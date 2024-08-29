<script setup>
import { Link } from '@inertiajs/vue3';

defineProps({
    body:{
        type:String,
        required:true
    },
    isLink:{
        type:Boolean,
        default:false
    },
    link: {
        type: String,
        default: ''
    }
});


</script>

<template>
    <button 
        v-bind="$attrs"
        class="px-3 py-2 rounded-md text-white bg-blue-500 hover:bg-blue-600 duration-150"
    >
        <span v-if="!isLink">{{ body }}</span>
        <Link :href="link" v-else>{{ body }}</Link>
    </button>
</template>

