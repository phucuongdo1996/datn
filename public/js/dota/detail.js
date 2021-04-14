var detailFunction = (function () {
    let modules = {};
    modules.buildHistoryChart = function (data) {
        console.log(data.price)
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
                categories: data.date
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
                data: data.price
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

    modules.getDataChart = function () {
        let formData = new FormData();
        formData.append("_token", $('meta[name="csrf-token"]').attr('content'));
        formData.append('product_base_id', $('#product-base-id').val())
        let submitAjax = $.ajax({
            url: '/dota/get-data-detail',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false
        })
        submitAjax.done(function (response) {
            modules.buildHistoryChart(response);
        });
        submitAjax.fail(function (response) {
            console.log(response)
        })
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
    detailFunction.getDataChart();

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
