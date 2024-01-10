<script setup>
import DashboardLayout from '@/Layouts/DashboardLayout.vue';
import { Link, router} from '@inertiajs/vue3';
import AddStaff from './Create.vue'
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
    staffMembers: {
        type: [Array, Object], 
        required: true,
    }
})

const primaryLinkClasses = 'px-3 py-1 text-gray-600 hover:bg-primary hover:text-white rounded hover:shadow-md transition-all duration-200 mb-1 w-full block text-left';
const activeTabClasses = 'border-b border-primary px-3 py-2 text-sm text-primary';
const tabClasses = 'border-b-4 border-transparent px-3 py-2 text-sm text-primary';
const dropdownClasses = 'w-full text-left p-1 text-slate-700 hover:opacity-75 hover:text-sky-700 hover:pl-4 hover:border-l hover:border-sky-700 transitio duration-200 ease-in-out';


const selectedStaffMembers = ref([]);
const show = ref(false);
const inProgress = ref(false);

const toggleModal = ()=>{
    show.value = !show.value
}



const deleteSelectedStaffMembers = ()=>{

    inProgress.value= true;
    show.value = true;

    router.post(route('admin.staff.destroymultiple'), {
        _method: 'delete',
        ids: selectedStaffMembers.value,
    }, 
    {
        onProgress: ()=>{
            inProgress.value= true;
            toggleModal();
        },
        onSuccess: ()=>{
            inProgress.value = false;
            selectedStaffMembers.value = [];
            show.value=false;
        },
    })
}


const publishSelectedStaffMembers = ()=>{

    inProgress.value= true;
    show.value = true;

    router.post(route('admin.staff.publishmultiple'), {
        ids: selectedStaffMembers.value,
    }, 
    {
        onProgress: ()=>{
            inProgress.value= true;
            toggleModal();
        },
        onSuccess: ()=>{
            inProgress.value = false;
            selectedStaffMembers.value = [];
            show.value=false;
        },
    })
}



const unPublishSelectedStaffMembers = ()=>{

    inProgress.value= true;
    show.value = true;

    router.post(route('admin.staff.unpublishmultiple'), {
        ids: selectedStaffMembers.value,
    }, 
    {
        onProgress: ()=>{
            inProgress.value= true;
            toggleModal();
        },
        onSuccess: ()=>{
            inProgress.value = false;
            selectedStaffMembers.value = [];
            show.value=false;
        },
    })
}


const featureSelectedStaffMembers = ()=>{

    inProgress.value= true;
    show.value = true;

    router.post(route('admin.staff.featuremultiple'), {
        ids: selectedStaffMembers.value,
    }, 
    {
        onProgress: ()=>{
            inProgress.value= true;
            toggleModal();
        },
        onSuccess: ()=>{
            inProgress.value = false;
            selectedStaffMembers.value = [];
            show.value=false;
        },
    })
}


const unFeatureSelectedStaffMembers = ()=>{

    inProgress.value= true;
    show.value = true;

    router.post(route('admin.staff.unfeaturemultiple'), {
        ids: selectedStaffMembers.value,
    }, 
    {
        onProgress: ()=>{
            inProgress.value= true;
            toggleModal();
        },
        onSuccess: ()=>{
            inProgress.value = false;
            selectedStaffMembers.value = [];
            show.value=false;
        },
    })
}


</script>


<template>
    <DashboardLayout>

        
        <div class="">
    
            <div class="flex justify-between items-center mb-2">
                <AddStaff />
                <div v-if="selectedStaffMembers.length" class="flex gap-1 justify-end items-center">
                    <p class="text-sm font-bold uppercase text-primary">With Selected</p>
                    <Dropdown align="right" width="36">
                        <template #trigger>
                            <button type="button" class="h-6 w-6 rounded-md bg-slate-200 text-primary cursor-pointer hover:bg-slate-300 flex items-center justify-center">
                                <font-awesome-icon icon="fa-ellipsis-h"></font-awesome-icon>
                            </button>
                        </template>

                        <template #content>  
                            <button @click="deleteSelectedStaffMembers" :class="dropdownClasses">Delete</button>
                            <button @click="publishSelectedStaffMembers" :class="dropdownClasses">Publish</button>
                            <button @click="unPublishSelectedStaffMembers" :class="dropdownClasses">Un-Publish</button>
                            <button @click="featureSelectedStaffMembers" :class="dropdownClasses">Feature</button>
                            <button @click="unFeatureSelectedStaffMembers" :class="dropdownClasses">Un-Feature</button>
                            <AssignCategoryButton :categories="$props.categories" :ids="selectedStaffMembers"/>
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
                            About 
                        </th>
                        <th scope="col" class="px-2 py-2 text-left">
                            Email 
                        </th>
                        <th scope="col" class="px-2 py-2 text-left">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(staff, index) in staffMembers.data" :key="index" class="bg-white border-b transition duration-300 ease-in-out hover:bg-gray-100">

                        <td class="px-2">
                            <input 
                                type="checkbox" 
                                :id="staff.id" 
                                :value="staff.id" 
                                v-model="selectedStaffMembers"
                                class="rounded"
                                >
                        </td>
                  
                        <td class="text-gray-900 font-light px-2 py-4">
                            <div class="h-16 w-24 overflow-hidden rounded-md">
                                <img :src="staff.image" class="object-cover h-full w-full" >
                            </div>
                        </td>
                        <td class="text-gray-900 font-light px-2 py-4 w-[20%]">
                            <span :class="[staff.isFeatured ? 'text-primary font-bold' : '']">{{staff.title}} {{staff.name}}</span>
                            <span v-if="staff.isFeatured " class="h-5 w-5 rounded-full flex items-center justify-center bg-sky-500 text-white font-bold text-xs">F</span>
                        </td>
                        <td class="text-gray-900 font-light px-2 py-4 ">
                            <p v-if="staff.description" v-html="staff.description.slice(0, 240)+'...'" class="mb-2"></p>
                        </td>
                        <td class="text-gray-900 font-light px-2 py-4 ">
                            {{staff.email}}
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
                                        :model="staff"
                                        :publishable_type="`\\App\\Models\\Staff`" 
                                        :publishable_id="staff.id" 
                                        />
                                        <FeatureButton 
                                            v-if="staff.isPublished"
                                            :model="staff"
                                            :featurable_type="`\\App\\Models\\Staff`" 
                                            :featurable_id="staff.id" 
                                            />          
                                        <Edit :staff="staff" />
                                        <Delete :staff="staff" />
                                        
                                        <Link :href="route('admin.staff.manage', staff.slug)" :class="primaryLinkClasses">
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