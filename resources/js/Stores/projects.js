import { defineStore } from "pinia";
import axios from '../axios'

export const useProjectsStore = defineStore('projects', {
    state: ()=>({
        allprojects:[],
        featured:[],
        published:[],
        isFetching: false,
    }),
    actions: {
        async fetchAllProjects()
        {
            this.isFetching = true;
            const fetchedItems = await axios.get(`/all-projects`);
            this.allprojects = fetchedItems.data;
            this.isFetching = false;
        },
        async fetchFeaturedProjects()
        {
            this.isFetching = true;
            await new Promise((res)=>setTimeout(res, 1200));
            const fetchedItems = await axios.get(`/featured-projects`);
            this.featured = fetchedItems.data.data;
            this.isFetching = false;
        },
        async fetchPublishedProjects()
        {
            this.isFetching = true;
            const fetchedItems = await axios.get(`/published-projects`);
            this.published = fetchedItems.data.data;
            this.isFetching = false;
        },


    }
})





