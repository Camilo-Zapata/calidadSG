template<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';

const initialValues={

    nombre: "",
    tipo: "",
    objetivo:"",
    facilitador_nombre:"",
    facilitador_cargo:""
}

const form = useForm(initialValues);

const submit = ()=>{
   form.post(route('tema.store'))
}

</script>

<template>
    <Head title="Tema" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Tema</h2>

            <Link  :href="route('tema.index')"  >
            Listar Tema
            </Link>
        </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class=" flex justify-center bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <form class="bg py-4 space-y-6" @submit.prevent="submit">
                        <div>
                <InputLabel for="Nombre" value="Nombre" />

                <TextInput
                    id="nombre"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.nombre"

                    autofocus
                    autocomplete="nombre"
                />

                <InputError class="mt-2" :message="form.errors.nombre" />
            </div>

            <div>
                <InputLabel for="Tipo" value="Tipo" />

                <select
                id="tipo"
                v-model="form.tipo"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"

              >
                <option disabled value="">Seleccione un Tipo</option>
                <option value="capacitacion">Capacitacion</option>
                <option value="entrenamiento">Entrenamiento</option>
              </select>



                <InputError class="mt-2" :message="form.errors.tipo" />
            </div>

            <div>
                <InputLabel for="objetivo" value="Objetivo" />


                <TextInput
                    id="objetivo"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.objetivo"

                    autofocus
                    autocomplete="objetivo"
                />

                <InputError class="mt-2" :message="form.errors.objetivo" />
            </div>

            <div>
                <InputLabel for="facilitador_nombre" value="Nombre de Facilitador" />

                <TextInput
                    id="facilitador_nombre"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.facilitador_nombre"

                    autofocus

                />

                <InputError class="mt-2" :message="form.errors.facilitador_nombre" />

            </div>


            <div>
                <InputLabel for="facilitador_cargo" value="Cargo de Facilitador" />

                <TextInput
                    id="facilitador_cargo"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.facilitador_cargo"

                    autofocus
                    autocomplete="facilitador_cargo"
                    placeholder=""
                />

                <InputError class="mt-2" :message="form.errors.facilitador_cargo" />

            </div>
            <div class="flex justify-center">
            <PrimaryButton >
                Crear Tema
            </PrimaryButton>
        </div>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
