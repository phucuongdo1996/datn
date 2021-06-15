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
