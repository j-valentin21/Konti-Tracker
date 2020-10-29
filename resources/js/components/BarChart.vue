<template>
        <canvas ref="barChart"></canvas>
</template>
<script>
export default{
    props : ['pto_usage'],
    data() {
        return {
            pto_used: this.pto_usage,
        }
    },
    mounted() {
        const chart = this.$refs.barChart;
        const ctx = chart.getContext("2d");
        const barChartData = {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'June', 'July', 'Aug', 'Sept', 'Oct', 'Nov', 'Dec'],
            datasets: [{
                label: 'PTO per month',
                backgroundColor: 'rgba(0, 123, 255, 0.5)',
                borderColor: 'rgb(0, 123, 255)',
                borderWidth: 2,
                data: [this.pto_used]
            }]
        };
        const barChart = new Chart(ctx, {
            type: 'bar',
            data: barChartData,
            options: {
                maintainAspectRatio: true,
                responsive: true,
                legend: {
                    position: 'top',
                },
                animation: {
                    duration: 2000,
                    easing: 'easeInOutQuint'
                },
                scales: {
                    yAxes: [{
                        gridLines: {
                            color: 'rgba(54, 68, 88, 1)',
                            lineWidth: 1
                        },
                        ticks: {
                            min:0,
                            max:30
                        }
                    }],
                    xAxes: [{
                        gridLines: {
                            color: 'rgba(54, 68, 88, 1)',
                            lineWidth: 0
                        }
                    }]
                }
            }
        });
    }
}
</script>
