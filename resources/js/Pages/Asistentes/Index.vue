<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, usePage, useForm, Link } from '@inertiajs/vue3';
import InputError from '@/Components/InputError.vue';

import { ref } from 'vue';
import { Transition } from 'vue';

const page = usePage();
const temas = ref(page.props.tema);
const asistentes = ref(page.props.asistente);

console.log(asistentes);

const initialValues = {
  nombre: "",
  cargo: "",
  tema_id: "", // Aquí se almacenará el ID del tema seleccionado
  confirmado: false,
};

const form = useForm(initialValues);

// Función para enviar el formulario
const submitForm = () => {
  const routeName = form.id ? 'asistentes.update' : 'asistentes.store'; // Si tenemos un ID, es una actualización
  const method = form.id ? 'post' : 'post';

  form[method](route(routeName, form.id || ''), {
    preserveScroll: true, // Mantiene el desplazamiento actual
    onSuccess: (response) => {
      if (response.success) {
        // Actualizar la lista de asistentes en el frontend
        asistentes.value = response.asistentes;
        form.reset(); // Limpiar el formulario después de éxito
      }
    },
    onError: () => {
      console.error("Error al guardar el asistente");
    },
  });
};


const onDeleteSucces = (e) =>{
   asistentes.value = e.props.asistente
}

const editAsistente = (asistente) => {
  // Llenamos el formulario con los datos del asistente seleccionado
  form.nombre = asistente.nombre;
  form.cargo = asistente.cargo;
  form.tema_id = asistente.tema_id;
  form.confirmado = asistente.confirmado;

  // También puedes guardar el ID del asistente para usarlo cuando se envíe el formulario
  form.id = asistente.id;
};
</script>


<template>
    <Head title="Tema" />

    <AuthenticatedLayout>
      <Head title="Asistentes" />

      <!-- Mensaje de éxito -->


      <div class="max-w-7xl mx-auto py-12 sm:px-6 lg:px-8">
        <div class="bg-white p-6 rounded shadow">
          <div>

    <Transition
        enter-active-class="transition ease-in-out"
        enter-from-class="opacity-0"
        leave-active-class="transition ease-in-out"
        leave-to-class="opacity-0"
      >
        <p v-if="form.recentlySuccessful" class="text-md flex justify-center text-green-600">
          Asistencia Creada
        </p>
     </Transition>
            <h1 class="text-2xl font-bold mb-6">Seleccionar un tema:</h1>

            <!-- Dropdown de temas -->
            <select
              v-model="form.tema_id"
              class="block w-1/2 p-2 border rounded-md mb-6"
            >
              <option value="" disabled>Selecciona un tema</option>
              <option
                v-for="tema in temas"
                :key="tema.id"
                :value="tema.id"
              >
                {{ tema.nombre }}
              </option>
            </select>

            <InputError class="mt-2" :message="form.errors.tema_id" />
          </div>

          <!-- Formulario -->
          <form @submit="submitForm" class="mb-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
              <div>
                <label class="block text-sm font-medium text-gray-700">Nombre</label>
                <input v-model="form.nombre" type="text" class="w-full mt-1 border-gray-300 rounded-md shadow-sm" required />
              </div>
              <div>
                <label class="block text-sm font-medium text-gray-700">Cargo</label>
                <input v-model="form.cargo" type="text" class="w-full mt-1 border-gray-300 rounded-md shadow-sm" required />
              </div>
              <div>
                <label class="block text-sm font-medium text-gray-700">Confirmado</label>
                <select v-model="form.confirmado" class="w-full mt-1 border-gray-300 rounded-md shadow-sm" required>
                  <option :value="true">Sí</option>
                  <option :value="false">No</option>
                </select>
              </div>
            </div>
            <button
                type="submit"
                class="mt-4 bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600"
                >
                {{ form.id ? 'Actualizar Asistente' : 'Agregar Asistente' }}
            </button>
          </form>



          <!-- Listado -->
          <table class="min-w-full border-collapse border border-gray-200">
            <thead class="bg-gray-50">
              <tr>
                <th class="px-4 py-2 border">Nombre</th>
                <th class="px-4 py-2 border">Cargo</th>
                <th class="px-4 py-2 border">Confirmado</th>
                <th class="px-4 py-2 border">Acciones</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="asistente in asistentes" :key="asistente.id" class="hover:bg-gray-100">
                <td class="px-4 py-2 border">{{ asistente.nombre }}</td>
                <td class="px-4 py-2 border">{{ asistente.cargo }}</td>
                <td class="px-4 py-2 border">{{ asistente.confirmado ? 'Sí' : 'No' }}</td>
                <td class="px-4 py-2 border">
                <td class="flex justify-center  px-4 py-2 ">
                <button
                    @click="editAsistente(asistente)"
                    class="     bg-yellow-500 text-white px-4 py-2 rounded-md hover:bg-yellow-600"
                >
                    Editar
                </button>
                </td>

                <div class="flex justify-center">
                    <Link
                        @success="onDeleteSucces"
                          :href="route('asistentes.destroy', asistente.id)"method= "delete" as ="button"
                          class="  bg-red-500 text-white space-x-2 px-6 py-2 rounded-md hover:bg-red-600"
                        >
                          Eliminar
                    </Link>

                    <Link :href="route('verificaciones.index', asistente.id)" class="  bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600">
                    Verificaciones
                    </Link>

                </div>

                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </AuthenticatedLayout>
  </template>
