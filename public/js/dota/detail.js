var detailFunction = (function () {
    let modules = {};
    modules.buildHistoryChart = function (data) {
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
        if (isLogin) {
            $('#login-form').modal('show');
        } else {
            modules.showFormBuyItem();
        }
    }

    modules.showFormBuyItem = function () {
        $('#modal-buy-item').modal('show')
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

    modules.buyItem = function () {
        let formData = new FormData();
        formData.append("_token", $('meta[name="csrf-token"]').attr('content'));
        formData.append("market_id", $('#market-id').val());
        let submitAjax = $.ajax({
            url: '/dota/user/buy-item',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
        })
        submitAjax.done(function (response) {
            if (response.save == true) {
                window.location.href = '/dota/user/list-item'
            } else {
                location.reload();
            }
        });
        submitAjax.fail(function (response) {
        })
    }

    modules.sendOrder = function () {
        let formData = new FormData();
        formData.append("_token", $('meta[name="csrf-token"]').attr('content'));
        formData.append("market_id", $('#market-id').val());
        let submitAjax = $.ajax({
            url: 'https://sandbox.baokim.vn/payment/api/v4/order/send',
            type: 'POST',
            data: {
                "mrc_order_id": "3052kBFlVcDTMZ5Z",
                "total_amount": 8,
                "description": "eqxI4W4HFUPwyNxH",
                "url_success": "abk7XKg37d6bJHjG",
                "merchant_id": 8,
                "url_detail": "RPEF5JjBawPtAnwT",
                "lang": "sMOpnGOwh246qgqW",
                "bpm_id": 18,
                "accept_bank": "ABi3NK6SJoxOCeby",
                "accept_cc": "xhQhwajpY6WghowL",
                "accept_qrpay": "Js7wlJYIS1JIfiJm",
                "accept_e_wallet": "a1UW630UbULvXFJG",
                "webhooks": "0YvqxR11rvvQDTVE",
                "customer_email": "NUwsDFkMkq5mofTd",
                "customer_phone": "b3PvayJ8ycfcddGa",
                "customer_name": "DEw68quVK4nnbh0x",
                "customer_address": "Lrfr5l6bETkne7y8"
            },
            // processData: false,
            // contentType: false,
        })
        submitAjax.done(function (response) {
            console.log(999, response)
        });
        submitAjax.fail(function (response) {
        })
    }

    return modules;
}(window.jQuery, window, document));

$(document).ready(function () {
    detailFunction.getDataChart();
    detailFunction.sendOrder()

   $('.btn-buy-item').on('click', function () {
       detailFunction.clickBuyItem();
   });

   $('#pay-submit').on('click', function () {
       $('#modal-buy-item').modal('hide');
       $('#modal-loading').modal('show');
       detailFunction.buyItem();
   });

   $('#button-login').on('click', function () {
       $(this).prop('disabled', true);
       detailFunction.login();
   });

    $('#check-submit').on('click', function () {
        $('#pay-submit').prop('disabled', !$(this).prop('checked'))
    });

    // var settings = {
    //     "async": true,
    //     "crossDomain": true,
    //     "url": "https://sandbox.baokim.vn/payment/api/v4/order/send",
    //     "method": "POST",
    //     "data": {
    //         "mrc_order_id": "3052kBFlVcDTMZ5Z",
    //         "total_amount": 8,
    //         "description": "eqxI4W4HFUPwyNxH",
    //         "url_success": "abk7XKg37d6bJHjG",
    //         "merchant_id": 8,
    //         "url_detail": "RPEF5JjBawPtAnwT",
    //         "lang": "sMOpnGOwh246qgqW",
    //         "bpm_id": 18,
    //         "accept_bank": "ABi3NK6SJoxOCeby",
    //         "accept_cc": "xhQhwajpY6WghowL",
    //         "accept_qrpay": "Js7wlJYIS1JIfiJm",
    //         "accept_e_wallet": "a1UW630UbULvXFJG",
    //         "webhooks": "0YvqxR11rvvQDTVE",
    //         "customer_email": "NUwsDFkMkq5mofTd",
    //         "customer_phone": "b3PvayJ8ycfcddGa",
    //         "customer_name": "DEw68quVK4nnbh0x",
    //         "customer_address": "Lrfr5l6bETkne7y8"
    //     },
    //     "headers": {
    //         "Access-Control-Allow-Origin" : "*"
    //     }
    // }
    //
    // $.ajax(settings).done(function (response) {
    //     console.log(response);
    // });
});
