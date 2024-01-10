
<script setup>
import { useQuotationsStore } from "@/Stores/quotations";
import Modal from '@/Components/Modal.vue'
import { ref } from "vue";
import Spinner from '@/Components/spinners/Spinner.vue'
import { router } from "@inertiajs/vue3";

const props = defineProps({
    text: {
        type: String, 
        default: 'Preview'
    },
});

const emits = defineEmits([
    'quotationsent'
]);


const store = useQuotationsStore()

const isModalActive = ref(false);
const isSending = ref(false);

const toggleModal = ()=>{
    isModalActive.value=!isModalActive.value
}

const requestObjects = ref({
    quote: [],
    email: '',
    subscribeMe: false,
    total: 0,
    days: 0,
})

const sendQuotation = () => {

    requestObjects.value.total = store.totalCost;
    requestObjects.value.days = store.totalDays;
    requestObjects.value.quote = store.quote;

    isSending.value = true;
    router.post(route('quotation.store', requestObjects.value), {
        
    },{
        onSuccess: async ()=>{
            isSending.value = false;
            requestObjects.value = {};
            toggleModal();
            store.clearQuote();
            emits('quotationsent');
        }
    }); 
}
</script>

<template>
    <div class="">
        <button @click="toggleModal" class="primary-button w-full flex items-center gap-1">
            <font-awesome-icon icon="fa-eye"></font-awesome-icon>
            <span class="">
                {{props.text}}
            </span>
        </button>

       <Modal :show="isModalActive" :closeable="true" :max-width="'2xl'">
        <template #header>
            <div class="px-6 pt-6">
                <h1 class="text-center font-bold text-blue-900 uppercase text-xl">Estimated Quotation For a Dynamic Web Application</h1>
                <hr class="my-3">
            </div>
        </template>



        <div v-if="isSending" class="bg-blue-600 bg-opacity-75 text-white absolute inset-0 rounded-md z-40">
            <div class="flex items-center justify-center h-full">
                <Spinner :has-text="true" :text="'Sending Mail...'"/>
            </div>
        </div>

        <div v-if="!isSending" class="px-6 overflow-y-scroll max-h-[60vh]">
            <table class="min-w-full text-sm">
                <thead class="bg-gray-200 text-gray-500 sticky top-0">
                    <tr class="">
                        <th scope="col" class="px-2 py-2 text-left">
                            #
                        </th>
                        <!-- <th scope="col" class="px-2 py-2 text-left"></th> -->
                        <th scope="col" class="px-2 py-2 text-left">
                            Feature 
                        </th>
                        <th scope="col" class="px-2 py-2 text-left">
                            Estimated Cost 
                        </th>
                        <th></th>
    
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(feature, index) in store.quote" :key="feature" class="bg-white border-b transition duration-300 ease-in-out hover:bg-gray-100">
                        <td class="px-2 sm:px-6 py-4 font-medium text-gray-900 text-right">{{index + 1}}.</td>
                        <!-- <td> 
                            <img :src="feature.icon" :alt="feature.name" class="sm:h-12 w-8 sm:w-auto object-cover">
                        </td> -->
                        <td class="text-gray-900 font-light px-2 py-4">
                            <span class="font-bold">{{feature.name}}</span>
                        </td>
                        <td class="text-gray-900 text-right font-light px-2 py-4 max-w-[20rem]">
                            {{ feature.cost}}
                        </td>
                        <td class="text-gray-900 font-light px-2 py-4">
                            <div class="flex justify-end gap-1 items-center sm:pr-5">
                                    <button class="rounded-md border border-transparent bg-red-600 px-2 py-1 text-xs text-white shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">
                                        <font-awesome-icon icon="fa-trash-alt"></font-awesome-icon>
                                    </button>
                            </div>
                        </td>
                    </tr>  
                </tbody>
            </table>
        </div>

        <template #footer>
            <div class="px-6 pt-2">
                <div class="flex items-center justify-between gap-2">
                    Total Estimated Cost =>  
                    <span class="text-xl font-bold ">KES. {{ store.totalCost.toLocaleString() }}</span> 
                </div>
            </div>
            <h3 class="px-6 font-bold mb-2">
                Save and send your estimate to email 
            </h3>
            <div class="px-6 pb-6">
                <div class="">
                    <input  type="email" 
                            name="email" 
                            id="email" 
                            autocomplete="email" 
                            class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                            placeholder="Enter a working email address"
                            v-model="requestObjects.email"
                            >
                    <div class="flex items-center gap-2 my-2">
                        <input  type="checkbox" 
                                name="subscribe" 
                                id="subscribe" 
                                class="rounded border-blue-300 focus:border-blue-500 focus:ring-blue-500"
                                v-model="requestObjects.subscribeMe"
                                >
                        <label for="subscribe" class="uppercase text-xs font-bold">Receive useful information about building apps.</label>
                    </div>
                </div>
                <div class="flex justify-between ">
                    <button @click="sendQuotation()" class="items-center rounded-md border border-transparent bg-blue-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                        Save & Send 
                    </button>  
                     <button type="button" @click="toggleModal" class="inline-flex items-center rounded-md border border-transparent bg-red-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">
                         <font-awesome-icon icon="fa-times"></font-awesome-icon>
                         <span class="pl-2">Close</span>
                     </button>
                 </div>
            </div>
        </template>
       </Modal>
    </div>
</template>

<style>
.re
{
    color: rgb(36, 34, 54);
    
}
</style>