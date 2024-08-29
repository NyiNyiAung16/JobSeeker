<script setup>
import ApexChart from "vue3-apexcharts";
import { ref, computed } from 'vue'

const { locations } = defineProps({
    locations: {
        type:Array,
        default: []
    }
});

const data = computed(() => locations.map((l) => l.total));
const categories = computed(() => locations.map((l) => l.name));

const series = ref([{
    data
}]);

const colors = ref(['#3b82f6','#f97316','#22c55e','#ef4444']);


const chartOptions = ref({
    chart: {
        height: 350,
        type: 'bar',
        events: {
            click: function(chart, w, e) {
                // console.log(chart, w, e)
            }
        }
    },
    colors: colors,
    plotOptions: {
        bar: {
            columnWidth: '45%',
            distributed: true,
        }
    },
    dataLabels: {
        enabled: false
    },
    legend: {
        show: false
    },
    xaxis: {
        categories,
        labels: {
            style: {
                colors: colors,
                fontSize: '12px'
            }
        }
    }
});
</script>


<template>
    <h2 class="text-2xl text-center text-gray-800 font-medium underline tracking-wide mb-3">Highest Hiring Locations</h2>
    <div>
        <ApexChart type="bar" height="350" :options="chartOptions" :series="series"></ApexChart>
    </div>
</template>

