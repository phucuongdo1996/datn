<div class="modal fade" id="modal-delete-photo">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="form-delete-photo" method="POST">
                @csrf
                @method('delete')
                <input type="hidden" id="photo-id">
                <div class="modal-header fs16">
                    {{ trans('attributes.admin_manager.photos.title_form_delete') }}
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body form-group">
                    <label for="message-text" class="col-form-label">{{ trans('attributes.my_page.topic.divorce') }}</label>
                    <textarea id="reason-delete-photo" class="form-control" name="reason_delete"></textarea>
                </div>
            </form>
            <div class="modal-footer">
                <button type="button" class="btn custom-btn-default" data-dismiss="modal">{{ trans('attributes.button.btn_cancel') }}</button>
                <button id="button-delete-photo" type="submit" class="btn custom-btn-success">OK</button>
            </div>
        </div>
    </div>
</div>
