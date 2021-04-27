var steamCodeFunction = (function () {
    let modules = {};
    modules.clickBuySteamCode = function () {
        let isLogin = $('#user-id').val() == '';
        if (isLogin) {
            $('#login-form').modal('show');
        } else {
            modules.showFormBuySteamCode();
        }
    }

    modules.showFormBuySteamCode = function () {
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

    modules.buyItem = function () {
        let formData = new FormData();
        formData.append("_token", $('meta[name="csrf-token"]').attr('content'));
        formData.append("market_id", $('#market-id').val());
        let submitAjax = $.ajax({
            url: '/dota/user/buy-item',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
        })
        submitAjax.done(function (response) {
            if (response.save == true) {
                window.location.href = '/dota/user/list-item'
            } else {
                location.reload();
            }
        });
        submitAjax.fail(function (response) {
        })
    }

    return modules;
}(window.jQuery, window, document));

$(document).ready(function () {
    $('.buy-steam-code').on('click', function () {
        steamCodeFunction.clickBuySteamCode();
    });

    $('#button-login').on('click', function () {
        $(this).prop('disabled', true);
        steamCodeFunction.login();
    });
});
