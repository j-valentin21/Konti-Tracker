<template>
    <div>
        <canvas ref="barChart"></canvas>
    </div>
</template>
<script>
export default{
    data() {
        return {
            barData: [],
            barChartData: {},
            barChart: {},
        }
    },
    methods: {
        fetchTasks() {
            let uri = `/dashboard/pto-chart`;
            axios.get(uri).then(response => {
                this.barData = [response.data[0]['Jan'], response.data[0]['Feb'], response.data[0]['Mar'], response.data[0]['Apr'], response.data[0]['May'], response.data[0]['June'],
                    response.data[0]['July'], response.data[0]['Aug'], response.data[0]['Sept'], response.data[0]['Oct'], response.data[0]['Nov'], response.data[0]['Dec']]
            })
            .catch((err) => {
                console.log(err)
            })
        },
    },
    watch: {
        barData:function(val) {
            this.barChartData.datasets[0].data = this.barData
            this.barChart.update();
        },
    },
    created() {
        this.fetchTasks();
        Fire.$on('SubmitCount', () => {
            this.fetchTasks()
        });
    },
    mounted() {
        let uri = '/dashboard/pto-chart';
        axios.get(uri).then((response) => {
            const chart = this.$refs.barChart;
            const ctx = chart.getContext("2d");
            this.barChartData = {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'June', 'July', 'Aug', 'Sept', 'Oct', 'Nov', 'Dec'],
                datasets: [{
                    label: 'PTO days used',
                    backgroundColor: 'rgb(0, 123, 255)',
                    borderColor: 'rgb(0, 123, 255)',
                    borderWidth: 2,
                    data: this.barData
                }]
            };
            this.barChart = new Chart(ctx, {
                type: 'bar',
                data: this.barChartData,
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
