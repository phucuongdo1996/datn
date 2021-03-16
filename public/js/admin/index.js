let adminFunction = (function () {
    let modules = {};

    modules.buildCharts = function () {
        modules.buildIncomeChart();
        modules.buildTopSellChart();
    }

    modules.buildIncomeChart = function () {
        Highcharts.chart('chart-income', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'Doanh thu theo tháng'
            },
            xAxis: {
                categories: ['01/2021', '02/2021', '03/2021', '04/2021', '05/2021']
            },
            yAxis: {
                title: {
                    text: 'VND'
                },
                labels: {
                    formatter: function() {
                        return Common.numberFormat(this.value);
                    }
                },
            },
            credits: {
                enabled: false
            },
            series: [{
                name: 'Nạp tài khoản',
                data: [5000000, 3000000, 4000000, 7000000, 2000000]
            }, {
                name: 'Doanh thu dịch vụ trung gian',
                data: [3600000, 2500000, 3000000, 2000000, 1000000]
            }, {
                name: 'Doanh thu Steam code',
                data: [3000000, 4000000, 4000000, 2000000, 5500000]
            }]
        });
    }

    modules.buildTopSellChart = function () {
        Highcharts.chart('chart-top-sell', {
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: 'pie'
            },
            title: {
                text: 'Browser market shares in January, 2018'
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
            },
            accessibility: {
                point: {
                    valueSuffix: '%'
                }
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: false
                    },
                    showInLegend: true
                }
            },
            series: [{
                name: 'Brands',
                colorByPoint: true,
                data: [{
                    name: 'Chrome',
                    y: 61.41,
                    sliced: true,
                    selected: true
                }, {
                    name: 'Internet Explorer',
                    y: 11.84
                }, {
                    name: 'Firefox',
                    y: 10.85
                }, {
                    name: 'Edge',
                    y: 4.67
                }, {
                    name: 'Safari',
                    y: 4.18
                }, {
                    name: 'Other',
                    y: 7.05
                }]
            }]
        });
    }

    return modules;
}(window.jQuery, window, document));

$(document).ready(function () {
    adminFunction.buildCharts();
});
