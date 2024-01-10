import { defineStore } from "pinia";
import axios from '../axios'

export const useSiteSettingsStore = defineStore('sitesettings', {
    state: ()=>({
        settings:[],
        isFetching: false,
    }),
    actions: {
        async fetchSettings()
        {
            
            this.isFetching = true;
            await new Promise((res)=>setTimeout(res, 800));
            const fetchedItems = await axios.get(`/site-settings`);
            this.settings = fetchedItems.data.data;
            console.log(this.settings)
            this.isFetching = false;

        },


    }
})





