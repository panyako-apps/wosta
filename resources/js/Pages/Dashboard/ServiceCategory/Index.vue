<script setup>
import DashboardLayout from '@/Layouts/DashboardLayout.vue';
import Create from './Create.vue'
import { Link} from '@inertiajs/vue3';
import Edit from './Edit.vue'
import Delete from './Delete.vue'
import Dropdown from '@/Components/Dropdown.vue'
import PublishButton from '@/Components/buttons/PublishButton.vue';
import FeatureButton from '@/Components/buttons/FeatureButton.vue';

defineProps({
    categories: {
        type: [Object, Array], 
        required: true,
    }
})
const primaryLinkClasses = 'px-3 py-1 text-slate-600 hover:bg-primary hover:text-white rounded hover:shadow-md transition-all duration-200 mb-1 w-full block text-left';
const activeTabClasses = 'border-b border-primary px-3 py-2 text-sm text-primary';
const tabClasses = 'border-b-4 border-transparent px-3 py-2 text-sm text-primary';

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
                <h2 class="uppercase">Service Categories</h2>
                <Create 
                    :categories="categories.data" 
                    />
            </div>
    
    
            <table class="min-w-full text-sm">
                <thead class="bg-slate-200 text-slate-500">
                    <tr>
                        <th scope="col" class="px-2 py-2 text-left">
                            #
                        </th>
                        <th scope="col" class="px-2 py-2 text-left">
                            Icon Image 
                        </th>
                        <th scope="col" class="px-2 py-2 text-left">
                            Name 
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
                    <tr v-for="(category, index) in categories.data" :key="category.id" class="bg-white border-b transition duration-300 ease-in-out hover:bg-slate-100">
                        <td class="px-6 py-4 font-medium text-slate-900">{{index + 1}}</td>
                        <td class="text-slate-900 font-light px-2 py-4">
                            <div class="h-16 w-24 overflow-hidden rounded-md">
                                <img :src="category.image" class="object-cover h-full w-full" >
                            </div>
                        </td>
                        <td class="text-slate-900 font-light px-2 py-4">
                            <span :class="[category.isFeatured === 1 ? 'text-primary font-bold' : '']">{{category.name}}</span>
                            <span v-if="category.isFeatured === 1 " class="h-5 w-5 rounded-full flex items-center justify-center bg-sky-500 text-white font-bold text-xs">F</span>
                        </td>
                        <td class="text-slate-900 font-light px-2 py-4">
                            <p v-html="category.description"></p>
                        </td>
                
                        <td class="text-slate-900 font-light px-2 py-4">
                            <div class="flex justify-end gap-1 items-center pr-5">
                                <Dropdown align="right" width="36">
                                    <template #trigger>
                                        <button type="button" class="h-6 w-6 rounded-full bg-slate-200 text-slate-500 cursor-pointer hover:bg-slate-300 flex items-center justify-center">
                                            <font-awesome-icon icon="fa-ellipsis-h"></font-awesome-icon>
                                        </button>
                                    </template>
    
                                    <template #content>
                                        <PublishButton 
                                            :model="category"
                                            :publishable_type="`\\App\\Models\\ServiceCategory`" 
                                            :publishable_id="category.id" 
                                            />
                                        <FeatureButton 
                                            v-if="category.isPublished"
                                            :model="category"
                                            :featurable_type="`\\App\\Models\\ServiceCategory`" 
                                            :featurable_id="category.id" 
                                            />          
                                        <Edit :categories="categories.data" :category="category" />
                                        <Delete :category="category" />
                                    </template>
                                </Dropdown>
    
                            </div>
                        </td>
    
                    </tr>
                    
                </tbody>
            </table>
        </div>
    </DashboardLayout>
</template>