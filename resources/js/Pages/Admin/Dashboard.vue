<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import DataStatsOne from '@/Components/Admin/DataStatsOne.vue'
import ChartBar from '@/Components/Admin/ChartBar.vue'

defineProps({
    locations: {
        type: Array,
        default: []
    },
    dataStats:{
        type:Object,
        default:{}
    }
});


</script>

<template>
    <Head title="Admin Dashboard" />
    
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
        </template>

        <div class="py-3">
            <div>
                <DataStatsOne :dataStats="dataStats"/>
                <div class="mt-10">
                    <ChartBar :locations="locations"/>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
