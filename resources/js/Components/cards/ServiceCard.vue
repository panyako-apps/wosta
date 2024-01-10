<template>
    <a :href="route('service.show', props.service.slug)" >
        <div @mouseenter="show=true" @mouseleave="show=false" class=" w-full  xl:h-[23rem] relative overflow-hidden" >  
            <div class="h-[18rem] overflow-hidden">
                <img :src="props.service.image" class="object-cover w-full h-full scale-125" :class="show ? 'translate-y-5 transition-all duration-500 ease-in-out' : ''">
            </div>

            <div v-if="!show" class="absolute bottom-0 left-0 z-20 w-full ">
                <div class="w-3/4 mx-auto h-full my-auto">
                    <div class="flex items-center justify-center p-4 bg-white text-primary border border-slate-300 rounded transition-all duration-500 ease-linear capitalize">{{service.name}}</div>
                    <div class="flex items-center justify-center p-4 text-primary transition-all duration-500 ease-in-out">Explore More</div>
                </div>
            </div>

            <TransitionGroup 
                tag="div"
                enter-from-class="translate-y-full opacity-0"
                enter-active-class="duration-500"
                leave-active-class="duration-500"
                leave-to-class="translate-y-full opacity-0"
                class="">
                    <div v-if="show" class="absolute bottom-0 left-0 z-20 w-full ">
                        <div class="w-3/4 mx-auto h-full my-auto">
                            <div class="p-4 bg-primary transition-all duration-300 ease-in-out text-white">
                                <h3 class="capitalize font-bold">{{service.name}}</h3>
                                <hr class="border-b border-slate-200 border-opacity-50 my-3">
                                <p class="text-sm text-center" v-html="description"></p>
                            </div>
                            <Link :href="route('service.show', props.service.slug)" >
                                <div class="flex items-center justify-center p-4 bg-secondary text-white transition-all duration-300 ease-in-out">Explore More</div>
                            </Link>
                        </div>
                    </div>
            </TransitionGroup>
        </div>
    </a>
</template>

<script setup>
import { computed, ref } from "vue"
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    service: Object,
})
const show = ref(false)
const toggleButtons = () =>{
    show.value = !show.value
}

const description = computed(()=>{
    
    if(props.service.description.length>80){
        return props.service.description.slice(0,80)+'...'
    }

    return props.service.description.slice(0,80)
})

</script>

<style>

</style>