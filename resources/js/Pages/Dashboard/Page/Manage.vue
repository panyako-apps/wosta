<script setup>
import DashboardLayout from '@/Layouts/DashboardLayout.vue';
import { Head, Link} from '@inertiajs/vue3';
import Edit from './Section/Edit.vue';
import AddImages from '@/Components/image/AddImages.vue';
import DeleteImage from '@/Components/image/DeleteImage.vue'
import EditImage from '@/Components/image/EditImage.vue'
import { onMounted, ref } from 'vue';
import Dropdown from '@/Components/Dropdown.vue'
import { router } from '@inertiajs/vue3';
import Spinner from '@/Components/spinners/Spinner.vue';
import Modal from "@/Components/Modal.vue";


const props = defineProps({
    page: Object,
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

    Inertia.post(route('admin.page.images.destroy'), {
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
        }
    })
}


const fetchImages = async ()=>{
    const res = await axios.post(route('api.images.index'),
    {
        imageable_id: props.page.data.id,
        imageable_type: 'App\\Models\\Page',
        folder: 'page'
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
<Head title="Manage Page" />

<DashboardLayout>
    <div class="flex justify-between items-center mb-2">
        <h2 class="uppercase font-bold text-blue-600 text-lg">
            {{ page.data.name }}
        </h2>
        <Link :href="route('admin.pages.index')" :class="btnClasses">Back</Link>
    </div>
    <div class="">
        <h2 class="sr-only">{{ props.page.data.name }}</h2>

        <Edit :page="page.data" />

        <div v-if="page.data.name" class="">
            <div v-if="page.data.title1||page.data.description1||page.data.image1" class="border border-dashed border-slate-300 p-6 rounded-md mb-6">
                <h3 class="mb-3 font-bold text-slate-600 uppercase" v-if="page.data.title1">{{ page.data.title1 }}</h3>
                <hr class="mb-3">
                <p v-if="page.data.description1" v-html="page.data.description1"></p>
                <div v-if="page.data.image1" class="w-48 mt-4">
                    <img :src="page.data.image1" alt="" class="h-full">
                </div>
            </div>
            <div v-if="page.data.title2||page.data.description2||page.data.image2" class="border border-dashed border-slate-300 p-6 rounded-md mb-6">
                <h3 class="mb-3 font-bold text-slate-600 uppercase" v-if="page.data.title2">{{ page.data.title2 }}</h3>
                <hr class="mb-3">
                <p v-if="page.data.description2" v-html="page.data.description2"></p>
                <div v-if="page.data.image2" class="w-48 mt-4">
                    <img :src="page.data.image2" alt="" class="h-full">
                </div>
            </div>
            <div v-if="page.data.title3||page.data.description3||page.data.image3" class="border border-dashed border-slate-300 p-6 rounded-md mb-6">
                <h3 class="mb-3 font-bold text-slate-600 uppercase" v-if="page.data.title3">{{ page.data.title3 }}</h3>
                <hr class="mb-3">
                <p v-if="page.data.description3" v-html="page.data.description3"></p>
                <div v-if="page.data.image3" class="w-48 mt-4">
                    <img :src="page.data.image3" alt="" class="h-full">
                </div>
            </div>
        </div>

        <Edit :page="page.data" />

    </div>
    <div class="container mx-auto pb-6">
        <div class="">
            <div class="flex justify-between">
                <AddImages 
                    :model="props.page.data" 
                    :customroute="'admin.page.images.store'" 
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
                                <EditImage :image="image" :customroute="'admin.page.image.update'"/>
                                <DeleteImage 
                                    :image="image" 
                                    :customroute="'admin.page.image.destroy'"
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
