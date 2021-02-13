@extends('layout.home.master')
@section('content')
<div class="content-wrapper">
    <div class="container-fluid container-wrapper container-wrapper-bank wrapper-bank-list">
        <div id="main-info-assessment">
            <div class="row row-header m50b">
                <div class="col-12 text-center text-md-left p0">
                    <h3 class="m0">{{ $userProfile->profile->company_name ?? '' }}</h3>
                </div>
            </div>

            <div class="d-flex col-8 text-center text-lg-right m0 p0">
                @if(isset($currentUser->id) && $userProfile->profile->user_id == $currentUser->id)
                    <div class="w-auto text-center text-md-right m0 ml-auto p0">
                        <button type="button" class="btn br8 custom-btn-default dropdown-toggle fs15 fs13-sp m5t" data-toggle="dropdown" aria-expanded="true">{{ trans('attributes.my_page.btn_default.title') }}</button>
                        <ul class="dropdown-menu list-house-tax m15t fs14">
                            @if(in_array($currentUser->role, [BROKER]))
                                <li class="p5"><a href="{{ route(USER_PROFILE_EDIT, ['role' => ROLES[$currentUser->role], 'id' => $currentUser->id]) }}" class="parent-checkbox" data-value="" tabIndex="-1">{{ trans('attributes.my_page.btn_default.edit_vendor_information') }}</a></li>
                            @elseif(in_array($currentUser->role, [EXPERT]))
                                <li class="p5"><a href="{{ route(USER_PROFILE_EDIT, ['role' => ROLES[$currentUser->role], 'id' => $currentUser->id]) }}" class="parent-checkbox" data-value="" tabIndex="-1">{{ trans('attributes.my_page.btn_default.expert_information_editing') }}</a></li>
                            @endif
                            <li class="p5"><a href="{{ route(USER_ARTICLE_TEXT_ADD, ['screen' => 'topic_list', 'page' => $dataTopic->currentPage()]) }}" class="parent-checkbox" data-value="" tabIndex="-1">{{ trans('attributes.my_page.btn_default.new_topics') }}</a></li>
                            <li class="p5"><a href="{{ route(USER_ARTICLE_TEXT) }}" class="parent-checkbox" data-value="" tabIndex="-1">{{ trans('attributes.my_page.btn_default.topics_management') }}</a></li>
                            <li class="p5"><a href="{{ route(USER_ARTICLE_PHOTO_CREATE, ['screen' => 'topic_list', 'page' => $dataTopic->currentPage()]) }}" class="parent-checkbox" data-value="" tabIndex="-1">{{ trans('attributes.my_page.btn_default.new_photo_archive') }}</a></li>
                            <li class="p5"><a href="{{ route(USER_PHOTO_ARCHIVE_INDEX) }}" class="parent-checkbox" data-value="" tabIndex="-1">{{ trans('attributes.my_page.btn_default.photo_archive_management') }}</a></li>
                        </ul>
                    </div>
                @else
                    <div class="w-auto text-center text-md-right m0 ml-auto p0">
                        <a href="#" class="btn custom-btn-primary fs15 sort-property m0 p18l p18r w-auto">{{ trans('attributes.my_page.chat') }}</a>
                        <a href="#" class="btn custom-btn-primary fs15 sort-property m0 p18l p18r w-auto">{{ trans('attributes.my_page.inquiry') }}</a>
                    </div>
                @endif
            </div>

            <div class="col-8 m30b m30t p0">
                <div class="m0 diagram-analysis">
                    <div class="diagram-block p0">
                        <div class="p30">
                            <div class="user_topics_wrap mp_r">
                                <div class="d-flex m25b m0l">
                                    <p class="fs16 fw-bold m0">{{ trans('attributes.my_page.topics') }}</p>
                                </div>
                                @forelse($dataTopic as $data)
                                    <a href="
                                    @if(isset($currentUser->id) && $userProfile->profile->user_id == $currentUser->id)
                                    {{ route(USER_ARTICLE_TEXT_EDIT, ['id'=> $data->id, 'screen' => 'topic_list', 'page' => $dataTopic->currentPage()])}}
                                    @else
                                    {{ route(PREVIEW_TOPIC_DETAIL, ['id' => $data->id, 'screen' => 'topic_list', 'page' => $dataTopic->currentPage()]) }}
                                    @endif
                                        " class="row topics_article fs15">
                                        <div class="category" style="background: {{ $data->category->color }}">{{ $data->category->name }}</div>
                                        <div class="title m10l topic-title break-all d-none">{{ $data->title }}</div>
                                    </a>
                                @empty
                                    {{ __('attributes.common.no_data') }}
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="d-flex col-8 text-center text-lg-right m0 p0 m30b">
                <div class="w-auto text-center text-md-right m0 mr-auto p0">
                    <a href="{{ route(MY_PAGE, [ROLES[$userProfile->role], $userProfile->profile->user_id]) }}" class="btn custom-btn-default fs15 sort-property m0 p18l p18r w-auto">{{ trans('attributes.my_page.topic.back') }}</a>
                </div>
                <div class="w-auto text-lg-right p0 text-right group-button-top d-inline-block ml-auto ">
                    {{ $dataTopic->appends(['user_id' => $userProfile->id])->links('partials.text_topic', ['totalPage' => ceil(($dataTopic->total())/($dataTopic->perPage()))]) }}
                </div>
            </div>

            <div class="d-flex col-8 text-center text-lg-right m0 p0">
                @if(!(isset($currentUser->id) && $userProfile->profile->user_id == $currentUser->id))
                    <div class="w-auto text-center text-md-right m0 ml-auto p0">
                        <a href="#" class="btn custom-btn-primary fs15 sort-property m0 p18l p18r w-auto">{{ trans('attributes.my_page.chat') }}</a>
                        <a href="#" class="btn custom-btn-primary fs15 sort-property m0 p18l p18r w-auto">{{ trans('attributes.my_page.inquiry') }}</a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
    <script src="{{ asset('dist/js/list.min.js') }}"></script>
@endsection
