<script setup>
import { computed } from 'vue';

const props = defineProps(['href', 'active']);

const classes = computed(() => props.active
    ? 'inline-flex items-center px-3 border-t-[0.28rem] border-secondary  font-bold leading-5 text-secondary focus:outline-none focus:border-gray-700 transition  duration-150 ease-in-out'
    : 'inline-flex items-center px-3 border-t-[0.28rem] border-transparent  font-bold leading-5 text-primary hover:text-secondary hover:border-secondary focus:outline-none focus:text-gray-200 focus:border-gray-200 transition-all duration-350 ease-in-out'
);
</script>

<template>
    <a :href="href" :class="classes">
        <slot />
    </a>
</template>
