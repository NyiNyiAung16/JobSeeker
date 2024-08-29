<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
import PendingJobs from '@/Components/Admin/PendingJobs.vue'
import ApprovedJobs from '@/Components/Admin/ApprovedJobs.vue'
import RejectedJobs from '@/Components/Admin/RejectedJobs.vue'
import { ref } from 'vue'

const props = defineProps({
    pendingJobs: {
        type: Object,
        required: true,
    },
    approvedJobs: {
        type: Object,
        required: true,
    },
    rejectedJobs: {
        type: Object,
        required: true,
    }
});

const active = ref('pending');

</script>

<template>
    <Head title="Admin Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <div class="space-x-6 flex">
                <h2
                    class="font-semibold text-lg text-gray-800 leading-tight cursor-pointer"
                    :class="{
                        'active transition-all duration-100 ':
                            active === 'pending',
                    }"
                    @click="active = 'pending'"
                >
                    Pending Jobs
                </h2>
                <h2
                    class="font-semibold text-lg text-gray-800 leading-tight cursor-pointer"
                    :class="{
                        'active transition-all duration-100 ':
                            active === 'approved',
                    }"
                    @click="active = 'approved'"
                >
                    Approved Jobs
                </h2>
                <h2
                    class="font-semibold text-lg text-gray-800 leading-tight cursor-pointer"
                    :class="{
                        'active transition-all duration-100 ':
                            active === 'rejected',
                    }"
                    @click="active = 'rejected'"
                >
                    Rejected Jobs
                </h2>
            </div>
        </template>

        <div class="py-3">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div v-if="active === 'pending'">
                    <PendingJobs :pendingJobs="pendingJobs"/>
                </div>
                <div v-else-if="active === 'approved'">
                    <ApprovedJobs :approvedJobs="approvedJobs"/>
                </div>
                <div v-else-if="active === 'rejected'">
                    <RejectedJobs :rejectedJobs="rejectedJobs"/>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
