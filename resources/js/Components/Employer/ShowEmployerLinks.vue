<script setup>
import NavLink from "@/Components/NavLink.vue";

</script>


<template>
    <NavLink
        :href="route('employer.dashboard')"
        :active="route().current('employer.dashboard')"
        v-if="
            $page.props.auth.user.role ===
            'employer'
        "
    >
        Dashboard
    </NavLink>
    <NavLink
        :href="route('employer.appliedEmployees')"
        :active="route().current('employer.appliedEmployees')"
        v-if="
            $page.props.auth.user.role ===
            'employer'
        "
    >
        Applied Employees
    </NavLink>
    <NavLink
        :href="route('employer.approvedJobs')"
        :active="route().current('employer.approvedJobs')"
        v-if="
            $page.props.auth.user.role ===
            'employer'
        "
    >
        Approved Jobs
    </NavLink>
    <NavLink
        :href="route('employer.rejectedJobs')"
        :active="route().current('employer.rejectedJobs')"
        v-if="
            $page.props.auth.user.role ===
            'employer'
        "
    >
        Rejected Jobs
    </NavLink>
</template>

