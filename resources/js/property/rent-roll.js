var rentRoll = (function () {
    let modules = {};

    modules.calculateMoney = function () {
        let monthlyRent = Common.convertStringToNumber($('.monthly-rent').val());
        let depositMonthly = Common.divisionNumber(Common.convertStringToNumber($('.deposit').val()), monthlyRent).toFixed(1);
        let keyMoneyMonthly = Common.divisionNumber(Common.convertStringToNumber($('.key-money').val()), monthlyRent).toFixed(1);
        $("input[name='deposit_monthly']").val(depositMonthly);
        $("input[name='key_money_monthly']").val(keyMoneyMonthly);
        Common.cleaveNumeral();
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

    modules.saveData = function (isEdit) {
        let date = $("input[name='contract_start_date']").val(),
            url = '/property/'+$("input[name='property_id']").val()+'/rent-roll',
            data = new FormData($('#main-info-assessment')[0]);
        data.append("_token", $('meta[name="csrf-token"]').attr('content'));
        Common.convertNumeralForForm(data);
        let submitAjax = $.ajax({
            type: "POST",
            url: isEdit ? url+'/update/'+$("input[name='rent_roll_id']").val() : url+'/store',
            data: data,
            processData: false,
            contentType: false,
        });

        submitAjax.done(function (response) {
            if (response.updated == false) {
                window.location.reload();
            }
            if (response.save == false) {
                window.location.reload();
            } else {
                window.location.href = url+'?date_year='+ date.substring(0, date.indexOf("/")) +'&date_month='+ date.substring(date.indexOf("/") + 1, date.lastIndexOf("/"));
            }
        });

        submitAjax.fail(function (response) {
            let messageList = response.responseJSON.errors;
            modules.showMessageValidate(messageList);
            $('#add-rent-roll, #edit-rent-roll, #contract-renewal-rent-roll').attr("disabled", false);
        });
    };


    modules.loadChartsRentRoll = function () {
        let countData = parseInt($('#count-data').val());
        let countDataNoEmpty = parseInt($('#count-data-no-empty').val());
        let sumContractArea = $('#sum-contract-area').val();
        let sumContractAreaNoEmpty = $('#sum-contract-area-no-empty').val();
        let dataRent = 0;

        if (countData && countData > 0) {
            if (sumContractArea && sumContractArea > 0) {
                dataRent = Number(parseFloat((sumContractAreaNoEmpty / sumContractArea) * 100).toFixed(2));

            }
            let titleDataHouse = '<p class="fw-bold m5b fs12-sp">Tenanted</p><br>' + '<p class="fs14 fs10-sp">' + (countDataNoEmpty) + ' / ' + countData + '</p>';
            let titleDataRent = '<p class="fw-bold m5b fs12-sp">稼働率</p><br><p class="fs14 fs10-sp">' + dataRent + '%</p> <br>' + '<p class="fs12 fs8-sp">(' + Common.addCommas(Number(parseFloat(sumContractArea)).toFixed(2)) + ' m²)</p>';

            let titleDataOne = (sumContractAreaNoEmpty == 0) ? '' : Common.numberFormat(sumContractAreaNoEmpty, 2) + ' m²';
            let titleDataTwo= ((sumContractArea - sumContractAreaNoEmpty) == 0) ? '' : Common.numberFormat(sumContractArea - sumContractAreaNoEmpty, 2) + ' m²';
            commonHighcharts.buildChartRentRoll('chart-acreage', titleDataRent, dataRent, titleDataOne, Number(parseFloat(100 - dataRent).toFixed(2)), titleDataTwo, 10, 'black', '13px');
            let chartAcreagePre = commonHighcharts.buildChartRentRoll('pre-chart-acreage', titleDataRent, dataRent, titleDataOne, Number(parseFloat(100 - dataRent).toFixed(2)), titleDataTwo, 10, 'black', '13px');
            chartAcreagePre.update({
                chart: {
                    width: 665
                }
            });

            let dataHouse = countData - countDataNoEmpty;
            let dataHousePercent = Number(parseFloat((countDataNoEmpty/countData) * 100).toFixed(2));
            commonHighcharts.buildChartRentRoll('chart-room', titleDataHouse, dataHousePercent, (countDataNoEmpty == 0) ? '' : countDataNoEmpty,  Number(parseFloat(100 - dataHousePercent).toFixed(2)), (dataHouse == 0) ? '' : dataHouse, -25, 'white', '18px');
            let chartRoomPre = commonHighcharts.buildChartRentRoll('pre-chart-room', titleDataHouse, dataHousePercent, (countDataNoEmpty == 0) ? '' : countDataNoEmpty,  Number(parseFloat(100 - dataHousePercent).toFixed(2)), (dataHouse == 0) ? '' : dataHouse, -25, 'white', '18px');
            chartRoomPre.update({
                chart: {
                    width: 665
                }
            });

            $('.legend-chart1').css({'display' : 'block',  'margin-bottom' : '40px'});
            $('.legend-chart2').css({'display' : 'block',  'margin-bottom' : '40px'});
            $('.highcharts-legend').css({'display' : 'none'});
            $('.highcharts-credits').css({'display' : 'none'});
        } else {
            $('#parent-chart-room').css({'display' : 'none'});
            $('#parent-chart-acreage').css({'display' : 'none'});
            $('#parent-chart-room-pre').css({'display' : 'none'});
            $('#parent-chart-acreage-pre').css({'display' : 'none'});
        }
    };

    return modules;
}(window.jQuery, window, document));

$(document).ready(function () {
    $('.date-time-search').text($('.date-year-rent-roll').val() + '年' + $('.date-month-rent-roll').val() + '月期');
    rentRoll.calculateMoney();
    rentRoll.loadChartsRentRoll();

    $('.monthly-rent, .deposit, .key-money').on('change focusout', function () {
        rentRoll.calculateMoney();
    });
    $('#add-rent-roll, #contract-renewal-rent-roll').on('click', function () {
        $(this).attr("disabled", true);
        rentRoll.saveData();
    });

    $('#edit-rent-roll').on('click', function () {
        $('#edit-rent-roll').attr("disabled", true);
        rentRoll.saveData(true);
    });
    $('.date-month-rent-roll, .date-year-rent-roll').on('change', function () {
        $('.form-search-rent-roll').submit();
    });

    $(document).on('click', '.sort-table-rent-roll .sort-icon', function () {
        let dataId = $(this).data('id');
        $('.centered-vertical .sort-icon').removeClass('sort-icon-first');
        Common.sortTable(dataId, '.table-rent-roll tr', '.table-preview-rent-roll tr', 2);
        $(this).addClass('sort-icon-first');
    });

    $('.delete-rent-roll, .delete-rent-roll-room').on('click', function () {
        $('#confirm-rent-roll').modal('show');
        $('#form-delete-rent-roll').attr('action', window.location.origin + '/property/' + $('.property-id').val() + '/rent-roll/delete/' + $(this).data('id'));
    });

    $('.pre-print').on('click', function () {
        $('.date-time-search').text($('.date-year-rent-roll').val() + '年' + $('.date-month-rent-roll').val() + '月期');
        setTimeout(function () {
            window.print();
        }, 500);
    });

    Common.showPrint($('#main-info-assessment'), $('.show-print'));

    $(document).on('click', '.sort-table-rent-roll-room .sort-icon', function () {
        $('.centered-vertical .sort-icon').removeClass('sort-icon-first');
        Common.sortTable($(this).data('id'), '.table-rent-roll-room tr', '.table-rent-roll-room tr', 1);
        $(this).addClass('sort-icon-first');
    });
});
