<script setup>


import { ref, watch } from 'vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import { Head, Link, router } from '@inertiajs/vue3';

const props = defineProps({
    videos: Array,
    filters: Array,
});

const search = ref(props.filters.search);
const perPage = ref(props.filters.perPage);



watch(search, value => {
    router.get(route('videos.index'), {perPage: perPage.value, search: search.value}, {
        preserveState: true,
        replace: true,
    });
})

function getVideos(){
    router.get(route('videos.index'), {perPage: perPage.value, search: search.value}, {
        preserveState: true,
        replace: true,
    });
}

</script>

<template>
<Head title="Videos" />
<GuestLayout>
    <div class="bg-gray-200 px-4 md:px-0 py-12">
        <div class="container mx-auto ">
            <div class="border border-dashed border-pink-600 rounded-lg p-6 md:w-[32rem] text-gray-500">
                <h1 class="text-3xl font-bold uppercase">
                    Workout Videos.
                </h1>
                <hr class="my-3 border border-dashed border-gray-500">
                <p class="">We have sampled some of the best Workout videos from YouTube that are beneficial to your physiological, psychological and econimical wellbeing.</p>
            </div>
        </div>
    </div>
    <div v-if="props.videos.data.length>0" class="container mx-auto px-4 md:px-0 pt-12 min-h-screen">

        <div class="bg-white rounded-lg p-6 mb-6">
            <div class="md:grid grid-cols-2 gap-4 mb-3">
                <div class="md:flex gap-2 md:mb-3 mb-6 border border-gray-500 border-dashed rounded-md p-4">
                    <div class="mb-2 md:mb-0 md:w-1/2">
                        <label for="search" class="block text-sm font-bold text-gray-700">Live Search</label>
                        <input type="search" name="search" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-gray-500 focus:ring-gray-500 sm:text-sm text-gray-600 py-1" placeholder="Enter keyword e.g. yoga, cardio" v-model="search">
                    </div>

                    <div class="grid grid-cols-2 gap-2 items-end  mb-3 md:mb-0 md:w-1/2">
                        <div class="">
                            <label for="perPage" class="block text-sm font-bold text-gray-700">Per Page</label>
                            <select name="perPage" id="perPage" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-gray-500 focus:ring-gray-500 sm:text-sm text-gray-600 py-1 bg-gray-200"
                            v-model="perPage" @change="getVideos"
                            >
                                <option value="4">4</option>
                                <option value="8">8</option>
                                <option value="16">16</option>
                                <option value="20">20</option>
                                <option value="32">32</option>
                                <option value="40">40</option>
                                <option value="100">100</option>
                            </select>
        
                        </div> 
                        <div class="md:flex items-end">
                            <Link :href="route('videos.index')" class="block md:inline-flex text-center rounded-md border border-transparent bg-red-600 px-4 py-1 text-sm font-medium text-white shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">Clear Filters</Link>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mb-6">
                <template v-for="(link, index) in props.videos.links" :key="index" >
                    <span v-if="link.url=== null" v-html="link.label" class="border border-gray-300 text-gray-300 px-3 py-1 rounded-lg"></span>
                    <Link v-else :href="link.url" v-html="link.label" 
                                    class="border border-gray-300 text-gray-300 text-sm font-bold hover:bg-gray-600 hover:border-none 
                                            hover:text-white px-3 py-1 rounded-lg mx-1 transition-all duration-200"
                                    :class="{'bg-gray-900': link.active}"                        
                                            >
                    </Link>
                </template>
            </div>
            <div class="mx-auto max-w-2xl lg:container mb-6">
                <h2 class="sr-only">Workout Videos</h2>

                <div class="grid grid-cols-1 gap-4 sm:grid-cols-4">
                    <div v-for="video in props.videos.data" :key="video.id" class="rounded-md shadow-lg overflow-hidden">
                        <iframe class="w-full h-48" :src="'https://www.youtube.com/embed/'+video.code" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                        <div class="flex gap-1 items-center p-2">
                            <Link :href="route('admin.video.edit', video.id)" class="rounded-md border border-transparent bg-indigo-600 px-4 py-1 text-xs text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Edit</Link>
                            <button @click="deleteVideo(video.id)" class="rounded-md border border-transparent bg-red-600 px-4 py-1 text-xs text-white shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                </svg>
                            </button> 
                        </div>
                    </div>
                </div>

            </div>

            <div class="">
                <template v-for="(link, index) in props.videos.links" :key="index" >
                    <span v-if="link.url=== null" v-html="link.label" class="border border-gray-300 text-gray-300 px-3 py-1 rounded-lg"></span>
                    <Link v-else :href="link.url" v-html="link.label" 
                                    class="border border-gray-300 text-gray-300 text-sm font-bold hover:bg-gray-600 hover:border-none 
                                            hover:text-white px-3 py-1 rounded-lg mx-1 transition-all duration-200"
                                    :class="{'bg-gray-900': link.active}"                        
                                            >
                    </Link>
                </template>
            </div>

        </div>

    </div>
</GuestLayout>

</template>


<style>

</style>