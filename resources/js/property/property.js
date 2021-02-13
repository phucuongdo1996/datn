var $tableListHouse = $(".table-list-house");
var $loanBankName = $(".loan-bank-name");
var $loanBankBranchPre = $(".loan-bank-branch-pre");

var Property = (function () {
    let modules = {};

    modules.getValueBankName = function () {
        let listBank = require('zengin-code');
        jQuery.each($loanBankName, function (key, item) {
            let code = item.innerHTML.trim();
            let subStr = code.split('/');
            let codeBank = subStr[0];
            let codeBranch = subStr[1];
            if (typeof listBank[codeBank] != 'undefined') {
                let bankName = listBank[codeBank].name;
                let bankBranchName = ''
                let bankBranch = listBank[codeBank]['branches']
                $.each(bankBranch, function (key, value) {
                    if (key == codeBranch) {
                        bankBranchName = '/' + value['name'];
                    }
                });
                item.innerHTML = bankName + bankBranchName;
            } else {
                item.innerHTML = 'ー';
            }
        });

        jQuery.each($loanBankBranchPre, function (key, item) {
            if (item.innerHTML.trim() == 'ー') {
                item.innerHTML = '';
            }
        });
    };

    modules.handleCollapse = function(index, value, number) {
        if (index == number || index == (number + 9)) {
            let element = $(value).children('th');
            $(element).css('padding-right', 0);
            $(element).append('<button type="button" class="btn btn-tool collapse-style float-right p15r pointer btn-collapse-' + index + '">' +
                '<i class="fas fa-minus"></i></button>')
        }
        if (modules.createArrayItemCollapse(number, 8).indexOf(index) >= 0) {
            $(value).addClass('child-collapse-'+number);
        }
        if (modules.createArrayItemCollapse(number + 9, 11).indexOf(index) >= 0) {
            $(value).addClass('child-collapse-'+(number+9));
        }
    };

    modules.createArrayItemCollapse = function(indexParentItem, totalChildItem) {
        let arrayItem = [];
        for (let i = 1; i <= totalChildItem; i++) {
            arrayItem.push(indexParentItem + i);
        }
        return arrayItem;
    };

    modules.btnCollapseOnClick = function(indexParentItem) {
        $('.btn-collapse-'+ indexParentItem).on('click', function () {
            $('.child-collapse-' + indexParentItem).toggleClass("collapse-none");
            $(this).find('i').toggleClass("collapse-hide");
        });
    };

    modules.loadTable = function () {
        $tableListHouse.each(function () {
            let $this = $(this);
            let newrows = [];
            $this.find("tr").each(function () {
                let i = 0;
                $(this).find("td,th").each(function () {
                    i++;
                    if (newrows[i] === undefined) {
                        newrows[i] = $("<tr></tr>");
                    }
                    newrows[i].append($(this));
                });
            });
            $this.find("tr").remove();
            $.each(newrows, function (index, value) {
                if (newrows.length == 57) {
                    Property.handleCollapse(index, value, 18);
                } else {
                    Property.handleCollapse(index, value, 17);
                }
                $this.append(this);
            });
        });
        $("#table-list-house").css('display', 'block');
        $("#pagination-bottom").css('display', 'block');
        $('.main-sidebar').height($('.content-wrapper').height());
        $('p.error-message.error-list-house').html('&nbsp').show();
        Property.getValueBankName();
        $("#table-list-house .div-grey").append('</br>');
        modules.btnCollapseOnClick(17);
        modules.btnCollapseOnClick(18);
        modules.btnCollapseOnClick(26);
        modules.btnCollapseOnClick(27);
        return false;
    };

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

    modules.stringConnection = function (str) {
        let string = '';
        let subStr = str.split(',');
        for (var i = 0; i < subStr.length; i++) {
            string += subStr[i];
        }
        return string;
    };

    modules.handlingUpdateNetProfit = function (dataId, value) {
        $('p.error-message.error-list-house').html('&nbsp').show();
        $('input.input-net-profit').removeClass('input-error');
        let data = new FormData();
        data.append("_token", $('meta[name="csrf-token"]').attr('content'));
        data.append("property_id", dataId);
        data.append("net_profit", value);
        let submitAjax = $.ajax({
            type: "POST",
            url: '/property/update-net-profit/' + dataId,
            data: data,
            processData: false,
            contentType: false,
        });

        submitAjax.done(function (response) {
            if(response.save) {
                $('div[data-id=amount_assessed_taxing' + dataId + ']').html(Common.numberFormat(response.amount_assessed_taxing) + ' 円');
                $('.table-preview td[data-id=amount_assessed_taxing' + dataId + ']').html(Common.numberFormat(response.amount_assessed_taxing) + ' 円');
                $('.table-preview td[data-id=net_profit' + dataId + ']').html(Common.numberFormat(value) + ' %');
            } else {
                alert('システムでの処理中にエラーが発生しました。\n' +
                    '時間を開けて再度お試しください。');
                window.location.reload();
            }
        });

        submitAjax.fail(function (response) {
            if (response && response.responseJSON) {
                $.each(response.responseJSON.errors, function (key, value) {
                    $('p.error-message.error-list-house').html('&nbsp').show();
                    $('p.error-message[data-error=' + key + dataId + ']').text(value).show();
                    $('input.input-net-profit[data-error=net_profit' + dataId + ']').addClass('input-error');
                    if (key == 'property_id') {
                        $('p.error-net-profit').text('').hide();
                    } else if (key == 'net_profit') {
                        $('p.error-property-id').text('').hide();
                    }
                });
            } else {
                alert('システムでの処理中にエラーが発生しました。\n' +
                    '時間を開けて再度お試しください。');
                window.location.reload();
            }
        });
    };

    modules.setHeightColumn = function (className) {
        let maxHeight = 0;
        $(className).each(function(){
            let height = $(this).height();
            if (height > maxHeight) {
                maxHeight = height;
            }
        });
        $(className).height(maxHeight);
    };

    modules.addTittleBorderTopInIE = function () {
        if ((navigator.userAgent.indexOf("MSIE") != -1) || (!!document.documentMode == true)) {
            $(document).find('#table-list-house th').removeClass('fixed');
            $(document).find('#table-list-house th').addClass('tittle-border-right-in-IE');
        }
    };

    modules.addTittleBorderTopInSafari = function () {
        if (navigator.userAgent.indexOf("Safari") != -1) {
            $(document).find('#table-list-house .safari').addClass('tittle-border-top-in-firefox-safari');
            $(document).find('#table-list-house .safari').removeClass('border-top');
        }
    };

    modules.addTittleBorderTopInFirefox = function () {
        if (navigator.userAgent.indexOf("Firefox") != -1) {
            $(document).find('#table-list-house .firefox').addClass('tittle-border-top-in-firefox-safari');
            $(document).find('#table-list-house .firefox').removeClass('border-top');
        }
    };

    modules.setValueDebtBalance = function () {
        $('.debt-balance').each(function (key, value) {
            let id = this.dataset.value,
                year = $('#date-dif-' + id).data('value');
            if (year === 0) {
                $(this).html('0 円');
                $('#debt-balance-'+id).html(Common.numberFormat('0 円'));
            } else {
                let loan = $('#loan-' + id).data('value'),
                    rate = $('#interest-rate-' + id).data('value') / 100,
                    period = $('#contract-loan-period-' + id).data('value');
                if (year >= period) {
                    year = period;
                }
                let valueReturn = Math.round(loan + excelFormulas.CUMPRINC(rate, period, loan, 1, year, 0));
                $(this).html(Common.numberFormat(valueReturn) + ' 円');
                $('#debt-balance-'+id).html(Common.numberFormat(valueReturn) + ' 円');
            }
        });
    };

    return modules;

}(window.jQuery, window, document));

Dropzone.autoDiscover = false;

$(document).ready(function () {
    Property.loadTable();
    Property.setValueDebtBalance();

    $(document).on('change', '.input-net-profit', function () {
        Property.handlingUpdateNetProfit($(this).data('id'), Common.convertStringToNumber($(this).val()));
    });

    $(document).on('keyup', '.input-net-profit', function () {
        let input = $(this).val();
        let subInput = Property.stringConnection(input);
        $(this).val(Property.addCommas(subInput));
    });

    $(document).on('click', '.btn-delete-house', function () {
        let dataId = $(this).data('id');
        $('#confirm-delete-house').modal('show');
        $('#form-delete-house').attr('action', window.location.origin + '/property/delete-house/' + dataId);
    });

    $(document).on('click', '.btn-preview-house', function () {
        setTimeout(function () {
            window.print();
        }, 500);
    });

    $('select[name=subuser_id]').on('change', function () {
        window.location.href = window.origin + '/property?subuser_id=' + $(this).val() + '&proprietor=' + ($('select[name=proprietor]').val() ?? '')
    });

    $('select[name=proprietor]').on('change', function () {
        window.location.href = window.origin + '/property?subuser_id=' + $('select[name=subuser_id]').val() + '&proprietor=' + $(this).val()
    });

    Property.setHeightColumn(".property-code");
    Property.setHeightColumn(".house-name");
    Property.setHeightColumn(".proprietor");
    Property.setHeightColumn(".address-city");
    Property.setHeightColumn(".detail-real-estate-type");
    Property.setHeightColumn(".house-material");
    Property.setHeightColumn(".type-rental");
    Property.setHeightColumn(".deposit-host");
    Property.setHeightColumn(".prize-money");
    Property.setHeightColumn(".room-cede-fee");
    Property.setHeightColumn(".fee-rebuild-rented-house");
    Property.setHeightColumn(".contract-update-fee");
    Property.setHeightColumn(".notes");

    Property.addTittleBorderTopInIE();
    Property.addTittleBorderTopInSafari();
    Property.addTittleBorderTopInFirefox();
});
