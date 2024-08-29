<script setup>
import { Head, router, Link } from "@inertiajs/vue3";
import { ref } from "vue";
import Modal from "../Modal.vue";
import Pagination from '../Pagination.vue'

defineProps({
    users: {
        type: Object,
        required: true,
    }
});

const selectedUserId = ref(null);
let confirmedDeleteUser = ref(false);

const openDeleteModal = (id) => {
    selectedUserId.value = id;
    confirmedDeleteUser.value = true;
}

const deleteUser = () => {
    router.delete(route('admin.user.destroy',selectedUserId.value), {
        autoClose: 2000,
        preserveScroll: true,
    });
    confirmedDeleteUser.value = false;
};

</script>

<template>
    <Head title="Admin Dashboard" />

    <div class="relative overflow-x-auto mt-4" v-if="users.data.length > 0">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500">
            <thead class="text-xs text-gray-700 uppercase bg-gray-200">
                <tr>
                    <th scope="col" class="px-6 py-3">ID</th>
                    <th scope="col" class="px-6 py-3">Name</th>
                    <th scope="col" class="px-6 py-3">Email</th>
                    <th scope="col" class="px-6 py-3">Role</th>
                    <th scope="col" class="px-6 py-3">Action</th>
                </tr>
            </thead>
            <tbody>
                <tr
                    class="bg-white border-b"
                    v-for="(user, index) in users.data"
                    :key="user.id"
                >
                    <th
                        scope="row"
                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap"
                    >
                        {{ index + 1 }}
                    </th>
                    <td class="px-6 py-4 capitalize">
                        {{ user.name }}
                    </td>
                    <td class="px-6 py-4">
                        {{ user.email }}
                    </td>
                    <td class="px-6 py-4 capitalize">
                        {{ user.role }}
                    </td>
                    <td class="px-6 py-4 font-medium space-x-2">
                        <Link
                            :href="route('admin.user.show', user.id)"
                            class="text-blue-500 hover:underline duration-150"
                            >Edit</Link
                        >
                        <button
                            @click="openDeleteModal(user.id)"
                            class="text-red-500 hover:underline"
                        >
                            Delete
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
        <Pagination :paginate="users"/>
        <Modal
            :show="confirmedDeleteUser"
            @close="() => (confirmedDeleteUser = false)"
        >
            <div class="p-6">
                <h2 class="text-lg font-medium text-gray-900">
                    Are you sure you want to delete the job?
                </h2>

                <div class="mt-3 space-x-3">
                    <button
                        class="px-3 py-2 bg-red-500 rounded hover:bg-opacity-90 duration-150 text-gray-200"
                        @click="deleteUser"
                    >
                        Delete
                    </button>
                    <button
                        class="px-3 py-2 bg-gray-500 rounded hover:bg-opacity-90 duration-150 text-gray-200"
                        @click="confirmedDeleteUser = false"
                    >
                        Cancel
                    </button>
                </div>
            </div>
        </Modal>
    </div>
    <p class="text-lg font-medium" v-else>
        You don't have users.
    </p>
</template>
