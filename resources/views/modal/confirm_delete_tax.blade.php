<div class="modal fade" id="confirm-delete-tax">
    <div class="modal-dialog">
        <div class="modal-content br8">
            <form id="form-delete-tax" method="POST" class="form-data-submit">
                @method('DELETE')
                @csrf
                <div class="modal-header fs16">
                    <p class="title-delete-tax"><span></span></p>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn custom-btn-default" data-dismiss="modal">
                        {{ trans('attributes.button.btn_cancel') }}
                    </button>
                    <button type="submit" id="submit-delete-tax" class="btn custom-btn-success">
                        {{ trans('attributes.button.btn_OK') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
