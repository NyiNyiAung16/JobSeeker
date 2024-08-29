<script setup>
import BaseButton from '@/Components/BaseButton.vue';
import BaseError from '@/Components/BaseError.vue';
import BaseInput from '@/Components/BaseInput.vue';
import formattedDate from '@/helpers/formattedDate';
import getMinDate from '@/helpers/getMinDate';

defineProps({
    experiences: {
        type:Array,
        required:true
    },
    errors: {
        type: Object,
        default: {}
    }
});

defineEmits(['addExperience']);

</script>

<template>
    <div>
        <div class="flex justify-between mb-1">
            <h3 class="font-semibold">Experience</h3>
            <span
                class="cursor-pointer"
                @click="$emit('addExperience')"
                >+Add</span
            >
        </div>
        <div class="space-y-3">
            <div
                v-for="(exp, index) in experiences"
                :key="index"
                class="bg-[#c7c7c7] max-w-[900px] py-3 px-2 rounded flex flex-col gap-3"
            >
                <BaseInput
                    type="text"
                    v-model="exp.job_title"
                    placeholder="Job Title"
                />
                <BaseError v-if="errors?.[`experiences.${index}.job_title`]" :error-text="errors?.[`experiences.${index}.job_title`]"/>
                <BaseInput
                    type="text"
                    v-model="exp.company_name"
                    placeholder="Company Name"
                />
                <BaseError v-if="errors?.[`experiences.${index}.company_name`]" :error-text="errors?.[`experiences.${index}.company_name`]"/>
                <BaseInput
                    type="date"
                    v-model="exp.start_date"
                    placeholder="Start Date"
                    :max="formattedDate()"
                    class="w-full"
                />
                <BaseError v-if="errors?.[`experiences.${index}.start_date`]" :error-text="errors?.[`experiences.${index}.start_date`]"/>
                <BaseInput
                    type="date"
                    v-model="exp.end_date"
                    placeholder="End Date"
                    :max="formattedDate()"
                    :min="getMinDate(exp.start_date)" 
                />
                <BaseError v-if="errors?.[`experiences.${index}.end_date`]" :error-text="errors?.[`experiences.${index}.end_date`]"/>
                <BaseButton
                    body="Delete"
                    @click="experiences.splice(index, 1)"
                    v-if="index > 0"
                />
            </div>
        </div>
    </div>
</template>

