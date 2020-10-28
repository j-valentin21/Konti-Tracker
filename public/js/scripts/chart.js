//===========CHART.JS CHARTS=================

window.onload = function() {


    //=========POINTS PER MONTH CHART=============
    let lineChart = document.getElementById('lineChart').getContext('2d');
    const line  = new Chart(lineChart, {
        // The type of chart we want to create
        type: 'line',

        // The data for our dataset
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'June', 'July', 'Aug', 'Sept', 'Oct', 'Nov', 'Dec'],
            datasets: [{
                label: 'Points used per month',
                backgroundColor: 'rgba(235, 167, 43, 0.1)',
                borderColor: 'rgb(235, 167, 43)',
                data: [0, 3, 1, 3, 5, 0,0]
            }]
        },

        // Configuration options go here
        options: {
            animation: {
                duration: 2000,
                easing: 'easeInOutQuint'
            },
            scales: {
                yAxes: [{
                    gridLines: {
                        color: 'rgba(54, 68, 88, 1)',
                        lineWidth: 1
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

