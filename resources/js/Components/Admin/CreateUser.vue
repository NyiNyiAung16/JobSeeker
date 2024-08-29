<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import {  useForm } from '@inertiajs/vue3';
import BaseSelect from '@/Components/BaseSelect.vue';


const form = useForm({
    name: '',
    email: '',
    role: '',
    password: '',
    password_confirmation: '',
});


const submit = () => {
    form.post(route('admin.user.store'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
}

</script>

<template>
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

        <div class="mt-4">
            <InputLabel for="password" value="Password" />

            <TextInput
                id="password"
                type="password"
                class="mt-1 block w-full"
                v-model="form.password"
                required
                autocomplete="new-password"
            />

            <InputError class="mt-2" :message="form.errors.password" />
        </div>

        <div class="mt-4">
            <InputLabel for="password_confirmation" value="Confirm Password" />

            <TextInput
                id="password_confirmation"
                type="password"
                class="mt-1 block w-full"
                v-model="form.password_confirmation"
                required
                autocomplete="new-password"
            />

            <InputError class="mt-2" :message="form.errors.password_confirmation" />
        </div>

        <PrimaryButton class="mt-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
            Register
        </PrimaryButton>
    </form>
</template>
