<script setup>
import DashboardLayout from '@/Layouts/DashboardLayout.vue';
import { Head, Link, router} from '@inertiajs/vue3';
import Edit from './Edit.vue';
import AddImages from '@/Components/image/AddImages.vue';
import DeleteImage from '@/Components/image/DeleteImage.vue'
import EditImage from '@/Components/image/EditImage.vue'
import { onMounted, ref } from 'vue';
import Dropdown from '@/Components/Dropdown.vue'
import Spinner from '@/Components/spinners/Spinner.vue';
import Modal from "@/Components/Modal.vue";
import FavouriteButton from '@/Components/buttons/FavoriteButton.vue';

const props = defineProps({
    service: Object,
    categories: Array
});

const show = ref(false);

const toggleModal = () =>{
    show.value = !show.value
}

const selectedImages = ref([]);
const inProgress = ref(false);
const images = ref([]);

const deleteSelectedImages = ()=>{

    inProgress.value= true;
    show.value = true;

    router.post(route('admin.service.images.destroy'), {
        _method: 'delete',
        ids: selectedImages.value,
    }, 
    {
        onProgress: ()=>{
            inProgress.value= true;
            toggleModal();
        },
        onSuccess: ()=>{
            inProgress.value = false;
            selectedImages.value = [];
            show.value=false;
            fetchImages();
        },
    })
}

const fetchImages = async ()=>{
    const res = await axios.post(route('api.images.index'),
    {
        imageable_id: props.service.data.id,
        imageable_type: 'App\\Models\\Service',
        folder: 'service'
    });
    
    images.value = res.data.data
}

onMounted(()=>{
    // fetchComments()
    fetchImages();
});


const btnClasses = 'rounded border border-transparent bg-blue-600 px-3 py-1 text-sm text-white shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2';

</script>

<template>
<Head title="Manage Service" />

<DashboardLayout>

    <div class="flex justify-between items-center mb-2">
        <h2 class="uppercase"> {{ service.data.name }}</h2>
        <Link :href="route('admin.services.index')" :class="btnClasses">Back</Link>
    </div>

    <div class="container mx-auto pb-6">
        <h2 class="sr-only">{{ service.data.name }}</h2>
        
        <div class="container mx-auto px-3 md:px-0  mb-6 ">
            <div class="w-full h-96 overflow-hidden bg-slate-200 p-2 border border-slate-500 border-dashed rounded-lg mb-3 relative">
                <img :src="service.data.image" class="object-cover w-full h-full" >                    
            </div>
            <div class="">
                <div class="mb-3">
                    <h3 class="text-xl font-bold text-blue-800 uppercase"> {{service.data.name}}</h3>
                    <hr>
                </div>
                <h4>Description.</h4>
                <p class="border border-slate-400 border-dashed rounded-md p-5 mb-3" v-html="service.data.description"></p>
                <div class="w-24">
                    <Edit :categories="categories" :service="service.data" />
                </div>
            </div>   
        </div>
        <div class="">
            <div class="flex justify-between">
                <AddImages 
                    :model="service.data" 
                    :customroute="'admin.service.images.store'" 
                    @imagesuploaded="fetchImages"
                    />
                <div v-if="selectedImages.length" class="flex gap-1 justify-end items-center">
                     <p class="text-sm font-bold uppercase text-blue-600">With Selected</p>
                     <Dropdown align="right" width="36">
                        <template #trigger>
                            <button type="button" class="h-6 w-6 rounded-full bg-slate-200 text-blue-600 cursor-pointer hover:bg-slate-300 flex items-center justify-center">
                                <font-awesome-icon icon="fa-ellipsis-h"></font-awesome-icon>
                            </button>
                        </template>

                        <template #content>  
                            <button @click="deleteSelectedImages">Delete</button>
                        </template>
                    </Dropdown>
                </div>
            </div>
            <div v-if="images" class="columns columns-4 gap-4 mt-2">
                <div v-for="image in images" :key="image.id" class="bg-slate-200 p-2 mb-4 break-inside-avoid-column rounded-t-lg">
                    <div class="rounded relative" :class="{'border-4 border-blue-600 shadow order-opacity-75': selectedImages.includes(image.id)}">
                        <input 
                            type="checkbox" 
                            :id="image.id" 
                            :value="image.id" 
                            v-model="selectedImages"
                            class="absolute top-2 right-2 hidden"
                            >
                        <label :for="image.id">
                            <img :src="image.url" alt="" class="h-full w-full object-cover z-10 cursor-pointer">
                        </label>
                        <div class="absolute bottom-0 w-full p-1">
                            <div class="flex justify-end gap-1">
                                <EditImage :image="image" :customroute="'admin.service.image.update'"/>
                                <DeleteImage 
                                    :image="image" 
                                    :customroute="'admin.service.image.destroy'"
                                    @imagedeleted="fetchImages()"
                                    />
                            </div>
                        </div>
                    </div>
                    <div v-if="image.description||image.title" class="mt-2 uppercase p-2 text-sm">
                        <h3 class="font-bold text-blue-600 border-b border-blue-300 mb-1">{{ image.title }}</h3>
                        <p>{{ image.description }}</p>
                    </div>
                </div>
            </div>
        </div>


        <Modal :show="show" :closeable="true">
            <div v-if="inProgress" class="p-6 h-36 flex justify-center items-center">
                <Spinner :has-text="true" :text="'Deleting Images...'"/>
            </div>
        </Modal>

    </div>

</DashboardLayout>

</template>
