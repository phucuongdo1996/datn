let listItem = (function () {
    let modules = {};

    modules.buildHistoryChart = function (data) {
        Highcharts.chart('history-pay-chart-sell', {
            chart: {
                type: 'line',
                height: '300px',
            },

            exporting: {
                enabled: false
            },
            credits: {
                enabled: false
            },
            title: {
                text: 'Giá bán gần đây'
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

    modules.getDataChart = function (productBaseId) {
        let formData = new FormData();
        formData.append("_token", $('meta[name="csrf-token"]').attr('content'));
        formData.append('product_base_id', productBaseId)
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

    modules.showModal = function (object) {
        Common.clearMessageValidate();
        $('#modal-product-image').prop('src', object.data('image'))
        $('#modal-product-name').text(object.data('product-name'))
        $('#modal-hero-name').text(object.data('hero-name'))
        $('#check-submit').prop('checked', false);
        $('input[name=product_id]').val(object.data('product-id'))
        $('#modal-sell-item').modal('show')
    }

    modules.sellItem = function () {
        let formData = new FormData($('#form-sell-item')[0]);
        formData.append("_token", $('meta[name="csrf-token"]').attr('content'));
        Common.convertNumeralForForm(formData);
        let submitAjax = $.ajax({
            url: '/dota/user/sell-item',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false
        })
        submitAjax.done(function (response) {
            location.reload();
        });
        submitAjax.fail(function (response) {
            $('#pay-submit').prop('disabled', false);
            let messageList = response.responseJSON.errors;
            Common.showMessageValidate(messageList)
        });
    }

    modules.validateSellItem = function () {
        let formData = new FormData($('#form-sell-item')[0]);
        formData.append("_token", $('meta[name="csrf-token"]').attr('content'));
        Common.convertNumeralForForm(formData);
        let submitAjax = $.ajax({
            url: '/dota/user/validation-sell-item',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false
        })
        submitAjax.done(function (response) {
            if (response.check == true) {
                $('#modal-sell-item').modal('hide');
                $('#modal-loading').modal('show');
                modules.sellItem()
            }
        });
        submitAjax.fail(function (response) {
            $('#pay-submit').prop('disabled', false);
            let messageList = response.responseJSON.errors;
            Common.showMessageValidate(messageList)
        });
    }

    return modules;
}(window.jQuery, window, document));

$(document).ready(function () {
    $('.sell-item').on('click', function () {
        listItem.getDataChart($(this).data('product-base-id'))
        listItem.showModal($(this));
    });

    $('input[name=price]').on('keyup', function () {
        let value1 = Common.convertStringToNumber($(this).val());
        let value2 = value1 * 0.95;
        $('input[name=price_real]').val(Common.numberFormat(value2, 2))
    });

    $('#check-submit').on('click', function () {
        $('#pay-submit').prop('disabled', !$(this).prop('checked'))
    });

    $('#pay-submit').on('click', function () {
        $(this).prop('disabled', true);
        listItem.validateSellItem();
    });

    $('input[name=price_real]').on('keyup', function () {
        let value1 = Common.convertStringToNumber($(this).val());
        let value2 = value1 * 100 / 90;
        $('input[name=price]').val(Common.numberFormat(value2, 2))
    })
});
