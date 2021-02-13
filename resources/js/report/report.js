$(document).ready(function () {
    $('.arrowArea .prev').on('click', function() {
        $(".table-responsive").scrollLeft($(".table-responsive").scrollLeft() - 105 );
        return false;
    });

    $('.arrowArea .next').on('click', function() {
        $(".table-responsive").scrollLeft($(".table-responsive").scrollLeft() + 105 );
        return false;
    });

    $('.per-page').on('change', function () {
        $('select[name=option_paginate]').val(this.value);
        $('.form-report-filter').submit();
    });

    $(document).on('change', '#select-proprietor', function () {
        $('select[name=option_paginate]').val(this.value);
        $('.form-report-filter').submit();
    });

    $('.centered-vertical .sort-icon').on('click', function () {
        let dataId = $(this).data('id');
        $('.centered-vertical .sort-icon').removeClass('sort-icon-first');
        Common.sortTable(dataId, '.table-report tr', '.table-report tr', 1);
        $(this).addClass('sort-icon-first');
    });

    $('.checkbox-report').on('change', function () {
        $('.form-report-filter').submit();
    })
});
