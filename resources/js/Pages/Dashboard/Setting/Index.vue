<script setup>
import DashboardLayout from '@/Layouts/DashboardLayout.vue';
import { Head, Link} from '@inertiajs/vue3';
import { computed } from 'vue';
import EditSiteSetting from './EditSiteSetting.vue'
import EditCoreValue from './EditCoreValue.vue'
import DeleteCoreValue from './DeleteCoreValue.vue'
import PublishButton from '@/Components/buttons/PublishButton.vue';
import Dropdown from '@/Components/Dropdown.vue'
import DropdownLink from '@/Components/DropdownLink.vue'

const props = defineProps({
    orders: [Object, Array],
    callbacks_today: [Object, Array],
    notifications: [Object, Array],
    userreviews: [Object, Array],
    sitesettings: [Object, Array],
    corevalues: [Object, Array],
});

const appname =  props.sitesettings.filter(item => item.custom_id == 'appname')[0];
const logo =  props.sitesettings.filter(item => item.custom_id == 'logo')[0];
const slogan =  props.sitesettings.filter(item => item.custom_id == 'slogan')[0];
const mission =  props.sitesettings.filter(item => item.custom_id == 'mission')[0];
const vision =  props.sitesettings.filter(item => item.custom_id == 'vision')[0];

const dropDownLinkClass="block w-full px-4 py-2 text-left text-sm leading-5 text-slate-700 hover:text-secondary dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800 focus:outline-none focus:bg-slate-100 dark:focus:bg-slate-800 transition duration-150 ease-in-out"

</script>

<template>
<Head title="Dashboard" />

<DashboardLayout>
    <div class="h-screen bg-slate-200 p-6">
        <div class="mb-6">
            <h2 class="font-bold text-primary">About Us</h2>
        </div>
        <div class="grid grid-cols-2 gap-6 mb-6">
            <div v-if="props.sitesettings&&appname " class="md:p-4 flex justify-between gap-2 bg-white rounded-md">
                <div class="">
                    <h2 class="text-sm">{{ appname.title }} : </h2>
                    <h2 v-html="appname.description" class="font-bold text-primary  text-xl md:text-2xl"></h2>
                </div>
        
                <div class="">
                    <Dropdown align="right" width="36">
                        <template #trigger>
                            <button type="button" class="h-6 w-6 rounded-full bg-slate-200 text-slate-500 cursor-pointer hover:bg-slate-300 flex items-center justify-center">
                                <font-awesome-icon icon="fa-ellipsis-h"></font-awesome-icon>
                            </button>
                        </template>
    
                        <template #content>
                            <div :class="dropDownLinkClass">
                                <EditSiteSetting :sitesetting="appname" />                    
                            </div>
                            <div :class="dropDownLinkClass">
                                <PublishButton 
                                    :model="appname"
                                    :publishable_type="`\\App\\Models\\SiteSetting`" 
                                    :publishable_id="appname.id" 
                                    />
                            </div>
                        </template>
                    </Dropdown>
                    
                </div>
            </div>
            <div v-if="props.sitesettings&&slogan " class="md:p-4 flex justify-between gap-2 bg-white rounded-md">
                <div class="">
                    <h2 class="text-sm">{{ slogan.title }} : </h2>
                    <h2 v-html="slogan.description" class="font-bold text-primary  text-xl md:text-2xl"></h2>
                </div>
                <div class="">
    
                    <Dropdown align="right" width="36">
                        <template #trigger>
                            <button type="button" class="h-6 w-6 rounded-full bg-slate-200 text-slate-500 cursor-pointer hover:bg-slate-300 flex items-center justify-center">
                                <font-awesome-icon icon="fa-ellipsis-h"></font-awesome-icon>
                            </button>
                        </template>
    
                        <template #content>
                            <div :class="dropDownLinkClass">
                                <EditSiteSetting :sitesetting="slogan" />  
                            </div>
                            <div :class="dropDownLinkClass">
                                <PublishButton 
                                    :model="slogan"
                                    :publishable_type="`\\App\\Models\\SiteSetting`" 
                                    :publishable_id="slogan.id" 
                                    />                  
                            </div>
                        </template>
    
                    </Dropdown>
                </div>
            </div>
        </div>
        <div v-if="props.sitesettings&&mission" class="bg-white p-4 mb-6 rounded-xl" >
            <h3 class="font-bold text-2xl text-primary mb-4"><span class="border-b border-b-slate-600">{{ mission.title }}</span></h3>
            <p v-html="mission.description" class="text-sm"></p>
            <div class="flex justify-end">
                <Dropdown align="right" width="36">
                    <template #trigger>
                        <button type="button" class="h-6 w-6 rounded-full bg-slate-200 text-slate-500 cursor-pointer hover:bg-slate-300 flex items-center justify-center">
                            <font-awesome-icon icon="fa-ellipsis-h"></font-awesome-icon>
                        </button>
                    </template>
    
                    <template #content>
                        <div :class="dropDownLinkClass">
                            <EditSiteSetting :sitesetting="mission"/> 
                        </div>
                        <div :class="dropDownLinkClass">
                            <PublishButton 
                            :model="mission"
                            :publishable_type="`\\App\\Models\\SiteSetting`" 
                            :publishable_id="mission.id" 
                            /> 
                        </div>
                           
                    </template>
                </Dropdown>
            </div>                
    
        </div>
        <div v-if="props.sitesettings&&vision" class="bg-white p-4 mb-6 rounded-xl" >
            <h3 class="font-bold text-2xl text-primary mb-4"> <span class="border-b border-b-slate-600">{{ vision.title }}</span></h3>
            <p v-html="vision.description" class="text-sm"></p>
            <div class="flex justify-end ">
                <Dropdown align="right" width="36">
                    <template #trigger>
                        <button type="button" class="h-6 w-6 rounded-full bg-slate-200 text-slate-500 cursor-pointer hover:bg-slate-300 flex items-center justify-center">
                            <font-awesome-icon icon="fa-ellipsis-h"></font-awesome-icon>
                        </button>
                    </template>
    
                    <template #content>
                        <div :class="dropDownLinkClass">
                            <EditSiteSetting :sitesetting="vision"/>  
                        </div>
                        <div :class="dropDownLinkClass">
                            <PublishButton 
                                :model="vision"
                                :publishable_type="`\\App\\Models\\SiteSetting`" 
                                :publishable_id="vision.id" 
                                />                   
                        </div>
                    </template>
                </Dropdown>
            </div>                    
    
        </div>
        <div v-if="corevalues.length" class="bg-white p-4 mb-6 rounded-xl" >
            <h3 class="font-bold text-2xl text-primary mb-4"><span class="border-b border-b-slate-600"> CORE VALUES</span></h3>
            <ul class="grid grid-cols-2 gap-4"> 
                <li v-for="(value, index) in corevalues" :key="index" class="">
                    <div class="flex items-center gap-2 mb-3">
                        <div class="h-8 w-8 rounded-full flex items-center justify-center left-2 bg-slate-600 text-white font-bold shrink-0">{{ index+1 }}</div>
                        <h4 v-html="value.title" class="font-bold text-slate-700"></h4>
                        <small class="text-primary">{{ value.isPublished ? 'Published' : '' }}</small>
                    </div>
                    <p v-html="value.description" class="text-sm"></p>
                    <div class="flex justify-end ">
                        <Dropdown align="right" width="36">
                            <template #trigger>
                                <button type="button" class="h-6 w-6 rounded-full bg-slate-200 text-slate-500 cursor-pointer hover:bg-slate-300 flex items-center justify-center">
                                    <font-awesome-icon icon="fa-ellipsis-h"></font-awesome-icon>
                                </button>
                            </template>
    
                            <template #content>
                                <div :class="dropDownLinkClass">
                                    <EditCoreValue :corevalue="value"/>
                                </div>
                                <div :class="dropDownLinkClass">
                                    <DeleteCoreValue :corevalue="value"/>
                                </div>
                                <div :class="dropDownLinkClass">
                                    <PublishButton 
                                        :model="value"
                                        :publishable_type="`\\App\\Models\\CoreValue`" 
                                        :publishable_id="value.id" 
                                        />
                                </div>
                            </template>
                        </Dropdown>
    
                    </div>
                </li>
            </ul>
        </div>

    </div>
</DashboardLayout>

</template>
