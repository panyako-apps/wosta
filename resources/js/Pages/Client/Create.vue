<script setup>

import { ref } from 'vue';
import { Head, useForm, usePage } from "@inertiajs/vue3";
import GuestLayout from '@/Layouts/GuestLayout.vue'
import Spinner from '@/Components/spinners/Spinner.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';

const page =usePage();

const form = useForm({
    name: '', 
    email: '',
    phone: '',
    company: '',
});

const inProgress = ref(false);
const errors = ref([]);

function submit() {

    errors.value = [];

    if(form.email===''){
        errors.value.push('Email field is required')
    }
    if(form.phone===''){
        errors.value.push('Phone field is required')
    }
    if(form.name===''){
        errors.value.push('Name field is required')
    }

    if(errors.value.length<1)
    {

        inProgress.value = true;

        form.post(route('client.store'), {
            preserveScroll: true,
            onSuccess: ()=>{
                form.reset();
            }, 
        });
        
        inProgress.value = false;

    }

}



const btnClasses = 'rounded border border-transparent bg-sky-600 px-3 py-1 text-sm text-white shadow-sm hover:bg-sky-700 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:ring-offset-2';
const inputClasses = 'mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-sky-500 focus:ring-sky-500 sm:text-sm'


</script>

<template>
    <GuestLayout>
        <Head>
            <title>Contact Us</title>
            <meta name="description" content="contacts us for professional cleaning services.">
        </Head>

        <div class="mx-auto gap-8 pt-8">
            <div class="h-24 md:h-36 flex items-center bg-slate-300 mb-8 rounded-md">
                <div class="p-4">
                    <h2 class="text-4xl tracking-tight font-extrabold text-sky-600 dark:text-white">Join Our Clientbase.</h2>
                    <!-- <hr class="w-50 mx-auto lg:mb-4 border border-sky-600"> -->
                </div>
            </div>

            <div class="md:grid grid-cols-2 gap-8 md:mb-6">
                <div class="mb-4 md:mb-0">
                    <p class="mb-8 lg:mb-8 font-light text-slate-500 dark:text-slate-400 sm:text-xl">Enjoy Discounted Prices and Special Offers. </p>
                    <section class="">
                        <div v-if="inProgress" class="p-6 h-36 flex justify-center items-center">
                            <Spinner :has-text="true" :text="'Sending...'"/>
                        </div>

                        <div v-else class="p-4 mx-auto bg-white rounded-xl border-2  border-sky-200">
                            <div class="text-center -mt-8 mb-8">
                                <span class="bg-sky-200 text-sky-600 font-bold h-16 rounded-full px-3 py-2">Client Registration Form</span>
                            </div>
                            <form @submit.prevent="submit">
                                <div v-if="page.props.flash.success" class="p-2 rounded-md bg-sky-100 text-sky-600 font-bold mb-4">
                                    <p>{{ page.props.flash.success }}</p>
                                </div>
                                <div class="grid md:grid-cols-2 gap-4 mb-3">
                                    <div class="">
                                        <InputLabel for="name" value="Your Name *" />
                                        <TextInput 
                                            id="name" 
                                            type="text" 
                                            :class="inputClasses" 
                                            v-model="form.name" 
                                            placeholder="Name"
                                            />
                                        <InputError class="mt-2" :message="form.errors.name" />
                                    </div>
                                    <div class="">
                                        <InputLabel for="email" value="Your Email *" />
                                        <TextInput 
                                            id="email" 
                                            type="text" 
                                            :class="inputClasses" 
                                            v-model="form.email" 
                                            placeholder="Active email address"
                                            required />
                                        <InputError class="mt-2" :message="form.errors.email" />
                                    </div>
                                </div>

                                <div class="grid md:grid-cols-2 gap-4 mb-3">
                                    <div class="">
                                        <InputLabel for="phone" value="Phone No. *" />
                                        <TextInput 
                                            id="phone" 
                                            type="text" 
                                            :class="inputClasses" 
                                            v-model="form.phone" 
                                            placeholder="Phone No"
                                            required
                                            />
                                        <InputError class="mt-2" :message="form.errors.phone" />
                                    </div>
                                    <div class="">
                                        <InputLabel for="company" value="Your company " />
                                        <TextInput 
                                            id="company" 
                                            type="text" 
                                            :class="inputClasses" 
                                            v-model="form.company" 
                                            placeholder="Company Name"
                                            />
                                        <InputError class="mt-2" :message="form.errors.company" />
                                    </div>
                                </div>

                                <div v-if="errors.length" class="bg-red-200 text-red-600 p-4 mb-3 rounded-md">
                                    <ul>
                                        <li v-for="error in errors" :key="error" class="">{{ error }}</li>
                                    </ul>
                                </div>
                                <div class="flex gap-2">
                                    <button class="bg-sky-600 hover:bg-sky-500 text-white font-bold text-sm px-4 py-2 rounded-full" 
                                        :class="[form.processing ? 'opacity-25' : btnClasses]"
                                        @click="submit"
                                        :disabled="form.processing"
                                        >
                                            Submit
                                    </button>
                                </div>
                            </form>
                        </div>

                    </section>
                </div>
                <div class="bg-slate-200 p-2 flex items-center mb-4 md:mb-0">
                    <video src="/storage/globals/intro.mp4" controls loop class="w-full"></video>
                </div>
            </div>
        </div>
    </GuestLayout>    
</template>

<style>

</style>
