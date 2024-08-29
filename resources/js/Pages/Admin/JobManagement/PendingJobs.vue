<script setup>
import Pagination from "@/Components/Pagination.vue";
import Modal from "@/Components/Modal.vue";
import AdminLayout from "@/Components/Admin/AdminLayout.vue";
import {  Link , router } from "@inertiajs/vue3";
import { ref } from "vue";

const props = defineProps({
    pendingJobs: {
        type: Object,
        default: {}
    }
});

let showApprovedModal = ref(false);
let showRejectModal = ref(false);
let rejectionReason = ref('');
let selectedJobId = ref(null);
let error = ref(null);


let openApprovedModal = (id) => {
    selectedJobId.value = id;
    showApprovedModal.value = true;
}

let openRejectedModal = (id) => {
    selectedJobId.value = id;
    showRejectModal.value = true;
}

const submitApproved = () => {
    router.post(route('admin.approvedJob',selectedJobId.value),{},{
        onFinish:() => showApprovedModal.value = false
    });
}

const submitRejected = () => {
    router.post(route('admin.rejectedJob',selectedJobId.value),{ rejection_reason : rejectionReason.value },{
        onSuccess:() => {
            showRejectModal.value = false;
            rejectionReason.value = '';
        },
        onError:(e) => {
            error.value = e;
            setTimeout(() => {
                error.value = null;
            }, 3000);
        }
    });
}


</script>

<template>
    <AdminLayout>
        <div
            class="relative overflow-x-auto mt-4"
            v-if="pendingJobs.data.length > 0"
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
                        <th scope="col" class="px-6 py-3 text-center">
                            Actions
                        </th>
                        <th scope="col" class="px-6 py-3"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr
                        class="bg-white border-b"
                        v-for="(job,index) in pendingJobs.data"
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
                        <td class="px-6 py-4">
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
                        <td class="px-6 py-4 space-x-2 text-center">
                            <button
                                class="text-blue-500 font-medium hover:underline"
                                v-show="
                                    job.status === 'pending' ||
                                    job.status === 'rejected'
                                "
                                @click="openApprovedModal(job.id)"
                            >
                                Approved
                            </button>
                            <button
                                class="text-red-500 font-medium hover:underline"
                                v-show="
                                    job.status === 'pending' ||
                                    job.status === 'approved'
                                "
                                @click="openRejectedModal(job.id)"
                            >
                                Rejected
                            </button>
                            <Modal
                                :show="showApprovedModal"
                                @close="showApprovedModal = false"
                            >
                                <div class="p-6">
                                    <h2
                                        class="text-lg font-medium text-gray-900"
                                    >
                                        Are you sure you want to approve
                                        the job?
                                    </h2>
                                    <div class="mt-3 space-x-3">
                                        <button
                                            class="px-3 py-2 rounded bg-blue-500 text-[#ffffffdb] font-medium hover:bg-opacity-80 duration-150"
                                            @click="submitApproved"
                                        >
                                            Yes
                                        </button>
                                        <button
                                            class="px-3 py-2 rounded bg-gray-500 text-[#ffffffdb] font-medium hover:bg-opacity-80 duration-150"
                                            @click="
                                                showApprovedModal = false
                                            "
                                        >
                                            NO
                                        </button>
                                    </div>
                                </div>
                            </Modal>
    
                            <Modal
                                :show="showRejectModal"
                                @close="showRejectModal = false"
                            >
                                <div class="p-6">
                                    <h2
                                        class="text-lg font-medium text-gray-900"
                                    >
                                        Are you sure you want to reject the job? If yes, write rejection reason.
                                    </h2>
    
                                    <div class="mt-3">
                                        <textarea
                                            id="rejection_reason"
                                            class="w-full border-2 border-gray-400 resize-none p-2 rounded"
                                            placeholder="Rejection reason..."
                                            v-model="rejectionReason"
                                        ></textarea>
                                        <span v-if="error?.rejection_reason" class="text-red-500 text-sm mt-1">{{ error.rejection_reason }}</span>
                                    </div>
                                    <div class="mt-3 space-x-3">
                                        <button
                                            class="px-3 py-2 rounded bg-red-500 text-[#ffffffdb] font-medium hover:bg-opacity-80 duration-150"
                                            @click="submitRejected"
                                        >
                                            Reject
                                        </button>
                                        <button
                                            class="px-3 py-2 rounded bg-gray-500 text-[#ffffffdb] font-medium hover:bg-opacity-80 duration-150"
                                            @click="
                                                showRejectModal = false;
                                                rejectionReason = ''
                                            "
                                        >
                                            Cancel
                                        </button>
                                    </div>
                                </div>
                            </Modal>
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
            <Pagination :paginate="pendingJobs" />
        </div>
        <div v-else>
            <p class="text-lg text-gray-700">You don't have any pending jobs.</p>
        </div>
    </AdminLayout>
</template>
