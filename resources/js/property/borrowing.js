const CHARTBORROWING = [1, 7, 13, 19, 25, 31, 37, 43, 49, 55];

var $loanBankBranch = $(".loan-bank-branch");
var $loanBankBranchPre = $(".loan-bank-branch-pre");

var borrowing = (function () {
    let modules = {};

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
        jQuery.each($loanBankBranchPre, function (key, item) {
            if (item.innerHTML.trim() == 'ー') {
                item.innerHTML = '';
            }
        });
    };

    modules.loadPageBorrowing = function () {
        borrowing.getValueBankName();
        $(".loan-bank-branch").removeClass('d-none');
    };
    return modules;
}(window.jQuery, window, document));

var highChartBorrowing = (function () {
    let modules = {};
    modules.loadCharts = function (data) {
        let index = data.from;
        jQuery.each(data.data, function (key, item) {
            let no = '';
            if(index < 10) {
                no = '00' + index;
            } else if(index < 100) {
                no = '0' + index;
            }
            let listYear = commonHighcharts.setCategoriesColumnChart(35);
            let listPPMT = commonHighcharts.calculateRepayment(item.loan, item.contract_loan_period, item.interest_rate/100, 1, item.years_passed);
            let listCF = commonHighcharts.calculateCF(item.total_revenue - item.total_cost, item.loan, item.contract_loan_period, item.interest_rate/100, item.years_passed);
            let listCFGrandTotal = commonHighcharts.calculateGrandTotalCF(item.total_revenue - item.total_cost, item.loan, item.contract_loan_period, item.interest_rate/100, item.years_passed);
            let dataSeries = [];
            dataSeries.push(commonHighcharts.setItemColumnChart('ローン残高(右軸)', 'column', 1, '#4F81BD', listPPMT, ' 万円'));
            dataSeries.push(commonHighcharts.setItemColumnChart('累計CF(右軸)', 'column', 1, '#EE72DC', listCFGrandTotal, ' 万円'));
            dataSeries.push(commonHighcharts.setItemColumnChart('CF(左軸)', 'line', 0, '#FF0000', listCF, ' 万円'));
            $('.chart-block').append(
                `<div id="chart-borrowing`+ item.id +`" class="chart-borrowing col-xl-4 m-0 mb-3">
                     <div class="borrowing-diagram-block borrowing-h272">
                         <p class="title-diagram color-title-chart">CFシミュレーション(物件NO.` + no + `)</p>
                         <div id="chart`+ item.id +`"></div>
                         <p class="highcharts-des fs7 highcharts-note m15l">* １当シミュレーション結果は、あくまでも目安としてご利用ください。</p>
                         <p class="highcharts-des fs7 highcharts-note m15l">* ２入居率の変動、賃料収入の経年下落、大規模修繕費、減価償却費、所得税については考慮外としておりますので、詳細な試算の際にはご留意ください。</p>
                     </div>
                </div>`);
            highChartBorrowing.handlingAppendDataPreview(index, item.id, no);
            let title = 'C F シミュレーショ   ン';
            commonHighcharts.buildColumnChart('chart'+ item.id , title, listYear , '（万円 )', '（万円 )', dataSeries);
            commonHighcharts.buildColumnChartPreview('chart-preview'+ item.id , title, listYear , '（万円 )', '（万円 )', dataSeries);
            index++;
        });
    };

    modules.getDataChartAll = function () {
        let listIdChecked = $("input:checkbox[name=id-chart]:checked").map(function () {
            return this.dataset.id;
        }).get();
        let formdata = new FormData();
        formdata.append("_token", $('meta[name="csrf-token"]').attr('content'));
        formdata.append("list_id_checked", JSON.stringify(listIdChecked));
        let submitAjax = $.ajax({
            type: "POST",
            url: '/property/borrowing/get-data-borrowing',
            data: formdata,
            processData: false,
            contentType: false,
        });

        submitAjax.done(function (response) {
            modules.loadChartAllData(JSON.parse(response.data));
        });

        submitAjax.fail(function (response) {
            alert('システムでの処理中にエラーが発生しました。\n' + '時間を開けて再度お試しください。');
        });
    };

    modules.loadChartAllData = function (data) {
        let dataYear = commonHighcharts.setCategoriesColumnChart(35);
        let totalListPPMT = [];
        let totalListCF = [];
        let totalListCFGrandTotal = [];
        jQuery.each(data, function (key, item) {
            let listPPMT = commonHighcharts.calculateRepayment(item.loan, item.contract_loan_period, item.interest_rate/100, 1, item.years_passed);
            let listCF = commonHighcharts.calculateCF(item.total_revenue - item.total_cost, item.loan, item.contract_loan_period, item.interest_rate/100, item.years_passed);
            let listCFGrandTotal = commonHighcharts.calculateGrandTotalCF(item.total_revenue - item.total_cost, item.loan, item.contract_loan_period, item.interest_rate/100, item.years_passed);
            totalListPPMT.push(listPPMT);
            totalListCF.push(listCF);
            totalListCFGrandTotal.push(listCFGrandTotal);
        });
        let allPPMT = [];
        let allCF = [];
        let allCFGrandTotal = [];
        for (let i = 0; i < 35; i++) {
            let totalPPMT = 0;
            let totalCF = 0;
            let totalCFGrandTotal = 0;
            for (let j = 0; j < totalListPPMT.length; j++) {
                totalPPMT += totalListPPMT[j][i]
            }

            for (let j = 0; j < totalListCF.length; j++) {
                totalCF += totalListCF[j][i]
            }

            for (let j = 0; j < totalListCFGrandTotal.length; j++) {
                totalCFGrandTotal += totalListCFGrandTotal[j][i]
            }

            allPPMT.push(Number(totalPPMT.toFixed(1)));
            allCF.push(Number(totalCF.toFixed(1)));
            allCFGrandTotal.push(Number(totalCFGrandTotal.toFixed(1)));
        }
        let series = [];
        series.push(commonHighcharts.setItemColumnChart('ローン残高(右軸)', 'column', 1, '#4F81BD', allPPMT, ' 万円'));
        series.push(commonHighcharts.setItemColumnChart('累計CF(右軸)', 'column', 1, '#EE72DC', allCFGrandTotal, ' 万円'));
        series.push(commonHighcharts.setItemColumnChart('CF(左軸)', 'line', 0, '#FF0000', allCF, ' 万円'));
        let titleAll = 'CFシミュレーション';
        commonHighcharts.buildColumnChart('chart-all' , titleAll, dataYear , '（万円 )', '（万円 )', series);
        commonHighcharts.buildColumnChart('chart-all-preview' , titleAll, dataYear , '（万円 )', '（万円 )', series);
        $('.highcharts-des').show()
    };

    modules.handlingAppendDataPreview = function (index, id, no) {
        let dataAppend = `<div id="chart-borrowing-preview`+ id +`" class="chart-borrowing chart-borrowing-preview col-xl-4 p10t">
                          <p class="title-diagram color-title-chart">CFシミュレーション(物件NO.` + no + `)</p>
                          <div id="chart-preview`+ id +`"></div>
                    </div>`;
        if (index >= CHARTBORROWING[0] && index < CHARTBORROWING[1]) {
            $('#chart-preview-parent-1').append(dataAppend);
            $('#chart-preview-parent-1').css({'margin-top':'100px', 'height':'690px'});
        } else if (index >= CHARTBORROWING[1] && index < CHARTBORROWING[2]) {
            $('#chart-preview-parent-2').append(dataAppend);
            $('#chart-preview-parent-2').css({'margin-top':'100px', 'height':'690px'});
        } else if (index >= CHARTBORROWING[2] && index < CHARTBORROWING[3]) {
            $('#chart-preview-parent-3').append(dataAppend);
            $('#chart-preview-parent-3').css({'margin-top':'100px', 'height':'690px'});
        } else if (index >= CHARTBORROWING[3] && index < CHARTBORROWING[4]) {
            $('#chart-preview-parent-4').append(dataAppend);
            $('#chart-preview-parent-4').css({'margin-top':'100px', 'height':'690px'});
        } else if (index >= CHARTBORROWING[4] && index < CHARTBORROWING[5]) {
            $('#chart-preview-parent-5').append(dataAppend);
            $('#chart-preview-parent-5').css({'margin-top':'100px', 'height':'690px'});
        } else if (index >= CHARTBORROWING[5] && index < CHARTBORROWING[6]) {
            $('#chart-preview-parent-6').append(dataAppend);
            $('#chart-preview-parent-6').css({'margin-top':'100px', 'height':'690px'});
        } else if (index >= CHARTBORROWING[6] && index < CHARTBORROWING[7]) {
            $('#chart-preview-parent-7').append(dataAppend);
            $('#chart-preview-parent-7').css({'margin-top':'100px', 'height':'690px'});
        } else if (index >= CHARTBORROWING[7] && index < CHARTBORROWING[8]) {
            $('#chart-preview-parent-8').append(dataAppend);
            $('#chart-preview-parent-8').css({'margin-top':'100px', 'height':'690px'});
        } else if (index >= CHARTBORROWING[8] && index < CHARTBORROWING[9]) {
            $('#chart-preview-parent-9').append(dataAppend);
            $('#chart-preview-parent-9').css({'margin-top':'100px', 'height':'690px'});
        }
    };
    return modules;
}(window.jQuery, window, document));

$(document).ready(function () {
    borrowing.loadPageBorrowing();
    highChartBorrowing.loadCharts(data);
    highChartBorrowing.getDataChartAll();

    $(document).on('click', '.btn-borrowing-preview', function () {
        setTimeout(function () {
            window.print();
        }, 500);
    });

    $(document).on('click', '#all-data', function () {
        $('input[name=id-chart]').prop('checked', $('#all-data').prop('checked'));
        if($(this).is(':checked') == true) {
            $("input[name=id-chart]").each(function () {
                $('#chart-borrowing' + $(this).data('id')).show();
                $('#chart-borrowing-preview' + $(this).data('id')).show();
            });
        } else {
            $("input[name=id-chart]").each(function () {
                $('#chart-borrowing' + $(this).data('id')).hide();
                $('#chart-borrowing-preview' + $(this).data('id')).hide();
            });
        }
        highChartBorrowing.getDataChartAll();
    });

    $(document).on('click', '.house-borrowing', function () {
        let dataId = $(this).data('id');
        let length = $('.house-borrowing').length;
        let lengthChecked = $("input:checkbox[name=id-chart]:checked").length;
        if(length == lengthChecked) {
            $('#all-data').prop('checked', true);
        } else {
            $('#all-data').prop('checked', false);
        }
        $('#chart-borrowing' + dataId).slideToggle();
        $('#chart-borrowing-preview' + dataId).slideToggle();
        highChartBorrowing.getDataChartAll()
    });

    $(document).on('change', '.select-paginate', function () {
        $('.select-paginate').val($(this).val());
        $('#form-borrowing').submit();
    });

    $('#form-borrowing').on('change', function () {
        $('#form-borrowing').submit();
    });

    $(document).on('click', '.centered-vertical .sort-icon', function () {
        let dataId = $(this).data('id');
        $('.centered-vertical .sort-icon').removeClass('sort-icon-first');
        Common.sortTable(dataId, '#table-property tr', '#table-property-preview-print tr', 2);
        $(this).addClass('sort-icon-first');
    });
});
