<template>
    <div @click="toggleModal" class="bg-primary w-36 h-36 shrink-0 rounded-md cursor-pointer">
        <div class="h-20 flex items-center justify-center">
            <font-awesome-icon icon="fa-play" class="text-3xl text-secondary"></font-awesome-icon>
        </div>
        <div class="border-b border-b-secondary border-opacity-60 w-3/4 mx-auto" />
        <p class="text-white font-bold text-center px-6 pt-2">Watch The Video</p>
    </div>


    <Modal :show="show" closeable :max-width="'3xl'">
        <div class="p-2 bg-gradient-to-br from-primary to-secondary via-white relative">
            <div class="w-full h-[30rem] rounded overflow-hidden bg-black">
                <iframe class="w-full h-full object-cover" src="https://www.youtube.com/embed/9BkJXXGdawE?si=UgeCwDxtumHtITAS" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
            </div>
            <button @click="toggleModal" class="h-8 w-8 rounded-full bg-secondary text-white absolute bottom-0 right-0 flex items-center justify-center">
                <font-awesome-icon icon="close"></font-awesome-icon>
            </button>
        </div>
    </Modal>

</template>

<script setup>
import Modal from '@/Components/Modal.vue'
import { ref } from 'vue'

const show = ref(false)

const toggleModal = () => {
    show.value = !show.value
}
</script>

