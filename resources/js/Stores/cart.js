import axios from "axios";
import { defineStore } from "pinia";
import { useLocalStorage } from "@vueuse/core";

export const useCartStore = defineStore('cart', {
    state: ()=>({
        cart: useLocalStorage('cart', []),
        cartTotal: useLocalStorage('cart_total', 0),
    }), 
    actions: {

        addToCart(product){
            this.cart.push(product);
            this.calculateTotalCost();
        }, 

        incrementQuantityInCart(id){
            let itemIndex = this.cart.findIndex(item => item.id == id);
            this.cart[itemIndex].quantity++;
            this.calculateTotalCost();
        },
        decrementQuantityInCart(id){
            let itemIndex = this.cart.findIndex(item => item.id == id);
            if(this.cart[itemIndex].quantity<2)
            {
                this.removeFromCart(id);
            }
            else{
                this.cart[itemIndex].quantity--;

            }
            this.calculateTotalCost();
        },
        removeFromCart(id){
            this.cart = this.cart.filter(item => item.id != id);
            this.calculateTotalCost();
        },

        submitOrder(){
            axios.post('/save-cart', {cart: this.cart})
            .then(response => console.log(response))
            .catch(error => console.error(error));
        },

        calculateTotalCost(){
            let sum = 0;
            for(const item of this.cart){
                sum += parseInt(item.price * item.quantity);
            }
            this.cartTotal = sum;
        }   

    }
})