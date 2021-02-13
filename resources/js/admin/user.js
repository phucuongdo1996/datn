$(document).ready(function () {
    $(document).on('click', '.status-option', function () {
        $('.title-member-status').html($(this).html());
        $('input[name=member_status]').val($(this).data('id'));
    });

    $(document).on('click', '.role-option', function () {
        $('.title-role').html($(this).html());
        $('input[name=role]').val($(this).data('id'));
    });

    $(document).on('click', '.block-option', function () {
        $('.title-block-user').html($(this).html());
        $('input[name=block_user]').val($(this).data('id'));
    });
});
