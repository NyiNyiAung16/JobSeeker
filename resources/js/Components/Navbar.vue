<script setup>
import LogoIcon from "../Components/LogoIcon.vue";
import BaseButton from "../Components/BaseButton.vue";
import { Link, router } from "@inertiajs/vue3";
import { toast } from "vue3-toastify";

const logout = () => {
    router.post(
        "/logout",
        {},
        {
            onSuccess: () => {
                toast.success("Logout is succcessful.", { autoClose: 2000 });
            },
        }
    );
};
</script>

<template>
    <div class="flex justify-between items-center px-3 py-2 bg-[#c7c7c7]">
        <div class="flex items-center gap-3">
            <LogoIcon />
            <!-- <h3 class="text-xl font-medium">Job Seeker</h3> -->
        </div>
        <div class="flex items-center gap-3">
            <Link href="/" :class="{ active: $page.component === 'Home' }"
                >Home</Link
            >
            <Link
                href="/about-us"
                :class="{ active: $page.component === 'About-Us' }"
                >About Us</Link
            >
            <Link
                href="/privacy"
                :class="{ active: $page.component === 'Privacy' }"
                >Privacy</Link
            >
            <Link
                href="/jobs"
                :class="{ active: $page.component === 'Jobs/JobsLists' }"
                >Jobs</Link
            >
            <Link
                href="/job/create"
                :class="{ active: $page.component === 'Jobs/Create' }"
                v-if="$page.props.auth.user?.role === 'employer'"
                >Job Creator</Link
            >
            <Link href="/admin/dashboard" v-if="$page.props.auth.user?.role === 'admin'">Dashboard</Link>
            <Link href="/employer/dashboard" v-if="$page.props.auth.user?.role === 'employer'">Dashboard</Link>
            <Link href="/employee/dashboard" v-if="$page.props.auth.user?.role === 'employee'">Dashboard</Link>
            <div v-if="!$page.props.auth.user" class="space-x-2">
                <BaseButton body="Login" :is-link="true" link="/login" />
                <BaseButton body="Register" :is-link="true" link="/register" />
            </div>
        </div>
    </div>
</template>
