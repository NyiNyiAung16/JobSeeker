<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import BaseTable from "@/Components/BaseTable.vue";
import { Head } from "@inertiajs/vue3";
import { computed, ref } from "vue";

const { employeeDetails } = defineProps({
    employeeDetails: {
        type: Object,
    },
});

console.log(employeeDetails)

const labelNames = ref([
    "Contact",
    "Experience",
    "Education",
    "Language",
    "Additional",
]);


const active = ref("Contact");

const totalExperience = computed(() => {
    let years = 0,
        months = 0;

    let total = "";

    employeeDetails.experiences.forEach((e) => {
        const startDate = new Date(e.start_date);
        const endDate = new Date(e.end_date);

        years += endDate.getFullYear() - startDate.getFullYear();
        months += endDate.getMonth() - startDate.getMonth();
    });

    if (years > 0) {
        total += `${years}year${years > 1 ? "s" : ""}`;
    }
    if (months > 0) {
        total += ` ${months}month${months > 1 ? "s" : ""}`;
    }

    return total;
});

const handleRelevantAction = (labelName) => {
    active.value = labelName;
};

const handleResumeFile = (path) => {
    location.href = path;
}

</script>

<template>
    <Head title="Employee Details" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                <span class="uppercase">{{ employeeDetails.user.name }} </span>/
                Applied Details
            </h2>
        </template>

        <div class="py-3">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="mt-5">
                    <!-- Briefly -->
                    <div class="bg-gray-200 p-5 rounded space-y-1">
                        <h1 class="font-bold underline mb-1">Briefly</h1>
                        <h2>
                            FullName -
                            {{
                                employeeDetails.contact.first_name +
                                " " +
                                employeeDetails.contact.last_name
                            }}
                        </h2>
                        <h3>Position - {{ employeeDetails.job.position }}</h3>
                        <h3>Experience - {{ totalExperience }}</h3>
                        <p>
                            Education -
                            {{ employeeDetails.educations[0].degree }}
                        </p>
                    </div>
                </div>

                <!-- Labels Button -->
                <div class="flex gap-2">
                    <div
                        class="w-fit px-5 py-3 font-medium text-gray-600 bg-gray-200 hover:bg-gray-300 rounded mt-2 cursor-pointer duration-200 select-none"
                        v-for="(label, index) in labelNames"
                        :key="index"
                        @click="handleRelevantAction(label)"
                        :class="{
                            'bg-gray-300': active === label,
                        }"
                    >
                        {{ label }}
                    </div>
                </div>

                <!-- Contact -->
                <BaseTable v-if="active === 'Contact'">
                    <template #tableHeader>
                        <tr>
                            <th scope="col" class="px-6 py-3">No</th>
                            <th scope="col" class="px-6 py-3">FirstName</th>
                            <th scope="col" class="px-6 py-3">LastName</th>
                            <th scope="col" class="px-6 py-3">Email</th>
                            <th scope="col" class="px-6 py-3">Phone Number</th>
                        </tr>
                    </template>
                    <template #tableBody>
                        <tr class="hover:bg-gray-300 duration-200">
                            <th scope="row" class="px-6 py-4">
                                {{ employeeDetails.contact.id }}
                            </th>
                            <td class="px-6 py-4">
                                {{ employeeDetails.contact.first_name }}
                            </td>
                            <td class="px-6 py-4">
                                {{ employeeDetails.contact.last_name }}
                            </td>
                            <td class="px-6 py-4">
                                {{ employeeDetails.contact.email }}
                            </td>
                            <td class="px-6 py-4">
                                {{ employeeDetails.contact.phone_number }}
                            </td>
                        </tr>
                    </template>
                </BaseTable>

                <!-- Experience -->
                <BaseTable v-if="active === 'Experience'">
                    <template #tableHeader>
                        <tr>
                            <th scope="col" class="px-6 py-3">No</th>
                            <th scope="col" class="px-6 py-3">Company Name</th>
                            <th scope="col" class="px-6 py-3">Position</th>
                            <th scope="col" class="px-6 py-3">Start Date</th>
                            <th scope="col" class="px-6 py-3">End Date</th>
                        </tr>
                    </template>
                    <template #tableBody>
                        <tr
                            class="hover:bg-gray-300 duration-200"
                            v-for="experience in employeeDetails.experiences"
                            :key="experience.id"
                        >
                            <th scope="row" class="px-6 py-4">
                                {{ experience.id }}
                            </th>
                            <td class="px-6 py-4 capitalize">
                                {{ experience.company_name }}
                            </td>
                            <td class="px-6 py-4 capitalize">
                                {{ experience.job_title }}
                            </td>
                            <td class="px-6 py-4 capitalize">
                                {{ experience.start_date }}
                            </td>
                            <td class="px-6 py-4 capitalize">
                                {{ experience.end_date }}
                            </td>
                        </tr>
                    </template>
                </BaseTable>

                <!-- Education -->
                <BaseTable v-if="active === 'Education'">
                    <template #tableHeader>
                        <tr>
                            <th scope="col" class="px-6 py-3">No</th>
                            <th scope="col" class="px-6 py-3">Institution</th>
                            <th scope="col" class="px-6 py-3">Degree</th>
                            <th scope="col" class="px-6 py-3">Start Date</th>
                            <th scope="col" class="px-6 py-3">End Date</th>
                        </tr>
                    </template>
                    <template #tableBody>
                        <tr
                            class="hover:bg-gray-300 duration-200"
                            v-for="education in employeeDetails.educations"
                            :key="education.id"
                        >
                            <th scope="row" class="px-6 py-4">
                                {{ education.id }}
                            </th>
                            <td class="px-6 py-4 capitalize">
                                {{ education.institution }}
                            </td>
                            <td class="px-6 py-4 capitalize">
                                {{ education.degree }}
                            </td>
                            <td class="px-6 py-4 capitalize">
                                {{ education.start_date }}
                            </td>
                            <td class="px-6 py-4 capitalize">
                                {{ education.end_date }}
                            </td>
                        </tr>
                    </template>
                </BaseTable>

                <!-- Language -->
                <BaseTable v-if="active === 'Language'">
                    <template #tableHeader>
                        <tr>
                            <th scope="col" class="px-6 py-3">No</th>
                            <th scope="col" class="px-6 py-3">Language Name</th>
                            <th scope="col" class="px-6 py-3">
                                Speaking Level
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Listening Level
                            </th>
                            <th scope="col" class="px-6 py-3">Reading Level</th>
                        </tr>
                    </template>
                    <template #tableBody>
                        <tr
                            class="hover:bg-gray-300 duration-200"
                            v-for="language in employeeDetails.languages"
                            :key="language.id"
                        >
                            <th scope="row" class="px-6 py-4">
                                {{ language.id }}
                            </th>
                            <td class="px-6 py-4 capitalize">
                                {{ language.name }}
                            </td>
                            <td class="px-6 py-4 capitalize">
                                {{ language.speaking_level }}
                            </td>
                            <td class="px-6 py-4 capitalize">
                                {{ language.listening_level }}
                            </td>
                            <td class="px-6 py-4 capitalize">
                                {{ language.reading_level }}
                            </td>
                        </tr>
                    </template>
                </BaseTable>

                <!-- Additional -->
                <BaseTable v-if="active === 'Additional'">
                    <template #tableHeader>
                        <tr>
                            <th scope="col" class="px-6 py-3">No</th>
                            <th scope="col" class="px-6 py-3">
                                Is Legally Work?
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Has Worked Before here?
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Is Agreed Terms?
                            </th>
                            <th scope="col" class="px-6 py-3">Resume File</th>
                        </tr>
                    </template>
                    <template #tableBody>
                        <tr class="hover:bg-gray-300 duration-200">
                            <th scope="row" class="px-6 py-4">
                                {{ employeeDetails.additional.id }}
                            </th>
                            <td class="px-6 py-4 capitalize">
                                <i
                                    :class="`fa-solid fa-${
                                        employeeDetails.additional.legally_work
                                            ? 'check'
                                            : 'xmark'
                                    }`"
                                ></i>
                            </td>
                            <td class="px-6 py-4 capitalize">
                                <i
                                    :class="`fa-solid fa-${
                                        employeeDetails.additional
                                            .worked_before_here
                                            ? 'check'
                                            : 'xmark'
                                    }`"
                                ></i>
                            </td>
                            <td class="px-6 py-4 capitalize">
                                <i
                                    :class="`fa-solid fa-${
                                        employeeDetails.additional.agreed_terms
                                            ? 'check'
                                            : 'xmark'
                                    }`"
                                ></i>
                            </td>
                            <td class="px-6 py-4 capitalize">
                                <p
                                    class="underline cursor-pointer"
                                    @click="
                                        handleResumeFile(
                                            employeeDetails.additional
                                                .resume_file_path
                                        )
                                    "
                                >
                                    Resume File
                                </p>
                            </td>
                        </tr>
                    </template>
                </BaseTable>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
