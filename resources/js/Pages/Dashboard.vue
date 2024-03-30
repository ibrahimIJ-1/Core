<template>

    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
        </template>

        <div class="py-12">
            <div class="mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">You're logged in!</div>
                    <form @submit.prevent="sendNotification">
                        <input type="text" v-model="form.name">
                        <button type="submit" :disabled="form.processing">Send</button>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, usePage, useForm } from '@inertiajs/vue3';
import Button from '@/Components/App/UI/Buttons/Button.vue';
import { onMounted, onUnmounted } from "vue";
import { register, unRegister } from '@/channels-manager.ts'
import { showErrorDialog, showSuccessNotification } from "@/event-bus.ts";

const sendNotification = () => {
    form.post(route('sendNotification'));
    showSuccessNotification('User sent 🚀')
    showErrorDialog('error')
}

onMounted(() => {
    const user = usePage().props.auth.user

    register({
        channelName: `dashboard`,
        channelEvent: 'TestEvent',
        callback: () => {
            alert('Reverb 🚀')
        }
    })

    register({
        channelName: `user.${user.id}`,
        channelEvent: 'UserEvent',
        callback: () => {
            alert('User sent 🚀')
        }
    })

});

onUnmounted(() => {
    const user = usePage().props.auth.user
    unRegister({ channelName: `user.${user.id}` })
    unRegister({ channelName: `dashboard` })
})

const form = useForm({
    name: null as string | null
})

</script>