<script setup>
import BaseInput from '../../BaseInput.vue'
import BaseError from '../../BaseError.vue'
import BaseButton from '../../BaseButton.vue'
import formattedDate from '@/helpers/formattedDate';
import getMinDate from '@/helpers/getMinDate';

defineProps({
    education: {
        type:Array,
        required:true
    },
    errors: {
        type: Object,
        default: {}
    }
});

defineEmits(['addEducation']);

</script>

<template>
    <div>
        <div class="flex justify-between mb-1">
            <h3 class="font-semibold">Education</h3>
            <span
                class="cursor-pointer"
                @click="$emit('addEducation')"
                >+Add</span
            >
        </div>
        <div class="space-y-3">
            <div
                class="bg-[#c7c7c7] max-w-[900px] py-3 px-2 rounded flex flex-col gap-3"
                v-for="(edu, index) in education"
                :key="index"
            >
                <BaseInput
                    type="text"
                    v-model="edu.degree"
                    placeholder="Degree"
                />
                <BaseError v-if="errors?.[`education.${index}.degree`]" :error-text="errors?.[`education.${index}.degree`]"/>
                <BaseInput
                    type="text"
                    v-model="edu.institution"
                    placeholder="Institution"
                />
                <BaseError v-if="errors?.[`education.${index}.institution`]" :error-text="errors?.[`education.${index}.institution`]"/>
                <BaseInput
                    type="date"
                    v-model="edu.start_date"
                    placeholder="Start Date"
                    :max="formattedDate()"
                />
                <BaseError v-if="errors?.[`education.${index}.start_date`]" :error-text="errors?.[`education.${index}.start_date`]"/>
                <BaseInput
                    type="date"
                    v-model="edu.end_date"
                    placeholder="End Date"
                    :max="formattedDate()"
                    :min="getMinDate(edu.start_date)"
                />
                <BaseError v-if="errors?.[`education.${index}.end_date`]" :error-text="errors?.[`education.${index}.end_date`]"/>
                <BaseButton
                    body="Delete"
                    @click="education.splice(index, 1)"
                    v-if="index > 0"
                />
            </div>
        </div>
    </div>
</template>

