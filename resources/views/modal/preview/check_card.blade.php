<div class="modal fade" id="modal-check-card">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
                <div class="modal-header fs16">
                    <span>{{ trans('messages.pay_api.check_card.text_1') }} <br>
                        <span>{{ trans('messages.pay_api.check_card.text_2') }}</span>
                    </span>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
            <div class="modal-footer">
                <button type="button" class="btn custom-btn-default" data-dismiss="modal">{{ trans('attributes.pay_api.btn_check_card_cancel') }}</button>
                <a href="{{ route(USER_SETTING_PAY_CREATE_CARD) }}" type="button" class="btn custom-btn-success">{{ trans('attributes.pay_api.btn_check_card_ok') }}</a>
            </div>
        </div>
    </div>
</div>
