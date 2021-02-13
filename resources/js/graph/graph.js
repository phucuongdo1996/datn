var heightChart;
var widthTooltip = '150px';
var pie = ".pie";
var record = 0;
var arrayColors = [
    '#2F868C', '#E56C9B', '#f7a35c', '#0377FF', '#FF0000',
    '#D28CD4', '#90ed7d', '#6AF9C4', '#fdec6d', '#24CBE5',
    '#EF2081', '#91e8e1', '#C1DB05', '#F96E00', '#8085e9',
    '#434348', '#4861BF', '#DFBF1D', '#C9E7B6', '#5219A9',
    '#F2D7D5', '#82E0AA', '#F8C471', '#5D6D7E', '#D98880',
    '#F7DC6F', '#85929E', '#85C1E9', '#27AE60', '#ED7569',
    '#EC9E00', '#95A5A6', '#8E44AD', '#BA4A00', '#1ABC9C',
    '#2E86C1', '#1F618D', '#943126', '#2D6D49', '#B9770E',
    '#ee9900', '#bb1122', '#669933', '#b7e6ea', '#f4bfb0',
    '#f2d4a6', '#e6a8d7', '#673147', '#8b4513', '#c10024'
];

const UNIT = 'unit';
const PERCENT = '%';
const CATEGORY_NAME = 'categories';
const flagZero = 0;
const flagOne = 1;
const flagTwo = 2;
const flagThree = 3;
const flagFour = 4;
const flagFive = 5;

var Graph = (function ($) {

    let modules = {};

    modules.processingChartWithNoData = function () {
        return [
            {
                noData: "データが存在しません"
            },
            {
                style: {
                    fontWeight: 'bold',
                    fontSize: '12px',
                    color: '#2C3348'
                }
            }
        ]
    };

    modules.convertHtml = function (text) {
        return String(text).replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;');
    };


    modules.pieChartOption = function (dataArray, renderTo, items) {
        return  {
            chart: {
                renderTo: renderTo,
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                style: {
                    fontFamily: "Noto Sans CJK JP",
                },
                type: 'pie',
                height: heightChart,
                backgroundColor: 'transparent'
            },
            title: {
                text: ''
            },
            legend: {
                symbolHeight: 11,
                symbolWidth: 11,
                symbolRadius: 0,
                layout: 'horizontal',
                align: 'center',
                itemDistance: 180,
                itemStyle: {
                    fontSize: '12px',
                    width: '95px',
                    fontWeight: 'Regular',
                    color: '#2C3348'
                }
            },
            credits: {
                enabled: false
            },
            accessibility: {
                point: {
                    valueSuffix: '%'
                }
            },
            tooltip: {
                outside: true,
                followPointer: true,
                style: {
                    width: widthTooltip
                },
                useHTML: true,
                backgroundColor: "transparent",
                borderWidth: 0,
                borderRadius: 0,
                shadow: false,
                formatter: function () {
                    if (this.key.length > 30) {
                        return '<div style="background: rgba(247,247,247,0.85);padding: 8px;border: 1px solid ' + this.color + ';border-radius:3px;word-wrap:break-word;width:350px; white-space:normal">' + this.key + '<br>' +
                            Common.addCommas(this.y) +' 円'+ '<br> (' + Highcharts.numberFormat(this.percentage, 2) + '%)</div>';
                    } else {
                        return '<div style="background-color: rgba(247,247,247,0.85);padding: 8px;border: 1px solid' + this.color + ';border-radius:3px;">' + this.key + '<br>' + Common.addCommas(this.y) +' 円'+ '<br> (' + Highcharts.numberFormat(this.percentage, 2) + '%)</div>';
                    }
                },
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    colors: arrayColors,
                    dataLabels: {
                        enabled: false,
                        useHTML: true,
                    },
                    showInLegend: false
                }
            },
            labels: {
                items: items
            },
            series: dataArray,
            lang: modules.processingChartWithNoData()[flagZero],
            noData: modules.processingChartWithNoData()[flagOne]
        };
    };

    modules.makeValueLabelPieChart = function (title, center) {
        return {
            html: title,
            style: {
                fontSize: '16px',
                color: '#2C3348',
                fontWeight: 'bold',
                left: center,
                top: '20px'
            }
        }
    };

    modules.makeArrayValueLabelPieChart = function () {
        let dataReturn = [], titleArray = ['取得価額', '査定額', '借入残高', '相続税評価額'];
        titleArray.forEach( function (item, index) {
            index == flagThree ? dataReturn.push(modules.makeValueLabelPieChart(item, 210 + index * 320+'px')) : dataReturn.push(modules.makeValueLabelPieChart(item, 230 + index * 320+'px'));
        });

        return dataReturn;
    };

    modules.makeArray = function(className, type = flagZero) {
        let dataReturn = [];
        $(".pie-chart").each(function (index, element) {
            if (element.dataset.key != flagOne) {
                return;
            }
            $.each(arrayColors, function (item, color) {
                if (item != index) {
                    return;
                }
                if (type) {
                    dataReturn.push({
                        name: Graph.convertHtml($(element).find("td.house-name").text()),
                        color: color,
                        y: Common.convertStringToNumber($(element).find("td." + className + "").text())
                    });
                } else {
                    dataReturn.push({
                        name: Graph.convertHtml($(element).find("td.house-name").text()),
                        color: color,
                        y: Common.convertStringToNumber($(element).find("." + className + "").val()) > flagOne ? Common.convertStringToNumber($(element).find("." + className + "").val()) : flagZero
                    });
                }
            });
        });
        return dataReturn;
    };

    modules.makeDataChart = function (data, center, visible = true) {
        return {
            name: 'Share',
            visible: visible,
            showInLegend: false,
            colorByPoint: true,
            data: data,
            center: center,
            size: 180,
        }
    };

    modules.makeArrayDataChart = function (dataArray) {
        let dataReturn = [];
        let visible = false;
        $.each(dataArray, function (key, value) {
            $.each(value, function (index) {
                if(index+1) {
                    visible = true;
                    return false;
                }
            });
            dataReturn.push(modules.makeDataChart(value, [240 + key * 320, 150], visible ))
        });
        return dataReturn;
    };

    modules.showPieChart = function () {
        let dataArray = [];
         dataArray.push(modules.makeArray('money-receive-house', flagOne), modules.makeArray('assessed-amount', flagZero), modules.makeArray('debt-balance', flagZero), modules.makeArray('inheritance-tax-valuation', flagZero));

        new Highcharts.Chart(Graph.pieChartOption(modules.makeArrayDataChart(dataArray), 'container', Graph.makeArrayValueLabelPieChart()));
    };

    modules.countRecord = function () {
        record = 0;
        $(".pie-chart").each(function (index, element) {
            if (element.dataset.key == 1) {
                record +=1;
            }
        });
        return record;
    };

    modules.loadHighchartsByRecord = function () {
        let record = modules.countRecord();
        if ( record <= 10) {
            heightChart = 350;
        } else if(record <= 20) {
            heightChart = 370;
        } else if(record <= 30) {
            heightChart = 400;
        } else {
            heightChart = 450;
        }
    };

    modules.sum = function (className) {
        let sum = flagZero;
        $(".pie-chart").each(function (index, element) {
            if (element.dataset.key != flagOne) {
                return;
            }
            if (className == 'noi') {
                sum = sum + Common.convertStringToNumber($(element).find("." + className + "").val())
            } else {
                sum = sum + Common.convertStringToNumber($(element).find("." + className + "")[0].innerText)
            }
        });
        return sum;
    };

    modules.columnChartOption = function(renderTo, title, titleY, data, sumNoi, sumRentalPercentage) {
        Highcharts.chart(renderTo, {
            chart: {
                type: 'column',
                height: '310px',
                backgroundColor: 'transparent',
                style: {
                    fontFamily: "Noto Sans CJK JP",
                },
                marginBottom: 90,
                events: {
                    load: function(event) {
                        event.target.reflow();
                    }
                }
            },
            pane: {
                size: '70%'
            },
            colors: arrayColors,
            title: {
                text: title,
                style: {
                    fontSize: '16px',
                    fontWeight: 'bold',
                    color: '#2C3348',
                }
            },
            xAxis: [{
                tickLength: 0,
                categories: [''],
                title: {
                    text: '計　'+ Common.addCommas(sumNoi) + '　円'+'　 　'+'稼働率　:　' + Common.addCommas(sumRentalPercentage),
                    style: {
                        fontSize: '16px',
                        color: '#2C3348',
                    },
                    y: 30,
                    x: -50
                },
            }],
            yAxis: [{
                labels: {
                    style: {
                        fontSize: '12px',
                        color: '#2C3348',
                    },
                    formatter: function () {
                        if (this.value >= 0) {
                            return '<div>' + Common.addCommas(this.value) + '</div>';

                        } else {
                            return '<div style="color: red">' + Common.addCommas(this.value) + '</div>';
                        }
                    },
                },
                tickAmount: 4,
                title: {
                    text: titleY,
                    style: {
                        fontWeight: 'bold',
                        color: '#2C3348',
                    }
                }
            }],
            tooltip: {
                formatter: function () {
                    return '<div style="background-color: rgba(247,247,247,0.85);padding: 8px;border: 1px solid' + this.color + ';border-radius:3px;">' + this.series.name + '<br>' + Common.addCommas(this.y) + '</div>';
                },
            },
            plotOptions: {
                series: {
                    groupPadding: 0.01
                }
            },
            legend: {
                enabled: false
            },
            credits: {
                enabled: false
            },
            exporting: {
                enabled: false
            },
            series: data,
            lang: modules.processingChartWithNoData()[flagZero],
            noData: modules.processingChartWithNoData()[flagOne]
        });
    };

    modules.makeArrayDataColumn = function(className) {
        let dataReturn = [];
        $(".pie-chart").each(function (index, element) {
            if (element.dataset.key != flagOne) {
               return;
            }
            $.each(arrayColors, function (item, color) {
                if (item != index) {
                    return;
                }
                dataReturn.push({
                    name: Graph.convertHtml($(element).find("td.house-name").text()),
                    color: color,
                    data: [Common.convertStringToNumber($(element).find("." + className + "").val())]
                })
            });
        });
        return dataReturn;
    };

    modules.showColumnChart = function () {
        Graph.columnChartOption('noi-chart', 'NOI', '円', Graph.makeArrayDataColumn('noi'), Graph.sum('noi'), $('#sum-rental-percentage').text());
        Graph.columnChartOption('noi-chart-preview', 'NOI', '円', Graph.makeArrayDataColumn('noi'), Graph.sum('noi'), $('#sum-rental-percentage').text());
    };

    modules.setTextTooltipScatterChart = function (text, type = CATEGORY_NAME) {
        if (type == UNIT) {
            return text.substring(text.indexOf("（") + flagOne, text.indexOf("）"));
        }
        return text.substring(flagZero, text.indexOf("（"));
    };

    modules.makeArrayDataScatter = function (className1, className2, type = flagZero) {
        let dataReturn = [];
        $(".pie-chart").each(function (index, element) {
            if (element.dataset.key != flagOne) {
                return;
            }
            $.each(arrayColors, function (item, color) {
                if (item != index) {
                    return;
                }
                switch (type) {
                    case 1:
                        dataReturn.push({
                            name: Graph.convertHtml($(element).find("td.house-name").text()),
                            color: color,
                            x: Common.convertStringToNumber($(element).find(className1)[0].innerText) === 0 ? 0 : Common.convertStringToNumber($(element).find(className1)[0].innerText)/10000,
                            y: Common.convertStringToNumber($(element).find(className2).val()) === 0 ? 0 : Common.convertStringToNumber($(element).find(className2).val())/10000
                        });
                        break;
                    case 2:
                        if (Common.convertStringToNumber($(element).find('.noi-yield').val()) !== flagZero) {
                            dataReturn.push({
                                name: Graph.convertHtml($(element).find("td.house-name").text()),
                                color: color,
                                x: Common.convertStringToNumber($(element).find(className1).val()),
                                y: Common.convertStringToNumber(parseFloat($(element).find(className2).val()).toFixed(flagTwo))
                            });
                        }
                        break;
                    case 3:
                        if (Common.convertStringToNumber($(element).find(className1).val()) !== flagZero) {
                            let noiYield = parseInt((Common.convertStringToNumber($(element).find('.noi').val()) / Common.convertStringToNumber($(element).find(className1).val())).toFixed(flagZero));
                            dataReturn.push({
                                name: Graph.convertHtml($(element).find("td.house-name").text()),
                                color: color,
                                x: noiYield === 0 ? 0 : Common.excelRound(noiYield, 5 - Math.round(noiYield).toString().length)/10000,
                                y: Common.convertStringToNumber($(element).find(className2).val()) === 0 ? 0 : Common.convertStringToNumber($(element).find(className2).val())/10000
                            });
                        }
                        break;
                    case 4:
                        if (Common.convertStringToNumber($(element).find('.noi-yield').val()) !== flagZero) {
                            // let AmountAssessedTaxing = parseInt((Common.convertStringToNumber($(element).find('.noi').val()) / Common.convertStringToNumber($(element).find('.noi-yield').val())).toFixed(flagZero));
                            // let AmountToAssessInheritanceTax = Common.convertStringToNumber($(element).find(className2).val());
                            dataReturn.push({
                                name: Graph.convertHtml($(element).find("td.house-name").text()),
                                color: color,
                                x: Common.convertStringToNumber($(element).find(className1).val()),
                                y: Common.convertStringToNumber($(element).find(className2).val())/10000
                            });
                        }
                        break;
                    default:
                        dataReturn.push({
                            name: Graph.convertHtml($(element).find("td.house-name").text()),
                            color: color,
                            x: Common.convertStringToNumber($(element).find(className1).val()),
                            y: Common.convertStringToNumber($(element).find(className2).val())
                        });
                        break;
                }
            });
        });
        return dataReturn;
    };

    modules.makeArrayDataLine = function (className1, className2, type) {
        let data = [], xs = [];
        $.each(Graph.makeArrayDataScatter(className1, className2, type), function (index, value) {
            let arr = Object.keys(value).map((key) => [key, value[key]]);
            data.push([ arr[flagTwo][flagOne], arr[flagThree][flagOne]]);
        });
        let m = regression('linear', data).equation[flagZero], b = regression('linear', data).equation[flagOne];
        data.forEach(function(index) {
            xs.push(index[flagZero]);
        });
        let x0 = Math.min.apply(null, xs), y0 = m*x0 + b, xf = Math.max.apply(null, xs), yf = m*xf + b;
        return [[x0, y0], [xf, yf]]
    };

    modules.makeArrayDataScatterWithRegressionLine = function (className1, className2, type, textX, textY) {
        let dataReturn = [];
        $.each(Graph.makeArrayDataScatter(className1, className2, type), function (index, value) {
            if (value != []) {
                dataReturn = [Graph.makeArrayDataLine(className1, className2, type), Graph.makeArrayDataScatter(className1, className2, type), textX, textY];
            } else {
                dataReturn = [Graph.makeArrayDataLine(className1, className2, type), Graph.makeArrayDataScatter(className1, className2, type)];
            }
        });
        return dataReturn
    };

    modules.showScatterWithRegressionLine = function () {
        Graph.scatterWithRegressionLine('container-1', Graph.makeArrayDataScatterWithRegressionLine('.money-receive-house', '.noi', flagOne, '取得価額（万円）', 'NOI（万円）'), 'NOI ⇔ 取得価額');
        Graph.scatterWithRegressionLine('container-2', Graph.makeArrayDataScatterWithRegressionLine('.acquisition-price-yield', '.noi-yield', flagTwo, '取得価額利回り（%）', 'NOI利回り（%）'), 'NOI利回り ⇔ 取得価額利回り', 310, true, true);
        Graph.scatterWithRegressionLine('container-3', Graph.makeArrayDataScatterWithRegressionLine('.revenue-room-rentals', '.noi-yield', flagTwo, '賃料水準/月/坪（円）', 'NOI利回り（%）'), 'NOI利回り ⇔ 賃料水準/月/坪', 310, false, true);
        Graph.scatterWithRegressionLine('container-4', Graph.makeArrayDataScatterWithRegressionLine('.noi-yield', '.inheritance-tax-valuation', flagThree, '査定額（万円）', '相続税評価額（万円）'), '相続税評価額 ⇔ 査定額');
        Graph.scatterWithRegressionLine('container-5', Graph.makeArrayDataScatterWithRegressionLine('.synthetic-point', '.assessed-amount-debt-balance', flagFour, 'スコア（points）', '査定額－相続税評価額（万円）'), '査定額−相続税評価額 ⇔ スコア');
        Graph.scatterWithRegressionLine('container-6', Graph.makeArrayDataScatterWithRegressionLine('.total-revenue', '.total-cost', flagZero, '1㎡あたり賃貸事業収入（円）', '1㎡あたり賃貸事業費用（円）'), '1m²あたり賃貸事業費用 ⇔ 1m²あたり賃貸事業収入');
        Graph.scatterWithRegressionLine('container-7', Graph.makeArrayDataScatterWithRegressionLine('.revenue-room-rentals', '.maintenance-management-fee', flagZero, '賃料水準/月/坪（円）', '1㎡あたり維持管理費/月（円）'), '1m²あたり維持管理費/月 ⇔ 賃料水準/月/坪');
        Graph.scatterWithRegressionLine('container-8', Graph.makeArrayDataScatterWithRegressionLine('.revenue-room-rentals', '.repair-fee', flagZero, '賃料水準/月/坪（円）', '1㎡あたり修繕費（円）'), '1m²あたり修繕費 ⇔ 賃料水準/月/坪');
        Graph.scatterWithRegressionLine('container-9', Graph.makeArrayDataScatterWithRegressionLine('.maintenance-management-fee', '.repair-fee', flagZero, '1㎡あたり維持管理費/月（円）', '1㎡あたり修繕費（円）'), '1m²あたり修繕費 ⇔ 1m²あたり維持管理費/月');

        Graph.scatterWithRegressionLine('container-1-preview', Graph.makeArrayDataScatterWithRegressionLine('.money-receive-house', '.noi', flagOne, '取得価額（万円）', 'NOI（万円)'), 'NOI ⇔ 取得価額', 290);
        Graph.scatterWithRegressionLine('container-2-preview', Graph.makeArrayDataScatterWithRegressionLine('.acquisition-price-yield', '.noi-yield', flagTwo, '取得価額利回り（%）', 'NOI利回り（%）'), 'NOI利回り ⇔ 取得価額利回り', 290, true, true);
        Graph.scatterWithRegressionLine('container-3-preview', Graph.makeArrayDataScatterWithRegressionLine('.revenue-room-rentals', '.noi-yield', flagTwo, '賃料水準/月/坪（円）', 'NOI利回り（%）'), 'NOI利回り ⇔ 賃料水準/月/坪', 290, false, true);
        Graph.scatterWithRegressionLine('container-4-preview', Graph.makeArrayDataScatterWithRegressionLine('.noi-yield', '.inheritance-tax-valuation', flagThree, '査定額（万円）', '相続税評価額（万円）'), '相続税評価額 ⇔ 査定額', 290);
        Graph.scatterWithRegressionLine('container-5-preview', Graph.makeArrayDataScatterWithRegressionLine('.synthetic-point', '.assessed-amount-debt-balance', flagFour, 'スコア（points）', '査定額－相続税評価額（万円）'), '査定額−相続税評価額 ⇔ スコア', 290);
        Graph.scatterWithRegressionLine('container-6-preview', Graph.makeArrayDataScatterWithRegressionLine('.total-revenue', '.total-cost', flagZero, '1㎡あたり賃貸事業収入（円）', '1㎡あたり賃貸事業費用（円）'), '1m²あたり賃貸事業費用 ⇔ 1m²あたり賃貸事業収入', 290);
        Graph.scatterWithRegressionLine('container-7-preview', Graph.makeArrayDataScatterWithRegressionLine('.revenue-room-rentals', '.maintenance-management-fee', flagZero, '賃料水準/月/坪（円）', '1㎡あたり維持管理費/月（円）'), '1m²あたり維持管理費/月 ⇔ 賃料水準/月/坪', 290);
        Graph.scatterWithRegressionLine('container-8-preview', Graph.makeArrayDataScatterWithRegressionLine('.revenue-room-rentals', '.repair-fee', flagZero, '賃料水準/月/坪（円）', '1㎡あたり修繕費（円）'), '1m²あたり修繕費 ⇔ 賃料水準/月/坪', 290);
        Graph.scatterWithRegressionLine('container-9-preview', Graph.makeArrayDataScatterWithRegressionLine('.maintenance-management-fee', '.repair-fee', flagZero, '1㎡あたり維持管理費/月（円）', '1㎡あたり修繕費（円）'), '1m²あたり修繕費 ⇔ 1m²あたり維持管理費/月', 290);
    };

    modules.scatterWithRegressionLine = function (renderTo, data, text, height, percentX, percentY) {
        let textX = data.length == flagZero ? '' : data[flagTwo],
        textY = data.length == flagZero ? '' : data[flagThree],
        visible = data.length == flagZero ? false :  true ;
        return  new Highcharts.Chart({
            chart: {
                renderTo: renderTo,
                height: height || 310,
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
            title: {
                text: text,
                style: {
                    fontSize: '16px',
                    fontWeight: 'bold',
                    color: '#2C3348'
                }
            },
            tooltip: {
                formatter: function (point) {
                    return  '<div>'+'<span style="color:#2C3348; font-size: 8px">\u25CF</span> <b style="margin-right: 2px; ">'+ this.point.name +'</b>' +
                        '<br>'+ modules.setTextTooltipScatterChart(textX) +': <b>'+ (modules.setTextTooltipScatterChart(textX, UNIT) == PERCENT
                            ? Common.convertStringToNumber(this.x).toFixed(flagTwo) : Common.addCommas(this.x)) + ' ' + modules.setTextTooltipScatterChart(textX, UNIT) +'</b>'+
                        '<br>'+ modules.setTextTooltipScatterChart(textY) +': <b>'+ (modules.setTextTooltipScatterChart(textY, UNIT) == PERCENT
                            ? Common.convertStringToNumber(this.y).toFixed(flagTwo) : Common.addCommas(this.y)) + ' ' + modules.setTextTooltipScatterChart(textY, UNIT) +'</b>'+ '</div>';
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
                className: 'convert-data',
                allowDecimals: false,
                tickAmount: 4,
                title: {
                    text: textX,
                    style: {
                        color: '#2C3348',
                        fontWeight: 'bold',
                    },
                    y: 7,
                },
                visible: visible,
                labels: {
                    style: {
                        fontSize: '12px',
                        color: '#2C3348',
                    },
                    formatter: function () {
                        return (this.value >= 0 ? '<div>' : '<div style="color:red">') + (percentX ? Common.addCommas(this.value.toFixed(2)) + '</div>' : Common.addCommas(this.value));
                    },
                },
                marginTop: 50,
                tickWidth: 1,
                tickLength: 7,
            },
            yAxis: {
                allowDecimals: false,
                tickAmount: 6,
                min: text === '1m²あたり維持管理費/月 ⇔ 賃料水準/月/坪' ? flagZero : null,
                title: {
                    text: textY,
                    style: {
                        color: '#2C3348',
                        fontWeight: 'bold',
                    }
                },
                labels: {
                    style: {
                        fontSize: '12px',
                        color: '#2C3348',
                    },
                    formatter: function () {
                        return (this.value >= 0 ? '<div>' : '<div style="color:red">') + (percentY ? Common.addCommas(this.value.toFixed(2)) + '</div>' : Common.addCommas(this.value));
                    },
                },
            },
            series: [{
                type: 'line',
                name: 'Regression Line',
                data: data[flagZero],
                marker: {
                    enabled: false
                },
                states: {
                    hover: {
                        lineWidth: 0
                    }
                },
                enableMouseTracking: false
            }, {
                type: 'scatter',
                data: data[flagOne],
                marker: {
                    radius: 4
                }
            }],
            lang: modules.processingChartWithNoData()[flagZero],
            noData: modules.processingChartWithNoData()[flagOne]
        });
    };

    modules.makeArrayLegendPieChart = function(className) {
        let total = flagZero, totalAssessedAmount = flagZero, totalNoi = flagZero, totalMoneyReceive = flagZero;
        $(".pie-chart").each(function (index, element) {
            if (element.dataset.key != flagOne) {
                return;
            }
            switch (className) {
                case 'money-receive-house':
                    total += Common.convertStringToNumber($(element).find("td." + className + "").text());
                    break;
                case 'noi-yield':
                    totalAssessedAmount += Common.convertStringToNumber($(element).find("input[name='assessed_amount']").val());
                    totalNoi += Common.convertStringToNumber($(element).find("input[name='noi']").val());
                    break;
                case 'acquisition-price-yield':
                    totalNoi += Common.convertStringToNumber($(element).find("input[name='noi']").val());
                    totalMoneyReceive += Common.convertStringToNumber($(element).find(".money-receive-house").text());
                    break;
                default:
                    total += Common.convertStringToNumber($(element).find("." + className + "").val());
                    break;
            }
        });

        if (className === 'noi-yield') {
            return totalNoi === 0 ? 0 : (totalNoi / totalAssessedAmount) * 100;
        } else if (className === 'acquisition-price-yield') {
            return totalNoi === 0 ? 0 : (totalNoi / totalMoneyReceive) * 100;
        } else {
            return total;
        }
    };

    modules.setValueLegendPieChart = function(arr) {
        let check = flagZero;
        $(arr).each(function (index, value) {
            if(value == flagZero) {
                return;
            }
            check += flagOne;
        });
        if(check > flagZero) {
            $('p.legend-money').html('計' + Common.numberFormat(arr[flagZero], flagZero) + '円');
            $('p.legend-acquisition').html('取得価格利回り' + Common.numberFormat(arr[flagFour], flagTwo) + '%');
            $('p.legend-assessed-amount').html('計' + Common.numberFormat(arr[flagOne], flagZero) + '円');
            $('p.legend-noi-yield').html('NOI利回り' + Common.numberFormat(arr[flagFive], flagTwo) + '%');
            $('p.legend-debt-balance').html('計' + Common.numberFormat(arr[flagTwo], flagZero) + '円');
            $('p.legend-inheritance').html('計' + Common.numberFormat(arr[flagThree], flagZero) + '円');
        } else {
            $('p.legend-money').html('');
            $('p.legend-acquisition').html('');
            $('p.legend-assessed-amount').html('');
            $('p.legend-noi-yield').html('');
            $('p.legend-debt-balance').html('');
            $('p.legend-inheritance').html('');
        }
    }

    modules.checkAllOnOff = function () {
        $('input:checkbox[name="check-portfolio"]:checked').length != $('tr.porfolio-all').length
            ? $('.check-all').prop('checked', false) : $('.check-all').prop('checked', true);
    };

    modules.setAttributeCheckBox = function (objectOne, objectTwo) {
        objectOne.prop('checked') ? objectTwo.attr('data-key', flagOne) : objectTwo.attr('data-key', flagZero);
    };

    modules.showChart = function () {
        Graph.showPieChart();
        Graph.setValueLegendPieChart([Graph.makeArrayLegendPieChart('money-receive-house'), Graph.makeArrayLegendPieChart('assessed-amount'), Graph.makeArrayLegendPieChart('debt-balance'), Graph.makeArrayLegendPieChart('inheritance-tax-valuation'), Graph.makeArrayLegendPieChart('acquisition-price-yield'), Graph.makeArrayLegendPieChart('noi-yield')]);
        Graph.showColumnChart();
        Graph.showScatterWithRegressionLine();
    };

    return modules;

}(window.jQuery, window, document));


$(document).ready(function () {
    Graph.loadHighchartsByRecord();
    Graph.showChart();
    $('.check-all').on('change', function () {
        $('.check-portfolio').prop('checked', $(this).prop('checked'));
        Graph.setAttributeCheckBox($('.check-all'), $('.check-portfolio').closest('.pie-chart'));
        Graph.loadHighchartsByRecord();
        Graph.showChart();
    });

    $('.check-portfolio').on('change', function () {
        Graph.setAttributeCheckBox($(this), $(this).closest('.pie-chart'));
        Graph.checkAllOnOff();
        Graph.loadHighchartsByRecord();
        Graph.showChart();
    });

    $('.noi-yield, .correction-factor, .tax-valuation, .route_price').on('change', function () {
        Graph.showChart();
    });
});
