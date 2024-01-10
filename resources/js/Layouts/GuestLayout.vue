<script setup>
import TopNavigation from '@/Components/navigation/TopNavigation.vue';
import { useSiteSolutionsStore } from '@/Stores/solutions';
import { Link } from '@inertiajs/vue3';
import { onMounted } from 'vue';

const store = useSiteSolutionsStore();

onMounted(async ()=>{
    await store.fetchSolutions()
    console.log(store.solutions)
})

</script>


<template>
    <div class="min-h-screen h-auto flex flex-col justify-between bg-white text-slate-500">

        <div class="">
            <div class="h-12 bg-primary text-white text-sm hidden md:block">
                <div class="mx-auto h-full flex items-center justify-between  px-4 xl:px-16">
                    <div class="flex gap-8">
                        <span class="text-secondary">Email: 
                            <span class="text-white">info@wostaconsult.com</span>
                        </span>
                        <span class="text-secondary">Call Now: 
                            <span class="text-white">+31 6 36387766 / +31 6 19757288</span>
                        </span>
                    </div>
                    <div class="text-white flex justify-end gap-1">
                        <Link :href="''" class="flex items-center gap-1">
                            Instagram
                            <div class="h-1.5 w-1.5 rounded-full shrink-0 bg-secondary"></div>
                        </Link>
                        <Link :href="''" class="flex items-center gap-1">
                            Facebook
                            <div class="h-1.5 w-1.5 rounded-full shrink-0 bg-secondary"></div>
                        </Link>
                        <Link :href="''" class="flex items-center gap-1">
                            Twitter
                            <div class="h-1.5 w-1.5 rounded-full shrink-0 bg-secondary"></div>
                        </Link>
                        <Link :href="''" class="flex items-center gap-1">
                            LinkedIn
                        </Link>

                    </div>
                </div>
            </div>
            <TopNavigation />
            <!-- Page Content -->
            <main class="mx-auto max-w-[1920px]">
                <!-- <ToastList></ToastList> -->
                <slot />
            </main>
        </div>

        <section class="lg:h-[25rem] text-white relative">
            <img src="https://w7.pngwing.com/pngs/302/241/png-transparent-city-landscape-illustration-city-of-melbourne-new-york-city-drawing-skyline-sketch-pencil-pencil-city-monochrome.png" alt="" class="w-full h-full object-cover z-10 hidden lg:block">

            <div class="lg:absolute lg:inset-0 bg-primary bg-opacity-90 z-20 py-12 px-6">
                <div class="max-w-7xl mx-auto grid lg:grid-cols-4 gap-8 h-full">
                    <div class="">
                        <h4 class="font-bold text-lg mb-4">Imagine a better future</h4>
                        <p class="mb-6 text-sm">Lorem ipsum dolor sit amet consectetur adipisicing elit. Eligendi eius ducimus inventore fugit ratione pariatur.</p>
                        
                        <h4 class="font-bold text-lg mb-4">Quick Links</h4>
                        <div class="grid grid-cols-2 gap-4 mb-6 text-sm">
                            <div class="space-x-2">
                                <font-awesome-icon icon="fa-plus"></font-awesome-icon>
                                <span>Business</span>
                            </div>
                            <div class="space-x-2">
                                <font-awesome-icon icon="fa-plus"></font-awesome-icon>
                                <span>Migrate</span>
                            </div>
                            <div class="space-x-2">
                                <font-awesome-icon icon="fa-plus"></font-awesome-icon>
                                <span>Countries</span>
                            </div>
                            <div class="space-x-2">
                                <font-awesome-icon icon="fa-plus"></font-awesome-icon>
                                <span>Evalution</span>
                            </div>
                            <div class="space-x-2">
                                <font-awesome-icon icon="fa-plus"></font-awesome-icon>
                                <span>Application</span>
                            </div>
                            <div class="space-x-2">
                                <font-awesome-icon icon="fa-plus"></font-awesome-icon>
                                <span>Classes </span>
                            </div>
                        </div>
                        <div class="flex gap-2">
                            <div class="w-8 h-8 flex items-center justify-center rounded-md bg-rose-500 text-white">
                                <font-awesome-icon icon="fab fa-instagram"></font-awesome-icon>
                            </div>
                            <div class="w-8 h-8 flex items-center justify-center rounded-md bg-blue-600 text-white">
                                <font-awesome-icon icon="fab fa-facebook"></font-awesome-icon>
                            </div>
                            <div class="w-8 h-8 flex items-center justify-center rounded-md bg-sky-500 text-white">
                                <font-awesome-icon icon="fab fa-twitter"></font-awesome-icon>
                            </div>
                            <div class="w-8 h-8 flex items-center justify-center rounded-md bg-blue-500 text-white">
                                <font-awesome-icon icon="fab fa-linkedin"></font-awesome-icon>
                            </div>
                        </div>
                    </div>
                    
                    <div class="">
                        <h4 class="font-bold text-lg mb-4">100+ Best Universities Scholarship Programs From 20 Countries</h4>
                        <p class="mb-1 text-sm">We also help with connections to universities in numerous counties across the globe </p>
                                            
                        
                        <Link :href="'/'" class="font-bold text-lg mb-4 mt-8 hover:text-secondary transition-colors duration-300 ease-in-out">Apply Now</Link>
    
                    </div>
                
                    <div class="">
                        <h4 class="font-bold text-lg mb-4">Get in Touch</h4>
                        <address class="mb-1 text-sm">Westlands Drive <br>
                            Nairobi, Kenya</address>
                        <p class="mb-1 text-sm"><span class="font-bold">Office:</span> +31 6 36387766 / +31 6 19757288</p>
                        <p class="mb-1 text-sm"><span class="font-bold">Email:</span> info@wostaconsult.com</p>
                                            
                        
                        <h4 class="font-bold text-lg mb-4 mt-8">Sign Up to get latest Updates</h4>
                        <div class="flex gap-4 items-center border-b-[0.1px]">
                            <div class="">
                                <input type="text" name="email" id="" class="bg-transparent border-none border-b-white outline-none w-full placeholder:text-blue-100 placeholder:text-xs focus:outline-none focus:ring-none focus:bg-transparent pl-0" placeholder="enter your email address">
                            </div>
                            <button>
                                <font-awesome-icon icon="fa-paper-plane" class="text-2xl"></font-awesome-icon>
                            </button>
                        </div>
                
                    </div>
                    <div class="">
                        <div class="h-[20rem] relative border-b-8 border-b-primary">
                            <img src="https://assets.vogue.com/photos/64776fac4c9f8f331d8b784d/4:3/w_964,h_723,c_limit/luggage_site.jpeg" alt="" class="w-full h-full object-cover">
                            <div class="absolute inset-0 p-4 flex items-center justify-center">
                                <div class="p-4 bg-secondary bg-opacity-60 text-white text-center rounded">
                                Give Wings To Your Dreams!
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </section>
        <div class="bg-primary h-16 px-4">
            <p class="flex items-center justify-center text-white text-sm gap-2 h-full">
                Copyright &copy; Wosta Consult, {{new Date().getFullYear()}}
            </p>
        </div>
    </div>
</template>

