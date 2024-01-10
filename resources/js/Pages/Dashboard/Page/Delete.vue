<script setup>
import Modal from "@/Components/Modal.vue";
import { ref } from 'vue';
import { router } from "@inertiajs/vue3";

const props = defineProps({
    parampage: {
        type: Object, 
        required: true,
    }
})

const btnClasses = 'rounded border border-transparent bg-blue-600 px-3 py-1 text-sm text-white shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2';

const btnCloseClasses = 'rounded border border-transparent bg-red-600 px-3 py-1 text-sm text-white shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2';
const primaryLinkClasses = 'px-3 py-1 text-gray-600 hover:bg-red-600 hover:text-white rounded hover:shadow-md transition-all duration-200 mb-1 w-full text-left';


function submit() {
    router.post(route("admin.page.destroy", props.parampage.id),{
        _method: 'delete',
    });
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
            <font-awesome-icon icon="fa-trash-alt"></font-awesome-icon>
            Delete
        </button>
    </div>

    <Modal :show="show" :closeable="true">
        <div class="p-6">
            <div class="flex gap-4 items-center mb-6">
                <div class="h-24">
                    <img :src="parampage.image" class="h-full" >
                </div>
                <div class="grow">
                    <h3 class="uppercase font-bold text-blue-800">{{ parampage.name }}</h3>
                    <h2 class="text-red-600">Are you sure you want to DELETE this page?</h2>
                </div>
            </div>

            <div class="flex gap-2">
                <button 
                    type="button"
                    :class="btnCloseClasses"
                    @click="submit"
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