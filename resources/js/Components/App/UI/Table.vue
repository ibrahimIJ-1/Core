<template>
    <table class="w-full text-center">
        <tr>
            <th v-for="header in headers">{{ header }}</th>
        </tr>
        <tbody>
            <slot />
        </tbody>
    </table>
</template>

<script setup lang="ts">
const props = defineProps({
    headers: {
        type: Array,
        required: true
    },
})
</script>