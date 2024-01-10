<template>
    <img @click="imagePreview" :src="url" alt="" class="w-full">
    <Modal :show="show" @close="imagePreview">
        <div class="p-4">
            <img :src="url" alt="" class="mx-auto" id="image">
        </div>
    </Modal>
</template>

<script setup>
import Modal from '@/Components/Modal.vue'
import { onMounted, ref } from 'vue';
const props = defineProps({
    url: String,
});

const show = ref(false);

const imagePreview = ()=>{
    show.value = !show.value
}

</script>