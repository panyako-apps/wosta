<script setup>
import DashboardLayout from '@/Layouts/DashboardLayout.vue';
import { Head} from '@inertiajs/vue3';
import Create from './Create.vue';
import EditSection from './Section/Edit.vue'

import { Link} from '@inertiajs/vue3';
import Delete from './Delete.vue'
import Dropdown from '@/Components/Dropdown.vue'
import PublishButton from '@/Components/buttons/PublishButton.vue';
import FeatureButton from '@/Components/buttons/FeatureButton.vue';
import { ref } from 'vue';
import ListItem from '@/Components/ListItem.vue'

const props = defineProps({
    pages: {
        type: [Object, Array], 
        default: []
    }, 
});

const primaryLinkClasses = 'px-3 py-1 text-gray-600 hover:bg-blue-600 hover:text-white rounded hover:shadow-md transition-all duration-200 mb-1 w-full block text-left';

const activePageIndex = ref(0)

</script>

<template>
<Head title="Application Pages" />

<DashboardLayout>
    <div class="">
        <div class="flex justify-between items-center mb-2">
            <h2 class="font-bold text-primary">Application Pages</h2>
            <Create  />
        </div>

        <div class="flex gap-2">
            <button v-for="(page, index) in pages.data" :key="index" @click="activePageIndex=index"
                :class="[activePageIndex === index ? 'bg-primary text-white' : 'bg-slate-200 text-slate-800']"
                class="capitalize  rounded-full px-4 py-1.5"
                >
                {{page.name}}
            </button>
        </div>

        <div class="">
            <div v-for="(page, index) in pages.data" :key="index" 
                :class="[activePageIndex === index ? 'block' : 'hidden']"
                class="py-6"
            >
                <div v-for="section in page.sections" :key="section" class="bg-slate-200 p-4 mb-6">
                    <div class="flex justify-between gap-6">
                        <div class="bg-primary w-16 shrink-0 flex items-center">
                            <div class="-rotate-90 text-white font-bold text-center">{{section.name}}</div>
                        </div>
                        <div class="grow">
                            <h2 class="mb-2"><span class="font-bold">Title:</span> <span v-html="section.title"></span></h2>
                            <h2 class="mb-2"><span class="font-bold">Intro:</span> <span v-html="section.intro"></span></h2>
                            <p class="mb-2"><span class="font-bold">Description:</span> <span v-html="section.description"></span></p>
                            <div>
                                <ListItem v-for="point in section.points" :key="point" :text="point" />
                            </div>
                        </div>
                        <div class="">
                            <Dropdown align="right" width="36">
                                <template #trigger>
                                    <button type="button" class="h-6 w-6 rounded-full bg-primary text-white cursor-pointer hover:bg-slate-400 flex items-center justify-center transition-all duration-500 ease-linear">
                                        <font-awesome-icon icon="fa-ellipsis-h"></font-awesome-icon>
                                    </button>
                                </template>
        
                                <template #content>  
                                    <EditSection :section="section" :pageId="page.id"/>
                                </template>
                            </Dropdown>
                        </div>
                    </div>
                </div>
            
            </div>
        </div>


    </div>
</DashboardLayout>

</template>
