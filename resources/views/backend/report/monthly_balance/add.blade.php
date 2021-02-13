@extends('layout.home.master')
@section('content')
    <div class="content-wrapper">
        @include('partials.flash_messages')
        <form action="" id="form-data-monthly-balance-add" >
            <div class="container-fluid container-wrapper container-wrapper-add">
                <div id="main-info-assessment">
                    <div class="row m0 m30b">
                        <div class="col-12 text-center text-md-left p0">
                            <h3 class="m0">{{ __('attributes.monthly_balance.title') }}</h3>
                        </div>
                        <div class="col-12 p0 m10t media-575-p20l media-575-p20r">
                            <div class="row m0">
                                <div class="btn-group m15t">
                                    <button type="button" class="btn balance-custom-btn-secondary fw400 cursor-unset fs14 h41">{{ trans('attributes.property.house_name') }}</button>
                                    <button type="button" class="btn balance-custom-btn-default fw400 m15r cursor-unset fs14 h41">{{ $property['house_name'] }}</button>
                                </div>

                                <div class="btn-group dropdown-none-icon m15t">
                                    <button type="button" class="btn balance-custom-btn-secondary fw400 cursor-unset fs14 h41">{{ trans('attributes.property.status') }}</button>
                                    <button type="button" class="btn balance-custom-btn-default fw400 m15r cursor-unset fs14 h41">{{ STATUS_HOUSE[$property['status']] }}</button>
                                </div>
                                @if(in_array($currentUser->role, [BROKER, EXPERT]))
                                    <div class="btn-group dropdown-none-icon m15t">
                                        <button type="button" class="btn balance-custom-btn-secondary fw400 cursor-unset fs14 h41">{{ trans('attributes.register_info.item_block.label.proprietor_2') }}</button>
                                        <button type="button" class="btn balance-custom-btn-default fw400 m15r cursor-unset fs14 h41  min-w100">{{ $property['proprietor'] ?? 'ー' }}</button>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="has-error-monthly-balance m10t" >
                        <span class="error-number-one-byte text-danger" hidden>{{ __('attributes.monthly_balance.error_number_one_byte') }}</span>
                        <span class="error-number-and-dot-one-byte text-danger" hidden>{{ __('attributes.monthly_balance.error_number_and_dot_one_byte') }}</span>
                        <span class="error-limit text-danger" hidden>{{ __('attributes.monthly_balance.error_limit') }}</span>
                    </div>
                    <div class="w-100 m30b">
                        <div class="m0 diagram-analysis">
                            <div class="p30 diagram-block">
                                <div class="d-flex m30b m0l">
                                    <p class="fs16 fw-bold m0">{{ __('attributes.monthly_balance.added_item') }}</p>
                                </div>

                                <div class="row w-50 m0 p0">
                                    <div class="col-6 d-flex p0">
                                        @if(count(listDateYear()) != count($dateYear))
                                            <div class="w-60 col-12-sp p0 d-flex m5t">
                                                <span class="d-inline-block">{{ __('attributes.monthly_balance.year_of_registration') }}</span>
                                            </div>
                                            <div class="w-40 col-12-sp p0">
                                                <div class="w-100 m20r">
                                                    <div class="btn wrap-input-option w-100 p0 br4">

                                                            <select name="date_year_registration" class="date-year-registration option-paginate-1 btn form-control hp100 p3 fs14" required>
                                                                <option value="">---</option>
                                                                @foreach(listDateYear() as $key => $year)
                                                                    @if(!in_array($year, $dateYear))
                                                                        <option value="{{ (int)date('Y') - $key }}">{{ $year }}</option>
                                                                    @endif
                                                                @endforeach
                                                            </select>

                                                    </div>
                                                    <p class="error-message m0" data-error="date_year_registration"></p>
                                                </div>
                                            </div>
                                        @else
                                            <div class="w-40 col-12-sp p0 m5t">
                                                <span class="d-inline-block">{{ __('attributes.monthly_balance.year_of_registration') }}</span>
                                            </div>
                                            <div class="w-60 col-12-sp p0">
                                                <div class="w-100 m20r">
                                                    <div class="btn wrap-input-option w-100 p0 br4">
                                                        {{ __('attributes.monthly_balance.all_years_are_registered') }}
                                                    </div>
                                                    <p class="error-message m0" data-error="date_year_registration"></p>
                                                </div>
                                            </div>
                                        @endif
                                    </div>

                                    <div class="col-6 p0 text-right">
                                        <div class="col-12-sp p0 m5t">
                                            <span class="d-inline-block">{{ __('attributes.monthly_balance.first_month') }}</span>
                                            @if((int)$property['date_month_registration_revenue'] == DEC)
                                                {{ JAN . trans('attributes.common.month') . trans('attributes.common.end_of_period') . DEC . trans('attributes.common.month') }}
                                            @else
                                                {{ (int)$property['date_month_registration_revenue'] + FLAG_MIN_MONTH . trans('attributes.common.month') . trans('attributes.common.end_of_period') .
                                                (int)$property['date_month_registration_revenue'] . trans('attributes.common.month') }}
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <input type="hidden" value="{{$propertyId}}" class="property-id">
                                <div class="table-responsive fs14 m50t">
                                    <table id="table-property" class="table table-bordered table-striped border-0 m0 ">
                                        @php( $showInput0 = ($property['real_estate_type_id'] == FLAG_TEN || $property['real_estate_type_id'] == FLAG_NINE) )
                                        <tr class="table-head table-monthly-balance">
                                            <td class="border-0 sticky">
                                                <div class="w-auto">
                                                    <div class="d-flex m0 p0">
                                                        <div class="col-11 p0l">
                                                            <p class="fs16 m0">{{ __('attributes.property.operating_revenue') }}</p>
                                                        </div>
                                                    </div>
                                                    @if($showInput0)
                                                    <div class="m-100 m10t p0 fw-normal">
                                                        <div class="p0 d-flex align-items-center">
                                                            <span class="d-inline-block">{{ __('attributes.register_info.item_block.label.rent_income') }}<br>{{ __('attributes.register_info.item_block.label.rent_income_1') }}</span>
                                                        </div>
                                                    </div>
                                                    @endif

                                                    <div class="m-100 m10t p0 p7t p7b fw-normal">
                                                        <div class="p0 d-flex align-items-center">
                                                            <span class="d-inline-block">{{ __('attributes.register_info.item_block.label.rent_income_2') }}</span>
                                                        </div>
                                                    </div>

                                                    <div class="m-100 m10t p0 p7t p7b fw-normal">
                                                        <div class="p0 d-flex align-items-center">
                                                            <span class="d-inline-block">{{ __('attributes.register_info.item_block.label.service_revenue') }}</span>
                                                        </div>
                                                    </div>

                                                    <div class="m-100 m10t p0 p7t p7b fw-normal">
                                                        <div class="p0 d-flex align-items-center">
                                                            <span class="d-inline-block">{{ __('attributes.register_info.item_block.label.utilities_revenue') }}</span>
                                                        </div>
                                                    </div>

                                                    <div class="m-100 m10t p0 p7t p7b fw-normal">
                                                        <div class="p0 d-flex align-items-center">
                                                            <span class="d-inline-block">{{ __('attributes.register_info.item_block.label.parking_lot_revenue') }}</span>
                                                        </div>
                                                    </div>

                                                    <div class="m-100 m10t p0 p7t p7b fw-normal">
                                                        <div class="p0 d-flex align-items-center">
                                                            <span class="d-inline-block">{{ __('attributes.register_info.item_block.label.key_money_royalties') }}</span>
                                                        </div>
                                                    </div>

                                                    <div class="m-100 m10t p0 p7t p7b fw-normal">
                                                        <div class="p0 d-flex align-items-center">
                                                            <span class="d-inline-block">{{ __('attributes.register_info.item_block.label.renewal_fee') }}</span>
                                                        </div>
                                                    </div>

                                                    <div class="m-100 m10t p0 p7t p7b fw-normal">
                                                        <div class="p0 d-flex align-items-center">
                                                            <span class="d-inline-block">{{ __('attributes.register_info.item_block.label.other_income') }}</span>
                                                        </div>
                                                    </div>

                                                    <div class="m-100 m10t p0 p7t p7b fw-normal">
                                                        <div class="p0 d-flex align-items-center">
                                                            <span class="d-inline-block">{{ __('attributes.register_info.item_block.label.etc') }}</span>
                                                        </div>
                                                    </div>

                                                    <div class="m-100 m10t p0 p7t p7b fw-normal">
                                                        <div class="p0 d-flex align-items-center">
                                                            <span class="d-inline-block">{{ __('attributes.register_info.item_block.label.meter') }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            @foreach(setArrayDateMonth((int)$property['date_month_registration_revenue']) as $key => $month)
                                                @switch($key)
                                                    @case(JAN)
                                                        <td class="border-top-0 border-bottom-0 border-left-0 td-monthly-balance td-{{ $month }}">
                                                            <div class="w120">
                                                            <div class="d-flex m0 m10b p0">
                                                                <div class="col-11 p0l">
                                                                    <input type="hidden" value="{{ $month }}" class="date-month-registration-{{ $month }}">
                                                                    <p class="fs16 m0 text-center">{{ $month }}{{ __('attributes.common.month') }}</p>
                                                                </div>
                                                                <div class="col-1 m3l p0 d-flex align-items-end justify-content-end ">
                                                                    <p class="fs12 fw-normal m0">({{ __('attributes.common.yen') }})</p>
                                                                </div>
                                                            </div>
                                                            @if($showInput0)
                                                            <div class="m-100 p0 fw-normal">
                                                                <div class="p0">
                                                                    <input type="text" name="revenue_land_taxes_{{ $month }}" value="0" class="operating-revenue-{{ $month }} revenue-land-taxes-{{ $month }} convert-data form-control m0 p13 p8l p8r h-auto fs14 text-right" />
                                                                </div>
                                                            </div>
                                                            @endif

                                                            <div class="m-100 p0 @if($showInput0) p10t @endif fw-normal">
                                                                <div class="p0">
                                                                    <input type="text" name="revenue_room_rentals_{{ $month }}" value="0" class="operating-revenue-{{ $month }} revenue-room-rentals-{{ $month }} convert-data form-control m0 p13 p8l p8r h-auto fs14 text-right" />
                                                                </div>
                                                            </div>
                                                            <div class="m-100 p0 p10t fw-normal">
                                                                <div class="p0">
                                                                    <input type="text" name="revenue_service_charges_{{ $month }}" value="0" class="operating-revenue-{{ $month }} revenue-service-charges-{{ $month }} convert-data form-control m0 p13 p8l p8r h-auto fs14 text-right" />
                                                                </div>
                                                            </div>
                                                            <div class="m-100 p0 p10t fw-normal">
                                                                <div class="p0">
                                                                    <input type="text" name="revenue_utilities_{{ $month }}" value="0" class="operating-revenue-{{ $month }} revenue-utilities-{{ $month }} convert-data form-control m0 p13 p8l p8r h-auto fs14 text-right" />
                                                                </div>
                                                            </div>
                                                            <div class="m-100 p0 p10t fw-normal">
                                                                <div class="p0">
                                                                    <input type="text" name="revenue_car_deposits_{{ $month }}" value="0" class="operating-revenue-{{ $month }} revenue-car-deposits-{{ $month }} convert-data form-control m0 p13 p8l p8r h-auto fs14 text-right" />
                                                                </div>
                                                            </div>
                                                            <div class="m-100 p0 p10t fw-normal">
                                                                <div class="p0">
                                                                    <input type="text" name="turnover_revenue_{{ $month }}" value="0" class="operating-revenue-{{ $month }} turnover-revenue-{{ $month }} convert-data form-control m0 p13 p8l p8r h-auto fs14 text-right" />
                                                                </div>
                                                            </div>
                                                            <div class="m-100 p0 p10t fw-normal">
                                                                <div class="p0">
                                                                    <input type="text" name="revenue_contract_update_fee_{{ $month }}" value="0" class="operating-revenue-{{ $month }} revenue-contract-update-fee-{{ $month }} convert-data form-control m0 p13 p8l p8r h-auto fs14 text-right" />
                                                                </div>
                                                            </div>
                                                            <div class="m-100 p0 p10t fw-normal">
                                                                <div class="p0">
                                                                    <input type="text" name="revenue_other_{{ $month }}" value="0" class="operating-revenue-{{ $month }} revenue-other-{{ $month }} convert-data form-control m0 p13 p8l p8r h-auto fs14 text-right" />
                                                                </div>
                                                            </div>
                                                            <div class="m-100 p0 p10t fw-normal">
                                                                <div class="p0">
                                                                    <input type="text" name="bad_debt_{{ $month }}" value="0" class="operating-revenue-{{ $month }} bad-debt-{{ $month }} convert-data form-control m0 p13 p8l p8r h-auto fs14 text-right" />
                                                                </div>
                                                            </div>
                                                            <div class="m-100 p0 p10t fw-normal">
                                                                <div class="p0">
                                                                    <input type="text" name="total_operating_revenue_{{ $month }}" value="0" class="total-operating-revenue-{{ $month }} convert-data disable-field form-control m0 p13 p8l p8r h-auto fs14 text-right" readonly/>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        </td>
                                                        @break
                                                    @case(FEB)
                                                    @case(MAR)
                                                    @case(APR)
                                                    @case(MAY)
                                                    @case(JUN)
                                                    @case(JULY)
                                                    @case(AUG)
                                                    @case(SEP)
                                                    @case(OCT)
                                                    @case(NOV)
                                                        <td class="border-top-0 border-bottom-0 td-monthly-balance td-{{$month}}">
                                                            <div class="w120">
                                                            <div class="d-flex m0 m10b p0">
                                                                <div class="col-11 p0l">
                                                                    <input type="hidden" value="{{$month}}" class="date-month-registration-{{$month}}">
                                                                    <p class="fs16 m0 text-center">{{ $month}}{{ __('attributes.common.month') }}</p>
                                                                </div>
                                                                <div class="col-1 m3l p0 d-flex align-items-end justify-content-end ">
                                                                    <p class="fs12 fw-normal m0">({{ __('attributes.common.yen') }})</p>
                                                                </div>
                                                            </div>
                                                            @if($showInput0)
                                                            <div class="m-100 p0 fw-normal">
                                                                <div class="p0">
                                                                    <input type="text" name="revenue_land_taxes_{{ $month }}" value="0" class="operating-revenue-{{ $month }} revenue-land-taxes-{{ $month }} convert-data form-control m0 p13 p8l p8r h-auto fs14 text-right" />
                                                                </div>
                                                            </div>
                                                            @endif

                                                            <div class="m-100 p0 @if($showInput0) p10t @endif fw-normal">
                                                                <div class="p0">
                                                                    <input type="text" name="revenue_room_rentals_{{$month}}" value="0" class="operating-revenue-{{$month}} revenue-room-rentals-{{$month}} convert-data form-control m0 p13 p8l p8r h-auto fs14 text-right" />
                                                                </div>
                                                            </div>
                                                            <div class="m-100 p0 p10t fw-normal">
                                                                <div class="p0">
                                                                    <input type="text" name="revenue_service_charges_{{$month}}" value="0" class="operating-revenue-{{$month}} revenue-service-charges-{{$month}} convert-data form-control m0 p13 p8l p8r h-auto fs14 text-right" />
                                                                </div>
                                                            </div>
                                                            <div class="m-100 p0 p10t fw-normal">
                                                                <div class="p0">
                                                                    <input type="text" name="revenue_utilities_{{$month}}" value="0" class="operating-revenue-{{$month}} revenue-utilities-{{$month}} convert-data form-control m0 p13 p8l p8r h-auto fs14 text-right" />
                                                                </div>
                                                            </div>
                                                            <div class="m-100 p0 p10t fw-normal">
                                                                <div class="p0">
                                                                    <input type="text" name="revenue_car_deposits_{{$month}}" value="0" class="operating-revenue-{{$month}} revenue-car-deposits-{{$month}} convert-data form-control m0 p13 p8l p8r h-auto fs14 text-right" />
                                                                </div>
                                                            </div>
                                                            <div class="m-100 p0 p10t fw-normal">
                                                                <div class="p0">
                                                                    <input type="text" name="turnover_revenue_{{$month}}" value="0" class="operating-revenue-{{$month}} turnover-revenue-{{$month}} convert-data form-control m0 p13 p8l p8r h-auto fs14 text-right" />
                                                                </div>
                                                            </div>
                                                            <div class="m-100 p0 p10t fw-normal">
                                                                <div class="p0">
                                                                    <input type="text" name="revenue_contract_update_fee_{{$month}}" value="0" class="operating-revenue-{{$month}} revenue-contract-update-fee-{{$month}} convert-data form-control m0 p13 p8l p8r h-auto fs14 text-right" />
                                                                </div>
                                                            </div>
                                                            <div class="m-100 p0 p10t fw-normal">
                                                                <div class="p0">
                                                                    <input type="text" name="revenue_other_{{$month}}" value="0" class="operating-revenue-{{$month}} revenue-other-{{$month}} convert-data form-control m0 p13 p8l p8r h-auto fs14 text-right" />
                                                                </div>
                                                            </div>
                                                            <div class="m-100 p0 p10t fw-normal">
                                                                <div class="p0">
                                                                    <input type="text" name="bad_debt_{{$month}}" value="0" class="operating-revenue-{{$month}} bad-debt-{{$month}} convert-data form-control m0 p13 p8l p8r h-auto fs14 text-right" />
                                                                </div>
                                                            </div>
                                                            <div class="m-100 p0 p10t fw-normal">
                                                                <div class="p0">
                                                                    <input type="text" name="total_operating_revenue_{{$month}}" value="0" class="total-operating-revenue-{{$month}} convert-data disable-field form-control m0 p13 p8l p8r h-auto fs14 text-right" readonly/>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        </td>
                                                        @break
                                                    @default
                                                        <td class="border-top-0 border-bottom-0 td-monthly-balance border-right-0 td-{{ $month }}">
                                                        <div class="w120">
                                                            <div class="d-flex m0 m10b p0">
                                                                <div class="col-11 p0l">
                                                                    <input type="hidden" value="{{$month}}" class="date-month-registration-{{$month}}">
                                                                    <p class="fs16 m0 text-center">{{ $month }}{{ __('attributes.common.month') }}</p>
                                                                </div>
                                                                <div class="col-1 m3l p0 d-flex align-items-end justify-content-end ">
                                                                    <p class="fs12 fw-normal m0">({{ __('attributes.common.yen') }})</p>
                                                                </div>
                                                            </div>
                                                            @if($showInput0)
                                                            <div class="m-100 p0 fw-normal">
                                                                <div class="p0">
                                                                    <input type="text" name="revenue_land_taxes_{{ $month }}" value="0" class="operating-revenue-{{ $month }} revenue-land-taxes-{{ $month }} convert-data form-control m0 p13 p8l p8r h-auto fs14 text-right" />
                                                                </div>
                                                            </div>
                                                            @endif

                                                            <div class="m-100 p0 @if($showInput0) p10t @endif fw-normal">
                                                                <div class="p0">
                                                                    <input type="text" name="revenue_room_rentals_{{$month}}" value="0" class="operating-revenue-{{$month}} revenue-room-rentals-{{$month}} convert-data form-control m0 p13 p8l p8r h-auto fs14 text-right" />
                                                                </div>
                                                            </div>
                                                            <div class="m-100 p0 p10t fw-normal">
                                                                <div class="p0">
                                                                    <input type="text" name="revenue_service_charges_{{$month}}" value="0" class="operating-revenue-{{$month}} revenue-service-charges-{{$month}} convert-data form-control m0 p13 p8l p8r h-auto fs14 text-right" />
                                                                </div>
                                                            </div>
                                                            <div class="m-100 p0 p10t fw-normal">
                                                                <div class="p0">
                                                                    <input type="text" name="revenue_utilities_{{$month}}" value="0" class="operating-revenue-{{$month}} revenue-utilities-{{$month}} convert-data form-control m0 p13 p8l p8r h-auto fs14 text-right" />
                                                                </div>
                                                            </div>
                                                            <div class="m-100 p0 p10t fw-normal">
                                                                <div class="p0">
                                                                    <input type="text" name="revenue_car_deposits_{{$month}}" value="0" class="operating-revenue-{{$month}} revenue-car-deposits-{{$month}} convert-data form-control m0 p13 p8l p8r h-auto fs14 text-right" />
                                                                </div>
                                                            </div>
                                                            <div class="m-100 p0 p10t fw-normal">
                                                                <div class="p0">
                                                                    <input type="text" name="turnover_revenue_{{$month}}" value="0" class="operating-revenue-{{$month}} turnover-revenue-{{$month}} convert-data form-control m0 p13 p8l p8r h-auto fs14 text-right" />
                                                                </div>
                                                            </div>
                                                            <div class="m-100 p0 p10t fw-normal">
                                                                <div class="p0">
                                                                    <input type="text" name="revenue_contract_update_fee_{{$month}}" value="0" class="operating-revenue-{{$month}} revenue-contract-update-fee-{{$month}} convert-data form-control m0 p13 p8l p8r h-auto fs14 text-right" />
                                                                </div>
                                                            </div>
                                                            <div class="m-100 p0 p10t fw-normal">
                                                                <div class="p0">
                                                                    <input type="text" name="revenue_other_{{$month}}" value="0" class="operating-revenue-{{$month}} revenue-other-{{$month}} convert-data form-control m0 p13 p8l p8r h-auto fs14 text-right" />
                                                                </div>
                                                            </div>
                                                            <div class="m-100 p0 p10t fw-normal">
                                                                <div class="p0">
                                                                    <input type="text" name="bad_debt_{{$month}}" value="0" class="operating-revenue-{{$month}} bad-debt-{{$month}} convert-data form-control m0 p13 p8l p8r h-auto fs14 text-right" />
                                                                </div>
                                                            </div>
                                                            <div class="m-100 p0 p10t fw-normal">
                                                                <div class="p0">
                                                                    <input type="text" name="total_operating_revenue_{{$month}}" value="0" class="total-operating-revenue-{{$month}} convert-data disable-field form-control m0 p13 p8l p8r h-auto fs14 text-right" readonly/>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                        @break
                                                @endswitch
                                            @endforeach
                                        </tr>

                                        <tr class="table-head table-monthly-balance">
                                            <td class="border-bottom-0 border-left-0 border-right-0 sticky">
                                                <div class="w-auto">
                                                    <div class="d-flex m0 p0">
                                                        <div class="col-11 p0l">
                                                            <p class="fs16 m0">{{ __('attributes.property.operating_fee') }}</p>
                                                        </div>
                                                    </div>

                                                    <div class="m-100 m10t p0 p7t p7b fw-normal">
                                                        <div class="col-5 col-12-sp p0 d-flex align-items-center">
                                                            <span class="d-inline-block">{{ __('attributes.register_info.item_block.label.management_fee') }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="m-100 m10t p0 p7t p7b fw-normal">
                                                        <div class="p0 d-flex align-items-center">
                                                            <span class="d-inline-block">{{ __('attributes.register_info.item_block.label.utilities_expenses') }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="m-100 m10t p0 p7t p7b fw-normal">
                                                        <div class="p0 d-flex align-items-center">
                                                            <span class="d-inline-block">{{ __('attributes.register_info.item_block.label.repair_fee') }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="m-100 m10t p0 p7t p7b fw-normal">
                                                        <div class="p0 d-flex align-items-center">
                                                            <span class="d-inline-block">{{ __('attributes.register_info.item_block.label.intact_reply_fee') }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="m-100 m10t p0 fw-normal">
                                                        <div class="p0 d-flex align-items-center">
                                                            <span class="d-inline-block">{{ __('attributes.balance.body.property') }}<br />{{ __('attributes.balance.body.management_fee') }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="m-100 m5t p0 p7t p7b fw-normal">
                                                        <div class="p0 d-flex align-items-center">
                                                            <span class="d-inline-block">{{ __('attributes.register_info.item_block.label.tenant_recruitment_fee') }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="m-100 m10t p0 p7t p7b fw-normal">
                                                        <div class="p0 d-flex align-items-center">
                                                            <span class="d-inline-block">{{ __('attributes.register_info.item_block.label.taxes_dues') }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="m-100 m10t p0 p7t p7b fw-normal">
                                                        <div class="p0 d-flex align-items-center">
                                                            <span class="d-inline-block">{{ __('attributes.register_info.item_block.label.insurance_premium') }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="m-100 m10t p0 p7t p7b fw-normal">
                                                        <div class="p0 d-flex align-items-center">
                                                            <span class="d-inline-block">{{ __('attributes.register_info.item_block.label.land_payment') }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="m-100 m10t p0 p7t p7b fw-normal">
                                                        <div class="p0 d-flex align-items-center">
                                                            <span class="d-inline-block">{{ __('attributes.register_info.item_block.label.other_expenses') }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="m-100 m10t p0 p7t p7b fw-normal">
                                                        <div class="p0 d-flex align-items-center">
                                                            <span class="d-inline-block">{{ __('attributes.register_info.item_block.label.meter') }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            @foreach(setArrayDateMonth((int)$property['date_month_registration_revenue']) as $key => $month)
                                                @switch($key)
                                                    @case(JAN)
                                                        <td class="border-bottom-0 border-left-0 td-monthly-balance td-{{ $month }}">
                                                        <div class="w120">
                                                            <div class="d-flex m5t m10b p0">
                                                                <div class="col-12 m3l p0 d-flex align-items-end justify-content-end ">
                                                                    <p class="fs12 fw-normal m0">({{ __('attributes.common.yen') }})</p>
                                                                </div>
                                                            </div>

                                                            <div class="m-100 p0 fw-normal">
                                                                <div class="p0">
                                                                    <input type="text" name="maintenance_management_fee_{{ $month }}" value="0" class="operating-fee-{{$month}} maintenance-management-fee-{{$month}} convert-data form-control m0 p13 p8l p8r h-auto fs14 text-right" />
                                                                </div>
                                                            </div>
                                                            <div class="m-100 p0 p10t fw-normal">
                                                                <div class="p0">
                                                                    <input type="text" name="electricity_gas_charges_{{ $month }}" value="0" class="operating-fee-{{$month}} electricity-gas-charges-{{$month}} convert-data form-control m0 p13 p8l p8r h-auto fs14 text-right" />
                                                                </div>
                                                            </div>
                                                            <div class="m-100 p0 p10t fw-normal">
                                                                <div class="p0">
                                                                    <input type="text" name="repair_fee_{{ $month }}" value="0" class="operating-fee-{{$month}} repair-fee-{{$month}} convert-data form-control m0 p13 p8l p8r h-auto fs14 text-right" />
                                                                </div>
                                                            </div>
                                                            <div class="m-100 p0 p10t fw-normal">
                                                                <div class="p0">
                                                                    <input type="text" name="recovery_costs_{{ $month }}" value="0" class="operating-fee-{{$month}} recovery-costs-{{$month}} convert-data form-control m0 p13 p8l p8r h-auto fs14 text-right" />
                                                                </div>
                                                            </div>
                                                            <div class="m-100 p0 p10t fw-normal">
                                                                <div class="p0">
                                                                    <input type="text" name="property_management_fee_{{ $month }}" value="0" class="operating-fee-{{$month}} property-management-fee-{{$month}} convert-data form-control m0 p13 p8l p8r h-auto fs14 text-right" />
                                                                </div>
                                                            </div>
                                                            <div class="m-100 p0 p10t fw-normal">
                                                                <div class="p0">
                                                                    <input type="text" name="find_tenant_fee_{{ $month }}" value="0" class="operating-fee-{{$month}} find-tenant-fee-{{$month}} convert-data form-control m0 p13 p8l p8r h-auto fs14 text-right" />
                                                                </div>
                                                            </div>
                                                            <div class="m-100 p0 p10t fw-normal">
                                                                <div class="p0">
                                                                    <input type="text" name="tax_{{ $month }}" value="0" class="operating-fee-{{$month}} tax-{{$month}} convert-data form-control m0 p13 p8l p8r h-auto fs14 text-right" />
                                                                </div>
                                                            </div>
                                                            <div class="m-100 p0 p10t fw-normal">
                                                                <div class="p0">
                                                                    <input type="text" name="loss_insurance_{{ $month }}" value="0" class="operating-fee-{{$month}} loss-insurance-{{$month}} convert-data form-control m0 p13 p8l p8r h-auto fs14 text-right" />
                                                                </div>
                                                            </div>
                                                            <div class="m-100 p0 p10t fw-normal">
                                                                <div class="p0">
                                                                    <input type="text" name="land_rental_fee_{{ $month }}" value="0" class="operating-fee-{{$month}} land-rental-fee-{{$month}} convert-data form-control m0 p13 p8l p8r h-auto fs14 text-right" />
                                                                </div>
                                                            </div>
                                                            <div class="m-100 p0 p10t fw-normal">
                                                                <div class="p0">
                                                                    <input type="text" name="other_costs_{{ $month }}" value="0" class="operating-fee-{{$month}} other-costs-{{$month}} convert-data form-control m0 p13 p8l p8r h-auto fs14 text-right" />
                                                                </div>
                                                            </div>
                                                            <div class="m-100 p0 p10t fw-normal">
                                                                <div class="p0">
                                                                    <input type="text" name="total_operating_costs_{{ $month }}" value="0" class="total-operating-costs-{{$month}} convert-data disable-field form-control m0 p13 p8l p8r h-auto fs14 text-right" readonly/>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                        @break
                                                    @case(FEB)
                                                    @case(MAR)
                                                    @case(APR)
                                                    @case(MAY)
                                                    @case(JUN)
                                                    @case(JULY)
                                                    @case(AUG)
                                                    @case(SEP)
                                                    @case(OCT)
                                                    @case(NOV)
                                                        <td class="border-bottom-0 td-monthly-balance td-{{$month}}">
                                                            <div class="w120">
                                                                <div class="d-flex m5t m10b p0">
                                                                    <div class="col-12 m3l p0 d-flex align-items-end justify-content-end ">
                                                                        <p class="fs12 fw-normal m0">({{ __('attributes.common.yen') }})</p>
                                                                    </div>
                                                                </div>

                                                                <div class="m-100 p0 fw-normal">
                                                                    <div class="p0">
                                                                        <input type="text" name="maintenance_management_fee_{{ $month }}" value="0" class="operating-fee-{{$month}} maintenance-management-fee-{{$month}} convert-data form-control m0 p13 p8l p8r h-auto fs14 text-right" />
                                                                    </div>
                                                                </div>
                                                                <div class="m-100 p0 p10t fw-normal">
                                                                    <div class="p0">
                                                                        <input type="text" name="electricity_gas_charges_{{ $month }}" value="0" class="operating-fee-{{$month}} electricity-gas-charges-{{$month}} convert-data form-control m0 p13 p8l p8r h-auto fs14 text-right" />
                                                                    </div>
                                                                </div>
                                                                <div class="m-100 p0 p10t fw-normal">
                                                                    <div class="p0">
                                                                        <input type="text" name="repair_fee_{{ $month }}" value="0" class="operating-fee-{{$month}} repair-fee-{{$month}} convert-data form-control m0 p13 p8l p8r h-auto fs14 text-right" />
                                                                    </div>
                                                                </div>
                                                                <div class="m-100 p0 p10t fw-normal">
                                                                    <div class="p0">
                                                                        <input type="text" name="recovery_costs_{{ $month }}" value="0" class="operating-fee-{{$month}} recovery-costs-{{$month}} convert-data form-control m0 p13 p8l p8r h-auto fs14 text-right" />
                                                                    </div>
                                                                </div>
                                                                <div class="m-100 p0 p10t fw-normal">
                                                                    <div class="p0">
                                                                        <input type="text" name="property_management_fee_{{ $month }}" value="0" class="operating-fee-{{$month}} property-management-fee-{{$month}} convert-data form-control m0 p13 p8l p8r h-auto fs14 text-right" />
                                                                    </div>
                                                                </div>
                                                                <div class="m-100 p0 p10t fw-normal">
                                                                    <div class="p0">
                                                                        <input type="text" name="find_tenant_fee_{{ $month }}" value="0" class="operating-fee-{{$month}} find-tenant-fee-{{$month}} convert-data form-control m0 p13 p8l p8r h-auto fs14 text-right" />
                                                                    </div>
                                                                </div>
                                                                <div class="m-100 p0 p10t fw-normal">
                                                                    <div class="p0">
                                                                        <input type="text" name="tax_{{ $month }}" value="0" class="operating-fee-{{$month}} tax-{{$month}} convert-data form-control m0 p13 p8l p8r h-auto fs14 text-right" />
                                                                    </div>
                                                                </div>
                                                                <div class="m-100 p0 p10t fw-normal">
                                                                    <div class="p0">
                                                                        <input type="text" name="loss_insurance_{{ $month }}" value="0" class="operating-fee-{{$month}} loss-insurance-{{$month}} convert-data form-control m0 p13 p8l p8r h-auto fs14 text-right" />
                                                                    </div>
                                                                </div>
                                                                <div class="m-100 p0 p10t fw-normal">
                                                                    <div class="p0">
                                                                        <input type="text" name="land_rental_fee_{{ $month }}" value="0" class="operating-fee-{{$month}} land-rental-fee-{{$month}} convert-data form-control m0 p13 p8l p8r h-auto fs14 text-right" />
                                                                    </div>
                                                                </div>
                                                                <div class="m-100 p0 p10t fw-normal">
                                                                    <div class="p0">
                                                                        <input type="text" name="other_costs_{{ $month }}" value="0" class="operating-fee-{{$month}} other-costs-{{$month}} convert-data form-control m0 p13 p8l p8r h-auto fs14 text-right" />
                                                                    </div>
                                                                </div>
                                                                <div class="m-100 p0 p10t fw-normal">
                                                                    <div class="p0">
                                                                        <input type="text" name="total_operating_costs_{{ $month }}" value="0" class="total-operating-costs-{{$month}} convert-data disable-field form-control m0 p13 p8l p8r h-auto fs14 text-right" readonly/>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        @break
                                                    @default
                                                        <td class="border-bottom-0 border-right-0 td-monthly-balance td-{{ $month }}">
                                                            <div class="w120">
                                                                <div class="d-flex m5t m10b p0">
                                                                    <div class="col-12 m3l p0 d-flex align-items-end justify-content-end ">
                                                                        <p class="fs12 fw-normal m0">({{ __('attributes.common.yen') }})</p>
                                                                    </div>
                                                                </div>

                                                                <div class="m-100 p0 fw-normal">
                                                                    <div class="p0">
                                                                        <input type="text" name="maintenance_management_fee_{{ $month }}" value="0" class="operating-fee-{{$month}} maintenance-management-fee-{{$month}} convert-data form-control m0 p13 p8l p8r h-auto fs14 text-right" />
                                                                    </div>
                                                                </div>
                                                                <div class="m-100 p0 p10t fw-normal">
                                                                    <div class="p0">
                                                                        <input type="text" name="electricity_gas_charges_{{ $month }}" value="0" class="operating-fee-{{$month}} electricity-gas-charges-{{$month}} convert-data form-control m0 p13 p8l p8r h-auto fs14 text-right" />
                                                                    </div>
                                                                </div>
                                                                <div class="m-100 p0 p10t fw-normal">
                                                                    <div class="p0">
                                                                        <input type="text" name="repair_fee_{{ $month }}" value="0" class="operating-fee-{{$month}} repair-fee-{{$month}} convert-data form-control m0 p13 p8l p8r h-auto fs14 text-right" />
                                                                    </div>
                                                                </div>
                                                                <div class="m-100 p0 p10t fw-normal">
                                                                    <div class="p0">
                                                                        <input type="text" name="recovery_costs_{{ $month }}" value="0" class="operating-fee-{{$month}} recovery-costs-{{$month}} convert-data form-control m0 p13 p8l p8r h-auto fs14 text-right" />
                                                                    </div>
                                                                </div>
                                                                <div class="m-100 p0 p10t fw-normal">
                                                                    <div class="p0">
                                                                        <input type="text" name="property_management_fee_{{ $month }}" value="0" class="operating-fee-{{$month}} property-management-fee-{{$month}} convert-data form-control m0 p13 p8l p8r h-auto fs14 text-right" />
                                                                    </div>
                                                                </div>
                                                                <div class="m-100 p0 p10t fw-normal">
                                                                    <div class="p0">
                                                                        <input type="text" name="find_tenant_fee_{{ $month }}" value="0" class="operating-fee-{{$month}} find-tenant-fee-{{$month}} convert-data form-control m0 p13 p8l p8r h-auto fs14 text-right" />
                                                                    </div>
                                                                </div>
                                                                <div class="m-100 p0 p10t fw-normal">
                                                                    <div class="p0">
                                                                        <input type="text" name="tax_{{ $month }}" value="0" class="operating-fee-{{$month}} tax-{{$month}} convert-data form-control m0 p13 p8l p8r h-auto fs14 text-right" />
                                                                    </div>
                                                                </div>
                                                                <div class="m-100 p0 p10t fw-normal">
                                                                    <div class="p0">
                                                                        <input type="text" name="loss_insurance_{{ $month }}" value="0" class="operating-fee-{{$month}} loss-insurance-{{$month}} convert-data form-control m0 p13 p8l p8r h-auto fs14 text-right" />
                                                                    </div>
                                                                </div>
                                                                <div class="m-100 p0 p10t fw-normal">
                                                                    <div class="p0">
                                                                        <input type="text" name="land_rental_fee_{{ $month }}" value="0" class="operating-fee-{{$month}} land-rental-fee-{{$month}} convert-data form-control m0 p13 p8l p8r h-auto fs14 text-right" />
                                                                    </div>
                                                                </div>
                                                                <div class="m-100 p0 p10t fw-normal">
                                                                    <div class="p0">
                                                                        <input type="text" name="other_costs_{{ $month }}" value="0" class="operating-fee-{{$month}} other-costs-{{$month}} convert-data form-control m0 p13 p8l p8r h-auto fs14 text-right" />
                                                                    </div>
                                                                </div>
                                                                <div class="m-100 p0 p10t fw-normal">
                                                                    <div class="p0">
                                                                        <input type="text" name="total_operating_costs_{{ $month }}" value="0" class="total-operating-costs-{{$month}} convert-data disable-field form-control m0 p13 p8l p8r h-auto fs14 text-right" readonly/>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        @break
                                                @endswitch
                                            @endforeach
                                        </tr>

                                        <tr class="table-head table-monthly-balance">
                                            <td class="border-bottom-0 border-left-0 border-right-0 sticky">
                                                <div class="w-auto">

                                                    <div class="m-100 p0 p7t p7b fw-normal">
                                                        <div class="col-5 col-12-sp p0 d-flex align-items-center">
                                                            <span class="d-inline-block">{{ __('attributes.register_info.item_block.label.operating_balance') }}</span>
                                                        </div>
                                                    </div>

                                                </div>
                                            </td>
                                            @foreach(setArrayDateMonth((int)$property['date_month_registration_revenue']) as $key => $month)
                                                @switch($key)
                                                    @case(JAN)
                                                        <td class="border-bottom-0 border-left-0 td-monthly-balance td-{{ $month }}">
                                                            <div class="w120">

                                                                <div class="m-100 p0 fw-normal">
                                                                    <div class="p0">
                                                                        <input type="text" name="operating_expenses" value="0" class="operating-expenses-{{$month}} convert-data disable-field form-control m0 p13 p8l p8r h-auto fs14 text-right" readonly/>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </td>
                                                        @break
                                                    @case(FEB)
                                                    @case(MAR)
                                                    @case(APR)
                                                    @case(MAY)
                                                    @case(JUN)
                                                    @case(JULY)
                                                    @case(AUG)
                                                    @case(SEP)
                                                    @case(OCT)
                                                    @case(NOV)
                                                        <td class="border-bottom-0 td-monthly-balance td-{{$month}}">
                                                            <div class="w120">

                                                                <div class="m-100 p0 fw-normal">
                                                                    <div class="p0">
                                                                        <input type="text" name="operating_expenses" value="0" class="operating-expenses-{{$month}} convert-data disable-field form-control m0 p13 p8l p8r h-auto fs14 text-right" readonly/>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </td>
                                                        @break
                                                    @default
                                                        <td class="border-bottom-0 border-right-0 td-monthly-balance td-{{$month}}">
                                                            <div class="w120">

                                                                <div class="m-100 p0 fw-normal">
                                                                    <div class="p0">
                                                                        <input type="text" name="operating_expenses" value="0" class="operating-expenses-{{$month}} convert-data disable-field form-control m0 p13 p8l p8r h-auto fs14 text-right" readonly/>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </td>
                                                        @break
                                                @endswitch
                                            @endforeach
                                        </tr>

                                        <tr class="table-head table-monthly-balance">
                                            <td class="border-bottom-0 border-left-0 border-right-0 sticky">
                                                <div class="w-auto">

                                                    <div class="m-100 p0 p7t p7b fw-normal">
                                                        <div class="col-5 col-12-sp p0 d-flex align-items-center">
                                                            <span class="d-inline-block">{{ __('attributes.register_info.item_block.label.crop_yield') }}</span>
                                                        </div>
                                                    </div>

                                                </div>
                                            </td>

                                            @foreach(setArrayDateMonth((int)$property['date_month_registration_revenue']) as $key => $month)
                                                @switch($key)
                                                    @case(JAN)
                                                        <td class="border-bottom-0 border-left-0 td-monthly-balance td-{{ $month }}">
                                                            <div class="w120">

                                                                <div class="m-100 p0 fw-normal">
                                                                    <div class="p0 centered">
                                                                        <input type="text" name="rental_percentage_{{ $month }}" value="0.0" class="rental-percentage-{{$month}} convert-number-single-decimal form-control m0 p13 p8l p8r h-auto fs14 text-right" />
                                                                        <span class="m5l">{{ __('attributes.common.percent') }}</span>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </td>
                                                        @break
                                                    @case(FEB)
                                                    @case(MAR)
                                                    @case(APR)
                                                    @case(MAY)
                                                    @case(JUN)
                                                    @case(JULY)
                                                    @case(AUG)
                                                    @case(SEP)
                                                    @case(OCT)
                                                    @case(NOV)
                                                        <td class="border-bottom-0 td-monthly-balance td-{{$month}}">
                                                            <div class="w120">

                                                                <div class="m-100 p0 fw-normal">
                                                                    <div class="p0 centered">
                                                                        <input type="text" name="rental_percentage_{{ $month }}" value="0.0" class="rental-percentage-{{$month}} convert-number-single-decimal form-control m0 p13 p8l p8r h-auto fs14 text-right" />
                                                                        <span class="m5l">{{ __('attributes.common.percent') }}</span>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </td>
                                                        @break
                                                    @default
                                                        <td class="border-bottom-0 border-right-0 td-monthly-balance td-{{$month}}">
                                                            <div class="w120">

                                                                <div class="m-100 p0 fw-normal">
                                                                    <div class="p0 centered">
                                                                        <input type="text" name="rental_percentage_{{ $month }}" value="0.0" class="rental-percentage-{{$month}} convert-number-single-decimal form-control m0 p13 p8l p8r h-auto fs14 text-right" />
                                                                        <span class="m5l">{{ __('attributes.common.percent') }}</span>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </td>
                                                        @break
                                                @endswitch
                                            @endforeach
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex col-12 text-center text-lg-right m0 p0">
                        <div class="w-auto text-center text-md-right m20r m p0">
                            <a href="{{ buttonBackPages(request()->all(), $propertyId) }}" class="btn custom-btn-default fs15 sort-property m0 p18l p18r w-auto">{{ __('attributes.button.btn_cancel') }}</a>
                        </div>
                        @if(count(listDateYear()) != count($dateYear))
                            <div class="w-auto text-center text-md-right m0 p0">
                                <button type="button" class="btn-monthly-balance-add btn custom-btn-primary fs15 sort-property m0 p18l p18r w-auto">{{ __('attributes.rent_roll.btn_save') }}</button>
                            </div>
                        @else
                            <div class="w-auto text-center text-md-right m0 p0">
                                <button type="button" class="btn-monthly-balance-add btn custom-btn-primary fs15 sort-property m0 p18l p18r w-auto" hidden>{{ __('attributes.rent_roll.btn_save') }}</button>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
@section('js')
    <script src="{{ asset('dist/js/monthly-balance.min.js') }}"></script>
@endsection
