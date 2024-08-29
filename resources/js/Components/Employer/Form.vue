<script setup>
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import BaseSelect from "@/Components/BaseSelect.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import InputError from "@/Components/InputError.vue";
import Editor from '@/Components/Editor.vue'
import formattedDate from '@/helpers/formattedDate'
import { ref, computed } from 'vue'
import { useForm, usePage, router } from '@inertiajs/vue3'

const props = defineProps({
    locations: {
        type: Array,
        required: true,
    },
    categories: {
        type: Array,
        required: true,
    },
    jobTypes: {
        type: Array,
        required: true,
    },
    job:{
        type:Object
    }
});

let locationNames = computed(() => props.locations.map((l) => l.name));
let categoryTypes = computed(() => props.categories.map((c) => c.type));
let jobTypeNames = computed(() => props.jobTypes.map((t) => t.name));
let previewImage = ref(null);
let label = ref("Choose a Image");

const form = useForm({
    company_name: "",
    position: "",
    description: "",
    image_url: "",
    location: "",
    job_type: "",
    category: "",
    close_date: "",
});

if(!!props.job){
    form.company_name = props.job.company_name;
    form.position = props.job.position;
    form.description = props.job.description;
    form.image_url = props.job.image_url;
    previewImage.value = props.job.image_url;
    label.value = props.job.image_url;
    form.location = props.job.location;
    form.job_type = props.job.job_type;
    form.category = props.job.category;
    form.close_date = props.job.close_date;
}


let uploadFile = (e) => {
    let file = e.target.files[0];
    let fileReader = new FileReader();
    fileReader.onload = (e) => {
        previewImage.value = e.target.result;
    };
    fileReader.readAsDataURL(file);
    label.value = file.name;
    form.image_url = file;
};

let submit = () => {
    if(!!props.job) {
        //edit
        router.post(route("employer.updateJob",props.job.id),{
            _method: 'patch',
            ...form
        },{
            method:'patch',
            onError: () => {
                setTimeout(() => {
                   form.clearErrors()
                }, 6000);
            },
            onSuccess: () => {
                form.reset()
            }
        });
    }else{
        //post
        form.post(route("job.store"), {
            onError: () => {
                setTimeout(() => {
                   form.clearErrors()
                }, 6000);
            },
            onSuccess: () => {
                form.reset();
                previewImage.value = '';
                label.value = 'Choose a Image';
            },
            onProgress:(val) => console.log(val)
        });
    }
};

</script>


<template>
    <form
        class="max-w-4xl w-full mx-auto bg-stone-300 px-4 py-2 rounded mt-5 shadow-md"
        @submit.prevent="submit"
    >
        <h1 class="text-2xl font-bold text-center text-gray-700">
            {{job ? "Edit Job Form" : 'Job Create Form'}}
        </h1>
        <div class="space-y-4 mb-4"> 
            <div class="flex justify-between items-center">
                <div>
                    <InputLabel value="Image" />
                    <label
                        for="image_url"
                        class="block w-full bg-stone-200 text-gray-800 p-2 rounded"
                        >{{ label }}</label
                    >
                    <input
                        type="file"
                        id="image_url"
                        accept="image/jpg, image/jpeg, image/png"
                        class="hidden"
                        @change="uploadFile"
                    />
                    <InputError class="mt-2" :message="form.errors?.image_url" />
                </div>
                <img
                    :src="previewImage"
                    alt="previewImage"
                    v-if="previewImage"
                    class="w-[50px] h-[50px] rounded-full object-cover object-center"
                />
            </div>

            <div>
                <InputLabel for="company_name" value="Company Name" />
                
                <TextInput
                id="company_name"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.company_name"
                    autofocus
                    autocomplete="company_name"
                />
    
                <InputError class="mt-2" :message="form.errors?.company_name" />
            </div>
    
            <div>
                <InputLabel for="position" value="Position" />
    
                <TextInput
                    id="position"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.position"
                    autofocus
                    autocomplete="position"
                />
    
                <InputError class="mt-2" :message="form.errors?.position" />
            </div>
    
            <div>
                <InputLabel for="description" value="Description" class="mb-2" />
    
                <Editor v-model="form.description"/>
    
                <InputError class="mt-2" :message="form.errors?.description" />
            </div>
    
            <div>
                <InputLabel for="location" value="Location" />
    
                <BaseSelect
                    :options="locationNames"
                    default-value="Select a location"
                    v-model="form.location"
                    class="border-none w-full bg-white"
                />
    
                <InputError class="mt-2" :message="form.errors?.location" />
            </div>
    
            <div>
                <InputLabel for="job_type" value="Job Type" />
                <BaseSelect
                    :options="jobTypeNames"
                    default-value="Select a type"
                    v-model="form.job_type"
                    class="border-none w-full bg-white"
                />
                <InputError class="mt-2" :message="form.errors?.job_type" />
            </div>
    
            <div>
                <InputLabel for="category" value="Category" />
    
                <BaseSelect
                    :options="categoryTypes"
                    default-value="Select a Category"
                    v-model="form.category"
                    class="border-none w-full bg-white"
                />
    
                <InputError class="mt-2" :message="form.errors?.category" />
            </div>
    
            <div>
                <InputLabel for="close_date" value="Close Date" />
    
                <TextInput
                    id="close_date"
                    type="date"
                    class="mt-1 block w-full"
                    v-model="form.close_date"
                    autofocus
                    autocomplete="close_date"
                    :min="formattedDate()"
                />
    
                <InputError class="mt-2" :message="form.errors?.close_date" />
            </div>
        </div>
        <PrimaryButton
            :class="{ 'opacity-25': form.processing }"
            :disabled="form.processing"
        >
            {{ job ? 'Edit' : 'Create' }}
        </PrimaryButton>
    </form>
</template>

