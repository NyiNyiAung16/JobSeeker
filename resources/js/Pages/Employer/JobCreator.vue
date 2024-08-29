<script setup>
import Navbar from "../../Components/Navbar.vue";
import Form from "../../Components/Employer/Form.vue";
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
    }
});


</script>

<template>
    <Head title="Job Creator" />
    <div class="mb-4">
        <Navbar />
        <Form 
            :locations="locations"
            :categories="categories"
            :jobTypes="jobTypes"
        />
    </div>
</template>
