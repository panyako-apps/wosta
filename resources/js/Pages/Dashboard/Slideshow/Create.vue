<script setup>
import { useForm, router } from "@inertiajs/vue3";
import Modal from "@/Components/Modal.vue";
import { ref } from 'vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
import {component as CKEditor} from '@ckeditor/ckeditor5-vue';
import Spinner from '@/Components/spinners/Spinner.vue';

const btnClasses = 'bg-sky-600 hover:bg-sky-500 text-white font-bold text-sm px-4 py-2 rounded-full h-8 my-auto flex items-center';
const btnCloseClasses = 'bg-rose-600 hover:bg-rose-500 text-white font-bold text-sm px-4 py-2 rounded-full h-8 my-auto flex items-center';
const inputClasses = 'block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm'


const form = useForm({
    name: '',
    position: '',
    description: '',
})


const show = ref(false);
const selectedPosition = ref();

const toggleModal = () =>{
    show.value = !show.value
}


const inProgress = ref(false);

function submit() {
    
    inProgress.value= true;

    router.post(route('admin.slideshow.store'),{
        name: form.name,
        position: selectedPosition.value.name,
        description: selectedPosition.value.description,
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


const positions = [
    {
        name: 'homepage-hero-section',
        description: 'Will be placed at the home page, Hero section.'
    },
    {
        name: 'homepage-mid-section',
        description: 'Will be placed at the mid section of the home page.'
    },
    {
        name: 'aboutus-hero-section',
        description: 'Will be placed at the about us page, Hero section.'
    },
    {
        name: 'aboutus-mid-section',
        description: 'Will be placed at the mid section of the about us page.'
    },
];


</script>

<template>

    <div>
        <button 
            @click="toggleModal"
            :class="btnClasses"
            >
            Add Slideshow
        </button>
    </div>

    <Modal :show="show" :closeable="true">
        
        <div class="pt-4 px-6 border-b pb-2">
            <h4 class="uppercase text-blue-600 font-bold">Create New Slideshow</h4>
        </div>


        <div v-if="inProgress" class="p-6 h-36 flex justify-center items-center">
            <Spinner :has-text="true"/>
        </div>

        <div v-if="!inProgress" class="p-6">
            <form @submit.prevent="submit">

                <div class="mb-3">
                    <InputLabel for="name" value="Slideshow Name" />
                    <TextInput 
                        id="name" 
                        type="text" 
                        :class="inputClasses" 
                        v-model="form.name" 
                        placeholder="Title "
                        required />
                    <InputError class="mt-2" :message="form.errors.name" />
                </div>

                <div class="mb-3">
                    <InputLabel for="position" value="position" />
                    <select name="position" id="position" 
                            :class="inputClasses" 
                            v-model="selectedPosition" 
                            >
                        <option v-for="(position, index) in positions" 
                                :key="index" 
                                :value="position"
                                >
                                {{ position.name }}
                        </option>
                    </select>
                    <InputError class="mt-2" :message="form.errors.position" />
                </div>


                <div class="flex gap-2">
                    <button 
                        :class="[form.processing ? 'opacity-25' : btnClasses]"
                        @click="submit"
                        :disabled="form.processing"
                        >
                            Submit
                    </button>
                    <button 
                            type="button" 
                            :class="btnCloseClasses"
                            @click="toggleModal"
                            >
                            Close
                    </button>
                </div>
            </form>
        </div>
    </Modal>

</template>
