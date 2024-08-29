<script setup>
import BaseCheckbox from "@/Components/BaseCheckbox.vue";
import BaseError from "@/Components/BaseError.vue";

defineProps({
    additional: {
        type: Object,
        required: true,
    },
    errors: {
        type: Object,
        default: {},
    },
    resumeLabel: {
        type: String,
        default: "Resume File",
    },
    percentage:{
        type:Number,
        default: 0
    }
});

defineEmits(["handleFileUpload"]);
</script>

<template>
    <div class="space-y-3">
        <div>
            <h3 class="font-semibold mb-1">Additional</h3>
            <div class="bg-[#c7c7c7] max-w-[900px] py-3 px-2 rounded space-y-2">
                <div>
                    <p>Have you ever worked the company before?</p>
                    <BaseCheckbox
                        v-model="additional.worked_before_here"
                        :class="{
                            'border border-red-500':
                                !!errors?.['additional.worked_before_here'],
                        }"
                    />
                </div>
                <div>
                    <p>Legally work?</p>
                    <BaseCheckbox
                        v-model="additional.legally_work"
                        :class="{
                            'border border-red-500':
                                !!errors?.['additional.legally_work'],
                        }"
                    />
                </div>
            </div>
        </div>
        <div>
            <label
                for="resume"
                class="block bg-[#c7c7c7] p-3 rounded cursor-pointer"
                >{{ percentage ? percentage + '%' : resumeLabel }}</label
            >
            <input
                type="file"
                id="resume"
                class="hidden"
                @change="$emit('handleFileUpload',$event)"
            />
            <BaseError
                v-if="errors?.['additional.resume']"
                :error-text="errors?.['additional.resume']"
            />
        </div>
        <div>
            <div class="flex items-center gap-1">
                <input
                    type="checkbox"
                    class="rounded"
                    id="agree"
                    v-model="additional.agreed_terms"
                />
                <label for="agree">Are you agreed terms and conditions?</label>
            </div>
            <BaseError
                v-if="errors?.['additional.agreed_terms']"
                :error-text="errors?.['additional.agreed_terms']"
            />
        </div>
    </div>
</template>
