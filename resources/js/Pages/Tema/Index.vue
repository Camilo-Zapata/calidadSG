<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, usePage } from '@inertiajs/vue3';
import {ref} from 'vue';


const page = usePage();
const temas = ref(page.props.tema);

const onDeleteSucces = (e) =>{
    temas.value = e.props.tema
}



console.log(page.props.tema);

defineProps({
  temas: Array, // Recibe los datos de los temas desde el controlador
});
</script>

<template>
  <Head title="Tema" />

  <AuthenticatedLayout>
    <template #header>
      <div class="flex justify-between items-center">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Tema</h2>
        <Link :href="route('tema.create')" class="bg-green-500 hover:bg-green-700 px-4 py-2 rounded-md transition">
          Crear Tema
        </Link>
      </div>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <div class="p-6">
            <!-- Tabla Responsive -->
            <div class=" flex justify-center  overflow-x-auto">
              <table class="min-w-full table-auto border-collapse border border-gray-200">
                <thead class="bg-gray-100">
                  <tr>
                    <th class="px-4 py-2 border border-gray-200 text-left font-medium text-gray-600">Nombre</th>
                    <th class="px-4 py-2 border border-gray-200 text-left font-medium text-gray-600">Tipo</th>
                    <th class="px-4 py-2 border border-gray-200 text-left font-medium text-gray-600">Objetivo</th>
                    <th class="px-4 py-2 border border-gray-200 text-left font-medium text-gray-600">Nombre del facilitador</th>
                    <th class="px-4 py-2 border border-gray-200 text-left font-medium text-gray-600">Cargo del facilitador</th>
                    <th class="px-4 py-2 border border-gray-200 text-left font-medium text-gray-600">Acciones</th>
                  </tr>
                </thead>
                <tbody>
                  <tr
                    v-for="tema in temas"
                    :key="tema.id"
                    class="odd:bg-white even:bg-gray-50 hover:bg-gray-100 transition"
                  >
                    <td class="px-4 py-2 border border-gray-200">{{ tema.nombre }}</td>
                    <td class="px-4 py-2 border border-gray-200">{{ tema.tipo }}</td>
                    <td class="px-4 py-2 border border-gray-200">{{ tema.objetivo }}</td>
                    <td class="px-4 py-2 border border-gray-200">{{ tema.facilitador_nombre }}</td>
                    <td class="px-4 py-2 border border-gray-200">{{ tema.facilitador_cargo }}</td>
                    <td class="px-6 py-2 border border-gray-200">
                      <div class="flex space-x-3">
                        <Link
                          :href="route('tema.edit', tema.id)"
                          class=" px-3 py-1 rounded-md text-sm transition bg-yellow-500 hover:bg-yellow-700 "
                        >
                          Editar
                        </Link>
                        <Link
                        @success="onDeleteSucces"
                          :href="route('tema.destroy', tema.id)"method= "delete" as ="button"
                          class=" px-3 py-1 rounded-md text-sm transition bg-red-500 hover:bg-red-700"
                        >
                          Eliminar
                        </Link>
                      </div>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
