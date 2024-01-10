<template>
    <div class="relative h-full">
        <img @click="imagePreview" :src="url" alt="" class="w-full h-full object-cover">
    </div>
    <Modal :show="show" @close="imagePreview" :max-width="'6xl'">
        <div class="p-4 relative">
            <img :src="url" alt="" class="mx-auto max-h-[760px] aspect-auto" id="image">
            <div class="absolute top-4 right-4">
                <button class="h-6 w-6 flex items-center justify-center text-white rounded-full bg-rose-700 hover:bg-red-600 transition-all duration-200 ease-in-out"
                @click="toggleModal"
                >
                    <font-awesome-icon icon="fa-close"></font-awesome-icon>
                </button>
            </div>
        </div>
    </Modal>
</template>

<script setup>
import Modal from '@/Components/Modal.vue'
import { ref } from 'vue';
const props = defineProps({
    url: String,
});

const show = ref(false);
const showToolTip = ref(false);

const imagePreview = ()=>{
    show.value = !show.value
}

const toggleModal = ()=>{
    show.value = !show.value
}

</script>