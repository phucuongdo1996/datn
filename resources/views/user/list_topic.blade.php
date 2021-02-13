@extends('layout.home.master')
@section('content')
    <div class="content-wrapper content-home-user">
        <div class="container-fluid container-wrapper container-wrapper-bank">
            <div id="main-info-assessment">
                <div class="row row-header m50b">
                    <div class="row m0">
                        <div class="col-12 text-center text-md-left p0">
                            <h3 class="m0">{{ trans('attributes.admin.manage_topic_title') }}</h3>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-8 order-md-1 flex-fill">
                        <div class="card topics h-100 mb-0">
                            <div class="card-body p30">
                                <div class="topicsList">
                                    @forelse($topics as $topic)
                                        <dl>
                                            <dt>
                                                <div class="icon">
                                                    <div class="iconInner">
                                                        <img src="{{ isset($topic['profile']['avatar_thumbnail']) ? url(PATH_SRC_AVATAR . $topic['profile']['avatar_thumbnail']) : asset('images/user_default.png') }}">
                                                    </div>
                                                </div><!-- icon -->
                                            </dt>
                                            <dd>
                                                <div class="textHead">
                                                    <a href="{{ route(MY_PAGE, ['role' => ROLES[$topic['user']['role']], 'userId' => $topic['user']['id']]) }}">{{ $topic['profile']['company_name'] }}</a>
                                                    <p>{{ date('Y/m/d', strtotime($topic['created_at'])) }}</p>
                                                    <p><span class="topicsCat {{ 'cat_'.$topic['category']['id'] }}">{{ $topic['category']['name'] }}</span>
                                                    </p>
                                                </div><!-- textHead -->
                                                <div class="text">
                                                    <a href="{{ route(PREVIEW_TOPIC_DETAIL, ['id' => $topic['id'], 'screen' => SCREEN_TOPICS]) }}">{{ setMaxLength($topic['title'], FLAG_ONE_HUNDRED) }}</a>
                                                </div><!-- text -->
                                            </dd>
                                        </dl>
                                    @empty
                                        <div class="text-center">{{ trans('attributes.common.no_data') }}</div>
                                    @endforelse
                                </div><!-- topicsList -->
                            </div><!-- card-body -->
                            <div class="card-footer">
                                {{ $topics->links('partials.custom_pagination_manager', ['paginator' => $topics]) }}
                            </div>
                        </div><!-- card -->
                    </div><!-- col-12 -->
                </div><!-- row -->

                <div class="row col-8 m-0 m60t p40b position-relative">
                    <a href="{{ route(USER_HOME) }}" class="btn btn-primary text-center content-zoom-chart">{{ trans('attributes.button.btn_back_home') }}</a>
                </div>
            </div>
        </div>
    </div>
@endsection
