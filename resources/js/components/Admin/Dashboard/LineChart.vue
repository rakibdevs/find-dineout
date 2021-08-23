<template>
    <vue3-chart-js
        ref="chartRef"
        :type="lineChart.type"
        :data="lineChart.data"
        :options="lineChart.options" 
     />
</template>
<script>
    import Vue3ChartJs from "@j-t-mcc/vue3-chartjs";
    import { ref, onMounted } from 'vue' 
    
    export default {
      name: "App",
      props: {
        data: {
            type: Object,
            required: true
        },
      },
      components: {
        Vue3ChartJs,
      },
      
      setup(props) {
        const chartRef = ref(null) 
        const lineChart = {
          type: "line",
          data: {
            labels: props.data.labels,
            datasets: [
              {
                label: props.data.title,
                data: props.data.datasets,
                fill: false,
                borderColor: "#00D8FF",
                tension: 0.5,
                backgroundColor: "blue",
              },
            ],
          },
        };

        const updateChart = () => {
          lineChart.data.labels = props.data.labels
          lineChart.data.datasets = [
            {
              data: props.data.datasets
            }
          ]

          chartRef.value.update(250)
        }

        onMounted(lineChart)
    
        return {
          lineChart,
          updateChart,
          chartRef
        };
      },
    };
</script>