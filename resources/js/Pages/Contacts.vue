<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue'
import { Head, usePage } from '@inertiajs/vue3';
import ContactForm from '@/Components/forms/ContactForm.vue';

const page =usePage();

</script>

<template>
    <GuestLayout>
        <Head>
            <title>Contact Us</title>
            <meta name="description" content="contacts us for professional cleaning services.">
        </Head>

        <div class="mx-auto gap-8">
            <section class="bg-white relative h-48 -mx-4" id="header-image">
                <img src="https://www.kenya2uhub.com/wp-content/uploads/2019/06/Inland-container-terminal-Embakasi-Nairobi.jpg" alt="" class="w-full h-full object-cover">
                <div class="absolute inset-0 h-full bg-black bg-opacity-50">
                    <div class="max-w-7xl mx-auto text-white flex items-center h-full justify-center lg:justify-start">
                        <div class="">
                            <h1 class="text-6xl font-bold">Contact Us</h1>
                            <p class="space-x-2 text-sm">
                                <font-awesome-icon icon="fa-home" class="text-secondary"></font-awesome-icon>
                                <a href="/" class="hover:text-secondary font-bold">Home </a> 
                                <span>|</span> 
                                <a :href="route('services.index')" class="hover:text-secondary font-bold">Services </a> 
                                <span>|</span> 
                                <span>Contact Us</span>
                            </p>
                        </div>
                    </div>
                </div>
            </section>

            <div class="max-w-7xl mx-auto md:grid grid-cols-2 gap-8 md:mb-6 py-8 px-6">
                <div class="mb-4 md:mb-0">
                    <p class="mb-8 lg:mb-8 font-light text-slate-500 dark:text-slate-400 sm:text-xl">Got something to share? Want to send feedback? Need details about our plan? Let us know.</p>
                    <ContactForm />
                </div>
                <div class="bg-slate-200 p-2 flex items-center mb-4 md:mb-0">
                    <div class="rounded-xl overflow-hidden shadow-lg w-full">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3988.8537529409086!2d36.8179083!3d-1.2599000999999999!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x182f171bdc9d83cd%3A0xd05be9b70fee453f!2s3rd%20Parklands%20Ave%2C%20Nairobi!5e0!3m2!1sen!2ske!4v1704540468342!5m2!1sen!2ske" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>                    </div>
                </div>
            </div>
        </div>
    </GuestLayout>    
</template>

<style>

</style>
