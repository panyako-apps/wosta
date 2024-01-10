<script setup>

import { computed, onMounted, ref } from "vue";
import { usePage } from "@inertiajs/vue3";
import { useReviewStore } from "@/Stores/reviews";
import Spinner from '@/Components/spinners/Spinner.vue';
import LikeButton from "@/Components/buttons/LikeButton.vue";
import ProfileImage from "@/Components/ProfileImage.vue";
import NewCommentForm from "./NewCommentForm.vue";

const user = computed(() => usePage().props.auth.user)

const store = useReviewStore();
const inProgress = ref(false);

onMounted(async ()=>{
  inProgress.value = true;
  await new Promise((res)=>setTimeout(res, 500))
  store.fetchFeaturedReviews()
  inProgress.value = false;
})


</script>

<template>
    <div v-if="inProgress" class="p-6 h-36 flex justify-center items-center">
        <Spinner :has-text="true"/>
    </div>
    <div v-if="!inProgress" class="">
      <div v-for="comment in store.featuredReviews" :key="comment.id" class="">
          <ProfileImage 
            :image="comment.avatar ? comment.avatar : comment.profileimage" 
            :showTitle="true"
            :title="comment.user.name"
            :classes="'h-20 w-20'"
            class="mb-2"/>
      
          <div class="bg-slate-200 px-3 py-2 rounded-lg " :class="user && user.id === comment.user.id ? 'bg-blue-100' : ''">
              <p class="text-sm" v-html="comment.comment"></p>
              <div class="flex justify-between items-center">
                  <div class="flex items-center gap-3">
                      <LikeButton 
                          :likeable_type="`\\App\\Models\\Comment`" 
                          :likeable_id="comment.id" 
                          :no-background="true"
                          />
                      <NewCommentForm
                          :commentable_type="`App\\Models\\Comment`" 
                          :commentable_id="comment.id" 
                          :parent_id="comment.id"
                          :text="'Reply'"
                          :is-minimal="true"
                          @commentposted="[store.fetchReviews(), store.fetchFeaturedReviews()]"
                          />
                        <span class="text-slate-400 text-xs pt-1">{{ comment.comments.length }} Replies</span>

                  </div>
                  <div class="flex items-center justify-end gap-2 pt-1">
                      <span class="text-xs font-bold text-slate-600">{{comment.created_at}}</span>
                  </div>
              </div>
          </div>
      </div>
    </div>
</template>


<style>

</style>