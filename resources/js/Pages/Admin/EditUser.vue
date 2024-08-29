<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import TextInput from '@/Components/TextInput.vue'
import InputError from '@/Components/InputError.vue'
import InputLabel from '@/Components/InputLabel.vue'
import PrimaryButton from '@/Components/PrimaryButton.vue'
import BaseSelect from '@/Components/BaseSelect.vue'
import { Head, useForm } from '@inertiajs/vue3';

const props = defineProps({
    user:{
        type:Object
    }
});

const form = useForm('Edit User',{
    name:'',
    email:"",
    role: ''
})

if(props?.user){
    form.name = props.user.name;
    form.email = props.user.email;
    form.role = props.user.role;
}


const submit = () => {
    form.patch(route('admin.user.update',props.user.id),{
        onSuccess:() => form.reset(),
        onError:() => form.clearErrors()
    });
}

</script>

<template>
    <Head title="Edit User" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit User</h2>
        </template>

        <div class="py-3">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <form class="max-w-2xl mx-auto border border-gray-300 shadow-lg p-5 rounded mt-3" @submit.prevent="submit">
                    <div>
                        <InputLabel for="name" value="Name" />

                        <TextInput
                            id="name"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="form.name"
                            required
                            autofocus
                            autocomplete="name"
                        />

                        <InputError class="mt-2" :message="form.errors.name" />
                    </div>

                    <div class="mt-4">
                        <InputLabel for="email" value="Email" />

                        <TextInput
                            id="email"
                            type="email"
                            class="mt-1 block w-full"
                            v-model="form.email"
                            required
                            autocomplete="username"
                        />

                        <InputError class="mt-2" :message="form.errors.email" />
                    </div>

                    <div class="mt-4">
                        <InputLabel for="role" value="Role" />

                        <BaseSelect
                            default-value="Select a role"
                            :options="['employer','employee','admin']"
                            v-model="form.role"
                            class="bg-white border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm bg-none w-full"
                        />

                        <InputError class="mt-2" :message="form.errors.role" />
                    </div>

                    <PrimaryButton class="mt-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                        Edit
                    </PrimaryButton>
                </form>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
