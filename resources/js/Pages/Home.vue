<script setup>
import Navbar from '../Components/Navbar.vue'
import Banner from '../Components/Banner.vue'
import LatestJobs from '../Components/LatestJobs.vue'
import Partners from '../Components/Partners.vue'
import Footer from '../Components/Footer.vue'
import { Head } from '@inertiajs/vue3'

defineProps({
    jobs: {
        type:Array,
        required:true
    },
    partners: {
        type: Array,
        required:true
    },
    appliedJobsId: {
        type:Array
    },
    jobsLength: {
        type: Number,
        default: 0
    },
    partnersLength : {
        type: Number,
        default:0
    }
});
</script>

<template>
    <Head title="Home"/>
    <div>
        <Navbar/>
        <Banner :jobsLength="jobsLength" :partnersLength="partnersLength"/>
        <LatestJobs :jobs="jobs" :applied-jobs-id="appliedJobsId"/>
        <Partners :partners="partners"/>
        <Footer/>
    </div>
</template>


<style scoped>

</style>