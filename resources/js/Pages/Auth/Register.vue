<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <GuestLayout>
        <Head title="Register" />

        <div class="p-8 min-h-screen">
            <div class="bg-blue-100 md:w-[400px] p-8 rounded-lg mx-auto">
                <h1 class="font-bold text-indigo-600 mb-3">New User Registration</h1>
                <hr class="border-indigo-600 mb-3">
       
                <form @submit.prevent="submit">
                    <div>
                        <InputLabel for="name" value="Name" />
        
                        <TextInput
                            id="name"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="form.name"
                            required
                            autofocus
                            autocomplete="name"
                        />
        
                        <InputError class="mt-2" :message="form.errors.name" />
                    </div>
        
                    <div class="mt-4">
                        <InputLabel for="email" value="Email" />
        
                        <TextInput
                            id="email"
                            type="email"
                            class="mt-1 block w-full"
                            v-model="form.email"
                            required
                            autocomplete="username"
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
                            autocomplete="new-password"
                        />
        
                        <InputError class="mt-2" :message="form.errors.password" />
                    </div>
        
                    <div class="mt-4">
                        <InputLabel for="password_confirmation" value="Confirm Password" />
        
                        <TextInput
                            id="password_confirmation"
                            type="password"
                            class="mt-1 block w-full"
                            v-model="form.password_confirmation"
                            required
                            autocomplete="new-password"
                        />
        
                        <InputError class="mt-2" :message="form.errors.password_confirmation" />
                    </div>
        
                    <div class="flex items-center mt-4 gap-3">
                        
                        <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                            Register
                        </PrimaryButton>
                        <Link :href="route('login')" class="text-gray-600 hover:text-indigo-600 font-bold">
                            Already registered?
                        </Link>
                    </div>
                </form>

            </div>
        </div>
    </GuestLayout>
</template>
