var btnSaveSort;
var className;
var url;
var arr = {};
var setKeyRowChange = 1;
var flagOne = 1;
var $loanBankBranch = $(".loan-bank-branch-sort");

var sort = (function () {
    let modules = {};

    modules.portfolioArrangement = function (className) {
        $("."+ className +" .up, ."+ className +" .down").click(function () {
            var row = $(this).parents("tr:first");
            if ($(this).is(".up")) {
                if(row[0].rowIndex != flagOne) {
                    row.insertBefore(row.prev());
                    $(this).closest('.keep-all').attr('data-key', setKeyRowChange);
                    $(this).closest('.keep-all').next().attr('data-key', setKeyRowChange);
                }
            } else {
                row.insertAfter(row.next());
                $(this).closest('.keep-all').attr('data-key', setKeyRowChange);
                $(this).closest('.keep-all').prev().attr('data-key', setKeyRowChange);
            }

            $('.'+ className +' .keep-all td:first-child').each(function(index) {
                $(this).text(index+flagOne);
            });
        });
    };

    modules.getArrDataAfterSort = function(className) {
        let row = $('.'+ className +' tr.keep-all');
        $.each(row, function (key, value) {
            if ($(value).closest('.keep-all').data('key') == setKeyRowChange) {
                if ($(value).closest('.keep-all').data('order') != (key+flagOne)) {
                    arr[key+flagOne] = {
                        id : $(value).closest('.keep-all').data('id'),
                        order : key+flagOne,
                    };
                }
            }
        });
        return arr;
    };

    modules.updateOrder = function (data, url) {
        let submitAjax = $.ajax({
            type: "POST",
            url: 'update-order',
            data: data,
        });

        submitAjax.done(function (response) {
            if (response.updated == true) {
                window.location.href = url;
            } else {
                window.location.reload();
            }
        });

        submitAjax.fail(function (response) {
        });
    };

    modules.save = function (btnSave, className, url) {
        $(btnSave).on('click ', function () {
            let data = sort.getArrDataAfterSort(className);
            sort.updateOrder(data, url);
        });
    };

    modules.sortByOrderProperty = function (btnSaveSort, className, url) {
        sort.portfolioArrangement(className);
        sort.save(btnSaveSort, className, url);
    };

    modules.getValueBankName = function () {
        let listBank = require('zengin-code');
        jQuery.each($loanBankBranch, function (key, item) {
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
    };

    return modules;
}(window.jQuery, window, document));

$(document).ready(function () {
    sort.sortByOrderProperty(btnSaveSort='.btn-save-sort', className='table-sort', url='/property/portfolio-analysis');
    sort.sortByOrderProperty(btnSaveSort='.btn-save-borrowing-sort', className='table-borrowing-sort', url='/property/borrowing');
    sort.getValueBankName();
    $(".loan-bank-branch-sort").removeClass('d-none');
});
