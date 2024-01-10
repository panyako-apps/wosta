
<script setup>
import { computed, onMounted } from 'vue';
import { useSiteRatingsStore } from '@/Stores/siteratings';
const store = useSiteRatingsStore();

onMounted(()=>{
    store.fetchRatings();
});
const isOneStar = computed(()=>{
    return store.average <=1
});
const isTwoStar = computed(()=>{
    return store.average >1&&store.average<=2.44
});
const isThreeStar = computed(()=>{
    return store.average >2.44&&store.average<=3.44
});
const isFourStar = computed(()=>{
    return store.average >3.44&&store.average<=4.44
});
const isFiveStar = computed(()=>{
    return store.average >4.44&&store.average<=5
});

</script>

<template>
<div class="relative text-slate-700">
        <div class="">
            <div class="flex justify-between items-center mb-3 rounded-md border border-dashed border-slate-500 p-3">
                <div class="font-bold uppercase">Average <span class="hidden sm:inline">Rating</span> : <span class="text-slate-500">{{ store.average.toFixed(2) }}</span></div>  
                <div class="star-ratings text-blue-500">
                    <div class="star-icon flex justify-evenly">
                        <input type="radio"  class="hidden" :checked="isOneStar">
                        <label class="text-2xl rating-label"><font-awesome-icon icon="fa-solid fa-star"></font-awesome-icon></label>

                        <input type="radio"  class="hidden" :checked="isTwoStar">
                        <label class="text-2xl rating-label"><font-awesome-icon icon="fa-solid fa-star"></font-awesome-icon></label>

                        <input type="radio"  class="hidden" :checked="isThreeStar">
                        <label class="text-2xl rating-label"><font-awesome-icon icon="fa-solid fa-star"></font-awesome-icon></label>

                        <input type="radio"  class="hidden" :checked="isFourStar">
                        <label class="text-2xl rating-label"><font-awesome-icon icon="fa-solid fa-star"></font-awesome-icon></label>

                        <input type="radio"  class="hidden" :checked="isFiveStar">
                        <label class="text-2xl rating-label"><font-awesome-icon icon="fa-solid fa-star"></font-awesome-icon></label>
                    </div>
                </div>
            </div>

            <div class="flex justify-between items-center gap-4 pr-3">
                <div class="text-2xl">
                    <span class="text-blue-500">
                        <font-awesome-icon icon="fa-solid fa-star"></font-awesome-icon>
                    </span>
                    <span class="text-slate-300">
                        <font-awesome-icon icon="fa-solid fa-star"></font-awesome-icon>
                    </span>
                    <span class="text-slate-300">
                        <font-awesome-icon icon="fa-solid fa-star"></font-awesome-icon>
                    </span>
                    <span class="text-slate-300">
                        <font-awesome-icon icon="fa-solid fa-star"></font-awesome-icon>
                    </span>
                    <span class="text-slate-300">
                        <font-awesome-icon icon="fa-solid fa-star"></font-awesome-icon>
                    </span>
                </div>
                <div class="text-sm">
                    <span class="rounded-xl bg-blue-500 text-slate-50 px-2 py-1">
                        {{ store.one_stars.length }} 
                    </span>
                </div>
            </div>
            <div class="flex justify-between items-center gap-4 pr-3">
                <div class="text-2xl">
                    <span class="text-blue-500">
                        <font-awesome-icon icon="fa-solid fa-star"></font-awesome-icon>
                    </span>
                    <span class="text-blue-500">
                        <font-awesome-icon icon="fa-solid fa-star"></font-awesome-icon>
                    </span>
                    <span class="text-slate-300">
                        <font-awesome-icon icon="fa-solid fa-star"></font-awesome-icon>
                    </span>
                    <span class="text-slate-300">
                        <font-awesome-icon icon="fa-solid fa-star"></font-awesome-icon>
                    </span>
                    <span class="text-slate-300">
                        <font-awesome-icon icon="fa-solid fa-star"></font-awesome-icon>
                    </span>
                </div>
                <div class="text-sm">
                    <span class="rounded-xl bg-blue-500 text-slate-50 px-2 py-1">
                        {{ store.two_stars.length }}
                    </span>
                </div>
            </div>
            <div class="flex justify-between items-center gap-4 pr-3">
                <div class="text-2xl">
                    <span class="text-blue-500">
                        <font-awesome-icon icon="fa-solid fa-star"></font-awesome-icon>
                    </span>
                    <span class="text-blue-500">
                        <font-awesome-icon icon="fa-solid fa-star"></font-awesome-icon>
                    </span>
                    <span class="text-blue-500">
                        <font-awesome-icon icon="fa-solid fa-star"></font-awesome-icon>
                    </span>
                    <span class="text-slate-300">
                        <font-awesome-icon icon="fa-solid fa-star"></font-awesome-icon>
                    </span>
                    <span class="text-slate-300">
                        <font-awesome-icon icon="fa-solid fa-star"></font-awesome-icon>
                    </span>
                </div>
                <div class="text-sm">
                    <span class="rounded-xl bg-blue-500 text-slate-50 px-2 py-1">
                        {{ store.three_stars.length }} 
                    </span>
                </div>
            </div>
            <div class="flex justify-between items-center gap-4 pr-3">
                <div class="text-2xl">
                    <span class="text-blue-500">
                        <font-awesome-icon icon="fa-solid fa-star"></font-awesome-icon>
                    </span>
                    <span class="text-blue-500">
                        <font-awesome-icon icon="fa-solid fa-star"></font-awesome-icon>
                    </span>
                    <span class="text-blue-500">
                        <font-awesome-icon icon="fa-solid fa-star"></font-awesome-icon>
                    </span>
                    <span class="text-blue-500">
                        <font-awesome-icon icon="fa-solid fa-star"></font-awesome-icon>
                    </span>
                    <span class="text-slate-300">
                        <font-awesome-icon icon="fa-solid fa-star"></font-awesome-icon>
                    </span>
                </div>
                <div class="text-sm">
                    <span class="rounded-xl bg-blue-500 text-slate-50 px-2 py-1">
                        {{ store.four_stars.length }}
                    </span>
                </div>
            </div>
            <div class="flex justify-between items-center gap-4 pr-3">
                <div class="text-2xl">
                    <span class="text-blue-500">
                        <font-awesome-icon icon="fa-solid fa-star"></font-awesome-icon>
                    </span>
                    <span class="text-blue-500">
                        <font-awesome-icon icon="fa-solid fa-star"></font-awesome-icon>
                    </span>
                    <span class="text-blue-500">
                        <font-awesome-icon icon="fa-solid fa-star"></font-awesome-icon>
                    </span>
                    <span class="text-blue-500">
                        <font-awesome-icon icon="fa-solid fa-star"></font-awesome-icon>
                    </span>
                    <span class="text-blue-500">
                        <font-awesome-icon icon="fa-solid fa-star"></font-awesome-icon>
                    </span>

                </div>
                <div class="text-sm">
                    <span class="rounded-xl bg-blue-500 text-slate-50 px-2 py-1">
                        {{ store.five_stars.length }}
                    </span>
                </div>
            </div>
            
   
            <div class="flex justify-between items-center gap-4 my-3 rounded-md border border-dashed border-slate-500 p-3">
                <div class="space-x-2">
                    <span class="font-bold uppercase">Total Stars :</span>
                    <span class="text-yellow-500 text-2xl">
                        <font-awesome-icon icon="fa-solid fa-star"></font-awesome-icon>
                    </span>
                </div>
                <div class="text-sm">
                    <span class="rounded-xl bg-blue-600 text-slate-50 px-2 py-1">
                        {{ store.stars }}
                    </span>
                </div>
            </div>

        </div>
    </div>

</template>
<style scoped>
  .rating-label {
    text-shadow: 1px 1px 0 #8f8420;
  }
  
  /* 
  * 1. Select the first label that is placed before the cheched input 
  * 2. select all the labels that are preceeded by the first label 
  * 3. Then apply the color below to the selected labels above.
  */

  .star-ratings input:checked + label ~ label { 
    color: #cbd5e1;
  }
</style>