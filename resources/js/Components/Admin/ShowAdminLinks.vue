<script setup>
import NavLink from "@/Components/NavLink.vue";

</script>


<template>
    <NavLink
        :href="route('admin.dashboard')"
        :active="route().current('admin.dashboard')"
        v-if="
            $page.props.auth.user.role ===
            'admin'
        "
    >
        Admin Dashboard
    </NavLink>
    <NavLink
        :href="route('admin.userManagement')"
        :active="route().current('admin.userManagement')"
        v-if="
            $page.props.auth.user.role ===
            'admin'
        "
    >
        User Management
    </NavLink>
    <NavLink
        :href="route('admin.contentManagement')"
        :active="route().current('admin.contentManagement')"
        v-if="
            $page.props.auth.user.role ===
            'admin'
        "
    >
        Content Management
    </NavLink>
    <NavLink
        :href="route('admin.jobManagement.pending')"
        :active="route().current('admin.jobManagement.pending')"
        v-if="
            $page.props.auth.user.role ===
            'admin'
        "
    >
        Job Management
    </NavLink>
</template>

