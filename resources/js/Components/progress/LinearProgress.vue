<template>
    <div class="text-primary font-bold text-md">
        <div class="bg-slate-100 px-4 py-1.5 flex gap-2 justify-between mb-1">
            <p class="">{{props.text}}</p>
        </div>
        <div class="bg-gradient-to-r from-primary to-secondary h-1 relative rounded-r-xl" :style="{ width: counter + '%' }">
            <div class="absolute -top-8 right-0 ">{{ counter }}%</div>
        </div>
    </div>


  </template>
  
  <script setup>
  import { onMounted, ref } from "vue";
  
  const props = defineProps({
    progressEndValue: {
      type: Number,
      default: 90
    },
    text: {
        type: String,
        default: 'Progress'
    }
  });
  
  let counter = ref(0);
  
  onMounted(() => {
    let progress = setInterval(() => {
      counter.value++;  
      if (counter.value === props.progressEndValue) {
        clearInterval(progress);
      }
    }, 20);
  });


  </script>
  