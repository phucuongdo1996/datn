let download = (function () {
    let modules = {};


    modules.isValidDate = function (date) {
        let regEx = /^\d{4}\/\d{2}\/\d{2}$/;
        return date.match(regEx) != null;
    };

    modules.handleDateTime = function (className, error) {
        if ($(className).val().length === 0 || download.isValidDate(String($(className).val()))) {
            $(className).removeClass('input-error');
            $(error).attr('hidden', true);
        }
    };

    modules.handleValidateCsv = function () {

        if ($('.csv-status').val().length != 0) {
            $('.csv-status').removeClass('input-error');
            $('.error-message-status').attr('hidden', true);
        }

        if ($('.csv-role').val().length != 0) {
            $('.csv-role').removeClass('input-error');
            $('.error-message-role').attr('hidden', true);
        }
        modules.handleDateTime('.date-from-registration', '.error-date-from-registration');
        modules.handleDateTime('.date-to-registration', '.error-date-to-registration');
        modules.handleDateTime('.date-from-last-payment', '.error-date-from-last-payment');
        modules.handleDateTime('.date-to-last-payment', '.error-date-to-last-payment');
        modules.handleDateTime('.date-from-last-login', '.error-date-from-last-login');
        modules.handleDateTime('.date-to-last-login', '.error-date-to-last-login');
        $('.error').attr('hidden', true);
    };

    return modules;
}(window.jQuery, window, document));

$(document).ready(function () {
    $('.btn-download-csv').on('click', function () {
        download.handleValidateCsv();
        Common.Numeral();
    });
});
