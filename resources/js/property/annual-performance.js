let flagZero = 0;
let flagOne = 1;
let flagTwo = 2;

var annualPerformance = (function () {
    let modules = {};
    modules.calculateSumDifference = function () {
        let sumIncome = Common.convertStringToNumber($('input[name="sum_income"]').val());
        let sumFee = Common.convertStringToNumber($('input[name="sum_fee"]').val());
        let sumDiff = sumIncome - sumFee;
        let amountPaid = Common.convertStringToNumber($('input[name="amount_paid_annually"]').val());
        $('input[name="sum_difference"]').val(Common.numberFormat(sumDiff));
        $('input[name="dscr"]').val(Common.numberFormat(sumDiff / amountPaid * 100,2));
        $('input[name="dscr_output"]').val(Common.numberFormat(sumDiff / amountPaid * 100,2) + ' %');
    };

    modules.saveData = function () {
        let data = new FormData($('#form-annual-performance')[0]);
        data.append("_token", $('meta[name="csrf-token"]').attr('content'));
        Common.convertNumeralForForm(data);
        let submitAjax = $.ajax({
            type: "POST",
            url: window.location,
            data: data,
            processData: false,
            contentType: false,
        });

        submitAjax.done(function (response) {
            if (response.updated === false) {
                window.location.reload();
            }
            if (response.save && response.redirect) {
                window.location.href='/property/'+$("input[name='property_id']").val() + response.redirect;
            } else {
                window.location.reload(true);
            }
        });

        submitAjax.fail(function (response) {
            let messageList = response.responseJSON.errors;
            modules.showMessageValidate(messageList);
            $('#submit-annul-performance').prop('disabled', false);
        })
    };

    modules.showMessageValidate = function (messageList) {
        $('body').find('p.error-message').css('padding-top', 0).hide();
        $("body").find('input').removeClass('input-error');
        $("body").find('select').parent().removeClass('input-error');
        $.each(messageList, function (key, value) {
            $('p.error-message[data-error=' + key + ']').text(value).css('padding-top', 4).show();
            $('input[name=' + key + ']').addClass('input-error');
            $('select[name=' + key + ']').parent().addClass('input-error');
        });
        $('html, body').animate({
            scrollTop: (
                $(document).find('p.error-message[data-error=' + Object.keys(messageList)[0] + ']').offset().top - 300
            )
        }, 0);
    };

    modules.buildSpiderWebChart = function () {
        if (document.getElementById('form-data-annual-performance') == null) {
            return;
        }
        let idDiv = 'annual-per-spiderweb-chart',
            categories = ['賃料水準', '運営費用', '損害保険料', '修繕費',
                '維持管理費', '運営収益'];
        let data = new FormData($('#form-data-annual-performance')[0]);
        data.append("_token", $('meta[name="csrf-token"]').attr('content'));
        Common.convertNumeralForForm(data);
        let submitAjax = $.ajax({
            type: "POST",
            url: window.location.origin + '/property/' + $('input[name=property_id]').val() + '/annual-performance/spider-web-chart',
            data: data,
            processData: false,
            contentType: false,
        });

        submitAjax.done(function (response) {
            let dataseries = [];
            $.each(response.spiderWeb, function (key, value) {
                let item = {
                    name: response.year[key],
                    data: value,
                    pointPlacement: 'on',
                };
                dataseries.push(item);
            });
            commonHighchart.buildSpiderWebChart(idDiv, categories, dataseries, '', true);
            let chartPre = commonHighchart.buildSpiderWebChart('pre-annual-per-spiderweb-chart', categories, dataseries, '', true, '340px');
            chartPre.update({
                chart: {
                    width: 745
                },
                pane: {
                    size: '90%'
                },
            });
            modules.setInputPoints(response.scoreMap);
            modules.buildChartBelow();
        });

        submitAjax.fail(function () {
            modules.buildChartBelow();
        })
    };

    modules.setInputPoints = function (dataPoints) {
        $.each(dataPoints, function (key, value) {
            $('input[name=score_point_'+key+']').val(value + ' points');
            $('.pre-score-point-'+key).text(value + ' points');
        })
    };

    modules.buildChartBelow = function () {
        if (document.getElementById('form-data-annual-performance') == null) {
            return;
        }
        let data = new FormData($('#form-data-annual-performance')[0]);
        data.append("_token", $('meta[name="csrf-token"]').attr('content'));
        Common.convertNumeralForForm(data);
        let submitAjax = $.ajax({
            type: "POST",
            url: '/property/{propertyId}/annual-performance/graph-below',
            data: data,
            processData: false,
            contentType: false,
        });
        submitAjax.done(function (response) {
            let catagories = response.data[4].map(i => i + '年度');
            let chart = commonHighchart.buildChart('container-chart-annual', '年度推移', response.data, catagories, flagTwo);
            if (catagories.length > 3) {
                chart.update({
                    scrollbar : { enabled : true },
                });
                chart.xAxis[0].update({
                    min: 0,
                    max: 2,
                });
            }
            let chartPre = commonHighchart.buildChart('pre-container-chart-annual', '年度推移', response.data, catagories, flagTwo, '500px');
            chartPre.update({
                chart: {
                    width: 1450
                }
            });
            Common.showPrint($('#main-info-assessment'), $('.show-print'));
        });
    };

    modules.setCssPreview = function () {
        let totalRecords = Number($('.total-records').val());
        if (totalRecords < 9) {
            $('#pre-print-annual-performance .table-data tr:first-child td').css('width', 158);
        }
        if (totalRecords == 9) {
            $('#pre-print-annual-performance .table-data tr:first-child td').css('width', 141);
        }
        if (totalRecords == 10) {
            $('#pre-print-annual-performance .table-data tr:first-child td').css('width', 127);
        }
        if (totalRecords == 11) {
            $('#pre-print-annual-performance .table-data tr:first-child td').css('width', 115);
        }
    };

    modules.setValueCropYield = function () {
        if (Common.convertStringToNumber($('#area-may-rent').val()) === 0) {
            $('#crop-yield').val(0);
        } else {
            $('#crop-yield').val((Common.convertStringToNumber($('#area-rental-operating').val()) / Common.convertStringToNumber($('#area-may-rent').val()) * 100).toFixed(2));
        }
    };

    return modules;
}(window.jQuery, window, document));

$(document).ready(function () {
    annualPerformance.buildSpiderWebChart();
    annualPerformance.setCssPreview();

    $('.sum-income').on('change focusout', function () {
        let sum = 0;
        $.each($('.sum-income'), function (key, value) {
            sum += Common.convertStringToNumber($(value).val());
        });
        sum -= 2 * Common.convertStringToNumber($('input[name=bad_debt_losses]').val());
        $('input[name="sum_income"]').val(Common.numberFormat(sum));
        annualPerformance.calculateSumDifference();
    });

    $('.sum-fee').on('change focusout', function () {
        let sum = 0;
        $.each($('.sum-fee'), function (key, value) {
            sum += Common.convertStringToNumber($(value).val());
        });
        $('input[name="sum_fee"]').val(Common.numberFormat(sum));
        annualPerformance.calculateSumDifference();
    });

    $('#submit-annul-performance').on('click', function () {
        $('#submit-annul-performance').prop('disabled', true);
        annualPerformance.saveData();
    });

    $('.pre-print-annual').on('click', function () {
        annualPerformance.setCssPreview();
        setTimeout(function () {
            window.print();
        }, 500);
    });

    $('.destroy-annual-performance').on('click', function () {
        $(document).find('#annual-performance-id').val($(this).attr('data-id'));
        $(document).find('#old-data').val($(this).attr('data-value'));
    });

    $('#area-rental-operating, #area-may-rent').on('change', function () {
        annualPerformance.setValueCropYield();
    });
});
