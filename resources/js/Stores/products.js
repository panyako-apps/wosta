import { defineStore } from "pinia";
import axios from '../axios'

export const useProductsStore = defineStore('products', {
    state: ()=>({
        allproducts:[],
        featured:[],
        published:[],
        categories: [],
        isFetching: false,
    }),
    actions: {
        async fetchAllProducts()
        {
            this.isFetching = true;
            await new Promise((res)=>setTimeout(res, 800))
            const fetchedItems = await axios.get(`/all-products`);
            this.allproducts = fetchedItems.data.data;
            this.isFetching = false;
        },
        async fetchFeaturedProducts()
        {
            this.isFetching = true;
            await new Promise((res)=>setTimeout(res, 500))
            const fetchedItems = await axios.get(`/featured-products`);
            this.featured = fetchedItems.data.data;
            this.isFetching = false;
        },
        async fetchPublishedProducts()
        {
            this.isFetching = true;
            await new Promise((res)=>setTimeout(res, 500))
            const fetchedItems = await axios.get(`/published-products`);
            this.published = fetchedItems.data.data;
            this.isFetching = false;
        },
        async fetchProductCategories()
        {
            this.isFetching = true;
            await new Promise((res)=>setTimeout(res, 500))
            const fetchedItems = await axios.get(`/product-categories`);
            this.categories = fetchedItems.data;
            this.isFetching = false;
        },
        async fetchFilteredProducts(id)
        {
            this.published = [];
            this.isFetching = true;
            await new Promise((res)=>setTimeout(res, 500))
            const fetchedItems = await axios.get(`/filtered-products/${id}`);
            this.published = fetchedItems.data.data;
            this.isFetching = false;
        },


    }
})





