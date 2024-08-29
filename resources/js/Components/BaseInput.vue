<script setup>

defineProps({
    placeholder:{
        type:String
    },
    modelValue:{
        type:[String,Number], 
        required:true
    }
})

</script>


<template>
    <input 
        v-bind="$attrs"
        class="bg-[#d9d9d9] px-3 py-2 rounded border-none outline-none" 
        :placeholder="placeholder"
        :value="modelValue"
        @input="$emit('update:modelValue',$event.target.value)"
    >
</template>

