let defaultData = [0,0,0,0,0,0];

var commonHighchart = (function () {
    let modules = {};

    modules.buildSpiderWebChart = function (idDiv, categories, series, title, legend, height) {
        if (document.getElementById(idDiv) == null) {
            return;
        }
        return Highcharts.chart(idDiv, {
            chart: {
                polar: true,
                type: 'line',
                backgroundColor: 'transparent',
                style: {
                    fontFamily: "Noto Sans CJK JP",
                    height: height || '',
                },
                events: {
                    load: function(event) {
                        event.target.reflow();
                    }
                }
            },
            accessibility: {
                description: ''
            },
            title: {
                text: title,
                style: {
                    fontWeight: 'bold',
                    color: '#2C3348',
                    fontSize: '16px'
                }
            },
            pane: {
                size: '85%'
            },
            legend: {
                margin: 50,
                enabled: legend,
                maxWidth: 50,
                itemMarginBottom: 10,
            },
            exporting: {
                enabled: false
            },
            credits: {
                enabled: false
            },
            xAxis: {
                categories: categories,
                tickmarkPlacement: 'on',
                lineWidth: 0,
                gridLineWidth: 0,
                labels: {
                    formatter: function () {
                        return '<span style="font-weight: bold; font-size: 15px; color: #2C3348">' + this.value + '</span>';
                    }
                },
            },
            yAxis: {
                gridLineInterpolation: 'polygon',
                gridLineColor: '#C9D4E9',
                gridLineWidth: 1,
                title: 0,
                lineWidth: 0,
                tickAmount: 6,
                min: 0,
                max: 100,
                labels: {
                    enabled: false
                }
            },
            tooltip: {
                shared: true,
                pointFormat: '<span style="color:{series.color}">{series.name}: <b>{point.y:,.0f}</b><br/>'
            },
            plotOptions: {
                series: {
                    lineWidth: 3,
                    marker: {
                        enabled: false,
                        states: {
                            hover: {
                                enabled: false
                            }
                        }
                    }
                }
            },
            series: series,
            responsive: {
                rules: [{
                    condition: {
                        maxWidth: 400
                    },
                    chartOptions: {
                        pane: {
                            size: '70%'
                        },
                        legend: {
                            margin: 20
                        },
                        xAxis: {
                            labels: {
                                formatter: function () {
                                    return '<span style="font-weight: bold; font-size: 10px; color: #2C3348; word-break: break-all">' + this.value + '</span>';
                                }
                            },
                        }
                    },
                },{
                    condition: {
                        maxWidth: 290
                    },
                    chartOptions: {
                        pane: {
                            size: '55%'
                        },
                    },
                }]
            }
        });
    };

    modules.buildScatterChart = function (idDiv, series, title, subTitle, titleX, titleY, height) {
        if (document.getElementById(idDiv) == null) {
            return;
        }
        return Highcharts.chart(idDiv, {
            chart: {
                zoomType: 'xy',
                backgroundColor: 'transparent',
                style: {
                    fontFamily: "Noto Sans CJK JP",
                    height: height || ''
                },
                events: {
                    load: function() {
                        let trendlines = this.series.filter(function (c) {
                            return c.options.isRegressionLine;
                        });
                        for (let i in trendlines) {
                            trendlines[i].update({
                                enableMouseTracking: false
                            });
                        }
                    }
                },
            },
            title: {
                text: title,
                style: {
                    fontWeight: 'bold',
                    color: '#2C3348',
                    fontSize: '16px'
                }
            },
            subtitle: {
                text: subTitle
            },
            exporting: {
                enabled: false
            },
            credits: {
                enabled: false
            },
            xAxis: {
                gridLineWidth: 1,
                title: {
                    enabled: true,
                    text: titleX,
                    style: {
                        fontWeight: 'bold',
                        color: '#2C3348',
                        fontSize: '13px'
                    }
                },
                labels: {
                    formatter: function() {
                        return Highcharts.numberFormat(this.value, 0);
                    }
                },
                plotLines: [{
                    color: '#ff0000',
                    value: 0,
                    width: 2,
                    events: {
                        mouseover: function (e) {
                            let series = this.axis.series[6],
                                chart = series.chart,
                                PointClass = series.pointClass,
                                tooltip = chart.tooltip,
                                point = (new PointClass()).init(
                                    series, ['', this.options.value]
                                ),
                                normalizedEvent = chart.pointer.normalize(e);
                            point.tooltipPos = [
                                normalizedEvent.chartX - chart.plotLeft,
                                normalizedEvent.chartY - chart.plotTop
                            ];

                            tooltip.refresh(point);
                        },
                        mouseout: function (e) {
                            this.axis.chart.tooltip.hide();
                        }
                    }
                }],
                startOnTick: true,
                endOnTick: true,
                tickLength: 0,
                showLastLabel: true,
                min: 0
            },
            yAxis: {
                // tickAmount: 10,
                tickInterval: 1,
                min: 0,
                max: 10,
                title: {
                    text: titleY,
                    style: {
                        fontWeight: 'bold',
                        color: '#2C3348',
                        fontSize: '13px'
                    }
                },
                labels: {
                    formatter: function() {
                        return Highcharts.numberFormat(this.value, 1) + '%';
                    }
                }
            },
            legend: {
                itemDistance: 20,
                itemStyle: {
                    fontSize: '10px'
                },
                backgroundColor: Highcharts.defaultOptions.chart.backgroundColor,
            },
            plotOptions: {
                scatter: {
                    marker: {
                        radius: 5,
                        states: {
                            hover: {
                                enabled: true,
                                lineColor: 'rgb(100,100,100)'
                            }
                        }
                    },
                    states: {
                        hover: {
                            marker: {
                                enabled: false
                            }
                        }
                    },
                    tooltip: {
                        headerFormat: '<b>{series.name}</b><br>',
                        pointFormat: '{point.x} 円/坪, {point.y} %'
                    }
                },
                line: {
                    events: {
                        legendItemClick: function () {
                            return false;
                        }
                    },
                    showInLegend: true,
                    tooltip: {
                        headerFormat: '<b>{series.name}</b><br>',
                        pointFormat: '{point.y} 円/坪'
                    }
                }
            },
            series: series
        });

    };

    modules.buildBoxPlotChart = function (idDiv, categories, series, title, subTitle, titleX, titleY, height) {
        if (document.getElementById(idDiv) == null) {
            return;
        }
        let min = title.includes('賃料水準') ? 0 : null;
        Highcharts.chart(idDiv, {
            chart: {
                type: 'boxplot',
                backgroundColor: 'transparent',
                style: {
                    fontFamily: "Noto Sans CJK JP",
                    height: height || '',
                },
            },
            title: {
                text: title,
                style: {
                    fontSize: '16px',
                    fontWeight: 'bold',
                    color: '#2C3348'
                }
            },
            legend: {
                enabled: false
            },
            tooltip: {
                fontFamily: 'Noto Sans CJK JP',
            },
            exporting: {
                enabled: false
            },
            credits: {
                enabled: false
            },
            xAxis: {
                categories: categories,
                title: {
                    text: titleX
                },
                showEmpty: false

            },
            yAxis: {
                min: min,
                title: {
                    text: titleY
                },
                showEmpty: false,
                labels: {
                    formatter: function() {
                        if (this.value >= 0) {
                            return '<div>' + Common.addCommas(this.value) + '</div>';

                        } else {
                            return '<div style="color: red">' + Common.addCommas(this.value) + '</div>';
                        }
                    },
                    style: {
                        color: '#595959',
                    }
                },
            },
            series: series,
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

    modules.buildChart = function (idDiv, title, data, categories, percent, height, heightResponsive) {
        if (document.getElementById(idDiv) == null) {
            return;
        }
        return Highcharts.chart(idDiv, {
            chart: {
                zoomType: 'xy',
                style: {
                    fontFamily: "Noto Sans CJK JP",
                },
                height: height || '',
            },
            title: {
                text: title,
                align: 'center',
                style: {
                    fontSize: '16px',
                    color: '#2C3348',
                    'font-weight': 'bold',
                },
            },
            xAxis: {
                categories: categories,
                crosshair: true,
            },
            yAxis: [{ // Primary yAxis
                tickAmount: 11,
                min: 0,
                max: 100,
                labels: {
                    style: {
                        color: '#2C3348',
                        fontSize: '10px'
                    }
                },
                title: {
                    text: '%',
                    align: 'high',
                    rotation: 0,
                    y: -15,
                    x: -15,
                    offset: 0,
                    style: {
                        color: '#595959',
                        fontSize: '10px'
                    }
                }
            }, { // Secondary yAxis
                tickAmount: 6,
                title: {
                    text: '円',
                    align: 'high',
                    rotation: 0,
                    y: -15,
                    offset: 0,
                    x: 15,
                    style: {
                        color: '#595959',
                        fontSize: '10px'
                    }
                },
                labels: {
                    style: {
                        color: '#595959',
                        fontSize: '10px'
                    },
                    formatter: function() {
                        if (this.value >= 0) {
                            return '<div>' + Common.addCommas(this.value) + '</div>';

                        } else {
                            return '<div style="color: red">' + Common.addCommas(this.value) + '</div>';
                        }
                    },
                },
                opposite: true
            }],
            responsive: {
                rules: [{
                    condition: {
                        maxWidth: 400
                    },
                    chartOptions: {
                        chart: {
                            height: heightResponsive || '',
                        },
                    },
                }],
            },
            tooltip: {
                pointFormatter: function() {
                    let point = this;
                    return point.series.name === '稼働率(左軸)' ? '<span style="color:' + point.color + '">\u25C6</span> '  + point.series.name + ': <b>'+ Common.convertStringToNumber(point.y).toFixed(percent) + ' %' + '</b><br/>'
                        : point.series.name === '運営収益(右軸)' ? '<span style="color:' + point.color + '">\u25CF</span> '  + point.series.name + ': <b>' +  Common.addCommas(point.y) + ' 円' + '</b><br/>'
                        : '<span style="color:' + point.color + '">\u25AC</span> '  + point.series.name + ': <b>' +  Common.addCommas(point.y) + ' 円' + '</b><br/>'
                },
                shared: true
            },
            legend: {
                useHTML: true,
                symbolHeight: 10,
                symbolWidth: 15,
                symbolRadius: 0,
                squareSymbol: false,
                itemStyle: {
                    color: '#595959',
                    fontSize: '10px',
                    'font-weight': 'normal',
                    'border-radius': 0,
                },
            },
            plotOptions: {
                series: {
                    stacking: 'normal',
                    marker: {
                        radius: 5,
                    }
                },
            },
            credits: {
                enabled: false
            },
            exporting: {
                enabled: false
            },
            series: [{
                name: '運営費用(右軸)',
                color: '#F8D026',
                type: 'column',
                yAxis: 1,
                data: data[0],
            },{
                name: 'NOI運営収支',
                type: 'column',
                color: '#02AC80',
                yAxis: 1,
                data: data[1],
            },{
                name: '運営収益(右軸)',
                type: 'spline',
                color: '#FF4A09',
                yAxis: 1,
                data: data[2],
            }, {
                name: '稼働率(左軸)',
                type: 'spline',
                color: '#2172CF',
                yAxis: 0,
                data: data[3],
                marker: {
                    fontSize: '20px'
                },
            }],
        });
    };

    return modules;
}(window.jQuery, window, document));

var commonHighcharts = (function() {
    let modules = {};

    modules.buildColumnChart = function(idContainer, title, categories, titleY1, titleY2, series, fontSize, coordinates, height) {
        if (fontSize == null) {
            fontSize = ['13px', '10px', '10px', '11px']
        }
        if (coordinates == null) {
            coordinates = [0, -20, 7, 18, 51]
        }
        if (document.getElementById(idContainer) == null) {
            return;
        }
        return Highcharts.chart(idContainer, {
            chart: {
                zoomType: 'xy',
                marginTop: coordinates[4],
                backgroundColor: 'transparent',
                style: {
                    fontFamily: "Noto Sans CJK JP",
                    height: height || '',
                },
                events: {
                    load: function(event) {
                        event.target.reflow();
                    }
                }
            },
            title: {
                text: title,
                y: coordinates[0],
                style: {
                    fontSize: fontSize[0],
                    color: '#595959',
                },
            },
            xAxis: [{
                categories: categories,
                labels: {
                    style: {
                        color: '#595959',
                        fontSize: fontSize[1]
                    }
                },
                crosshair: true
            }],
            yAxis: [{ // Primary yAxis
                tickAmount: 9,
                labels: {
                    formatter: function() {
                        if (this.value >= 0) {
                            return '<div>' + Common.addCommas(this.value) + '</div>';

                        } else {
                            return '<div style="color: red">' + Common.addCommas(this.value) + '</div>';
                        }
                    },
                    style: {
                        color: '#595959',
                        fontSize: fontSize[1]
                    }
                },
                title: {
                    text: titleY1,
                    align: 'high',
                    rotation: 0,
                    y: coordinates[1],
                    x: -11,
                    offset: 0,
                    style: {
                        color: '#595959',
                        fontSize: fontSize[2]
                    }
                }
            }, { // Secondary yAxis
                tickAmount: 9,
                title: {
                    text: titleY2,
                    align: 'high',
                    rotation: 0,
                    y: coordinates[1],
                    offset: 0,
                    x: 8,
                    style: {
                        color: '#595959',
                        fontSize: fontSize[2]
                    }
                },
                labels: {
                    formatter: function() {
                        if (this.value >= 0) {
                            return '<div>' + Common.addCommas(this.value) + '</div>';

                        } else {
                            return '<div style="color: red">' + Common.addCommas(this.value) + '</div>';
                        }
                    },
                    style: {
                        color: '#595959',
                        fontSize: fontSize[1]
                    },
                },
                opposite: true
            }],
            tooltip: {
                formatter: function () {
                    return this.points.reduce(function (s, point) {
                        return s + '<br/><span style="color:' + point.color + '">\u25CF</span><b> ' + point.series.name + ': ' + Common.addCommas(Math.round(point.y)) + ' 万円 </b>';
                    }, '<b>' + this.x + '</b>');
                },
                shared: true
            },
            legend: {
                useHTML: true,
                symbolHeight: coordinates[2],
                symbolWidth: coordinates[3],
                symbolRadius: 0,
                squareSymbol: false,
                itemStyle: {
                    color: '#595959',
                    fontSize: fontSize[3],
                    'font-weight': 'normal',
                    'border-radius': 0,
                },
            },
            plotOptions: {
                column: {
                    pointPadding: 0,
                    borderWidth: 0
                }
            },
            credits: {
                enabled: false
            },
            exporting: {
                enabled: false
            },
            series: series,
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

    modules.buildColumnChartPreview = function(idContainer, title, categories, titleY1, titleY2, series, fontSize, coordinates) {
        if (fontSize == null) {
            fontSize = ['13px', '10px', '10px', '11px']
        }
        if (coordinates == null) {
            coordinates = [0, -20, 7, 18, 51]
        }
        if (document.getElementById(idContainer) == null) {
            return;
        }
        return Highcharts.chart(idContainer, {
            chart: {
                zoomType: 'xy',
                marginTop: coordinates[4],
                backgroundColor: 'transparent',
                style: {
                    fontFamily: "Noto Sans CJK JP",
                    height: '258px',
                },
                events: {
                    load: function(event) {
                        event.target.reflow();
                    }
                }

            },
            title: {
                text: title,
                y: coordinates[0],
                style: {
                    fontSize: fontSize[0],
                    color: '#595959',
                },
            },
            xAxis: [{
                categories: categories,
                labels: {
                    style: {
                        color: '#595959',
                        fontSize: fontSize[1]
                    }
                },
                crosshair: true
            }],
            yAxis: [{ // Primary yAxis
                tickAmount: 9,
                labels: {
                    formatter: function() {
                        if (this.value >= 0) {
                            return '<div>' + Common.addCommas(this.value) + '</div>';

                        } else {
                            return '<div style="color: red">' + Common.addCommas(this.value) + '</div>';
                        }
                    },
                    style: {
                        color: '#595959',
                        fontSize: fontSize[1]
                    }
                },
                title: {
                    text: titleY1,
                    align: 'high',
                    rotation: 0,
                    y: coordinates[1],
                    x: -11,
                    offset: 0,
                    style: {
                        color: '#595959',
                        fontSize: fontSize[2]
                    }
                }
            }, { // Secondary yAxis
                tickAmount: 9,
                title: {
                    text: titleY2,
                    align: 'high',
                    rotation: 0,
                    y: coordinates[1],
                    offset: 0,
                    x: 8,
                    style: {
                        color: '#595959',
                        fontSize: fontSize[2]
                    }
                },
                labels: {
                    formatter: function() {
                        if (this.value >= 0) {
                            return '<div>' + Common.addCommas(this.value) + '</div>';

                        } else {
                            return '<div style="color: red">' + Common.addCommas(this.value) + '</div>';
                        }
                    },
                    style: {
                        color: '#595959',
                        fontSize: fontSize[1]
                    },
                },
                opposite: true
            }],
            tooltip: {
                formatter: function () {
                    return this.points.reduce(function (s, point) {
                        return s + '<br/><span style="color:' + point.color + '">\u25CF</span><b> ' + point.series.name + ': ' + Common.addCommas(Math.round(point.y)) + ' 万円 </b>';
                    }, '<b>' + this.x + '</b>');
                },
                shared: true
            },
            legend: {
                enabled:true,
                useHTML: true,
                symbolHeight: coordinates[2],
                symbolWidth: coordinates[3],
                symbolRadius: 0,
                squareSymbol: false,
                itemStyle: {
                    color: '#595959',
                    fontSize: fontSize[3],
                    'font-weight': 'normal',
                    'border-radius': 0,
                },
            },
            exporting: {
                chartOptions:{
                    legend:{
                        enabled:true
                    }
                }
            },
            plotOptions: {
                column: {
                    pointPadding: 0,
                    borderWidth: 0
                }
            },
            credits: {
                enabled: false
            },
            series: series,
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
    modules.setCategoriesColumnChart = function(dataYear, pass) {
        if (pass == null) {
            pass = 1;
        }
        let dataReturn = [];
        for (let i = 1; i <= dataYear; i += pass) {
            if (pass == 5 && i == 6) {
                i = 5;
            }
            dataReturn.push(i + '年');
            if (pass == 3 && i == 34) {
                dataReturn.push((i + 1) + '年');
            }
        }
        return dataReturn;
    };

    modules.calculateRepayment = function(loan, nper, rate, type, perCurrent) {
        /*       type = 1 for formulas have CUMPRINC
               type = 0: perCurrent = 0*/
        let dataReturn = [];
        if (type == 0) {
            for (let i = 1; i <= 35; i++) {
                dataReturn.push(Math.round(Number(modules.getRepaymentPPMT(rate, i, nper, loan, 0, 0))));
            }
        } else {
            for (let i = 1; i <= 35; i++) {
                dataReturn.push(Math.round(Number(modules.getRepaymentPPMT(rate, i, nper, loan, 1, perCurrent))));
            }
        }
        return dataReturn;
    };

    modules.calculateCF = function(operatingBalance, loan, nper, rate, perCurrent) {
        let dataCFReturn = [];
        for (let i = 1; i <= 35; i++) {
            if ((i + perCurrent) <= nper) {
                dataCFReturn.push(Number((modules.getRepaymentIPMT(rate, nper, loan, operatingBalance) / 10000).toFixed(1)));
            } else {
                dataCFReturn.push(Number((operatingBalance / 10000).toFixed(1)));
            }
        }

        return dataCFReturn;
    };

    modules.calculateGrandTotalCF = function(operatingBalance, loan, nper, rate, perCurrent) {
        let dataCFReturn = [];
        for (let i = 1; i <= 35; i++) {
            if ((i + perCurrent) <= nper) {
                dataCFReturn.push(Number((modules.getRepaymentIPMT(rate, nper, loan, operatingBalance) * i / 10000).toFixed(1)));
            } else {
                dataCFReturn.push(Number((operatingBalance / 10000 + parseFloat(dataCFReturn[i - 2])).toFixed(1)));
            }
        }
        return dataCFReturn;
    };

    modules.getRepaymentPPMT = function(rate, per, nper, pv, type, perCurrent) {
        var dataTotalRepayment = this.getTotalRepayment(rate, per, nper, pv, perCurrent);
        if (per >= nper) {
            return 0;
        }
        if (type == 0) {
            let ppmt = 0 - excelFormulas.PPMT(rate, per, nper, pv, 0, 0);
            return (pv / 10000 - ppmt / 10000 - dataTotalRepayment[per - 1]).toFixed(0);
        } else {
            //cumprinc
            let ppmt = 0 - excelFormulas.PPMT(rate, per + perCurrent, nper, pv, 0, 0);
            return (pv / 10000 - ppmt / 10000 - dataTotalRepayment[per - 1] + excelFormulas.CUMPRINC(rate, nper, pv, 1, perCurrent, 0) / 10000).toFixed(0);
        }
    };

    modules.getTotalRepayment = function(rate, per, nper, pv, perCurrent) {
        let dataTotalRepayment = [];
        dataTotalRepayment.push(0);
        for (let i = 1; i <= 35; i++) {
            dataTotalRepayment.push(dataTotalRepayment[i - 1] - excelFormulas.PPMT(rate, i + perCurrent, nper, pv, 0, 0) / 10000);
        }
        return dataTotalRepayment;
    };

    modules.getRepaymentIPMT = function(rate, nper, pv, operatingBalance) {
        return operatingBalance + excelFormulas.PMT(rate, nper, pv, 0, 0);
    };

    modules.setItemColumnChart = function(name, type, yAxis, color, data, unit) {
        return {
            name: name,
            type: type,
            yAxis: yAxis,
            color: color,
            data: data,
            marker: {
                enabled: false
            },
            tooltip: {
                valueSuffix: unit
            }
        }
    };


    modules.setItemBoxPlotChart = function(data, dataDote, dataLine, unit, dataAmount, type) {
        return [{
            name: '',
            data: data,
            tooltip: {
                headerFormat: '',
                pointFormatter: function () {
                    return '</span>' + this.category.substring(this.category.indexOf(">") + 1, this.category.lastIndexOf("</")) + '<br/>' +
                        '<b><span style="color:' +
                        this.series.color + '">\u25CF</span><b> 標本数:</b> ' + dataAmount[this.index] + '<br/>' +
                        '<b><span style="color:' +
                        this.series.color + '">\u25CF</span><b> 第 3 四分位値:</b> ' + (Common.addCommas(this.q3)) + ' ' + unit + '<br/>' +
                        '<span style="color:' +
                        this.series.color + '">\u25CF</span><b> 中央値:</b> ' + (Common.addCommas(this.median)) + ' ' + unit + '<br/>' +
                        '<span style="color:' +
                        this.series.color + '">\u25CF</span><b> 第 1 四分位値:</b> ' + (Common.addCommas(this.q1)) + ' ' + unit + '<br/>'
                }
            },
        }, {
            name: '平均値',
            color: Highcharts.getOptions().colors[0],
            type: 'scatter',
            data: dataDote,
            marker: {
                fillColor: 'white',
                lineWidth: 1,
                lineColor: Highcharts.getOptions().colors[0]
            },
            tooltip: {
                headerFormat: '',
                pointFormatter: function () {
                    return '</span>' + this.category.substring(this.category.indexOf(">") + 1, this.category.lastIndexOf("</")) + '<br/>' +
                        '<b><span style="color:' +
                        this.series.color + '">\u25CF</span><b> 標本数:</b> ' + dataAmount[this.index] + '<br/>' +
                        '<span style="color:' +
                        this.series.color + '">\u25CF</span> <b> ' +
                        this.series.name + '</b> : ' + (Common.addCommas(this.y)) + ' ' + unit + '<br/>'
                }
            }
        }, {
            name: '対象不動産',
            type: 'line',
            color: 'red',
            data: dataLine,
            marker: {
                enabled: false
            },
            tooltip: {
                headerFormat: '',
                pointFormatter: function () {
                    return type === 1 ? '<span style="color:' + this.series.color + '">\u25CF</span> <b> ' +
                        this.series.name + '</b> : ' + (Common.addCommas(this.y)) + ' ' + unit + '<br/>'
                        :
                        /** FB 17/6 no42対応より無視になる*/
                        /**
                        '</span>' + this.category.substring(this.category.indexOf(">") + 1, this.category.lastIndexOf("</")) + '<br/>' +
                        '<b><span style="color:' +
                        this.series.color + '">\u25CF</span><b> 標本数:</b> ' + dataAmount[this.index] + '<br/>' +
                        */
                        '<span style="color:' +
                        this.series.color + '">\u25CF</span> <b> ' +
                        this.series.name + '</b> : ' + (Common.addCommas(this.y)) + ' ' + unit + '<br/>'
                }
            }
        }];
    };

    modules.buildChartRentRoll = function (id, title, dataNoEmpty, titleDataNoEmpty, dataEmpty, titleDataEmpty, distance, color, fontSize) {
        if (document.getElementById(id) == null) {
            return;
        }
        return Highcharts.chart(id, {
            chart: {
                type: 'pie',
                options3d: {
                    enabled: true,
                },
                style: {
                    fontFamily: "Noto Sans CJK JP"
                },
                events: {
                    load: function(event) {
                        event.target.reflow();
                    }
                }
            },
            title: {
                text: title,
                align: 'center',
                verticalAlign: 'middle',
                y: 10
            },
            tooltip: {
                shared: true,
                headerFormat: '',
                pointFormat: '<span style="color:{series.color}"><b>{point.y} %</b><br/>'
            },
            plotOptions: {
                pie: {
                    size: 300,
                    innerSize: 190,
                    depth: 45,
                    dataLabels: {
                        enabled: true,
                        distance: distance,
                        connectorColor: 'white',
                        style: {
                            fontSize: fontSize,
                            fontWeight: 'regular',
                            color: color
                        }
                    },
                    showInLegend: true
                }
            },
            lang: {
                noData: "データが存在しません"
            },
            noData: {
                style: {
                    fontWeight: 'bold',
                    fontSize: '12px',
                    color: '#2C3348'
                }
            },
            series: [{
                type: 'pie',
                data: [{
                    y: dataNoEmpty,
                    name: titleDataNoEmpty,
                    color: "#0E7AFF"
                }, {
                    y: dataEmpty,
                    name: titleDataEmpty,
                    color: "#D03C42"
                }]
            }]
        });
    };

    modules.buildChartPortfolioAnalysis = function (id, title, dataNoEmpty, titleDataNoEmpty, dataEmpty, titleDataEmpty, distance, color, fontSize) {
        if (document.getElementById(id) == null) {
            return;
        }
        return Highcharts.chart(id, {
            chart: {
                type: 'pie',
                options3d: {
                    enabled: true,
                },
                style: {
                    fontFamily: "Noto Sans CJK JP"
                },
                events: {
                    load: function(event) {
                        event.target.reflow();
                    }
                },
                height: '200'
            },
            title: {
                text: title,
                align: 'center',
                verticalAlign: 'middle',
                y: 10
            },
            tooltip: {
                shared: true,
                headerFormat: '',
                pointFormat: '<span style="color:{series.color}"><b>{point.y} %</b><br/>'
            },
            plotOptions: {
                pie: {
                    size: 160,
                    innerSize: 120,
                    depth: 20,
                    dataLabels: {
                        enabled: true,
                        distance: distance,
                        connectorColor: 'white',
                        style: {
                            fontSize: fontSize,
                            fontWeight: 'regular',
                            color: color
                        }
                    },
                    showInLegend: true
                }
            },
            lang: {
                noData: "データが存在しません"
            },
            noData: {
                style: {
                    fontWeight: 'bold',
                    fontSize: '12px',
                    color: '#2C3348'
                }
            },
            series: [{
                type: 'pie',
                data: [{
                    y: dataNoEmpty,
                    name: titleDataNoEmpty,
                    color: "#0E7AFF"
                }, {
                    y: dataEmpty,
                    name: titleDataEmpty,
                    color: "#D03C42"
                }]
            }]
        });
    };

    return modules;
}(window.jQuery, window, document));
