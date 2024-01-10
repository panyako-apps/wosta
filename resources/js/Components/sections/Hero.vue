
<script setup>
// import Button from '@/Components/buttons/Button.vue';
import HorizontalSeperator from '@/Components/seperators/HorizontalSeperator.vue';
import { Link } from '@inertiajs/vue3';
// import Swiper core and required modules
import { Navigation, Pagination, Scrollbar, A11y, Autoplay } from 'swiper/modules';
  
// Import Swiper Vue.js components
import { Swiper, SwiperSlide } from 'swiper/vue';

// Import Swiper styles
import 'swiper/css';
import 'swiper/css/bundle'
import 'swiper/css/navigation';
import 'swiper/css/pagination';
import 'swiper/css/scrollbar';
import 'swiper/css/autoplay';

const props = defineProps({
    slides: [Object, Array]
});

</script>


<template>
    <Swiper
        :modules="[Navigation, A11y, Autoplay]"
        :slides-per-view="1"
        :navigation="true"
        :autoplay = "{
            delay: 5000,
            disableOnInteraction: false,
            pauseOnMouseEnter: true,
        }"
        :loop="true"

    class="h-full"
    >
        <SwiperSlide v-for="(slide, index) in props.slides" :key="slide + index" class="h-full">
            <div class="absolute w-full h-full z-30">
                <div class="w-full lg:max-w-7xl mx-auto h-full flex" :class="[index % 3 !== 0 ? 'lg:flex-row-reverse ' : '']">
                    <div class="flex lg:w-1/2 items-center px-8 lg:px-0"  :class="[index % 3 !== 0 ? 'lg:pl-16' : 'lg:pr-16']">
                        <div class="text-white text-xl">
                            <p class="font-bold  mb-2" v-html="slide.title"></p>
                            <p class="text-5xl lg:text-6xl text-white font-extrabold mb-6" v-html="slide.description"></p>
                            <div class="lg:flex items-center gap-4">
                                <div class="mb-4 lg:mb-0">
                                    <button class="border border-white rounded-full px-6 py-2.5 hover:bg-secondary hover:border-secondary transition-all duration-300 ease-in-out">Pay Fee After Visa</button>
                                </div>
                                <div class="flex items-center gap-2">
                                    <div class="h-12 w-12 flex items-center justify-center border border-secondary border-dashed rounded-full text-secondary">
                                        <font-awesome-icon icon="phone-flip"></font-awesome-icon>
                                    </div>
                                    <div class="">
                                        <p class="text-lg">Call us</p>
                                        <p class="text-md">+31 6 36387766</p>
                                        <p class="text-md">+31 6 19757288</p>
                                    
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="w-0 lg:w-1/2"></div>
                </div>
            </div>
            <div class="absolute w-full lg:w-1/2 h-full bg-primary bg-opacity-90" 
                :class="[index % 3 !== 0 ? 'right-0' : '']"></div>
            <img :src="slide.image" alt="" class="inset-0 w-full h-full object-cover z-10">       
        </SwiperSlide>
    </Swiper>
</template>

<style>

</style>