<script setup>
import Job from './Job.vue';

const props = defineProps({
    jobs: {
        type:Array,
        required:true
    },
    appliedJobsId: {
        type:Array
    }
});

</script>

<template>
    <div class="mx-8">
        <h2 class="text-xl font-bold underline mb-5">Latest Jobs</h2>
        <Job :jobs="jobs" :appliedJobsId="appliedJobsId"/>
    </div>
</template>


<style scoped>

</style>