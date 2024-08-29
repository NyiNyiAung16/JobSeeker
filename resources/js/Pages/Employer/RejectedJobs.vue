<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import BaseRejectedJobs from '@/Components/BaseRejectedJobs.vue'
import { Head } from "@inertiajs/vue3";;

const props = defineProps({
    rejectedJobs: {
        type: Object,
        default: {}
    }
});


</script>

<template>
    <Head title="Posting Jobs" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Rejected Jobs
            </h2>
        </template>

        <div class="py-3">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div v-if="rejectedJobs.data.length > 0">
                    <BaseRejectedJobs :rejectedJobs="rejectedJobs"/>
                </div>
                <div v-else>
                    <p class="text-lg text-gray-700">You don't have any rejected jobs.</p>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
