let userDetail = (function () {
    let userId = $('#main-info-assessment').data('user-id');

    let modules = {};
    modules.getProperty = function (url) {
        let submitAjax = $.ajax({
            url: url ? url : "/admin/manage/user/edit/" + userId + "/property",
            type: "GET"
        });

        submitAjax.done(function (response) {
            $('#main-info-assessment #property-results').html(response.html);
            $('#main-info-assessment .cus-paginate .btn').prop('disabled', false);
            if (url) {
                $('html, body').animate({
                    scrollTop: (
                        $(document).find('#admin-user-list-property').offset().top - 100
                    )
                }, 100);
            }
        });

        submitAjax.fail(function (response) {
            $(document).find('#main-info-assessment .cus-paginate .btn').prop('disabled', false);
        });
    };

    modules.getArticlePhoto = function () {
        let submitAjax = $.ajax({
            url: "/admin/manage/user/edit/" + userId + "/article-photo",
            type: "GET",
        });

        submitAjax.done(function (response) {
            $('.user-detail-photo').html(response.html);
            $('.photo-article-0').removeClass('mt-2');
            Common.displayDetailPhoto();
        });
    };

    modules.getTopics = function () {
        let submitAjax = $.ajax({
            url: "/admin/manage/user/edit/" + userId + "/topics",
            type: "GET",
        });

        submitAjax.done(function (response) {
            $('.user-detail-topic').html(response.html);
        });
    };

    modules.moveProperty = function () {
        let data = new FormData($('#form-property-checkbox')[0]);
        data.append('_token', $('meta[name="csrf-token"]').attr('content'));
        let submitAjax = $.ajax({
            url: "/admin/manage/user/edit/" + userId + "/property/move",
            type: "POST",
            data: data,
            processData: false,
            contentType: false,
        });

        submitAjax.done(function (response) {
            window.location.reload(true);
        });

        submitAjax.fail(function (response) {
            $("#submit-form-property-checkbox").html('変更');
            modules.disabledButton(false);
            let messageList = response.responseJSON.errors;
            modules.showMessageValidate(messageList);
        })
    };

    modules.moveSubUser = function () {
        let data = new FormData($('#form-sub-user-checkbox')[0]);
        data.append('_token', $('meta[name="csrf-token"]').attr('content'));
        let submitAjax = $.ajax({
            url: "/admin/manage/user/edit/" + userId + "/sub-user/move",
            type: "POST",
            data: data,
            processData: false,
            contentType: false,
        });

        submitAjax.done(function (response) {
            window.location.reload(true);
        });

        submitAjax.fail(function (response) {
            $("#submit-form-sub-user-checkbox").html('変更');
            modules.disabledButton(false);
            let messageList = response.responseJSON.errors;
            modules.showMessageValidate(messageList);
        })
    };

    modules.clearErrorMessages = function () {
        $('p.error-message').html('');
        $("body").find('input').removeClass('input-error');
    };

    modules.showMessageValidate = function (messageList) {
        $.each(messageList, function (key, value) {
            $('p.error-message[data-error=' + key + ']').text(value).show();
            $('input[name=' + key + ']').addClass('input-error');
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
            userDetail.getTopics()
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
            userDetail.getArticlePhoto();
        });
    };

    modules.disabledButton = function (boolean) {
        $('.btn-in-detail').each(function() {
            $(this).prop('disabled', boolean);
        })
    };

    return modules;
}(window.jQuery, window, document));

$(document).ready(function () {
    userDetail.getProperty();
    userDetail.getTopics();
    userDetail.getArticlePhoto();

    $(document).on('click', '#main-info-assessment .cus-paginate .btn', function(e) {
        e.preventDefault();
        $(this).prop('disabled', true);
        userDetail.getProperty($(this).attr('href'));
    });

    $(document).on('click', '#btn-block-user', function(e) {
        e.preventDefault();
        $(this).prop('disabled', true);
        $('#form-block-user').submit();
    });

    $('.check-all').on('change', function () {
        let parent = $(this).parent().parent();
        if (this.checked) {
            parent.find('.check-items').prop('checked', true);
        } else {
            parent.find('.check-items').prop('checked', false);
        }
    });

    $('.check-items').on('change', function () {
        let parent = $(this).parent().parent();
        if (!this.checked) {
            parent.find('.check-all').prop('checked', false);
        } else {
            let check = true;
            $.each(parent.find('.check-items'), function ($key, $value) {
                if (!$value.checked) {
                    check = false;
                    return false;
                }
            });
            if (check) {
                parent.find('.check-all').prop('checked', true);
            } else {
                parent.find('.check-all').prop('checked', false);
            }
        }
    });

    $('#submit-form-property-checkbox').on('click', function () {
        $(this).html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>少々お待ちください...');
        $(this).attr("disabled", true);
        userDetail.clearErrorMessages();
        userDetail.moveProperty();
        userDetail.disabledButton(true);
    });

    $('#submit-form-sub-user-checkbox').on('click', function () {
        $(this).html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>少々お待ちください...');
        $(this).attr("disabled", true);
        userDetail.clearErrorMessages();
        userDetail.moveSubUser();
        userDetail.disabledButton(true);
    });

    $(document).on('click', '.close-modal-block', function(e) {
        $('#reason-block-user').val('');
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
            userDetail.deleteTopic(dataId);
        }
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
        $('#modal-delete-photo').modal('hide');
        let dataId = $('#photo-id').val();
        userDetail.deletePhoto(dataId);
    });

    $(document).on('click', '.user_delete', function () {
        $('#sub-user-modal').modal('show');
        $('#reason-delete-sub-user').val('');
        let dataId = $(this).data('id');
        $('#form-delete-sub-user').prop('action', '/admin/subuser/' + dataId);
    });

    $(document).on('click', '#btn-delete-sub-user', function () {
        $(this).prop('disabled', 'true');
        $('#form-delete-sub-user').submit();
    });

    $('.show-confirm-trial').on('click', function () {
        $('#modal-show-confirm-trial').modal('show');
    });

    $('#end-trial').on('click', function () {
        $('#change-member-status').submit();
    });

    $('input[name=discount-output]').on('focusout', function () {
        $('input[name=discount]').val(Common.convertStringToNumber($('input[name=discount-output]').val()));
    });

    $('#update-payment').on('click', function () {
        $('#form-update-payment').submit();
        userDetail.disabledButton(true);
    });

     $('#update-member-status').on('click', function () {
        $('#change-member-status').submit();
        userDetail.disabledButton(true);
    })
});
