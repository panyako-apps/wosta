<script setup>
import { computed, onMounted, ref } from 'vue';
import { useForm } from "@inertiajs/vue3";
import Modal from "@/Components/Modal.vue";
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { router } from "@inertiajs/vue3";
import ListItem from '@/Components/ListItem.vue'

import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
import {component as CKEditor} from '@ckeditor/ckeditor5-vue';

const props = defineProps({
    section: Object,
    pageId: Number,
});

const btnClasses = 'rounded border border-transparent bg-blue-600 px-3 py-1 text-sm text-white shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2';
const btnCloseClasses = 'rounded border border-transparent bg-rose-600 px-3 py-1 text-sm text-white shadow-sm hover:bg-rose-700 focus:outline-none focus:ring-2 focus:ring-rose-500 focus:ring-offset-2';
const inputClasses = 'block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm'
const primaryLinkClasses = 'px-3 py-1 text-gray-600 hover:bg-blue-600 hover:text-white rounded hover:shadow-md transition-all duration-200 mb-1 text-left';


const form = useForm({
    title: props.section.title,
    intro: props.section.intro,
    description: props.section.description,

})

const show = ref(false);

const toggleModal = () =>{
    show.value = !show.value
}

const editorConfig = [{
}];

const sectionPoints = ref(props.section.points || [])
const newPoint = ref('')

function submit() {
    router.put(route('admin.page.section.update'),{
        pageId: props.pageId,
        sectionName: props.section.name,
        title: form.title,
        intro: form.intro,
        description: form.description,
        points: sectionPoints.value
    },
    {
        onSuccess: ()=>{
            toggleModal();
        },
        preserveScroll: true,
    });

}

const addPoint = (point) =>{
    sectionPoints.value.push(point)
}

const removePoint = (point) =>{
    const newPoints = sectionPoints.value.filter(item => item !==point)
    sectionPoints.value = newPoints;
}

</script>

<template>

    <div>
        <button 
            @click="toggleModal"
            class="hover:text-secondary"
            >
            <font-awesome-icon icon="fa-edit"></font-awesome-icon>
            Edit Section
        </button>
    </div>

    <Modal :show="show" :closeable="true" :max-width="'4xl'">
        <div class="p-6 ">
            <h3 class="font-bold uppercase mb-3 text-primary border-b border-slate-300 pb-3">Edit Section</h3>
            <form @submit.prevent="submit">
                <div class="md:h-[80vh] overflow-y-scroll customscroll pr-3">
                    <div class="mb-3">
                        <div class="">
                            <InputLabel for="title" value="Section Title" />
                            <TextInput 
                                id="title" 
                                type="text" 
                                :class="inputClasses" 
                                v-model="form.title" 
                                />
                            <InputError class="mt-2" :message="form.errors.title" />
                        </div>
                    </div>
                    <div class="mb-3">
                        <InputLabel for="intro" value="Intro" />
                        <TextInput 
                            id="intro" 
                            type="text" 
                            :class="inputClasses" 
                            v-model="form.intro" 
                            />
                        <InputError class="mt-2" :message="form.errors.intro" />
                    </div>
                    <div class="mb-3">
                        <InputLabel for="description" value="Description" />
                        <CKEditor :editor="ClassicEditor" v-model="form.description" :config="editorConfig"></CKEditor>
                        <InputError class="mt-2" :message="form.errors.description" />
                    </div>
                   
                    <div class="flex gap-4 mb-3 items-center">
                        <div class="overflow-hidden rounded shadow-sm w-48 h-28 bg-slate-300">
                            <img :src="section.image" alt="" class="w-full">
                        </div>
                        
                        <div class=" grow">
                            <InputLabel for="image" value="Section Image" />
                            <input 
                                class="form-file-input"
                                type="file" 
                                id="image"
                                @input="form.image = $event.target.files[0]" 
                            >
                            <InputError class="mt-2" :message="form.errors.image" />
                        </div>
                    </div>

                    <div class="mb-6">
                        <div v-for="point in sectionPoints" :key="point" class="flex justify-between items-center gap-4 ">
                            <ListItem :text="point"/>
                            <button type="button" @click="removePoint(point)" class="bg-secondary hover:bg-primary text-white px-4 py-1.5 rounded-full transition-all duration-500 ease-linear">
                                <font-awesome-icon icon="fa-minus"></font-awesome-icon>
                            </button>
                        </div>
                    </div>

                    <div class="mb-6">
                        <InputLabel for="point" value="Add a Point" />
                        <div class="flex justify-between items-center gap-4">
                            <TextInput 
                                id="point" 
                                type="text" 
                                :class="inputClasses" 
                                v-model="newPoint" 
                                />
                                <button type="button" @click="addPoint(newPoint)" class="bg-primary hover:bg-secondary text-white px-4 py-1.5 rounded-full transition-all duration-500 ease-linear">
                                    <font-awesome-icon icon="fa-plus"></font-awesome-icon>
                                </button>
                        </div>
                    </div>
                </div>
                
                <div class="flex gap-2">
                    <PrimaryButton 
                        :class="[form.processing ? 'opacity-25' : btnClasses]"
                        @click="submit"
                        :disabled="form.processing"
                        >
                            Save Changes
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