@extends('layout.home.master')
@section('styles')
    <link rel="stylesheet" href="{{ asset('/css/preview/portfolio_analysis.css') }}">
@endsection
@section('content')
    <div class="container-fluid container-wrapper container-wrapper-analysis">
        <div id="main-analysis">
            <div class="row m0 m20b p15lr">
                <div class="col-12 text-left text-md-left p0 media-575-p20l media-575-p20r">
                    <h3 class="m0">{{ __('attributes.portfolio_analysis.title') }}</h3>
                </div>
            </div>
            <div class="p15lr">@include('partials.flash_messages')</div>
            <form id="form-condition-1" class="row m0 m30b p15lr" action="{{ route(USER_PROPERTY_PORTFOLIO_ANALYSIS) }}" method="get">
                <div class="row col-12 col-sm-8 text-center text-md-right p0 group-status-top">
                    <div id="block-status" class="d-flex min-h38 m8t m8r">
                        <div class="w-20 centered first-block">
                            <label class="m0 fw-normal">{{ __('attributes.portfolio_analysis.first_block.title') }}</label>
                        </div>
                        <div class="w-80 p8t p5b p10l p10r">
                            <div class="row">
                                <div class="offset-1 offset-lg-0 col-5 col-lg-3 p0l p0r m5b">
                                    <label class=" fs14-sp container-input fw-normal borrowing-left">{{ __('attributes.portfolio_analysis.first_block.checkbox_1') }}
                                        <input name="status[0]" type="checkbox" class="check-status" value="1" {{isset($params['status'][0])?'checked':''}}>
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <div class="offset-1 offset-lg-0 col-5 col-lg-3 p0l p0r m5b">
                                    <label class=" fs14-sp container-input fw-normal borrowing-left">{{ __('attributes.portfolio_analysis.first_block.checkbox_2') }}
                                        <input name="status[1]" type="checkbox" class="check-status" value="2" {{isset($params['status'][1])?'checked':''}}>
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <div class="offset-1 offset-lg-0 col-5 col-lg-3 p0l p0r m5b">
                                    <label class=" fs14-sp container-input fw-normal borrowing-left">{{ __('attributes.portfolio_analysis.first_block.checkbox_3') }}
                                        <input name="status[2]" type="checkbox" class="check-status" value="3" {{isset($params['status'][2])?'checked':''}}>
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <div class="offset-1 offset-lg-0 col-5 col-lg-3 p0l p0r m5b">
                                    <label class=" fs14-sp container-input fw-normal borrowing-left">{{ __('attributes.portfolio_analysis.first_block.checkbox_4') }}
                                        <input id="as" name="status[3]" type="checkbox" class="check-status" value="4" {{isset($params['status'][3])?'checked':''}}>
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if(in_array($currentUser->role, [BROKER, EXPERT]))
                    <div class="m0 name-group d-flex min-h38 m8t" style="width: 300px;max-width: 100%;">
                        <div class="btn fs14 centered fw-bold p10" style="border-radius: inherit; background-color: #6E7A94 !important;color: white !important;">{{ trans('attributes.register_info.item_block.label.proprietor_2') }}</div>
                        <div class="btn wrap-input-option fs14 p0 w-50">
                            <select id="select-proprietor" name="proprietor" class="option-paginate-1 btn form-control hp100 p0 p15r p5l">
                                <option class="m20r m20l" value="">{{ trans('attributes.register_info.item_block.label.all') }}</option>
                                <option class="m20r m20l" value="ー" @if(isset($params['proprietor']) && $params['proprietor'] == 'ー') selected @endif>ー</option>
                                @foreach($proprietors as $item)
                                    @if(isset($item->proprietor))
                                        <option @if(isset($params['proprietor']) && ($params['proprietor'] == $item->proprietor)) selected @endif class="m20r m20l break-all" value="{{ $item->proprietor }}">{{ $item->proprietor }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    @endif
                </div>
                <div class="col-12 col-sm-4 text-left text-lg-right p0 group-button-top">
                    @if(!$currentUser->isSubUser())
                        <a href="{{ route(USER_PROPERTY_PORTFOLIO_ANALYSIS_SORT_TABLE) }}" class="btn custom-btn-default fs15 fs13-sp p7t-sp sort-property d-none d-md-inline-block m7r m5t">{{ __('attributes.portfolio_analysis.text_btn_sort') }}</a>
                    @endif
                    <div class="btn-group m7r m8t">
                        <div class="btn label-option fs15 fs14-sp centered">{{ __('attributes.portfolio_analysis.number_displayed') }}</div>
                        <div class="btn wrap-input-option fs14 w-40 p0">
                            <div class="style-select-option text-center">
                                <select name="option_paginate" class="option-paginate-1 form-control fs14 border-0">
                                    <option value="10" {{$params['option_paginate']==10? 'selected':''}}>10{{ __('attributes.portfolio_analysis.item') }}</option>
                                    <option value="20" {{$params['option_paginate']==20? 'selected':''}}>20{{ __('attributes.portfolio_analysis.item') }}</option>
                                    <option value="30" {{$params['option_paginate']==30? 'selected':''}}>30{{ __('attributes.portfolio_analysis.item') }}</option>
                                    <option value="50" {{$params['option_paginate']==50? 'selected':''}}>50{{ __('attributes.portfolio_analysis.item') }}</option>
                                </select>
                            </div>
                        </div>
                    </div>
                        @if(!$currentUser->isSubUser())
                            <a href="{{ route(USER_PROPERTY_PORTFOLIO_ANALYSIS_SORT_TABLE) }}" class="btn custom-btn-default fs15 sort-property d-sm-inline-block d-md-none fs13-sp p7t-sp m5t">{{ __('attributes.portfolio_analysis.text_btn_sort') }}</a>
                        @endif

                    <button id="pre-print" type="button" class="btn custom-btn-success fs15 btn-borrowing-preview d-none d-sm-inline-block fs13-sp m5t media-767-m7l h36">{{ __('attributes.portfolio_analysis.pre_print') }}</button>
                </div>
            </form>

            <div class="row m-0 mb-3">
                <div id="circle-diagram" class="col-12 m-0 p0 diagram-block">
                    <div id="container"></div>
                    <div id="cus-legend" class="p10b">
                        <div class="legend-item">
                            <p class="legend-money fs16 m0" ></p>
                            <p class="legend-acquisition fs16 m0"></p>
                        </div>
                        <div class="legend-item">
                            <p class="legend-assessed-amount fs16 m0"></p>
                            <p class="legend-noi-yield fs16 m0"></p>
                        </div>
                        <div class="legend-item legend-debt-item">
                            <p class="legend-debt-balance fs16 m0"></p>
                        </div>
                        <div class="legend-item last-item">
                            <p class="legend-inheritance fs16"></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row diagram-analysis">
                {{--bieu do  moi--}}
                <div class="col-12 col-xl-4 mb-3 chart-on-off">
                    <div class="diagram-block">
                        <div id="noi-chart"></div>
                    </div>
                </div>
                <div class="col-12 col-xl-4 mb-3 chart-on-off">
                    <div class="diagram-block">
                        <p class="title-diagram">{{ __('attributes.portfolio_analysis.chart.title_1') }}</p>
                        <div id="parent-chart-room" class="diagram-block-new col-12 p0l col-xxl-5 m30r p0r" >
                            <div id="chart-room"></div>
                            <div class="legend-chart legend-chart1 row m0">
                                <div class="margin-auto row col-8 col-lg-8 col-xl-8">
                                    <div class="col-6 row m-0">
                                        <div class="col-6"><div class="margin-auto room_no_empty"></div></div>
                                        <div class="col-6 fs14">{{ trans('attributes.common.room_no_empty') }}</div>
                                    </div>
                                    <div class="col-6 row m-0">
                                        <div class="col-6"><div class="margin-auto room_empty"></div></div>
                                        <div class="col-6 fs14">{{ trans('attributes.common.room_empty') }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="fs12 font-weight-bold text-center no-data-chart-room" style="display: none; color:#2C3348;fill:#2C3348; line-height: 200px">{{ trans('attributes.common.no_data') }}</div>
                    </div>
                </div>
                <div class="col-12 col-xl-4 mb-3 chart-on-off">
                    <div class="diagram-block">
                        <p class="title-diagram">{{ __('attributes.portfolio_analysis.chart.title_2') }}</p>
                        <div id="parent-chart-acreage" class="diagram-block-new col-12 col-xxl-5 p0l p0r m30t-sp m30t-max16">
                            <div id="chart-acreage"></div>
                            <div class="legend-chart legend-chart2 row m0">
                                <div class="margin-auto row col-8 col-lg-8 col-xl-8">
                                    <div class="col-6 row m-0">
                                        <div class="col-6"><div class="margin-auto room_no_empty"></div></div>
                                        <div class="col-6 fs14">{{ trans('attributes.common.room_no_empty') }}</div>
                                    </div>
                                    <div class="col-6 row m-0">
                                        <div class="col-6"><div class="margin-auto room_empty"></div></div>
                                        <div class="col-6 fs14">{{ trans('attributes.common.room_empty') }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="fs12 font-weight-bold text-center no-data-chart-acreage" style="display: none; color:#2C3348;fill:#2C3348; line-height: 200px">{{ trans('attributes.common.no_data') }}</div>
                    </div>
                </div>
            </div>

            <div class="p-0 mb-3">
                <div class="row m-0 br10 bg-white">
                    <div class="table-responsive portfolio-table fs14" id="portfolio-analysis">
                        <input id="show-proprietor" type="hidden" value="{{ in_array($currentUser->role, [BROKER, EXPERT]) }}">
                        <table id="table-property" class="table table-bordered table-striped border-0 m0">
                            <tr class="table-head">
                                <td class="border-0">
                                    <div class="centered-vertical">
                                        <label class="container-input p25l">
                                            <input type="checkbox" class="check-all" checked >
                                            <span class="checkmark"></span>
                                            <span>No.</span>
                                        </label>
                                        <span data-id="0" class="sort-icon sort-icon-first"><i class="fa-sort-icon fa fa-caret-down" aria-hidden="true"></i></span>
                                    </div>
                                </td>
                                <td class="border-top-0 p120r">
                                    <div class="centered-vertical">
                                        <span >{{ __('attributes.table_list_house.table_head.td_1') }}</span><span data-id="1" class="sort-icon"><i class="fa-sort-icon fa fa-caret-down" aria-hidden="true"></i></span>
                                    </div>
                                </td>
                                <td class="border-top-0">
                                    <div class="centered-vertical">
                                        <span>{{ __('attributes.table_list_house.table_head.td_2') }}</span><span  data-id="2" class="sort-icon"><i class="fa-sort-icon fa fa-caret-down" aria-hidden="true"></i></span>
                                    </div>
                                </td>
                                <td class="border-top-0 p50r @if(!in_array($currentUser->role, [BROKER, EXPERT])) d-none @endif">
                                    <div class="centered-vertical">
                                        <span>{{ trans('attributes.register_info.item_block.label.proprietor_2') }}</span><span  data-id="3" class="sort-icon"><i class="fa-sort-icon fa fa-caret-down" aria-hidden="true"></i></span>
                                    </div>
                                </td>
                                <td class="border-top-0 p0t vertical-base">
                                    <span class="number-li m10b">1</span>
                                    <div class="centered-vertical">
                                    <span class="centered">
                                        <p class="m0">{{ __('attributes.table_list_house.table_head.td_3') }}</p>
                                        <span data-id="4" class="sort-icon"><i class="fa-sort-icon fa fa-caret-down" aria-hidden="true"></i></span>
                                    </span>
                                    </div>
                                    <span class="fs11">(㎡)</span>
                                </td>
                                <td class="border-top-0 p0t p30r vertical-base">
                                    <span class="number-li m10b">2</span>
                                    <div class="centered-vertical">
                                    <span class="centered">
                                        <p class="m0">{{ __('attributes.table_list_house.table_head.td_4') }}</p>
                                        <span data-id="5" class="sort-icon"><i class="fa-sort-icon fa fa-caret-down" aria-hidden="true"></i></span>
                                    </span>
                                    </div>
                                    <span class="fs11">(円/m²)</span>
                                </td>
                                <td class="border-top-0 p0t p52r vertical-base">
                                    <div class="centered-vertical m10b">
                                        <span class="centered-vertical fs10 fw-normal">(<span class="number-li li-small">1</span>x<span class="number-li li-small">2</span>)</span>
                                    </div>
                                    <div class="centered-vertical">
                                    <span class="centered">
                                        <p class="m0">{{ __('attributes.table_list_house.table_head.td_5_1') }}<br><span>{{ __('attributes.table_list_house.table_head.td_5_2') }}</span><br><span class="fs11">(円)</span></p>
                                        <span data-id="6" class="sort-icon p15b"><i class="fa-sort-icon fa fa-caret-down" aria-hidden="true"></i></span>
                                    </span>
                                    </div>
                                </td>
                                <td class="border-top-0">
                                    <div class="centered-vertical">
                                        <p class="m0">{{ __('attributes.table_list_house.table_head.td_new_1_1') }}<br><span>{{ __('attributes.table_list_house.table_head.td_new_1_2') }}</span><br><span class="fs11">(円)</span></p>
                                        <span data-id="7" class="sort-icon"><i class="fa-sort-icon fa fa-caret-down" aria-hidden="true"></i></span>
                                    </div>
                                </td>
                                <td class="border-top-0 p0t vertical-base p52r">
                                    <div class="centered-vertical m10b">
                                        <span class="number-li m0b m3r">3</span>
                                    </div>
                                    <div class="centered-vertical">
                                        <p class="m0">{{ __('attributes.table_list_house.table_head.td_new_2_1') }}<br><span>{{ __('attributes.table_list_house.table_head.td_new_2_2') }}</span><br><span class="fs11">(円)</span></p>
                                        <span data-id="8" class="sort-icon p15b"><i class="fa-sort-icon fa fa-caret-down" aria-hidden="true"></i></span>
                                    </div>
                                </td>
                                <td class="border-top-0">
                                    <div class="centered-vertical">
                                        <span>{{ __('attributes.table_list_house.table_head.td_6') }}</span><span data-id="9" class="sort-icon"><i class="fa-sort-icon fa fa-caret-down" aria-hidden="true"></i></span>
                                    </div>
                                </td>
                                <td class="border-top-0 p0t vertical-base">
                                    <div class="centered-vertical m10b">
                                        <span class="number-li m0b m3r">4</span>
                                    </div>
                                    <div class="centered-vertical">
                                    <span class="centered">
                                        <p class="m0">{{ __('attributes.table_list_house.table_head.td_7_1') }}<br><span>{{ __('attributes.table_list_house.table_head.td_7_2') }}</span><br><span class="fs11">(円)</span></p>
                                        <span data-id="10" class="sort-icon p15b"><i class="fa-sort-icon fa fa-caret-down" aria-hidden="true"></i></span>
                                    </span>
                                    </div>
                                </td>
                                <td class="border-top-0">
                                    <div class="centered-vertical">
                                        <span>{{ __('attributes.table_list_house.table_head.td_8') }}</span><span  data-id="11" class="sort-icon"><i class="fa-sort-icon fa fa-caret-down" aria-hidden="true"></i></span>
                                    </div>
                                </td>
                                <td class="border-top-0 p0t vertical-base">
                                    <div class="centered-vertical m25b">
                                        <span class="number-li m0b m3r">5</span>
                                    </div>
                                    <div class="centered-vertical">
                                    <span class="centered">
                                        <p class="m0">{{ __('attributes.table_list_house.table_head.td_9') }}</p>
                                        <span data-id="12" class="sort-icon"><i class="fa-sort-icon fa fa-caret-down" aria-hidden="true"></i></span>
                                    </span>
                                    </div>
                                </td>
                                <td class="border-top-0 p0t vertical-base p38r">
                                    <div class="centered-vertical m10b">
                                        <span class="number-li m0b m3r">6</span>
                                        <span class="centered-vertical fs10 fw-normal">(<span class="number-li li-small">3</span>+<span class="number-li li-small">4</span>x<span class="number-li li-small">5</span>)</span>
                                    </div>
                                    <div class="centered-vertical">
                                    <span class="centered">
                                        <p class="m0">{{ __('attributes.table_list_house.table_head.td_10') }}</p>
                                        <span data-id="13" class="sort-icon"><i class="fa-sort-icon fa fa-caret-down" aria-hidden="true"></i></span>
                                    </span>
                                    </div>
                                    <span class="fs11">({{ __('attributes.common.yen') }})</span>
                                </td>
                                <td class="border-top-0 p54r">
                                    <div class="centered-vertical">
                                        <span>{{ __('attributes.table_list_house.table_head.td_11_1') }}</span><span data-id="14" class="sort-icon"><i class="fa-sort-icon fa fa-caret-down" aria-hidden="true"></i></span>
                                    </div>
                                    <span>({{ __('attributes.table_list_house.table_head.td_11_2') }})</span><br>
                                    <span class="fs11">({{ __('attributes.common.yen') }})</span>
                                </td>
                                <td class="border-top-0 p38r">
                                    <div class="centered-vertical">
                                        <span>{{ __('attributes.table_list_house.table_head.td_12_1') }}</span><span data-id="15" class="sort-icon"><i class="fa-sort-icon fa fa-caret-down" aria-hidden="true"></i></span>
                                    </div>
                                    <span>− {{ __('attributes.table_list_house.table_head.td_12_2') }}</span><br>
                                    <span class="fs11">({{ __('attributes.common.yen') }})</span>
                                </td>
                                <td class="border-top-0 p0t p60r vertical-base">
                                    <span class="number-li m10b">7</span>
                                    <div class="centered-vertical">
                                    <span class="centered">
                                        <p class="m0">NOI</p>
                                        <span data-id="16" class="sort-icon"><i class="fa-sort-icon fa fa-caret-down" aria-hidden="true"></i></span>
                                    </span>
                                    </div>
                                    <span class="fs11">({{ __('attributes.common.yen') }})</span>
                                </td>
                                <td class="border-top-0 p0t vertical-base">
                                    <span class="number-li m25b">8</span>
                                    <div class="centered-vertical">
                                    <span class="centered">
                                        <p class="m0">{{ __('attributes.table_list_house.table_head.td_14') }}</p>
                                        <span data-id="17" class="sort-icon"><i class="fa-sort-icon fa fa-caret-down" aria-hidden="true"></i></span>
                                    </span>
                                    </div>
                                </td>
                                <td class="border-top-0 p0t p60r vertical-base p80r">
                                    <div class="centered-vertical m10b">
                                        <span class="centered-vertical fs10 fw-normal">(<span class="number-li li-small">7</span>/<span class="number-li li-small">8</span>)</span>
                                    </div>
                                    <div class="centered-vertical">
                                    <span class="centered">
                                        <p class="m0">{{ __('attributes.table_list_house.table_head.td_15') }}</p>
                                        <span data-id="18" class="sort-icon"><i class="fa-sort-icon fa fa-caret-down" aria-hidden="true"></i></span>
                                    </span>
                                    </div>
                                    <span class="fs11">({{ __('attributes.common.yen') }})</span>
                                </td>
                                <td class="border-top-0 p79r">
                                    <div class="centered-vertical">
                                        <p class="m0">{{ __('attributes.table_list_house.table_head.td_16_1') }}</p>
                                        <span data-id="19" class="sort-icon"><i class="fa-sort-icon fa fa-caret-down" aria-hidden="true"></i></span>
                                    </div>
                                    <span>− {{ __('attributes.table_list_house.table_head.td_16_2') }}</span>
                                </td>
                                <td class="border-top-0 p0t p30r vertical-base">
                                    <div class="centered-vertical m10b">
                                        <span class="number-li m0b m3r">9</span>
                                    </div>
                                    <div class="centered-vertical">
                                    <span class="centered">
                                        <p class="m0">{{ __('attributes.table_list_house.table_head.td_17') }}</p>
                                        <span data-id="20" class="sort-icon"><i class="fa-sort-icon fa fa-caret-down" aria-hidden="true"></i></span>
                                    </span>
                                    </div>
                                    <span class="fs11">({{ __('attributes.common.yen') }})</span>
                                </td>
                                <td class="border-top-0 p0t vertical-base p66r">
                                    <div class="centered-vertical m10b">
                                        <span class="number-li m0b m3r">10</span>
                                        <span class="centered-vertical fs10 fw-normal">(<span class="number-li li-small">7</span>/<span class="number-li li-small">9</span><span>*100</span>)</span>
                                    </div>
                                    <div class="centered-vertical">
                                    <span class="centered">
                                        <p class="m0">{{ __('attributes.table_list_house.table_head.td_18_1') }}</p>
                                        <span data-id="21" class="sort-icon"><i class="fa-sort-icon fa fa-caret-down" aria-hidden="true"></i></span>
                                    </span>
                                    </div>
                                    <span>{{ __('attributes.table_list_house.table_head.td_18_2') }}</span><br><span class="fs11">({{ __('attributes.common.yen') }})</span>
                                </td>
                                <td class="border-top-0">
                                    <div class="centered-vertical">
                                        <span>{{ __('attributes.table_list_house.table_head.td_19') }}</span><span  data-id="22" class="sort-icon"><i class="fa-sort-icon fa fa-caret-down" aria-hidden="true"></i></span>
                                    </div>
                                </td>
                                <td class="border-top-0 p0t vertical-base">
                                    <div class="centered-vertical m10b">
                                        <span class="number-li m0b m3r">11</span>
                                    </div>
                                    <div class="centered-vertical">
                                    <span class="centered">
                                        <p class="m0 w100">{{ __('attributes.table_list_house.table_head.td_20_1') }}</p>
                                        <span data-id="23" class="sort-icon"><i class="fa-sort-icon fa fa-caret-down" aria-hidden="true"></i></span>
                                    </span>
                                    </div>
                                    <span>（{{ __('attributes.table_list_house.table_head.td_20_2') }}）</span>
                                </td>
                                <td class="border-top-0 p30r">
                                    <span>{{ __('attributes.table_list_house.table_head.td_21_1') }}</span><br>
                                    <span>{{ __('attributes.table_list_house.table_head.td_21_2') }}</span>
                                </td>
                                <td class="border-top-0 p120r p33t vertical-top">
                                    <span>{{ __('attributes.table_list_house.table_head.td_23') }}</span>
                                </td>
                                <td class="border-top-0 p70r p33t vertical-top">
                                    <span>{{ __('attributes.table_list_house.table_head.td_24') }}</span>
                                </td>
                                <td class="border-top-0 p100r p33t vertical-top">
                                    <span>{{ __('attributes.table_list_house.table_head.td_25') }}</span>
                                </td>
                            </tr>
                            @if(empty($params['option_paginate']))
                                <div class="d-none">{{ $stepNumber = ($listDataTables->currentPage() - 1) * 10  }}</div>
                            @else
                                <div class="d-none">{{ $stepNumber = ($listDataTables->currentPage() - 1) * $params['option_paginate']  }}</div>
                            @endif
                            @php($index='')
                            @php($sumDebtBalance = 0)
                            @php($sumNoi = 0)
                            @php($sumMoneyReceiveHouse = 0)
                            @php($sumAreaRentalOperating = 0)
                            @php($sumAreaMayRent = 0)
                            @php($SumPoints = FLAG_ZERO)
                            @foreach($listDataTables as $listDataTable)
                                @php($index=$stepNumber + $loop->index +1)
                                @php($debtBalance = round($listDataTable['loan'] + excelCUMPRINC($listDataTable['interest_rate'] / 100, $listDataTable['contract_loan_period'], $listDataTable['loan'], 1 , dateDif($listDataTable['loan_date']), 0)))
                                @php($sumDebtBalance += $debtBalance)
                                @php($sumNoi += ($listDataTable['total_revenue']-$listDataTable['total_cost']))
                                @php($sumMoneyReceiveHouse += $listDataTable['money_receive_house'])
                                @php($sumAreaRentalOperating += $listDataTable['area_rental_operating'])
                                @php($sumAreaMayRent += $listDataTable['area_may_rent'])
                                @php($SumPoints += round($listDataTable['synthetic_point']))
                                <tr class="t-body porfolio-all pie-chart" data-id="{{$listDataTable['id']}}" data-key="1">
                                    <input type="hidden" value="{{ round(divisionNumber($listDataTable->revenue_room_rentals / 12, $listDataTable->total_area_floors * 0.3025), FLAG_ZERO) }}" class="revenue-room-rentals">
                                    <input type="hidden" value="{{ round(divisionNumber($listDataTable->total_cost, $listDataTable->total_area_floors), FLAG_ZERO) }}" class="total-cost">
                                    <input type="hidden" value="{{ round(divisionNumber($listDataTable->total_revenue, $listDataTable->total_area_floors), FLAG_ZERO) }}" class="total-revenue">
                                    <input type="hidden" value="{{ round(divisionNumber($listDataTable->repair_fee, $listDataTable->total_area_floors), FLAG_ZERO) }}" class="repair-fee">
                                    <input type="hidden" value="{{ round(divisionNumber($listDataTable->maintenance_management_fee / 12, $listDataTable->total_area_floors), FLAG_ZERO) }}" class="maintenance-management-fee">
                                    <input type="hidden" value="{{$listDataTable->synthetic_point ?? FLAG_ZERO }}" class="synthetic-point">
                                    <form action="" class="form-data-portfolio" data-id="{{$listDataTable['id']}}">
                                        <td data-value="{{ $index }}" class="border-left-0">
                                            <div class="centered-vertical">
                                                <label class="container-input p25l fw-normal">
                                                    <input type="checkbox" name="check-portfolio" class="check-portfolio" checked data-id="{{$listDataTable['id']}}">
                                                    <span class="checkmark"></span>
                                                    <span class="number-house">{{ $index <= 9 ? '00'.$index:'0'.$index }}</span>
                                                </label>
                                            </div>
                                        </td>
                                        <td class="border-top-0 name-color house-name" data-text = "{{ $listDataTable['house_name'] }}"><a href="{{ route(USER_PROPERTY_EDIT, ['propertyId' => $listDataTable['id'], 'params' => $params, 'screen' => 'portfolio-analysis', 'page' => $listDataTables->currentPage()]) }}">{{ $listDataTable['house_name'] }}</a></td>
                                        <td class="border-top-0 status">{{ STATUS_HOUSE[$listDataTable['status']] }}</td>
                                        <td class="border-top-0 w-auto @if(!in_array($currentUser->role, [BROKER, EXPERT])) d-none @endif">{{ $listDataTable['proprietor'] ?? 'ー' }}</td>
                                        <input type="hidden" class="proprietor" value="{{ $listDataTable['proprietor'] ?? '' }}">
                                        <td class="border-top-0 text-right convert-data ground-area" data-id="{{ $listDataTable['id'] . 'ground_area' }}"
                                            data-value="{{$listDataTable['ground_area'] ?? 0 }}">{{ $listDataTable['ground_area'] ? number_format($listDataTable['ground_area'], 2) : '0.00' }}</td>
                                        <td data-value="{{$listDataTable->portfolioAnalysis['route_price'] ?? 0}}" class="border-top-0 text-right convert-data">
                                            <input type="text" name="route_price" value="{{ $listDataTable->portfolioAnalysis['route_price'] ?? 0}}" class="form-control fs14 convert-data focus-out route-price" data-id="{{$listDataTable['id'] }}">
                                            <p class="error-message m0" data-error="route_price" data-id="{{$listDataTable['id']}}"></p>
                                        </td>
                                        <td data-value="{{$listDataTable->portfolioAnalysis['tax_land_price'] ??  0}}" class="border-top-0 text-right convert-data">
                                            <input type="text" name="tax_land_price" value="{{$listDataTable->portfolioAnalysis['tax_land_price']}}" class="input-sum convert-data tax-land-price fs14" data-id="{{$listDataTable['id'] . 'tax_land_price' }}" readonly>
                                        </td>
                                        <td data-value="{{ $listDataTable->portfolioAnalysis['land_tax_assessment'] ?? 0 }}" class="">
                                            <input type="text" name="land_tax_assessment" value="{{ $listDataTable->portfolioAnalysis['land_tax_assessment'] ?? 0 }}" class="form-control fs14 convert-data focus-out land-tax-assessment" data-id="{{$listDataTable['id']}}">
                                            <p class="error-message m0" data-error="land_tax_assessment" data-id="{{$listDataTable['id']}}"></p>
                                        </td>
                                        <td data-value="{{ $listDataTable->portfolioAnalysis['estimate_inheritance_tax_valuation'] ?? 0 }}" class="">
                                            <input type="text" name="estimate_inheritance_tax_valuation" value="{{ $listDataTable->portfolioAnalysis['estimate_inheritance_tax_valuation'] ?? 0}}" class="input-sum fs14 convert-data" data-id="{{$listDataTable['id']}}" readonly>
                                        </td>
                                        <td class="border-top-0">
                                            <select name="land_evaluation_note" class="btn form-control focus-out land-evaluation-note fs14 text-left">
                                                <option value="">---</option>
                                                @foreach(EVALUATION_NOTE as $value)
                                                    <option value="{{ $value }}" {{$listDataTable->portfolioAnalysis['land_evaluation_note'] == $value ? "selected" : ""}}>{{ $value }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td data-value="{{$listDataTable->portfolioAnalysis['tax_valuation'] ?? 0}}" class="border-top-0 text-right">
                                            <input type="text" name="tax_valuation" value="{{$listDataTable->portfolioAnalysis['tax_valuation'] ?? 0}} " data-id="{{$listDataTable['id']}}" class="form-control fs14 convert-data focus-out tax-valuation">
                                            <p class="error-message m0" data-error="tax_valuation" data-id="{{$listDataTable['id']}}"></p>
                                        </td>
                                        <td class="border-top-0">
                                            <select name="building_selection" class="btn form-control focus-out building-selection fs14 text-left" data-id="{{$listDataTable['id']}}">
                                                <option value="">---</option>
                                                <option value="自用家屋" {{ $listDataTable->portfolioAnalysis['building_selection'] === '自用家屋' ? 'selected' : '' }}>{{ __('attributes.portfolio_analysis.house_type.type_1') }}</option>
                                                <option value="貸家" {{ $listDataTable->portfolioAnalysis['building_selection'] === '貸家' ? 'selected' : '' }}>{{ __('attributes.portfolio_analysis.house_type.type_2') }}</option>
                                            </select>
                                        </td>
                                        <td data-value="{{$listDataTable->portfolioAnalysis['correction_factor'] ?? 0}}" class="border-top-0">
                                            <input type="text" name="correction_factor" value="{{$listDataTable->portfolioAnalysis['correction_factor'] ?? 0}}" class="form-control fs14 convert-number-single-decimal focus-out correction-factor" data-id="{{$listDataTable['id']}}">
                                            <p class="error-message m0" data-error="correction_factor" data-id="{{$listDataTable['id']}}"></p>
                                        </td>
                                        <td data-value="{{$listDataTable->portfolioAnalysis['inheritance_tax_valuation'] ?? 0}}" class="border-top-0 text-right">
                                            <input type="text" name="inheritance_tax_valuation" value="{{$listDataTable->portfolioAnalysis['inheritance_tax_valuation']}}" class="input-sum convert-data inheritance-tax-valuation fs14" readonly data-id="{{$listDataTable['id']. 'inheritance_tax_valuation'}}">
                                        </td>
                                        <td data-value="{{$debtBalance ?? 0}}" class="border-top-0 text-right">
                                            <input type="text" name="debt_balance" value="{{$debtBalance}}" class="input-sum convert-data debt-balance fs14" disabled data-value="{{ $listDataTable['id'] }}" data-id="{{$listDataTable['id']. 'debt_balance'}}">
                                        </td>
                                        <td data-value="{{$listDataTable->portfolioAnalysis['inheritance_tax_debt_balance'] ?? 0}}" class="border-top-0 text-right">
                                            <input type="text" name="inheritance_tax_debt_balance" value="{{$listDataTable->portfolioAnalysis['inheritance_tax_debt_balance']}}" class="input-sum convert-data inheritance-tax-debt-balance fs14" data-id="{{$listDataTable['id']. 'inheritance_tax_debt_balance'}}" readonly>
                                        </td>
                                        <td data-value="{{$listDataTable['total_revenue']-$listDataTable['total_cost'] ?? 0}}" class="border-top-0 text-right">
                                            <input type="text" name="noi" value="{{$listDataTable['total_revenue']-$listDataTable['total_cost'] ?? 0}}" class="input-sum convert-data noi fs14" data-id="{{$listDataTable['id']. 'noi'}}" disabled>
                                        </td>
                                        <td data-value="{{$listDataTable->portfolioAnalysis['noi_yield'] ?? 0}}" class="border-top-0">
                                            <input type="text" name="noi_yield" value="{{$listDataTable->portfolioAnalysis['noi_yield'] ?? '0.00'}}" class="form-control fs14 d-inline-block w-70 convert-number-double-decimal focus-out noi-yield fs14" data-id="{{$listDataTable['id']}}">
                                            <span class="d-inline-block w-20 text-right">{{ __('attributes.common.percent') }}</span>
                                        </td>
                                        <td data-value="{{$listDataTable->portfolioAnalysis['assessed_amount'] ?? 0}}" class="border-top-0 text-right">
                                            <input type="text" name="assessed_amount" value="{{$listDataTable->portfolioAnalysis['assessed_amount']}}" class="input-sum convert-data assessed-amount assessed_amount fs14" data-id="{{$listDataTable['id'].'assessed_amount'}}" readonly>
                                        </td>
                                        <td data-value="{{$listDataTable->portfolioAnalysis['assessed_amount_debt_balance'] ?? 0}}" class="border-top-0 text-right">
                                            <input type="text" name="assessed_amount_debt_balance" value="{{$listDataTable->portfolioAnalysis['assessed_amount_debt_balance']}}" class="input-sum convert-data assessed-amount-debt-balance fs14" data-id="{{$listDataTable['id'].'assessed_amount_debt_balance'}}" readonly>
                                        </td>
                                        <td data-value="{{ $listDataTable['money_receive_house'] ?? 0}}" class="border-top-0 text-right convert-data money-receive-house" data-id="{{$listDataTable['id'].'money-receive-house'}}">{{ number_format($listDataTable['money_receive_house']) ?? 0}}</td>
                                        <td data-value="{{$listDataTable->portfolioAnalysis['acquisition_price_yield'] ?? 0}}" class="border-top-0 p0r">
                                            <input type="text" name="acquisition_price_yield" value="{{$listDataTable->portfolioAnalysis['acquisition_price_yield'] ?? 0.00}}" class="input-sum convert-number-double-decimal w-70 text-center acquisition-price-yield fs14" data-id="{{$listDataTable['id'].'acquisition_price_yield'}}" readonly>
                                            <span>%</span>
                                        </td>
                                        <td data-value="{{ $listDataTable['rental_percentage'] ?? 0}}" class="border-top-0 text-center rental-percentage">{{ $listDataTable['rental_percentage'] ? $listDataTable['rental_percentage'].' %': '0.00 %' }}</td>
                                        <td data-value="{{ round($listDataTable->synthetic_point) ?? FLAG_ZERO }}" class="border-top-0 synthetic-point">{{ round($listDataTable->synthetic_point) ?? FLAG_ZERO }} {{ __('attributes.common.points') }}
                                        </td>
                                        <td class="border-top-0 time-date">{{ dateTimeFormatBorrowing($listDataTable['date_year_registration_revenue'], $listDataTable['date_month_registration_revenue']) }}</td>
                                        <td class="border-top-0 real-estate-type">{{ $listDataTable->realEstateType['name'] }}</td>
                                        <td class="border-top-0 detail-real-estate-type">{{ $listDataTable->detailRealEstateType['name'] ?? 'ー' }}</td>
                                        <input type="hidden" class="pre-detail-real-estate-type" value="{{ $listDataTable->detailRealEstateType['name'] ?? '' }}">
                                        <td class="border-right-0 address">@if($listDataTable['address_city']){{ $listDataTable['address_city']}}&ensp;{{$listDataTable['address_district']}} @else {{ 'ー' }}@endif</td>
                                        <input type="hidden" class="pre-address" value="@if($listDataTable['address_city']){{ $listDataTable['address_city']}}&ensp;{{$listDataTable['address_district']}} @else {{ '' }}@endif">
                                    </form>
                                </tr>
                            @endforeach
                            <tr class="table-foot">
                                <td class="border-0"></td>
                                <td class="border-bottom-0 text-left">合計</td>
                                <td class="border-bottom-0"></td>
                                <td class="border-bottom-0 @if(!in_array($currentUser->role, [BROKER, EXPERT])) d-none @endif"></td>
                                <td class="border-bottom-0"></td>
                                <td class="border-bottom-0"></td>
                                <td id="sum-tax-land-price" class="border-bottom-0 convert-data"></td>
                                <td class="border-bottom-0"></td>
                                <td id="sum-estimate-inheritance-tax-valuation" class="border-bottom-0 convert-data"></td>
                                <td class="border-bottom-0"></td>
                                <td id="sum-tax-valuation" class="border-bottom-0 convert-data"></td>
                                <td class="border-bottom-0"></td>
                                <td class="border-bottom-0"></td>
                                <td id="inheritance-tax-valuation" class="border-bottom-0 convert-data"></td>
                                <td id="sum-debt-balance" class="border-bottom-0 convert-data">{{number_format($sumDebtBalance)}}</td>
                                <td id="sum-inheritance-tax-debt-balance" class="border-bottom-0 convert-data"></td>
                                <td id="sum-noi" class="border-bottom-0 convert-data">{{number_format($sumNoi)}}</td>
                                <td id="sum-noi-yield" class="border-bottom-0 convert-data text-center">0.00{{ trans('attributes.common.percent') }}</td>
                                <td id="sum-assessed-amount" class="border-bottom-0 convert-data"></td>
                                <td id="sum-assessed-amount-debt-balance" class="border-bottom-0 convert-data"></td>
                                <td id="sum-money-receive-house" class="border-bottom-0 convert-data">{{number_format($sumMoneyReceiveHouse)}}</td>
                                <td id="sum-acquisition-price-yield" class="border-bottom-0 convert-data text-center">{{ division($sumNoi, $sumMoneyReceiveHouse) . trans('attributes.common.percent') }}</td>
                                <td id="sum-rental-percentage" class="border-bottom-0 convert-data text-center">{{ division($sumAreaRentalOperating, $sumAreaMayRent) }}&ensp;%</td>
                                <td id="comprehensive-balance-evaluation" class="border-bottom-0 convert-data text-left">{{ round(divisionNumber($SumPoints, count($listDataTables))) }} {{ __('attributes.common.points') }}</td>
                                <td class="border-bottom-0"></td>
                                <td class="border-bottom-0"></td>
                                <td class="border-bottom-0"></td>
                                <td class="border-0"></td>
                            </tr>
                        </table>



                    </div>
                </div>
            </div>

            <div class="row diagram-analysis">
                <div class="col-12 col-xl-4 mb-3">
                    <div class="diagram-block">
                        <div id="container-1"></div>
                    </div>
                </div>
                <div class="col-12 col-xl-4 mb-3">
                    <div class="diagram-block">
                        <div id="container-2"></div>
                    </div>
                </div>
                <div class="col-12 col-xl-4 mb-3">
                    <div class="diagram-block">
                        <div id="container-3"></div>
                    </div>
                </div>
                <div class="col-12 col-xl-4 mb-3">
                    <div class="diagram-block">
                        <div id="container-4"></div>
                    </div>
                </div>
                <div class="col-12 col-xl-4 mb-3">
                    <div class="diagram-block">
                        <div id="container-5"></div>
                    </div>
                </div>
                <div class="col-12 col-xl-4 mb-3">
                    <div class="diagram-block">
                        <div id="container-6"></div>
                    </div>
                </div>
                <div class="col-12 col-xl-4 mb-3">
                    <div class="diagram-block">
                        <div id="container-7"></div>
                    </div>
                </div>
                <div class="col-12 col-xl-4 mb-3">
                    <div class="diagram-block">
                        <div id="container-8"></div>
                    </div>
                </div>
                <div class="col-12 col-xl-4 mb-3">
                    <div class="diagram-block">
                        <div id="container-9"></div>
                    </div>
                </div>
            </div>

            <div class="row m0 mt-5 mb-5">
                <div class="col-12 p0 text-center text-lg-right">
                    @if(!$currentUser->isSubUser())
                        <a href="{{ route(USER_PROPERTY_PORTFOLIO_ANALYSIS_SORT_TABLE) }}" class="btn custom-btn-default fs15 sort-property portfolio-float-left fs13-sp p7t-sp m0lr-sp">{{ __('attributes.portfolio_analysis.text_btn_sort') }}</a>
                    @endif
                    <div class="btn-group m15l m35r d-none d-sm-inline-flex m2t">
                        <div class="btn label-option fs15 fs14-sp centered">{{ __('attributes.portfolio_analysis.number_displayed') }}</div>
                        <form id="form-condition-2" class="btn wrap-input-option fs14 w-40 p0" action="{{ route(USER_PROPERTY_PORTFOLIO_ANALYSIS) }}" method="get">
                            <input name="status[0]" type="hidden" value="{{$params['status'][0]??''}}">
                            <input name="status[1]" type="hidden" value="{{$params['status'][1]??''}}">
                            <input name="status[2]" type="hidden" value="{{$params['status'][2]??''}}">
                            <input name="status[3]" type="hidden" value="{{$params['status'][3]??''}}">
                            <div class="style-select-option text-center">
                                <select name="option_paginate" class="option-paginate-2 form-control border-0 fs14">
                                    <option value="10" {{$params['option_paginate']==10? 'selected':''}}>10{{ __('attributes.portfolio_analysis.item') }}</option>
                                    <option value="20" {{$params['option_paginate']==20? 'selected':''}}>20{{ __('attributes.portfolio_analysis.item') }}</option>
                                    <option value="30" {{$params['option_paginate']==30? 'selected':''}}>30{{ __('attributes.portfolio_analysis.item') }}</option>
                                    <option value="50" {{$params['option_paginate']==50? 'selected':''}}>50{{ __('attributes.portfolio_analysis.item') }}</option>
                                </select>
                            </div>
                        </form>
                    </div>
                    {{ $listDataTables->links('partials.custom_pagination', ['params'=>$params]) }}
                </div>
            </div>

            <div class="row m-0 justify-content-end">
                <button id="pre-print-2" class="btn custom-btn-success d-none d-sm-inline-block fs15">{{ __('attributes.portfolio_analysis.pre_print') }}</button>
            </div>
        </div>
    </div>
    <div class="d-none">
        <input type="hidden" id="count-data" value="{{ $dataRenRollChart['count_data'] }}" disabled>
        <input type="hidden" id="count-data-no-empty" value="{{ $dataRenRollChart['count_no_empty'] }}" disabled>
        <input type="hidden" id="sum-contract-area" value="{{ $dataRenRollChart['sum_contract_area'] }}" disabled>
        <input type="hidden" id="sum-contract-area-no-empty" value="{{ $dataRenRollChart['sum_contract_area_no_empty']  }}" disabled>
    </div>
    @include('modal.preview_portfolio')
@endsection
@section('js')
    <script src="{{ asset('js/highcharts/modules/no-data-to-display.js') }}"></script>
    <script src="{{ asset('dist/js/portfolio-analysis.min.js') }}"></script>
    <script src="{{ asset('js/regression/regression.js') }}"></script>
    <script src="{{ asset('dist/js/graph.min.js') }}"></script>
@endsection


