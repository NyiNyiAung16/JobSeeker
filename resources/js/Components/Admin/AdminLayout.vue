<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link } from "@inertiajs/vue3";

</script>

<template>
    <Head title="Admin Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <div class="space-x-6 flex">
                <h2
                    class="font-semibold text-lg text-gray-800 leading-tight cursor-pointer"
                    :class="{
                        'active transition-all duration-100 ': route().current('admin.jobManagement.pending'),
                    }"
                >
                    <Link :href="route('admin.jobManagement.pending')">Pending Jobs</Link>
                </h2>
                <h2
                    class="font-semibold text-lg text-gray-800 leading-tight cursor-pointer"
                    :class="{
                        'active transition-all duration-100 ': route().current('admin.jobManagement.approved'),
                    }"
                >
                    <Link :href="route('admin.jobManagement.approved')">Approved Jobs</Link>
                </h2>
                <h2
                    class="font-semibold text-lg text-gray-800 leading-tight cursor-pointer"
                    :class="{
                        'active transition-all duration-100 ': route().current('admin.jobManagement.rejected'),
                    }"
                >
                    <Link :href="route('admin.jobManagement.rejected')">Rejected Jobs</Link>
                </h2>
            </div>
        </template>

        <div class="py-3">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <slot/>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
