let $imageMap1 = $('.image-location-map-1');
let $imageMap2 = $('.image-location-map-2');
let $inputImageMap1 = $('#input-image-map-1');
let $inputImageMap2 = $('#input-image-map-2');
const IMAGE_MAP_1 = 1;
const IMAGE_MAP_2 = 2;
const TYPE_IMAGES_ALLOW = ['image/jpg', 'image/png', 'image/jpeg'];
const PATH_URL_IMAGES_GENERAL_INFO = window.location.origin + '/storage/imagesGeneralInfo/';
let essentialProperty = (function () {
    let modules = {};

    modules.prevent = function (event) {
        event.preventDefault();
        event.stopPropagation()
    };

    modules.createImageMapPreview = function (src) {
        let $container = $('<div>', {
                class: "essential-img essential-icon-img border-0"
            }),
            $img = $('<img>', {
                class: 'img-preview-map',
                src: src
            }).appendTo($container);
        return $container;
    };

    modules.createImageInfoPreview = function (src, classImage, showButtonDelete = false) {
        let resource = window.location.origin + '/' + src;
        let $container = $('<div>', {
                class: 'col-6 m15b'
            }), $container1 = $('<div>', {
                class: "pick-images",
            }).appendTo($container),
            $container2 = $('<div>', {
                class: 'essential-img essential-icon-img border-0',
            }).appendTo($container1),
            $img = $('<img>', {
                class: classImage,
                src: resource
            }).appendTo($container2),
            $button = $('<button>', {
                class: 'delete-image input-hidden'
            }).appendTo($container2),
            $i = $('<i>', {
                text: 'clear',
                class: 'material-icons'
            }).appendTo($button),
            $input = $('<input>', {
                class: 'input-image-info input-hidden',
                name: 'image_info[]',
                type: 'file'
            }).appendTo($container);
        $container1.on('click', function (event) {
            $input.trigger('click')
        });
        $container1.on('dragover', function (event) {
            essentialProperty.prevent(event);
        });
        $container1.on('dragleave', function (event) {
            essentialProperty.prevent(event);
        });
        $container1.on('drop', function (event) {
            essentialProperty.fileSelectHandlerInfo(event, $input, $img, $button, true);
            modules.addImageDelete(src);
        });
        $input.on('change', function (event) {
            essentialProperty.fileSelectHandlerInfo(event, $input, $img, $button, false);
            modules.addImageDelete(src);
        });
        $button.on('click', function (event) {
            modules.addImageDelete(src);
            $container.remove();
            let numberImage = document.getElementsByClassName('img-preview-map-info').length;
            if (numberImage === 5) {
                $('#image-multiple-preview').append(modules.createImageInfoPreview('images/icon-plus.png', 'img-default', false));
            }
            modules.checkValidateImageInfo();
        });
        if (showButtonDelete) {
            $button.prop('class', 'delete-image');
        }
        return $container;
    };

    modules.addImageDelete = function(src) {
        if (src != 'images/icon-plus.png') {
            let $inputDelete = $('<input>', {
                name: 'image_delete[]',
                type: 'hidden',
                value: src,
            });
            $('#list-image-delete').append($inputDelete);
        }
    };

    modules.fileSelectHandlerInfo = function (event, $inputImageMap, $imageMap, $button, isDrop) {
        essentialProperty.prevent(event);
        let files = event.target.files || event.originalEvent.dataTransfer.files;
        if (files.length === 0) {
            return
        }
        if (isDrop) {
            $inputImageMap.prop('files', files);
        }
        $button.prop('class', 'delete-image');
        $imageMap.html('');
        $imageMap.prop('class', 'img-preview-map img-preview-map-info');
        $imageMap.prop('src', URL.createObjectURL(files[0]));
        let imageDefault = document.getElementsByClassName('img-default');
        let numberImage = document.getElementsByClassName('img-preview-map-info').length;
        if (numberImage <= 5 && imageDefault.length === 0) {
            $('#image-multiple-preview').append(modules.createImageInfoPreview('images/icon-plus.png', 'img-default', false));
        }
        modules.checkValidateImageInfo();
    };

    modules.checkValidateImageInfo = function() {
        let check = true;
        let listInputImageInfo = $('input.input-image-info');
        $.each(listInputImageInfo, function (key, value) {
            let file = value.files;
            if (file.length === 0) {
                return null;
            }
            if (file[0].size > 5120000) {
                modules.showMessageValidateInfo('画像1枚の容量は5MBまでです。');
                $($(value).parent().find("img")[0]).addClass('input-error');
                check = false;
            }
            if (TYPE_IMAGES_ALLOW.indexOf(file[0].type) === -1) {
                modules.showMessageValidateInfo('画像の形式はjpgかpngの許可されています。');
                $($(value).parent().find("img")[0]).addClass('input-error');
                check = false;
            }
        });
        if (check) {
            modules.showMessageValidateInfo('');
        }
        return null;
    };

    modules.showMessageValidateInfo = function(message) {
        if (message === '') {
            $('p[data-error=image-info]').text(message);
            $('p[data-error=image-info]').removeClass('image-error');
        } else {
            $('p[data-error=image-info]').text(message);
            $('p[data-error=image-info]').addClass('image-error');
        }
    };

    modules.fileSelectHandler = function (event, type, isDrop) {
        essentialProperty.prevent(event);
        let files = event.target.files || event.originalEvent.dataTransfer.files;
        if (files.length === 0) {
            return
        }
        if (type === IMAGE_MAP_1) {
            if (isDrop) {
                $inputImageMap1.prop('files', files);
            }
            $imageMap1.html('');
            $imageMap1.append(essentialProperty.createImageMapPreview(URL.createObjectURL(files[0])));
            $('.confirm-image-location-map-1').html('');
            $('.confirm-image-location-map-1').append(essentialProperty.createImageMapPreview(URL.createObjectURL(files[0])));
        } else {
            if (isDrop) {
                $inputImageMap2.prop('files', files);
            }
            $imageMap2.html('');
            $imageMap2.append(essentialProperty.createImageMapPreview(URL.createObjectURL(files[0])));
            $('.confirm-image-location-map-2').html('');
            $('.confirm-image-location-map-2').append(essentialProperty.createImageMapPreview(URL.createObjectURL(files[0])));
        }
        modules.checkValidateImage(files[0], type);
    };

    modules.checkValidateImage = function(file, type) {
        let allow = true;
        if (file.size > 5120000) {
            allow = false;
            modules.showMessageValidate('画像1枚の容量は5MBまでです。', type);
            type === IMAGE_MAP_1 ? $($('.image-map-1').find("img")[0]).addClass('input-error') : $($('.image-map-2').find("img")[0]).addClass('input-error');
        }
        if (TYPE_IMAGES_ALLOW.indexOf(file.type) === -1) {
            allow = false;
            modules.showMessageValidate('画像の形式はjpgかpngの許可されています。', type);
            type === IMAGE_MAP_1 ? $($('.image-map-1').find("img")[0]).addClass('input-error') : $($('.image-map-2').find("img")[0]).addClass('input-error');
        }
        if (allow) {
            modules.showMessageValidate('', type)
        }
    };

    modules.showMessageValidate = function(message, type) {
        let dataError = type === IMAGE_MAP_1 ? 'image-map-1' : 'image-map-2';
        if (message === '') {
            $('p[data-error='+dataError+']').text(message);
            $('p[data-error='+dataError+']').removeClass('image-error');
        } else {
            $('p[data-error='+dataError+']').text(message);
            $('p[data-error='+dataError+']').addClass('image-error');
        }
    };

    modules.setEventSelectImageMap = function ($imageMap, $inputImageMap, indexMap) {
        $imageMap.on('click', function (event) {
            essentialProperty.prevent(event);
            $inputImageMap.trigger('click');
        });
        $imageMap.on('dragover', function (event) {
            essentialProperty.prevent(event);
        });
        $imageMap.on('dragleave', function (event) {
            essentialProperty.prevent(event);
        });
        $imageMap.on('drop', function (event) {
            essentialProperty.fileSelectHandler(event, indexMap, true);
        });
        $inputImageMap.on('change', function (event) {
            essentialProperty.fileSelectHandler(event, indexMap, false);
        });
    };

    modules.checkValidate = function () {
        let listError = $(document).find('p.image-error');
        if (listError.length !== 0) {
            $('html, body').animate({
                scrollTop: (
                    $(document).find('p.image-error').offset().top - 300
                )
            }, 0);
            return false
        }
        return true;
    };

    modules.showImgPreviewConfirm = function () {
        $(document).find('img.confirm-img-info').removeClass('img-preview-map');
        $(document).find('img.confirm-img-info').prop('src', window.location.origin + '/images/icon-img.png');
        let listImageInfo = $(document).find('img.img-preview-map-info');
        $.each(listImageInfo, function (key, value) {
            if (value.src !== "") {
                $('#preview-image-' + (key+1)).prop('src', value.src);
                $('#preview-image-' + (key+1)).addClass('img-preview-map');
            }
        });
    };

    modules.switchEssentialScreen = function (showConfirm) {
        if (showConfirm) {
            modules.setValueConfirmScreen();
            $('#essential-create-screen').hide();
            $('#essential-confirm-screen').removeClass('d-none');
            $('#essential-confirm-screen').addClass('d-block');
        } else {
            $('#essential-create-screen').show();
            $('#essential-confirm-screen').removeClass('d-block');
            $('#essential-confirm-screen').addClass('d-none');
        }
        $('html, body').animate({
            scrollTop: (
                $(document).top - 300
            )
        }, 0);
    };

    modules.setValueConfirmScreen = function () {
        $('#traffic').val($('input[name=traffic]').val() ? $('input[name=traffic]').val() : 'ー');
        if ($('input[name=price]').val() != "") {
            $('#price').val('金' + $('input[name=price]').val() + '円');
        } else {
            $('#price').val('金0円');
        }
        $('#display-details-of-each-floor-area').val($('input[name=details_of_each_floor_area]').val() ? $('input[name=details_of_each_floor_area]').val() : 'ー');
        $('#display-near-road').val($('input[name=near_road]').val() ? $('input[name=near_road]').val() : 'ー');
        $('#display-area-used').val($('textarea[name=area_used]').val() ? $('textarea[name=area_used]').val() : 'ー');
        $('#display-notes').val($('textarea[name=notes]').val() ? $('textarea[name=notes]').val() : 'ー');
        $('#memo-broker').val($('textarea[name=memo_broker]').val() ? $('textarea[name=memo_broker]').val() : 'ー');
        modules.showImgPreviewConfirm();
        modules.showTextWithCheckBox();
        modules.setValueDisplayCheckBoxNumber();
    };

    modules.showTextWithCheckBox = function () {
        $.each($(document).find('input[type=checkbox]'), function (key, value) {
            if (value.value == 1) {
                $('#'+value.dataset.display).hide();
                $('#'+value.dataset.display+'-hidden').show();
            } else {
                $('#'+value.dataset.display).show();
                $('#'+value.dataset.display+'-hidden').hide();
            }
        })
    };

    modules.getDisplayCheckBoxNumber = function (value, valueDefault, checked) {
        let type = $('#real_estate_type_id').val();
        if (checked == 1 && type !== "") {
            switch (type) {
                case "1":
                    if (value < 3000) {
                        return '3,000㎡未満'
                    }
                    if (value >= 3000 && value < 10000) {
                        return '3,000㎡以上10,000㎡未満'
                    }
                    if (value >= 10000 && value < 30000) {
                        return '10,000㎡以上30,000㎡未満'
                    }
                    if (value >= 30000) {
                        return '30,000㎡以上'
                    }
                    break;
                case "2":
                    if (value < 2000) {
                        return '2,000㎡未満'
                    }
                    if (value >= 2000 && value < 3000) {
                        return '2,000㎡以上3,000㎡未満'
                    }
                    if (value >= 3000 && value < 5000) {
                        return '3,000㎡以上5,000㎡未満'
                    }
                    if (value >= 5000) {
                        return '5,000㎡以上'
                    }
                    break;
                case "3":
                    if (value < 1000) {
                        return '1,000㎡未満'
                    }
                    if (value >= 1000 && value < 10000) {
                        return '1,000㎡以上10,000㎡未満'
                    }
                    if (value >= 10000) {
                        return '10,000㎡以上'
                    }
                    break;
                default:
                    if (value < 5000) {
                        return '5,000㎡未満'
                    }
                    if (value >= 5000 && value < 10000) {
                        return '5,000㎡以上10,000㎡未満'
                    }
                    if (value >= 10000) {
                        return '10,000㎡以上'
                    }
                    break;
            }
        } else {
            return valueDefault;
        }
    };

    modules.setValueDisplayCheckBoxNumber = function () {
        let type = $('#real_estate_type_id').val();
        $('#confirm-ground-area').val(modules.checkDisplayExcelRoundDown($('#ground-area').val(), $('#ground-area-unit').val(), $('#display-ground-area').val()));
        $('#confirm-total-area-floors').val(modules.getDisplayCheckBoxNumber($('#total-area-floors').val(), $('#total-area-floors-unit').val(), $('#display-total-area-floors').val()));
        $('#confirm-area-may-rent').val(modules.getDisplayCheckBoxNumber($('#area-may-rent').val(), $('#area-may-rent-unit').val(), $('#display-area-may-rent').val()));
        $('#confirm-display-area-rent').val(modules.checkDisplayExcelRoundDown($('#area-rent').val(), $('#area-rent-unit').val(), $('#display-area-rent').val()));
        $('#confirm-area-rental-operating').val(modules.getDisplayCheckBoxNumber($('#area-rental-operating').val(), $('#area-rental-operating-unit').val(), $('#display-area-rental-operating').val()));
    };

    modules.checkDisplayExcelRound = function (value, valueDefault, checked) {
        if (checked == 1) {
            return Common.numberFormat(Common.roundByPosition(value, 3)) + ' ㎡台';
        }
        return valueDefault;
    };

    modules.checkDisplayExcelRoundDown = function (value, valueDefault, checked) {
        if (checked == 1) {
            return Common.numberFormat(Common.excelRoundDown(value)) + ' ㎡台';
        }
        return valueDefault;
    };

    modules.showImageGeneralInfo = function () {
        $('#image-multiple-preview').html('');
        let listImage = $(document).find('input[class=img-preview-info]');
        $.each(listImage, function (key, value) {
            if (value.value != "") {
                $('#image-multiple-preview').append(modules.createImageInfoPreview('storage/imagesGeneralInfo/' + value.value, 'img-preview-map img-preview-map-info', true));
            }
        });
        if (listImage.length < 6 ){
            $('#image-multiple-preview').append(essentialProperty.createImageInfoPreview('images/icon-plus.png', 'img-default', false));
        }
    };

    modules.showPreviewPrint = function () {
        modules.setValuePreviewPrint();
        modules.setImagesPreviewPrint();
        setTimeout(function () {
            window.print();
        }, 500);
    };

    modules.hidePreviewPrint = function () {
        $('#header').show();
        $('#form-data-summary').show();
        $('.main-sidebar-left').show();
        $('#wrapper-master').css('padding-left', 270);
        $('.background-print').hide();
    };

    modules.setImagesPreviewPrint = function () {
        let listImageInfo = $(document).find('img.img-preview-map-info');
        $('.preview-print-image').prop('src', window.location.origin + '/images/icon-img.png');
        $('.preview-print-image').removeClass('img-preview-map');
        $('#images-info-print').html('');
        if (listImageInfo.length == 0) {
            $('#title-imames-info-print').hide();
        } else {
            $('#title-imames-info-print').show();
        }
        $.each(listImageInfo, function (key, value) {
            if (value.src !== "") {
                let elementImage = `<div class="col-6 m15b">
                        <div class="pick-images">
                            <div class="essential-img essential-icon-img border-0">
                                <img src="`+value.src+`"
                                     class="preview-print-image img-preview-map">
                            </div>
                        </div>
                    </div>`;
                $('#images-info-print').append(elementImage)
            }
        });
        $('#preview-print-map-image-1').prop('src', $('.confirm-image-location-map-1').find('img')[0].src);
        if ($inputImageMap1.prop('files').length !== 0) {
            $('#preview-print-map-image-1').prop('class','img-preview-map');
        }
        $('#preview-print-map-image-2').prop('src', $('.confirm-image-location-map-2').find('img')[0].src);
        if ($inputImageMap2.prop('files').length !== 0) {
            $('#preview-print-map-image-2').prop('class','img-preview-map');
        }
    };

    modules.setValuePreviewPrint = function () {
        $('#preview-print-traffic').html($('input[name=traffic]').val());
        $('#preview-print-area-rent').html($('#confirm-display-area-rent').val());
        $('#preview-print-area-may-rent').html($('#confirm-area-may-rent').val());
        $('#preview-print-ground-area-unit').html($('#confirm-ground-area').val());
        $('#preview-print-total-area-floors-unit').html($('#confirm-total-area-floors').val());
        if ($('#memo-broker').val() == 'ー') {
            $('#preview-print-memo-broker').html("");
        } else {
            $('#preview-print-memo-broker').html($('#memo-broker').val());
        }
        $('#preview-print-area-rental-operating').html($('#confirm-area-rental-operating').val());
        $('#noi-yield').html($('.noi-yield').val());
        if ($('input[name=price]').val() != "") {
            $('#preview-print-price').html('金' + $('input[name=price]').val() + '円');
        } else {
            $('#preview-print-price').html('金0円');
        }
        $.each($(document).find('input[type=checkbox]'), function (key, value) {
            if (value.value == 1) {
                $('#preview-' + value.dataset.display).text($('#'+value.dataset.display+'-hidden').val());
            } else {
                if ($('#'+value.dataset.display).val() == 'ー') {
                    $('#preview-' + value.dataset.display).text("");
                } else {
                    $('#preview-' + value.dataset.display).text($('#'+value.dataset.display).val());
                }
            }
        })
    };

    modules.showPrint = function () {
        if ($('#essential-create-screen').hasClass('has-print')) {
            essentialProperty.switchEssentialScreen(true);
            $('.show-print').click();
        }
    };

    return modules;
}(window.jQuery, window, document));

$(document).ready(function () {
    $('#image-multiple-preview').append(essentialProperty.createImageInfoPreview('images/icon-plus.png', 'img-default', false));
    essentialProperty.setEventSelectImageMap($imageMap1, $inputImageMap1, IMAGE_MAP_1);
    essentialProperty.setEventSelectImageMap($imageMap2, $inputImageMap2, IMAGE_MAP_2);
    essentialProperty.showImageGeneralInfo();

    $('.btn-essential-submit').on('click', function () {
        if (essentialProperty.checkValidate()) {
            essentialProperty.switchEssentialScreen(true);
        }
    });

    $('.btn-essential-confirm-back').on('click', function () {
        essentialProperty.switchEssentialScreen(false);
    });

    $('.btn-essential-confirm-submit').on('click', function () {
        $('#form-data-summary').submit();
    });

    $('input[type="checkbox"]').on('change', function(){
        this.value = this.checked ? 1 : 0;
    });

    $('.btn-preview-print').on('click', function () {
        essentialProperty.showPreviewPrint();
    });

    $('#btn-close-preview-print').on('click', function () {
        essentialProperty.hidePreviewPrint();
    });

    $('.price').on('change', function () {
        if (Common.convertStringToNumber($('.price').val()) === 0) {
            $('.noi-yield').val('0.00%');
        } else {
            $('.noi-yield').val(Common.numberFormat(Common.convertStringToNumber($('.operating-expenses').val()) / Common.convertStringToNumber($('.price').val()) * 100, 2) +'%');
        }
    });

    $('select[name=year]').on('change', function () {
        $('input[name=year]').val($(this).val());
        $('#form-select-year').submit();
    });

    essentialProperty.showPrint();
});
