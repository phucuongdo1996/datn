let $inputAvatar = $('#input-avatar'),
    $imageAvatar = $('#image-avatar');
const TYPE_IMAGES_ALLOW = ['image/jpg', 'image/png', 'image/jpeg'];

var profileSubUser = (function () {
    let modules = {};

    modules.saveData = function (url, urlSuccess) {
        let data = new FormData($('#form-data-profile')[0]);
        data.append("_token", $('meta[name="csrf-token"]').attr('content'));
        let submitAjax = $.ajax({
            type: "POST",
            url: url,
            data: data,
            processData: false,
            contentType: false,
        });

        submitAjax.done(function (response) {
            $('#import-info').attr("disabled", true);
            if (response.save == true) {
                window.location.href = urlSuccess;
            } else {
                 window.location.reload();
            }
        });

        submitAjax.fail(function (response) {
            $("#import-info").html('プロフィールを保存する');
            $('#import-info').attr("disabled", false);
            let messageList = response.responseJSON.errors;
            modules.showMessageValidate(messageList);
        });
    };

    modules.updateData = function (url, urlSuccess) {
        let data = new FormData($('#form-data-profile')[0]);
        data.append("_token", $('meta[name="csrf-token"]').attr('content'));
        let submitAjax = $.ajax({
            type: "POST",
            url: url,
            data: data,
            processData: false,
            contentType: false,
        });

        submitAjax.done(function (response) {
            $('#update-info').attr("disabled", true);
            if (response && response.save == true) {
                if (response.isSubUser) {
                    window.location.href = '/home';
                } else {
                    window.location.href = urlSuccess;
                }
            } else {
                window.location.reload();
            }
        });

        submitAjax.fail(function (response) {
            $("#update-info").html('プロフィールを保存する');
            $('#update-info').attr("disabled", false);
            let messageList = response.responseJSON.errors;
            modules.showMessageValidate(messageList);
        });
    };

    modules.showMessageValidate = function (messageList) {
        modules.removeError();
        $.each(messageList, function (key, value) {
            $('p.error-message[data-error=' + key + ']').text(value).show();
            $('input[name=' + key + ']').addClass('input-error');
            $('select[name=' + key + ']').addClass('input-error');

            if (key === 'nick_name') {
                if (value[0] === " ") {
                    $('.note_nickname').css('color', 'red');
                }
            }
        });
        modules.checkValidate(messageList);
    };

    modules.removeError = function () {
        $('p.error-message').html('');
        $("body").find('input').removeClass('input-error');
        $("body").find('select').removeClass('input-error');
        $('.note_nickname').css('color', '#212529');
    };

    modules.getAddressZipCode = function (zipCode) {
        let postal_code = require('japan-postal-code');
        postal_code.get(zipCode, function(address) {
            $('select[name=address_city]').val(address.prefecture);
            $('input[name=address_district]').val(address.city);
            $('input[name=address_town]').val(address.area);
        });
    };

    modules.setEventSelectImageMap = function ($imageMap, $inputImageMap) {
        $imageMap.on('click', function (event) {
            modules.prevent(event);
            $inputImageMap.trigger('click');
        });
        $imageMap.on('dragover', function (event) {
            modules.prevent(event);
        });
        $imageMap.on('dragleave', function (event) {
            modules.prevent(event);
        });
        $imageMap.on('drop', function (event) {
            modules.fileSelectHandler(event, true);
        });
        $inputImageMap.on('change', function (event) {
            modules.fileSelectHandler(event, false);
        });
    };

    modules.fileSelectHandler = function (event, isDrop) {
        modules.prevent(event);
        let files = event.target.files || event.originalEvent.dataTransfer.files;
        if (files.length === 0) {
            return
        }
        if (isDrop) {
            $inputAvatar.prop('files', files);
        }
        $imageAvatar.html('');
        $imageAvatar.append(modules.createImageMapPreview(URL.createObjectURL(files[0])));
        modules.checkValidateImageAdd();
    };

    modules.createImageMapPreview = function (src) {
        let $container = $('<div>', {
                class: "dz-default dz-message"
            }),
            $img = $('<img>', {
                class: 'property-img-view-custom',
                src: src
            }).appendTo($container);
        return $container;
    };

    modules.checkValidateImageAdd = function() {
        let file = $inputAvatar[0].files[0];
        if (!file.type || TYPE_IMAGES_ALLOW.indexOf(file.type) === -1) {
            modules.showMessageValidateImage('画像の形式はjpgかpngの許可されています。');
            $imageAvatar.html('<i class="fa fa-picture-o fa-3x" aria-hidden="true"></i>');
            checkImage = false;
        } else if (file.size > 5120000) {
            $imageAvatar.html('<i class="fa fa-picture-o fa-3x" aria-hidden="true"></i>');
            modules.showMessageValidateImage('画像1枚の容量は5MBまでです。');
            checkImage = false;
        } else {
            checkImage = true;
        }
        if (checkImage) {
            modules.showMessageValidateImage('');
        }
    };

    modules.showMessageValidateImage = function(message) {
        if (message === '') {
            $('p[data-error=avatar]').text(message).show();
            $('p[data-error=avatar]').removeClass('image-error').show();
        } else {
            $('p[data-error=avatar]').text(message).show();
            $('p[data-error=avatar]').addClass('image-error').show();
        }
    };

    modules.checkValidate = function (messageList) {
        let listError = $(document).find('p.image-error');
        if (listError.length !== 0) {
            $('html, body').animate({
                scrollTop: (
                    $(document).find('p.image-error').offset().top - 300
                )
            }, 300);
            return false
        } else {
            $('html, body').animate({
                scrollTop: (
                    $(document).find('p.error-message[data-error=' + Object.keys(messageList)[0] + ']').offset().top - 300
                )
            }, 300);
        }
        return true;
    };

    modules.prevent = function (event) {
        event.preventDefault();
        event.stopPropagation()
    };

    return modules;
}(window.jQuery, window, document));

$(document).ready(function () {
    profileSubUser.setEventSelectImageMap($imageAvatar, $inputAvatar);

    $('input[name=zip_code]').on('focusout', function () {
        profileSubUser.getAddressZipCode($(this).val());
    });

    $('.create-info-sub-user').on('click', function () {
        $(this).html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>少々お待ちください...');
        $(this).attr("disabled", true);
        profileSubUser.saveData('/subuser/store/', '/subuser');
    });

    $('.admin-add').on('click', function () {
        let userId = $('.parent-id').val();
        $(this).html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>少々お待ちください...');
        $(this).attr("disabled", true);
        profileSubUser.saveData('/admin/'+userId+'/subuser/store/', '/admin/manage/user/edit/'+userId);
    });

    $('.update-info-sub-user').on('click', function () {
        $(this).html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>少々お待ちください...');
        $(this).attr("disabled", true);
        profileSubUser.updateData('/subuser/update/'+ $('input[name=user_id]').val(), '/subuser');
    });

    $('.admin-edit').on('click', function () {
        let userId = $('.parent-id').val();
        $(this).html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>少々お待ちください...');
        $(this).attr("disabled", true);
        profileSubUser.updateData('/admin/'+userId+'/subuser/update/'+ $('input[name=user_id]').val(), '/admin/manage/user/edit/'+userId);
    });

    $('.delete-sub-user').on('click', function () {
        let dataId = $(this).data('id');
        $('#sub-user-modal').modal('show');
        $('#form-delete-sub-user').attr('action', window.location.origin + '/subuser' + '/destroy/' + dataId);
    });

    $('.change-role').on('change', function () {
        $('#change-' + this.dataset.id).prop('checked', true);
    });

    $('#btn-submit-change-permission').on('click', function () {
        $(this).html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>少々お待ちください...');
        $(this).attr("disabled", true);
        $('#form-change-permission').submit();
    });
});
