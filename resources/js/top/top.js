//<![CDATA[
$(document).ready(function(){
	
	/* Plan Price Table */
	/*----------------------------------------------------------*/
	var _planTblArea = '.planTblArea';
	var _planUserPrice = '.planUserPrice';
	var _pricePlanKind = '.pricePlanKind';
	var _planTblSelect = '.planTblSelect';
	var $planTblSelect = $(_planTblSelect);
	
	var val_planPriceDefault = $planTblSelect.find('option').eq(0).val();
	var clName_planPriceActive = 'active';
	
	$planTblSelect.val(val_planPriceDefault);
	
	$planTblSelect.on('change',function(){
		var $this = $(this);
		var v = $this.val();
		
		$planTblSelect.val(v);
		$this.parents(_planTblArea).find(_planUserPrice).find(_pricePlanKind).removeClass(clName_planPriceActive);
		$this.parents(_planTblArea).find(_planUserPrice).find(_pricePlanKind+'.'+v).addClass(clName_planPriceActive);
	});
	
	
	
	
	
});
//]]>