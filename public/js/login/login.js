let loginFunction = (function () {
    let modules = {};

    modules.clearMessageValidate = function () {
        $('p.error-message').text('');
        $('input.input-error').removeClass('input-error');
        $('.fail-login').hide();
    };

    modules.showMessageValidate = function (messageList) {
        modules.clearMessageValidate();
        $.each(messageList, function (key, value) {
            $('p.error-message[data-error=' + key + ']').text(value).show();
            $('input[name=' + key + ']').addClass('input-error');
        });
    };

    modules.login = function () {
        let formData = new FormData($('#form-login')[0]);
        let submitAjax = $.ajax({
            url: '/login',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
        });
        submitAjax.done(function (response) {
            if (response.login == true) {
                window.location.href = '/';
            } else {
                modules.clearMessageValidate();
                $('.fail-login').show();
                $('input').addClass('input-error');
                toastr.error('Đăng nhập thất bại', 'Lỗi!');
            }
        });
        submitAjax.fail(function (response) {
            $('#btn-login').prop('disabled', false);
            let messageList = response.responseJSON.errors;
            modules.showMessageValidate(messageList);
        })

    }
    return modules;
}(window.jQuery, window, document));

$(document).ready(function () {
    $('#btn-login').on('click', function () {
        // $(this).prop('disabled', true);
        loginFunction.login();
    })
});