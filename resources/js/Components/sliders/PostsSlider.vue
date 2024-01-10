<script setup>
// import Swiper core and required modules
import { Navigation, Pagination, Scrollbar, A11y, Autoplay } from 'swiper/modules';
  
// Import Swiper Vue.js components
import { Swiper, SwiperSlide } from 'swiper/vue';

// Import Swiper styles
import 'swiper/css';
import 'swiper/css/bundle'
import 'swiper/css/navigation';
import 'swiper/css/pagination';
import 'swiper/css/scrollbar';
import 'swiper/css/autoplay';


import { onMounted, ref } from 'vue';
import { usePostsStore } from '@/Stores/posts';
import { useElementVisibility } from '@vueuse/core';
import PostCard from '@/Components/cards/PostCard.vue';
import PostCardSkeleton from '@/Components/placeholders/PostCardSkeleton.vue';

const props = defineProps({
    post_id: Number,
    category_id: Number,
});


const store = usePostsStore();
const target = ref(null);
const targetIsVisible = useElementVisibility(target)

onMounted(()=>{
     onScroll();
})

function onScroll(){
    
    document.addEventListener('scroll', ()=>{
        if(targetIsVisible.value){
            if(store.related.length<1){

                store.fetchRelatedPosts(props.post_id, props.category_id);
            }
            else{
                return
            }
        }

    })
}



</script>
<template>
    <div v-if="store.isFetching" class="grid grid-cols-2 md:grid-cols-4 gap-4">
        <PostCardSkeleton v-for="i in 4" :key="i" />
    </div>
    <div class="" ref="target">
        <Swiper
              :modules="[Navigation, Pagination, Scrollbar, A11y, Autoplay]"
              :slides-per-view="8"
              :space-between="10"
              :navigation="false"
              :autoplay = "{
                  delay: 5000,
                  disableOnInteraction: false,
                  pauseOnMouseEnter: true,
              }"
              :loop="true"
              :pagination="{ clickable: true }"
              :scrollbar="{ draggable: true }"
              :breakpoints = "{
                  320: {
                      slidesPerView: 2,
                      pagination: false
                  },
                  640: {
                      slidesPerView: 3,
                  },
                  1024: {
                      slidesPerView: 5,
                  }
              }"
          >
            <SwiperSlide v-for="post in store.related" :key="post.id"  class="mb-8">
                <PostCard :post="post"></PostCard>
            </SwiperSlide>
        </Swiper>
    </div>
</template>


<style>

</style>