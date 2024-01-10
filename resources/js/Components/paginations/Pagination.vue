<template>
    <div :class="props.classes">
        <span v-for="(link, index) in props.links" :key="index" >
            <span v-if="link.url=== null" v-html="link.label" class="border border-secondary text-secondary px-3 py-1 rounded-lg"></span>
            <a v-else :href="link.url" v-html="link.label" 
                class="border border-secondary text-secondary text-sm font-bold hover:bg-primary hover:border-transparent 
                        hover:text-white px-3 py-1 rounded-full mx-1 transition-all duration-200"
                :class="{'bg-primary border-primary  text-white font-bold': link.active}"                        
                >
            </a>
        </span>
    </div>
</template>

<script setup>
const props = defineProps({
    links: [Object, Array],
    classes: String,
})
</script>

<style>

</style>