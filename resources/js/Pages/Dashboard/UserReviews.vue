<script setup>
import DashboardLayout from '@/Layouts/DashboardLayout.vue';
import { Head} from '@inertiajs/vue3';
import { computed, onMounted, ref } from "vue";
import {useReviewStore} from '@/Stores/reviews'
import Comment from '@/Components/comment/Comment.vue';


const store =  useReviewStore();

onMounted(()=>{
    store.fetchAllReviews()
})

const listEl = ref(null);

let hideButton = computed(()=>{
    return store.fetchingData || (store.page === store.lastPage);
});


</script>

<template>
<Head title="Our Services" />

<DashboardLayout>
    <div class="">
        <div ref="listEl" class="p-6">
            <div v-for="(comment, index) in store.reviews" :key="index" class="break-inside-avoid-column text-sm mb-3" >
                <div class="flex gap-1">
                    <Comment 
                        :comment="comment" 
                        :replies="comment.comments"
                        :is-admin="true"
                        />
                </div>
            </div>
    
        </div>
        <div class="text-center p-3">
            <p v-show="store.fetchingData">Fetching Data, Please Hold!</p>
            <button v-if="!hideButton" @click="store.getItemsOnScroll" class="text-slate-600 rounded-full hover:bg-blue-600 hover:text-white px-3 py-1 border hover:border-transparent border-dashed border-slate-600 cursor-pointer transition-all duration-200">Load More Reviews</button>
        </div>
    </div>
</DashboardLayout>

</template>
