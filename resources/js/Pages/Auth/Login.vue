<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';

import Checkbox from '@/Components/Checkbox.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';


defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <div class="h-screen">
        <Head title="Log in" />

        <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
            {{ status }}
        </div>

        <div  class="flex justify-center h-full relative">
            
            <div class="flex flex-col justify-between z-30">

                <div class="flex items-center justify-center h-full">
                    <div class="w-[20rem] md:w-[450px] mx-auto bg-white rounded-xl overflow-hidden">
                        <div class="text-xl bg-primary text-white py-3 px-6 font-bold uppercase flex justify-between items-center">
                            <h1>Login</h1>
                            <div class="h-10 w-10 border-dashed border border-white rounded-full flex items-center justify-center">
                                <font-awesome-icon icon="fa-lock"></font-awesome-icon>
                            </div>
                        </div>
    
                        <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
                            {{ status }}
                        </div>
    
    
                        <div class="px-6 py-12">
                            <form @submit.prevent="submit" autocomplete="off">
                                <div>
                                    <InputLabel for="email" value="Email" />
                    
                                    <TextInput
                                        id="email"
                                        type="email"
                                        class="mt-1 block w-full"
                                        v-model="form.email"
                                        required
                                        autocomplete="username"
                                        placeholder="admin@bmc.co.ke"
                                    />
                    
                                    <InputError class="mt-2" :message="form.errors.email" />
                                </div>
                    
                                <div class="mt-4">
                                    <InputLabel for="password" value="Password" />
                    
                                    <TextInput
                                        id="password"
                                        type="password"
                                        class="mt-1 block w-full"
                                        v-model="form.password"
                                        required
                                    />
                    
                                    <InputError class="mt-2" :message="form.errors.password" />
                                </div>
                    
                                <div class="flex items-center justify-between mt-4">
                                    <label class="flex items-center">
                                        <Checkbox name="remember" v-model:checked="form.remember" />
                                        <span class="ml-2 text-sm text-slate-600 dark:text-slate-400">Remember me</span>
                                    </label>
        
                                    <Link
                                        v-if="canResetPassword"
                                        :href="route('password.request')"
                                        class="underline text-sm text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-slate-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-slate-800"
                                    >
                                        Forgot your password?
                                    </Link>
        
                                </div>
                    
                                <div class="my-4">
                                    <button type="submit" class="py-3 w-full px-6 rounded-lg text-white bg-primary hover:bg-secondary border border-primary hover:border-secondary transition-all duration-500 ease-linear" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                        Log in
                                    </button>
                                </div>
                                <div class="text-slate-600 ">
                                    <span>Don't Have Account?  Register</span>
                                    <span><a :href="route('register')" class="text-primary hover:text-secondary font-bold"> Here.</a></span>
                                </div>
                            </form>
    
                        </div>
    
                    </div>
                </div>


                <div class="mb-16 md:w-[450px] md:mx-auto">
                    <hr class="mt-8 mb-2 border-white">
                    <div class="flex justify-center gap-4 px-8 md:px-0">
                        <a href="/" class="text-white hover:text-white font-bold">Home</a>
                        <a :href="route('page.about')" class="text-white hover:text-white font-bold">About</a>
                        <a href="/" class="text-white hover:text-white font-bold">Terms</a>
                        <a href="/" class="text-white hover:text-white font-bold">Contact Us</a>
                    </div>
                </div>
            </div>
            <div class="absolute inset-0 bg-black z-20 bg-opacity-75"></div>
            <img src="/storage/globals/login-bg.jpg" alt="" class="absolute inset-0 w-full h-full object-cover ">

        </div>

    </div>
</template>
