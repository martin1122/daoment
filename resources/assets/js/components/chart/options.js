export default {
    /*type: 'line',
    data: {
        labels: self.chartLabels,
        datasets: [{
            label: false,
            data: [],
            fill: false,
            lineTension: 0.1,
            borderColor: '#AAE2D2'
        }]
    },
    options: {
        legend: {
            display: false
        },
        scales: {
            // yAxes: [{
            //   display: false
            // }],
            xAxes: [{
                display: false
            }]
        }
    }*/
    type: 'line',
    data: {
        labels: ["January", "February", "March", "April", "May", "June", "July"],
        datasets: [{
            label: "My First dataset",
            data: [],
            fill: false,
            borderColor: '#AAE2D2'
        }]
    },
    options: {
        responsive: true,
        legend: {
            display: false
        },
        title:{
            display: true,
            text: 'market summary indecies'
        },
        tooltips: {
            mode: 'index',
            intersect: false,
        },
        hover: {
            mode: 'nearest',
            intersect: true
        },

        scales: {
            xAxes: [{
                display: true,

            }],
            yAxes: [{
                display: false,
                beginAtZero: false
            }]
        },

        scales2: {
            xAxes: [{
                display: true,
                scaleLabel: {
                    display: true,
                    labelString: 'Month'
                }
            }],
            yAxes: [{
                display: true,
                scaleLabel: {
                    display: true,
                    labelString: 'Value'
                }
            }]
        }
    }
}