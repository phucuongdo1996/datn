let information = (function () {
    let modules = {};

    modules.showModalDelete = function (id) {
        $('#delete-information-id').val(id);
        $('#modal-delete-information').modal('show');
    };

    return modules;
}(window.jQuery, window, document));

$(document).ready(function(){
    $('.remove_information').on('click', function () {
        information.showModalDelete(this.dataset.id)
    });

    $('.select-information-category').on('click', function () {
        console.log(2222)
        let value = this.dataset.value;
        if (value == "ALL") {
            $('#category-selected').html('カテゴリー');
            $('input[name=category]').val('');
        } else {
            $('#category-selected').html(value);
            $('input[name=category]').val(value);
        }
    });

    $('#search-list-information').on('click', function () {
        window.location.href = '/admin/manage/information?category=' + $('input[name=category]').val() + '&title='+$('input[name=title]').val();
    });
});
