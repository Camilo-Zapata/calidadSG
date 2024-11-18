<script setup>
import { ref } from 'vue';
import { useForm, usePage } from '@inertiajs/vue3';

const page = usePage();
const verificacion = ref(page.props.verificacion);

const form = useForm({
    fecha_verificacion: verificacion.value.fecha_verificacion,
  responsable:  verificacion.value.responsable,
});

const submitForm = () => {
    form.post(route('verificaciones.update', { tema: page.props.tema.id, verificacion: verificacion.value.id }), {
        preserveScroll: true,
        onSuccess: (e) => {
            verificacion.value = e.props.verificacion;
            console.log('Verificación actualizada');
        },
        onError: () => {
            console.error('Error al actualizar la verificación');
        }
    });
};
</script>

<template>
    <div class="max-w-4xl mx-auto p-6 bg-white shadow rounded">
        <h1 class="text-2xl font-bold mb-6">Editar Verificación</h1>
        <form @submit.prevent="submitForm">
            <div class="mb-4">
                <label for="campo1" class="block text-sm font-medium text-gray-700">Campo 1</label>
                <input v-model="form.fecha_verificacion" id="campo1" type="date" class="w-full p-2 border rounded-md" />
            </div>
            <div class="mb-4">
                <label for="campo2" class="block text-sm font-medium text-gray-700">Campo 2</label>
                <input v-model="form.responsable" id="campo2" type="text" class="w-full p-2 border rounded-md" />
            </div>

            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Actualizar</button>
        </form>
    </div>
</template>
