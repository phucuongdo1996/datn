$(document).ready(function () {
    $('.page-repair-history').on('change', function () {
        window.location.href = window.location.origin + window.location.pathname + '?' + $(this).attr('name') + '=' + this.value;
    });

    $('.delete-repair-history').on('click', function () {
        let dataId = $(this).data('id');
        $('#confirm-delete-house').modal('show');
        $('#form-delete-house').attr('action', window.location.origin + '/property/' + $('.property-id').val() + '/repair-history/delete/' + dataId);
    });

    $('.centered-vertical .sort-icon').on('click', function () {
        let dataId = $(this).data('id');
        $('.centered-vertical .sort-icon').removeClass('sort-icon-first');
        Common.sortTable(dataId, '.table-repair-history tr', '.table-preview-repair tr', 2);
        $(this).addClass('sort-icon-first');
    });

    $('.pre-print-repair').on('click', function () {
        setTimeout(function () {
            window.print();
        }, 500);
    });

    Common.showPrint($('#main-info-assessment'), $('.show-print'));
});
