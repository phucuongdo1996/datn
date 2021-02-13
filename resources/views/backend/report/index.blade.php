@extends('layout.home.master')
@section('content')
    <div class="container-fluid container-wrapper container-wrapper-report container-padding">
        <div id="main-info-assessment">
            <div class="row row-header m50b">
                <div class="row m0">
                    <div class="col-12 text-center text-md-left p0">
                        <h3 class="m0">{{ __('attributes.home.menu.sub_report') }}</h3>
                    </div>
                </div>
            </div>
        </div>
        @include('partials.flash_messages')
        <form id="form-condition-1" class="text-lg-right m0 m30b p0 text-right group-button-top form-report-filter"
              action="{{ route(USER_REPORT) }}" method="GET">
            @if(in_array($currentUser->role, [BROKER, EXPERT]))
            <div id="borrowing-block-status" class="d-flex min-h38 m0l m8t m10b">
                <div class="w-20 centered first-block">
                    <label class="m0 fw-normal fs13-sp">{{ __('attributes.portfolio_analysis.first_block.title') }}</label>
                </div>
                <div class="w-80 p8t p5b p10l p10r">
                    <div class="row">
                        <div class="offset-1 offset-lg-0 col-5 col-lg-3 p0l p0r m5b">
                            <label class="container-input fw-normal borrowing-left">{{ __('attributes.portfolio_analysis.first_block.checkbox_1') }}
                                <input class="checkbox-report" name="status[]" value="1" type="checkbox"  {{ in_array(FLAG_ONE, $params['status']) ? 'checked=checked' : '' }}>
                                <span class="checkmark"></span>
                            </label>
                        </div>
                        <div class="offset-1 offset-lg-0 col-5 col-lg-3 p0l p0r m5b">
                            <label class="container-input fw-normal borrowing-left">{{ __('attributes.portfolio_analysis.first_block.checkbox_2') }}
                                <input class="checkbox-report" name="status[]" value="2" type="checkbox"  {{ in_array(FLAG_TWO, $params['status']) ? 'checked=checked' : '' }}>
                                <span class="checkmark"></span>
                            </label>
                        </div>
                        <div class="offset-1 offset-lg-0 col-5 col-lg-3 p0l p0r m5b">
                            <label class="container-input fw-normal borrowing-left">{{ __('attributes.portfolio_analysis.first_block.checkbox_3') }}
                                <input class="checkbox-report" name="status[]" value="3" type="checkbox"  {{ in_array(FLAG_THREE, $params['status']) ? 'checked=checked' : '' }}>
                                <span class="checkmark"></span>
                            </label>
                        </div>
                        <div class="offset-1 offset-lg-0 col-5 col-lg-3 p0l p0r m5b">
                            <label class="container-input fw-normal borrowing-left">{{ __('attributes.portfolio_analysis.first_block.checkbox_4') }}
                                <input class="checkbox-report" name="status[]" value="4" type="checkbox"  {{ in_array(FLAG_FOUR, $params['status']) ? 'checked=checked' : '' }}>
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            <div class="row justify-content-between">
                @if(in_array($currentUser->role, [BROKER, EXPERT]))
                <div class="btn-group m0 name-group p8l" style="width: 300px;max-width: 100%;">
                    <div class="btn label-option fs14 centered fw-bold p10">{{ trans('attributes.register_info.item_block.label.proprietor_2') }}</div>
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
                @else
                    <div id="borrowing-block-status" class="d-flex min-h38 m8t m10b">
                        <div class="w-20 centered first-block">
                            <label class="m0 fw-normal fs13-sp">{{ __('attributes.portfolio_analysis.first_block.title') }}</label>
                        </div>
                        <div class="w-80 p8t p5b p10l p10r">
                            <div class="row">
                                <div class="offset-1 offset-lg-0 col-5 col-lg-3 p0l p0r m5b">
                                    <label class="container-input fw-normal borrowing-left">{{ __('attributes.portfolio_analysis.first_block.checkbox_1') }}
                                        <input class="checkbox-report" name="status[]" value="1" type="checkbox"  {{ in_array(FLAG_ONE, $params['status']) ? 'checked=checked' : '' }}>
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <div class="offset-1 offset-lg-0 col-5 col-lg-3 p0l p0r m5b">
                                    <label class="container-input fw-normal borrowing-left">{{ __('attributes.portfolio_analysis.first_block.checkbox_2') }}
                                        <input class="checkbox-report" name="status[]" value="2" type="checkbox"  {{ in_array(FLAG_TWO, $params['status']) ? 'checked=checked' : '' }}>
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <div class="offset-1 offset-lg-0 col-5 col-lg-3 p0l p0r m5b">
                                    <label class="container-input fw-normal borrowing-left">{{ __('attributes.portfolio_analysis.first_block.checkbox_3') }}
                                        <input class="checkbox-report" name="status[]" value="3" type="checkbox"  {{ in_array(FLAG_THREE, $params['status']) ? 'checked=checked' : '' }}>
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <div class="offset-1 offset-lg-0 col-5 col-lg-3 p0l p0r m5b">
                                    <label class="container-input fw-normal borrowing-left">{{ __('attributes.portfolio_analysis.first_block.checkbox_4') }}
                                        <input class="checkbox-report" name="status[]" value="4" type="checkbox"  {{ in_array(FLAG_FOUR, $params['status']) ? 'checked=checked' : '' }}>
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                <input class="checkbox-report d-none" name="check_all" value="0" type="hidden">
                <div class="m8t mr-0">
                    <div class="btn-group m0">
                        <div class="btn label-option fs14 centered fw-bold p10">{{ __('attributes.common.option_paginate') }}</div>
                        <div class="btn wrap-input-option fs14 w-45 p0">
                            <select name="option_paginate" class="per-page option-paginate-1 btn form-control hp100 p0 p15r p5l">
                                @foreach(LIST_OPTION_PAGINATE as $key => $value)
                                    <option class="m20r m20l" value="{{ $key }}" @if($optionPaginate == $key) {{'selected'}} @endif>{{ $value }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    {{ $property->appends(['option_paginate' => $optionPaginate, 'status' => $params['status'], 'proprietor' => isset($params['proprietor']) ? $params['proprietor'] : ''])->links('partials.simple_paginate', ['totalPage' => $totalPage]) }}
                </div>
            </div>
        </form>

        <div class="row m0 m30b br10 bg-white">
            <div class="table-responsive fs14 br10">
                <table id="table-property" class="table-report table table-bordered table-striped border-0 m0">
                    <thead class="">
                    <tr class="table-head">
                        <td class="border-top-0 border-left-0 z-index-100 first-column">
                            <div class="centered">
                                <div><p class="m0 text-center">{{ __('attributes.common.order') }}</p><p class="m0 text-center">{{ __('attributes.common.property') }}</p></div>
                            </div>
                        </td>
                        <td class="border-top-0 border-left-0 z-index-100 second-column">
                            <div class="centered-vertical">
                                <span>{{ __('attributes.property.house_name') }}</span>
                            </div>
                        </td>
                        <td class="border-top-0">
                            <div class="centered-vertical text-center">
                                <span class="centered">
                                    <p class="m0 text-center">{{ trans('attributes.borrowing.table.status') }}</p>
                                    <span data-id='2' class="sort-icon"><i class="fa-sort-icon fa fa-caret-down" aria-hidden="true"></i></span>
                                </span>
                            </div>
                        </td>
                        @if(in_array($currentUser->role, [BROKER, EXPERT]))
                        <td class="border-top-0">
                            <div class="centered-vertical">
                                <span class="centered">
                                    <p class="m0">{!! trans('attributes.property.report_owner') !!}</p>
                                    <span data-id='3' class="sort-icon"><i class="fa-sort-icon fa fa-caret-down" aria-hidden="true"></i></span>
                                </span>
                            </div>
                        </td>
                        @endif
                        <td class="border-top-0">
                            <div class="centered-vertical centered">
                                <span>{{ __('attributes.home.menu.simple_form') }}</span>
                            </div>
                        </td>
                        <td class="border-top-0">
                            <div class="centered-vertical centered">
                                <span>{{ __('attributes.property.business_plan') }}</span>
                            </div>
                        </td>
                        <td class="border-top-0">
                            <div class="centered-vertical centered">
                                <span class="text-center">{{ __('attributes.home.menu.list_short_term_rental') }}</span>
                            </div>
                        </td>
                        <td class="border-top-0">
                            <div class="centered-vertical centered">
                                <span>{{ __('attributes.home.menu.monthly_re_and_ex_table') }}</span>
                            </div>
                        </td>
                        <td class="border-top-0">
                            <div class="centered-vertical centered">
                                <span>{{ __('attributes.home.menu.year_achievement_table') }}</span>
                            </div>
                        </td>
                        <td class="border-top-0">
                            <div class="centered-vertical centered">
                                <span>{{ __('attributes.home.menu.repair_table') }}</span>
                            </div>
                        </td>
                        <td class="border-top-0">
                            <div class="centered-vertical centered">
                                <span>{{ __('attributes.property.essential_house') }}</span>
                            </div>
                        </td>
                    </tr>
                    </thead>

                    <tbody>

                    @forelse($property as $item)
                        @php($order = $numericalOrder + $loop->index + 1)
                        <tr class="table">
                            <td class="border-top-0 border-left-0 first-column text-center">{{ $order <= 9 ? '00'.$order:'0'.$order }}</td>
                            <td class="border-top-0 border-left-0 second-column"><a href="{{ route(USER_PROPERTY_EDIT, $item->id) }}" class="fw-bold position-relative">{{ $item->house_name }}</a></td>
                            <td class="border-top-0 border-left-0 text-left">{{ $item->status ? STATUS_HOUSE[$item->status] ? : '' : '' }}</td>
                            @if(in_array($currentUser->role, [BROKER, EXPERT]))
                            <td class="border-top-0 border-left-0 text-center break-all">{{ $item->proprietor ? $item->proprietor : 'ー'}}</td>
                            @endif
                            @if($item->simpleAssessment)
                                <td class="border-top-0 border-left-0">
                                    <div class="centered m5b">
                                        <div class="image">
                                            <img src="{{ asset('images/icon_report_check.png') }}" alt=""/>
                                        </div>
                                    </div>
                                    <div class="row centered">
                                        <a href="{{route(USER_PROPERTY_SIMPLE_ASSESSMENT, [$item->id, 'screen' => 'report', 'option_paginate' => $optionPaginate])}}">{{ __('attributes.common.edit') }}</a>
                                        <span class="m0 m5r m5l">/</span>
                                        <a href="{{route(USER_PROPERTY_SIMPLE_ASSESSMENT, [$item->id, 'screen' => 'report', 'option_paginate' => $optionPaginate, 'show_print' => true])}}">{{ __('attributes.common.export') }}</a>
                                    </div>
                                    <div class="text-center date">{{ dateTimeFormat($item->simpleAssessment->updated_at)}}</div>
                                </td>
                            @else
                                <td class="border-top-0 border-left-0 text-center">
                                    <a href="{{ route(USER_PROPERTY_SIMPLE_ASSESSMENT, [$item->id, 'screen' => 'report', 'option_paginate' => $optionPaginate]) }}">
                                        <div class="centered m5b">
                                            <div class="image">
                                                <img src="{{ asset('images/icon_report_add.png') }}" alt=""/>
                                            </div>
                                        </div>
                                        <div class="text-center">{{ __('attributes.common.new_registration') }}</div>
                                    </a>
                                </td>
                            @endif
                            <td class="border-top-0 border-left-0">
                                @if ($item->businessPlan)
                                    <div class="centered m5b">
                                        <div class="image">
                                            <img src="{{ asset('images/icon_report_check.png') }}" alt=""/>
                                        </div>
                                    </div>
                                    <div class="row centered">
                                        <a href="{{ route(USER_PROPERTY_BUSINESS_PLAN_EDIT, ['propertyId' => $item->id, 'screen' => 'report', 'option_paginate' => $optionPaginate]) }}" class="business-plan-report">{{ __('attributes.common.edit') }}</a>
                                        <span class="m0 m5r m5l">/</span>
                                        <a href="{{ route(USER_PROPERTY_BUSINESS_PLAN_EDIT, ['propertyId' => $item->id, 'screen' => 'report', 'option_paginate' => $optionPaginate, 'show_print' => true]) }}">{{ __('attributes.common.export') }}</a>
                                    </div>
                                    <div class="text-center date">{{dateTimeFormat($item->businessPlan['updated_at'])}}</div>
                                @else
                                    <a href="{{ route(USER_PROPERTY_BUSINESS_PLAN_CREATE, ['propertyId' => $item->id, 'screen' => 'report', 'option_paginate' => $optionPaginate]) }}" class="business-plan-report">
                                        <div class="centered m5b">
                                            <div class="image">
                                                <img src="{{ asset('images/icon_report_add.png') }}" alt=""/>
                                            </div>
                                        </div>
                                        <div class="text-center">{{ __('attributes.common.new_registration') }}</div>
                                    </a>
                                @endif
                            </td>

                            @if($item->rentRolls->toArray())
                                <td class="border-top-0 border-left-0">
                                    <div class="centered m5b">
                                        <div class="image">
                                            <img src="{{ asset('images/icon_report_check.png') }}" alt=""/>
                                        </div><!-- /.image -->
                                    </div>
                                    <div class="row centered">
                                        <a href="{{ route(USER_PROPERTY_RENT_ROLL_INDEX, [$item->id]) }}">{{ __('attributes.common.edit') }}</a>
                                        <span class="m0 m5r m5l">/</span>
                                        <a href="{{ route(USER_PROPERTY_RENT_ROLL_INDEX, [$item->id, 'show_print' => true]) }}">{{ __('attributes.common.export') }}</a>
                                    </div>
                                    <div class="text-center date">
                                        @php($timeStampRentRoll = strtotime($item->rentRolls->sortByDesc('contract_start_date')->first()->toArray()['contract_start_date']))
                                        {{ trans('attributes.report.latest_registration') . date('Y', $timeStampRentRoll) . trans('attributes.common.year') . date('m', $timeStampRentRoll) . trans('attributes.report.month') }}</div>
                                </td>
                            @else
                                <td class="border-top-0 border-left-0 text-center">
                                    <a href="{{ route(USER_PROPERTY_RENT_ROLL_CREATE, [$item->id, 'screen' => 'report', 'option_paginate' => $optionPaginate, 'page'=> $property->currentPage()]) }}">
                                        <div class="centered m5b">
                                            <div class="image">
                                                <img src="{{ asset('images/icon_report_add.png') }}" alt=""/>
                                            </div>
                                        </div>
                                        <div class="text-center">{{ __('attributes.common.new_registration') }}</div>
                                    </a>
                                </td>
                            @endif
                            @php($monthProperty = $item->date_month_registration_revenue)
                            @if($item->monthlyBalances->toArray())
                                <td class="border-top-0 border-left-0">
                                    <div class="centered m5b">
                                        <div class="image">
                                            <img src="{{ asset('images/icon_report_check.png') }}" alt=""/>
                                        </div><!-- /.image -->
                                    </div>
                                    <div class="row centered">
                                        <a href="{{ route(USER_PROPERTY_MONTHLY_BALANCE_INDEX, [$item->id]) }}">{{ __('attributes.common.edit') }}</a>
                                        <span class="m0 m5r m5l">/</span>
                                        <a href="{{ route(USER_PROPERTY_MONTHLY_BALANCE_INDEX, [$item->id, 'show_print' => true]) }}">{{ __('attributes.common.export') }}</a>
                                    </div>
                                    <div class="text-center date">
                                        @php($yearMonthlyBalances = $item->monthlyBalances->sortByDesc('date_year_registration')->first()->toArray()['date_year_registration'])
                                        {{ trans('attributes.report.latest_registration') . $yearMonthlyBalances . trans('attributes.common.year') . $monthProperty . trans('attributes.report.month') }}
                                    </div>
                                </td>
                            @else
                                <td class="border-top-0 border-left-0 text-center">
                                    <a href="{{ route(USER_PROPERTY_MONTHLY_BALANCE_CREATE, [$item->id, 'screen' => 'report', 'option_paginate' => $optionPaginate, 'page'=> $property->currentPage()]) }}">
                                        <div class="centered m5b">
                                            <div class="image">
                                                <img src="{{ asset('images/icon_report_add.png') }}" alt=""/>
                                            </div>
                                        </div>
                                        <div class="text-center">{{ __('attributes.common.new_registration') }}</div>
                                    </a>
                                </td>
                            @endif

                            @if($item->annualPerformances->toArray())
                                <td class="border-top-0 border-left-0">
                                    <div class="centered m5b">
                                        <div class="image">
                                            <img src="{{ asset('images/icon_report_check.png') }}" alt=""/>
                                        </div><!-- /.image -->
                                    </div>
                                    <div class="row centered">
                                        <a href="{{ route(USER_PROPERTY_ANNUAL_PERFORMANCE_INDEX, $item->id) }}">{{ __('attributes.common.edit') }}</a>
                                        <span class="m0 m5r m5l">/</span>
                                        <a href="{{ route(USER_PROPERTY_ANNUAL_PERFORMANCE_INDEX, [$item->id, 'show_print' => true]) }}">{{ __('attributes.common.export') }}</a>
                                    </div>
                                    <div class="text-center date">
                                        @php($yearAnnualPerformances = $item->annualPerformances->sortByDesc('year')->first()->toArray()['year'])
                                        {{ trans('attributes.report.latest_registration') . $yearAnnualPerformances . trans('attributes.common.year') . $monthProperty . trans('attributes.report.month') }}
                                    </div>
                                </td>
                            @else
                                <td class="border-top-0 border-left-0 text-center">
                                    <a href="{{ route(USER_PROPERTY_ANNUAL_PERFORMANCE_CREATE, [$item->id, 'screen' => 'report', 'option_paginate' => $optionPaginate, 'page'=> $property->currentPage()]) }}">
                                        <div class="centered m5b">
                                            <div class="image">
                                                <img src="{{ asset('images/icon_report_add.png') }}" alt=""/>
                                            </div>
                                        </div>
                                        <div class="text-center">{{ __('attributes.common.new_registration') }}</div>
                                    </a>
                                </td>
                            @endif

                            @if($item->repairHistory->toArray())
                                <td class="border-top-0 border-left-0">
                                    <div class="centered m5b">
                                        <div class="image">
                                            <img src="{{ asset('images/icon_report_check.png') }}" alt=""/>
                                        </div><!-- /.image -->
                                    </div>
                                    <div class="row centered">
                                        <a href="{{ route(USER_REPAIR_HISTORY, $item->id) }}">{{ __('attributes.common.edit') }}</a>
                                        <span class="m0 m5r m5l">/</span>
                                        <a href="{{ route(USER_REPAIR_HISTORY, [$item->id, 'show_print' => true]) }}">{{ __('attributes.common.export') }}</a>
                                    </div>
                                    <div class="text-center date">{{ dateTimeFormat(last($item->repairHistory->toArray())['updated_at']) }}</div>
                                </td>
                            @else
                                <td class="border-top-0 border-left-0 text-center">
                                    <a href="{{ route(USER_REPAIR_HISTORY, $item->id) }}">
                                        <div class="centered m5b">
                                            <div class="image">
                                                <img src="{{ asset('images/icon_report_add.png') }}" alt=""/>
                                            </div>
                                        </div>
                                        <div class="text-center">{{ __('attributes.common.new_registration') }}</div>
                                    </a>
                                </td>
                            @endif

                            @if($item->generalInfo)
                                <td class="border-top-0 border-left-0">
                                    <div class="centered m5b">
                                        <div class="image">
                                            <img src="{{ asset('images/icon_report_check.png') }}" alt=""/>
                                        </div><!-- /.image -->
                                    </div>
                                    <div class="row centered">
                                        <a href="{{ route(USER_ESSENTIAL, ['id' => $item->id, 'screen' => 'report', 'option_paginate' => $optionPaginate]) }}">{{ __('attributes.common.edit') }}</a>
                                        <span class="m0 m5r m5l">/</span>
                                        <a href="{{ route(USER_ESSENTIAL, ['id' => $item->id, 'screen' => 'report', 'option_paginate' => $optionPaginate, 'show_print' => true]) }}">{{ __('attributes.common.export') }}</a>
                                    </div>
                                    <div class="text-center date">{{ dateTimeFormat($item->generalInfo->updated_at) }}</div>
                                </td>
                            @else
                                <td class="border-top-0 border-left-0 text-center">
                                    <a href="{{ route(USER_ESSENTIAL, ['id' => $item->id, 'screen' => 'report', 'option_paginate' => $optionPaginate]) }}">
                                        <div class="centered m5b">
                                            <div class="image">
                                                <img src="{{ asset('images/icon_report_add.png') }}" alt=""/>
                                            </div>
                                        </div>
                                        <div class="text-center">{{ __('attributes.common.new_registration') }}</div>
                                    </a>
                                </td>
                            @endif
                        </tr>
                    @empty
                        <td colspan="11" class="text-center">{{ __('attributes.common.no_data') }}</td>
                    @endforelse
                    </tbody>
                </table>
            </div>
            <div class="arrowArea pointer">
                <button class="arrow prev">
                    <img src="{{ asset('images/arrow-prev.png') }}" alt="左へ"/>
                </button>

                <button class="arrow next">
                    <img src="{{ asset('images/arrow-next.png') }}" alt="左へ"/>
                </button>
            </div>
        </div>

        <div class="col-12 text-lg-right p0 text-right group-button-top">
            <div class="btn-group">
                <div class="btn label-option fs14 centered fw-bold p10">{{ __('attributes.common.option_paginate') }}</div>
                <div class="btn wrap-input-option fs14 w-45 p0">
                    <select name="option_paginate" class="per-page option-paginate-1 btn form-control hp100 p0 p15r p5l">
                        @foreach(LIST_OPTION_PAGINATE as $key => $value)
                            <option class="m20r m20l" value="{{ $key }}" @if($optionPaginate == $key) {{'selected'}} @endif>{{ $value }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            {{ $property->appends(['option_paginate' => $optionPaginate, 'proprietor' => isset($params['proprietor']) ? $params['proprietor'] : ''])->links('partials.simple_paginate', ['totalPage' => $totalPage]) }}
        </div>
    </div>
@endsection
@section('js')
        <script src="{{ asset('dist/js/report.min.js') }}"></script>
@endsection

