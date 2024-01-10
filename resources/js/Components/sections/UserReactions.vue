<template>
      <section id="user-reactions">
        <div class="py-6 sm:py-16">
            <h1 class="font-extrabold text-5xl text-center  md:w-1/3 mx-auto "> <span class="bg-clip-text text-transparent bg-gradient-to-l from-blue-600 from-10% via-blue-300 via-30% to-blue-900 to-90% drop-shadow-md">User</span> <span class="bg-clip-text text-transparent bg-gradient-to-l from-blue-600 from-10% via-blue-300 via-30% to-blue-900 to-90% drop-shadow-md">Reactions.</span></h1>
        </div>
        <div class="max-w-5xl mx-auto mb-6 p-6 lg:p-0">
            <div class="grid grid-cols-2 gap-12">
                <!-- <RecommendUsToAFriend /> -->
                <RequestACallBack />
                <div class="">
                    <RateUs />
                    <ShowRatings />
                </div>
            </div>
        </div>
    </section>
</template>

<script setup>
import RateUs from '@/Components/ratings/RateUs.vue';
import ShowRatings from '@/Components/ratings/ShowRatings.vue';
import RequestACallBack from '@/Components/RequestACallBack.vue';
import RecommendUsToAFriend from '@/Components/RecommendUsToAFriend.vue';

</script>

<style>

</style>