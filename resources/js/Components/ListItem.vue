<template>
    <div class="group flex gap-6 items-center mb-2">
        <div class="h-8 w-8 rounded shrink-0 bg-slate-100 group-hover:bg-secondary flex items-center justify-center text-secondary group-hover:text-white transition-all duration-300 ease-in-out">
            <font-awesome-icon icon="fa-check"></font-awesome-icon>
        </div>
        <p class="group-hover:text-slate-700 transition-all duration-300 ease-in-out">{{props.text}}</p>
    </div>
</template>

<script setup>
const props = defineProps({
    text: {
        type: String, 
        required: true,
    }
})
</script>
