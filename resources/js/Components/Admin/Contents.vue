<script setup>
import { Head, router, Link } from "@inertiajs/vue3";
import { ref } from "vue";
import Modal from "../Modal.vue";

defineProps({
    contents: {
        type: Object,
        required: true,
    }
});

const selectedContentId = ref(null);
let confirmedDeleteContent = ref(false);

const openDeleteModal = (id) => {
    selectedContentId.value = id;
    confirmedDeleteContent.value = true;
}

const deleteContent = () => {
    router.delete(route('admin.content.destroy',selectedContentId.value), {
        autoClose: 2000,
        preserveScroll: true,
    });
    confirmedDeleteContent.value = false;
};

</script>

<template>
    <Head title="Admin Dashboard" />

    <div class="relative overflow-x-auto mt-4">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500">
            <thead class="text-xs text-gray-700 uppercase bg-gray-200">
                <tr>
                    <th scope="col" class="px-6 py-3">ID</th>
                    <th scope="col" class="px-6 py-3">Type</th>
                    <th scope="col" class="px-6 py-3">Body</th>
                    <th scope="col" class="px-6 py-3">Action</th>
                </tr>
            </thead>
            <tbody>
                <tr
                    class="bg-white border-b"
                    v-for="(content, index) in contents"
                    :key="content.id"
                >
                    <th
                        scope="row"
                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap"
                    >
                        {{ index + 1 }}
                    </th>
                    <td class="px-6 py-4 capitalize">
                        {{ content.type }}
                    </td>
                    <td class="px-6 py-4">
                        <div v-html="content.body.substring(0,200) + '...'"></div>
                    </td>
                    <td class="px-6 py-4 font-medium">
                        <div class="flex items-center gap-2"> 
                            <Link
                                :href="route('admin.content.edit', content.id)"
                                class="text-blue-500 hover:underline duration-150"
                                >Edit</Link
                            >
                            <button
                                @click="openDeleteModal(content.id)"
                                class="text-red-500 hover:underline"
                            >
                                Delete
                            </button>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
        <Modal
            :show="confirmedDeleteContent"
            @close="() => (confirmedDeleteContent = false)"
        >
            <div class="p-6">
                <h2 class="text-lg font-medium text-gray-900">
                    Are you sure you want to delete the content?
                </h2>

                <div class="mt-3 space-x-3">
                    <button
                        class="px-3 py-2 bg-red-500 rounded hover:bg-opacity-90 duration-150 text-gray-200"
                        @click="deleteContent"
                    >
                        Delete
                    </button>
                    <button
                        class="px-3 py-2 bg-gray-500 rounded hover:bg-opacity-90 duration-150 text-gray-200"
                        @click="confirmedDeleteContent = false"
                    >
                        Cancel
                    </button>
                </div>
            </div>
        </Modal>
    </div>
</template>
