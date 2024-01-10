<script setup>
import PrimaryButton from '@/Components/PrimaryButton.vue'
import { useForm, usePage } from '@inertiajs/vue3';
import { computed, onMounted, ref } from 'vue';
import Login from '@/Components/Login.vue'
import Modal from '@/Components/Modal.vue'
import axios from 'axios';

const props = defineProps({
    text: String,
    likeable_type: String,
    likeable_id: Number,
    noBackground: Boolean,
    btnClasses: {
        type: String,
        default: 'bg-sky-600 inline-flex items-center gap-2 rounded-full border border-transparent bg-sky-600 px-2 py-1 text-sm font-medium text-white shadow-sm hover:bg-sky-700 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:ring-offset-2',
    }
});

const likes = ref([]);

const user = usePage().props.auth.user;

const isModalActive = ref(false);

const toggleModal = ()=>{
    isModalActive.value=!isModalActive.value
}

const computed_user_id = computed(()=>{
    if(user){
        return user.id
    }
    else{
        return 0
    }
});

const form = useForm({
    likeable_id: props.likeable_id,
    likeable_type: props.likeable_type,
    user_id: computed_user_id,
});

const submit = async () =>{
    if(user){
        const res = await axios.post(route('api.like'), {
            likeable_id: form.likeable_id, 
            likeable_type:form.likeable_type,
            user_id: form.user_id
        })

        if(res.data.status === 200)
        {
            fetchLikes()
        }

    }
    else{
        toggleModal();
    }
    
}

const fetchLikes = async ()=>{
    const fetchedlikes = await axios.post(route('api.likes'),{
            likeable_id: form.likeable_id,
            likeable_type: form.likeable_type
        });
    likes.value = fetchedlikes.data;
}

onMounted(async ()=>{
    await fetchLikes();
});

const btnCloseClasses = 'rounded border border-transparent bg-red-600 px-3 py-1 text-sm text-white shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2';
const noBgClasses = 'border-none text-sm';

const liked = computed(()=>{
    if(user&&likes.value.length>0){
        return likes.value.map(like => like.user_id).includes(user.id);
    }
});


</script>

<template>
    <button
        :class="props.noBackground ? noBgClasses : props.btnClasses"
        @click="submit()"
        >
        <span v-if="liked" :class="noBackground ? 'text-sky-600':'text-sky-300'" class="flex items-center gap-1">
            <span>You</span>
            <font-awesome-icon  icon="fa-thumbs-up"></font-awesome-icon>
        </span>
        <span v-else :class="noBackground ? 'text-sky-400':''">
            <font-awesome-icon icon="fa-thumbs-up"></font-awesome-icon>
        </span>
        <span v-if="text">{{props.text}}</span>
        <span class="text-sky-600 font-bold h-4 px-1  rounded-full text-xs" :class="noBackground ? '':'bg-sky-300 '">{{ likes.length }}</span>
    </button>

    <Modal :show="isModalActive&&!user" @close="toggleModal">
        <div class="p-6">
            <div class="">
                    <p class="uppercase ">You must be <span class="font-bold text-red-600">signed in</span> to Like this.</p>
            </div>
            <Login />
        </div>
    </Modal>
</template>



<style>

</style>


