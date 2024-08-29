<script setup>
import { Head, usePage } from "@inertiajs/vue3";
import BaseButton from "../../Components/BaseButton.vue";
import Job from "../../Components/Job.vue";
import Navbar from "../../Components/Navbar.vue";
import { computed } from "vue";
import '../../../css/content.css'

const props = defineProps({
    job: {
        type: Object,
        required: true,
    },
    similarJobs: {
        type: Array,
        required: true,
    },
    appliedJobsId: {
        type: Array,
    },
});

let page = usePage();

let buttonBody = computed(() => {
    let isHas = props.appliedJobsId?.includes(props.job.id);
    if (isHas) {
        return "Applied";
    } else {
        return "Apply";
    }
});

let isNotEmployee  = computed(() => page.props.auth.user?.role !== 'employee');
let isApplied = computed(() => props.appliedJobsId?.includes(props.job.id));

</script>

<template>
    <Head title="JobDetails" />
    <Navbar />
    <div class="p-6">
        <div class="bg-[#c7c7c7] rounded px-4 py-3 mb-20">
            <div class="flex justify-between items-center px-3 py-2 mb-2">
                <div class="flex items-center gap-4">
                    <img
                        :src="job.image_url"
                        alt="jobphoto"
                        class="photo"
                    />
                    <div>
                        <h3 class="font-bold">{{ job.company_name }}</h3>
                        <span class="capitalize">{{ job.position }}</span>
                    </div>
                </div>
                <div class="text-end">
                    <h3 class="font-medium">Posted Date</h3>
                    <span> {{ job.created_at }} </span
                    >
                </div>
            </div>
            <ul class="ml-5 space-y-4">
                <div class="text-sm flex items-center gap-5">
                    <p class="mt-2">
                        <span class="font-medium">Job Type</span> -
                        {{ job.job_type }}
                    </p>
                    <p class="mt-2">
                        <span class="font-medium">Category</span> -
                        {{ job.category }}
                    </p>
                    <p class="mt-2">
                        <span class="font-medium">Location</span> -
                        {{ job.location }}
                    </p>
                    <p class="mt-2">
                        <span class="font-medium">Close Date</span> -
                        {{ job.close_date }}
                    </p>
                </div>
                <div>
                    <p class="mb-2 font-medium">Description</p>
                    <li class="list-disc ml-4 _content">
                        <p v-html="job.description"></p>
                    </li>
                </div>
                <BaseButton
                    :body="buttonBody"
                    class="mt-3"
                    :class="{
                        'bg-blue-800 hover:bg-blue-700' : isApplied
                    }"
                    :disabled="isApplied || isNotEmployee"
                    :is-link="isApplied || isNotEmployee ? false : true"
                    :link="route('jobs.get',job.id)"
                />
            </ul>
        </div>
        <div>
            <h3 class="text-xl font-semibold underline mb-3">Similar Jobs</h3>
            <Job :jobs="similarJobs" />
        </div>
    </div>
</template>

<style scoped>
.photo {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    object-fit: cover;
}
</style>
