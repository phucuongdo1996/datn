@extends('layout.home.master')
@section('content')
<div class="container-fluid container-wrapper container-wrapper-bank wrapper-bank-list">
    <div id="main-info-assessment">
        <div class="row row-header m50b">
            <div class="col-12 text-center text-md-left p0">
                <h3 class="m0">{{ trans('attributes.my_page.btn_default.photo_archive_management') }}</h3>
            </div>
        </div>

        <form id="form-condition-1" class="col-8 text-lg-right m0 m30b p0 text-right group-button-top" action="" method="get">
            <div class="d-inline-block">
                <button type="button" class="btn br8 custom-btn-default dropdown-toggle fs15 fs13-sp m5t" data-toggle="dropdown" aria-expanded="true">
                    {{ trans('attributes.my_page.btn_default.title') }}
                </button>
                <ul class="dropdown-menu  list-house-tax m15t fs14">
                    @if(in_array($currentUser->role, [BROKER]))
                        <li class="p5">
                            <a href="{{ route(USER_PROFILE_EDIT, ['role' => ROLES[$currentUser->role], 'id' => $currentUser->id]) }}" class="color-title-chart parent-checkbox" data-value="" tabIndex="-1">
                                {{ trans('attributes.my_page.btn_default.edit_vendor_information') }}
                            </a>
                        </li>
                    @elseif(in_array($currentUser->role, [EXPERT]))
                        <li class="p5">
                            <a href="{{ route(USER_PROFILE_EDIT, ['role' => ROLES[$currentUser->role], 'id' => $currentUser->id]) }}" class="color-title-chart parent-checkbox" data-value="" tabIndex="-1">
                                {{ trans('attributes.my_page.btn_default.expert_information_editing') }}
                            </a>
                        </li>
                    @endif
                    <li class="p5">
                        <a href="{{ route(USER_ARTICLE_TEXT_ADD, ['screen' => 'photo_list', 'page' => $articlePhotos->currentPage()])}}" class="color-title-chart parent-checkbox" data-value="" tabIndex="-1">
                            {{ trans('attributes.my_page.btn_default.new_topics') }}
                        </a>
                    </li>
                    <li class="p5">
                        <a href="{{ route(USER_ARTICLE_TEXT) }}" class="color-title-chart parent-checkbox" data-value="" tabIndex="-1">
                            {{ trans('attributes.my_page.btn_default.topics_management') }}
                        </a>
                    </li>
                    <li class="p5">
                        <a href="{{ route(USER_ARTICLE_PHOTO_CREATE, ['screen' => 'photo_list', 'page' => $articlePhotos->currentPage()]) }}" class="color-title-chart parent-checkbox" data-value="" tabIndex="-1">
                            {{ trans('attributes.my_page.btn_default.new_photo_archive') }}
                        </a>
                    </li>
                    <li class="p5">
                        <a href="{{ route(USER_PHOTO_ARCHIVE_INDEX) }}" class="color-title-chart parent-checkbox" data-value="" tabIndex="-1">
                            {{ trans('attributes.my_page.btn_default.photo_archive_management') }}
                        </a>
                    </li>
                </ul>
            </div>
            <a href="{{ route(USER_ARTICLE_PHOTO_CREATE, ['screen' => 'photo_list', 'page' => $articlePhotos->currentPage()]) }}" class="btn custom-btn-primary fs15 sort-property m0 p18l p18r w-auto m15l">{{ trans('attributes.my_page.topics_management.btn_add') }}</a>
            <div class="d-inline-block cus-paginate m15l">
                @include('backend.my_pages.photo_archive.photo_paginate')
            </div>
        </form>

        <div class="col-8">
            @include('partials.flash_messages')
        </div>

        <div class="col-8 m30b m30t p0">
            <div class="m0 diagram-analysis">
                <div class="diagram-block p0">
                    <div class="p30">
                        <div class="user_photo_wrap mp_r">
                            <div class="centered-vertical m15b m0l align-center">
                                <p class="fs16 fw-bold m0 m10r">{{ trans('attributes.my_page.photo_archive') }}</p>
                            </div>

                            @forelse($articlePhotos as $key => $articlePhoto)
								
								
                                <div class="row photo_article fs15 centered-vertical m30t">
                                    <a href="{{ route(USER_ARTICLE_PHOTO_EDIT, $articlePhoto->id) }}" class="photo_article_item_edit col-3">
                                        <div class="img">
                                            @if($articlePhoto->image_1 != null)
                                                <img src="{{ url(PATH_SRC_ARTICLE_PHOTO . $articlePhoto->image_1) }}" alt=""/>
                                            @elseif($articlePhoto->image_2 != null)
                                                <img src="{{ url(PATH_SRC_ARTICLE_PHOTO . $articlePhoto->image_2) }}" alt=""/>
                                            @else
                                                <img src="{{ url(PATH_SRC_ARTICLE_PHOTO . $articlePhoto->image_3) }}" alt=""/>
                                            @endif
                                        </div>
                                    </a>
                                    <div class="edit_box col-9">
                                        <a href="{{ route(USER_ARTICLE_PHOTO_EDIT, $articlePhoto->id) }}" class="article-caption" id="article-caption-{{$key}}">
                                            <div class="txt text-caption break-all" id="text-caption-{{$key}}" hidden>{{ $articlePhoto->caption }}</div>
                                        </a>
                                        <p class="m-0">{{ trans('attributes.my_page.photo_archive_img.create_at') }} : {{ date('Y/m/d', strtotime($articlePhoto['created_at'])) }}</p>
                                        @if($articlePhoto['updated_at'] != null)
                                        <p class="m-0 mt-1">{{ trans('attributes.my_page.photo_archive_img.update_at') }} : {{ date('Y/m/d', strtotime($articlePhoto['updated_at'])) }}</p>
                                        @endif
										{{-- <p class="m-0 mt-1">{{ trans('attributes.my_page.photo_archive_img.user_name') }} : {{ date('Y/m/d', strtotime($articlePhoto['updated_at'])) }}</p> --}}
                                        <div class="row m-0 mt-2">
                                            <a href="{{ route(USER_ARTICLE_PHOTO_EDIT, $articlePhoto->id) }}" type="button" class="btn br8 custom-btn-default fs15 fs13-sp">{{ trans('attributes.common.edit') }}</a>
                                            <button type="button" class="btn br8 custom-btn-danger fs15 fs13-sp m10l destroy-article-photo" data-toggle="modal" data-target="#confirm-delete-article-photo" data-id="{{ $articlePhoto->id }}">{{ trans('attributes.common.delete') }}</button>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="text-center">{{ __('attributes.common.no_data') }}</div>
                            @endforelse
                            @include('modal.confirm_delete_article_photo')
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="d-flex col-8 text-center text-lg-right m0 p0 m30b">
            <div class="w-auto text-lg-right p0 text-right group-button-top d-inline-block ml-auto ">
                <div class="d-inline-block cus-paginate m0">
                    @include('backend.my_pages.photo_archive.photo_paginate')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
    <script src="{{ asset('dist/js/article_photo.min.js') }}"></script>
@endsection
