<script setup>
import DashboardLayout from '@/Layouts/DashboardLayout.vue';
import { Head} from '@inertiajs/vue3';
// import BarChart from '@/Components/charts/BarChart.vue'


</script>

<template>
<Head title="Dashboard" />

<DashboardLayout>
    <div class="pb-4">
        <h2 class="font-bold text-xl mt-2">Overview.</h2>
    </div>
    <div class="grid grid-cols-3 gap-4 mb-12">
        <div class="p-4 rounded-lg bg-white shadow-md overflow-hidden h-28 border-b-2 border-blue-500">
            <h4 class="text-slate-400">SITE VISITS</h4>
            <div class="flex justify-between">
                <p class="font-bold text-4xl text-blue-500">754</p>
            </div>
        </div>
    </div>
    
    <div class="grid grid-cols-3 gap-4">
        <div class="col-span-2">
            
            <!-- <BarChart /> -->
        </div>
        <div class="col">
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid nesciunt vel, amet esse explicabo qui dignissimos, dolor accusantium repellendus expedita vitae temporibus aut rerum magni, hic consectetur nulla. Soluta, cupiditate?
        </div>
    </div>


</DashboardLayout>

</template>
