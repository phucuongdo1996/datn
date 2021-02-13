@extends('layout.home.master')
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/preview/confirm-final.css') }}">
@endsection
@section('content')
    <div class="content-wrapper content-confirm-final">
        <div class="container-fluid container-wrapper container-padding container-wrapper-confirm p70b @if(request('show_print') == true) has-print @endif">
            <div id="main-info-assessment">
                <div class="row row-header m40b">
                    <div class="row m0">
                        <div class="col-12 text-center text-md-left p0">
                            <h3 class="m0">{{ trans('attributes.tax.title') }}</h3>
                        </div>
                    </div>
                </div>
                @include('partials.flash_messages')

                <form id="tax-form">
                    @csrf
                    @method('put')
                    <input type="hidden" name="option_paginate" value="{{ $perPage }}" readonly>
                    <input type="hidden" name="tax_id" value="{{ $data->id }}" readonly>
                    <input type="hidden" name="time_open_page" value="{{ date('Y/m/d H:i:s', time()) }}" readonly>
                    <input type="hidden" name="user_id" value="{{ $currentUser->id }}" readonly>
                    <div class="w-100 m30b">
                        <div id="form-condition-1" class="row m0 m30b">
                            <div class="col-12 col-xl-8 text-center text-md-right m0 p0 group-status-top row">
                                <div class="btn-group w-auto m20r m10b">
                                    <div class="btn label-option fs14 centered fw-bold p15r p15l custom-confirm-final">{{ trans('attributes.rent_roll_list.year') }}</div>
                                    <div class="btn wrap-input-option fs14 w120 p0 custom-confirm-final">
                                        <select disabled id="select-year" name="year" class="option-paginate-1 btn form-control hp100 p0 p15r p15l">
                                            <option class="m20r m20l" value="{{ $data->year }}" selected>{{ $data->year . trans('attributes.common.year') }}</option>
                                        </select>
                                    </div>
                                </div>
                                <div id="block-month" class="btn-group w-auto m20r m10b">
                                    <div class="btn label-option fs14 centered fw-bold p15r p15l custom-confirm-final">{{ trans('attributes.rent_roll_list.month') }}</div>
                                    <div class="btn wrap-input-option fs14 w120 p0 custom-confirm-final">
                                        <select disabled id="select-month" name="month" class="option-paginate-1 btn form-control hp100 p0 p15r p15l">
                                                <option class="m20r m20l" value="{{ $data->month }}" selected>{{ $data->month . trans('attributes.common.month') }}</option>
                                        </select>
                                    </div>
                                </div>
                                @if($currentUser->role == BROKER || $currentUser->role == EXPERT)
                                <div class="btn-group w-auto m20r m10b">
                                    <div class="btn label-option fs14 centered fw-bold p15r p15l custom-confirm-final">{{ trans('attributes.register_info.item_block.label.proprietor_2') }}</div>
                                    <div class="btn wrap-input-option fs14 w200 p0 custom-confirm-final">
                                        <select disabled id="select-proprietor" name="proprietor" class="option-paginate-1 btn form-control hp100 p0 p15r p15l">
                                            <option class="m20r m20l" value="{{ $data->proprietor }}">{{ $data->proprietor ?? 'ー' }}</option>
                                        </select>
                                    </div>
                                </div>
                                @endif
                            </div>
                            <div id="popup-list" class="col-12 col-xl-4 col-12-sp text-lg-right p0 text-right group-button-top">
                                <button id="btn-select-house" type="button" class="btn br8 custom-btn-default m10r dropdown-toggle fs15 fs13-sp" data-toggle="dropdown" aria-expanded="true">{{ trans('attributes.balance.header.btn_choose') }}</button>
                                <ul class="dropdown-menu  set-scrollbar list-house-tax">
                                    @include('backend.property.confirm_final.list_house', ['listProperty' => $listProperty])
                                </ul>
                                <a href="#" class="btn custom-btn-primary fs15 sort-property m15r w70 btn-edit-tax-form m10t-sp">{{ trans('attributes.tax.btn_update') }}</a>
                                <a class="btn w-auto custom-btn-success fs15 m10t-sp pre-print show-print">{{ trans('attributes.portfolio_analysis.pre_print') }}</a>
                            </div>
                            <div class="has-error-confirm has-error-simulation col-12 col-sm-8 col-xl-8 m10t centered-vertical" style="display: none !important;">
                                <span class="text-red error-simulation error_month error_year"></span>
                            </div>
                        </div>
                    </div>
                    <div class="w-65 m30b">
                        <div class="m0 m30b diagram-analysis">
                            <div class="p30 m25b diagram-block">
                                <div class="col-12 p0">
                                    <div class="col-12 d-flex m15b m0l p0">
                                        <div class="col-11 p0 m5b">
                                            <p class="fs16 fw-bold m0">{{ trans('attributes.tax.income') }}<i class="far fa-question-circle m10l" aria-hidden="true"></i></p>
                                        </div>
                                        <div class="col-1 p0 d-flex align-items-end justify-content-end">
                                            <p class="fs12 m0">({{ trans('attributes.common.yen') }})</p>
                                        </div>
                                    </div>

                                    <div class="item-simulation fs14">
                                        <div class="row m-0">
                                            <div class="col-8 p0 d-flex align-items-center">
                                                <span class="number-li m10r">1</span>
                                                <span class="d-inline-block">{{ trans('attributes.tax.rent') }}</span>
                                            </div>
                                            <div class="col-4 p0">
                                                @php($totalRent = $dataProperty->total_rent_income + $dataProperty->total_revenue_land_taxes + $dataProperty->total_parking_revenue + $dataProperty->total_general_services)
                                                <input disabled name="total_rent" value="{{ $totalRent }}" class="input-income disable-field form-control input-simulation text-right operating-revenue convert-data">
                                                <span class="text-red error-simulation error_rent"></span>
                                            </div>
                                        </div>

                                        <div class="row m-0 p15t">
                                            <div class="col-8 p0 d-flex align-items-center">
                                                <span class="number-li m10r">2</span>
                                                <span class="d-inline-block">{{ trans('attributes.tax.key_money') }}</span>
                                            </div>
                                            <div class="col-4 p0">
                                                @php($totalKeyMoney = $dataProperty->total_income_input_money + $dataProperty->total_income_update_house_contract)
                                                <input disabled name="total_key_money" value="{{ $totalKeyMoney }}" class="input-income disable-field form-control input-simulation text-right operating-revenue convert-data">
                                                <span class="text-red error-simulation error_key_money"></span>
                                            </div>
                                        </div>

                                        <div class="row m-0 p15t">
                                            <div class="col-8 p0 d-flex align-items-center">
                                                <span class="number-li m10r">3</span>
                                                <span class="d-inline-block">{{ trans('attributes.balance.body.other_income') }}</span>
                                            </div>
                                            <div class="col-4 p0">
                                                @php($totalOtherIncome = $dataProperty->total_utilities_revenue + $dataProperty->total_other_income)
                                                <input disabled name="total_other_income" value="{{ $totalOtherIncome }}" class="input-income disable-field form-control input-simulation text-right operating-revenue convert-data">
                                                <span class="text-red error-simulation error_other_income"></span>
                                            </div>
                                        </div>

                                        <div class="row m-0 p15t">
                                            <div class="col-8 p0 d-flex align-items-center">
                                                <span class="number-li m10r">4</span>
                                                <span class="d-inline-block">{{ trans('attributes.balance.body.meter') }}</span>
                                            </div>
                                            <div class="col-4 p0">
                                                @php($totalIncome = $totalRent + $totalKeyMoney + $totalOtherIncome)
                                                <input id="item4" disabled name="total_income" value="{{ $totalIncome }}" class="disable-field form-control input-simulation text-right operating-revenue convert-data">
                                                <span class="text-red error-simulation error_total_income"></span>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="m0 m30b diagram-analysis">
                            <div class="p30 m25b diagram-block">
                                <div class="col-12 p0">
                                    <div class="col-12 d-flex m15b m0l p0">
                                        <div class="col-11 p0 m5b">
                                            <p class="fs16 fw-bold m0">{{ trans('attributes.tax.necessary_expenses') }}<i class="far fa-question-circle m10l" aria-hidden="true"></i></p>
                                        </div>
                                        <div class="col-1 p0 d-flex align-items-end justify-content-end">
                                            <p class="fs12 m0">({{ trans('attributes.common.yen') }})</p>
                                        </div>
                                    </div>

                                    <div class="item-simulation fs14">
                                        <div class="row m-0">
                                            <div class="col-8 p0 d-flex align-items-center">
                                                <span class="number-li">5</span>
                                                <span class="d-inline-block">{{ trans('attributes.tax.taxes_dues') }}</span>
                                            </div>
                                            <div class="col-4 p0">
                                                @php($totalTaxesDues = $dataProperty->total_taxes_dues ?? FLAG_ZERO)
                                                <input disabled name="total_taxes_dues" value="{{ $totalTaxesDues }}" class="input-expenses disable-field form-control input-simulation text-right operating-revenue convert-data">
                                                <span class="text-red error-simulation error_taxes_dues"></span>
                                            </div>
                                        </div>

                                        <div class="row m-0 p15t">
                                            <div class="col-8 p0 d-flex align-items-center">
                                                <span class="number-li">6</span>
                                                <span class="d-inline-block">{{ trans('attributes.simulation.content.operating_fee.damage_insurance') }}</span>
                                            </div>
                                            <div class="col-4 p0">
                                                @php($totalInsurancePremium = $dataProperty->total_insurance_premium ?? FLAG_ZERO)
                                                <input disabled name="total_insurance_premium" value="{{ $totalInsurancePremium }}" class="input-expenses disable-field form-control input-simulation text-right operating-revenue convert-data">
                                                <span class="text-red error-simulation error_non_life_insurance_premiums"></span>
                                            </div>
                                        </div>

                                        <div class="row m-0 p15t">
                                            <div class="col-8 p0 d-flex align-items-center">
                                                <span class="number-li">7</span>
                                                <span class="d-inline-block">{{ trans('attributes.balance.body.repair_fee') }}</span>
                                            </div>
                                            <div class="col-4 p0">
                                                @php($totalRepairCosts = $dataProperty->total_repair_fee + $dataProperty->total_intact_reply_fee)
                                                <input disabled name="total_repair_costs" value="{{ $totalRepairCosts }}" class="input-expenses disable-field form-control input-simulation text-right operating-revenue convert-data">
                                                <span class="text-red error-simulation error_repair_costs"></span>
                                            </div>
                                        </div>

                                        <div class="row m-0 p15t">
                                            <div class="col-8 p0 d-flex align-items-center">
                                                <span class="number-li">8</span>
                                                <span class="d-inline-block">{{ trans('attributes.tax.depreciation') }}</span>
                                            </div>
                                            <div class="col-4 p0">
                                                <input disabled name="depreciation" value="＊＊＊" class="input-expenses disable-field form-control input-simulation text-right operating-revenue">
                                                <span class="text-red error-simulation error_depreciation"></span>
                                            </div>
                                        </div>

                                        <div class="row m-0 p15t">
                                            <div class="col-8 p0 d-flex align-items-center">
                                                <span class="number-li">9</span>
                                                <span class="d-inline-block">{{ trans('attributes.tax.borrowing_interest') }}</span>
                                            </div>
                                            <div class="col-4 p0">
                                                <input disabled name="borrowing_interest" value="＊＊＊" class="input-expenses disable-field form-control input-simulation text-right operating-revenue">
                                                <span class="text-red error-simulation error_borrowing_interest"></span>
                                            </div>
                                        </div>

                                        <div class="row m-0 p15t">
                                            <div class="col-8 p0 d-flex align-items-center">
                                                <span class="number-li">10</span>
                                                <span class="d-inline-block">{{ trans('attributes.simulation.content.operating_fee.land_tax') }}</span>
                                            </div>
                                            <div class="col-4 p0">
                                                @php($totalLandTax = $dataProperty->total_land_tax ?? FLAG_ZERO)
                                                <input disabled name="total_land_tax" value="{{ $totalLandTax }}" class="input-expenses disable-field form-control input-simulation text-right operating-revenue convert-data">
                                                <span class="text-red error-simulation error_payment_rent"></span>
                                            </div>
                                        </div>

                                        <div class="row m-0 p15t">
                                            <div class="col-8 p0 d-flex align-items-center">
                                                <span class="number-li">11</span>
                                                <span class="d-inline-block">{{ trans('attributes.tax.salary_wage') }}</span>
                                            </div>
                                            <div class="col-4 p0">
                                                <input disabled name="salary_wage" value="＊＊＊" class="input-expenses disable-field form-control input-simulation text-right operating-revenue">
                                                <span class="text-red error-simulation error_salary_wage"></span>
                                            </div>
                                        </div>

                                        <div class="row m-0 p15t">
                                            <div class="col-8 p0 d-flex align-items-center">
                                                <span class="number-li">12</span>
                                                <span class="d-inline-block">{{ trans('attributes.tax.building_management_fee') }}</span>
                                            </div>
                                            <div class="col-4 p0">
                                                @php($totalManagementFee = $dataProperty->total_management_fee ?? FLAG_ZERO)
                                                <input disabled name="total_management_fee" value="{{ $totalManagementFee }}" class="input-expenses disable-field form-control input-simulation text-right operating-revenue convert-data">
                                                <span class="text-red error-simulation error_maintenance_management_fee"></span>
                                            </div>
                                        </div>

                                        <div class="row m-0 p15t">
                                            <div class="col-8 p0 d-flex align-items-center">
                                                <span class="number-li">13</span>
                                                <span class="d-inline-block">{{ trans('attributes.simulation.content.operating_fee.utilities') }}</span>
                                            </div>
                                            <div class="col-4 p0">
                                                @php($totalUtilitiesFee = $dataProperty->total_utilities_fee ?? FLAG_ZERO)
                                                <input disabled name="total_utilities_fee" value="{{ $totalUtilitiesFee }}" class="input-expenses disable-field form-control input-simulation text-right operating-revenue convert-data">
                                                <span class="text-red error-simulation error_utilities_expenses"></span>
                                            </div>
                                        </div>

                                        <div class="row m-0 p15t">
                                            <div class="col-8 p0 d-flex align-items-center">
                                                <span class="number-li">14</span>
                                                <span class="d-inline-block">{{ trans('attributes.tax.management_fee') }}</span>
                                            </div>
                                            <div class="col-4 p0">
                                                @php($totalAssetManagementFee = $dataProperty->total_asset_management_fee ?? FLAG_ZERO)
                                                <input disabled name="total_asset_management_fee" value="{{ $totalAssetManagementFee }}" class="input-expenses disable-field form-control input-simulation text-right operating-revenue convert-data">
                                                <span class="text-red error-simulation error_management_fee"></span>
                                            </div>
                                        </div>

                                        <div class="row m-0 p15t">
                                            <div class="col-8 p0 d-flex align-items-center">
                                                <span class="number-li">15</span>
                                                <span class="d-inline-block">{{ trans('attributes.tax.commission_paid') }}</span>
                                            </div>
                                            <div class="col-4 p0">
                                                @php($totalTenantRecruitmentFee = $dataProperty->total_tenant_recruitment_fee ?? FLAG_ZERO)
                                                <input disabled name="total_tenant_recruitment_fee" value="{{ $totalTenantRecruitmentFee }}" class="input-expenses disable-field form-control input-simulation text-right operating-revenue convert-data">
                                                <span class="text-red error-simulation error_commission_paid"></span>
                                            </div>
                                        </div>

                                        <div class="row m-0 p15t">
                                            <div class="col-8 p0 d-flex align-items-center">
                                                <span class="number-li">16</span>
                                                <span class="d-inline-block">{{ trans('attributes.tax.bad_debt_losses') }}</span>
                                            </div>
                                            <div class="col-4 p0">
                                                @php($totalBadDebtLosses = $dataProperty->total_bad_debt_losses ?? FLAG_ZERO)
                                                <input disabled name="total_bad_debt_losses" value="{{ $totalBadDebtLosses }}" class="input-expenses disable-field form-control input-simulation text-right operating-revenue convert-data">
                                                <span class="text-red error-simulation error_loan_loss"></span>
                                            </div>
                                        </div>

                                        <div class="row m-0 p15t">
                                            <div class="col-8 p0 d-flex align-items-center">
                                                <span class="number-li">17</span>
                                                <span class="d-inline-block">{{ trans('attributes.tax.other_expenses') }}</span>
                                            </div>
                                            <div class="col-4 p0">
                                                @php($otherExpenses = $dataProperty->other_expenses ?? FLAG_ZERO)
                                                <input disabled name="other_expenses" value="{{ $otherExpenses }}" class="input-expenses disable-field form-control input-simulation text-right operating-revenue convert-data">
                                                <span class="text-red error-simulation error_other_expenses"></span>
                                            </div>
                                        </div>

                                        <div class="row m-0 p15t">
                                            <div class="col-8 p0 d-flex align-items-center">
                                                <span class="number-li">18</span>
                                                <span class="d-inline-block">{{ trans('attributes.balance.body.meter') }}</span>
                                            </div>
                                            <div class="col-4 p0">
                                                @php($totalRequiredExpenses = $totalTaxesDues + $totalInsurancePremium + $totalRepairCosts + $totalLandTax + $totalManagementFee +
                                                        $totalUtilitiesFee + $totalAssetManagementFee + $totalTenantRecruitmentFee + $totalBadDebtLosses + $otherExpenses)
                                                <input id="item18" disabled name="total_required_expenses" value="{{ $totalRequiredExpenses }}" class="disable-field form-control input-simulation text-right operating-revenue convert-data">
                                                <span class="text-red error-simulation error_total_required_expenses"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="m0 m30b diagram-analysis">
                            <div class="p30 m25b diagram-block">
                                <div class="col-12 p0">
                                    <div class="col-12 d-flex m15b m0l p0">
                                        <div class="col-12 p0 d-flex align-items-end justify-content-end">
                                            <p class="fs12 m0">({{ trans('attributes.common.yen') }})</p>
                                        </div>
                                    </div>

                                    <div class="item-simulation fs14">
                                        <div class="row m-0">
                                            <div class="col-8 p0 d-flex align-items-center">
                                                <span class="number-li">19</span>
                                                <span class="d-inline-block m10r">{{ trans('attributes.tax.balance') }}</span>
                                                <span class="red-text">(4) - (18)</span>
                                            </div>
                                            <div class="col-4 p0">
                                                <input id="item19" disabled name="balance" value="{{ $totalIncome - $totalRequiredExpenses }}" class="disable-field form-control input-simulation text-right operating-revenue convert-data">
                                                <span class="text-red error-simulation error_balance"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-12-sp text-lg-right p0 text-right group-button-top">
                            <a href="#" class="btn custom-btn-primary fs15 sort-property m15r w70 btn-edit-tax-form">{{ trans('attributes.tax.btn_update') }}</a>
                            <a class="btn w-auto custom-btn-success fs15 pre-print m10t-sp">{{ trans('attributes.portfolio_analysis.pre_print') }}</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @include('backend.preview_print.confirm-final')
@endsection
@section('js')
    <script src="{{ asset('dist/js/tax.min.js') }}"></script>
@endsection

