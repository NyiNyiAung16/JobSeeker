<script setup>

defineProps({
    errorText: {
        type: String
    }
})

</script>


<template>
    <p class="text-sm text-red-600">{{ errorText }}</p>
</template>
