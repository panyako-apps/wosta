import { defineStore } from "pinia";
import axios from '../axios'

export const useCommentStore = defineStore('Comments', {
    state: ()=>({
        comments:[],
        fetchingData:false,
        page: 1,
        lastPage: 1,
        totalComments: 0,
        featuredComments: [],

    }),
    actions: {
        async fetchAllComments()
        {
            const fetchedItems = await axios.get(`/site-comments`);
            this.comments = fetchedItems.data.data;
            this.lastPage = fetchedItems.data.meta.last_page;
            this.page = fetchedItems.data.meta.current_page;
            this.totalComments = fetchedItems.data.meta.total;
        },
        async fetchComments()
        {
            const fetchedItems = await axios.get(`/published-site-comments`);
            this.comments = fetchedItems.data.data;
            this.lastPage = fetchedItems.data.meta.last_page;
            this.page = fetchedItems.data.meta.current_page;
            this.totalComments = fetchedItems.data.meta.total;
          
        },
        async reloadComments(page)
        {
            const fetchedItems = await axios.get(`/site-comments?page=${page}`);
            this.comments.push(...fetchedItems.data.data);
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
                    await this.reloadComments(this.page);
                }
            catch (err)
                {
                    console.log(err);
                }
        
            this.fetchingData = false;   
        },
        async fetchFeaturedComments()
        {
            const fetchedItems = await axios.post(route('featured.user.review'))
            this.featuredComments = fetchedItems.data.data;
            console.log(this.featuredComments)
        },

    }
})





