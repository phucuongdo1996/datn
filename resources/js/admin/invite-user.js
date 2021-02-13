const ROLE_JA = ['不動産経営者', '業者', '専門家'];

$(document).ready(function () {
    $("input[name='person_charge_last_name']").on('change', function () {
        if (!$(this).val()) {
            $('.last-name').text('｛姓｝');
        } else {
            $('.last-name').text($(this).val());
        }
    })
    $("input[name='person_charge_first_name']").on('change', function () {
        if (!$(this).val()) {
            $('.first-name').text('｛名｝');
        } else {
            $('.first-name').text($(this).val());
        }
    })
    $("input[name='email']").on('change', function () {
        if (!$(this).val()) {
            $('.email').text('{ユーザーID}');
        } else {
            $('.email').text($(this).val());
        }
    })
    $("select[name='role']").on('change', function () {
        $('.role').text(ROLE_JA[$(this).val()]);
    })
    $("#btn-send").on('click', function () {
        $('#invite-user').submit();
        $(this).html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>少々お待ちください...');
        $(this).attr("disabled", true);
    });
})
