var topIndex = (function () {
    let modules = {};

    modules.showModalAds = function () {
        $('#show-ads').modal('show');
    }

    return modules;
}(window.jQuery, window, document));

$(document).ready(function () {
    topIndex.showModalAds();
});
