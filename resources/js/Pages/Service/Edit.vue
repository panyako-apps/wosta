<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import { Head, Link, useForm, router } from '@inertiajs/vue3';

const props = defineProps({
    product: Object,
    categories: Array,
});
const updateProductForm = useForm({
    name: props.product.name,
    price: props.product.price,
    description: props.product.description,
    coverimage: props.product.coverimage,
    slug: props.product.slug,
    category: props.product.product_category_id,
})

function updateProduct() {
    router.post(route('product.update', props.product.id), {
    _method: 'put',

    name: updateProductForm.name,
    price: updateProductForm.price,
    description: updateProductForm.description,
    coverimage: updateProductForm.coverimage,
    slug: updateProductForm.slug,
    category: updateProductForm.category,


    })
}

</script>

<template>
 <Head :title="'Update : '+props.product.name" />

<GuestLayout>
    <template #header>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Update: {{props.product.name}}
        </h2>
    </template>

    <div class="py-12 min-h-screen">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-4 flex justify-between">
                <Link :href="route('vendor.show', props.product.product_vendor.slug)" class="rounded-full hover:border-none bg-gradient-to-r from-pink-500 to-yellow-500 px-4 py-1 text-sm font-medium text-white hover:shadow-md outline-none  ring-1 hover:ring-2 ring-gray-400 hover:ring-red-200 ring-offset-2">Back</Link>
                <div class="">
                    <span class="capitalize text-white font-bold bg-gray-400 rounded-full py-1 px-4">{{props.product.name}}.</span>
                </div>
            </div>
            
            <div class=" bg-white shadow-md px-6 py-8 rounded-lg">
                <form @submit.prevent="updateProduct">
                    <div class="mb-3">

                        <div class="">
                            <label for="name" class="block text-sm font-medium text-gray-700">Product Name</label>
                            <input type="text" name="name" id="name" autocomplete="name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                            
                            v-model="updateProductForm.name"
                            >
                        </div>
                        <!-- <div class="">
                            <label for="slug" class="block text-sm font-medium text-gray-700">Slug URL</label>
                            <input type="text" name="slug" id="slug" autocomplete="slug" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                            
                            v-model="updateProductForm.slug"
                            >
                        </div> -->
                        
                    </div>
                    
                    <div class="grid grid-cols-2 gap-4 mb-3">
                        <div class="">
                            <label for="category" class="block text-sm font-medium text-gray-700">Product Category</label>
    
                            <select name="category" id="category" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                            
                            v-model="updateProductForm.category"
                            >
                                <option v-for="category in props.categories" :key="category.id" :value="category.id">{{category.name}}</option>
    
                            </select>
                        </div>
                        <div class="">
                            <label for="price" class="block text-sm font-medium text-gray-700">Price</label>
                            <input type="number" name="price" id="price" autocomplete="price" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                            v-model="updateProductForm.price"
                            
                            >
                        </div>
                        
                    </div>
                    <div class="mb-3">
                        <label for="coverimage" class="form-label inline-block text-gray-700">Cover coverImage</label>
                        <input class="form-control
                        block
                        w-full
                        p-1
                        text-base
                        font-normal
                        text-gray-700
                        bg-white bg-clip-padding
                        border border-solid border-gray-300
                        rounded
                        transition
                        ease-in-out
                        m-0
                        focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" type="file" id="image"
                        @input="updateProductForm.coverimage = $event.target.files[0]" 
                        >
                    </div>

                    <div class="mb-3">
                        <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                        <textarea name="description" id="description" rows="8" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                        
                        v-model="updateProductForm.description"
                        
                        ></textarea>
                    </div>



                    <button type="submit" class="rounded-full hover:border-none bg-gradient-to-r from-pink-500 to-yellow-500 px-4 py-1 text-sm font-medium text-white hover:shadow-md outline-none  ring-1 hover:ring-2 ring-gray-400 hover:ring-red-200 ring-offset-2">Submit</button>

                </form>

            </div>
        </div>
    </div>
</GuestLayout>
</template>
