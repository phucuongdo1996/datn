const FLAG_ZERO = 0;
const MAX_DISPLAY_CHARACTER_CAPTION = 200;
$(document).ready(function(){
    $(document).on('change', '.per-page', function () {
        $('.per-page').val($(this).val());
        window.location.href = location.origin + location.pathname + '?' + $(this).attr('name') + '=' + this.value;
    });

    $(document).on("click", '.remove_topics',function(){
        $('#modal-delete-topic').modal('show');
        let dataId = $(this).data('id');
        $('#title-topic').html($('#title-topic' + dataId).html());
        $('#form-delete-topic').attr('action', '/article/text/' + dataId);
    });

    $(document).on("click", '#button-delete-topic',function(){
        $('#button-delete-topic').prop('disabled', true);
        $('#form-delete-topic').submit();
    });

    $('.topic-title').each(function () {
        let val = $(this).html();
        if (val.length > MAX_DISPLAY_CHARACTER_CAPTION) {
            $(this).html(val.substr(FLAG_ZERO, MAX_DISPLAY_CHARACTER_CAPTION) + '...');
        }
        $(this).removeClass('d-none');
    });

    $('.caption-image').each(function () {
        let val = $(this).html();
        if (val.length > MAX_DISPLAY_CHARACTER_CAPTION) {
            $(this).html(val.substr(FLAG_ZERO, MAX_DISPLAY_CHARACTER_CAPTION) + '...');
        }
        $(this).removeClass('d-none');
    });
});
