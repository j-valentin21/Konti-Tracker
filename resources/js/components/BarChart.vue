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
            let uri = `/dashboard/charts`;
            axios.get(uri).then(response => {
                this.barData = [response.data['Jan'], response.data['Feb'], response.data['Mar'], response.data['Apr'], response.data['May'], response.data['June'],
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
                this.barChartData.datasets[0].data = this.barData
                this.barChart.update()
                }, 1000);
           setTimeout(() => {
               clearInterval(timer);
           },2000)
        });
    },
    mounted() {
        let uri = '/dashboard/charts';
        axios.get(uri).then((response) => {
            const chart = this.$refs.barChart;
            const ctx = chart.getContext("2d");
            this.barChartData = {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'June', 'July', 'Aug', 'Sept', 'Oct', 'Nov', 'Dec'],
                datasets: [{
                    label: 'PTO days used',
                    backgroundColor: 'rgba(0, 123, 255, 0.5)',
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
