<script setup>
defineProps({
    modelValue: {
        type: Boolean,
        required: true,
    },
});
</script>

<template>
    <input
        type="checkbox"
        class="rounded"
        :value="modelValue"
        @change="$emit('update:modelValue', Boolean($event.target.checked))"
    />
</template>
