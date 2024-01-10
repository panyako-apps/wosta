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

const props = defineProps({
    corevalue: [Object, Array],
})

const btnClasses = 'bg-sky-600 hover:bg-sky-500 text-white font-bold text-sm px-4 py-2 rounded-full';
const btnCloseClasses = 'bg-rose-600 hover:bg-rose-500 text-white font-bold text-sm px-4 py-2 rounded-full';
const inputClasses = 'block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm'


const form = useForm({
    title: props.corevalue.title,
    description: props.corevalue.description,
})


const show = ref(false);

const toggleModal = () =>{
    show.value = !show.value
}

const editorConfig = [];

const inProgress = ref(false);

function submit() {
    
    inProgress.value= true;

    router.post(route('admin.corevalue.update', props.corevalue.id),{
        _method: 'put',
        title: form.title,
        description: form.description,
    },
    {
        onSuccess: ()=>{
            toggleModal();
            inProgress.value = false;
            form.reset();
            location.reload()
        },
        preserveScroll: true,
    });

}

</script>

<template>

    <div>
        <button 
            @click="toggleModal"
            >
            <font-awesome-icon icon="fa-edit"></font-awesome-icon>
        </button>
    </div>

    <Modal :show="show" :closeable="true">
        <div class="pt-4 px-6 border-b pb-2">
            <h4 class="uppercase text-blue-600 font-bold">Edit Core Value.</h4>
        </div>
        
        <div v-if="inProgress" class="p-6 h-36 flex justify-center items-center">
            <Spinner :has-text="true"/>
        </div>

        <div v-if="!inProgress" class="p-6">
            <form @submit.prevent="submit">

                <div class="mb-3">
                    <InputLabel for="title" value="Post Title" />
                    <TextInput 
                        id="title" 
                        type="text" 
                        :class="inputClasses" 
                        v-model="form.title" 
                        placeholder="Title"
                        required />
                    <InputError class="mt-2" :message="form.errors.title" />
                </div>
        
                <div class="mb-3">
                    <InputLabel for="description" value="Post Body" />
                    <CKEditor :editor="ClassicEditor" v-model="form.description" :config="editorConfig"></CKEditor>
                    <InputError class="mt-2" :message="form.errors.description" />
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
