const USES = ['オフィスビル_事務所', 'レジデンス_住宅', 'リテール_店舗', 'ホテル・旅館', 'ロジスティックス_倉庫', '工場・作業所・データセンター', '病院・診療所', 'ヘルスケア', '土地_及び構築物', '底地_借地権付の土地の所有権'];
const BASE_URL_ICON_01 = window.location.origin + '/images/marker/scatter_01.svg';
const BASE_URL_ICON_02 = window.location.origin + '/images/marker/scatter_02.svg';
const BASE_URL_ICON_03 = window.location.origin + '/images/marker/scatter_03.svg';
const BASE_URL_ICON_04 = window.location.origin + '/images/marker/scatter_04.svg';
const BASE_URL_ICON_05 = window.location.origin + '/images/marker/scatter_05.svg';

const FORMULAS_ES_INHERITANCE_TAX_VALUATION_PARAM_1 = 0.7;
const FORMULAS_ES_INHERITANCE_TAX_VALUATION_PARAM_2 = 0.8;

const AUTO_CORRECTION_FACTOR = 0.7;

var Common = (function () {
    let modules = {};

    modules.addCommas = function (nStr) {
        nStr += '';
        let x = nStr.split('.');
        let x1 = x[0];
        let x2 = x.length > 1 ? '.' + x[1] : '';
        let rgx = /(\d+)(\d{3})/;
        while (rgx.test(x1)) {
            x1 = x1.replace(rgx, '$1' + ',' + '$2');
        }
        return x1 + x2;
    };

    modules.cleaveNumeral = function () {
        modules.cleaveNumeralDecimal('convert-number-double-decimal', 2);
        modules.cleaveNumeralDecimal('convert-number-single-decimal', 1);
        modules.cleaveNumeralDecimal('convert-data', 0);
    };

    modules.cleaveNumeralDecimal = function (className, decimal) {
        $('.' + className).on('focus', function () {
            if ($(this).is('[readonly]')) {
                return
            }
            if (modules.numberFormat(modules.convertStringToNumber($(this).val()).toFixed(decimal)) == 0) {
                $(this).val('');
            }
        });
        $('.' + className).on('change focusout', function () {
            $(this).val(modules.numberFormat(modules.convertStringToNumber($(this).val()).toFixed(decimal), decimal));
        });
        $("body").find('.' + className).each(function (i, e) {
            new Cleave($(this), {
                numeral: true,
                numeralThousandsGroupStyle: 'thousand'
            });
        })
    };

    modules.Numeral = function () {
        $("body").find('.convert-data').each(function (i, e) {
            let price = $(this).val();
            price = price.split(",").join("");
            $(this).val(price);
        });
    };

    modules.convertNumeralForForm =function($formData) {
        $("body").find('.convert-data, .convert-number-double-decimal, .convert-number-single-decimal').each(function (i, e) {
            let price = $(this).val();
            if (price == "") {
                $formData.append($(this).prop('name'), 0);
            } else {
                price = price.split(",").join("");
                $formData.append($(this).prop('name'), price);
            }
        });
    };

    modules.convertStringToNumber = function (str) {
        if (str == null || str == "") {
            return 0;
        }
        return parseFloat(str.toString().split(',').join(''));
    };

    modules.numberFormat = function (number, decimals, dec_point, thousands_point) {
        if (number == null || !isFinite(number)) {
            return 0;
        }
        if (!decimals) {
            let len = number.toString().split('.').length;
            decimals = len > 1 ? len : 0;
        }
        if (!dec_point) {
            dec_point = '.';
        }
        if (!thousands_point) {
            thousands_point = ',';
        }
        number = parseFloat(number).toFixed(decimals);
        number = number.replace(".", dec_point);
        let splitNum = number.split(dec_point);
        splitNum[0] = splitNum[0].replace(/\B(?=(\d{3})+(?!\d))/g, thousands_point);
        number = splitNum.join(dec_point);
        return number;
    };

    modules.divisionNumber = function (value1, value2) {
      if (!value1 || !value2 || value1 == "" || value2 == "" || value2 == 0) {
          return 0;
      }
      return value1 / value2;
    };

    modules.optionDateTime = function () {
        $('.date-time').datepicker({
            format: 'dd/mm/yyyy',
            language: "en",
            forceParse: false,
            useCurrent: false,
        });
    };

    modules.clearMessageValidate = function () {
        $('p.error-message').text('');
        $('input.input-error').removeClass('input-error');
        $('.fail-login').hide();
    };

    modules.showMessageValidate = function (messageList) {
        modules.clearMessageValidate();
        $.each(messageList, function (key, value) {
            $('p.error-message[data-error=' + key + ']').text(value).show();
            $('input[name=' + key + ']').addClass('input-error');
        });
    };

    modules.sortTable = function(index, tableClassWithTr, tablePrevievWithTr, number) {
        // table has row total(sum) number = 2 else number = 1
        let rows, switching, i, x, y, shouldSwitch, dir, switchCount = 0, rowsPreview;
        switching = true;
        dir = "asc";
        while (switching) {
            switching = false;
            rows = $(document).find(tableClassWithTr);
            if (tablePrevievWithTr != null) {
                rowsPreview = $(document).find(tablePrevievWithTr);
            }
            if (dir == "asc") {
                $('span[data-id='+index+']').html('<i class="fa-sort-icon fa fa-caret-down" aria-hidden="true"></i>');
            } else {
                $('span[data-id='+index+']').html('<i class="fa-sort-icon fa fa-caret-up" aria-hidden="true"></i>');
            }
            for (i = 1; i < (rows.length - number); i++) {
                shouldSwitch = false;
                x = rows[i].getElementsByTagName("TD")[index];
                y = rows[i + 1].getElementsByTagName("TD")[index];
                if (dir == "asc") {
                    if (!isNaN(parseFloat($(x).attr('data-value'))) && !isNaN(parseFloat($(y).attr('data-value')))) {
                        if (parseFloat($(x).attr('data-value')) > parseFloat($(y).attr('data-value'))) {
                            shouldSwitch= true;
                            break;
                        }
                    } else if (typeof $(x).attr('data-text') != 'undefined') {
                        if ($(x).attr('data-text').toLowerCase().trim().replace(/円|年|%|/gi, '') > $(y).attr('data-text').toLowerCase().trim().replace(/円|年|%|/gi, '')) {
                            shouldSwitch= true;
                            break;
                        }
                    } else {
                        if (x.innerHTML.toLowerCase().trim().replace(/円|年|%|/gi, '') > y.innerHTML.toLowerCase().trim().replace(/円|年|%|/gi, '')) {
                            shouldSwitch= true;
                            break;
                        }
                    }
                } else if (dir == "desc") {
                    if (!isNaN(parseFloat($(x).attr('data-value'))) && !isNaN(parseFloat($(y).attr('data-value')))) {
                        if (parseFloat($(x).attr('data-value')) < parseFloat($(y).attr('data-value'))) {
                            shouldSwitch= true;
                            break;
                        }
                    } else if (typeof $(x).attr('data-text') != 'undefined') {
                        if ($(x).attr('data-text').toLowerCase().trim().replace(/円|年|%|/gi, '') < $(y).attr('data-text').toLowerCase().trim().replace(/円|年|%|/gi, '')) {
                            shouldSwitch= true;
                            break;
                        }
                    } else {
                        if (x.innerHTML.toLowerCase().trim().replace(/円|年|%|/gi, '') < y.innerHTML.toLowerCase().trim().replace(/円|年|%|/gi, '')) {
                            shouldSwitch = true;
                            break;
                        }
                    }
                }
            }
            if (shouldSwitch) {
                rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                if (tablePrevievWithTr && rowsPreview.length !== 0) {
                    rowsPreview[i].parentNode.insertBefore(rowsPreview[i + 1], rowsPreview[i]);
                }
                switching = true;
                switchCount ++;
            } else {
                if (switchCount == 0 && dir == "asc") {
                    dir = "desc";
                    switching = true;
                }
            }
        }
    };

    modules.showPrint = function (object, buttonPrint) {
        if (object.hasClass('has-print')) {
            buttonPrint.click();
        }
    };

    modules.displayDetailPhoto = function () {
        $('.photo_modal').on('shown.bs.modal', function (event) {
            $(this).find('.img').animate({opacity:1},300);
            if ($('.img_item').length > 1) {
                $(this).find('.img').slick({
                    prevArrow : '<a href="javascript:void(0);" class="slick-prev"><img src="' + window.location.origin + '/images/a_l.png" alt="" /></a>',
                    nextArrow : '<a href="javascript:void(0);" class="slick-next"><img src="' + window.location.origin + '/images/a_r.png" alt="" /></a>'
                });
            }
        });

        $('.photo_modal').on('hidden.bs.modal', function (event) {
            $(this).find('.img').animate({opacity:0},300);
            $(this).find('.img').slick('unslick');
        });
    };

    modules.buildUrlRequest = function (path) {
        if ($('#admin-site').length) {
            return '/admin' + path;
        }
        return path;
    };

    modules.onlyAcceptNumbers = function () {
        let regExp = /[0-9]/;
        $('.block-out-character').on('keypress', function(e) {
            let value = String.fromCharCode(e.which) || e.key;
            if (!regExp.test(value) && e.which != 44) {
                e.preventDefault();
                return false;
            }
        });

    };

    modules.getValueItem = function (name) {
        return Common.convertStringToNumber($(':input[name="'+name+'"]').val());
    };

    modules.getValueOperatingItem = function (arrItem) {
        let arrOperatingItem = [];
        $.each(arrItem, function (index, item) {
            if (item === 'bad_debt') {
                arrOperatingItem.push(Common.getValueItem(item) * -1);
            } else {
                arrOperatingItem.push(Common.getValueItem(item));
            }
        });
        return arrOperatingItem;
    };

    modules.excelRound = function (value, places) {
        value = modules.convertStringToNumber(value);
        places = modules.convertStringToNumber(places);
        let pow = Math.pow(10, -places);
        return Math.round(value / pow) * pow;
    };

    modules.excelRoundDown = function (value) {
        value = modules.convertStringToNumber(value);
        if (value < 0) {
            return 0;
        }
        value = Math.floor(value);
        let pow = Math.pow(10, 1 - value.toString().length);
        return Math.floor(value * pow) / pow;
    };

    modules.roundByPosition = function (value, position) {
      let positionValue = Math.pow(10, position);
      return Math.floor(value / positionValue) * positionValue;
    };

    return modules;
}(window.jQuery, window, document));

$(document).ready(function () {
    Common.cleaveNumeral();
    Common.optionDateTime();
    Common.onlyAcceptNumbers();

    $('.form-data-submit').on('submit', function () {
        $(this).find('button[type=submit]').prop('disabled', true);
    });
});
