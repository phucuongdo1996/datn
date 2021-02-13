<div class="card-header">
    <h3 class="card-title">{{ __('attributes.user_detail.title_photo') }}</h3>
    <div class="card-tools">
        <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
            <i class="fas fa-minus"></i></button>
    </div>
</div>
<div class="card-body">
    <div class="user_photo_wrap mp_r ">
        @php($index = FLAG_ZERO)
        @forelse($photos->chunk(FLAG_TWO) as $chunkPhotos)
            <div class="row photo_article fs15 photo-article-{{$index}} centered-vertical mt-2">
                @foreach($chunkPhotos as $photo)
                    @php($index ++ )
                    <div class="col-6 row d-flex align-items-center">
                        <a href="#" class="photo_article_item_edit col-3" data-toggle="modal" data-target=".photo-{{ $photo['id'] }}" data-keyboard="true" data-backdrop="true">
                            <div class="img">
                                @if($photo['image_1'] != null)
                                    <img src="{{ url(PATH_SRC_ARTICLE_PHOTO . $photo['image_1']) }}" alt=""/>
                                @elseif($photo['image_2'] != null)
                                    <img src="{{ url(PATH_SRC_ARTICLE_PHOTO . $photo['image_2']) }}" alt=""/>
                                @else
                                    <img src="{{ url(PATH_SRC_ARTICLE_PHOTO . $photo['image_3']) }}" alt=""/>
                                @endif
                            </div>
                        </a>
                        <div class="edit_box col-9">
                            <a href="#" class="article-caption" id="article-caption-{{$index - FLAG_ONE}}" data-toggle="modal" data-target=".photo-{{ $photo['id'] }}" data-keyboard="true" data-backdrop="true">
                                <div class="txt text-caption break-all" id="text-caption-{{$index - FLAG_ONE}}">{{ $photo['caption'] ? setMaxLength($photo['caption'], FLAG_TWO_HUNDRED) : ''}}</div>
                            </a>
                            <div class="row m20t">
                                <a href="{{route(ADMIN_ARTICLE_PHOTO_EDIT, ['articlePhotoId' => $photo['id'], 'url_redirect' => 'user_detail'])}}" type="button" class="btn br8 custom-btn-default btn-sm">{{ trans('attributes.common.edit') }}</a>
                                <button type="button" data-id="{{ $photo['id'] }}" class="btn br8 remove_photo custom-btn-danger  btn-sm m10l">{{ trans('attributes.common.delete') }}</button>
                            </div>
                        </div>
                    </div>
                @endforeach
                @include('backend.admin.photo.img')
            </div>
        @empty
            <p class="text-center m-0">{{ trans('attributes.admin.photo.no_data') }}</p>
        @endforelse
    </div>
</div>
<!-- /.card-body -->
@if($index == LIMIT_RECORD_PHOTO_USER_DETAIL)
    <div class="card-footer">
    <a href="{{ route(ADMIN_ARTICLE_PHOTO_INDEX) }}" class="btn btn-default float-right">{{ __('attributes.user_detail.display_photo') }}</a>
    </div>
@endif
@include('modal.delete.delete_photo')
