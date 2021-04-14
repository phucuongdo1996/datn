var detailFunction = (function () {
    let modules = {};
    modules.buildHistoryChart = function () {
        Highcharts.chart('history-pay-chart', {
            chart: {
                type: 'line'
            },
            exporting: {
                enabled: false
            },
            credits: {
                enabled: false
            },
            title: {
                text: 'Giá trung bình gần đây'
            },
            subtitle: {
                text: 'Được tính trong 30 ngày gần nhất'
            },
            xAxis: {
                type: 'date',
                categories: ['01/01', '02/01', '03/01', '04/01', '05/01', '06/01', '07/01', '08/01', '09/01', '10/01', '11/01', '12/01']
            },
            yAxis: {
                title: {
                    text: 'Giá trung bình'
                }
            },
            tooltip: {
                crosshairs: true,
                shared: false,
            },
            plotOptions: {
                line: {
                    dataLabels: {
                        enabled: true
                    },
                    marker: {
                        radius: 4,
                        lineColor: '#666666',
                        lineWidth: 1
                    },
                    enableMouseTracking: true
                }
            },
            legend: {
                enabled: false
            },

            series: [{
                name: 'Giá',
                data: [10000, 12000, 11000, 15000, 19000, 22000, 21000, 21500, 21500, 21000, 21200, 22000]
            }]
        });
    }

    modules.clickBuyItem = function () {
        let isLogin = $('#user-id').val() == '';
        console.log($('#user-id').val(), isLogin)
        if (isLogin) {
            $('#login-form').modal('show');
        } else {
            $('#exampleModalCenter').modal('show')
        }
    }

    modules.login = function () {
        let formData = new FormData($('#form-login')[0]);
        let submitAjax = $.ajax({
            url: '/login',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
        })
        submitAjax.done(function (response) {
            if (response.login == true) {
                location.reload();
            } else {
                $('.fail-login').show();
                toastr.error('Đăng nhập thất bại', 'Lỗi!');
                $('#button-login').prop('disabled', false)
            }
        });
        submitAjax.fail(function (response) {
            $('#button-login').prop('disabled', false)
            let messageList = response.responseJSON.errors;
            $('.fail-login').hide();
            Common.showMessageValidate(messageList);
        })
    }

    return modules;
}(window.jQuery, window, document));

$(document).ready(function () {
    detailFunction.buildHistoryChart();

   $('.btn-buy-item').on('click', function () {
       detailFunction.clickBuyItem();
   });

   $('#pay-submit').on('click', function () {
       $('#exampleModalCenter').modal('hide');
       $('#loading').modal('show');
       setTimeout(function () {
           $('#loading').modal('hide');
           $('#modal-success').modal('show');
       }, 2000)
   });

   $('#button-login').on('click', function () {
       $(this).prop('disabled', true);
       detailFunction.login();
   })
});
