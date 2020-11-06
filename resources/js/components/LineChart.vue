<template>
    <div>
        <canvas ref="lineChart"></canvas>
    </div>
</template>
<script>
export default{
    data() {
        return {
            lineData: [],
            lineChartData: {},
            lineChart: {},
        }
    },
    mounted() {
        let uri = '/dashboard/charts';
        axios.get(uri).then((response) => {
            const chart = this.$refs.lineChart;
            const ctx = chart.getContext("2d");
            this.lineChartData = {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'June', 'July', 'Aug', 'Sept', 'Oct', 'Nov', 'Dec'],
                datasets: [{
                    label: 'Points used per month',
                    backgroundColor: 'rgb(235, 167, 43)',
                    borderColor: 'rgb(235, 167, 43)',
                    borderWidth: 2,
                    data: this.lineData
                }]
            };
            this.lineChart = new Chart(ctx, {
                type: 'line',
                data: this.lineChartData,
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
        })
    }
}
</script>


