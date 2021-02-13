@extends('layout.home.master')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/preview/essential.css') }}">
@endsection

@section('content')
    <form id="form-data-summary" class="form-data-submit" action="{{ route(USER_ESSENTIAL_STORE) }}" method="POST"
          enctype="multipart/form-data">
        @csrf
        <div id="essential-create-screen" class="essential container-fluid container-wrapper @if(request('show_print') == true) has-print @endif">
            <div class="essential-content essential-blade-content">
                @include('partials.flash_messages')
                <div class="essential-header media-575-p20l media-575-p20r p15lr">
                    <div class="row m0">
                        <div class="col-12 p0">
                            <h3 class="m0">
                                {{ trans('attributes.essential.header.page_title') }}
                            </h3>
                        </div>

                        @php($hideAnnualPerformance = empty($annualPerformance) || $annualPerformance['deleted_at'] != null)
                        @if($hideAnnualPerformance)
                            <div class="col-12 p0 m13t">
                                <div class="callout callout-danger">
                                    <h5>選択された年度実績表が存在しません。</h5>
                                    <p>選択されている年度実績表が削除されています。新たに年度実績表を選択してください。</p>
                                </div>
                            </div>
                        @endif
                        <div class="col-12 p0 m13t">
                            <div class="row m0">
                                <div class="col-10 p0 text-end">
                                    <span class="essential-sub-title">
                                        {{ trans('attributes.essential.header.page_sub_title') }}
                                    </span>
                                </div>
                                <div class="col-2 p0 text-right">
                                    <button type="button" class="btn custom-btn-success fs15 btn-submit-summary btn-essential-submit d-none d-sm-inline-block">
                                        {{ trans('attributes.essential.header.btn_confirm') }}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="m30t p15lr">
                    <div class="row m0 essential-body">
                        <div class="col-12">
                            <div class="row m0">
                                <div class="col-12 col-xl-2">
                                    <span class="essential-text">
                                        {{ trans('attributes.essential.body.property_name') }}
                                    </span>
                                </div>
                                <div class="col-12 col-xl-8 essential-m10t">
                                    <input type="text" class="form-control essential-input text-left fs14" value="{{ $property['house_name'] ?? "" }}" disabled>
                                </div>
                                <div class="col-12 col-xl-2 essential-m10t">
                                    <div class="essential-checkbox display-center">
                                        <input type="hidden" name="display_house_name" value="0">
                                        <label class="container-input fw400 fs12">{{ trans('attributes.balance.body.checkbox_text') }}
                                            <input data-display="display-house-name" type="checkbox" name="display_house_name" @if ($generalInfo['display_house_name'] == 1) value="1" checked @endif>
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 m15t">
                            <div class="row m0">
                                <div class="col-12 col-xl-2">
                                    <span class="essential-text">
                                        {{ trans('attributes.essential.body.date_of_completion') }}
                                    </span>
                                </div>
                                <div class="col-12 col-xl-4 essential-m10t">
                                    <input type="text" class="form-control essential-input text-center fs14" value="{{ $property['construction_time'] ? date("Y/m/d", strtotime($property['construction_time'])) : "ー" }}" disabled>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 m15t">
                            <div class="row m0">
                                <div class="col-12 col-xl-2">
                                    <span class="essential-text">
                                        {{ trans('attributes.essential.body.residence_indication') }}
                                    </span>
                                </div>
                                <div class="col-12 col-xl-8 essential-m10t">
                                    <input type="text" class="form-control essential-input text-left fs14"
                                           value="{{ addressFormat($property['address_city'], $property['address_district'], $property['address_town']) }}"
                                           disabled>
                                </div>
                                <div class="col-12 col-xl-2 essential-m10t">
                                    <div class="essential-checkbox display-center">
                                        <input type="hidden" name="display_address" value="0">
                                        <label class="container-input fw400 fs12">{{ trans('attributes.balance.body.checkbox_text') }}
                                            <input data-display="display-address" type="checkbox" name="display_address" @if ($generalInfo['display_address'] == FLAG_ONE) value="1" checked @endif>
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 m15t">
                            <div class="row m0">
                                <div class="col-12 col-xl-2">
                                    <span class="essential-text">
                                        {{ trans('attributes.essential.body.traffic') }}
                                    </span>
                                </div>
                                <div class="col-12 col-xl-10 essential-m10t">
                                    <input name="traffic" type="text"
                                           class="form-control essential-input-border essential-input text-left fs14" value="{{ $generalInfo['traffic'] }}" placeholder="{{ trans('attributes.essential.placeholder.traffic') }}">
                                </div>
                            </div>
                        </div>

                        <div class="col-12 m15t">
                            <div class="row m0">
                                <div class="col-12 col-xl-2">
                                    <span class="essential-text">
                                        {{ trans('attributes.essential.body.price') }}
                                    </span>
                                </div>
                                <div class="col-12 col-xl-4 essential-m10t">
                                    <div class="row">
                                        <div class="col-1 m5t">
                                            <span class="fs14">{{ trans('attributes.common.friday') }}</span>
                                        </div>
                                        <div class="col-10">
                                            <input name="price" type="text"
                                                   class="form-control essential-input-border essential-input text-right convert-data fs14 price" value="{{ $generalInfo['price'] ?? 0 }}">
                                        </div>
                                        <div class="col-1 text-right m5t">
                                            <span class="fs14">{{ trans('attributes.common.yen') }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 m15t">
                            <div class="row m0">
                                <div class="col-12 col-xl-2">
                                    <span class="essential-text">
                                        {{ trans('attributes.essential.body.lot_number') }}
                                    </span>
                                </div>
                                <div class="col-12 col-xl-8 essential-m10t">
                                    <input type="text" class="form-control essential-input text-left fs14" value="{{ $property['apartment_number'] ?? "ー" }}" disabled>
                                </div>
                                <div class="col-12 col-xl-2 essential-m10t">
                                    <div class="essential-checkbox display-center">
                                        <input type="hidden" name="display_apartment_number" value="0">
                                        <label class="container-input fw400 fs12">{{ trans('attributes.balance.body.checkbox_text') }}
                                            <input data-display="display-apartment-number" type="checkbox" name="display_apartment_number" @if ($generalInfo['display_apartment_number'] == 1) value="1" checked @endif>
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 m15t">
                            <div class="row m0">
                                <div class="col-12 col-xl-2">
                                    <span class="essential-text">
                                        {{ trans('attributes.essential.body.house_number') }}
                                    </span>
                                </div>
                                <div class="col-12 col-xl-8 essential-m10t">
                                    <input type="text" class="form-control essential-input text-left fs14" value="{{ $property['room_number'] ?? 'ー' }}" disabled>
                                </div>
                                <div class="col-12 col-xl-2 essential-m10t">
                                    <div class="essential-checkbox display-center">
                                        <input type="hidden" name="display_room_number" value="0">
                                        <label class="container-input fw400 fs12">{{ trans('attributes.balance.body.checkbox_text') }}
                                            <input data-display="display-room-number" type="checkbox" name="display_room_number" @if ($generalInfo['display_room_number'] == 1) value="1" checked @endif>
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 m15t">
                            <div class="row m0">
                                <div class="col-12 col-xl-2 col-xl-2 ">
                                    <span class="essential-text">
                                        {{ trans('attributes.essential.body.the_main_purpose') }}
                                    </span>
                                </div>
                                <div class="col-12 col-xl-4 essential-m10t">
                                    <input type="text" class="form-control essential-input text-center fs14"
                                           value="{{ $property['real_estate_type']['name'] ?? "" }}" disabled>
                                    <input id="real_estate_type_id" type="text" class="form-control essential-input text-center d-none fs14"
                                           value="{{ $property['real_estate_type_id'] ?? "" }}" disabled>
                                </div>
                                <div class="col-12 col-xl-2 essential-m10t">
                                    <span class="essential-text essential-p30l">
                                        {{ trans('attributes.essential.body.construction') }}
                                    </span>
                                </div>
                                <div class="col-12 col-xl-4 essential-m10t">
                                    <input type="text" class="form-control essential-input text-center fs14"
                                           value="{{ materialFormat($property['house_material']['name'], $property['house_roof_type']['name']) }}" disabled>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 m15t">
                            <div class="row m0">
                                <div class="col-12 col-xl-2">
                                    <span class="essential-text">
                                        {{ trans('attributes.essential.body.use_in_detail') }}
                                    </span>
                                </div>
                                <div class="col-12 col-xl-4 essential-m10t">
                                    <input type="text" class="form-control essential-input text-center fs14"
                                           value="{{ $property['detail_real_estate_type']['name'] ?? "" }}" disabled>
                                </div>
                                <div class="col-12 col-xl-2 essential-m15t">
                                    <span class="essential-text essential-p30l">
                                        {{ trans('attributes.essential.body.number_of_floors') }}
                                    </span>
                                </div>
                                <div class="col-12 col-xl-4 essential-m10t">
                                    <input type="text" class="form-control essential-input text-center fs14"
                                           value="{{ materialFormat($property['basement'], $property['storeys']) }}" disabled>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 m15t">
                            <div class="row m0">
                                <div class="col-12 col-xl-2">
                                    <span class="essential-text">
                                        {{ trans('attributes.essential.body.total_land_area') }}
                                    </span>
                                </div>
                                <div class="col-12 col-xl-2 essential-m10t">
                                    <input id="ground-area-unit" type="text" class="form-control essential-input text-right fs14" value="{{ $property['ground_area'] ? number_format($property['ground_area'], FLAG_TWO) : "0.00" }} {{ trans('attributes.common.m2') }}" disabled>
                                    <input id="ground-area" type="text" class="d-none" value="{{ $property['ground_area'] ?? "0" }}" disabled>
                                </div>
                                <div class="col-12 col-xl-2 essential-m10t">
                                    <div class="col-6 col-xl-12 p0l p0r essential-p7-5r">
                                        <div class="essential-checkbox display-center">
                                            <input type="hidden" name="display_ground_area" value="0">
                                            <label class="container-input fw400 fs12">{{ trans('attributes.balance.body.checkbox_text') }}
                                                <input id="display-ground-area" type="checkbox" name="display_ground_area" @if ($generalInfo['display_ground_area'] == 1) value="1" checked @endif>
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-xl-2 essential-m15t">
                                    <span class="essential-text essential-p30l">
                                        {{ trans('attributes.essential.body.building_floor_area') }}
                                    </span>
                                </div>
                                <div class="col-12 col-xl-2 essential-m10t">
                                    <input id="total-area-floors-unit" type="text" class="form-control essential-input text-right fs14"
                                           value="{{ $property['total_area_floors'] ? number_format($property['total_area_floors'], FLAG_TWO) : "0.00" }} {{ trans('attributes.common.m2') }}" disabled>
                                    <input id="total-area-floors" type="text" class="form-control essential-input text-right d-none"
                                           value="{{ $property['total_area_floors'] ?? "0" }}" disabled>
                                </div>
                                <div class="col-12 col-xl-2 essential-m10t">
                                    <div class="essential-checkbox display-center">
                                        <input type="hidden" name="display_total_area_floors" value="0">
                                        <label class="container-input fw400 fs12">{{ trans('attributes.balance.body.checkbox_text') }}
                                            <input id="display-total-area-floors" type="checkbox" name="display_total_area_floors" @if ($generalInfo['display_total_area_floors'] == 1) value="1" checked @endif>
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 m15t">
                            <div class="row m0">
                                <div class="col-12 col-xl-2">
                                    <span class="essential-text">
                                        {{ trans('attributes.essential.body.floor_area_details') }}
                                    </span>
                                </div>
                                <div class="col-12 col-xl-8 essential-m10t">
                                    <input type="text" name="details_of_each_floor_area" class="form-control essential-input-border essential-input text-left fs14"
                                           value="{{ $generalInfo['details_of_each_floor_area'] }}" placeholder="{{ trans('attributes.essential.placeholder.details_of_each_floor_area') }}">
                                </div>
                                <div class="col-12 col-xl-2 essential-m10t">
                                    <div class="essential-checkbox display-center">
                                        <input type="hidden" name="display_details_of_each_floor_area" value="0">
                                        <label class="container-input fw400 fs12">{{ trans('attributes.balance.body.checkbox_text') }}
                                            <input data-display="display-details-of-each-floor-area" type="checkbox" name="display_details_of_each_floor_area" @if ($generalInfo['display_details_of_each_floor_area'] == 1) value="1" checked @endif>
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{--Change layout--}}
                <div class="m30t">
                    <div class="row m0">
                        <div class="col-12 col-xl-6 p0l p15lr">
                            <div class="essential-body-special fill-height">
                                <div class="col-12">
                                    <span class="col-12 essential-body-title">
                                        {{ trans('attributes.essential.body.matters_concerning_rights') }}
                                    </span>
                                </div>

                                <div class="col-12 m15t">
                                    <div class="row m0">
                                        <div class="col-12 col-xl-4">
                                            <span class="essential-text">
                                                {{ trans('attributes.essential.body.land_rights') }}
                                            </span>
                                        </div>
                                        <div class="col-12 col-xl-8 essential-m10t">
                                            <input type="text" class="form-control essential-input text-center fs14"
                                                   value="{{ $property['land_right']['name'] ?? "ー" }}" disabled>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 m15t">
                                    <div class="row m0">
                                        <div class="col-12 col-xl-4">
                                            <span class="essential-text">
                                                {{ trans('attributes.essential.body.building_right') }}
                                            </span>
                                        </div>
                                        <div class="col-12 col-xl-8 essential-m10t">
                                            <input type="text" class="form-control essential-input text-center fs14"
                                                   value="{{ $property['building_right']['name'] ?? "ー" }}" disabled>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 m15t">
                                    <div class="row m0">
                                        <div class="col-12 col-xl-4">
                                            <span class="essential-text">
                                                年度月期
                                            </span>
                                        </div>
                                        <div class="col-12 col-xl-8 essential-m10t">
                                            @php($listYear = array_keys($listAnnualPerformance))
                                            <select class="form-control" name="year">
                                                @if($hideAnnualPerformance)
                                                    <option value="" selected></option>
                                                @endif
                                                @foreach($listYear as $year)
                                                    <option value="{{ $year }}" @if(isset($params['year']) && $params['year'] == $year) selected @endif>{{ $year . trans('attributes.common.year') }}{{ MONTH[$property['date_month_registration_revenue']]  ?? "ー" }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                @if(!$hideAnnualPerformance)
                                <div class="col-12 m15t">
                                    <div class="row m0">
                                        <div class="col-12 col-xl-4">
                                            <span class="essential-text">
                                                {{ trans('attributes.essential.body.leasable_area') }}
                                            </span>
                                        </div>
                                        <div class="col-12 col-xl-4 essential-m10t">
                                            <input id="area-may-rent-unit" type="text"
                                                   class="form-control essential-input text-right fs14"
                                                   value="{{ $annualPerformance['area_may_rent'] ? number_format($annualPerformance['area_may_rent'], FLAG_TWO) : "0.00" }} {{ trans('attributes.common.square_meters') }}"
                                                   disabled>
                                            <input id="area-may-rent" type="text"
                                                   class="form-control essential-input text-right d-none"
                                                   value="{{ $annualPerformance['area_may_rent'] ?? "0" }}" disabled>
                                        </div>
                                        <div class="col-12 col-xl-4 essential-m10t">
                                            <div class="essential-checkbox display-center">
                                                <input type="hidden" name="display_area_may_rent" value="0">
                                                <label class="container-input fw400 fs12">{{ trans('attributes.balance.body.checkbox_text') }}
                                                    <input id="display-area-may-rent" type="checkbox" name="display_area_may_rent" @if ($generalInfo['display_area_may_rent'] == 1) value="1" checked @endif>
                                                    <span class="checkmark"></span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 m15t">
                                    <div class="row m0">
                                        <div class="col-12 col-xl-4">
                                            <span class="essential-text">
                                                {{ trans('attributes.essential.body.rent-a-file_ratio') }}<br>
                                                {{ trans('attributes.essential.body.bed_effective_rate') }}
                                            </span>
                                        </div>
                                        <div class="col-12 col-xl-8 essential-m10t">
                                            <input type="text" class="form-control essential-input text-center fs14"
                                                   value="{{ division((float)$annualPerformance['area_may_rent'] ?? 0 ,(float)$property['total_area_floors'] ?? 0) }}{{ trans('attributes.common.percent') }}"
                                                   disabled>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 m15t">
                                    <div class="row m0">
                                        <div class="col-12 col-xl-4">
                                            <span class="essential-text">
                                                {{ trans('attributes.essential.body.rental_operating_area') }}
                                            </span>
                                        </div>
                                        <div class="col-12 col-xl-4 essential-m10t">
                                            <input id="area-rental-operating-unit" type="text"
                                                   class="form-control essential-input text-right fs14"
                                                   value="{{ $annualPerformance['area_rental_operating'] ? number_format($annualPerformance['area_rental_operating'], FLAG_TWO) : "0.00" }} {{ trans('attributes.common.square_meters') }}"
                                                   disabled>
                                            <input id="area-rental-operating" type="hidden"
                                                   class="form-control essential-input text-right fs14"
                                                   value="{{ $annualPerformance['area_rental_operating'] ?? "0" }}" disabled>
                                        </div>
                                        <div class="col-12 col-xl-4 essential-m10t">
                                            <div class="essential-checkbox display-center">
                                                <input type="hidden" name="display_area_rental_operating" value="0">
                                                <label class="container-input fw400 fs12">{{ trans('attributes.balance.body.checkbox_text') }}
                                                    <input id="display-area-rental-operating" type="checkbox"
                                                           name="display_area_rental_operating"
                                                           @if ($generalInfo['display_area_rental_operating'] == 1) value="1"
                                                           checked @endif>
                                                    <span class="checkmark"></span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 m15t">
                                    <div class="row m0">
                                        <div class="col-12 col-xl-4">
                                            <span class="essential-text">
                                                {{ trans('attributes.essential.body.occupancy_rate') }}
                                            </span>
                                        </div>
                                        <div class="col-12 col-xl-8 essential-m10t">
                                            <input type="text" class="form-control essential-input text-center fs14"
                                                   value="{{ $annualPerformance['crop_yield'] ? number_format($annualPerformance['crop_yield'], FLAG_TWO) : "0" }}{{ trans('attributes.common.percent') }}"
                                                   disabled>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 m15t">
                                    <div class="row m0">
                                        <div class="col-12 col-xl-4">
                                            <span class="essential-text">
                                                {{ trans('attributes.essential.body.security_deposit') }}
                                            </span>
                                        </div>
                                        <div class="col-12 col-xl-8 essential-m10t">
                                            <input type="text" class="form-control essential-input text-right fs14"
                                                   value="{{ $annualPerformance['deposits'] ? number_format($annualPerformance['deposits']) : "0" }} {{ trans('attributes.common.yen') }}"
                                                   disabled>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 m15t">
                                    <div class="row m0">
                                        <div class="col-12 col-xl-4">
                                            <span class="essential-text">
                                                {{ trans('attributes.essential.body.operating_balance') }}
                                            </span>
                                        </div>
                                        <div class="col-12 col-xl-8 essential-m10t">
                                            <input type="text" class="form-control essential-input text-right fs14 operating-expenses"
                                                   value="{{ $annualPerformance['sum_difference'] ? number_format($annualPerformance['sum_difference']) : "0" }} {{ trans('attributes.common.yen') }}"
                                                   disabled>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 m15t">
                                    <div class="row m0">
                                        <div class="col-12 col-xl-4">
                                            <span class="essential-text">
                                                {{ trans('attributes.essential.body.NOI_yield') }}
                                            </span>
                                        </div>
                                        <div class="col-12 col-xl-8 essential-m10t">
                                            <input type="text" class="form-control essential-input text-center fs14 noi-yield"
                                                   value="{{ number_format(division((float)$annualPerformance['sum_difference'] ?? 0 , (float)$generalInfo['price'] ?? 0), FLAG_TWO)  }}{{ trans('attributes.common.percent') }}"
                                                   disabled>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 m15t">
                                    <div class="row m0">
                                        <div class="col-12 col-xl-4">
                                            <span class="essential-text">
                                                {!! trans('attributes.property.assess_revenue_expenditure2') !!}
                                            </span>
                                        </div>
                                        <div class="col-12 col-xl-4 essential-m10t">
                                            <input id="area-rental-operating-unit" type="text"
                                                   class="form-control essential-input text-center fs14"
                                                   value="{{ $annualPerformance['synthetic_point'] ? number_format($annualPerformance['synthetic_point']) : "0" }} {{ trans('attributes.common.points') }}"
                                                   disabled>
                                            <input id="area-rental-operating" type="hidden"
                                                   class="form-control essential-input text-center fs14"
                                                   value="{{ $annualPerformance['synthetic_point'] ?? "0" }}" disabled>
                                        </div>
                                        <div class="col-12 col-xl-4 essential-m10t">
                                            <div class="essential-checkbox display-center">
                                                <input type="hidden" name="display_synthetic_point" value="0">
                                                <label class="container-input fw400 fs12">{{ trans('attributes.balance.body.checkbox_text') }}
                                                    <input type="checkbox" data-display="display-synthetic-point"
                                                           name="display_synthetic_point"
                                                           @if ($generalInfo['display_synthetic_point'] == 1) value="1"
                                                           checked @endif>
                                                    <span class="checkmark"></span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>

                        <div class="col-12 col-xl-6 p0r p15lr media-1199-m30t">
                            <div class="essential-body-special">
                                <div class="col-12">
                                    <span class="col-12 essential-body-title">
                                        {{ trans('attributes.essential.body.matters_concerning_leasehold') }}
                                    </span>
                                </div>

                                <div class="col-12 m15t">
                                    <div class="row m0">
                                        <div class="col-12 col-xl-4">
                                            <span class="essential-text">
                                                {{ trans('attributes.essential.body.leasehold_type') }}
                                            </span>
                                        </div>
                                        <div class="col-12 col-xl-8 essential-m10t">
                                            <input type="text" class="form-control essential-input text-center fs14"
                                                   value="{{ $property['type_rental']['name'] ?? "ー" }}" disabled>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 m15t">
                                    <div class="row m0">
                                        <div class="col-12 col-xl-4">
                                            <span class="essential-text">
                                                {{ trans('attributes.essential.body.leased_land_area') }}
                                            </span>
                                        </div>
                                        <div class="col-12 col-xl-4 essential-m10t">
                                            <input id="area-rent-unit" type="text"
                                                   class="form-control essential-input text-right fs14"
                                                   value="{{ $property['area_rent'] ? number_format($property['area_rent'], FLAG_TWO) : "0.00" }} {{ trans('attributes.common.m2') }}"
                                                   disabled>
                                            <input id="area-rent" type="text"
                                                   class="form-control essential-input text-right d-none"
                                                   value="{{ $property['area_rent'] ?? "0" }}" disabled>
                                        </div>
                                        <div class="col-12 col-xl-4 essential-m10t">
                                            <div class="essential-checkbox display-center">
                                                <input type="hidden" name="display_area_rent" value="0">
                                                <label class="container-input fw400 fs12">{{ trans('attributes.balance.body.checkbox_text') }}
                                                    <input id="display-area-rent" type="checkbox"
                                                           name="display_area_rent"
                                                           @if ($generalInfo['display_area_rent'] == 1) value="1"
                                                           checked @endif>
                                                    <span class="checkmark"></span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 m15t">
                                    <div class="row m0">
                                        <div class="col-12 col-xl-4">
                                            <span class="essential-text">
                                                {{ trans('attributes.essential.body.land_lease_period') }}
                                            </span>
                                        </div>
                                        <div class="col-12 col-xl-8 essential-m10t">
                                            <input type="text" class="form-control essential-input text-center fs14"
                                                   value="{{ $property['rental_period_from'] ? date("Y/m/d", strtotime($property['rental_period_from'])) : "ー" }}"
                                                   disabled>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 m15t">
                                    <div class="row m0">
                                        <div class="col-12 col-xl-4">
                                            <span class="essential-text">
                                                {{ trans('attributes.essential.body.during_the_lease_period') }}
                                            </span>
                                        </div>
                                        <div class="col-12 col-xl-8 essential-m10t">
                                            <input type="text" class="form-control essential-input text-center fs14"
                                                   value="{{ $property['rental_period_to'] ? date("Y/m/d", strtotime($property['rental_period_to'])) : "ー" }}"
                                                   disabled>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 m15t">
                                    <div class="row m0">
                                        <div class="col-12 col-xl-4">
                                            <span class="essential-text">
                                                {{ trans('attributes.essential.body.current_land_rent_agreement_date') }}<br>
                                                {{ trans('attributes.essential.body.latest_rent_update_date') }}
                                            </span>
                                        </div>
                                        <div class="col-12 col-xl-8 essential-m10t">
                                            <input type="text" class="form-control essential-input text-center fs14"
                                                   value="{{ $property['date_lease'] ? date("Y/m/d", strtotime($property['date_lease'])) : "ー" }}"
                                                   disabled>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 m15t">
                                    <div class="row m0">
                                        <div class="col-12 col-xl-4">
                                            <span class="essential-text">
                                                {{ trans('attributes.essential.body.security_deposit') }}
                                            </span>
                                        </div>
                                        <div class="col-12 col-xl-8 essential-m10t">
                                            <input type="text" class="form-control essential-input text-center fs14"
                                                   value="{{ $property['deposit_host'] == "" ? trans('attributes.common.no_stipulation') : $property['deposit_host'] }}"
                                                   disabled>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 m15t">
                                    <div class="row m0">
                                        <div class="col-12 col-xl-4">
                                            <span class="essential-text">
                                                {{ trans('attributes.essential.body.money') }}
                                            </span>
                                        </div>
                                        <div class="col-12 col-xl-8 essential-m10t">
                                            <input type="text" class="form-control essential-input text-center fs14"
                                                   value="{{ $property['prize_money'] == "" ? trans('attributes.common.no_stipulation') : $property['prize_money']   }}"
                                                   disabled>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 m15t">
                                    <div class="row m0">
                                        <div class="col-12 col-xl-4">
                                            <span class="essential-text">
                                                {{ trans('attributes.essential.body.nominal_book_change') }}
                                            </span>
                                        </div>
                                        <div class="col-12 col-xl-8 essential-m10t">
                                            <input type="text" class="form-control essential-input text-center fs14"
                                                   value="{{ $property['room_cede_fee'] == "" ? trans('attributes.common.no_stipulation') : $property['room_cede_fee'] }}"
                                                   disabled>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 m15t">
                                    <div class="row m0">
                                        <div class="col-12 col-xl-4">
                                            <span class="essential-text">
                                                {{ trans('attributes.essential.body.rebuilding_consent_fee') }}
                                            </span>
                                        </div>
                                        <div class="col-12 col-xl-8 essential-m10t">
                                            <input type="text" class="form-control essential-input text-center fs14"
                                                   value="{{ $property['fee_rebuild_rented_house'] == "" ? trans('attributes.common.no_stipulation') : $property['fee_rebuild_rented_house'] }}"
                                                   disabled>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 m15t">
                                    <div class="row m0">
                                        <div class="col-12 col-xl-4">
                                            <span class="essential-text">
                                                {{ trans('attributes.essential.body.update') }}
                                            </span>
                                        </div>
                                        <div class="col-12 col-xl-8 essential-m10t">
                                            <input type="text" class="form-control essential-input text-center fs14"
                                                   value="{{ $property['contract_update_fee'] == "" ? trans('attributes.common.no_stipulation') : $property['contract_update_fee'] }}"
                                                   disabled>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 m15t">
                                    <div class="row m0">
                                        <div class="col-12 col-xl-4">
                                            <span class="essential-text">
                                                {{ trans('attributes.essential.body.remarks') }}
                                            </span>
                                        </div>
                                        <div class="col-12 col-xl-8 essential-m10t">
                                            <input type="text" class="form-control essential-input text-center fs14"
                                                   value="{{ $property['notes'] ?? "ー" }}" disabled>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="p15lr">
                    <div class="m30t essential-body">
                        <div class="row m0">
                            <div class="col-12">
                                <span class="col-12 essential-body-title">
                                    {{ trans('attributes.essential.body.exam_preparation') }}
                                </span>
                            </div>

                            <div class="col-12 m15t">
                                <div class="row m0">
                                    <div class="col-12 col-xl-2">
                                        <span class="col-12 essential-text l32h">
                                            {{ trans('attributes.essential.body.access_road') }}
                                        </span>
                                    </div>
                                    <div class="col-12 col-xl-10">
                                        <input type="text" name="near_road"
                                               class="form-control essential-input essential-input-border text-left fs14"
                                               value="{{ $generalInfo['near_road'] }}"
                                               placeholder="{{ trans('attributes.essential.placeholder.near_road') }}">
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 m10t">
                                <div class="row m0">
                                    <div class="col-xl-2"></div>
                                    <div class="col-12 col-xl-2">
                                        <div class="essential-checkbox display-center">
                                            <input type="hidden" name="display_near_road" value="0">
                                            <label class="container-input fw400 fs12">{{ trans('attributes.balance.body.checkbox_text') }}
                                                <input data-display="display-near-road" type="checkbox" name="display_near_road" @if ($generalInfo['display_near_road'] == 1) value="1" checked @endif>
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 m15t">
                                <div class="row m0">
                                    <div class="col-12 col-xl-2">
                                    <span class="essential-text">
                                        {{ trans('attributes.essential.body.application_area') }}
                                    </span>
                                    </div>
                                    <div class="col-12 col-xl-10 essential-m10t">
                                    <textarea name="area_used" class="form-control essential-input-border text-left fs14" rows="5" placeholder="{{ trans('attributes.essential.placeholder.area_used_1') }}
{{ trans('attributes.essential.placeholder.area_used_2') }}
{{ trans('attributes.essential.placeholder.area_used_3') }}
{{ trans('attributes.essential.placeholder.area_used_4') }}
{{ trans('attributes.essential.placeholder.area_used_5') }}
                                        ">{{ $generalInfo['area_used'] }}</textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 m10t">
                                <div class="row m0">
                                    <div class="col-xl-2"></div>
                                    <div class="col-12 col-xl-2">
                                        <div class="essential-checkbox display-center">
                                            <input type="hidden" name="display_area_used" value="0">
                                            <label class="container-input fw400 fs12">{{ trans('attributes.balance.body.checkbox_text') }}
                                                <input data-display="display-area-used" type="checkbox" name="display_area_used" @if ($generalInfo['display_area_used'] == 1) value="1" checked @endif>
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 m15t">
                                <div class="row m0">
                                    <div class="col-12 col-xl-2">
                                    <span class="essential-text">
                                        {{ trans('attributes.essential.body.remarks') }}
                                    </span>
                                    </div>

                                    <div class="col-12 col-xl-10 essential-m10t">
                                    <textarea name="notes" class="form-control essential-input-border text-left fs14" rows="5" placeholder="{{ trans('attributes.essential.placeholder.area_used_1') }}
{{ trans('attributes.essential.placeholder.notes_1') }}
{{ trans('attributes.essential.placeholder.notes_2') }}
{{ trans('attributes.essential.placeholder.notes_3') }}
{{ trans('attributes.essential.placeholder.notes_4') }}
                                        ">{{ $generalInfo['notes'] }}</textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 m10t">
                                <div class="row m0">
                                    <div class="col-xl-2"></div>
                                    <div class="col-12 col-xl-2">
                                        <div class="essential-checkbox display-center">
                                            <input type="hidden" name="display_notes" value="0">
                                            <label class="container-input fw400 fs12">{{ trans('attributes.balance.body.checkbox_text') }}
                                                <input data-display="display-notes" type="checkbox" name="display_notes" @if ($generalInfo['display_notes'] == 1) value="1" checked @endif>
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 m15t">
                                <div class="row m0">
                                    <div class="col-12 col-xl-2">
                                        <span class="essential-text">
                                            {{ trans('attributes.essential.body.residential_building_trader') }}<br>
                                            {{ trans('attributes.essential.body.memo') }}
                                        </span>
                                    </div>
                                    <div class="col-12 col-xl-10 essential-m10t">
                                        <textarea name="memo_broker" class="form-control essential-input-border text-left fs14" rows="3" placeholder="{{ trans('attributes.essential.placeholder.memo') }}">{{ $generalInfo['memo_broker'] }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="p15lr">
                    <div class="m30t essential-body">
                        <div class="row m0">
                            <div class="col-12">
                                <span class="col-12 essential-body-title">
                                    {{ trans('attributes.essential.body.location') }}
                                </span>
                            </div>

                            <div class="col-12 m15t">
                                <div class="row m0">
                                    <div class="col-6 image-map-1">
                                        <span class="essential-sub-title">
                                            {{ trans('attributes.essential.body.location_map') }}
                                        </span>
                                        <div class="image-location-map-1 m5t">
                                            <div class="essential-img essential-icon-img border-0">
                                                @if(isset($generalInfo['map_image_1']))
                                                    <img class="img-preview-map" src="{{ asset('storage/imagesGeneralInfo/' . $generalInfo['map_image_1']) }}">
                                                @else
                                                    <img src="{{ asset('images/icon-img.png') }}">
                                                    <span class="m15t fw-bold fs16 hide-text text-black">{{ trans('attributes.essential.body.img_upload_text_1') }}</span>
                                                    <span class="m15t fs13 hide-text text-black">{{ trans('attributes.essential.body.img_upload_text_2') }}</span>
                                                    <span class="fs13 hide-text text-black">{{ trans('attributes.essential.body.img_upload_text_3') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <p class="error-message p5t m0" data-error="image-map-1"></p>
                                    </div>
                                    <div class="col-6 image-map-2">
                                        <span class="essential-sub-title">
                                            {{ trans('attributes.essential.body.public_map') }}
                                        </span>
                                        <div class="image-location-map-2 m5t">
                                            <div class="essential-img essential-icon-img border-0">
                                                @if(isset($generalInfo['map_image_2']))
                                                    <img class="img-preview-map" src="{{ asset('storage/imagesGeneralInfo/' . $generalInfo['map_image_2']) }}">
                                                @else
                                                    <img src="{{ asset('images/icon-img.png') }}">
                                                    <span class="m15t fw-bold fs16 hide-text text-black">{{ trans('attributes.essential.body.img_upload_text_1') }}</span>
                                                    <span class="m15t fs13 hide-text text-black">{{ trans('attributes.essential.body.img_upload_text_2') }}</span>
                                                    <span class="fs13 hide-text text-black">{{ trans('attributes.essential.body.img_upload_text_3') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <p class="error-message p5t m0" data-error="image-map-2"></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 m10t">
                                <span class="col-12 essential-sub-title m30t">
                                    {{ trans('attributes.essential.body.plan_view') }}
                                </span>
                            </div>
                            <div id="image-multiple-preview" class="col-12 row m0 m5t"></div>
                            <p class="error-message p5t m0" data-error="image-info"></p>
                        </div>
                    </div>
                </div>

                <div class="m30t p15lr">
                    <div class="row m0">
                        <div class="col-12 p0r text-right">
                            <button type="button" class="btn custom-btn-success fs15 btn-submit-summary btn-essential-submit">
                                {{ trans('attributes.essential.header.btn_confirm') }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <input type="hidden" name="property_id" value="{{ $property['id'] }}" style="display: none">
            <input id="input-image-map-1" type="file" name="map_image_1" style="display: none" multiple>
            <input id="input-image-map-2" type="file" name="map_image_2" style="display: none">
            <input type="hidden" name="paginate_previous" value="{{ request('option_paginate') }}" style="display: none">
            <input type="hidden" name="screen" value="{{ request('screen') }}" style="display: none">
        </div>

        @include('backend.property.essential_confirm')

        @foreach($generalImages as $item)
            <input  type="hidden" value="{{ $item['image_name_thumbnail'] }}" class="img-preview-info">
        @endforeach
        <div id="list-image-delete"></div>
    </form>
    <form id="form-select-year" action="{{ route(USER_ESSENTIAL, $property['id']) }}" method="GET">
        <input type="hidden" name="paginate_previous" value="{{ request('option_paginate') }}" style="display: none">
        <input type="hidden" name="screen" value="{{ request('screen') }}" style="display: none">
        <input type="hidden" name="year" value="" style="display: none">
    </form>
    @include('backend.preview_print.essential_print')
@endsection

@section('js')
    <script src="{{ asset('dist/js/essential-property.min.js') }}"></script>
@endsection
