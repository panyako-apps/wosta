<script setup>
import { onMounted, ref } from 'vue';
import { Head, Link, usePage } from '@inertiajs/vue3';
import axios from 'axios';

import GuestLayout from '@/Layouts/GuestLayout.vue';
import LikeButton from '@/Components/buttons/LikeButton.vue';
import Comment from '@/Components/comment/Comment.vue';
import NewCommentForm from '@/Components/comment/NewCommentForm.vue';
import ModelViews from '@/Components/ModelViews.vue'
import ImageCard from '@/Components/cards/ImageCard.vue'


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
     post: Object,
     sharelinks: [Array, Object]
})

const user = usePage().props.auth.user;

const comments = ref([]);
const images = ref([]);

const fetchComments = async ()=>{
    const res = await axios.post(route('api.comments.index'),
    {
        commentable_id: props.post.data.id,
        commentable_type: 'App\\Models\\Post'
    });
    comments.value = res.data.data
}

onMounted(()=>{
    fetchComments()
    fetchImages();
});

const fetchImages = async ()=>{
    const res = await axios.post(route('api.images.index'),
    {
        imageable_id: props.post.data.id,
        imageable_type: 'App\\Models\\Post',
        folder: 'post'
    });
    
    images.value = res.data.data
}


</script>

<template>
    <Head :title="post.data.name">
        <meta name="description" :content="post.data.tags">
    </Head>
    <GuestLayout>
        <div class="py-6 min-h-screen">
            <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
                <h2 class="sr-only">{{ post.data.name }}</h2>

                <div class="container mx-auto px-3 md:px-0 mb-6 gap-8">
                    <!-- LEFT -->
                    <div class="mb-4 grid grid-cols-1 gap-4">
                        <div class="w-full overflow-hidden bg-slate-200 p-2 rounded-lg md:min-h-[200px]">
                            <img :src="post.data.image" class="object-cover w-full max-h-screen rounded" >   
                        </div>
                        <div class="">
                            <Link :href="route('posts.index')" class="text-slate-600"> <font-awesome-icon icon="fa-chevron-circle-left"></font-awesome-icon> Back</Link>
                        </div>
                        <div class="space-y-4">
                            <div class="bg-white p-5 rounded-lg">
                                <div class="mb-3">
                                    <h3 class="text-xl font-bold uppercase text-slate-700">{{post.data.name}}</h3>
                                    <p>Posted By <Link :href="route('post.userposts', post.data.user.id)" class="text-blue-600 font-bold">{{post.data.user.name}}</Link> {{ post.data.created_at }} In <Link :href="route('post.category.index', post.data.category.id)" class="text-blue-600 font-bold">{{post.data.category.name}}</Link> </p>
                                    <hr class="my-3">
                                </div>
            
                                <p class="rounded-md p- mb-3" v-html="post.data.description"></p>
        
                                <div class="flex gap-2 items-center">
                                    <div class="bg-blue-600 rounded-md border-none px-2 py-1 text-sm font-medium text-white shadow-sm flex items-center">
                                        <ModelViews 
                                            :viewable_type="`App\\Models\\Post`" 
                                            :viewable_id="post.data.id" 
                                            />  
                                    </div>
                                    <div class="text-white bg-slate-500 px-3 py-1 rounded-md text-center">{{comments.length}} 
                                        <span v-if="comments.length === 1">comment</span>    
                                        <span v-else>comments</span>    
                                    </div>
                                    <div class=""> 
                                        <LikeButton 
                                            :likeable_type="`App\\Models\\Post`" 
                                            :likeable_id="post.data.id" 
                                            />  
                                    </div>
                                </div>
        
                            </div>
                        </div>


                        <div class=" gap-4 pb-6 mb-6 border-b border-slate-300">

                            <Swiper
                                :modules="[Pagination, A11y, Scrollbar, Autoplay]"
                                :slides-per-view="8"
                                :space-between="10"
                                :autoplay = "{
                                    delay: 5000,
                                    disableOnInteraction: false,
                                    pauseOnMouseEnter: true,
                                }"
                                :loop="true"
                                :pagination="{ clickable: true }"
                                :scrollbar="{ draggable: true}"
                                :breakpoints = "{
                                    320: {
                                        slidesPerView: 1.5,
                                    },
                                    640: {
                                        slidesPerView: 2,
                                    },
                                    1024: {
                                        slidesPerView: 3,
                                    }
                                }"
                            >
                                <SwiperSlide v-for="(image, index) in images" :key="index" class="mb-12 w-fit flex justify-center p-2 rounded-md shadow-md bg-slate-200">
                                    <div class="break-inside-avoid-column h-56" >
                                        <ImageCard :url="image.url"/>
                                        <div class="text-sm text-slate-600 uppercase">
                                            <LikeButton v-if="user"
                                                        :likeable_type="`\\App\\Models\\Image`" 
                                                        :likeable_id="image.id" 
                                                        :no-background="true"
                                                        :text="' like'"
                                                        class="mt-3"
                                                        />
                                            <div v-if="image.description||image.title" class="mt-2 mb-3">
                                                <h3 class="uppercase font-bold text-blue-600 border-b border-blue-300 mb-1">{{ image.title }}</h3>
                                                <p>{{ image.description }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </SwiperSlide>
                            </Swiper>
                        </div>


                        <div class="md:flex justify-between items-center">
                            <h3 class="font-bold text-blue-600 text-xl uppercase">Comments & Reactions</h3>
                            <NewCommentForm
                                :commentable_type="`\\App\\Models\\Post`" 
                                :commentable_id="post.data.id" 
                                @commentposted="fetchComments"
                            />
                        </div>

                        <div v-if="comments.length" class="my-3">
                            <Comment 
                                    v-for="(comment, index) in comments" 
                                    :key="index" 
                                    :comment="comment"
                                    :replies="comment.comments"
                                    @replyposted="fetchComments"
                                    >
                            </Comment>
                        </div>
                        <div v-else class="flex justify-center items-center rounded-md border border-dashed border-blue-600 ">
                            <p class="p-12 text-center text-blue-600"><span class="font-bold text-slate-700">No Comments.</span> Be the first to post a comment.</p>
                        </div>

                    </div>

                </div>

            </div>
        </div>
    </GuestLayout>
</template>
