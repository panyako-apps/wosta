<template>
    <section class="container mx-auto mb-6">
        <div class="max-w-5xl mx-auto mb-6 bg-red-200">
            <div class="sticky top-0 bg-gray-100">
                <div class="md:flex justify-between px-6 py-1">
                    <div class="md:flex items-center gap-2">
                        <h1 class="uppercase font-bold text-blue-700 text-xl md:text-2xl md:mb-0 "><font-awesome-icon icon="fa fa-book-open"></font-awesome-icon> What You Say About Us</h1>
                            <span class="text-xs bg-slate-300 rounded-full px-2 py-0.5 md:flex items-center">{{ store.totalReviews }} Reviews</span>
                    </div>

                    <HorizontalSeperator class="md:hidden mt-2" /> 
                    <!-- <NewCommentForm
                        :commentable_type="`App\\Models\\Page`" 
                        :commentable_id="2" 
                        :text="'Say Something'"
                        @commentposted="commentPosted"
                    /> -->
                </div>
            </div>
            <hr class="">
            <div ref="target" class="">
                <div v-if="fetchingReviews" class="p-6 h-36 flex justify-center items-center">
                    <Spinner :has-text="true" :text="'Loading Reviews'"/>
                </div>
                <div v-if="store.reviews.length" class="">
                    <div class="p-6">
                        <div v-for="(review, index) in store.reviews.slice(0,10)" :key="index" class="break-inside-avoid-column text-sm mb-3" >
                            <!-- <Comment
                                :comment="review"
                                :replies="review.comments"
                                :no-background="true"
                    
                                /> -->
                        </div>

                    </div>
                    <div class="text-center p-3">
                        <Link :href="route('page.reviews')" class="text-slate-600 rounded-full hover:bg-blue-600 hover:text-white px-3 py-1 border hover:border-transparent border-dashed border-slate-600 cursor-pointer transition-all duration-200">All Reviews</Link>
                    </div>
                </div>
            </div>
        </div>
    </section>

</template>

<script setup>
import FeaturedComment from '@/Components/comment/FeaturedComment.vue';
import NewCommentForm from '@/Components/comment/NewCommentForm.vue';
import Comment from '@/Components/comment/Comment.vue';

import HorizontalSeperator from '@/Components/seperators/HorizontalSeperator.vue';

import Spinner from '@/Components/spinners/Spinner.vue';


</script>

<style>

</style>