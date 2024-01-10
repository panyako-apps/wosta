<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue'
import HorizontalSeperatorSeperator from '@/Components/seperators/HorizontalSeperator.vue'
import { Head } from '@inertiajs/vue3';
import QuotationsCalculatorButton from '@/Components/buttons/QuotationCalculatorButton.vue'
import ReviewsList from '@/Components/comment/ReviewsList.vue';
import ShowRatings from '@/Components/ratings/ShowRatings.vue';
import RateUs from '@/Components/ratings/RateUs.vue';
import RecommendUsToAFriend from '@/Components/RecommendUsToAFriend.vue';
import RequestACallBack from '@/Components/RequestACallBack.vue';
import FeaturedComment from '@/Components/comment/FeaturedComment.vue';
import NewCommentForm from '@/Components/comment/NewCommentForm.vue';
import {useReviewStore} from '../Stores/reviews'
import SocialSharer from '@/Components/SocialSharer.vue';
import LikeButton from '@/Components/buttons/LikeButton.vue';
import ModelViews from '@/Components/ModelViews.vue'


const props = defineProps({
    sharelinks: [Array, Object],
})


const store = useReviewStore()

const commentPosted = ()=>{
    store.fetchReviews();
}


</script>

<template>
    <Head title="User Reviews" />

    <GuestLayout>
            <div class="min-h-screen pt-12 lg:px-8">
                <div class="container lg:flex mx-auto gap-4 mb-6">
                    <div class="lg:w-1/4 shrink-0 p-6 lg:p-0">
                        <div class="sticky top-24 z-20 bg-slate-100">
                            
                            <FeaturedComment />

                            <div class="hidden md:flex justify-between gap-6 items-center py-6 border-b border-t border-slate-300 mt-6">
                                <h4 class="font-bold uppercase text-blue-600">Let Others Know</h4>
                                <SocialSharer :links="props.sharelinks" :text="'Page'"/>
                            </div>

                            <div class="hidden md:block mt-6 pb-6">
                                <QuotationsCalculatorButton />
                            </div>
                            <div class="hidden md:block pb-3">
                                <RateUs />
                                <ShowRatings />
                            </div>
                        </div>
                    </div>
                    <div class="lg:max-w-3xl grow mx-auto mb-6 bg-gray-100">
                        <div class="">
                            <div class="">
                                <div class="bg-gray-100">
                                    <div class="xl:flex justify-between px-6 md:py-1">
                                        <div class="xl:flex items-center gap-2">
                                            <h1 class="uppercase font-bold text-blue-700 text-xl md:text-2xl md:mb-0">
                                                <font-awesome-icon icon="fa fa-book-open"></font-awesome-icon> What You Say About Us</h1>
                                             <span class="text-xs bg-slate-300 rounded-full px-2 py-0.5 items-center">{{ store.totalReviews }} Reviews</span>
                                        </div>
                                        <HorizontalSeperatorSeperator class="md:hidden mt-2" />
                                        <div class="hidden md:block">
                                            <NewCommentForm
                                                    :commentable_type="`App\\Models\\Page`" 
                                                    :commentable_id="2" 
                                                    :text="'Say Something'"
                                                    @commentposted="commentPosted"
                                                />
                                        </div>
                                    </div>
                                </div>
                                <hr class="">
                            </div>
                            <div class="overflow-y-scroll customscroll">
                                <ReviewsList/>
                            </div>
                        </div>
                    </div>
                    <div class="hidden md:block lg:w-1/4 shrink-0 p-6 md:p-0">
                        <div class="sticky top-24 z-20">
                            <RecommendUsToAFriend />
                            <div class="mt-4" >
                                <RequestACallBack />
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <template #fixedfooter>
                <div  class="flex w-full justify-center items-center gap-2 h-full">
                    <div class="text-slate-600">
                        <ModelViews 
                            :viewable_type="`App\\Models\\Page`" 
                            :viewable_id="4" 
                            />  
                    </div>
                    <NewCommentForm
                            :commentable_type="`App\\Models\\Page`" 
                            :commentable_id="2" 
                            :text="'Say Something'"
                            @commentposted="commentPosted"
                        />
                </div>
            </template>

    </GuestLayout>
</template>

<style scoped>


</style>