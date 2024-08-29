<script setup>
import ResponsiveNavLink from "@/Components/ResponsiveNavLink.vue";

</script>


<template>
    <ResponsiveNavLink
        :href="route('admin.dashboard')"
        :active="route().current('admin.dashboard')"
        v-if="
            $page.props.auth.user.role ===
            'admin'
        "
    >
        Admin Dashboard
    </ResponsiveNavLink>
    <ResponsiveNavLink
        :href="route('admin.userManagement')"
        :active="route().current('admin.userManagement')"
        v-if="
            $page.props.auth.user.role ===
            'admin'
        "
    >
        User Management
    </ResponsiveNavLink>
    <ResponsiveNavLink
        :href="route('admin.contentManagement')"
        :active="route().current('admin.contentManagement')"
        v-if="
            $page.props.auth.user.role ===
            'admin'
        "
    >
        Content Management
    </ResponsiveNavLink>
    <ResponsiveNavLink
        :href="route('admin.jobManagement.pending')"
        :active="route().current('admin.jobManagement.pending')"
        v-if="
            $page.props.auth.user.role ===
            'admin'
        "
    >
        Job Management
    </ResponsiveNavLink>
</template>

