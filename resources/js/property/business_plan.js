var flagZero = 0;
var flagOne = 1;
var flagTwo = 2;
let $creatorName = $('.material-creator-name');
let defaultVal1 = $('#note-confirmation-procedure').val();
let defaultVal2 = $('#addendum').val();

var businessPlan = (function ($) {

    var modules = {};

    modules.getValueBankName = function (className) {
        let listBank = require('zengin-code');
        let subStr = $('.'+className).val().split(' ');
        let codeBank = subStr[flagZero], codeBranch = subStr[flagOne];

        if (typeof listBank[codeBank] != 'undefined') {
            let bankName = listBank[codeBank].name;
            let bankBranchName = '', bankBranch = listBank[codeBank]['branches']
            $.each(bankBranch, function (key, value) {
                if (key == codeBranch) {
                    bankBranchName = '/' + value['name'];
                }
            });
            $('.destination-bank').val(bankName + bankBranchName);
        } else {
            $('.destination-bank').val('');
        }
    };

    modules.pmt = function () {
        let interest = Common.convertStringToNumber($('input[name="expected_interest"]').val()) / 100;
        let year = parseInt($('input[name="initial_borrowing_period"]').val());
        let loan = Common.convertStringToNumber($('input[name="expected_borrowing_amount"]').val());

        let pmt = 0 - excelFormulas.PMT(interest, year, loan, 0, 0);
        $('.principal_and_interest').val(Common.numberFormat(pmt.toFixed(0)));
        $('input[name="annual_repayment_of_principal_and_interest"]').val(Common.numberFormat(pmt.toFixed(0)) + ' 円');
    };

    modules.division = function (className1, className2, className3, input) {
        let value1 = Common.convertStringToNumber($('.'+className1).val());
        let value2 = Common.convertStringToNumber($('.'+className2).val());

        if (value1 == 0 || value2 == 0) {
            $('.'+className3).val(0);
            $(input).val('0.00 %');
        } else {
            $('.'+className3).val((value1 / value2 * 100 ).toFixed(flagTwo));
            $(input).val((value1 / value2 * 100 ).toFixed(flagTwo) + ' %');
        }
    };

    modules.showMessageValidate = function (messageList) {
        $('body').find('p.error-message').hide();
        $("body").find('input').removeClass('input-error');

        $.each(messageList, function (key, value) {
            $('p.error-message[data-error=' + key + ']').text(value).show();
            $('input[name=' + key + ']').addClass('input-error');

        });

        $('html, body').animate({
            scrollTop: (
                $(document).find('p.error-message[data-error=' + Object.keys(messageList)[0] + ']').offset().top - 300
            )
        }, 0);
    };

    modules.optionPaginate = function () {
        $('.business-plan-report').on('click', function () {
            return $('.option-paginate').val();
        });
    };

    modules.saveData = function (url, className) {
        let data = new FormData($('#form-data-business-plan')[0]);
        data.append("_token", $('meta[name="csrf-token"]').attr('content'));
        data.append("property_id", $('.property-id').val());
        Common.convertNumeralForForm(data);
        let submitAjax = $.ajax({
            type: "POST",
            url: url,
            data: data,
            processData: false,
            contentType: false,
        });

        submitAjax.done(function (response) {
            if(response) {
                if(response.save && response.redirect) {
                    window.location.href = '/' + response.redirect;
                } else {
                    window.location.reload();
                }
            }
        });

        submitAjax.fail(function (response) {
            let messageList = response.responseJSON.errors;
            modules.showMessageValidate(messageList);
            $('.'+className).attr("disabled", false);
        });
    };

    modules.setValuePintBusinessPlan = function () {
        $('#destination-bank-print').html($('#destination-bank').val() + `<span class="fw-bold fr">御中</span>`);
        $('#destination-address-print').text($('#destination-address').val());
        $('#destination-name-print').text($('#destination-name').val());
        $('#date-of-confirmation-print').text($('#date-of-confirmation').val());
        $('#note-confirmation-procedure-print').html($('#note-confirmation-procedure').val().replace(/(?:\r\n|\r|\n)/g, '<br />'));
        $('#addendum-print').html($('#addendum').val().replace(/(?:\r\n|\r|\n)/g, '<br />'));
        $('#expected-borrowing-date-print').text($('#expected-borrowing-date').val());
        $('#expected-borrowing-amount-print').text($('#expected-borrowing-amount').val());
        $('#initial-borrowing-period-print').text($('#initial-borrowing-period').val() + ' 年');
        $('#expected-interest-print').text($('#expected-interest').val() + ' %');
        $('#annual-repayment-of-principal-and-interest-print').text($('#annual-repayment-of-principal-and-interest').val());
        $('#noi-interest-print').text($('#noi_interest').val());
        $('#repayment-cover-rate-print').text($('#repayment-cover-rate').val());
    };

    modules.toggleBlockInfoCreator = function () {
        if ($creatorName.val()) {
            $('.info-creator').show();
            $('.blank-div').css('height', 0).hide();
            $('#note-confirmation-procedure').val(defaultVal1);
            $('#addendum').val(defaultVal2);
            $('.table-appraiser-name').removeClass('d-none');
            $('.previewed-correctly').removeClass('d-none');
            $('.estate-appraiser-name').text($('.material-creator-name').val());
        } else {
            $('.info-creator').hide();
            $('.blank-div').css('height', 250).show();
            $('#date-of-confirmation').val(null)
            $('#note-confirmation-procedure').val(null);
            $('#addendum').val(null);
            $('.table-appraiser-name').addClass('d-none');
            $('.previewed-correctly').addClass('d-none');
            $('.estate-appraiser-name').text('');

        }
    };

    return modules;

}(window.jQuery, window, document));


$(document).ready(function () {
    Common.optionDateTime();
    businessPlan.toggleBlockInfoCreator();
    if ($('#form-data-business-plan').find('input').hasClass('loan-bank-name')) {
        businessPlan.getValueBankName('loan-bank-name');
    }
    businessPlan.pmt();
    businessPlan.division('operating-expenses', 'principal_and_interest', 'repayment-rate', 'input[name="repayment_cover_rate"]');
    businessPlan.division('operating-expenses', 'expected-borrowing-amount', 'interest-noi', 'input[name="noi_interest"]');

    $('.expected-borrowing-amount, .initial-borrowing-period, .expected-interest').on('change', function () {
        if ($.isNumeric(Common.convertStringToNumber($(this).val())) == true) {
            businessPlan.pmt();
            businessPlan.division('operating-expenses', 'annual-repayment-of-principal-and-interest', 'repayment-rate', 'input[name="repayment_cover_rate"]');
        }
    });

    $('.expected-borrowing-amount').on('change', function () {
        if ($.isNumeric(Common.convertStringToNumber($(this).val())) == true) {
            businessPlan.division('operating-expenses', 'expected-borrowing-amount', 'interest-noi', 'input[name="noi_interest"]');
        }
    });

    $('.material-creator-name').on('change', function () {
        businessPlan.toggleBlockInfoCreator();
    });

    $('input[name="input_date"]').on('change', function () {
        $('.preview-input-date').text($('input[name="input_date"]').val());
    });

    $('.add-business-plan').on('click', function () {
        $('.add-business-plan').attr("disabled", true);
        businessPlan.saveData('/property/' + $('.property-id').val() + '/business-plan/store', 'add-business-plan');
    });

    $('.edit-business-plan').on('click', function () {
        $('.edit-business-plan').attr("disabled", true);
        businessPlan.saveData('/property/' + $('.property-id').val() + '/business-plan/update', 'edit-business-plan');
    });

    $('.business-plan-print'). on('click', function () {
        businessPlan.setValuePintBusinessPlan();

        setTimeout(function () {
            window.print();
        }, 500);
    });

    $('select[name=year]').on('change', function () {
        $('input[name=year]').val($(this).val());
        $('#form-condition-2').submit();
    });

    Common.showPrint($('#main-info-assessment'), $('.show-print'));
});
