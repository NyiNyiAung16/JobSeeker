<script setup>
import BaseError from '@/Components/BaseError.vue';
import BaseInput from '@/Components/BaseInput.vue';

defineProps({
    contact: {
        type:Object,
        required:true
    },
    errors: {
        type: Object,
        default: {}
    }
})

</script>


<template>
    <div>
        <h3 class="font-semibold mb-1">Contact Info</h3>
        <div
            class="bg-[#c7c7c7] max-w-[900px] py-3 px-2 rounded flex flex-col gap-3"
        >
            <BaseInput
                type="text"
                v-model="contact.first_name"
                placeholder="First Name"
            />
            <BaseError v-if="errors?.['contact.first_name']" :error-text="errors?.['contact.first_name']"/>
            <BaseInput
                type="text"
                v-model="contact.last_name"
                placeholder="Last Name"
            />
            <BaseError v-if="errors?.['contact.last_name']" :error-text="errors?.['contact.last_name']"/>
            <BaseInput
                type="email"
                v-model="contact.email"
                placeholder="Email"
            />
            <BaseError v-if="errors?.['contact.email']" :error-text="errors?.['contact.email']"/>
            <BaseInput
                type="number"
                v-model="contact.phone_number"
                placeholder="Phone Number"
            />
            <BaseError v-if="errors?.['contact.phone_number']" :error-text="errors?.['contact.phone_number']"/>
        </div>
    </div>
</template>

