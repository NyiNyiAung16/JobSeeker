<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import AppliedJobs from '@/Components/Employee/AppliedJobs.vue'


const props = defineProps({
    appliedJobs: {
        type:Object,
        default: {}
    }
});

</script>

<template>
    <Head title="Employee Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight" v-if="$page.props.auth.user.role === 'employee'">Applied Jobs</h2>
        </template>

        <div class="py-3">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div>
                    <div v-if="appliedJobs.data.length > 0">
                        <AppliedJobs :appliedJobs="appliedJobs"/>   
                    </div>
                    <p class="text-lg text-gray-700" v-else>You don't have any applied jobs.</p>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
