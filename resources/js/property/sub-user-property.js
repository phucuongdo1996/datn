const FLAG_ZERO = 0;
const FLAG_ONE = 1;
const FLAG_TWO = 2;
const FLAG_THREE = 3;
const FLAG_FOUR = 4;
const FLAG_FIVE = 5;
const FLAG_SIX = 6;
const FLAG_SEVEN = 7;
const FLAG_EIGHT = 8;

let total = FLAG_ZERO;

var subUserProperty = (function () {
    let modules = {};

    modules.subStringText = function (text) {
        return text.substring(text.indexOf("-") + FLAG_ONE, text.lastIndexOf("-"));
    };

    modules.setValuePermissionChecked = function (classInput, className1, className2 = null) {
        let value = parseInt($(classInput).val());
        switch (subUserProperty.subStringText(className1)) {
            case 'view':
                $(classInput).val(value + FLAG_ONE);
                break;
            case 'edit':
                $(className2).prop("checked") === true ? $(classInput).val(value + FLAG_ONE) : $(classInput).val(value + FLAG_TWO);
                break;
            case 'delete':
                $(className2).prop("checked") === true ? $(classInput).val(value + FLAG_TWO) : $(classInput).val(value + FLAG_THREE);
                break;
            case 'report':
                $(className2).prop("checked") === true ? $(classInput).val(value + FLAG_FOUR) : $(classInput).val(value + FLAG_FIVE);
                break;
            default:
                break;
        }
    };

    modules.setValuePermissionUnchecked = function (className1, className2) {
        let value = $(className1).val();
        switch (subUserProperty.subStringText(className2)) {
            case 'view':
                $(className1).val(FLAG_ZERO);
                break;
            case 'edit':
                $(className1).val(value - FLAG_ONE);
                break;
            case 'delete':
                $(className1).val(value - FLAG_TWO);
                break;
            case 'report':
                $(className1).val(value - FLAG_FOUR);
                break;
            default:
                break;
        }
    };

    modules.handleChecked = function (classInput, className1, className2 = null) {
        $(className1).click(function(){
            if($(this).prop("checked") == true){
                if (subUserProperty.subStringText(className1) === 'view') {
                    modules.setValuePermissionChecked(classInput, className1);
                } else {
                    modules.setValuePermissionChecked(classInput, className1, className2);
                    $(className2).prop("checked", true);
                }
            }
        });
    };

    modules.handleUnchecked = function (classInput, className, arrClassName = null ) {
        $(className).click(function(){
            if($(this).prop("checked") == false){
                if (subUserProperty.subStringText(className) !== 'view') {
                    subUserProperty.setValuePermissionUnchecked(classInput, className)
                } else {
                    $(arrClassName[FLAG_ZERO]).prop("checked", false);
                    $(arrClassName[FLAG_ONE]).prop("checked", false);
                    $(arrClassName[FLAG_TWO]).prop("checked", false);
                    subUserProperty.setValuePermissionUnchecked(classInput, className)
                }
            }
        });
    };

    modules.handleCheckedCheckBox = function (classInput, arrClassName) {
        switch (parseInt($(classInput).val())) {
            case FLAG_ONE:
                $(arrClassName[FLAG_ZERO]).prop("checked", true);
                break;
            case FLAG_TWO:
                $(arrClassName[FLAG_ZERO]).prop("checked", true);
                $(arrClassName[FLAG_ONE]).prop("checked", true);
                break;
            case FLAG_THREE:
                $(arrClassName[FLAG_ZERO]).prop("checked", true);
                $(arrClassName[FLAG_TWO]).prop("checked", true);
                break;
            case FLAG_FOUR:
                $(arrClassName[FLAG_ZERO]).prop("checked", true);
                $(arrClassName[FLAG_ONE]).prop("checked", true);
                $(arrClassName[FLAG_TWO]).prop("checked", true);
                break;
            case FLAG_FIVE:
                $(arrClassName[FLAG_ZERO]).prop("checked", true);
                $(arrClassName[FLAG_THREE]).prop("checked", true);
                break;
            case FLAG_SIX:
                $(arrClassName[FLAG_ZERO]).prop("checked", true);
                $(arrClassName[FLAG_ONE]).prop("checked", true);
                $(arrClassName[FLAG_THREE]).prop("checked", true);
                break;
            case FLAG_SEVEN:
                $(arrClassName[FLAG_ZERO]).prop("checked", true);
                $(arrClassName[FLAG_TWO]).prop("checked", true);
                $(arrClassName[FLAG_THREE]).prop("checked", true);
                break;
            case FLAG_EIGHT:
                $(arrClassName[FLAG_ZERO]).prop("checked", true);
                $(arrClassName[FLAG_ONE]).prop("checked", true);
                $(arrClassName[FLAG_TWO]).prop("checked", true);
                $(arrClassName[FLAG_THREE]).prop("checked", true);
                break;
            default:
                break;
        }
    };

    modules.enableBtnCreate = function (className1, className2) {
        $(className1).on('click', function () {
            $(className2).attr('disabled', false);
        });
    };

    return modules;
}(window.jQuery, window, document));

$(document).ready(function () {
    let totalProperty = $("input[name='total_property']").val();
    let totalUser = $("input[name='total_user']").val();
    for (let i = 0; i<totalProperty; i++) {
        for (let j=0; j<totalUser; j++) {
            subUserProperty.enableBtnCreate('.permission-view-'+i+j, '.btn-create-sub-property-'+i);
            subUserProperty.enableBtnCreate('.permission-edit-'+i+j, '.btn-create-sub-property-'+i);
            subUserProperty.enableBtnCreate('.permission-delete-'+i+j, '.btn-create-sub-property-'+i);
            subUserProperty.enableBtnCreate('.permission-report-'+i+j, '.btn-create-sub-property-'+i);

            subUserProperty.handleCheckedCheckBox('.permission-' + i + j, ['.permission-view-'+i+j, '.permission-edit-'+i+j, '.permission-delete-'+i+j, '.permission-report-'+i+j]);

            subUserProperty.handleChecked('.permission-'+i+j, '.permission-view-'+i+j);
            subUserProperty.handleChecked('.permission-'+i+j, '.permission-edit-'+i+j, '.permission-view-'+i+j);
            subUserProperty.handleChecked('.permission-'+i+j, '.permission-delete-'+i+j, '.permission-view-'+i+j);
            subUserProperty.handleChecked('.permission-'+i+j, '.permission-report-'+i+j, '.permission-view-'+i+j);

            subUserProperty.handleUnchecked('.permission-'+i+j, '.permission-view-'+i+j, ['.permission-edit-'+i+j, '.permission-delete-'+i+j, '.permission-report-'+i+j]);
            subUserProperty.handleUnchecked('.permission-'+i+j, '.permission-edit-'+i+j);
            subUserProperty.handleUnchecked('.permission-'+i+j, '.permission-delete-'+i+j);
            subUserProperty.handleUnchecked('.permission-'+i+j, '.permission-report-'+i+j);
        }
    }

    $('.btn-create-sub-property').on('click', function () {
        $('.btn-create-sub-property').css('pointer-events', 'none');
    });
});
