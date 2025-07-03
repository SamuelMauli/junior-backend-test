<script setup>
import { Head, Link } from '@inertiajs/vue3';

defineProps({
    contacts: Object,
});
</script>

<template>
    <Head title="Contatos" />

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex justify-between items-center mb-6">
                        <h1 class="text-2xl font-bold">Contatos</h1>
                        <Link :href="route('contacts.create')" class="px-4 py-2 bg-blue-500 text-white rounded-md">Novo Contato</Link>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full">
                            <thead>
                                <tr>
                                    <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-sm leading-4 text-blue-500 tracking-wider">Nome</th>
                                    <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-sm leading-4 text-blue-500 tracking-wider">Email</th>
                                    <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-sm leading-4 text-blue-500 tracking-wider">Telefone</th>
                                    <th class="px-6 py-3 border-b-2 border-gray-300"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="contact in contacts.data" :key="contact.id">
                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-500">{{ contact.name }}</td>
                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-500">{{ contact.email }}</td>
                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-500">{{ contact.phone }}</td>
                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-500 text-right">
                                        <Link :href="route('contacts.edit', contact.id)" class="px-4 py-2 bg-green-500 text-white rounded-md mr-2">Editar</Link>
                                        <Link :href="route('contacts.destroy', contact.id)" method="delete" as="button" type="button" class="px-4 py-2 bg-red-500 text-white rounded-md">Excluir</Link>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>