<script setup>
import DashboardLayout from '@/Layouts/DashboardLayout.vue';
import AddSlideshow from './Create.vue'
import { Link, router} from '@inertiajs/vue3';
import Edit from './Edit.vue'
import Delete from './Delete.vue'
import Dropdown from '@/Components/Dropdown.vue'

import PublishButton from '@/Components/buttons/PublishButton.vue';

import { ref } from 'vue';
import Modal from "@/Components/Modal.vue";
import Spinner from '@/Components/spinners/Spinner.vue';

defineProps({
    slideshows: {
        type: [Array, Object], 
        required: true,
    },
})


const selectedSlideshows = ref([]);
const show = ref(false);
const inProgress = ref(false);

const toggleModal = ()=>{
    show.value = !show.value
}



const deleteSelectedSlideshows = ()=>{

    inProgress.value= true;
    show.value = true;

    router.post(route('admin.slideshow.destroymultiple'), {
        _method: 'delete',
        ids: selectedSlideshows.value,
    }, 
    {
        onProgress: ()=>{
            inProgress.value= true;
            toggleModal();
        },
        onSuccess: ()=>{
            inProgress.value = false;
            selectedSlideshows.value = [];
            show.value=false;
        },
    })
}


const publishSelectedSlideshows = ()=>{

    inProgress.value= true;
    show.value = true;

    router.post(route('admin.slideshow.publishmultiple'), {
        ids: selectedSlideshows.value,
    }, 
    {
        onProgress: ()=>{
            inProgress.value= true;
            toggleModal();
        },
        onSuccess: ()=>{
            inProgress.value = false;
            selectedSlideshows.value = [];
            show.value=false;
        },
    })
}



const unPublishSelectedSlideshows = ()=>{

    inProgress.value= true;
    show.value = true;

    router.post(route('admin.slideshow.unpublishmultiple'), {
        ids: selectedSlideshows.value,
    }, 
    {
        onProgress: ()=>{
            inProgress.value= true;
            toggleModal();
        },
        onSuccess: ()=>{
            inProgress.value = false;
            selectedSlideshows.value = [];
            show.value=false;
        },
    })
}
const primaryLinkClasses = 'px-3 py-1 text-gray-600 hover:bg-sky-600 hover:text-white rounded hover:shadow-md transition-all duration-200 mb-1 w-full block text-left';
const dropdownClasses = 'w-full text-left p-1 text-slate-700 hover:opacity-75 hover:text-sky-700 hover:pl-4 hover:border-l hover:border-sky-700 transitio duration-200 ease-in-out';
</script>


<template>
    <DashboardLayout>

        
        <div class="">
            <div class="flex justify-between items-center mb-2">
                <AddSlideshow />
                <div v-if="selectedSlideshows.length" class="flex gap-1 justify-end items-center">
                    <p class="text-sm font-bold uppercase text-sky-600">With Selected</p>
                    <Dropdown align="right" width="36">
                        <template #trigger>
                            <button type="button" class="h-6 w-6 rounded-md bg-slate-200 text-sky-600 cursor-pointer hover:bg-slate-300 flex items-center justify-center">
                                <font-awesome-icon icon="fa-ellipsis-h"></font-awesome-icon>
                            </button>
                        </template>

                        <template #content>  
                            <button @click="deleteSelectedSlideshows" :class="dropdownClasses">Delete</button>
                            <button @click="publishSelectedSlideshows" :class="dropdownClasses">Publish</button>
                            <button @click="unPublishSelectedSlideshows" :class="dropdownClasses">Un-Publish</button>
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
                            Name 
                        </th>
                        <th scope="col" class="px-2 py-2 text-left">
                            Position 
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
                    <tr v-for="(slideshow, index) in $props.slideshows" :key="index" class="bg-white border-b transition duration-300 ease-in-out hover:bg-gray-100">

                        <td class="px-2">
                            <input 
                                type="checkbox" 
                                :id="slideshow.id" 
                                :value="slideshow.id" 
                                v-model="selectedSlideshows"
                                class="rounded "
                                >
                        </td>
                  
                        <td class="text-gray-900 font-light px-2 py-4">
                            <p v-html="slideshow.name" :class="[slideshow.isPublished ? 'text-sky-600' : '']"></p>
                        </td>
                        <td class="text-gray-900 font-light px-2 py-4">
                            <p v-html="slideshow.position" class=""></p>
                        </td>
                        
                        <td class="text-gray-900 font-light px-2 py-4">
                            <p v-html="slideshow.description" class=""></p>
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
                                            :model="slideshow"
                                            :publishable_type="`\\App\\Models\\Slideshow`" 
                                            :publishable_id="slideshow.id" 
                                            />        
                                        <Edit :categories="categories" :slideshow="slideshow" />
                                        <Delete :slideshow="slideshow" />
                                        <Link :href="route('admin.slideshow.manage', slideshow.slug)" :class="primaryLinkClasses">
                                            <font-awesome-icon icon="fa-cloud-meatball"></font-awesome-icon>
                                            Manage
                                        </Link> 
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
                <Spinner :has-text="true" :text="'Working...'"/>
            </div>
        </Modal>

    </DashboardLayout>
</template>