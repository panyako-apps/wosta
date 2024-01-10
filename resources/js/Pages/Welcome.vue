<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue'
import { Head, Link} from '@inertiajs/vue3';
import Hero  from '@/Components/sections/Hero.vue';
import ServiceCard from '@/Components/cards/ServiceCard.vue'
import CountryCard from '@/Components/cards/CountryCard.vue'
import PartnerLogos from '@/Components/sliders/PartnerLogos.vue'
import StatsRow from '@/Components/StatsRow.vue';
import ListItem from '@/Components/ListItem.vue';
import PlayVideo from '@/Components/PlayVideo.vue';
import ClientTestimonial1 from '@/Components/ClientTestimonial1.vue';
import PostThumbnail from '@/Components/PostThumbnail.vue'
import countries from '@/Stores/countries';

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
    heroslideshows: [Object, Array],
    sitesettings: [Object, Array],
    services: [Object, Array],
    posts: [Object, Array],
    testimonials: [Object, Array],
})


const about = props.sitesettings.filter(item => item.custom_id == 'about')[0];
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
const section6 = props.page.sections.filter(section=>section.name === 'Section 6')[0]
const section7 = props.page.sections.filter(section=>section.name === 'Section 7')[0]
const section8 = props.page.sections.filter(section=>section.name === 'Section 8')[0]


const featuredPost = 
    props.posts.data.filter(post=>post.isFeatured === 1).length 
    ? props.posts.data.filter(post=>post.isFeatured === 1)[0] 
    : props.posts.data[0];
    

</script>

<template>
    <GuestLayout>
        <Head>
            <title>Welcome</title>
            <meta name="description" content="">
        </Head>
        <div class="mx-auto">
            <div class="h-[37rem] mb-8 xl:mb-20">
                <Hero v-if="props.heroslideshows.data.length" :slides="props.heroslideshows.data[0].slides"/>
            </div>
            
            <section class="max-w-7xl mx-auto xl:mb-20 px-6" :id="section1.name">

                <div class="grid md:grid-cols-2 gap-8 mx-auto pb-3 md:pb-0">
                    <div class="flex overflow-hidden">
                        <img src="https://isepstudyabroad.files.wordpress.com/2016/04/joyd-2.png" alt="" class="w-full h-full object-cover">
                    </div>
                    <div class="md:p-4 ">
                        <span class="uppercase text-slate-600 border-b border-b-slate-600 mb-4">{{section1.title}}</span>
                        <h2 class="font-bold text-primary text-3xl md:text-4xl xl:text-5xl my-4" v-html="section1.intro"></h2>
                        <p class="mb-4" v-html="section1.description"></p>
                        <div class="flex gap-4 justify-between">
                            <div class="">
                                <ListItem v-for="item in section1.points" :key="item" :text="item"/>
                            </div>
                            <PlayVideo />
                 
                        </div>
                    </div>
                </div>
            </section>

            <section class="bg-slate-100 py-12  px-6" :id="section2.name">
                <div class="max-w-7xl mx-auto text-center">
                    <span class="uppercase text-slate-600 border-b border-b-slate-600">{{section2.title}}</span>
                    <h2 class="font-bold text-primary text-3xl md:text-4xl xl:text-5xl my-4 mb-8 lg:w-2/3 mx-auto" v-html="section2.intro"></h2>
                    <div class="grid grid-cols-2 lg:grid-cols-3 gap-4 lg:gap-8">
                        <ServiceCard v-for="service in services.data.slice(0,6)" :service="service" :key="service.id"/>
                    </div>
                </div>
            </section>


            <section class=" bg-slate-100 lg:py-12" :id="section3.name">
                <div class="lg:relative lg:h-[40rem] mb-12">
                    <div class="lg:absolute bottom-0 left-0 lg:w-[51%] h-[24rem] lg:h-[36rem] z-20">
                        <div class="relative h-full">
                            <img src="https://www.afterschoolafrica.com/wp-content/uploads/2017/01/scholarships-for-black-students-guide.jpg" alt="" class="w-full h-full object-cover">
                            <div class="absolute right-0 bottom-0 bg-secondary bg-opacity-75 lg:bg-opacity-100 w-[26%] h-full lg:h-[30rem] text-white text-center">
                               <div class="flex flex-col justify-around h-full px-4">
                                   <div class="h-1/3 flex items-center justify-center">
                                        <div class="">
                                            <p class="text-4xl font-bold">856</p>
                                            <p>Completed Transfers</p>
                                        </div>
                                   </div>
                                   <div class="h-1/3 flex items-center justify-center border-t border-b border-t-slate-200 border-b-slate-200">
                                        <div class="">
                                            <p class="text-4xl font-bold">1532</p>
                                            <p>Processed Visas</p>
                                        </div>
                                   </div>
                                   <div class="h-1/3 flex items-center justify-center">
                                        <div class="">
                                            <p class="text-4xl font-bold">16</p>
                                            <p>Partner Universities</p>
                                        </div>
                                   </div>
                               </div>
                            </div>
                        </div>
                        
                    </div>
                    <div class="lg:absolute top-0 right-0 lg:w-[51%] lg:h-[36rem] z-10 bg-primary">
                        <div class="p-6 py-10 lg:p-16 text-white xl:w-[45rem]">
                            <span class="uppercase text-white border-b border-b-white">{{section3.title}}</span>
                            <h2 class="font-bold text-white text-3xl md:text-4xl xl:text-5xl my-4 mb-8  mx-auto" v-html="section3.intro"></h2>
                            <p v-html="section3.description"></p>
                        </div>
                    </div>
                </div>
            </section>

            <section class="lg:py-12 px-6" :id="section4.name">
                <div class="max-w-7xl mx-auto text-center">
                    <span class="uppercase text-primary border-b border-b-slate-600">{{section4.title}}</span>
                    <h2 class="font-bold text-primary text-3xl md:text-4xl xl:text-5xl my-4 mb-8 lg:w-2/3 mx-auto" v-html="section4.intro"></h2>
                    <div class="grid grid-cols-2 lg:grid-cols-4 gap-8 mb-10 lg:mb-20">
                        <CountryCard v-for="country in countries" :key="country" :country="country"/>
                    </div>
                </div>
            </section>

            <section class="" :id="section5.name">
                <div class="grid lg:grid-cols-2 lg:h-[50rem] relative">
                    <div class="bg-primary h-full"></div>
                    <div class="">
                        <img src="https://st3.depositphotos.com/2783505/32529/i/450/depositphotos_325299558-stock-photo-group-of-happy-african-american.jpg" alt="" class="w-full h-full object-cover">
                    </div>
                    <div class="lg:absolute lg:inset-0 bg-primary lg:bg-transparent px-6 ">
                        <div class="max-w-7xl mx-auto flex gap-4 h-full">
                            <div class="lg:w-1/2 py-8 lg:py-16 lg:pr-8">
                                <span class="uppercase text-white border-b border-b-white">{{section5.title}}</span>
                                <h2 class="font-bold text-white text-3xl md:text-4xl xl:text-5xl my-4 mb-8" v-html="section5.intro"></h2>  
                                <div class="lg:pr-16">
                                    <ClientTestimonial1 v-for="testimonial in testimonials.data.slice(0,2)" :key="testimonial" :testimonial="testimonial"/>
                                </div>
                            </div>
                       
                        </div>
    
                    </div>
                </div>
            </section>
            <StatsRow :id="section6.name"/>
            
            <section class="py-12" :id="section7.name">
                <div class="max-w-7xl mx-auto ">
                    <div class="text-center">
                        <span class="uppercase text-primary  border-b border-slate-600">{{section7.title}}</span>
                    </div>
                    <h2 class="font-bold text-primary text-3xl md:text-4xl xl:text-5xl my-4 mb-8 lg:w-2/3 mx-auto text-center px-6 lg:px-0" v-html="section7.intro"></h2>
                    <div class="lg:relative lg:h-[36rem]">
                        <div class="grid lg:grid-cols-2 lg:mb-20 lg:h-[34rem] z-10">
                            <div class="h-full overflow-hidden">
                                <img :src="featuredPost.image" alt="" class="w-full h-full object-cover hover:scale-110 transition-all duration-500 ease-linear">
                            </div>
                            <div class="bg-slate-50 h-full p-6 lg:p-12 text-start">
                                <h4 class="uppercase text-slate-500 mb-4 space-x-2">
                                    <span class="mb-2  border-b border-slate-500">{{featuredPost.user.name}} </span><span>|</span><span class="mb-2  border-b border-slate-500">{{featuredPost.comments.length}} {{featuredPost.comments.length === 1 ? 'Comment' : 'Comments'}}</span>
                                </h4>
                                <Link :href="route('post.show', featuredPost.slug)" class="text-primary font-bold xl:text-3xl hover:text-primary cursor-pointer transition-colors duration-200 ease-linear">
                                    {{featuredPost.name}}
                                </Link>
                                <p class="mt-2">{{featuredPost.description.slice(0, 260)}} {{featuredPost.description.length > 260 ? '...' : ''}}</p>
                            </div>
                        </div>

                        <div class="lg:absolute lg:w-[46rem] bg-slate-100 lg:h-[16rem] z-20 -bottom-0 -right-0 flex items-center justify-center p-6">
                            <div class="grid lg:grid-cols-2 gap-4">
                                <PostThumbnail v-for="post in posts.data.slice(0, 4)" :key="post" :post="post"/>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
           
            <section class="" :id="section8.name">
                <PartnerLogos />
            </section>

        </div>

    </GuestLayout>    

</template>



