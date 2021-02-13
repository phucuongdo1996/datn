var tax = (function () {
    let modules = {};

    modules.handlingData = function () {
        let totalExpenses = 0,
            totalIncome = 0;
        $('.input-income').each(function () {
            totalIncome += Common.convertStringToNumber($(this).val());
        });

        $('.input-expenses').each(function () {
            if ($(this).val() == '＊＊＊') {
                totalExpenses += 0;
            } else {
                totalExpenses += Common.convertStringToNumber($(this).val());
            }
        });
        $('#item4').val(Common.addCommas(totalIncome));
        $('#item18').val(Common.addCommas(totalExpenses));
        let valueItem19 = totalIncome - totalExpenses;
        $('#item19').val(Common.addCommas(valueItem19));
    };

    modules.getDataExample = function (listChecked, year) {
        $.ajax({
            type: 'POST',
            url: '/property/confirm-final/data-example',
            data: {
                'id': listChecked,
                'year': year,
                '_token': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                if(response && response.data) {
                    let data = response.data;
                    $('input[name=total_rent]').val(Common.addCommas(
                        parseInt(data.total_rent_income) +
                        parseInt(data.total_revenue_land_taxes) +
                        parseInt(data.total_parking_revenue) +
                        parseInt(data.total_general_services)));
                    $('input[name=total_key_money]').val(Common.addCommas(parseInt(data.total_income_input_money) + parseInt(data.total_income_update_house_contract)));
                    $('input[name=total_other_income]').val(Common.addCommas(parseInt(data.total_utilities_revenue) + parseInt(data.total_other_income)));
                    $('input[name=total_taxes_dues]').val(Common.addCommas(parseInt(data.total_taxes_dues)));
                    $('input[name=total_insurance_premium]').val(Common.addCommas(parseInt(data.total_insurance_premium)));
                    $('input[name=total_repair_costs]').val(Common.addCommas(parseInt(data.total_repair_fee) + parseInt(data.total_intact_reply_fee)));
                    $('input[name=total_land_tax]').val(Common.addCommas(parseInt(data.total_land_tax)));
                    $('input[name=total_management_fee]').val(Common.addCommas(parseInt(data.total_management_fee)));
                    $('input[name=total_utilities_fee]').val(Common.addCommas(parseInt(data.total_utilities_fee)));
                    $('input[name=total_asset_management_fee]').val(Common.addCommas(parseInt(data.total_asset_management_fee)));
                    $('input[name=total_tenant_recruitment_fee]').val(Common.addCommas(parseInt(data.total_tenant_recruitment_fee)));
                    $('input[name=total_bad_debt_losses]').val(Common.addCommas(parseInt(data.total_bad_debt_losses)));
                    $('input[name=other_expenses]').val(Common.addCommas(parseInt(data.other_expenses)));
                    tax.handlingData();
                    $('.content-property').empty();
                    $('.content-property').append(response.propertyChecked);
                }
            }
        });
    };

    modules.handlingUpdateOrCreate = function (url, data) {
        $('.form-control').removeClass('input-error');
        $.ajax({
            type: 'POST',
            url: url,
            processData: false,
            contentType: false,
            data: data,
            success: function (response) {
                if(response) {
                    if(response.result && response.redirect) {
                        window.location.href = '/' + response.redirect;
                    } else {
                        window.location.reload();
                    }
                }
            },
            error: function (error) {
                if (error && error.status == 422) {
                    if (error.responseJSON) {
                        jQuery.each(error.responseJSON.errors, function (key, val) {
                            $('.error_' + key).html(val);
                            $("[name = '" + key + "' ]").addClass('input-error');
                            if (key == 'year' || key == 'month') {
                                $('.has-error-confirm').css({'display':'block'});
                            }
                        });
                        $('html, body').animate({
                            scrollTop: (
                                $(document).find('.input-error').offset().top - 300
                            )
                        }, 0);
                    }
                }
                $('.btn-edit-tax-form').prop('disabled', false);
                $('.btn-submit-tax-form').prop('disabled', false);
            }
        });
    };

    modules.handlingInputSearch = function () {
        $('.input-income').each(function () {
            $(this).val('0')
        });

        $('.input-expenses').each(function () {
            if ($(this).val() != '＊＊＊') {
                $(this).val('0')
            }
        });
        $('#content-property-owner').html('');
        $('.content-property').empty();
        tax.handlingData();
    };

    modules.searchHouseFollowYear = function (value, valueMonth) {
        $.ajax({
            type: 'POST',
            url: '/property/confirm-final/data-house-example',
            data: {
                'year': value,
                'month': valueMonth,
                'proprietor': $('#select-proprietor').val(),
            },
            success: function (response) {
                if(response.data) {
                    $('.list-house-tax').empty();
                    $('.list-house-tax').append(response.data)
                }
            }
        });
    };

    modules.getViewPreview = function (year, month, url) {
        if(month != '') {
            $('.time-default').val(month != 12 ? (parseInt(month)) + 1 : 1);
            $('.month-preview').val(month);
        }

        $.ajax({
            type: 'GET',
            url: url,
            data: {
                'year': year,
                'month': month,
            },
            success: function (response) {
                if(response.data) {
                    let data = response.data;
                    $('.date-time-format-tax').html(data.date_format_tax);
                    $('.day-of-month').val(data.day_of_month);
                    $('.year-label').html(data.year_label);
                    $('.date-of-year-label').val(data.date_of_year_label);
                }
            }
        });
    };

    modules.getDataProprietor = function () {
        let data = new FormData();
        data.append("_token", $('meta[name="csrf-token"]').attr('content'));
        data.append("year", $('#select-year').val());
        data.append("month", $('#select-month').val());
        let submitAjax = $.ajax({
            type: "POST",
            url: '/document/confirm-final/get-list-proprietor',
            data: data,
            processData: false,
            contentType: false
        });
        submitAjax.done(function (response) {
            $('#select-proprietor').html('');
            $('#select-proprietor').append('<option class="m20r m20l" value="">---</option>');
            $.each(response.data, function (key, value) {
                $('#select-proprietor').append('<option class="m20r m20l" value="' + value.proprietor + '">' + value.proprietor + '</option>');
            })
        });
        submitAjax.fail(function (response) {

        });
    };

    modules.proccessChangeSelect = function () {
        let value = $('#select-year').val();
        let valueMonth = $('#select-month').val();
        if(value != '' && valueMonth != '') {
            modules.searchHouseFollowYear(value, valueMonth);
            $('#btn-select-house').prop('disabled', false);
        } else {
            $('#btn-select-house').prop('disabled', true);
        }
        modules.handlingInputSearch();
    };

    return modules;
}(window.jQuery, window, document));

$(document).ready(function () {
    tax.handlingData();

    $(document).on('click', '.btn-submit-tax-form', function () {
        $('.btn-submit-tax-form').prop('disabled', true);
        let listChecked = [];
        $('.checkbox-choose-house').each(function () {
            if ( $(this).is(':checked') == true) {
                listChecked.push($(this).data('id'));
            }
        });
        let data = new FormData($('#tax-form')[0]);
        Common.convertNumeralForForm(data);
        data.append('salary_wage', 0);
        data.append('borrowing_interest', 0);
        data.append('depreciation', 0);
        if(listChecked.length > 0) {
            for(let i = 0; i < listChecked.length; i++) {
                data.append('property_id[' + i + ']', listChecked[i]);
            }
        }

        tax.handlingUpdateOrCreate('/document/confirm-final', data)
    });

    $(document).on('click', '.btn-delete-tax', function () {
        $(".title-delete-tax span").remove();
        let dataId = $(this).data('id');
        let value = $(this).data('value');
        $('#confirm-delete-tax').modal('show');
        $('.title-delete-tax').append('<span>'+value + ' 確定申告書書式を削除します。よろしいですか？'+'</span>');
        $('#form-delete-tax').attr('action', window.location.origin + '/document/confirm-final/delete-tax/' + dataId + '?option_paginate='+ $('.option-paginate-list').val() + '&page=' + $('.page-list').val());

    });

    $(document).on('click', '.btn-edit-tax-form', function () {
        $('.btn-edit-tax-form').prop('disabled', true);
        let id = $('input[name=tax_id]').val();

        let listChecked = [];
        $('.checkbox-choose-house').each(function () {
            if ( $(this).is(':checked') == true) {
                listChecked.push($(this).data('id'));
            }
        });
        let data = new FormData($('#tax-form')[0]);
        Common.convertNumeralForForm(data);
        data.append('salary_wage', 0);
        data.append('borrowing_interest', 0);
        data.append('depreciation', 0);
        data.append('year', $('#select-year').val());
        data.append('month', $('#select-month').val());
        if(listChecked.length > 0) {
            for(let i = 0; i < listChecked.length; i++) {
                data.append('property_id[' + i + ']', listChecked[i]);
            }
        }

        tax.handlingUpdateOrCreate('/document/confirm-final/' + id, data)
    });

    $(document).on('change', '#tax-form', function () {
        tax.handlingData();
    });

    $(document).on('focusout', '#tax-form', function () {
        tax.handlingData();
    });

    $(document).on( 'click', '.dropdown-menu .parent-checkbox', function() {
        let checkBoxes = $(this).find('input[type="checkbox"]')
        checkBoxes.prop("checked", !checkBoxes.prop("checked"));
        return false;
    });

    $(document).on('click', '#btn-select-house', function () {
        $('.btn-submit-tax-form').prop('disabled', true);
        $('.btn-edit-tax-form').prop('disabled', true);
    });

    $('#popup-list').on('hide.bs.dropdown', function () {
        let listChecked = [];
        let year = $('#select-year').val();
        $('.checkbox-choose-house').each(function () {
            if ( $(this).is(':checked') == true) {
                listChecked.push($(this).data('id'));
            }
        });

        if(listChecked.length > 0) {
            tax.getDataExample(listChecked, year);
        } else {
            tax.handlingInputSearch();
        }
        $('.btn-submit-tax-form').prop('disabled', false);
        $('.btn-edit-tax-form').prop('disabled', false);
    });

    $(document).on('click', '.pre-print', function () {
        let year = $('#select-year').val();
        let month = $('#select-month').val();
        let inputs = $('#tax-form').find(':input:disabled');
        inputs.prop('disabled', false);
        tax.getViewPreview(year, month, '/document/confirm-final/get-data-preview');
        let data = $('#tax-form').serializeArray();
        for (let i = 0; i < data.length; i ++) {
            $('.td-' + data[i].name).html(data[i].value);
        }
        $('#td-item4').html($('#item4').val());
        $('#td-item18').html($('#item18').val());
        $('#td-item19').html($('#item19').val());
        $('#content-property-owner').html($('#select-proprietor').val());
        inputs.prop('disabled', true);
        setTimeout(function () {
            window.print();
        }, 500);
    });

    $(document).on('change', '.select-paginate', function () {
        $('.select-paginate').val($(this).val());
        $('#form-condition-1').submit();
    });

    $('#select-year, #select-month').on('change', function () {
        tax.getDataProprietor();
    });

    $('#select-month, #select-year, #select-proprietor').on('change', function () {
        tax.proccessChangeSelect();
    });

    Common.showPrint($('.container-wrapper-confirm'), $('.show-print'));

    $('.centered-vertical .sort-icon').on('click', function () {
        $('.centered-vertical .sort-icon').removeClass('sort-icon-first');
        Common.sortTable($(this).data('id'), '.table-tax tr', '.table-tax tr', 1);
        $(this).addClass('sort-icon-first');
    });
});
