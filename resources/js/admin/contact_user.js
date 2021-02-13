var contactUser = (function () {
    let modules = {};
    modules.storeData = function () {
        let submitAjax = $.ajax({
            type: "POST",
            url: '/admin/manage/contact/update',
            data: modules.setDataStore(),
            processData: false,
            contentType: false,
        });
        submitAjax.done(function (response) {
            window.location.reload();
        });
        submitAjax.fail(function (response) {
            window.location.reload();
        });
    };

    modules.setDataStore = function() {
        let dataSend = new FormData(),
            dataForm = new FormData($('#form-data-contact')[0]),
            dataStatus = dataForm.getAll('status[]');
        dataSend.append("_token", $('meta[name="csrf-token"]').attr('content'));
        for (let i = 0; i < dataStatus.length; i++) {
            if (dataStatus[i] == 1) {
                dataSend.append("id[]", dataForm.getAll('id[]')[i]);
                dataSend.append("person_in_charge[]", dataForm.getAll('person_in_charge[]')[i]);
                dataSend.append("state[]", dataForm.getAll('state[]')[i]);
                dataSend.append("estimated_amount[]", Common.convertStringToNumber(dataForm.getAll('estimated_amount[]')[i]));
            }
        }
        return dataSend;
    };

    modules.setDataTitle = function(option, title, input) {
        $(option).on('click', function () {
            $(title).html($(this).html());
            $('input[name=' + input + ']').val($(this).data('id'));
        })
    };

    modules.sumEstimated = function() {
        let sumEstimated = 0;
        $('.estimated-amount').each(function() {
            sumEstimated += Common.convertStringToNumber($(this).val());
        });
        $('#sum-estimated').text(Common.numberFormat(sumEstimated));
    };

    return modules;
}(window.jQuery, window, document));

$(document).ready(function () {
    contactUser.sumEstimated();

    $('.save-data').on('change', function () {
        $('.btn-save-support').attr("disabled", false);
        $('.btn-reset').attr("disabled", false);
        $('.status-'+ $(this).data('id')).val(1);
        contactUser.sumEstimated()
    });

    $('.btn-save-support').on('click', function () {
        $(this).attr("disabled", true);
        contactUser.storeData();
    });
    contactUser.setDataTitle('.contact-status-option', '.title-contact-status', 'contact_status');
});
