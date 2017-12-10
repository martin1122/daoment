export default {
    type: 'line',
    data: {
        labels: [],
        datasets: [{
            label: "Price",
            data: [],
            fill: false,
            borderColor: '#AAE2D2',
            radius: 0,
            lineTension: 0,
        }]
    },
    options: {
        period: 'day',
        responsive: true,
        legend: {
            display: true
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
                ticks: {
                    callback: function(dataLabel, index) {
                        var period = this.chart.options.period

                        if(period ==='day') {
                            return index % 10 === 0 ? new Date(dataLabel).toLocaleTimeString('en', {hour: 'numeric', minute: 'numeric'}): '';
                        } else if(period === 'month') {
                            return index % 30 === 0 ? new Date(dataLabel).toLocaleDateString('en-En', {day:'2-digit', month: 'short'}): '';
                        } else if(period === '3 months') {
                            return index % 50 === 0 ? new Date(dataLabel).toLocaleDateString('en-En', {month:"short", day:"2-digit"}): '';
                        } else if(period === 'year') {
                            return index % 50 === 0 ? new Date(dataLabel).toLocaleDateString('en-En', {month:"short"}): '';
                        } else if(period === '5 years') {
                            return index % 50 === 0 ? new Date(dataLabel).toLocaleDateString('en-En', {month:"short", year:"numeric"}): '';
                        } else if(period === 'max') {
                            return index % 50 === 0 ? new Date(dataLabel).toLocaleDateString('en-En', {month:"short", year:"numeric"}): '';
                        }

                        return index % 50 === 0 ? dataLabel : '';
                    }
                }
            }],
            yAxes: [{
                display: true,
                beginAtZero: true,
                fullWidth: true,
            }]
        },
    }
}