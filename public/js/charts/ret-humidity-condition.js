const chart = Highcharts.chart('container', {
    chart: {
        type: 'line'
    },
    title: {
        text: 'Lectura promedio diaria por semana de Humedad Radicular'
    },
    subtitle: {
        text: 'Establecido por canchas'
    },
    xAxis: {
        categories: ['Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado']
    },
    yAxis: {
        title: {
            text: 'Humedad radicular (%)'
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
    fetch('/charts/ret-humidity/data')
        .then(function(response) {
            return response.json();
        })
        .then(function(data) {
            for (let key in data) {
                chart.addSeries(data[key]);
            }
        });
}

$(function () {
    fetchData();
})
