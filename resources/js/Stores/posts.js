import { defineStore } from "pinia";
import axios from '../axios'

export const usePostsStore = defineStore('posts', {
    state: ()=>({
        allposts:[],
        featured:[],
        published:[],
        related:[],
        isFetching: false,
        currentPage: 1,
        lastPage: 1
    }),
    actions: {
        async fetchPublishedPosts(page) {
            this.isFetching = true;
            await new Promise((res)=>setTimeout(res, 800));
            const fetchedposts = await axios.get(`/posts?page=${page}`);
            this.currentPage = fetchedposts.data.meta.current_page;
            this.lastPage = fetchedposts.data.meta.last_page;
            this.published.push(...fetchedposts.data.data);
            this.isFetching = false;
        },
        async fetchFeaturedPosts()
        {
            this.isFetching = true;
            await new Promise((res)=>setTimeout(res, 800));
            const fetchedItems = await axios.get(`/featured-posts?page=${page}`);
            this.featured = fetchedItems.data.data;
            this.isFetching = false;
        },
        async fetchRelatedPosts(post_id, category_id)
        {
            this.isfetching = true;
            await new Promise((res)=>setTimeout(res, 500));
            const fetchedItems = await axios.get(`/related-posts/${post_id}/${category_id}`);
            this.related = fetchedItems.data.data;
            this.isfetching = false;
        },
        async fetchPostsByCategory(category_id)
        {
            this.isfetching = true;
            await new Promise((res)=>setTimeout(res, 500));
            const fetchedItems = await axios.get(`/posts-by-category/${category_id}?page=${page}`);
            this.published = fetchedItems.data.data;
            this.isfetching = false;
        },

        async fetchFilteredPosts(id)
        {
            this.published = [];
            this.isFetching = true;
            await new Promise((res)=>setTimeout(res, 500))
            const fetchedItems = await axios.get(`/filtered-posts/${id}`);
            this.published = fetchedItems.data.data;
            this.isFetching = false;
        },


    }
})





