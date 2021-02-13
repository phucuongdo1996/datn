let flagZero = 0;
let flagOne = 1;
let flagTwo = 2;
let flagThree = 3;
let flagFour = 4;
let flagFive = 5;
let borderTop = ".border-top";
let competeChart1, competeChart2, competeChart3, competeChart4, competeChart5, competeChart6;
let dataChart1, dataChart2, dataChart3, dataChart4, dataChart5, dataChart6;
let categoryChart1, categoryChart2, categoryChart3, categoryChart4, categoryChart5, categoryChart6;

var search = (function () {
    let modules = {};

    modules.handlingConditionSearch = function(className, characterClass) {
        $(borderTop).css('display', 'block');
        $(className).addClass("active");
        $(characterClass).removeClass("active");
        $('.bank-search').attr("disabled", false);
    };

    modules.buildCompeteChart = function () {
        competeChart1 = modules.renderCompeteChart('container-1', dataCompeteChart[0], '1㎡あたり運営収支 ⇔ レンタブル比（床有効率）', 'レンタブル比\n' +
            '（床有効率）', '1㎡あたり運営収支', '%', '円/㎡', false, true, 2, 0);
        dataChart1 = dataCompeteChart[0][1];
        categoryChart1 = dataCompeteChart[0][0];

        competeChart2 = modules.renderCompeteChart('container-2', dataCompeteChart[1], '経費率 ⇔ レンタブル比（床有効率）', 'レンタブル比\n' +
            '（床有効率）', '経費率', '%', '%', false, false, 2, 2);
        dataChart2 = dataCompeteChart[1][1];
        categoryChart2 = dataCompeteChart[1][0];

        competeChart3 = modules.renderCompeteChart('container-3', dataCompeteChart[2], '経費率 ⇔ 1㎡あたり賃貸事業収入', '1㎡あたり運営収支',
            '経費率', '円/㎡', '%', true, false, 0, 2);
        dataChart3 = dataCompeteChart[2][1];
        categoryChart3 = dataCompeteChart[2][0];

        competeChart4 = modules.renderCompeteChart('container-4', dataCompeteChart[3], '1㎡あたり賃貸事業費用 ⇔ 1㎡あたり賃貸事業収入', '1㎡あたり運営収支',
            '1㎡あたり賃貸事業費用', '円/㎡', '円/㎡', true, true, 0, 0);
        dataChart4 = dataCompeteChart[3][1];
        categoryChart4 = dataCompeteChart[3][0];

        competeChart5 = modules.renderCompeteChart('container-5', dataCompeteChart[4], '1㎡あたり修繕費 ⇔ 1㎡あたり維持管理費/月', '1㎡あたり維持管理費/月',
            '1㎡あたり修繕費', '円/㎡', '円/㎡', true, true, 0, 0);
        dataChart5 = dataCompeteChart[4][1];
        categoryChart5 = dataCompeteChart[4][0];

        competeChart6 = modules.renderCompeteChart6('container-6', dataCompeteChart[5], '費用項目別 - 1㎡あたり年間単価-', '', '', '', '円/㎡', false, true);
        categoryChart6 = dataCompeteChart[5][0];
    }

    modules.renderCompeteChart = function (renderTo, data, title, titleX, titleY, percentX, percentY, brX, brY, decimalX, decimalY) {
        return new Highcharts.Chart({
            chart: {
                type: 'scatter',
                renderTo: renderTo,
                height: 310,
                backgroundColor: 'transparent',
                style: {
                    fontFamily: "Noto Sans CJK JP",
                },
                events: {
                    load: function(event) {
                        this.series.forEach(function(s) {
                            s.update({
                                showInLegend: s.points.length
                            });
                        });
                        event.target.reflow();
                    }
                }
            },
            exporting: {
                enabled: false
            },
            title: {
                text: title,
                style: {
                    fontSize: '16px',
                    fontWeight: 'bold',
                    color: '#2C3348'
                }
            },
            tooltip: {
                formatter: function () {
                    return  '<div>'+'<b>'+ this.point.name +'</b>' + '<br>' +
                        titleX +': <b>' + Common.numberFormat(this.x, decimalX) + ' ' + percentX +
                        '<br>'+ titleY +': <b>'+ Common.numberFormat(this.y, decimalY) + ' ' + percentY + '</b>'+ '</div>';
                },
                shared: true
            },
            legend: {
                enabled: false
            },
            credits: {
                enabled: false
            },
            xAxis: {
                categories: data[0],
                visible: data[0].length !== 0,
                title: {
                    text: titleX,
                    style: {
                        color: '#2C3348',
                        fontWeight: 'bold',
                    },
                    y: 7,
                },
                labels: {
                    style: {
                        fontSize: '12px',
                        color: '#2C3348',
                    },
                    formatter: function () {
                        return (this.value >= 0 ? '<div>' : '<div style="color:red">') + (Common.numberFormat(this.value) + (brX ? '<br>' :'') + percentX + '</div>');
                    },
                },
            },
            yAxis: {
                allowDecimals: false,
                tickAmount: 6,
                title: {
                    text: titleY,
                    style: {
                        color: '#2C3348',
                        fontWeight: 'bold',
                    }
                },
                // max: percentY === '%' ? 100 : null,
                labels: {
                    style: {
                        fontSize: '12px',
                        color: '#2C3348',
                    },
                    formatter: function () {
                        return (this.value >= 0 ? '<div>' : '<div style="color:red">') + (Common.numberFormat(this.value.toFixed()) + (brY ? '<br>' :'') + percentY + '</div>');
                    },
                },
            },
            plotOptions: {
                series : {
                    marker: {
                        symbol: 'circle',
                    }
                }
            },
            series: [{
                data: data[1]
            }],
            lang: {
                noData: "データが存在しません"
            },
            noData: {
                style: {
                    fontWeight: 'bold',
                    fontSize: '12px',
                    color: '#2C3348'
                }
            }
        });
    };

    modules.renderCompeteChart6 = function (renderTo, data, title, titleX, titleY, percentX, percentY, brX, brY, decimalX, decimalY) {
        dataChart6 = [{
            name: '維持管理費（年間・1㎡当たり）',
            data: data[1][3],
            color: '#2E86C1'
        },{
            name: '修繕費（年間・1㎡当たり）',
            data: data[1][2],
            color: '#E74C3C'
        },{
            name: '損害保険料（年間・1㎡当たり）',
            data: data[1][1],
            color: '#28B463'
        },{
            name: '他費用項目（年間・1㎡当たり）',
            data: data[1][0],
            color: '#7D3C98'
        }];

        return new Highcharts.Chart({
            chart: {
                renderTo: renderTo,
                type: 'column',
                height: 310,
                backgroundColor: 'transparent',
                style: {
                    fontFamily: "Noto Sans CJK JP",
                },
                events: {
                    load: function(event) {
                        this.series.forEach(function(s) {
                            s.update({
                                showInLegend: s.points.length
                            });
                        });
                        event.target.reflow();
                    }
                }
            },
            exporting: {
                enabled: false
            },
            credits: {
                enabled: false
            },
            legend: {
                itemDistance: 20,
                itemStyle: {
                    fontSize: '10px'
                },
                backgroundColor: Highcharts.defaultOptions.chart.backgroundColor,
            },
            title: {
                text: title,
                style: {
                    fontSize: '16px',
                    fontWeight: 'bold',
                    color: '#2C3348'
                }
            },
            xAxis: {
                categories: data[0],
                visible: data[0].length !== 0,
            },
            yAxis: {
                min: 0,
                title: {
                    text: titleY
                },
                labels: {
                    style: {
                        fontSize: '12px',
                        color: '#2C3348',
                    },
                    formatter: function () {
                        return (this.value >= 0 ? '<div>' : '<div style="color:red">') + (Common.numberFormat(this.value.toFixed()) + (brY ? '<br>' :'') + percentY + '</div>');
                    },
                },
            },
            tooltip: {
                pointFormat: '<span style="color:{series.color}">{series.name}</span>: <b>{point.y}</b> ({point.percentage:.0f}%)<br/>',
                shared: true
            },
            plotOptions: {
                column: {
                    stacking: 'normal'
                }
            },
            series: dataChart6,
            lang: {
                noData: "データが存在しません"
            },
            noData: {
                style: {
                    fontWeight: 'bold',
                    fontSize: '12px',
                    color: '#2C3348'
                }
            }
        });
    };

    modules.checkConditionSearch = function () {
        $('.bank-search').attr("disabled", true);
        $(".extraction").on('change', function() {
            $('input[type="checkbox"]').prop('checked', false);
            switch (parseInt($(".extraction").val())) {
                case flagZero:
                    $(borderTop).css('display', 'none');
                    $('.bank-search').attr("disabled", true);
                    break;
                case flagOne:
                    search.handlingConditionSearch(".office", ".housing, .shop, .logiIndustry, .hotel");
                    break;
                case flagTwo:
                    search.handlingConditionSearch(".housing", ".office, .shop, .logiIndustry, .hotel");
                    break;
                case flagThree:
                    search.handlingConditionSearch(".shop", ".office, .housing, .logiIndustry, .hotel");
                    break;
                case flagFour:
                    search.handlingConditionSearch(".logiIndustry", ".office, .housing, .shop, .hotel");
                    break;
                case flagFive:
                    search.handlingConditionSearch(".hotel", ".office, .housing, .shop, .logiIndustry");
                    break;
                default:
                    break;
            }
        });
    };

    modules.checkAllOnOff = function () {
         $(".check-all").change(function(){
                $(this).parents(".row").find('input[type="checkbox"]').prop('checked', $(this).prop('checked'))
         });
         $(".check-on-off").change(function(){
             let row = $(this).parents(".row");
             row.find('.check-on-off:checked').length != row.find('.check-on-off').length
                 ? row.find('.check-all').prop('checked', false) : row.find('.check-all').prop('checked', true);
         });
    };

    modules.handlingConditionAfterHavingParamUrl = function () {
        if ($('.container-fluid').hasClass('wrapper-bank-list') || $('.check-param-url').val() == flagOne) {
            $(borderTop).css('display', 'block');
            $('.bank-search').attr("disabled", false);
            switch (parseInt($(".extraction").val())) {
                case flagOne:
                    $(".office").addClass("active");
                    break;
                case flagTwo:
                    $(".housing").addClass("active");
                    break;
                case flagThree:
                    $(".shop").addClass("active");
                    break;
                case flagFour:
                    $(".logiIndustry").addClass("active");
                    break;
                case flagFive:
                    $(".hotel").addClass("active");
                    break;
                default:
                    break;
            }
            $('.row-search').each(function(index, value) {
                $(value).find('.row:not(.active)').find('input[type=checkbox]').prop('checked', false);
            });
        }
    };

    modules.rebuildCompeteChart = function () {
        let newDataChart1 =  [], newDataChart2 = [], newDataChart3 = [], newDataChart4 = [], newDataChart5 = [],
            newCategory1 = [], newCategory2 = [], newCategory3 = [], newCategory4 = [], newCategory5 = [],
            newCategoryChart6 = [],
            newDataChart6 = [[], [], [], []];
        $.each($('.check-show-on-chart'), function() {
            if($(this).is(':checked')) {
                newDataChart1.push(dataChart1[this.dataset.index]);
                newDataChart2.push(dataChart2[this.dataset.index]);
                newDataChart3.push(dataChart3[this.dataset.index]);
                newDataChart4.push(dataChart4[this.dataset.index]);
                newDataChart5.push(dataChart5[this.dataset.index]);

                newCategory1.push(categoryChart1[this.dataset.index]);
                newCategory2.push(categoryChart2[this.dataset.index]);
                newCategory3.push(categoryChart3[this.dataset.index]);
                newCategory4.push(categoryChart4[this.dataset.index]);
                newCategory5.push(categoryChart5[this.dataset.index]);

                newCategoryChart6.push(categoryChart6[this.dataset.index]);
                newDataChart6[0].push(dataChart6[0].data[this.dataset.index]);
                newDataChart6[1].push(dataChart6[1].data[this.dataset.index]);
                newDataChart6[2].push(dataChart6[2].data[this.dataset.index]);
                newDataChart6[3].push(dataChart6[3].data[this.dataset.index]);
            }
        });
        modules.setOptionChart(competeChart1, newDataChart1, newCategory1, true);
        modules.setOptionChart(competeChart2, newDataChart2, newCategory2, true);
        modules.setOptionChart(competeChart3, newDataChart3, newCategory3, true);
        modules.setOptionChart(competeChart4, newDataChart4, newCategory4, true);
        modules.setOptionChart(competeChart5, newDataChart5, newCategory5, true);
        modules.setOptionChart6(newDataChart6, newCategoryChart6, true);
    };

    modules.resetCompeteChart = function (showAll) {
        if (showAll) {
            modules.setOptionChart(competeChart1, dataChart1, categoryChart1, true);
            modules.setOptionChart(competeChart2, dataChart2, categoryChart2, true);
            modules.setOptionChart(competeChart3, dataChart3, categoryChart3, true);
            modules.setOptionChart(competeChart4, dataChart4, categoryChart4, true);
            modules.setOptionChart(competeChart5, dataChart5, categoryChart5, true);
            modules.setOptionChart6(dataChart6.map(a => a.data), categoryChart6, true);
        } else {
            modules.setOptionChart(competeChart1, [], [], false);
            modules.setOptionChart(competeChart2, [], [], false);
            modules.setOptionChart(competeChart3, [], [], false);
            modules.setOptionChart(competeChart4, [], [], false);
            modules.setOptionChart(competeChart5, [], [], false);
            modules.setOptionChart6([[], [], [], []], [], false);
        }
    }

    modules.setOptionChart = function (chart, dataSeries, categories, visible) {
        chart.series[0].setData(dataSeries);
        chart.xAxis[0].update({
            categories: categories,
            visible: visible
        });
        chart.yAxis[0].update({visible: visible});
    }

    modules.setOptionChart6 = function (dataSeries, categories, visible) {
        competeChart6.series[0].setData(dataSeries[0]);
        competeChart6.series[1].setData(dataSeries[1]);
        competeChart6.series[2].setData(dataSeries[2]);
        competeChart6.series[3].setData(dataSeries[3]);
        competeChart6.xAxis[0].update({
            categories: categories,
            visible: visible
        });
        competeChart6.yAxis[0].update({visible: visible});
        competeChart6.legend.update({enabled: visible});
    }

    return modules;
}(window.jQuery, window, document));

$(document).ready(function () {
    search.checkConditionSearch();
    search.checkAllOnOff();
    search.handlingConditionAfterHavingParamUrl();
    search.buildCompeteChart();

    $('.dropdown-menu .checkbox-search').on( 'click', function() {
        let checkBoxes = $(this).find('input[type="checkbox"]');
        checkBoxes.prop("checked", !checkBoxes.prop("checked"));
        $('.' + checkBoxes[flagZero].id).toggle();
        return false;
    });

    $('.check-show-on-chart').on('change', function () {
        let check = $('.check-show-on-chart:not(:checked)').length === 0;
        $('#all-data').prop('checked', check);
        if (check) {
            search.resetCompeteChart(true);
        } else if ($('.check-show-on-chart:checked').length === 0) {
            search.resetCompeteChart(false);
        } else {
            search.rebuildCompeteChart();
        }
    });

    $('#all-data').on('change', function () {
        let check = $(this).is(':checked');
        $('.check-show-on-chart').prop('checked', check)
        search.resetCompeteChart(check)
    });
});
