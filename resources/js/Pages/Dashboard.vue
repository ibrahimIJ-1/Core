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
                    <Button type="primary" :callback="sendNotification" text="Send"/>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, usePage } from '@inertiajs/vue3';
import Button from '@/Components/App/UI/Buttons/Button.vue';
import {onMounted, onUnmounted} from "vue";
const sendNotification = ()=>{
    console.log('send');
}

onMounted(() => {
   const user = usePage().props.auth.user

   window.Echo.channel(`dashboard`)
        .listen('TestEvent', (e:any) => {
           alert('Reverb 🚀')
     })

});
</script>