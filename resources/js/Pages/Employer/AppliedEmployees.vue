<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import BaseTable from '@/Components/BaseTable.vue'
import { Head, Link } from '@inertiajs/vue3';

const props = defineProps({
    appliedEmployeesInfo: {
        type:Array,
        default: []
    }
});


</script>

<template>
    <Head title="Applied Employees"/>

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight"> Applied Employees</h2>
        </template>

        <div class="py-3">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">                
                <BaseTable v-if="appliedEmployeesInfo.length > 0">
                    <template v-slot:tableHeader>
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                ID
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Job Id
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Name
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Email
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Role
                            </th>
                            <th scope="col" class="px-6 py-3">
                                
                            </th>
                        </tr>
                    </template>
                    <template v-slot:tableBody>
                        <tr class="bg-white border-b" v-for="(info,index) in appliedEmployeesInfo" :key="info.id">
                            <th scope="row" class="px-6 py-4 font-medium  whitespace-nowrap ">
                                {{ index + 1 }}
                            </th>
                            <td class="px-6 py-4">
                                <Link :href="`/jobs/${info.job.id}`" class="text-gray-600 font-medium underline">{{ info.job.id }}</Link>
                            </td>
                            <td class="px-6 py-4">
                                {{ info.user.name }}
                            </td>
                            <td class="px-6 py-4">
                                {{ info.user.email }}
                            </td>
                            <td class="px-6 py-4 capitalize">
                                {{ info.user.role }}
                            </td>
                            <td class="px-6 py-4">
                                <Link :href="`/users/${info.user.id}/jobs/${info.job.id}`" class="hover:underline font-semibold duration-150">Details</Link>
                            </td>
                        </tr>
                    </template>
                </BaseTable>
                <div v-else>
                    <p class="text-lg text-gray-700">You don't have any applied employees!</p>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

