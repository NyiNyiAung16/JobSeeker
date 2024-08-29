<script setup>
import LogoIcon from '../Components/LogoIcon.vue'
import { Link } from '@inertiajs/vue3';

</script>

<template>
    <div class="bg-[#c7c7c7] px-3 py-2 mt-10">
        <div class="flex justify-between px-3">
            <div class="max-w-[600px]">
                <div class="flex items-center gap-2 mb-1">
                    <LogoIcon/>
                    <h3>Job Seeker</h3>
                </div>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Omnis, quasi consequuntur cum vitae aut veniam aperiam blanditiis laboriosam ducimus assumenda!</p>
            </div>
            <div class="flex flex-col">
                <Link href="/" :class="{'active':$page.component === 'Home'}">Home</Link>
                <Link href="/about-us" :class="{'active':$page.component === 'About-Us'}">About Us</Link>
                <Link href="/jobs" :class="{'active':$page.component === 'Jobs/JobsLists'}">Jobs</Link>
            </div>
            <div>
                <h3 class="text-lg underline mb-1 font-medium">Contacts</h3>
                <p>Email:nyinyi@gmail.com</p>
                <p>Phone:097765397</p>
            </div>
        </div>
        <p class="text-center text-lg mt-5">CopyRight@ JobSeeker by {{ new Date().getFullYear() }}</p>
    </div>
</template>


<style scoped>

</style>