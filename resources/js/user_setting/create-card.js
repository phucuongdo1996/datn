const API_PAY_JP_PUBLIC_KEY = $('#public-key').val();
let numberElement;
let payJp;

let createCard = (function () {
    let modules = {};

    modules.createInput = function () {
        payJp = Payjp(API_PAY_JP_PUBLIC_KEY);
        let elements4 = payJp.elements();
        numberElement = elements4.create('cardNumber');
        let expiryElement = elements4.create('cardExpiry');
        let cvcElement = elements4.create('cardCvc');
        numberElement.mount('#number-form');
        expiryElement.mount('#expiry-form');
        cvcElement.mount('#cvc-form');
    };

    modules.checkOut = function () {
        payJp.createToken(numberElement, {
            card: {
                name: $('input[name=card_name]').val().toUpperCase()
            }
        }).then(function(response) {
            if (response.error) {
                // $('p[data-error=' + response.error.code + ']').html(response.error.message);
                $('p[data-error=check_card]').html('このクレジットカードはご利用いただけません');
                $('.' + response.error.code).addClass('input-error');
                $('#create-card').html('登録');
                $('#create-card').attr("disabled", false);
            } else {
                modules.sendDataCard(response.id);
            }
        })
    };

    modules.sendDataCard = function (pay_token) {
        let formdata = new FormData();
        formdata.append("_token", $('meta[name="csrf-token"]').attr('content'));
        formdata.append("pay_token", pay_token);
        let submitAjax = $.ajax({
            type: "POST",
            url: '/settings/card',
            data: formdata,
            processData: false,
            contentType: false,
        });

        submitAjax.done(function (response) {
            if (response && response.save == true) {
                window.location.href = '/settings';
            } else {
                window.location.reload(true);
            }
        });

        submitAjax.fail(function (response) {
            window.location.reload(true);
        });
    };

    modules.removeError = function () {
        $('.error-message').html('');
        $('.payjs-outer').removeClass('input-error');
    };

    return modules;
}(window.jQuery, window, document));

$(document).ready(function () {
    createCard.createInput();
    $('#create-card').on('click', function () {
        $("#create-card").html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>少々お待ちください...');
        $('#create-card').attr("disabled", true);
        createCard.removeError();
        createCard.checkOut();
    });

    $('input[name=card_name]').on('keypress', function (event) {
        let value = String.fromCharCode(event.which);
        let pattern = new RegExp(/[a-zåäö ]/i);
        return pattern.test(value);
    });
});
