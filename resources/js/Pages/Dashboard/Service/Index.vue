<script setup>
import DashboardLayout from '@/Layouts/DashboardLayout.vue';
import AddService from './Create.vue'
import { Link, router} from '@inertiajs/vue3';
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
    services: {
        type: [Array, Object], 
        required: true,
    },
    categories: {
        type: [Array, Object], 
        required: true,
    }
})

const primaryLinkClasses = 'px-3 py-1 text-gray-600 hover:bg-primary hover:text-white rounded hover:shadow-md transition-all duration-200 mb-1 w-full block text-left';
const activeTabClasses = 'border-b border-primary px-3 py-2 text-sm text-primary';
const tabClasses = 'border-b-4 border-transparent px-3 py-2 text-sm text-primary';
const dropdownClasses = 'w-full text-left p-1 text-slate-700 hover:opacity-75 hover:text-sky-700 hover:pl-4 hover:border-l hover:border-sky-700 transitio duration-200 ease-in-out';


const selectedServices = ref([]);
const show = ref(false);
const inProgress = ref(false);

const toggleModal = ()=>{
    show.value = !show.value
}



const deleteSelectedServices = ()=>{

    inProgress.value= true;
    show.value = true;

    router.post(route('admin.service.destroymultiple'), {
        _method: 'delete',
        ids: selectedServices.value,
    }, 
    {
        onProgress: ()=>{
            inProgress.value= true;
            toggleModal();
        },
        onSuccess: ()=>{
            inProgress.value = false;
            selectedServices.value = [];
            show.value=false;
        },
    })
}


const publishSelectedServices = ()=>{

    inProgress.value= true;
    show.value = true;

    router.post(route('admin.service.publishmultiple'), {
        ids: selectedServices.value,
    }, 
    {
        onProgress: ()=>{
            inProgress.value= true;
            toggleModal();
        },
        onSuccess: ()=>{
            inProgress.value = false;
            selectedServices.value = [];
            show.value=false;
        },
    })
}



const unPublishSelectedServices = ()=>{

    inProgress.value= true;
    show.value = true;

    router.post(route('admin.service.unpublishmultiple'), {
        ids: selectedServices.value,
    }, 
    {
        onProgress: ()=>{
            inProgress.value= true;
            toggleModal();
        },
        onSuccess: ()=>{
            inProgress.value = false;
            selectedServices.value = [];
            show.value=false;
        },
    })
}


const featureSelectedServices = ()=>{

    inProgress.value= true;
    show.value = true;

    router.post(route('admin.service.featuremultiple'), {
        ids: selectedServices.value,
    }, 
    {
        onProgress: ()=>{
            inProgress.value= true;
            toggleModal();
        },
        onSuccess: ()=>{
            inProgress.value = false;
            selectedServices.value = [];
            show.value=false;
        },
    })
}


const unFeatureSelectedServices = ()=>{

    inProgress.value= true;
    show.value = true;

    router.post(route('admin.service.unfeaturemultiple'), {
        ids: selectedServices.value,
    }, 
    {
        onProgress: ()=>{
            inProgress.value= true;
            toggleModal();
        },
        onSuccess: ()=>{
            inProgress.value = false;
            selectedServices.value = [];
            show.value=false;
        },
    })
}




const formatPrice = (price)=>{
    return parseFloat(price).toLocaleString('en-US', {
        minimumFractionDigits: 2,
        maximumFractionDigits: 2,
        });
}
</script>


<template>
    <DashboardLayout>

        <div class="flex gap-2 mb-3">
            <Link 
                :href="route('admin.services.index')"
                :class="[route().current('admin.services.index') ? activeTabClasses : tabClasses]"
                >Our Services
            </Link>

            <Link 
                :href="route('admin.servicecategories.index')"
                :class="[route().current('admin.servicecategories.index') ? activeTabClasses : tabClasses]"
                >Service Categories
            </Link>
        </div>
        
        <div class="">
    
            <div class="flex justify-between items-center mb-2">
                <AddService 
                    :categories="categories.data" 
                    />
                <div v-if="selectedServices.length" class="flex gap-1 justify-end items-center">
                    <p class="text-sm font-bold uppercase text-primary">With Selected</p>
                    <Dropdown align="right" width="36">
                        <template #trigger>
                            <button type="button" class="h-6 w-6 rounded-md bg-slate-200 text-primary cursor-pointer hover:bg-slate-300 flex items-center justify-center">
                                <font-awesome-icon icon="fa-ellipsis-h"></font-awesome-icon>
                            </button>
                        </template>

                        <template #content>  
                            <button @click="deleteSelectedServices" :class="dropdownClasses">Delete</button>
                            <button @click="publishSelectedServices" :class="dropdownClasses">Publish</button>
                            <button @click="unPublishSelectedServices" :class="dropdownClasses">Un-Publish</button>
                            <button @click="featureSelectedServices" :class="dropdownClasses">Feature</button>
                            <button @click="unFeatureSelectedServices" :class="dropdownClasses">Un-Feature</button>
                            <AssignCategoryButton :categories="$props.categories" :ids="selectedServices"/>
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
                    <tr v-for="(service, index) in services.data" :key="index" class="bg-white border-b transition duration-300 ease-in-out hover:bg-gray-100">

                        <td class="px-2">
                            <input 
                                type="checkbox" 
                                :id="service.id" 
                                :value="service.id" 
                                v-model="selectedServices"
                                class="rounded"
                                >
                        </td>
                  
                        <td class="text-gray-900 font-light px-2 py-4">
                            <div class="h-16 w-24 overflow-hidden rounded-md">
                                <img :src="service.image" class="object-cover h-full w-full" >
                            </div>
                        </td>
                        <td class="text-gray-900 font-light px-2 py-4 w-[20%]">
                            <span :class="[service.isFeatured ? 'text-primary font-bold' : '']">{{service.name}}</span>
                            <span v-if="service.isFeatured " class="h-5 w-5 rounded-full flex items-center justify-center bg-sky-500 text-white font-bold text-xs">F</span>
                        </td>
                        <td class="text-gray-900 font-light px-2 py-4 ">
                            <p v-html="service.description.slice(0, 240)+'...'" class="mb-2"></p>
                            <p class="text-xs">
                                <span class="text-slate-700">Category : </span>
                                <!-- <span class="text-primary bg-slate-200 px-4 py-1 rounded-md">{{ service.category.name }}</span> -->
                            </p>
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
                                            :model="service"
                                            :publishable_type="`\\App\\Models\\Service`" 
                                            :publishable_id="service.id" 
                                            />
                                        <FeatureButton 
                                            v-if="service.isPublished"
                                            :model="service"
                                            :featurable_type="`\\App\\Models\\Service`" 
                                            :featurable_id="service.id" 
                                            />          
                                        <Edit :categories="categories.data" :service="service" />
                                        <Delete :service="service" />
                                        <!-- <Link :href="route('admin.service.manage', service.slug)" :class="primaryLinkClasses">
                                            <font-awesome-icon icon="fa-cloud-meatball"></font-awesome-icon>
                                            Manage
                                        </Link>  -->
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