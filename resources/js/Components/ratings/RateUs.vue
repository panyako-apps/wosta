
<script setup>

import { computed, onMounted } from 'vue';
import { useForm } from '@inertiajs/vue3'
import { usePage } from '@inertiajs/vue3';
import { ref } from '@vue/reactivity';
import Modal from '@/Components/Modal.vue';
import Login from '@/Components/Login.vue'
import { useSiteRatingsStore } from '@/Stores/siteratings';

const store = useSiteRatingsStore();


const user = computed(() => usePage().props.value.auth.user)


// const user = computed(()=>{
//     if(authuser){
//         return user
//     }
//     else{
//         return 0
//     }
// });



const form = useForm({
    email: null, 
    rating: null,
})

const showModal = ref(false);

const toggleModal = ()=>{
    showModal.value=!showModal.value
}
// const errors = ref([])


function rateUs(){
    form.post(route('site.rate.us'),{
        onSuccess: ()=>{
            form.reset();
            toggleModal();
            store.fetchRatings();

        },
        preserveScroll: true,
    })
}

const btnClasses = 'rounded border border-transparent bg-blue-600 px-3 py-1 text-sm text-white shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2';

const btnCloseClasses = 'rounded border border-transparent bg-red-600 px-3 py-1 text-sm text-white shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2';


const userRating = computed(()=>{
    return user?store.ratings.filter(item => item.user_id===user.value.id || 0).map(item=>item.rating):0
});

const isOneStar = computed(()=>{
    return userRating.value[0]<=1
});
const isTwoStar = computed(()=>{
    return userRating.value[0]>1&&userRating.value[0]<=2.44
});
const isThreeStar = computed(()=>{
    return userRating.value[0]>2.44&&userRating.value[0]<=3.44
});
const isFourStar = computed(()=>{
    return userRating.value[0]>3.44&&userRating.value[0]<=4.44
});
const isFiveStar = computed(()=>{
    return userRating.value[0]>4.44&&userRating.value[0]<=5
});


</script>

<template>

    <div class="mb-2 flex items-center gap-2">
        <button @click="toggleModal" class="primary-button-2 flex items-center gap-1">
            <font-awesome-icon icon="fa fa-star"></font-awesome-icon>
            <span class="">
                Rate Us 
            </span>
        </button>
    </div>
  
    <Modal :show="showModal" :closeable="true">
        <div class="relative p-6">
            <div class="sm:flex gap-2 mb-2 items-center">
                <p class="font-bold text-lg uppercase text-blue-700">Rate Us</p>
            </div>
            <hr class="mt-3 mb-4 border-slate-400">

            <div  class="">
                <form @submit.prevent="rateUs" id="rateUs">
                    <div class="star-ratings text-blue-500">
                        <div class="star-icon flex justify-evenly" >
    
                            <input type="radio" value="1" name="rating" class="hidden" checked id="rating1" v-model="form.rating">
                            <label for="rating1" class="cursor-pointer text-3xl rating-label"><font-awesome-icon icon="fa-solid fa-star"></font-awesome-icon></label>
    
                            <input type="radio" value="2" name="rating" class="hidden" :checked="user?isTwoStar:''" id="rating2" v-model="form.rating">
                            <label for="rating2" class="cursor-pointer text-3xl rating-label"><font-awesome-icon icon="fa-solid fa-star"></font-awesome-icon></label>
    
                            <input type="radio" value="3" name="rating" class="hidden" :checked="user?isThreeStar:''" id="rating3" v-model="form.rating">
                            <label for="rating3" class="cursor-pointer text-3xl rating-label"><font-awesome-icon icon="fa-solid fa-star"></font-awesome-icon></label>
    
                            <input type="radio" value="4" name="rating" class="hidden" :checked="user?isFourStar:''" id="rating4" v-model="form.rating">
                            <label for="rating4" class="cursor-pointer text-3xl rating-label"><font-awesome-icon icon="fa-solid fa-star"></font-awesome-icon></label>
    
                            <input type="radio" value="5" name="rating" class="hidden" :checked="user?isFiveStar:''" id="rating5" v-model="form.rating">
                            <label for="rating5" class="cursor-pointer text-3xl rating-label"><font-awesome-icon icon="fa-solid fa-star"></font-awesome-icon></label>
    
                        </div>
                    </div>
                </form>
                <hr class="mt-6 mb-6 border-slate-600">
                <div class="md:flex justify-between items-center">
                    <div v-if="!user" class="">
                        <p class="uppercase ">You must be <span class="font-bold text-red-600">signed in</span> to rate this site.</p>
                    </div>
                    <div class="flex justify-end gap-2 items-center">
                        <button form="rateUs" type="submit" :class="[btnClasses, !user?'cursor-not-allowed bg-slate-400 hover:bg-slate-400':'']" :disabled="!user">
                            Submit Rating
                        </button>  
                        <button type="button" @click="toggleModal" :class="btnCloseClasses">
                            <font-awesome-icon icon="fa-times"></font-awesome-icon>
                            Close
                        </button>
                    </div>
                </div>
                <Login v-if="!user" />

            </div>
        </div>
    </Modal>

</template>

<style scoped>


  .rating-label {
    text-shadow: 1px 1px 0 #8f8420;
  }
  
  /* 
  * 1. Select the first label that is placed after the cheched input 
  * 2. select all the labels that are preceeded by the first label 
  * 3. Then apply the color below to the selected labels above.
  */

  .star-ratings input:checked + label ~ label { 
    color: #b4afaf;
  }

</style>