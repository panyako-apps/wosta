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
import { ref } from 'vue';
import ClientTestimonial2 from '@/Components/ClientTestimonial2.vue'

const props = defineProps({
    testimonials: [Array, Object]
})

</script>
<template>
    <Swiper
          :modules="[A11y, Autoplay]"
          :slides-per-view="2"
          :space-between="40"
          :autoplay = "{
                delay: 5000,
                disableOnInteraction: false,
                pauseOnMouseEnter: true,
            }"
          :loop="true"
          :breakpoints = "{
              320: {
                  slidesPerView: 1,
                  pagination: false
              },
              640: {
                  slidesPerView: 1,
              },
              1024: {
                  slidesPerView: 2,
              }
          }"
      >
        <SwiperSlide v-for="(testimonial, index) in props.testimonials" :key="testimonial+index" class="">
           <ClientTestimonial2 :testimonial = "testimonial"/>
        </SwiperSlide>
    </Swiper>
</template>


<style>

</style>