<script setup>
import { useForm, router } from "@inertiajs/vue3";
import Modal from "@/Components/Modal.vue";
import { ref } from 'vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import Spinner from '@/Components/spinners/Spinner.vue';
import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
import {component as CKEditor} from '@ckeditor/ckeditor5-vue';


const props = defineProps({
    categories: Array,
})

const btnClasses = 'rounded border border-transparent bg-blue-600 px-3 py-1 text-sm text-white shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2';
const btnCloseClasses = 'rounded border border-transparent bg-red-600 px-3 py-1 text-sm text-white shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2';
const inputClasses = 'block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm'


const selectedCategory = ref();


const form = useForm({
    name: '',
    image: '',
    description: '',
})


const show = ref(false);

const toggleModal = () =>{
    show.value = !show.value
}

const inProgress = ref(false);

function submit() {
    
    inProgress.value= true;

    router.post(route('admin.postcategory.store'),{
        name: form.name,
        image: form.image,
        description: form.description,
        parent_id: selectedCategory.value,
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


const editorConfig = [];


</script>

<template>

    <div>
        <button 
            @click="toggleModal"
            :class="btnClasses"
            >
            <font-awesome-icon icon="fa-plus-circle"></font-awesome-icon>
            Add Category
        </button>
    </div>

    <Modal :show="show" :closeable="true">
        <div class="pt-4 px-6 border-b pb-2">
            <h4 class="uppercase text-blue-600 font-bold">Create Post Category.</h4>
        </div>

        <div v-if="inProgress" class="p-6 h-36 flex justify-center items-center">
            <Spinner :has-text="true"/>
        </div>

        <div v-if="!inProgress" class="p-6">
            <form @submit.prevent="submit">

                <div class="mb-3">
                    <InputLabel for="name" value="Category Name *" />
                    <TextInput 
                        id="name" 
                        type="text" 
                        :class="inputClasses" 
                        v-model="form.name" 
                        placeholder="Name"
                        required />
                    <InputError class="mt-2" :message="form.errors.name" />
                </div>

                <div class="md:grid grid-cols-2 gap-4 mb-3">
                    <div class="">
                        <InputLabel for="category" value="Parent Category" />
                        <select name="category" id="category" 
                                :class="inputClasses" 
                                v-model="selectedCategory" 
                                >
                            <option v-for="(category, index) in categories" 
                                    :key="index" 
                                    :value="category.id"
                                    >
                                    {{ category.name }}
                            </option>
                        </select>
                        <InputError class="mt-2" :message="form.errors.title" />
                    </div>
                    <div class="">
                        <InputLabel for="image" value="Icon Image" />
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
                    <InputLabel for="description" value="Product Description " />
                    <CKEditor :editor="ClassicEditor" v-model="form.description" :config="editorConfig"></CKEditor>
                    <InputError class="mt-2" :message="form.errors.description" />
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
