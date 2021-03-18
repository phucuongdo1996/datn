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
                height:300,
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: 'pie'
            },
            title: {
                text: ''
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
                    showInLegend: false
                }
            },
            series: [{
                name: 'Sản phẩm',
                colorByPoint: true,
                data: [{
                    name: 'Sản phẩm 1',
                    y: 60,
                    color: '#BB0000',
                    sliced: true,
                    selected: true
                }, {
                    name: 'Sản phẩm 2',
                    y: 20,
                    color: '#FFFF66',
                },{
                    name: 'Sản phẩm 3',
                    y: 20,
                    color: '#00FF00'
                }, {
                    name: 'Sản phẩm 4',
                    y: 15,
                    color: '#33CCFF'
                }, {
                    name: 'Sản phẩm 5',
                    y: 5
                }, {
                    name: 'Sản phẩm 6',
                    y: 5
                }, {
                    name: 'Sản phẩm 7',
                    y: 20
                },{
                    name: 'Sản phẩm 8',
                    y: 20
                }, {
                    name: 'Sản phẩm 9',
                    y: 15
                }, {
                    name: 'Sản phẩm 10',
                    y: 5
                }]
            }]
        });
    }

    return modules;
}(window.jQuery, window, document));

$(document).ready(function () {
    adminFunction.buildCharts();
});
