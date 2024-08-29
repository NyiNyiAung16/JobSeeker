<script setup>
import { reactive } from "vue";
import { Head, router } from "@inertiajs/vue3";
import PrimaryButton from "../../Components/PrimaryButton.vue";
import Contact from "../../Components/Job/Apply/Contact.vue";
import Experiences from "../../Components/Job/Apply/Experiences.vue";
import Education from "../../Components/Job/Apply/Education.vue";
import Language from "../../Components/Job/Apply/Language.vue";
import Additional from "../../Components/Job/Apply/Additional.vue";
import { ref } from "vue";

const props = defineProps({
    job: {
        type: Object,
        required: true,
    },
});

let errors = ref(null);
let percentage = ref(0);
let resumeLabel = ref("Resume File");

let contact = reactive({
    first_name: "",
    last_name: "",
    email: "",
    phone_number: "",
});

let experiences = reactive([
    {
        job_title: "",
        company_name: "",
        start_date: "",
        end_date: "",
    },
]);

let education = reactive([
    {
        degree: "",
        institution: "",
        start_date: "",
        end_date: "",
    },
]);

let language = reactive([
    {
        name: "",
        speaking_level: "",
        listening_level: "",
        reading_level: "",
    },
]);

let additional = reactive({
    worked_before_here: false,
    legally_work: false,
    resume: null,
    agreed_terms: false,
});

const submit = async () => {

    let applyJob = {
        contact,
        experiences,
        education,
        language,
        additional,
    };

    router.post(route("jobs.store", props.job.id), applyJob, {
        headers: {
            "Content-Type": "multipart/form-data",
        },
        onError: (e) => {
            errors.value = e;
            setTimeout(() => {
                errors.value = null;
            }, 6000);
        },
        onProgress: (progress) => {
            percentage.value = progress.percentage;
        },
        preserveScroll: true
    });
};

const handleFileUpload = (e) => {
    resumeLabel.value = e.target.files[0].name;
    additional.resume = e.target.files[0];
};

function addExperience() {
    experiences.push({
        job_title: "",
        company_name: "",
        start_date: "",
        end_date: "",
    });
}

function addLanguage() {
    language.push({
        name: "",
        speaking_level: "",
        listening_level: "",
        reading_level: "",
    });
}

function addEducation() {
    education.push({
        degree: "",
        institution: "",
        start_date: "",
        end_date: "",
    });
}
</script>

<template>
    <Head title="Apply Form" />
    <div>
        <div class="bg-[#c7c7c7] px-3 py-4 mb-3">
            <h3 class="text-xl font-semibold underline ms-5">
                {{ job.company_name }} / Apply Form
            </h3>
        </div>
        <form class="max-w-2xl space-y-4 mx-auto p-4" @submit.prevent="submit">
            <Contact :contact="contact" :errors="errors" />
            <Experiences
                :experiences="experiences"
                :errors="errors"
                @add-experience="addExperience"
            />
            <Education
                :education="education"
                :errors="errors"
                @add-education="addEducation"
            />
            <Language
                :language="language"
                :errors="errors"
                @add-language="addLanguage"
            />
            <Additional
                :additional="additional"
                :errors="errors"
                :resume-label="resumeLabel"
                :percentage="percentage"
                @handle-file-upload="handleFileUpload"
            />
            <PrimaryButton :disabled="!additional.agreed_terms" :class="{ 'bg-opacity-80' : !additional.agreed_terms }">Submit</PrimaryButton>
        </form>
    </div>
</template>
