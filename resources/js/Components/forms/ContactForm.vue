
<script setup>

import { ref } from 'vue';
import { useForm, usePage } from "@inertiajs/vue3";

import Spinner from '@/Components/spinners/Spinner.vue';

import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
import {component as CKEditor} from '@ckeditor/ckeditor5-vue';

const page =usePage();


const form = useForm({
    name: '', 
    email: '',
    phone: '',
    subject: '',
    message: ''
});

const inProgress = ref(false);
const errors = ref([]);

function submit() {

    errors.value = [];

    if(form.email===''){
        errors.value.push('Email field is required')
    }
    if(form.subject===''){
        errors.value.push('Subject field is required')
    }
    if(form.message===''){
        errors.value.push('Message field is required')
    }

    if(errors.value.length<1)
    {

        inProgress.value = true;

        form.post(route('message.store'), {
            preserveScroll: true,
            onSuccess: ()=>{
                form.reset();
            }, 
        });
        
        inProgress.value = false;

    }

}



const btnClasses = 'rounded border border-transparent bg-primary px-3 py-1 text-sm text-white shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-secondary focus:ring-offset-2';
const inputClasses = 'mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-secondary focus:ring-secondary sm:text-sm'


const editorConfig = [];

const showMessage = ref(false)

const hideMessage = () =>{
    showMessage.value = false;
}


</script>

<template>
  <section class="">
        <div v-if="inProgress" class="p-6 h-36 flex justify-center items-center">
            <Spinner :has-text="true" :text="'Sending...'"/>
        </div>

        <div v-else class="p-4 mx-auto bg-white rounded-xl border-2  border-secondary">
            <div class="text-center -mt-8 mb-8">
                <span class="bg-secondary text-white font-bold h-16 rounded-full px-4 py-2">Feedback Form</span>
            </div>
            <form @submit.prevent="submit">
                <div v-if="page.props.flash.messagesent" 
                    class="p-2 px-4 rounded-md bg-rose-50 text-secondary font-bold mb-4 relative">
                    <p>{{ page.props.flash.messagesent }}!</p>
                    <div @click="hideMessage" class="absolute -top-2 -right-2 h-6 w-6 rounded-full bg-secondary text-white flex items-center justify-center">
                        <font-awesome-icon icon="fa-close"></font-awesome-icon>
                    </div>
                </div>
                <div class="md:grid grid-cols-2 gap-4 mb-3">
                    <div class="mb-3 md:mb-0">
                        <InputLabel for="name" value="Your Name " />
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
                <div class="mb-3">
                    <InputLabel for="subject" value="Subject *" />
                    <TextInput 
                        id="subject" 
                        type="text" 
                        :class="inputClasses" 
                        v-model="form.subject" 
                        placeholder="Subject"
                        required />
                    <InputError class="mt-2" :message="form.errors.subject" />
                </div>

                <div class="mb-3">
                    <InputLabel for="phone" value="Phone No." />
                    <TextInput 
                        id="phone" 
                        type="text" 
                        :class="inputClasses" 
                        v-model="form.phone" 
                        placeholder="Phone No"
                         />
                    <InputError class="mt-2" :message="form.errors.phone" />
                </div>

                <div class="mb-3">
                    <InputLabel for="message" value="Your Message *" />
                    <CKEditor :editor="ClassicEditor" v-model="form.message" :config="editorConfig"></CKEditor>
                    <InputError class="mt-2" :message="form.errors.message" />
                </div>
               
                <div v-if="errors.length" class="bg-red-200 text-red-600 p-4 mb-3 rounded-md">
                    <ul>
                        <li v-for="error in errors" :key="error" class="">{{ error }}</li>
                    </ul>
                </div>
                <div class="flex gap-2">
                    <button class="bg-primary hover:bg-secondary text-white font-bold text-sm px-4 py-2 rounded-full" 
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
</template>

<style>

</style>