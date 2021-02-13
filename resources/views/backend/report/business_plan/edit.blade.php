@extends('layout.home.master')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/preview/business_plan.css') }}">
@endsection

@section('content')
    <div class="content-wrapper">
        @include('partials.flash_messages')
        <div class="container-fluid container-padding container-wrapper-plan">

                <div id="main-info-assessment" class="@if(request('show_print') == true) has-print @endif">
                    <div class="row row-header m50b">
                        <div class="row m0">
                            <div class="col-12 text-center text-md-left">
                                <h3 class="m0">{{ trans('attributes.property.business_plan') }}</h3>
                            </div>
                        </div>
                    </div>


                    @php($hideAnnualPerformance = empty($annualPerformance) || $annualPerformance['deleted_at'] != null)
                    @if($hideAnnualPerformance)
                        <div class="callout callout-danger">
                            <h5>選択された年度実績表が存在しません。</h5>
                            <p>選択されている年度実績表が削除されています。新たに年度実績表を選択してください。</p>
                        </div>
                    @endif

                    <form action="" id="form-data-business-plan" enctype="multipart/form-data">
                        <input type="hidden" value="{{ $property['id'] }}" class="property-id">
                        <input type="hidden" name="screen" value="{{ $optionUrl['screen'] }}" readonly>
                        <input type="hidden" name="option_paginate" value="{{ $optionUrl['perPage'] }}" readonly>
                        <input type="hidden" id="time-open-page" name="time_open_page" value="{{ date('Y/m/d H:i:s', time()) }}">
                        <div id="form-condition-1" class="row m0 m30b">
                            <div class="col-12 col-xl-6 text-center text-md-right m0 p0 group-status-top row">
                                <div id="block-status" class="row spBlock m0l m20r w-auto">
                                    <div class="centered first-block p15r p15l">
                                        <label class="m0">{{ trans('attributes.balance.header.title_button_1') }}</label>
                                    </div>
                                    <div class="centered p0">
                                        @php($listYear = array_keys($listAnnualPerformance))
                                        <select name="year" class="option-paginate-1 btn form-control hp100 p15lr fs14" style="min-width: 140px">
                                            @if($hideAnnualPerformance)
                                                <option value="" selected></option>
                                            @endif
                                            @foreach($listYear as $year)
                                                <option value="{{ $year }}" @if(isset($params['year']) && $params['year'] == $year) selected @endif>{{ $year . trans('attributes.common.year') }}{{ MONTH[$property['date_month_registration_revenue']]  ?? "ー" }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div id="block-status" class="row spBlock m0 w-auto">
                                    <div class="centered first-block p15r p15l">
                                        <label class="m0">{{ trans('attributes.property.status') }}</label>
                                    </div>
                                    <div class="centered p0 p15r p15l">
                                        <div class="fw-normal">{{ STATUS_HOUSE[$property['status']] }}</div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-xl-6 col-12-sp text-center text-lg-right p0 text-right group-button-top">
                                <button type="button" class="edit-business-plan btn custom-btn-primary fs15 sort-property m15r w70">{{ trans('attributes.sort_table.btn-save') }}</button>
                                <a class="btn w-auto custom-btn-success fs15 business-plan-print show-print" id="pre-print">{{ trans('attributes.balance.header.btn_preview') }}</a>
                            </div>
                        </div>
                            <div class="row m0">
                            <div class="col-12 col-lg-6 m30b p0">
                                <div class="item-block-property m15r">
                                    <div class="m0 m30b diagram-analysisu">
                                        <div class="col-12 p30 diagram-block">
                                            <div class="m30b m0l">
                                                <div class="p0">
                                                    <p class="fs16 fw-bold m0">{{ trans('attributes.register_info.item_block.title.basic_info') }}</p>
                                                </div>
                                            </div>
                                            <div class="row m-0 p0">
                                                <div class="col-3 col-12-sp p0 d-flex align-items-center">
                                                    <span class="d-inline-block fs14">{{ trans('attributes.business_plan.input_date') }}</span>
                                                </div>
                                                <div class="col-9 col-12-sp p0">
                                                    <div class="row col-12 m0 p0">
                                                        <input name="input_date" value="{{ $businessPlan['input_date'] ? date("Y/m/d", strtotime($businessPlan['input_date'])) : ''}}" class="form-control m0 p5 p10l p10r w-100 h-auto fs14 text-center date-time" />
                                                        <p class="error-message p5 p10r m0" data-error="input_date"></p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row m-0 p0 p15t">
                                                <div class="col-3 col-12-sp p0 d-flex align-items-center">
                                                    <span class="d-inline-block fs14">{{ trans('attributes.business_plan.destination_bank') }}</span>
                                                </div>
                                                <div class="col-9 col-12-sp p0">
                                                    <div class="col-12 p0">
                                                        <input name="destination_bank" id="destination-bank" value="{{ $businessPlan['destination_bank'] }}" class="edit-destination-bank form-control m0 p5 p10l p10r w-100 h-auto fs14" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row m-0 p0 p15t">
                                                <div class="col-3 col-12-sp p0 d-flex align-items-center">
                                                    <span class="d-inline-block fs14">{{ trans('attributes.business_plan.destination_address') }}</span>
                                                </div>
                                                <div class="col-9 col-12-sp p0">
                                                    <div class="col-12 p0">
                                                        <input name="destination_address" value="{{ ($businessPlan['destination_address'] != null) ? $businessPlan['destination_address'] : addressFormat($profile['address_city'], $profile['address_district'], $profile['address_town'], $profile['address_building']) }}"
                                                               class="form-control p6 p10l p10r h-auto fs14" id="destination-address">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row m-0 p0 p15t">
                                                <div class="col-3 col-12-sp p0 d-flex align-items-center">
                                                    <span class="d-inline-block fs14">{{ trans('attributes.business_plan.destination_name') }}</span>
                                                </div>
                                                <div class="col-9 col-12-sp p0">
                                                    <div class="col-12 p0">
                                                        <input name="destination_name" value="{{ ($businessPlan['destination_name'] != null) ? $businessPlan['destination_name'] : nameFormat($profile['person_charge_last_name'] ,$profile['person_charge_first_name']) }}"
                                                               class="form-control p6 p10l p10r h-auto fs14" id="destination-name">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row m-0 p0 p15t">
                                                <div class="col-3 col-12-sp p0 d-flex align-items-center">
                                                    <span class="d-inline-block fs14">{{ trans('attributes.business_plan.real_estate_appraiser_name') }}</span>
                                                </div>
                                                <div class="col-9 col-12-sp p0">
                                                    <div class="col-12 p0">
                                                        <input name="material_creator_name" value="{{ $businessPlan['material_creator_name'] }}" class="material-creator-name form-control m0 p5 p10l p10r w-100 h-auto fs14">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="item-block-property m15r">
                                    <div class="m0 m30b diagram-analysisu">
                                        <div class="col-12 p30 diagram-block">
                                            <div class="m30b m0l">
                                                <div class="p0">
                                                    <p class="fs16 fw-bold m0">{{ trans('attributes.balance.body.thing') }}</p>
                                                </div>
                                            </div>
                                            <div class="row m-0 p0">
                                                <div class="col-3 col-12-sp p0 d-flex align-items-center">
                                                    <span class="d-inline-block fs14">{{ trans('attributes.property.house_name') }}</span>
                                                </div>
                                                <div class="col-9 col-12-sp p0">
                                                    <div class="col-12 p0">
                                                        <input name="name" value="{{ $property['house_name'] }}" class="disable-field form-control p6 p10l p10r h-auto fs14 text-center" id="name" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row m-0 p0 p10t">
                                                <div class="col-3 col-12-sp p0 d-flex align-items-center">
                                                    <span class="d-inline-block fs14">{{ trans('attributes.balance.body.location') }}</span>
                                                </div>
                                                <div class="col-9 col-12-sp p0">
                                                    <div class="col-12 p0">
                                                        <input name="address" class="disable-field form-control p6 p10l p10r h-auto fs14 text-center" id="address" disabled
                                                               value="{{ addressFormat($property['address_city'], $property['address_district'], $property['address_town']) }}">

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row m-0 p0 p10t">
                                                <div class="col-3 col-12-sp p0 d-flex align-items-center">
                                                    <span class="d-inline-block fs14">{{ trans('attributes.balance.body.the_main_purpose') }}</span>
                                                </div>
                                                <div class="col-9 col-12-sp p0">
                                                    <div class="col-12 p0">
                                                        <input name="uses" value="{{ $property['real_estate_type']['name'] ?? "" }}" class="disable-field form-control p6 p10l p10r h-auto text-center fs14" id="uses" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                            @if($property['real_estate_type']['id'] == FLAG_TEN)
                                                <div class="row m-0 p0 p10t">
                                                    <div class="col-3 col-12-sp p0 d-flex align-items-center">
                                                        <span class="d-inline-block fs14">{{ trans('attributes.property.main_application') }}</span>
                                                    </div>
                                                    <div class="col-9 col-12-sp p0">
                                                        <div class="col-12 p0">
                                                            <input name="main_application" value="{{ MAIN_APPLICATION[$property['main_application']] ?? "ー" }}" class="disable-field form-control p6 p10l p10r h-auto text-center fs14" id="main_application" disabled>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                            <div class="row m-0 p0 p10t">
                                                <div class="col-3 col-12-sp p0 d-flex align-items-center">
                                                    <span class="d-inline-block fs14">{{ trans('attributes.balance.body.use_in_detail') }}</span>
                                                </div>
                                                <div class="col-9 col-12-sp p0">
                                                    <div class="col-12 p0">
                                                        <input name="details" value="{{ $property['detail_real_estate_type']['name'] ?? "ー" }}" class="disable-field form-control p6 p10l p10r h-auto text-center fs14" id="details" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row m-0 p0 p10t">
                                                <div class="col-3 col-12-sp p0 d-flex align-items-center">
                                                    <span class="d-inline-block fs14">{{ trans('attributes.balance.body.construction') }}</span>
                                                </div>
                                                <div class="col-9 col-12-sp p0">
                                                    <div class="col-12 p0">
                                                        <input name="structure" value="{{ materialFormat($property['house_material']['name'], $property['house_roof_type']['name']) }}" class="disable-field form-control p6 p10l p10r h-auto text-center fs14" id="structure" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row m-0 p0 p10t">
                                                <div class="col-3 col-12-sp p0 d-flex align-items-center">
                                                    <span class="d-inline-block fs14">{{ trans('attributes.balance.body.floor') }}</span>
                                                </div>
                                                <div class="col-9 col-12-sp p0">
                                                    <div class="col-12 p0">
                                                        <input name="floor" value="{{ materialFormat($property['basement'], $property['storeys'])}}" class="disable-field form-control p6 p10l p10r h-auto text-center fs14" id="floor" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row m-0 p0 p10t">
                                                <div class="col-3 col-12-sp p0 d-flex align-items-center">
                                                    <span class="d-inline-block fs14">{{ trans('attributes.balance.body.total_land_area') }}</span>
                                                </div>
                                                <div class="col-9 col-12-sp p0">
                                                    <div class="d-flex">
                                                        <div class="col-6 p0 p5r">
                                                            <input name="ground_area" value="{{ $property['ground_area'] ? number_format($property['ground_area'], 2) : "0.00" }} {{ trans('attributes.common.square_meters') }}" class="disable-field form-control p6 p10l p10r h-auto text-right fs14" id="ground_area" disabled>
                                                        </div>
                                                        <div class="col-6 p0 p5l">
                                                            <input name="ground_area_unit_1" value="{{ $property['ground_area'] ? number_format($property['ground_area'] * 0.3025, 2) : "0.00" }} {{ trans('attributes.common.unit2') }}" class="disable-field form-control p6 p10l p10r h-auto text-right fs14" id="ground_area_unit_1" disabled>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row m-0 p0 p10t">
                                                <div class="col-3 col-12-sp p0 d-flex align-items-center">
                                                    <span class="d-inline-block fs14">{{ trans('attributes.balance.body.building_floor_area') }}</span>
                                                </div>
                                                <div class="col-9 col-12-sp p0">
                                                    <div class="d-flex">
                                                        <div class="col-6 p0 p5r">
                                                            <input name="total_floor_area" value="{{ $property['total_area_floors'] ? number_format($property['total_area_floors'], 2) : "0.00" }} {{ trans('attributes.common.square_meters') }}" class="disable-field form-control p6 p10l p10r h-auto text-right fs14" id="total_floor_area" disabled>
                                                        </div>
                                                        <div class="col-6 p0 p5l">
                                                            <input name="total_floor_area_unit_2" value="{{ $property['total_area_floors'] ? number_format($property['total_area_floors'] * 0.3025, 2) : "0" }} {{ trans('attributes.common.unit2') }}" class="disable-field form-control p6 p10l p10r h-auto text-right fs14" id="total_floor_area_unit_2" disabled>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row m-0 p0 p10t">
                                                <div class="col-3 col-12-sp p0 d-flex align-items-center">
                                                    <span class="d-inline-block fs14">{{ trans('attributes.balance.body.date_of_completion') }}</span>
                                                </div>
                                                <div class="col-9 col-12-sp p0">
                                                    <div class="col-12 p0">
                                                        <input name="date_of_construction" value="{{ $property['construction_time'] ? dateTimeFormat($property['construction_time']) : "ー" }}" class="disable-field form-control p6 p10l p10r h-auto text-center fs14" id="date_of_construction" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="item-block-property m15r">
                                    <div class="m0 diagram-analysisu">
                                        <div class="col-12 p30 diagram-block">
                                            <div class="m30b m0l">
                                                <div class="p0">
                                                    <p class="fs16 fw-bold m0">{{ trans('attributes.balance.body.rights_mode') }}</p>
                                                </div>
                                            </div>
                                            <div class="row m-0 p0">
                                                <div class="col-3 col-12-sp p0 d-flex align-items-center">
                                                    <span class="d-inline-block fs14">{{ trans('attributes.balance.body.land_rights') }}</span>
                                                </div>
                                                <div class="col-9 col-12-sp p0">
                                                    <div class="col-12 p0">
                                                        <input name="land_right_id" value="{{ $property['land_right']['name'] ?? "ー" }}" class="disable-field form-control p6 p10l p10r h-auto text-center fs14" id="land_right_id" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row m-0 p0 p10t">
                                                <div class="col-3 col-12-sp p0 d-flex align-items-center">
                                                    <span class="d-inline-block fs14">{{ trans('attributes.balance.body.building_rights') }}</span>
                                                </div>
                                                <div class="col-9 col-12-sp p0">
                                                    <div class="col-12 p0">
                                                        <input name="building_right_id" value="{{ $property['building_right']['name'] ?? "ー" }}" class="disable-field form-control p6 p10l p10r h-auto text-center fs14" id="building_right_id" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row m-0 p0 p10t">
                                                <div class="col-3 col-12-sp p0 d-flex align-items-center">
                                                    <span class="d-inline-block fs14">{{ trans('attributes.balance.body.total_number_of_tenants') }}</span>
                                                </div>
                                                <div class="col-9 col-12-sp p0">
                                                    <div class="col-12 p0">
                                                        <input name="total_tenants" value="{{ number_format($property['total_tenants']) }}" class="disable-field form-control p6 p10l p10r h-auto text-center fs14" id="total_tenants" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-lg-6 p0">
                                <div class="item-block-property m15l">
                                    <div class="m0 m30b diagram-analysisu">
                                        <div class="col-12 p30 diagram-block">
                                            <div class="m30b m0l">
                                                <div class="p0">
                                                    <p class="fs16 fw-bold m0">{{ trans('attributes.balance.body.matters_concerning_rights') }}</p>
                                                </div>
                                            </div>
                                            <div class="row m-0 p0">
                                                <div class="col-3 col-12-sp p0 d-flex align-items-center">
                                                    <span class="d-inline-block fs14">{{ trans('attributes.balance.body.leasable_area') }}</span>
                                                </div>
                                                <div class="col-9 col-12-sp p0">
                                                    <div class="col-12 p0">
                                                        <input name="area_may_rent" value="{{ $property['area_may_rent'] ? number_format($property['area_may_rent'], 2) : "0.00" }} {{ trans('attributes.common.square_meters') }}" class="disable-field form-control p6 p10l p10r h-auto text-right fs14" id="area_may_rent" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row m-0 p0 p10t">
                                                <div class="col-3 col-12-sp p0 d-flex align-items-center">
                                                    <span class="d-inline-block fs14">{{ trans('attributes.business_plan.rentable_floor_area_ratio_1') }}<br class="spH" />{{ trans('attributes.business_plan.rentable_floor_area_ratio_2') }}</span>
                                                </div>
                                                <div class="col-9 col-12-sp d-flex align-items-center p0">
                                                    <div class="col-12 p0">
                                                        <input name="rentable_floor_area_ratio" value="{{ division((float)$property['area_may_rent'] ?? 0 , (float)$property['total_area_floors'] ?? 0) }} {{ trans('attributes.common.percent') }}" class="disable-field form-control p6 p10l p10r h-auto text-center fs14" id="rentable_floor_area_ratio" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row m-0 p0 p10t">
                                                <div class="col-3 col-12-sp p0 d-flex align-items-center">
                                                    <span class="d-inline-block fs14">{{ trans('attributes.balance.body.rental_operating_area') }}</span>
                                                </div>
                                                <div class="col-9 col-12-sp p0">
                                                    <div class="col-12 p0">
                                                        <input name="area_rental_operating" value="{{ $property['area_rental_operating'] ? number_format($property['area_rental_operating'], 2) : "0.00" }} {{ trans('attributes.common.square_meters') }}" class="disable-field form-control p6 p10l p10r h-auto text-right fs14" id="area_rental_operating" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row m-0 p0 p10t">
                                                <div class="col-3 col-12-sp p0 d-flex align-items-center">
                                                    <span class="d-inline-block fs14">{{ trans('attributes.balance.body.crop_yield') }}</span>
                                                </div>
                                                <div class="col-9 col-12-sp p0">
                                                    <div class="col-12 p0">
                                                        <input name="rental_percentage" value="{{ numberFormatWithUnit($property['rental_percentage'], " " . trans('attributes.common.percent'), FLAG_TWO) }}" class="disable-field form-control p6 p10l p10r h-auto text-center fs14" id="rental_percentage" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row m-0 p0 p10t">
                                                <div class="col-3 col-12-sp p0 d-flex align-items-center">
                                                    <span class="d-inline-block fs14">{{ trans('attributes.balance.body.security_deposit') }}</span>
                                                </div>
                                                <div class="col-9 col-12-sp p0">
                                                    <div class="col-12 p0">
                                                        <input name="deposit_guarantor" value="{{ $property['deposits'] ? number_format($property['deposits']) : "0" }} {{ trans('attributes.common.yen') }}" class="disable-field form-control p6 p10l p10r h-auto text-right fs14" id="deposit_guarantor" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="item-block-property m15l">
                                    <div class="m0 diagram-analysisu">
                                        <div class="col-12 p30 diagram-block">
                                            <div class="m30b m0l">
                                                <div class="p0">
                                                    <p class="fs16 fw-bold m0">{{ trans('attributes.balance.body.leasehold') }}</p>
                                                </div>
                                            </div>
                                            <div class="row m-0 p0">
                                                <div class="col-3 col-12-sp p0 d-flex align-items-center">
                                                    <span class="d-inline-block fs14">{{ trans('attributes.balance.body.leasehold_type') }}</span>
                                                </div>
                                                <div class="col-9 col-12-sp p0">
                                                    <div class="col-12 p0">
                                                        <input name="type_rental_id" value="{{ $property['type_rental']['name'] ?? "ー" }}" class="disable-field form-control p6 p10l p10r h-auto text-left fs14 text-center" id="type_rental_id" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row m-0 p0 p10t">
                                                <div class="col-3 col-12-sp p0 d-flex align-items-center">
                                                    <span class="d-inline-block fs14">{{ trans('attributes.balance.body.leased_land_area') }}</span>
                                                </div>
                                                <div class="col-9 col-12-sp p0">
                                                    <div class="col-12 p0">
                                                        <input name="area_rent" value="{{ $property['area_rent'] ? number_format($property['area_rent'], 2) : "0.00" }} {{ trans('attributes.common.square_meters') }}" class="disable-field form-control p6 p10l p10r h-auto text-right fs14" id="area_rent" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row m-0 p0 p10t">
                                                <div class="col-3 col-12-sp p0 d-flex align-items-center">
                                                    <span class="d-inline-block">{{ trans('attributes.balance.body.lease_period_own') }}</span>
                                                </div>
                                                <div class="col-9 col-12-sp p0">
                                                    <div class="col-12 p0">
                                                        <input name="rental_period_from" value="{{ $property['rental_period_from'] ? dateTimeFormat($property['rental_period_from']) : "ー" }}" class="disable-field form-control p6 p10l p10r h-auto text-center fs14" id="rental_period_from" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row m-0 p0 p10t">
                                                <div class="col-3 col-12-sp p0 d-flex align-items-center">
                                                    <span class="d-inline-block fs14">{{ trans('attributes.balance.body.lease_period_to') }}</span>
                                                </div>
                                                <div class="col-9 col-12-sp p0">
                                                    <div class="col-12 p0">
                                                        <input name="rental_period_to" value="{{ $property['rental_period_to'] ? dateTimeFormat($property['rental_period_to']) : "ー" }}" class="disable-field form-control p6 p10l p10r h-auto text-center fs14" id="rental_period_to" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row m-0 p0 p10t">
                                                <div class="col-3 col-12-sp p0 d-flex align-items-center">
                                                    <span class="d-inline-block fs14">{{ trans('attributes.balance.body.current_rent_agreement_date') }}<br class="spH" /><span class="fs12">{{ trans('attributes.balance.body.latest_rent_update_date') }}</span></span>
                                                </div>
                                                <div class="col-9 col-12-sp d-flex align-items-center p0">
                                                    <div class="col-12 p0">
                                                        <input name="date_lease" value="{{ $property['date_lease'] ? dateTimeFormat($property['date_lease']) : "ー" }}" class="disable-field form-control p6 p10l p10r h-auto text-center fs14" id="date_lease" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row m-0 p0 p10t">
                                                <div class="col-3 col-12-sp p0 d-flex align-items-center">
                                                    <span class="d-inline-block fs14">{{ trans('attributes.balance.body.security_deposit') }}</span>
                                                </div>
                                                <div class="col-9 col-12-sp p0">
                                                    <div class="col-12 p0">
                                                        <input name="deposit_host" value="{{ $property['deposit_host'] == "" ? trans('attributes.common.no_stipulation') : $property['deposit_host'] }}" class="disable-field form-control p6 p10l p10r h-auto text-center fs14" id="deposit_host" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row m-0 p0 p10t">
                                                <div class="col-3 col-12-sp p0 d-flex align-items-center">
                                                    <span class="d-inline-block fs14">{{ trans('attributes.balance.body.royalties') }}</span>
                                                </div>
                                                <div class="col-9 col-12-sp p0">
                                                    <div class="col-12 p0">
                                                        <input name="prize_money" value="{{ $property['prize_money'] == "" ? trans('attributes.common.no_stipulation') : $property['prize_money'] }}" class="disable-field form-control p6 p10l p10r h-auto text-center fs14" id="prize_money" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row m-0 p0 p10t">
                                                <div class="col-3 col-12-sp p0 d-flex align-items-center">
                                                    <span class="d-inline-block fs14">{{ trans('attributes.balance.body.nominal_book_change') }}</span>
                                                </div>
                                                <div class="col-9 col-12-sp p0">
                                                    <div class="col-12 p0">
                                                        <input name="room_cede_fee" value="{{ $property['room_cede_fee'] == "" ? trans('attributes.common.no_stipulation') : $property['room_cede_fee'] }}" class="disable-field form-control p6 p10l p10r h-auto text-center fs14" id="room_cede_fee" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row m-0 p0 p10t">
                                                <div class="col-3 col-12-sp p0 d-flex align-items-center">
                                                    <span class="d-inline-block fs14">{{ trans('attributes.balance.body.reconstruction_permission_fee') }}</span>
                                                </div>
                                                <div class="col-9 col-12-sp p0">
                                                    <div class="col-12 p0">
                                                        <input name="fee_rebuild_rented_house" value="{{ $property['fee_rebuild_rented_house'] == "" ? trans('attributes.common.no_stipulation') : $property['fee_rebuild_rented_house'] }}" class="disable-field form-control p6 p10l p10r h-auto text-center fs14" id="fee_rebuild_rented_house" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row m-0 p0 p10t">
                                                <div class="col-3 col-12-sp p0 d-flex align-items-center">
                                                    <span class="d-inline-block fs14">{{ trans('attributes.balance.body.update') }}</span>
                                                </div>
                                                <div class="col-9 col-12-sp p0">
                                                    <div class="col-12 p0">
                                                        <input name="contract_update_fee" value="{{ $property['contract_update_fee'] == "" ? trans('attributes.common.no_stipulation') : $property['contract_update_fee'] }}" class="disable-field form-control p6 p10l p10r h-auto text-center fs14" id="contract_update_fee" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if(!$hideAnnualPerformance)
                            @include('backend.report.modules_html.operating_revenue_and_basis_for_calculation')

                            @include('backend.report.modules_html.operating_fee_and_basis_for_calculation')

                            @include('backend.report.modules_html.total_and_basis_for_calculation')
                        @endif

                        <div class="row m0 m30b">
                            <div class="col-12 col-lg-6 p0">
                                <div class="item-block-property m15r h-100">
                                    <div class="m0 diagram-analysisu">
                                        <div class="col-12 p30 diagram-block">
                                            <div class="row m-0 p0">
                                                <div class="col-3 col-12-sp p0 d-flex align-items-center">
                                                    <span class="d-inline-block fs14">{{ trans('attributes.business_plan.expected_borrowing_date') }}</span>
                                                </div>
                                                <div class="col-9 col-12-sp p0">
                                                    <div class="row col-12 m0 p0">
                                                        <input name="expected_borrowing_date" id="expected-borrowing-date" value="{{ $businessPlan['expected_borrowing_date'] ? date("Y/m/d", strtotime($businessPlan['expected_borrowing_date'])) : '' }}" class="form-control m0 p5 p10l p10r w-100 h-auto fs14 text-center date-time" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-9 offset-3 p0">
                                                <p class="error-message p10r m0" data-error="expected_borrowing_date"></p>
                                            </div>

                                            <div class="row m-0 p0 p15t">
                                                <div class="col-3 col-12-sp p0 d-flex align-items-center">
                                                    <span class="d-inline-block fs14">{{ trans('attributes.business_plan.expected_borrowing_amount') }}</span>
                                                </div>
                                                <div class="col-9 col-12-sp p0">
                                                    <div class="col-12 p0">
                                                        <input name="expected_borrowing_amount" id="expected-borrowing-amount" value="{{ $businessPlan['expected_borrowing_amount'] }}" class="expected-borrowing-amount form-control m0 p5 p10l p10r w-100 h-auto fs14 text-right convert-data" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-9 offset-3 p0">
                                                <p class="error-message p10r m0" data-error="expected_borrowing_amount"></p>
                                            </div>

                                            <div class="row m-0 p0 p15t">
                                                <div class="col-3 col-12-sp p0 d-flex align-items-center">
                                                    <span class="d-inline-block fs14">{{ trans('attributes.property.during_initial_borrowing_period') }}</span>
                                                </div>
                                                <div class="col-9 col-12-sp p0 d-flex">
                                                    <div class="col-11 p0">
                                                        <input name="initial_borrowing_period" id="initial-borrowing-period" value="{{ $businessPlan['initial_borrowing_period'] }}" class=" convert-data initial-borrowing-period form-control m0 p5 p10l p10r w-100 h-auto fs14 text-center">
                                                    </div>
                                                    <div class="col-1 w-8 p0 p8t text-right">
                                                        <span class="fs14">{{ trans('attributes.common.year') }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-9 offset-3 p0">
                                                <p class="error-message p10r m0" data-error="initial_borrowing_period"></p>
                                            </div>

                                            <div class="row m-0 p0 p15t">
                                                <div class="col-3 col-12-sp p0 d-flex align-items-center">
                                                    <span class="d-inline-block fs14">{{ trans('attributes.business_plan.expected_interest') }}</span>
                                                </div>
                                                <div class="col-9 col-12-sp p0 d-flex">
                                                    <div class="col-11 p0">
                                                        <input name="expected_interest" id="expected-interest" value="{{ $businessPlan['expected_interest'] }}" class="convert-number-double-decimal expected-interest form-control m0 p5 p10l p10r w-100 h-auto fs14 text-center">
                                                    </div>
                                                    <div class="col-1 w-8 p0 p8t text-right">
                                                        <span class="fs14">{{ trans('attributes.common.percent') }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-9 offset-3 p0">
                                                <p class="error-message p10r m0" data-error="expected_interest"></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-lg-6 p0">
                                <div class="item-block-property m15l h-100">
                                    <div class="m0 diagram-analysisu h-100">
                                        <div class="col-12 p30 diagram-block h-100">
                                            <div class="row m-0 p0">
                                                <div class="col-3 col-12-sp p0 d-flex align-items-center">
                                                    <span class="d-inline-block fs14">{{ trans('attributes.property.annual_payment_principal_interes') }}</span>
                                                </div>
                                                <div class="col-9 col-12-sp p0">
                                                    <div class="col-12 p0">
                                                        <input type="hidden" value="" class="principal_and_interest">
                                                        <input name="annual_repayment_of_principal_and_interest" value="" class="annual-repayment-of-principal-and-interest disable-field form-control h-auto p6 p10l p10r text-right fs14" id="annual-repayment-of-principal-and-interest" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row m-0 p0 p10t">
                                                <div class="col-3 col-12-sp p0 d-flex align-items-center">
                                                    <span class="d-inline-block fs14">{{ trans('attributes.business_plan.repayment_cover_rate_1') }}<br />{{ trans('attributes.business_plan.repayment_cover_rate_2') }}</span>
                                                </div>
                                                <div class="col-9 col-12-sp p0">
                                                    <div class="col-12 p0">
                                                        <input type="hidden" value="" class="repayment-rate">
                                                        <input name="repayment_cover_rate" value="" class="disable-field form-control h-auto text-center p6 p10l p10r fs14" id="repayment-cover-rate" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row m-0 p0 p10t">
                                                <div class="col-3 col-12-sp p0">
                                                    <span class="d-inline-block p10t fs14">{{ trans('attributes.balance.body.noi_yield') }}</span>
                                                </div>
                                                <div class="col-9 col-12-sp p0">
                                                    <div class="col-12 p0">
                                                        <input type="hidden" value="" class="interest-noi">
                                                        <input name="noi_interest" value="" class="disable-field form-control h-auto p6 p10l p10r text-right fs14" id="noi_interest" disabled>
                                                        <div class="m0 p0 align-items-center">
                                                            <span class="d-inline-block fs12">{{ trans('attributes.business_plan.interest_noi') }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="col-12 text-center text-lg-right m40b p0 text-right group-button-top">
                            <button type="button" class="edit-business-plan btn custom-btn-primary fs15 sort-property m15r w70">{{ trans('attributes.sort_table.btn-save') }}</button>
                            <a class="btn w-auto custom-btn-success fs15 business-plan-print" id="pre-print">{{ trans('attributes.property.display_preview') }}</a>
                        </div>

                        <div class="col-12 p0 m70t-sp info-creator">
                            <div class="m0 m30b diagram-analysis">
                                <div class="m0 p30 p35b diagram-block">
                                    <div class="p0 m0">
                                        <div class="m30b m0l">
                                            <div class="p0">
                                                <p class="fs16 fw-bold m0">{{ trans('attributes.business_plan.plan_1') }}</p>
                                            </div>
                                        </div>

                                        <div class="col-12 p0">
                                            <dl class="m30b">
                                                <dt class="m10b p3b border-bottom fs15">{{ trans('attributes.business_plan.plan_2') }}</dt>
                                                 <dd class="m0">
                                                    <input name="date_of_confirmation" id="date-of-confirmation" value="{{ $businessPlan['date_of_confirmation'] }}" placeholder="{{ trans('attributes.business_plan.plan_3') }}" class="form-control m0 p5 p10l p10r w-100 h-auto fs14 text-left" />
                                                </dd>
                                            </dl>
                                            <dl class="m30b">
                                                <dt class="m10b p3b border-bottom fs15">{{ trans('attributes.business_plan.plan_4') }}</dt>
                                                <dd class="m0">
                                                        <textarea name="note_confirmation_procedure" id="note-confirmation-procedure" cols="15" rows="5" class="form-control m0 h-auto fs14 text-left">{{ $businessPlan['note_confirmation_procedure'] ?? trans('attributes.business_plan.plan_5') }}</textarea>
                                                </dd>
                                            </dl>
                                            <dl class="m30b">
                                                <dt class="m10b p3b border-bottom fs15">{{ trans('attributes.business_plan.plan_7') }}</dt>
                                                <dd class="m0">
                                                    {{ trans('attributes.business_plan.plan_8') }}<br />
                                                    {{ trans('attributes.business_plan.plan_9') }}<br />
                                                    {{ trans('attributes.business_plan.plan_10') }}
                                                </dd>
                                            </dl>
                                            <dl class="m30b">
                                                <dt class="m10b p3b border-bottom fs15">{{ trans('attributes.business_plan.plan_11') }}</dt>
                                                <dd class="m0">
                                                    {{ trans('attributes.business_plan.plan_12') }}<br />
                                                    {{ trans('attributes.business_plan.plan_13') }}<br />
                                                    {{ trans('attributes.business_plan.plan_14') }}<br />
                                                    {{ trans('attributes.business_plan.plan_15') }}<br />
                                                    {{ trans('attributes.business_plan.plan_16') }}<br />
                                                    {{ trans('attributes.business_plan.plan_17') }}
                                                </dd>
                                            </dl>
                                            <dl class="m0">
                                                <dt class="m10b p3b border-bottom fs15">{{ trans('attributes.business_plan.plan_18') }}</dt>
                                                <dd class="m0">
                                                    <textarea name="addendum" id="addendum" cols="15" rows="5" class="form-control m0 h-auto fs14 text-left"> {{ $businessPlan{'addendum'} ?? trans('attributes.business_plan.plan_19') }}</textarea>
                                                </dd>
                                            </dl>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
        </div>
        @include('backend.preview_print.business_plan_print_edit')
        <form id="form-condition-2" action="{{ route(USER_PROPERTY_BUSINESS_PLAN_EDIT, $property['id']) }}" method="GET">
            <input type="hidden" name="screen" value="{{ $optionUrl['screen'] }}" readonly>
            <input type="hidden" name="option_paginate" value="{{ $optionUrl['perPage'] }}" readonly>
            <input type="hidden" name="year" value="">
        </form>
    </div>
@endsection
@section('js')
    <script src="{{ asset('dist/js/business_plan.min.js') }}"></script>
@endsection
