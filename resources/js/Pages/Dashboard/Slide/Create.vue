<script setup>
import { useForm, router } from "@inertiajs/vue3";
import Modal from "@/Components/Modal.vue";
import { ref } from 'vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import Spinner from '@/Components/spinners/Spinner.vue';

const btnClasses = 'bg-sky-600 hover:bg-sky-500 text-white font-bold text-sm px-4 py-2 rounded-full h-8 my-auto flex items-center';
const btnCloseClasses = 'bg-rose-600 hover:bg-rose-500 text-white font-bold text-sm px-4 py-2 rounded-full h-8 my-auto flex items-center';
const inputClasses = 'block w-full rounded-md border-gray-300 shadow-sm focus:border-sky-500 focus:ring-sky-500 sm:text-sm'

const props = defineProps({
    slideshow: [Object],
});

const form = useForm({
    title: '',
    description: '',
    image: '',
})


const show = ref(false);

const toggleModal = () =>{
    show.value = !show.value
}


const inProgress = ref(false);

function submit() {
    
    inProgress.value= true;

    router.post(route('admin.slide.store'),{
        title: form.title,
        slideshow_id: props.slideshow.id,
        description: form.description,
        image: form.image,
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
            Add Slide
        </button>
    </div>

    <Modal :show="show" :closeable="true">
        <div class="pt-4 px-6 border-b pb-2">
            <h4 class="uppercase text-sky-600 font-bold">Add New Slide to  the Slideshow</h4>
        </div>


        <div v-if="inProgress" class="p-6 h-36 flex justify-center items-center">
            <Spinner :has-text="true"/>
        </div>

        <div v-if="!inProgress" class="p-6">
            <form @submit.prevent="submit">

                <div class="mb-3">
                    <InputLabel for="title" value="Slide Title" />
                    <TextInput 
                        id="title" 
                        type="text" 
                        :class="inputClasses" 
                        v-model="form.title" 
                        placeholder="Title "
                        required />
                    <InputError class="mt-2" :message="form.errors.title" />
                </div>

                <div class="">
                    <InputLabel for="image" value="Slide Image" />
                    <input 
                    class="form-file-input"
                    type="file" 
                    id="image"
                    @input="form.image = $event.target.files[0]" 
                    >
                    <InputError class="mt-2" :message="form.errors.image" />
                </div>

                <div class="mb-3">
                    <InputLabel for="description" value="Slide Description" />
                    <textarea v-model="form.description" :class="inputClasses"></textarea>
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
