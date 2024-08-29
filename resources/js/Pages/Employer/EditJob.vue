<script setup>
import Navbar from "@/Components/Navbar.vue";
import Form from "@/Components/Employer/Form.vue";
import { Head } from "@inertiajs/vue3";

const props = defineProps({
    locations: {
        type: Array,
        default: []
    },
    categories: {
        type: Array,
        default: []
    },
    jobTypes: {
        type: Array,
        default: []
    },
    job:{
        type:Object,
        default: {}
    }
});


</script>

<template>
    <Head title="Edit Job" />
    <div class="mb-4">
        <Navbar />
        <Form 
            :locations="locations"
            :categories="categories"
            :jobTypes="jobTypes"
            :job="job"
        />
    </div>
</template>