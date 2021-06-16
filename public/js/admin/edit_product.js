const SELECT_ID = 1;
const SELECT_NAME = 2;
let productFunction = (function () {
    let modules = {};

    modules.autoSelect = function (obj, type) {
        let id = obj.val();
        if (type == SELECT_ID) {
            obj.parent().parent().find('.select-product-name').val(id);
        } else {
            obj.parent().parent().find('.select-product-id').val(id);
        }
    }

    return modules;
}(window.jQuery, window, document));

$(document).ready(function () {
    $('.select-product-id').on('change', function () {
        productFunction.autoSelect($(this), SELECT_ID)
    });

    $('.select-product-name').on('change', function () {
        productFunction.autoSelect($(this), SELECT_NAME)
    });
});
