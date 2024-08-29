<script setup>
import Pagination from '@/Components/Pagination.vue'
import Modal from '@/Components/Modal.vue'
import { Link, router } from '@inertiajs/vue3'
import { ref } from 'vue'

const { appliedJobs } = defineProps({
    appliedJobs: {
        type:Object,
        required:true
    }
});

let showModal = ref(false);
const selectedId = ref(null);

const openModal = (id) => {
    selectedId.value = id;
    showModal.value = true;
}

const submitWithdraw = () => {
    router.delete(route('employee.job.withdraw',selectedId.value));
    showModal.value = false;
}

</script>

<template>
    <div class="p-3">
        <div
            class="relative overflow-x-auto mt-4"
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
                        <th scope="col" class="px-6 py-3">Action</th>
                        <th scope="col" class="px-6 py-3"></th>
                        <th scope="col" class="px-6 py-3"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr
                        class="bg-white border-b"
                        v-for="(job,index) in appliedJobs.data"
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
                            class="px-6 py-4 capitalize text-blue-500 font-medium"
                        >
                            Applied
                        </td>
                        <td class="px-6 py-4 capitalize">
                            <button class="text-red-500 font-medium hover:underline" @click="openModal(job.id)">Withdraw</button>
                        </td>
                        <td class="px-6 py-4">
                            <Link
                            :href="`/jobs/${job.id}`"
                            class="font-medium hover:underline"
                            >View</Link
                            >
                        </td>
                        <td class="px-6 py-4">
                            <Link
                            :href="route('appliedUser.details',[job.pivot.user_id,job.id])"
                            class="font-medium hover:underline"
                            >Details</Link
                            >
                        </td>
                    </tr>
                </tbody>
            </table>
            <Pagination :paginate="appliedJobs" />
        </div>
        <Modal
            :show="showModal"
            @close="showModal = false"
        >
            <div class="p-6">
                <h2
                    class="text-lg font-medium text-gray-900"
                >
                    Are you sure you want to withdraw the application?
                </h2>
                <div class="mt-3 space-x-3">
                    <button
                        class="px-3 py-2 rounded bg-red-500 text-[#ffffffdb] font-medium hover:bg-opacity-80 duration-150"
                        @click="submitWithdraw"
                    >
                        Withdraw
                    </button>
                    <button
                    class="px-3 py-2 rounded bg-gray-500 text-[#ffffffdb] font-medium hover:bg-opacity-80 duration-150"
                    @click="
                            showModal = false
                        "
                    >
                    Cancel
                </button>
                </div>
            </div>
        </Modal>
    </div>
</template>
