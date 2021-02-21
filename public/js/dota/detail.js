var detail = (function () {
    let modules = {};
    modules.buildHistoryChart = function () {
        Highcharts.chart('history-pay-chart', {
            chart: {
                type: 'line'
            },
            exporting: {
                enabled: false
            },
            credits: {
                enabled: false
            },
            title: {
                text: 'Giá trung bình gần đây'
            },
            subtitle: {
                text: 'Được tính trong 30 ngày gần nhất'
            },
            xAxis: {
                type: 'date',
                categories: ['01/01', '02/01', '03/01', '04/01', '05/01', '06/01', '07/01', '08/01', '09/01', '10/01', '11/01', '12/01']
            },
            yAxis: {
                title: {
                    text: 'Giá trung bình'
                }
            },
            tooltip: {
                crosshairs: true,
                shared: false,
            },
            plotOptions: {
                line: {
                    dataLabels: {
                        enabled: true
                    },
                    marker: {
                        radius: 4,
                        lineColor: '#666666',
                        lineWidth: 1
                    },
                    enableMouseTracking: true
                }
            },
            legend: {
                enabled: false
            },

            series: [{
                name: 'Giá',
                data: [10000, 12000, 11000, 15000, 19000, 22000, 21000, 21500, 21500, 21000, 21200, 22000]
            }]
        });
    }
    return modules;
}(window.jQuery, window, document));

$(document).ready(function () {
   detail.buildHistoryChart();

   $('#open-modal').on('click', function () {
       $('#exampleModalCenter').modal('show')
   })
});
