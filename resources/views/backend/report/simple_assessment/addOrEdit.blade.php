@extends('layout.home.master')
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/preview/simple_assessment.css') }}">
@endsection
@section('content')
    <div id="main-info-assessment" class="container-wrapper-assessment container-assessment @if(request('show_print') == true) has-print @endif">
        @include('partials.flash_messages')

        <div class="row-header m50b">
            <div class="row m0">
                <div class="col-12 text-center text-md-left p0">
                    <h3 class="m0">{{ trans('attributes.home.menu.simple_form') }}</h3>
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
        <form id="form-condition-1" action="{{ route(USER_PROPERTY_SIMPLE_ASSESSMENT_UPDATE, $property['id']) }}" method="POST">
            @csrf
            <input type="hidden" id="time-open-page" name="time_open_page" value="{{ date('Y/m/d H:i:s', time()) }}">
            <input type="hidden" id="property-id" name="property_id" value="{{ $property['id'] }}">
            <input type="hidden" name="paginate_previous" value="{{ request('option_paginate') }}">
            <input type="hidden" name="screen" value="{{ request('screen') }}">
            <div class="row m0">
                <div class="col-12 col-xl-9 text-center text-md-right m0 group-status-top row p0">
                    <div id="block-status" class="row spBlock m0l m30r w-auto">
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
                            {{--                        <div class="fw-normal">{{ $property['date_year_registration_revenue'] ? $property['date_year_registration_revenue'].trans('attributes.common.year') : "" }}{{ MONTH[$property['date_month_registration_revenue']]  ?? "ー" }}</div>--}}
                        </div>
                    </div>
                    <div id="block-status" class="row spBlock m0 w-auto">
                        <div class="centered first-block p15r p15l">
                            <label class="m0">{{ trans('attributes.property.status') }}</label>
                        </div>
                        <div class="centered p0 p15r p15l">
                            <div class="fw-normal">{{ STATUS_HOUSE_SIMPLE[$property['status']] }}</div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-xl-3 text-center text-lg-right p0 text-right group-button-top">
                    <button type="submit" class="btn w-auto custom-btn-primary fs15 btn-save-simple-assessment">{{ trans('attributes.simulation.content.text_btn_save') }}</button>
                    <button type="button" class="btn w-auto custom-btn-success fs15 m15l btn-responsive print-simple-assessment show-print">{{ trans('attributes.balance.header.btn_preview') }}</button>
                </div>
            </div>

            @include('backend.report.modules_html.assessment_result')
        </form>

        <div class="row m0">
            <div class="col-12 col-lg-6 p0">
                @include('backend.report.modules_html.list_basic_house')

                @include('backend.report.modules_html.rights_mode')
            </div>

            <div class="col-12 col-lg-6 p0">
                @include('backend.report.modules_html.items_related_to_benefits')

                @include('backend.report.modules_html.leasehold')
            </div>
        </div>

        @if(!$hideAnnualPerformance)
        <div class="m0 m30b diagram-analysis">
            <div class="row m0 p30 diagram-block">
                <div class="col-12 m0 p0">
                    <div class="row m0 m10b">
                        <div class="col-6 m0 p0 p20r">
                            <div class="d-flex m0 m0l">
                                <div class="col-11 p0l m5b">
                                    <p class="fs16 fw-bold m0">{{ trans('attributes.balance.body.operating_revenue') }}</p>
                                </div>
                                <div class="col-1 p0l p15r d-flex align-items-end justify-content-end">
                                    <p class="fs12 m0">({{ trans('attributes.common.yen') }})</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-6 d-flex align-items-center m0 p0 p20l spH">
                            <div class="m0l w-100">
                                <div class="p0">
                                    <p class="fs16 fw-bold m0">{{ trans('attributes.balance.preview.table_3.table_head') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if($property['real_estate_type_id'] === FLAG_NINE || $property['real_estate_type_id'] === FLAG_TEN)
                    <div class="row m0 m10b">
                        <div class="col-6 row align-items-center m0 p0 p20r">
                            <div class="col-5 col-12-sp p0 d-flex align-items-center">
                                <span class="d-inline-block fs14">{{ __('attributes.register_info.item_block.label.rent_income') }}<br>{{ __('attributes.register_info.item_block.label.rent_income_1') }}</span>
                            </div>
                            <div class="col-7 col-12-sp p0">
                                <div class="d-flex">
                                    <span class="number-li">0</span>
                                    <div class="col-11 p0">
                                        <input name="revenue_land_taxes" value="{{ $annualPerformance['revenue_land_taxes'] ? number_format($annualPerformance['revenue_land_taxes']) : "0" }}" class="disable-field form-control text-right fs14" id="revenue_room_rentals" disabled>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-6 d-flex align-items-center m0 p0 p20l">
                            <div class="m0l w-100">
                                <div class="d-flex flex-wrap m0 p0">
                                    <div class="p0 d-flex align-items-center">
                                        <span class="d-inline-block fs14">{{ trans('attributes.balance.preview.table_3.title_8') }}</span>
                                    </div>
                                    <div class="col-4 p0">
                                        <div class="col-12 m15l p0">
                                            <input name="basis_for_calculation_0" class="disable-field form-control text-left fs14" id="basis_for_calculation_1" disabled
                                                   value="{{ numberFormatWithUnit(basisCalculationBusinessPlan($annualPerformance['revenue_land_taxes'], number_format($property['area_rent'] * 0.3025, FLAG_TWO), FLAG_MAX_MONTH), ' ' . trans('attributes.common.unit-3')) }}">
                                        </div>
                                    </div>
                                    <div class="m20l p0 d-flex align-items-center">
                                        <span class="d-inline-block fs14">{{ trans('attributes.balance.preview.table_3.unit') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif

                    <div class="row m0 m10b">
                        <div class="col-6 row align-items-center m0 p0 p20r">
                            <div class="col-5 col-12-sp p0 d-flex align-items-center">
                                <span class="d-inline-block fs14">{{ trans('attributes.balance.body.rent_income') }}</span>
                            </div>
                            <div class="col-7 col-12-sp p0">
                                <div class="d-flex">
                                    <span class="number-li">1</span>
                                    <div class="col-11 p0">
                                        <input name="revenue_room_rentals" value="{{ $annualPerformance['rent_income'] ? number_format($annualPerformance['rent_income']) : "0" }}" class="disable-field form-control text-right fs14" id="revenue_room_rentals" disabled>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-6 d-flex align-items-center m0 p0 p20l">
                            <div class="m0l w-100">
                                <div class="d-flex flex-wrap m0 p0">
                                    <div class="p0 d-flex align-items-center">
                                        <span class="d-inline-block fs14">{{ trans('attributes.balance.preview.table_3.title_1') }}</span>
                                    </div>
                                    <div class="col-4 p0">
                                        <div class="col-12 m15l p0">
                                            <input name="basis_for_calculation_1" class="disable-field form-control text-left fs14" id="basis_for_calculation_1" disabled
                                                   value="{{ numberFormatWithUnit(basisCalculationBusinessPlan($annualPerformance['rent_income'], number_format($property['total_area_floors'] * 0.3025, FLAG_TWO), FLAG_MAX_MONTH), ' ' . trans('attributes.common.unit-3')) }}">
                                        </div>
                                    </div>
                                    <div class="m20l p0 d-flex align-items-center">
                                        <span class="d-inline-block fs14">{{ trans('attributes.balance.preview.table_3.unit') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row m0 m10b">
                        <div class="col-6 row align-items-center row m0 p0 p20r">
                            <div class="col-5 col-12-sp p0 d-flex align-items-center">
                                <span class="d-inline-block fs14">{{ trans('attributes.balance.body.common_service_revenue') }}</span>
                            </div>
                            <div class="col-7 col-12-sp p0">
                                <div class="d-flex">
                                    <span class="number-li">2</span>
                                    <div class="col-11 p0">
                                        <input name="revenue_service_charges" value="{{ $annualPerformance['general_services'] ? number_format($annualPerformance['general_services']) : "0" }}" class="disable-field form-control text-right fs14" id="revenue_service_charges" disabled>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-6 d-flex align-items-center m0 p0 p20l">
                            <div class="m0l w-100">
                                <div class="d-flex flex-wrap m0 p0">
                                    <div class="p0 d-flex align-items-center">
                                        <span class="d-inline-block fs14">{{ trans('attributes.balance.preview.table_3.title_1') }}</span>
                                    </div>
                                    <div class="col-4 p0">
                                        <div class="col-12 m15l p0 ">
                                            <input name="basis_for_calculation_2"  class="disable-field form-control text-left fs14" id="basis_for_calculation_2" disabled
                                                   value="{{ numberFormatWithUnit(basisCalculationBusinessPlan($annualPerformance['general_services'], number_format($property['total_area_floors'] * 0.3025, FLAG_TWO), FLAG_MAX_MONTH), ' ' . trans('attributes.common.unit-3')) }}">
                                        </div>
                                    </div>
                                    <div class="m20l p0 d-flex align-items-center">
                                        <span class="d-inline-block fs14">{{ trans('attributes.balance.preview.table_3.unit') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row d-flex align-items-center m0 m10b">
                        <div class="col-6 row m0 p0 p20r">
                            <div class="col-5 col-12-sp p0 d-flex align-items-center">
                                <span class="d-inline-block fs14">{{ trans('attributes.balance.body.utilities_expenses_revenue') }}</span>
                            </div>
                            <div class="col-7 col-12-sp p0">
                                <div class="d-flex">
                                    <span class="number-li">3</span>
                                    <div class="col-11 p0">
                                        <input name="revenue_utilities" value="{{ $annualPerformance['utilities_revenue'] ? number_format($annualPerformance['utilities_revenue']) : "0" }}" class="disable-field form-control text-right fs14" id="revenue_utilities" disabled>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-6 d-flex align-items-center m0 p0 p20l">
                            <div class="m0l w-100">
                                <div class="d-flex flex-wrap m0 p0">
                                    <div class="p0 d-flex align-items-center">
                                        <span class="d-inline-block fs14">{{ trans('attributes.balance.preview.table_3.title_1') }}</span>
                                    </div>
                                    <div class="col-4 p0">
                                        <div class="col-12 m15l p0 ">
                                            <input name="basis_for_calculation_2" class="disable-field form-control text-left fs14" id="basis_for_calculation_2" disabled
                                                   value="{{ numberFormatWithUnit(basisCalculationBusinessPlan($annualPerformance['utilities_revenue'], number_format($property['total_area_floors'] * 0.3025, FLAG_TWO), FLAG_MAX_MONTH), ' ' . trans('attributes.common.unit-3')) }}">
                                        </div>
                                    </div>
                                    <div class="m20l p0 d-flex align-items-center">
                                        <span class="d-inline-block fs14">{{ trans('attributes.balance.preview.table_3.unit') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row m0 m10b">
                        <div class="col-6 row align-items-center row m0 p0 p20r">
                            <div class="col-5 col-12-sp p0 d-flex align-items-center">
                                <span class="d-inline-block fs14">{{ trans('attributes.balance.body.parking_revenue') }}</span>
                            </div>
                            <div class="col-7 col-12-sp p0">
                                <div class="d-flex">
                                    <span class="number-li">4</span>
                                    <div class="col-11 p0">
                                        <input name="revenue_car_deposits" value="{{ $annualPerformance['parking_revenue'] ? number_format($annualPerformance['parking_revenue']) : "0" }}" class="disable-field form-control text-right fs14" id="revenue_car_deposits" disabled>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-6 d-flex align-items-center m0 p0 p20l">
                            <div class="m0l w-100">
                                <div class="d-flex flex-wrap m0 p0">
                                    <div class="p0 d-flex align-items-center">
                                        <span class="d-inline-block fs14">≒</span>
                                    </div>
                                    <div class="col-4 p0">
                                        <div class="col-12 m15l p0">
                                            <input name="basis_for_calculation_4" class="disable-field form-control text-left fs14" id="basis_for_calculation_4" disabled
                                                   value="{{ numberFormatWithUnit($annualPerformance['parking_revenue'] / FLAG_MAX_MONTH, ' ' . trans('attributes.common.yen')) }}">
                                        </div>
                                    </div>
                                    <div class="m20l p0 d-flex align-items-center">
                                        <span class="d-inline-block fs14">{{ trans('attributes.balance.preview.table_3.unit') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row m0 m10b">
                        <div class="col-6 row align-items-center row m0 p0 p20r">
                            <div class="col-5 col-12-sp p0 d-flex align-items-center">
                                <span class="d-inline-block fs14">{{ trans('attributes.balance.body.key_money_and_royalties') }}</span>
                            </div>
                            <div class="col-7 col-12-sp p0">
                                <div class="d-flex">
                                    <span class="number-li">5</span>
                                    <div class="col-11 p0">
                                        <input name="turnover_revenue" value="{{ $annualPerformance['income_input_money'] ? number_format($annualPerformance['income_input_money']) : "0" }}" class="disable-field form-control text-right fs14" id="turnover_revenue" disabled>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-6 d-flex align-items-center m0 p0 p20l">
                            <div class="m0l w-100">
                                <div class="d-flex flex-wrap m0 p0">
                                    <div class="p0 d-flex align-items-center">
                                        <span class="d-inline-block fs14">{{ trans('attributes.balance.preview.table_3.title_2') }}</span>
                                    </div>
                                    <div class="col-4 p0">
                                        <div class="col-12 m15l p0">
                                            <input name="basis_for_calculation_5" class="disable-field form-control text-left fs14" id="basis_for_calculation_5" disabled
                                                   value="{{ calculationPercentBusinessPlan($annualPerformance['income_input_money'], $annualPerformance['rent_income']) . ' ' . trans('attributes.common.percent') }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row m0 m10b">
                        <div class="col-6 row align-items-center  row m0 p0 p20r">
                            <div class="col-5 col-12-sp p0 d-flex align-items-center">
                                <span class="d-inline-block fs14">{{ trans('attributes.balance.body.renewal_fee_income') }}</span>
                            </div>
                            <div class="col-7 col-12-sp p0">
                                <div class="d-flex">
                                    <span class="number-li">6</span>
                                    <div class="col-11 p0">
                                        <input name="revenue_contract_update_fee" value="{{ $annualPerformance['income_update_house_contract'] ? number_format($annualPerformance['income_update_house_contract']) : "0" }}" class="disable-field form-control text-right fs14" id="revenue_contract_update_fee" disabled>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-6 d-flex align-items-center  m0 p0 p20l">
                            <div class="m0l w-100">
                                <div class="d-flex flex-wrap m0 p0">
                                    <div class="p0 d-flex align-items-center">
                                        <span class="d-inline-block fs14">{{ trans('attributes.balance.preview.table_3.title_2') }}</span>
                                    </div>
                                    <div class="col-4 p0">
                                        <div class="col-12 m15l p0">
                                            <input name="basis_for_calculation_6" class="disable-field form-control text-left fs14" id="basis_for_calculation_6" disabled
                                                   value="{{ calculationPercentBusinessPlan($annualPerformance['income_update_house_contract'], $annualPerformance['rent_income']) . ' ' . trans('attributes.common.percent') }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row m0 m10b">
                        <div class="col-6 row flex-wrap align-items-center  row m0 p0 p20r">
                            <div class="col-5 col-12-sp p0 d-flex align-items-center">
                                <span class="d-inline-block fs14">{{ trans('attributes.balance.body.other_income') }}</span>
                            </div>
                            <div class="col-7 col-12-sp p0">
                                <div class="d-flex">
                                    <span class="number-li">7</span>
                                    <div class="col-11 p0">
                                        <input name="revenue_other" value="{{ $annualPerformance['other_income'] ? number_format($annualPerformance['other_income']) : "0" }}" class="disable-field form-control text-right fs14" id="revenue_other" disabled>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-6 d-flex flex-wrap align-items-center  m0 p0 p20l">
                            <div class="m0l w-100">
                                <div class="d-flex m0 p0">
                                    <div class="p0 d-flex align-items-center">
                                        <span class="d-inline-block fs14">{{ trans('attributes.balance.preview.table_3.title_3') }}</span>
                                    </div>
                                    <div class="col-4 p0">
                                        <div class="col-12 m15l p0">
                                            <input name="basis_for_calculation_7" class="disable-field form-control text-left fs14" id="basis_for_calculation_7" disabled
                                                   value="{{ calculationPercentBusinessPlan($annualPerformance['other_income'], sumRentalIncome($property)) . ' ' . trans('attributes.common.percent') }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row m0 m10b">
                        <div class="col-6 row align-items-center  row m0 p0 p20r">
                            <div class="col-5 col-12-sp p0 d-flex align-items-center">
                                <span class="d-inline-block fs14">{{ trans('attributes.balance.body.bad_debt_losses') }}</span>
                            </div>
                            <div class="col-7 col-12-sp p0">
                                <div class="d-flex">
                                    <span class="number-li">8</span>
                                    <div class="col-11 p0">
                                        <input name="bad_debt" value="{{ $annualPerformance['bad_debt_losses'] ? number_format($annualPerformance['bad_debt_losses']) : "0" }}" class="disable-field form-control text-right fs14" id="bad_debt" disabled>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-6 d-flex flex-wrap align-items-center m0 p0 p20l">
                            <div class="w-100 m0l">
                                <div class="d-flex m0 p0">
                                    <div class="p0 d-flex align-items-center">
                                        <span class="d-inline-block fs14">{{ trans('attributes.balance.preview.table_3.title_3') }}</span>
                                    </div>
                                    <div class="col-4 p0">
                                        <div class="col-12 m15l p0">
                                            <input name="basis_for_calculation_8" class="disable-field form-control text-left fs14" id="basis_for_calculation_8" disabled
                                                   value="{{ calculationPercentBusinessPlan($annualPerformance['bad_debt_losses'], sumRentalIncome($property)) . ' ' . trans('attributes.common.percent') }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row m0 m10b">
                        <div class="col-6 row align-items-center row m0 p0 p20r">
                            <div class="col-5 col-12-sp p0 d-flex align-items-center">
                                <span class="d-inline-block fs14">{{ trans('attributes.balance.body.meter') }}</span>
                            </div>
                            <div class="col-7 col-12-sp p0">
                                <div class="d-flex">
                                    <span class="number-li">9</span>
                                    <div class="col-11 p0">
                                        <input name="total_revenue" value="{{ $annualPerformance['sum_income'] ? number_format($annualPerformance['sum_income']) : "0" }}" class="h-auto p10 disable-field form-control fs24 fw-bold text-right" id="total_revenue" disabled>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-6 d-flex align-items-center m0 p0 p20l">
                            <div class="w-100 m0 p0 ">
                                <div class="d-flex flex-wrap m0 p0 ">
                                    <div class="p0 d-flex align-items-center">
                                        <span class="d-inline-block fs14">{{ trans('attributes.balance.preview.table_3.title_1') }}</span>
                                    </div>
                                    <div class="col-4 p0">
                                        <div class="col-12 m15l p0">
                                            <input name="basis_for_calculation_9" class="disable-field form-control text-left fs14" id="basis_for_calculation_9" disabled
                                                   value="{{ numberFormatWithUnit(basisCalculationBusinessPlan($annualPerformance['sum_income'], $property['total_area_floors']), ' ' . trans('attributes.common.unit-4')) }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="m0 m30b diagram-analysis">
            <div class="row m0 p0 p30 diagram-block">
                <div class="col-12 m0 p0">
                    <div class="row m0 m10b">
                        <div class="col-6 m0 p0 p20r">
                            <div class="d-flex m0 m0l">
                                <div class="col-11 p0l m5b">
                                    <p class="fs16 fw-bold m0">{{ trans('attributes.balance.body.operating_costs') }}</p>
                                </div>
                                <div class="col-1 p0l p15r d-flex align-items-end justify-content-end">
                                    <p class="fs12 m0">({{ trans('attributes.common.yen') }})</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-6 d-flex align-items-center m0 p0 p20l spH">
                            <div class="m0l w-100">
                                <div class="p0">
                                    <p class="fs16 fw-bold m0">{{ trans('attributes.balance.preview.table_3.table_head') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row m0 m10b">
                        <div class="col-6 row align-items-center m0 p0 p20r">
                            <div class="col-5 col-12-sp p0 d-flex align-items-center">
                                <span class="d-inline-block fs14">{{ trans('attributes.balance.body.maintenance_management_fee') }}</span>
                            </div>
                            <div class="col-7 col-12-sp p0">
                                <div class="d-flex">
                                    <span class="number-li">10</span>
                                    <div class="col-11 p0">
                                        <input name="maintenance_management_fee" value="{{ $annualPerformance['management_fee'] ? number_format($annualPerformance['management_fee']) : "0" }}" class="disable-field form-control text-right fs14" id="revenue_room_rentals" disabled>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-6 d-flex align-items-center m0 p0 p20l">
                            <div class="m0l w-100">
                                <div class="d-flex flex-wrap m0 p0">
                                    <div class=" p0 d-flex align-items-center">
                                        <span class="d-inline-block fs14">{{ trans('attributes.balance.preview.table_3.title_1') }}</span>
                                    </div>
                                    <div class="col-4 p0">
                                        <div class="col-12 m15l p0">
                                            <input name="basis_for_calculation_10" class="disable-field form-control text-left fs14" id="basis_for_calculation_10" disabled
                                                   value="{{ numberFormatWithUnit(basisCalculationBusinessPlan($annualPerformance['management_fee'], number_format($property['total_area_floors'], FLAG_TWO), FLAG_MAX_MONTH), ' ' . trans('attributes.common.unit-4')) }}">
                                        </div>
                                    </div>
                                    <div class="m20l p0 d-flex align-items-center">
                                        <span class="d-inline-block fs14">{{ trans('attributes.balance.preview.table_3.unit') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row m0 m10b">
                        <div class="col-6 row align-items-center m0 p0 p20r">
                            <div class="col-5 col-12-sp p0 d-flex align-items-center">
                                <span class="d-inline-block fs14">{{ trans('attributes.balance.body.utilities_expenses') }}</span>
                            </div>
                            <div class="col-7 col-12-sp p0">
                                <div class="d-flex">
                                    <span class="number-li">11</span>
                                    <div class="col-11 p0">
                                        <input name="electricity_gas_charges" value="{{ $annualPerformance['utilities_fee'] ? number_format($annualPerformance['utilities_fee']) : "0" }}" class="disable-field form-control text-right fs14" id="electricity_gas_charges" disabled>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-6 d-flex align-items-center m0 p0 p20l">
                            <div class="m0l w-100">
                                <div class="d-flex flex-wrap m0 p0">
                                    <div class="p0 d-flex align-items-center">
                                        <span class="d-inline-block fs14">{{ trans('attributes.balance.preview.table_3.title_1') }}</span>
                                    </div>
                                    <div class="col-4 p0">
                                        <div class="col-12 m15l p0">
                                            <input name="basis_for_calculation_11" class="disable-field form-control text-left fs14" id="basis_for_calculation_11" disabled
                                                   value="{{ numberFormatWithUnit(basisCalculationBusinessPlan($annualPerformance['utilities_fee'], number_format($property['total_area_floors'] * 0.3025, FLAG_TWO), FLAG_MAX_MONTH), ' ' . trans('attributes.common.unit-3')) }}">
                                        </div>
                                    </div>
                                    <div class="m20l p0 d-flex align-items-center">
                                        <span class="d-inline-block fs14">{{ trans('attributes.balance.preview.table_3.unit') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row m0 m10b">
                        <div class="col-6 row align-items-center m0 p0 p20r">
                            <div class="col-5 col-12-sp p0 d-flex align-items-center">
                                <span class="d-inline-block fs14">{{ trans('attributes.balance.body.management_repair_fee') }}</span>
                            </div>
                            <div class="col-7 col-12-sp p0">
                                <div class="d-flex">
                                    <span class="number-li">12</span>
                                    <div class="col-11 p0">
                                        <input name="repair_fee" value="{{ $annualPerformance['repair_fee'] ? number_format($annualPerformance['repair_fee']) : "0" }}" class="disable-field form-control text-right fs14" id="repair_fee" disabled>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-6 d-flex align-items-center m0 p0 p20l">
                            <div class="m0l w-100">
                                <div class="d-flex flex-wrap m0 p0">
                                    <div class="p0 d-flex align-items-center">
                                        <span class="d-inline-block fs14">{{ trans('attributes.balance.preview.table_3.title_1') }}</span>
                                    </div>
                                    <div class="col-4 p0">
                                        <div class="col-12 m15l p0">
                                            <input name="basis_for_calculation_12" class="disable-field form-control text-left fs14" id="basis_for_calculation_12" disabled
                                                   value="{{ numberFormatWithUnit(basisCalculationBusinessPlan($annualPerformance['repair_fee'], number_format($property['total_area_floors'], FLAG_TWO)), ' ' . trans('attributes.common.unit-4')) }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row m0 m10b">
                        <div class="col-6 row align-items-center m0 p0 p20r">
                            <div class="col-5 col-12-sp p0 d-flex align-items-center">
                                <span class="d-inline-block fs14">{{ trans('attributes.balance.body.intact_reply_fee') }}</span>
                            </div>
                            <div class="col-7 col-12-sp p0">
                                <div class="d-flex">
                                    <span class="number-li">13</span>
                                    <div class="col-11 p0">
                                        <input name="recovery_costs" value="{{ $annualPerformance['intact_reply_fee'] ? number_format($annualPerformance['intact_reply_fee']) : "0" }}" class="disable-field form-control text-right fs14" id="recovery_costs" disabled>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-6 d-flex align-items-center m0 p0 p20l">
                            <div class="m0l w-100">
                                <div class="d-flex flex-wrap m0 p0">
                                    <div class="p0 d-flex align-items-center">
                                        <span class="d-inline-block fs14">{{ trans('attributes.balance.preview.table_3.title_1') }}</span>
                                    </div>
                                    <div class="col-4 p0">
                                        <div class="col-12 m15l p0">
                                            <input name="basis_for_calculation_13" class="disable-field form-control text-left fs14" id="basis_for_calculation_13" disabled
                                                   value="{{ numberFormatWithUnit(basisCalculationBusinessPlan($annualPerformance['intact_reply_fee'], number_format($property['total_area_floors'], FLAG_TWO)), ' ' . trans('attributes.common.unit-4')) }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row m0 m10b">
                        <div class="col-6 row align-items-center m0 p0 p20r">
                            <div class="col-5 col-12-sp p0 d-flex align-items-center">
                                <span class="d-inline-block fs14">{{ trans('attributes.balance.body.property') }}<br class="spH" />{{ trans('attributes.balance.body.management_fee') }}</span>
                            </div>
                            <div class="col-7 col-12-sp p0">
                                <div class="d-flex">
                                    <span class="number-li">14</span>
                                    <div class="col-11 p0">
                                        <input name="property_management_fee" value="{{ $annualPerformance['asset_management_fee'] ? number_format($annualPerformance['asset_management_fee']) : "0" }}" class="disable-field form-control text-right fs14" id="property_management_fee" disabled>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-6 d-flex align-items-center m0 p0 p20l">
                            <div class="m0l w-100">
                                <div class="d-flex flex-wrap m0 p0">
                                    <div class="p0 d-flex align-items-center">
                                        <span class="d-inline-block fs14">{{ trans('attributes.balance.preview.table_3.title_3') }}</span>
                                    </div>
                                    <div class="col-4 p0">
                                        <div class="col-12 m15l p0">
                                            <input name="basis_for_calculation_14" class="disable-field form-control text-left fs14" id="basis_for_calculation_14" disabled
                                                   value="{{ calculationPercentBusinessPlan($annualPerformance['asset_management_fee'], sumRentalIncome($property)) . ' ' . trans('attributes.common.percent') }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row m0 m10b">
                        <div class="col-6 row align-items-center m0 p0 p20r">
                            <div class="col-5 col-12-sp p0 d-flex align-items-center">
                                <span class="d-inline-block fs14">{{ trans('attributes.balance.body.tenant_recruitment_costs') }}</span>
                            </div>
                            <div class="col-7 col-12-sp p0">
                                <div class="d-flex">
                                    <span class="number-li">15</span>
                                    <div class="col-11 p0">
                                        <input name="find_tenant_fee" value="{{ $annualPerformance['tenant_recruitment_fee'] ? number_format($annualPerformance['tenant_recruitment_fee']) : "0" }}" class="disable-field form-control text-right fs14" id="property_management_fee" disabled>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-6 d-flex align-items-center m0 p0 p20l">
                            <div class="m0l w-100">
                                <div class="d-flex flex-wrap m0 p0">
                                    <div class="p0 d-flex align-items-center">
                                        <span class="d-inline-block fs14">{{ trans('attributes.balance.preview.table_3.title_3') }}</span>
                                    </div>
                                    <div class="col-4 p0">
                                        <div class="col-12 m15l p0">
                                            <input name="basis_for_calculation_15" class="disable-field form-control text-left fs14" id="basis_for_calculation_15" disabled
                                                   value="{{ calculationPercentBusinessPlan($annualPerformance['tenant_recruitment_fee'], sumRentalIncome($property)) . ' ' . trans('attributes.common.percent') }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row m0 m10b">
                        <div class="col-6 row align-items-center m0 p0 p20r">
                            <div class="col-5 col-12-sp p0 d-flex align-items-center">
                                <span class="d-inline-block fs14">{{ trans('attributes.balance.body.taxes_and_dues') }}</span>
                            </div>
                            <div class="col-7 col-12-sp p0">
                                <div class="d-flex">
                                    <span class="number-li">16</span>
                                    <div class="col-11 p0">
                                        <input name="tax" value="{{ $annualPerformance['taxes_dues'] ? number_format($annualPerformance['taxes_dues']) : "0" }}" class="disable-field form-control text-right fs14" id="tax" disabled>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-6 d-flex align-items-center m0 p0 p20l">
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

                    <div class="row m0 m10b">
                        <div class="col-6 row align-items-center m0 p0 p20r">
                            <div class="col-5 col-12-sp p0 d-flex align-items-center">
                                <span class="d-inline-block fs14">{{ trans('attributes.balance.body.non-life_insurance_premiums') }}</span>
                            </div>
                            <div class="col-7 col-12-sp p0">
                                <div class="d-flex">
                                    <span class="number-li">17</span>
                                    <div class="col-11 p0">
                                        <input name="loss_insurance" value="{{ $annualPerformance['insurance_premium'] ? number_format($annualPerformance['insurance_premium']) : "0" }}" class="disable-field form-control text-right fs14" id="loss_insurance" disabled>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-6 d-flex align-items-center m0 p0 p20l">
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

                    <div class="row m0 m10b">
                        <div class="col-6 row align-items-center m0 p0 p20r">
                            <div class="col-5 col-12-sp p0 d-flex align-items-center">
                                <span class="d-inline-block fs14">{{ trans('attributes.single_analysis.rent') }}</span>
                            </div>
                            <div class="col-7 col-12-sp p0">
                                <div class="d-flex">
                                    <span class="number-li">18</span>
                                    <div class="col-11 p0">
                                        <input name="land_rental_fee" value="{{ $annualPerformance['land_tax'] ? number_format($annualPerformance['land_tax']) : "0" }}" class="disable-field form-control text-right fs14" id="land_rent" disabled>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-6 d-flex align-items-center m0 p0 p20l">
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

                    <div class="row m0 m10b">
                        <div class="col-6 row align-items-center m0 p0 p20r">
                            <div class="col-5 col-12-sp p0 d-flex align-items-center">
                                <span class="d-inline-block fs14">{{ trans('attributes.balance.body.other_expenses') }}</span>
                            </div>
                            <div class="col-7 col-12-sp p0">
                                <div class="d-flex">
                                    <span class="number-li">19</span>
                                    <div class="col-11 p0">
                                        <input name="other_costs" value="{{ $annualPerformance['other_fee'] ? number_format($annualPerformance['other_fee']) : "0" }}" class="disable-field form-control text-right fs14" id="other_costs" disabled>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-6 d-flex align-items-center m0 p0 p20l">
                            <div class="m0l w-100">
                                <div class="d-flex flex-wrap m0 p0">
                                    <div class="p0 d-flex align-items-center">
                                        <span class="d-inline-block fs14">{{ trans('attributes.balance.preview.table_3.title_5') }}</span>
                                    </div>
                                    <div class="col-4 p0">
                                        <div class="col-12 m15l p0">
                                            <input name="basis_for_calculation_19" class="disable-field form-control text-left fs14" id="basis_for_calculation_19" disabled
                                                   value="{{ calculationPercentBusinessPlan($annualPerformance['other_fee'], $annualPerformance['sum_income']) . ' ' . trans('attributes.common.percent') }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row m0 m10b">
                        <div class="col-6 row align-items-center m0 p0 p20r">
                            <div class="col-5 col-12-sp p0 d-flex align-items-center">
                                <span class="d-inline-block fs14">{{ trans('attributes.balance.body.meter') }}</span>
                            </div>
                            <div class="col-7 col-12-sp p0">
                                <div class="d-flex">
                                    <span class="number-li">20</span>
                                    <div class="col-11 p0">
                                        <input name="total_cost" value="{{ $annualPerformance['sum_fee'] ? number_format($annualPerformance['sum_fee']) : "0" }}" class="h-auto p10 disable-field form-control fs24 fw-bold text-right" id="total_cost" disabled>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-6 d-flex align-items-center m0 p0 p20l">
                            <div class="m0l w-100">
                                <div class="d-flex flex-wrap m0 p0">
                                    <div class="p0 d-flex align-items-center m55r">
                                        <span class="d-inline-block fs14">{{ trans('attributes.property.cost_ratio') }}</span>
                                    </div>
                                    <div class="col-4 p0">
                                        <div class="col-12 m30l p0">
                                            <input name="basis_for_calculation_20" class="disable-field form-control text-left fs14" id="basis_for_calculation_20" disabled
                                                   value="{{ number_format(divisionNumber($annualPerformance['sum_fee'], $annualPerformance['sum_income']) * 100, FLAG_TWO) . ' ' . trans('attributes.common.percent') }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="m0 m30b diagram-analysis">
            <div class="row m0 p30 m25b diagram-block">
                <div class="col-12 m0 p0">
                    <div class="row m0 m10b">
                        <div class="col-6 row align-items-center m0 p0 p20r">
                            <div class="col-5 col-12-sp p0 d-flex align-items-center">
                                <span class="d-flex flex-wrap fs14">{{ trans('attributes.balance.body.operating_balance') }}(<span class="number-li m5l m5r">9</span>-<span class="number-li m5l m5r">20</span>)</span>
                            </div>
                            <div class="col-7 col-12-sp p0">
                                <div class="d-flex p10t-sp">
                                    <span class="number-li">21</span>
                                    <div class="col-11 p0">
                                        <input name="basis_for_calculation_21" class="h-auto p10 disable-field form-control fs24 fw-bold text-right operating-expenses" id="basis_for_calculation_21" disabled
                                               value="{{ $annualPerformance['sum_difference'] ? number_format($annualPerformance['sum_difference']) . ' ' . trans('attributes.common.yen') : "0 " . trans('attributes.common.yen') }}">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-6 d-flex align-items-center m0 p0 p20l">
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
                </div>
            </div>
        </div>
        @endif

        <div class="col-12 text-center text-lg-right p0 text-right group-button-top">
            <button type="submit" class="btn w-auto custom-btn-primary fs15 btn-save-simple-assessment">{{ trans('attributes.simulation.content.text_btn_save') }}</button>
            <button id="pre-print" type="button" class="btn w-auto custom-btn-success fs15 m15l btn-responsive print-simple-assessment">{{ trans('attributes.balance.header.btn_preview') }}</button>
        </div>
    </div><!-- /#main-info-assessment -->
    <form id="form-condition-2" action="{{ route(USER_PROPERTY_SIMPLE_ASSESSMENT, $property['id']) }}" method="GET">
        <input type="hidden" name="paginate_previous" value="{{ request('paginate_previous') ?? request('option_paginate') }}">
        <input type="hidden" name="screen" value="{{ request('screen') }}">
        <input type="hidden" name="year" value="">
    </form>
    @include('backend.preview_print.simple_assessment_print')
@endsection
@section('js')
    <script src="{{ asset('dist/js/simple-assessment.min.js') }}"></script>
@endsection
