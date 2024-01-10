import { defineStore } from "pinia";
import axios from '../axios'

export const useStaffMembersStore = defineStore('staffmembers', {
    state: ()=>({
        staffmembers:[],
        isfetching: false,
    }),
    actions: {
        async fetchStaffMembers()
        {
            this.isfetching = true;
            const fetchedItems = await axios.get(`/site-staff-members`);
            this.staffmembers = fetchedItems.data.data;
            this.isfetching = false;

        },


    }
})





