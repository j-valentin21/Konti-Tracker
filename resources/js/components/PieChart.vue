<template>
    <div>
        <canvas ref="pieChart"></canvas>
    </div>
</template>
<script>
export default{
    data() {
        return {
            pieData: [],
            pieChartData: {},
            pieChart: {},
        }
    },
    mounted() {
        const chart = this.$refs.pieChart;
        const ctx = chart.getContext("2d");

        this.pieChartData = {
            labels: [
                'Days available',
                'Days pending'
            ],
            datasets: [{
                label: 'PTO days used',
                backgroundColor: [
                    'rgba(40, 167, 69, 0.4)',
                    'rgba(233, 236, 239, .7)'
                ],
                borderColor: [
                    'rgb(40, 167, 69)',
                    'rgba(0, 0, 0, .6)'
                ],
                borderWidth: 2,
                data: [22,5]
            }]
        };
        this.pieChart = new Chart(ctx, {
            type: 'pie',
            data: this.pieChartData,
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
                            min: 0,
                            max: 30
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

