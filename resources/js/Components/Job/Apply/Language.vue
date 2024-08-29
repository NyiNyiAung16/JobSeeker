<script setup>
import BaseButton from '@/Components/BaseButton.vue';
import BaseSelect from '@/Components/BaseSelect.vue';
import { ref } from 'vue';

defineProps({
    language: {
        type:Array,
        required:true
    },
    errors: {
        type: Object,
        default: {}
    }
});

defineEmits(['addLanguage']);

let languageNames = ref([
    "Burmese",
    "Mandarin Chinese",
    "Spanish",
    "English",
    "Hindi",
    "Arabic",
    "Portuguese",
    "Bengali",
    "Russian",
    "Japanese",
    "Punjabi",
    "German",
    "Javanese",
    "Wu (Shanghainese)",
    "Malay/Indonesian",
    "Telugu",
    "Vietnamese",
    "Korean",
    "French",
    "Marathi",
    "Tamil",
    "Urdu",
    "Persian (Farsi)",
    "Turkish",
    "Italian",
    "Thai",
    "Gujarati",
    "Kannada",
    "Polish",
    "Ukrainian",
    "Romanian",
    "Dutch",
    "Greek",
    "Hungarian",
    "Czech",
    "Swedish",
    "Bulgarian",
    "Serbian",
    "Hebrew",
    "Norwegian",
    "Finnish"
]);

</script>


<template>
    <div>
        <div class="flex justify-between mb-1">
            <h3 class="font-semibold">Language</h3>
            <span
                class="cursor-pointer"
                @click="$emit('addLanguage')"
                >+Add</span
            >
        </div>
        <div class="space-y-3">
            <div
                class="bg-[#c7c7c7] max-w-[900px] py-3 px-2 rounded flex flex-col gap-3"
                v-for="(lang, index) in language"
                :key="index"
            >
                <div class="flex items-end justify-around">
                    <BaseSelect
                        default-value="Language"
                        :options="languageNames"
                        class="min-w-[160px]"
                        v-model="lang.name"
                        :class="{
                                'border border-red-500' : !!errors?.[`language.${index}.name`]
                            }"
                    />
                    <div>
                        <label class="block mb-1 ml-1 font-medium"
                            >Speaking</label
                        >
                        <BaseSelect
                            default-value="select"
                            :options="[
                                'beginner',
                                'intermediate',
                                'advanced',
                                'flucent',
                            ]"
                            v-model="lang.speaking_level"
                            class="bg-none"
                            :class="{
                                'border border-red-500' : !!errors?.[`language.${index}.speaking_level`]
                            }"
                        />
                    </div>
                    <div>
                        <label class="block mb-1 ml-1 font-medium"
                            >Listening</label
                        >
                        <BaseSelect
                            default-value="select"
                            :options="[
                                'beginner',
                                'intermediate',
                                'advanced',
                                'flucent',
                            ]"
                            v-model="lang.listening_level"
                            class="bg-none"
                            :class="{
                                'border border-red-500' : !!errors?.[`language.${index}.listening_level`]
                            }"
                        />
                    </div>
                    <div>
                        <label class="block mb-1 ml-1 font-medium"
                            >Reading</label
                        >
                        <BaseSelect
                            default-value="select"
                            :options="[
                                'beginner',
                                'intermediate',
                                'advanced',
                                'flucent',
                            ]"
                            v-model="lang.reading_level"
                            class="bg-none"
                            :class="{
                                'border border-red-500' : !!errors?.[`language.${index}.reading_level`]
                            }"
                        />
                    </div>
                    <BaseButton
                        body="Delete"
                        @click="language.splice(index, 1)"
                        v-if="index > 0"
                    />
                </div>
            </div>
        </div>
    </div>
</template>

