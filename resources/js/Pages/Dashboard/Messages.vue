<script setup>
import DashboardLayout from '@/Layouts/DashboardLayout.vue';

defineProps({
    messages: {
        type: [Object, Array], 
        required: true,
    },
})


</script>


<template>
    <DashboardLayout>      
        <div class="">
    
            <div class="flex justify-between items-center mb-2">
                <h2 class="uppercase">Contact Messages</h2>
            </div>
    
            <table class="min-w-full text-sm">
                <thead class="bg-gray-200 text-gray-500">
                    <tr>
                        <th scope="col" class="px-2 py-2 text-left">
                            #
                        </th>
                        <th scope="col" class="px-2 py-2 text-left">
                            Information
                        </th>
                        <th scope="col" class="px-2 py-2 text-left">
                            Service 
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
                    <tr v-for="(message, index) in messages.data" :key="message.id" class="bg-white border-b transition duration-300 ease-in-out hover:bg-gray-100">
                        <td class="px-3 py-4 font-medium text-gray-900">{{index + 1}}</td>
                        <td class="text-gray-900 font-light px-2 py-4 w-36">
                            <span v-if="message.name" class="uppercase">{{ message.name}}</span>
                        </td>
                        <td class="text-gray-900 font-light px-2 py-4 ">
                            <h4 class="font-bold">{{ message.subject }}</h4>
                            <p v-if="message.message" v-html="message.message"></p>
                        </td>
                        <td class="text-gray-900 font-light px-2 py-4 w-48">
                            <span v-if="message.phone">{{ message.phone }}</span>
                        </td>
                        <td class="text-gray-900 font-light px-2 py-4 w-48">
                            <span v-if="message.email">{{ message.email }}</span>
                        </td>
                    </tr>
                    
                </tbody>
            </table>
        </div>
    </DashboardLayout>
</template>