<script setup>
import axios from 'axios';
import { useForm, usePage } from '@inertiajs/vue3';
import { computed, ref } from 'vue';
import {useReviewStore} from '../../Stores/reviews'
import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
import {component as CKEditor} from '@ckeditor/ckeditor5-vue';
import Modal from '@/Components/Modal.vue'
import Spinner from '@/Components/spinners/Spinner.vue'



const props = defineProps({
    comment: Object,
    text: {
        type: String, 
        default : 'Edit'
    },
    hasText: {
        type: Boolean,
        default: false
    }
})

const emits = defineEmits([
    'commentupdated'
])

const user = usePage().props.auth.user;

const inProgress = ref(false);

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
const errors = ref([])


const form = useForm({
    comment: props.comment.comment,

})

const updateComment = async () => {
    inProgress.value = true;
    const res = await axios.post(route('api.comment.update', props.comment.id), {
        _method: 'put',
        comment: form.comment,
    });

    if(res.data.status ===200){
        form.reset();
        toggleModal();
        inProgress.value = false;
        useReviewStore().fetchReviews();
    }
}

const editorConfig = ref();
</script>

<template>
<div class="">
 
    <span v-if="isCommentOwner" @click="toggleModal" class="text-blue-600 cursor-pointer hover:text-slate-400 transition-all duration-200">
        <font-awesome-icon  icon="fa-edit"></font-awesome-icon>
        <span v-if="hasText" class="mt-6">
            {{text}}
        </span>
    </span>
    <Modal :show="show" :closeable="true">

        <div v-if="inProgress" class="p-6 h-36 flex justify-center items-center">
            <Spinner :has-text="true" :text="'Updating...'"/>
        </div>

        <div v-if="!inProgress" class="relative p-6">

            <div v-if="errors.length" class="text-sm mb-3">
                <ul>
                    <li v-for="(error, index) in errors" :key="index" class="bg-red-200 text-red-700 px-2 py-1 rounded mb-1">
                        * {{ error }}
                    </li>
                </ul>
            </div>


            <form @submit.prevent="updateComment" id="update_comment_form" class="pb-4">
                <div class="">
                    <CKEditor :editor="ClassicEditor" v-model="form.comment" :config="editorConfig"></CKEditor>
                    <div v-if="form.errors.comment" class="mt-2 bg-red-100 p-2 text-red-600 text-sm"> * The <span class="font-bold">message</span> field is required</div>
                </div>
            </form>

            <div class="flex justify-end gap-2">
                <button form="update_comment_form" type="submit" class="inline-flex items-center rounded-md border border-transparent bg-blue-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                    Save Changes
                </button>  
                <button type="button" @click="toggleModal" class="inline-flex items-center rounded-md border border-transparent bg-slate-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-slate-700 focus:outline-none focus:ring-2 focus:ring-slate-500 focus:ring-offset-2">
                    <font-awesome-icon icon="fa-times"></font-awesome-icon>
                    Close
                </button>
            </div>
        </div>
    </Modal>
</div>  
</template>


<style>

</style>