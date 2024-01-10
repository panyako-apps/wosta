import { reactive } from "vue";

export default reactive({
    items: [
        // {message: "Message One"},
        // {message: "Message Two"},
        // {message: "Message Three"},
    ],

    add(toast){
        this.items.unshift({
            key: Symbol(),
            ...toast
        })
    }, 

    remove(index){
        this.items.splice(index, 1)
    }
})