<script setup>
const props = defineProps({
    label:{
        type: [String, Boolean],
        default: false,
    },
    name:{
        required: true,
        type: String
    },
    modelValue: {
        type: [String, Number],
        default: ""
    } 
})

const resizeTextArea = (e)=> {
    e.target.style.height = 'auto'
    e.target.style.height = `${e.target.scrollHeight}px`
}

</script>

<template>
    <label v-if="label">{{label}}</label>
    <textarea 
        v-bind="$attrs"
        :name="name" 
        :id="name" 
        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
        :value="modelValue"
        @input="$emit('update:modelValue', $event.target.value); resizeTextArea($event)"
    
    ></textarea>
</template>
