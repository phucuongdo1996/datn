let $imageDiv1 = $('#photo-1');
let $imageDiv2 = $('#photo-2');
let $imageDiv3 = $('#photo-3');
let $inputImage1 = $("input[name='image_1']");
let $inputImage2 = $("input[name='image_2']");
let $inputImage3 = $("input[name='image_3']");
let $inputCaption = $('.caption');
let $cancelImage = $('.cancel-image');

let $currentImage1 = $("input[name='base_image_1']");
let $currentImage2 = $("input[name='base_image_2']");
let $currentImage3 = $("input[name='base_image_3']");
const FLAG_ZERO = 0;
const MAX_DISPLAY_CHARACTER_CAPTION = 200;
const TYPE_IMAGES_ALLOW = ['image/jpg', 'image/png', 'image/jpeg'];
const MAX_CHARACTER_CAPTION = 1000;
const PATH_URL_IMAGE_DEFAULT= window.location.origin + '/images/icon-plus.png';
var articlePhoto = (function () {
   let modules = {};

    modules.preventPhoto = function (event) {
        event.preventDefault();
        event.stopPropagation()
    };

    modules.setEventSelectImage = function ($imageDiv, $inputImage, $currentImage) {
        $imageDiv.on('click', function (event) {
            articlePhoto.preventPhoto(event);
            $inputImage.trigger('click');
        });
        $imageDiv.on('dragover', function (event) {
            articlePhoto.preventPhoto(event);
        });
        $imageDiv.on('dragleave', function (event) {
            articlePhoto.preventPhoto(event);
        });
        $imageDiv.on('drop', function (event) {
            articlePhoto.showImage(event, $imageDiv);
            $inputImage.prop('files', event.target.files || event.originalEvent.dataTransfer.files );
            $currentImage.val('');
        });
        $inputImage.on('change', function (event) {
            articlePhoto.showImage(event, $imageDiv);
            $currentImage.val('');
        });
        $imageDiv.find($cancelImage).on('click', function (event) {
            $currentImage.val('');
            articlePhoto.clearImage($imageDiv, $inputImage);
            articlePhoto.preventPhoto(event)
        });
    };

    modules.showImage = function (event, $imageDiv) {
        articlePhoto.preventPhoto(event);
        let files = event.target.files || event.originalEvent.dataTransfer.files;
        if (files.length === 0) {
            return
        }
        $imageDiv.removeClass('input-error').find($('div, img')).remove();
        $imageDiv.find($cancelImage).show();
        $imageDiv.append($('<img>', {
            class: 'img-preview-map',
            src: URL.createObjectURL(files[0])
        }));

        modules.checkValidateImage(files[0], $imageDiv);
    };

    modules.checkValidateImage = function(file, $imageDiv) {
        let allow = true;
        if (file.size > 5120000) {
            allow = false;
            modules.showMessageValidate('画像1枚の容量は5MBまでです。', $imageDiv);
            $imageDiv.addClass('input-error');
        }
        if (TYPE_IMAGES_ALLOW.indexOf(file.type) === -1) {
            allow = false;
            modules.showMessageValidate('画像の形式はjpgかpngの許可されています。', $imageDiv);
            $imageDiv.addClass('input-error');
        }
        if (allow) {
            modules.showMessageValidate('', $imageDiv)
        }
    };

    modules.checkValidateCaption = function() {
        if ($inputCaption.val().length > MAX_CHARACTER_CAPTION) {
            $inputCaption.addClass('input-error');
            modules.showMessageValidate('1000桁まで入力してください。', $inputCaption);
        } else {
            $inputCaption.removeClass('input-error');
            modules.showMessageValidate('', $inputCaption)
        };
    };

    modules.checkRequiredImage = function(currentImage) {
        if (!$inputImage1.val() && !$inputImage2.val() && !$inputImage3.val() && !currentImage) {
            modules.showMessageValidate('フォトを1枚以上投稿してください。', $('.title-image '));
        } else {
            modules.showMessageValidate('', $('.title-image '))
        };
    };

    modules.showMessageValidate = function(message, $imageDiv) {
        if (message === '') {
            $imageDiv.siblings("p").text(message);
            $imageDiv.siblings("p").removeClass('data-error').css('padding-top', 0);
        } else {
            $imageDiv.siblings("p").text(message);
            $imageDiv.siblings("p").addClass('data-error').css('padding-top', 5);
        }
    };

    modules.checkError = function () {
        let listError = $(document).find('p.data-error');
        if (listError.length !== 0) {
            $('html, body').animate({
                scrollTop: (
                    $(document).find('p.data-error').offset().top - 300
                )
            }, 0);
            return false
        }
        return true;
    };

    modules.issetCurrentImage = function() {
        let currentImage = false;
        $('.base-image').each(function () {
            if ($(this).val()) {
                currentImage = true;
            }
        });
        return currentImage;
    };

    modules.clearImage = function ($imageDiv, $inputImage) {
        $imageDiv.removeClass('input-error').find($('img')).remove()
        $imageDiv.find($cancelImage).hide();
        $imageDiv.siblings("p").text('').removeClass('data-error').css('padding-top', 0);
        $imageDiv.append(' <div class="essential-img_input"><img class="default_plus_icon" src="'+PATH_URL_IMAGE_DEFAULT+'"></div>');
        $inputImage.val('');
    };

    modules.displayCharacterCaption = function () {
        $('.article-caption').each(function (index, value) {
            let val = $(value).find('.text-caption')[FLAG_ZERO].innerHTML;
            if (val.length > MAX_DISPLAY_CHARACTER_CAPTION) {
                $('#text-caption-'+index).remove();
                $('#article-caption-'+index).append('<div class="txt text-caption break-all text-caption-'+index+'">' + val.substr(FLAG_ZERO, MAX_DISPLAY_CHARACTER_CAPTION) + '...' + '</div>');
            }
            $('#text-caption-'+index).removeAttr('hidden');
        })
    };

   return modules;
}(window.jQuery, window, document));

$(document).ready(function () {
    articlePhoto.setEventSelectImage($imageDiv1, $inputImage1, $currentImage1);
    articlePhoto.setEventSelectImage($imageDiv2, $inputImage2, $currentImage2);
    articlePhoto.setEventSelectImage($imageDiv3, $inputImage3, $currentImage3);

    $('#save-photo').on('click', function (event) {
        articlePhoto.checkValidateCaption();
        articlePhoto.checkRequiredImage( articlePhoto.issetCurrentImage());
        if (!articlePhoto.checkError()) {
            articlePhoto.preventPhoto(event)
        } else {
            $('#article-photo-add').submit();
            $('#save-photo').attr("disabled", true);
        }
    });

    $('.destroy-article-photo').on('click', function () {
        $(document).find('#article-photo-id').val($(this).attr('data-id'));
    });

    articlePhoto.displayCharacterCaption();

    $('.btn-search-photo').on('click', function () {
        $('.form-search-photo').submit();
    });

    $('.photo-article-0').removeClass('mt-4');

    $(document).on("click", '.remove_photo',function(){
        $('#modal-delete-photo').modal('show');
        $('.delete-photo').css('display', 'none');
        let dataId = $(this).data('id');
        $('#form-delete-photo').attr('action', "/admin/manage/delete-photo/" + dataId)
    });

    $(document).on("click", '#button-delete-photo',function(){
        $('#button-delete-photo').prop('disabled', true);
        $('#form-delete-photo').submit();
    });
});
