f<script setup>

defineProps({
    defaultValue:{
        type:String
    },
    options:{
        type:Array,
        required:true
    },
    modelValue:{
        type:String,
        required:true
    }
})

</script>


<template>
    <select class="bg-[#d9d9d9] px-3 py-3 rounded capitalize" :value="modelValue" @change="$emit('update:modelValue',$event.target.value)">
        <option disabled selected value="">{{ defaultValue }}</option>
        <option 
            v-for="(option,index) in options"
            :key="index"
        >
            {{ option }}
        </option>
    </select>
</template>

