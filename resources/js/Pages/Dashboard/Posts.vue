<script setup>
import DashboardLayout from '@/Layouts/DashboardLayout.vue';
import { Head} from '@inertiajs/vue3';

const props = defineProps({
    posts: Array,
});

</script>

<template>
<Head title="Posts" />

<DashboardLayout>
    {{posts}}
</DashboardLayout>

</template>
