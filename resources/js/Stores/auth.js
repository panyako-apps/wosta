import { defineStore } from "pinia";
import axios from "axios";

export const useAuthStore  = defineStore('auth',{
    state: ()=>({
        authUser: null,
    }),
    getters: {
        user: (state) => state.authUser
    },
    actions: {

        async getToken () {
           const res =  await axios.get('/sanctum/csrf-cookie');
        },

        // async getUser() {
        //     if(this.authUser){
        //         await this.getToken();
        //         const data = await axios.get('/api/user');
        //         this.authUser = data.data ;

        //     }
        // }
    }
});