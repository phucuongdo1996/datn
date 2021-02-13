var scrollP = 0;

var Home = (function () {
    var modules = {};

    modules.reponsive = function () {
        if ($('#fa-menu:visible').length == 0) {
            $('.menu-simulation-item .form-search').hide();
            $('.main-sidebar-left').show();
            $('.content-wrapper').show();
            $('.name-user').show();
        } else {
            if ($('#fa-menu').hasClass('fa-bars-custom')) {
                $('.main-sidebar-left').hide();
                $('.content-wrapper').show();
                $('.fa-bars-img').show();
                $('.fa-close-img').hide();
            } else {
                $('.content-wrapper').hide();
                $('.main-sidebar-left').show();
                $('.fa-bars-img').hide();
                $('.fa-close-img').show();
            }
            $('.menu-simulation-item .form-search').show();
        }
    };

    modules.clickMenuIcon = function () {
        if ($('#fa-menu').hasClass('fa-bars-custom')) {
            $('.content-wrapper').hide();
            $('.main-sidebar-left').show();
            $('.fa-bars-img').hide();
            $('.fa-close-img').show();
            $('#fa-menu').removeClass('fa-bars-custom');
            $('#fa-menu').addClass('fa-close-custom');
        } else {
            $('.fa-bars-img').show();
            $('.fa-close-img').hide();
            $('#fa-menu').removeClass('fa-close-custom');
            $('#fa-menu').addClass('fa-bars-custom');
            $('.main-sidebar-left').hide();
            $('.content-wrapper').show();
        }
    };

    return modules;
}(window.jQuery, window, document));

$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    Home.reponsive();

    window.addEventListener('resize', function () {
        if ($('.background-print:visible').length == 0) {
            Home.reponsive();
        }
    });

    $(document).on('click', '.nl-ml-item', function () {
        let iconDrop = $(this).find('i.fa')[0];
        if($(this).parent().hasClass( "menu-open" )) {
            $(iconDrop).removeClass( "fa-caret-down");
            $(iconDrop).addClass( "fa-caret-right");
        } else {
            $(iconDrop).removeClass( "fa-caret-right");
            $(iconDrop).addClass( "fa-caret-down");
        }
    });

    $('#fa-menu').on('click', function () {
        Home.clickMenuIcon();
    });
});
