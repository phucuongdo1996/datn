const TOTAL_NUMBER_PREFECTURE = 47;
const FLAG_ONE = 1;
const OPERATING_REVENUE = [
    'revenue_land_taxes', 'revenue_room_rentals', 'revenue_general_services', 'revenue_utilities', 'revenue_parking',
    'income_input_money', 'income_update_house_contract', 'other_revenue', 'bad_debt'
];
const OPERATING_FEE = [
    'maintenance_management_fee', 'fee_utilities', 'repair_fee', 'fee_intact_reply',
    'fee_property_management', 'fee_recruitment_rental', 'tax', 'loss_insurance', 'land_tax', 'other_fees'
];
const OPERATING_EXPENSES = [
    'total_revenue', 'total_cost'
];

let total,
    reducer,
    pass = 1,
    dataSeries = [],
    pageCurrent = 1,
    start = 0,
    maxColumn = 0,
    OPTION_ZOOM = '拡大して表示',
    OPTION_SCROLL = 'スクロール表示',
    OPTION_PAGINATE = '分割して表示';

var Simulation = (function () {
    let modules = {};

    modules.sendDataSimulation = function () {
        let data = new FormData($('#form-simulation')[0]);
        data.append("_token", $('meta[name="csrf-token"]').attr('content'));
        data.append("address", $('.address').val());
        Common.convertNumeralForForm(data);
        $.ajax({
            url: '/simulation/store',
            type: 'POST',
            processData: false,
            contentType: false,
            data: data,
            success: function (response) {
                if (response && response.save == true) {
                    Simulation.resetErrorSimulation();
                    $('#modal-save-success').modal('show');
                    $("#modal-save-success").on("hidden.bs.modal", function () {
                        window.location.reload();
                    });
                } else {
                    alert('システムでの処理中にエラーが発生しました。\n' +
                        '時間を開けて再度お試しください。');
                    window.location.reload();
                }
            },
            error: function (error) {
                Simulation.resetErrorSimulation();
                Common.cleaveNumeral();
                if (error && error.status == 422) {
                    $('.has-error-simulation').css('display', 'block');
                    $('.double-btn-top').removeClass('col-sm-3');
                    $('.row-header').removeClass('p20r');
                    $('.double-btn-top').addClass('col-sm-4');
                    $('.has-error-simulation').addClass('centered-vertical');
                    if (error.responseJSON) {
                        jQuery.each(error.responseJSON.errors, function (key, val) {
                            $('.error_' + key).html(val);
                            $("[name = '" + key + "' ]").addClass('input-error');
                        });
                        $('html, body').animate({
                            scrollTop: (
                                $(document).find('.input-error').offset().top - 300
                            )
                        }, 0);
                    }
                }
                $('.btn-save').prop('disabled', false);
            }
        })
    };

    modules.resetErrorSimulation = function () {
        $('.input-simulation').removeClass('input-error');
        $('.has-error-simulation').css('display', 'none');
        $('.error-simulation').html('');
    };

    modules.resetAfterSuccessSimulation = function () {
        $('.input-simulation').val('');
        $('select[name=year]').val(20);
        $('.double-btn-top').removeClass('col-sm-4');
        $('.double-btn-top').addClass('p25');
        $('.double-btn-top').addClass('col-sm-3');
    };

    modules.sumTotal = function (arr, reducer, inputName) {
        if (arr.reduce(reducer) === 0) {
            total = 0;
        } else {
            total = arr.reduce(reducer);
        }
        $(inputName).val(Common.numberFormat(total.toString()));
    };

    modules.getValueOperatingRevenue = function (reducer) {
        return modules.sumTotal(Common.getValueOperatingItem(OPERATING_REVENUE), reducer, 'input[name="total_revenue"]')
    };

    modules.getValueOperatingFee = function(reducer) {
        return modules.sumTotal(Common.getValueOperatingItem(OPERATING_FEE), reducer, 'input[name="total_cost"]');
    };

    modules.getValueOperatingExpenses = function () {
        let reducerOperatingExpenses = (accumulator, currentValue) => accumulator - currentValue;
        total = Common.getValueOperatingItem(OPERATING_EXPENSES).reduce(reducerOperatingExpenses);
        $('#total_revenue_expenditure_operation').val(Common.numberFormat(total.toString()));
        $('#total_show').val(Common.numberFormat(total.toString()) + ' 円');
    };

    modules.setValueInputTotal = function () {
        Simulation.getValueOperatingExpenses();
        Simulation.setValueNOI();
    };

    modules.setHousePrice = function () {
        let value = Common.convertStringToNumber($("input[name='house_price']").val());
        $("input[name='personal_money_spent']").val(Common.numberFormat((value / 5).toFixed(0), 0));
        $("input[name='loan']").val(Common.numberFormat((value * 80/100).toFixed(0), 0));
        Simulation.setValueNOI();
    };

    modules.pmt = function () {
        let interest = Common.convertStringToNumber($('input[name="interest"]').val()) / 100;
        let year = parseInt($('select[name=year]').val());
        let loan = Common.convertStringToNumber($('#loan').val());
        if (!isNaN(interest) && !isNaN(year) && !isNaN(loan)) {
            let pmt = 0 - excelFormulas.PMT(interest, year, loan, 0, 0);
            $('input[name="loan_per_year"]').val(Common.numberFormat(pmt.toFixed(0)));
        } else {
            $('input[name="loan_per_year"]').val(0);
        }
    };

    modules.setValueNOI = function () {
        let net_income =  Common.divisionNumber(Common.convertStringToNumber($('input[name="operating_expenses"]').val()),
            Common.convertStringToNumber($('input[name="house_price"]').val())) * 100;
        $('input[name="net_income"]').val(Common.numberFormat(net_income,2) + ' %');
    };

    modules.appendData = function (id, className) {
        for(let i=FLAG_ONE; i<=TOTAL_NUMBER_PREFECTURE ; i++) {
            if(id  === i) {
                $('.' + className + '-' + i).each(function (index, element) {
                    $('.' + className).append( '<option class="simulation-'+ className +'" value="'+ $(element).val() +'">'+ $(element).data('name') +'</option>' );
                });
                break;
            }
        }
    };

    modules.getAddressZipCode = function (zipCode) {
        let postal_code = require('japan-postal-code');
        $('select[name=province]').val('');
        $('select[name=address]').val('');
        postal_code.get(zipCode, function (address) {
            $('select[name="province"]').val(address.prefecture);
            Simulation.appendData($('select[name=province]').find(':selected').data("id"), 'address');
            $('select[name="address"]').val(address.city);
        });
    };

    modules.setDataPreview = function () {
        let province;
        let data = $('#form-simulation').serializeArray();
        data.forEach(function (element) {
            switch (element.name) {
                case 'province':
                    province = element.value;
                    break;
                case 'address':
                    element.value = province + ' ' + element.value;
                    $('td[data-name = address]').text(element.value);
                    break;
                case 'uses':
                    element.value = USES[parseInt(element.value) - 1];
                    break;
                case 'ground_area':
                    // Not using toFixed() function
                    // ex: 1079.925.toFixed(2) = 1079.92, but exact result is 1079.93.
                    // $('td[data-name = unit_1]').text(Common.numberFormat((Common.convertStringToNumber(element.value) * 0.3025).toFixed(2)) + ' 坪');
                    let grounArea = Math.round((Common.convertStringToNumber(element.value) * 0.3025 + Number.EPSILON) * 100) / 100;
                    $('td[data-name = unit_1]').text(Common.numberFormat(grounArea) + ' 坪');
                    element.value = element.value + ' m²';
                    break;
                case 'total_area_floors':
                    // Not using toFixed() function
                    // ex: 1079.925.toFixed(2) = 1079.92, but exact result is 1079.93.
                    // $('td[data-name = unit_2]').text(Common.numberFormat((Common.convertStringToNumber(1) * 0.3025).toFixed(2)) + ' 坪');
                    let totalAreaFloors = Math.round((Common.convertStringToNumber(element.value) * 0.3025 + Number.EPSILON) * 100) / 100;
                    $('td[data-name = unit_2]').text(Common.numberFormat(totalAreaFloors) + ' 坪');
                    element.value = element.value + ' m²';
                    break;
                case 'house_price':
                case 'personal_money_spent':
                case 'loan':
                case 'loan_per_year':
                    element.value = element.value + ' 円';
                    break;
                case 'interest':
                    element.value = element.value + ' %';
                    break;
                case 'year':
                    element.value = element.value + ' 年';
                    break;
                case 'net_income':
                    element.value = element.value + '\xa0\xa0\xa0\xa0\xa0\xa0\xa0\xa0= 運営収支 ÷ 物件価格';
                    break;
                default:
                    break;
            }
            $('td[data-name=' + element.name + ']').text(element.value);
        });
    };

    modules.showMainSceen = function() {
        $('.container-simulation').show();
        $('#wrapper-master').css('padding-left', 270);
        $('#header').show();
        if (!highchartSimulation.mobileCheck()) {
            $('.main-sidebar-left').show();
        }
    };

    modules.hideMainSceen = function() {
        $('.container-simulation').hide();
        $('#header').hide();
        $('.main-sidebar-left').hide();
        $('#wrapper-master').css('padding-left', 0);
    };

    modules.moveItem = function (width) {
/*
        if (width >= 1200 && width <= 1600) {
            $('.item-3').insertAfter('.item-5');
            $('.item-4').insertAfter('.item-3');
            $('.item-chart').insertAfter('.block-2');
            $('.item-button').insertAfter('.item-chart');
        } else {
            $('.item-3').insertAfter('.item-2');
            $('.item-4').insertAfter('.item-3');
            $('.item-scatter').insertAfter('.item-score');
            $('.item-chart').insertAfter('.item-scatter');
            $('.item-button').insertAfter('.item-chart');
        }
*/
    };

    return modules;
}(window.jQuery, window, document));

var highchartSimulation = (function () {
    let modules = {};

    modules.buildSpiderWebChart = function (data) {
        var idDiv = 'simulation-spiderweb',
            categories = ['賃料水準', '運営費用', '損害保険料', '修繕費', '維持管理費', '運営収益'],
            series = [{
                name: 'center',
                data: defaultData,
                pointPlacement: 'on',
                color: '#707070',
                lineWidth: 2,
                tooltip: {
                    pointFormat: '',
                },
            },{
                name: '対象不動産',
                data: data,
                pointPlacement: 'on',
                color: '#0E7AFF'
            }];
        commonHighchart.buildSpiderWebChart(idDiv, categories, series,'', false);
        commonHighchart.buildSpiderWebChart('simulation-spiderweb-preview', categories, series,'', false);
    };

    modules.updateSpiderWebChart = function () {
        let buildChart = false;
        $('.operating-revenue, .operating-fee').each(function () {
            if (Common.convertStringToNumber($(this).val()) !== 0) {
                buildChart = true;
                return;
            }
        });
        if (!buildChart) {
            highchartSimulation.buildSpiderWebChart(null);
            $("input[name='synthetic_point']").val(0);
            $('#synthetic-point, .synthetic-point').text(0);
            return;
        }
        let formdata = new FormData($('#form-simulation')[0]);
        formdata.append("_token", $('meta[name="csrf-token"]').attr('content'));
        formdata.append('provincial', $('select[name=province]').val());
        formdata.append('district', $('select[name=address]').val());
        formdata.append('real_estate_type_id', $('#uses').val());
        Common.convertNumeralForForm(formdata);
        let submitAjax = $.ajax({
            type: "POST",
            url: '/property/highcharts/spiderweb/',
            data: formdata,
            processData: false,
            contentType: false,
        });
        submitAjax.done(function (response) {
            highchartSimulation.buildSpiderWebChart(response.dataSpiderWeb);
            $("input[name='synthetic_point']").val(response.scoreMap);
            $('#synthetic-point, .synthetic-point').text(Math.round(response.scoreMap));
        });
    };

    modules.buildColumnChart = function () {
        let loan = Common.convertStringToNumber($('input[name="loan"]').val()),
            nper = Common.convertStringToNumber($('select[name=year]').val()),
            rate = Common.convertStringToNumber($('input[name="interest"]').val()) / 100,
            operatingExpenses = Common.convertStringToNumber($('input[name="operating_expenses"]').val()),
            series = [],
            categories = commonHighcharts.setCategoriesColumnChart(35),
            fontSize = ['20px', '9px', '10px', '13px'],
            coordinates = [ 10, -20, 10, 27, 100];
        if (loan !== 0) {
            series.push(commonHighcharts.setItemColumnChart('ローン残高（右軸)', 'column', 1, '#4F81BD', commonHighcharts.calculateRepayment(loan, nper, rate, 0, 0), ''));
        }
        if (operatingExpenses !== 0) {
            series.push(commonHighcharts.setItemColumnChart('累計CF（右軸)', 'column', 1, '#EE72DC', commonHighcharts.calculateGrandTotalCF(operatingExpenses, loan, nper, rate, 0), ''));
            series.push(commonHighcharts.setItemColumnChart('CF（左軸)', 'line', 0, 'red', commonHighcharts.calculateCF(operatingExpenses, loan, nper, rate, 0), ''));
        }
        let title = this.showNote(series);
        dataSeries = series;

        commonHighcharts.buildColumnChart('chart-simulation-in-simulation', title, categories, '(万円)', '（万円)', series);
        commonHighcharts.buildColumnChart('zoom-chart-simulation', title, categories, '(万円)', '（万円)', series, fontSize, coordinates);
        commonHighcharts.buildColumnChart('chart-simulation-preview', '', categories, '(万円)', '（万円)', series, fontSize, coordinates);

		if(loan !== 0 || operatingExpenses !== 0){
			$("#myToast").toast({ delay: 2800, }).toast('show');	
		}

        return dataSeries;
    };

    modules.updateXaxisScroll = function(chart, maxColumn) {
        chart.update({
            scrollbar : { enabled : true },
        });
        chart.xAxis[0].update({
            min: 0,
            max: maxColumn,
        });
    };

    modules.updateXaxisPaginate = function(chart, maxColumn) {
        chart.xAxis[0].update({
            min: 0,
            max: maxColumn,
        });
        modules.displayPage(maxColumn);
    };

    modules.showNote = function (array) {
        if (array.length > 0) {
            $('.highcharts-note').show();
            return 'CF シミュレーショ ン';
        } else {
            return '';
            $('.highcharts-note').hide();
        }
    };

    modules.mobileCheck = function () {
        var check = false;
        (function (a) {
            if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|Windows Phone/i.test(navigator.userAgent.toLowerCase())) check = true;
        })(navigator.userAgent || navigator.vendor || window.opera);
        return check;
    };

    modules.displayPage = function (maxColumn) {
        let totalPage = Math.ceil(35 / pass / (maxColumn + 1));
        if ($('.highcharts-note').is(':visible')) {
            pageCurrent = 1;
            $('#pagination').removeAttr('hidden');
            if (pageCurrent == totalPage) {
                $(".btn-after").prop('disabled', true);
            } else {
                $(".btn-after").prop('disabled', false);
            }
        }
        $('.start-paginate').text(pageCurrent);
        $('.total-paginate').text(totalPage);
    };

    modules.renderColumnChart = function (option, paginate) {
        modules.buildColumnChart();
        let categories = commonHighcharts.setCategoriesColumnChart(35, paginate),
            dataReturn = dataSeries.splice(0);
        $.each(dataReturn, function (key, value) {
            let data = [];
            for (let i = 0; i< 35; i+= paginate) {
                if (paginate == 5 && i == 5) {
                    i = 4;
                }
                data.push(value.data[i]);
                if (paginate == 3 && i == 33) {
                    data.push(value.data[i+1]);
                }
            }
            value.data = data;
        });
        let title = this.showNote(dataReturn),
            chart = commonHighcharts.buildColumnChart('chart-simulation-in-simulation', title, categories, '(万円)', '（万円)', dataReturn),
            maxColumn = modules.maxColumn();
        if (option == OPTION_ZOOM) {
            $("#pagination").attr("hidden",true);
            Simulation.hideMainSceen();
            $('.zoom-chart').show();
        }
        if (option == OPTION_PAGINATE) {
            if (maxColumn !== 7) {
                modules.updateXaxisPaginate(chart, maxColumn);
            }
        }
        if (option == OPTION_SCROLL) {
            if (maxColumn !== 7) {
                modules.updateXaxisScroll(chart, maxColumn);
            }
        }
    };

    modules.maxColumn = function () {
        let maxColumn;
        if (modules.mobileCheck()) {
            maxColumn = 5;
        } else {
            if (pass != 5) {
                maxColumn = Math.ceil(20/pass) - 1;
            } else {
                maxColumn = 7;
            }
        }
        return maxColumn
    };

    modules.showColumnChart = function () {
        if ($('.highcharts-note').is(':visible')) {
            highchartSimulation.renderColumnChart($('.text-display-chart').text(), pass);
        }
    };

    modules.checkValueToZendChart = function (chart) {
        if (chart == 'column') {
            highchartSimulation.renderColumnChart($('.text-display-chart').text(), pass);
        }
        if (chart == 'spider') {
            highchartSimulation.updateSpiderWebChart();
        }
        if (chart == 'charts') {
            highchartSimulation.renderColumnChart($('.text-display-chart').text(), pass);
            highchartSimulation.updateSpiderWebChart();
        }
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
                let augment = (Number(listPoint[listPoint.length - 1][0]) - Number(listPoint[0][0])) / 100;
                let xValues = [];
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
            scatterChart = commonHighchart.buildScatterChart(idDiv, seriesScatter, "底地上アセットタイプ別 設定地代散布図", "", "月額地代単価（円/坪）", "年間地代（円/㎡）÷ 前面路線価（円/㎡）");
            modules.updateScatterChart();
        });
    };

    modules.updateScatterChart = function () {
        let x = Common.convertStringToNumber($('input[name=revenue_land_taxes]').val()),
            y = Common.convertStringToNumber($('input[name=ground_area]').val());
        let value = Common.divisionNumber(x, y) / 12 / 0.3025;
        scatterChart.xAxis[0].options.plotLines[0].value = Common.convertStringToNumber(value.toFixed(2));
        scatterChart.xAxis[0].update();
        if (scatterChart.series.length == 10) {
            scatterChart.series[scatterChart.series.length -1].remove();
        }
        scatterChart.addSeries({
            name: "scatter",
            type: 'scatter',
            data: [[value, scatterChart.yAxis[0].min]],
            showInLegend: false,
            enableMouseTracking: false,
            marker: {
                enabled: false
            }
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

    modules.plottingPoints = function(xValues, a, b, c) {
        let dataLin = [];
        $.each(xValues, function (key, value) {
            dataLin.push([value, (a * value * value) + (b * value) + c]);
        });
        return dataLin;
    };

    modules.showOrHideScatterChart = function (realEstateTypeId) {
        if (realEstateTypeId == 9 || realEstateTypeId == 10) {
            $("#scatter-chart").show();
            $('.item-scatter').addClass('m30b');
        } else {
            $("#scatter-chart").hide();
            $('.item-scatter').removeClass('m30b');
        }
    };

    return modules;
}(window.jQuery, window, document));

$(document).ready(function () {
    Simulation.setDataPreview();

    window.onresize = function(event) {
        let width = $(window).width();
        Simulation.moveItem(width);
    };

    let width = $(window).width();
    Simulation.moveItem(width);

    highchartSimulation.buildSpiderWebChart();
    highchartSimulation.buildColumnChart();
    highchartSimulation.buildScatterChart();
    highchartSimulation.showOrHideScatterChart();

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    maxColumn = highchartSimulation.maxColumn();

    reducer = (accumulator, currentValue) => accumulator + currentValue;

    $('#uses').on('change', function () {
        highchartSimulation.showOrHideScatterChart($(this).val());
        highchartSimulation.updateScatterChart();
        if ($(this).val() == 9 || $(this).val() == 10) {
            $('input[name=revenue_land_taxes]').prop('readonly', false);
        } else {
            $('input[name=revenue_land_taxes]').val(0);
            $('input[name=revenue_land_taxes]').prop('readonly', true);
        }
        Simulation.setDataPreview();
        Simulation.getValueOperatingRevenue(reducer);
        Simulation.setValueInputTotal();
        highchartSimulation.checkValueToZendChart('charts');
    });

    $('input.operating-revenue').on('focusin', function() {
        this.dataset.oldvalue = $(this).val();
    });

    $('input.operating-revenue').on('focusout', function() {
        if (this.dataset.oldvalue != $(this).val()) {
            Simulation.getValueOperatingRevenue(reducer);
            Simulation.setValueInputTotal();
            highchartSimulation.checkValueToZendChart('charts');
        }
    });

    $('input.operating-fee').on('focusin', function() {
        this.dataset.oldvalue = $(this).val();
    });

    $('input.operating-fee').on('focusout', function() {
        if (this.dataset.oldvalue != $(this).val()) {
            Simulation.getValueOperatingFee(reducer);
            Simulation.setValueInputTotal();
            highchartSimulation.checkValueToZendChart('charts');
        }
    });

    $('input[name="house_price"]').on('focusout', function() {
        Simulation.setHousePrice();
        Simulation.pmt();
        highchartSimulation.checkValueToZendChart('column');
    });

    $('input[name="personal_money_spent"]').on('focusout', function() {
        let value = Common.convertStringToNumber($("[name='house_price']").val());
        let personal_money_spent= Common.convertStringToNumber($(this).val());
        let loan = parseInt(value - personal_money_spent);
        if ($(this).val() == '') {
            $(this).val(0);
        }
        $("input[name='loan']").val(Common.numberFormat(loan.toString()));
        Simulation.pmt();
        highchartSimulation.checkValueToZendChart('column');
    });

    $('input[name="interest"]').on('focusout',function() {
        Simulation.pmt();
        highchartSimulation.checkValueToZendChart('column');
    });

    $('.btn-save').on('click', function (e) {
        $('.btn-save').prop('disabled', true);
        e.preventDefault();
        Simulation.sendDataSimulation();
    });

    $('.page-link-item').on('click', function () {
        $('.page-link-item.pagination-active').removeClass('pagination-active');
        $(this).addClass('pagination-active');
        pass = $(this).data('id');
        highchartSimulation.showColumnChart();
        maxColumn = highchartSimulation.maxColumn();
        start = 0;
        pageCurrent = 1;
        $(".btn-before").prop('disabled', true);
        if (pass == 5 && maxColumn != 5) {
            $("#pagination").attr("hidden",true);
        }
    });

    $('.btn-review').on('click', function () {
        $('html, body').animate({
            scrollTop: (
                $(document).find($('.chart-simulation')).offset().top - 300
            )
        }, 0);
    });

    $('input[name=zipcode]').on('change', function () {
        Simulation.getAddressZipCode($(this).val());
        setTimeout(function () {
            Simulation.setDataPreview();
            highchartSimulation.updateSpiderWebChart();
        }, 500);
    });
    $('.province').on('change', function () {
        $('.simulation-address').remove();
        $('select[name=address]').val('');
        Simulation.appendData($(this).find(':selected').data("id"), 'address');
    });

    $('.province, .address').on('change', function () {
        $('.zip-code').val(' ');
    });

    $('.btn-export, .btn-report').on('click', function () {
        if ($('#email-current-user').length) {
            Simulation.setDataPreview();
            setTimeout(function () {
                window.print();
            }, 500);
        } else {
            $('#alert-print').modal('show');
        }
    });

    window.addEventListener('beforeprint', function () {
        if (!$('#email-current-user').length) {
            $('#cant-preview-print').show();
            $('#page-1').hide();
            $('#page-2').hide();
            return false;
        }
    });

    $('.container-simulation input').not($("input[name='zipcode']")).on('focusout', function(){
        Simulation.setDataPreview();
    });

    $('.container-simulation select').on('change', function(){
        Simulation.setDataPreview();
    });

    $("input[name='total_area_floors'], input[name='address']").on('focusout', function () {
        highchartSimulation.checkValueToZendChart('spider');
    });

    $('.container-simulation select').not($("select[name='year']")).on('change', function () {
        highchartSimulation.updateSpiderWebChart();
    });

    $('select[name=year]').on('change',　function() {
        Simulation.pmt();
        highchartSimulation.renderColumnChart($('.text-display-chart').text(), pass);
    });

    $(".display-scroll .dropdown-menu a").on('click', function(){
        $(this).parents(".display-scroll").find('.text-display-chart').text($(this).text());
    });

    $('.btn-zoom-chart').on('click', function () {
        highchartSimulation.renderColumnChart($('.text-display-chart').text(), pass);
    });

    $('.btn-close-modal-zoom').on('click', function () {
        Simulation.showMainSceen();
        $('.zoom-chart').hide();
        $('.text-display-chart').text('スクロール表示');
        highchartSimulation.showColumnChart();
    });

    $('.btn-flow-over').on('click', function () {
        $("#pagination").attr("hidden",true);
        highchartSimulation.showColumnChart();
    });

    $('.btn-paginate').on('click', function () {
        highchartSimulation.showColumnChart();
    });

    $(".btn-before").on('click', function () {
        $(".btn-after").prop('disabled', false);
        let chart = $('#chart-simulation-in-simulation').highcharts();
        if (chart.xAxis[0].min > 0) {
            start -= maxColumn + 1;
            chart.xAxis[0].setExtremes(start, start + maxColumn);
            $('.start-paginate').text(--pageCurrent);
            if (start <= 0) {
                $(".btn-before").prop('disabled', true);
            }
        }
    });

    $(".btn-after").on('click', function () {
        $(".btn-before").prop('disabled', false);
        let chart = $('#chart-simulation-in-simulation').highcharts();
        if (chart.xAxis[0].max >= 34) {
            return;
        }
        start += maxColumn + 1;
        if (start + maxColumn >= Math.floor(34/pass)) {
            if (pass == 1 || pass == 2) {
                chart.xAxis[0].setExtremes(start, Math.floor(34/pass));
            } else {
                chart.xAxis[0].setExtremes(start, Math.ceil(34/pass));
            }
        } else {
            chart.xAxis[0].setExtremes(start, start + maxColumn);
        }
        $('.start-paginate').text(++pageCurrent);
        if (chart.xAxis[0].max >= Math.floor(34/pass)) {
            $(".btn-after").prop('disabled', true);
        }
    });

    $('input[name=revenue_land_taxes], input[name=ground_area]').on('focusout', function () {
        highchartSimulation.updateScatterChart();
    });
});
