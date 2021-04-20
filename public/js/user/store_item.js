let storeItem = (function () {
    let modules = {};

    modules.showModal = function (object) {
        $('#modal-product-image').prop('src', object.data('product-image'));
        $('#modal-product-name').text(object.data('product-name'));
        $('#modal-hero-name').text(object.data('hero-name'));
        $('#modal-product-price').text(object.data('product-price'));
        $('#modal-withdraw-item').modal('show')
    }

    return modules;
}(window.jQuery, window, document));

$(document).ready(function () {
    $('#check-submit').on('click', function () {
        $('#withdraw-submit').prop('disabled', !$(this).prop('checked'));
    });

    $('.withdraw-item').on('click', function () {
        // listItem.getDataChart($(this).data('product-base-id'))
        storeItem.showModal($(this));
    });
});
