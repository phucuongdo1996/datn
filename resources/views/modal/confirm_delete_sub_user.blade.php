<div class="modal fade" id="sub-user-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ trans('attributes.sub_user.confirm_delete') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans('attributes.button.btn_cancel') }}</button>
                <form id="form-delete-sub-user" method="POST" class="form-data-submit">
                    @method('DELETE')
                    @csrf
                    <button type="submit" class="btn btn-danger">{{ trans('attributes.button.btn_delete') }}</button>
                </form>
            </div>
        </div>
    </div>
</div>
