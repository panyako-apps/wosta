import { defineStore } from "pinia";
import axios from '../axios'

export const useSiteImagesStore = defineStore('siteimages', {
    state: ()=>({
        images:[],
        fetchingData:false,
        page: 1,
        lastPage: 1,
        totalImages: 0,
    }),
    actions: {
        async fetchImages()
        {
            const fetchedItems = await axios.get(`/site-images`);
            console.log(fetchedItems)
            this.images = fetchedItems.data.data;
            this.lastPage = fetchedItems.data.meta.last_page;
            this.page = fetchedItems.data.meta.current_page;
            this.totalImages = fetchedItems.data.meta.total;
          
        },
        async reloadImages(page)
        {
            const fetchedItems = await axios.get(`/site-images?page=${page}`);
            this.images.push(...fetchedItems.data.data);
        },

        async getItemsOnScroll()
        {
            if(this.page<this.lastPage)
            {
                if(this.page === this.lastPage) return;
                this.page +=1; 
            }

            this.fetchingData = true;
            
            await new Promise((res)=>setTimeout(res, 2000));
            
            try
                {
                    await this.reloadImages(this.page);
                }
            catch (err)
                {
                    console.log(err);
                }
        
            this.fetchingData = false;   
        }
    }
})





