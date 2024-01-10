<template>
    <div class="flex gap-2 items-center">
        <div class="rounded-full shrink-0 bg-blue-600 flex justify-center items-center text-white overflow-hidden" :class="classes">
             <img :src="image" alt="" class="w-full h-full object-cover">
         </div>
         <div v-if="title" class="leading-4">
            <h3 class="uppercase text-blue-700 font-bold">{{ title }}</h3>
            <p class="text-sm text-red-500">Featured Review.</p>
         </div>
    </div>
</template>

<script setup>

const props = defineProps({
    classes:{
        type: String,
        default: 'h-10 w-10'
    },
    image: {
        type: String,
    }, 
    showTitle: false,
    title: String
})
</script>

<style>

</style>