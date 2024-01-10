
<script setup>
import { ref } from "vue"
const props = defineProps({
    testimonial: Object
})


const formatTestimony = (testimony) => {
    if(testimony.length > 160)
    {
        return testimony.slice(0, 160)+'...'
    }

    return testimony
}

const showMoreTestimony = ref(false)
const toggleMoreTestimony = () => {
    showMoreTestimony.value = !showMoreTestimony.value
}


</script>

<template>
 <div @mouseenter="toggleMoreTestimony" @mouseleave="toggleMoreTestimony" class="bg-slate-100 lg:h-72 lg:flex gap-4 items-center border-2 border-r-slate-300 p-4 lg:p-0">
    <div class="w-12 lg:w-32 shrink-0 h-full text-center lg:pt-8 hidden lg:block">
        <font-awesome-icon icon="fa-quote-right" class="text-4xl lg:text-8xl text-secondary"></font-awesome-icon>
    </div>
    <div class="">
        <div class="lg:flex gap-4">
            <div class="lg:h-24 lg:w-24 h-56 w-56 overflow-hidden shrink-0 border-4 border-white shadow mb-4 lg:mb-0">
                <img :src="testimonial.image" class="w-full h-full object-cover hover:scale-110 transition-all duration-500 ease-linear">
            </div>
            <div class="lg:pr-6">
                <h3 class="text-primary font-bold xl:text-xl ">
                    {{testimonial.title}} {{testimonial.name}}
                </h3>
                <p class="text-slate-500 space-x-2 text-sm mb-2">
                    {{testimonial.job_title}}
                </p>
                <p class="flex gap-1 mb-4">
                    <font-awesome-icon v-for="i in 5" :key="i" icon="fa-star" class="text-sm text-yellow-400"></font-awesome-icon>
                </p>

                <div class="relative">
                    <p  class="italic" v-html="formatTestimony(testimonial.testimony)"></p>
                    
                    <Transition 
                        tag="div"
                        enter-from-class="translate-y-full opacity-0"
                        enter-active-class="duration-500"
                        leave-active-class="duration-500"
                        leave-to-class="translate-y-full opacity-0"
                        class="">
                        <div v-if="showMoreTestimony" class="absolute -top-10" :class="[testimonial.testimony.length> 160 ? 'block' : 'hidden']">
                            <p class="bg-white p-4 rounded-md shadow h-36 overflow-y-scroll customscroll" v-html="testimonial.testimony"></p>
                        </div>
                    </Transition>

                </div>
            </div>
        </div>
    </div>
</div>
</template>