<script setup>
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { useForm, usePage } from '@inertiajs/vue3';
import axios from 'axios';
import { computed, onMounted, ref } from 'vue';
import Modal from "@/Components/Modal.vue";
import Spinner from '@/Components/spinners/Spinner.vue'
import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
import {component as CKEditor} from '@ckeditor/ckeditor5-vue';
import Login from '@/Components/Login.vue'

const props = defineProps({
    commentable_type: String,
    commentable_id: Number,
    text:{
        type: String,
        default: 'Add Comment'
    },
    parent_id: Number,
    isMinimal: {
        type: Boolean,
        default: false
    }
});

const emits = defineEmits([
    'commentposted'
])

const show = ref(false);

const toggleModal = ()=>{
    show.value=!show.value
}
const inProgress = ref(false);


const comments = ref([]);

const user = usePage().props.auth.user;

const computed_user_id = computed(()=>{
    if(user){
        return user.id
    }
    else{
        return 0
    }
});

const errors = ref([])

const form = useForm({
    comment: '',
    image: null,
    commentable_id: props.commentable_id,
    commentable_type: props.commentable_type,
    user_id: computed_user_id,
    parent_id: props.parent_id,
});


const submit = async () =>{
    
    errors.value = [];

    if(user){

        if(form.comment==='')
        {
            errors.value.push('Comment field is required!')
        }

        if(errors.value.length<1){
        
            inProgress.value = true;

            const res = await axios.post(route('api.comment.store'), {
                comment: form.comment,
                image: form.image,
                commentable_id: form.commentable_id, 
                commentable_type:form.commentable_type,
                user_id: form.user_id,
                parent_id: form.parent_id
            })
                        
            if(res.data.status === 200)
            {
                inProgress.value = false;
                comments.value = res
                toggleModal();
                form.reset();
                emits('commentposted');
                
            }
        }
    }
    else{
        toggleModal();
    }
    
}


const editorConfig = ref();

const btnText = 'text-sm text-customBlue hover:text-slate-400 transition-all duration-200';
const btnCloseClasses = 'rounded border border-transparent bg-red-600 px-3 py-1 text-sm text-white shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2';
const primaryLinkClasses = 'px-3 py-1 text-gray-600 bg-customBlue hover:bg-sky-700 text-white rounded-full hover:shadow-md text-left';

</script>

<template>
    <div>
        <button 
            @click="toggleModal"
            :class="[isMinimal?btnText:primaryLinkClasses]"
            class="bg-customBlue hover:bg-blue-600 text-white font-bold px-5 py-2.5 rounded-full my-auto flex items-center"
            >
            <span v-if="isMinimal">
                <font-awesome-icon icon="fa-reply"></font-awesome-icon>
                <span class="text-xs"> reply</span>
            </span>
            <span v-else>
                {{ text }}
                <font-awesome-icon icon="fa-comment"></font-awesome-icon>
            </span>

        </button>
    </div>
    <Modal :show="show" @close="toggleModal">
        <div class="" v-if="user">
            <div v-if="inProgress" class="p-6 h-36 flex justify-center items-center">
                <Spinner :has-text="true" :text="'Uploading Images...'"/>
            </div>
            <div v-show="!inProgress" class="p-6">
                <form @submit.prevent="submit">
                    <div class="mb-3">
                        <CKEditor :editor="ClassicEditor" v-model="form.comment" :config="editorConfig"></CKEditor>
                        <InputError class="mt-2" :message="form.errors.comment" />
                        <ul v-if="errors.length>0" class="bg-red-100 rounded-md p-2 mt-1">
                            <li class="text-red-600" v-for="error in errors" :key="error">{{ error }}</li>
                        </ul>
                    </div>
    
                    <div class="my-3 flex gap-2 items-center">
                        <PrimaryButton class="block" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                            Post Comment
                        </PrimaryButton>
                        <button 
                            type="button" 
                            :class="btnCloseClasses"
                            @click="toggleModal"
                            >
                            <font-awesome-icon icon="fa-times"></font-awesome-icon>
                            Close
                        </button>
                    </div>
                </form>
            </div>
        </div>
            
        <div v-if="!user" class="p-4" >
            <p class="uppercase text-red-500 font-bold">Your must be logged in to post a comment</p>
            <Login  />
        </div>

    </Modal>

</template>
