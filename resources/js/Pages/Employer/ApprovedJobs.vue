<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import BaseApprovedJobs from '@/Components/BaseApprovedJobs.vue'
import { Head } from "@inertiajs/vue3";

const props = defineProps({
    approvedJobs: {
        type: Object,
        default: {}
    }
});

</script>

<template>
    <Head title="Approved Jobs" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Approved Jobs
            </h2>
        </template>

        <div class="py-3">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div v-if="approvedJobs.data.length > 0 ">
                    <BaseApprovedJobs :approvedJobs="approvedJobs"/>
                </div>
                <div v-else>
                    <p class="text-lg text-gray-700">You don't have any approved jobs.</p>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>


