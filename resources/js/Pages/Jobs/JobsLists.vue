<script setup>
import Navbar from '../../Components/Navbar.vue';
import JobsFilter from '../../Components/JobsFilter.vue';
import Job from '../../Components/Job.vue';
import Pagination from '../../Components/Pagination.vue';
import Footer from '../../Components/Footer.vue'
import { ref } from 'vue';
import { Head, router } from '@inertiajs/vue3';

const props = defineProps({
    jobs :{
        type:Object,
        required:true
    },
    appliedJobsId: {
        type: Array
    },
    locations: {
        type:Array,
        default: []
    },
    categories: {
        type:Array,
        default: []
    },
    jobTypes: {
        type:Array,
        default: []
    },
    jobsLength: {
        type: Number,
        default: 0
    }
});

let url = ref('/jobs?');
let filters = ref([]);

let filteredBySearch = (position) => {
    filters.value.push(`position=${position}`);
    filteredBy();
}

const filteredByLocation = (location) => {
    filters.value.push(`location=${location}`);
    filteredBy();
}

const filteredByCategory = (category) => {
    filters.value.push(`category=${category}`);
    filteredBy();
}

const filteredByJobType = (jobType) => {
    filters.value.push(`jobType=${jobType}`);
    filteredBy();
}

const filteredByDate = (val) => {
    router.get(`/jobs?sortByDate=${val}`,{},{
        preserveScroll:true,
        preserveState:true
    });
}

//helper function
const filteredBy = () => {
    let fullURL = url.value += filters.value.join('&');
    router.get(fullURL,{},{
        preserveScroll:true,
        preserveState:true
    });
};

const reset = () => {
    url.value = '/jobs';
    filters.value = [];
    router.get(url.value);
}

</script>


<template>
    <Head title="Jobs Lists"/>
    <div>
        <Navbar/>
        <div>
            <JobsFilter 
                :locations="locations"
                :categories="categories"
                :jobTypes="jobTypes"
                @filteredBySearch="(val) => filteredBySearch(val)"
                @filteredByLocation="(val) => filteredByLocation(val)"
                @filteredByCategory="(val) => filteredByCategory(val)"
                @filteredByJobType="(val) => filteredByJobType(val)"
                @filteredByDate="(val) => filteredByDate(val)"
                @reset="reset"
            />
            <div class="max-w-[1400px] m-auto mt-6" v-if="jobsLength > 0">
                <div v-if="jobs.data.length > 0">
                    <Job :jobs="jobs.data" :appliedJobsId="appliedJobsId"/>
                    <Pagination :paginate="jobs"/>
                </div>
                <div v-else>
                    <p class="font-medium text-center text-lg">Jobs doesn't have what you are looking! </p>
                </div>
            </div>
            <p v-else class="font-medium text-center text-lg">We don't have any jobs!</p>
            <Footer/>
        </div>
    </div>
</template>