@extends('layout.home.master')
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/preview/rent_roll.css') }}">
@endsection
@section('content')
    <div class="content-wrapper">
        <div class="container-fluid container-wrapper container-padding container-wrapper-rent">
                <div id="main-info-assessment" class="@if(request('show_print') == true) has-print @endif">
                    <div class="row row-header m50b">
                        <div class="row m0">
                            <div class="col-12 text-center text-md-left p0">
                                <h3 class="m0">{{ trans('attributes.rent_roll_list.title') }}<span class="fs24 fw-normal">{{ $property->house_name }}</span></h3>
                            </div>
                        </div>
                    </div>

                    @include('partials.flash_messages')
                    <form id="form-condition-1" class="form-search-rent-roll row m0 m30b" action="{{route(USER_PROPERTY_RENT_ROLL_INDEX, ['propertyId' => $propertyId])}}" method="get">
                        <div class="btn-group w-auto m20r">
                            <div class="btn label-option fs14 centered fw-bold p15r p15l">{{ trans('attributes.rent_roll_list.year') }}</div>
                            <div class="btn wrap-input-option fs14 w120 p0">
                                <select name="date_year" class="date-year-rent-roll option-paginate-1 btn form-control hp100 p0 p15r p15l">
                                    @foreach(dateYear() as $key => $year)
                                        <option value="{{ $key + 1950 }}"@if (request('date_year', date('Y')) == $key+ 1950) {{ 'selected' }}@endif>{{ $year }}年</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div id="block-month" class="row spBlock m0l w-auto m20r">
                            <div class="btn label-option fs14 centered fw-bold p15r p15l">{{ trans('attributes.rent_roll_list.month') }}</div>
                            <div class="btn wrap-input-option fs14 w120 p0">
                                <select name="date_month" class="date-month-rent-roll option-paginate-1 btn form-control hp100 p0 p15r p15l">
                                    @foreach(DATE_MONTH as $key => $month)
                                        <option value="{{ $key }}" @if (request('date_month', date('m')) == $key) {{ 'selected' }}@endif>{{ $month }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        @if ($currentUser->role != INVESTOR)
                            <div id="block-status" class="row spBlock m0 w-auto">
                                <div class="centered first-block p15r p15l">
                                    <label class="m0">{{ trans('attributes.repair_history.owner') }}</label>
                                </div>
                                <div class="centered-vertical p0 p15r p15l w250">
                                    <div class="fw-normal">{{ $property->proprietor ?? 'ー' }}</div>
                                </div>
                            </div>
                        @endif
                        <div class="col-12 col-xl-10 col-12-sp text-center text-lg-right m38l p0 text-right group-button-top">
                            <a href="{{ route(USER_PROPERTY_RENT_ROLL_ROOM, ['propertyId' => $propertyId]) }}" class="btn custom-btn-default fs15 sort-property m10l w-auto">{{ trans('attributes.rent_roll.room.title') }}</a>
                            <a href="{{ route(USER_PROPERTY_RENT_ROLL_CREATE, ['propertyId' => $propertyId, 'screen' => 'list_rent_rolls', 'date_year' => $params['date_year'] ?? '', 'date_month' => $params['date_month'] ?? '']) }}" class="btn custom-btn-default fs15 sort-property m10l w-auto">{{ trans('attributes.rent_roll_list.btn_create_rent_roll') }}</a>
                            <a type="button" class="btn custom-btn-default fs15 sort-property m10l w-auto" data-toggle="dropdown">{{ trans('attributes.rent_roll_list.List_houses') }}</a>
                            <div class="dropdown-menu dropdown-menu-right set-scrollbar">
                                @foreach($listProperty as $value)
                                    @if($value->property_id != $propertyId)
                                    <a href="{{ route(USER_PROPERTY_RENT_ROLL_INDEX, ['propertyId' => $value->property_id]) }}" class="dropdown-item find-property pointer">{{ $value->house_name }}</a>
                                    @endif
                                @endforeach
                            </div>
                            <button id="pre-print" type="button" class="btn custom-btn-success m10l fs15 pre-print show-print">{{ trans('attributes.balance.header.btn_preview') }}</button>
                        </div>
                    </form>

                    <div class="row m0 m20b br10 bg-white">
                        <div class="table-responsive fs14 br10">
                            <input type="text" class="d-none property-id" value="{{ $propertyId }}">
                            <table id="table-property" class="table-rent-roll table table-bordered table-striped border-0 m0">
                                <tr class="table-head">
                                    <td class="border-0">
                                        <div class="centered-vertical sort-table-rent-roll w90">
                                            <span>{{ trans('attributes.rent_roll_list.Floor_and_room_number') }}</span>
                                            <span class="sort-icon" data-id='0'><i class="fa-sort-icon fa fa-caret-down" aria-hidden="true"></i></span>
                                        </div>
                                    </td>
                                    <td class="border-top-0">
                                        <div class="centered-vertical sort-table-rent-roll w150">
                                            <span>{{ trans('attributes.rent_roll_list.tenant') }}</span>
                                            <span class="sort-icon" data-id='1'><i class="fa-sort-icon fa fa-caret-down" aria-hidden="true"></i></span>
                                        </div>
                                    </td>
                                    <td class="border-top-0">
                                        <div class="centered-vertical sort-table-rent-roll w70">
                                                <span class="centered">
                                                    <p class="m0">{{ trans('attributes.rent_roll_list.contract_area') }}</p>
                                                    <span class="sort-icon" data-id='2'><i class="fa-sort-icon fa fa-caret-down" aria-hidden="true"></i></span>
                                                </span>
                                        </div>
                                        <span class="fs11">({{ trans('attributes.common.unit-5') }})</span>
                                    </td>
                                    <td class="border-top-0">
                                        <div class="centered-vertical sort-table-rent-roll w70">
                                                <span class="centered">
                                                    <p class="m0">{{ trans('attributes.rent_roll_list.monthly_rent') }}</p>
                                                    <span class="sort-icon" data-id='3'><i class="fa-sort-icon fa fa-caret-down" aria-hidden="true"></i></span>
                                                </span>
                                        </div>
                                        <span class="fs11">({{ trans('attributes.common.yen') }})</span>
                                    </td>
                                    <td class="border-top-0">
                                        <div class="centered-vertical sort-table-rent-roll w70">
                                                <span class="centered">
                                                    <p class="m0">{{ trans('attributes.rent_roll_list.Rent') }}<br><span class="fs11">({{ trans('attributes.common.yen') }})</span></p>
                                                    <span class="sort-icon" data-id='4'><i class="fa-sort-icon fa fa-caret-down m15b" aria-hidden="true"></i></span>
                                                </span>
                                        </div>
                                    </td>
                                    <td class="border-top-0">
                                        <div class="centered-vertical sort-table-rent-roll w90">
                                            <p class="m0">{{ trans('attributes.rent_roll_list.monthly_service_fee') }}<br><span class="fs11">({{ trans('attributes.common.yen') }})</span></p>
                                            <span class="sort-icon" data-id='5'><i class="fa-sort-icon fa fa-caret-down" aria-hidden="true"></i></span>
                                        </div>
                                    </td>
                                    <td class="border-top-0">
                                        <div class="centered-vertical sort-table-rent-roll w90">
                                                <span class="centered">
                                                    <p class="m0">{{ trans('attributes.rent_roll_list.utilities') }}<br><span class="fs11">({{ trans('attributes.common.yen') }})</span></p>
                                                    <span class="sort-icon" data-id='6'><i class="fa-sort-icon fa fa-caret-down m15b" aria-hidden="true"></i></span>
                                                </span>
                                        </div>
                                    </td>
                                    <td class="border-top-0">
                                        <div class="centered-vertical sort-table-rent-roll w100">
                                            <p class="m0">{{ trans('attributes.rent_roll_list.total_rent_month') }}<br><span class="fs11">({{ trans('attributes.common.yen') }})</span></p>
                                            <span class="sort-icon" data-id='7'><i class="fa-sort-icon fa fa-caret-down" aria-hidden="true"></i></span>
                                        </div>
                                    </td>
                                    <td class="border-top-0">
                                        <div class="centered-vertical sort-table-rent-roll w100">
                                                <span class="centered">
                                                    <p class="m0">{{ trans('attributes.rent_roll_list.total_rent') }}<br><span class="fs11">({{ trans('attributes.common.yen') }})</span></p>
                                                    <span class="sort-icon" data-id='8'><i class="fa-sort-icon fa fa-caret-down" aria-hidden="true"></i></span>
                                                </span>
                                        </div>
                                    </td>
                                    <td class="border-top-0">
                                        <div class="centered-vertical sort-table-rent-roll w70">
                                                <span class="centered">
                                                    <p class="m0">{{ trans('attributes.property.deposit') }}</p>
                                                    <span class="sort-icon" data-id='9'><i class="fa-sort-icon fa fa-caret-down" aria-hidden="true"></i></span>
                                                </span>
                                        </div>
                                        <span class="fs11">({{ trans('attributes.common.yen') }})</span>
                                    </td>
                                    <td class="border-top-0">
                                        <div class="centered-vertical sort-table-rent-roll w70">
                                            <span>{{ trans('attributes.rent_roll_list.monthly_rent') }}</span>
                                            <span class="sort-icon" data-id='10'><i class="fa-sort-icon fa fa-caret-down" aria-hidden="true"></i></span>
                                        </div>
                                        <span class="fs11">({{ trans('attributes.common.months') }})</span>
                                    </td>
                                    <td class="border-top-0 border-right-0">
                                        <div class="centered-vertical sort-table-rent-roll w70">
                                                <span class="centered">
                                                    <p class="m0">{{ trans('attributes.rent_roll_list.key_money') }}</p>
                                                    <span class="sort-icon" data-id='11'><i class="fa-sort-icon fa fa-caret-down" aria-hidden="true"></i></span>
                                                </span>
                                        </div>
                                    </td>
                                    <td class="border-top-0">
                                        <div class="centered-vertical sort-table-rent-roll w70">
                                            <span>{{ trans('attributes.rent_roll_list.monthly_rent') }}</span>
                                            <span class="sort-icon" data-id='12'><i class="fa-sort-icon fa fa-caret-down" aria-hidden="true"></i></span>
                                        </div>
                                        <span class="fs11">({{ trans('attributes.common.months') }})</span>
                                    </td>
                                    <td class="border-top-0">
                                        <div class="centered-vertical sort-table-rent-roll w70">
                                            <span>{{ trans('attributes.simulation.content.physical_info.uses') }}</span>
                                            <span class="sort-icon" data-id='13'><i class="fa-sort-icon fa fa-caret-down" aria-hidden="true"></i></span>
                                        </div>
                                    </td>
                                    <td class="border-top-0 border-right-0">
                                        <div class="centered-vertical sort-table-rent-roll w70">
                                                <span class="centered">
                                                    <p class="m0">{{ trans('attributes.rent_roll_list.contract_type') }}</p>
                                                    <span class="sort-icon" data-id='14'><i class="fa-sort-icon fa fa-caret-down" aria-hidden="true"></i></span>
                                                </span>
                                        </div>
                                    </td>
                                    <td class="border-top-0 border-right-0">
                                        <div class="centered-vertical sort-table-rent-roll w70">
                                                <span class="centered">
                                                    <p class="m0">{{ trans('attributes.rent_roll_list.original_contract_date') }}</p>
                                                    <span class="sort-icon" data-id='15'><i class="fa-sort-icon fa fa-caret-down" aria-hidden="true"></i></span>
                                                </span>
                                        </div>
                                    </td>
                                    <td class="border-top-0 border-right-0">
                                        <div class="centered-vertical sort-table-rent-roll w100">
                                                <span class="centered">
                                                    <p class="m0">{{ trans('attributes.rent_roll_list.current_contract_start_date') }}</p>
                                                    <span class="sort-icon" data-id='16'><i class="fa-sort-icon fa fa-caret-down" aria-hidden="true"></i></span>
                                                </span>
                                        </div>
                                    </td>
                                    <td class="border-top-0 border-right-0">
                                        <div class="centered-vertical sort-table-rent-roll w100">
                                                <span class="centered">
                                                    <p class="m0">{{ trans('attributes.rent_roll_list.end_date_of_current_contract') }}</p>
                                                    <span class="sort-icon" data-id='17'><i class="fa-sort-icon fa fa-caret-down" aria-hidden="true"></i></span>
                                                </span>
                                        </div>
                                    </td>
                                    <td class="border-top-0 border-right-0">
                                        <div class="centered-vertical sort-table-rent-roll w70">
                                            <span>{{ trans('attributes.borrowing.table.agreement_period') }}</span>
                                            <span class="sort-icon" data-id='18'><i class="fa-sort-icon fa fa-caret-down" aria-hidden="true"></i></span>
                                        </div>
                                        <span class="fs11">({{ trans('attributes.common.year') }})</span>
                                    </td>
                                    <td class="border-top-0 border-right-0">
                                        <div class="centered-vertical sort-table-rent-roll w70">
                                            <span class="centered">
                                                <p class="m0">{{ trans('attributes.property.contract_update_fee') }}</p>
                                                <span class="sort-icon" data-id='19'><i class="fa-sort-icon fa fa-caret-down" aria-hidden="true"></i></span>
                                            </span>
                                        </div>
                                        <span class="fs11">({{ trans('attributes.common.months') }})</span>
                                    </td>
                                    <td class="border-top-0 border-right-0">
                                        <div class="centered-vertical sort-table-rent-roll w70">
                                            <span>{{ trans('attributes.rent_roll_list.cancellation_notice') }}</span>
                                            <span class="sort-icon" data-id='20'><i class="fa-sort-icon fa fa-caret-down" aria-hidden="true"></i></span>
                                        </div>
                                        <span class="fs11">({{ trans('attributes.common.months') }})</span>
                                    </td>
                                    <td class="border-top-0 border-right-0">
                                        <div class="centered-vertical sort-table-rent-roll w70">
                                                <span class="centered">
                                                    <p class="m0">{{ trans('attributes.rent_roll_list.remarks') }}<br />({{ trans('attributes.rent_roll_list.see_attachment') }})</p>
                                                    <span class="sort-icon" data-id='21'><i class="fa-sort-icon fa fa-caret-down" aria-hidden="true"></i></span>
                                                </span>
                                        </div>
                                    </td>
                                    <td class="border-top-0 border-right-0">
                                        <div class="centered-vertical sort-table-rent-roll w100">
                                                <span class="centered">
                                                    <p class="m0">{{ trans('attributes.borrowing.table.rental_condition_score') }}<br />({{ trans('attributes.rent_roll_list.in_the_property') }})</p>
                                                    <span class="sort-icon" data-id='22'><i class="fa-sort-icon fa fa-caret-down" aria-hidden="true"></i></span>
                                                </span>
                                        </div>
                                    </td>
                                    <td class="border-top-0 border-right-0"></td>
                                </tr>

                                @php
                                    $sumRent = 0;
                                    $sumContFee = 0;
                                    $sumTotalRent = 0;
                                    $sumContractArea = 0;
                                    $sumContractAreaFar = 0;
                                    $sumMonthlyRent = 0;
                                    $sumMonthlyService = 0;
                                    $sumTotalRentService = 0;
                                    $sumDeposit = 0;
                                    $sumDepositMonthly = 0;
                                    $sumKeyMoney = 0;
                                    $sumKeyMoneyMonthly = 0;
                                    $sumRentNoEmpty = 0;
                                    $sumContFeeNoEmpty = 0;
                                    $sumTotalRentNoEmpty = 0;
                                    $sumContractAreaNoEmpty = 0;
                                    $sumContractAreaFarNoEmpty = 0;
                                    $sumMonthlyRentNoEmpty = 0;
                                    $sumMonthlyServiceNoEmpty = 0;
                                    $sumTotalRentServiceNoEmpty = 0;
                                    $sumDepositNoEmpty = 0;
                                    $sumDepositMonthlyNoEmpty = 0;
                                    $sumKeyMoneyNoEmpty = 0;
                                    $sumKeyMoneyMonthlyNoEmpty = 0;
                                    $countData = 0;
                                    $countDataNoEmpty = 0;
                                @endphp
                                @forelse($listRentRoll as $rentRoll)
                                    @php
                                        $sumRent += roundAmount(round(divisionNumber($rentRoll['monthly_rent'], round($rentRoll['contract_area'] * 0.3025, FLAG_TWO)), FLAG_ZERO));
                                        $sumContFee += roundAmount(round(divisionNumber($rentRoll['monthly_service'], round($rentRoll['contract_area'] * 0.3025, FLAG_TWO)), FLAG_ZERO));
                                        $sumTotalRent += roundAmount(round(divisionNumber($rentRoll['monthly_rent'] + $rentRoll['monthly_service'], round($rentRoll['contract_area'] * 0.3025, FLAG_TWO)), FLAG_ZERO));
                                        $sumContractArea += $rentRoll['contract_area'];
                                        $sumContractAreaFar += round($rentRoll['contract_area'] * 0.3025, FLAG_TWO);
                                        $sumMonthlyRent += $rentRoll['monthly_rent'];
                                        $sumMonthlyService += $rentRoll['monthly_service'];
                                        $sumTotalRentService += round($rentRoll['monthly_rent'] + $rentRoll['monthly_service'], FLAG_ZERO);
                                        $sumDeposit += $rentRoll['deposit'];
                                        $sumDepositMonthly += $rentRoll['deposit_monthly'];
                                        $sumKeyMoney += $rentRoll['key_money'];
                                        $sumKeyMoneyMonthly += $rentRoll['key_money_monthly'];
                                        $countData += FLAG_ONE;
                                        if ($rentRoll['room_status'] == 'no_empty') {
                                            $sumRentNoEmpty += roundAmount(round(divisionNumber($rentRoll['monthly_rent'], round($rentRoll['contract_area'] * 0.3025, FLAG_TWO)), FLAG_ZERO));
                                            $sumContFeeNoEmpty += roundAmount(round(divisionNumber($rentRoll['monthly_service'], round($rentRoll['contract_area'] * 0.3025, FLAG_TWO)), FLAG_ZERO));
                                            $sumTotalRentNoEmpty += roundAmount(round(divisionNumber($rentRoll['monthly_rent'] + $rentRoll['monthly_service'], round($rentRoll['contract_area'] * 0.3025, FLAG_TWO)), FLAG_ZERO));
                                            $sumContractAreaNoEmpty += $rentRoll['contract_area'];
                                            $sumContractAreaFarNoEmpty += round($rentRoll['contract_area'] * 0.3025, FLAG_TWO);
                                            $sumMonthlyRentNoEmpty += $rentRoll['monthly_rent'];
                                            $sumMonthlyServiceNoEmpty += $rentRoll['monthly_service'];
                                            $sumTotalRentServiceNoEmpty += round($rentRoll['monthly_rent'] + $rentRoll['monthly_service'], FLAG_ZERO);
                                            $sumDepositNoEmpty += $rentRoll['deposit'];
                                            $sumDepositMonthlyNoEmpty += $rentRoll['deposit_monthly'];
                                            $sumKeyMoneyNoEmpty += $rentRoll['key_money'];
                                            $sumKeyMoneyMonthlyNoEmpty += $rentRoll['key_money_monthly'];
                                            $countDataNoEmpty += FLAG_ONE;
                                        }
                                    @endphp
                                    <tr class="table">
                                        <td class="border-left-0" data-text="{{ displayNumberFloorAndRooms(getIndexSort($rentRoll['floor_code']), $rentRoll['room_code']) }}">
                                            {{ displayNumberFloorAndRooms(BASEMENT_RENT_ROLL[$rentRoll['floor_code']] ?? $rentRoll['floor_code'], $rentRoll['room_code']) }}
                                        </td>
                                        <td class="border-bottom-0"  data-text="{{ $rentRoll['room_status'] == 'no_empty' ? $rentRoll['tenant'] ?? 'ー' : 'ー'}}">
                                            @if($rentRoll['room_status'] == 'no_empty')
                                                <a type="button" class="btn br8 dropdown-toggle fs15 fs13-sp m5t rent-roll-popup" data-toggle="dropdown">
                                                    {{ $rentRoll['tenant'] ?? 'ー'}}
                                                </a>
                                            @else
                                                <a type="button" class="btn br8 dropdown-toggle fs15 fs13-sp m5t rent-roll-popup" data-toggle="dropdown">{{'ー'}}
                                                    <span class="room-empty">{{ __('attributes.rent_roll.room_status') }}</span>
                                                </a>
                                            @endif
                                            <div class="dropdown-menu dropdown-menu-right rent-roll-set-scrollbar">
                                                <a href="{{ route(USER_PROPERTY_RENT_ROLL_EDIT, ["propertyId" => $rentRoll['property_id'], "id" => $rentRoll['id'], 'screen' => 'list_rent_rolls', 'date_year' => $params['date_year'] ?? '', 'date_month' => $params['date_month'] ?? '']) }}"
                                                   class="dropdown-item find-property pointer">{{ __('attributes.rent_roll.edit') }}</a>
                                                <a href="{{ route(USER_PROPERTY_RENT_ROLL_CONTRACT_RENEWAL, ["propertyId" => $rentRoll['property_id'], "id" => $rentRoll['id'], 'screen' => 'list_rent_rolls', 'date_year' => $params['date_year'] ?? '', 'date_month' => $params['date_month'] ?? '']) }}"
                                                   class="dropdown-item find-property pointer">{{ __('attributes.rent_roll.title_contract_renewal') }}</a>
                                            </div>
                                        </td>
                                        <td class="border-bottom-0 convert-data text-nowrap" data-value="{{$rentRoll['contract_area']}}">
                                            {{ numberFormatWithUnit($rentRoll['contract_area'],'' . trans('attributes.common.square_meters'), FLAG_TWO) }}
                                            <br />{{ numberFormatWithUnit($rentRoll['contract_area'] * 0.3025,'' . trans('attributes.common.unit2'), FLAG_TWO) }}
                                        </td>
                                        <td class="border-bottom-0 text-right convert-data" data-value="{{$rentRoll['monthly_rent']}}">
                                            {{ number_format($rentRoll['monthly_rent']) }}
                                        </td>
                                        <td class="border-bottom-0 text-right convert-data" data-value="{{ round(divisionNumber($rentRoll['monthly_rent'], round($rentRoll['contract_area'] * 0.3025, FLAG_TWO)), FLAG_ZERO) }}">
                                            {{ number_format(excelRound(divisionNumber($rentRoll['monthly_rent'], round($rentRoll['contract_area'] * 0.3025, FLAG_TWO)), -FLAG_TWO)) }}
                                        </td>
                                        <td class="border-bottom-0 text-right convert-data" data-value="{{$rentRoll['monthly_service']}}">
                                            {{ number_format($rentRoll['monthly_service']) }}
                                        </td>
                                        <td class="border-bottom-0 text-right" data-value="{{ round(divisionNumber($rentRoll['monthly_service'], round($rentRoll['contract_area'] * 0.3025, FLAG_TWO)), FLAG_ZERO) }}">
                                            {{ number_format(excelRound(divisionNumber($rentRoll['monthly_service'], round($rentRoll['contract_area'] * 0.3025, FLAG_TWO)), -FLAG_TWO)) }}
                                        </td>
                                        <td class="border-bottom-0 text-right" data-value="{{ round($rentRoll['monthly_rent'] + $rentRoll['monthly_service'], FLAG_ZERO) }}">
                                            {{ number_format($rentRoll['monthly_rent'] + $rentRoll['monthly_service'], FLAG_ZERO) }}
                                        </td>
                                        <td class="border-bottom-0 text-right" data-value="{{ round(divisionNumber($rentRoll['monthly_rent'] + $rentRoll['monthly_service'], round($rentRoll['contract_area'] * 0.3025, FLAG_TWO)), FLAG_ZERO) }}">
                                            {{ number_format(excelRound(divisionNumber($rentRoll['monthly_rent'] + $rentRoll['monthly_service'], round($rentRoll['contract_area'] * 0.3025, FLAG_TWO)), -FLAG_TWO)) }}
                                        </td>
                                        <td class="border-bottom-0 text-right" data-value="{{$rentRoll['deposit']}}">
                                            {{ number_format($rentRoll['deposit']) }}
                                        </td>
                                        <td class="border-bottom-0 text-right" data-value="{{$rentRoll['deposit_monthly']}}">
                                            {{ number_format($rentRoll['deposit_monthly'], FLAG_ONE) }}
                                        </td>
                                        <td class="border-bottom-0 text-right" data-value="{{$rentRoll['key_money']}}">
                                            {{ number_format($rentRoll['key_money']) }}
                                        </td>
                                        <td class="border-bottom-0 text-right" data-value="{{$rentRoll['key_money_monthly']}}">
                                            {{ number_format($rentRoll['key_money_monthly'], FLAG_ONE) }}
                                        </td>
                                        <td class="border-bottom-0" data-value="{{ $rentRoll['real_estate_type_id'] ? REAL_ESTATE_TYPE[$rentRoll['real_estate_type_id']] : 'ー' }}">
                                            {{ $rentRoll['real_estate_type_id'] ? REAL_ESTATE_TYPE[$rentRoll['real_estate_type_id']] : 'ー' }}
                                        </td>
                                        <td class="border-bottom-0" data-value="{{ isset($rentRoll['contract_type']) ? CONTRACT_TYPE[$rentRoll['contract_type']] : 'ー' }}">
                                            {{ isset($rentRoll['contract_type']) ? CONTRACT_TYPE[$rentRoll['contract_type']] : 'ー' }}
                                        </td>
                                        <td class="border-bottom-0 text-center">{{ $rentRoll['contract_signing_date'] ? dateTimeFormat($rentRoll['contract_signing_date']) : 'ー' }}</td>
                                        <td class="border-bottom-0 text-center">{{ $rentRoll['contract_start_date'] ? dateTimeFormat($rentRoll['contract_start_date']) : 'ー' }}</td>
                                        <td class="border-bottom-0 text-center">{{ $rentRoll['contract_end_date'] ? dateTimeFormat($rentRoll['contract_end_date']) : 'ー' }}</td>
                                        <td class="border-bottom-0 text-center" data-value="{{ calculationMonthBetweenTwoTimeParts($rentRoll['contract_start_date'],$rentRoll['contract_end_date']) }}">
                                            {{ calculationMonthBetweenTwoTimeParts($rentRoll['contract_start_date'],$rentRoll['contract_end_date']) }}
                                        </td>
                                        <td class="border-bottom-0 text-right" data-value="{{ $rentRoll['money_update'] }}">
                                            {{ number_format($rentRoll['money_update'], FLAG_ONE) }}
                                        </td>
                                        <td class="border-bottom-0 text-right" data-value="{{ $rentRoll['cancellation_notice'] }}">
                                            {{ number_format($rentRoll['cancellation_notice']) }}
                                        </td>
                                        <td class="border-bottom-0">
                                            @if(isset($rentRoll['note']))
                                                <a href="#">有</a></td>
                                            @else
                                                {{ '' }}
                                            @endif
                                        <td class="border-bottom-0 border-right-0 text-right" data-value="{{ $score[$rentRoll['id']] == FLAG_ZERO ? '' :  $score[$rentRoll['id']] }}">
                                            {{ $score[$rentRoll['id']] == FLAG_ZERO ? '' :  $score[$rentRoll['id']] }}
                                        </td>
                                        <td class="border-bottom-0 border-right-0">
                                            <a class="delete-rent-roll pointer" data-id="{{$rentRoll['id']}}"><i class="far fa-trash-alt"></i></a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-left" colspan="25" >{{trans('attributes.rent_roll_list.no_data')}}</td>
                                    </tr>
                                @endforelse

                                @if($listRentRoll)
                                <tr class="table-foot">
                                    <td class="border-0 text-left p0" colspan="2">
                                        <div class="p25 w80 fw-bold bg-general w40">
                                            <p class="m0">{{ trans('attributes.borrowing.table.total') }}</p>
                                        </div>
                                    </td>
                                    <td id="sum-area-leased" class="border-bottom-0 text-left text-left fw-bold text-nowrap" data-toggle="tooltip" title="">
                                        {{ numberFormatWithUnit($sumContractArea,'' . trans('attributes.common.square_meters'), FLAG_TWO) }}
                                        <br />{{ numberFormatWithUnit($sumContractAreaFar,'' . trans('attributes.common.unit2'), FLAG_TWO) }}
                                    </td>
                                    <td id="sum-monthly-rent" class="border-bottom-0 text-left text-right fw-bold" data-toggle="tooltip" title="">
                                        {{ number_format($sumMonthlyRent) }}
                                    </td>
                                    <td id="sum-rent-tsubo" class="border-bottom-0 text-right fw-bold" data-toggle="tooltip" title="">
                                        {{ number_format(divisionNumber($sumMonthlyRent, $sumContractAreaFar)) }}
                                    </td>
                                    <td id="sum-monthly-condo-fee" class="border-bottom-0 text-right fw-bold" data-toggle="tooltip" title="">
                                        {{ number_format($sumMonthlyService) }}
                                    </td>
                                    <td id="sum-cont-fee-tsubo" class="border-bottom-0 text-right fw-bold" data-toggle="tooltip" title="">
                                        {{ number_format(divisionNumber($sumMonthlyService, $sumContractAreaFar)) }}
                                    </td>
                                    <td id="sum-total-rent-monthly" class="border-bottom-0 text-right fw-bold" data-toggle="tooltip" title="">
                                        {{ number_format($sumTotalRentService) }}
                                    </td>
                                    <td id="sum-total-rent-tsubo" class="border-bottom-0 text-right fw-bold" data-toggle="tooltip" title="">
                                        {{ number_format(excelRound(round(divisionNumber($sumTotalRentService, $sumContractAreaFar)), FLAG_ZERO)) }}
                                    </td>
                                    <td id="sum-deposit" class="border-bottom-0 text-right fw-bold" data-toggle="tooltip" title="">
                                        {{ number_format($sumDeposit) }}
                                    </td>
                                    <td id="sum-monthly-rent" class="border-bottom-0 text-right fw-bold" data-toggle="tooltip" title="">
                                        {{ number_format(divisionNumber($sumDeposit, $sumMonthlyRent), FLAG_ONE) }}
                                    </td>
                                    <td id="sum-monthly-rent" class="border-bottom-0 text-right fw-bold" data-toggle="tooltip" title="">
                                        {{ number_format($sumKeyMoney, FLAG_ONE) }}
                                    </td>
                                    <td id="sum-monthly-rent" class="border-bottom-0 text-right fw-bold" data-toggle="tooltip" title="">
                                        {{ number_format(divisionNumber($sumKeyMoney, $sumMonthlyRent), FLAG_ONE) }}
                                    </td>
                                    <td class="border-bottom-0" colspan="2"></td>
                                    <td class="border-bottom-0" colspan="8"></td>
                                    <td class="border-bottom-0 border-right-0 "></td>
                                </tr>
                                @endif
                            </table>
                        </div>
                    </div>

                    <div class="col-12 col-xl-10 col-12-sp m17l-per m30b p0">
                        @if(!empty($listRentRoll))
                            <div class="row m0 m13b bg-white">
                                <div class="table-responsive fs14 fw-bold">
                                    <table id="table-property" class="table table-bordered table-striped border-0 m0">
                                        <tr class="table-head">
                                            <td class="fw-bold bg-general w40 border-0" rowspan="5"><span class="vertical">総括</span></td>
                                        </tr>

                                        <tr>
                                            <td class="border-left-0"></td>
                                            <td class="text-center">{{ trans('attributes.rent_roll_list.contract_area') }}<br>({{ trans('attributes.common.unit-5') }})</td>
                                            <td class="text-center">{{ trans('attributes.rent_roll_list.monthly_rent') }}<br>({{ trans('attributes.common.yen') }})</td>
                                            <td class="text-center">{{ trans('attributes.rent_roll_list.Rent') }}<br>({{ trans('attributes.common.yen') }})</td>
                                            <td class="text-center">{{ trans('attributes.rent_roll_list.monthly_service_fee') }}<br>({{ trans('attributes.common.yen') }})</td>
                                            <td class="text-center">{{ trans('attributes.rent_roll_list.utilities') }}<br>({{ trans('attributes.common.yen') }})</td>
                                            <td class="text-center">
                                                <div class="w90">
                                                    {{ trans('attributes.rent_roll_list.total_rent_month') }}<br>({{ trans('attributes.common.yen') }})
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <div class="w90">
                                                    {{ trans('attributes.rent_roll_list.total_rent') }}<br>({{ trans('attributes.common.yen') }})
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <div class="w90">
                                                {{ trans('attributes.property.deposit') }}<br>({{ trans('attributes.common.yen') }})
                                                </div>
                                            </td>
                                            <td class="text-center">{{ trans('attributes.rent_roll_list.monthly_rent') }}<br>({{ trans('attributes.common.months') }})</td>
                                            <td class="text-center">{{ trans('attributes.rent_roll_list.key_money') }}</td>
                                            <td class="text-center">{{ trans('attributes.rent_roll_list.monthly_rent') }}<br>({{ trans('attributes.common.months') }})</td>
                                            <td class="text-center"></td>
                                        </tr>

                                        <tr class="table text-center">
                                            <td class="border-left-0 text-center"><span class="rent-btn rent-green-btn">賃貸</span></td>
                                            <td class="border-top-0 border-bottom-0 text-right text-nowrap">
                                                {{ numberFormatWithUnit($sumContractAreaNoEmpty,'' . trans('attributes.common.square_meters'), FLAG_TWO) }}
                                                <br />{{ numberFormatWithUnit($sumContractAreaFarNoEmpty,'' . trans('attributes.common.unit2'), FLAG_TWO) }}
                                            </td>
                                            <td class="border-top-0 border-bottom-0 text-right">
                                                {{ number_format($sumMonthlyRentNoEmpty) }}
                                            </td>
                                            <td class="border-top-0 border-bottom-0 text-right">
                                                {{ number_format(divisionNumber($sumMonthlyRentNoEmpty, $sumContractAreaFarNoEmpty)) }}
                                            </td>
                                            <td class="border-top-0 border-bottom-0 text-right">
                                                {{ number_format($sumMonthlyServiceNoEmpty) }}
                                            </td>
                                            <td class="border-top-0 border-bottom-0 text-right">
                                                {{ number_format(divisionNumber($sumMonthlyServiceNoEmpty, $sumContractAreaFarNoEmpty)) }}
                                            </td>
                                            <td class="border-top-0 border-bottom-0 text-right">
                                                {{ number_format($sumTotalRentServiceNoEmpty) }}
                                            </td>
                                            <td class="border-top-0 border-bottom-0 text-right">
                                                {{ number_format(excelRound(round(divisionNumber($sumTotalRentServiceNoEmpty, $sumContractAreaFarNoEmpty)), FLAG_ZERO)) }}
                                            </td>
                                            <td class="border-top-0 border-bottom-0 text-right">
                                                {{ number_format($sumDepositNoEmpty) }}
                                            </td>
                                            <td class="border-top-0 border-bottom-0 text-right">
                                                {{ number_format(divisionNumber($sumDepositNoEmpty, $sumMonthlyRentNoEmpty), FLAG_ONE) }}
                                            </td>
                                            <td class="border-top-0 border-bottom-0 text-right">
                                                {{ number_format($sumKeyMoneyNoEmpty) }}
                                            </td>
                                            <td class="border-top-0 border-bottom-0 text-right">
                                                {{ number_format(divisionNumber($sumKeyMoneyNoEmpty, $sumMonthlyRentNoEmpty), FLAG_ONE) }}
                                            </td>
                                            <td class="border-top-0 border-bottom-0 border-right-0 text-center">
                                                {{ trans('attributes.rent_roll_list.crop_rate') }}：{{numberFormatWithUnit(divisionNumber(round($sumContractAreaNoEmpty, FLAG_TWO), round($sumContractArea, FLAG_TWO)) * FLAG_ONE_HUNDRED, '' . trans('attributes.common.percent'), FLAG_ONE)}}
                                            </td>
                                        </tr>

                                        <tr class="table">
                                            <td class="border-left-0 text-center"><span class="rent-btn rent-pink-btn">空室</span></td>
                                            <td class="border-bottom-0 text-right text-nowrap">
                                                {{ numberFormatWithUnit($sumContractArea - $sumContractAreaNoEmpty,'' . trans('attributes.common.square_meters'), FLAG_TWO) }}
                                                <br />{{ numberFormatWithUnit($sumContractAreaFar -$sumContractAreaFarNoEmpty,'' . trans('attributes.common.unit2'), FLAG_TWO) }}
                                            </td>
                                            <td class="border-bottom-0 text-right">-</td>
                                            <td class="border-bottom-0 text-right">-</td>
                                            <td class="border-bottom-0 text-right">-</td>
                                            <td class="border-bottom-0 text-right">-</td>
                                            <td class="border-bottom-0 text-right">-</td>
                                            <td class="border-bottom-0 text-right">-</td>
                                            <td class="border-bottom-0 text-right">-</td>
                                            <td class="border-bottom-0 text-right">-</td>
                                            <td class="border-bottom-0 text-right">-</td>
                                            <td class="border-bottom-0 text-right">-</td>
                                            <td class="border-bottom-0 border-right-0 text-center">
                                                {{ trans('attributes.rent_roll_list.vacancy_rate') }}：{{numberFormatWithUnit(divisionNumber(round($sumContractArea - $sumContractAreaNoEmpty, FLAG_TWO), round($sumContractArea, FLAG_TWO)) * FLAG_ONE_HUNDRED, '' . trans('attributes.common.percent'), FLAG_ONE)}}
                                            </td>
                                        </tr>

                                        <tr class="table">
                                            <td class="border-left-0 border-bottom-0 text-center"><span class="rent-btn rent-general-btn">{{ trans('attributes.rent_roll_list.effective_total') }}</span></td>
                                            <td class="border-bottom-0 text-right text-nowrap">
                                                {{ numberFormatWithUnit($sumContractArea,'' . trans('attributes.common.square_meters'), FLAG_TWO) }}
                                                <br />{{ numberFormatWithUnit($sumContractAreaFar,'' . trans('attributes.common.unit2'), FLAG_TWO) }}
                                            </td>
                                            <td class="border-bottom-0 text-right">
                                                {{ number_format($sumMonthlyRent) }}
                                            </td>
                                            <td class="border-bottom-0 text-right">-</td>
                                            <td class="border-bottom-0 text-right">
                                                {{ number_format($sumMonthlyService) }}
                                            </td>
                                            <td class="border-bottom-0 text-right">-</td>
                                            <td class="border-bottom-0 text-right">
                                                {{ number_format($sumTotalRentService) }}
                                            </td>
                                            <td class="border-bottom-0 text-right">-</td>
                                            <td class="border-bottom-0 text-right">
                                                {{ number_format($sumDeposit) }}
                                            </td>
                                            <td class="border-bottom-0 text-right">-</td>
                                            <td class="border-bottom-0 text-right">{{ number_format($sumKeyMoney) }}</td>
                                            <td class="border-bottom-0 text-right">-</td>
                                            <td class="border-bottom-0 border-right-0 text-center"></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        @endif

                        @php($i =0)
                        @foreach($totalRealEstateTypes as $key => $total)
                            @php($i++)
                            @if ($i != count($totalRealEstateTypes))
                                <div class="row m0 m13b bg-white">
                                    <div class="table-responsive fs14 fw-bold">
                                        <table id="table-property" class="table table-bordered table-striped border-0 m0">
                                            <tr class="table-head">
                                                <td class="fw-bold bg-general w40" rowspan="5"><span class="vertical">{{'用途別'.$i}}</span></td>
                                            </tr>

                                            <tr>
                                                <td class="border-left-0"></td>
                                                <td class="text-center">{{ trans('attributes.rent_roll_list.contract_area') }}<br>({{ trans('attributes.common.unit-5') }})</td>
                                                <td class="text-center">{{ trans('attributes.rent_roll_list.monthly_rent') }}<br>({{ trans('attributes.common.yen') }})</td>
                                                <td class="text-center">{{ trans('attributes.rent_roll_list.Rent') }}<br>({{ trans('attributes.common.yen') }})</td>
                                                <td class="text-center">{{ trans('attributes.rent_roll_list.monthly_service_fee') }}<br>({{ trans('attributes.common.yen') }})</td>
                                                <td class="text-center">{{ trans('attributes.rent_roll_list.utilities') }}<br>({{ trans('attributes.common.yen') }})</td>
                                                <td class="text-center">
                                                    <div class="w90">
                                                        {{ trans('attributes.rent_roll_list.total_rent_month') }}<br>({{ trans('attributes.common.yen') }})
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    <div class="w90">
                                                        {{ trans('attributes.rent_roll_list.total_rent') }}<br>({{ trans('attributes.common.yen') }})
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    <div class="w90">
                                                        {{ trans('attributes.property.deposit') }}<br>({{ trans('attributes.common.yen') }})
                                                    </div>
                                                </td>
                                                <td class="text-center">{{ trans('attributes.rent_roll_list.monthly_rent') }}<br>({{ trans('attributes.common.months') }})</td>
                                                <td class="text-center">{{ trans('attributes.rent_roll_list.key_money') }}</td>
                                                <td class="text-center">{{ trans('attributes.rent_roll_list.monthly_rent') }}<br>({{ trans('attributes.common.months') }})</td>
                                                <td class="text-center"></td>
                                            </tr>

                                            <tr class="table text-center">
                                                <td class="border-left-0 border-left-0 text-center"><span class="rent-btn rent-green-btn">{{REAL_ESTATE_TYPE[$key]}}</span></td>
                                                <td class="border-top-0 border-bottom-0 text-right text-nowrap">
                                                    {{ numberFormatWithUnit($total[FLAG_ZERO]['contract_area'],'' . trans('attributes.common.square_meters'), FLAG_TWO) }}
                                                    <br />{{ numberFormatWithUnit($total[FLAG_ZERO]['contract_area_2'],'' . trans('attributes.common.unit2'), FLAG_TWO) }}
                                                </td>
                                                <td class="border-top-0 border-bottom-0 text-right">
                                                    {{ number_format($total[FLAG_ZERO]['monthly_rent']) }}
                                                </td>
                                                <td class="border-top-0 border-bottom-0 text-right">
                                                    {{ number_format(divisionNumber($total[FLAG_TWO]['rental_fee'], round($total[FLAG_ZERO]['contract_area'] * 0.3025, FLAG_TWO))) }}
                                                </td>
                                                <td class="border-top-0 border-bottom-0 text-right">
                                                    {{ number_format($total[FLAG_ZERO]['monthly_service'])}}
                                                </td>
                                                <td class="border-top-0 border-bottom-0 text-right">
                                                    {{ number_format(divisionNumber($total[FLAG_TWO]['shared_fee'], round($total[FLAG_ZERO]['contract_area'] * 0.3025, FLAG_TWO))) }}
                                                </td>
                                                <td class="border-top-0 border-bottom-0 text-right">
                                                    {{ number_format($total[FLAG_ZERO]['monthly_rent'] + $total[FLAG_ZERO]['monthly_service'], FLAG_ZERO) }}
                                                </td>
                                                <td class="border-top-0 border-bottom-0 text-right">
                                                    {{ number_format(divisionNumber($total[FLAG_TWO]['total_rental'], round($total[FLAG_ZERO]['contract_area'] * 0.3025, FLAG_TWO))) }}
                                                </td>
                                                <td class="border-top-0 border-bottom-0 text-right">
                                                    {{ number_format($total[FLAG_ZERO]['deposit'])}}
                                                </td>
                                                <td class="border-top-0 border-bottom-0 text-right">
                                                    {{ number_format(divisionNumber($total[FLAG_ZERO]['deposit'], $total[FLAG_ZERO]['monthly_rent']), FLAG_ONE) }}
                                                </td>
                                                <td class="border-top-0 border-bottom-0 text-right">
                                                    {{ number_format($total[FLAG_ZERO]['key_money']) }}
                                                </td>
                                                <td class="border-top-0 border-bottom-0 text-right">
                                                    {{ number_format(divisionNumber($total[FLAG_ZERO]['key_money'], $total[FLAG_ZERO]['monthly_rent']), FLAG_ONE) }}
                                                </td>
                                                <td class="border-top-0 border-bottom-0 border-right-0 text-center">
                                                    {{ trans('attributes.rent_roll_list.crop_rate') }}：{{numberFormatWithUnit(divisionNumber(round($total[FLAG_ZERO]['contract_area'], FLAG_TWO), round($total[FLAG_ZERO]['contract_area'] + $total[FLAG_ONE]['contract_area'], FLAG_TWO)) * FLAG_ONE_HUNDRED, '' . trans('attributes.common.percent'), FLAG_ONE)}}
                                                </td>
                                            </tr>

                                            <tr class="table">
                                                <td class="border-left-0 text-center"><span class="rent-btn rent-pink-btn">空室</span></td>
                                                <td class="border-bottom-0 text-right text-nowrap">
                                                    {{ numberFormatWithUnit($total[FLAG_ONE]['contract_area'],'' . trans('attributes.common.square_meters'), FLAG_TWO) }}
                                                    <br />{{ numberFormatWithUnit($total[FLAG_ONE]['contract_area_2'],'' . trans('attributes.common.unit2'), FLAG_TWO) }}
                                                </td>
                                                <td class="border-bottom-0 text-right">-</td>
                                                <td class="border-bottom-0 text-right">-</td>
                                                <td class="border-bottom-0 text-right">-</td>
                                                <td class="border-bottom-0 text-right">-</td>
                                                <td class="border-bottom-0 text-right">-</td>
                                                <td class="border-bottom-0 text-right">-</td>
                                                <td class="border-bottom-0 text-right">-</td>
                                                <td class="border-bottom-0 text-right">-</td>
                                                <td class="border-bottom-0 text-right">-</td>
                                                <td class="border-bottom-0 text-right">-</td>
                                                <td class="border-bottom-0 border-right-0 text-center">
                                                    {{ trans('attributes.rent_roll_list.vacancy_rate') }}：{{numberFormatWithUnit(divisionNumber(round($total[FLAG_ONE]['contract_area'], FLAG_TWO), round($total[FLAG_ZERO]['contract_area'] + $total[FLAG_ONE]['contract_area'], FLAG_TWO)) * FLAG_ONE_HUNDRED, '' . trans('attributes.common.percent'), FLAG_ONE)}}
                                                </td>
                                            </tr>

                                            <tr class="table">
                                                <td class="border-left-0 border-bottom-0 text-center"><span class="rent-btn rent-general-btn">計</span></td>
                                                <td class="border-bottom-0 text-right text-nowrap">
                                                    {{ numberFormatWithUnit($total[FLAG_ZERO]['contract_area'] + $total[FLAG_ONE]['contract_area'],'' . trans('attributes.common.square_meters'), FLAG_TWO) }}
                                                    <br />{{ numberFormatWithUnit($total[FLAG_ZERO]['contract_area_2'] + $total[FLAG_ONE]['contract_area_2'],'' . trans('attributes.common.unit2'), FLAG_TWO) }}
                                                </td>
                                                <td class="border-bottom-0 text-right">
                                                    {{ number_format($total[FLAG_ZERO]['monthly_rent'] + $total[FLAG_ONE]['monthly_rent']) }}
                                                </td>
                                                <td class="border-bottom-0 text-right">-</td>
                                                <td class="border-bottom-0 text-right">
                                                    {{ number_format($total[FLAG_ZERO]['monthly_service'] +  $total[FLAG_ONE]['monthly_service']) }}
                                                </td>
                                                <td class="border-bottom-0 text-right">-</td>
                                                <td class="border-bottom-0 text-right">
                                                    {{ number_format($total[FLAG_ZERO]['monthly_rent'] + $total[FLAG_ZERO]['monthly_service'] + $total[FLAG_ONE]['monthly_rent'] + $total[FLAG_ONE]['monthly_service'], FLAG_ZERO) }}
                                                </td>
                                                <td class="border-bottom-0 text-right">-</td>
                                                <td class="border-bottom-0 text-center">
                                                    {{ number_format($total[FLAG_ZERO]['deposit'] + $total[FLAG_ONE]['deposit']) }}
                                                </td>
                                                <td class="border-bottom-0 text-right">-</td>
                                                <td class="border-bottom-0 text-right">{{ number_format($total[FLAG_ZERO]['key_money'] +  $total[FLAG_ONE]['key_money']) }}</td>
                                                <td class="border-bottom-0 text-right">-</td>
                                                <td class="border-bottom-0 border-right-0 text-center"></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            @else
                                <div class="row m0 br15l bg-white">
                                    <div class="table-responsive br15l fs14 fw-bold">
                                        <table id="table-property" class="table table-bordered table-striped border-0 m0">
                                            <tr class="table-head">
                                                <td class="fw-bold bg-general br15l w40 border-0" rowspan="5"><span class="vertical">{{'用途別'.$i}}</span></td>
                                            </tr>

                                            <tr>
                                                <td class="border-left-0"></td>
                                                <td class="text-center">{{ trans('attributes.rent_roll_list.contract_area') }}<br>({{ trans('attributes.common.unit-5') }})</td>
                                                <td class="text-center">{{ trans('attributes.rent_roll_list.monthly_rent') }}<br>({{ trans('attributes.common.yen') }})</td>
                                                <td class="text-center">{{ trans('attributes.rent_roll_list.Rent') }}<br>({{ trans('attributes.common.yen') }})</td>
                                                <td class="text-center">{{ trans('attributes.rent_roll_list.monthly_service_fee') }}<br>({{ trans('attributes.common.yen') }})</td>
                                                <td class="text-center">{{ trans('attributes.rent_roll_list.utilities') }}<br>({{ trans('attributes.common.yen') }})</td>
                                                <td class="text-center">
                                                    <div class="w90">
                                                        {{ trans('attributes.rent_roll_list.total_rent_month') }}<br>({{ trans('attributes.common.yen') }})
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    <div class="w90">
                                                        {{ trans('attributes.rent_roll_list.total_rent') }}<br>({{ trans('attributes.common.yen') }})
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    <div class="w90">
                                                        {{ trans('attributes.property.deposit') }}<br>({{ trans('attributes.common.yen') }})
                                                    </div>
                                                </td>
                                                <td class="text-center">{{ trans('attributes.rent_roll_list.monthly_rent') }}<br>({{ trans('attributes.common.months') }})</td>
                                                <td class="text-center">{{ trans('attributes.rent_roll_list.key_money') }}</td>
                                                <td class="text-center">{{ trans('attributes.rent_roll_list.monthly_rent') }}<br>({{ trans('attributes.common.months') }})</td>
                                                <td class="text-center"></td>
                                            </tr>

                                            <tr class="table text-center">
                                                <td class="border-left-0 border-left-0 text-center"><span class="rent-btn rent-green-btn">{{REAL_ESTATE_TYPE[$key]}}</span></td>
                                                <td class="border-top-0 border-bottom-0 text-right text-nowrap">
                                                    {{ numberFormatWithUnit($total[FLAG_ZERO]['contract_area'],'' . trans('attributes.common.square_meters'), FLAG_TWO) }}
                                                    <br />{{ numberFormatWithUnit($total[FLAG_ZERO]['contract_area_2'],'' . trans('attributes.common.unit2'), FLAG_TWO) }}
                                                </td>
                                                <td class="border-top-0 border-bottom-0 text-right">
                                                    {{ number_format($total[FLAG_ZERO]['monthly_rent']) }}
                                                </td>
                                                <td class="border-top-0 border-bottom-0 text-right">
                                                    {{ number_format(divisionNumber($total[FLAG_TWO]['rental_fee'], round($total[FLAG_ZERO]['contract_area'] * 0.3025, FLAG_TWO))) }}
                                                </td>
                                                <td class="border-top-0 border-bottom-0 text-right">
                                                    {{ number_format($total[FLAG_ZERO]['monthly_service']) }}
                                                </td>
                                                <td class="border-top-0 border-bottom-0 text-right">
                                                    {{ number_format(divisionNumber($total[FLAG_TWO]['shared_fee'], round($total[FLAG_ZERO]['contract_area'] * 0.3025, FLAG_TWO))) }}
                                                </td>
                                                <td class="border-top-0 border-bottom-0 text-right">
                                                    {{ number_format($total[FLAG_ZERO]['monthly_rent'] + $total[FLAG_ZERO]['monthly_service'], FLAG_ZERO) }}
                                                </td>
                                                <td class="border-top-0 border-bottom-0 text-right">
                                                    {{ number_format(divisionNumber($total[FLAG_TWO]['total_rental'], round($total[FLAG_ZERO]['contract_area'] * 0.3025, FLAG_TWO))) }}
                                                </td>
                                                <td class="border-top-0 border-bottom-0 text-right">
                                                    {{ number_format($total[FLAG_ZERO]['deposit']) }}
                                                </td>
                                                <td class="border-top-0 border-bottom-0 text-right">
                                                    {{ number_format(divisionNumber($total[FLAG_ZERO]['deposit'], $total[FLAG_ZERO]['monthly_rent']), FLAG_ONE) }}
                                                </td>
                                                <td class="border-top-0 border-bottom-0 text-right">
                                                    {{ number_format($total[FLAG_ZERO]['key_money']) }}
                                                </td>
                                                <td class="border-top-0 border-bottom-0 text-right">
                                                    {{ number_format(divisionNumber($total[FLAG_ZERO]['key_money'], $total[FLAG_ZERO]['monthly_rent']), FLAG_ONE) }}
                                                </td>
                                                <td class="border-top-0 border-bottom-0 border-right-0 text-center">
                                                    {{ trans('attributes.rent_roll_list.crop_rate') }}：{{numberFormatWithUnit(divisionNumber(round($total[FLAG_ZERO]['contract_area'], FLAG_TWO), $total[FLAG_ZERO]['contract_area'] + round($total[FLAG_ONE]['contract_area'], FLAG_TWO)) * FLAG_ONE_HUNDRED, '' . trans('attributes.common.percent'), FLAG_ONE)}}
                                                </td>
                                            </tr>

                                            <tr class="table">
                                                <td class="border-left-0 text-center"><span class="rent-btn rent-pink-btn">{{ trans('attributes.common.room_empty') }}</span></td>
                                                <td class="border-bottom-0 text-right text-nowrap">
                                                    {{ numberFormatWithUnit($total[FLAG_ONE]['contract_area'],'' . trans('attributes.common.square_meters'), FLAG_TWO) }}
                                                    <br />{{ numberFormatWithUnit($total[FLAG_ONE]['contract_area_2'],'' . trans('attributes.common.unit2'), FLAG_TWO) }}
                                                </td>
                                                <td class="border-bottom-0 text-right">-</td>
                                                <td class="border-bottom-0 text-right">-</td>
                                                <td class="border-bottom-0 text-right">-</td>
                                                <td class="border-bottom-0 text-right">-</td>
                                                <td class="border-bottom-0 text-right">-</td>
                                                <td class="border-bottom-0 text-right">-</td>
                                                <td class="border-bottom-0 text-right">-</td>
                                                <td class="border-bottom-0 text-right">-</td>
                                                <td class="border-bottom-0 text-right">-</td>
                                                <td class="border-bottom-0 text-right">-</td>
                                                <td class="border-bottom-0 border-right-0 text-center">
                                                    {{ trans('attributes.rent_roll_list.vacancy_rate') }}：{{numberFormatWithUnit(divisionNumber(round($total[FLAG_ONE]['contract_area'], FLAG_TWO), round($total[FLAG_ZERO]['contract_area'] + $total[FLAG_ONE]['contract_area'], FLAG_TWO)) * FLAG_ONE_HUNDRED, '' . trans('attributes.common.percent'), FLAG_ONE)}}
                                                </td>
                                            </tr>

                                            <tr class="table">
                                                <td class="border-left-0 border-bottom-0 text-center"><span class="rent-btn rent-general-btn">{{ trans('attributes.simulation.content.operating_fee.sum') }}</span></td>
                                                <td class="border-bottom-0 text-right text-nowrap">
                                                    {{ numberFormatWithUnit($total[FLAG_ZERO]['contract_area'] + $total[FLAG_ONE]['contract_area'],'' . trans('attributes.common.square_meters'), FLAG_TWO) }}
                                                    <br />{{ numberFormatWithUnit($total[FLAG_ZERO]['contract_area_2'] + $total[FLAG_ONE]['contract_area_2'],'' . trans('attributes.common.unit2'), FLAG_TWO) }}
                                                </td>
                                                <td class="border-bottom-0 text-right">
                                                    {{ number_format($total[FLAG_ZERO]['monthly_rent'] + $total[FLAG_ONE]['monthly_rent']) }}
                                                </td>
                                                <td class="border-bottom-0 text-right">-</td>
                                                <td class="border-bottom-0 text-right">
                                                    {{ number_format($total[FLAG_ZERO]['monthly_service'] + $total[FLAG_ONE]['monthly_service']) }}
                                                </td>
                                                <td class="border-bottom-0 text-right">-</td>
                                                <td class="border-bottom-0 text-right">
                                                    {{ number_format($total[FLAG_ZERO]['monthly_rent'] + $total[FLAG_ZERO]['monthly_service'] + $total[FLAG_ONE]['monthly_rent'] + $total[FLAG_ONE]['monthly_service']) }}
                                                </td>
                                                <td class="border-bottom-0 text-right">-</td>
                                                <td class="border-bottom-0 text-right">
                                                    {{ number_format($total[FLAG_ZERO]['deposit'] + $total[FLAG_ONE]['deposit']) }}
                                                </td>
                                                <td class="border-bottom-0 text-right">-</td>
                                                <td class="border-bottom-0 text-right">{{ number_format($total[FLAG_ZERO]['key_money'] + $total[FLAG_ONE]['key_money']) }}</td>
                                                <td class="border-bottom-0 text-right">-</td>
                                                <td class="border-bottom-0 border-right-0 text-center"></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                    <div class="div-chart-list row m0lr m30b">
                        <div id="parent-chart-room" class="diagram-block-new col-12 p0l col-xxl-5 m30r p0r" >
                            <div id="chart-room"></div>
                            <div class="legend-chart legend-chart1 row">
                                <div class="margin-auto row col-8 col-lg-5 col-xl-5">
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
                        <div id="parent-chart-acreage" class="diagram-block-new col-12 col-xxl-5 p0l p0r m30t-sp m30t-max16">
                            <div id="chart-acreage"></div>
                            <div class="legend-chart legend-chart2 row">
                                <div class="margin-auto row col-8 col-lg-5 col-xl-5">
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
                    </div>
                    <div class="m0 diagram-analysis">
                        <div class="m30b p30 p100r diagram-block">
                            <div class="m25b">
                                <div class="col-11 p0l m0">
                                    <p class="fs16 fw-bold m0">{{ trans('attributes.property.notes') }}</p>
                                </div>
                            </div>

                            <div class="col-12 p0 break-all">
                                @foreach($listRentRoll as $rentRoll)
                                    @if(isset($rentRoll['note']))
                                        <div class="m30b" id="attention-{{$rentRoll['id']}}">
                                            <h4>{{ DisplayNumberFloorAndRooms(BASEMENT_RENT_ROLL[$rentRoll['floor_code']] ?? $rentRoll['floor_code'], $rentRoll['room_code']) }}</h4>
                                            <p class="fs14 m13b">{{ $rentRoll['note'] }}</p>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="col-12 text-center text-lg-right p0 text-right group-button-top">
                        <button id="pre-print" type="button" class="btn w-auto custom-btn-success fs15 pre-print">{{ trans('attributes.balance.header.btn_preview') }}</button>
                    </div>
                </div>
            </div>
    </div>
    <div class="d-none">
        <input type="hidden" id="count-data" value="{{ $countData }}" disabled>
        <input type="hidden" id="count-data-no-empty" value="{{ $countDataNoEmpty }}" disabled>
        <input type="hidden" id="sum-contract-area" value="{{ $sumContractArea }}" disabled>
        <input type="hidden" id="sum-contract-area-no-empty" value="{{ $sumContractAreaNoEmpty }}" disabled>
    </div>

    @include('modal.delete.confirm_rent_roll')
    @include('backend.preview_print.rent_roll_print')
@endsection
@section('js')
    <script src="{{ asset('js/highcharts/modules/no-data-to-display.js') }}"></script>
    <script src="{{ asset('dist/js/rent-roll.min.js') }}"></script>
@endsection
