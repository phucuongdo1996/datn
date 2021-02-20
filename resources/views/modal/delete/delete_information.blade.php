<div class="modal fade" id="modal-delete-information">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="form-delete-information" method="POST" action="{{ route(ADMIN_MANAGE_INFORMATION_DELETE) }}">
                @csrf
                <input type="hidden" id="delete-information-id" name="information_id">
                <div class="modal-header fs16">
                    {{ trans('attributes.admin_manager.information.title_form_delete') }}
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn custom-btn-default" data-dismiss="modal">{{ trans('attributes.button.btn_cancel') }}</button>
                    <button id="button-delete-topic" type="submit" class="btn custom-btn-success">{{ trans('attributes.common.ok') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
