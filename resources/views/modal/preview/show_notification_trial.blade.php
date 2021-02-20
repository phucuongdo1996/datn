<div class="modal fade" id="modal-show-notification-trial">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
                <div class="modal-header fs16">
                    <span id="text-modal-notification"></span>
                    <button type="button" class="close btn-process" data-dismiss="modal">&times;</button>
                </div>
            <div class="modal-footer">
                <button type="button" class="btn custom-btn-default btn-process" data-dismiss="modal">{{ trans('attributes.pay_api.btn_check_card_cancel') }}</button>
                <a id="checkout-from-trial-basic" href="{{ route(USER_SETTING_PAY_BASIC_CHECKOUT) }}" type="button" class="btn custom-btn-success">{{ trans('attributes.pay_api.btn_check_card_ok') }}</a>
                <a id="checkout-from-trial-premium" href="{{ route(USER_SETTING_PAY_PREMIUM_CHECKOUT) }}" type="button" class="btn custom-btn-success">{{ trans('attributes.pay_api.btn_check_card_ok') }}</a>
                <button id="downgrade-from-trial-free" type="button" class="btn custom-btn-success btn-downgrade btn-process" data-type="{{ FREE }}">{{ trans('attributes.pay_api.btn_check_card_ok') }}</button>
            </div>
        </div>
    </div>
</div>
