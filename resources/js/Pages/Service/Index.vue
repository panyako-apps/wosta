<script setup>

import GuestLayout from '@/Layouts/GuestLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import ServiceCard from '@/Components/cards/ServiceCard.vue';
import Spinner from '@/Components/spinners/Spinner.vue';
import SocialSharer from '@/Components/SocialSharer.vue';
import Dropdown from '@/Components/Dropdown.vue'
import Pagination from '@/Components/paginations/Pagination.vue'
import TeamMemberCard from '@/Components/cards/TeamMemberCard.vue'

const props = defineProps({
    services: [Array, Object],
    categories: [Object],
    // filters: [Array, Object],
    staffMembers: [Object, Array],
});

</script>

<template>

    <Head title="Our Services">
        <meta title="description" content="next electronic and furniture imports from Sweden">
    </Head>

    <GuestLayout>

        <div class="min-h-screen">
            <section class="bg-white relative h-48" id="header-image">
                <img src="https://www.kenya2uhub.com/wp-content/uploads/2019/06/Inland-container-terminal-Embakasi-Nairobi.jpg" alt="" class="w-full h-full object-cover">
                <div class="absolute inset-0 h-full bg-black bg-opacity-50">
                    <div class="max-w-7xl mx-auto text-white flex items-center h-full justify-center lg:items-start">
                        <div class="">
                            <h1 class="text-5xl lg:text-6xl font-bold">Our Services</h1>
                            <p class="space-x-2 text-sm">
                                <font-awesome-icon icon="fa-home" class="text-secondary"></font-awesome-icon>
                                <a href="/" class="hover:text-secondary font-bold">Home </a> 
                                <span>|</span> 
                                <span>Services</span>
                            </p>
                        </div>
                    </div>
                </div>
            </section>
            <section class="py-16 px-6">
                <div class="max-w-7xl mx-auto">
                    <div v-if="props.services.data.length" class="grid lg:grid-cols-3 gap-6 lg:gap-4">
                        <ServiceCard v-for="service in props.services.data" :key="service.id" :service="service" />
                    </div>
                    <div v-else class="flex justify-center items-center h-full">
                        <div v-show="isFetching&&props.services.data.length<1" class="text-center">
                            <p class="uppercase font-bold text-slate-500 text-2xl">
                                No Services added yet.
                            </p>
                        </div>
                    </div>
                    <div class="my-8">
                        <Pagination v-if="!isFetching && props.services.meta.last_page>1" :links="props.services.meta.links" :classes="'mb-8'"/>
                    </div>
                </div>
            </section>

            <section class=" bg-primary relative lg:h-[40rem] px-6">
                <div class="lg:absolute inset-0 bg-primary bg-opacity-95 z-40 flex items-center justify-end">
                    <div class="lg:w-[42%]  h-full self-end relative">
                        <div class="absolute w-2/5 bg-secondary bg-opacity-50 h-full"></div>
                        <img src="https://apiabroad.com/wp-content/uploads/2022/12/students-on-computer-high-five-532500-1024x683.jpg" alt="" class="w-full h-full object-cover">
                    </div>
                </div>
                <div class="lg:absolute inset-0 z-40 py-16">
                    <div class="max-w-7xl mx-auto lg:flex gap-8">
                        <div class="lg:w-[60%] shrink-0 lg:pr-6">
                            <span class="uppercase text-white border-b border-b-slate-400">Why Choose Us</span>
                            <h2 class="font-bold text-white text-2xl md:text-4xl xl:text-5xl my-4 mb-8">International placements and advisory services from  <span class="font-secondary italic text-secondary ">Experts.</span></h2>

                            <div class="grid lg:grid-cols-2 gap-8 text-white">
                                <div class="lg:border-r border-r-white pr-6">
                                    <div class="h-16 w-16 rounded-full shrink-0 border border-dashed border-white flex justify-center items-center mb-2">
                                        <font-awesome-icon icon="fa-bullseye" class="text-4xl"></font-awesome-icon> 
                                    </div>
                                    <h4 class="font-bold text-2xl mb-2">International Universities Course Placements</h4>
                                    <p class="text-sm">Lorem ipsum dolor sit amet consectetur adipisicing elit. Reprehenderit nemo labore voluptatum reiciendis. Dolor, quas? Mollitia iure adipisci reiciendis labore!</p>
                                </div>
                                <div class="pr-6">
                                    <div class="h-16 w-16 rounded-full shrink-0 border border-dashed border-white flex justify-center items-center mb-2">
                                        <font-awesome-icon icon="fa-plane-departure" class="text-4xl"></font-awesome-icon> 
                                    </div>
                                    <h4 class="font-bold text-2xl mb-2">Comprehensive Travel Arrangements</h4>
                                    <p class="text-sm">Lorem ipsum dolor sit amet consectetur adipisicing elit. Reprehenderit nemo labore voluptatum reiciendis. Dolor, quas? Mollitia iure adipisci reiciendis labore!</p>
                                </div>
                            </div>
                        </div>
                        <div class="lg:p-6 pb-8 lg:w-[24%] flex flex-col justify-between">
                            <h2 class="font-bold text-white text-2xl md:text-4xl xl:text-5xl my-4 leading-5">Secure Your Future Now!</h2>
                            <div class="">
                                <Link :href="'/'" class="bg-primary hover:bg-rose-600 text-white font-bold px-5 py-2.5 rounded-full my-auto">
                                    Register Here
                                </Link>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="py-16 px-6" id="whychooseus">
                <div class="max-w-7xl mx-auto lg:h-[24rem]">
                    <div class="h-full">
                        <p class="uppercase text-slate-600 underline">Our Team Members</p>
                        <div class="lg:flex items-center justify-between gap-4 mb-8">
                            <h2 class="font-bold text-primary text-2xl md:text-4xl xl:text-5xl my-4 leading-5">Discover Wostac's <span class="font-secondary italic text-secondary"> Experts</span>.</h2>
                            <Link :href="'/'" class="bg-secondary hover:bg-rose-600 text-white font-bold px-5 py-2.5 rounded-full my-auto flex items-center justify-center">
                                Explore More
                            </Link>
                        </div>

                        <div class="grid lg:grid-cols-4 gap-6 lg:gap-12">
                            <TeamMemberCard v-for="staff in staffMembers.data.slice(0,4)" 
                                :key="staff"
                                :staff="staff"/>
                        </div>
                    </div>
                </div>
            </section>

                
        </div> 
    </GuestLayout>
</template>


<style>

</style>