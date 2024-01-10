import { defineStore } from "pinia";
import axios from '../axios'

export const useReviewStore = defineStore('reviews', {
    state: ()=>({
        reviews:[],
        fetchingData:false,
        page: 1,
        lastPage: 1,
        totalReviews: 0,
        featuredReviews: [],

    }),
    actions: {
        async fetchAllReviews()
        {
            const fetchedItems = await axios.get(`/site-reviews`);
            this.reviews = fetchedItems.data.data;
            this.lastPage = fetchedItems.data.meta.last_page;
            this.page = fetchedItems.data.meta.current_page;
            this.totalReviews = fetchedItems.data.meta.total;
        },
        async fetchReviews()
        {
            const fetchedItems = await axios.get(`/published-site-reviews`);            
            this.reviews = fetchedItems.data.data;
            this.lastPage = fetchedItems.data.meta.last_page;
            this.page = fetchedItems.data.meta.current_page;
            this.totalReviews = fetchedItems.data.meta.total;
          
        },
        async reloadReviews(page)
        {
            const fetchedItems = await axios.get(`/published-site-reviews?page=${page}`);
            this.reviews.push(...fetchedItems.data.data);
        },

        async getItemsOnScroll()
        {
            if(this.page<this.lastPage)
            {
                if(this.page === this.lastPage) return;
                this.page +=1; 
            }

            this.fetchingData = true;
            
            await new Promise((res)=>setTimeout(res, 200));
            
            try
                {
                    await this.reloadReviews(this.page);
                }
            catch (err)
                {
                    console.log(err);
                }
        
            this.fetchingData = false;   
        },
        async fetchFeaturedReviews()
        {
            const fetchedItems = await axios.post(route('featured.user.review'))
            this.featuredReviews = fetchedItems.data.data;
        },

    }
})





