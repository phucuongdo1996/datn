var steamCodeFunction = (function () {
    let modules = {};
    modules.clickBuySteamCode = function (object) {
        let isLogin = $('#user-id').val() == '';
        if (isLogin) {
            $('#login-form').modal('show');
        } else {
            modules.showFormBuySteamCode(object.data('type'), object.data('money'));
        }
    }

    modules.showFormBuySteamCode = function (type, money) {
        $('#steam-price').text(Common.numberFormat(money));
        let rest = $('#user-money').val() - money;
        if (rest >= 0) {
            $('#money-rest').css('color', 'green');
            $('#steam-price').css('color', 'green');
            $('.can-pay').show();
            $('.cant-pay').hide();
            $('#pay-submit').prop('disabled', true);
            $('#check-submit').prop('checked', false)
        } else {
            $('#money-rest').css('color', 'red');
            $('#steam-price').css('color', 'red');
            $('.can-pay').hide();
            $('.cant-pay').show();
            $('#pay-submit').prop('disabled', true);
        }
        $('#money-rest').text(Common.numberFormat(rest));
        $('input[name=steam_code_type]').val(type);
        $('input[name=steam_code_money]').val(money);
        $('#modal-buy-steam-code').modal('show')
    }

    modules.login = function () {
        let formData = new FormData($('#form-login')[0]);
        let submitAjax = $.ajax({
            url: '/login',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
        })
        submitAjax.done(function (response) {
            if (response.login == true) {
                location.reload();
            } else {
                $('.fail-login').show();
                toastr.error('Đăng nhập thất bại', 'Lỗi!');
                $('#button-login').prop('disabled', false)
            }
        });
        submitAjax.fail(function (response) {
            $('#button-login').prop('disabled', false)
            let messageList = response.responseJSON.errors;
            $('.fail-login').hide();
            Common.showMessageValidate(messageList);
        })
    }

    modules.buySteamCode = function () {
        let formData = new FormData($('#form-buy-item')[0]);
        formData.append("_token", $('meta[name="csrf-token"]').attr('content'));
        let submitAjax = $.ajax({
            url: '/dota/user/buy-steam-code',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
        })
        submitAjax.done(function (response) {
            location.reload();
        });
        submitAjax.fail(function (response) {
        })
    }

    modules.hideLoading = function (callback) {
        $('#modal-loading').modal('hide');
        callback();
    }

    return modules;
}(window.jQuery, window, document));

$(document).ready(function () {
    $('.buy-steam-code').on('click', function () {
        steamCodeFunction.clickBuySteamCode($(this));
    });

    $('#button-login').on('click', function () {
        $(this).prop('disabled', true);
        steamCodeFunction.login();
    });

    $('#check-submit').on('click', function () {
        $('#pay-submit').prop('disabled', !$(this).prop('checked'))
    });

    $('#pay-submit').on('click', async function () {
        $(this).prop('disabled', true)
        $('#modal-buy-steam-code').modal('hide');
        $('#modal-loading').modal('show');
        steamCodeFunction.buySteamCode();
    })
});
