let payCard = (function () {
    let modules = {};

    modules.deleteCard = function (dataId) {
        let formdata = new FormData();
        formdata.append("_token", $('meta[name="csrf-token"]').attr('content'));
        formdata.append("id_car", dataId);
        let submitAjax = $.ajax({
            type: "POST",
            url: '/settings/destroy',
            data: formdata,
            processData: false,
            contentType: false,
        });

        submitAjax.done(function (response) {
            window.location.reload(true);
        });

        submitAjax.fail(function (response) {
            window.location.reload(true);
        });
    };

    modules.changeDefaultCard = function (dataId) {
        let formdata = new FormData();
        formdata.append("_token", $('meta[name="csrf-token"]').attr('content'));
        formdata.append("id_car", dataId);
        let submitAjax = $.ajax({
            type: "POST",
            url: '/settings/change-default',
            data: formdata,
            processData: false,
            contentType: false,
        });

        submitAjax.done(function (response) {
            window.location.reload(true);
        });

        submitAjax.fail(function (response) {
            window.location.reload(true);
        });
    };

    modules.downgrade = function (dataType) {
        let formdata = new FormData();
        formdata.append("_token", $('meta[name="csrf-token"]').attr('content'));
        formdata.append("type", dataType);
        let submitAjax = $.ajax({
            type: "POST",
            url: '/settings/downgrade',
            data: formdata,
            processData: false,
            contentType: false,
        });

        submitAjax.done(function (response) {
            window.location.reload(true);
        });

        submitAjax.fail(function (response) {
            window.location.reload(true);
        });
    };

    modules.checkCard = function (type) {
        let submitAjax = $.ajax({
            type: "GET",
            url: '/settings/check-card',
            contentType: false,
        });

        submitAjax.done(function (response) {
            if (response && response.check == true) {
                    window.location.href = '/settings/' + type + '/checkout';
            } else {
                $('#modal-check-card').modal('show');
            }
        });

        submitAjax.fail(function (response) {
            window.location.reload(true);
        });
    };

    modules.showNotificationTrial = function (type) {
        let url, data;
        if (type === "0") {
            url = '/settings/downgrade';
        } else if (type === "1") {
            url = '/settings/basic/checkout';
        } else {
            url = '/settings/premium/checkout';
        }
        let submitAjax = $.ajax({
            type: "POST",
            url: url,
            data: type === "0" ? {type: 0} : null
        });

        submitAjax.done(function (response) {
            window.location.reload(true);
        });

        submitAjax.fail(function (response) {
            window.location.reload(true);
        });
    };

    modules.showNotificationDowngrade = function (type) {
        if (type == '0') {
            $('#text-modal-notification-downgrade-free').show();
            $('#text-modal-notification-downgrade-fee').hide();
            $('#downgrade-free').show();
            $('#downgrade-basic').hide();
        } else {
            $('#text-modal-notification-downgrade-free').hide();
            $('#text-modal-notification-downgrade-fee').show();
            $('#downgrade-free').hide();
            $('#downgrade-basic').show();
        }
        $('#modal-show-notification-downgrade').modal('show');
    };

    modules.showLoading = function (buttonObject) {
        buttonObject.html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>少々お待ちください...');
        $('.btn-process').css('pointer-events', 'none');
    };

    return modules;
}(window.jQuery, window, document));
$(document).ready(function () {
    $('.btn-delete-card').on('click', function () {
        $(this).html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>処理中...');
        $('.btn-process').css('pointer-events', 'none');
        payCard.deleteCard(this.dataset.id);
    });

    $('.change-default-card').on('click', function () {
        payCard.showLoading($(this));
        payCard.changeDefaultCard(this.dataset.id);
    });

    $('.btn-downgrade').on('click', function () {
        payCard.showLoading($(this));
        payCard.downgrade(this.dataset.type);
    });

    $('.upgrade-from-trial').on('click', function () {
        payCard.checkCard(this.dataset.type);
    });

    $('.show-notification-trial').on('click', function () {
        payCard.showLoading($(this));
        payCard.showNotificationTrial(this.dataset.type)
    });

    $('.show-notification-downgrade').on('click', function () {
        payCard.showNotificationDowngrade(this.dataset.type);
    })
});
