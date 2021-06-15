let rechargeMoney = (function () {
    let modules = {};

    modules.getUrlBaoKim = function () {
        let formData = new FormData($('#form-data')[0]);
        formData.append("_token", $('meta[name="csrf-token"]').attr('content'));
        let submitAjax = $.ajax({
            url: '/dota/user/get-url-bao-kim',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false
        })
        submitAjax.done(function (response) {
            window.location.href = response.url_redirect;
        });
        submitAjax.fail(function (response) {
            $('#btn-redirect-bao-kim').prop('disabled', false);
            let messageList = response.responseJSON.errors;
            Common.showMessageValidate(messageList)
        });
    }
    return modules;
}(window.jQuery, window, document));

$(document).ready(function () {
    $('#btn-redirect-bao-kim').on('click', function () {
        $(this).prop('disabled', true);
        rechargeMoney.getUrlBaoKim()
    });
});
