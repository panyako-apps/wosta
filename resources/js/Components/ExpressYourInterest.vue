<script setup>
import { useForm } from '@inertiajs/vue3';
import { computed, onMounted, ref } from 'vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import TextArea from "@/Components/TextArea.vue";
import axios from 'axios';
import Spinner from '@/Components/spinners/Spinner.vue'
import countries from '@/Stores/countries'
import Modal from '@/Components/Modal.vue'

const props = defineProps({
    product_id: Number,
});

const errors = ref([]);
const isSending = ref(false);
const showSuccess = ref(false);
const selectedCountry = ref({});
const contact = ref();
const code = ref();


const chooseCountry = (country)=>{
    selectedCountry.value = country;
    code.value = country.code;
}

const form = useForm({
    message: '',
    email: null,
});



const submit = async () => {  
    
    const phone = code.value + contact.value.replace(/^0+/, '');
    
    errors.value = [];

    if(form.contact === null){
        errors.value.push('Phone No. MUST be provided');
    }

    if(errors.value.length<1){
    
        isSending.value = true;

        const result =  await axios.post(route('product.expressinterest'),
            {
                message: form.message,
                email: form.email,
                phone_no: phone,
                product_id: props.product_id
            }
        )     
        isSending.value = false;

        if(result.status === 200){
            form.reset();
            showSuccess.value = true;
            await new Promise((res)=>setTimeout(res, 5000))
            toggleModal();
        }
    
    }
}

const inProgress = ref(false);

onMounted(async()=>{
    inProgress.value = true;
    await new Promise((res)=>setTimeout(res, 500))
    inProgress.value = false;
});


const show = ref(false);

const toggleModal = ()=>{
    show.value=!show.value
}


const btnClasses = 'rounded border border-transparent bg-blue-600 px-3 py-1 text-sm space-x-1 text-white shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2';
const inputClasses = 'mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm'
const btnCloseClasses = 'rounded border border-transparent bg-red-600 px-3 py-1 text-sm text-white shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2';

</script>

<template>

<button @click="toggleModal" class="rounded-full border border-transparent bg-blue-600 px-4 py-1 text-sm font-medium text-white shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">Express Your Interest</button>

<Modal :show="show" :closeable="true">
    <div v-if="inProgress" class="p-6 h-36 flex justify-center items-center">
    <Spinner :has-text="true"/>
    </div>
    
    <div v-if="!inProgress" class="p-6">
        <h1 class="uppercase text-blue-600 font-bold">Express Interest on This Product</h1>
        <hr class="mb-2">
        <Transition   
            enter-from-class="translate-x-full opacity-0"
            enter-active-class="duration-500"
            leave-active-class="duration-500"
            leave-to-class="translate-x-full opacity-0">
            <div v-show="showSuccess" class="bg-teal-600 rounded p-2 my-1 text-white flex justify-between">
                <span class="font-bold space-x-2">
                    <font-awesome-icon icon="fa-envelope-circle-check"></font-awesome-icon>
                    Your request was submitted successfully! You will be contacted from +254794357375
                </span>
                <span class="shrink-0 bg-white text-teal-600 h-6 w-6 rounded-full flex justify-center items-center cursor-pointer hover:bg-teal-400 transition-all duration-200" @click="showSuccess=false">
                    <font-awesome-icon icon="fa-times"></font-awesome-icon>
                </span>
            </div>
        </Transition>
        <div class="relative py-2 ">
            <div v-if="isSending" class="bg-blue-600 bg-opacity-75 text-white absolute inset-0 rounded-md">
                <div class="flex items-center justify-center h-full">
                    <Spinner :has-text="true" :text="'Sending Mail...'"/>
                </div>
            </div>
            <div class="p-4">
                <div v-if="errors.length" class="text-sm mb-3">
                    <ul>
                        <li v-for="(error, index) in errors" :key="index" class="bg-red-200 text-red-700 px-2 py-1 rounded mb-1">
                            * {{ error }}
                        </li>
                    </ul>
                </div>
        
                <form @submit.prevent="submit" class="pb-4">
                    <div class="mt-3">
                        <div class="flex justify-between items-center">
                            <InputLabel for="contact" value="Your Phone No." />
                            <span class="text-sm">{{ selectedCountry.name }}</span>
                        </div>
                        <div class="flex items-center gap-0 mb-3">
                            <div class="">
                                <select name="countries" id="countries" 
                                        :class="inputClasses" 
                                        v-model="selectedCountry" 
                                        @change="chooseCountry(selectedCountry)"
                                        >
                                    <option v-for="(country, index) in countries" 
                                            :key="index" 
                                            :value="country"
                                            >
                                            {{ country.code }}
                                    </option>
                                </select>
                            </div>
                            <TextInput 
                                id="contact" 
                                type="number" 
                                :class="inputClasses" 
                                v-model="contact" 
                                required
                                placeholder="0794357375" />      
                        </div>
                        <InputError class="mt-2" :message="form.errors.contact" />
                    </div>
                    <div class="mb-3">
                        <InputLabel for="contact" value="Email Address" />
                        <TextInput 
                            id="email" 
                            type="text" 
                            :class="inputClasses" 
                            v-model="form.email" 
                            required
                            placeholder="johnapuoyo@mbui.kom" />
                        <InputError class="mt-2" :message="form.errors.email" />
                    </div>
                    <div class="mt-3">
                        <InputLabel for="message" value="Message" />
                        <TextArea 
                            v-model="form.message" 
                            name="message" 
                            placeholder="Your message here..."></TextArea>
                        <InputError class="mt-2" :message="form.errors.message" />
                    </div>            
                    <div class="flex gap-2 items-center mt-4">
                        <button type="submit" 
                            :class="[btnClasses, !contact||!form.message ? 'cursor-not-allowed bg-slate-400':'']" 
                            :disabled="!contact||!form.message"
                            >
                            Submit
                        </button>  

                        <button 
                                type="button" 
                                :class="btnCloseClasses"
                                @click="toggleModal"
                                >
                                <font-awesome-icon icon="fa-times"></font-awesome-icon>
                                Close
                        </button>
                    </div>
                    
                </form>
            </div>
        </div>
        
    </div>  
</Modal>
</template>
