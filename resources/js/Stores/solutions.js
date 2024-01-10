import { defineStore } from "pinia";
import axios from '../axios'

export const useSiteSolutionsStore = defineStore('sitesolutions', {
    state: ()=>({
        solutions:[],
        isFetching: false,
    }),
    actions: {
        async fetchSolutions()
        {
            this.isFetching = true;
            await new Promise((res)=>setTimeout(res, 800));
            const fetchedItems = await axios.get(`/site-settings`);
            this.solutions = fetchedItems.data.data;
            this.isFetching = false;

        },


    }
})





