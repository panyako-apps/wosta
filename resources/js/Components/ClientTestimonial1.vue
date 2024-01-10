<template>
    <div class="relative mb-8">
    <div class="bg-teal-400 bg-opacity-5 rounded-lg p-6">
        <p class=" text-slate-100 italic" v-html="props.testimonial.testimony"></p>
        <span class="flex justify-end gap-1">
            <font-awesome-icon v-for="i in 5" :key="i" icon="fa-star" class="text-sm text-yellow-400"></font-awesome-icon>
        </span>
    </div>
    <div class="pl-16 -mt-4">
        <font-awesome-icon icon="fa-caret-down" class="text-5xl text-teal-400 opacity-5"></font-awesome-icon>
    </div>
    <div class="flex gap-4 pl-12">
        <div class="h-14 w-14 rounded-full overflow-hidden bg-white">
            <img :src="testimonial.image" alt="" class="w-full h-full object-cover">
        </div>
        <div class="text-white">
            <h4 class="text-lg">{{testimonial.title}} {{testimonial.name}}</h4>
            <p>{{testimonial.job_title}}</p>
        </div>
    </div>
</div>
</template>

<script setup>
const props = defineProps({
    testimonial: Object
})
</script>
