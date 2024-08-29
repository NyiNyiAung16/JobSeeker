<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import PendingJobs from '@/Components/Employer/PendingJobs.vue'

const props = defineProps({
    pendingJobs: {
        type: Object,
        required:true
    }
});

</script>

<template>
    <Head title="Employer Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Pending Jobs</h2>
        </template>

        <div class="py-3">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div>
                    <div v-if="pendingJobs.data.length > 0">
                        <PendingJobs :jobs="pendingJobs"/>
                    </div>
                    <p class="text-lg text-gray-700" v-else>You don't have any pending jobs.</p>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
