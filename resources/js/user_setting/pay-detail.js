$(document).ready(function () {
    $('.btn-preview-payment').on('click', function () {
        setTimeout(function () {
            window.print();
        }, 500);
    });
});
