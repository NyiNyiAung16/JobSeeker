<script setup>
import Navbar from '../Components/Navbar.vue'
import '../../css/content.css'

defineProps({
    content:{
        type:String,
        required:true
    }
})

</script>


<template>
    <Navbar/>
    <div >
        <div class="_content space-y-6 px-5 py-3" v-html="content"></div>
    </div>
</template>

