<div class="modal" id="modal-edit-email" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-content-unhead">
            <div class="modal-body modal-body-unhead">
                <form action="{{ route(TOP) }}">
                    <div class="contain-modal">
                        <div class="text-center">
                            <div id="content-edit-email-1" class="fs18">{{ trans('messages.notification.accuracy_email_change_1') }}</div>
                            <div id="content-edit-email-2" class="fs18">{{ trans('messages.notification.accuracy_email_change_2') }}</div>
                        </div>
                        <div class="text-center p15t">
                            <button type="submit" class="btn custom-btn-success">
                                {{ trans('attributes.button.btn_OK') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
