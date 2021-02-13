@extends('layout.home.master')
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/preview/annual_performance.css') }}">
@endsection
@section('content')
    <div class="container-fluid container-wrapper container-wrapper-annual">
        @php($timeLine = setTimeLine($property['date_month_registration_revenue']))

        <div id="main-info-assessment" class="@if(request('show_print') == true) has-print @endif">
            <div class="row row-header m50b">
                <div class="row m0">
                    <div class="col-12 text-center text-md-left p0">
                        <h3 class="m0">{{ __('attributes.home.menu.year_achievement_table') }} -
                            <span class="fs24 fw-normal">{{ $property['house_name'] }}</span></h3>
                    </div>
                </div>
            </div>
            @include('partials.flash_messages')
            <form id="form-condition-1" class="row m0 m30b" method="get">
                <div class="w-auto text-center text-md-right m0 m15r p0 group-status-top row">
                    <div id="block-status" class="row spBlock m0 m15r w-auto">
                        <div class="centered first-block p15r p15l">
                            <label class="m0">{{ __('attributes.property.status') }}</label>
                        </div>
                        <div class="centered p0 p15r p15l w90">
                            <div
                                class="fw-normal">{{ $property['status'] ? STATUS_HOUSE[$property['status']] : '' }}</div>
                        </div>
                    </div>

                    @if ($currentUser->role != INVESTOR)
                        <div id="block-status" class="row spBlock m0 m15r w-auto">
                            <div class="centered first-block p15r p15l">
                                <label class="m0">{{ __('attributes.repair_history.owner') }}</label>
                            </div>
                            <div class="centered-vertical p0 p15r p15l w250">
                                <div class="fw-normal">{{$property['proprietor'] ?? 'ー'}}</div>
                            </div>
                        </div>
                     @endif

                    <!-- 0320 add-->
                    <div id="block-status" class="row spBlock m0 w-auto">
                        <div class="centered first-block p15r p15l">
                            <label class="m0">{{ __('attributes.property.annual_month') }}</label>
                        </div>
                        <div class="centered-vertical p0 p15r p15l w90">
                            <div class="fw-normal">{{$property['date_month_registration_revenue']}}
                                {{ __('attributes.common.lunar_month') }}</div>
                        </div>
                    </div>
                    <!-- 0320 add-->
                </div>

                <div class="row centered-vertical m0 m9r-pr media-1410-m10t fs14 fs13-sp">
                    <div class="fw-normal">
                        <span class="fw-bold">{{ trans('attributes.monthly_balance.first_month') }}　</span>
                        {{ $timeLine['month_start'].trans('attributes.common.month').'　〜　'.trans('attributes.common.period'). '　' .$timeLine['month_end'].trans('attributes.common.month')}}
                    </div>
                </div>

                <div class="w-auto text-lg-right p0 text-right group-button-top">
                    <a href="{{ route(USER_PROPERTY_ANNUAL_PERFORMANCE_CREATE, [$property['id'], 'screen' => 'annual-performance', 'option_paginate' => $optionPaginate , 'page'=> $annualPerformances->currentPage()]) }}"
                       class="btn custom-btn-default fs15 sort-property w70 m7l">
                        {{ trans('attributes.tax.add') }}
                    </a>
                    <div class="d-inline-block cus-paginate m0">
                        {{ $annualPerformances->appends(['option_paginate' => FLAG_ELEVEN])->links('partials.simple_paginate', ['totalPage' => $annualPerformances->lastPage()]) }}
                    </div>
                    <button type="button" id="pre-print" class="btn w-auto custom-btn-success fs15 m15l m0lr-sp pre-print-annual show-print">{{ __('attributes.property.display_preview') }}</button>
                </div>
            </form>

            <form id="form-data-annual-performance" class="row col-12 m0 p0">
                <input name="property_id" type="text" class="d-none" value="{{ $property['id'] }}">
                <div class="w-65 p0">
                    <div class="row m0 m30b br10 bg-white">
                        <div class="table-responsive fs14 br10">
                            <table id="table-property" class="table table-bordered table-striped border-0 m0">
                                <tr class="table-head">
                                    <td class="border-0 position-relative w400">
                                        <div class="w400">
                                            <div class="d-flex m0 m10b p0">
                                                <div class="col-12 d-flex p0 relative">
                                                    <div class="w-45 p0">
                                                        <p class="fs16 m0">{{ __('attributes.simulation.content.operating_revenue.title') }}</p>
                                                    </div>
                                                    <div class="w-55 p0">
                                                        <p class="fs16 m0">{{$dataLatestYear->year}}{{ __('attributes.rent_roll_list.year') }}</p>
                                                        <input name="year[]" type="text" class="d-none"
                                                               value="{{ $dataLatestYear->year }}" readonly>
                                                    </div>
                                                    <div class="p0">
                                                        <div class="col-6 text-right">
                                                            <a href="#"
                                                               class="pointer sidebar-list fs16 m0 p3l text-center"
                                                               data-toggle="dropdown" aria-haspopup="true"
                                                               aria-expanded="false">
                                                                <i class="fa fa-bars custom-fa" aria-hidden="true"></i>
                                                            </a>
                                                            <div class="dropdown-menu">
                                                                <a class="dropdown-item custom-dropdown-item"
                                                                   href="{{route(USER_PROPERTY_ANNUAL_PERFORMANCE_EDIT, ['propertyId' => $property['id'], 'screen' => 'annual-performance', 'option_paginate' => $optionPaginate , 'page'=> $annualPerformances->currentPage(), 'id' =>$dataLatestYear->id])}}">
                                                                    {{__('attributes.annual_performance.edit')}}</a>
                                                                <a class="dropdown-item error-messages custom-dropdown-item destroy-annual-performance" data-id="{{ $dataLatestYear->id }}" data-value="{{ json_encode($dataLatestYear) }}" data-toggle="modal" data-target="#confirm-delete-annual-performance" href="#">
                                                                    {{__('attributes.annual_performance.delete')}}
                                                                </a>
                                                            </div>
                                                        </div>
                                                        <div class="m3l p0 d-flex align-items-end justify-content-end ">
                                                            <p class="fs12 fw-normal m0">
                                                                ({{ __('attributes.common.yen') }})</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @php($showInput0 = in_array($property['real_estate_type_id'], [FLAG_NINE, FLAG_TEN]))
                                            @if($showInput0)
                                                <div class="d-flex m-0 p0 fw-normal">
                                                    <div class="col-5 col-12-sp p0 d-flex align-items-center">
                                                       <span class="d-inline-block">{{ __('attributes.register_info.item_block.label.rent_income') }}<br>
                                            {{ __('attributes.register_info.item_block.label.rent_income_1') }}</span>
                                                    </div>
                                                    <div class="col-7 col-12-sp p0">
                                                        <div class="d-flex">
                                                            <span class="number-li custom-number-li">0</span>
                                                            <div class="col-11 p0">
                                                                <input name="revenue_land_taxes"
                                                                       value="{{number_format($dataLatestYear->revenue_land_taxes)}}"
                                                                       class="disable-field form-control text-right br0"
                                                                       id="revenue_land_taxes" disabled>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif

                                            <div class="d-flex m-0 p0 fw-normal @if($showInput0) p10t @endif">
                                                <div class="col-5 col-12-sp p0 d-flex align-items-center">
                                                    <span
                                                        class="d-inline-block">{{ __('attributes.simulation.content.operating_revenue.number') }}</span>
                                                </div>
                                                <div class="col-7 col-12-sp p0">
                                                    <div class="d-flex">
                                                        <span class="number-li custom-number-li">1</span>
                                                        <div class="col-11 p0">
                                                            <input name="revenue_room_rentals_16"
                                                                   value="{{number_format($dataLatestYear->rent_income)}}"
                                                                   class="disable-field form-control text-right br0"
                                                                   id="revenue_room_rentals_16" disabled>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="d-flex m-0 p0 p10t fw-normal">
                                                <div class="col-5 col-12-sp p0 d-flex align-items-center">
                                                    <span
                                                        class="d-inline-block">{{ __('attributes.simulation.content.operating_revenue.general_services') }}</span>
                                                </div>
                                                <div class="col-7 col-12-sp p0">
                                                    <div class="d-flex">
                                                        <span class="number-li custom-number-li">2</span>
                                                        <div class="col-11 p0">
                                                            <input name="revenue_service_charges_16"
                                                                   value="{{number_format($dataLatestYear->general_services)}}"
                                                                   class="disable-field form-control text-right br0"
                                                                   id="revenue_service_charges_16" disabled>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="d-flex m-0 p0 p10t fw-normal">
                                                <div class="col-5 col-12-sp p0 d-flex align-items-center">
                                                    <span
                                                        class="d-inline-block">{{ __('attributes.simulation.content.operating_revenue.utilities') }}</span>
                                                </div>
                                                <div class="col-7 col-12-sp p0">
                                                    <div class="d-flex">
                                                        <span class="number-li custom-number-li">3</span>
                                                        <div class="col-11 p0">
                                                            <input name="revenue_utilities_16"
                                                                   value="{{number_format($dataLatestYear->utilities_revenue)}}"
                                                                   class="disable-field form-control text-right br0"
                                                                   id="revenue_utilities_16" disabled>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="d-flex m-0 p0 p10t fw-normal">
                                                <div class="col-5 col-12-sp p0 d-flex align-items-center">
                                                    <span
                                                        class="d-inline-block">{{ __('attributes.simulation.content.operating_revenue.parking') }}</span>
                                                </div>
                                                <div class="col-7 col-12-sp p0">
                                                    <div class="d-flex">
                                                        <span class="number-li custom-number-li">4</span>
                                                        <div class="col-11 p0">
                                                            <input name="revenue_car_deposits_16"
                                                                   value="{{number_format($dataLatestYear->parking_revenue)}}"
                                                                   class="disable-field form-control text-right br0"
                                                                   id="revenue_car_deposits_16" disabled>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="d-flex m-0 p0 p10t fw-normal">
                                                <div class="col-5 col-12-sp p0 d-flex align-items-center">
                                                    <span
                                                        class="d-inline-block">{{ __('attributes.simulation.content.operating_revenue.income_input_money') }}</span>
                                                </div>
                                                <div class="col-7 col-12-sp p0">
                                                    <div class="d-flex">
                                                        <span class="number-li custom-number-li">5</span>
                                                        <div class="col-11 p0">
                                                            <input name="turnover_revenue_16"
                                                                   value="{{number_format($dataLatestYear->income_input_money)}}"
                                                                   class="disable-field form-control text-right br0"
                                                                   id="turnover_revenue_16" disabled>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="d-flex m-0 p0 p10t fw-normal">
                                                <div class="col-5 col-12-sp p0 d-flex align-items-center">
                                                    <span
                                                        class="d-inline-block">{{ __('attributes.simulation.content.operating_revenue.income_update_house_contract') }}</span>
                                                </div>
                                                <div class="col-7 col-12-sp p0">
                                                    <div class="d-flex">
                                                        <span class="number-li custom-number-li">6</span>
                                                        <div class="col-11 p0">
                                                            <input name="revenue_contract_update_fee_16"
                                                                   value="{{number_format($dataLatestYear->income_update_house_contract)}}"
                                                                   class="disable-field form-control text-right br0"
                                                                   id="revenue_contract_update_fee_16" disabled>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="d-flex m-0 p0 p10t fw-normal">
                                                <div class="col-5 col-12-sp p0 d-flex align-items-center">
                                                    <span
                                                        class="d-inline-block">{{ __('attributes.simulation.content.operating_revenue.other') }}</span>
                                                </div>
                                                <div class="col-7 col-12-sp p0">
                                                    <div class="d-flex">
                                                        <span class="number-li custom-number-li">7</span>
                                                        <div class="col-11 p0">
                                                            <input name="revenue_other_16"
                                                                   value="{{number_format($dataLatestYear->other_income)}}"
                                                                   class="disable-field form-control text-right br0"
                                                                   id="revenue_other_16" disabled>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="d-flex m-0 p0 p10t fw-normal">
                                                <div class="col-5 col-12-sp p0 d-flex align-items-center">
                                                    <span
                                                        class="d-inline-block">{{ __('attributes.simulation.content.operating_revenue.bad_debt') }}</span>
                                                </div>
                                                <div class="col-7 col-12-sp p0">
                                                    <div class="d-flex">
                                                        <span class="number-li custom-number-li">8</span>
                                                        <div class="col-11 p0">
                                                            <input name="bad_debt_16"
                                                                   value="{{number_format($dataLatestYear->bad_debt_losses)}}"
                                                                   class="disable-field form-control text-right br0"
                                                                   id="bad_debt_16" disabled>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="d-flex m-0 p0 p10t fw-normal">
                                                <div class="col-5 col-12-sp p0 d-flex align-items-center">
                                                    <span
                                                        class="d-inline-block">{{ __('attributes.simulation.content.operating_revenue.sum') }}</span>
                                                </div>
                                                <div class="col-7 col-12-sp p0">
                                                    <div class="d-flex">
                                                        <span class="number-li custom-number-li">9</span>
                                                        <div class="col-11 p0">
                                                            <input name="total_revenue_16"
                                                                   value="{{number_format($dataLatestYear->sum_income)}}"
                                                                   class="disable-field form-control text-right br0"
                                                                   id="total_revenue_16" disabled>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    @foreach($annualPerformances as $key => $annualPerformance)
                                        <td class="border-top-0 position-relative border-right-0">
                                            <div class="w230">
                                                <div class="d-flex m0 m10b p0">
                                                    <div class="col-12 d-flex p0">
                                                        <div class="w-100 p0">
                                                            <p class="fs16 m0">{{$annualPerformances[$key]->year}}{{ __('attributes.rent_roll_list.year') }}</p>
                                                            <input name="year[]" type="text" class="d-none"
                                                                   value="{{ $annualPerformances[$key]->year }}"
                                                                   readonly>
                                                        </div>
                                                        <div class="p0">
                                                            <div class="col-6 text-right">
                                                                <a href="#"
                                                                   class="pointer sidebar-list fs16 m0 p3l text-center"
                                                                   data-toggle="dropdown" aria-haspopup="true"
                                                                   aria-expanded="false">
                                                                    <i class="fa fa-bars custom-fa"
                                                                       aria-hidden="true"></i>
                                                                </a>
                                                                <div class="dropdown-menu">
                                                                    <a class="dropdown-item custom-dropdown-item"
                                                                       href="{{route(USER_PROPERTY_ANNUAL_PERFORMANCE_EDIT, ['propertyId' => $property['id'], 'screen' => 'annual-performance', 'option_paginate' => $optionPaginate , 'page'=> $annualPerformances->currentPage(), 'id' =>$annualPerformances[$key]->id])}}">
                                                                        {{__('attributes.annual_performance.edit')}}
                                                                    </a>
                                                                    <a class="dropdown-item error-messages custom-dropdown-item destroy-annual-performance" data-id="{{ $annualPerformance->id }}" data-value="{{ json_encode($annualPerformance) }}" data-toggle="modal" data-target="#confirm-delete-annual-performance" href="#">
                                                                        {{__('attributes.annual_performance.delete')}}
                                                                    </a>
                                                                </div>
                                                            </div>
                                                            <div
                                                                class="m3l p0 d-flex align-items-end justify-content-end ">
                                                                <p class="fs12 fw-normal m0">
                                                                    ({{ __('attributes.common.yen') }})</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @if($showInput0)
                                                    <div class="m0 p0 fw-normal">
                                                        <div class="col-12 p0">
                                                            <input name="revenue_land_taxes"
                                                                   value="{{number_format($annualPerformances[$key]->revenue_land_taxes)}}"
                                                                   class="disable-field form-control text-right br0"
                                                                   id="revenue_land_taxes" disabled>
                                                        </div>
                                                    </div>
                                                @endif
                                                <div class="m0 p0 fw-normal @if($showInput0) p10t @endif">
                                                    <div class="col-12 p0">
                                                        <input name="revenue_room_rentals_15"
                                                               value="{{number_format($annualPerformances[$key]->rent_income)}}"
                                                               class="disable-field form-control text-right br0"
                                                               id="revenue_room_rentals_15" disabled>
                                                    </div>
                                                </div>

                                                <div class="m0 p0 p10t fw-normal">
                                                    <div class="col-12 p0">
                                                        <input name="revenue_service_charges_15"
                                                               value="{{number_format($annualPerformances[$key]->general_services)}}"
                                                               class="disable-field form-control text-right br0"
                                                               id="revenue_service_charges_15" disabled>
                                                    </div>
                                                </div>

                                                <div class="m0 p0 p10t fw-normal">
                                                    <div class="col-12 p0">
                                                        <input name="revenue_utilities_15"
                                                               value="{{number_format($annualPerformances[$key]->utilities_revenue)}}"
                                                               class="disable-field form-control text-right br0"
                                                               id="revenue_utilities_15" disabled>
                                                    </div>
                                                </div>

                                                <div class="m0 p0 p10t fw-normal">
                                                    <div class="col-12 p0">
                                                        <input name="revenue_car_deposits_15"
                                                               value="{{number_format($annualPerformances[$key]->parking_revenue)}}"
                                                               class="disable-field form-control text-right br0"
                                                               id="revenue_car_deposits_15" disabled>
                                                    </div>
                                                </div>

                                                <div class="m0 p0 p10t fw-normal">
                                                    <div class="col-12 p0">
                                                        <input name="turnover_revenue_15"
                                                               value="{{number_format($annualPerformances[$key]->income_input_money)}}"
                                                               class="disable-field form-control text-right br0"
                                                               id="turnover_revenue_15" disabled>
                                                    </div>
                                                </div>

                                                <div class="m0 p0 p10t fw-normal">
                                                    <div class="col-12 p0">
                                                        <input name="revenue_contract_update_fee_15"
                                                               value="{{number_format($annualPerformances[$key]->income_update_house_contract)}}"
                                                               class="disable-field form-control text-right br0"
                                                               id="revenue_contract_update_fee_15" disabled>
                                                    </div>
                                                </div>

                                                <div class="m0 p0 p10t fw-normal">
                                                    <div class="col-12 p0">
                                                        <input name="revenue_other_15"
                                                               value="{{number_format($annualPerformances[$key]->other_income)}}"
                                                               class="disable-field form-control text-right br0"
                                                               id="revenue_other_15" disabled>
                                                    </div>
                                                </div>

                                                <div class="m0 p0 p10t fw-normal">
                                                    <div class="col-12 p0">
                                                        <input name="bad_debt_15"
                                                               value="{{number_format($annualPerformances[$key]->bad_debt_losses)}}"
                                                               class="disable-field form-control text-right br0"
                                                               id="bad_debt_15" disabled>
                                                    </div>
                                                </div>

                                                <div class="m0 p0 p10t fw-normal">
                                                    <div class="col-12 p0">
                                                        <input name="total_revenue_15"
                                                               value="{{number_format($annualPerformances[$key]->sum_income)}}"
                                                               class="disable-field form-control text-right br0"
                                                               id="total_revenue_15" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    @endforeach
                                </tr>

                                <tr class="table">
                                    <td class="border-bottom-0 border-left-0">
                                        <div class="w400">
                                            <div class="d-flex m0 m10b p0">
                                                <div class="col-12 d-flex p0 relative">
                                                    <div class="col-11 p0l m5b">
                                                        <p class="fs16 m0 fw-bold">{{ __('attributes.simulation.content.operating_fee.title') }}</p>
                                                    </div>
                                                    <div
                                                        class="col-1 m3l p0 d-flex align-items-end justify-content-end ">
                                                        <p class="fs12 fw-normal m0">({{ __('attributes.common.yen') }}
                                                            )</p>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="d-flex m-0 p0 fw-normal">
                                                <div class="col-5 col-12-sp p0 d-flex align-items-center">
                                                    <span
                                                        class="d-inline-block">{{ __('attributes.simulation.content.operating_fee.maintenance_management') }}</span>
                                                </div>
                                                <div class="col-7 col-12-sp p0">
                                                    <div class="d-flex">
                                                        <span class="number-li custom-number-li">10</span>
                                                        <div class="col-11 p0">
                                                            <input name="maintenance_management_fee_16"
                                                                   value="{{number_format($dataLatestYear->management_fee)}}"
                                                                   class="disable-field form-control text-right br0"
                                                                   id="maintenance_management_fee_16" disabled>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="d-flex m-0 p0 p10t fw-normal">
                                                <div class="col-5 col-12-sp p0 d-flex align-items-center">
                                                    <span
                                                        class="d-inline-block">{{ __('attributes.simulation.content.operating_fee.utilities') }}</span>
                                                </div>
                                                <div class="col-7 col-12-sp p0">
                                                    <div class="d-flex">
                                                        <span class="number-li custom-number-li">11</span>
                                                        <div class="col-11 p0">
                                                            <input name="electricity_gas_charges_16"
                                                                   value="{{number_format($dataLatestYear->utilities_fee)}}"
                                                                   class="disable-field form-control text-right br0"
                                                                   id="electricity_gas_charges_16" disabled>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="d-flex m-0 p0 p10t fw-normal">
                                                <div class="col-5 col-12-sp p0 d-flex align-items-center">
                                                    <span
                                                        class="d-inline-block">{{ __('attributes.simulation.content.operating_fee.repair') }}</span>
                                                </div>
                                                <div class="col-7 col-12-sp p0">
                                                    <div class="d-flex">
                                                        <span class="number-li custom-number-li">12</span>
                                                        <div class="col-11 p0">
                                                            <input name="repair_fee_16"
                                                                   value="{{number_format($dataLatestYear->repair_fee)}}"
                                                                   class="disable-field form-control text-right br0"
                                                                   id="repair_fee_16" disabled>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="d-flex m-0 p0 p10t fw-normal">
                                                <div class="col-5 col-12-sp p0 d-flex align-items-center">
                                                    <span
                                                        class="d-inline-block">{{ __('attributes.simulation.content.operating_fee.intact_reply') }}</span>
                                                </div>
                                                <div class="col-7 col-12-sp p0">
                                                    <div class="d-flex">
                                                        <span class="number-li custom-number-li">13</span>
                                                        <div class="col-11 p0">
                                                            <input name="recovery_costs_16"
                                                                   value="{{number_format($dataLatestYear->intact_reply_fee)}}"
                                                                   class="disable-field form-control text-right br0"
                                                                   id="recovery_costs_16" disabled>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="d-flex m-0 p0 p10t fw-normal">
                                                <div class="col-5 col-12-sp p0 d-flex align-items-center">
                                                        <span class="d-inline-block">{{ __('attributes.balance.body.property') }}<br/>
                                                            {{ __('attributes.balance.body.management_fee') }}
                                                        </span>
                                                </div>
                                                <div class="col-7 col-12-sp p0">
                                                    <div class="d-flex">
                                                        <span class="number-li custom-number-li">14</span>
                                                        <div class="col-11 p0">
                                                            <input name="property_management_fee_16"
                                                                   value="{{number_format($dataLatestYear->asset_management_fee)}}"
                                                                   class="disable-field form-control text-right br0"
                                                                   id="property_management_fee_16" disabled>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="d-flex m-0 p0 p10t fw-normal">
                                                <div class="col-5 col-12-sp p0 d-flex align-items-center">
                                                    <span
                                                        class="d-inline-block">{{ __('attributes.simulation.content.operating_fee.recruitment_rental') }}</span>
                                                </div>
                                                <div class="col-7 col-12-sp p0">
                                                    <div class="d-flex">
                                                        <span class="number-li custom-number-li">15</span>
                                                        <div class="col-11 p0">
                                                            <input name="find_tenant_fee_16"
                                                                   value="{{number_format($dataLatestYear->tenant_recruitment_fee)}}"
                                                                   class="disable-field form-control text-right br0"
                                                                   id="find_tenant_fee_16" disabled>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="d-flex m-0 p0 p10t fw-normal">
                                                <div class="col-5 col-12-sp p0 d-flex align-items-center">
                                                    <span
                                                        class="d-inline-block">{{ __('attributes.simulation.content.operating_fee.tax') }}</span>
                                                </div>
                                                <div class="col-7 col-12-sp p0">
                                                    <div class="d-flex">
                                                        <span class="number-li custom-number-li">16</span>
                                                        <div class="col-11 p0">
                                                            <input name="tax_16"
                                                                   value="{{number_format($dataLatestYear->taxes_dues)}}"
                                                                   class="disable-field form-control text-right br0"
                                                                   id="tax_16" disabled>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="d-flex m-0 p0 p10t fw-normal">
                                                <div class="col-5 col-12-sp p0 d-flex align-items-center">
                                                    <span
                                                        class="d-inline-block">{{ __('attributes.simulation.content.operating_fee.damage_insurance') }}</span>
                                                </div>
                                                <div class="col-7 col-12-sp p0">
                                                    <div class="d-flex">
                                                        <span class="number-li custom-number-li">17</span>
                                                        <div class="col-11 p0">
                                                            <input name="loss_insurance_16"
                                                                   value="{{number_format($dataLatestYear->insurance_premium)}}"
                                                                   class="disable-field form-control text-right br0"
                                                                   id="loss_insurance_16" disabled>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="d-flex m-0 p0 p10t fw-normal">
                                                <div class="col-5 col-12-sp p0 d-flex align-items-center">
                                                    <span
                                                        class="d-inline-block">{{ __('attributes.simulation.content.operating_fee.land_tax') }}</span>
                                                </div>
                                                <div class="col-7 col-12-sp p0">
                                                    <div class="d-flex">
                                                        <span class="number-li custom-number-li">18</span>
                                                        <div class="col-11 p0">
                                                            <input name="land_rental_fee_16"
                                                                   value="{{number_format($dataLatestYear->land_tax)}}"
                                                                   class="disable-field form-control text-right br0"
                                                                   id="land_rental_fee_16" disabled>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="d-flex m-0 p0 p10t fw-normal">
                                                <div class="col-5 col-12-sp p0 d-flex align-items-center">
                                                    <span
                                                        class="d-inline-block">{{ __('attributes.simulation.content.operating_fee.other') }}</span>
                                                </div>
                                                <div class="col-7 col-12-sp p0">
                                                    <div class="d-flex">
                                                        <span class="number-li custom-number-li">19</span>
                                                        <div class="col-11 p0">
                                                            <input name="other_costs_16"
                                                                   value="{{number_format($dataLatestYear->other_fee)}}"
                                                                   class="disable-field form-control text-right br0"
                                                                   id="other_costs_16" disabled>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="d-flex m-0 p0 p10t fw-normal">
                                                <div class="col-5 col-12-sp p0 d-flex align-items-center">
                                                    <span
                                                        class="d-inline-block">{{ __('attributes.simulation.content.operating_fee.sum') }}</span>
                                                </div>
                                                <div class="col-7 col-12-sp p0">
                                                    <div class="d-flex">
                                                        <span class="number-li custom-number-li">20</span>
                                                        <div class="col-11 p0">
                                                            <input name="total_cost_16"
                                                                   value="{{number_format($dataLatestYear->sum_fee)}}"
                                                                   class="disable-field form-control text-right br0"
                                                                   id="total_cost_16" disabled>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="d-flex m-0 p0 p10t fw-normal">
                                                <div class="col-5 col-12-sp p0 d-flex align-items-center">
                                                    <span class="d-flex">{{ __('attributes.simulation.content.operating_total') }}(<span
                                                            class="number-li m5l m5r">9</span>-<span
                                                            class="number-li m5l m5r">20</span>)</span>

                                                </div>
                                                <div class="col-7 col-12-sp p0">
                                                    <div class="d-flex">
                                                        <span class="number-li custom-number-li">21</span>
                                                        <div class="col-11 p0">
                                                            <input name="operating_balance_16"
                                                                   value="{{number_format($dataLatestYear->sum_difference)}}"
                                                                   class="disable-field form-control text-right br0"
                                                                   id="operating_balance_16" disabled>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="d-flex m-0 p0 p10t fw-normal">
                                                <div class="col-5 col-12-sp p0 d-flex align-items-center">
                                                    <span
                                                        class="d-inline-block">{{ trans('attributes.property.total_tenants') }}</span>
                                                </div>
                                                <div class="col-7 col-12-sp p0">
                                                    <input name="year_end_occupancy_rate_16"
                                                           value="{{number_format($dataLatestYear->total_tenants)}}"
                                                           class="disable-field form-control text-center br0"
                                                           id="year_end_occupancy_rate_16" disabled>
                                                </div>
                                            </div>
                                            <div class="d-flex m-0 p0 p10t fw-normal">
                                                <div class="col-5 col-12-sp p0 d-flex align-items-center">
                                                    <span
                                                        class="d-inline-block">{{ trans('attributes.property.area_can_for_rent') }}</span>
                                                </div>
                                                <div class="col-7 col-12-sp p0">
                                                    <input name="year_end_occupancy_rate_16"
                                                           value="{{number_format($dataLatestYear->area_may_rent, 2)}}"
                                                           class="disable-field form-control text-center br0"
                                                           id="year_end_occupancy_rate_16" disabled>
                                                </div>
                                            </div>
                                            <div class="d-flex m-0 p0 p10t fw-normal">
                                                <div class="col-5 col-12-sp p0 d-flex align-items-center">
                                                    <span
                                                        class="d-inline-block">{{ trans('attributes.property.deposit') }}</span>
                                                </div>
                                                <div class="col-7 col-12-sp p0">
                                                    <input name="year_end_occupancy_rate_16"
                                                           value="{{number_format($dataLatestYear->deposits)}}"
                                                           class="disable-field form-control text-center br0"
                                                           id="year_end_occupancy_rate_16" disabled>
                                                </div>
                                            </div>
                                            <div class="d-flex m-0 p0 p10t fw-normal">
                                                <div class="col-5 col-12-sp p0 d-flex align-items-center">
                                                    <span
                                                        class="d-inline-block">{{ trans('attributes.property.area_for_rent') }}</span>
                                                </div>
                                                <div class="col-7 col-12-sp p0">
                                                    <input name="year_end_occupancy_rate_16"
                                                           value="{{number_format($dataLatestYear->area_rental_operating, 2)}}"
                                                           class="disable-field form-control text-center br0"
                                                           id="year_end_occupancy_rate_16" disabled>
                                                </div>
                                            </div>
                                            <div class="d-flex m-0 p0 p10t fw-normal">
                                                <div class="col-5 col-12-sp p0 d-flex align-items-center">
                                                    <span
                                                        class="d-inline-block">{{ __('attributes.register_info.item_block.label.crop_yield_1') }}</span>
                                                </div>
                                                <div class="col-7 col-12-sp p0">
                                                    <input name="year_end_occupancy_rate_16"
                                                           value="{{number_format($dataLatestYear->crop_yield, 2)}} {{ trans('attributes.common.percent') }}"
                                                           class="disable-field form-control text-center br0"
                                                           id="year_end_occupancy_rate_16" disabled>
                                                </div>
                                            </div>
                                            <div class="d-flex m-0 p0 p10t fw-normal">
                                                <div class="col-5 col-12-sp p0 d-flex align-items-center">
                                                    <span
                                                        class="d-inline-block">{{ __('attributes.property.annual_payment_principal_interes') }}</span>
                                                </div>
                                                <div class="col-7 col-12-sp p0">
                                                    <input name="annual_repayment_of_principal_and_interest_16"
                                                           value="{{number_format($property['amount_paid_annually'])}}"
                                                           class="disable-field form-control text-right br0"
                                                           id="annual_repayment_of_principal_and_interest_16" disabled>
                                                </div>
                                            </div>
                                            <div class="d-flex m-0 p0 p10t fw-normal">
                                                <div class="col-5 col-12-sp p0 d-flex align-items-center">
                                                        <span class="d-inline-block">{{ __('attributes.register_info.item_block.label.dscr_first') }}<br/>
                                                            {{ __('attributes.register_info.item_block.label.dscr_last') }}
                                                        </span>
                                                </div>
                                                <div class="col-7 col-12-sp p0">
                                                    <input name="repayment_coverage_rate_16"
                                                           value="{{number_format($dataLatestYear->dscr,2)}} {{ trans('attributes.common.percent') }}"
                                                           class="disable-field form-control text-center br0"
                                                           id="repayment_coverage_rate_16" disabled>
                                                </div>
                                            </div>
                                            <div class="d-flex m-0 p0 p10t fw-normal">
                                                <div class="col-5 col-12-sp p0 d-flex align-items-center">
                                                        <span class="d-inline-block">{{ __('attributes.simulation.preview.title_chart_1_first') }}<br/>
                                                            ({{ __('attributes.simulation.preview.title_chart_1_last') }})
                                                        </span>
                                                </div>
                                                <div class="col-7 col-12-sp p0">
                                                    <input name="score_point_0" value="0 points"
                                                           class="disable-field form-control text-center br0"
                                                           id="score_16" disabled>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    @foreach($annualPerformances as $key =>$annualPerformance)
                                        <td class="border-top-0 border-right-0">
                                            <div class="m7t w230">
                                                <div class="d-flex m10b p0">
                                                    <div
                                                        class="col-12 m3l p0 d-flex align-items-end justify-content-end">
                                                        <p class="fs12 fw-normal m0">({{ __('attributes.common.yen') }}
                                                            )</p>
                                                    </div>
                                                </div>

                                                <div class="m0 p0 fw-normal">
                                                    <div class="col-12 p0">
                                                        <input name="maintenance_management_fee_15"
                                                               value="{{number_format($annualPerformances[$key]->management_fee)}}"
                                                               class="disable-field form-control text-right br0"
                                                               id="maintenance_management_fee_15" disabled>
                                                    </div>
                                                </div>

                                                <div class="m0 p0 p10t fw-normal">
                                                    <div class="col-12 p0">
                                                        <input name="electricity_gas_charges_15"
                                                               value="{{number_format($annualPerformances[$key]->utilities_fee)}}"
                                                               class="disable-field form-control text-right br0"
                                                               id="electricity_gas_charges_15" disabled>
                                                    </div>
                                                </div>

                                                <div class="m0 p0 p10t fw-normal">
                                                    <div class="col-12 p0">
                                                        <input name="repair_fee_15"
                                                               value="{{number_format($annualPerformances[$key]->repair_fee)}}"
                                                               class="disable-field form-control text-right br0"
                                                               id="repair_fee_15" disabled>
                                                    </div>
                                                </div>

                                                <div class="m0 p0 p10t fw-normal">
                                                    <div class="col-12 p0">
                                                        <input name="recovery_costs_15"
                                                               value="{{number_format($annualPerformances[$key]->intact_reply_fee)}}"
                                                               class="disable-field form-control text-right br0"
                                                               id="recovery_costs_15" disabled>
                                                    </div>
                                                </div>

                                                <div class="m0 p0 p10t fw-normal">
                                                    <div class="col-12 p0">
                                                        <input name="property_management_fee_15"
                                                               value="{{number_format($annualPerformances[$key]->asset_management_fee)}}"
                                                               class="disable-field form-control text-right br0"
                                                               id="property_management_fee_15" disabled>
                                                    </div>
                                                </div>

                                                <div class="m0 p0 p13t fw-normal">
                                                    <div class="col-12 p0">
                                                        <input name="find_tenant_fee_15"
                                                               value="{{number_format($annualPerformances[$key]->tenant_recruitment_fee)}}"
                                                               class="disable-field form-control text-right br0"
                                                               id="find_tenant_fee_15" disabled>
                                                    </div>
                                                </div>

                                                <div class="m0 p0 p10t fw-normal">
                                                    <div class="col-12 p0">
                                                        <input name="tax_15"
                                                               value="{{number_format($annualPerformances[$key]->taxes_dues)}}"
                                                               class="disable-field form-control text-right br0"
                                                               id="tax_15" disabled>
                                                    </div>
                                                </div>

                                                <div class="m0 p0 p10t fw-normal">
                                                    <div class="col-12 p0">
                                                        <input name="loss_insurance_15"
                                                               value="{{number_format($annualPerformances[$key]->insurance_premium)}}"
                                                               class="disable-field form-control text-right br0"
                                                               id="loss_insurance_15" disabled>
                                                    </div>
                                                </div>

                                                <div class="m0 p0 p10t fw-normal">
                                                    <div class="col-12 p0">
                                                        <input name="land_rental_fee_15"
                                                               value="{{number_format($annualPerformances[$key]->land_tax)}}"
                                                               class="disable-field form-control text-right br0"
                                                               id="land_rental_fee_15" disabled>
                                                    </div>
                                                </div>

                                                <div class="m0 p0 p10t fw-normal">
                                                    <div class="col-12 p0">
                                                        <input name="other_costs_15"
                                                               value="{{number_format($annualPerformances[$key]->other_fee)}}"
                                                               class="disable-field form-control text-right br0"
                                                               id="other_costs_15" disabled>
                                                    </div>
                                                </div>

                                                <div class="m0 p0 p10t fw-normal">
                                                    <div class="col-12 p0">
                                                        <input name="total_cost_15"
                                                               value="{{number_format($annualPerformances[$key]->sum_fee)}}"
                                                               class="disable-field form-control text-right br0"
                                                               id="total_cost_15" disabled>
                                                    </div>
                                                </div>

                                                <div class="m0 p0 p10t fw-normal">
                                                    <div class="col-12 p0">
                                                        <input name="operating_balance_15"
                                                               value="{{number_format($annualPerformances[$key]->sum_difference)}}"
                                                               class="disable-field form-control text-right br0"
                                                               id="operating_balance_15" disabled>
                                                    </div>
                                                </div>

                                                <div class="m0 p0 p10t fw-normal">
                                                    <div class="col-12 p0">
                                                        <input name="year_end_occupancy_rate_15"
                                                               value="{{ number_format($annualPerformances[$key]->total_tenants) }}"
                                                               class="disable-field form-control text-center br0"
                                                               id="year_end_occupancy_rate_15" disabled>
                                                    </div>
                                                </div>

                                                <div class="m0 p0 p10t fw-normal">
                                                    <div class="col-12 p0">
                                                        <input name="year_end_occupancy_rate_15"
                                                               value="{{number_format($annualPerformances[$key]->area_may_rent,2)}}"
                                                               class="disable-field form-control text-center br0"
                                                               id="year_end_occupancy_rate_15" disabled>
                                                    </div>
                                                </div>

                                                <div class="m0 p0 p10t fw-normal">
                                                    <div class="col-12 p0">
                                                        <input name="year_end_occupancy_rate_15"
                                                               value="{{ number_format($annualPerformances[$key]->deposits) }}"
                                                               class="disable-field form-control text-center br0"
                                                               id="year_end_occupancy_rate_15" disabled>
                                                    </div>
                                                </div>

                                                <div class="m0 p0 p10t fw-normal">
                                                    <div class="col-12 p0">
                                                        <input name="year_end_occupancy_rate_15"
                                                               value="{{number_format($annualPerformances[$key]->area_rental_operating,2)}}"
                                                               class="disable-field form-control text-center br0"
                                                               id="year_end_occupancy_rate_15" disabled>
                                                    </div>
                                                </div>

                                                <div class="m0 p0 p10t fw-normal">
                                                    <div class="col-12 p0">
                                                        <input name="year_end_occupancy_rate_15"
                                                               value="{{number_format($annualPerformances[$key]->crop_yield,2)}} {{ trans('attributes.common.percent') }}"
                                                               class="disable-field form-control text-center br0"
                                                               id="year_end_occupancy_rate_15" disabled>
                                                    </div>
                                                </div>

                                                <div class="m0 p0 p58t fw-normal">
                                                    <div class="col-12 p0">
                                                        <input name="repayment_coverage_rate_15"
                                                               value="{{number_format($annualPerformances[$key]->dscr,2)}} {{ trans('attributes.common.percent') }}"
                                                               class="disable-field form-control text-center br0"
                                                               id="repayment_coverage_rate_15" disabled>
                                                    </div>
                                                </div>
                                                <div class="m0 p0 p15t fw-normal">
                                                    <div class="col-12 p0">
                                                        <input name="{{ 'score_point_' . ($key+1) }}" value="0 points"
                                                               class="disable-field form-control text-center br0"
                                                               id="score_15" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    @endforeach
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="w-35 p0">
                    <div class="m0 m30l diagram-analysis">
                        <div class="p30 diagram-block">
                            <div class="w-auto">
                                <p class="m0 fs16 fw-bold">{{ __('attributes.balance.body.SCOREMAP') }}<i
                                        class="question-icon far fa-question-circle m10l"></i></p>
                                <p class="m0 fs14 fw-bold">{{ __('attributes.balance.body.note_chart') }}</p>
                            </div>
                            <div id="annual-per-spiderweb-chart"></div>
                        </div>
                    </div>

                    <div class="diagram-analysis media-1023-m30t">
                        <div class="p20 p25t diagram-block">
                            <div class="w-auto">
                            </div>
                            <div id="container-chart-annual"></div>
                        </div>
                    </div>
                </div>

                <div class="w-65 col-12-sp text-lg-right p0 text-right group-button-top">
                    <a href="{{ route(USER_PROPERTY_ANNUAL_PERFORMANCE_CREATE, [$property['id'], 'screen' => 'annual-performance', 'option_paginate' => $optionPaginate , 'page'=> $annualPerformances->currentPage()]) }}"
                       class="btn custom-btn-default fs15 sort-property w70 m7l">
                        {{ trans('attributes.tax.add') }}
                    </a>
                    <div class="d-inline-block cus-paginate">
                        {{ $annualPerformances->appends(['option_paginate' => FLAG_ELEVEN])->links('partials.simple_paginate', ['totalPage' => $annualPerformances->lastPage()]) }}
                    </div>

                    <button type="button" id="pre-print" class="btn m20l w-auto custom-btn-success fs15 pre-print-annual">{{ __('attributes.property.display_preview') }}</button>
                </div>
            </form>
        </div>
    </div>
    @include('backend.preview_print.annual_performance_print')
    @include('modal.confirm_delete_annual_performance')
@endsection
@section('js')
    <script src="{{ asset('dist/js/annual-performance.min.js') }}"></script>
@endsection
