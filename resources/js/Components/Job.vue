<script setup>
import BaseButton from './BaseButton.vue';

defineProps({
    'jobs' : {
        type:Array,
        default: []
    },
    'appliedJobsId' :{
        type:Array,
        default: []
    }
});


</script>

<template>
    <div class="space-y-4" v-if="!!jobs">
        <div v-bind="$attrs" class="bg-gray-300 rounded px-4 py-2" v-for="job in jobs" :key="job.id" >
            <div class="flex justify-between items-center px-3 py-2 mb-4">
                <div class="flex items-center gap-4">
                    <img :src="job.image_url ?? '/photos/banner.png'" alt="jobphoto" class="photo">
                    <div>
                        <h3 class="font-bold">{{ job.company_name }}</h3>
                        <span class="capitalize">{{ job.position }}</span>
                    </div>
                </div>
                <div class="text-end">
                    <h3 class="font-medium">Posted Date</h3>
                    <span>{{ job.created_at }}</span>
                </div>
            </div>
            <ul class="ml-5">
                <p class="mb-2 font-medium">Description</p>
                <li class="list-disc ml-4">{{ job.description }}</li>
                <p class="mt-2"><span class="font-medium">Close Date</span> - {{ job.close_date }}</p>
            </ul>
            <div class="flex justify-between items-center">
                <BaseButton body="Read More" :is-link="true" :link="route('jobs.show',job.id)" class="mt-4"/>
                <div>
                    <p v-if="appliedJobsId?.includes(job.id)" class="text-end text-blue-700 font-semibold">Applied</p>
                    <p class="font-medium">{{ job.location }}</p>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
.photo{
    width: 50px;
    height: 50px;
    border-radius: 50%;
    object-fit: cover;
    object-position: center
}

</style>