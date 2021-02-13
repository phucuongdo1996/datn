@extends('layout.home.master')
@section('content')
    <div class="container-fluid container-wrapper container-wrapper-bank container-list-topic">
        <div id="main-info-assessment">
            <div class="row row-header mb-5">
                <div class="row m0">
                    <div class="col-12 text-center text-md-left p0">
                        <h3 class="m0">{{ trans('attributes.admin.photo.list_title') }}</h3>
                    </div>
                </div>
            </div>
            @include('partials.flash_messages')
            <!--profile edit-->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">{{ trans('attributes.admin.photo.archive') }}</h3>
                            <div class="card-tools d-flex align-items-center">
                                <form class="input-group input-group-sm form-search-photo" action="{{ route(ADMIN_ARTICLE_PHOTO_INDEX) }}">
                                    <input type="text" class="form-control" name="user_name" placeholder="{{ trans('attributes.article_photo.user_name') }}" value="{{ $params['user_name'] ?? '' }}">
                                    <div class="input-group-append">
                                        <div class="btn btn-primary btn-search-photo">
                                            <i class="fas fa-search"></i>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="user_photo_wrap mp_r">
                                @php($index = FLAG_ZERO)
                                @forelse($photos->chunk(FLAG_TWO) as $chunkPhotos)
                                    <div class="row photo_article fs15 centered-vertical photo-article-{{$index}}  mt-4">
                                        @foreach($chunkPhotos as $photo)
                                            @php($index ++ )
                                            <div class="col-6 row d-flex align-items-center">
                                                <a href="#" class="photo_article_item_edit col-4" data-toggle="modal" data-target=".photo-{{ $photo['id'] }}" data-keyboard="true" data-backdrop="true">
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
                                                <div class="edit_box col-8">
                                                    <a href="#" class="article-caption" id="article-caption-{{$index - FLAG_ONE}}" data-toggle="modal" data-target=".photo-{{ $photo['id'] }}" data-keyboard="true" data-backdrop="true">
                                                        <div class="txt text-caption break-all" id="text-caption-{{$index - FLAG_ONE}}">{{ $photo['caption'] ?? '' }}</div>
                                                    </a>
                                                    <p class="mt-1"><a href="{{ route(ADMIN_MANAGE_USER_DETAIL_INDEX, $photo['user_id']) }}">{{ $photo['user_name'] }}</a></p>
                                                    <p class="mt-1">{{ dateTimeFormat($photo['created_at']) }}</p>
                                                    <div class="row m20t">
                                                        <a href="{{route(ADMIN_ARTICLE_PHOTO_EDIT, ['articlePhotoId' => $photo['id']])}}" type="button" class="btn br8 custom-btn-default btn-sm">{{ trans('attributes.common.edit') }}</a>
                                                        <button type="button" data-id="{{ $photo['id'] }}" class="btn remove_photo br8 custom-btn-danger  btn-sm m10l">{{ trans('attributes.common.delete') }}</button>
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

                        <div class="card-footer">
                            <div class="row">
                                <div class="col-sm-12 col-md-5">
                                    <div class="dataTables_info" id="" role="status" aria-live="polite">
                                        @if( !empty($photos->items()))
                                            <span class="number-record m10r">{!! FLAG_ONE . ' - ' . FLAG_FIFTY . " " . "を表示中" !!}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-7">
                                    <ul class="pagination pagination-sm m-0 float-right">
                                        {{ $photos->appends( $_GET )->links('partials.custom_pagination_manager', ['paginator' => $photos]) }}
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('modal.delete.delete_photo')
@endsection
@section('js')
    <script src="{{ asset('dist/js/article_photo.min.js') }}"></script>
@endsection

