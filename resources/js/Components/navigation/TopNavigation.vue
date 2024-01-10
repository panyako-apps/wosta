
<script setup>
import ApplicationLogo from '../ApplicationLogo.vue';
import NavLink from '@/Components/links/NavLink.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import { Link } from '@inertiajs/vue3';
import { useCartStore } from '@/Stores/cart';
import { ref } from 'vue';

const active = 'border-blue-400 text-blue-600 ';

const cart = useCartStore();

const isShowingMobileMenu = ref(false)

const toggleMobileMenu = () =>{
    isShowingMobileMenu.value = !isShowingMobileMenu.value
}

const mobileMenuItemClasses = 'block w-full bg-slate-100 p-3 mb-1  border-b text-slate-500  hover:bg-white hover:text-primary transition-all duration-200 ease-in-out flex items-center gap-4'
const activeMobileMenu = 'text-primary border-b-primary'

</script>

<template>
      <nav class="sticky top-0 z-50 bg-white shadow-md">
            <!-- Primary Navigation Menu -->
            <div class="max-w-[1920px] mx-auto xl:px-16 px-4">
                <div class="flex justify-between h-24">
                    <div class="flex">
                        <!-- Logo -->
                        <div class="shrink-0 flex items-center">
                            <a :href="route('page.welcome')">
                                <ApplicationLogo class="block h-9 w-auto" />
                            </a>
                        </div>
                    </div>
                    <!-- Navigation Links -->
                    <div class="hidden space-x-4 sm:-my-px sm:ml-10 md:flex lg:flex">
                        <NavLink :href="route('page.welcome')" :active="route().current('page.welcome')">
                            Home
                        </NavLink>
                        <NavLink :href="route('page.about')" :active="route().current('page.about')">
                            About Us
                        </NavLink>
                        <NavLink :href="route('services.index')" :active="route().current('services.index')">
                            Our Services
                        </NavLink>
                        <NavLink :href="route('posts.index')" :active="route().current('posts.index')">
                            Blog
                        </NavLink>
                        <NavLink :href="route('page.contactus')" :active="route().current('page.contactus')">
                            Contact Us
                        </NavLink>
                        <div class="flex items-center gap-1 h-12 my-auto">
                            <font-awesome-icon icon="fa-search" class="text-primary"></font-awesome-icon>
                            <input type="text" class="border-none focus:border-none focus:outline-none focus:ring-0 placeholder:text-primary font-bold w-36" placeholder="Search Here ...">
                        </div>
                        <Link :href="route('page.requestquote')" class="bg-secondary hover:bg-primary text-white font-bold px-5 py-2.5 rounded-full my-auto flex items-center transition-all duration-500 ease-linear">
                            Get Started
                        </Link>
                        <a :href="route('admin.index')" 
                            :active="route().current('admin.index')" 
                            v-if="$page.props.auth.isAdmin"
                            class="inline-flex items-center px-3 font-bold leading-5 text-primary hover:text-secondary hover:border-secondary focus:outline-none focus:text-gray-200 focus:border-gray-200 transition-all duration-350 ease-in-out"
                            >
                            Dashboard
                        </a>
                        <div class="flex gap-2 items-center sm:ml-6">
    
                            <!-- Settings Dropdown -->
        
                            <div class="relative" v-if="$page.props.auth.user">
                                <Dropdown align="right" width="48">
                                    <template #trigger>
                                        <div class="flex items gap-2">
                                            <span class="inline-flex rounded-md">
                                                <button type="button" class="inline-flex items-center justify-end text-primary hover:text-slate-700  focus:outline-none  focus:text-slate-700 transition duration-150 ease-in-out">
                                                    <!-- <span class="hidden md:inline-flex">
                                                        {{ $page.props.auth.user.name }}
                                                    </span> -->
        
                                                    <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                                    </svg>
                                                </button>
                                            </span>
                                            <div v-if="$page.props.auth.profile" class="h-10 w-10 rounded-full overflow-hidden border-2 border-blue-50 cursor-pointer bg-primary">
                                                <img v-if="$page.props.auth.profile.avatar" :src="$page.props.auth.profile.avatar" alt="" class="w-full h-full object-cover">
                                                <img v-else :src="'/storage/user/profileimages/'+$page.props.auth.profile.profileimage" alt="" class="w-full h-full object-cover">
                                            </div>
                                        </div>
                                    </template>
        
                                    <template #content>
                                        <DropdownLink :href="route('logout')" method="post" as="button">
                                            Log Out
                                        </DropdownLink>
                                    </template>
                                </Dropdown>
                            </div>
                            <span v-else class="inline-flex rounded-md">
                                <a :href="route('login')" class="text-xl bg-slate-300 hover:bg-secondary text-primary hover:text-white transition-all duration-500 ease-linear h-11 w-11 rounded-full text-center flex items-center justify-center">
                                    <font-awesome-icon icon="fa-unlock"></font-awesome-icon> 
                                </a>
                            </span>
                            <div class="md:hidden text-primary transition-all duration-200 ease-in-out cursor-pointer">
                                <button @click="toggleMobileMenu" class="text-2xl bg-slate-300 h-8 w-8 rounded-sm">
                                    <font-awesome-icon v-if="isShowingMobileMenu" icon="fa-close"></font-awesome-icon> 
                                    <font-awesome-icon v-else icon="fa-bars"></font-awesome-icon> 
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="md:hidden text-primary transition-all duration-200 ease-in-out cursor-pointer flex items-center">
                        <button @click="toggleMobileMenu" class="text-2xl bg-slate-300 h-8 w-8 rounded-sm">
                            <font-awesome-icon v-if="isShowingMobileMenu" icon="fa-close"></font-awesome-icon> 
                            <font-awesome-icon v-else icon="fa-bars"></font-awesome-icon> 
                        </button>
                    </div>
                </div>
            </div>

        </nav>

        <!-- Responsive Navigation Menu -->
        <TransitionGroup 
            tag="div"
            enter-from-class="-translate-x-full opacity-0"
            enter-active-class="duration-500"
            leave-active-class="duration-500"
            leave-to-class="-translate-x-full opacity-0"

            class="">
                <div v-if="isShowingMobileMenu" class="md:hidden bg-slate-200 p-2 fixed top-0 h-full left-0 shadow-md max-h-screen w-1/2 z-50">
                    <div class="gap-4 text-slate-500 items-center w-full py-2 flex flex-col justify-between h-full">

                        <div class="">
                            <ApplicationLogo />
                            <hr class="my-4">
                            <a :href="route('page.welcome')" :class="[[route().current('page.welcome')? activeMobileMenu:''], mobileMenuItemClasses]">
                                Home
                            </a>
                            <a :href="route('page.about')" :class="[[route().current('page.about')? activeMobileMenu:''], mobileMenuItemClasses]">
                                About Us
                            </a>
                            <a :href="route('services.index')" :class="[[route().current('services.index')? activeMobileMenu:''], mobileMenuItemClasses]">
                                Services
                            </a>
                            <Link :href="route('posts.index')" :class="[[route().current('posts.index')? activeMobileMenu:''], mobileMenuItemClasses]">
                                Blog
                            </Link>
                            <Link :href="route('page.contactus')" :class="[[route().current('page.contactus')? activeMobileMenu:''], mobileMenuItemClasses]">
                                Contact Us
                            </Link>
                            <NavLink :href="route('admin.index')" :active="route().current('admin.index')" v-if="$page.props.auth.isAdmin">
                                Dashboard
                            </NavLink>
                        </div>
                        <div class="md:hidden text-primary transition-all duration-200 ease-in-out cursor-pointer">
                            <button @click="toggleMobileMenu" class="">
                                <span v-if="isShowingMobileMenu" class="flex gap-2 items-center">
                                    <span>Close Drawer</span>
                                    <span class="text-2xl bg-slate-300 h-8 w-8 rounded-sm">
                                        <font-awesome-icon  icon="fa-close"></font-awesome-icon> 
                                    </span>
                                </span>
                            </button>
                        </div>
           
                    </div>

                </div>
        </TransitionGroup>



</template>

<style>

</style>