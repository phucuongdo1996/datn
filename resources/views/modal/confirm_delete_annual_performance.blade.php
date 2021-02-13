<div class="modal fade" id="confirm-delete-annual-performance">
    <div class="modal-dialog">
        <div class="modal-content br8">
            <form id="form-delete-house" method="post" class="form-data-submit" action="{{ route(USER_PROPERTY_ANNUAL_PERFORMANCE_DESTROY, $property['id']) }}">
                @method('delete')
                @csrf
                <div class="modal-header fs16">
                    {{ trans('messages.confirm_delete') }}
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <input type="hidden" name="annual_performance_id" value="" id="annual-performance-id">
                <input type="hidden" name="page" value="{{ request('page', FLAG_ONE) }}">
                <input type="hidden" name="old_data" value="" id="old-data">
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
<?php
