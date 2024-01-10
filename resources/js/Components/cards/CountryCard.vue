<template>
    <Link :href="'/'">
        <div @mouseenter="show=true" @mouseleave="show=false" class=" w-full h-[12rem]  xl:h-[14rem] relative overflow-hidden" > 
            <div class="absolute inset-0 z-20 flex items-center justify-center bg-black bg-opacity-50">
                <h4 class="capitalize text-white text-lg font-bold">{{country.name}}</h4> 
            </div> 
            <img :src="props.country.image" class="z-10 object-cover w-full h-full scale-125" :class="show ? 'translate-y-5 transition-all duration-500 ease-linear' : ''">
        </div>
    </Link>
</template>

<script setup>
import { ref } from "vue"
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    country: Object,
})

const show = ref(false)
const toggleButtons = () =>{
    show.value = !show.value
}
</script>

<style>

</style>