@extends('layout.home.master')
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/preview/rent_roll.css') }}">
@endsection
@section('content')
        <div class="container-fluid container-wrapper container-wrapper-monthly p60b">
            <div id="main-info-assessment" class="@if(request('show_print') == true) has-print @endif">
                <div class="row row-header m50b">
                    <div class="row m0">
                        <div class="col-12 text-center text-md-left p0">
                            <h3 class="m0">{{ __('attributes.monthly_balance.house_name') }}<span class="fs24 fw-normal">{{ $property->house_name }}</span></h3>
                        </div>
                    </div>
                </div>

                <div id="form-condition-1" class="row m0 m30b">
                    <div class="col-12 col-xl-8 text-center text-md-right m0 p0 group-status-top row">
                        <form class="form-search-monthly-balance btn-group w-auto m20r" action="{{route(USER_PROPERTY_MONTHLY_BALANCE_INDEX, ['propertyId' => $property->id])}}" method="get">
                            <div class="btn label-option fs14 centered fw-bold p15r p15l">{{ __('attributes.rent_roll_list.year') }}</div>
                            <div class="btn wrap-input-option fs14 w120 p0">
                                <select name="date_year" class="date-year option-paginate-1 btn form-control hp100 p0 p15r p15l" required>
                                    @foreach($listDateYear as $year)
                                            <option value="{{ $year }}"@if (request('date_year', $dateYear) == $year) {{ 'selected' }}@endif>{{ $year }}{{ __('attributes.common.year') }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </form>

                        <div class="d-flex spBlock block-text p25l-sp">
                            <div class="row m0l w-auto">
                                <div class="h-100 text-left centered-vertical p15r">
                                    <span class="m0">12 {{ trans('attributes.common.lunar_month') }}</span>
                                </div>
                            </div>

                            <div id="block-month" class="row spBlock m0l w-auto m0">
                                <div class="centered p0 w200 text-left">
                                    <label class="m0">{{ __('attributes.monthly_balance.first_month') }}</label>&nbsp;
                                    <input type="hidden" value="{{ (int)$property['date_month_registration_revenue'] == DEC ? JAN : (int)$property['date_month_registration_revenue'] + FLAG_ONE }}" class="date-month">
                                    <div class="fw-normal">
                                        {{ (int)$property['date_month_registration_revenue'] == DEC ?
                                        JAN . trans('attributes.common.month') . trans('attributes.common.end_of_period') . DEC . trans('attributes.common.month') :
                                        (int)$property['date_month_registration_revenue'] + FLAG_ONE . trans('attributes.common.month') . trans('attributes.common.end_of_period') .
                                        (int)$property['date_month_registration_revenue'] . trans('attributes.common.month') }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="block-status" class="row spBlock m0l w-auto m20r block-status">
                            <div class="centered first-block p15r p15l">
                                <label class="m0">{{ __('attributes.property.status') }}</label>
                            </div>
                            <div class="centered p0 p15r p15l w90">
                                <div class="fw-normal">{{ STATUS_HOUSE_SIMPLE[$property->status] }}</div>
                            </div>
                        </div>
                        @if ($currentUser->role != INVESTOR)
                            <div id="block-status" class="row spBlock m0 w-auto m10r m10t block-proprietor">
                                <div class="centered first-block p15r p15l">
                                    <label class="m0">{{ trans('attributes.repair_history.owner') }}</label>
                                </div>
                                <div class="text-left centered-vertical p0 p15r p15l w250">
                                    <div class="fw-normal">{{ $property->proprietor ?? 'ー' }}</div>
                                </div>
                            </div>
                        @endif
                    </div>

                    <div class="col-12 col-xl-4 col-12-sp text-center text-lg-right p0 text-right group-button-top">
                        <a href="{{ route(USER_PROPERTY_MONTHLY_BALANCE_CREATE, ['propertyId' => $property->id, 'screen' => 'monthly-balance', 'date_year' => request('date_year', $dateYear)])}}" class="btn custom-btn-default fs15 sort-property w-auto">{{ __('attributes.common.new_registration') }}</a>
                        <a href="{{ route(USER_PROPERTY_MONTHLY_BALANCE_EDIT, ['propertyId' => $property->id, 'screen' => 'monthly-balance', 'date_year' => request('date_year', $dateYear)]) }}" class="btn custom-btn-default fs15 sort-property m10l w-auto">{{ __('attributes.common.edit') }}</a>
                        <a type="button" class="btn custom-btn-default fs15 sort-property m10l w-auto" data-toggle="dropdown">{{ __('attributes.balance.header.btn_choose') }}</a>
                        <div class="dropdown-menu dropdown-menu-right set-scrollbar">
                            @if(count($listProperty) == FLAG_ONE)
                                <p class="m10l text-primary break-all">{{ trans('attributes.monthly_balance.no_data') }}</p>
                            @else
                                @foreach($listProperty as $value)
                                    @if($value->property_id != $property->id)
                                        <a href="{{ route(USER_PROPERTY_MONTHLY_BALANCE_INDEX, ['propertyId' => $value->property_id]) }}" class="dropdown-item find-property pointer">{{ $value->house_name }}</a>
                                    @endif
                                @endforeach
                            @endif
                        </div>
                        <button id="pre-print" class="btn m10l w-auto custom-btn-success fs15 pre-print-monthly show-print">{{ __('attributes.property.display_preview') }}</button>
                    </div>
                </div>
                <div class="row m0 m25b br10 bg-white">
                    <div class="table-responsive fs14 br10">
                        <table id="table-property" class="table table-bordered table-striped border-0 m0">
                            @php( $showInput0 = ($property['real_estate_type_id'] == FLAG_TEN || $property['real_estate_type_id'] == FLAG_NINE) )
                            <tr class="table-head list-monthly-balance">
                                <td class="border-0">
                                    <div class="w400">
                                        <div class="d-flex m0 m10b p0">
                                            <div class="col-11 p0l m5b">
                                                <p class="fs16 m0">{{ __('attributes.property.operating_revenue') }}</p>
                                            </div>
                                            <div class="col-1 m3l p0 d-flex align-items-end justify-content-end ">
                                                <p class="fs12 fw-normal m0">({{ __('attributes.common.yen') }})</p>
                                            </div>
                                        </div>
                                        @if($showInput0)
                                            <div class="d-flex m-0 p0 fw-normal">
                                                <div class="col-5 col-12-sp p0 d-flex align-items-center">
                                                    <span class="d-inline-block">{{ __('attributes.register_info.item_block.label.rent_income') }}<br>{{ __('attributes.register_info.item_block.label.rent_income_1') }}</span>
                                                </div>
                                                <div class="col-7 col-12-sp p0">
                                                    <div class="d-flex">
                                                        <span class="number-li">0</span>
                                                        <div class="col-11 p0">
                                                            <input class="convert-data disable-field form-control text-right {{!empty($dataByYear) ? compareValueRevenue($dataByYear['revenue_land_taxes'], $total['revenue_land_taxes']) : ''}}"
                                                                name="revenue_land_taxes" value="{{ $total['revenue_land_taxes'] }}" id="revenue-land-taxes" disabled>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif

                                        <div class="d-flex m-0 p0 @if($showInput0) p10t @endif fw-normal">
                                            <div class="col-5 col-12-sp p0 d-flex align-items-center">
                                                <span class="d-inline-block">{{ __('attributes.register_info.item_block.label.rent_income_2') }}</span>
                                            </div>
                                            <div class="col-7 col-12-sp p0">
                                                <div class="d-flex">
                                                    <span class="number-li">1</span>
                                                    <div class="col-11 p0">
                                                        <input class="convert-data disable-field form-control text-right {{!empty($dataByYear) ? compareValueRevenue($dataByYear['rent_income'], $total['revenue_room_rentals']) : ''}}"
                                                               name="revenue_room_rentals" value="{{ $total['revenue_room_rentals'] }}" id="revenue_room_rentals" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-flex m-0 p0 p10t fw-normal">
                                            <div class="col-5 col-12-sp p0 d-flex align-items-center">
                                                <span class="d-inline-block">{{ __('attributes.register_info.item_block.label.service_revenue') }}</span>
                                            </div>
                                            <div class="col-7 col-12-sp p0">
                                                <div class="d-flex">
                                                    <span class="number-li">2</span>
                                                    <div class="col-11 p0">
                                                        <input class="convert-data disable-field form-control text-right {{!empty($dataByYear) ? compareValueRevenue($dataByYear['general_services'], $total['revenue_service_charges']) : ''}}"
                                                               name="revenue_service_charges" value="{{ $total['revenue_service_charges'] }}" id="revenue_service_charges" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-flex m-0 p0 p10t fw-normal">
                                            <div class="col-5 col-12-sp p0 d-flex align-items-center">
                                                <span class="d-inline-block">{{ __('attributes.register_info.item_block.label.utilities_revenue') }}</span>
                                            </div>
                                            <div class="col-7 col-12-sp p0">
                                                <div class="d-flex">
                                                    <span class="number-li">3</span>
                                                    <div class="col-11 p0">
                                                        <input class="convert-data disable-field form-control text-right {{!empty($dataByYear) ? compareValueRevenue($dataByYear['utilities_revenue'], $total['revenue_utilities']) : ''}}"
                                                               name="revenue_utilities" value="{{ $total['revenue_utilities'] }}" id="revenue_utilities" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-flex m-0 p0 p10t fw-normal">
                                            <div class="col-5 col-12-sp p0 d-flex align-items-center">
                                                <span class="d-inline-block">{{ __('attributes.register_info.item_block.label.parking_lot_revenue') }}</span>
                                            </div>
                                            <div class="col-7 col-12-sp p0">
                                                <div class="d-flex">
                                                    <span class="number-li">4</span>
                                                    <div class="col-11 p0">
                                                        <input class="convert-data disable-field form-control text-right {{!empty($dataByYear) ? compareValueRevenue($dataByYear['parking_revenue'], $total['revenue_car_deposits']) : ''}}"
                                                               name="revenue_car_deposits" value="{{ $total['revenue_car_deposits'] }}" id="revenue_car_deposits" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-flex m-0 p0 p10t fw-normal">
                                            <div class="col-5 col-12-sp p0 d-flex align-items-center">
                                                <span class="d-inline-block">{{ __('attributes.register_info.item_block.label.key_money_royalties') }}</span>
                                            </div>
                                            <div class="col-7 col-12-sp p0">
                                                <div class="d-flex">
                                                    <span class="number-li">5</span>
                                                    <div class="col-11 p0">
                                                        <input class="convert-data disable-field form-control text-right {{!empty($dataByYear) ? compareValueRevenue($dataByYear['income_input_money'], $total['turnover_revenue']) : ''}}"
                                                               name="turnover_revenue" value="{{ $total['turnover_revenue'] }}" id="turnover_revenue" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-flex m-0 p0 p10t fw-normal">
                                            <div class="col-5 col-12-sp p0 d-flex align-items-center">
                                                <span class="d-inline-block">{{ __('attributes.register_info.item_block.label.renewal_fee') }}</span>
                                            </div>
                                            <div class="col-7 col-12-sp p0">
                                                <div class="d-flex">
                                                    <span class="number-li">6</span>
                                                    <div class="col-11 p0">
                                                        <input class="convert-data disable-field form-control text-right {{!empty($dataByYear) ? compareValueRevenue($dataByYear['income_update_house_contract'], $total['revenue_contract_update_fee']) : ''}}"
                                                               name="revenue_contract_update_fee" value="{{ $total['revenue_contract_update_fee'] }}" id="revenue_contract_update_fee" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-flex m-0 p0 p10t fw-normal">
                                            <div class="col-5 col-12-sp p0 d-flex align-items-center">
                                                <span class="d-inline-block">{{ __('attributes.register_info.item_block.label.other_income') }}</span>
                                            </div>
                                            <div class="col-7 col-12-sp p0">
                                                <div class="d-flex">
                                                    <span class="number-li">7</span>
                                                    <div class="col-11 p0">
                                                        <input class="convert-data disable-field form-control text-right {{!empty($dataByYear) ? compareValueRevenue($dataByYear['other_income'], $total['revenue_other']) : ''}}"
                                                               name="revenue_other" value="{{ $total['revenue_other'] }}" id="revenue_other" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-flex m-0 p0 p10t fw-normal">
                                            <div class="col-5 col-12-sp p0 d-flex align-items-center">
                                                <span class="d-inline-block">{{ __('attributes.register_info.item_block.label.etc') }}</span>
                                            </div>
                                            <div class="col-7 col-12-sp p0">
                                                <div class="d-flex">
                                                    <span class="number-li">8</span>
                                                    <div class="col-11 p0">
                                                        <input class="convert-data disable-field form-control text-right {{!empty($dataByYear) ? compareValueRevenue($dataByYear['bad_debt_losses'], $total['bad_debt']) : ''}}"
                                                               name="bad_debt" value="{{ $total['bad_debt'] }}" id="bad_debt" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-flex m-0 p0 p10t fw-normal">
                                            <div class="col-5 col-12-sp p0 d-flex align-items-center">
                                                <span class="d-inline-block">{{ __('attributes.register_info.item_block.label.meter') }}</span>
                                            </div>
                                            <div class="col-7 col-12-sp p0">
                                                <div class="d-flex">
                                                    <span class="number-li">9</span>
                                                    <div class="col-11 p0">
                                                        <input class="convert-data disable-field form-control text-right {{!empty($dataByYear) ? compareValueRevenue($dataByYear['sum_income'], $total['total_operating_revenue']) : ''}}"
                                                               name="total_revenue" value="{{ $total['total_operating_revenue'] }}" id="total_revenue" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>

                                @foreach(setArrayDateMonth((int)$property['date_month_registration_revenue']) as $key => $month)
                                    <td class="border-top-0 border-bottom-0">
                                        <div class=" w120">
                                            <div class="d-flex m0 m10b p0">
                                                <div class="col-11 p0l m5b">
                                                    <p class="fs16 m0 text-center">{{$month}}{{ __('attributes.common.month') }}</p>
                                                </div>
                                                <div class="col-1 m3l p0 d-flex align-items-end justify-content-end ">
                                                    <p class="fs12 fw-normal m0">({{ __('attributes.common.yen') }})</p>
                                                </div>
                                            </div>
                                            @if($showInput0)
                                            <div class="m-100 p0 fw-normal">
                                                <div class="p0">
                                                    <input value="{{$listData[$month - FLAG_ONE]['revenue_land_taxes']}}" class="convert-data disable-field form-control text-right" disabled>
                                                </div>
                                            </div>
                                            @endif
                                            <div class="m-100 p0 @if($showInput0) p10t @endif fw-normal">
                                                <div class="p0">
                                                    <input name="revenue_room_rentals_jan" value="{{$listData[$month - FLAG_ONE]['revenue_room_rentals']}}" class="convert-data disable-field form-control text-right" id="revenue_room_rentals_jan" disabled>
                                                </div>
                                            </div>
                                            <div class="m-100 p0 p10t fw-normal">
                                                <div class="p0">
                                                    <input name="revenue_service_charges_jan" value="{{ $listData[$month - FLAG_ONE]['revenue_service_charges'] }}" class="convert-data disable-field form-control text-right" id="revenue_service_charges_jan" disabled>
                                                </div>
                                            </div>
                                            <div class="m-100 p0 p10t fw-normal">
                                                <div class="p0">
                                                    <input name="revenue_utilities_jan" value="{{ $listData[$month - FLAG_ONE]['revenue_utilities'] }}" class="convert-data disable-field form-control text-right" id="revenue_utilities_jan" disabled>
                                                </div>
                                            </div>
                                            <div class="m-100 p0 p10t fw-normal">
                                                <div class="p0">
                                                    <input name="revenue_car_deposits_jan" value="{{ $listData[$month - FLAG_ONE]['revenue_car_deposits'] }}" class="convert-data disable-field form-control text-right" id="revenue_car_deposits_jan" disabled>
                                                </div>
                                            </div>
                                            <div class="m-100 p0 p10t fw-normal">
                                                <div class="p0">
                                                    <input name="turnover_revenue_jan" value="{{ $listData[$month - FLAG_ONE]['turnover_revenue'] }}" class="convert-data disable-field form-control text-right" id="turnover_revenue_jan" disabled>
                                                </div>
                                            </div>
                                            <div class="m-100 p0 p10t fw-normal">
                                                <div class="p0">
                                                    <input name="revenue_contract_update_fee_jan" value="{{ $listData[$month - FLAG_ONE]['revenue_contract_update_fee'] }}" class="convert-data disable-field form-control text-right" id="revenue_contract_update_fee_jan" disabled>
                                                </div>
                                            </div>
                                            <div class="m-100 p0 p10t fw-normal">
                                                <div class="p0">
                                                    <input name="revenue_other_jan" value="{{ $listData[$month - FLAG_ONE]['revenue_other'] }}" class="convert-data disable-field form-control text-right" id="revenue_other_jan" disabled>
                                                </div>
                                            </div>
                                            <div class="m-100 p0 p10t fw-normal">
                                                <div class="p0">
                                                    <input name="bad_debt_jan" value="{{ $listData[$month - FLAG_ONE]['bad_debt'] }}" class="convert-data disable-field form-control text-right" id="bad_debt_jan" disabled>
                                                </div>
                                            </div>
                                            <div class="m-100 p0 p10t fw-normal">
                                                <div class="p0">
                                                    <input name="total_revenue_jan" value="{{ $listData[$month - FLAG_ONE]['total_operating_revenue'] }}" class="convert-data disable-field form-control text-right" id="total_revenue_jan" disabled>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                @endforeach
                            </tr>

                            <tr class="table-head list-monthly-balance">
                                <td class="border-bottom-0 border-left-0">
                                    <div class="w400">
                                        <div class="d-flex m0 m10b p0">
                                            <div class="col-11 p0l m5b">
                                                <p class="fs16 m0">{{ __('attributes.property.operating_fee') }}</p>
                                            </div>
                                            <div class="col-1 m3l p0 d-flex align-items-end justify-content-end ">
                                                <p class="fs12 fw-normal m0">({{ __('attributes.common.yen') }})</p>
                                            </div>
                                        </div>

                                        <div class="d-flex m-0 p0 fw-normal">
                                            <div class="col-5 col-12-sp p0 d-flex align-items-center">
                                                <span class="d-inline-block">{{ __('attributes.register_info.item_block.label.management_fee') }}</span>
                                            </div>
                                            <div class="col-7 col-12-sp p0">
                                                <div class="d-flex">
                                                    <span class="number-li">10</span>
                                                    <div class="col-11 p0">
                                                        <input class="convert-data disable-field form-control text-right {{!empty($dataByYear) ? compareValueRevenue($dataByYear['management_fee'], $total['maintenance_management_fee']) : ''}}"
                                                               name="maintenance_management_fee" value="{{ $total['maintenance_management_fee'] }}" id="maintenance_management_fee" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-flex m-0 p0 p10t fw-normal">
                                            <div class="col-5 col-12-sp p0 d-flex align-items-center">
                                                <span class="d-inline-block">{{ __('attributes.register_info.item_block.label.utilities_expenses') }}</span>
                                            </div>
                                            <div class="col-7 col-12-sp p0">
                                                <div class="d-flex">
                                                    <span class="number-li">11</span>
                                                    <div class="col-11 p0">
                                                        <input class="convert-data disable-field form-control text-right {{!empty($dataByYear) ? compareValueRevenue($dataByYear['utilities_fee'], $total['electricity_gas_charges']) : ''}}"
                                                               name="electricity_gas_charges" value="{{ $total['electricity_gas_charges'] }}" id="electricity_gas_charges" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-flex m-0 p0 p10t fw-normal">
                                            <div class="col-5 col-12-sp p0 d-flex align-items-center">
                                                <span class="d-inline-block">{{ __('attributes.register_info.item_block.label.repair_fee') }}</span>
                                            </div>
                                            <div class="col-7 col-12-sp p0">
                                                <div class="d-flex">
                                                    <span class="number-li">12</span>
                                                    <div class="col-11 p0">
                                                        <input class="convert-data disable-field form-control text-right {{!empty($dataByYear) ? compareValueRevenue($dataByYear['repair_fee'], $total['repair_fee']) : ''}}"
                                                               name="repair_fee" value="{{ $total['repair_fee'] }}" id="repair_fee" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-flex m-0 p0 p10t fw-normal">
                                            <div class="col-5 col-12-sp p0 d-flex align-items-center">
                                                <span class="d-inline-block">{{ __('attributes.register_info.item_block.label.intact_reply_fee') }}</span>
                                            </div>
                                            <div class="col-7 col-12-sp p0">
                                                <div class="d-flex">
                                                    <span class="number-li">13</span>
                                                    <div class="col-11 p0">
                                                        <input class="convert-data disable-field form-control text-right {{!empty($dataByYear) ? compareValueRevenue($dataByYear['intact_reply_fee'], $total['recovery_costs']) : ''}}"
                                                               name="recovery_costs" value="{{ $total['recovery_costs'] }}" id="recovery_costs" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-flex m-0 p0 p10t fw-normal">
                                            <div class="col-5 col-12-sp p0 d-flex align-items-center">
                                                <span class="d-inline-block">{{ __('attributes.balance.body.property') }}<br />{{ __('attributes.balance.body.management_fee') }}</span>
                                            </div>
                                            <div class="col-7 col-12-sp p0">
                                                <div class="d-flex">
                                                    <span class="number-li">14</span>
                                                    <div class="col-11 p0">
                                                        <input class="convert-data disable-field form-control text-right {{!empty($dataByYear) ? compareValueRevenue($dataByYear['asset_management_fee'], $total['property_management_fee']) : ''}}"
                                                               name="property_management_fee" value="{{ $total['property_management_fee'] }}" id="property_management_fee" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-flex m-0 p0 p10t fw-normal">
                                            <div class="col-5 col-12-sp p0 d-flex align-items-center">
                                                <span class="d-inline-block">{{ __('attributes.register_info.item_block.label.tenant_recruitment_fee') }}</span>
                                            </div>
                                            <div class="col-7 col-12-sp p0">
                                                <div class="d-flex">
                                                    <span class="number-li">15</span>
                                                    <div class="col-11 p0">
                                                        <input class="convert-data disable-field form-control text-right {{!empty($dataByYear) ? compareValueRevenue($dataByYear['tenant_recruitment_fee'], $total['find_tenant_fee']) : ''}}"
                                                               name="find_tenant_fee" value="{{ $total['find_tenant_fee'] }}" id="find_tenant_fee" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-flex m-0 p0 p10t fw-normal">
                                            <div class="col-5 col-12-sp p0 d-flex align-items-center">
                                                <span class="d-inline-block">{{ __('attributes.register_info.item_block.label.taxes_dues') }}</span>
                                            </div>
                                            <div class="col-7 col-12-sp p0">
                                                <div class="d-flex">
                                                    <span class="number-li">16</span>
                                                    <div class="col-11 p0">
                                                        <input class="convert-data disable-field form-control text-right {{!empty($dataByYear) ? compareValueRevenue($dataByYear['taxes_dues'], $total['tax']) : ''}}"
                                                               name="tax" value="{{ $total['tax'] }}" id="tax" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-flex m-0 p0 p10t fw-normal">
                                            <div class="col-5 col-12-sp p0 d-flex align-items-center">
                                                <span class="d-inline-block">{{ __('attributes.register_info.item_block.label.insurance_premium') }}</span>
                                            </div>
                                            <div class="col-7 col-12-sp p0">
                                                <div class="d-flex">
                                                    <span class="number-li">17</span>
                                                    <div class="col-11 p0">
                                                        <input class="convert-data disable-field form-control text-right {{!empty($dataByYear) ? compareValueRevenue($dataByYear['insurance_premium'], $total['loss_insurance']) : ''}}"
                                                               name="loss_insurance" value="{{ $total['loss_insurance'] }}" id="loss_insurance" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-flex m-0 p0 p10t fw-normal">
                                            <div class="col-5 col-12-sp p0 d-flex align-items-center">
                                                <span class="d-inline-block">{{ __('attributes.register_info.item_block.label.land_payment') }}</span>
                                            </div>
                                            <div class="col-7 col-12-sp p0">
                                                <div class="d-flex">
                                                    <span class="number-li">18</span>
                                                    <div class="col-11 p0">
                                                        <input class="convert-data disable-field form-control text-right {{!empty($dataByYear) ? compareValueRevenue($dataByYear['land_tax'], $total['land_rental_fee']) : ''}}"
                                                               name="land_rental_fee" value="{{ $total['land_rental_fee'] }}" id="land_rental_fee" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-flex m-0 p0 p10t fw-normal">
                                            <div class="col-5 col-12-sp p0 d-flex align-items-center">
                                                <span class="d-inline-block">{{ __('attributes.register_info.item_block.label.other_expenses') }}</span>
                                            </div>
                                            <div class="col-7 col-12-sp p0">
                                                <div class="d-flex">
                                                    <span class="number-li">19</span>
                                                    <div class="col-11 p0">
                                                        <input class="convert-data disable-field form-control text-right {{!empty($dataByYear) ? compareValueRevenue($dataByYear['other_fee'], $total['other_costs']) : ''}}"
                                                               name="other_costs" value="{{ $total['other_costs'] }}" id="other_costs" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-flex m-0 p0 p10t fw-normal">
                                            <div class="col-5 col-12-sp p0 d-flex align-items-center">
                                                <span class="d-inline-block">{{ __('attributes.register_info.item_block.label.meter') }}</span>
                                            </div>
                                            <div class="col-7 col-12-sp p0">
                                                <div class="d-flex">
                                                    <span class="number-li">20</span>
                                                    <div class="col-11 p0">
                                                        <input class="convert-data disable-field form-control text-right {{!empty($dataByYear) ? compareValueRevenue($dataByYear['sum_fee'], $total['total_operating_costs']) : ''}}"
                                                               name="total_cost" value="{{ $total['total_operating_costs'] }}" id="total_cost" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-flex m-0 p0 p10t fw-normal">
                                            <div class="col-5 col-12-sp p0 d-flex align-items-center">
                                                <span class="d-flex">{{ __('attributes.register_info.item_block.label.operating_balance') }}(<span class="number-li m5l m5r">9</span>-<span class="number-li m5l m5r">20</span>)</span>
                                            </div>
                                            <div class="col-7 col-12-sp p0">
                                                <div class="d-flex">
                                                    <span class="number-li">21</span>
                                                    <div class="col-11 p0">
                                                        <input class="convert-data disable-field form-control text-right {{!empty($dataByYear) ? compareValueRevenue($dataByYear['sum_difference'], $total['operating_expenses']) : ''}}"
                                                            name="operating_balance" value="{{ $total['operating_expenses'] }}" id="operating_balance" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-flex m-0 p0 p10t fw-normal">
                                            <div class="col-5 col-12-sp p0 d-flex align-items-center">
                                                <span class="d-inline-block">{{ __('attributes.register_info.item_block.label.crop_yield') }}</span>
                                            </div>
                                            <div class="col-7 col-12-sp p0">
                                                <div class="col-12 p0">
                                                    <input name="rental_percentage" value=""
                                                           class="convert-number-single-decimal disable-field form-control text-right {{!empty($dataByYear) ? compareValueRevenue($dataByYear['crop_yield'], $listData[FLAG_ELEVEN]['rental_percentage']) : ''}}"
                                                           id="rental_percentage" disabled>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                @foreach(setArrayDateMonth((int)$property['date_month_registration_revenue']) as $key => $month)
                                    <td class="border-bottom-0">
                                        <div class="m10t w120">
                                            <div class="d-flex m0 m10b p0">
                                                <div class="col-12 m3l p0 d-flex align-items-end justify-content-end ">
                                                    <p class="fs12 fw-normal m0">({{ __('attributes.common.yen') }})</p>
                                                </div>
                                            </div>

                                            <div class="m-100 p0 fw-normal">
                                                <div class="p0">
                                                    <input name="maintenance_management_fee_jan" value="{{$listData[$month - FLAG_ONE]['maintenance_management_fee']}}" class="convert-data disable-field form-control text-right" id="maintenance_management_fee_jan" disabled>
                                                </div>
                                            </div>
                                            <div class="m-100 p0 p10t fw-normal">
                                                <div class="p0">
                                                    <input name="electricity_gas_charges_jan" value="{{$listData[$month - FLAG_ONE]['electricity_gas_charges']}}" class="convert-data disable-field form-control text-right" id="electricity_gas_charges_jan" disabled>
                                                </div>
                                            </div>
                                            <div class="m-100 p0 p10t fw-normal">
                                                <div class="p0">
                                                    <input name="repair_fee_jan" value="{{$listData[$month - FLAG_ONE]['repair_fee']}}" class="convert-data disable-field form-control text-right" id="repair_fee_jan" disabled>
                                                </div>
                                            </div>
                                            <div class="m-100 p0 p15t fw-normal">
                                                <div class="p0">
                                                    <input name="recovery_costs_jan" value="{{$listData[$month - FLAG_ONE]['recovery_costs']}}" class="convert-data disable-field form-control text-right" id="recovery_costs_jan" disabled>
                                                </div>
                                            </div>
                                            <div class="m-100 p0 p10t fw-normal">
                                                <div class="p0">
                                                    <input name="property_management_fee_jan" value="{{$listData[$month - FLAG_ONE]['property_management_fee']}}" class="convert-data disable-field form-control text-right" id="property_management_fee_jan" disabled>
                                                </div>
                                            </div>
                                            <div class="m-100 p0 p10t fw-normal">
                                                <div class="p0">
                                                    <input name="find_tenant_fee_jan" value="{{$listData[$month - FLAG_ONE]['find_tenant_fee']}}" class="convert-data disable-field form-control text-right" id="find_tenant_fee_jan" disabled>
                                                </div>
                                            </div>
                                            <div class="m-100 p0 p10t fw-normal">
                                                <div class="p0">
                                                    <input name="tax_jan" value="{{$listData[$month - FLAG_ONE]['tax']}}" class="convert-data disable-field form-control text-right" id="tax_jan" disabled>
                                                </div>
                                            </div>
                                            <div class="m-100 p0 p10t fw-normal">
                                                <div class="p0">
                                                    <input name="loss_insurance_jan" value="{{$listData[$month - FLAG_ONE]['loss_insurance']}}" class="convert-data disable-field form-control text-right" id="loss_insurance_jan" disabled>
                                                </div>
                                            </div>
                                            <div class="m-100 p0 p10t fw-normal">
                                                <div class="p0">
                                                    <input name="land_rental_fee_jan" value="{{$listData[$month - FLAG_ONE]['land_rental_fee']}}" class="convert-data disable-field form-control text-right" id="land_rental_fee_jan" disabled>
                                                </div>
                                            </div>
                                            <div class="m-100 p0 p10t fw-normal">
                                                <div class="p0">
                                                    <input name="other_costs_jan" value="{{$listData[$month - FLAG_ONE]['other_costs']}}" class="convert-data disable-field form-control text-right" id="other_costs_jan" disabled>
                                                </div>
                                            </div>
                                            <div class="m-100 p0 p10t fw-normal">
                                                <div class="p0">
                                                    <input name="total_cost" value="{{$listData[$month - FLAG_ONE]['total_operating_costs']}}" class="convert-data disable-field form-control text-right" id="total_cost" disabled>
                                                </div>
                                            </div>
                                            <div class="m-100 p0 p10t fw-normal">
                                                <div class="p0">
                                                    <input name="operating_balance_jan" value="{{$listData[$month - FLAG_ONE]['operating_expenses']}}" class="convert-data disable-field form-control text-right" id="operating_balance_jan" disabled>
                                                </div>
                                            </div>
                                            <div class="m-100 p0 p10t fw-normal">
                                                <div class="p0">
                                                    <input name="rental_percentage_jan" value="{{$listData[$month - FLAG_ONE]['rental_percentage']}}%" class="disable-field form-control text-right" id="rental_percentage_jan" disabled>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    @if($month == (int)$property['date_month_registration_revenue'])
                                    <input type="hidden" value="{{ $listData[$month - FLAG_ONE]['rental_percentage'] }}" class="rental-rate">
                                    @endif
                                @endforeach
                            </tr>
                        </table>
                        <div class="p0 p200l p10b error-monthly" hidden>
                            <span>■</span>
                            <p>{{__('attributes.common.note')}}</p></div>
                        </div>
                </div>

                <div class="m0 m30t m25b br10 bg-white p20 p25t">
                    <input type="hidden" value="{{ $property->id }}" class="property-id-screen-list">
                    <div id="container-chart-monthly" class=" chart-monthly"></div>
                </div>
                </div><!-- /#main-info-assessment -->
        </div>
        @include('backend.preview_print.monthly_balance_print')
@endsection
@section('js')
    <script src="{{ asset('dist/js/monthly-balance.min.js') }}"></script>
@endsection
