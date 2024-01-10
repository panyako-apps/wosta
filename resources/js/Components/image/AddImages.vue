<script setup>
import { useForm } from "@inertiajs/vue3";
import Modal from "@/Components/Modal.vue";
import { ref } from 'vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import Spinner from "@/Components/spinners/Spinner.vue";

const props = defineProps({
    model: {
        type: Object, 
        required: true,
    },
    customroute: {
        type: String,
    }
})
const emits = defineEmits([
    'imagesuploaded'
]);

const btnClasses = 'rounded border border-transparent bg-blue-600 px-3 py-1 text-sm text-white shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2';
const btnCloseClasses = 'rounded border border-transparent bg-red-600 px-3 py-1 text-sm text-white shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2';
const primaryLinkClasses = 'px-3 py-1 text-gray-600 hover:bg-blue-600 hover:text-white rounded hover:shadow-md transition-all duration-200 mb-1 w-full text-left';

const form = useForm({
    images: null,
    id: props.model.id,
})
const inProgress = ref(false);

function submit() {
    form.post(route(props.customroute), {
        onSuccess: ()=>{
            toggleModal();
            inProgress.value = false;
            emits('imagesuploaded');
        },
        onProgress: ()=>{
            inProgress.value = true;
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
            <font-awesome-icon icon="fa-images"></font-awesome-icon>
            Add Images
        </button>
    </div>

    <Modal :show="show" :closeable="true">
        <div v-if="inProgress" class="p-6 h-36 flex justify-center items-center">
            <Spinner :has-text="true" :text="'Uploading Images...'"/>
        </div>
        <div v-show="!inProgress" class="p-6">
            <form @submit.prevent="submit">
              <div class="mb-3">
                  <InputLabel for="images" value="Product Images" />
                  <input 
                      class="form-file-input"
                      type="file" 
                      id="images"
                      multiple
                      @input="form.images = $event.target.files" 
                  >
                  <InputError class="mt-2" :message="form.errors.images" />
              </div>

              <div class="flex gap-2">
                  <PrimaryButton 
                      :class="[form.processing ? 'opacity-25' : btnClasses]"
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

            <div class="rounded-md border border-dashed border-blue-500 mt-6 h-36">
                <div class="flex justify-center items-center h-full text-blue-600 ">
                    <div class="text-center">
                        <font-awesome-icon icon="fa-images"></font-awesome-icon>
                        <p>Drag & Drop Images Here</p>
                    </div>
                    
                </div>
            </div>
        </div>
    </Modal>

</template>