<script setup>
import { computed, onMounted, ref } from "vue";
import {useReviewStore} from '@/Stores/reviews'
import Spinner from '@/Components/spinners/Spinner.vue';
import Comment from "./Comment.vue";


const store =  useReviewStore();
const inProgress = ref(false);

onMounted( async()=>{
    inProgress.value =true;
    await new Promise((res)=>setTimeout(res, 800))
    store.fetchReviews()
    inProgress.value =false;
})


let hideButton = computed(()=>{
    return store.fetchingData || (store.page === store.lastPage);
});

</script>


<template>
    <div v-if="inProgress" class="p-6 h-36 flex justify-center items-center">
        <Spinner :has-text="true"/>
    </div>
    <div v-if="store.reviews.length" class="">
        <div class="p-6">
            <div v-for="(review, index) in store.reviews" :key="index" class="break-inside-avoid-column text-sm mb-3" >
                <Comment
                    :comment="review"
                    :replies="review.comments"
                    :no-background="true"
           
                     />
            </div>

        </div>
        <div  class="text-center p-3">
            <div v-if="store.fetchingData" class="p-6 h-36 flex justify-center items-center">
                <Spinner :has-text="true"/>
            </div>
            <button v-if="!hideButton" @click="store.getItemsOnScroll" class="text-slate-600 rounded-full hover:bg-blue-600 hover:text-white px-3 py-1 border hover:border-transparent border-dashed border-slate-600 cursor-pointer transition-all duration-200">Load More Reviews</button>
        </div>
    </div>
</template>


