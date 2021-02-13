let $formProfile = $('#form-data-profile'),
    $numPercent = $('.num-percent'),
    $progressCurrent = $('#progress-current'),
    $inputNotRequired = $('.not-required'),
    $labelError = $('#form-data-profile .error-message'),
    isAvatar = false,
    progressAll = 0,
    count_all = 1,
    role = $('input[name=role]').val(),
    checkImage = true,
    $inputAvatar = $('#input-avatar'),
    $imageAvatar = $('#image-avatar'),
    $sumProcess = 0;
if ($('#profile-id-check').length) {
    jQuery.each($formProfile.serializeArray(), function (data, val) {
        let dataName = val.name;
        if (dataName.indexOf('specialty') == -1) {
            count_all++;
        }
    });
} else {
    count_all += $formProfile.serializeArray().length;
}

if ($('#image-check-update').length) {
    isAvatar = true;
}

const NUMBER_INPUT_HIDDEN = 2;
const PROGRESS_DEFAULT = 20;
const INVESTOR = 0;
const BROKER = 1;
const EXPERT = 2;
const TYPE_IMAGES_ALLOW = ['image/jpg', 'image/png', 'image/jpeg'];

if (role == BROKER || role == EXPERT) {
    count_all = count_all + 1;
}

var profileUser = (function () {
    let modules = {};

    modules.saveData = function () {
        $("body").find('input').removeClass('input-error');
        let data = new FormData($('#form-data-profile')[0]);
        data.append("_token", $('meta[name="csrf-token"]').attr('content'));
        let submitAjax = $.ajax({
            type: "POST",
            url: '/register/info/store/',
            data: data,
            processData: false,
            contentType: false,
        });

        submitAjax.done(function (response) {
            if (response.save == 'profile_exist') {
                $('.error-register-info').show();
            } else if (response.save == true) {
                if (response.updateEmail) {
                    modules.showModalEditEmail();
                } else {
                    window.location.href = '/home';
                }
            } else {
                window.location.reload(true);
            }
        });

        submitAjax.fail(function (response) {
            $("#import-info").html('プロフィールを保存する');
            $('#import-info').attr("disabled", false);
            let messageList = response.responseJSON.errors;
            profileUser.showMessageValidate(messageList);
        });
    };

    modules.showModalEditEmail = function () {
        $("#update-info").html('プロフィールを更新する');
        $('#update-info').attr("disabled", false);
        $('#modal-edit-email').modal('show');

        $('#modal-edit-email').on('hidden.bs.modal', function (e) {
            window.location.href = '/';
        })
    };

    modules.showMessageValidate = function (messageList) {
        $("body").find('input').removeClass('input-error');
        $("body").find('select').removeClass('input-error');
        $("body").find('textarea').removeClass('input-error');
        $("body").find('.license_address').removeClass('input-error');
        $('.max_character').css("color", "#212529");
        $('.note_nickname').css('color', '#212529');

        $.each(messageList, function (key, value) {
            $('p.error-message[data-error=' + key + ']').text(value).show();
            $('input[name=' + key + ']').addClass('input-error');
            $('select[name=' + key + ']').addClass('input-error');
            $('textarea[name=' + key + ']').addClass('input-error');

            if (key === 'license_number') {
                $('[name=license_address]').addClass('input-error');
                $('input[name=license]').addClass('input-error');
                $('input[name=number_license]').addClass('input-error');
            }

            if (key === 'introduction') {
                $('.max_character').css("color", "red");
            }

            if (key === 'nick_name') {
                if (value[0] === " ") {
                    $('.note_nickname').css('color', 'red');
                }
            }
        });
        $('html, body').animate({
            scrollTop: (
                $(document).find('p.error-message[data-error=' + Object.keys(messageList)[0] + ']').offset().top - 300
            )
        }, 0);
    };

    modules.getAddressZipCode = function (zipCode) {
        let postal_code = require('japan-postal-code');
        postal_code.get(zipCode, function(address) {
            $('select[name=address_city]').val(address.prefecture);
            $('input[name=address_district]').val(address.city);
            $('input[name=address_town]').val(address.area);
            modules.progressCalculate();
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
        $('#input-avatar-url').val('');
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
            isAvatar = false;
        } else if (file.size > 5120000) {
            $imageAvatar.html('<i class="fa fa-picture-o fa-3x" aria-hidden="true"></i>');
            modules.showMessageValidateImage('画像1枚の容量は5MBまでです。');
            checkImage = false;
            isAvatar = false;
        } else {
            checkImage = true;
            isAvatar = true;
        }
        if (checkImage) {
            modules.showMessageValidateImage('');
        }
        modules.progressCalculate();
    };

    modules.showMessageValidateImage = function(message) {
        if (message === '') {
            $('p[data-error=avatar]').text(message).show();
        } else {
            $('p[data-error=avatar]').text(message).show();
        }
    };

    modules.prevent = function (event) {
        event.preventDefault();
        event.stopPropagation()
    };

    modules.updateData = function () {
        let data = new FormData($('#form-data-profile')[0]);
        data.append("_token", $('meta[name="csrf-token"]').attr('content'));
        data.append("profile_id", $('input[name="profile_id"]').val());
        data.append("time_open_page", $('input[name="time_open_page"]').val());
        let submitAjax = $.ajax({
            type: "POST",
            url: window.location.origin + '/update/info/' + $('input[name=profile_id]').val(),
            data: data,
            processData: false,
            contentType: false,
        });

        submitAjax.done(function (response) {
            if (response && response.save == true) {
                if (response.updateEmail) {
                    modules.showModalEditEmail();
                } else {
                    window.location.href = '/home';
                }
            } else {
                window.location.reload(true);
            }
        });

        submitAjax.fail(function (response) {
            $("#update-info").html('プロフィールを更新する');
            $('#update-info').attr("disabled", false);
            let messageList = response.responseJSON.errors;
            modules.showMessageValidate(messageList);
        })
    };

    modules.adminUpdateProfileUser = function () {
        let data = new FormData($('#form-data-profile')[0]);
        data.append("_token", $('meta[name="csrf-token"]').attr('content'));
        let submitAjax = $.ajax({
            type: "POST",
            url: "/admin/manage/user/edit/" + $('#main-info-assessment').data('user-id') + "/profile",
            data: data,
            processData: false,
            contentType: false,
        });

        submitAjax.done(function (response) {
            window.location.reload(true);
        });

        submitAjax.fail(function (response) {
            $("#admin-update-info").html('変更');
            modules.disabledButton(false);
            let messageList = response.responseJSON.errors;
            modules.showMessageValidate(messageList);
        })
    };

    modules.beforeSave = function ($button) {
        $('p.error-message').text('');
        $('p.error-messages').text('');
        $button.html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>少々お待ちください...');
        $button.attr("disabled", true);
    };

    modules.calculateSumProgress = function () {
        $sumProcess = $('.progress-calculate').length + 1 ;
        if ($('.input-notification').length != 0) {
            $sumProcess++
        }
        if ($('.progress-calculate-checkbox').length != 0) {
            $sumProcess++
        }
    };

    modules.progressCalculate = function () {
        let sum = 0;
        if ($('input[name=notification]').length != 0) {
            sum++;
        }
        $('.progress-calculate').each(function (key, value) {
            if ($(value).val() != '') {
                sum++
            }
        });
        $('.progress-calculate-checkbox').each(function (key, value) {
            if ($(value).prop('checked')) {
                sum++;
                return false;
            }
        });
        if (isAvatar) {
            sum++
        }
        let progress = Math.round(sum / $sumProcess * 100);
        $numPercent.html(progress);
        $progressCurrent.css({'width': progress + '%'});
    };

    modules.disabledButton = function (boolean) {
        $('.btn-in-detail').each(function() {
            $(this).prop('disabled', boolean);
        })
    };

    return modules;
}(window.jQuery, window, document));

$(document).ready(function () {
    profileUser.setEventSelectImageMap($imageAvatar, $inputAvatar);
    profileUser.calculateSumProgress();
    profileUser.progressCalculate();

    $(document).on('change', '#form-data-profile input[name=zip_code]', function () {
        profileUser.getAddressZipCode($(this).val());
    });

    $('#update-info').on('click', function () {
        profileUser.beforeSave($(this));
        profileUser.updateData();
    });

    $('#import-info').on('click', function () {
        profileUser.beforeSave($(this));
        profileUser.saveData();
    });

    $('#admin-update-info').on('click', function () {
        profileUser.beforeSave($(this));
        profileUser.adminUpdateProfileUser();
        profileUser.disabledButton(true);
    });

    $('.search-tool').on('change', function () {
        if ($(this).val() === '知人や取引業者の紹介') {
            $('.presenter').removeClass('d-none');
        } else {
            $('.presenter').addClass('d-none');
            $('.presenter').removeClass('input-error');
            $('.presenter').val('');
            $('.presenter-error').hide();
        }
    });

    $('.progress-calculate').on('change', function () {
        profileUser.progressCalculate();
    });

    $('.progress-calculate-checkbox').on('click', function () {
        profileUser.progressCalculate();
    });
});

