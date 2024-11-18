<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

import { Head, usePage, useForm,  router, Link } from '@inertiajs/vue3';

import { ref } from 'vue';

const page = usePage();
const tema = ref(page.props.tema);
const  verificaciones = ref(page.props.verificaciones);

const form = useForm({
    fecha_verificacion: '',
  responsable: '',
});

const submitForm = () => {
  form.post(route('verificaciones.store', tema.value), {
    onSuccess: () => {
      form.reset();
    },
  });
};

const onDeleteSucces = (e) =>{
   verificaciones.value = e.props.verificaciones
}

const deleteVerification = (id) => {
  router.delete(route('verificaciones.destroy', { tema: tema.value, verificacion: id }));
};
</script>

<template>
  <AuthenticatedLayout>
    <Head title="Verificaciones" />

    <div class="max-w-7xl mx-auto py-12 sm:px-6 lg:px-8">
      <div class="bg-white p-6 rounded shadow">
        <h1 class="text-2xl font-bold mb-6">Verificaciones del tema: {{ tema.nombre }}</h1>

        <!-- Formulario -->
        <form @submit="submitForm" class="mb-6">
          <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
              <label class="block text-sm font-medium text-gray-700">Fecha</label>
              <input
                v-model="form.fecha_verificacion"
                type="date"
                class="w-full mt-1 border-gray-300 rounded-md shadow-sm"
                required
              />
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-700">Responsable</label>
              <input
                v-model="form.responsable"
                type="text"
                class="w-full mt-1 border-gray-300 rounded-md shadow-sm"
                required
              />
            </div>
          </div>
          <button
            type="submit"
            class="mt-4 bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600"
          >
            Agregar Verificación
          </button>
        </form>

        <!-- Listado -->
        <table class="min-w-full border-collapse border border-gray-200">
          <thead class="bg-gray-50">
            <tr>
              <th class="px-4 py-2 border">Fecha</th>
              <th class="px-4 py-2 border">Responsable</th>
              <th class="px-4 py-2 border">Acciones</th>
            </tr>
          </thead>
          <tbody>
            <tr
              v-for="verificacion in verificaciones"
              :key="verificacion.id"
              class="hover:bg-gray-100"
            >
              <td class="px-4 py-2 border">{{ verificacion.fecha_verificacion }}</td>
              <td class="px-4 py-2 border">{{ verificacion.responsable }}</td>
              <td class="px-4 py-2 border">

                <Link
                        :href="route('verificaciones.edit', { tema: tema.id, verificacion: verificacion.id })"
                        class="bg-yellow-500 text-white space-x-1  px-5   rounded"
                    >
                        Editar
                </Link>

                <Link
                @success="onDeleteSucces"

                    :href="route('verificaciones.destroy', { tema: tema.id, verificacion: verificacion.id })"
                    method="delete"
                    as="button"
                    class="bg-red-500 text-white space-y-4   flex px-3 py-1 rounded">
                    Eliminar
                </Link>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
