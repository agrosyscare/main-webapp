const chart = Highcharts.chart('container', {
    chart: {
        type: 'line'
    },
    title: {
        text: 'Monthly Average Temperature'
    },
    subtitle: {
        text: 'Source: WorldClimate.com'
    },
    xAxis: {
        categories: ['Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado']
    },
    yAxis: {
        title: {
            text: 'Temperature (°C)'
        }
    },
    plotOptions: {
        line: {
            dataLabels: {
                enabled: true
            },
            enableMouseTracking: false
        }
    },
    series: []
});

function fetchData() {
    fetch('/charts/temperatures/data')
        .then(function(response) {
            return response.json();
        })
        .then(function(data) {
            // console.log(data);
            for (let x in data) {
                chart.addSeries(data[x]);
            }
        });
}

$(function () {
    fetchData();
})
