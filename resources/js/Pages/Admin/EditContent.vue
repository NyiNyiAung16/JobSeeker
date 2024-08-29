<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
import { computed } from "vue";
import Content from '@/Components/Admin/Content.vue'


const props = defineProps({
    content:{
        type:Object,
        default:{}
    }
});

const type = computed(() => props.content.type === 'privacy' ? 'privacy' : 'about_us');


</script>

<template>
    <Head title="Content Management" />

    <AuthenticatedLayout>
        <template #header>
            <div class="space-x-6 flex">
                <h2
                    class="font-semibold text-xl text-gray-600 leading-tight"
                >
                    Edit Content
                </h2>
            </div>
        </template>


        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 pt-4">
            <Content :label="`Edit ${type} content`" :type="type" :content="content"/>
        </div>
    </AuthenticatedLayout>
</template>
