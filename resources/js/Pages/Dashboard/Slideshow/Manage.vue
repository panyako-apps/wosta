<script setup>
import {  ref } from 'vue';
import DashboardLayout from '@/Layouts/DashboardLayout.vue';
import { Head, Link, router} from '@inertiajs/vue3';
import AddSlide from '../Slide/Create.vue';
import EditSlide from '../Slide/Edit.vue';
import DeleteSlide from '../Slide/Delete.vue'
import PublishButton from '@/Components/buttons/PublishButton.vue';
import Dropdown from '@/Components/Dropdown.vue'
import Spinner from '@/Components/spinners/Spinner.vue';
import Modal from "@/Components/Modal.vue";

const props = defineProps({
    slideshow: [Object],
    slides: [Object, Array],
});


const selectedSlides = ref([]);
const show = ref(false);
const inProgress = ref(false);

const toggleModal = ()=>{
    show.value = !show.value
}



const deleteSelectedSlides = ()=>{

    inProgress.value= true;
    show.value = true;

    router.post(route('admin.slide.destroymultiple'), {
        _method: 'delete',
        ids: selectedSlides.value,
    }, 
    {
        onProgress: ()=>{
            inProgress.value= true;
            toggleModal();
        },
        onSuccess: ()=>{
            inProgress.value = false;
            selectedSlides.value = [];
            show.value=false;
        },
    })
}


const publishSelectedSlides = ()=>{

    inProgress.value= true;
    show.value = true;

    router.post(route('admin.slide.publishmultiple'), {
        ids: selectedSlides.value,
    }, 
    {
        onProgress: ()=>{
            inProgress.value= true;
            toggleModal();
        },
        onSuccess: ()=>{
            inProgress.value = false;
            selectedSlides.value = [];
            show.value=false;
        },
    })
}



const unPublishSelectedSlides = ()=>{

    inProgress.value= true;
    show.value = true;

    router.post(route('admin.slide.unpublishmultiple'), {
        ids: selectedSlides.value,
    }, 
    {
        onProgress: ()=>{
            inProgress.value= true;
            toggleModal();
        },
        onSuccess: ()=>{
            inProgress.value = false;
            selectedSlides.value = [];
            show.value=false;
        },
    })
}


const btnClasses = 'rounded-full border border-transparent bg-sky-600 px-3 py-1 text-sm text-white shadow-sm hover:bg-sky-700 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:ring-offset-2';
const dropdownClasses = 'w-full text-left p-1 text-slate-700 hover:opacity-75 hover:text-sky-700 hover:pl-4 hover:border-l hover:border-sky-700 transitio duration-200 ease-in-out';

</script>

<template>
<Head title="Manage Slideshow" />

<DashboardLayout>

    <div class="flex justify-between items-center mb-2">
        <Link :href="route('admin.slideshows.index')" :class="btnClasses">Back</Link>
    </div>
    <div class="container mx-auto pb-6">
        <h2 class="sr-only">{{ props.slideshow.data.name }}</h2>
        
        <div class="container mx-auto px-3 md:px-0  mb-6 ">

            <div class="">
                <div class="mb-3">
                    <h3 class="text-xl  text-sky-800 uppercase">Slideshow: <span class="font-bold">{{props.slideshow.data.name}}</span></h3>
                    <hr>
                    <p class="" v-html="props.slideshow.data.description"></p>
                </div>
            </div>   
        </div>


        <div class="">
    
            <div class="flex justify-between items-center mb-2">

                <AddSlide :slideshow="slideshow.data" />
                <div v-if="selectedSlides.length" class="flex gap-1 justify-end items-center">
                    <p class="text-sm font-bold uppercase text-sky-600">With Selected</p>
                    <Dropdown align="right" width="36">
                        <template #trigger>
                            <button type="button" class="h-6 w-6 rounded-md bg-slate-200 text-sky-600 cursor-pointer hover:bg-slate-300 flex items-center justify-center">
                                <font-awesome-icon icon="fa-ellipsis-h"></font-awesome-icon>
                            </button>
                        </template>

                        <template #content>  
                            <button @click="deleteSelectedSlides" :class="dropdownClasses">Delete</button>
                            <button @click="publishSelectedSlides" :class="dropdownClasses">Publish</button>
                            <button @click="unPublishSelectedSlides" :class="dropdownClasses">Un-Publish</button>
                        </template>
                    </Dropdown>
                </div>
            </div>
            

            <table class="min-w-full text-sm">
                <thead class="bg-gray-200 text-gray-500">
                    <tr>
                        <th scope="col" class="px-2 py-2 text-left">
                            <input 
                                type="checkbox" 
                                class="rounded"
                                >
                        </th>
                        <th scope="col" class="px-2 py-2 text-left">
                            Cover Image 
                        </th>
                        <th scope="col" class="px-2 py-2 text-left">
                            Title 
                        </th>
                        <th scope="col" class="px-2 py-2 text-left">
                            Description 
                        </th>
                        <th scope="col" class="px-2 py-2 text-left">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(slide, index) in props.slideshow.data.slides" :key="index" class="bg-white border-b transition duration-300 ease-in-out hover:bg-gray-100">

                        <td class="px-2">
                            <input 
                                type="checkbox" 
                                :id="slide.id" 
                                :value="slide.id" 
                                v-model="selectedSlides"
                                class="rounded"
                                >
                        </td>
                
                        <td class="text-gray-900 font-light px-2 py-4">
                            <div class="h-48 w-56 overflow-hidden rounded-md">
                                <img :src="slide.image" class="object-cover h-full w-full" >
                            </div>
                        </td>
                        <td class="text-gray-900 font-light px-2 py-4">
                            <span :class="[slide.isFeatured ? 'text-sky-600 font-bold' : '']" v-html="slide.title"></span>
                            <span v-if="slide.isFeatured " class="h-5 w-5 rounded-full flex items-center justify-center bg-sky-500 text-white font-bold text-xs">F</span>
                        </td>
                        <td class="text-gray-900 font-light px-2 py-4 ">
                            <p v-html="slide.description"></p>
                            {{ slide.isFeatured }}
                        </td>
                        
                        <td class="text-gray-900 font-light px-2 py-4">
                            <div class="flex justify-end gap-1 items-center pr-5">
                                <Dropdown align="right" width="36">
                                    <template #trigger>
                                        <button type="button" class="h-6 w-6 rounded-full bg-slate-200 text-slate-500 cursor-pointer hover:bg-slate-300 flex items-center justify-center">
                                            <font-awesome-icon icon="fa-ellipsis-h"></font-awesome-icon>
                                        </button>
                                    </template>

                                    <template #content>
                                        <PublishButton 
                                            :model="slide"
                                            :publishable_type="`\\App\\Models\\Slide`" 
                                            :publishable_id="slide.id" 
                                            />       
                                        <EditSlide :slide="slide" />
                                        <DeleteSlide :slide="slide" />
                                        
                                    </template>

                                </Dropdown>

                            </div>
                        </td>

                    </tr>
                    
                </tbody>
            </table>
        </div>

        <Modal :show="show" :closeable="true">
            <div v-if="inProgress" class="p-6 h-36 flex justify-center items-center">
                <Spinner :has-text="true" :text="'Deleting Images...'"/>
            </div>
        </Modal>

   
    </div> 

</DashboardLayout>

</template>
