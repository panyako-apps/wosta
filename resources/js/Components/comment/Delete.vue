<script setup>
import Modal from '@/Components/Modal.vue'
import { computed, ref } from 'vue';
import {useReviewStore} from '../../Stores/reviews'
import Spinner from '@/Components/spinners/Spinner.vue'
import { usePage } from '@inertiajs/vue3';
import axios from 'axios';

const props = defineProps({
    comment: Object,
})

const emits = defineEmits([
    'commentdeleted'
])

const user = usePage().props.auth.user;

const isCommentOwner = computed(()=>{
    if(user){
        return user.id===props.comment.user.id
    }
    else{
        return false;
    }
});


const show = ref(false);

const toggleModal = ()=>{
    show.value=!show.value
}


const inProgress = ref(false);

const deleteComment = async () => {
    inProgress.value = true;
    const res = await axios.delete(route("api.comment.destroy", props.comment.id), {
        _method: 'delete',
    });

    if(res.data.status === 200){
        useReviewStore().fetchReviews();
        toggleModal();
        emits('commentdeleted');
        inProgress.value = false;
    }
}



</script>

<template>
<div class="">
 
    <span v-if="isCommentOwner" @click="toggleModal" class="text-red-600 cursor-pointer hover:text-slate-400 transition-all duration-200">
        <font-awesome-icon  icon="fa-trash-alt"></font-awesome-icon>
    </span>

    <Modal :show="show" :closeable="true">

        <div v-if="inProgress" class="p-6 h-36 flex justify-center items-center">
            <Spinner :has-text="true" :text="'Deleting...'"/>
        </div>

        <div v-if="!inProgress" class="relative p-6">
            <div class="flex items-center gap-2 text-red-600 font-bold">
                <font-awesome-icon icon="fa-times-circle"></font-awesome-icon>
                <p class="text-red-600 font-bold">Are You Sure You want to Delele </p>
            </div>
            <div class="flex justify-end gap-2">
                <button @click="deleteComment" type="button" class="inline-flex items-center rounded-md border border-transparent bg-red-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">
                    Yes, Delete
                </button>  
                <button type="button" @click="toggleModal" class="inline-flex items-center rounded-md border border-transparent bg-slate-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-slate-700 focus:outline-none focus:ring-2 focus:ring-slate-500 focus:ring-offset-2">
                    No, Go Back
                </button>
            </div>
        </div>
    </Modal>
</div>  
</template>


<style>

</style>