
<script setup>
import ProjectsSlider from '@/Components/sliders/ProjectsSlider.vue'
import Link from '@/Components/links/Link.vue';
</script>

<template>
    <div class="container mx-auto  px-4 md:px-0">
        <div class="py-6 sm:py-16">
            <h1 class="font-extrabold text-5xl text-center  md:w-1/3 mx-auto "> <span class="bg-clip-text text-transparent bg-gradient-to-l from-blue-600 from-10% via-blue-300 via-30% to-blue-900 to-90% drop-shadow-md">Recent</span> <span class="bg-clip-text text-transparent bg-gradient-to-l from-blue-600 from-10% via-blue-300 via-30% to-blue-900 to-90% drop-shadow-md">Projects.</span></h1>
        </div>
        <div class="mx-auto max-w-2xl lg:container">
            <h2 class="sr-only">Recent Projects</h2>
            <ProjectsSlider />
            <div class="mt-6 text-center">
                <Link :href="route('projects.index')" :as-button="true" :classes="'rounded-full py-2 px-5'">
                    More Projects
                </Link>
            </div>
        </div>
    </div>
</template>

<style>

</style>

