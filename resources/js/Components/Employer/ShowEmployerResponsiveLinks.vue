<script setup>
import ResponsiveNavLink from "@/Components/ResponsiveNavLink.vue";

</script>


<template>
    <ResponsiveNavLink
        :href="route('employer.dashboard')"
        :active="route().current('employer.dashboard')"
        v-if="
            $page.props.auth.user.role ===
            'employer'
        "
    >
        Dashboard
    </ResponsiveNavLink>
    <ResponsiveNavLink
        :href="route('employer.appliedEmployees')"
        :active="route().current('employer.appliedEmployees')"
        v-if="
            $page.props.auth.user.role ===
            'employer'
        "
    >
        Applied Employees
    </ResponsiveNavLink>
    <ResponsiveNavLink
        :href="route('employer.approvedJobs')"
        :active="route().current('employer.approvedJobs')"
        v-if="
            $page.props.auth.user.role ===
            'employer'
        "
    >
        Approved Jobs
    </ResponsiveNavLink>
    <ResponsiveNavLink
        :href="route('employer.rejectedJobs')"
        :active="route().current('employer.rejectedJobs')"
        v-if="
            $page.props.auth.user.role ===
            'employer'
        "
    >
        Rejected Jobs
    </ResponsiveNavLink>
</template>

