const OPERATING_REVENUE = [
    '.revenue-land-taxes-', '.revenue-room-rentals-', '.revenue-service-charges-', '.revenue-utilities-', '.revenue-car-deposits-',
    '.turnover-revenue-', '.revenue-contract-update-fee-', '.revenue-other-', '.bad-debt-'
];
const OPERATING_FEE = [
    '.maintenance-management-fee-', '.electricity-gas-charges-', '.repair-fee-', '.recovery-costs-',
    '.property-management-fee-', '.find-tenant-fee-', '.tax-', '.loss-insurance-', '.land-rental-fee-', '.other-costs-'
];
const OPERATING_EXPENSES = [
    '.total-operating-revenue-', '.total-operating-costs-'
];

let flagZero = 0;
let flagOne = 1;
let flagTwo = 2;
let flagThree = 3;
let flagTwelve = 12;
let reducer;

var monthlyBalance = (function ($) {
    var modules = {};

    modules.sumTotal = function (arr, reducer, className) {
        let total;
        arr.reduce(reducer) === flagZero ? total = flagZero : total = arr.reduce(reducer);
        $(className).val(Common.numberFormat(total.toString()));
    };

    modules.getValueItem = function (className) {
        return Common.convertStringToNumber($(className).val());
    };

    modules.getValueOperatingItem = function (arrItem, key) {
        let arrOperatingItem = [];
        $.each(arrItem, function (index, item) {
            if (item === '.bad-debt-') {
                arrOperatingItem.push(monthlyBalance.getValueItem(item + key) * -1);
            } else {
                arrOperatingItem.push(monthlyBalance.getValueItem(item + key));
            }
        });
        return arrOperatingItem;
    };

    modules.getValueOperatingRevenue = function (reducer, key) {
        return modules.sumTotal(monthlyBalance.getValueOperatingItem(OPERATING_REVENUE, key), reducer, ".total-operating-revenue-" + key + "")
    };

    modules.getValueOperatingFee = function(reducer, key) {
        return modules.sumTotal(monthlyBalance.getValueOperatingItem(OPERATING_FEE, key), reducer, ".total-operating-costs-" + key + "");
    };

    modules.getValueOperatingExpenses = function (key) {
        let reducerOperatingExpenses = (accumulator, currentValue) => accumulator - currentValue;
        total = monthlyBalance.getValueOperatingItem(OPERATING_EXPENSES, key).reduce(reducerOperatingExpenses);
        $(".operating-expenses-" + key + "").val(Common.numberFormat(total.toString()));
    };

    modules.getData = function () {
        var arr = [];
        for(let i =flagOne; i<=flagTwelve; i++) {
            arr.push({
                property_id : $(".property-id").val(),
                date_year_registration : $('select[name=date_year_registration]').val(),
                date_month_registration : $(".date-month-registration-" + i + "").val(),
                revenue_land_taxes : Common.convertStringToNumber($(".revenue-land-taxes-" + i + "").val()),
                revenue_room_rentals : Common.convertStringToNumber($(".revenue-room-rentals-" + i + "").val()),
                revenue_service_charges : Common.convertStringToNumber($(".revenue-service-charges-" + i + "").val()),
                revenue_utilities : Common.convertStringToNumber($(".revenue-utilities-" + i + "").val()),
                revenue_car_deposits : Common.convertStringToNumber($(".revenue-car-deposits-" + i + "").val()),
                turnover_revenue : Common.convertStringToNumber($(".turnover-revenue-" + i + "").val()),
                revenue_contract_update_fee : Common.convertStringToNumber($(".revenue-contract-update-fee-" + i + "").val()),
                revenue_other : Common.convertStringToNumber($(".revenue-other-" + i + "").val()),
                bad_debt : Common.convertStringToNumber($(".bad-debt-" + i + "").val()),
                total_operating_revenue : Common.convertStringToNumber($(".total-operating-revenue-" + i + "").val()),
                maintenance_management_fee : Common.convertStringToNumber($(".maintenance-management-fee-" + i + "").val()),
                electricity_gas_charges : Common.convertStringToNumber($(".electricity-gas-charges-" + i + "").val()),
                repair_fee : Common.convertStringToNumber($(".repair-fee-" + i + "").val()),
                recovery_costs : Common.convertStringToNumber($(".recovery-costs-" + i + "").val()),
                property_management_fee : Common.convertStringToNumber($(".property-management-fee-" + i + "").val()),
                find_tenant_fee : Common.convertStringToNumber($(".find-tenant-fee-" + i + "").val()),
                tax : Common.convertStringToNumber($(".tax-" + i + "").val()),
                loss_insurance : Common.convertStringToNumber($(".loss-insurance-" + i + "").val()),
                land_rental_fee : Common.convertStringToNumber($(".land-rental-fee-" + i + "").val()),
                other_costs : Common.convertStringToNumber($(".other-costs-" + i + "").val()),
                total_operating_costs : Common.convertStringToNumber($(".total-operating-costs-" + i + "").val()),
                operating_expenses : Common.convertStringToNumber($(".operating-expenses-" + i + "").val()),
                rental_percentage : Common.convertStringToNumber($(".rental-percentage-" + i + "").val()),
            })
        }

        return arr;
    };
    modules.showMessageValidate = function (messageList) {
        $("body").find('input').removeClass('input-error');
        $("body").find('select').parent().removeClass('input-error');
        $('body').find('p.error-message').hide();
        $('.has-error-monthly-balance').css('display', 'none');
        $(".error-number-one-byte").attr("hidden",true);
        $(".error-number-and-dot-one-byte").attr("hidden",true);
        $(".error-limit").attr("hidden",true);
        $.each(messageList, function (key, value) {
            if (value[flagZero] == '半角数字のみでご入力ください。') {
                $('.has-error-monthly-balance').css('display', 'block');
                $(".error-number-one-byte").attr("hidden",false)
            }
            if (value[flagZero] == '半角数字とドットのみでご入力ください。') {
                $('.has-error-monthly-balance').css('display', 'block');
                $('.error-number-and-dot-one-byte').css('display', 'block');
                $(".error-number-and-dot-one-byte").attr("hidden",false)
            }
            if (value[flagZero] == '0.0〜100.0の範囲で入力してください。') {
                $('.has-error-monthly-balance').css('display', 'block');
                $('.error-limit').css('display', 'block');
                $(".error-limit").attr("hidden",false)
            }
            let i = key.substr(-(key.length - parseInt(key.lastIndexOf('.')) - flagOne)) + '_' + (parseInt(key.substring(key.indexOf('.') + flagOne,key.lastIndexOf('.'))) + flagOne);
            $('input[name=' + i+ ']').addClass('input-error');
            $('p.error-message[data-error=' + key.substr(-(key.length - parseInt(key.lastIndexOf('.')) - flagOne)) + ']').text(value).show().css('padding-top', '5px');
            $('select[name=' + key.substr(-(key.length - parseInt(key.lastIndexOf('.')) - flagOne)) + ']').parent().addClass('input-error');

        });
        $('html, body').animate({
            scrollTop: (
                $(document).find('.has-error-monthly-balance').offset().top - 300
            )
        }, 0);
    };

    modules.saveData = function (url, year) {
        let data = monthlyBalance.getData();
        let submitAjax = $.ajax({
            type: "POST",
            url: url,
            data: {
                data : data,
                property_id : $(".property-id").val(),
                _token : $('meta[name="csrf-token"]').attr('content'),
            },
        });

        submitAjax.done(function (response) {
            if (response.save == false) {
                window.location.reload();
            } else {
                window.location.href='/property/'+$(".property-id").val()+'/monthly-balance'+year;
            }
        });

        submitAjax.fail(function (response) {
            let messageList = response.responseJSON.errors;
            monthlyBalance.showMessageValidate(messageList);
            $('.btn-monthly-balance-add').attr("disabled", false);
            $('.btn-monthly-balance-edit').attr("disabled", false);
        });
    };

    modules.moveTableColumn = function (month) {
        var start;
        $('.table-monthly-balance').find('td:nth-child(2)').removeClass('border-left-0');
        $('.table-monthly-balance').find('td:last').removeClass('border-right-0');

        $('.table-monthly-balance .td-monthly-balance').each(function (index, element) {
            if(index != flagZero) {
                return;
            }
            start = $(element)[flagZero].classList[flagThree].replace('td-','');
        });

        $('.table-monthly-balance').each(function () {
            if(parseInt(start) <= parseInt(month)) {
                for (let i =parseInt(start) ; i<parseInt(month); i++){
                    $('.td-'+i+'',this).remove().insertAfter($('td:last',this));
                }
            } else {
                for (var i =parseInt(start) ; i>=parseInt(month); i--){
                    $('.td-'+i+'',this).remove().insertAfter($('td:first',this));
                }
            }
        });
        $('.table-monthly-balance').find('td:nth-child(2)').addClass('border-left-0');
        $('.table-monthly-balance').find('td:last').addClass('border-right-0');
    };

    modules.buildChart = function () {
        let submitAjax = $.ajax({
            type: "POST",
            url: '/property/{propertyId}/monthly-balance/graph',
            data: {
                _token : $('meta[name="csrf-token"]').attr('content'),
                property_id : $(".property-id-screen-list").val(),
                date_year : $('.date-year').val(),
                date_month : $(".date-month").val()
            }
        });
        submitAjax.done(function (response) {
            let  categories = response.data[4];
            commonHighchart.buildChart('container-chart-monthly', '年度推移', response.data, categories, flagOne, 700, 350);
            let chartPreview = commonHighchart.buildChart('pre-container-chart-monthly', '年度推移', response.data, categories, flagOne, 700, 350);
            chartPreview.update({
                chart: {
                    width: 1400
                }
            });
            Common.showPrint($('#main-info-assessment'), $('.show-print'));
        });
    };

    return modules;
}(window.jQuery, window, document));

$(document).ready(function () {
    reducer = (accumulator, currentValue) => accumulator + currentValue;
    $('.list-monthly-balance').find('td:last').addClass('border-right-0');
    $('#rental_percentage').val($('.rental-rate').val() + '%');
    $('#pre-rental-percentage').text($('.rental-rate').val() + '%');
    $('.pre-year').text($('.date-year').val() + '年');
    monthlyBalance.buildChart();

    $(document).on('focusout', "[class^=operating-revenue]", function(event){
        let key = $(this)[flagZero].classList[flagZero].replace('operating-revenue-', '');
        monthlyBalance.getValueOperatingRevenue(reducer, key);
        monthlyBalance.getValueOperatingExpenses(key);
    });

    $(document).on('focusout', "[class^=operating-fee]", function(event){
        let key = $(this)[flagZero].classList[flagZero].replace('operating-fee-', '');
        monthlyBalance.getValueOperatingFee(reducer, key);
        monthlyBalance.getValueOperatingExpenses(key);
    });

    $('.btn-monthly-balance-add').on('click', function () {
        $('.btn-monthly-balance-add').attr("disabled", true);
        monthlyBalance.saveData('/property/'+$(".property-id").val()+'/monthly-balance/store', '?date_year='+$('.date-year-registration').val());
    });

    $('.btn-monthly-balance-edit').on('click', function () {
        $('.btn-monthly-balance-edit').attr("disabled", true);
        monthlyBalance.saveData('/property/'+$(".property-id").val()+'/monthly-balance/update', '?date_year='+$('.date-year-registration').val());
    });

    $('.date-year').on('change', function () {
        $('.form-search-monthly-balance').submit();
    });

    $('.pre-print-monthly').on('click', function () {
        $('.pre-year').text($('.date-year').val() + '年');
        setTimeout(function () {
            window.print();
        }, 500);
    });

    if ($('#table-property').find('input').hasClass('error-flag')) {
        $('.error-monthly').attr('hidden', false);
    }
});
