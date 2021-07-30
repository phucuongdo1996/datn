const SELECT_ID = 1;
const SELECT_NAME = 2;
let editProductFunction = (function () {
    let modules = {};

    modules.autoSelect = function (obj, type) {
        let id = obj.val();
        if (type == SELECT_ID) {
            obj.parent().parent().find('.select-product-name').val(id);
        } else {
            obj.parent().parent().find('.select-product-id').val(id);
        }
    }

    modules.deleteProduct = function () {
        let formData = new FormData();
        formData.append("_token", $('meta[name="csrf-token"]').attr('content'));
        formData.append("product_base_id", $('#product-base-id').val());
        formData.append("table", $('#table').val());
        let submitAjax = $.ajax({
            url: '/admin/delete-product',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false
        })
        submitAjax.done(function (response) {
            window.location.reload();
        });
        submitAjax.fail(function (response) {
            window.location.reload();
        });
    }

    return modules;
}(window.jQuery, window, document));

$(document).ready(function () {
    $('.select-product-id').on('change', function () {
        editProductFunction.autoSelect($(this), SELECT_ID)
    });

    $('.select-product-name').on('change', function () {
        editProductFunction.autoSelect($(this), SELECT_NAME)
    });

    $('.btn-drop-product').on('click', function () {
        $('#product-base-id').val($(this).data('id'))
        $('#table').val($(this).data('table'))
        $('#modal-delete-product-admin').modal('show');
    });

    $('#delete-submit').on('click', function () {
        editProductFunction.deleteProduct()
    })
});
