<template>

    <Head title="Users" />
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Users</h2>
        </template>
        <div class="py-12">
            <div class="mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <Table :headers="['name', 'email', 'permissions count', 'roles count', 'is active', 'actions']">
                        <tr v-for="user in users.data" :key="(user as User).id" class="hover:bg-gray-200">
                            <td>{{ (user as User).name }}</td>
                            <td>{{ (user as User).email }}</td>
                            <td>{{ (user as User).permissions.length }}</td>
                            <td>{{ (user as User).roles.length }}</td>
                            <td>{{ (user as User).isActive }}</td>
                            <td><Button v-if="can?.users_edit" text="Edit" :callback="() => editButton((user as User).name)" type="primary" />
                            </td>
                        </tr>
                    </Table>
                </div>
            </div>
        </div>
        <form @submit.prevent="submit">
            <input type="text" v-model="form.name">
            <button type="submit" :disabled="form.processing">Login</button>
        </form>
    </AuthenticatedLayout>
</template>

<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import Table from '@/Components/App/UI/Table.vue';
import Button from '@/Components/App/UI/Buttons/Button.vue';
import { useForm } from "@inertiajs/vue3"

interface User {
    id: number;
    name: string;
    email: string;
    isActive: boolean;
    permissions: string[];
    roles: string[];
}

const props = defineProps({
    users: {
        type: Array,
        required: false
    },
    can: Array
})

const form = useForm({
    name: null
})

const editButton = (name) => {
    console.log(name);

}

const submit = () => {
    form.post(route('setUserRole'))
}
</script>