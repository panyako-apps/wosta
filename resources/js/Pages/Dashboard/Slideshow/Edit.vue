<script setup>
import { ref } from 'vue';
import { useForm, router } from "@inertiajs/vue3";
import Modal from "@/Components/Modal.vue";
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import Spinner from '@/Components/spinners/Spinner.vue';

const props = defineProps({
    slideshow: {
        type: [Object, Array], 
    }, 
})


const btnClasses = 'bg-sky-600 hover:bg-sky-500 text-white font-bold text-sm px-4 py-2 rounded-full h-8 my-auto flex items-center';
const btnCloseClasses = 'bg-rose-600 hover:bg-rose-500 text-white font-bold text-sm px-4 py-2 rounded-full h-8 my-auto flex items-center';
const inputClasses = 'block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm'
const primaryLinkClasses = 'px-3 py-1 text-gray-600 hover:bg-blue-600 hover:text-white rounded hover:shadow-md transition-all duration-200 mb-1 w-full text-left';


const form = useForm({
    name: props.slideshow.name ? props.slideshow.name : '',
    position: props.slideshow.position ? props.slideshow.position : '',
})


const show = ref(false);
const selectedPosition = ref();

const toggleModal = () =>{
    show.value = !show.value
}


const inProgress = ref(false);

function submit() {

    inProgress.value= true;

    router.post(route('admin.slideshow.update', props.slideshow.id),{
        _method: 'put',
        name: form.name,
        position: selectedPosition.value.name,
    },
    {
        onSuccess: ()=>{
            toggleModal();
            inProgress.value = false;
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
            :class="primaryLinkClasses"
            >
            <font-awesome-icon icon="fa-edit"></font-awesome-icon>
            Edit
        </button>
    </div>

    <Modal :show="show" :closeable="true">

        <div class="pt-4 px-6 border-b pb-2">
            <h4 class="uppercase text-blue-600 font-bold">Edit Slideshow.</h4>
        </div>

        <div v-if="inProgress" class="p-6 h-36 flex justify-center items-center">
            <Spinner :has-text="true"/>
        </div>

        <div v-if="!inProgress" class="p-6">
           
            <form @submit.prevent="submit">

                <div class="mb-3">
                    <InputLabel for="name" value="Name" />
                    <TextInput 
                        id="name" 
                        type="text" 
                        :class="inputClasses" 
                        v-model="form.name" 
                        placeholder="Name"
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
                    <InputError class="mt-2" :message="form.errors.title" />
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
                            <font-awesome-icon icon="fa-times"></font-awesome-icon>
                            Close
                    </button>
                </div>
            </form>
        </div>
    </Modal>

</template>
