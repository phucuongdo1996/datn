const FLAG_ZERO = 0;
const FLAG_ONE = 1;
const FLAG_TWO = 2;
const FLAG_THREE = 3;
const FLAG_FOUR = 4;
const FLAG_FIVE = 5;
const ARRAY_TITLE_BOX_PLOT = [
    ' -1m²あたり運営収益-【地域別】', ' -1m²あたり運営費用-【延床面積別】', ' -賃料水準-【地域別】',
    ' -1m²あたり維持管理費-【延床面積別】', ' -1m²あたり修繕費-【築年数別】', ' -1m²あたり運営収支-【地域別】'
];
let scatterChart;
var singleAnalysis = (function () {
    let  modules = {};

    modules.setValueInTable4 = function () {
        let revenueLandTaxes = Common.convertStringToNumber($('.revenue_land_taxes').val()); //number0
        let revenueRoomRentals = Common.convertStringToNumber($('.td-revenue-room-rentals').html()); //number1
        let groundAreaUnit2 = Common.convertStringToNumber($('.td-ground-area-unit2').html()); // unit22
        let groundArea = Common.convertStringToNumber($('.td-ground-area').html()); // m2
        let revenueServiceCharges = Common.convertStringToNumber($('.td-revenue-service-charges').html()); //number2
        let revenueUtilities = Common.convertStringToNumber($('.td-revenue-utilities').html()); //number3
        let revenueCarDeposits = Common.convertStringToNumber($('.td-revenue-car-deposits').html()); //number4
        let turnoverRevenue = Common.convertStringToNumber($('.td-turnover-revenue').html()); //number5
        let revenueContractUpdateFee = Common.convertStringToNumber($('.td-revenue-contract-update-fee').html()); //number6
        let revenueOther = Common.convertStringToNumber($('.td-revenue-other').html()); //number7
        let badDebt = Common.convertStringToNumber($('.td-bad-debt').html()); //number8
        let totalRevenue = Common.convertStringToNumber($('.td-total-revenue').html()); //number9
        let maintenanceManagementFee = Common.convertStringToNumber($('.td-maintenance-management-fee').html()); //number10
        let electricityGasCharges = Common.convertStringToNumber($('.td-electricity-gas-charges').html()); //number11
        let repairFee = Common.convertStringToNumber($('.td-repair-fee').html()); //number12
        let recoveryCosts = Common.convertStringToNumber($('.td-recovery-costs').html()); //number13
        let propertyManagementFee = Common.convertStringToNumber($('.td-property-management_fee').html()); //number14
        let findTenantFee = Common.convertStringToNumber($('.td-find-tenant-fee').html()); //number15
        let otherCosts = Common.convertStringToNumber($('.td-other-costs').html()); //number19
        let totalCost = Common.convertStringToNumber($('.td-total-cost').html()); //number20
        let operatingExpenses = Common.convertStringToNumber($('.td-operating-expenses').html()); //number21
        let totalRevenue21 = Common.convertStringToNumber($('.td-total_revenue-21').html()); //td-21
        let rentalIncome = revenueRoomRentals + revenueServiceCharges + revenueLandTaxes;

        $('.op-building-floor-area-0').text(Common.numberFormat((revenueLandTaxes / 12 / Common.convertStringToNumber($('.ground-area-unit2').text())).toFixed(0)) + ' 円/坪');
        $('.op-building-floor-area-1').text(Common.numberFormat((revenueRoomRentals / 12 / groundAreaUnit2).toFixed(0)) + ' 円/坪');
        $('.op-building-floor-area-2').text(Common.numberFormat((revenueServiceCharges / 12 / groundAreaUnit2).toFixed(0)) + ' 円/坪');
        $('.op-building-floor-area-3').text(Common.numberFormat((revenueUtilities / 12 / groundAreaUnit2).toFixed(0)) + ' 円/坪');
        $('.op-revenue-car').text(Common.numberFormat((revenueCarDeposits / 12).toFixed(0)) + ' 円');
        $('.op-turnover-revenue').text(Common.numberFormat((turnoverRevenue / revenueRoomRentals * 100).toFixed(2)) + ' %');
        $('.op-revenue-contract-update-fee').text(Common.numberFormat((revenueContractUpdateFee / revenueRoomRentals * 100).toFixed(2)) + ' %');
        $('.op-revenue-other').text(Common.numberFormat((revenueOther / rentalIncome * 100).toFixed(2)) + ' %');
        $('.op-bad-debt').text(Common.numberFormat((badDebt / rentalIncome * 100).toFixed(2)) + ' %');
        $('.op-total-revenue').text(Common.numberFormat((totalRevenue / groundArea).toFixed(0)) + ' 円/m²');
        $('.op-maintenance-fee').text(Common.numberFormat((maintenanceManagementFee / 12 / groundArea).toFixed(0)) + ' 円/m²');
        $('.op-electricity-gas-charges').text(Common.numberFormat((electricityGasCharges / 12 / groundAreaUnit2).toFixed(0)) + ' 円/坪');
        $('.op-repair-fee').text(Common.numberFormat((repairFee / groundArea).toFixed(0)) + ' 円/m²');
        $('.op-recovery-costs').text(Common.numberFormat((recoveryCosts / groundArea).toFixed(0)) + ' 円/m²');
        $('.op-property-management-fee').text(Common.numberFormat((propertyManagementFee / rentalIncome * 100).toFixed(2)) + ' %');
        $('.op-find-tenant-fee').text(Common.numberFormat((findTenantFee / rentalIncome * 100).toFixed(2)) + ' %');
        $('.op-tax').text(Common.numberFormat((otherCosts / totalRevenue * 100).toFixed(2)) + ' %');
        $('.op-total-cost').text(Common.numberFormat((totalCost / totalRevenue21 * 100).toFixed(2)) + ' %');
        $('.op-ground-area').text(Common.numberFormat((operatingExpenses / groundArea).toFixed(0)) + ' 円/m²');
    };

    modules.showOrHideScatterChart = function () {
        let realEstateTypeId = $('.single-analysis-scatter-chart').val();
        if (realEstateTypeId == 9 || realEstateTypeId == 10) {
            $("#scatter-chart").parent().attr("hidden",false);
        } else {
            $("#scatter-chart, #scatter-chart-preview").parent().attr("hidden",true);
            $("#scatter-chart-preview").parent().parent().attr("hidden",true);
            $('.score-map-wrapper').removeClass('p2l');
            $('.single-analysis-simulation-charts').css({
                flex: '0 0 100%',
                maxWidth: '100%',
            });
        }
    };

    return modules;
}(window.jQuery, window, document));

var highChartSingleAnalysis = (function () {
    let modules = {};

    modules.buildCharts = function () {
        modules.buildScatterChart();
        modules.buildBoxPlotChart(dataBoxPlot);
        modules.buildSpiderWebChart();
        modules.loadChartDataSimulation(dataAll);
        modules.buildCompeteChart();
    };

    modules.buildCompeteChart = function () {
        modules.renderCompeteChart('container-1', dataCompeteChart[0], '1㎡あたり運営収支 ⇔ レンタブル比（床有効率）', 'レンタブル比\n' +
            '（床有効率）', '1㎡あたり運営収支', '%', '円/㎡', false, true, 2, 0);
        modules.renderCompeteChart('container-2', dataCompeteChart[1], '経費率 ⇔ レンタブル比（床有効率）', 'レンタブル比\n' +
            '（床有効率）', '経費率', '%', '%', false, false, 2, 2);
        modules.renderCompeteChart('container-3', dataCompeteChart[2], '経費率 ⇔ 1㎡あたり賃貸事業収入', '1㎡あたり運営収支',
            '経費率', '円/㎡', '%', true, false, 0, 2);
        modules.renderCompeteChart('container-4', dataCompeteChart[3], '1㎡あたり賃貸事業費用 ⇔ 1㎡あたり賃貸事業収入', '1㎡あたり運営収支',
            '1㎡あたり賃貸事業費用', '円/㎡', '円/㎡', true, true, 0, 0);
        modules.renderCompeteChart('container-5', dataCompeteChart[4], '1㎡あたり修繕費 ⇔ 1㎡あたり維持管理費/月', '1㎡あたり維持管理費/月',
            '1㎡あたり修繕費', '円/㎡', '円/㎡', true, true, 0, 0);
        modules.renderCompeteChart6('container-6', dataCompeteChart[5], '費用項目別 - 1㎡あたり年間単価-', '', '', '', '円/㎡', false, true);
    }

    modules.renderCompeteChart = function (renderTo, data, title, titleX, titleY, percentX, percentY, brX, brY, decimalX, decimalY) {
        return  new Highcharts.Chart({
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
            series: [{
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

    modules.buildSpiderWebChart = function () {
        let formdata = new FormData();
        formdata.append("_token", $('meta[name="csrf-token"]').attr('content'));
        formdata.append('type', 'single_analysis');
        formdata.append('property_id', $('.property-id').val());
        let submitAjax = $.ajax({
            type: "POST",
            url: '/property/highcharts/spiderweb/',
            data: formdata,
            processData: false,
            contentType: false,
        });

        submitAjax.done(function (response) {
            setTimeout(function () {
                modules.renderSpiderWebChart(response);
            }, 500);
        });
    };

    modules.renderSpiderWebChart = function(data) {
        modules.swapDataQuarter(data.dataFirstQuarter, data.dataThirdQuarter);
        let idDiv = 'spiderweb-chart',
            categories = ['賃料水準', '運営費用', '損害保険料', '修繕費',
                '維持管理費', '運営収益'],
            legend = true,
            series = [{
                name: 'center',
                data: defaultData,
                pointPlacement: 'on',
                color: '#707070',
                lineWidth: 2,
                showInLegend: false,
                tooltip: {
                    pointFormat: '',
                },
            }, {
                name: '対象不動産',
                data: data.dataSpiderWeb,
                pointPlacement: 'on',
                color: '#D03C42'
            },{
                name: '第１四分位',
                data: data.dataFirstQuarter,
                pointPlacement: 'on',
                color: '#0E7AFF'
            },{
                name: '中央',
                data: data.dataAverageNumber,
                pointPlacement: 'on',
                color: '#088B5E'
            },{
                name: '第３四分位',
                data: data.dataThirdQuarter,
                pointPlacement: 'on',
                color: '#5B4786'
            }];
        commonHighchart.buildSpiderWebChart(idDiv, categories, series, '', legend);
        commonHighchart.buildSpiderWebChart('spiderweb-chart-preview', categories, series, '', false, 253);
    };

    modules.swapDataQuarter = function(FirstQuarter, thirdQuarter) {
        for (let i = 1; i < 5; i++) {
            let mediate = FirstQuarter[i];
            FirstQuarter[i] = thirdQuarter[i];
            thirdQuarter[i] = mediate;
        }
    };

    modules.convertData = function(data) {
        let category = [], dataBlock = [], dataDote = [], dataLine = [], dataAmount = [];
        $.each(data, function (key, val) {
            category.push('<b>' + val.region_acreage_year + '</b><br>');
            dataBlock.push([val.average_number, val.first_quarter, val.average_number, val.third_quarter, val.average_number]);
            dataDote.push([key, val.medium]);
            dataLine.push(val.real_estate_object);
            dataAmount.push(val.amount);
        });
        return {
            category, dataBlock, dataDote, dataLine, dataAmount
        }
    };

    modules.makeArrayTitle = function (dataBoxPlot) {
        let arrTitle = [];
        if (dataBoxPlot.bank_uses) {
            $.each(ARRAY_TITLE_BOX_PLOT, function (key, val) {
                arrTitle.push(dataBoxPlot.bank_uses + val);
            });
        }
        return arrTitle;
    };

    modules.makeArrayData = function (dataBoxPlot) {
        let chartOne = [], chartTwo = [], chartThree = [], chartFour = [], chartFive = [], chartSix = [];
        $.each(dataBoxPlot, function (key, val) {
            switch(val.formula) {
                case 1:
                    chartThree.push(val);
                    break;
                case 2:
                    chartTwo.push(val);
                    break;
                case 4:
                    chartFive.push(val);
                    break;
                case 5:
                    chartFour.push(val);
                    break;
                case 6:
                    chartOne.push(val);
                    break;
                case 7:
                    chartSix.push(val);
                    break;
                default :
                    break;
            }
        });
        return [
            highChartSingleAnalysis.convertData(chartOne), highChartSingleAnalysis.convertData(chartTwo), highChartSingleAnalysis.convertData(chartThree),
            highChartSingleAnalysis.convertData(chartFour), highChartSingleAnalysis.convertData(chartFive),highChartSingleAnalysis.convertData(chartSix)
        ];
    };

    modules.buildBoxPlotChart = function (dataBoxPlot) {
        let dataChartOne = highChartSingleAnalysis.makeArrayData(dataBoxPlot)[FLAG_ZERO], dataChartTwo = highChartSingleAnalysis.makeArrayData(dataBoxPlot)[FLAG_ONE],
        dataChartThree = highChartSingleAnalysis.makeArrayData(dataBoxPlot)[FLAG_TWO], dataChartFour = highChartSingleAnalysis.makeArrayData(dataBoxPlot)[FLAG_THREE],
        dataChartFive = highChartSingleAnalysis.makeArrayData(dataBoxPlot)[FLAG_FOUR], dataChartSix = highChartSingleAnalysis.makeArrayData(dataBoxPlot)[FLAG_FIVE];

        commonHighchart.buildBoxPlotChart('box-plot-chart-1', dataChartOne.category, commonHighcharts.setItemBoxPlotChart(dataChartOne.dataBlock, dataChartOne.dataDote, dataChartOne.dataLine, '円/㎡', dataChartOne.dataAmount, FLAG_ZERO), highChartSingleAnalysis.makeArrayTitle(dataBoxPlot)[FLAG_ZERO], "", "", '(円/㎡)');
        commonHighchart.buildBoxPlotChart('box-plot-chart-2', dataChartTwo.category, commonHighcharts.setItemBoxPlotChart(dataChartTwo.dataBlock, dataChartTwo.dataDote, dataChartTwo.dataLine, '円/㎡', dataChartTwo.dataAmount, FLAG_ONE), highChartSingleAnalysis.makeArrayTitle(dataBoxPlot)[FLAG_ONE], "", "", '(円/㎡)');
        commonHighchart.buildBoxPlotChart('box-plot-chart-3', dataChartThree.category, commonHighcharts.setItemBoxPlotChart(dataChartThree.dataBlock, dataChartThree.dataDote, dataChartThree.dataLine, '円/㎡/月/坪', dataChartThree.dataAmount, FLAG_ZERO), highChartSingleAnalysis.makeArrayTitle(dataBoxPlot)[FLAG_TWO], "", "", '(円/㎡/月/坪)');
        commonHighchart.buildBoxPlotChart('box-plot-chart-4', dataChartFour.category, commonHighcharts.setItemBoxPlotChart(dataChartFour.dataBlock, dataChartFour.dataDote, dataChartFour.dataLine, '円/㎡/月', dataChartFour.dataAmount, FLAG_ZERO), highChartSingleAnalysis.makeArrayTitle(dataBoxPlot)[FLAG_THREE], "", "", '(円/㎡/月)');
        commonHighchart.buildBoxPlotChart('box-plot-chart-5', dataChartFive.category, commonHighcharts.setItemBoxPlotChart(dataChartFive.dataBlock, dataChartFive.dataDote, dataChartFive.dataLine, '円/㎡', dataChartFive.dataAmount, FLAG_ZERO), highChartSingleAnalysis.makeArrayTitle(dataBoxPlot)[FLAG_FOUR], "", "", '(円/㎡)');
        commonHighchart.buildBoxPlotChart('box-plot-chart-6', dataChartSix.category, commonHighcharts.setItemBoxPlotChart(dataChartSix.dataBlock, dataChartSix.dataDote, dataChartSix.dataLine, '円/㎡', dataChartSix.dataAmount, FLAG_ZERO), highChartSingleAnalysis.makeArrayTitle(dataBoxPlot)[FLAG_FIVE], "", "", '(円/㎡)');

        commonHighchart.buildBoxPlotChart('box-plot-chart-1-preview', dataChartOne.category, commonHighcharts.setItemBoxPlotChart(dataChartOne.dataBlock, dataChartOne.dataDote, dataChartOne.dataLine, '円/㎡', dataChartOne.dataAmount, FLAG_ZERO), highChartSingleAnalysis.makeArrayTitle(dataBoxPlot)[FLAG_ZERO], "", "", '(円/㎡)', 310);
        commonHighchart.buildBoxPlotChart('box-plot-chart-2-preview', dataChartTwo.category, commonHighcharts.setItemBoxPlotChart(dataChartTwo.dataBlock, dataChartTwo.dataDote, dataChartTwo.dataLine, '円/㎡', dataChartTwo.dataAmount, FLAG_ONE), highChartSingleAnalysis.makeArrayTitle(dataBoxPlot)[FLAG_ONE], "", "", '(円/㎡)', 310);
        commonHighchart.buildBoxPlotChart('box-plot-chart-3-preview', dataChartThree.category, commonHighcharts.setItemBoxPlotChart(dataChartThree.dataBlock, dataChartThree.dataDote, dataChartThree.dataLine, '円/㎡/月/坪', dataChartThree.dataAmount, FLAG_ZERO), highChartSingleAnalysis.makeArrayTitle(dataBoxPlot)[FLAG_TWO], "", "", '(円/㎡/月/坪)', 310);
        commonHighchart.buildBoxPlotChart('box-plot-chart-4-preview', dataChartFour.category, commonHighcharts.setItemBoxPlotChart(dataChartFour.dataBlock, dataChartFour.dataDote, dataChartFour.dataLine, '円/㎡/月', dataChartFour.dataAmount, FLAG_ZERO), highChartSingleAnalysis.makeArrayTitle(dataBoxPlot)[FLAG_THREE], "", "", '(円/㎡/月)', 310);
        commonHighchart.buildBoxPlotChart('box-plot-chart-5-preview', dataChartFive.category, commonHighcharts.setItemBoxPlotChart(dataChartFive.dataBlock, dataChartFive.dataDote, dataChartFive.dataLine, '円/㎡', dataChartFive.dataAmount, FLAG_ZERO), highChartSingleAnalysis.makeArrayTitle(dataBoxPlot)[FLAG_FOUR], "", "", '(円/㎡)', 310);
        commonHighchart.buildBoxPlotChart('box-plot-chart-6-preview', dataChartSix.category, commonHighcharts.setItemBoxPlotChart(dataChartSix.dataBlock, dataChartSix.dataDote, dataChartSix.dataLine, '円/㎡', dataChartSix.dataAmount, FLAG_ZERO), highChartSingleAnalysis.makeArrayTitle(dataBoxPlot)[FLAG_FIVE], "", "", '(円/㎡)', 310);
    };

    modules.buildScatterChart = function () {
        let formdata = new FormData();
        formdata.append("_token", $('meta[name="csrf-token"]').attr('content'));
        let submitAjax = $.ajax({
            type: "POST",
            url: '/property/highcharts/scatter/',
            data: formdata,
            processData: false,
            contentType: false,
        });
        const TYPES = ['オフィスビル_事務所', 'レジデンス_住宅', 'リテール_店舗', 'ヘルスケア・ホテル', 'ロジ・インダストリー'];
        const URL_ICON = [BASE_URL_ICON_01, BASE_URL_ICON_02, BASE_URL_ICON_03, BASE_URL_ICON_04, BASE_URL_ICON_05];
        submitAjax.done(function (response) {
            let seriesScatter = [];
            let listPoint = [];
            let checkParabol = false;
            $.each(response.data, function (key, value) {
                listPoint = listPoint.concat(value);
                seriesScatter.push({
                    name: TYPES[key],
                    type: 'scatter',
                    data: value,
                    marker: {
                        symbol: "url("+URL_ICON[key]+")",
                        width: 6,
                        height: 6,
                    }
                });
            });
            modules.sortData(listPoint);
            let parabol = [];
            if (listPoint.length > 1) {
                let xValues = [];
                let augment = (Number(listPoint[listPoint.length - 1][0]) - Number(listPoint[0][0])) / 100;
                let slope = regression('polynomial', listPoint);
                let a = slope.equation[2], b = slope.equation[1], c = slope.equation[0];
                for (let k = listPoint[0][0]; k < listPoint[listPoint.length - 1][0]; k += augment) {
                    xValues.push(k);
                }
                parabol =  modules.plottingPoints(xValues, a, b, c)
            }
            seriesScatter.push({
                    name: '全体',
                    type: 'scatter',
                    data: [],
                    marker: {
                        symbol: 'url()'
                    }
                },{
                    name: '対象不動産',
                    color: '#ff0000',
                    type: 'line',
                    data: [],
                    marker: {
                        enabled: false
                    }
                },{
                    type: 'spline',
                    name: '多項式（全体）',
                    color: '#0099FF',
                    data: parabol,
                    marker: {
                        enabled: false
                    },
                    enableMouseTracking: false,
                }
            );
            let idDiv = 'scatter-chart';
            let scatterChart = commonHighchart.buildScatterChart(idDiv, seriesScatter, "底地上アセットタイプ別 設定地代散布図", "", "月額地代単価（円/坪）", "年間地代（円/㎡）÷ 前面路線価（円/㎡）");
            let scatterChartPreview = commonHighchart.buildScatterChart('scatter-chart-preview', seriesScatter, "底地上アセットタイプ別 設定地代散布図", "", "月額地代単価（円/坪）", "年間地代（円/㎡）÷ 前面路線価（円/㎡）", 300);
            modules.updateScatterChart(scatterChart);
            modules.updateScatterChart(scatterChartPreview);
        });
    };

    modules.sortData = function ($data) {
        for (let i = 0; i < $data.length - 1; i++) {
            for (let k = i + 1; k < $data.length; k++) {
                if ($data[i][0] > $data[k][0]) {
                    let tg = $data[i];
                    $data[i] = $data[k];
                    $data[k] = tg
                }
            }
        }
    };

    modules.updateScatterChart = function (chart) {
        let x = Common.convertStringToNumber($('input[id=input-land-rental-fee]').val()),
            y = Common.convertStringToNumber($('input[id=input-area-rent]').val());
        let value = Common.divisionNumber(x, y) / 12 / 0.3025;
        chart.xAxis[0].options.plotLines[0].value = Common.convertStringToNumber(value.toFixed(2));
        chart.xAxis[0].update();
        if (chart.series.length == 10) {
            chart.series[chart.series.length -1].remove();
        }
        chart.addSeries({
            name: "scatter",
            type: 'scatter',
            data: [[value, chart.yAxis[0].min]],
            showInLegend: false,
            enableMouseTracking: false,
            marker: {
                enabled: false
            }
        });
    };

    modules.plottingPoints = function(xValues, a, b, c) {
        let dataLin = [];
        $.each(xValues, function (key, value) {
            dataLin.push([value, (a * value * value) + (b * value) + c]);
        });
        return dataLin;
    };

    modules.loadChartDataSimulation = function (data) {
        let series = [];
        let dataYear = commonHighcharts.setCategoriesColumnChart(35);
        let listPPMT = commonHighcharts.calculateRepayment(data.loan, data.contract_loan_period, data.interest_rate/100, 1, data.years_passed);
        let listCF = commonHighcharts.calculateCF(data.total_revenue - data.total_cost, data.loan, data.contract_loan_period, data.interest_rate/100, data.years_passed);
        let listCFGrandTotal = commonHighcharts.calculateGrandTotalCF(data.total_revenue - data.total_cost, data.loan, data.contract_loan_period, data.interest_rate/100, data.years_passed);
        series.push(commonHighcharts.setItemColumnChart('ローン残高(右軸)', 'column', 1, '#4F81BD', listPPMT, ' 万円'));
        series.push(commonHighcharts.setItemColumnChart('累計CF(右軸)', 'column', 1, '#EE72DC', listCFGrandTotal, ' 万円'));
        series.push(commonHighcharts.setItemColumnChart('CF(右軸)', 'line', 0, '#FF0000', listCF, ' 万円'));
        let titleAll = 'C F シミュレーショ   ン';
        commonHighcharts.buildColumnChart('chart-all' , titleAll, dataYear , '（万円 )', '（万円 )', series);
        commonHighcharts.buildColumnChart('chart-all-preview' , titleAll, dataYear , '（万円 )', '（万円 )', series, null, null, 280);
        $('.highcharts-description').show()
    };

    return modules;
}(window.jQuery, window, document));

$(document).ready(function () {
    singleAnalysis.showOrHideScatterChart();
    singleAnalysis.setValueInTable4();
    highChartSingleAnalysis.buildCharts();

    $('.btn-preview-single-analysis').on('click', function () {
        window.print();
    });

    $('#btn-close-preview-single-analysis').on('click', function () {
        $('#wrapper-master').css('top', 46);
        singleAnalysis.hidePreview();
    });
});
