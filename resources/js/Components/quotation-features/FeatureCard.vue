<script setup>
import { useQuotationsStore } from '@/Stores/quotations';
import { computed, ref } from 'vue';

const props  = defineProps({
    feature: Object,
})

const store = useQuotationsStore();

const isInQuote = computed(()=>{
    return store.quote.find(item => item.id == props.feature.id)?.id
})

const filterGroup = (feature)=>{
    let newQuote = store.quote.filter(item => item.category.name == feature.category.name);
    store.quote = newQuote;
}

const calculateQuote = (event, feature)=>{
    if((event.target.checked))
    {
        store.addFeatureToQuote(feature)
    }
    if((!event.target.checked))
    {
        store.removeFeatureFromQuote(feature.id)
    }
        
}

// Move To ToolTip Component Later
const isToolTipShown = ref(false)

const toggleToolTipMenu = ()=>{
    isToolTipShown.value = !isToolTipShown.value
}

</script>


<template>

    <!-- If the Category Allows For More than one Selection Use Checkboxes 
        - Otherwise Use Radio Buttons-->
    <!-- <div  class="flex flex-col items-center">
        <div class="mb-3 relative">
            <input v-if="props.feature.category.is_exclusive"
                    type="radio" 
                    :name="props.feature.category.name"
                    :id="props.feature.id"
                    @click="filterGroup(feature), calculateQuote($event, props.feature)" 
                    class="cursor-pointer w-36 h-16 border border-dashed border-blue-500 rounded-lg px-3 py-5"
                    :class="{'bg-blue-100': isInQuote}"
                    >   
            <input v-else
                    type="checkbox" 
                    :id="props.feature.id"
                    @click="calculateQuote($event, props.feature)" 
                    class="cursor-pointer w-36 h-16 border border-dashed border-blue-500 rounded-lg px-3 py-5"
                    :class="{'bg-blue-100': isInQuote}"
                    >   
            <div v-if="isInQuote" class="absolute -top-1 -right-1 h-8 w-8 rounded-full bg-blue-600">
                <div class="flex justify-center items-center h-full text-white font-bold">
                    <font-awesome-icon icon="fa-check"></font-awesome-icon>
                </div>
            </div>
        </div>
        <label :for="feature.id" class="block text-sm font-medium text-blue-700">{{feature.name}}</label>
    </div> -->

    <div  class="flex flex-col items-center" >
        <div class="relative" @mouseenter="toggleToolTipMenu" @mouseleave="toggleToolTipMenu">
            <input v-if="props.feature.category.is_exclusive"
                    type="radio" 
                    :name="props.feature.category.name"
                    :id="props.feature.id"
                    @click="filterGroup(feature), calculateQuote($event, props.feature)" 
                    class="opacity-0"
                    :class="{'bg-blue-100': isInQuote}"
                    >   
            <input v-else
                    type="checkbox" 
                    :id="props.feature.id"
                    @click="calculateQuote($event, props.feature)" 
                    class="opacity-0"
                    :class="{'bg-blue-100': isInQuote}"
                    >   
            <div v-if="isInQuote" class="absolute -top-1 -right-1 h-8 w-8 rounded-full bg-blue-600">
                <div class="flex justify-center items-center h-full text-white font-bold">
                    <font-awesome-icon icon="fa-check"></font-awesome-icon>
                </div>
            </div>
            <label :for="feature.id" 
                    class="inset-0 block text-sm font-medium text-blue-700 cursor-pointer w-36 h-24 border border-dashed border-blue-500 rounded-lg"
                    :class="{'bg-blue-100': isInQuote}"
                    >
                    <div class="flex flex-col justify-center items-center h-full text-center p-2">
                        <!-- <img :src="feature.image" alt="" class="h-12 "> -->
                        {{feature.name}}
                    </div>
            </label>
            <div v-show="isToolTipShown" class="hidden sm:block absolute top-4 -translate-y-full">
                <p class="sm:w-56 bg-slate-600 text-white p-2 rounded-b-md rounded-t-md">
                    {{ feature.description }}
                </p>
                <div class="w-56 flex pl-12">
                    <span class="w-0 h-0 
                        border-l-[10px] border-l-transparent
                        border-t-[10px] border-t-slate-600
                        border-r-[10px] border-r-transparent">
                    </span>
                </div>
            </div>
        </div>
    </div>

</template>

<style scoped>

</style>