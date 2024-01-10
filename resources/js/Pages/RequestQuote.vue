<script setup>
import GuestLayout from "@/Layouts/GuestLayout.vue";
import {Head, router, useForm, usePage } from "@inertiajs/vue3";
import { ref } from 'vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
import {component as CKEditor} from '@ckeditor/ckeditor5-vue';
import Spinner from '@/Components/spinners/Spinner.vue';

const props = defineProps({
    services: Array,
})

const btnClasses = 'bg-primary hover:bg-sky-500 text-white font-bold text-sm px-4 py-2 rounded-full h-8 my-auto flex items-center';
const btnCloseClasses = 'bg-rose-600 hover:bg-rose-500 text-white font-bold text-sm px-4 py-2 rounded-full h-8 my-auto flex items-center';
const inputClasses = 'block w-full rounded-md border-gray-300 shadow-sm focus:border-sky-500 focus:ring-sky-500 sm:text-sm'

const page =usePage();

const selectedService = ref();


const form = useForm({
    name: '',
    email: '',
    phone: '',
    company: '',
    message: '',
    file: '',
      
})


const show = ref(false);

const toggleModal = () =>{
    show.value = !show.value
}

const editorConfig = [];

const inProgress = ref(false);

function submit() {
    
    inProgress.value= true;

    router.post(route('quotation.store'),{
        name: form.name,
        email: form.email,
        phone: form.phone,
        company: form.company,
        product_id: selectedService.value,
        message: form.message,
        file: form.file,
    },
    {
        onSuccess: ()=>{
            toggleModal();
            inProgress.value = false;
            form.reset();
        },
        preserveScroll: true,
    });

}

</script>

<template>
<Head title="Request Quotation" />

<GuestLayout>

    <div class="max-w-3xl mx-auto gap-8 pt-8 h-screen">
        
        <div class="bg-white p-6 rounded-xl">

            <div class="">
                <h1 class=" mx-auto flex items-center justify-center font-bold text-2xl md:text-4xl text-primary uppercase w-1/2 text-center">Request a Quote</h1>
                <hr class="mt-4 mb-12 w-1/5 mx-auto border-primary border-2">
            </div>

            <form @submit.prevent="submit">
                <div v-if="page.props.flash.quotesubmitted" class="p-2 rounded-md bg-sky-100 text-primary font-bold mb-4">
                    <p>{{ page.props.flash.quotesubmitted }}</p>
                </div>

                <div class="mb-3">
                    <InputLabel for="name" value="Your Name" />
                    <TextInput 
                        id="name" 
                        type="text" 
                        :class="inputClasses" 
                        v-model="form.name" 
                        placeholder="Full Name"
                        required />
                    <InputError class="mt-2" :message="form.errors.name" />
                </div>

                <div class="md:grid grid-cols-2 gap-4 mb-3">
                    <div class="">
                        <InputLabel for="email" value="Email Address" />
                        <TextInput 
                            id="email" 
                            type="text" 
                            :class="inputClasses" 
                            v-model="form.email" 
                            placeholder="Full Email"
                            required />
                        <InputError class="mt-2" :message="form.errors.email" />
                    </div>
                    <div class="">
                        <InputLabel for="phone" value="Phone No" />
                        <TextInput 
                            id="phone" 
                            type="text" 
                            :class="inputClasses" 
                            v-model="form.phone" 
                            placeholder="+254700XXX999"
                            required />
                        <InputError class="mt-2" :message="form.errors.phone" />
                    </div>
                </div>
    
                <div class="mb-3">
                    <InputLabel for="company" value="Company Name" />
                    <TextInput 
                        id="company" 
                        type="text" 
                        :class="inputClasses" 
                        v-model="form.company" 
                        placeholder="Company Name"
                        required />
                    <InputError class="mt-2" :message="form.errors.company" />
                </div>


                <div class="mb-3">
                    <InputLabel for="service" value="Service" />
                    <select name="service" id="service" 
                            :class="inputClasses" 
                            v-model="selectedService" 
                            required
                            >
                        <option v-for="(service, index) in props.services" 
                                :key="index" 
                                :value="service.id"
                                >
                                {{ service.name }}
                        </option>
                    </select>
                    <InputError class="mt-2" :message="form.errors.service_id" />
                </div>


                <div class="mb-3">
                    <InputLabel for="message" value="Additional Information" />
                    <CKEditor :editor="ClassicEditor" v-model="form.message" :config="editorConfig"></CKEditor>
                    <InputError class="mt-2" :message="form.errors.message" />
                </div>

                <div class="mb-3">
                    <InputLabel for="file" value="Upload Image" />
                    <input 
                        class="form-file-input"
                        type="file" 
                        id="file"
                        @input="form.file = $event.target.files[0]" 
                    >
                    <InputError class="mt-2" :message="form.errors.file" />
                </div>

                <div class="flex gap-2">
                    <button 
                        :class="[form.processing ? 'opacity-25' : btnClasses]"
                        @click="submit"
                        :disabled="form.processing"
                        >
                            Submit
                    </button>
                </div>
            </form>
        </div>
    </div>
</GuestLayout>

</template>