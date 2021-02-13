<div class="modal fade" id="confirm-delete-article-photo">
    <div class="modal-dialog">
        <div class="modal-content br8">
            <form method="post" class="form-data-submit" action="{{ route(USER_ARTICLE_PHOTO_DESTROY) }}">
                @method('delete')
                @csrf
                <div class="modal-header fs16">
                    {{ trans('messages.confirm_delete_article_photo') }}
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <input type="hidden" name="article_photo_id" value="" id="article-photo-id">
                <input type="hidden" name="page" value="{{ request('page', FLAG_ONE) }}">
                <div class="modal-footer">
                    <button type="button" class="btn custom-btn-default" data-dismiss="modal">
                        {{ trans('attributes.button.btn_cancel') }}
                    </button>
                    <button type="submit" class="btn custom-btn-success">
                        {{ trans('attributes.button.btn_OK') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
