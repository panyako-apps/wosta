<script>
import NewCommentForm from './NewCommentForm.vue';
import Delete from './Delete.vue'
import Edit from './Edit.vue';
import { usePage } from '@inertiajs/vue3';
import {useReviewStore} from '../../Stores/reviews'
import Dropdown from '@/Components/Dropdown.vue'
import LikeButton from '@/Components/buttons/LikeButton.vue';
import PublishButton from '@/Components/buttons/PublishButton.vue';
import FeatureButton from '@/Components/buttons/FeatureButton.vue';


export default {
    name: "recursive-comment",
    data(){
            return {
                user: usePage().props.auth.user,
                store: useReviewStore(),
                
            }
    },
    components:{
        NewCommentForm,
        Delete,
        Edit,
        LikeButton, 
        Dropdown, 
        PublishButton, 
        FeatureButton
    },
    props: {
        comment: {
            type: Object, 
            required: true,
        }, 
        replies: {
            type: Array, 
            default: ()=>[],
        }, 
        isReply: {
            type: Boolean, 
            default: false,
        },
        isAdmin: {
            type: Boolean, 
            default: false,
        }
    },
    emits: [
        'replyposted'
    ],
    computed:{
        computed_user: function(){
            if(this.user){
                return this.user
            }
            else{
                return 0
            }
        }
    },
    methods: {
        commentPosted: function(){
            this.store.fetchReviews();
            this.$emit('replyposted');
        }
    }

}

</script>


<template>

    <div class="">
        <div class="">
            <div class="flex gap-1 md:gap-4 mb-3">
                <div class="md:max-w-[10vw]">
                    <div class="h-12 w-12 rounded-full overflow-hidden bg-blue-800 mb-2 md:mb-0">
                        <img v-if="comment.avatar" :src="comment.avatar" alt="" class="w-full h-full object-cover">
                        <img v-else :src="comment.profileimage" alt="" class="w-full h-full object-cover">
                    </div>
                </div>
                <div class="rounded-2xl overflow-hidden" :class="[isReply ?'bg-blue-200':'bg-slate-200']">
                    <div class="px-4 py-2">
                        <div class="flex gap-2 items-baseline">
                            <p class="font-bold" :class="[computed_user.id===comment.user.id?'text-blue-700':'text-slate-700']">{{comment.user.name}}</p>
                            <span class="text-xs text-slate-500 font-bold">
                                {{comment.created_at}}
                            </span>
                        </div>
                        <p class="m-0" v-html="comment.comment"></p>
                        <div class="flex justify-between gap-4">
                            <span v-if="comment.parent_id===null" class="text-slate-400 text-xs pt-1">{{ comment.comments.length }} Replies</span>
                            <div class="flex justify-end items-center gap-2">
                                <LikeButton 
                                        :likeable_type="`App\\Models\\Comment`" 
                                        :likeable_id="comment.id" 
                                        :no-background="true"
                                        />  
                                <Edit 
                                    v-if="this.user&&this.user.id===comment.user.id" 
                                    :comment="comment"
                                    />
                                <Delete 
                                    v-if="this.user&&this.user.id===comment.user.id" 
                                    :comment="comment" 
                                    />
                                <NewCommentForm
                                    v-if="this.user&&comment.parent_id===null"
                                    :commentable_type="`App\\Models\\Comment`" 
                                    :commentable_id="comment.id" 
                                    :parent_id="comment.id"
                                    :text="'Reply'"
                                    :is-minimal="true"
                                    @commentposted="commentPosted"
                                    />
                            </div>
                        </div>
                    </div>
                </div>
                <Dropdown v-if="isAdmin" align="right" width="36">
                    <template #trigger>
                        <button type="button" class="h-6 w-6 rounded-full bg-slate-200 text-slate-500 cursor-pointer hover:bg-slate-300 flex items-center justify-center">
                            <font-awesome-icon icon="fa-ellipsis-h"></font-awesome-icon>
                        </button>
                    </template>

                    <template #content>
                        <PublishButton 
                            :model="comment"
                            :publishable_type="`\\App\\Models\\Comment`" 
                            :publishable_id="comment.id" 
                            />
                        <FeatureButton 
                            v-if="comment.isPublished"
                            :model="comment"
                            :featurable_type="`\\App\\Models\\Comment`" 
                            :featurable_id="comment.id" 
                            />          
                    </template>
                </Dropdown>
            </div>
        </div>



        <div v-if="replies.length" class="md:ml-12 pl-6 border-l-blue-500">
            <div v-for="(reply, index) in replies" :key="index" class="">
                <recursive-comment 
                        :comment="reply"
                        :replies="reply.replies"
                        :is-reply="true"
                        :is-admin="isAdmin"
                        >
                </recursive-comment>
            </div>
        </div>
    </div>


</template>
