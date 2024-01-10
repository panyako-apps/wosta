<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue'
import { Head, Link, router, usePage } from '@inertiajs/vue3';
import { ref, onMounted, computed } from 'vue';
import ListItem from '@/Components/ListItem.vue';

import Hero  from '@/Components/sections/Hero.vue';
import LinearProgress from '@/Components/progress/LinearProgress.vue'
import TeamMemberCard from '@/Components/cards/TeamMemberCard.vue'
import StatsRow from '@/Components/StatsRow.vue';
import TestimonialsSlider from '@/Components/sliders/TestimonialsSlider.vue'

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
    page: [Object, Array],
    categories: [Object, Array],
    sitesettings: [Object, Array],
    corevalues: [Object, Array],
    staffMembers: [Object, Array],
    testimonials: [Object, Array],

})


const getProductsByCategory = async (id)=>{
    router.get(route('products.index'), {category_id: id});
}


const appname = props.sitesettings.filter(item => item.custom_id == 'appname')[0];
const slogan = props.sitesettings.filter(item => item.custom_id == 'slogan')[0];
const mission = props.sitesettings.filter(item => item.custom_id == 'mission')[0];
const vision = props.sitesettings.filter(item => item.custom_id == 'vision')[0];

//Page Sections
const section1 = props.page.sections.filter(section=>section.name === 'Section 1')[0]
const section2 = props.page.sections.filter(section=>section.name === 'Section 2')[0]
const section3 = props.page.sections.filter(section=>section.name === 'Section 3')[0]
const section4 = props.page.sections.filter(section=>section.name === 'Section 4')[0]
const section5 = props.page.sections.filter(section=>section.name === 'Section 5')[0]

</script>

<template>
    <GuestLayout>
        <Head>
            <title>Welcome</title>
            <meta name="description" content="">
        </Head>
      
        <section class="bg-white relative h-48 " id="header-image">
            <img src="https://www.kenya2uhub.com/wp-content/uploads/2019/06/Inland-container-terminal-Embakasi-Nairobi.jpg" alt="" class="w-full h-full object-cover">
            <div class="absolute inset-0 h-full bg-black bg-opacity-50">
                <div class="max-w-7xl mx-auto text-white flex items-center h-full justify-center lg:justify-start">
                    <div class="">
                        <h1 class="text-6xl font-bold">About Us</h1>
                        <p class="space-x-2 text-sm">
                            <font-awesome-icon icon="fa-home" class="text-secondary"></font-awesome-icon>
                            <a href="/" class="hover:text-secondary font-bold">Home </a> 
                            <span>|</span> 
                            <span>About Us</span>
                        </p>
                    </div>
                </div>
            </div>
        </section>
        <section class="py-16 " :id="section1.name">
            <div class="max-w-7xl mx-auto  lg:flex gap-12 px-6">
                <div class="lg:w-[50%] shrink-0 lg:h-[36rem] mb-6 lg:mb-0">
                    <img src="https://www.afterschoolafrica.com/wp-content/uploads/2017/01/scholarships-for-black-students-guide.jpg" alt="" class="w-full h-full object-cover">
                </div>
                <div class="h-full">
                    <span class="uppercase text-slate-600 border-b border-b-slate-400">{{section1.title}}</span>
                    <h2 class="font-bold text-primary text-2xl md:text-4xl xl:text-5xl my-4 leading-5" v-html="section1.intro"></h2>
                    <p class="mb-6 text-md" v-html="section1.description"></p>
                      
                    <div class="mb-6 flex flex-col gap-4">
                        <LinearProgress :text="'Education Placements'" :progress-end-value="75"/>
                        <LinearProgress :text="'Visa Applications'" :progress-end-value="88"/>
                        
                    </div>
  
                    <div class="lg:flex justify-between gap-8">
                        <div class="lg:w-[40%] h-[10rem] shrink-0 mb-6 lg:mb-0">
                            <img src="https://www.afterschoolafrica.com/wp-content/uploads/2017/01/scholarships-for-black-students-guide.jpg" alt="" class="w-full h-full object-cover">
                        </div>
                        <div class="">
                            <ListItem v-for="item in section1.points" :key="item" :text="item"/>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <section class=" bg-primary relative lg:h-[40rem] px-6" :id="section2.name">
            <img src="https://w7.pngwing.com/pngs/302/241/png-transparent-city-landscape-illustration-city-of-melbourne-new-york-city-drawing-skyline-sketch-pencil-pencil-city-monochrome.png" alt="" class="w-full h-full object-cover z-10 hidden lg:block">
            <div class="lg:absolute inset-0 bg-primary bg-opacity-95 z-20 py-16 flex items-center">
                <div class="max-w-7xl mx-auto ">
                    <div class="">
                        <div class="text-center">
                            <span class="uppercase text-white border-b border-b-slate-400">{{section2.title}}</span>
                        </div>
                    </div>
                    <h2 class="font-bold text-white text-2xl md:text-4xl xl:text-5xl my-4 mb-8 lg:w-2/3 mx-auto text-center" v-html="section2.intro"></h2>

                    <div class="">
                        
                        <div class="text-white lg:flex items-center gap-20 pb-8 mb-8 border-b-[0.1px] border-b-white">
                            <div class="flex gap-4 items-center lg:border-r lg:border-r-white lg:w-[25%] lg:pr-6 shrink-0 mb-6 lg:mb-0">
                                <div class="h-16 w-16 rounded-full shrink-0 border border-dashed border-white flex justify-center items-center">
                                    <font-awesome-icon icon="fa-bullseye" class="text-4xl"></font-awesome-icon> 
                                </div>
                                <span class="font-bold text-2xl">{{vision.title}}</span>
                            </div>
                            <p class="text-sm" v-html="vision.description"></p>
    
                        </div>


                        <div class="text-white lg:flex items-center gap-20 pb-8 mb-8">
                            <div class="flex gap-4 items-center lg:border-r lg:border-r-white lg:w-[25%] lg:pr-6 shrink-0 mb-6 lg:mb-0">
                                <div class="h-16 w-16 rounded-full shrink-0 border border-dashed border-white flex justify-center items-center">
                                    <font-awesome-icon icon="fa-file-alt" class="text-4xl"></font-awesome-icon> 
                                </div>
                                <span class="font-bold text-2xl">{{mission.title}}</span>
                            </div>
                            <p class="text-sm" v-html="mission.description"></p>
    
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <section class="py-16 px-6" :id="section3.name">
            <div class="max-w-7xl mx-auto lg:h-[24rem]">
                <div class="h-full">
                    <span class="uppercase text-slate-600 border-b border-b-slate-400">{{section3.title}}</span>
                    <div class="lg:flex items-center justify-between gap-4 mb-8">
                        <h2 class="font-bold text-primary text-2xl md:text-4xl xl:text-5xl my-4 leading-5" v-html="section3.intro"></h2>
                        <Link :href="'/'" class="bg-secondary hover:bg-rose-600 text-white font-bold px-5 py-2.5 rounded-full my-auto flex items-center justify-center">
                            Explore More
                        </Link>
                    </div>

                    <div class="grid lg:grid-cols-4 gap-4 lg:gap-12">
                        <TeamMemberCard v-for="staff in staffMembers.data.slice(0,4)" 
                            :key="staff"
                            :staff="staff"/>
                    </div>
                </div>
            </div>
        </section>
        <section class="" :id="section4.name">
            <StatsRow />
        </section>
        <section class="py-16 lg:flex items-center px-6" :id="section5.name">
            <div class="max-w-7xl mx-auto">
                <TestimonialsSlider :testimonials="testimonials.data" />
            </div>
        </section>
    </GuestLayout>    

</template>


<style>
/* #cta-1 {
    background: url('/storage/globals/maize-plantation.png');
    background-attachment: fixed;
    background-repeat: no-repeat;
    background-size: cover;
}
#cta-2, #cta-3 {
    background: url('/storage/globals/maize-plantation-2.png');
    background-attachment: fixed;
    background-repeat: no-repeat;
    background-size: cover;
} */
</style>
