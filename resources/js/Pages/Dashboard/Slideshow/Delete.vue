<script setup>
import Modal from "@/Components/Modal.vue";
import { ref } from 'vue';
import { router } from "@inertiajs/vue3";
import Spinner from '@/Components/spinners/Spinner.vue';


const props = defineProps({
    slideshow: {
        type: Object, 
        required: true,
    }
})

const btnClasses = 'rounded border border-transparent bg-blue-600 px-3 py-1 text-sm text-white shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2';
const btnCloseClasses = 'rounded border border-transparent bg-red-600 px-3 py-1 text-sm text-white shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2';
const primaryLinkClasses = 'px-3 py-1 text-gray-600 hover:bg-red-600 hover:text-white rounded hover:shadow-md transition-all duration-200 mb-1 w-full text-left';

const inProgress = ref(false);

function deleteProduct() {

    inProgress.value= true;

    router.post(route('admin.slideshow.destroy', props.slideshow.id),
        {
            _method: 'delete'
        }, 
        {
            onSuccess: ()=>{
                toggleModal();
                inProgress.value = false;
            },
            preserveScroll: true,
        }
    );


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
            class="block w-full mb-1"
            >
            <font-awesome-icon icon="fa-trash-alt"></font-awesome-icon>
            Delete
        </button>
    </div>

    <Modal :show="show" :closeable="true">

        <div v-if="inProgress" class="p-6 h-36 flex justify-center items-center">
            <Spinner :has-text="true"/>
        </div>


        <div v-if="!inProgress" class="p-6">
            <div class="flex gap-4 items-center mb-6">
                <h2 class="text-red-600">Are you sure ?</h2>
            </div>
             
            <div class="flex gap-2">
                <button 
                    type="button"
                    :class="btnCloseClasses"
                    @click="deleteProduct"
                    >
                        <font-awesome-icon icon="fa-trash-alt"></font-awesome-icon>
                        Ok, Delete
                </button>
                <button 
                    type="button" 
                    :class="btnClasses"
                    @click="toggleModal"
                    >
                    No, Go Back
            </button>
            </div>
        </div>
    </Modal>

</template>