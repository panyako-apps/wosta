<script setup>
import { router, useForm,  } from '@inertiajs/vue3';
import { onMounted, ref } from 'vue';
import axios from 'axios';

const props = defineProps({
    viewable_type: String,
    viewable_id: Number,

});

const views = ref([]);

const form = useForm({
    viewable_id: props.viewable_id,
    viewable_type: props.viewable_type,
});

const viewModel = () =>{
    form.post(route('model.view.store'), {
        viewable_id: form.viewable_id, 
        viewable_type:form.viewable_type,
    }) 
}

const fetchViews = async ()=>{
   const res = await axios.post(route('model.views.get'),{
        viewable_id: form.viewable_id,
        viewable_type: form.viewable_type
    })
    views.value = res.data;

}

onMounted(async ()=>{
    viewModel();
    await fetchViews();
});

</script>

<template>
    <span class="flex items-center gap-1">
        <font-awesome-icon icon="fa-eye"></font-awesome-icon>
        {{ views.length }} 
        <span v-if="views===1">view</span>
        <span v-else>views</span>
    </span>
</template>


