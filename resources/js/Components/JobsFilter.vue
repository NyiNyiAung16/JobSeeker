<script setup>
import { Head } from "@inertiajs/vue3";
import { ref } from "vue";

defineProps({
    locations: {
        type: Array,
        required: true,
    },
    categories: {
        type: Array,
        required: true,
    },
    jobTypes: {
        type: Array,
        required: true,
    },
});

defineEmits([
    "filteredBySearch",
    "filteredByLocation",
    "filteredByCategory",
    "filteredByJobType",
    "filteredByDate",
    "reset",
]);

let search = ref("");
let location = ref("default");
let category = ref("default");
let job_type = ref("default");
let filteredByDate = ref("asc");
</script>

<template>
    <Head title="Jobs" />
    <div class="jobs-filter-container">
        <input
            type="text"
            class="filter"
            placeholder="Search by position..."
            v-model="search"
            @keydown.enter="$emit('filteredBySearch', search)"
        />
        <select
            class="filter"
            v-model="location"
            @change="$emit('filteredByLocation', location)"
        >
            <option disabled selected value="default">Location</option>
            <option
                v-for="location in locations"
                :key="location.id"
                :value="location.name"
            >
                {{ location.name }}
            </option>
        </select>
        <select
            class="filter"
            v-model="category"
            @change="$emit('filteredByCategory', category)"
        >
            <option disabled selected value="default">Category</option>
            <option
                v-for="category in categories"
                :key="category.id"
                :value="category.type"
            >
                {{ category.type }}
            </option>
        </select>
        <select
            class="filter"
            v-model="job_type"
            @change="$emit('filteredByJobType', job_type)"
        >
            <option disabled selected value="default">Job Type</option>
            <option
                v-for="jobType in jobTypes"
                :key="jobType.id"
                :value="jobType.name"
            >
                {{ jobType.name }}
            </option>
        </select>
        <button
            class="inline-block bg-gray-400 text-white p-2 rounded font-medium hover:bg-opacity-90 duration-100"
            @click="$emit('reset')"
        >
            Reset
        </button>
    </div>
    <div class="max-w-[1400px] m-auto flex justify-between items-center">
        <h3 class="text-xl font-semibold underline">Jobs</h3>
        <select
            v-model="filteredByDate"
            @change="$emit('filteredByDate', filteredByDate)"
            class="bg-[#c7c7c7] p-1 rounded outline-none border-none"
            id="hideArrow"
        >
            <option value="desc">Posted Date</option>
            <option value="asc">Relevence</option>
        </select>
    </div>
</template>

<style scoped>
.jobs-filter-container {
    max-width: 600px;
    background-color: #c7c7c7;
    margin: 20px auto;
    padding: 10px 15px;
    display: flex;
    flex-direction: column;
    gap: 20px;
    border-radius: 5px;
}

.jobs-filter-container .filter {
    background-color: #d9d9d9;
    padding: 7px;
    border: none;
    border-radius: 5px;
    outline: none;
}

#hideArrow {
    background-image: none;
}
</style>
