var home = (function () {
    let modules = {};
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
        let titleAll = 'C F シミュレーショ   ン';
        commonHighcharts.buildColumnChart('chart-all' , titleAll, dataYear , '（万円 )', '（万円 )', series);
        $('.highcharts-des').show()
    };
    return modules;
}(window.jQuery, window, document));

$(document).ready(function () {
    home.loadChartAllData(dataAll);
});
