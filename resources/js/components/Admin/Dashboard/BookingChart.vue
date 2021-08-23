<template>
    <vue3-chart-js v-bind="{ ...lineChart }" />
</template>
<script>
    import Vue3ChartJs from "@j-t-mcc/vue3-chartjs";
    
    export default {
      name: "App",
      components: {
        Vue3ChartJs,
      },
      setup() {
        const lineChart = {
          type: "line",
          data: {
            labels: [
              "January",
              "February",
              "March",
              "April",
              "May",
              "June",
              "July",
            ],
            datasets: [
              {
                label: "Productivity",
                data: [70, 25, 110, 90, 5, 60, 30],
                fill: false,
                borderColor: "#00D8FF",
                tension: 0.5,
                backgroundColor: "blue",
              },
            ],
          },
          options: {
          },
        };
    
        return {
          lineChart,
        };
      },
    };
</script>