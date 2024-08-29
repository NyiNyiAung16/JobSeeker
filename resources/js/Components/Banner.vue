<script setup>
import RealTimeBtn from './RealTimeBtn.vue';
import JobIcon from './JobIcon.vue';
import PartnersIcon from './PartnersIcon.vue';

const { jobsLength, partnersLength} = defineProps({
    jobsLength:{
        type:Number,
        required:true
    },
    partnersLength: {
        type:Number,
        required:true
    }
});

</script>

<template>
    <div class="pt-7 min-h-screen">
        <div class="flex justify-around">
            <div class="me-7">
                <p class="font-medium text-xl max-w-[640px]">Lorem ipsum dolor sit amet consectetur adipisicing elit. Praesentium iure illum nobis quibusdam officiis, provident suscipit iusto quaerat, temporibus consectetur sed enim magni facilis modi consequatur ea perferendis! Vel eaque tenetur nisi tempora alias minus perspiciatis eius, mollitia minima, debitis esse obcaecati perferendis quam, quidem necessitatibus ipsam sunt fuga excepturi adipisci corrupti nobis! Alias, nam voluptatem! Tempora nostrum laudantium labore ullam aut eum architecto, odit a eligendi, obcaecati veritatis cumque quam sequi numquam facere quia!</p>
                <p class="text-lg mt-5 max-w-[540px]">Our Team are really work hard for you to get a better job. We wish you to get a job and be happy.</p>
            </div>
            <img src="photos/banner.png" alt="bannerPhoto" class="w-[500px]"/>
        </div>
        <div class="flex justify-around mt-16">
            <RealTimeBtn>
                <JobIcon/>
                <h3 class="realTimeText">Jobs</h3>
                <p class="realTimeNumber">{{ jobsLength }}</p>   
            </RealTimeBtn>
            <RealTimeBtn>
                <PartnersIcon/>
                <h3 class="realTimeText">Partners</h3>
                <p class="realTimeNumber">{{ partnersLength }}</p>   
            </RealTimeBtn>
        </div>
    </div>
</template>