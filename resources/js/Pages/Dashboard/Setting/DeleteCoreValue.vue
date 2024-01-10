<script setup>
import Modal from "@/Components/Modal.vue";
import { ref } from 'vue';
import { router } from "@inertiajs/vue3";
import Spinner from '@/Components/spinners/Spinner.vue';


const props = defineProps({
    corevalue: {
        type: Object, 
        required: true,
    }
})

const btnClasses = 'bg-sky-600 hover:bg-sky-500 text-white font-bold text-sm px-4 py-2 rounded-full';
const btnCloseClasses = 'bg-rose-600 hover:bg-rose-500 text-white font-bold text-sm px-4 py-2 rounded-full';

const inProgress = ref(false);

function deleteCoreValue() {

    inProgress.value= true;

    router.post(route('admin.corevalue.destroy', props.corevalue.id),
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
            class=""
            >
            <font-awesome-icon icon="fa-trash-alt"></font-awesome-icon>
        </button>
    </div>

    <Modal :show="show" :closeable="true">

        <div v-if="inProgress" class="p-6 h-36 flex justify-center items-center">
            <Spinner :has-text="true"/>
        </div>

        <div v-if="!inProgress" class="p-6">
            <div class="flex gap-4 items-center mb-6">
                <h2 class="text-red-600">Are you sure you want to DELETE this?</h2>
            </div>

            <div class="flex gap-2">
                <button 
                    type="button"
                    :class="btnCloseClasses"
                    @click="deleteCoreValue"
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