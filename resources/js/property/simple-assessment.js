const STATUS_HOUSE_SIMPLE = ['', '保有中', '売却済', '検討段階', '検討中止'];
const FLAG_ZERO = 0;
const FLAG_ONE = 1;
const FLAG_TWO = 2;
const FLAG_FOUR = 4;
const FLAG_FIVE = 5;
const FLAG_SIX = 6;
const FLAG_TEN = 10;
const FLAG_ONE_HUNDRED = 100;
const ENTER_CODE = 13;
const operatingExpensesValue = Common.convertStringToNumber($('#operating-expenses').text());

let SimpleAssessment = (function () {
    let modules = {};

    modules.calculationNetProfitData = function (amountAssessedTaxingValue) {
        amountAssessedTaxingValue = Common.excelRound(amountAssessedTaxingValue, 5 - amountAssessedTaxingValue.toString().length)
        let netProfit = operatingExpensesValue / amountAssessedTaxingValue * 100;
        $('#net-profit').val(Common.numberFormat(netProfit.toFixed(FLAG_TWO)));
        $('#amount-assessed-taxing').val(Common.numberFormat(amountAssessedTaxingValue));
    };

    modules.calculationAmountAssessedTaxingData = function (netProfitValue) {
        let amountAssessedTaxingValue = Common.divisionNumber(operatingExpensesValue * 100, netProfitValue).toFixed(0);
        $('#amount-assessed-taxing').val(Common.numberFormat(Common.excelRound(amountAssessedTaxingValue, 5 - amountAssessedTaxingValue.toString().length)))
    };

    modules.setDataPreview = function () {
        $('.status-house-simple').text(STATUS_HOUSE_SIMPLE[$('.status').val()]);
        $('.pre-operating-expenses').val($('#operating-expenses').text());
        $('.pre-net-profit').val($('#net-profit').val());
        $('.pre-amount-assessed-taxing').val($('#amount-assessed-taxing').val());
    };

    return modules;
}(window.jQuery, window, document));

$(document).ready(function () {
    $('#amount-assessed-taxing').focusout(function () {
        SimpleAssessment.calculationNetProfitData(Common.convertStringToNumber($(this).val()));
        SimpleAssessment.setDataPreview();
    });

    $('#net-profit').focusout(function () {
        SimpleAssessment.calculationAmountAssessedTaxingData(Common.convertStringToNumber($(this).val()));
        SimpleAssessment.setDataPreview();
    });

    $('.btn-save-simple-assessment').on('click', function () {
        $('#form-condition-1').submit();
    });

    $('.status').on('change', function () {
        SimpleAssessment.setDataPreview();
    });

    $('.print-simple-assessment').on('click', function () {
        SimpleAssessment.setDataPreview();
        window.print();
    });

    $('#form-condition-1').on('keyup keypress', function(e) {
        let keyCode = e.keyCode || e.which;
        if (keyCode === ENTER_CODE) {
            e.preventDefault();
            return false;
        }
    });

    $('select[name=year]').on('change', function () {
        $('input[name=year]').val($(this).val());
        $('#form-condition-2').submit();
    });

    Common.showPrint($('#main-info-assessment'), $('.show-print'));
});
