<script setup>
import Modal from '@/Components/Modal.vue'
import { useForm } from '@inertiajs/vue3';
import { ref } from 'vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
// import TextArea from "@/Components/TextArea.vue";
// import axios from 'axios';
import Spinner from '@/Components/spinners/Spinner.vue'
import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
import {component as CKEditor} from '@ckeditor/ckeditor5-vue';
// import { Inertia } from '@inertiajs/inertia';

const isModalActive = ref(false);

const toggleModal = ()=>{
    isModalActive.value=!isModalActive.value;
}
const errors = ref([]);
const isSending = ref(false);
const showSuccess = ref(false);


const form = useForm({
    message: '',
    addresses: ''
});


const storeReview = async () => {  

    errors.value = [];

    if(form.review === null){
        errors.value.push('The review field is required');
    }

    if(errors.value.length<1){
    
        isSending.value = true;

        form.post(route('send.recommendation'),
            {
                message: form.message,
                addresses: form.addresses,
            },
            {
                onSuccess: ()=>{
                    isSending.value = false;
                    form.reset();
                    showSuccess.value = true;
                }
            }
        )     
    
    }
}
const btnClasses = 'rounded border border-transparent bg-blue-600 px-3 py-1 text-sm space-x-1 text-white shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2';
const btnCloseClasses = 'rounded border border-transparent bg-red-600 px-3 py-1 text-sm text-white shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2';
const inputClasses = 'mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm'

const editorConfig = ref();
</script>

<template>
<div class="">
    <h1 class="uppercase text-blue-700 font-bold">Recommend Us To a friend, company ...</h1>
    <hr class="mb-2">
    <Transition   
        enter-from-class="translate-x-full opacity-0"
        enter-active-class="duration-500"
        leave-active-class="duration-500"
        leave-to-class="translate-x-full opacity-0">
        <div v-show="showSuccess" class="bg-teal-600 rounded p-2 my-1 text-white flex justify-between">
            <span class="font-bold space-x-2">
                <font-awesome-icon icon="fa-envelope-circle-check"></font-awesome-icon>
                Email Sent Successfully!
            </span>
            <span class="bg-white text-teal-600 h-6 w-6 rounded-full flex justify-center items-center cursor-pointer hover:bg-teal-400 transition-all duration-200" @click="showSuccess=false">
                <font-awesome-icon icon="fa-times"></font-awesome-icon>
            </span>
        </div>
    </Transition>
    <div class="relative py-2 ">
        <div v-if="isSending" class="bg-blue-600 bg-opacity-75 text-white absolute inset-0 rounded-md z-40">
            <div class="flex items-center justify-center h-full">
                <Spinner :has-text="true" :text="'Sending Mail...'"/>
            </div>
        </div>
        <div class="bg-blue-100 shadow rounded-md p-4">
            <div v-if="errors.length" class="text-sm mb-3">
                <ul>
                    <li v-for="(error, index) in errors" :key="index" class="bg-red-200 text-red-700 px-2 py-1 rounded mb-1">
                        * {{ error }}
                    </li>
                </ul>
            </div>
    
            <form @submit.prevent="storeReview" class="pb-4">
                <div class="mt-3">
                    <InputLabel for="message" value="Message" />
                    <div class="mb-3">
                        <CKEditor :editor="ClassicEditor" v-model="form.message" :config="editorConfig"></CKEditor>
                        <ul v-if="errors.length>0" class="bg-red-100 rounded-md p-2 mt-1">
                            <li class="text-red-600" v-for="error in errors" :key="error">{{ error }}</li>
                        </ul>
                    </div>
                </div>            
                <div class="mt-3">
                    <InputLabel for="addresses" value="Recipient's Email" />
                    <TextInput 
                        id="addresses" 
                        type="email" 
                        :class="inputClasses" 
                        v-model="form.addresses" 
                        required
                        placeholder="johnapuoyo@mbui.kom" />
                    <InputError class="mt-2" :message="form.errors.addresses" />
                </div>
                <div class="flex gap-2 items-center mt-4">
                    <button type="button" @click="toggleModal" :class="btnClasses">
                        <span class="">
                            import contacts
                        </span>
                    </button>
                    <button type="submit" :class="[btnClasses, !form.addresses||!form.message ? 'cursor-not-allowed bg-slate-400':'']" :disabled="!form.addresses||!form.message">
                        Send
                    </button>  
                </div>
                
            </form>
        </div>
    </div>
    
    <Modal :show="isModalActive" :closeable="true">

        <div class="p-6">
            <h3 class="uppercase text-slate-600 font-bold mb-2">Import Contacts</h3>
            <hr>
            <div class="p-4 uppercase">
                <p class="font-bold">This Module is Under Develoment.</p> 
                <p>Currently, you can only send recommendation to a single email address in the email input box provided.</p>
            </div>
            <button type="button" @click="toggleModal" :class="btnCloseClasses">
                <font-awesome-icon icon="fa-times"></font-awesome-icon>
                Close
            </button>
        </div>
    </Modal>
</div>  
</template>
