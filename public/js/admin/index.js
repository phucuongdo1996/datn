let adminFunction = (function () {
    let modules = {};

    modules.buildCharts = function () {
        modules.getDataRevenue();
        modules.buildTopSellChart();
    }

    modules.getDataRevenue = function () {
        let formData = new FormData();
        formData.append("_token", $('meta[name="csrf-token"]').attr('content'));
        let submitAjax = $.ajax({
            url: '/admin/get-data-revenue',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false
        })
        submitAjax.done(function (response) {
            modules.buildIncomeChart(response.data);
            $('input[name=revenue_index_month]').val(Common.numberFormat(Number(response.data.revenue_index_month.revenue_agency) +
                Number(response.data.revenue_index_month.revenue_recharge_money) +  Number(response.data.revenue_index_month.revenue_steam_code)));
            $('input[name=revenue_last_month]').val(Common.numberFormat(Number(response.data.revenue_last_month.revenue_agency) +
                Number(response.data.revenue_last_month.revenue_recharge_money) +  Number(response.data.revenue_last_month.revenue_steam_code)));
        });
        submitAjax.fail(function (response) {
            console.log(response);
        });
    }

    modules.buildIncomeChart = function (data) {
        Highcharts.chart('chart-income', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'Doanh thu theo tháng'
            },
            xAxis: {
                categories: data.categories
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
                data: data.revenue_recharge_money.map(i => Number(i))
            }, {
                name: 'Doanh thu dịch vụ trung gian',
                data: data.revenue_agency.map(i => Number(i))
            }, {
                name: 'Doanh thu Steam code',
                data: data.revenue_steam_code.map(i => Number(i))
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
                pointFormat: '{series.name}: <b>{point.y}</b>'
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
                name: 'Số lượng giao dịch',
                colorByPoint: true,
                data: dataPieChart
            }]
        });
    }

    return modules;
}(window.jQuery, window, document));

$(document).ready(function () {
    adminFunction.buildCharts();
});
