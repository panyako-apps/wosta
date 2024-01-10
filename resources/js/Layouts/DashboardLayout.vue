<script setup>
import { ref } from 'vue';

import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import { Link} from '@inertiajs/vue3';

const showingNavigationDropdown = ref(false);

const activeElementsClass = 'flex gap-3 items-center px-4 py-1.5 text-sm bg-slate-200 text-primary mb-1';
const nonActiveElementsClass = 'flex gap-3 cursor-pointer rounded border border-transparent bg-primary px-4 py-1.5 mb-1 text-sm  text-white hover:pl-6 hover:bg-slate-200 hover:text-primary transition-all duration-200';
    
const sbwidth = 'w-1/6'
</script>

<template>

    <div class="min-h-screen bg-gray-100">
        <!-- <nav class="bg-indigo-500 border-b border-indigo-100 shadow-lg"> -->
        <nav class="bg-gray-900 sticky top-0 z-50">
            <!-- Primary Navigation Menu -->
            <div class="container mx-auto px-4 md:px-0">
                <div class="flex justify-between h-16">
                    <div class="flex">
                        <!-- Logo -->
                        <div class="shrink-0 flex items-center text-white">
                         Dashboard
                        </div>

                        <!-- Navigation Links -->
                        <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                            <NavLink :href="route('page.welcome')" :active="route().current('page.welcome')" class="text-sm">
                                Preview Site
                            </NavLink>
                        </div>
                    </div>

                    <div class="hidden sm:flex sm:items-center sm:ml-6">
                        <!-- Settings Dropdown -->
                        
                        <div class="ml-3 relative" v-if="$page.props.auth.user">
                            <Dropdown align="right" width="48">
                                <template #trigger>
                                    <span class="inline-flex rounded-md">
                                        <button type="button" class="inline-flex items-center px-1 pt-1 text-sm leading-5 text-gray-100 font-bold hover:text-gray-200 hover:border-gray-100 focus:outline-none focus:text-gray-200 focus:border-gray-200 transition duration-150 ease-in-out">
                                            {{ $page.props.auth.user.name }}

                                            <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                    </span>
                                </template>

                                <template #content>
                                    <DropdownLink :href="route('logout')" method="post" as="button">
                                        Log Out
                                    </DropdownLink>
                                </template>
                            </Dropdown>
                        </div>
                        <span v-else class="inline-flex rounded-md gap-5">
                            <NavLink :href="route('login')" >
                                Login 
                            </NavLink>
                        </span>
                    </div>

                    <!-- Hamburger -->
                    <div class="-mr-2 flex items-center sm:hidden">
                        <button @click="showingNavigationDropdown = ! showingNavigationDropdown" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                            <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                <path :class="{'hidden': showingNavigationDropdown, 'inline-flex': ! showingNavigationDropdown }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                <path :class="{'hidden': ! showingNavigationDropdown, 'inline-flex': showingNavigationDropdown }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Responsive Navigation Menu -->
            <div :class="{'block': showingNavigationDropdown, 'hidden': ! showingNavigationDropdown}" class="sm:hidden">
                <div class="">
                    <ResponsiveNavLink :href="route('page.welcome')" :active="route().current('page.welcome')">
                        Home
                    </ResponsiveNavLink>
                    <ResponsiveNavLink :href="route('admin.index')" :active="route().current('admin.index')" v-if="$page.props.auth.user">
                        Dashboard
                    </ResponsiveNavLink>
                </div>
            </div>
        </nav>


        <!-- Page Content -->
        <main class="z-40">
            <div  class="container mx-auto px-4 pt-6 md:px-0 min-h-screen grid grid-cols-[1fr_4fr_1fr] gap-4">
                <div class="">
                    <div class="sticky top-20">
                        <div class="flex justify-between items-center bg-slate-200 rounded px-4 py-2 mb-4">
                            <ApplicationLogo :show-title="false" />
                        </div>
    
                        <div class="flex flex-col justify-between md:min-h-[80vh]">
                            <ul class="bg-slate-200 p-4 rounded-md ">
                                <li class="cursor-pointer" 
                                    :class="[route().current('admin.index') ? activeElementsClass : nonActiveElementsClass]">
                                    <Link class="w-full block" :href="route('admin.index')">Overview</Link>
                                </li>

                                <li class="cursor-pointer" 
                                    :class="[
                                        route().current('admin.sitesettings.index')
                                        ? activeElementsClass : nonActiveElementsClass]"
                                        >
                                    <Link class="w-full block" :href="route('admin.sitesettings.index')">About Us</Link>
                                </li>
                                <li class="cursor-pointer" 
                                    :class="[
                                        route().current('admin.pages.index')
                                        ? activeElementsClass : nonActiveElementsClass]"
                                        >
                                    <Link class="w-full block" :href="route('admin.pages.index')">Pages</Link>
                                </li>
                                <li class="cursor-pointer" 
                                    :class="[
                                        route().current('admin.slideshows.index')
                                        ? activeElementsClass : nonActiveElementsClass]"
                                        >
                                    <Link class="w-full block" :href="route('admin.slideshows.index')">Slideshows</Link>
                                </li>
                                <li class="cursor-pointer" 
                                    :class="[
                                        route().current('admin.services.index')
                                        ||route().current('admin.servicecategories.index') 
                                        ||route().current('admin.service.manage') 
                                        ? activeElementsClass : nonActiveElementsClass]"
                                        >
                                    <Link class="w-full block" :href="route('admin.services.index')">Our Services</Link>
                                </li>
                                
                                <li class="cursor-pointer" 
                                    :class="[
                                        route().current('admin.posts.index') 
                                        ||route().current('admin.post.manage')
                                        ? activeElementsClass : nonActiveElementsClass]
                                        ">
                                    <Link class="w-full block" :href="route('admin.posts.index')">Blog Posts</Link>
                                </li>

                                <li class="cursor-pointer" 
                                    :class="[
                                        route().current('admin.messages.index') 
                                        ? activeElementsClass : nonActiveElementsClass
                                        ]">
                                    <Link class="w-full block" :href="route('admin.messages.index')">Client Messages</Link>
                                </li>

                                <li class="cursor-pointer" 
                                    :class="[
                                        route().current('admin.testimonials.index') 
                                        ? activeElementsClass : nonActiveElementsClass
                                        ]">
                                    <Link class="w-full block" :href="route('admin.testimonials.index')">Testimonials</Link>
                                </li>


                                <li class="cursor-pointer" :class="[
                                    route().current('admin.staffs.index')
                                     ? activeElementsClass : nonActiveElementsClass]">
                                    <Link class="w-full block" :href="route('admin.staffs.index')">Staff Members</Link>
                                </li>
                            
                                <li class="cursor-pointer" :class="[
                                    route().current('admin.users.index')
                                        ? activeElementsClass : nonActiveElementsClass]">
                                    <Link class="w-full block" :href="route('admin.users.index')">System Users</Link>
                                </li>

                            </ul>
                            
                            <div class="bg-slate-200 rounded px-4 py-1">
                                <Link :href="route('logout')" class="text-primary font-bold">Logout</Link>
                            </div>
    
                        </div>
                    </div>
                </div>
                <div class="grow pt-">
                    <slot />
                </div>
                <div class="">
                    <div class="bg-slate-200 p-3 rounded sticky top-20">
                        <h3 class="text-slate-600 font-bold"><font-awesome-icon icon="fa-bell"></font-awesome-icon> Notifications</h3>
                    </div>
                    <div class="mt-2">
                        <slot name="raside"/>
                    </div>
                </div>
            </div>
        </main>

    </div>
</template>
