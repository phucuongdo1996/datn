@extends('layout.home.master')
@section('content')
<div class="container-fluid container-wrapper container-wrapper-bank wrapper-bank-list">
    <form id="article-photo-add" action="{{ route(ADMIN_ARTICLE_PHOTO_UPDATE, $data['id']) }}" enctype="multipart/form-data" method="POST">
        @csrf
        <input type="hidden" name="url_redirect" value="{{ request()->url_redirect }}">
        <div class="row row-header m50b">
            <div class="row m0">
                <div class="col-12 text-center text-md-left p0">
                    <h3 class="m0">{{ $data['user']['profile']['person_charge_last_name'].$data['user']['profile']['person_charge_first_name'] }}{{ trans('attributes.article_photo.title_edit') }}</h3>
                </div>
            </div>
        </div>
        <div class="col-8 p0">
            @include('partials.flash_messages')
        </div>
        <div class="row">
            <div class="col-8">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{ trans('attributes.article_photo.user_information') }}</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                <i class="fas fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="row m0 br10 bg-white">
                            <div class="table-responsive">
                                <table id="table-property" class="table table-bordered table-striped border-0 m0">
                                    <tr class="table">
                                        <th class="border-left-0 w30-percent">{{ trans('attributes.article_photo.user_name') }}</th>
                                        <td class="border-right-0 w70-percent fs13">{{ $data['user']['profile']['person_charge_last_name'].$data['user']['profile']['person_charge_first_name'] }}</td>
                                    </tr>
                                    <tr class="table">
                                        <th class="border-left-0 w30-percent">{{ trans('attributes.article_photo.last_login_date') }}</th>
                                        <td class="border-right-0 w70-percent fs13">{{ convertDateTime($data['user']['last_login']) }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{ trans('attributes.article_photo.post_information') }}</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                <i class="fas fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="row m0 br10 bg-white">
                            <div class="table-responsive">
                                <table id="table-property" class="table table-bordered table-striped border-0 m0">
                                    <tr class="table">
                                        <th class="border-left-0 w30-percent">{{ trans('attributes.article_photo.post_date') }}</th>
                                        <td class="border-right-0 w70-percent fs13">{{ convertDateTime($data['created_at']) }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-8 m30b p0">
            <div class="m0 diagram-analysis">
                <div class="diagram-block p0">
                    <div class="p30">
                        <div class="title-image centered-vertical m0l align-center">
                            <p class="fs16 fw-bold m0 m10r">{{ trans('attributes.article_photo.title_img') }}</p>
                            <p class="fs14 m0">{{ trans('attributes.article_photo.title_img_note') }}</p>
                        </div>
                        <p class="error-message m15b m0 p0" data-error="required-image"></p>
                        <div class="wp100 col-12-sp p0 m30b d-flex">
                            <div class="col-4">
                                <div id="photo-1" class="essential-img essential-icon-img pointer">
                                    @if(isset($data['image_1']))
                                        <button class="cancel-image" style="display: block"><i class="material-icons">clear</i></button>
                                        <img class="img-preview-map" src="{{ asset(STORAGE_LOCATION.$data['image_1']) }}">
                                    @else
                                        <button class="cancel-image"><i class="material-icons">clear</i></button>
                                        <div><img class="default_plus_icon" src="{{asset('images/icon-plus.png')}}"></div>
                                    @endif
                                </div>
                                <p class="error-message m0" data-error="photo-1"></p>
                            </div>
                            <div class="col-4">
                                <div id="photo-2" class="essential-img essential-icon-img pointer">
                                    @if(isset($data['image_2']))
                                        <button class="cancel-image" style="display: block"><i class="material-icons">clear</i></button>
                                        <img class="img-preview-map" src="{{ asset(STORAGE_LOCATION.$data['image_2']) }}">
                                    @else
                                        <button class="cancel-image"><i class="material-icons">clear</i></button>
                                        <div><img class="default_plus_icon" src="{{asset('images/icon-plus.png')}}"></div>
                                    @endif
                                </div>
                                <p class="error-message m0" data-error="photo-2"></p>
                            </div>
                            <div class="col-4">
                                <div id="photo-3" class="essential-img essential-icon-img pointer">
                                    @if(isset($data['image_3']))
                                        <button class="cancel-image" style="display: block"><i class="material-icons">clear</i></button>
                                        <img class="img-preview-map" src="{{ asset(STORAGE_LOCATION.$data['image_3']) }}">
                                    @else
                                        <button class="cancel-image"><i class="material-icons">clear</i></button>
                                        <div><img class="default_plus_icon" src="{{asset('images/icon-plus.png')}}"></div>
                                    @endif
                                </div>
                                <p class="error-message m0" data-error="photo-3"></p>
                            </div>
                        </div>
                        <div class="centered-vertical m15b m0l align-center">
                            <p class="fs16 fw-bold m0 m10r">{{ trans('attributes.article_photo.title_caption') }}</p>
                            <p class="fs14 m0">{{ trans('attributes.article_photo.title_caption_note') }}</p>
                        </div>
                        <div class="wp100 col-12-sp p0 m30b">
                            <textarea name="caption" id="items" cols="15" rows="20" class="caption form-control m0 h-auto fs14 text-left">{{ $data['caption'] }}</textarea>
                            <p class="error-message m0" data-error="caption"></p>
                        </div>
                        <div class="centered-vertical m15b m0l align-center">
                            <p class="fs16 fw-bold m0 m10r">{{ trans('attributes.article_photo.reason_for_change') }}</p>
                        </div>
                        <div class="wp100 col-12-sp p0 m30b">
                            <textarea name="reason" id="items" cols="15" rows="5" class="form-control m0 h-auto fs14 text-left">{{ $data['reason'] }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <input type="file" name="image_1" hidden>
        <input type="file" name="image_2" hidden>
        <input type="file" name="image_3" hidden>

        <input type="hidden" name="base_image_1" value="{{ $data['image_1'] }}" class="base-image">
        <input type="hidden" name="base_image_2" value="{{ $data['image_2'] }}" class="base-image">
        <input type="hidden" name="base_image_3" value="{{ $data['image_3'] }}" class="base-image">
        <input type="hidden" name="current_time" value="{{ $data['updated_at'] }}">
        <input type="hidden" name="created_at_photo" value="{{ $data['created_at'] }}">

        <div class="col-8 text-lg-right m0 m30b p0 text-right group-button-top">
            <button id="save-photo" type="submit" class="btn custom-btn-primary fs15 sort-property m0 p18l p18r w-auto">{{ trans('attributes.my_page.topic.save') }}</button>
        </div>
    </form>
</div>
@endsection
@section('js')
    <script src="{{ asset('dist/js/article_photo.min.js') }}"></script>
@endsection
