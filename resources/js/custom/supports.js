$(document).ready(function () {
    $('.send-supports').on('click', function () {
        $(this).attr("disabled", true);
        $('.form-support').submit();
    });

    $('.btn-checkout-card').on('click', function () {
        $(this).html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>少々お待ちください...');
        $('.btn-process').css('pointer-events', 'none');
        $('#checkout-member-status').submit();
    });
});
