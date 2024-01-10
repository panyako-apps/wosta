<script setup>
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


</script>
<template>
    <Swiper
          :modules="[A11y]"
          :slides-per-view="6"
          :space-between="0"
          :loop="true"
          :breakpoints = "{
              320: {
                  slidesPerView: 2,
                  pagination: false
              },
              640: {
                  slidesPerView: 3,
              },
              1024: {
                  slidesPerView: 6,
              }
          }"
      >
        <SwiperSlide v-for="i in 12" :key="i" class="group">
            <div class="bg-slate-100 h-32 flex items-center justify-center border-r border-r-slate-300">
                <img src="https://image.similarpng.com/very-thumbnail/2021/08/Air-travel-logo-template.png" alt="" class="w-full h-full object-contain grayscale hover:grayscale-0 hover:-translate-y-1 transition-all duration-500 ease-linear">
            </div>
        </SwiperSlide>
    </Swiper>
</template>


<style>

</style>