<script setup>
import { Head, useForm } from '@inertiajs/vue3';

const props = defineProps({
    contact: Object,
});

const form = useForm({
    name: props.contact.name,
    email: props.contact.email,
    phone: props.contact.phone,
});

const submit = () => {
    form.put(route('contacts.update', props.contact.id));
};
</script>

<template>
    <Head title="Editar Contato" />

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h1 class="text-2xl font-bold mb-6">Editar Contato</h1>

                    <form @submit.prevent="submit">
                         <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-700">Nome</label>
                            <input type="text" v-model="form.name" id="name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                             <div v-if="form.errors.name" class="text-red-500 mt-2 text-sm">{{ form.errors.name }}</div>
                        </div>

                        <div class="mb-4">
                            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                            <input type="email" v-model="form.email" id="email" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                             <div v-if="form.errors.email" class="text-red-500 mt-2 text-sm">{{ form.errors.email }}</div>
                        </div>

                        <div class="mb-4">
                            <label for="phone" class="block text-sm font-medium text-gray-700">Telefone</label>
                            <input type="text" v-model="form.phone" id="phone" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                             <div v-if="form.errors.phone" class="text-red-500 mt-2 text-sm">{{ form.errors.phone }}</div>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <button type="submit" :disabled="form.processing" class="px-4 py-2 bg-blue-500 text-white rounded-md">Atualizar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>