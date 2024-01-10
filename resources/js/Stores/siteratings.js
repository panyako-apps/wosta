import { defineStore } from "pinia";
import axios from '../axios'

export const useSiteRatingsStore = defineStore('siteratings', {
    state: ()=>({
        ratings:[],
        stars:0,
        average:0,
        one_stars: 0,
        two_stars: 0,
        three_stars: 0,
        four_stars: 0,
        five_stars: 0,

    }),
    actions: {
        async fetchRatings()
        {
            const fetchedItems = await axios.get(`/site-ratings`);
            this.ratings = fetchedItems.data;
            this.calculateTotalStars();
            this.splitStars(this.ratings)
        },
        calculateTotalStars(){
            let sum = 0;
            for(const item of this.ratings){
                sum += parseInt(item.rating);
                this.stars = sum;
            }
            this.average = this.stars/this.ratings.length;
        },
        splitStars(ratings){
            this.one_stars = ratings.filter(item=>item.rating===1);
            this.two_stars = ratings.filter(item=>item.rating===2);
            this.three_stars = ratings.filter(item=>item.rating===3);
            this.four_stars = ratings.filter(item=>item.rating===4);
            this.five_stars = ratings.filter(item=>item.rating===5);
        }  

    }
})





