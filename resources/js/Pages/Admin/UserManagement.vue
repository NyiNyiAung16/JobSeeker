<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import Users from "@/Components/Admin/Users.vue";
import CreateUser from "@/Components/Admin/CreateUser.vue";
import { Head } from "@inertiajs/vue3";
import { ref } from "vue";

defineProps({
    users: {
        type: Object,
        default: {},
    },
});

const active = ref("all");

</script>

<template>
    <Head title="Admin Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <div class="space-x-6 flex">
                <h2
                    class="font-semibold text-lg text-gray-800 leading-tight cursor-pointer"
                    :class="{
                        'active transition-all duration-100 ':
                            active === 'all',
                    }"
                    @click="active = 'all'"
                >
                    All Users
                </h2>
                <h2
                    class="font-semibold text-lg text-gray-800 leading-tight cursor-pointer"
                    :class="{
                        'active transition-all duration-100 ':
                            active === 'create',
                    }"
                    @click="active = 'create'"
                >
                    Create User
                </h2>
            </div>
        </template>

        <div class="py-3">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div v-if="active === 'all'">
                    <Users :users="users" />
                </div>
                <div v-else-if="active === 'create'">
                    <CreateUser/>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
