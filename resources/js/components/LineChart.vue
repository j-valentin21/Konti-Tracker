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
    methods: {
        fetchTasks() {
            let uri = `/dashboard/points-chart`;
            axios.get(uri).then(response => {
                this.lineData = [response.data['Jan'], response.data['Feb'], response.data['Mar'], response.data['Apr'], response.data['May'], response.data['June'],
                    response.data['July'], response.data['Aug'], response.data['Sept'], response.data['Oct'], response.data['Nov'], response.data['Dec']]
            })
            .catch((err) => {
                console.log(err)
            })
        },
    },
    created() {
        this.fetchTasks();
        Fire.$on('SubmitCount', () => {
            let timer = setInterval(() => {
                this.fetchTasks()
                this.lineChartData.datasets[0].data = this.lineData
                this.lineChart.update()
            }, 1000);
            setTimeout(() => {
                clearInterval(timer);
            },2000)
        });
    },
    mounted() {
        let uri = '/dashboard/points-chart';
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


