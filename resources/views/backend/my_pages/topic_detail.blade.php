@extends('layout.home.master')
@section('content')


    <div class="content-wrapper">
        <div class="container-fluid container-wrapper container-wrapper-bank wrapper-bank-list">
            <div id="main-info-assessment">
                <div class="row row-header m50b">
                    <div class="row m0">
                        <div class="col-12 text-center text-md-left p0">
                            <h3 class="m0">{{ $userProfile->profile->company_name ?? '' }}</h3>
                        </div>
                    </div>
                </div>
                <div class="d-flex col-8 text-center text-lg-right m0 p0">
                    <div class="w-auto text-center text-md-right m0 ml-auto p0">
                        <a href="{{route(MY_PAGE, ['role' => ROLES[$dataTopic['user']['role']], 'userId' => $dataTopic['user']['id']])}}" class="btn custom-btn-success fs15 sort-property w-auto ">{{ trans('attributes.my_page.gopage') }}</a>
                        <a href="#" class="btn custom-btn-primary fs15 sort-property w-auto mt-3 mt-sm-0">{{ trans('attributes.my_page.chat') }}</a>
                        <a href="#" class="btn custom-btn-primary fs15 sort-property w-auto mt-3 mt-sm-0">{{ trans('attributes.my_page.inquiry') }}</a>
                    </div>
                </div>

                <div class="col-8 m30b p0 m30t">
                    <div class="m0 diagram-analysis">
                        <div class="diagram-block bd-radius-sp p0">
                            <div class="p30 user_topics_wrap mp_r">
                                <div class="d-flex m0l">
                                    <p class="fs16 fw-bold m0 break-all">{{ $dataTopic->title }}</p>
                                </div>
                                <div class="mt-3 topics_article">
                                    <div class="category" style="background: {{ $dataTopic->category->color }}">{{ $dataTopic->category->name }}</div>
                                </div>
                                <div class="mt-1 topics_date">
                                    <div class="category">{{ date('Y/m/d', strtotime($dataTopic['created_at'])) }}</div>
                                </div>
                                <div class="col-12-sp p0 mt-4">
                                    <div class="content_wrap">
                                        {!! $dataTopic->content !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-flex col-8 text-center text-lg-right m0 p0 m30b">
                    <div class="w-auto text-center text-md-right m0 mr-auto p0">
                        @php($request = request()->all())
                        @if(isset($request['screen']))
                            @switch($request['screen'])
                                @case(SCREEN_MY_PAGE[FLAG_TWO])
                                <a href="{{ route(LIST_TOPIC, ['id' => $userProfile->profile->user_id, 'page' => isset($request['page']) ? $request['page'] : 1]) }}"
                                   class="btn custom-btn-default fs15 sort-property m0 p18l p18r w-auto">{{ trans('attributes.my_page.topic.back') }}</a>
                                @break
                                @case(MY_PAGE)
                                <a href="{{ route(MY_PAGE, [ROLES[$role], $userProfile->profile->user_id]) }}" class="btn custom-btn-default fs15 sort-property m0 p18l p18r w-auto">{{ trans('attributes.my_page.topic.back') }}</a>
                                @break
                                @case(SCREEN_TOPICS)
                                <a href="{{ route(USER_LIST_TOPIC) }}" class="btn custom-btn-default fs15 sort-property m0 p18l p18r w-auto">{{ trans('attributes.my_page.topic.back') }}</a>
                                @break
                            @endswitch
                        @else
                            <a href="{{ route(USER_HOME) }}" class="btn custom-btn-default fs15 sort-property m0 p18l p18r w-auto">{{ trans('attributes.my_page.topic.back') }}</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

