import { defineStore } from "pinia";

export const useQuotationsStore = defineStore('quotations', {
    state: ()=>({
        quote: [],
        totalCost: 0,
        totalDays: 0,
    }),

    getters: {

    },

    actions: {
        addFeatureToQuote(feature){
            this.quote.push(feature)
            this.calculateTotalCost()
            this.calculateTotalDays()
        },
        removeFeatureFromQuote(id){
            this.quote = this.quote.filter((feature)=> feature.id !=id)
            this.calculateTotalCost()
            this.calculateTotalDays()
        },
        
        // calculateTotalCost(){ The reduce method accumulates the value even after removing the featue - need to find a way of clearing the accumulator
        //     this.totalCost = this.quote.reduce((accumulator, feature)=>accumulator + parseInt(feature.cost), this.totalCost)
        //     return this.totalCost
        // },   
        
        
        calculateTotalCost(){
            let sum = 0;
            for(const item of this.quote){
                sum += parseInt(item.cost)
            }

            this.totalCost = sum;
        },      
   
        calculateTotalDays(){
            let days = 0;
            for(const item of this.quote){
                days += parseInt(item.completion_days)
            }
            this.totalDays = days;
        },
        clearQuote(){
            this.quote = [];
            this.totalCost = 0;
            this.totalDays = 0;
        }      
    }
    
})