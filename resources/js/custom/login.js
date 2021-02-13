var $btnLogin = $('#login');
var Login = (function ($) {
    let modules = {};

    modules.showMessageValidate = function (messageList) {
        $('body').find('p.error-message').hide();
        $('#email').removeClass('input-error');
        $('#password').removeClass('input-error');
        $.each(messageList, function (key, value) {
            $('p.error-message[data-error=' + key + ']').text(value).show();
            $('#' + key ).addClass('input-error');
        });
        $('html, body').animate({
            scrollTop: (
                $(document).find('p.error-message[data-error=' + Object.keys(messageList)[0] +']').offset().top - 300
            )
        }, 1000);
    };

    modules.clearFlashMessages = function (id) {
        $('body').find('#' + id).hide();
    };

    modules.login = function () {
        let data = new FormData($('#form-login')[0]);
        let submitAjax = $.ajax({
            url: "/login",
            type: "POST",
            data: data,
            processData: false,
            contentType: false
        });

        submitAjax.done(function (response) {
            window.location.reload();

            if (response.userLogin === true) {
                window.location.href="/home";
            }
        });

        submitAjax.fail(function (response) {
            let messageList = response.responseJSON.errors;
            Login.showMessageValidate(messageList);
        });
    };

    return modules;
}(window.jQuery, window, document));

$(document).ready(function () {
    $btnLogin.click(function () {
        $($btnLogin).attr('disable', true);
        Login.clearFlashMessages('flash-messages-error');
        Login.clearFlashMessages('flash-messages-success');
        Login.login();
    });

    if ($('#flash-messages-error').text() != "") {
        $('#email').addClass('input-error');
        $('#password').addClass('input-error');
    }
});
