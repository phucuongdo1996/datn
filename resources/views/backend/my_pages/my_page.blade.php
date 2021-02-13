@extends('layout.home.master')
@section('content')
<div class="my-page-container">
    <div class="container-fluid container-wrapper-bank">
        <div id="main-info-assessment">
            <div class="row row-header m50b">
                <div class="row m0">
                    <div class="col-12 text-center text-md-left p0">
                        <h3 class="m0">{{ $userProfile->profile->company_name ?? '' }} </h3>
                    </div>
                </div>
            </div>

            <div class="d-flex col-12 col-sm-8 text-center text-lg-right m0 p0 m30b">
                @if(isset($currentUser->id) && $userProfile->profile->user_id == $currentUser->id)
                    <div class="w-auto text-center text-md-right m0 ml-auto p0">
                        <button type="button" class="btn br8 custom-btn-default dropdown-toggle fs15 fs13-sp m5t" data-toggle="dropdown" aria-expanded="true">{{ trans('attributes.my_page.btn_default.title') }}</button>
                        <ul class="dropdown-menu list-house-tax m15t fs14">
                            @if(in_array($currentUser->role, [BROKER]))
                                <li class="p5"><a href="{{ route(USER_PROFILE_EDIT, ['role' => ROLES[$currentUser->role], 'id' => $currentUser->id]) }}" class="parent-checkbox" data-value="" tabIndex="-1">{{ trans('attributes.my_page.btn_default.edit_vendor_information') }}</a></li>
                            @elseif(in_array($currentUser->role, [EXPERT]))
                                <li class="p5"><a href="{{ route(USER_PROFILE_EDIT, ['role' => ROLES[$currentUser->role], 'id' => $currentUser->id]) }}" class="parent-checkbox" data-value="" tabIndex="-1">{{ trans('attributes.my_page.btn_default.expert_information_editing') }}</a></li>
                            @endif
                            <li class="p5"><a href="{{ route(USER_ARTICLE_TEXT_ADD, ['screen' => MY_PAGE]) }}" class="parent-checkbox" data-value="" tabIndex="-1">{{ trans('attributes.my_page.btn_default.new_topics') }}</a></li>
                            <li class="p5"><a href="{{ route(USER_ARTICLE_TEXT) }}" class="parent-checkbox" data-value="" tabIndex="-1">{{ trans('attributes.my_page.btn_default.topics_management') }}</a></li>
                            <li class="p5"><a href="{{ route(USER_ARTICLE_PHOTO_CREATE, ['screen' => MY_PAGE]) }}" class="parent-checkbox" data-value="" tabIndex="-1">{{ trans('attributes.my_page.btn_default.new_photo_archive') }}</a></li>
                            <li class="p5"><a href="{{ route(USER_PHOTO_ARCHIVE_INDEX) }}" class="parent-checkbox" data-value="" tabIndex="-1">{{ trans('attributes.my_page.btn_default.photo_archive_management') }}</a></li>
                        </ul>
                    </div>
                @else
                    <div class="w-auto text-center text-md-right m0 ml-auto p0">
                        <a href="#" class="btn custom-btn-primary fs15 sort-property w-auto mt-3 mt-sm-0">{{ trans('attributes.my_page.chat') }}</a>
                        <a href="#" class="btn custom-btn-primary fs15 sort-property w-auto mt-3 mt-sm-0">{{ trans('attributes.my_page.inquiry') }}</a>
                    </div>
                @endif
            </div>
            @include('partials.flash_messages')

            <div class="col-12 col-sm-8 m30b p0">
                <div class="m0 diagram-analysis">
                    <div class="diagram-block p0">
                        <div class="p30">
                            <div class="row user_info_wrap mp_r">
                                <div class="img">
                                    <img src="{{ $userProfile->profile->avatar_thumbnail ? url(PATH_SRC_AVATAR . $userProfile->profile->avatar_thumbnail) : asset('images/user_default.png') }}" alt="" />
                                </div>
                                <div class="txt m25l fs15">
                                    <p>{{ $userProfile->profile->introduction ?? '' }}</p>
                                </div>
                            </div>

                            <div class="user_meta_wrap p30 m30t mp_r fs15">
                                <div class="row flex-column flex-sm-row">
                                    <div class="heading m10b">{{ trans('attributes.profile.body.label.specialty') }}</div>
                                    <div class="content break-all">
                                        @foreach($userProfile->profile->specialties as $value)
                                            <div class="row m0l">
                                                {{ $value['name'] }}
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            <div class="user_meta_wrap p30 m30t mp_r fs15">
                                <div class="row flex-column flex-sm-row">
                                    <div class="heading">
                                        {{ trans('attributes.profile.body.label.ZIP_code') }}
                                    </div>
                                    <div class="content break-all">
                                        {{ $userProfile->profile->zip_code }}
                                    </div>
                                </div>
                                <div class="row flex-column flex-sm-row">
                                    <div class="heading">
                                        {{ trans('attributes.business_plan.destination_address') }}
                                    </div>
                                    <div class="content break-all">
                                        {{ $userProfile->profile->address_city . $userProfile->profile->address_district . $userProfile->profile->address_town . $userProfile->profile->address_building }}
                                    </div>
                                </div>
                                <div class="row flex-column flex-sm-row">
                                    <div class="heading">
                                        {{ trans('attributes.profile.body.label.phone_number') }}
                                    </div>
                                    <div class="content break-all">
                                        {{ $userProfile->profile->phone ?? '' }}
                                    </div>
                                </div>
                                <div class="row flex-column flex-sm-row">
                                    <div class="heading">
                                        {{ trans('attributes.my_page.HP') }}
                                    </div>
                                    <div class="content">
                                        <a href="{{ $userProfile->profile->website_business_name ?? '#' }}" target="_blank">{{ $userProfile->profile->website_business_name ?? '' }}</a>
                                    </div>
                                </div>
                                <div class="row flex-column flex-sm-row">
                                    <div class="heading">
                                        {{ trans('attributes.profile.body.label.club') }}
                                    </div>
                                    <div class="content break-all">
                                        {{ $userProfile->profile->company_representative_last_name . $userProfile->profile->company_representative_first_name }}
                                    </div>
                                </div>
                                <div class="row flex-column flex-sm-row">
                                    <div class="heading">
                                        {{ trans('attributes.profile.body.label.other_web') }}
                                    </div>
                                    <div class="content">
                                        <a href="{{ $userProfile->profile->website_business_name_other ?? '#' }}" target="_blank">{{ $userProfile->profile->website_business_name_other ?? '' }}</a>
                                    </div>
                                </div>
                                @if($userProfile->role == BROKER)
                                    <div class="row flex-column flex-sm-row">
                                        <div class="heading">
                                            {{ trans('attributes.my_page.license') }}
                                        </div>
                                        <div class="content">
                                            {{ $userProfile->profile->license_address . trans('attributes.profile.body.content.license_number') . '(' . $userProfile->profile->license . ')' . trans('attributes.profile.body.content.license_number_1') . $userProfile->profile->number_license . trans('attributes.profile.body.content.number') }}
                                        </div>
                                    </div>
                                @endif
                            </div>
                            @if($dataTopic->count() > FLAG_ZERO)
                                <div class="user_topics_wrap border_top p25t p25b mp_r m30t">
                                    <div class="d-flex m25b m0l">
                                        <p class="fs16 fw-bold m0">{{ trans('attributes.my_page.topics') }}</p>
                                    </div>

                                    @foreach($dataTopic as $data)
                                        <a href="
                                        @if(isset($currentUser->id) && $userProfile->profile->user_id == $currentUser->id)
                                            {{ route(USER_ARTICLE_TEXT_EDIT, ['id'=> $data->id, 'screen' => 'my_page']) }}
                                        @else
                                            {{ route(PREVIEW_TOPIC_DETAIL, [$data->id, 'screen' => 'my_page']) }}
                                        @endif
                                    " class="row topics_article fs15">
                                    <div class="category" style="background: {{ $data->category->color }}">{{ $data->category->name }}</div>
                                            <div class="title m10l topic-title break-all d-none">{{ $data->title }}</div>
                                        </a>
                                    @endforeach

                                    @if($countDataTopic > LIMIT_POST_USER_NORMAL)
                                        <div class="row moreBtn_mypage_wrap fs15 m25t">
                                            <a href="{{ route(LIST_TOPIC, $userProfile->profile->user_id) }}" class="moreBtn_mypage">{{ trans('attributes.my_page.see_more') }}</a>
                                        </div>
                                    @endif
                                </div>
                            @endif

                            @if($countDataPhoto > FLAG_ZERO)
                                <div class="user_photo_wrap border_top p25t p25b mp_r m30t">
                                    <div class="d-flex m25b m0l">
                                        <p class="fs16 fw-bold m0">{{ trans('attributes.my_page.photo_archive') }}</p>
                                    </div>
                                    <div class="row photo_article fs15">
                                        @foreach($articlePhotos as $articlePhoto)
                                            <a class="photo_article_item photo_article_item_edit col-6 col-sm-4" data-toggle="modal" data-target=".photo-{{ $articlePhoto['id'] }}" data-keyboard="true" data-backdrop="true">
                                                <div class="img">
                                                    @if($articlePhoto->image_1 != null)
                                                        <img src="{{ url(PATH_SRC_ARTICLE_PHOTO . $articlePhoto->image_1) }}" alt="" />
                                                    @elseif($articlePhoto->image_2 != null)
                                                        <img src="{{ url(PATH_SRC_ARTICLE_PHOTO . $articlePhoto->image_2) }}" alt="" />
                                                    @else
                                                        <img src="{{ url(PATH_SRC_ARTICLE_PHOTO . $articlePhoto->image_3) }}" alt="" />
                                                    @endif
                                                </div>
                                                <div class="txt caption-image break-all d-none">{{ mb_strimwidth($articlePhoto->caption, 0, 30, '…', 'UTF-8') }}</div>
                                            </a>
                                        @endforeach
                                    </div>
                                    @if($countDataPhoto > LIMIT_POST_USER_NORMAL)
                                        <div class="row moreBtn_mypage_wrap fs15 m25t">
                                            <a href="{{ route(USER_LIST_PHOTO_INDEX, ['id' => $userProfile->id, 'screen' => MY_PAGE]) }}" class="moreBtn_mypage">{{ trans('attributes.my_page.see_more') }}</a>
                                        </div>
                                    @endif
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            @if(!(isset($currentUser->id) && $userProfile->profile->user_id == $currentUser->id))
                <div class="d-flex col-8 text-center text-lg-right m0 p0">
                    <div class="w-auto text-center text-md-right m0 ml-auto p0">
                        <a href="#" class="btn custom-btn-primary fs15 sort-property m0 p18l p18r w-auto">{{ trans('attributes.my_page.chat') }}</a>
                        <a href="#" class="btn custom-btn-primary fs15 sort-property m0 p18l p18r w-auto">{{ trans('attributes.my_page.inquiry') }}</a>
                    </div>
                </div>
            @endif
        </div>
    </div>
    @include('modal.photo_img')
</div>
@endsection
@section('js')
    <script src="{{ asset('dist/js/list.min.js') }}"></script>
@endsection
