<script setup>
import { computed, ref, watch } from 'vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import { Head, Link, router, usePage } from '@inertiajs/vue3';
import PostCard from '@/Components/cards/PostCard.vue';
import Spinner from '@/Components/spinners/Spinner.vue';
import Pagination from '@/Components/paginations/Pagination.vue'

const props = defineProps({
    posts: [Array, Object],
    categories: [Array, Object],
    filters: [Array, Object],
});
const page = usePage();

const activeCategoryIndex = ref(-1);
const activeCategoryId = ref();

const search = ref(props.filters.search);
const perPage = ref(props.filters.perPage);

const perpageValues = [
    '4',
    '8',
    '16',
    '20',
    '24',
    '32',
    '64',
    '96',
];

const activeElementsClass = 'flex gap-3 items-center px-4 py-2 bg-rose-500 text-white  shadow-md';
const nonActiveElementsClass = 'flex gap-3 items-center px-4 py-2 my-1 bg-slate-200 hover:bg-rose-200 hover:text-rose-500 hover:shadow-lg transition-all duration-200';

const isFetching = ref(false);


const changeCategory = async (index, id)=>{
   
    activeCategoryIndex.value = index;
    activeCategoryId.value = id;   
    
    
    if(activeCategoryId.value === 0 )
    {
        isFetching.value = true;
        await new Promise((res)=>setTimeout(res, 500));
        
        router.visit(route('posts.index'), {
                onSuccess: ()=>{
                isFetching.value = false;
            }
        }); 

    } 
    else{
        getPosts();
    }
}


watch(search, value => {
    
    isFetching.value = true;
        
    router.get(route('posts.index'), {perPage: perPage.value, search: search.value}, {
        preserveState: true,
        replace: true,
        onSuccess: ()=>{
            isFetching.value = false;
        }
    });
})


async function getPosts(){

    isFetching.value = true;
    
    await new Promise((res)=>setTimeout(res, 500));

    router.get(route('posts.index'), {perPage: perPage.value, search: search.value, category_id: activeCategoryId.value}, {
        preserveState: true,
        replace: true,
        onSuccess: ()=>{
            isFetching.value = false;
        }
    });
}


const formatDescription =(description)=>{
    if(description.length>160){
        return description.slice(0, 160)+'...'
    }
    return description.slice(0, 160)
}

</script>

<template>
<Head title="Posts" />
<GuestLayout>
    <div class="min-h-screen bg-slate-200">
            <section class="bg-white relative h-48 -mx-4" id="header-image">
                <img src="https://www.kenya2uhub.com/wp-content/uploads/2019/06/Inland-container-terminal-Embakasi-Nairobi.jpg" alt="" class="w-full h-full object-cover">
                <div class="absolute inset-0 h-full bg-black bg-opacity-50">
                    <div class="max-w-7xl mx-auto text-white flex items-center h-full justify-center lg:justify-start">
                        <div class="">
                            <h1 class="text-6xl font-bold">Blog</h1>
                            <p class="space-x-2 text-sm">
                                <font-awesome-icon icon="fa-home" class="text-secondary"></font-awesome-icon>
                                <a href="/" class="hover:text-secondary font-bold">Home </a> 
                                <span>|</span> 
                                <span>Blog</span>
                            </p>
                        </div>
                    </div>
                </div>
            </section>
            <h2 class="sr-only">Blog</h2>
            <div class="max-w-7xl mx-auto lg:grid grid-cols-[70%_30%] gap-8 py-16">

                <section class="container mx-auto mb-3" id="service-details">
                    <div v-for="post in posts.data" :key="post" class="bg-white  mb-8 p-4 lg:flex">

                        <div class="lg:w-[30%] bg-secondary shrink-0 h-72">
                            <Link :href="route('post.show', post.slug)">
                                <img :src="post.image" alt="" class="w-full h-full object-cover">
                            </Link>
                        </div>
                        <div class="px-6 py-4">
                            <div class="border-b border-b-slate-300 pb-3 mb-4">
                                <h4 class="uppercase text-slate-500 space-x-2 text-sm mb-4">
                                    <span class="mb-2  border-b border-slate-500">{{post.user.name}} </span><span>|</span><span class="mb-2 border-b border-slate-500">{{post.comments.length}} {{post.comments.length === 1 ? 'Comment' : 'Comments'}}</span>
                                </h4>
                                <Link :href="route('post.show', post.slug)" class="text-primary font-bold xl:text-2xl hover:text-secondary transition-colors duration-200 ease-linear leading-">
                                    {{post.name}}
                                </Link>
                            </div>
                            <p class="mb-3" v-html="formatDescription(post.description)"></p>
                            <Link :href="route('post.show', post.slug)" class="text-primary font-bold  hover:text-secondary transition-colors duration-200 ease-linear ">
                                View More
                            </Link>
                        </div>
                    </div>
                </section>
                
                <section class="hidden lg:block">
                    <div class="bg-white h-36 mb-8"></div>
                    <div class="bg-white h-64 mb-8"></div>
                    <div class="bg-white h-56 mb-8"></div>
                    <div class="bg-white h-72 mb-8"></div>
                </section>
            </div>
            
        </div>
</GuestLayout>
</template>