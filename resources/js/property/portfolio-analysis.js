var total;
const AUTO_CORRECTION_FACTOR_YOUR_HOME = '1.0';

var Portfolio = (function () {
    let modules = {};

    modules.cleaveNumeral = function() {
        $("body").find('.convert-data, .convert-number-double-decimal, .convert-number-single-decimal').each(function (i, e) {
            new Cleave($(this), {
                numeral: true,
                numeralThousandsGroupStyle: 'thousand'

            });
        })
    };

    modules.Numeral =function() {
        $("body").find('.convert-data, .convert-number-double-decimal, .convert-number-single-decimal').each(function (i, e) {
            let price = $(this).val();
            price = price.split(",").join("");
            $(this).val(price);
        })
    };

    modules.stringConnection = function(str) {
        let string = '';
        let subStr = str.split(',');
        for (var i = 0; i < subStr.length; i++) {
            string += subStr[i];
        }
        return string;
    };

    modules.convertArrStringToArrNumber = function(arr) {
        let arrResult =[];
        for (let i=0; i<arr.length; i++) {
            arrResult.push(+arr[i]);
        }

        return arrResult;
    };

    modules.getValueTaxLandPrice = function(id, $this) {
        let reducerTaxLandPrice  = (accumulator, currentValue) => accumulator * currentValue;

        let totalAreaFloors = modules.stringConnection($('.ground-area[data-id='+id+']').text()),
            routePrice = modules.stringConnection($this.val());

        let arrTaxLandPrice = [totalAreaFloors, routePrice];
        let arrConvertTaxLandPrice = modules.convertArrStringToArrNumber(arrTaxLandPrice);

        total = arrConvertTaxLandPrice.reduce(reducerTaxLandPrice);
        $(':input[name="tax_land_price"][data-id='+id+']').val(total.toString());

        Portfolio.cleaveNumeral();

    };

    modules.saveData = function (id) {
        modules.Numeral();
        let data = new FormData($('.form-data-portfolio[data-id='+id+']')[0]);
        data.append('property_id', id);
        let submitAjax = $.ajax({
            type: "POST",
            url: '/property/portfolio-analysis/save-data',
            data: data,
            processData: false,
            contentType: false,
        });

        submitAjax.done(function (response) {
            if (response.save == true) {
                $('body').find('p.error-message[data-id='+id+']').hide();
                $("body").find('input[data-id='+id+']').removeClass('input-error');
            }
         });

        submitAjax.fail(function (response) {
            let messageList = response.responseJSON.errors;
            Portfolio.showMessageValidate(messageList, id);
        });
        Portfolio.cleaveNumeral();
    };

    modules.changeData = function (className) {
        $(className).each(function () {
            let id = $(this).closest('tr').attr('data-id');
            $(this).on('change',function() {
                Portfolio.saveData(id);
            });
        });
    };

    modules.showMessageValidate = function (messageList, id) {
        $('body').find('p.error-message[data-id='+id+']').hide();
        $("body").find('input[data-id='+id+']').removeClass('input-error');

        $.each(messageList, function (key, value) {
            $('p.error-message[data-error=' + key + '][data-id='+id+']').text(value).show();
            $('input[name=' + key + '][data-id='+id+']').addClass('input-error');

        });

        $('html, body').animate({
            scrollTop: (
                $(document).find('p.error-message[data-error=' + Object.keys(messageList)[0] + ']').offset().top - 300
            )
        }, 0);
    };

    modules.calculateTotalRaw = function(dtaNameChild, dtaNameParent, dtSetId, valueThis) {
        let value1 = 0;
        if ($('td[data-id=' + dtSetId + dtaNameChild + ']')[0].dataset.value != "") {
            value1 = parseFloat($('td[data-id=' + dtSetId + dtaNameChild + ']')[0].dataset.value)
        }
        let totalRaw =  value1 * parseFloat(Portfolio.convertNumber(valueThis));
        $('input[data-id=' + dtSetId + dtaNameParent +']').val(Common.excelRound(totalRaw, 5 - totalRaw.toString().length));
    };

    modules.calculateTotalRaw2 = function(dtaNameParent, dtSetId, valueThis) {
        let value1 = 0;
        value1 = parseFloat(Portfolio.convertNumber($(':input[name="estimate_inheritance_tax_valuation"][data-id='+dtSetId+']').val()));
        let totalRaw =  Portfolio.numberFormat(Math.round(value1 + valueThis));
        $('input[data-id=' + dtSetId + dtaNameParent +']').val(totalRaw);
    };

    modules.calculateRowDebtBalance = function(dtSetId, param1, param2) {
        let value1 = parseFloat(Portfolio.convertNumber($('input[data-id='+dtSetId+param1+']').val()));
        let value2 = parseFloat(Portfolio.convertNumber($('input[data-id='+dtSetId+param2+']').val()));
        let sumRow = Portfolio.numberFormat(Math.round(value1-value2))
        if(param1=='assessed_amount') {
            $('input[data-id=' + dtSetId + 'assessed_amount_debt_balance]').val(sumRow);
        } else {
            $('input[data-id=' + dtSetId + 'inheritance_tax_debt_balance]').val(sumRow);
        }
    };

    modules.calculateRowAssessedAmount = function(dtSetId, param1) {
        let value1 = parseFloat(Portfolio.convertNumber($('input[data-id='+dtSetId+param1+']').val()));
        let value2 = parseFloat(Portfolio.convertNumber($(':input[name="noi_yield"][data-id='+dtSetId+']').val()));
        let sumRow = 0;
        if (value1 != 0 && value2 !=0) {
            sumRow = Common.excelRound(Math.round(value1/(value2/100)), 5 - Math.round(value1/(value2/100)).toString().length);
        }
        $('input[data-id=' + dtSetId + 'assessed_amount]').val(sumRow);
    };

    modules.calculateRowAcquisitionPrice = function(dtSetId, param1, param2) {
        let value1 = parseFloat(Portfolio.convertNumber($('input[data-id='+dtSetId+param1+']').val()));
        let value2 = parseFloat(Portfolio.convertNumber($('td[data-id='+dtSetId+param2+']').text()));
        let sumRow = Portfolio.numberFormat((value1/value2)*100) || '0.00';
        $('input[data-id=' + dtSetId + 'acquisition_price_yield]').val(sumRow);
    };

    modules.calculateRowEstimate = function(dtSetId) {
        let optionOne = Math.round(Portfolio.convertNumber($('td[data-id=' + dtSetId + 'ground_area]').attr('data-value')) *
                                      Portfolio.convertNumber($('input[name="route_price"][data-id='+dtSetId+']').val()));
        let optionTwo = Math.round(Common.divisionNumber(Portfolio.convertNumber($('input[name="land_tax_assessment"][data-id='+dtSetId+']').val()),
                                                            FORMULAS_ES_INHERITANCE_TAX_VALUATION_PARAM_1) * FORMULAS_ES_INHERITANCE_TAX_VALUATION_PARAM_2);
        if (optionOne * optionTwo === 0) {
            let value = Common.excelRound(Math.abs(optionOne - optionTwo), 5 - Math.abs(optionOne - optionTwo).toString().length);
            $('input[name="estimate_inheritance_tax_valuation"][data-id='+dtSetId+']').val(value).parent().attr('data-value', value)
        } else {
            let value = optionOne <= optionTwo ? Common.excelRound(optionOne, 5 - optionOne.toString().length) : Common.excelRound(optionTwo, 5 - optionTwo.toString().length);
            $('input[name="estimate_inheritance_tax_valuation"][data-id='+dtSetId+']').val(value).parent().attr('data-value', value)
        }
    };

    modules.calculateRowFirst = function() {
        let parent, dtSetId, value1, value2;
        $('.form-data-portfolio ').each(function () {
            parent = 'tr[data-id='+$(this).attr('data-id')+']';
            dtSetId = $(this)[0].dataset.id;
            value1 = $(parent).find("input[name='route_price']").val();
            value2 = parseFloat(Portfolio.convertNumber($('.tax-valuation[data-id='+dtSetId+']').val())) * parseFloat(Portfolio.convertNumber($('.correction-factor[data-id='+dtSetId+']').val()));
            Portfolio.calculateTotalRaw('ground_area', 'tax_land_price', dtSetId, value1);
            Portfolio.calculateRowEstimate(dtSetId);
            Portfolio.calculateTotalRaw2( 'inheritance_tax_valuation', dtSetId, value2);
            Portfolio.calculateRowDebtBalance(dtSetId, 'inheritance_tax_valuation', 'debt_balance');
            Portfolio.calculateRowAssessedAmount(dtSetId, 'noi');
            Portfolio.calculateRowDebtBalance(dtSetId, 'assessed_amount', 'inheritance_tax_valuation');
            Portfolio.calculateRowAcquisitionPrice(dtSetId, 'noi', 'money-receive-house');

        });
    };

     modules.calculateSum = function(nameTotalRaw, idSum) {
        let sum = 0;
        $.each($('input[name=' + nameTotalRaw + ']'), function (key, value) {
            let id = $(this).attr('data-id');
            if (value.value != "") {
                sum += parseFloat(Portfolio.convertNumber(value.value));
                $('input[name=' + nameTotalRaw + '][data-id='+id+']').parent().attr('data-value', Portfolio.convertNumber(value.value));
            } else {
                $('input[name=' + nameTotalRaw + '][data-id='+id+']').parent().attr('data-value', 0);
            }
        });

        if (nameTotalRaw == 'noi_yield' || nameTotalRaw == 'acquisition_price_yield') {
            $('#' + idSum).text((Portfolio.numberFormat(sum) || 0) +' %');
        } else {
            $('#' + idSum).text(Portfolio.numberFormat(sum));
        }
        Portfolio.cleaveNumeral();
    };

    modules.convertNumber = function(number) {
        return number.split(',').join('');
    };

    modules.numberFormat = function(number, decimals, dec_point, thousands_point) {
        if (number == null || !isFinite(number)) {
            return "";
        }

        if (!decimals) {
            var len = number.toString().split('.').length;
            decimals = len > 1 ? len : 0;
        }

        if (!dec_point) {
            dec_point = '.';
        }

        if (!thousands_point) {
            thousands_point = ',';
        }

        number = parseFloat(number).toFixed(decimals);

        number = number.replace(".", dec_point);

        var splitNum = number.split(dec_point);
        splitNum[0] = splitNum[0].replace(/\B(?=(\d{3})+(?!\d))/g, thousands_point);
        number = splitNum.join(dec_point);

        return number;
    };

    modules.setDataPreview = function () {
        let showProprietor = $('#show-proprietor').val();
        $('.form-data-portfolio').each(function () {
            let parent = 'tr[data-id='+$(this).attr('data-id')+']';
            $('#table-data').append(
                '<tr class="content"><td class="column-first text-center borrowing-text-inline">'+($(parent).find('.number-house').text())+'</td>' +
                '<td class="text-center">'+($(parent).find('.house-name').text())+'</td>' +
                '<td class="text-center">'+($(parent).find('.status').text())+'</td>' +
                (showProprietor == true ? '<td class="text-center">'+($(parent).find('.proprietor').val())+'</td>' : '') +
                '<td>'+($(parent).find('.ground-area').text() ? $(parent).find('.ground-area').text()+' m²':'')+'</td>' +
                '<td>'+($(parent).find('.route-price').val() ? $(parent).find('.route-price').val()+' 円/m²':'')+'</td>' +
                '<td>'+($(parent).find('.tax-land-price').val() ? $(parent).find('.tax-land-price').val()+' 円':'')+'</td>' +
                '<td>'+($(parent).find('.land-tax-assessment').val() ? $(parent).find('.land-tax-assessment').val()+' 円':'')+'</td>' +
                '<td>'+($(parent).find("input[name='estimate_inheritance_tax_valuation']").val() ? $(parent).find("input[name='estimate_inheritance_tax_valuation']").val()+' 円':'')+'</td>' +
                '<td class="text-center">'+($(parent).find('.land-evaluation-note').val())+'</td>' +
                '<td>'+($(parent).find('.tax-valuation').val() ? $(parent).find('.tax-valuation').val()+' 円':'')+'</td>' +
                '<td class="text-center">'+($(parent).find('.building-selection').val())+'</td>' +
                '<td class="text-center">'+($(parent).find('.correction-factor').val())+'</td>' +
                '<td>'+($(parent).find('.inheritance-tax-valuation').val() ? $(parent).find('.inheritance-tax-valuation').val()+' 円':'')+'</td>' +
                '<td>'+($(parent).find('.debt-balance').val() ? $(parent).find('.debt-balance').val()+' 円':'')+'</td>' +
                '<td>'+($(parent).find('.inheritance-tax-debt-balance').val() ? $(parent).find('.inheritance-tax-debt-balance').val()+' 円':'')+'</td>' +
                '<td>'+($(parent).find('.noi').val() ? $(parent).find('.noi').val()+' 円':'')+'</td>' +
                '<td class="text-center">'+($(parent).find('.noi-yield').val() ? $(parent).find('.noi-yield').val()+' %':'')+'</td>' +
                '<td>'+($(parent).find('.assessed-amount').val() ? $(parent).find('.assessed-amount').val()+' 円':'')+'</td>' +
                '<td>'+($(parent).find('.assessed-amount-debt-balance').val() ? $(parent).find('.assessed-amount-debt-balance').val()+' 円':'')+'</td>' +
                '<td>'+($(parent).find('.money-receive-house').text() ? $(parent).find('.money-receive-house').text()+' 円':'')+'</td>' +
                '<td class="text-center">'+($(parent).find('.acquisition-price-yield').val() ? $(parent).find('.acquisition-price-yield').val()+' %':'')+'</td>' +
                '<td class="text-center">'+($(parent).find('.rental-percentage').text())+'</td>' +
                '<td class="text-center">'+($(parent).find('.synthetic-point').text())+'</td>' +
                '<td class="text-center">'+($(parent).find('.time-date').text())+'</td>' +
                '<td class="text-center">'+($(parent).find('.real-estate-type').text())+'</td>' +
                '<td class="text-center">'+($(parent).find('.pre-detail-real-estate-type').val())+'</td>' +
                '<td class="text-center">'+($(parent).find('.pre-address').val())+'</td></tr>'
            )
        });
        $('#table-data').append(
            '<tr class="content"><td class="text-center">計</td>' +
            '<td></td><td></td><td></td><td></td>' + (showProprietor == true ? '<td></td>' : '') +
            '<td>'+($('#sum-tax-land-price').text() ? ($('#sum-tax-land-price').text()+' 円'):'')+'</td>' +
            '<td></td>' +
            '<td>'+($('#sum-estimate-inheritance-tax-valuation').text() ? ($('#sum-estimate-inheritance-tax-valuation').text()+' 円'):'')+'</td>' +
            '<td></td>' +
            '<td>'+($('#sum-tax-valuation').text() ? ($('#sum-tax-valuation').text()+' 円'):'')+'</td>' +
            '<td></td><td></td>' +
            '<td>'+($('#inheritance-tax-valuation').text() ? ($('#inheritance-tax-valuation').text()+' 円'):'')+'</td>' +
            '<td>'+($('#sum-debt-balance').text() ? ($('#sum-debt-balance').text()+' 円'):'')+'</td>' +
            '<td>'+($('#sum-inheritance-tax-debt-balance').text() ? ($('#sum-inheritance-tax-debt-balance').text()+' 円'):'')+'</td>' +
            '<td>'+($('#sum-noi').text() ? ($('#sum-noi').text()+' 円'):'')+'</td>' +
            '<td class="text-center">'+$('#sum-noi-yield').text()+'</td>' +
            '<td>'+($('#sum-assessed-amount').text() ? ($('#sum-assessed-amount').text()+' 円'):'')+'</td>' +
            '<td>'+($('#sum-assessed-amount-debt-balance').text() ? ($('#sum-assessed-amount-debt-balance').text()+' 円'):'')+'</td>' +
            '<td>'+($('#sum-money-receive-house').text() ? ($('#sum-money-receive-house').text()+' 円'):'')+'</td>' +
            '<td class="text-center">'+$('#sum-acquisition-price-yield').text()+'</td>' +
            '<td class="text-center">'+$('#sum-rental-percentage').text()+'</td>' +
            '<td class="text-center">'+$('#comprehensive-balance-evaluation').text()+'</td>' +
            '<td></td><td></td><td></td><td></td></tr>'
        )
    };

    modules.getDetailRealEstateType = function() {
        $('.building-selection').each(function () {
            let estateTypeId = $(this).attr('data-real-estate');
            let parent = 'select[data-id='+$(this).attr('data-id')+']'
            for(let i = 1; i<=10; i++) {
                if(estateTypeId  !== String(i)) {
                    $(parent).find('.detail-read-estate-type-'+ i).remove();
                }
            }
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
            commonHighcharts.buildChartPortfolioAnalysis('chart-acreage', titleDataRent, dataRent, titleDataOne, Number(parseFloat(100 - dataRent).toFixed(2)), titleDataTwo, 10, 'black', '13px');
            let chartAcreagePre = commonHighcharts.buildChartPortfolioAnalysis('pre-chart-acreage', titleDataRent, dataRent, titleDataOne, Number(parseFloat(100 - dataRent).toFixed(2)), titleDataTwo, 10, 'black', '13px');
            chartAcreagePre.update({
                chart: {
                    width: 485
                }
            });

            let dataHouse = countData - countDataNoEmpty;
            let dataHousePercent = Number(parseFloat((countDataNoEmpty/countData) * 100).toFixed(2));
            commonHighcharts.buildChartPortfolioAnalysis('chart-room', titleDataHouse, dataHousePercent, (countDataNoEmpty == 0) ? '' : countDataNoEmpty,  Number(parseFloat(100 - dataHousePercent).toFixed(2)), (dataHouse == 0) ? '' : dataHouse, -10, 'white', '18px');
            let chartRoomPre = commonHighcharts.buildChartPortfolioAnalysis('pre-chart-room', titleDataHouse, dataHousePercent, (countDataNoEmpty == 0) ? '' : countDataNoEmpty,  Number(parseFloat(100 - dataHousePercent).toFixed(2)), (dataHouse == 0) ? '' : dataHouse, -10, 'white', '18px');
            chartRoomPre.update({
                chart: {
                    width: 485
                }
            });

            $('.legend-chart1').css({'display' : 'block',  'margin-bottom' : '40px'});
            $('.legend-chart2').css({'display' : 'block',  'margin-bottom' : '40px'});
            $('.highcharts-legend').css({'display' : 'none'});
            $('.highcharts-credits').css({'display' : 'none'});
        } else {
            $('#parent-chart-room').addClass('d-none');
            $('#parent-chart-acreage').addClass('d-none');
            $('#parent-chart-room-pre').addClass('d-none');
            $('#parent-chart-acreage-pre').addClass('d-none');
            $('.no-data-chart-room').show();
            $('.no-data-chart-acreage').show();
        }
    };

    return modules;
}(window.jQuery, window, document));

$(document).ready(function(){
    Portfolio.calculateRowFirst();
    Portfolio.calculateSum('tax_land_price', 'sum-tax-land-price');
    Portfolio.calculateSum('estimate_inheritance_tax_valuation', 'sum-estimate-inheritance-tax-valuation');
    Portfolio.calculateSum('tax_valuation', 'sum-tax-valuation');
    Portfolio.calculateSum('inheritance_tax_valuation', 'inheritance-tax-valuation');
    Portfolio.calculateSum('inheritance_tax_debt_balance', 'sum-inheritance-tax-debt-balance');
    Portfolio.calculateSum('assessed_amount', 'sum-assessed-amount');
    Portfolio.calculateSum('assessed_amount_debt_balance', 'sum-assessed-amount-debt-balance');
    Portfolio.loadChartsRentRoll();
    $('#sum-noi-yield').text((Common.divisionNumber(Common.convertStringToNumber($('#sum-noi').text()), Common.convertStringToNumber($('#sum-assessed-amount').text())) * 100).toFixed(2) + '%');
    Portfolio.cleaveNumeral();
    $('[data-toggle="tooltip"]').tooltip();
    $('.option-paginate-1').on('change', function () {
        $('#form-condition-1').submit();
    });
    $('.check-status').on('click', function () {
        $('#form-condition-1').submit();
    });

    $('.option-paginate-2').on('change', function () {
        $('#form-condition-2').submit();
    });

    $('.route-price, .tax-valuation, .correction-factor, .noi-yield').on('keyup', function () {
        if(!($(this)[0].value)) {
            $(this).val(0);
        }
    });

    $('.noi-yield').on('keyup', function () {
        if ($(this)[0].value == '') {
            $(this).val('0.00');
        }
    });

    $('.building-selection').on('change', function () {
        let dtSetId = $(this).attr('data-id');
        let valueThis = 0;
        if($(this).val() === '貸家' ) {
            valueThis = AUTO_CORRECTION_FACTOR * parseFloat(Portfolio.convertNumber($('.tax-valuation[data-id='+dtSetId+']').val()));
            $('input[name="correction_factor"][data-id='+dtSetId+']').val(AUTO_CORRECTION_FACTOR).parent().attr('data-value', AUTO_CORRECTION_FACTOR);
        } else if ($(this).val() === '自用家屋') {
            valueThis = AUTO_CORRECTION_FACTOR_YOUR_HOME * Common.convertStringToNumber($('.tax-valuation[data-id='+dtSetId+']').val());
            $('input[name="correction_factor"][data-id='+dtSetId+']').val(AUTO_CORRECTION_FACTOR_YOUR_HOME).parent().attr('data-value', AUTO_CORRECTION_FACTOR_YOUR_HOME);
        } else {
            $('input[name="correction_factor"][data-id='+dtSetId+']').val(0).parent().attr('data-value', 0);
        }
        Portfolio.calculateTotalRaw2('inheritance_tax_valuation', dtSetId, valueThis);
        Portfolio.calculateSum('inheritance_tax_valuation', 'inheritance-tax-valuation');
        Portfolio.calculateRowDebtBalance(dtSetId, 'inheritance_tax_valuation', 'debt_balance');
        Portfolio.calculateSum('inheritance_tax_debt_balance', 'sum-inheritance-tax-debt-balance');
        Portfolio.calculateRowDebtBalance(dtSetId, 'assessed_amount', 'inheritance_tax_valuation');
        Portfolio.calculateSum('assessed_amount_debt_balance', 'sum-assessed-amount-debt-balance');
        Portfolio.cleaveNumeral();
    });

    $('.route-price').on('keyup', function () {
        let dtSetId = $(this)[0].dataset.id;
        let valueThis = $(this)[0].value;
        let dataValue = Portfolio.convertNumber(valueThis) || 0;
        $(this).parent().attr('data-value', dataValue);
        Portfolio.calculateTotalRaw('ground_area', 'tax_land_price', dtSetId, valueThis);
        Portfolio.calculateSum('tax_land_price', 'sum-tax-land-price');
        Portfolio.calculateSum('assessed_amount_debt_balance', 'sum-assessed-amount-debt-balance');
        Portfolio.cleaveNumeral();
    });

    $('.route-price, .land-tax-assessment').on('keyup', function () {
        $(this).parent().attr('data-value', Portfolio.convertNumber($(this).val()) || 0);
        Portfolio.calculateRowEstimate($(this).attr('data-id'));
        Portfolio.calculateSum('estimate_inheritance_tax_valuation', 'sum-estimate-inheritance-tax-valuation');
    });

    $('.tax-valuation, .route-price, .land-tax-assessment').on('keyup change', function () {
        let dtSetId = $(this)[0].dataset.id;
        let valueThis = parseFloat(Portfolio.convertNumber($('.tax-valuation[data-id='+dtSetId+']').val())) * parseFloat(Portfolio.convertNumber($('.correction-factor[data-id='+dtSetId+']').val()));
        Portfolio.calculateTotalRaw2('inheritance_tax_valuation', dtSetId, valueThis);
        Portfolio.calculateSum('tax_valuation', 'sum-tax-valuation');
        Portfolio.calculateSum('inheritance_tax_valuation', 'inheritance-tax-valuation');
        Portfolio.calculateRowDebtBalance(dtSetId, 'inheritance_tax_valuation', 'debt_balance');
        Portfolio.calculateSum('inheritance_tax_debt_balance', 'sum-inheritance-tax-debt-balance');
        Portfolio.calculateRowDebtBalance(dtSetId, 'assessed_amount', 'inheritance_tax_valuation');
        Portfolio.calculateSum('assessed_amount_debt_balance', 'sum-assessed-amount-debt-balance');
        Portfolio.cleaveNumeral();
    });

    $('.correction-factor').on('keyup', function () {
        let dtSetId = $(this)[0].dataset.id;
        let value = $(this).val();
        let dataValue = Portfolio.convertNumber(value) || 0;
        let valueThis = parseFloat(Portfolio.convertNumber($('.correction-factor[data-id='+dtSetId+']').val())) * parseFloat(Portfolio.convertNumber($('.tax-valuation[data-id='+dtSetId+']').val()));
        $(this).parent().attr('data-value', dataValue);
        Portfolio.calculateTotalRaw2('inheritance_tax_valuation', dtSetId, valueThis);
        Portfolio.calculateSum('inheritance_tax_valuation', 'inheritance-tax-valuation');
        Portfolio.calculateRowDebtBalance(dtSetId, 'inheritance_tax_valuation', 'debt_balance');
        Portfolio.calculateSum('inheritance_tax_debt_balance', 'sum-inheritance-tax-debt-balance');
        Portfolio.calculateRowDebtBalance(dtSetId, 'assessed_amount', 'inheritance_tax_valuation');
        Portfolio.calculateSum('assessed_amount_debt_balance', 'sum-assessed-amount-debt-balance');
        Portfolio.cleaveNumeral();
    });

    $('.noi-yield').on('keyup', function () {
        let dtSetId = $(this)[0].dataset.id;
        Portfolio.calculateRowAssessedAmount(dtSetId, 'noi');
        Portfolio.calculateSum('assessed_amount', 'sum-assessed-amount');
        Portfolio.calculateRowDebtBalance(dtSetId, 'assessed_amount', 'inheritance_tax_valuation');
        Portfolio.calculateSum('assessed_amount_debt_balance', 'sum-assessed-amount-debt-balance');
        $('#sum-noi-yield').text((Common.divisionNumber(Common.convertStringToNumber($('#sum-noi').text()), Common.convertStringToNumber($('#sum-assessed-amount').text())) * 100).toFixed(2) + '%');
    });

    $('.route-price').each(function () {
        let $this = $(this);
        let id = $this.attr('data-id');
        $this.on('change',function() {
            Portfolio.saveData(id);
        });
    });

    $('#pre-print, #pre-print-2').on('click', function () {
        $('#pre-print-portfolio .content').remove();
        $('#container-preview').html('');
        Portfolio.setDataPreview();
        $("#circle-diagram").clone().appendTo("#container-preview");
        setTimeout(function () {
            window.print();
        }, 500)
    });

    $(document).on('click', '.centered-vertical .sort-icon', function () {
        let dataId = $(this).data('id');
        $('.centered-vertical .sort-icon').removeClass('sort-icon-first');
        Common.sortTable(dataId, '#table-property tr', '#table-property-preview-print tr', 2);
        $(this).addClass('sort-icon-first');
    });

    Portfolio.changeData('.land-evaluation-note');
    Portfolio.changeData('.tax-valuation');
    Portfolio.changeData('.building-selection');
    Portfolio.changeData('.correction-factor');
    Portfolio.changeData('.noi-yield');
    Portfolio.changeData('.land-tax-assessment');

});
