@extends('layout.home.master')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/preview/single_analysis.css') }}">
@endsection

@section('content')
    <div class="container-fluid container-wrapper balance-full-view" id="single-analysis">
        <div class="essential-content">
            <div class="row m0 essential-header">
                <div class="col-12 p0 page-name media-575-p20l media-575-p20r p15lr">
                    <div class="row m0">
                        <span class="essential-title title-style fs28">{{ trans('attributes.balance.header.title') }}</span>
                        <span class="d-none d-sm-block fs28">&nbsp;-&nbsp;</span>
                    </div>
                    <span class="essential-title break-all page-house-name fs24 fs18-sp flex-end-vertical">{{ $property['house_name'] }}</span>
                </div>
                <div class="col-12 p0 m10t media-575-p20l media-575-p20r">
                    <div class="row m0">
                        <div class="col-12 p0 col-lg-8 p15lr">
                            <div class="btn-group m15t">
                                <button type="button" class="btn balance-custom-btn-secondary fw400 cursor-unset fs14 h41">{{ trans('attributes.balance.header.title_button_1') }}</button>
                                <button type="button" class="btn balance-custom-btn-default fw400 m15r cursor-unset fs14 w130 h41">{{ dateTimeFormatBorrowing($property['date_year_registration_revenue'], $property['date_month_registration_revenue']) }}</button>
                            </div>

                            <div class="btn-group dropdown-none-icon m15t">
                                <button type="button" class="btn balance-custom-btn-secondary fw400 cursor-unset fs14 h41">{{ trans('attributes.property.status') }}</button>
                                <button type="button" class="btn balance-custom-btn-default fw400 m15r cursor-unset fs14 h41">{{ STATUS_HOUSE[$property['status']] }}</button>
                            </div>
                            @if(in_array($currentUser->role, [BROKER, EXPERT]))
                                <div class="btn-group dropdown-none-icon m15t">
                                <button type="button" class="btn balance-custom-btn-secondary fw400 cursor-unset fs14 h41">
                                    {{ trans('attributes.register_info.item_block.label.proprietor_2') }}
                                </button>
                                <button type="button" class="btn balance-custom-btn-default fw400 cursor-unset fs14 h41 min-w100">{{ $property['proprietor'] ?? 'ー' }}</button>
                                <button class="btn custom-btn-primary m20l m10r dropdown-toggle d-block d-sm-none m20l h38" data-toggle="dropdown">{{ trans('attributes.balance.header.btn_choose') }}</button>
                                @include('backend.property.commonElements.dropdown_property')
                                </div>
                            @endif
                        </div>
                        <div class="col-12 p0 col-lg-4 text-right dropdown-none-icon p15lr">
                            <button class="btn custom-btn-primary m15t dropdown-toggle d-none d-sm-inline-block fs15 fs13-sp" data-toggle="dropdown">{{ trans('attributes.balance.header.btn_choose') }}</button>
                            @include('backend.property.commonElements.dropdown_property')
                            <button class="btn custom-btn-success btn-preview-single-analysis m15t m10l d-none d-sm-inline-block fs15 fs13-sp">
                                {{ trans('attributes.balance.header.btn_preview') }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row m0 balance-body m30t">
                <div class="col-lg-8 single-analysis-simulation-charts p15lr">
                    <div class="single-chart-content bg-white min-h545">
                        <p class="title-diagram text-left p20t p20l fs16 color-title-chart">{{ __('attributes.single_analysis.title_high_charts') }}</p>
                        <div id="chart-all"></div>
                        <p class="highcharts-description fs11 highcharts-notedes m20l" style="display: none">
                            {{ __('attributes.simulation_charts.note_1') }}<br/>
                            {{ __('attributes.simulation_charts.note_2') }}
                        </p>
                    </div>
                </div>
                <div class="col-lg-4 balance-m30t p15lr">
                    <input type="hidden" class="single-analysis-scatter-chart" value="{{$property['real_estate_type']['id']}}">
                    <div id="scatter-chart" class="single-chart-content h431 scatter-chart-single-analysis"></div>
                </div>
            </div>

            <div class="row m0 balance-body m30t">
                <div class="col-lg-4 p15lr">
                    <div id="box-plot-chart-1" class="single-chart-content h431">
                    </div>
                </div>

                <div class="col-lg-4 balance-m30t p15lr">
                    <div id="box-plot-chart-2" class="single-chart-content h431"></div>
                </div>

                <div class="col-lg-4 balance-m30t p15lr">
                    <div id="box-plot-chart-3" class="single-chart-content h431"></div>
                </div>
            </div>

            <div class="row m0 balance-body m30t">
                <div class="col-lg-4 p15lr">
                    <div id="box-plot-chart-4" class="single-chart-content h431"></div>
                </div>

                <div class="col-lg-4 balance-m30t p15lr">
                    <div id="box-plot-chart-5" class="single-chart-content h431"></div>
                </div>

                <div class="col-lg-4 balance-m30t p15lr">
                    <div id="box-plot-chart-6" class="single-chart-content h431"></div>
                </div>
            </div>

            <div class="row m0 balance-body m30t">
                <div class="col-lg-12 p0 text-right dropdown-none-icon p15lr media-575-p20r">
                    <button class="btn custom-btn-primary m5t m10r dropdown-toggle fs15 fs13-sp m0lr-sp" data-toggle="dropdown">{{ trans('attributes.balance.header.btn_choose') }}</button>
                    @include('backend.property.commonElements.dropdown_property')
                    <button class="btn custom-btn-success m5t btn-preview-single-analysis d-none d-sm-inline-block fs15 fs13-sp">
                        {{ trans('attributes.balance.header.btn_preview') }}
                    </button>
                </div>
            </div>

            <div class="row m0 balance-body m30t p15lr">
                <div class="balance-table">
                    <div class="row m0 br10 bg-white">
                        <div class="table-responsive fs14 portfolio-table table-main">
                            <table id="table-property" class="table table-bordered table-striped border-0 m0">
                                <tr class="table-head single-table-head">
                                    <td class="border-top-0 border-left-0 note-table-head" rowspan="2">
                                        <div class="centered-vertical">
                                            <span class="centered">
                                                <p class="m0">{{ trans('attributes.balance.body.table.target_real_estate') }}
                                                </p>
                                            </span>
                                        </div>
                                    </td>
                                    <td class="border-top-0 table-position">
                                        <div class="centered-vertical">
                                            <span class="centered">
                                                <p class="m0">{{ trans('attributes.borrowing.table.no') }}
                                                </p>
                                            </span>
                                        </div>
                                    </td>
                                    <td class="border-top-0 table-position">
                                        <div class="centered-vertical">
                                            <span class="centered">
                                                <p class="m0">{{ trans('attributes.balance.body.table.prefectures') }}
                                                </p>
                                            </span>
                                        </div>
                                    </td>
                                    <td class="border-top-0 table-position">
                                        <div class="centered-vertical">
                                            <span class="centered">
                                                <p class="m0">{{ trans('attributes.balance.body.location') }}<br>
                                                    ({{ trans('attributes.balance.body.table.urban_area') }})
                                                </p>
                                            </span>
                                        </div>
                                    </td>
                                    <td class="border-top-0 table-position">
                                        <div class="centered-vertical">
                                            <span class="centered">
                                                <p class="m0">{{ trans('attributes.balance.body.the_main_purpose') }}
                                                </p>
                                            </span>
                                        </div>
                                    </td>
                                    <td class="border-top-0 table-position">
                                        <div class="centered-vertical">
                                            <span class="centered">
                                                <p class="m0">{{ trans('attributes.balance.body.construction') }}
                                                </p>
                                            </span>
                                        </div>
                                    </td>
                                    <td class="border-top-0 table-position">
                                        <div class="centered-vertical">
                                            <span class="centered">
                                                <p class="m0">{{ trans('attributes.balance.body.floor') }}<br>
                                                    ({{ trans('attributes.balance.body.table.ground_floor') }})
                                                </p>
                                            </span>
                                        </div>
                                    </td>
                                    <td class="border-top-0 table-position">
                                        <div class="centered-vertical">
                                            <span class="centered">
                                                <p class="m0">{{ trans('attributes.balance.body.total_land_area') }}
                                                </p>
                                            </span>
                                        </div>
                                    </td>
                                    <td class="border-top-0 table-position">
                                        <div class="centered-vertical">
                                            <span class="centered">
                                                <p class="m0">{{ trans('attributes.balance.body.building_floor_area') }}
                                                </p>
                                            </span>
                                        </div>
                                    </td>
                                    <td class="border-top-0 table-position">
                                        <div class="centered-vertical">
                                            <span class="centered">
                                                <p class="m0">{{ trans('attributes.balance.body.table.year_of_completion') }}
                                                </p>
                                            </span>
                                        </div>
                                    </td>
                                    <td class="border-top-0 table-position">
                                        <div class="centered-vertical">
                                            <span class="centered">
                                                <p class="m0">{{ trans('attributes.balance.body.land_rights') }}
                                                </p>
                                            </span>
                                        </div>
                                    </td>
                                    <td class="border-top-0 table-position">
                                        <div class="centered-vertical">
                                            <span class="centered">
                                                <p class="m0">{{ trans('attributes.balance.body.building_rights') }}
                                                </p>
                                            </span>
                                        </div>
                                    </td>
                                    <td class="border-top-0 table-position">
                                        <div class="centered-vertical">
                                            <span class="centered">
                                                <p class="m0">{{ trans('attributes.balance.body.table.leasable_area') }}
                                                </p>
                                            </span>
                                        </div>
                                    </td>
                                    <td class="border-top-0 table-position">
                                        <div class="centered-vertical">
                                            <span class="centered">
                                                <p class="m0">{{ trans('attributes.balance.body.table.rent-a-file_ratio') }}<br>
                                                    ({{ trans('attributes.balance.body.table.bed_effective_rate') }})
                                                </p>
                                            </span>
                                        </div>
                                    </td>
                                    <td class="border-top-0 table-position">
                                        <div class="centered-vertical">
                                            <span class="centered">
                                                <p class="m0">{{ trans('attributes.balance.body.crop_yield') }}
                                                </p>
                                            </span>
                                        </div>
                                    </td>
                                    <td class="border-top-0 table-position">
                                        <div class="centered-vertical">
                                            <span class="centered">
                                                <p class="m0 text-online">{{ trans('attributes.balance.body.rent_income') }}<br>
                                                    ({{ trans('attributes.balance.body.table.monthly_basis') }})
                                                </p>
                                            </span>
                                        </div>
                                    </td>
                                    <td class="border-top-0 table-position">
                                        <div class="centered-vertical">
                                            <span class="centered">
                                                <p class="m0 text-online">{{ trans('attributes.balance.body.operating_revenue') }}<br>
                                                    ({{ trans('attributes.balance.body.table.per_m²') }})
                                                </p>
                                            </span>
                                        </div>
                                    </td>
                                    <td class="border-top-0 table-position">
                                        <div class="centered-vertical">
                                            <span class="centered">
                                                <p class="m0 text-online">{{ trans('attributes.balance.body.maintenance_management_fee') }}<br>
                                                    ({{ trans('attributes.balance.body.table.monthly_m²') }})
                                                </p>
                                            </span>
                                        </div>
                                    </td>
                                    <td class="border-top-0 table-position">
                                        <div class="centered-vertical">
                                            <span class="centered">
                                                <p class="m0 text-online">{{ trans('attributes.balance.body.repair_fee') }}<br>
                                                    ({{ trans('attributes.balance.body.table.per_m²') }})
                                                </p>
                                            </span>
                                        </div>
                                    </td>
                                    <td class="border-top-0 table-position">
                                        <div class="centered-vertical">
                                            <span class="centered">
                                                <p class="m0 text-online">{{ trans('attributes.balance.body.non-life_insurance_premiums') }}<br>
                                                    ({{ trans('attributes.balance.body.table.per_m²') }})
                                                </p>
                                            </span>
                                        </div>
                                    </td>
                                    <td class="border-top-0 border-right-0 table-position">
                                        <div class="centered-vertical">
                                            <span class="centered">
                                                <p class="m0 text-online">{{ trans('attributes.balance.body.operating_costs') }}<br>
                                                    ({{ trans('attributes.balance.body.table.per_m²') }})
                                                </p>
                                            </span>
                                        </div>
                                    </td>
                                    <td class="border-top-0 border-right-0 table-position">
                                        <div class="centered-vertical">
                                            <span class="centered">
                                                <p class="m0 text-online">{{ trans('attributes.balance.body.table.expense_ratio') }}<br>
                                                    ({{ trans('attributes.balance.body.operating_costs') }} ÷ {{ trans('attributes.balance.body.operating_revenue') }})
                                                </p>
                                            </span>
                                        </div>
                                    </td>
                                    <td class="border-top-0 border-right-0 table-position">
                                        <div class="centered-vertical">
                                            <span class="centered">
                                                <p class="m0 text-online">{{ trans('attributes.balance.body.operating_balance') }}<br>
                                                    ({{ trans('attributes.balance.body.table.per_m²') }})
                                                </p>
                                            </span>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="table-foot single-analysis-table-foot">
                                    <td class="border-0 text-center">ー</td>
                                    <td class="border-bottom-0 fw-bold text-left analysis-tooltip">
                                        {{ $property['address_city'] ?? "ー" }}
                                    </td>
                                    <td class="border-bottom-0 fw-bold text-left analysis-tooltip">
                                        {{ $property['address_district'] ?? "ー" }}
                                    </td>
                                    <td class="border-bottom-0 fw-bold text-left analysis-tooltip">
                                        {{ $property['real_estate_type']['name'] ?? "ー" }}
                                    </td>
                                    <td class="border-bottom-0 fw-bold text-left analysis-tooltip">
                                        {{ materialFormat($property['house_material']['name'], $property['house_roof_type']['name']) }}
                                    </td>
                                    <td class="border-bottom-0 fw-bold text-left analysis-tooltip">
                                        {{ $property['storeys'] ?? "ー" }}
                                    </td>
                                    <td class="border-bottom-0 fw-bold text-left analysis-tooltip">
                                        {{ number_format(excelRoundDown($property['ground_area'])) . trans('attributes.common.round_square_meters') }}
                                    </td>
                                    <td class="border-bottom-0 fw-bold text-left analysis-tooltip">
                                        {{ getValueByListLimited($property['real_estate_type_id'], $property['total_area_floors']) }}
                                    </td>
                                    <td class="border-bottom-0 fw-bold text-left analysis-tooltip">
                                        {{ !empty($property['construction_time']) ? getDecade($property['construction_time']) . ' ' . trans('attributes.common.decade') : "ー" }}
                                    </td>
                                    <td class="border-bottom-0 fw-bold text-left analysis-tooltip">
                                        {{ $property['land_right']['name'] ?? "ー" }}
                                    </td>
                                    <td class="border-bottom-0 fw-bold text-left analysis-tooltip">
                                        {{ $property['building_right']['name'] ?? "ー" }}
                                    </td>
                                    <td class="border-bottom-0 fw-bold text-center analysis-tooltip">
                                        {{ getValueByListLimited($property['real_estate_type_id'], $property['area_may_rent']) }}
                                    </td>
                                    <td class="border-bottom-0 fw-bold text-center analysis-tooltip">
                                        {{ division($property['area_may_rent'], $property['total_area_floors']) }} {{ trans('attributes.common.percent') }}
                                    </td>
                                    <td class="border-bottom-0 fw-bold text-center analysis-tooltip">
                                        {{ number_format($property['rental_percentage'], FLAG_TWO) }} {{ trans('attributes.common.percent') }}
                                    </td>
                                    <td class="border-bottom-0 fw-bold text-center analysis-tooltip">
                                        {{ numberFormatWithUnit(divisionNumber($property['revenue_room_rentals'] / FLAG_TWELVE, $property['total_area_floors'] * 0.3025), ' ' . trans('attributes.common.unit-3')) }}
                                    </td>
                                    <td class="border-bottom-0 fw-bold text-center analysis-tooltip">
                                        {{ numberFormatWithUnit($property['operating_revenue'] ?? FLAG_ZERO, ' ' . trans('attributes.common.unit-4')) }}
                                    </td>
                                    <td class="border-bottom-0 fw-bold text-center analysis-tooltip">
                                        {{ numberFormatWithUnit($property['maintenance_management_cost'] ?? FLAG_ZERO, ' ' . trans('attributes.common.unit-4')) }}
                                    </td>
                                    <td class="border-bottom-0 fw-bold text-center analysis-tooltip">
                                        {{ numberFormatWithUnit($property['repair_cost'] ?? FLAG_ZERO, ' ' . trans('attributes.common.unit-4')) }}
                                    </td>
                                    <td class="border-bottom-0 fw-bold text-center analysis-tooltip">
                                        {{ numberFormatWithUnit($property['insurance_premium'] ?? FLAG_ZERO, ' ' . trans('attributes.common.unit-4')) }}
                                    </td>
                                    <td class="border-bottom-0 fw-bold text-center analysis-tooltip">
                                        {{ numberFormatWithUnit(divisionNumber($property['total_cost'], $property['total_area_floors']), ' ' . trans('attributes.common.unit-4')) }}
                                    </td>
                                    <td class="border-bottom-0 fw-bold text-center analysis-tooltip">
                                        {{ numberFormatWithUnit($property['expense_ratio'] ?? FLAG_ZERO, ' ' . trans('attributes.common.percent'), FLAG_TWO) }}
                                    </td>
                                    <td class="border-bottom-0 fw-bold text-center analysis-tooltip">
                                        {{ numberFormatWithUnit($property['operating_balance'] ?? FLAG_ZERO, ' ' . trans('attributes.common.unit-4')) }}
                                    </td>
                                </tr>
                                @foreach($listPropertyTable as $key => $value)
                                    <tr class="table-body">
                                        @if($key + FLAG_ONE == FLAG_ONE)
                                            <td class="border-0 text-center fw-bold note-table-body" rowspan="{{ $countProperty }}">{{ trans('attributes.balance.body.table.real_estate_example') }}</td>
                                        @endif
                                        <td class="border-left-0 border-bottom-0 text-center border-top analysis-tooltip">
                                            {{ $key + FLAG_ONE }}
                                        </td>
                                        <td class="border-bottom-0 text-left analysis-tooltip">
                                            {{ $value['address_city'] ?? "ー" }}
                                        </td>
                                        <td class="border-bottom-0 text-left analysis-tooltip">
                                            {{ $value['address_district'] ?? "ー" }}
                                        </td>
                                        <td class="border-bottom-0 text-left analysis-tooltip">
                                            {{ $value['real_estate_type']['name'] ?? "ー" }}
                                        </td>
                                        <td class="border-bottom-0 text-left analysis-tooltip">
                                            {{ materialFormat($value['house_material']['name'], $value['house_roof_type']['name']) }}
                                        </td>
                                        <td class="border-bottom-0 text-left analysis-tooltip">
                                            {{ $value['storeys'] ?? "ー" }}
                                        </td>
                                        <td class="border-bottom-0 text-left analysis-tooltip">
                                            {{ number_format(excelRoundDown($value['ground_area'])) . trans('attributes.common.round_square_meters') }}
                                        </td>
                                        <td class="border-bottom-0 text-left analysis-tooltip">
                                            {{ $value['total_area_floors'] ? getValueByListLimited($value['real_estate_type_id'], $value['total_area_floors']) : "ー" }}
                                        </td>
                                        <td class="border-bottom-0 text-left analysis-tooltip">
                                            {{ !empty($value['construction_time']) ? getDecade($value['construction_time']) . ' ' . trans('attributes.common.decade') : "ー" }}
                                        </td>
                                        <td class="border-bottom-0 text-left analysis-tooltip">
                                            {{ $value['land_right']['name'] ?? "ー" }}
                                        </td>
                                        <td class="border-bottom-0 text-left analysis-tooltip">
                                            {{ $value['building_right']['name'] ?? "ー" }}
                                        </td>
                                        <td class="border-bottom-0 text-center analysis-tooltip">
                                            {{ $value['area_may_rent'] ? getValueByListLimited($value['real_estate_type_id'], $value['area_may_rent']) : "" }}
                                        </td>
                                        <td class="border-bottom-0 text-center analysis-tooltip">
                                            {{ division($value['area_may_rent'], $value['total_area_floors']) }} {{ trans('attributes.common.percent') }}
                                        </td>
                                        <td class="border-bottom-0 text-center analysis-tooltip">
                                            {{ number_format($value['rental_percentage'], FLAG_TWO) }} {{ trans('attributes.common.percent') }}
                                        </td>
                                        <td class="border-bottom-0 text-center analysis-tooltip">
                                            {{ numberFormatWithUnit(divisionNumber($value['revenue_room_rentals'] / FLAG_TWELVE, $value['total_area_floors'] * 0.3025), ' ' . trans('attributes.common.unit-3')) }}
                                        </td>
                                        <td class="border-bottom-0 text-center analysis-tooltip">
                                            {{ numberFormatWithUnit($value['operating_revenue'] ?? FLAG_ZERO, ' ' . trans('attributes.common.unit-4')) }}
                                        </td>
                                        <td class="border-bottom-0 text-center analysis-tooltip">
                                            {{ numberFormatWithUnit($value['maintenance_management_cost'] ?? FLAG_ZERO, ' ' . trans('attributes.common.unit-4')) }}
                                        </td>
                                        <td class="border-bottom-0 text-center analysis-tooltip">
                                            {{ numberFormatWithUnit($value['repair_cost'] ?? FLAG_ZERO, ' ' . trans('attributes.common.unit-4')) }}
                                        </td>
                                        <td class="border-bottom-0 text-center analysis-tooltip">
                                            {{ numberFormatWithUnit($value['insurance_premium'] ?? FLAG_ZERO, ' ' . trans('attributes.common.unit-4')) }}
                                        </td>
                                        <td class="border-bottom-0 text-center analysis-tooltip">
                                            {{ numberFormatWithUnit(divisionNumber($value['total_cost'], $value['total_area_floors']), ' ' . trans('attributes.common.unit-4')) }}
                                        </td>
                                        <td class="border-bottom-0 text-center analysis-tooltip">
                                            {{ numberFormatWithUnit($value['expense_ratio'] ?? FLAG_ZERO, ' ' . trans('attributes.common.percent'), FLAG_TWO) }}
                                        </td>
                                        <td class="border-bottom-0 text-center analysis-tooltip">
                                            {{ numberFormatWithUnit($value['operating_balance'] ?? FLAG_ZERO, ' ' . trans('attributes.common.unit-4')) }}
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row m0 balance-body m30t">
                <div class="col-12 col-xl-4 m30b p15lr">
                    <div class="diagram-block">
                        <div id="container-1"></div>
                    </div>
                </div>
                <div class="col-12 col-xl-4 m30b p15lr">
                    <div class="diagram-block">
                        <div id="container-2"></div>
                    </div>
                </div>
                <div class="col-12 col-xl-4 m30b p15lr">
                    <div class="diagram-block">
                        <div id="container-3"></div>
                    </div>
                </div>
                <div class="col-12 col-xl-4 m30b p15lr">
                    <div class="diagram-block">
                        <div id="container-4"></div>
                    </div>
                </div>
                <div class="col-12 col-xl-4 m30b p15lr">
                    <div class="diagram-block">
                        <div id="container-5"></div>
                    </div>
                </div>
                <div class="col-12 col-xl-4 m30b p15lr">
                    <div class="diagram-block">
                        <div id="container-6"></div>
                    </div>
                </div>
            </div>

            {{--Data--}}
            <div class="balance-body">
                <div class="row m0">
                    <div class="col-12 col-1500-4 p0 m30b p15lr">
                        <div class="row m0">
                            <div class="col-12 p0 balance-body-content">
                                <div class="row m0">
                                    <div class="col-12 p0">
                                        <span class="balance-body-title">
                                            {{ trans('attributes.balance.body.thing') }}
                                        </span>
                                    </div>
                                    <div class="col-12 p0 m25t">
                                        <div class="row m0">
                                            <div class="col-4 p0 centered-vertical">
                                            <span class="balance-text">
                                                {{ trans('attributes.single_analysis.property_name') }}
                                            </span>
                                            </div>
                                            <div class="col-8 p0 centered-vertical">
                                                <span class="fs14 text-left break-all custom-input" readonly="readonly">{{ $property['house_name'] }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 p0 m10t">
                                        <div class="row m0">
                                            <div class="col-4 p0 centered-vertical">
                                                <span class="balance-text">
                                                    {{ trans('attributes.balance.body.location') }}
                                                </span>
                                            </div>
                                            <div class="col-8 p0 centered-vertical">
                                                <input class="form-control balance-no-border-radius balance-input-text fs14 text-left" type="text" readonly="readonly"
                                                       value="{{ addressFormat($property['address_city'], $property['address_district'], $property['address_town']) }}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 p0 m10t">
                                        <div class="row m0">
                                            <div class="col-4 p0 centered-vertical">
                                                <span class="balance-text">
                                                    {{ trans('attributes.balance.body.the_main_purpose') }}
                                                </span>
                                            </div>
                                            <div class="col-8 p0 centered-vertical">
                                                <input class="form-control balance-no-border-radius balance-input-text fs14 text-center" type="text"
                                                       value="{{ $property['real_estate_type']['name'] ?? "ー" }}" readonly="readonly">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 p0 m10t">
                                        <div class="row m0">
                                            <div class="col-4 p0 centered-vertical">
                                                <span class="balance-text">
                                                    {{ trans('attributes.balance.body.use_in_detail') }}
                                                </span>
                                            </div>
                                            <div class="col-8 p0 centered-vertical">
                                                <input class="form-control balance-no-border-radius balance-input-text fs14 text-center" type="text"
                                                       value="{{ $property['detail_real_estate_type']['name'] ?? "ー" }}" readonly="readonly">
                                            </div>
                                        </div>
                                    </div>

                                    @if($property['main_application'] != null)
                                        <div class="col-12 p0 m10t">
                                            <div class="row m0">
                                                <div class="col-4 p0 centered-vertical">
                                                    <span class="balance-text">
                                                        {{ trans('attributes.property.main_application') }}
                                                    </span>
                                                </div>
                                                <div class="col-8 p0 centered-vertical">
                                                    <input class="form-control balance-no-border-radius balance-input-text fs14 text-center" type="text"
                                                           value="{{ $property['main_application'] ? MAIN_APPLICATION[$property['main_application']] : "ー" }}" readonly="readonly">
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                    <div class="col-12 p0 m10t">
                                        <div class="row m0">
                                            <div class="col-4 p0 centered-vertical">
                                                <span class="balance-text">
                                                    {{ trans('attributes.balance.body.construction') }}
                                                </span>
                                            </div>
                                            <div class="col-8 p0 centered-vertical">
                                                <input class="form-control balance-no-border-radius balance-input-text fs14 text-center" type="text"
                                                       value="{{ materialFormat($property['house_material']['name'], $property['house_roof_type']['name']) }}" readonly="readonly">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 p0 m10t">
                                        <div class="row m0">
                                            <div class="col-4 p0 centered-vertical">
                                                <span class="balance-text">
                                                    {{ trans('attributes.balance.body.floor') }}
                                                </span>
                                            </div>
                                            <div class="col-8 p0 centered-vertical">
                                                <input class="form-control balance-no-border-radius balance-input-text fs14 text-center" type="text"
                                                       value="{{ materialFormat($property['basement'], $property['storeys'])}}" readonly="readonly">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 p0 m10t">
                                        <div class="row m0">
                                            <div class="col-4 p0 centered-vertical">
                                                <span class="balance-text">
                                                    {{ trans('attributes.balance.body.total_land_area') }}
                                                </span>
                                            </div>
                                            <div class="col-4 p0l">
                                                <input class="form-control balance-no-border-radius balance-input-text fs14 text-right" type="text"
                                                       value="{{ $property['ground_area'] ? number_format($property['ground_area'], FLAG_TWO) : "0.00" }} {{ trans('attributes.common.square_meters') }}" readonly="readonly">
                                            </div>
                                            <div class="col-4 p0r">
                                                <input class="form-control balance-no-border-radius balance-input-text fs14 text-right" type="text"
                                                       value="{{ $property['ground_area'] ? number_format($property['ground_area'] * 0.3025, FLAG_TWO) : "0.00" }} {{ trans('attributes.common.unit2') }}" readonly="readonly">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 p0 m10t">
                                        <div class="row m0">
                                            <div class="col-4 p0 centered-vertical">
                                                <span class="balance-text">
                                                    {{ trans('attributes.balance.body.building_floor_area') }}
                                                </span>
                                            </div>
                                            <div class="col-4 p0l">
                                                <input class="form-control balance-no-border-radius balance-input-text fs14 text-right" type="text"
                                                       value="{{ $property['total_area_floors'] ? number_format($property['total_area_floors'], FLAG_TWO) : "0.00" }} {{ trans('attributes.common.square_meters') }}" readonly="readonly">
                                            </div>
                                            <div class="col-4 p0r">
                                                <input class="form-control balance-no-border-radius balance-input-text fs14 text-right" type="text"
                                                       value="{{ $property['total_area_floors'] ? number_format($property['total_area_floors'] * 0.3025, FLAG_TWO) : "0" }} {{ trans('attributes.common.unit2') }}" readonly="readonly">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 p0 m10t">
                                        <div class="row m0">
                                            <div class="col-4 p0 centered-vertical">
                                                    <span class="balance-text">
                                                        {{ trans('attributes.balance.body.date_of_completion') }}
                                                    </span>
                                            </div>
                                            <div class="col-8 p0 centered-vertical">
                                                <input class="form-control balance-no-border-radius balance-input-text fs14 text-center" type="text"
                                                       value="{{ $property['construction_time'] ? dateTimeFormat($property['construction_time']) : "ー" }}" readonly="readonly">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 p0 balance-body-content m30t">
                                <div class="row m0">
                                    <div class="col-12 p0">
                                        <span class="balance-body-title">
                                            {{ trans('attributes.balance.body.rights_mode') }}
                                        </span>
                                    </div>

                                    <div class="col-12 p0 m25t">
                                        <div class="row m0">
                                            <div class="col-4 p0 centered-vertical">
                                                <span class="balance-text">
                                                    {{ trans('attributes.balance.body.land_rights') }}
                                                </span>
                                            </div>
                                            <div class="col-8 p0 centered-vertical">
                                                <input class="form-control balance-no-border-radius balance-input-text fs14 text-center" type="text"
                                                       value="{{ $property['land_right']['name'] ?? "ー" }}" readonly="readonly">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 p0 m10t">
                                        <div class="row m0">
                                            <div class="col-4 p0 centered-vertical">
                                                <span class="balance-text">
                                                    {{ trans('attributes.balance.body.building_rights') }}
                                                </span>
                                            </div>
                                            <div class="col-8 p0 centered-vertical">
                                                <input class="form-control balance-no-border-radius balance-input-text fs14 text-center" type="text"
                                                       value="{{ $property['building_right']['name'] ?? "ー" }}" readonly="readonly">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 p0 m10t">
                                        <div class="row m0">
                                            <div class="col-4 p0 centered-vertical">
                                                <span class="balance-text">
                                                    {{ trans('attributes.balance.body.total_number_of_tenants') }}
                                                </span>
                                            </div>
                                            <div class="col-8 p0 centered-vertical">
                                                <input class="form-control balance-no-border-radius balance-input-text fs14 text-center" type="text"
                                                       value="{{ number_format($property['total_tenants']) }}" readonly="readonly">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 p0 balance-body-content m30t">
                                <div class="row m0">
                                    <div class="col-12 p0">
                                        <span class="balance-body-title">
                                            {{ trans('attributes.balance.body.matters_concerning_rights') }}
                                        </span>
                                    </div>

                                    <div class="col-12 p0 m25t">
                                        <div class="row m0">
                                            <div class="col-4 p0 centered-vertical">
                                                <span class="balance-text">
                                                    {{ trans('attributes.balance.body.leasable_area') }}
                                                </span>
                                            </div>
                                            <div class="col-8 p0 centered-vertical">
                                                <input class="form-control balance-no-border-radius balance-input-text fs14 text-right" type="text"
                                                       value="{{ $property['area_may_rent'] ? number_format($property['area_may_rent'], FLAG_TWO) : "0.00" }} {{ trans('attributes.common.square_meters') }}" readonly="readonly">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 p0 m10t">
                                        <div class="row m0">
                                            <div class="col-4 p0 centered-vertical">
                                                <span class="balance-text">
                                                    {{ trans('attributes.balance.body.for_rent') }}<br>
                                                    {{ trans('attributes.balance.body.floor_rate') }}
                                                </span>
                                            </div>
                                            <div class="col-8 p0 centered-vertical">
                                                <input class="form-control balance-no-border-radius balance-input-text fs14 text-center" type="text"
                                                       value="{{ division((float)$property['area_may_rent'] ?? 0 , (float)$property['total_area_floors'] ?? 0)  }} {{ trans('attributes.common.percent') }}" readonly="readonly">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 p0 m10t">
                                        <div class="row m0">
                                            <div class="col-4 p0 centered-vertical">
                                                <span class="balance-text">
                                                    {{ trans('attributes.balance.body.rental_operating_area') }}
                                                </span>
                                            </div>
                                            <div class="col-8 p0 centered-vertical">
                                                <input class="form-control balance-no-border-radius balance-input-text fs14 text-right" type="text"
                                                       value="{{ $property['area_rental_operating'] ? number_format($property['area_rental_operating'], FLAG_TWO) : "0.00" }} {{ trans('attributes.common.square_meters') }}" readonly="readonly">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 p0 m10t">
                                        <div class="row m0">
                                            <div class="col-4 p0 centered-vertical">
                                                <span class="balance-text">
                                                    {{ trans('attributes.balance.body.crop_yield') }}
                                                </span>
                                            </div>
                                            <div class="col-8 p0 centered-vertical">
                                                <input class="form-control balance-no-border-radius balance-input-text fs14 text-center" type="text"
                                                       value="{{ numberFormatWithUnit($property['rental_percentage'], " " . trans('attributes.common.percent'), FLAG_TWO) }}" readonly="readonly">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 p0 m10t">
                                        <div class="row m0">
                                            <div class="col-4 p0 centered-vertical">
                                                <span class="balance-text">
                                                    {{ trans('attributes.balance.body.deposit_guarantor') }}
                                                </span>
                                            </div>
                                            <div class="col-8 p0 centered-vertical">
                                                <input class="form-control balance-no-border-radius balance-input-text fs14 text-right" type="text"
                                                       value="{{ $property['deposits'] ? number_format($property['deposits']) : "0" }} {{ trans('attributes.common.yen') }}" readonly="readonly">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 p0 balance-body-content m30t">
                                <div class="row m0">
                                    <div class="col-12 p0">
                                        <span class="balance-body-title">
                                            {{ trans('attributes.balance.body.leasehold') }}
                                        </span>
                                    </div>

                                    <div class="col-12 p0 m25t">
                                        <div class="row m0">
                                            <div class="col-4 p0 centered-vertical">
                                                <span class="balance-text">
                                                    {{ trans('attributes.balance.body.leasehold_type') }}
                                                </span>
                                            </div>
                                            <div class="col-8 p0 centered-vertical">
                                                <input class="form-control balance-no-border-radius balance-input-text fs14 text-left" type="text"
                                                       value="{{ $property['type_rental']['name'] ?? "ー" }}" readonly="readonly">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 p0 m10t">
                                        <div class="row m0">
                                            <div class="col-4 p0 centered-vertical">
                                                <span class="balance-text">
                                                    {{ trans('attributes.balance.body.leased_land_area') }}
                                                </span>
                                            </div>
                                            <div class="col-8 p0 centered-vertical">
                                                <input class="form-control balance-no-border-radius balance-input-text fs14 text-right" type="text"
                                                       value="{{ $property['area_rent'] ? number_format($property['area_rent'], FLAG_TWO) : "0.00" }} {{ trans('attributes.common.square_meters') }}" readonly="readonly">
                                                <input id="input-area-rent" type="hidden" value="{{ $property['area_rent'] ?? '0.00' }}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 p0 m10t">
                                        <div class="row m0">
                                            <div class="col-4 p0 centered-vertical">
                                                <span class="balance-text">
                                                    {{ trans('attributes.balance.body.lease_period_own') }}
                                                </span>
                                            </div>
                                            <div class="col-8 p0 centered-vertical">
                                                <input class="form-control balance-no-border-radius balance-input-text fs14 text-center" type="text"
                                                       value="{{ $property['rental_period_from'] ? dateTimeFormat($property['rental_period_from']) : "ー" }}" readonly="readonly">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 p0 m10t">
                                        <div class="row m0">
                                            <div class="col-4 p0 centered-vertical">
                                                <span class="balance-text">
                                                    {{ trans('attributes.balance.body.lease_period_to') }}
                                                </span>
                                            </div>
                                            <div class="col-8 p0 centered-vertical">
                                                <input class="form-control balance-no-border-radius balance-input-text fs14 text-center" type="text"
                                                       value="{{ $property['rental_period_to'] ? dateTimeFormat($property['rental_period_to']) : "ー" }}" readonly="readonly">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 p0 m10t">
                                        <div class="row m0">
                                            <div class="col-4 p0 centered-vertical">
                                                <span class="balance-text">
                                                    {{ trans('attributes.balance.body.current_rent_agreement_date') }}<br>
                                                    {{ trans('attributes.balance.body.latest_rent_update_date') }}
                                                </span>
                                            </div>
                                            <div class="col-8 p0 centered-vertical centered-vertical">
                                                <input class="form-control balance-no-border-radius balance-input-text fs14 text-center" type="text"
                                                       value="{{ $property['date_lease'] ? dateTimeFormat($property['date_lease']) : "ー" }}" readonly="readonly">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 p0 m10t">
                                        <div class="row m0">
                                            <div class="col-4 p0 centered-vertical">
                                                <span class="balance-text">
                                                    {{ trans('attributes.balance.body.security_deposit') }}
                                                </span>
                                            </div>
                                            <div class="col-8 p0 centered-vertical">
                                                <input class="form-control balance-no-border-radius balance-input-text fs14 text-center" type="text"
                                                       value="{{ $property['deposit_host'] == "" ? trans('attributes.common.no_stipulation') : $property['deposit_host'] }}" readonly="readonly">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 p0 m10t">
                                        <div class="row m0">
                                            <div class="col-4 p0 centered-vertical">
                                                <span class="balance-text">
                                                    {{ trans('attributes.balance.body.royalties') }}
                                                </span>
                                            </div>
                                            <div class="col-8 p0 centered-vertical">
                                                <input class="form-control balance-no-border-radius balance-input-text fs14 text-center" type="text"
                                                       value="{{ $property['prize_money'] == "" ? trans('attributes.common.no_stipulation') : $property['prize_money'] }}" readonly="readonly">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 p0 m10t">
                                        <div class="row m0">
                                            <div class="col-4 p0 centered-vertical">
                                                <span class="balance-text">
                                                    {{ trans('attributes.balance.body.nominal_book_change') }}
                                                </span>
                                            </div>
                                            <div class="col-8 p0 centered-vertical">
                                                <input class="form-control balance-no-border-radius balance-input-text fs14 text-center" type="text"
                                                       value="{{ $property['room_cede_fee'] == "" ? trans('attributes.common.no_stipulation') : $property['room_cede_fee'] }}" readonly="readonly">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 p0 m10t">
                                        <div class="row m0">
                                            <div class="col-4 p0 centered-vertical">
                                                <span class="balance-text">
                                                    {{ trans('attributes.single_analysis.reconstruction_permission_fee') }}
                                                </span>
                                            </div>
                                            <div class="col-8 p0 centered-vertical">
                                                <input class="form-control balance-no-border-radius balance-input-text fs14 text-center" type="text"
                                                       value="{{ $property['fee_rebuild_rented_house'] == "" ? trans('attributes.common.no_stipulation') : $property['fee_rebuild_rented_house'] }}" readonly="readonly">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 p0 m10t">
                                        <div class="row m0">
                                            <div class="col-4 p0 centered-vertical">
                                                <span class="balance-text">
                                                    {{ trans('attributes.balance.body.update') }}
                                                </span>
                                            </div>
                                            <div class="col-8 p0 centered-vertical">
                                                <input class="form-control balance-no-border-radius balance-input-text fs14 text-center" type="text"
                                                       value="{{ $property['contract_update_fee'] == "" ? trans('attributes.common.no_stipulation') : $property['contract_update_fee'] }}" readonly="readonly">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 p0 m10t">
                                        <div class="row m0">
                                            <div class="col-4 p0 centered-vertical">
                                                <span class="balance-text">
                                                    {{ trans('attributes.property.notes') }}
                                                </span>
                                            </div>
                                            <div class="col-8 p0 centered-vertical">
                                                <input class="form-control balance-no-border-radius balance-input-text fs14 text-center" type="text"
                                                       value="{{ $property['notes'] ?? "ー" }}" readonly="readonly">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-1500-8 p0 p15lr">
                        <div class="row m0">
                            <div class="col-12 p0 balance-body-content">
                                <div class="row m0">
                                    <div class="row col-12 p0">
                                        <div class="col-6">
                                             <span class="balance-body-title">{{ trans('attributes.balance.body.operating_revenue') }}</span>
                                        </div>
                                        <div class="col-6 align-items-center m0 p0 p20l">
                                            <span class="balance-body-title">{{ trans('attributes.balance.preview.table_3.table_head') }}</span>
                                        </div>
                                    </div>

                                    <div class="col-12 p0 text-right">
                                        <span class="fs12">
                                            ({{ trans('attributes.common.yen') }})
                                        </span>
                                    </div>
                                    @php( $showInput0 = ($property['real_estate_type_id'] == FLAG_TEN || $property['real_estate_type_id'] == FLAG_NINE) )
                                    @if($showInput0)
                                        <div class="col-12 p0 m5t">
                                            <div class="row m0">
                                                <div class="col-4 p0 centered-vertical">
                                                <span class="balance-text">
                                                    {{ __('attributes.register_info.item_block.label.rent_income') }}<br>
                                                        {{ __('attributes.register_info.item_block.label.rent_income_1') }}
                                                </span>
                                                </div>
                                                <div class="col-8 p0 centered-vertical">
                                                    <span class="fs12 balance-w8 balance-number-input">0</span>
                                                    <input class="form-control balance-no-border-radius balance-input-text fs14 balance-w92 text-right" type="text"
                                                           value="{{ $property['revenue_land_taxes'] ? number_format($property['revenue_land_taxes']) : "0" }}" readonly="readonly">
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                    <div class="row col-12 p0 @if($showInput0) m10t @else m5t @endif">
                                        <div class="col-12 col-sm-6">
                                            <div class="row m0 h-100">
                                                <div class="col-4 p0 centered-vertical">
                                                <span class="balance-text">
                                                    {{ trans('attributes.balance.body.rent_income') }}
                                                </span>
                                                </div>
                                                <div class="col-8 p0 centered-vertical">
                                                    <span class="fs12 balance-w8 balance-number-input">1</span>
                                                    <input type="text" class="d-none revenue_land_taxes" value="{{ $property['revenue_land_taxes'] ?? "0"}}">
                                                    <input class="form-control balance-no-border-radius balance-input-text fs14 balance-w92 text-right" type="text"
                                                           value="{{ $property['revenue_room_rentals'] ? number_format($property['revenue_room_rentals']) : "0" }}" readonly="readonly">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-6 d-flex align-items-center m0 p0 p20l p10t-sp">
                                            <div class="m0l w-100">
                                                <div class="d-flex flex-wrap m0 p0">
                                                    <div class="p0 d-flex align-items-center">
                                                        <span class="d-inline-block fs14">{{ trans('attributes.balance.preview.table_3.title_1') }}</span>
                                                    </div>
                                                    <div class="col-4 p0">
                                                        <div class="col-12 m15l p0">
                                                            <input name="basis_for_calculation_1" class="disable-field form-control text-left fs14" id="basis_for_calculation_1" disabled
                                                                   value="{{ numberFormatWithUnit(basisCalculationBusinessPlan($property['revenue_room_rentals'], number_format($property['total_area_floors'] * 0.3025, FLAG_TWO), FLAG_MAX_MONTH), ' ' . trans('attributes.common.unit-3')) }}">
                                                        </div>
                                                    </div>
                                                    <div class="m20l p0 d-flex align-items-center">
                                                        <span class="d-inline-block fs14">{{ trans('attributes.balance.preview.table_3.unit') }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row col-12 p0 m10t">
                                        <div class="col-12 col-sm-6">
                                            <div class="row m0 h-100">
                                                <div class="col-4 p0 centered-vertical">
                                                <span class="balance-text">
                                                    {{ trans('attributes.balance.body.common_service_revenue') }}
                                                </span>
                                                </div>
                                                <div class="col-8 p0 centered-vertical">
                                                    <span class="fs12 balance-w8 balance-number-input">2</span>
                                                    <input class="form-control balance-no-border-radius balance-input-text fs14 balance-w92 text-right" type="text"
                                                           value="{{ $property['revenue_service_charges'] ? number_format($property['revenue_service_charges']) : "0" }}" readonly="readonly">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-6 d-flex align-items-center m0 p0 p20l p10t-sp">
                                            <div class="m0l w-100">
                                                <div class="d-flex flex-wrap m0 p0">
                                                    <div class="p0 d-flex align-items-center">
                                                        <span class="d-inline-block fs14">{{ trans('attributes.balance.preview.table_3.title_1') }}</span>
                                                    </div>
                                                    <div class="col-4 p0">
                                                        <div class="col-12 m15l p0 ">
                                                            <input name="basis_for_calculation_2"  class="disable-field form-control text-left fs14" id="basis_for_calculation_2" disabled
                                                                   value="{{ numberFormatWithUnit(basisCalculationBusinessPlan($property['revenue_service_charges'], number_format($property['total_area_floors'] * 0.3025, FLAG_TWO), FLAG_MAX_MONTH), ' ' . trans('attributes.common.unit-3')) }}">
                                                        </div>
                                                    </div>
                                                    <div class="m20l p0 d-flex align-items-center">
                                                        <span class="d-inline-block fs14">{{ trans('attributes.balance.preview.table_3.unit') }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row col-12 p0 m10t">
                                        <div class="col-12 col-sm-6">
                                            <div class="row m0 h-100">
                                                <div class="col-4 p0 centered-vertical">
                                                <span class="balance-text">
                                                    {{ trans('attributes.balance.body.utilities_expenses_revenue') }}
                                                </span>
                                                </div>
                                                <div class="col-8 p0 centered-vertical">
                                                    <span class="fs12 balance-w8 balance-number-input">3</span>
                                                    <input class="form-control balance-no-border-radius balance-input-text fs14 balance-w92 text-right" type="text"
                                                           value="{{ $property['revenue_utilities'] ? number_format($property['revenue_utilities']) : "0" }}" readonly="readonly">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-6 d-flex align-items-center m0 p0 p20l p10t-sp">
                                            <div class="m0l w-100">
                                                <div class="d-flex flex-wrap m0 p0">
                                                    <div class="p0 d-flex align-items-center">
                                                        <span class="d-inline-block fs14">{{ trans('attributes.balance.preview.table_3.title_1') }}</span>
                                                    </div>
                                                    <div class="col-4 p0">
                                                        <div class="col-12 m15l p0 ">
                                                            <input name="basis_for_calculation_2" class="disable-field form-control text-left fs14" id="basis_for_calculation_2" disabled
                                                                   value="{{ numberFormatWithUnit(basisCalculationBusinessPlan($property['revenue_utilities'], number_format($property['total_area_floors'] * 0.3025, FLAG_TWO), FLAG_MAX_MONTH), ' ' . trans('attributes.common.unit-3')) }}">
                                                        </div>
                                                    </div>
                                                    <div class="m20l p0 d-flex align-items-center">
                                                        <span class="d-inline-block fs14">{{ trans('attributes.balance.preview.table_3.unit') }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row col-12 p0 m10t">
                                        <div class="col-12 col-sm-6">
                                            <div class="row m0 h-100">
                                                <div class="col-4 p0 centered-vertical">
                                                <span class="balance-text">
                                                    {{ trans('attributes.balance.body.parking_revenue') }}
                                                </span>
                                                </div>
                                                <div class="col-8 p0 centered-vertical">
                                                    <span class="fs12 balance-w8 balance-number-input">4</span>
                                                    <input class="form-control balance-no-border-radius balance-input-text fs14 balance-w92 text-right" type="text"
                                                           value="{{ $property['revenue_car_deposits'] ? number_format($property['revenue_car_deposits']) : "0" }}" readonly="readonly">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-6 d-flex align-items-center m0 p0 p20l p10t-sp">
                                            <div class="m0l w-100">
                                                <div class="d-flex flex-wrap m0 p0">
                                                    <div class="p0 d-flex align-items-center">
                                                        <span class="d-inline-block fs14">≒</span>
                                                    </div>
                                                    <div class="col-4 p0">
                                                        <div class="col-12 m15l p0">
                                                            <input name="basis_for_calculation_4" class="disable-field form-control text-left fs14" id="basis_for_calculation_4" disabled
                                                                   value="{{ numberFormatWithUnit($property['revenue_car_deposits'] / FLAG_MAX_MONTH, ' ' . trans('attributes.common.yen')) }}">
                                                        </div>
                                                    </div>
                                                    <div class="m20l p0 d-flex align-items-center">
                                                        <span class="d-inline-block fs14">{{ trans('attributes.balance.preview.table_3.unit') }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row col-12 p0 m10t">
                                        <div class="col-12 col-sm-6">
                                            <div class="row m0 h-100">
                                                <div class="col-4 p0 centered-vertical">
                                                <span class="balance-text">
                                                    {{ trans('attributes.balance.body.key_money_and_royalties') }}
                                                </span>
                                                </div>
                                                <div class="col-8 p0 centered-vertical">
                                                    <span class="fs12 balance-w8 balance-number-input">5</span>
                                                    <input class="form-control balance-no-border-radius balance-input-text fs14 balance-w92 text-right" type="text"
                                                           value="{{ $property['turnover_revenue'] ? number_format($property['turnover_revenue']) : "0" }}" readonly="readonly">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-6 d-flex align-items-center m0 p0 p20l p10t-sp">
                                            <div class="m0l w-100">
                                                <div class="d-flex flex-wrap m0 p0">
                                                    <div class="p0 d-flex align-items-center">
                                                        <span class="d-inline-block fs14">{{ trans('attributes.balance.preview.table_3.title_2') }}</span>
                                                    </div>
                                                    <div class="col-4 p0">
                                                        <div class="col-12 m15l p0">
                                                            <input name="basis_for_calculation_5" class="disable-field form-control text-left fs14" id="basis_for_calculation_5" disabled
                                                                   value="{{ calculationPercentBusinessPlan($property['turnover_revenue'], $property['revenue_room_rentals']) . ' ' . trans('attributes.common.percent') }}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row col-12 p0 m10t">
                                        <div class="col-12 col-sm-6">
                                            <div class="row m0 h-100">
                                                <div class="col-4 p0 centered-vertical">
                                                <span class="balance-text">
                                                    {{ trans('attributes.balance.body.renewal_fee_income') }}
                                                </span>
                                                </div>
                                                <div class="col-8 p0 centered-vertical">
                                                    <span class="fs12 balance-w8 balance-number-input">6</span>
                                                    <input class="form-control balance-no-border-radius balance-input-text fs14 balance-w92 text-right" type="text"
                                                           value="{{ $property['revenue_contract_update_fee'] ? number_format($property['revenue_contract_update_fee']) : "0" }}" readonly="readonly">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-6 d-flex align-items-center m0 p0 p20l p10t-sp">
                                            <div class="m0l w-100">
                                                <div class="d-flex flex-wrap m0 p0">
                                                    <div class="p0 d-flex align-items-center">
                                                        <span class="d-inline-block fs14">{{ trans('attributes.balance.preview.table_3.title_2') }}</span>
                                                    </div>
                                                    <div class="col-4 p0">
                                                        <div class="col-12 m15l p0">
                                                            <input name="basis_for_calculation_6" class="disable-field form-control text-left fs14" id="basis_for_calculation_6" disabled
                                                                   value="{{ calculationPercentBusinessPlan($property['revenue_contract_update_fee'], $property['revenue_room_rentals']) . ' ' . trans('attributes.common.percent') }}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row col-12 p0 m10t">
                                        <div class="col-12 col-sm-6">
                                            <div class="row m0 h-100">
                                                <div class="col-4 p0 centered-vertical">
                                                <span class="balance-text">
                                                    {{ trans('attributes.balance.body.other_income') }}
                                                </span>
                                                </div>
                                                <div class="col-8 p0 centered-vertical">
                                                    <span class="fs12 balance-w8 balance-number-input">7</span>
                                                    <input class="form-control balance-no-border-radius balance-input-text fs14 balance-w92 text-right" type="text"
                                                           value="{{ $property['revenue_other'] ? number_format($property['revenue_other']) : "0" }}" readonly="readonly">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-6 d-flex align-items-center m0 p0 p20l p10t-sp">
                                            <div class="m0l w-100">
                                                <div class="d-flex m0 p0">
                                                    <div class="p0 d-flex align-items-center">
                                                        <span class="d-inline-block fs14">{{ trans('attributes.balance.preview.table_3.title_3') }}</span>
                                                    </div>
                                                    <div class="col-4 p0">
                                                        <div class="col-12 m15l p0">
                                                            <input name="basis_for_calculation_7" class="disable-field form-control text-left fs14" id="basis_for_calculation_7" disabled
                                                                   value="{{ calculationPercentBusinessPlan($property['revenue_other'], sumRentalIncome($property)) . ' ' . trans('attributes.common.percent') }}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row col-12 p0 m10t">
                                        <div class="col-12 col-sm-6">
                                            <div class="row m0">
                                                <div class="col-4 p0 centered-vertical">
                                                <span class="balance-text">
                                                    {{ trans('attributes.balance.body.bad_debt_losses') }}
                                                </span>
                                                </div>
                                                <div class="col-8 p0 centered-vertical">
                                                    <span class="fs12 balance-w8 balance-number-input">8</span>
                                                    <input class="form-control balance-no-border-radius balance-input-text fs14 balance-w92 text-right" type="text"
                                                           value="{{ $property['bad_debt'] ? number_format($property['bad_debt']) : "0" }}" readonly="readonly">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-6 d-flex align-items-center m0 p0 p20l p10t-sp">
                                            <div class="w-100 m0l">
                                                <div class="d-flex m0 p0">
                                                    <div class="p0 d-flex align-items-center">
                                                        <span class="d-inline-block fs14">{{ trans('attributes.balance.preview.table_3.title_3') }}</span>
                                                    </div>
                                                    <div class="col-4 p0">
                                                        <div class="col-12 m15l p0">
                                                            <input name="basis_for_calculation_8" class="disable-field form-control text-left fs14" id="basis_for_calculation_8" disabled
                                                                   value="{{ calculationPercentBusinessPlan($property['bad_debt'], sumRentalIncome($property)) . ' ' . trans('attributes.common.percent') }}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row col-12 p0 m10t">
                                        <div class="col-12 col-sm-6">
                                            <div class="row m0">
                                                <div class="col-4 p0 centered-vertical">
                                                <span class="balance-text">
                                                    {{ trans('attributes.balance.body.meter') }}
                                                </span>
                                                </div>
                                                <div class="col-8 p0 centered-vertical">
                                                    <span class="fs12 balance-w8 balance-number-input h56">9</span>
                                                    <input class="form-control balance-no-border-radius balance-input-text fs18 h56 fw550 balance-w92 text-right" type="text"
                                                           value="{{ $property['total_revenue'] ? number_format($property['total_revenue']) : "0" }}" readonly="readonly">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-6 d-flex align-items-center m0 p0 p20l p10t-sp">
                                            <div class="w-100 m0 p0 ">
                                                <div class="d-flex flex-wrap m0 p0 ">
                                                    <div class="p0 d-flex align-items-center">
                                                        <span class="d-inline-block fs14">{{ trans('attributes.balance.preview.table_3.title_1') }}</span>
                                                    </div>
                                                    <div class="col-4 p0">
                                                        <div class="col-12 m15l p0">
                                                            <input name="basis_for_calculation_9" class="disable-field form-control text-left fs14" id="basis_for_calculation_9" disabled
                                                                   value="{{ numberFormatWithUnit(basisCalculationBusinessPlan($property['total_revenue'], $property['total_area_floors']), ' ' . trans('attributes.common.unit-4')) }}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="col-12 p0 balance-body-content m30t">
                                <div class="row m0">
                                    <div class="row col-12 p0">
                                        <div class="col-6">
                                            <span class="balance-body-title">{{ trans('attributes.balance.body.operating_costs') }}</span>
                                        </div>
                                        <div class="col-6 align-items-center m0 p0 p20l">
                                            <span class="balance-body-title">{{ trans('attributes.balance.preview.table_3.table_head') }}</span>
                                        </div>
                                    </div>

                                    <div class="col-12 p0 text-right">
                                        <span class="fs12">({{ trans('attributes.common.yen') }})</span>
                                    </div>

                                    <div class="row col-12 p0 m5t">
                                        <div class="col-12 col-sm-6">
                                            <div class="row m0">
                                                <div class="col-4 p0 centered-vertical">
                                            <span class="balance-text">
                                                {{ trans('attributes.balance.body.maintenance_management_fee') }}
                                            </span>
                                                </div>
                                                <div class="col-8 p0 centered-vertical">
                                                    <span class="fs12 balance-w8 balance-number-input">10</span>
                                                    <input class="form-control balance-no-border-radius balance-input-text fs14 balance-w92 text-right" type="text"
                                                           value="{{ $property['maintenance_management_fee'] ? number_format($property['maintenance_management_fee']) : "0" }}" readonly="readonly">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-6 d-flex align-items-center m0 p0 p20l p10t-sp">
                                            <div class="m0l w-100">
                                                <div class="d-flex flex-wrap m0 p0">
                                                    <div class=" p0 d-flex align-items-center">
                                                        <span class="d-inline-block fs14">{{ trans('attributes.balance.preview.table_3.title_1') }}</span>
                                                    </div>
                                                    <div class="col-4 p0">
                                                        <div class="col-12 m15l p0">
                                                            <input name="basis_for_calculation_10" class="disable-field form-control text-left fs14" id="basis_for_calculation_10" disabled
                                                                   value="{{ numberFormatWithUnit(basisCalculationBusinessPlan($property['maintenance_management_fee'], number_format($property['total_area_floors'], FLAG_TWO), FLAG_MAX_MONTH), ' ' . trans('attributes.common.unit-4')) }}">
                                                        </div>
                                                    </div>
                                                    <div class="m20l p0 d-flex align-items-center">
                                                        <span class="d-inline-block fs14">{{ trans('attributes.balance.preview.table_3.unit') }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row col-12 p0 m10t">
                                        <div class="col-12 col-sm-6">
                                            <div class="row m0">
                                                <div class="col-4 p0 centered-vertical">
                                            <span class="balance-text">
                                                {{ trans('attributes.balance.body.utilities_expenses') }}
                                            </span>
                                                </div>
                                                <div class="col-8 p0 centered-vertical">
                                                    <span class="fs12 balance-w8 balance-number-input">11</span>
                                                    <input class="form-control balance-no-border-radius balance-input-text fs14 balance-w92 text-right" type="text"
                                                           value="{{ $property['electricity_gas_charges'] ? number_format($property['electricity_gas_charges']) : "0" }}" readonly="readonly">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-6 d-flex align-items-center m0 p0 p20l p10t-sp">
                                            <div class="m0l w-100">
                                                <div class="d-flex flex-wrap m0 p0">
                                                    <div class="p0 d-flex align-items-center">
                                                        <span class="d-inline-block fs14">{{ trans('attributes.balance.preview.table_3.title_1') }}</span>
                                                    </div>
                                                    <div class="col-4 p0">
                                                        <div class="col-12 m15l p0">
                                                            <input name="basis_for_calculation_11" class="disable-field form-control text-left fs14" id="basis_for_calculation_11" disabled
                                                                   value="{{ numberFormatWithUnit(basisCalculationBusinessPlan($property['electricity_gas_charges'], number_format($property['total_area_floors'] * 0.3025, FLAG_TWO), FLAG_MAX_MONTH), ' ' . trans('attributes.common.unit-3')) }}">
                                                        </div>
                                                    </div>
                                                    <div class="m20l p0 d-flex align-items-center">
                                                        <span class="d-inline-block fs14">{{ trans('attributes.balance.preview.table_3.unit') }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row col-12 p0 m10t">
                                        <div class="col-12 col-sm-6">
                                            <div class="row m0">
                                                <div class="col-4 p0 centered-vertical">
                                            <span class="balance-text">
                                                {{ trans('attributes.balance.body.management_repair_fee') }}
                                            </span>
                                                </div>
                                                <div class="col-8 p0 centered-vertical">
                                                    <span class="fs12 balance-w8 balance-number-input">12</span>
                                                    <input class="form-control balance-no-border-radius balance-input-text fs14 balance-w92 text-right" type="text"
                                                           value="{{ $property['repair_fee'] ? number_format($property['repair_fee']) : "0" }}" readonly="readonly">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-6 d-flex align-items-center m0 p0 p20l p10t-sp">
                                            <div class="m0l w-100">
                                                <div class="d-flex flex-wrap m0 p0">
                                                    <div class="p0 d-flex align-items-center">
                                                        <span class="d-inline-block fs14">{{ trans('attributes.balance.preview.table_3.title_1') }}</span>
                                                    </div>
                                                    <div class="col-4 p0">
                                                        <div class="col-12 m15l p0">
                                                            <input name="basis_for_calculation_12" class="disable-field form-control text-left fs14" id="basis_for_calculation_12" disabled
                                                                   value="{{ numberFormatWithUnit(basisCalculationBusinessPlan($property['repair_fee'], number_format($property['total_area_floors'], FLAG_TWO)), ' ' . trans('attributes.common.unit-4')) }}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row col-12 p0 m10t">
                                        <div class="col-12 col-sm-6">
                                            <div class="row m0">
                                                <div class="col-4 p0 centered-vertical">
                                            <span class="balance-text">
                                                {{ trans('attributes.balance.body.intact_reply_fee') }}
                                            </span>
                                                </div>
                                                <div class="col-8 p0 centered-vertical">
                                                    <span class="fs12 balance-w8 balance-number-input">13</span>
                                                    <input class="form-control balance-no-border-radius balance-input-text fs14 balance-w92 text-right" type="text"
                                                           value="{{ $property['recovery_costs'] ? number_format($property['recovery_costs']) : "0" }}" readonly="readonly">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-6 d-flex align-items-center m0 p0 p20l p10t-sp">
                                            <div class="m0l w-100">
                                                <div class="d-flex flex-wrap m0 p0">
                                                    <div class="p0 d-flex align-items-center">
                                                        <span class="d-inline-block fs14">{{ trans('attributes.balance.preview.table_3.title_1') }}</span>
                                                    </div>
                                                    <div class="col-4 p0">
                                                        <div class="col-12 m15l p0">
                                                            <input name="basis_for_calculation_13" class="disable-field form-control text-left fs14" id="basis_for_calculation_13" disabled
                                                                   value="{{ numberFormatWithUnit(basisCalculationBusinessPlan($property['recovery_costs'], number_format($property['total_area_floors'], FLAG_TWO)), ' ' . trans('attributes.common.unit-4')) }}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row col-12 p0 m10t">
                                        <div class="col-12 col-sm-6">
                                            <div class="row m0">
                                                <div class="col-4 p0 centered-vertical">
                                            <span class="balance-text">
                                                {{ trans('attributes.balance.body.property') }}<br>
                                                {{ trans('attributes.balance.body.management_fee') }}
                                            </span>
                                                </div>
                                                <div class="col-8 p0 centered-vertical">
                                                    <span class="fs12 balance-w8 balance-number-input">14</span>
                                                    <input class="form-control balance-no-border-radius balance-input-text fs14 balance-w92 text-right" type="text"
                                                           value="{{ $property['property_management_fee'] ? number_format($property['property_management_fee']) : "0" }}" readonly="readonly">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-6 d-flex align-items-center m0 p0 p20l p10t-sp">
                                            <div class="m0l w-100">
                                                <div class="d-flex flex-wrap m0 p0">
                                                    <div class="p0 d-flex align-items-center">
                                                        <span class="d-inline-block fs14">{{ trans('attributes.balance.preview.table_3.title_3') }}</span>
                                                    </div>
                                                    <div class="col-4 p0">
                                                        <div class="col-12 m15l p0">
                                                            <input name="basis_for_calculation_14" class="disable-field form-control text-left fs14" id="basis_for_calculation_14" disabled
                                                                   value="{{ calculationPercentBusinessPlan($property['property_management_fee'], sumRentalIncome($property)) . ' ' . trans('attributes.common.percent') }}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row col-12 p0 m10t">
                                        <div class="col-12 col-sm-6">
                                            <div class="row m0">
                                                <div class="col-4 p0 centered-vertical">
                                            <span class="balance-text">
                                                {{ trans('attributes.balance.body.tenant_recruitment_costs') }}
                                            </span>
                                                </div>
                                                <div class="col-8 p0 centered-vertical">
                                                    <span class="fs12 balance-w8 balance-number-input">15</span>
                                                    <input class="form-control balance-no-border-radius balance-input-text fs14 balance-w92 text-right" type="text"
                                                           value="{{ $property['find_tenant_fee'] ? number_format($property['find_tenant_fee']) : "0" }}" readonly="readonly">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-6 d-flex align-items-center m0 p0 p20l p10t-sp">
                                            <div class="m0l w-100">
                                                <div class="d-flex flex-wrap m0 p0">
                                                    <div class="p0 d-flex align-items-center">
                                                        <span class="d-inline-block fs14">{{ trans('attributes.balance.preview.table_3.title_3') }}</span>
                                                    </div>
                                                    <div class="col-4 p0">
                                                        <div class="col-12 m15l p0">
                                                            <input name="basis_for_calculation_15" class="disable-field form-control text-left fs14" id="basis_for_calculation_15" disabled
                                                                   value="{{ calculationPercentBusinessPlan($property['find_tenant_fee'], sumRentalIncome($property)) . ' ' . trans('attributes.common.percent') }}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row col-12 p0 m10t">
                                        <div class="col-12 col-sm-6">
                                            <div class="row m0">
                                                <div class="col-4 p0 centered-vertical">
                                            <span class="balance-text">
                                                {{ trans('attributes.balance.body.taxes_and_dues') }}
                                            </span>
                                                </div>
                                                <div class="col-8 p0 centered-vertical">
                                                    <span class="fs12 balance-w8 balance-number-input">16</span>
                                                    <input class="form-control balance-no-border-radius balance-input-text fs14 balance-w92 text-right" type="text"
                                                           value="{{ $property['tax'] ? number_format($property['tax']) : "0" }}" readonly="readonly">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-6 d-flex align-items-center m0 p0 p20l p10t-sp">
                                            <div class="m0l w-100">
                                                <div class="d-flex flex-wrap m0 p0">
                                                    <div class="p0l">
                                                        <input name="basis_for_calculation_16" value="{{ $property['date_year_registration_revenue'] ?? "" }}" class="disable-field form-control text-left w100" id="basis-for-calculation-16" disabled>
                                                        <p class="error-message m0" data-error="basis_for_calculation_16"></p>
                                                    </div>
                                                    <div class="m5l p0 d-flex align-items-center">
                                                        <span class="d-inline-block fs14">{{ trans('attributes.balance.preview.table_3.title_4') }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row col-12 p0 m10t">
                                        <div class="col-12 col-sm-6">
                                            <div class="row m0">
                                                <div class="col-4 p0 centered-vertical">
                                            <span class="balance-text">
                                                {{ trans('attributes.balance.body.non-life_insurance_premiums') }}
                                            </span>
                                                </div>
                                                <div class="col-8 p0 centered-vertical">
                                                    <span class="fs12 balance-w8 balance-number-input">17</span>
                                                    <input class="form-control balance-no-border-radius balance-input-text fs14 balance-w92 text-right" type="text"
                                                           value="{{ $property['loss_insurance'] ? number_format($property['loss_insurance']) : "0" }}" readonly="readonly">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-6 d-flex align-items-center m0 p0 p20l p10t-sp">
                                            <div class="m0l w-100">
                                                <div class="d-flex flex-wrap m0 p0">
                                                    <div class="p0l">
                                                        <input name="basis_for_calculation_16" value="{{ $property['date_year_registration_revenue'] ?? "" }}" class="disable-field form-control text-left w100" id="basis-for-calculation-16" disabled>
                                                        <p class="error-message m0" data-error="basis_for_calculation_16"></p>
                                                    </div>
                                                    <div class="m5l p0 d-flex align-items-center">
                                                        <span class="d-inline-block fs14">{{ trans('attributes.balance.preview.table_3.title_4') }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row col-12 p0 m10t">
                                        <div class="col-12 col-sm-6">
                                            <div class="row m0">
                                                <div class="col-4 p0 centered-vertical">
                                            <span class="balance-text">
                                                {{ trans('attributes.single_analysis.rent') }}
                                            </span>
                                                </div>
                                                <div class="col-8 p0 centered-vertical">
                                                    <span class="fs12 balance-w8 balance-number-input">18</span>
                                                    <input id="input-land-rental-fee" class="form-control balance-no-border-radius balance-input-text fs14 balance-w92 text-right" type="text"
                                                           value="{{ $property['land_rental_fee'] ? number_format($property['land_rental_fee']) : "0" }}" readonly="readonly">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-6 d-flex align-items-center m0 p0 p20l p10t-sp">
                                            <div class="m0l w-100">
                                                <div class="d-flex flex-wrap m0 p0">
                                                    <div class="p0l">
                                                        <input name="basis_for_calculation_17" value="{{ $property['date_year_registration_revenue'] ?? "" }}" class="disable-field form-control text-left w100" id="basis-for-calculation-16" disabled>
                                                        <p class="error-message m0" data-error="basis_for_calculation_16"></p>
                                                    </div>
                                                    <div class="m5l p0 d-flex align-items-center">
                                                        <span class="d-inline-block fs14">{{ trans('attributes.balance.preview.table_3.title_4') }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row col-12 p0 m10t">
                                        <div class="col-12 col-sm-6">
                                            <div class="row m0">
                                                <div class="col-4 p0 centered-vertical">
                                            <span class="balance-text">
                                                {{ trans('attributes.balance.body.other_expenses') }}
                                            </span>
                                                </div>
                                                <div class="col-8 p0 centered-vertical">
                                                    <span class="fs12 balance-w8 balance-number-input">19</span>
                                                    <input class="form-control balance-no-border-radius balance-input-text fs14 balance-w92 text-right" type="text"
                                                           value="{{ $property['other_costs'] ? number_format($property['other_costs']) : "0" }}" readonly="readonly">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-6 d-flex align-items-center m0 p0 p20l p10t-sp">
                                            <div class="m0l w-100">
                                                <div class="d-flex flex-wrap m0 p0">
                                                    <div class="p0 d-flex align-items-center">
                                                        <span class="d-inline-block fs14">{{ trans('attributes.balance.preview.table_3.title_5') }}</span>
                                                    </div>
                                                    <div class="col-4 p0">
                                                        <div class="col-12 m15l p0">
                                                            <input name="basis_for_calculation_19" class="disable-field form-control text-left fs14" id="basis_for_calculation_19" disabled
                                                                   value="{{ calculationPercentBusinessPlan($property['other_costs'], $property['total_revenue']) . ' ' . trans('attributes.common.percent') }}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row col-12 p0 m10t">
                                        <div class="col-12 col-sm-6">
                                            <div class="row m0">
                                                <div class="col-4 p0 centered-vertical">
                                            <span class="balance-text">
                                                {{ trans('attributes.balance.body.meter') }}
                                            </span>
                                                </div>
                                                <div class="col-8 p0 centered-vertical">
                                                    <span class="fs12 balance-w8 balance-number-input h56">20</span>
                                                    <input class="form-control balance-no-border-radius balance-input-text fs18 h56 fw550 balance-w92 text-right" type="text"
                                                           value="{{ $property['total_cost'] ? number_format($property['total_cost']) : "0" }}" readonly="readonly">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-6 d-flex align-items-center m0 p0 p20l p10t-sp">
                                            <div class="m0l w-100">
                                                <div class="d-flex flex-wrap m0 p0">
                                                    <div class="p0 d-flex align-items-center m55r">
                                                        <span class="d-inline-block fs14">{{ trans('attributes.property.cost_ratio') }}</span>
                                                    </div>
                                                    <div class="col-4 p0">
                                                        <div class="col-12 m30l p0">
                                                            <input name="basis_for_calculation_20" class="disable-field form-control text-left fs14" id="basis_for_calculation_20" disabled
                                                                   value="{{ number_format(divisionNumber($property['total_cost'], $property['total_revenue']) * 100, FLAG_TWO) . ' ' . trans('attributes.common.percent') }}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="col-12 p0 balance-body-content m30t">
                                <div class="row m0">
                                    <div class="row col-12 p0">
                                        <div class="col-12 col-sm-6">
                                            <div class="row m0">
                                                <div class="col-4 p0 centered-vertical">
                                                <span class="balance-text">
                                                    {{ trans('attributes.balance.body.operating_balance') }} <br>
                                                     <span class="d-flex align-items-center">(<span class="number-li m5r m5l">9</span>-<span class="number-li m5r m5l">20</span>)</span>
                                                </span>

                                                </div>
                                                <div class="col-8 p0 centered-vertical text-right m5t">
                                                    <span class="fs12 balance-w8 balance-number-input h56">21</span>
                                                    <input class="form-control balance-no-border-radius balance-input-text fs18 h56 fw550 text-right d-inline-block" type="text"
                                                           value="{{ number_format($property['total_revenue'] - ($property['total_cost'])) . ' ' . trans('attributes.common.yen') }}" readonly="readonly">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-6 d-flex align-items-center m0 p0 p20l p10t-sp">
                                            <div class="m0l w-100">
                                                <div class="d-flex flex-wrap m0 p0">
                                                    <div class="p0 d-flex align-items-center">
                                                        <span class="d-inline-block fs14">{{ trans('attributes.balance.preview.table_3.title_1') }}</span>
                                                    </div>
                                                    <div class="col-4 p0">
                                                        <div class="col-12 m15l p0">
                                                            <input name="basis_for_calculation_22" class="disable-field form-control text-left fs14" id="basis_for_calculation_22" disabled
                                                                   value="{{ numberFormatWithUnit(basisCalculationBusinessPlan($property['operating_expenses'], $property['total_area_floors']), ' ' . trans('attributes.common.unit-4')) }}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row col-12 p0 m10t">
                                        <div class="col-12 col-sm-6">
                                            <div class="row m0">
                                                <div class="col-4 p0 centered-vertical">
                                                <span class="balance-text">
                                                    {{ trans('attributes.balance.body.noi_yield') }} <br>
                                                    <span class="d-flex align-items-center">(<span class="number-li m5r m5l">21</span>/<span class="fs12">{{ trans('attributes.single_analysis.info') }}</span>)</span>
                                                </span>
                                                </div>
                                                <div class="col-8 p0 centered-vertical m5t">
                                                    <span class="fs12 balance-w8 balance-number-input h56">22</span>
                                                    <input class="form-control balance-no-border-radius balance-input-text fs18 h56 fw550 text-right" type="text"
                                                           value="{{ division((float)($property['total_revenue'] - ($property['total_cost'])) ?? 0 , (float)$property['money_receive_house'] ?? 0)  }} {{ trans('attributes.common.percent') }}" readonly="readonly">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-6 d-flex align-items-center m0 p0 p20l p10t-sp">
                                            <div class="m0l w-100">
                                                <div class="d-flex flex-wrap m0 p0">
                                                    <div class="p0 d-flex align-items-center">
                                                        <span class="d-inline-block fs14">{{ trans('attributes.balance.preview.table_3.title_7') }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="col-12 p0 m30t">
                                <div class="row m0 p0">
                                    <div class="col-12 col-sm-6 p0 p15r p-575-0 m30b">
                                        <div class="col-12 p0 balance-body-content h-100">
                                            <div class="row m0">
                                                <div class="col-12 p0">
                                        <span class="balance-body-title">
                                            {{ trans('attributes.balance.body.funding_conditions') }}
                                        </span>
                                                </div>

                                                <div class="col-12 p0 m25t">
                                                    <div class="row m0">
                                                        <div class="col-4 p0 centered-vertical">
                                            <span class="balance-text">
                                                {{ trans('attributes.property.date_of_receipt') }}
                                            </span>
                                                        </div>
                                                        <div class="col-8 p0 centered-vertical">
                                                            <input class="form-control balance-no-border-radius balance-input-text fs14 text-center" type="text"
                                                                   value="{{ $property['receive_house_date'] ? date("Y/m/d", strtotime($property['receive_house_date'])) : "ー" }}" readonly="readonly">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-12 p0 m10t">
                                                    <div class="row m0">
                                                        <div class="col-4 p0 centered-vertical">
                                            <span class="balance-text">
                                                {{ trans('attributes.single_analysis.acquisition_price') }}
                                            </span>
                                                        </div>
                                                        <div class="col-8 p0 centered-vertical">
                                                            <input class="form-control balance-no-border-radius balance-input-text fs14 text-right" type="text"
                                                                   value="{{ $property['money_receive_house'] ? number_format($property['money_receive_house']) : "0" }} {{ trans('attributes.common.yen') }}" readonly="readonly">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-12 p0 m10t">
                                                    <div class="row m0">
                                                        <div class="col-4 p0 centered-vertical">
                                            <span class="balance-text">
                                                {{ trans('attributes.balance.body.borrowed_amount') }}
                                            </span>
                                                        </div>
                                                        <div class="col-8 p0 centered-vertical">
                                                            <input class="form-control balance-no-border-radius balance-input-text fs14 text-right" type="text"
                                                                   value="{{ $property['loan'] ? number_format($property['loan']) : "0" }} {{ trans('attributes.common.yen') }}" readonly="readonly">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-12 p0 m10t">
                                                    <div class="row m0">
                                                        <div class="col-4 p0 centered-vertical">
                                            <span class="balance-text">
                                                {{ trans('attributes.balance.body.borrowing_day') }}
                                            </span>
                                                        </div>
                                                        <div class="col-8 p0 centered-vertical">
                                                            <input class="form-control balance-no-border-radius balance-input-text fs14 text-center" type="text"
                                                                   value="{{ $property['loan_date'] ? dateTimeFormat($property['loan_date']) : "ー" }}" readonly="readonly">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-12 p0 m10t">
                                                    <div class="row m0">
                                                        <div class="col-4 p0 centered-vertical">
                                            <span class="balance-text">
                                                {{ trans('attributes.balance.body.interest_rate') }}
                                            </span>
                                                        </div>
                                                        <div class="col-8 p0 centered-vertical">
                                                            <input class="form-control balance-no-border-radius balance-input-text fs14 text-center" type="text"
                                                                   value="{{ numberFormatWithUnit($property['interest_rate'], " " . trans('attributes.common.percent'), FLAG_TWO) }}" readonly="readonly">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-12 p0 m10t">
                                                    <div class="row m0">
                                                        <div class="col-4 p0 centered-vertical">
                                            <span class="balance-text">
                                                {{ trans('attributes.balance.body.contract_borrowing_period') }}
                                            </span>
                                                        </div>
                                                        <div class="col-8 p0 centered-vertical">
                                                            <input class="form-control balance-no-border-radius balance-input-text fs14 text-center" type="text"
                                                                   value="{{ $property['contract_loan_period'] }} {{__('attributes.common.year')}}" readonly="readonly">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-12 p0 m10t">
                                                    <div class="row m0">
                                                        <div class="col-4 p0 centered-vertical">
                                                <span class="balance-text">
                                                    {{ trans('attributes.balance.body.age') }}
                                                </span>
                                                        </div>
                                                        <div class="col-8 p0 centered-vertical">
                                                            <input class="form-control balance-no-border-radius balance-input-text fs14 text-center" type="text"
                                                                   value="{{ $property['loan_date'] ? getNumberYearPassed($property['loan_date'])." ".__('attributes.common.year') : "ー" }}" readonly="readonly">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-12 p0 m10t">
                                                    <div class="row m0">
                                                        <div class="col-4 p0 centered-vertical">
                                                <span class="balance-text">
                                                    {{ trans('attributes.balance.body.loan_repayment_amount') }}<br>
                                                    {{ trans('attributes.balance.body.repayment_of_principal_and_interest') }}
                                                </span>
                                                        </div>
                                                        <div class="col-8 p0 centered-vertical">
                                                            <input class="form-control balance-no-border-radius balance-input-text fs14 text-right" type="text"
                                                                   value="{{ number_format(round($pmt)) . " " . trans('attributes.common.yen') }}" readonly="readonly">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6 p0 p15l p-575-0 m30b">
                                        <div class="col-12 p0 score-map-content w-100 h-100">
                                            <input type="hidden" value="{{$property['id']}}" class="property-id">
                                            <div class="header-card6">
                                                <div class="header-card6-left p25 p20l p10b p10r">
                                                    <p class="fs16 fw-bold m0 color-title-chart">SCOREMAP
                                                        <i class="question-icon far fa-question-circle" aria-hidden="true"></i>
                                                    </p>
                                                    <p class="fs14 fw-bold color-title-chart">{{ trans('attributes.balance.body.note_chart') }}</p>
                                                </div>
                                                <div class="header-card6-right p15r">
                                                    <div class="sum-points text-white text-center">
                                                        <div class="fs13 fw-bold p05-rem-top">CYARea!スコア<br>(収支総合評価)</div>
                                                        <div id="synthetic-point" class="fs36 fw-bold">{{ round($property['synthetic_point']) }}<span class="fs18 fw-bold">points</span></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="spiderweb-chart"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row m0 balance-body">
                <div class="col-lg-12 p0 text-right dropdown-none-icon p15lr media-575-p20r">
                    <button class="btn custom-btn-primary m5t m10r dropdown-toggle fs15 fs13-sp m0lr-sp" data-toggle="dropdown">{{ trans('attributes.balance.header.btn_choose') }}</button>
                    @include('backend.property.commonElements.dropdown_property')
                    <button class="btn custom-btn-success m5t btn-preview-single-analysis d-none d-sm-inline-block fs15 fs13-sp">
                        {{ trans('attributes.balance.header.btn_preview') }}
                    </button>
                </div>
            </div>
        </div>
    </div>
    <input id="data-chart-all" type="hidden" value="{{ json_encode($property) }} ">
    @include('modal.single_analysis_preview')
@endsection
@section('js')
    <script src="{{ asset('js/highcharts/modules/no-data-to-display.js') }}"></script>
    <script src="{{ asset('js/highcharts/exporting.js')}}"></script>
    <script src="{{ asset('js/highcharts/highcharts-regression.js')}}"></script>
    <script src="{{ asset('js/regression/regression.js') }}"></script>
    <script src="{{ asset('dist/js/single-analysis.min.js') }}"></script>
    <script type="text/javascript">
        let dataAll = {!! json_encode($property) !!};
        let dataBoxPlot = {!! json_encode($dataValues) !!};
        let dataCompeteChart = {!! json_encode($dataCompeteChart) !!};
    </script>
@endsection
