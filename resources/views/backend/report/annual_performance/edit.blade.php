@extends('layout.home.master')
@section('content')
    <div class="container-fluid container-wrapper container-wrapper-add">
        <div id="main-info-assessment">

            <div class="row row-header m50b">
                <div class="row m0">
                    <div class="col-12 text-center text-md-left p0">
                        <h3 class="m0">{{ trans('attributes.annual_performance.title_edit') }}<span class="fs24 fw-normal">{{ $property['house_name'] }}</span></h3>
                    </div>
                </div>
            </div>
            @include('partials.flash_messages')
            <form id="form-condition-1" class="row m0 m30b">
                <div class="w-auto text-center text-md-right m0 m9r-pr p0 group-status-top row">
                    <div id="block-status" class="row spBlock m0 m15r w-auto">
                        <div class="centered first-block p15r p15l">
                            <label class="m0">{{ trans('attributes.property.status') }}</label>
                        </div>
                        <div class="centered p0 p15r p15l w90">
                            <div class="fw-normal">{{ STATUS_HOUSE[$property['status']] }}</div>
                        </div>
                    </div>
                    @if ($currentUser->role != INVESTOR)
                        <div id="block-status" class="row spBlock m0 w-auto">
                            <div class="centered first-block p15r p15l">
                                <label class="m0">{{ trans('attributes.repair_history.owner') }}</label>
                            </div>
                            <div class="centered-vertical p0 p15r p15l w250">
                                <div class="fw-normal">{{ $property['proprietor'] ?? 'ー'}}</div>
                            </div>
                        </div>
                    @endif
                </div>
            </form>
            <form id="form-annual-performance">
                <input name="property_id" type="text" value="{{ $property['id'] }}"
                       class="d-none" disabled/>
                <input type="hidden" name="time_open_page" value="{{ date('Y/m/d H:i:s', time()) }}" readonly>
                <div class="col-12 col-sm-7 m30b p0">
                    <div class="m0 diagram-analysis">
                        <div class="p30 diagram-block">

                            <div class="row m-0 m15t p0">
                                <div class="w-40 col-12-sp p0 d-flex align-items-center">
                                    <span class="d-inline-block">{{ trans('attributes.rent_roll_list.year') }}</span>
                                </div>
                                <div class="w-60 col-12-sp p0">
                                    <div class="wp100 m20r">
                                        <input name="year" value="{{ $annualPer['year'] }}" class="fs14 form-control m5t m5b text-center" readonly>
                                    </div>
                                    <p class="error-message m0" data-error="year"></p>
                                </div>
                            </div>

                            <!-- 0320 add -->
                            <div class="row m-0 m15t p0">
                                <div class="w-40 col-12-sp p0 d-flex align-items-center">
                                    <span class="d-inline-block">{{ trans('attributes.property.annual_month') }}</span>
                                </div>
                                <div class="w-60 col-12-sp p0">
                                    <div class="wp100 m20r">
                                        <input name="month" value="{{ $property['date_month_registration_revenue'] }}"
                                               class="disable-field form-control p6 p10l p10r h-auto fs14 text-center" disabled>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex m25t m0l">
                                <div class="col-11 p0l">
                                    <p class="fs16 fw-bold m0">{{ trans('attributes.property.items_related_to_benefits') }}</p>
                                </div>
                            </div>

                            <div class="row m-0 m15t p0">
                                <div class="w-40 col-12-sp p0 d-flex align-items-center">
                                    <span class="d-inline-block">{{ trans('attributes.property.total_tenants') }}</span>
                                </div>
                                <div class="w-60 col-12-sp p0">
                                    <div class="wp100 m20r">
                                        <input name="total_tenants" class="form-control p6 p10l p10r h-auto fs14 text-right convert-data" value="{{ $annualPer['total_tenants'] }}">
                                    </div>
                                </div>
                            </div>

                            <div class="row m-0 m15t p0">
                                <div class="w-40 col-12-sp p0 d-flex align-items-center">
                                    <span class="d-inline-block">{{ trans('attributes.property.area_can_for_rent') }}</span>
                                </div>
                                <div class="w-60 col-12-sp p0">
                                    <div class="wp100 m20r">
                                        <input name="area_may_rent" id="area-may-rent" class="form-control p6 p10l p10r h-auto fs14 text-right convert-number-double-decimal" value="{{ $annualPer['area_may_rent'] }}">
                                    </div>
                                </div>
                            </div>

                            <div class="row m-0 m15t p0">
                                <div class="w-40 col-12-sp p0 d-flex align-items-center">
                                    <span class="d-inline-block">{{ trans('attributes.property.deposit') }}</span>
                                </div>
                                <div class="w-60 col-12-sp p0">
                                    <div class="wp100 m20r">
                                        <input name="deposits" class="form-control p6 p10l p10r h-auto fs14 text-right convert-data" value="{{ $annualPer['deposits'] }}">
                                    </div>
                                </div>
                            </div>
                            <!-- 0320 add -->

                            <div class="d-flex m25t m0l">
                                <div class="col-11 p0l">
                                    <p class="fs16 fw-bold m0">{{ trans('attributes.simulation.content.operating_revenue.title') }}</p>
                                </div>
                                <div class="col-1 m3l p0 d-flex align-items-end justify-content-end ">
                                    <p class="fs12 fw-normal m0">({{ trans('attributes.common.yen') }})</p>
                                </div>
                            </div>

                            @if(in_array($property['real_estate_type_id'], [FLAG_NINE, FLAG_TEN]))
                                <div class="row m-0 m15t p0">
                                    <div class="w-40 col-12-sp p0 d-flex align-items-center">
                                         <span class="number-li">0</span>
                                         <span class="d-inline-block w-70">{{ __('attributes.register_info.item_block.label.rent_income') }}<br>
                                            {{ __('attributes.register_info.item_block.label.rent_income_1') }}</span>
                                    </div>
                                    <div class="w-60 col-12-sp p0">
                                        <div class="wp100 m20r">
                                            <input name="revenue_land_taxes" type="text" value="{{ $annualPer['revenue_land_taxes'] }}"
                                                   class="form-control m0 p13 p8l p8r h-auto fs14 text-right convert-data sum-income"/>
                                            <p class="error-message m0" data-error="revenue_land_taxes"></p>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <div class="row m-0 m15t p0">
                                <div class="w-40 col-12-sp p0 d-flex align-items-center">
                                    <span class="number-li">1</span>
                                    <span class="d-inline-block w-70">{{ trans('attributes.balance.body.rent_income') }}</span>
                                </div>
                                <div class="w-60 col-12-sp p0">
                                    <div class="wp100 m20r">
                                        <input name="rent_income" type="text" value="{{ $annualPer['rent_income'] }}"
                                               class="form-control m0 p13 p8l p8r h-auto fs14 text-right convert-data sum-income"/>
                                        <p class="error-message m0" data-error="rent_income"></p>
                                    </div>
                                </div>
                            </div>

                            <div class="row m-0 m15t p0">
                                <div class="w-40 col-12-sp p0 d-flex align-items-center">
                                    <span class="number-li">2</span>
                                    <span class="d-inline-block w-70">{{ trans('attributes.simulation.content.operating_revenue.general_services') }}</span>
                                </div>
                                <div class="w-60 col-12-sp p0">
                                    <div class="wp100 m20r">
                                        <input name="general_services" type="text" value="{{ $annualPer['general_services'] }}"
                                               class="form-control m0 p13 p8l p8r h-auto fs14 text-right convert-data sum-income"/>
                                        <p class="error-message m0" data-error="general_services"></p>
                                    </div>
                                </div>
                            </div>

                            <div class="row m-0 m15t p0">
                                <div class="w-40 col-12-sp p0 d-flex align-items-center">
                                    <span class="number-li">3</span>
                                    <span class="d-inline-block w-70">{{ trans('attributes.register_info.item_block.label.utilities_revenue') }}</span>
                                </div>
                                <div class="w-60 col-12-sp p0">
                                    <div class="wp100 m20r">
                                        <input name="utilities_revenue" type="text" value="{{ $annualPer['utilities_revenue'] }}"
                                               class="form-control m0 p13 p8l p8r h-auto fs14 text-right convert-data sum-income"/>
                                        <p class="error-message m0" data-error="utilities_revenue"></p>
                                    </div>
                                </div>
                            </div>

                            <div class="row m-0 m15t p0">
                                <div class="w-40 col-12-sp p0 d-flex align-items-center">
                                    <span class="number-li">4</span>
                                    <span class="d-inline-block w-70">{{ trans('attributes.balance.body.parking_revenue') }}</span>
                                </div>
                                <div class="w-60 col-12-sp p0">
                                    <div class="wp100 m20r">
                                        <input name="parking_revenue" type="text" value="{{ $annualPer['parking_revenue'] }}"
                                               class="form-control m0 p13 p8l p8r h-auto fs14 text-right convert-data sum-income"/>
                                        <p class="error-message m0" data-error="parking_revenue"></p>
                                    </div>
                                </div>
                            </div>

                            <div class="row m-0 m15t p0">
                                <div class="w-40 col-12-sp p0 d-flex align-items-center">
                                    <span class="number-li">5</span>
                                    <span class="d-inline-block w-70">{{ trans('attributes.simulation.content.operating_revenue.income_input_money') }}</span>
                                </div>
                                <div class="w-60 col-12-sp p0">
                                    <div class="wp100 m20r">
                                        <input name="income_input_money" type="text" value="{{ $annualPer['income_input_money'] }}"
                                               class="form-control m0 p13 p8l p8r h-auto fs14 text-right convert-data sum-income"/>
                                        <p class="error-message m0" data-error="income_input_money"></p>
                                    </div>
                                </div>
                            </div>

                            <div class="row m-0 m15t p0">
                                <div class="w-40 col-12-sp p0 d-flex align-items-center">
                                    <span class="number-li">6</span>
                                    <span class="d-inline-block w-70">{{ trans('attributes.simulation.content.operating_revenue.income_update_house_contract') }}</span>
                                </div>
                                <div class="w-60 col-12-sp p0">
                                    <div class="wp100 m20r">
                                        <input name="income_update_house_contract" type="text" value="{{ $annualPer['income_update_house_contract'] }}"
                                               class="form-control m0 p13 p8l p8r h-auto fs14 text-right convert-data sum-income"/>
                                        <p class="error-message m0" data-error="income_update_house_contract"></p>
                                    </div>
                                </div>
                            </div>

                            <div class="row m-0 m15t p0">
                                <div class="w-40 col-12-sp p0 d-flex align-items-center">
                                    <span class="number-li">7</span>
                                    <span class="d-inline-block w-70">{{ trans('attributes.balance.body.other_income') }}</span>
                                </div>
                                <div class="w-60 col-12-sp p0">
                                    <div class="wp100 m20r">
                                        <input name="other_income" type="text" value="{{ $annualPer['other_income'] }}"
                                               class="form-control m0 p13 p8l p8r h-auto fs14 text-right convert-data sum-income"/>
                                        <p class="error-message m0" data-error="other_income"></p>
                                    </div>
                                </div>
                            </div>

                            <div class="row m-0 m15t p0">
                                <div class="w-40 col-12-sp p0 d-flex align-items-center">
                                    <span class="number-li">8</span>
                                    <span class="d-inline-block w-70">{{ trans('attributes.register_info.item_block.label.etc') }}</span>
                                </div>
                                <div class="w-60 col-12-sp p0">
                                    <div class="wp100 m20r">
                                        <input name="bad_debt_losses" type="text" value="{{ $annualPer['bad_debt_losses'] }}"
                                               class="form-control m0 p13 p8l p8r h-auto fs14 text-right convert-data sum-income"/>
                                        <p class="error-message m0" data-error="bad_debt_losses"></p>
                                    </div>
                                </div>
                            </div>

                            <div class="row m-0 m15t p0">
                                <div class="w-40 col-12-sp p0 d-flex align-items-center">
                                    <span class="number-li">9</span>
                                    <span class="d-inline-block w-70">{{ trans('attributes.simulation.content.operating_fee.sum') }}</span>
                                </div>
                                <div class="w-60 col-12-sp p0">
                                    <div class="wp100 m20r">
                                        <input name="sum_income" type="text" value="{{ $annualPer['sum_income'] }}"
                                               class="disable-field form-control p6 p10l p10r h-auto fs14 convert-data text-right"
                                               readonly>
                                    </div>
                                </div>
                            </div>


                            <div class="d-flex m25t m0l">
                                <div class="col-11 p0l">
                                    <p class="fs16 fw-bold m0">{{ trans('attributes.simulation.content.operating_fee.title') }}</p>
                                </div>
                                <div class="col-1 m3l p0 d-flex align-items-end justify-content-end ">
                                    <p class="fs12 fw-normal m0">({{ trans('attributes.common.yen') }})</p>
                                </div>
                            </div>

                            <div class="row m-0 m15t p0">
                                <div class="w-40 col-12-sp p0 d-flex align-items-center">
                                    <span class="number-li">10</span>
                                    <span class="d-inline-block w-70">{{ trans('attributes.register_info.item_block.label.management_fee') }}</span>
                                </div>
                                <div class="w-60 col-12-sp p0">
                                    <div class="wp100 m20r">
                                        <input name="management_fee" type="text" value="{{ $annualPer['management_fee'] }}"
                                               class="form-control m0 p13 p8l p8r h-auto fs14 text-right convert-data sum-fee"/>
                                        <p class="error-message m0" data-error="management_fee"></p>
                                    </div>
                                </div>
                            </div>

                            <div class="row m-0 m15t p0">
                                <div class="w-40 col-12-sp p0 d-flex align-items-center">
                                    <span class="number-li">11</span>
                                    <span class="d-inline-block w-70">{{ trans('attributes.simulation.content.operating_fee.utilities') }}</span>
                                </div>
                                <div class="w-60 col-12-sp p0">
                                    <div class="wp100 m20r">
                                        <input name="utilities_fee" type="text" value="{{ $annualPer['utilities_fee'] }}"
                                               class="form-control m0 p13 p8l p8r h-auto fs14 text-right convert-data sum-fee"/>
                                        <p class="error-message m0" data-error="utilities_fee"></p>

                                    </div>
                                </div>
                            </div>

                            <div class="row m-0 m15t p0">
                                <div class="w-40 col-12-sp p0 d-flex align-items-center">
                                    <span class="number-li">12</span>
                                    <span class="d-inline-block w-70">{{ trans('attributes.register_info.item_block.label.repair_fee') }}</span>
                                </div>
                                <div class="w-60 col-12-sp p0">
                                    <div class="wp100 m20r">
                                        <input name="repair_fee" type="text" value="{{ $annualPer['repair_fee'] }}"
                                               class="form-control m0 p13 p8l p8r h-auto fs14 text-right convert-data sum-fee"/>
                                        <p class="error-message m0" data-error="repair_fee"></p>
                                    </div>
                                </div>
                            </div>

                            <div class="row m-0 m15t p0">
                                <div class="w-40 col-12-sp p0 d-flex align-items-center">
                                    <span class="number-li">13</span>
                                    <span class="d-inline-block w-70">{{ trans('attributes.register_info.item_block.label.intact_reply_fee') }}</span>
                                </div>
                                <div class="w-60 col-12-sp p0">
                                    <div class="wp100 m20r">
                                        <input name="intact_reply_fee" type="text" value="{{ $annualPer['intact_reply_fee'] }}"
                                               class="form-control m0 p13 p8l p8r h-auto fs14 text-right convert-data sum-fee"/>
                                        <p class="error-message m0" data-error="intact_reply_fee"></p>
                                    </div>
                                </div>
                            </div>

                            <div class="row m-0 m15t p0">
                                <div class="w-40 col-12-sp p0 d-flex align-items-center">
                                    <span class="number-li">14</span>
                                    <span class="d-inline-block w-70">{{ trans('attributes.register_info.item_block.label.asset_management_fee') }}</span>
                                </div>
                                <div class="w-60 col-12-sp p0">
                                    <div class="wp100 m20r">
                                        <input name="asset_management_fee" type="text" value="{{ $annualPer['asset_management_fee'] }}"
                                               class="form-control m0 p13 p8l p8r h-auto fs14 text-right convert-data sum-fee"/>
                                        <p class="error-message m0" data-error="asset_management_fee"></p>
                                    </div>
                                </div>
                            </div>

                            <div class="row m-0 m15t p0">
                                <div class="w-40 col-12-sp p0 d-flex align-items-center">
                                    <span class="number-li">15</span>
                                    <span class="d-inline-block w-70">{{ trans('attributes.register_info.item_block.label.tenant_recruitment_fee') }}</span>
                                </div>
                                <div class="w-60 col-12-sp p0">
                                    <div class="wp100 m20r">
                                        <input name="tenant_recruitment_fee" type="text" value="{{ $annualPer['tenant_recruitment_fee'] }}"
                                               class="form-control m0 p13 p8l p8r h-auto fs14 text-right convert-data sum-fee"/>
                                        <p class="error-message m0" data-error="tenant_recruitment_fee"></p>
                                    </div>
                                </div>
                            </div>

                            <div class="row m-0 m15t p0">
                                <div class="w-40 col-12-sp p0 d-flex align-items-center">
                                    <span class="number-li">16</span>
                                    <span class="d-inline-block w-70">{{ trans('attributes.register_info.item_block.label.taxes_dues') }}</span>
                                </div>
                                <div class="w-60 col-12-sp p0">
                                    <div class="wp100 m20r">
                                        <input name="taxes_dues" type="text" value="{{ $annualPer['taxes_dues'] }}"
                                               class="form-control m0 p13 p8l p8r h-auto fs14 text-right convert-data sum-fee"/>
                                        <p class="error-message m0" data-error="taxes_dues"></p>
                                    </div>
                                </div>
                            </div>

                            <div class="row m-0 m15t p0">
                                <div class="w-40 col-12-sp p0 d-flex align-items-center">
                                    <span class="number-li">17</span>
                                    <span class="d-inline-block w-70">{{ trans('attributes.register_info.item_block.label.insurance_premium') }}</span>
                                </div>
                                <div class="w-60 col-12-sp p0">
                                    <div class="wp100 m20r">
                                        <input name="insurance_premium" type="text" value="{{ $annualPer['insurance_premium'] }}"
                                               class="form-control m0 p13 p8l p8r h-auto fs14 text-right convert-data sum-fee"/>
                                        <p class="error-message m0" data-error="insurance_premium"></p>
                                    </div>
                                </div>
                            </div>

                            <div class="row m-0 m15t p0">
                                <div class="w-40 col-12-sp p0 d-flex align-items-center">
                                    <span class="number-li">18</span>
                                    <span class="d-inline-block w-70">{{ trans('attributes.simulation.content.operating_fee.land_tax') }}</span>
                                </div>
                                <div class="w-60 col-12-sp p0">
                                    <div class="wp100 m20r">
                                        <input name="land_tax" type="text" value="{{ $annualPer['land_tax'] }}"
                                               class="form-control m0 p13 p8l p8r h-auto fs14 text-right convert-data sum-fee"/>
                                        <p class="error-message m0" data-error="land_tax"></p>
                                    </div>
                                </div>
                            </div>

                            <div class="row m-0 m15t p0">
                                <div class="w-40 col-12-sp p0 d-flex align-items-center">
                                    <span class="number-li">19</span>
                                    <span class="d-inline-block w-70">{{ trans('attributes.balance.body.other_expenses') }}</span>
                                </div>
                                <div class="w-60 col-12-sp p0">
                                    <div class="wp100 m20r">
                                        <input name="other_fee" type="text" value="{{ $annualPer['other_fee'] }}"
                                               class="form-control m0 p13 p8l p8r h-auto fs14 text-right convert-data sum-fee"/>
                                        <p class="error-message m0" data-error="other_fee"></p>

                                    </div>
                                </div>
                            </div>

                            <div class="row m-0 m15t p0">
                                <div class="w-40 col-12-sp p0 d-flex align-items-center">
                                    <span class="number-li">20</span>
                                    <span class="d-inline-block w-70">{{ trans('attributes.simulation.content.operating_fee.sum') }}</span>
                                </div>
                                <div class="w-60 col-12-sp p0">
                                    <div class="wp100 m20r">
                                        <input name="sum_fee" type="text" value="{{ $annualPer['sum_fee'] }}"
                                               class="disable-field form-control p6 p10l p10r h-auto fs14 convert-data text-right"
                                               readonly>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex m25t m0l">
                                <div class="col-11 p0l">
                                    <p class="fs16 fw-bold m0">{{ trans('attributes.simulation.content.operating_total') }}</p>
                                </div>
                                <div class="col-1 m3l p0 d-flex align-items-end justify-content-end ">
                                    <p class="fs12 fw-normal m0">({{ trans('attributes.common.yen') }})</p>
                                </div>
                            </div>

                            <div class="row m-0 m15t p0">
                                <div class="w-40 col-12-sp p0 d-flex align-items-center">
                                    <span class="number-li">21</span>
                                    <span class="d-inline-block w-70">{{ trans('attributes.simulation.content.operating_fee.sum') }}</span>
                                </div>
                                <div class="w-60 col-12-sp p0">
                                    <div class="wp100 m20r">
                                        <input name="sum_difference" type="text" value="{{ $annualPer['sum_difference'] }}"
                                               class="disable-field form-control p6 p10l p10r h-auto fs14 convert-data text-right"
                                               readonly>
                                    </div>
                                </div>
                            </div>

                            <div class="row m-0 m30t p0">
                                <div class="w-40 col-12-sp p0 d-flex align-items-center">
                                    <span class="d-inline-block">{{ trans('attributes.property.area_for_rent') }}</span>
                                </div>
                                <div class="w-60 col-12-sp p0">
                                    <div class="wp100 m20r">
                                        <input name="area_rental_operating" id="area-rental-operating" type="text" class="form-control p6 p10l p10r h-auto fs14 convert-number-double-decimal text-right" value="{{ number_format($annualPer['area_rental_operating'], FLAG_TWO) }}">
                                    </div>
                                </div>
                            </div>

                            <div class="row m-0 m15t p0">
                                <div class="w-40 col-12-sp p0 d-flex align-items-center">
                                    <span class="d-inline-block">{{ trans('attributes.register_info.item_block.label.crop_yield_1') }}</span>
                                </div>
                                <div class="w-60 col-12-sp p0 row align-items-center">
                                    <div class="col-11">
                                        <input name="crop_yield" id="crop-yield" type="text" value="{{ number_format($annualPer['crop_yield'], FLAG_TWO) }}"
                                               class="disable-field form-control p6 p10l p10r h-auto fs14 convert-number-double-decimal text-right" disabled>
                                        <p class="error-message m0" data-error="crop_yield"></p>
                                    </div>
                                    <div class="col-1">
                                        {{ trans('attributes.common.percent') }}
                                    </div>
                                </div>
                            </div>

                            <div class="row m-0 m15t p0">
                                <div class="w-40 col-12-sp p0 d-flex align-items-center">
                                    <span class="d-inline-block">{{ trans('attributes.property.annual_payment_principal_interes') }}</span>
                                </div>
                                <div class="w-60 col-12-sp p0">
                                    <div class="wp100 m20r">
                                        <input name="amount_paid_annually" type="text"
                                               value="{{ $property['amount_paid_annually'] }}"
                                               class="disable-field form-control p6 p10l p10r h-auto fs14 convert-data text-right"
                                               disabled>
                                    </div>
                                </div>
                            </div>

                            <div class="row m-0 m15t p0">
                                <div class="w-40 col-12-sp p0 d-flex align-items-center">
                                    <span class="d-inline-block">{{ trans('attributes.register_info.item_block.label.dscr') }}</span>
                                </div>
                                <div class="w-60 col-12-sp p0">
                                    <div class="wp100 m20r">
                                        <input name="dscr" type="text" value="{{ number_format($annualPer['dscr'], FLAG_TWO) }}"
                                               class="disable-field form-control p6 p10l p10r h-auto fs14 convert-number-double-decimal d-none text-right"
                                               readonly>
                                        <input name="dscr_output" type="text" value="{{ number_format($annualPer['dscr'], FLAG_TWO) . ' ' . trans('attributes.common.percent') }}"
                                               class="disable-field form-control p6 p10l p10r h-auto fs14 text-right"
                                               readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="old_data" value="{{json_encode($annualPer)}}">
            </form>
            <div class="d-flex col-12 text-center text-lg-right m0 p0">
                <div class="w-auto text-center text-md-right m20r m p0">
                    <a id="back-annul-performance" href="{{ buttonBackPages(request()->all(), $property["id"]) }}"
                            class="btn custom-btn-default fs15 sort-property m0 p18l p18r w-auto">{{ trans('attributes.button.btn_cancel') }}
                    </a>
                </div>
                <div class="w-auto text-center text-md-right m0 p0">
                    <button id="submit-annul-performance" type="button"
                            class="btn custom-btn-primary fs15 sort-property m0 p18l p18r w-auto">{{ trans('attributes.rent_roll.btn_update') }}
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="{{ asset('dist/js/annual-performance.min.js') }}"></script>
@endsection
