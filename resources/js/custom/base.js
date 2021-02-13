$(document).ready(function () {
    $(document).on('click', '.show-policy-modal', function () {
        $('#modal-policy').modal('show');
    });

    $(document).on('click', '.show-rules-modal', function () {
        $('#modal-rules').modal('show');
    });

    $('#date-picker').datepicker({
        format: 'yyyy/mm/dd',
        language: "ja",
        forceParse: false,
        defaultViewDate: { year: 1979, month: 12, day: 1 },
        endDate: "today",
    });

    $('.zip-code').on('change', function () {
        $('.zip-code').val($('.zip-code').val().split('-').join(''));
    });
});
