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
                        <tr v-for="user in users?.data" :key="user.id" class="hover:bg-gray-200">
                            <td>{{ user.name }}</td>
                            <td>{{ user.email }}</td>
                            <td>{{ user.permissions.length }}</td>
                            <td>{{ user.roles.length }}</td>
                            <td>{{ user.isActive }}</td>
                            <td>
                                <Button v-if="can?.users_edit" text="Edit" :callback="()=>editButton(user.name)"
                                    type="primary" />
                            </td>
                        </tr>
                    </Table>
                </div>
            </div>
        </div>
        <form @submit.prevent="submit">
            <input type="text" v-model="form.name">
            <button type="submit" :disabled="form.processing">Submit</button>
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

interface Users{
    data:User[];
}

const props = defineProps({
    users: {
        type: Object as () => Users,
        required: false
    },
    can: {
        type: Object as () => Record<string, boolean>,
        required: true
    }
})

const form = useForm({
    name: null as string | null
})

const editButton = (name: string) => {
    console.log(name);
}

const submit = () => {
    form.post(route('setUserRole'));
}
</script>
