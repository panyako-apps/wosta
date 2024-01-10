<script setup>

const props = defineProps({
    href: String, 
    active: Boolean, 
    classes: String,
    asButton: {
        type: Boolean,
        default: false
    }
});

const btnclasses = 'border border-transparent bg-blue-600 px-4 py-1 text-sm font-medium text-white shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2';

</script>

<template>
    <a :href="href" class="text-white hover:text-blue-200" :class="asButton ? [classes, btnclasses] : classes">
        <slot />
    </a>
</template>
