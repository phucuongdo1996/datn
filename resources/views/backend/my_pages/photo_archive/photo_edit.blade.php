@extends('layout.home.master')
@section('content')
<div class="container-fluid container-wrapper container-wrapper-bank wrapper-bank-list">
    <form id="article-photo-add" action="{{ route(USER_ARTICLE_PHOTO_UPDATE, $articlePhoto['id']) }}" enctype="multipart/form-data" method="POST">
        @csrf
        <input type="hidden" name="user_id" value="{{ $userProxy->id }}">
        <div class="row row-header m50b">
            <div class="row m0">
                <div class="col-12 text-center text-md-left p0">
                    <h3 class="m0">{{ __('attributes.article_photo.title_edit') }}</h3>
                </div>
            </div>
        </div>
        <div class="col-8 m30b p0">
            @include('partials.flash_messages')
            <div class="m0 diagram-analysis">
                <div class="diagram-block p0">
                    <div class="p30">
                        <div class="title-image centered-vertical m0l align-center">
                            <p class="fs16 fw-bold m0 m10r">{{ __('attributes.article_photo.title_img') }}</p>
                            <p class="fs14 m0">{{ __('attributes.article_photo.title_img_note') }}</p>
                        </div>
                        <p class="error-message m15b m0 p0" data-error="required-image"></p>
                        <div class="wp100 col-12-sp p0 m30b imgInputWrap d-flex">
                            <div class="col-4">
                                <div id="photo-1" class="block-img essential-icon-img pointer">
                                    @if(isset($articlePhoto['image_1']))
                                        <button class="cancel-image" style="display: block"><i class="material-icons">clear</i></button>
                                        <img class="img-preview-map" src="{{ asset(STORAGE_LOCATION.$articlePhoto['image_1']) }}">
                                    @else
                                        <button class="cancel-image"><i class="material-icons">clear</i></button>
                                        <div><img class="default_plus_icon" src="{{asset('images/icon-plus.png')}}"></div>
                                    @endif
                                </div>
                                <p class="error-message m0" data-error="photo-1"></p>
                            </div>
                            <div class="col-4">
                                <div id="photo-2" class="block-img essential-icon-img pointer">
                                    @if(isset($articlePhoto['image_2']))
                                        <button class="cancel-image" style="display: block"><i class="material-icons">clear</i></button>
                                        <img class="img-preview-map" src="{{ asset(STORAGE_LOCATION.$articlePhoto['image_2']) }}">
                                    @else
                                        <button class="cancel-image"><i class="material-icons">clear</i></button>
                                        <div><img class="default_plus_icon" src="{{asset('images/icon-plus.png')}}"></div>
                                    @endif
                                </div>
                                <p class="error-message m0" data-error="photo-2"></p>
                            </div>
                            <div class="col-4">
                                <div id="photo-3" class="block-img essential-icon-img pointer">
                                    @if(isset($articlePhoto['image_3']))
                                        <button class="cancel-image" style="display: block"><i class="material-icons">clear</i></button>
                                        <img class="img-preview-map" src="{{ asset(STORAGE_LOCATION.$articlePhoto['image_3']) }}">
                                    @else
                                        <button class="cancel-image"><i class="material-icons">clear</i></button>
                                        <div><img class="default_plus_icon" src="{{asset('images/icon-plus.png')}}"></div>
                                    @endif
                                </div>
                                <p class="error-message m0" data-error="photo-3"></p>
                            </div>
                        </div>
                        <div class="centered-vertical m15b m0l align-center">
                            <p class="fs16 fw-bold m0 m10r">{{ __('attributes.article_photo.title_caption') }}</p>
                            <p class="fs14 m0">{{ __('attributes.article_photo.title_caption_note') }}</p>
                        </div>
                        <div class="wp100 col-12-sp p0 m30b">
                            <textarea name="caption" cols="15" rows="5" class="caption form-control m0 h-auto fs14 text-left">{{ $articlePhoto['caption'] }}</textarea>
                            <p class="error-message m0" data-error="caption"></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <input type="file" name="image_1" hidden>
        <input type="file" name="image_2" hidden>
        <input type="file" name="image_3" hidden>

        <input type="hidden" name="base_image_1" value="{{ $articlePhoto['image_1'] }}" class="base-image">
        <input type="hidden" name="base_image_2" value="{{ $articlePhoto['image_2'] }}" class="base-image">
        <input type="hidden" name="base_image_3" value="{{ $articlePhoto['image_3'] }}" class="base-image">
        <input type="hidden" name="current_time" value="{{ $articlePhoto['updated_at'] }}">

        <div class="col-8 text-lg-right p0 text-right group-button-top">
            <a class="btn custom-btn-default fs15 m5b p18l p18r w-auto float-left" href="{{route(USER_PHOTO_ARCHIVE_INDEX)}}">{{ __('attributes.article_photo.btn_back') }}</a>
            <button id="save-photo" type="submit" class="btn custom-btn-primary fs15 m0 p18l p18r w-auto">
                {{ __('attributes.common.edit') }}
            </button>
        </div>
    </form>
</div>
@endsection
@section('js')
    <script src="{{ asset('dist/js/article_photo.min.js') }}"></script>
@endsection
