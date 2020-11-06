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
            this.lineChartData.datasets[0].data = this.lineData
            this.lineChart.update()
        }, 1000);
        setTimeout(() => {
            clearInterval(timer);
        },2000)
    });
},
    //=========PENDING=============
    const pieChart = document.getElementById('pieChart').getContext('2d');
    const pie  = new Chart(pieChart, {
        // The type of chart we want to create
        type: 'pie',

        // The data for our dataset
        data: {
            labels: [
                'Days available',
                'Days pending'
            ],
            datasets: [{
                backgroundColor: [
                    'rgba(40, 167, 69, 0.4)',
                    'rgba(233, 236, 239, .7)'

                ],
                borderColor: [
                    'rgb(40, 167, 69)',
                    'rgba(0, 0, 0, .6)'
                ],
                data: [22,5]
            }]
        },

        // Configuration options go here
        options: {
            responsive: true,
            animation: {
                duration: 2000,
                easing: 'easeInOutQuint'
            },
        }
    });
}

