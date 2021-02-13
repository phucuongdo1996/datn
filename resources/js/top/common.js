//<![CDATA[

// ユーザーエージェント判別
/*-----------------------------------------------------------------------------------------------*/
function UAChk(){
    /* breakpoint設定 */
    var pcWinSize = 1024;// PC
    var tabletWinSize = 768;// Tablet
    var spWinSize = 767;// SP
    /*-----------------------------------------------*/

    var ua = {};
    ua.name = window.navigator.userAgent.toLowerCase();

    ua.isIE = (ua.name.indexOf('msie') >= 0 || ua.name.indexOf('trident') >= 0);
    ua.isiPhone = ua.name.indexOf('iphone') >= 0;
    ua.isiPod = ua.name.indexOf('ipod') >= 0;
    ua.isiPad = ua.name.indexOf('ipad') >= 0;
    ua.isiOS = (ua.isiPhone || ua.isiPod || ua.isiPad);
    ua.isAndroid = ua.name.indexOf('android') >= 0;
    ua.isTablet = (ua.isiPad || (ua.isAndroid && ua.name.indexOf('mobile') < 0));

    if (ua.isIE) {
        ua.verArray = /(msie|rv:?)\s?([0-9]{1,})([\.0-9]{1,})/.exec(ua.name);
        if (ua.verArray) {
            ua.ver = parseInt(ua.verArray[2], 10);
        }
    }
    if (ua.isiOS) {
        ua.verArray = /(os)\s([0-9]{1,})([\_0-9]{1,})/.exec(ua.name);
        if (ua.verArray) {
            ua.ver = parseInt(ua.verArray[2], 10);
        }
    }
    if (ua.isAndroid) {
        ua.verArray = /(android)\s([0-9]{1,})([\.0-9]{1,})/.exec(ua.name);
        if (ua.verArray) {
            ua.ver = parseInt(ua.verArray[2], 10);
        }
    }

    var uaFlg = 'PC';
    var windSizeFlg = 'PC';

    if( ua.isiPhone || ua.isiPod || (ua.isAndroid && ua.name.indexOf('mobile') >= 0) ){
        // SPだったら
        uaFlg = 'SP';
        windSizeFlg = 'SP';
    }else if( ua.isTablet ){
        // Tabletだったら
        uaFlg = 'Tablet';
        windSizeFlg = 'Tablet';
    }else{
        // PCだったら
        uaFlg = 'PC';

        // ウィンドウサイズでUA振り分け
        //var winW = $(window).width();
        //var winW = $("html").width();
        var winW = window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth;

        if( winW >= pcWinSize ){
            // PCサイズ
            windSizeFlg = 'PC';
        }else if( winW < pcWinSize && winW >= tabletWinSize ){
            // Tabletサイズ
            windSizeFlg = 'Tablet';
        }else if( winW <= spWinSize ){
            // SPサイズ
            windSizeFlg = 'SP';
        }

    }

    var flgs = new Array();

    flgs['UAInfo'] = new Array();
    flgs['UAInfo'] = ua;

    flgs['UAFlg'] = uaFlg;
    flgs['winSizeFlg'] = windSizeFlg;

    return flgs;

    /*--------------------------------------------
        ■ 使い方
        ● flgs['UAInfo']の中身を見る
        var uaInfo = UAChk();
        for(var i in uaInfo['UAInfo']){
            alert(uaInfo['UAInfo'][i]);
        }

        ● flgs['UAInfo']の中身へアクセス
        var uaInfo = UAChk();
        alert(uaInfo.UAInfo.name);
        または
        alert(uaInfo['UAInfo']['name']);

    ----------------------------------------------*/

}//UAChk

/*-----------------------------------------------------------------------------------------------*/


// IE判別
/*-----------------------------------------------------------------------------------------------*/

function ltIE9(){
    var userAgent = window.navigator.userAgent.toLowerCase();
    var appVersion = window.navigator.appVersion.toLowerCase();

    // IE8以下チェック
    if (userAgent.indexOf('msie') != -1) {
        if (appVersion.indexOf("msie 6.") != -1) {
            //IE6
            return true;
        }else if (appVersion.indexOf("msie 7.") != -1) {
            //IE7
            return true;
        }else if (appVersion.indexOf("msie 8.") != -1) {
            //IE8
            return true;
        }else{
            //IE9以上
            return false;
        }
    }else{
        return false;
    }
}//ltIE9

/*-----------------------------------------------------------------------------------------------*/


// GETパラメータ取得
/*-----------------------------------------------------------------------------------------------*/
(function($) {
    // http://tips.recatnap.info/wiki/Jquery%E3%81%A7%E3%83%AA%E3%82%AF%E3%82%A8%E3%82%B9%E3%83%88%E3%83%91%E3%83%A9%E3%83%A1%E3%83%BC%E3%82%BF%E3%81%AE%E5%8F%96%E5%BE%97%28$.getParameter%28%29%29
    $.extend({
        getParameter: function getParameter() {
            // URLのパラメーターを取得

            var arg  = new Object;
            var pair = location.search.substring(1).split('&');
            for(i=0; pair[i]; i++) {
                var kv = pair[i].split('=');
                arg[kv[0]] = kv[1];
            }
            return arg;
        }
    });

    /*
    var args = $.getParameter();
    パラメーターがあれば「args.○○○」とかで値が取れる。
    */
})(jQuery);











//]]>

//<![CDATA[
$(document).ready(function(){

	var $wrap = $('#wrap');

	var uaInfo = UAChk();

	var nowUrl = location.href;
	var nowParam = location.search;
	var paramAry = nowParam.split('&');

	//console.log(paramAry.length);



	/* SP GlobalNav */
	/*----------------------------------------------------------*/
	//	var globalNavBtn = $("#globalNavBtn").find("a");
	//	var globalNavWrap = $("#globalNavWrap");
	//
	//	// nav Click
	//	globalNavBtn.click(function(e){
	//		globalNavWrap.slideToggle();
	//		e.preventDefault();
	//		return false;
	//	});
	//
	//	function spGnavSetting(){
	//		uaInfo = UAChk();
	//		if(uaInfo['winSizeFlg'] == 'SP'){
	//			globalNavWrap.hide();
	//		}else{
	//			globalNavWrap.show();
	//		}
	//	}
	//
	//	$(window).on('resize',function(){
	//		spGnavSetting();
	//	});


	/* SP GlobalNav Drawer */
	/*----------------------------------------------------------*/
	var $drawerNavBtn = $('#globalNavBtn a');
	var $drawerNavWrap = $('#globalNavWrap');
	var clName_drawerNavBtnAct = 'drawerActive';
	var clName_wrapDrawerAct = 'drawer';

	var spGNavEvName = 'spGnav';

	function gNavEvReset(){
		$drawerNavBtn.off('.'+spGNavEvName+'');
	}


	function spGnavInit(){
		$drawerNavBtn.on('click.'+spGNavEvName+'',function(){
			var $this = $(this);
			var t = ($(window).scrollTop() * -1);

			$this.toggleClass(clName_drawerNavBtnAct);
			$this.parent().toggleClass(clName_drawerNavBtnAct);

			$drawerNavWrap.toggleClass(clName_drawerNavBtnAct);
			$wrap.toggleClass(clName_wrapDrawerAct);
			if($wrap.hasClass(clName_wrapDrawerAct)){
				$wrap.css({
					'width':'100%',
					'position': 'fixed',
					'top':t+'px'
				});

				var h = window.innerHeight || document.documentElement.clientHeight || document.body.clientHeight;

				$('html,body').css('height','100%');
			}else{
				var scrY = parseInt(($wrap.css('top').replace('px','')) * -1);
				$wrap.attr('style','');
				$('html,body').attr('style','');
				$('html,body').scrollTop(scrY);
			}
		});
	}


	function gNavInit(){
		uaInfo = UAChk();
		gNavEvReset();
		if(uaInfo['winSizeFlg'] != 'PC'){
			spGnavInit();
		}else{
			var scrY = 0;
			$drawerNavBtn.removeClass(clName_drawerNavBtnAct);
			$drawerNavBtn.parent().removeClass(clName_drawerNavBtnAct);
			$drawerNavWrap.removeClass(clName_drawerNavBtnAct);
			$wrap.removeClass(clName_wrapDrawerAct);
			if($wrap.attr('style')){
				scrY = parseInt(($wrap.css('top').replace('px','')) * -1);
			}
			$wrap.attr('style','');
			$('html,body').attr('style','');
			if($wrap.attr('style')){
				$('html,body').scrollTop(scrY);
			}
		}
	}

	gNavInit();

	$(window).resize(function(){
		gNavInit();
	});





	var leaveScrollNum = ($('#headWrap').outerHeight()) * -1;
//	var leaveScrollNum = 0;
	var smoothScrollSpd = 300;

	// 除外するタグ指定
	var smoothScrollNotList = '#globalNavBtn a';
	//var smoothScrollNotList = '#globalNavBtn a, #third a, #fourth a, #fifth a';

	$('a[href^="#"]').not(smoothScrollNotList).click(function(e){
		leaveScrollNum = ($('#headWrap').outerHeight()) * -1;
//		leaveScrollNum = 0;

		var href= $(this).attr("href");
		var target = $(href == "#" || href == "" ? 'html' : href);


		// Drawer時のページ内スクロールの場合は、上記をコメントアウトし、下記を有効化
//		alert(position);
		if(uaInfo['winSizeFlg'] != 'PC'){
			$drawerNavBtn.toggleClass(clName_drawerNavBtnAct);
			$drawerNavBtn.parent().toggleClass(clName_drawerNavBtnAct);

			$drawerNavWrap.toggleClass(clName_drawerNavBtnAct);
			$wrap.toggleClass(clName_wrapDrawerAct);

			$wrap.attr('style','');
			$('html,body').attr('style','');

			var position = (target.offset().top)+leaveScrollNum;
			var scrY = position;

			$('html,body').scrollTop(scrY);
		}else{
			var position = (target.offset().top)+leaveScrollNum;
			$("html, body").animate({scrollTop:position}, smoothScrollSpd, "swing");
		}


		e.preventDefault();
		return false;
	});


	// 別ページスムーススクロール
	var smoothScrollPrefix = 'move=';
	$(window).on('load.smooth',function(){
		$.each(paramAry, function(i, val) {
			if(val.indexOf(smoothScrollPrefix) != -1){
				leaveScrollNum = ($('#headWrap').outerHeight()) * -1;
//				leaveScrollNum = 0;

				var hh = val.replace('?','').replace(smoothScrollPrefix,'');
				var hash = '#' + hh;
				var tgt = $(hash);
				var pos = (tgt.offset().top)+leaveScrollNum;;
				$("html, body").animate({scrollTop:pos}, smoothScrollSpd, "swing");
			}
		});
	});



	// タブ切り替え
	/*----------------------------------------------------------------------*/
	var tabWrapName = '.tabWrap';
	var tabBtnName = '.tabBtn';
	var tabBoxName = '.tabBox';
	var activeCl = 'active';

	var tabWrap = $(tabWrapName);
	var tabBtn = $(tabBtnName);
	var tabBox = $(tabBoxName);

	tabBtn.click(function(e){
		var $this = $(this);
		var thisParentIdx = $(tabWrapName).index($this.parents(tabWrapName));

		tabWrap.eq(thisParentIdx).find(tabBtnName).removeClass(activeCl);
		tabWrap.eq(thisParentIdx).find(tabBoxName).removeClass(activeCl);

		var activeId = $this.data('tabtrg');
		$("#"+activeId).addClass(activeCl);
		$this.addClass(activeCl);

		e.preventDefault();
		return false;
	});

	// tab 別ページ
	var tabPrefix = 'tabtrg=';
	$(window).on('load.tab',function(){
		$.each(paramAry, function(i, val) {
			if(val.indexOf(tabPrefix) != -1){
				var hh = val.replace('?','').replace(tabPrefix,'');
				var trgTabParentIdx = $(tabWrapName).index($(tabBoxName+'#'+hh).parents(tabWrapName));

				tabWrap.eq(trgTabParentIdx).find(tabBtnName).removeClass(activeCl);
				tabWrap.eq(trgTabParentIdx).find(tabBoxName).removeClass(activeCl);

				var activeId = hh;
				$("#"+activeId).addClass(activeCl);
				$(tabBtnName+'[data-tabtrg="'+activeId+'"]').addClass(activeCl);

			}
		});
	});




	/* tel link */
	/* --------------------------------------------------------- */
	if(uaInfo['UAFlg'] != 'SP'){
		$('a[href^="tel:"]').on('click', function(e){
			e.preventDefault();
		});
	}




	/* Scroll Fadein */
	/*----------------------------------------------------------*/
	var clName_fadeinWrap = 'fadeinWrap';
	var clName_fadein = 'fadein';
	var clName_fadeinActive = 'scrollin';
	var $fadeinWrap = $('.'+clName_fadeinWrap);
	var $fadein = $('.'+clName_fadein);

	var winH = window.innerHeight || document.documentElement.clientHeight || document.body.clientHeight;

	var division_fadein_pc = 1.4;
	var division_fadein_sp = 1.4;
	var extra_fadein = (winH / division_fadein_pc);
	if(uaInfo['winSizeFlg'] != 'PC'){
		extra_fadein = (winH / division_fadein_sp);
	}

	var delay_fadein = 320;

	var limH = $('body').outerHeight() - winH;

	function scrollFadein(y){
		uaInfo = UAChk();
		var scrY = y;

		winH = window.innerHeight || document.documentElement.clientHeight || document.body.clientHeight;
		limH = $('body').outerHeight() - winH;

		if(uaInfo['winSizeFlg'] == 'PC'){
			extra_fadein = (winH / division_fadein_pc);
		}else{
			extra_fadein = (winH / division_fadein_sp);
		}

		if($fadeinWrap.find('.'+clName_fadein).size()){
			$fadeinWrap.each(function(idx){
				var $this = $(this);
				var trgY = ($this.offset().top) - extra_fadein;

				if(scrY >= trgY && !$this.hasClass(clName_fadeinActive)){
					$this.addClass(clName_fadeinActive);

					$this.find('.'+clName_fadein).each(function(i){
						var $t = $(this);
						$t.stop().delay((delay_fadein * i)).queue(function() {
							$t.addClass(clName_fadeinActive);
						});
					});
				}


				// One time only
				if(limH <= scrY){
					$this.find('.'+clName_fadein).not('.'+clName_fadeinActive).each(function(i){
						var $t = $(this);
						$t.stop().delay((delay_fadein * i)).queue(function() {
							$t.addClass(clName_fadeinActive);
						});
					});
				}

				// Any Time
				/*if(scrY >= trgY && $this.hasClass(clName_fadeinActive)){
					$this.find('.'+clName_fadein).each(function(i){
						var $t = $(this);
						if(!$t.hasClass(clName_fadeinActive)){
							$t.addClass(clName_fadeinActive);
						}
					});
				}else if(scrY < trgY && $this.hasClass(clName_fadeinActive)){
					$this.find('.'+clName_fadein).stop();
					$this.removeClass(clName_fadeinActive);
					$this.find('.'+clName_fadein).removeClass(clName_fadeinActive);
				}*/
			});
		}

	}


	// Release when using
//	setTimeout(function(){
//		scrollFadein($(window).scrollTop());
//	},300);
//
//
//	$(window).on('scroll.scrollFadein',function(){
//		scrollFadein($(window).scrollTop());
//	});





	/* FAQ List Accordion */
	/*----------------------------------------------------------*/
	var _faqList = '.faqList > dl';
	var _faqListBtn = _faqList+' .faqListBtn';
	var $faqListBtn = $(_faqListBtn);

	var clName_faqListActive = 'active';
	var ev_faqAcr = 'faqAcrEv';
	var spd_faqListSlide = 300;

	$faqListBtn.on('click.'+ev_faqAcr,function(e){
		var $this = $(this);
		var $trg = $this.parents(_faqList).children('dd');

		$this.toggleClass(clName_faqListActive);
		$trg.stop().slideToggle(spd_faqListSlide);

		e.preventDefault();
		return false;
	});





	/* Modal */
	/*----------------------------------------------------------*/
	var _modalBg = '#modalBg';
	var _modalWrap = '#modalWrap';
	var _modalContents = '.modalContents';
	var _modalBtn = '.modalBtn';
	var _modalCloseBtn = '#modalClose > a';
	var $modalBg = $(_modalBg);
	var $modalWrap = $(_modalWrap);
	var $modalBtn = $(_modalBtn);
	var $modalCloseBtn = $(_modalCloseBtn);
	var $modalContents = $(_modalContents);

	var clName_modalActive = 'active';
	var ev_modal = 'modalEv';
	var data_modal = 'modal';
	var spd_modal = 300;

	function modalView(){
		$modalBg.stop().fadeIn(spd_modal);
		$modalWrap.stop().fadeIn(spd_modal);
	}

	function modalHide(){
		$modalBg.stop().fadeOut(spd_modal);
		$modalWrap.stop().fadeOut(spd_modal);
	}

	$(document).on('click.'+ev_modal, _modalBtn, function(e){
		var $this = $(this);
		var trgId = $this.data(data_modal);
		var $trg = $('#'+trgId);

		$modalContents.removeClass(clName_modalActive);
		$trg.addClass(clName_modalActive);

		modalView();

		e.preventDefault();
		return false;
	});


	$modalBg.on('click.'+ev_modal,function(){
		modalHide();
	});

	$modalCloseBtn.on('click.'+ev_modal,function(){
		modalHide();
	});









});
//]]>
