let steamCodeFunction = (function () {
    let modules = {};

    modules.deleteSteamCode = function () {
        let submitAjax = $.ajax({
            url: '/admin/delete-steam-code/' + $('#steam-code-id').val(),
            type: 'DELETE',
            data: {
                "_token" : $('meta[name="csrf-token"]').attr('content')
            },
        })
        submitAjax.done(function (response) {
           window.location.reload();
        });
        submitAjax.fail(function (response) {
            window.location.reload();
        });
    }

    modules.addSteamCode = function () {
        let formData = new FormData($('#form-data')[0]);
        formData.append('_token', $('meta[name="csrf-token"]').attr('content'));
        let submitAjax = $.ajax({
            url: '/admin/add-steam-code/' + $('#steam-code-id').val(),
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false
        })
        submitAjax.done(function (response) {
            window.location.reload();
        });
        submitAjax.fail(function (response) {
            let messageList = response.responseJSON.errors;
            Common.showMessageValidate(messageList);
        });
    }

    return modules;
}(window.jQuery, window, document));

$(document).ready(function () {
    $('.btn-delete-steam-code').on('click', function () {
        $('#delete-steam-code').text($(this).data('steam-code'));
        $('#steam-code-id').val($(this).data('id'));
        $('#modal-delete-steam-code').modal('show');
    });

    $('#delete-submit').on('click', function () {
        steamCodeFunction.deleteSteamCode();
    });

    $('#btn-add-steam-code').on('click', function () {
        steamCodeFunction.addSteamCode();
    })
});
