<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
import { ref } from "vue";
import Content from '@/Components/Admin/Content.vue'
import Contents from '@/Components/Admin/Contents.vue'

const isActive = ref('all');

defineProps({
    contents:{
        type:Array,
        default:[]
    }
})


</script>

<template>
    <Head title="Content Management" />

    <AuthenticatedLayout>
        <template #header>
            <div class="space-x-6 flex">
                <h2
                    class="font-semibold text-lg text-gray-600 leading-tight cursor-pointer"
                    :class="{
                        'transition-all active duration-100 ' : isActive === 'all'
                    }"
                    @click="isActive = 'all'"
                >
                    All Contents
                </h2>
                <h2
                    class="font-semibold text-lg text-gray-600 leading-tight cursor-pointer"
                    :class="{
                        'active transition-all duration-100 ' : isActive === 'create'
                    }"
                    @click="isActive = 'create'"
                >
                    Create Content
                </h2>
            </div>
        </template>


        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 pt-4">
            <div v-if="isActive === 'all'">
                <div v-if="contents.length > 0">
                    <Contents :contents="contents"/>
                </div>
                <p v-else>You don't have any contents!</p>
            </div>
            <div v-else-if="isActive === 'create'">
                <Content/>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
