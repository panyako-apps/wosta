<script setup>
import DashboardLayout from '@/Layouts/DashboardLayout.vue';

defineProps({
    quotations: {
        type: [Object, Array], 
        required: true,
    },
})


</script>


<template>
    <DashboardLayout>

        
        <div class="">
    
            <div class="flex justify-between items-center mb-2">
                <h2 class="uppercase">Quotation Requests</h2>
            </div>
    
            <table class="min-w-full text-sm">
                <thead class="bg-gray-200 text-gray-500">
                    <tr>
                        <th scope="col" class="px-2 py-2 text-left">
                            #
                        </th>
                        <th scope="col" class="px-2 py-2 text-left">
                            Service 
                        </th>
                        <th scope="col" class="px-2 py-2 text-left">
                            Information
                        </th>
                        <th scope="col" class="px-2 py-2 text-left">
                            Phone No 
                        </th>
                        <th scope="col" class="px-2 py-2 text-left">
                            Email 
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(quotation, index) in quotations.data" :key="quotation.id" class="bg-white border-b transition duration-300 ease-in-out hover:bg-gray-100">
                        <td class="px-3 py-4 font-medium text-gray-900">{{index + 1}}</td>
                        <td class="text-gray-900 font-light px-2 py-4 w-48">
                            <span v-if="quotation.product">{{ quotation.product.name}}</span>
                        </td>
                        <td class="text-gray-900 font-light px-2 py-4 ">
                            <span v-if="quotation.message" v-html="quotation.message"></span>
                        </td>
                        <td class="text-gray-900 font-light px-2 py-4 w-48">
                            <span v-if="quotation.phone">{{ quotation.phone }}</span>
                        </td>
                        <td class="text-gray-900 font-light px-2 py-4 w-48">
                            <span v-if="quotation.email">{{ quotation.email }}</span>
                        </td>
                        <td class="text-gray-900 font-light px-2 py-4 w-48">
                            <div v-if="quotation.file" class="h-12 ">
                                <img :src="quotation.file" alt="" class="h-full">
                                {{ quotation.file }}
                            </div>
                        </td>
                    </tr>
                    
                </tbody>
            </table>
        </div>
    </DashboardLayout>
</template>