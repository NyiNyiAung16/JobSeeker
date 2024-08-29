<script setup>

defineProps({
    partners: {
        type:Array,
        required:true
    }
});

</script>

<template>
    <div class="w-100 h-10"></div>
    <h1 class="text-center font-bold text-2xl text-gray-700 mb-3">Partner By</h1>
    <div class="overflow-x-hidden">
        <div class="marquee-container">
            <div v-for="partner in partners" :key="partner.id">
                <img :src="partner.image_url" alt="photos" class="icons m-auto">
                <span class="text-center">{{ partner.name }}</span>
            </div>
        </div>
    </div>
</template>


<style scoped>
.icons{
    width: 70px;
    height: 70px;
    border-radius: 50%;
    object-fit: cover;
}

.marquee-container {
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: space-around;
    animation: loopIcon 20s infinite linear;        
}


@keyframes loopIcon {
    0% {
        transform: translateX(-100%);
    }

    100% {
        transform: translateX(100%);
    }
}
</style>