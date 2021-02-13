@extends('layout.home.master')

@section('content')
    <div class="content-wrapper content-home-user">
        <div class="container-fluid container-wrapper container-wrapper-bank">
            <div class="row">
                <section class="col-12">
                    <div class="card information">
                        <div class="card-header">
                            <h3 class="card-title">{{ trans('attributes.home.user.information.title') }}</h3>
                        </div><!-- card-header -->
                        <div class="card-body">
                            <div class="informationList">
                                @forelse($information as $item)
                                    <dl>
                                        <dt class="date fs14">{{ dateTimeFormat($item['created_at']) }}</dt>
                                        <dd class="category"><span class="categoryLabel fs14 {{ $item['category'] == INFORMATION_CATEGORIES[FLAG_ZERO] ? 'cateBg_news' : 'cateBg_event' }}">{{ $item['category'] }}</span>
                                        </dd>
                                        <dd class="text">
                                            <a href="{{ route(USER_INFORMATION_DETAIL, ['id' => $item['id']]) }}" class="fs14">
                                                {{ setMaxLength($item['title'], FLAG_TWO_HUNDRED) }}
                                            </a>
                                        </dd>
                                    </dl>
                                @empty
                                    <div class="text-center">{{ trans('attributes.common.no_data') }}</div>
                                @endforelse
                            </div><!-- informationList -->
                        </div><!-- card-body -->
                        @if(!empty($information))
                            <div class="card-footer clearfix">
                                <a href="{{ route(USER_INFORMATION) }}" class="btn btn-sm btn-primary pull-right">{{ trans('attributes.home.user.information.btn_view_all') }}</a>
                            </div><!-- card-footer -->
                        @endif
                    </div><!-- card -->
                </section>
            </div><!-- row -->

            <div class="row mb-3">
                <section class="col-md-6">
                    <div class="row h-100 flex-column">
                        @if(isset($userProxy) && !$currentUser->isAdmin())
                            <div class="col-12 order-md-2 mt-3 flex-grow-0 flex-fill">
                                <div
                                    class="card registerNum mb-0 @if($currentUser->isInvestor()) trader @else manager @endif">
                                    <div class="card-body">
                                        <div class="registerNumArea mb-0">
                                            <p class="number"><span class="num">‐</span><span class="unit">users</span>
                                            </p>
                                            <p class="title">{{ $currentUser->isInvestor() ? trans('attributes.home.user.count_users.investor') : trans('attributes.home.user.count_users.other')}}</p>
                                        </div>
                                    </div><!-- card-body -->
                                </div><!-- card -->
                            </div>
                        @endif
                        <div class="col-12 order-md-1 flex-fill">
                            <div class="card topics h-100 mb-0">
                                <div class="card-header">
                                    <h3 class="card-title">{{ trans('attributes.my_page.topics') }}</h3>
                                </div><!-- card-header -->
                                <div class="card-body">
                                    <div class="topicsList">
                                        @forelse($topics as $topic)
                                            <dl>
                                                <dt>
                                                    <div class="icon">
                                                        <div class="iconInner"><img
                                                                src="{{ isset($topic['profile']['avatar_thumbnail']) ? url(PATH_SRC_AVATAR . $topic['profile']['avatar_thumbnail']) : asset('images/user_default.png') }}"
                                                                alt=""></div>
                                                    </div><!-- icon -->
                                                </dt>
                                                <dd>
                                                    <div class="textHead">
                                                        <a href="{{ route(MY_PAGE, ['role' => ROLES[$topic['user']['role']], 'userId' => $topic['user']['id']]) }}">{{ $topic['profile']['company_name'] }}</a>
                                                        <p>{{ date('Y/m/d', strtotime($topic['created_at'])) }}</p>
                                                        <p><span
                                                                class="topicsCat {{ 'cat_'.$topic['category']['id'] }}">{{ $topic['category']['name'] }}</span>
                                                        </p>
                                                    </div><!-- textHead -->
                                                    <div class="text">
                                                        <a href="{{ route(PREVIEW_TOPIC_DETAIL, $topic['id']) }}">{{ setMaxLength($topic['title'], FLAG_ONE_HUNDRED) }}</a>
                                                    </div><!-- text -->
                                                </dd>
                                            </dl>
                                        @empty
                                            <div class="text-center">{{ trans('attributes.common.no_data') }}</div>
                                        @endforelse
                                    </div><!-- topicsList -->
                                </div><!-- card-body -->
                                @if(!empty($topics))
                                    <div class="card-footer clearfix">
                                        <a href="{{ route(USER_LIST_TOPIC) }}" class="btn btn-sm btn-primary pull-right">{{ trans('attributes.admin.manage_topic_title') }}</a>
                                    </div><!-- card-footer -->
                                @endif
                            </div><!-- card -->
                        </div><!-- col-12 -->
                    </div><!-- row -->
                </section>

                <section class="col-md-6">
                    <div class="card photoArchive h-100">
                        <div class="card-header">
                            <h3 class="card-title">{{ trans('attributes.my_page.photo_archive') }}</h3>
                        </div><!-- card-header -->
                        <div class="card-body p30">
                            <div class="photoArchiveList row">
                                @forelse($articlePhotos as $articlePhoto)
                                    <a href="#" class="col-md-4 col-6" data-toggle="modal"
                                       data-target=".photo-{{ $articlePhoto['id'] }}" data-keyboard="true"
                                       data-backdrop="true">
                                        <div class="photo">
                                            <div class="photoInner h150 background-color-image">
                                                <img class="object-fit-contain" src="{{ getImageArticle([$articlePhoto['image_1'], $articlePhoto['image_2'], $articlePhoto['image_3']]) }}" alt="">
                                            </div>
                                        </div><!-- photo -->
                                        <div class="detail">
                                            <p class="title">{{ setMaxLength($articlePhoto['caption'], FLAG_ONE_HUNDRED) }}</p>
                                        </div><!-- detail -->
                                        <div class="row detail m0">
                                            <div class="user-create-home p5l p5r"
                                                 style="color: #212529">{{ date('Y/m/d', strtotime($articlePhoto['created_at'])) }}</div>
                                            <div class="user-create-home user-border-home p5l p5r">
                                                {{ $articlePhoto['profile']['company_name'] }}
                                            </div>
                                        </div>
                                    </a>
                                @empty
                                    <div class="text-center w-100">{{ trans('attributes.common.no_data') }}</div>
                                @endforelse
                            </div><!-- photoArchiveList -->
                        </div><!-- card-body -->
                        @if(!empty($articlePhotos))
                            <div class="card-footer clearfix">
                                <a href="{{ route(USER_LIST_PHOTO) }}" class="btn btn-sm btn-primary pull-right">{{ trans('attributes.admin.photo.archive') }}</a>
                            </div><!-- card-footer -->
                        @endif
                    </div><!-- card -->
                </section>
            </div>

            @if(isset($userProxy) && !$currentUser->isAdmin())
                @if($userProxy->isInvestor())
                    <div class="row">
                        <section class="col-12">
                            <div class="card graph">
                                <div class="card-header">
                                    <h3 class="card-title">{{ trans('attributes.home.user.portfolio_analysis') }}</h3>
                                </div><!-- card-header -->
                                <div class="card-body">
                                    <div class="d-flex justify-content-center flex-wrap" id="graph">
                                        <div class="col-12 col-md-3">
                                            <h5 class="card-text font-weight-bold text-center">{{ trans('attributes.table_list_house.table_head.td_17') }}</h5>
                                            <p class="card-text text-center py-5">Contents in Preparation</p>
                                        </div><!-- col-3 -->

                                        <div class="col-12 col-md-3 mt-3 mt-md-0">
                                            <h5 class="card-text font-weight-bold text-center">{{ trans('attributes.table_list_house.table_head.td_15') }}</h5>
                                            <p class="card-text text-center py-5">Contents in Preparation</p>
                                        </div><!-- col-3 -->

                                        <div class="col-12 col-md-3 mt-3 mt-md-0">
                                            <h5 class="card-text font-weight-bold text-center">{{ trans('attributes.borrowing.table.borrowing_balance') }}</h5>
                                            <p class="card-text text-center py-5">Contents in Preparation</p>
                                        </div><!-- col-3 -->

                                        <div class="col-12 col-md-3 mt-3 mt-md-0">
                                            <h5 class="card-text font-weight-bold text-center">{{ trans('attributes.table_list_house.table_head.td_10') }}</h5>
                                            <p class="card-text text-center py-5">Contents in Preparation</p>
                                        </div><!-- col-3 -->
                                    </div><!-- d-flex -->
                                </div><!-- card-body -->
                            </div><!-- card -->
                        </section>
                    </div>

                    <div class="row">
                        <section class="col-12 col-md-4">
                            <div class="card graph">
                                <div class="card-body" id="noi-chart">
                                    <h5 class="card-text font-weight-bold text-center">{{ trans('attributes.borrowing.table.noi') }}</h5>
                                    <p class="card-text text-center py-5">Contents in Preparation</p>
                                </div><!-- card-body -->
                            </div><!-- card -->
                        </section>

                        <section class="col-12 col-md-4">
                            <div class="card graph">
                                <div class="card-body" id="chart-acreage">
                                    <h5 class="card-text font-weight-bold text-center">{{ trans('attributes.portfolio_analysis.chart.title_1') }}</h5>
                                    <p class="card-text text-center py-5">Contents in Preparation</p>
                                </div><!-- card-body -->
                            </div><!-- card -->
                        </section>

                        <section class="col-12 col-md-4">
                            <div class="card graph">
                                <div class="card-body" id="chart-room">
                                    <h5 class="card-text font-weight-bold text-center">{{ trans('attributes.portfolio_analysis.chart.title_2') }}</h5>
                                    <p class="card-text text-center py-5">Contents in Preparation</p>
                                </div><!-- card-body -->
                            </div><!-- card -->
                        </section>
                    </div>

                    <div class="row">
                        <section class="col-12">
                            <div class="card cfSimulation">
                                <div class="card-body">
                                    <p class="title-diagram text-left p20l color-title-chart">{{ __('attributes.borrowing.title_high_charts') }}</p>
                                    <div id="chart-all"></div>
                                    <p class="highcharts-des fs15 highcharts-note m15l fs13-sp" style="display: none">
                                        {{ __('attributes.simulation_charts.note_1') }}<br/>
                                        {{ __('attributes.simulation_charts.note_2') }}
                                    </p>
                                </div><!-- card-body -->
                                <div class="card-footer clearfix">
                                    <ul class="list-inline mb-0 pull-right text-right d-flex flex-column flex-sm-row">
                                        <li class="list-inline-item mb-2 mr-0 mr-sm-2"><a href="{{ route(USER_PROPERTY_INDEX) }}"
                                                                        class="btn btn-sm btn-primary">{{ trans('attributes.home.menu.list_house') }}</a>
                                        </li>
                                        <li class="list-inline-item mb-2 mr-0 mr-sm-2"><a
                                                href="{{ route(USER_PROPERTY_PORTFOLIO_ANALYSIS) }}"
                                                class="btn btn-sm btn-primary">{{ trans('attributes.home.menu.portfolio_analysis') }}</a>
                                        </li>
                                        <li class="list-inline-item mb-2 mr-0 mr-sm-2"><a href="{{ route(USER_BORROWING) }}"
                                                                        class="btn btn-sm btn-primary">{{ trans('attributes.property.list_status_owe') }}</a>
                                        </li>
                                    </ul>
                                </div><!-- card-footer -->
                            </div><!-- card -->
                        </section>
                    </div>
                @else
                    @if($currentUser->isMainUser() || $currentUser->hasPermissionProperty(VIEW_REPORT))
                    <div class="row">
                        <section class="col-12">
                            <div class="card selectList">
                                <div class="card-body">
                                    <div id="drop-down-home" class="d-md-flex justify-content-md-center align-items-md-center mb-0">
                                        <div class="col-lg-4 col-12 m5b">
                                            <button type="button" class="form-control btn btn-dropdown-home m10r dropdown-toggle text-left" data-toggle="dropdown" aria-expanded="true">{{ trans('attributes.top.header.plan_tbl_cell.title_7') }}</button>
                                            <div class="dropdown-menu dropdown-home p10t">
                                                <div class="dropdown-properties-home">
                                                    @forelse($listProperty as $key => $property)
                                                        <div class="row m0">
                                                            <div class="col-5 break-all p10b p10l p10r">{{ trans('attributes.home.menu.position') . str_pad($key + FLAG_ONE, FLAG_FIVE, '0', STR_PAD_LEFT) }}</div>
                                                            <div class="col-7 break-all p10b p10l p10r "><a href="{{ route(USER_REPORT, ['proprietor' => $property['proprietor'] ?? 'ー']) }}">{{ $property['proprietor'] ?? 'ー' }}</a></div>
                                                        </div>
                                                    @empty
                                                        <div class="text-center">{{ trans('attributes.common.no_data') }}</div>
                                                    @endforelse
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-12 m5b">
                                            <button disabled type="button" class="form-control btn btn-dropdown-home m10r dropdown-toggle text-left" data-toggle="dropdown" aria-expanded="true">{{ trans('attributes.home.menu.list_house') }}</button>
                                            <div class="dropdown-menu dropdown-home p10t">
                                                <div class="dropdown-properties-home">
                                                @forelse($listProperty as $key => $property)
                                                    <div class="row m0">
                                                        <div class="col-4 break-all p10b p10l p10r">{{ trans('attributes.home.menu.position') . ($key + FLAG_ONE) }}</div>
                                                        <div class="col-8 break-all p10b p10l p10r "><a href="">{{ $property['proprietor'] }}</a></div>
                                                    </div>
                                                @empty
                                                    <div class="text-center">{{ trans('attributes.common.no_data') }}</div>
                                                @endforelse
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-12 m5b">
                                            <button disabled type="button" class="form-control btn btn-dropdown-home m10r dropdown-toggle text-left" data-toggle="dropdown" aria-expanded="true">{{ trans('attributes.home.menu.portfolio_analysis') }}</button>
                                            <div class="dropdown-menu dropdown-home p10t">
                                                <div class="dropdown-properties-home">
                                                @forelse($listProperty as $key => $property)
                                                    <div class="row m0">
                                                        <div class="col-4 break-all p10b p10l p10r">{{ trans('attributes.home.menu.position') . ($key + FLAG_ONE) }}</div>
                                                        <div class="col-8 break-all p10b p10l p10r "><a href="">{{ $property['proprietor'] }}</a></div>
                                                    </div>
                                                @empty
                                                    <div class="text-center">{{ trans('attributes.common.no_data') }}</div>
                                                @endforelse
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- card-body -->
                            </div><!-- card -->
                        </section>
                    </div>
                    @endif
                    @if($currentUser->isMainUser() || $currentUser->hasPermission(CHANGE_MYPAGE))
                    <div class="row mb-3">
                        <section class="col-md-6 mb-3 mb-md-0">
                            <div class="card topics h-100">
                                <div class="card-header">
                                    <h3 class="card-title">{{ trans('attributes.home.user.my_page.topic') }}</h3>
                                </div><!-- card-header -->
                                <div class="card-body">
                                    <div class="topicsList">
                                        @forelse($topicsUser as $topic)
                                            <dl>
                                                <dt>
                                                    <div class="icon">
                                                        <div class="iconInner"><img
                                                                src="{{ isset($topic['profile']['avatar_thumbnail']) ? url(PATH_SRC_AVATAR . $topic['profile']['avatar_thumbnail']) : asset('images/user_default.png') }}"
                                                                alt=""></div>
                                                    </div><!-- icon -->
                                                </dt>
                                                <dd>
                                                    <div class="textHead">
                                                        <p>{{ $topic['profile']['person_charge_last_name'] }} {{ $topic['profile']['person_charge_first_name'] }}</p>
                                                        <p>{{ date('Y/m/d', strtotime($topic['created_at'])) }}</p>
                                                        <p><span
                                                                class="topicsCat {{ 'cat_'.$topic['category']['id'] }}">{{ $topic['category']['name'] }}</span>
                                                        </p>
                                                    </div><!-- textHead -->
                                                    <div class="text">
                                                        <a href="{{ route(USER_ARTICLE_TEXT_EDIT, $topic['id']) }}">{{ setMaxLength($topic['title'], FLAG_ONE_HUNDRED) }}</a>
                                                    </div><!-- text -->
                                                </dd>
                                            </dl>
                                        @empty
                                            <div class="text-center">{{ trans('attributes.common.no_data') }}</div>
                                        @endforelse
                                    </div><!-- topicsList -->
                                </div><!-- card-body -->
                                @if(!empty($topicsUser))
                                    <div class="card-footer clearfix">
                                        <a href="{{ route(USER_ARTICLE_TEXT) }}" class="btn btn-sm btn-primary pull-right">{{ trans('attributes.home.menu.topics_management') }}</a>
                                    </div><!-- card-footer -->
                                @endif
                            </div><!-- card -->
                        </section>

                        <section class="col-md-6">
                            <div class="card photoArchive h-100">
                                <div class="card-header">
                                    <h3 class="card-title">{{ trans('attributes.home.user.my_page.photo') }}</h3>
                                </div><!-- card-header -->
                                <div class="card-body">
                                    <div class="photoArchiveList row">
                                        @forelse($articlePhotosUser as $articlePhoto)
                                            <a href="{{ route(USER_ARTICLE_PHOTO_EDIT, $articlePhoto['id']) }}" class="col-md-4 col-6">
                                                <div class="photo">
                                                    <div class="photoInner h150 background-color-image">
                                                        <img class="object-fit-contain" src="{{ getImageArticle([$articlePhoto['image_1'], $articlePhoto['image_2'], $articlePhoto['image_3']]) }}" alt="">
                                                    </div>
                                                </div><!-- photo -->
                                                <div class="detail">
                                                    <p class="title">{{ setMaxLength($articlePhoto['caption'], FLAG_ONE_HUNDRED) }}</p>
                                                    <p class="date">{{ date('Y/m/d', strtotime($articlePhoto['created_at'])) }}</p>
                                                </div><!-- detail -->
                                            </a>
                                        @empty
                                            <div
                                                class="text-center w-100">{{ trans('attributes.common.no_data') }}</div>
                                        @endforelse
                                    </div><!-- photoArchiveList -->
                                </div><!-- card-body -->
                                @if(!empty($articlePhotosUser))
                                    <div class="card-footer clearfix">
                                        <a href="{{ route(USER_PHOTO_ARCHIVE_INDEX) }}" class="btn btn-sm btn-primary pull-right">{{ trans('attributes.home.menu.photo_archive_management') }}</a>
                                    </div><!-- card-footer -->
                                @endif
                            </div><!-- card -->
                        </section>
                    </div>
                    @endif
                @endif

                @if(!$userProxy->isFreeMember() && ($currentUser->isMainUser() || $currentUser->hasPermission(CHANGE_PLAN)))
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">{{ trans('attributes.setting.pay.current_contract_information') }}</h3>
                        </div>
                        <div class="card-body">
                            <div class="col-lg-12 m10t p0l p0r">

                                <!--無料会員の場合-->
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th>{{ trans('attributes.setting.pay.plans_under_contract') }}</th>
                                        <th>{{ trans('attributes.setting.pay.quantity') }}</th>
                                        <th>{{ trans('attributes.setting.pay.fee') }}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>{{ PLAN_TEXT_NAME[$userProxy->getMemberStatus()] }}</td>
                                        <td>1</td>
                                        <td>{{ trans('attributes.common.unit_yen') . number_format($amount['amounts_by_member']) }}</td>
                                    </tr>
                                    <tr>
                                        <td>{{ trans('attributes.setting.pay.sub_user') }}</td>
                                        <td>{{ $amount['total_sub'] }}</td>
                                        <td>{{ trans('attributes.common.unit_yen') . number_format($amount['total_sub'] *  $amount['amounts_by_sub_user']) }}</td>
                                    </tr>
                                    <tr>
                                        <td>{{ trans('attributes.setting.pay.discount_rate') }}</td>
                                        <td class="text-danger">{{ $userSubscription['discount'] . __('attributes.common.percent') }}</td>
                                        <td class="text-danger">{{ trans('attributes.common.unit_yen') . number_format($amount['discount_value']) }}</td>
                                    </tr>
                                    <tr>
                                        <td>{{ trans('attributes.info_billing.sale_tax') }}</td>
                                        <td>{{ number_format(TAX_PERSONAL * FLAG_ONE_HUNDRED, FLAG_TWO) . trans('attributes.common.percent') }}</td>
                                        <td>{{ trans('attributes.common.unit_yen') . number_format($amount['tax']) }}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" style="background-color:#666;color:#fff;"
                                            align="right">{{ trans('attributes.setting.pay.total_charges') }}</td>
                                        <td>{{ trans('attributes.common.unit_yen') . number_format($amount['total_amount']) }}</td>
                                    </tr>
                                    </tbody>
                                </table>

                                <table class="table table-bordered mt-4">
                                    <tbody>
                                    @if($userProxy->inTrial())
                                        <tr>
                                            <th>{{ trans('attributes.setting.pay.free_period') }}</th>
                                            <td>
                                                <p>{{ date('yy/m/d', strtotime($userSubscription['finish_date'])) }}
                                                    まで</p>
                                                <p class="text-danger small mb-0">{{ trans('attributes.setting.pay.downgrade_trial') }}</p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>{{ trans('attributes.setting.pay.next_date') }}</th>
                                            <td>{{ date('yy/m/d', strtotime($userSubscription['finish_date']) + THIRTY_DAY_BY_SECONDS) }}</td>
                                        </tr>
                                    @else
                                        <tr>
                                            <th>{{ trans('attributes.setting.pay.next_date') }}</th>
                                            <td>{{ date('yy/m/d', strtotime($userSubscription['finish_date'])) }}</td>
                                        </tr>
                                    @endif
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                @endif

                @if($currentUser->isMainUser() || $currentUser->hasPermission(CHANGE_SUB_USER))
                    <div class="row">
                        <section class="col-12">
                            <div class="card subUser">
                                <div class="card-header">
                                    <h3 class="card-title">{{ trans('attributes.sub_user.title') }}</h3>
                                </div><!-- card-header -->
                                <div class="card-body">
                                    <div class="subUserList d-flex align-items-center flex-wrap">
                                        @forelse($subUser as $item)
                                            <a href="{{ route(USER_PROFILE_SUB_USER_EDIT, $item['id']) }}">
                                                <dl>
                                                    <dt>
                                                        <div class="icon">
                                                            <div class="iconInner"><img
                                                                    src="{{ isset($item['profile']['avatar_thumbnail']) ? url(PATH_SRC_AVATAR . $item['profile']['avatar_thumbnail']) : asset('images/user_default.png') }}"
                                                                    alt=""></div>
                                                        </div><!-- icon -->
                                                    </dt>
                                                    <dd class="detail">
                                                        <div class="userInfo">
                                                            <p>{{ $item['profile']['person_charge_last_name'] . $item['profile']['person_charge_first_name'] }}</p>
                                                            <p>{{ $item['email'] }}</p>
                                                        </div><!-- userInfo -->
                                                        <div class="lastLogin">
                                                            <p>{{ trans('attributes.admin_manager.user.last_login') }}
                                                                ：{{ isset($item['last_login']) ? dateTimeFormat($item['last_login']) : trans('attributes.user_detail.dont_login') }}</p>
                                                        </div><!-- text -->
                                                    </dd>
                                                    <dd class="status">
                                                        <span
                                                            class="statusLabel @if($item['status'] == OPEN) true @else false @endif">{{ $item['status'] == OPEN ? trans('attributes.user_detail.active') : trans('attributes.user_detail.disable') }}</span>
                                                    </dd>
                                                </dl>
                                            </a>
                                        @empty
                                            <div
                                                class="text-center w-100">{{ trans('attributes.common.no_data') }}</div>
                                        @endforelse
                                    </div>
                                </div><!-- card-body -->
                                <div class="card-footer clearfix">
                                    <a href="{{ route(SUB_USER_INDEX) }}"
                                       class="btn btn-sm btn-primary pull-right">{{ trans('attributes.home.user.manage') }}</a>
                                </div><!-- card-footer -->
                            </div><!-- card -->
                        </section>
                    </div>
                @endif
            @endif
        </div>
    </div>
    @include('modal.home.photo_img')
@endsection
@section('js')
    <script src="{{ asset('dist/js/home.min.js') }}"></script>
    <script type="text/javascript">
        let dataAll = {!! isset($userProxy) ? json_encode($dataChart) : json_encode(null) !!} ;
    </script>
    <script src="{{ asset('js/highcharts/modules/no-data-to-display.js') }}"></script>
    <script src="{{ asset('dist/js/portfolio-analysis.min.js') }}"></script>
    <script src="{{ asset('js/regression/regression.js') }}"></script>
    <script src="{{ asset('dist/js/graph.min.js') }}"></script>
@endsection

