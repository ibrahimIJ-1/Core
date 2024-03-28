<template>
    <button @click="props.callback()" class="border-[1px] rounded py-1 px-2 hover:bg-white hover:text-black"
        :class="buttonStyles[props.type]">{{ text }}</button>
</template>

<script setup lang="ts">
const props = defineProps({
    text: String,
    type:{
        type:String,
        required:true
    },
    callback: {
        type: Function,
        required: true
    }
})



const buttonStyles = {
    primary: "border-sky-500 bg-sky-500 text-white",
    secondary: "border-gray-500 bg-gray-500 text-white",
    danger: "border-rose-500 bg-red-500 text-white",
    success: "border-green-500 bg-green-500 text-white",
    warning: "border-yellow-500 bg-yellow-500 text-white"
}
</script>