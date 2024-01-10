<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import { Head, Link, usePage } from '@inertiajs/vue3';
import FavouriteButton from '@/Components/buttons/FavoriteButton.vue';
import Comment from '@/Components/comment/Comment.vue';
import NewCommentForm from '@/Components/comment/NewCommentForm.vue';
import { onMounted, ref } from 'vue';
import ModelViews from '@/Components/ModelViews.vue'
import ImageCard from '@/Components/cards/ImageCard.vue'
import ServiceCard from '@/Components/cards/ServiceCard.vue';

const props = defineProps({
     service: Object,
     sharelinks: [Array, Object]
});


const isShowingMobileMenu = ref(false)

const coverimage = { 
    "id": 0, 
    "title": null, 
    "description": 'cover image', 
    "url": props.service.data.image, 
    "views": null, 
    "likes": [], 
    "isPublished": 1, 
    "isFeatured": 0 
};


const comments = ref([]);
const images = ref([]);

const fetchComments = async ()=>{
    const res = await axios.post(route('api.comments.index'),
    {
        commentable_id: props.service.data.id,
        commentable_type: 'App\\Models\\Service'
    });
    comments.value = res.data.data
}

const fetchImages = async ()=>{
    const res = await axios.post(route('api.images.index'),
    {
        imageable_id: props.service.data.id,
        imageable_type: 'App\\Models\\Service',
        folder: 'service'
    });
    
    if(res.status ===200)
    {
        images.value = res.data.data
        images.value.unshift(coverimage);
    }

}

onMounted(()=>{
    fetchComments();
    fetchImages();
});


</script>

<template>
    <Head :title="service.data.name">
        <meta name="description" :content="service.data.tags">
    </Head>


    <GuestLayout>
        <div class="min-h-screen">
            <section class="bg-white relative h-48" id="header-image">
                <img src="https://www.kenya2uhub.com/wp-content/uploads/2019/06/Inland-container-terminal-Embakasi-Nairobi.jpg" alt="" class="w-full h-full object-cover">
                <div class="absolute inset-0 h-full bg-black bg-opacity-50">
                    <div class="max-w-7xl mx-auto text-white flex items-center h-full justify-center lg:justify-start px-6 lg:px-0">
                        <div class="">
                            <h1 class="text-4xl lg:text-6xl font-bold">{{ service.data.name }}</h1>
                            <p class="space-x-2 text-sm">
                                <font-awesome-icon icon="fa-home" class="text-secondary"></font-awesome-icon>
                                <a href="/" class="hover:text-secondary font-bold">Home </a> 
                                <span>|</span> 
                                <a :href="route('services.index')" class="hover:text-secondary font-bold">Services </a> 
                                <span>|</span> 
                                <span>{{ service.data.name }}</span>
                            </p>
                        </div>
                    </div>
                </div>
            </section>
            <h2 class="sr-only">{{ service.data.name }}</h2>
            <div class="max-w-7xl mx-auto grid lg:grid-cols-[70%_30%] gap-8 py-16 px-6">
                <div class="">
                    <div class="mb-12">
                        <img :src="service.data.image" alt="" class="w-full ">
                    </div>
                    <section class="container mx-auto mb-3" id="service-details">

                        <div class="">
                            <div class="mb-3 border-b border-slate-300">
                                <h3 class="text-xl font-bold text-slate-700 uppercase">{{service.data.name}}</h3>
                            </div>
                            <p class="mb-3" v-html="service.data.description "></p>
                            <div class="flex gap items-center pb-6 mb-3 border-b border-slate-300">
                                
                                <div class="text-slate-500 px-3 py-1 text-center">
                                    <ModelViews 
                                        :viewable_type="`App\\Models\\Service`" 
                                        :viewable_id="service.data.id" 
                                        />  
                                </div>

                            </div>
                        
                        </div>
                    </section>
             
                    <section id="customer-feedback">
                        <div class="md:flex justify-between items-center">
                            <h3 class="font-bold text-primary text-xl uppercase">Comments</h3>
                            <div class="flex flex-row-reverse md:flex-row gap-2 items-center justify-between">
                                <div class="text-slate-500 py-1 text-center">{{comments.length}} 
                                    <span v-if="comments.length === 1">comment</span>    
                                    <span v-else>comments</span>    
                                </div>
                                <NewCommentForm
                                    :commentable_type="`App\\Models\\Service`" 
                                    :commentable_id="service.data.id" 
                                    @commentposted="fetchComments"
                                    />
                            </div>
                        </div>
                        <div v-if="comments.length>0" class="my-3">
                            <Comment 
                                    v-for="(comment, index) in comments" 
                                    :key="index" 
                                    :comment="comment"
                                    :replies="comment.comments"
                                    @replyposted="fetchComments"
                                    >
                            </Comment>
                        </div>
                        <div v-else class="flex justify-center items-center rounded-md border border-dashed border-primary mt-2">
                            <p class="p-12 text-center text-primary"><span class="font-bold text-slate-700">No Comments.</span> Be the first to post a comment.</p>
                        </div>
                    </section>
                </div>
                <div class="hidden lg:block">
                    <div class="bg-slate-200 h-56 mb-8"></div>
                    <div class="bg-slate-200 h-56 mb-8"></div>
                    <div class="bg-slate-200 h-56 mb-8"></div>
                    <div class="bg-slate-200 h-56 mb-8"></div>
                </div>
            </div>
            
        </div>
    </GuestLayout> 
</template>
