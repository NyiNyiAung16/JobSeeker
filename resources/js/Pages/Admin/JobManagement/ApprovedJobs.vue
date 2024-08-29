<script setup>
import BaseApprovedJobs from '@/Components/BaseApprovedJobs.vue'
import AdminLayout from "@/Components/Admin/AdminLayout.vue";

defineProps({
    approvedJobs: {
        type: Object,
        default: {}
    }
});

</script>

<template>
    <AdminLayout>
        <div v-if="approvedJobs.data.length > 0">
            <BaseApprovedJobs :approvedJobs="approvedJobs"/>
        </div>
        <div v-else>
            <p class="text-lg text-gray-700">You don't have any approved jobs.</p>
        </div>
    </AdminLayout>
</template>
