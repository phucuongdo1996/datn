let adminTop = (function () {
    let modules = {};

    modules.getTopics = function () {
        let submitAjax = $.ajax({
            url: "/admin/manage/get-topics",
            type: "GET",
            data: {
                "user_name" : $('input[name=user_name]').val(),
                "category_name" : $('input[name=category_name]').val()
            }
        });

        submitAjax.done(function (response) {
            $('#list-table-topics').html('');
            $('#list-table-topics').html(response);
        });
    };

    modules.getArticlePhoto = function () {
        let submitAjax = $.ajax({
            url: "/admin/manage/get-article-photo",
            type: "GET",
            data: {
                "user_name" : $('input[name=user_name_photo]').val(),
            }
        });

        submitAjax.done(function (response) {
            $('.top-article-photo').html('');
            $('.top-article-photo').html(response.data);
            $('.photo-article-0').removeClass('mt-4');
            Common.displayDetailPhoto();
        });
    };

    modules.deleteTopic = function (dataId) {
        let submitAjax = $.ajax({
            url: "/admin/manage/delete-topic/" + dataId,
            type: "POST",
            data: {
                '_method' : 'DELETE',
                'reason_delete' : $('#reason-delete-topic').val()
            }
        });
        submitAjax.done(function (response) {
            $('#modal-delete-topic').modal('hide');
            $('#reason-delete-topic').val('');
            if(response && response.delete) {
                $('#div-delete-success').css('display', 'block');
                $('.delete-topic-success').html('トピックスを削除しました。');
                $('html, body').animate({
                    scrollTop: (
                        $(document).find('.delete-topic-success').offset().top - 300
                    )
                }, 1000);
            } else {
                alert('システムでの処理中にエラーが発生しました。\n' +
                    '時間を開けて再度お試しください。');
                window.location.reload();
            }
            $('#button-delete-topic').prop('disabled', false);
            adminTop.getTopics()
        });
    };

    modules.deletePhoto = function (dataId) {
        let submitAjax = $.ajax({
            url: "/admin/manage/delete-photo/" + dataId,
            type: "POST",
            data: {
                '_method' : 'DELETE',
                'reason_delete' : $('#reason-delete-photo').val()
            }
        });
        submitAjax.done(function (response) {
            $('#modal-delete-photo').modal('hide');
            $('#reason-delete-photo').val('');
            if(response && response.delete) {
                $('.delete-photo').css('display', 'block');
                $('.delete-photo-success').html('フォトアーカイブを削除しました。')
                $('html, body').animate({
                    scrollTop: (
                        $(document).find('.delete-photo-success').offset().top - 300
                    )
                }, 1000);
            } else {
                alert('システムでの処理中にエラーが発生しました。\n' +
                    '時間を開けて再度お試しください。');
                window.location.reload();
            }
            $('#button-delete-photo').prop('disabled', false);
            adminTop.getArticlePhoto();
        });
    };

    return modules;
}(window.jQuery, window, document));

$(document).ready(function () {
    adminTop.getTopics();

    $('#search-topic').on('click', function () {
        adminTop.getTopics();
    });

    $('li.select-dropdown').on('click', function () {
        $('a.select-dropdown').html($(this).html());
        let valSelected;
        if ($(this).html() == '---') {
            valSelected = '';
        } else {
            valSelected = $(this).html();
        }
        $('input[name=category_name]').val(valSelected);
    });

    $('#btn-list-topic').on('click', function () {
        window.location.href = '/admin/manage/article/?category_name=' + $('input[name=category_name]').val() + '&user_name=' + $('input[name=user_name]').val()
    });

    $('#search-list-topic').on('click', function () {
        $('#form-manage-list-topic').submit();
    });

    $(document).on("click", '.remove_topics',function(){
        $('#modal-delete-topic').modal('show');
        $('#reason-delete-topic').val('');
        $('.delete-topic').css('display', 'none');
        $('.alert-success').css('display', 'none');
        let dataId = $(this).data('id');
        $('#title-topic').html($('#title-topic' + dataId).html());
        $('#topic-id').val(dataId);
    });

    $(document).on("click", '#button-delete-topic',function(){
        let dataId = $('#topic-id').val();
        if ($('#resolve-deleted').val() == "reload") {
            $('#form-delete-topic').prop('action', "/admin/manage/delete-topic/" + dataId);
            $('#form-delete-topic').submit();
        } else {
            $('#button-delete-topic').prop('disabled', true);
            $('.delete-topic').css('display', 'none');
            adminTop.deleteTopic(dataId);
        }
    });

    adminTop.getArticlePhoto();
    $('#search-top-photo').on('click', function () {
        adminTop.getArticlePhoto();
    });

    $('#btn-top-article-photo').on('click', function () {
        window.location.href = '/admin/manage/image/?&user_name=' + $('input[name=user_name_photo]').val()
    });

    $(document).on("click", '.remove_photo',function(){
        $('#modal-delete-photo').modal('show');
        $('#reason-delete-photo').val('');
        $('.delete-photo').css('display', 'none');
        $('.alert-success').css('display', 'none');
        let dataId = $(this).data('id');
        $('#photo-id').val(dataId);
    });

    $(document).on("click", '#button-delete-photo',function(){
        $('#button-delete-photo').prop('disabled', true);
        $('.delete-photo').css('display', 'none');
        let dataId = $('#photo-id').val();
        adminTop.deletePhoto(dataId);
    });
});
