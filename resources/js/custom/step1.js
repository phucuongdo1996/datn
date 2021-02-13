var $formRegister = $('#form-register');
var $buttonRegister = $('.btn-submit-register');
var $inputPassword = $('#password-register');
var $spanError = $('.span-error-register');
var $inputRegister = $('.input-register');
var $checkBoxShowPass = $('#checkbox-show-pass');
var $checkBoxPolicy = $('#checkbox-policy');

var register = (function () {
    var modules = {};
    modules.register = function () {
        let data = $formRegister.serialize();
        modules.resetError();
        $.ajax({
            type: 'post',
            url: '/register/register',
            data: data,
            dataType: 'json',
            success: function (response) {
                if (response && response.data) {
                    modules.resetError();
                    modules.resetAfterSuccess();
                    window.location.href = '/register/step2';
                }
            },
            error: function (error) {
                if (error && error.status == 422) {
                    if (error.responseJSON) {
                        jQuery.each(error.responseJSON.errors, function (key, val) {
                            $('#error-register-' + key).html(val);
                            $('#' + key + '-register').addClass('input-error');
                        });
                    }
                }
                $buttonRegister.prop('disabled', false);
            }
        });
    };

    modules.resetError = function () {
        $buttonRegister.prop('disabled', true);
        $spanError.html('');
        $inputRegister.removeClass('input-error');
    };

    modules.resetAfterSuccess = function () {
        $inputRegister.val('');
        $inputRegister.removeClass('input-error');
        $checkBoxShowPass.prop('checked', false);
        $checkBoxPolicy.prop('checked', false);
    };

    return modules;
}(window.jQuery, window, document));

$(document).ready(function () {
    $(document).on('click', '.btn-submit-register', function (e) {
        e.preventDefault();
        register.register();
    });

    $(document).on('change', '#checkbox-show-pass', function () {
        if ($(this).is(':checked')) {
            $inputPassword.prop('type', 'text');
        } else {
            $inputPassword.prop('type', 'password');
        }
    });

    $(document).on('change', '#checkbox-policy', function () {
        if ($(this).is(':checked')) {
            $buttonRegister.prop('disabled', false);
        } else {
            $buttonRegister.prop('disabled', true);
        }
    });

    $(document).on('click', '#label-show-pass', function () {
        $checkBoxShowPass.click();
    });

    $(document).on('click', '#label-policy', function () {
        $checkBoxPolicy.click();
    });
});
