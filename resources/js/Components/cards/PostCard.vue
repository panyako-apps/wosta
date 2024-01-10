<template>
<div class="break-inside-avoid-column bg-white rounded-md overflow-hidden">
    <Link :href="route('post.show', post.slug)">
        <div class="aspect-w-1 aspect-h-1 w-full overflow-hidden rounded-t-lg bg-gray-200 xl:aspect-w-7 xl:aspect-h-8 h-56 md:h-64">
            <img loading="lazy" :src="post.image" class="object-cover h-full w-full transition-all duration-200 hover:opacity-70" >
        </div>
    </Link>
    <div class="p-3">
        <Link :href="route('post.show', post.slug)">
            <h3 class="text-sm text-slate-600 hover:text-sky-600 font-bold">{{ post.name }}</h3>
        </Link>
    </div>
    <hr class="mt-6 md:hidden">
</div>

</template>

<script setup>
import { Link } from "@inertiajs/vue3";

const props = defineProps({
    post: [Object, Array]
})

</script>
