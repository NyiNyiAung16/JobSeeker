<script setup>
import { ref } from 'vue'

const { dataStats } = defineProps({
    dataStats:{
        type:Object,
        default:{}
    }
});



const cardItems = ref([
    {
        icon: 'user',
        title: 'User',
        data:dataStats.user,
        color:'orange',
        growthRate:dataStats.userGrowRate
    },
    {
        icon: 'hourglass-half',
        title: 'Pending Jobs',
        data:dataStats.pending,
        color:'blue',
        growthRate:dataStats.pendingJobGrowRate
    },
    {
        icon: 'check',
        title: 'Approved Jobs',
        data:dataStats.approved,
        color:'green',
        growthRate:dataStats.approvedJobGrowRate
    },
    {
        icon: 'xmark',
        title: 'Rejected Jobs',
        data:dataStats.rejected,
        color:'red',
        growthRate:dataStats.rejectedJobGrowRate
    }
]);

</script>


<template>
    <div class="grid grid-cols-1 gap-4 md:grid-cols-2 md:gap-6 xl:grid-cols-4 2xl:gap-7 mx-3">
        <div
            v-for="(item, index) in cardItems"
            :key="index"
            class="rounded-sm border border-stroke bg-white py-6 px-7 shadow-lg dark:border-strokedark dark:bg-boxdark"
        >
            <div
                class="flex h-11 w-11 items-center justify-center rounded-full bg-gray-100 dark:bg-meta-4"
            >
                <i :class="`fa-solid fa-${item.icon} text-${item.color}-600`"></i>
            </div>

            <div class="mt-4 flex items-end justify-between">
                <div>
                    <h4 class="text-title-md font-bold text-black">{{ item.data }}</h4>
                    <span class="text-sm font-medium text-gray-500">{{ item.title }}</span>
                </div>

                <span
                    class="flex items-center gap-1 text-sm font-medium"
                    :class="{ 'text-green-500': item.growthRate > 0, 'text-blue-500': item.growthRate < 0 }"
                >
                    {{ item.growthRate.toFixed(2) }}%
                    <i class="fa-solid fa-arrow-up" v-if="item.growthRate > 0"></i>
                    <i class="fa-solid fa-arrow-down" v-if="item.growthRate < 0"></i>
                </span>
            </div>
        </div>
    </div>
</template>

