<script setup>
import BaseButton from '../Components/BaseButton.vue';


</script>


<template>
    <div class="w-screen h-screen space-y-2 bg-blue-50 flex flex-col justify-center items-center">
        <h3 class="max-w-[230px] text-center font-semibold text-xl">Thank you for Applying with us.</h3>
        <img src="/photos/thankyou.png" alt="thankyou">
        <BaseButton body="Back to Jobs Lists" :is-link="true" link="/jobs"/>
    </div>
</template>

