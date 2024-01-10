<template>
    <div class="flex items-center gap-2">
      <div class="h-12 w-12 bg-secondary rounded-full text-white shrink-0 flex items-center justify-center">
        <img src="/storage/globals/logo.jpg" alt="" class="w-full h-full object-cover">
      </div>
      <div class="h-full border-r border-r-secondary lg:mx-2"></div>
      <h1 v-show="showTitle" class=""><span class="text-primary font-bold text-xl">Wosta Consult. </span> </h1>
    </div>
  </template>
  <script setup>
  defineProps({
    showTitle:{
      type: Boolean,
      default: true
    } 
    
  })
  </script>