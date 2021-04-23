const SPECIAL_COLOR = ['unset', '#99CCFF', '#3333FF', '#6600CC', '#FF9900', '#FF33CC', '#FF3300'];

let storeItem = (function () {
    let modules = {};

    modules.showModal = function (object) {
        $('#modal-product-image').prop('src', object.data('product-image'));
        $('#modal-product-name').text(object.data('product-name'));
        $('#modal-hero-name').text(object.data('hero-name'));
        $('#modal-product-price').text(object.data('product-price'));
        $('#modal-product-name').css('color', SPECIAL_COLOR[Number(object.data('product-special'))]);
        $('#market-id-withdraw').val(object.data('market-id'));
        $('#modal-withdraw-item').modal('show');
    }

    modules.withdrawItem = function () {
        let formData = new FormData();
        formData.append("_token", $('meta[name="csrf-token"]').attr('content'));
        formData.append("market_id", $('#market-id-withdraw').val());
        Common.convertNumeralForForm(formData);
        let submitAjax = $.ajax({
            url: '/dota/user/withdraw-item',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false
        })
        submitAjax.done(function (response) {
            location.reload();
        });
        submitAjax.fail(function (response) {
            $('#pay-submit').prop('disabled', false);
            let messageList = response.responseJSON.errors;
            Common.showMessageValidate(messageList)
        });
    }

    return modules;
}(window.jQuery, window, document));

$(document).ready(function () {
    $('#check-submit').on('click', function () {
        $('#withdraw-submit').prop('disabled', !$(this).prop('checked'));
    });

    $('.withdraw-item').on('click', function () {
        storeItem.showModal($(this));
    });

    $('#withdraw-submit').on('click', function () {
        $(this).prop('disabled', true);
        $('#modal-withdraw-item').modal('hide');
        $('#modal-loading').modal('show');
        storeItem.withdrawItem();
    });
});
