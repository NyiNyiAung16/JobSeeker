<script setup>
import Pagination from "@/Components/Pagination.vue";
import Modal from "@/Components/Modal.vue";
import BaseTable from "@/Components/BaseTable.vue";
import { usePage, router, Link } from "@inertiajs/vue3";
import { ref, computed } from "vue";

defineProps({
    approvedJobs: {
        type: Object,
        required: true,
    },
});

const page = usePage();

let showRejectModal = ref(false);
let showEmployerModal = ref(false);
let rejectionReason = ref("");
let selectedJobId = ref(null);
let error = ref(null);

const isAdmin = computed(() => page.props.auth.user.role === "admin");
const isEmployer = computed(() => page.props.auth.user.role === "employer");

//admin action
let openRejectedModal = (id) => {
    selectedJobId.value = id;
    showRejectModal.value = true;
};

const submitRejected = () => {
    router.post(
        route("admin.rejectedJob", selectedJobId.value),
        { rejection_reason: rejectionReason.value },
        {
            onSuccess: () => {
                showRejectModal.value = false;
                rejectionReason.value = ''
            },
            onError: (e) => {
                error.value = e;
                setTimeout(() => {
                    error.value = null;
                }, 3000);
            }
        }
    );
};

// employer actions
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
    <BaseTable>
        <template v-slot:tableHeader> 
            <tr>
                <th scope="col" class="px-6 py-3">ID</th>
                <th scope="col" class="px-6 py-3">Company Name</th>
                <th scope="col" class="px-6 py-3">Position</th>
                <th scope="col" class="px-6 py-3">Status</th>
                <th scope="col" class="px-6 py-3 text-center">Action</th>
                <th scope="col" class="px-6 py-3"></th>
            </tr>
        </template>
        <template v-slot:tableBody>
            <tr
                class="bg-white border-b"
                v-for="(job, index) in approvedJobs.data"
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
                        'text-blue-500': job.status == 'pending',
                        'text-green-500': job.status == 'approved',
                        'text-red-500': job.status == 'rejected',
                    }"
                >
                    {{ job.status }}
                </td>
                <!-- admin action -->
                <td class="px-6 py-4 space-x-2 text-center" v-if="isAdmin">
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
                </td>
                <!-- employer action -->
                <td class="px-6 py-4 space-x-2 text-center font-medium" v-if="isEmployer">
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
        </template>
    </BaseTable>
    <Pagination :paginate="approvedJobs" />
    <Modal
        :show="showRejectModal"
        @close="showRejectModal = false"
    >
        <div class="p-6">
            <h2 class="text-lg font-medium text-gray-900">
                Are you sure you want to reject the job? If
                yes, write rejection reason.
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
                    class="px-3 py-2 rounded bg-blue-500 text-[#ffffffdb] font-medium hover:bg-opacity-80 duration-150"
                    @click="submitRejected"
                >
                    Submit
                </button>
                <button
                    class="px-3 py-2 rounded bg-red-500 text-[#ffffffdb] font-medium hover:bg-opacity-80 duration-150"
                    @click="showRejectModal = false"
                >
                    Cancel
                </button>
            </div>
        </div>
    </Modal>
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
                    class="bg-red-500 text-[#ffffffdb] font-medium hover:bg-opacity-80 duration-150 px-3 py-2 rounded"
                    @click="deleteJob"
                >
                    Delete
                </button>
                <button
                    class="px-3 py-2 rounded bg-gray-500 text-[#ffffffdb] font-medium hover:bg-opacity-80 duration-150"
                    @click="showEmployerModal = false"
                >
                    Cancel
                </button>
            </div>
        </div>
    </Modal>
</template>
