<script setup>
import BaseRejectedJobs from '@/Components/BaseRejectedJobs.vue'
import AdminLayout from "@/Components/Admin/AdminLayout.vue";

defineProps({
    rejectedJobs: {
        type: Object,
        default: {}
    }
});


</script>

<template>
    <AdminLayout>
        <div v-if="rejectedJobs.data.length > 0">
            <BaseRejectedJobs :rejectedJobs="rejectedJobs"/>
        </div>
        <div v-else>
            <p class="text-lg text-gray-700">You don't have any rejected jobs.</p>
        </div>
    </AdminLayout>
</template>
