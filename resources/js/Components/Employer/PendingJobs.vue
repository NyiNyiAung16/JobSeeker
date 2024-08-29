<script setup>
import Pagination from '@/Components/Pagination.vue'
import Modal from '@/Components/Modal.vue'
import { Link, router } from '@inertiajs/vue3'
import { ref } from 'vue'

defineProps({
    jobs: {
        type:Object,
        required:true
    }
});

let showEmployerModal = ref(false);
let selectedJobId = ref(null);

const openDeleteModal = (id) => {
    selectedJobId.value = id;
    showEmployerModal.value = true;
}

const deleteJob = () => {
    router.delete(route('employer.destroyJob',selectedJobId.value),{
        onFinish: () => showEmployerModal.value = false
    });
}

</script>

<template>
    <div class="p-3">
        <div
            class="relative overflow-x-auto mt-4"
            v-if="jobs.data.length > 0"
        >
            <table
                class="w-full text-sm text-left rtl:text-right text-gray-500"
            >
                <thead
                    class="text-xs text-gray-700 uppercase bg-gray-200"
                >
                    <tr>
                        <th scope="col" class="px-6 py-3">ID</th>
                        <th scope="col" class="px-6 py-3">
                            Company Name
                        </th>
                        <th scope="col" class="px-6 py-3">Position</th>
                        <th scope="col" class="px-6 py-3">Status</th>
                        <th scope="col" class="px-6 py-3 text-center">Actions</th>
                        <th scope="col" class="px-6 py-3"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr
                        class="bg-white border-b"
                        v-for="(job,index) in jobs.data"
                        :key="job.id"
                    >
                        <th
                            scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap"
                        >
                            {{ index + 1 }}
                        </th>
                        <td class="px-6 py-4 capitalize">
                            {{ job.company_name }}
                        </td>
                        <td class="px-6 py-4 capitalize">
                            {{ job.position }}
                        </td>
                        <td
                            class="px-6 py-4 capitalize"
                            :class="{
                                'text-blue-500':
                                    job.status == 'pending',
                                'text-green-500':
                                    job.status == 'approved',
                                'text-red-500':
                                    job.status == 'rejected',
                            }"
                        >
                            {{ job.status }}
                        </td>
                        <td class="px-6 py-4 space-x-2 text-center font-medium" >
                            <Link
                                :href="route('employer.editJob', job.id)"
                                class="text-blue-500 hover:underline duration-150"
                                >Edit</Link
                            >
                            <button
                                class="text-red-500 hover:underline duration-150"
                                @click="openDeleteModal(job.id)"
                                >Delete
                            </button>
                        </td>
                        <td class="px-6 py-4">
                            <Link
                                :href="`/jobs/${job.id}`"
                                class="font-medium hover:underline"
                                >View</Link
                            >
                        </td>
                    </tr>
                </tbody>
            </table>
            <Pagination :paginate="jobs" />
            <Modal
                :show="showEmployerModal"
                @close="showEmployerModal = false"
            >
                <div class="p-6">
                    <h2 class="text-lg font-medium text-gray-900">
                        Are you sure you want to delete the job? 
                    </h2>

                    <div class="mt-3 space-x-3">
                        <button
                            class="px-3 py-2 rounded bg-gray-500 text-[#ffffffdb] font-medium hover:bg-opacity-80 duration-150"
                            @click="showEmployerModal = false"
                        >
                            Cancel
                        </button>
                        <button
                            class="bg-red-500 text-[#ffffffdb] font-medium hover:bg-opacity-80 duration-150 px-3 py-2 rounded"
                            @click="deleteJob"
                        >
                            Delete
                        </button>
                    </div>
                </div>
            </Modal>
        </div>
        <div v-else>
            <p class="text-lg text-gray-700">You don't have any pending jobs.</p>
        </div>
    </div>
</template>

