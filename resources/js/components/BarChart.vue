<template>
    <div>
        <canvas ref="barChart"></canvas>
    </div>
</template>
<script>


export default{
    // props : ['pto_usage'],

    data() {
        return {
            // pto_used: this.pto_usage,
        }
    },
    mounted() {
        let uri = '/dashboard/charts';
        axios.get(uri).then((response) => {
            const chart = this.$refs.barChart;
            const ctx = chart.getContext("2d");
            const barData = [response.data['Jan'], response.data['Feb'], response.data['Mar'], response.data['Apr'], response.data['May'], response.data['June'],
                response.data['July'], response.data['Aug'], response.data['Sept'], response.data['Oct'], response.data['Nov'], response.data['Dec']]
            const barChartData = {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'June', 'July', 'Aug', 'Sept', 'Oct', 'Nov', 'Dec'],
                datasets: [{
                    label: 'PTO days used',
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
    },
    methods: {

    }

}
</script>
