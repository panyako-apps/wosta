<template>
    <div class="flex gap-4">
        <div class="h-20 w-20 overflow-hidden shrink-0">
            <img :src="props.post.image" class="w-full h-full object-cover hover:scale-110 transition-all duration-500 ease-linear">
        </div>
        <div class="text-start">
            <h4 class="uppercase text-slate-500 space-x-2 text-sm">
                <span class="mb-2  border-b border-slate-500">{{props.post.user.name}} </span><span>|</span><span class="mb-2 border-b border-slate-500">{{post.comments.length}} {{post.comments.length === 1 ? 'Comment' : 'Comments'}}</span>
            </h4>
            <Link :href="route('post.show', props.post.slug)" class="text-primary font-bold xl:text-xl hover:text-secondary transition-colors duration-200 ease-linear leading-">
                {{props.post.name.slice(0, 40)}} {{props.post.name.length > 40 ? '...' : ''}}
            </Link>
        </div>
    </div>
</template>

<script setup>
import { onMounted } from "vue"
import { Link } from '@inertiajs/vue3'

const props = defineProps({
    post: {
        type: Object, 
        required: true
    }
})

</script>
