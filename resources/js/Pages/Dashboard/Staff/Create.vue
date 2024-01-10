<script setup>
import { router, useForm } from "@inertiajs/vue3";
import Modal from "@/Components/Modal.vue";
import { ref } from 'vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
import {component as CKEditor} from '@ckeditor/ckeditor5-vue';
import Spinner from '@/Components/spinners/Spinner.vue';

const props = defineProps({
    roles: {
        type: Array, 
    }
})

const btnClasses = 'rounded-md border border-transparent bg-primary px-3 py-1 text-sm text-white shadow-sm hover:bg-primary focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2';
const btnCloseClasses = 'rounded-md border border-transparent bg-secondary px-3 py-1 text-sm text-white shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2';
const inputClasses = 'block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary sm:text-sm'


const selectedTitle = ref();
const titles = [
    'Proff.',
    'Mr.',
    'Mrs.',
    'Miss',
    'Dr.',
]; 


const form = useForm({
    name: null,
    email: null,
    description: ref(),
    title: null,
    image: null,
    job_titles: null,
})

const show = ref(false);

const toggleModal = () =>{
    show.value = !show.value
}

const editorConfig = [];

const inProgress = ref(false);

function submit() {
    
    inProgress.value= true;

    router.post(route('admin.staff.store'),{
        name: form.name,
        email: form.email,
        description: form.description,
        title: selectedTitle.value,
        image: form.image,
        job_title: form.job_title,
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

    <div>
        <button 
            @click="toggleModal"
            :class="btnClasses"
            >
            Add Staff Member
        </button>
    </div>

    <Modal :show="show" :closeable="true">
        <div v-if="inProgress" class="p-6 h-36 flex justify-center items-center">
            <Spinner :has-text="true"/>
        </div>

        <div v-if="!inProgress" class="p-6">
            <form @submit.prevent="submit">

                <div class="md:grid grid-cols-2 gap-4 mb-3">
                    <div class="">
                        <InputLabel for="name" value="Full Name(s)" />
                        <TextInput 
                            id="name" 
                            type="text" 
                            :class="inputClasses" 
                            v-model="form.name" 
                            required />
                        <InputError class="mt-2" :message="form.errors.name" />
                    </div>
                    <div class="">
                        <InputLabel for="email" value="Email Address" />
                        <TextInput 
                            id="email" 
                            type="email" 
                            :class="inputClasses" 
                            v-model="form.email" 
                            required />
                        <InputError class="mt-2" :message="form.errors.email" />
                    </div>
                </div>
                
                <div class="md:grid grid-cols-2 gap-4 mb-3">
                    <div class="">
                        <InputLabel for="title" value="Title" />
                        <select name="title" id="title" 
                                :class="inputClasses" 
                                v-model="selectedTitle" 
                                @change="chooseTitle(selectedTitle)"
                                >
                            <option v-for="(title, index) in titles" 
                                    :key="index" 
                                    :value="title"
                                    >
                                    {{ title }}
                            </option>
                        </select>
                        <InputError class="mt-2" :message="form.errors.title" />
                    </div>
                    <div class="">
                        <InputLabel for="image" value="Profile Image" />
                        <input 
                            class="form-file-input"
                            type="file" 
                            id="image"
                            @input="form.image = $event.target.files[0]" 
                        >
                        <InputError class="mt-2" :message="form.errors.image" />
                    </div>
                </div>
                
        
                <div class="mb-3">
                    <InputLabel for="description" value="About" />
                    <CKEditor :editor="ClassicEditor" v-model="form.description" :config="editorConfig"></CKEditor>
                    <InputError class="mt-2" :message="form.errors.description" />
                </div>


                <div class="mb-3">
                    <InputLabel for="job_title" value="Job Title" />
                    <TextInput 
                        id="job_title" 
                        type="text" 
                        :class="inputClasses" 
                        v-model="form.job_titles" 
                        placeholder = ""
                        />
                    <InputError class="mt-2" :message="form.errors.job_titles" />
                </div>

                <div class="flex gap-2">
                    <PrimaryButton 
                        :class="[form.processing ? 'opacity-25' : btnClasses]"
                        @click="submit"
                        :disabled="form.processing"
                        >
                            Submit
                    </PrimaryButton>
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
    </Modal>

</template>