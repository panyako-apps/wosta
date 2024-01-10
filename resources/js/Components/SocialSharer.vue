<template>

<Dropdown align="right" width="48" :show-above="displayAbove">
    <template #trigger>
        <button class="text-slate-500 hover:text-blue-600 transition-all duration-200 flex items-center gap-1">
            <font-awesome-icon icon="fa-share"></font-awesome-icon>
            <span> Share {{ text }}</span>
        </button>
    </template>


    <template #content>
        <div class="rounded-md overflow-hidden">
            <div v-for="(link, index) in props.links" :key="index">
                <a :href="link" target="_blank" 
                    class="w-full block uppercase py-2 text-sm
                    transition-all duration-200 
                    px-2 font-bold mb-1 hover:pl-5"
                    :class="[
                        {'hover:text-blue-400 bg-blue-400 hover:bg-slate-100 text-white':index==='facebook'},
                        {'hover:text-blue-500 bg-blue-500 hover:bg-slate-100 text-white':index==='twitter'},
                        {'hover:text-teal-500 bg-teal-500 hover:bg-slate-100 text-white':index==='whatsapp'},
                        {'hover:text-blue-500 bg-blue-500 hover:bg-slate-100 text-white':index==='telegram'},
                        {'hover:text-blue-600 bg-blue-600 hover:bg-slate-100 text-white':index==='linkedin'}
                        ]"
                        >

                        <font-awesome-icon v-if="index==='facebook'" icon="fab fa-facebook"></font-awesome-icon>                                                               
                        <font-awesome-icon v-if="index==='twitter'" icon="fab fa-twitter"></font-awesome-icon>                                                               
                        <font-awesome-icon v-if="index==='whatsapp'" icon="fab fa-whatsapp"></font-awesome-icon>                                                               
                        <font-awesome-icon v-if="index==='linkedin'" icon="fab fa-linkedin"></font-awesome-icon>    
                        <font-awesome-icon v-if="index==='telegram'" icon="fab fa-telegram"></font-awesome-icon>    
                        {{ index }}
                    </a>
            </div>
        </div>
    </template>
</Dropdown>

</template>

<script setup>
import Dropdown from '@/Components/Dropdown.vue'

const props = defineProps({
    links: [Array, Object],
    text: {
        type: String, 
    },
    displayAbove: {
        type: Boolean,
        default: false,
    } 
});
</script>

<style>

</style>