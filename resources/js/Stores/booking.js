import axios from "axios";
import { defineStore } from "pinia";
import { useLocalStorage } from "@vueuse/core";

export const useBookingsStore = defineStore('booking', {
    state: ()=>({
        bookings: useLocalStorage('booking', []),
        bookingsTotal: 0,
    }), 
    actions: {

        addToBook(product){
            this.bookings.push(product);
            this.calculateTotalCost();
        }, 

        incrementQuantityInBook(id){
            let itemIndex = this.bookings.findIndex(item => item.id == id);
            this.bookings[itemIndex].quantity++;
            this.calculateTotalCost();
        },
        decrementQuantityInBook(id){
            let itemIndex = this.bookings.findIndex(item => item.id == id);
            if(this.bookings[itemIndex].quantity<2)
            {
                this.removeFromBook(id);
            }
            else{
                this.bookings[itemIndex].quantity--;

            }
            this.calculateTotalCost();
        },
        removeFromBook(id){
            this.bookings = this.bookings.filter(item => item.id != id);
            this.calculateTotalCost();
        },

        submitOrder(){
            axios.post('/save-bookings', {bookings: this.bookings})
            .then(response => console.log(response))
            .catch(error => console.error(error));
        },

        calculateTotalCost(){
            let sum = 0;
            for(const item of this.bookings){
                sum += parseInt(item.price * item.quantity);
            }
            this.bookingsTotal = sum;
        }   

    }
})