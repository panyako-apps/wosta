<template>
    <div @mouseenter="increaseCounter" @mouseleave="decreaseCounter" class="border-2 border-slate-200 bg-slate-100 text-center h-64 relative flex items-center justify-center">
        <div class="" :class="[active ? 'bg-primary' : 'bg-transparent']" :style="{ width: counter + '%', height: counter + '%' }"></div>
        <div class="absolute inset-0 z-20 p-8">
            <div class="mx-auto h-32 w-32 rounded-full overflow-hidden shrink-0 bg-slate-300 border-4 border-white shadow-md mb-4">
              <img :src="props.staff.image" alt="" class="w-full h-full object-cover">
            </div>
            <a href="/" class="text-xl font-bold" :class="[active ? 'text-white' : 'text-primary ']">{{props.staff.title}} {{props.staff.name}}</a>
            <p :class="[active ? 'text-white' : 'text-slate-500 ']">{{props.staff.job_title}}</p>
        </div>
        <div class="absolute top-[50%] -translate-y-[50%] translate-x-[50%] right-0 w-12 h-32 rounded-full bg-slate-50 border-2 border-slate-200 z-30">
            <div class="relative flex flex-col justify-around h-full">
                <font-awesome-icon icon="fa-envelope" class="hover:text-secondary cursor-pointer"></font-awesome-icon>
                <hr class="w-[80%] mx-auto border-b ">
                <font-awesome-icon 
                    icon="fa-share-alt" 
                    class="hover:text-secondary cursor-pointer"
                    @mouseenter="toggleButtons" 
                    @mouseleave="toggleButtons"
                    >
                </font-awesome-icon>

            <TransitionGroup 
                tag="div"
                enter-from-class="-translate-y-full opacity-0"
                enter-active-class="duration-500"
                leave-active-class="duration-500"
                leave-to-class="-translate-y-full opacity-0"
                class="">
                <div :class="[showShareButtons ? 'flex' : 'hidden']" class="absolute bottom-0 -translate-x-full items-center">
                    <div class="flex gap-2 bg-white p-3 rounded-md shadow">
                        <font-awesome-icon icon="fab fa-facebook" class="hover:text-secondary cursor-pointer"></font-awesome-icon>
                        <font-awesome-icon icon="fab fa-instagram" class="hover:text-secondary cursor-pointer"></font-awesome-icon>
                        <font-awesome-icon icon="fab fa-pinterest" class="hover:text-secondary cursor-pointer"></font-awesome-icon>
                    </div>
                    <font-awesome-icon icon="fa-caret-right" class="text-slate-400 text-2xl"></font-awesome-icon>
                </div>
            </TransitionGroup>
            </div>
        </div>
    </div>
  </template>
  
  <script setup>
  import { ref } from "vue";
  
  const props = defineProps({
    staff: Object
  })

  const active = ref(false);
  let counter = ref(0);
  let intervalId = null;
  const showShareButtons = ref(false)

  const increaseCounter = () => {
    active.value = true;
  
    counter.value = 0;
  
    clearInterval(intervalId); // Clear the previous interval
  
    intervalId = setInterval(() => {
      counter.value++;
      if (counter.value === 100) {
        clearInterval(intervalId);
      }
    }, 5);
  };
  
  const decreaseCounter = () => {
    counter.value = 100;
  
    clearInterval(intervalId); // Clear the previous interval
  
    intervalId = setInterval(() => {
      counter.value--;
      if (counter.value === 0) {
        clearInterval(intervalId);
        active.value = false;
      }
    }, 5); 
  };

  const toggleButtons = () =>{
    showShareButtons.value = !showShareButtons.value
  }

  </script>
  