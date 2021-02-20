<div class="modal fade" id="modal-show-confirm-trial">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
                <div class="modal-header fs16">
                    <span>{{ trans('messages.pay_api.confirm_end_trial') }}</span>
                    <button type="button" class="close btn-process" data-dismiss="modal">&times;</button>
                </div>
            <div class="modal-footer">
                <button type="button" class="btn custom-btn-default btn-process" data-dismiss="modal">{{ trans('attributes.pay_api.btn_check_card_cancel') }}</button>
                <button id="end-trial" type="button" class="btn custom-btn-success btn-process" data-type="{{ FREE }}">{{ trans('attributes.pay_api.btn_check_card_ok') }}</button>
            </div>
        </div>
    </div>
</div>
