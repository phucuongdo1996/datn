<div class="modal fade" id="modal-show-notification-downgrade">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
                <div class="modal-header fs16">
                    <span id="text-modal-notification-downgrade-free">
                        {{ trans('messages.pay_api.downgrade_free.title') }} <br>
                        {{ trans('messages.pay_api.downgrade_free.text_1') }} <br>
                        {{ trans('messages.pay_api.downgrade_free.text_2') }} <br>
                        {{ trans('messages.pay_api.downgrade_free.text_3') }} <br>
                        {{ trans('messages.pay_api.downgrade_free.text_4') }} <br>
                        {{ trans('messages.pay_api.downgrade_free.text_5') }} <br>
                        {{ trans('messages.pay_api.downgrade_free.text_6') }} <br>
                        {{ trans('messages.pay_api.downgrade_free.text_7') }} <br>
                        {{ trans('messages.pay_api.downgrade_free.text_8') }} <br>
                        {{ trans('messages.pay_api.downgrade_free.text_9') }} <br>
                    </span>
                    <span id="text-modal-notification-downgrade-fee">
                        {{ trans('messages.pay_api.downgrade_fee.title') }} <br>
                        {{ trans('messages.pay_api.downgrade_fee.text_1') }} <br>
                        {{ trans('messages.pay_api.downgrade_fee.text_2') }} <br>
                        {{ trans('messages.pay_api.downgrade_fee.text_3') }} <br>
                        {{ trans('messages.pay_api.downgrade_fee.text_4') }} <br>
                        {{ trans('messages.pay_api.downgrade_fee.text_5') }} <br>
                    </span>
                    <span id="text-modal-notification-downgrade"></span>
                    <button type="button" class="close btn-process" data-dismiss="modal">&times;</button>
                </div>
            <div class="modal-footer">
                <button type="button" class="btn custom-btn-default btn-process" data-dismiss="modal">{{ trans('attributes.pay_api.btn_check_card_cancel') }}</button>
                <button id="downgrade-free" type="button" class="btn custom-btn-success btn-downgrade btn-process" data-type="{{ FREE }}">{{ trans('attributes.pay_api.btn_check_card_ok') }}</button>
                <button id="downgrade-basic" type="button" class="btn custom-btn-success btn-downgrade btn-process" data-type="{{ BASIC }}">{{ trans('attributes.pay_api.btn_check_card_ok') }}</button>
            </div>
        </div>
    </div>
</div>
