<script setup>
import DashboardLayout from '@/Layouts/DashboardLayout.vue';
import { Head, Link} from '@inertiajs/vue3';
import ListItem from '@/Components/ListItem.vue'


const props = defineProps({
    users: Array,
});

</script>

<template>
<Head title="Users Management" />

<DashboardLayout>
    <table class="min-w-full text-sm">
        <thead class="bg-gray-200 text-gray-500">
            <tr>
                <th scope="col" class="px-2 py-2 text-left">
                    #
                </th>
                <th scope="col" class="px-2 py-2 text-left">
                    
                </th>
                <th scope="col" class="px-2 py-2 text-left">
                    Name 
                </th>
                <th scope="col" class="px-2 py-2 text-left">
                    Email
                </th>
                <th scope="col" class="px-2 py-2 text-left">
                    Roles
                </th>
                <th scope="col" class="px-2 py-2 text-left">
                    Status
                </th>

                <th scope="col" class="px-2 py-2 text-left">
                    Actions
                </th>
            </tr>
        </thead>
        <tbody>

            <tr v-for="(user, index) in props.users.data" :key="user.id+index" class="bg-white border-b transition duration-300 ease-in-out hover:bg-gray-100">
                <td class="px-6 py-4 font-medium text-gray-900">{{index + 1}}</td>
                <td class="">
                    <div class="h-10 w-16 overflow-hidden rounded">
                        <img v-if="user.profile.avatar" :src="user.profile.avatar" class="object-cover h-full w-full" >
                        <img v-else :src="user.profile.profileimage" class="object-cover h-full w-full" >
                    </div>
                </td>
                <td class="text-gray-900 font-light px-2 py-4">
                    {{user.name}}
                </td>
                <td class="text-gray-900 font-light px-2 py-4">
                    {{user.email}}
                </td>
                <td class="text-gray-900 font-light px-2 py-4">
                    <ListItem v-for="role in user.roles" :key="role" :text="role.name" />
                </td>
                <td class="text-gray-900 font-light px-2 py-4">
                    status
                </td>
        
                <td class="text-gray-900 font-light px-2 py-4">
                    <div class="flex gap-1 items-center">
                        <Link :href="'/'" class="rounded-md border border-transparent bg-primary px-4 py-1 text-xs text-white shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">Manage</Link>
                        <Link :href="'/'" class="rounded-md border border-transparent bg-primary p-1 text-xs text-white shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                            </svg>
                        </Link>
                    </div>
                </td>
            </tr>
            
        </tbody>
    </table>
</DashboardLayout>

</template>
