<script setup>
import { useForm } from "@inertiajs/vue3";
import Modal from "@/Components/Modal.vue";
import { ref } from 'vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
import {component as CKEditor} from '@ckeditor/ckeditor5-vue';
import { router } from "@inertiajs/vue3";

const btnClasses = 'rounded border border-transparent bg-blue-600 px-3 py-1 text-sm text-white shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2';
const btnCloseClasses = 'rounded border border-transparent bg-red-600 px-3 py-1 text-sm text-white shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2';
const inputClasses = 'block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm'


const form = useForm({
    name: null,
    title1: null,
    description1: ref(),
    image1: null,
    title2: null,
    description2: ref(),
    image2: null,
    title3: null,
    description3: ref(),
    image3: null,

})

const show = ref(false);

const toggleModal = () =>{
    show.value = !show.value
}

const editorConfig = [];

function submit() {
    router.post(route('admin.page.store'),{
        name: form.name,
        title1: form.title1,
        description1: form.description1,
        image1: form.image1,
        title2: form.title2,
        description2: form.description2,
        image2: form.image2,
        title3: form.title3,
        description3: form.description3,
        image3: form.image3,
    },
    {
        onSuccess: ()=>{
            toggleModal();
        },
        preserveScroll: true,
    });

}

</script>

<template>

    <div>
        <button 
            @click="toggleModal"
            class="bg-secondary hover:bg-primary text-white px-4 py-1.5 rounded-full transition-all duration-500 ease-linear"
            >
            Add New Page
        </button>
    </div>

    <Modal :show="show" :closeable="true">
        <div class="p-6">
            <form @submit.prevent="submit">

                <div class="mb-3">
                    <div class="">
                        <InputLabel for="name" value="Page Name" />
                        <TextInput 
                            id="name" 
                            type="text" 
                            :class="inputClasses" 
                            v-model="form.name" 
                            required />
                        <InputError class="mt-2" :message="form.errors.name" />
                    </div>
                </div>

                <div class="md:grid grid-cols-2 gap-4 mb-3">
                    <div class="">
                        <InputLabel for="title1" value="Page title1" />
                        <TextInput 
                            id="title1" 
                            type="text" 
                            :class="inputClasses" 
                            v-model="form.title1" 
                            required />
                        <InputError class="mt-2" :message="form.errors.title1" />
                    </div>
                    <div class="">
                        <InputLabel for="image1" value="Profile Image1" />
                        <input 
                            class="form-file-input"
                            type="file" 
                            id="image1"
                            @input="form.image1 = $event.target.files[0]" 
                        >
                        <InputError class="mt-2" :message="form.errors.image1" />
                    </div>
                </div>
                <div class="mb-3">
                    <InputLabel for="description1" value="About" />
                    <CKEditor :editor="ClassicEditor" v-model="form.description1" :config="editorConfig"></CKEditor>
                    <InputError class="mt-2" :message="form.errors.description1" />
                </div>


                <div class="md:grid grid-cols-2 gap-4 mb-3">
                    <div class="">
                        <InputLabel for="title2" value="Page title2" />
                        <TextInput 
                            id="title2" 
                            type="text" 
                            :class="inputClasses" 
                            v-model="form.title2" 
                            required />
                        <InputError class="mt-2" :message="form.errors.title2" />
                    </div>
                    <div class="">
                        <InputLabel for="image2" value="Profile Image2" />
                        <input 
                            class="form-file-input"
                            type="file" 
                            id="image2"
                            @input="form.image2 = $event.target.files[0]" 
                        >
                        <InputError class="mt-2" :message="form.errors.image2" />
                    </div>
                </div>
                <div class="mb-3">
                    <InputLabel for="description2" value="About" />
                    <CKEditor :editor="ClassicEditor" v-model="form.description2" :config="editorConfig"></CKEditor>
                    <InputError class="mt-2" :message="form.errors.description2" />
                </div>


                <div class="md:grid grid-cols-2 gap-4 mb-3">
                    <div class="">
                        <InputLabel for="title3" value="Page title3" />
                        <TextInput 
                            id="title3" 
                            type="text" 
                            :class="inputClasses" 
                            v-model="form.title3" 
                            required />
                        <InputError class="mt-2" :message="form.errors.title3" />
                    </div>
                    <div class="">
                        <InputLabel for="image3" value="Profile Image3" />
                        <input 
                            class="form-file-input"
                            type="file" 
                            id="image3"
                            @input="form.image3 = $event.target.files[0]" 
                        >
                        <InputError class="mt-2" :message="form.errors.image3" />
                    </div>
                </div>
                <div class="mb-3">
                    <InputLabel for="description3" value="About" />
                    <CKEditor :editor="ClassicEditor" v-model="form.description3" :config="editorConfig"></CKEditor>
                    <InputError class="mt-2" :message="form.errors.description3" />
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
                            class="shrink-0"
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

// "@ckeditor/ckeditor5-build-classic": "^38.1.1",
// "@ckeditor/ckeditor5-html-embed": "^38.1.1",
// "@ckeditor/ckeditor5-vue": "^5.1.0",