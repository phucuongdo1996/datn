var ResetPassword = (function ($) {
    let modules = {};

    modules.showMessageValidate = function (error) {
        if (error.responseJSON) {
            jQuery.each(error.responseJSON.errors, function (key, val) {
                if (key == 'email_forgot' || key == 'password_confirm') {
                    if (val[0].length == 2) {
                        $('span.span-error-forgot-pw[data-error=' + key + '_1]').html(val[0][0]);
                        $('span.span-error-forgot-pw[data-error=' + key + '_2]').html(val[0][1]);
                    } else {
                        $('span.span-error-forgot-pw[data-error=' + key + '_1]').html(val);
                    }
                }
                else {
                    $('span.span-error-forgot-pw[data-error=' + key + ']').html(val);
                }
                $("[name = '" + key + "' ]").addClass('input-error');
            });
        }
    };

    modules.clearErrorMessages = function () {
        $('body').find('.input-error').removeClass('input-error');
        $('.span-error-forgot-pw').html('');
    };

    modules.submitEmailForgotPass = function () {
        ResetPassword.clearErrorMessages();
        $("#submit-gmail-forgot-pass").html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>少々お待ちください...');
        document.getElementById("submit-gmail-forgot-pass").disabled = true;

        let submitEmail = $.ajax({
            url: "/pass-reminder/send-mail-reset-password",
            type: "POST",
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                email_forgot: $('#email-forgot').val(),
            },
        });

        submitEmail.done(function (res) {
            $("#submit-gmail-forgot-pass").html('パスワード再発行メールの送信');
            document.getElementById("submit-gmail-forgot-pass").disabled = false;
            if (res.status == true) {
                $('.div-gmail-forgot-pass').text(res.data.email_forgot);
                $('.forgot-pw-step1').css('display', 'none');
                $('.forgot-pw-step2').css('display', 'block');
            } else {
                alert('システムでの処理中にエラーが発生しました。\n' +
                    '時間を開けて再度お試しください。');
                window.location.reload();
            }
        });

        submitEmail.fail(function (error) {
            $("#submit-gmail-forgot-pass").html('パスワード再発行メールの送信');
            document.getElementById("submit-gmail-forgot-pass").disabled = false;
            ResetPassword.clearErrorMessages();
            ResetPassword.showMessageValidate(error);
        });
    };

    modules.submitChangePass = function () {
        ResetPassword.clearErrorMessages();
        let data = new FormData($('#confirm-password')[0]);
        data.append('_token', $('meta[name="csrf-token"]').attr('content'));
        let submitChangePass = $.ajax({
            url: "/pass-reminder/reset-password",
            type: "POST",
            data: data,
            processData: false,
            contentType: false,
        });

        submitChangePass.done(function (res) {
            if (res.save == true) {
                $('.forgot-pw-step3').css('display', 'none');
                $('.forgot-pw-step4').css('display', 'block');
            } else {
                alert('システムでの処理中にエラーが発生しました。\n' +
                    '時間を開けて再度お試しください。');
                window.location.reload();
            }
        });

        submitChangePass.fail(function (error) {
            ResetPassword.clearErrorMessages();
            ResetPassword.showMessageValidate(error);
        });
    };

    return modules;
}(window.jQuery, window, document));

$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#submit-gmail-forgot-pass').on('click', function () {
        ResetPassword.submitEmailForgotPass();
    });

    $('#btn-change-pass').on('click', function () {
        ResetPassword.submitChangePass();
    });
});
