import { defineStore } from "pinia";
import axios from '../axios'

export const useTechnologiesStore = defineStore('technologies', {
    state: ()=>({
        technologies:[],
        isfetching: false,
    }),
    actions: {
        async fetchTechnologies()
        {
            this.isfetching = true;
            const fetchedItems = await axios.get(`/site-technologies`);
            this.technologies = fetchedItems.data.data;
            this.isfetching = false;

        },


    }
})





