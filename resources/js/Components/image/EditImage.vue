<script setup>
import { useForm, router } from "@inertiajs/vue3";
import Modal from "@/Components/Modal.vue";
import { ref } from 'vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextArea from "@/Components/TextArea.vue";


const props = defineProps({
    image: {
        type: Object, 
        required: true,
    },
    customroute: {
        type: String,
    }
})

const btnClasses = 'rounded border border-transparent bg-blue-600 px-3 py-1 text-sm text-white shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2';
const btnCloseClasses = 'rounded border border-transparent bg-red-600 px-3 py-1 text-sm text-white shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2';
const inputClasses = 'mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm'
const primaryLinkClasses = 'px-2 py-1 text-white bg-blue-600 hover:bg-blue-700 rounded transition-all duration-200 text-xs';

const form = useForm({
    title: props.image.title,
    description: props.image.description,
    image: null,
})

function submit() {
    router.post(route(props.customroute, props.image.id), {
        _method: 'put', 
        title: form.title,
        description: form.description,
        image: form.image,
    }, 
    {
        onSuccess: ()=>{
            toggleModal();
            location.reload()
        }, 
        preserveScroll: true,
    })

}

const show = ref(false);

const toggleModal = () =>{
    show.value = !show.value
}


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
        <div class="p-6">
            <form @submit.prevent="submit">
              
                <div class="mb-3">
                    <InputLabel for="title" value="Image Title" />
                    <TextInput 
                        id="title" 
                        type="text" 
                        :class="inputClasses" 
                        v-model="form.title" 
                        />
                    <InputError class="mt-2" :message="form.errors.title" />
                </div>

                <div class="mb-3">
                    <InputLabel for="description" value="Description" />
                    <TextArea 
                        name="description" 
                        id="description" 
                        :class="inputClasses"                    
                        v-model="form.description"
                        placeholder="Image Description"
                    ></TextArea>
                </div>
      
                <div class="flex gap-4 items-center mb-6">
                    <div class="h-24">
                        <img :src="image.url" class="h-full" >
                    </div>
                    <div class="grow">
                        <InputLabel for="image" value="Change Image" />
                        <input 
                            class="form-file-input"
                            type="file" 
                            id="image"
                            @input="form.image = $event.target.files[0]" 
                        >
                    </div>
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