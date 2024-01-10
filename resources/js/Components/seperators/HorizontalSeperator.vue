<script setup>
const props = defineProps({
    classes: String
})
</script>

<template>
    <hr class="border border-slate-300 my-3" :class="classes">
</template>
