<script setup>
import Editor from "@/Components/Editor.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import InputLabel from "@/Components/InputLabel.vue";
import BaseSelect from "@/Components/BaseSelect.vue";
import InputError from "@/Components/InputError.vue";
import { useForm } from '@inertiajs/vue3'

const props = defineProps({
    label: {
        type: String,
        default: ''
    },
    type: {
        type:String,
        required:true
    },
    content:{
        type:Object,
        default: {}
    }
});

let form = useForm({
    body: props.content.body || '',
    type: props.type || ''
});

const handleSubmit = () => {
    if(Object.keys(props.content).length > 0) {
        form.patch(route('admin.contents.update',props.content.id),{
            onSuccess:() => form.reset(),
            onError: () => {
                setTimeout(() => {
                    form.clearErrors();
                }, 3000);
            }
        });
    }else {
        form.post(route(`admin.contents.store`),{
            onSuccess:() => {
                form.reset();
            },
            onError: () => {
                setTimeout(() => {
                    form.clearErrors();
                }, 3000);
            }
        });
    }
}



</script>


<template>
    <div>
        <div class="mb-6">
            <h1 class="text-2xl text-center font-medium text-gray-700 underline">Create Content Form</h1>
        </div>
        <form
        class="max-w-4xl mx-auto border border-gray-300 shadow-lg p-5 rounded mt-3 space-y-4"
        @submit.prevent="handleSubmit"
        >
            <div class="mt-4">
                <InputLabel for="type" value="Type" />

                <BaseSelect
                    default-value="Select a type"
                    :options="['about_us','privacy']"
                    v-model="form.type"
                    class="bg-white border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm bg-none w-full box-border"
                />

                <InputError class="mt-2" :message="form.errors.type" />
            </div>
            <div>
                <InputLabel value="Content" />

                <Editor v-model="form.body" bgColor="border-2 border-gray-300"/>

                <InputError class="mt-2" :message="form.errors.body" />
            </div>
    
            <PrimaryButton class="mt-4" type="submit"> {{ content.length > 0 ? 'Edit' : 'Submit' }} </PrimaryButton>
        </form>
    </div>
</template>
