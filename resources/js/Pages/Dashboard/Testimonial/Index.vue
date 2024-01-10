<script setup>
import DashboardLayout from '@/Layouts/DashboardLayout.vue';
import { Link, router} from '@inertiajs/vue3';
import AddTestimonial from './Create.vue'
import Edit from './Edit.vue'
import Delete from './Delete.vue'
import Dropdown from '@/Components/Dropdown.vue'

import PublishButton from '@/Components/buttons/PublishButton.vue';
import FeatureButton from '@/Components/buttons/FeatureButton.vue';
import AssignCategoryButton from '@/Components/buttons/AssignCategoryButton.vue';

import { ref } from 'vue';
import Modal from "@/Components/Modal.vue";
import Spinner from '@/Components/spinners/Spinner.vue';

defineProps({
    testimonials: {
        type: [Array, Object], 
        required: true,
    }
})

const primaryLinkClasses = 'px-3 py-1 text-gray-600 hover:bg-primary hover:text-white rounded hover:shadow-md transition-all duration-200 mb-1 w-full block text-left';
const activeTabClasses = 'border-b border-primary px-3 py-2 text-sm text-primary';
const tabClasses = 'border-b-4 border-transparent px-3 py-2 text-sm text-primary';
const dropdownClasses = 'w-full text-left p-1 text-slate-700 hover:opacity-75 hover:text-sky-700 hover:pl-4 hover:border-l hover:border-sky-700 transitio duration-200 ease-in-out';


const selectedTestimonials = ref([]);
const show = ref(false);
const inProgress = ref(false);

const toggleModal = ()=>{
    show.value = !show.value
}



const deleteSelectedTestimonials = ()=>{

    inProgress.value= true;
    show.value = true;

    router.post(route('admin.testimonial.destroymultiple'), {
        _method: 'delete',
        ids: selectedTestimonials.value,
    }, 
    {
        onProgress: ()=>{
            inProgress.value= true;
            toggleModal();
        },
        onSuccess: ()=>{
            inProgress.value = false;
            selectedTestimonials.value = [];
            show.value=false;
        },
    })
}


const publishSelectedTestimonials = ()=>{

    inProgress.value= true;
    show.value = true;

    router.post(route('admin.testimonial.publishmultiple'), {
        ids: selectedTestimonials.value,
    }, 
    {
        onProgress: ()=>{
            inProgress.value= true;
            toggleModal();
        },
        onSuccess: ()=>{
            inProgress.value = false;
            selectedTestimonials.value = [];
            show.value=false;
        },
    })
}



const unPublishSelectedTestimonials = ()=>{

    inProgress.value= true;
    show.value = true;

    router.post(route('admin.testimonial.unpublishmultiple'), {
        ids: selectedTestimonials.value,
    }, 
    {
        onProgress: ()=>{
            inProgress.value= true;
            toggleModal();
        },
        onSuccess: ()=>{
            inProgress.value = false;
            selectedTestimonials.value = [];
            show.value=false;
        },
    })
}


const featureSelectedTestimonials = ()=>{

    inProgress.value= true;
    show.value = true;

    router.post(route('admin.testimonial.featuremultiple'), {
        ids: selectedTestimonials.value,
    }, 
    {
        onProgress: ()=>{
            inProgress.value= true;
            toggleModal();
        },
        onSuccess: ()=>{
            inProgress.value = false;
            selectedTestimonials.value = [];
            show.value=false;
        },
    })
}


const unFeatureSelectedTestimonials = ()=>{

    inProgress.value= true;
    show.value = true;

    router.post(route('admin.testimonial.unfeaturemultiple'), {
        ids: selectedTestimonials.value,
    }, 
    {
        onProgress: ()=>{
            inProgress.value= true;
            toggleModal();
        },
        onSuccess: ()=>{
            inProgress.value = false;
            selectedTestimonials.value = [];
            show.value=false;
        },
    })
}


</script>


<template>
    <DashboardLayout>

        
        <div class="">
    
            <div class="flex justify-between items-center mb-2">
                <AddTestimonial />
                <div v-if="selectedTestimonials.length" class="flex gap-1 justify-end items-center">
                    <p class="text-sm font-bold uppercase text-primary">With Selected</p>
                    <Dropdown align="right" width="36">
                        <template #trigger>
                            <button type="button" class="h-6 w-6 rounded-md bg-slate-200 text-primary cursor-pointer hover:bg-slate-300 flex items-center justify-center">
                                <font-awesome-icon icon="fa-ellipsis-h"></font-awesome-icon>
                            </button>
                        </template>

                        <template #content>  
                            <button @click="deleteSelectedTestimonials" :class="dropdownClasses">Delete</button>
                            <button @click="publishSelectedTestimonials" :class="dropdownClasses">Publish</button>
                            <button @click="unPublishSelectedTestimonials" :class="dropdownClasses">Un-Publish</button>
                            <button @click="featureSelectedTestimonials" :class="dropdownClasses">Feature</button>
                            <button @click="unFeatureSelectedTestimonials" :class="dropdownClasses">Un-Feature</button>
                            <AssignCategoryButton :categories="$props.categories" :ids="selectedTestimonials"/>
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
                            Name  
                        </th>
                        <th scope="col" class="px-2 py-2 text-left">
                            Testimony 
                        </th>
                        <th scope="col" class="px-2 py-2 text-left">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(testimonial, index) in testimonials.data" :key="index" class="bg-white border-b transition duration-300 ease-in-out hover:bg-gray-100">

                        <td class="px-2">
                            <input 
                                type="checkbox" 
                                :id="testimonial.id" 
                                :value="testimonial.id" 
                                v-model="selectedTestimonials"
                                class="rounded"
                                >
                        </td>
                  
                        <td class="text-gray-900 font-light px-2 py-4">
                            <div class="h-16 w-24 overflow-hidden rounded-md">
                                <img :src="testimonial.image" class="object-cover h-full w-full" >
                            </div>
                        </td>
                        <td class="text-gray-900 font-light px-2 py-4 w-[20%]">
                            <span :class="[testimonial.isFeatured ? 'text-primary font-bold' : '']">{{testimonial.title}} {{testimonial.name}}</span>
                            <span v-if="testimonial.isFeatured " class="h-5 w-5 rounded-full flex items-center justify-center bg-sky-500 text-white font-bold text-xs">F</span>
                        </td>
                        <td class="text-gray-900 font-light px-2 py-4 ">
                            <p v-if="testimonial.testimony" v-html="testimonial.testimony.slice(0, 240)+'...'" class="mb-2"></p>
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
                                        :model="testimonial"
                                        :publishable_type="`\\App\\Models\\Testimonial`" 
                                        :publishable_id="testimonial.id" 
                                        />
                                        <FeatureButton 
                                            v-if="testimonial.isPublished"
                                            :model="testimonial"
                                            :featurable_type="`\\App\\Models\\Testimonial`" 
                                            :featurable_id="testimonial.id" 
                                            />          
                                        <Edit :testimonial="testimonial" />
                                        <Delete :testimonial="testimonial" />
                                        
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