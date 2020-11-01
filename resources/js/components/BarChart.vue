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
        const barData = [this.pto_used['Jan'], this.pto_used['Feb'],this.pto_used['Mar'],this.pto_used['Apr'],this.pto_used['May'],this.pto_used['June'],
            this.pto_used['July'], this.pto_used['Aug'],this.pto_used['Sept'], this.pto_used['Oct'], this.pto_used['Nov'], this.pto_used['Dec']]
        const barChartData = {

            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'June', 'July', 'Aug', 'Sept', 'Oct', 'Nov', 'Dec'],
            datasets: [{
                label: 'PTO per month',
                backgroundColor: 'rgba(0, 123, 255, 0.5)',
                borderColor: 'rgb(0, 123, 255)',
                borderWidth: 2,
                data: barData
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
