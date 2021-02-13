$(function(){
	$('.photo_modal').on('shown.bs.modal', function (event) {
		$(this).find('.img').animate({opacity:1},300);
		if ($('.img_item').length > 1) {
            $(this).find('.img').slick({
                prevArrow : '<a href="javascript:void(0);" class="slick-prev"><img src="' + window.location.origin + '/images/a_l.png" alt="" /></a>',
                nextArrow : '<a href="javascript:void(0);" class="slick-next"><img src="' + window.location.origin + '/images/a_r.png" alt="" /></a>'
            });
        }
    });

	$('.photo_modal').on('hidden.bs.modal', function (event) {
		$(this).find('.img').animate({opacity:0},300);
		$(this).find('.img').slick('unslick');
    });
});
