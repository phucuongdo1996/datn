<div class="modal fade" id="confirm-rent-roll">
    <div class="modal-dialog">
        <div class="modal-content br8">
            <form id="form-delete-rent-roll" method="POST" class="form-data-submit">
                @method('DELETE')
                @csrf
                <input type="text" name="page" class="d-none" value="{{ request()->page }}">
                <div class="modal-header fs16">
                    {{ trans('attributes.repair_history.confirm_delete') }}
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn custom-btn-default" data-dismiss="modal">
                        {{ trans('attributes.button.btn_cancel') }}
                    </button>
                    <button type="submit" id="submit-delete-house" class="btn custom-btn-success">
                        {{ trans('attributes.button.btn_OK') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
