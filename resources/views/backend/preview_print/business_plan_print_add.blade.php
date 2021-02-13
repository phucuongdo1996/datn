@extends('modal.preview.common_preview')
@section('title', trans('attributes.property.business_plan') )
@section('content_preview')
<div id="pre-print-business-plan" class="background-print" style="display: block;">
    <div id="block-page" class="container">
        <div class="content-preview">
            <div class="page-preview-print m0t">
                <div class="row m-0">
                    <div class="col-3 p0 p10r">
                        <div class="row m-0">
                            <table class="table table-bordered table-preview table-preview-analysis tb-pre-1 m-0 m10b">
                                <tbody>
                                <tr>
                                    <td class="text-center fw-normal" colspan="3" id="destination-bank-print"><span class="fw-bold fr">{{ trans('attributes.business_plan.preview.you') }}</span></td>
                                </tr>
                                </tbody>
                            </table>
                            <table class="table table-bordered table-preview table-preview-analysis tb-pre-1 m-0 m10b">
                                <tbody>
                                <tr>
                                    <td class="w60 text-center fw-bold">{{ trans('attributes.business_plan.destination_address') }}</td>
                                    <td id="destination-address-print"></td>
                                </tr>
                                </tbody>
                            </table>
                            <table class="table table-bordered table-preview table-preview-analysis tb-pre-1 m-0 m30b">
                                <tbody>
                                <tr>
                                    <td class="w60 text-center fw-bold">{{ trans('attributes.business_plan.destination_name') }}</td>
                                    <td id="destination-name-print"></td>
                                </tr>
                                </tbody>
                            </table>

                            <div class="sub-title-review-simulation m15b">
                                <span class="fs16 fw-bold m15l">{{ trans('attributes.simulation.preview.title_1') }}</span>
                            </div>
                            <table class="table table-bordered table-preview table-preview-analysis tb-pre-1 m-0 m30b">
                                <tbody>
                                <tr>
                                    <td class="text-center td-vertical fw-bold" rowspan="{{ $property['real_estate_type']['id'] == FLAG_TEN ? FLAG_TWELVE : FLAG_ELEVEN}}">{{ trans('attributes.property.list_basic_house') }}</td>
                                    <td class="text-left td-first-child">{{ trans('attributes.property.house_name') }}</td>
                                    <td class="text-center">{{$property['house_name']}}</td>
                                </tr>
                                <tr>
                                    <td class="text-left td-first-child lh1">{{ trans('attributes.property.address') }}</td>
                                    <td class="text-center">{{ $property['address_city'] . ' ' . $property['address_district'] . ' ' . $property['address_town'] }}</td>
                                </tr>
                                <tr>
                                    <td class="text-left td-first-child">{{ trans('attributes.property.main_purpose') }}</td>
                                    <td class="text-center">{{ $property['real_estate_type']['name'] }}</td>
                                </tr>
                                @if($property['real_estate_type']['id'] == FLAG_TEN)
                                <tr>
                                    <td class="text-left td-first-child">{{ trans('attributes.property.main_application') }}</td>
                                    <td class="text-center">{{ MAIN_APPLICATION[$property['main_application']] ?? "" }}</td>
                                </tr>
                                @endif
                                <tr>
                                    <td class="text-left td-first-child">{{ trans('attributes.property.detailed_description_of_purpose') }}</td>
                                    <td class="text-center">{{ $property['detail_real_estate_type']['name'] ?? "" }}</td>
                                </tr>
                                <tr>
                                    <td class="text-left td-first-child">{{ trans('attributes.property.house_structure') }}</td>
                                    <td class="text-center">{{ materialFormat($property['house_material']['name'], $property['house_roof_type']['name'], true) }}</td>
                                </tr>
                                <tr>
                                    <td class="text-left td-first-child">{{ trans('attributes.property.number_floors') }}</td>
                                    <td class="text-center">{{ materialFormat($property['basement'], $property['storeys'], true)}}</td>
                                </tr>
                                <tr>
                                    <td class="td-first-child">
                                        <div class="row m-0">
                                            <div class="col-9 p0">
                                                <span>{{ trans('attributes.property.ground_area') }}</span></div>
                                            <div class="col-3 p0 col-unit"><span>{{ trans('attributes.common.square_meters') }}</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-right">{{ $property['ground_area'] ? number_format($property['ground_area'], 2) : "0.00" }} {{ trans('attributes.common.square_meters') }}</td>
                                </tr>
                                <tr>
                                    <td class="text-right td-first-child">{{ trans('attributes.common.unit2') }}</td>
                                    <td class="text-right">{{ $property['ground_area'] ? number_format($property['ground_area'] * 0.3025, 2) : "0.00" }} {{ trans('attributes.common.unit2') }}</td>
                                </tr>
                                <tr>
                                    <td class="text-left td-first-child">
                                        <div class="row m-0">
                                            <div class="col-9 p0">
                                                <span>{{ trans('attributes.property.total_area_of_​​floors') }}</span></div>
                                            <div class="col-3 p0 col-unit"><span>{{ trans('attributes.common.square_meters') }}</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-right"><span class="td-ground-area">{{ $property['total_area_floors'] ? number_format($property['total_area_floors'], 2) : "0.00" }}</span> {{ trans('attributes.common.square_meters') }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-right td-first-child">{{ trans('attributes.common.unit2') }}</td>
                                    <td class="text-right"><span class="td-ground-area-unit2">{{ $property['total_area_floors'] ? number_format($property['total_area_floors'] * 0.3025, 2) : "0" }}</span> {{ trans('attributes.common.unit2') }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-left td-first-child">{{ trans('attributes.property.construction_time') }}</td>
                                    <td class="text-center">{{ $property['construction_time'] ? dateTimeFormat($property['construction_time']) : "" }}</td>
                                </tr>

                                <tr>
                                    <td class="text-center td-vertical fw-bold" rowspan="3">{{ trans('attributes.balance.body.rights_mode') }}</td>
                                    <td class="text-left td-first-child"> {{ trans('attributes.balance.body.land_rights') }}</td>
                                    <td class="text-center">{{ $property['land_right']['name'] ?? "" }}</td>
                                </tr>
                                <tr>
                                    <td class="text-left td-first-child">{{ trans('attributes.balance.body.building_rights') }}</td>
                                    <td class="text-center">{{ $property['building_right']['name'] ?? "" }}</td>
                                </tr>
                                <tr>
                                    <td class="text-left td-first-child">{{ trans('attributes.balance.body.total_number_of_tenants') }}</td>
                                    <td class="text-center">{{ number_format($property['total_tenants']) }}</td>
                                </tr>
                                </tbody>
                            </table>

                            <div class="sub-title-review-simulation m15b info-creator">
                                <span class="fs16 fw-bold m15l">{{ trans('attributes.business_plan.plan_1') }}</span>
                            </div>
                            <div class="col-12 p0 info-creator">
                                <dl class="m10b">
                                    <dt class="m5b p5b border-bottom fs12">{{ trans('attributes.business_plan.plan_2') }}</dt>
                                    <dd class="m0 fs10" id="date-of-confirmation-print"></dd>
                                </dl>
                                <dl class="m10b">
                                    <dt class="m5b p5b border-bottom fs12">{{ trans('attributes.business_plan.plan_4') }}</dt>
                                    <dd class="m0 fs10" id="note-confirmation-procedure-print">
                                    </dd>
                                </dl>
                                <dl class="m-0">
                                    <dt class="m5b p5b border-bottom fs12">{{ trans('attributes.business_plan.plan_7') }}</dt>
                                    <dd class="m0 fs10">
                                        {{ trans('attributes.business_plan.plan_8') }}<br />
                                        {{ trans('attributes.business_plan.plan_9') }}<br />
                                        {{ trans('attributes.business_plan.plan_10') }}
                                    </dd>
                                </dl>
                            </div>
                        </div>
                    </div>

                    <div class="col-3 p0 p10r">
                        <div class="row m-0">
                            <table class="table table-bordered table-preview table-preview-analysis tb-pre-1 m-0 m10b">
                                <tbody>
                                <tr>
                                    <td class="text-center fw-bold w75">{{ trans('attributes.business_plan.input_date') }}</td>
                                    <td class="preview-input-date text-center"></td>
                                </tr>
                                </tbody>
                            </table>

                            <table class="table table-bordered table-preview table-preview-analysis tb-pre-1 m-0 m10b table-appraiser-name">
                                <tbody>
                                <tr>
                                    <td class="text-center fw-bold w75">{{ trans('attributes.business_plan.real_estate_appraiser_name') }}</td>
                                    <td>
                                        <span class="estate-appraiser-name text-left fl"></span>
                                        <span class="m10r fr">{{ trans('attributes.business_plan.stamp') }}</span>
                                    </td>
                                </tr>
                                </tbody>
                            </table>

                            <div class="col-12 m30b ">
                                <dl class="m0 previewed-correctly">
                                    <dt class="m5b fs12">{{ trans('attributes.business_plan.preview.plan_1') }} </dt>
                                    <dd class="m0 fs10">{{ trans('attributes.business_plan.preview.plan_2') }}</dd>
                                </dl>
                            </div>

                            <table class="table table-bordered table-preview table-preview-analysis tb-pre-2 m-0 m30b">
                                <tbody>
                                <tr>
                                    <td class="text-center td-vertical fw-bold lh1" rowspan="5">{{ trans('attributes.property.items_related_to_benefits') }}</td>
                                    <td class="text-left td-first-child">{{ trans('attributes.balance.body.leasable_area') }}</td>
                                    <td class="text-right">{{ $property['area_may_rent'] ? number_format($property['area_may_rent'], 2) : "0.00" }} {{ trans('attributes.common.square_meters') }}</td>
                                </tr>
                                <tr>
                                    <td class="text-left td-first-child lh1">{{ trans('attributes.business_plan.rentable_floor_area_ratio_1') }}<br />{{ trans('attributes.business_plan.rentable_floor_area_ratio_2') }}</td>
                                    <td class="text-center">{{ division((float)$property['area_may_rent'] ?? 0 , (float)$property['total_area_floors'] ?? 0) }} {{ trans('attributes.common.percent') }}</td>
                                </tr>
                                <tr>
                                    <td class="text-left td-first-child">{{ trans('attributes.balance.body.rental_operating_area') }}</td>
                                    <td class="text-right">{{ $property['area_rental_operating'] ? number_format($property['area_rental_operating'], 2) : "0.00" }} {{ trans('attributes.common.square_meters') }}</td>
                                </tr>
                                <tr>
                                    <td class="text-left td-first-child">{{ trans('attributes.balance.body.crop_yield') }}</td>
                                    <td class="text-center">{{ numberFormatWithUnit($property['rental_percentage'], " " . trans('attributes.common.percent'), FLAG_TWO) }}</td>
                                </tr>
                                <tr>
                                    <td class="text-left td-first-child">{{ trans('attributes.balance.body.security_deposit') }}</td>
                                    <td class="text-right">{{ $property['deposits'] ? number_format($property['deposits']) : "0" }} {{ trans('attributes.common.yen') }}</td>
                                </tr>
                                <tr>
                                    <td class="text-center td-vertical fw-bold" rowspan="11">{{ trans('attributes.balance.body.leasehold') }}</td>
                                    <td class="text-left td-first-child">{{ trans('attributes.balance.body.leasehold_type') }}</td>
                                    <td class="text-center">{{ $property['type_rental']['name'] ?? "" }}</td>
                                </tr>
                                <tr>
                                    <td class="text-left td-first-child">{{ trans('attributes.balance.body.leased_land_area') }}</td>
                                    <td class="text-right">{{ $property['area_rent'] ? number_format($property['area_rent'], 2) : "0.00" }} {{ trans('attributes.common.square_meters') }}</td>
                                </tr>
                                <tr>
                                    <td class="text-left td-first-child">{{ trans('attributes.balance.body.lease_period_own') }}</td>
                                    <td class="text-center">{{ $property['rental_period_from'] ? dateTimeFormat($property['rental_period_from']) : "" }}</td>
                                </tr>
                                <tr>
                                    <td class="text-left td-first-child">{{ trans('attributes.balance.body.lease_period_to') }}</td>
                                    <td class="text-center">{{ $property['rental_period_to'] ? dateTimeFormat($property['rental_period_to']) : "" }}</td>
                                </tr>
                                <tr>
                                    <td class="text-left td-first-child lh1">{{ trans('attributes.balance.body.current_rent_agreement_date') }}
                                        <br>
                                        <span class="fs11">{{ trans('attributes.balance.body.latest_rent_update_date') }}</span></td>
                                    <td class="text-center">{{ $property['date_lease'] ? dateTimeFormat($property['date_lease']) : "" }}</td>
                                </tr>
                                <tr>
                                    <td class="text-left td-first-child">{{ trans('attributes.balance.body.deposit_guarantor') }}</td>
                                    <td class="text-center">{{ $property['deposit_host'] == "" ? trans('attributes.common.no_stipulation') : $property['deposit_host'] }}</td>
                                </tr>
                                <tr>
                                    <td class="text-left td-first-child">{{ trans('attributes.balance.body.royalties') }}</td>
                                    <td class="text-center">{{ $property['prize_money'] == "" ? trans('attributes.common.no_stipulation') : $property['prize_money'] }}</td>
                                </tr>
                                <tr>
                                    <td class="text-left td-first-child">{{ trans('attributes.balance.body.nominal_book_change') }}</td>
                                    <td class="text-center">{{ $property['room_cede_fee'] == "" ? trans('attributes.common.no_stipulation') : $property['room_cede_fee'] }}</td>
                                </tr>
                                <tr>
                                    <td class="text-left td-first-child">{{ trans('attributes.balance.body.reconstruction_permission_fee') }}</td>
                                    <td class="text-center">{{ $property['fee_rebuild_rented_house'] == "" ? trans('attributes.common.no_stipulation') : $property['fee_rebuild_rented_house'] }}</td>
                                </tr>
                                <tr>
                                    <td class="text-left td-first-child">{{ trans('attributes.balance.body.update') }}</td>
                                    <td class="text-center">{{ $property['contract_update_fee'] == "" ? trans('attributes.common.no_stipulation') : $property['contract_update_fee'] }}</td>
                                </tr>
                                </tbody>
                            </table>

                            <div class="col-12 p0 info-creator">
                                <dl class="m10b">
                                    <dt class="m5b p5b border-bottom fs12">{{ trans('attributes.business_plan.plan_11') }}</dt>
                                    <dd class="m0 fs10">
                                        {{ trans('attributes.business_plan.plan_12') }}<br />
                                        {{ trans('attributes.business_plan.plan_13') }}<br />
                                        {{ trans('attributes.business_plan.plan_14') }}<br />
                                        {{ trans('attributes.business_plan.plan_15') }}<br />
                                        {{ trans('attributes.business_plan.plan_16') }}<br />
                                        {{ trans('attributes.business_plan.plan_17') }}
                                    </dd>
                                </dl>
                                <dl class="m-0">
                                    <dt class="m5b p5b border-bottom fs12">{{ trans('attributes.business_plan.plan_18') }}</dt>
                                    <dd class="m0 fs10" id="addendum-print">
                                    </dd>
                                </dl>
                            </div>
                            <div class="col-12 p0 blank-div"></div>
                        </div>
                    </div>

                    <div class="col-3 p0 p10l">
                        <div class="row m-0">
                            <table class="table table-bordered table-preview table-preview-analysis tb-pre-1 m-0 m10b">
                                <tbody>
                                <tr>
                                    <td class="w150 text-center fw-bold">{{ trans('attributes.balance.header.title_button_1') }}</td>
                                    <td class="text-center">
                                        {{ $property['date_year_registration_revenue'] ? $property['date_year_registration_revenue'] . trans('attributes.common.year') : "" }}{{ MONTH[$property['date_month_registration_revenue']]  ?? "" }}
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            @if(!$hideAnnualPerformance)
                            <table class="table table-bordered table-preview-2 tb-pre-3 m-0 m10b">
                                <tbody>
                                <tr>
                                    <td class="text-center fw-bold" colspan="3">{{ trans('attributes.simulation.preview.subjects') }}</td>
                                    <td class="text-center fw-bold">
                                        <div class="row m-0">
                                            <div class="col-9 p0">
                                                <span>{{ trans('attributes.simulation.preview.moneys') }}</span></div>
                                            <div class="col-3 p0"><span>({{ trans('attributes.common.yen') }})</span></div>
                                        </div>
                                    </td>
                                </tr>

                                @if($property['real_estate_type_id'] === FLAG_NINE || $property['real_estate_type_id'] === FLAG_TEN)
                                    <tr>
                                        <td class="text-center td-vertical fw-bold" rowspan="10">{{ trans('attributes.balance.preview.table_3.table_head') }}</td>
                                        <td class="text-left td-first-child lh1 label-long-text">{{ __('attributes.register_info.item_block.label.rent_income') }}<br>{{ __('attributes.register_info.item_block.label.rent_income_1') }}</td>
                                        <td class="text-center number-radius">
                                            <div class="number-border-radius">0</div>
                                        </td>
                                        <td class="text-right td-revenue-room-rentals">{{ $annualPerformance['revenue_land_taxes'] ? number_format($annualPerformance['revenue_land_taxes']) : "0" }}</td>
                                    </tr>
                                @endif

                                <tr>
                                    @if($property['real_estate_type_id'] !== FLAG_NINE && $property['real_estate_type_id'] !== FLAG_TEN)
                                    <td class="text-center td-vertical fw-bold" rowspan="9">{{ trans('attributes.property.operating_revenue') }}</td>
                                    @endif
                                    <td class="text-left td-first-child">{{ trans('attributes.balance.body.rent_income') }}</td>
                                    <td class="text-center number-radius">
                                        <div class="number-border-radius">1</div>
                                    </td>
                                    <td class="text-right td-revenue-room-rentals">{{ $annualPerformance['rent_income'] ? number_format($annualPerformance['rent_income']) : "0" }}</td>
                                </tr>
                                <tr>
                                    <td class="text-left td-first-child">{{ trans('attributes.register_info.item_block.label.service_revenue') }}</td>
                                    <td class="text-center number-radius">
                                        <div class="number-border-radius">2</div>
                                    </td>
                                    <td class="text-right td-revenue-service-charges">{{ $annualPerformance['general_services'] ? number_format($annualPerformance['general_services']) : "0" }}</td>
                                </tr>
                                <tr>
                                    <td class="text-left td-first-child">{{ trans('attributes.register_info.item_block.label.utilities_revenue') }}</td>
                                    <td class="text-center number-radius">
                                        <div class="number-border-radius fs11">3</div>
                                    </td>
                                    <td class="text-right td-revenue-utilities">{{ $annualPerformance['utilities_revenue'] ? number_format($annualPerformance['utilities_revenue']) : "0" }}</td>
                                </tr>
                                <tr>
                                    <td class="text-left td-first-child">{{ trans('attributes.register_info.item_block.label.parking_lot_revenue') }}</td>
                                    <td class="text-center number-radius">
                                        <div class="number-border-radius">4</div>
                                    </td>
                                    <td class="text-right"><span class="td-revenue-car-deposits">{{ $annualPerformance['parking_revenue'] ? number_format($annualPerformance['parking_revenue']) : "0" }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-left td-first-child">{{ trans('attributes.register_info.item_block.label.key_money_royalties') }}</td>
                                    <td class="text-center number-radius">
                                        <div class="number-border-radius fs11">5</div>
                                    </td>
                                    <td class="text-right td-turnover-revenue">{{ $annualPerformance['income_input_money'] ? number_format($annualPerformance['income_input_money']) : "0" }}</td>
                                </tr>
                                <tr>
                                    <td class="text-left td-first-child">{{ trans('attributes.register_info.item_block.label.renewal_fee') }}</td>
                                    <td class="text-center number-radius">
                                        <div class="number-border-radius">6</div>
                                    </td>
                                    <td class="text-right td-revenue-contract-update-fee">{{ $annualPerformance['income_update_house_contract'] ? number_format($annualPerformance['income_update_house_contract']) : "0" }}</td>
                                </tr>
                                <tr>
                                    <td class="text-left td-first-child">{{ trans('attributes.register_info.item_block.label.other_income') }}</td>
                                    <td class="text-center number-radius">
                                        <div class="number-border-radius">7</div>
                                    </td>
                                    <td class="text-right td-revenue-other">{{ $annualPerformance['other_income'] ? number_format($annualPerformance['other_income']) : "0" }}</td>
                                </tr>
                                <tr>
                                    <td class="text-left td-first-child">{{ trans('attributes.register_info.item_block.label.etc') }}</td>
                                    <td class="text-center number-radius">
                                        <div class="number-border-radius">8</div>
                                    </td>
                                    <td class="text-right td-bad-debt">{{ $annualPerformance['bad_debt_losses'] ? number_format($annualPerformance['bad_debt_losses']) : "0" }}</td>
                                </tr>
                                <tr>
                                    <td class="text-left td-first-child">{{ trans('attributes.register_info.item_block.label.meter') }}</td>
                                    <td class="text-center number-radius">
                                        <div class="number-border-radius">9</div>
                                    </td>
                                    <td class="text-right td-total-revenue">{{ $annualPerformance['sum_income'] ? number_format($annualPerformance['sum_income']) : "0" }}</td>
                                </tr>
                                <tr>
                                    <td class="text-center td-vertical fw-bold" rowspan="11">{{ trans('attributes.property.operating_fee') }}</td>
                                    <td class="text-left td-first-child">{{ trans('attributes.register_info.item_block.label.management_fee') }}</td>
                                    <td class="text-center number-radius">
                                        <div class="number-border-radius">10</div>
                                    </td>
                                    <td class="text-right td-maintenance-management-fee">{{ $annualPerformance['management_fee'] ? number_format($annualPerformance['management_fee']) : "0" }}</td>
                                </tr>
                                <tr>
                                    <td class="text-left td-first-child">{{ trans('attributes.register_info.item_block.label.utilities_expenses') }}</td>
                                    <td class="text-center number-radius">
                                        <div class="number-border-radius">11</div>
                                    </td>
                                    <td class="text-right td-electricity-gas-charges">{{ $annualPerformance['utilities_fee'] ? number_format($annualPerformance['utilities_fee']) : "0" }}</td>
                                </tr>
                                <tr>
                                    <td class="text-left td-first-child">{{ trans('attributes.register_info.item_block.label.repair_fee') }}</td>
                                    <td class="text-center number-radius">
                                        <div class="number-border-radius">12</div>
                                    </td>
                                    <td class="text-right td-repair-fee">{{ $annualPerformance['repair_fee'] ? number_format($annualPerformance['repair_fee']) : "0" }}</td>
                                </tr>
                                <tr>
                                    <td class="text-left td-first-child">{{ trans('attributes.register_info.item_block.label.intact_reply_fee') }}</td>
                                    <td class="text-center number-radius">
                                        <div class="number-border-radius">13</div>
                                    </td>
                                    <td class="text-right td-recovery-costs">{{ $annualPerformance['intact_reply_fee'] ? number_format($annualPerformance['intact_reply_fee']) : "0" }}</td>
                                </tr>
                                <tr>
                                    <td class="text-left td-first-child lh1">{{ trans('attributes.register_info.item_block.label.property_management_fee') }}
                                        <br>
                                        {{ trans('attributes.register_info.item_block.label.property_management_fee_1') }}
                                    </td>
                                    <td class="text-center number-radius">
                                        <div class="number-border-radius">14</div>
                                    </td>
                                    <td class="text-right td-property-management_fee">{{ $annualPerformance['asset_management_fee'] ? number_format($annualPerformance['asset_management_fee']) : "0" }}</td>
                                </tr>
                                <tr>
                                    <td class="text-left td-first-child">{{ trans('attributes.register_info.item_block.label.tenant_recruitment_fee') }}</td>
                                    <td class="text-center number-radius">
                                        <div class="number-border-radius">15</div>
                                    </td>
                                    <td class="text-right td-find-tenant-fee">{{ $annualPerformance['tenant_recruitment_fee'] ? number_format($annualPerformance['tenant_recruitment_fee']) : "0" }}</td>
                                </tr>
                                <tr>
                                    <td class="text-left td-first-child">{{ trans('attributes.register_info.item_block.label.taxes_dues') }}</td>
                                    <td class="text-center number-radius">
                                        <div class="number-border-radius">16</div>
                                    </td>
                                    <td class="text-right td-tax">{{ $annualPerformance['taxes_dues'] ? number_format($annualPerformance['taxes_dues']) : "0" }}</td>
                                </tr>
                                <tr>
                                    <td class="text-left td-first-child">{{ trans('attributes.register_info.item_block.label.insurance_premium') }}</td>
                                    <td class="text-center number-radius">
                                        <div class="number-border-radius">17</div>
                                    </td>
                                    <td class="text-right td-loss-insurance">{{ $annualPerformance['insurance_premium'] ? number_format($annualPerformance['insurance_premium']) : "0" }}</td>
                                </tr>
                                <tr>
                                    <td class="text-left td-first-child">{{ trans('attributes.balance.body.rent') }}</td>
                                    <td class="text-center number-radius">
                                        <div class="number-border-radius">18</div>
                                    </td>
                                    <td class="text-right td-land-rental-fee">{{ $annualPerformance['land_tax'] ? number_format($annualPerformance['land_tax']) : "0" }}</td>
                                </tr>
                                <tr>
                                    <td class="text-left td-first-child">{{ trans('attributes.balance.body.other_expenses') }}</td>
                                    <td class="text-center number-radius">
                                        <div class="number-border-radius">19</div>
                                    </td>
                                    <td class="text-right td-other-costs">{{ $annualPerformance['other_fee'] ? number_format($annualPerformance['other_fee']) : "0" }}</td>
                                </tr>
                                <tr>
                                    <td class="text-left td-first-child">{{ trans('attributes.balance.body.meter') }}</td>
                                    <td class="text-center number-radius">
                                        <div class="number-border-radius">20</div>
                                    </td>
                                    <td class="text-right td-total-cost">{{ $annualPerformance['sum_fee'] ? number_format($annualPerformance['sum_fee']) : "0" }}</td>
                                </tr>
                                <tr class="last-row">
                                    <td class="text-left fw-bold p6 text-center" colspan="2">{{ trans('attributes.business_plan.preview.plan_8') }}(&#9320;-&#9331;)</td>
                                    <td class="text-center number-radius">
                                        <div class="number-border-radius">21</div>
                                    </td>
                                    <td class="text-right p6 td-operating-expenses">{{ $annualPerformance['sum_difference'] ? number_format($annualPerformance['sum_difference']) . ' ' : "0 " }}</td>
                                </tr>
                                </tbody>
                            </table>
                            @endif
                            <table class="table table-bordered table-preview table-preview-analysis tb-pre-1 m-0 m10b">
                                <tbody>
                                <tr>
                                    <td class="p6 w150 fw-bold text-center">{{ trans('attributes.business_plan.expected_borrowing_date') }}</td>
                                    <td class="p6 text-center" id="expected-borrowing-date-print"></td>
                                </tr>
                                <tr>
                                    <td class="p6 w150 fw-bold text-center">{{ trans('attributes.business_plan.expected_borrowing_amount') }}</td>
                                    <td class="p6 text-right" id="expected-borrowing-amount-print"></td>
                                </tr>
                                </tbody>
                            </table>

                            <table class="table table-bordered table-preview table-preview-analysis tb-pre-1 m-0 m26b">
                                <tbody>
                                <tr>
                                    <td class="p6 w150 fw-bold text-center">{{ trans('attributes.property.annual_payment_principal_interes') }}</td>
                                    <td class="p6 text-right" id="annual-repayment-of-principal-and-interest-print"></td>
                                </tr>
                                </tbody>
                            </table>

                            <table class="table table-bordered table-preview table-preview-analysis tb-pre-1 m-0">
                                <tbody>
                                <tr>
                                    <td class="p6 w150 fw-bold text-center">{{ trans('attributes.balance.body.noi_yield') }}</td>
                                    <td class="p6 text-right" id="noi-interest-print"></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="col-3 p0 p10l">
                        <div class="row m-0">
                            <table class="table table-bordered table-preview table-preview-analysis tb-pre-1 m-0 m10b">
                                <tbody>
                                <tr>
                                    <td class="w150 text-center fw-bold td-first-child">{{ trans('attributes.property.status') }}</td>
                                    <td class="text-center">{{ STATUS_HOUSE[$property['status']] }}</td>
                                </tr>
                                </tbody>
                            </table>

                            @if(!$hideAnnualPerformance)
                            <table class="table table-bordered table-preview table-preview-analysis table-preview-analysis tb-pre-4 m-0 m10b">
                                <tbody>
                                <tr>
                                    <td class="text-center fw-bold">{{ trans('attributes.balance.preview.table_3.table_head') }}</td>
                                </tr>
                                @if($property['real_estate_type_id'] === FLAG_NINE || $property['real_estate_type_id'] === FLAG_TEN)
                                    <tr>
                                        <td class="text-center p7t p7b h37" colspan="2">
                                            <div class="row">
                                                <div class="col-5 text-left text-center-vertical">{{ trans('attributes.balance.preview.table_3.title_0') }}</div>
                                                <div class="col-4 p0">
                                                    <input class="like-input op-building-floor-area-1" type="text" disabled=""
                                                           value="{{ numberFormatWithUnit(basisCalculationBusinessPlan($annualPerformance['revenue_land_taxes'], number_format($property['ground_area'] * 0.3025, FLAG_TWO), FLAG_MAX_MONTH), ' ' . trans('attributes.common.unit-3')) }}">
                                                </div>
                                                <div class="col-3 text-center-vertical">{{ trans('attributes.balance.preview.table_3.unit') }}</div>
                                            </div>
                                        </td>
                                    </tr>
                                @endif
                                <tr>
                                    <td class="text-center">
                                        <div class="row">
                                            <div class="col-5 text-left text-center-vertical">{{ trans('attributes.balance.preview.table_3.title_1') }}</div>
                                            <div class="col-4 p0">
                                                <input class="like-input op-building-floor-area-1 p10l p10r w-100" type="text" disabled=""
                                                       value="{{ numberFormatWithUnit(basisCalculationBusinessPlan($annualPerformance['rent_income'],
                                                           number_format($property['total_area_floors'] * 0.3025, FLAG_TWO), FLAG_MAX_MONTH), ' ' . trans('attributes.common.unit-3')) }}">
                                            </div>
                                            <div class="col-3 text-center-vertical">{{ trans('attributes.balance.preview.table_3.unit') }}</div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center">
                                        <div class="row">
                                            <div class="col-5 text-left text-center-vertical">{{ trans('attributes.balance.preview.table_3.title_1') }}</div>
                                            <div class="col-4 p0">
                                                <input class="like-input op-building-floor-area-2 p10l p10r w-100" type="text" disabled=""
                                                       value="{{ numberFormatWithUnit(basisCalculationBusinessPlan($annualPerformance['general_services'],
                                                           number_format($property['total_area_floors'] * 0.3025, FLAG_TWO), FLAG_MAX_MONTH), ' ' . trans('attributes.common.unit-3')) }}">
                                            </div>
                                            <div class="col-3 text-center-vertical">{{ trans('attributes.balance.preview.table_3.unit') }}</div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center">
                                        <div class="row">
                                            <div class="col-5 text-left text-center-vertical">{{ trans('attributes.balance.preview.table_3.title_1') }}</div>
                                            <div class="col-4 p0">
                                                <input class="like-input op-building-floor-area-3 p10l p10r w-100" type="text" disabled=""
                                                       value="{{ numberFormatWithUnit(basisCalculationBusinessPlan($annualPerformance['utilities_revenue'],
                                                           number_format($property['total_area_floors'] * 0.3025, FLAG_TWO), FLAG_MAX_MONTH), ' ' . trans('attributes.common.unit-3')) }}">
                                            </div>
                                            <div class="col-3 text-center-vertical">{{ trans('attributes.balance.preview.table_3.unit') }}</div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center">
                                        <div class="row">
                                            <div class="col-1 p30r text-left text-center-vertical">≒</div>
                                            <div class="col-4 p0">
                                                <input class="like-input op-revenue-car p10l p10r w-100" type="text" disabled=""
                                                       value="{{ numberFormatWithUnit($annualPerformance['parking_revenue'] / FLAG_MAX_MONTH, ' ' . trans('attributes.common.yen')) }}">
                                            </div>
                                            <div class="col-6 text-left text-center-vertical">{{ trans('attributes.balance.preview.table_3.unit') }}</div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center">
                                        <div class="row">
                                            <div class="col-5 text-left text-center-vertical">{{ trans('attributes.balance.preview.table_3.title_2') }}</div>
                                            <div class="col-4 p0">
                                                <input class="like-input op-turnover-revenue p10l p10r w-100" type="text" disabled=""
                                                       value="{{ CalculationPercentBusinessPlan($annualPerformance['income_input_money'], $annualPerformance['rent_income']) . ' ' . trans('attributes.common.percent') }}">
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center">
                                        <div class="row">
                                            <div class="col-5 text-left text-center-vertical">{{ trans('attributes.balance.preview.table_3.title_2') }}</div>
                                            <div class="col-4 p0">
                                                <input class="like-input op-revenue-contract-update-fee p10l p10r w-100" type="text" disabled=""
                                                       value="{{ CalculationPercentBusinessPlan($annualPerformance['income_update_house_contract'], $annualPerformance['rent_income']) . ' ' . trans('attributes.common.percent') }}">
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center">
                                        <div class="row">
                                            <div class="col-5 text-left text-center-vertical">{{ trans('attributes.balance.preview.table_3.title_3') }}</div>
                                            <div class="col-4 p0">
                                                <input class="like-input op-revenue-other p10l p10r w-100" type="text" disabled=""
                                                       value="{{ CalculationPercentBusinessPlan($annualPerformance['other_income'], sumRentalIncome($property)) . ' ' . trans('attributes.common.percent') }}">
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center">
                                        <div class="row">
                                            <div class="col-5 text-left text-center-vertical">{{ trans('attributes.balance.preview.table_3.title_3') }}</div>
                                            <div class="col-4 p0">
                                                <input class="like-input op-bad-debt p10l p10r w-100" type="text" disabled=""
                                                       value="{{ CalculationPercentBusinessPlan($annualPerformance['bad_debt_losses'], sumRentalIncome($property)) . ' ' . trans('attributes.common.percent') }}">
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center">
                                        <div class="row">
                                            <div class="col-5 text-left text-center-vertical">{{ trans('attributes.balance.preview.table_3.title_1') }}</div>
                                            <div class="col-4 p0">
                                                <input class="like-input op-total-revenue p10l p10r w-100" type="text" disabled=""
                                                       value="{{ numberFormatWithUnit(basisCalculationBusinessPlan($annualPerformance['sum_income'], $property['total_area_floors']), ' ' . trans('attributes.common.unit-4')) }}">
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center">
                                        <div class="row">
                                            <div class="col-5 text-left text-center-vertical">{{ trans('attributes.balance.preview.table_3.title_1') }}</div>
                                            <div class="col-4 p0">
                                                <input class="like-input op-maintenance-fee p10l p10r w-100" type="text" disabled=""
                                                       value="{{ numberFormatWithUnit(basisCalculationBusinessPlan($annualPerformance['management_fee'],
                                                           number_format($property['total_area_floors'], FLAG_TWO), FLAG_MAX_MONTH), ' ' . trans('attributes.common.unit-4')) }}">
                                            </div>
                                            <div class="col-3 text-center-vertical">{{ trans('attributes.balance.preview.table_3.unit') }}</div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center">
                                        <div class="row">
                                            <div class="col-5 text-left text-center-vertical">{{ trans('attributes.balance.preview.table_3.title_1') }}</div>
                                            <div class="col-4 p0">
                                                <input class="like-input op-electricity-gas-charges p10l p10r w-100" type="text" disabled=""
                                                       value="{{ numberFormatWithUnit(basisCalculationBusinessPlan($annualPerformance['utilities_fee'],
                                                           number_format($property['total_area_floors'] * 0.3025, FLAG_TWO), FLAG_MAX_MONTH), ' ' . trans('attributes.common.unit-3')) }}">
                                            </div>
                                            <div class="col-3 text-center-vertical">{{ trans('attributes.balance.preview.table_3.unit') }}</div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center">
                                        <div class="row">
                                            <div class="col-5 text-left text-center-vertical">{{ trans('attributes.balance.preview.table_3.title_1') }}</div>
                                            <div class="col-4 p0">
                                                <input class="like-input op-repair-fee p10l p10r w-100" type="text" disabled=""
                                                       value="{{ numberFormatWithUnit(basisCalculationBusinessPlan($annualPerformance['repair_fee'],
                                                           number_format($property['total_area_floors'], FLAG_TWO)), ' ' . trans('attributes.common.unit-4')) }}">
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center">
                                        <div class="row">
                                            <div class="col-5 text-left text-center-vertical">{{ trans('attributes.balance.preview.table_3.title_1') }}</div>
                                            <div class="col-4 p0">
                                                <input class="like-input op-recovery-costs p10l p10r w-100" type="text" disabled=""
                                                       value="{{ numberFormatWithUnit(basisCalculationBusinessPlan($annualPerformance['intact_reply_fee'],
                                                           number_format($property['total_area_floors'], FLAG_TWO)), ' ' . trans('attributes.common.unit-4')) }}">
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center">
                                        <div class="row" style="height: 28px !important;">
                                            <div class="col-5 text-left text-center-vertical">{{ trans('attributes.balance.preview.table_3.title_3') }}</div>
                                            <div class="col-4 p0 d-flex">
                                                <input class="like-input op-property-management-fee p10l p10r w-100" type="text" disabled=""
                                                       value="{{ CalculationPercentBusinessPlan($annualPerformance['asset_management_fee'], sumRentalIncome($property)) . ' ' . trans('attributes.common.percent') }}">
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center">
                                        <div class="row">
                                            <div class="col-5 text-left text-center-vertical">{{ trans('attributes.balance.preview.table_3.title_3') }}</div>
                                            <div class="col-4 p0">
                                                <input class="like-input op-find-tenant-fee p10l p10r w-100" type="text" disabled=""
                                                       value="{{ CalculationPercentBusinessPlan($annualPerformance['tenant_recruitment_fee'], sumRentalIncome($property)) . ' ' . trans('attributes.common.percent') }}">
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center">
                                        <div class="row">
                                            <div class="col-4 p10l text-left">
                                                <input class="w55 like-input-sm p10l p10r w-100" type="text" disabled=""
                                                       value="{{ $property['date_year_registration_revenue'] ?? "" }}">
                                            </div>
                                            <div class="col-8 text-left p0 text-center-vertical">{{ trans('attributes.balance.preview.table_3.title_4') }}</div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center">
                                        <div class="row">
                                            <div class="col-4 p10l text-left">
                                                <input class="w55 like-input-sm p10l p10r w-100" type="text" disabled=""
                                                       value="{{ $property['date_year_registration_revenue'] ?? "" }}">
                                            </div>
                                            <div class="col-8 text-left p0 text-center-vertical">{{ trans('attributes.balance.preview.table_3.title_4') }}</div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center">
                                        <div class="row">
                                            <div class="col-4 p10l text-left">
                                                <input class="w55 like-input-sm p10l p10r w-100" type="text" disabled=""
                                                       value="{{ $property['date_year_registration_revenue'] ?? "" }}">
                                            </div>
                                            <div class="col-8 text-left p0 text-center-vertical">{{ trans('attributes.balance.preview.table_3.title_4') }}</div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center">
                                        <div class="row">
                                            <div class="col-5 text-left text-center-vertical">{{ trans('attributes.balance.preview.table_3.title_5') }}</div>
                                            <div class="col-4 p0">
                                                <input class="like-input op-tax p10l p10r w-100" type="text" disabled=""
                                                       value="{{ CalculationPercentBusinessPlan($annualPerformance['other_fee'], $annualPerformance['sum_income']) . ' ' . trans('attributes.common.percent') }}">
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center">
                                        <div class="row">
                                            <div class="col-5 text-left text-center-vertical p20l">{{ trans('attributes.property.cost_ratio') }}</div>
                                            <div class="col-4 p0">
                                                <input class="like-input op-total-cost p10l p10r w-100" type="text" disabled=""
                                                       value="{{ number_format(divisionNumber($annualPerformance['sum_fee'], $annualPerformance['sum_income']) * 100, FLAG_TWO) . ' ' . trans('attributes.common.percent') }}">
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center">
                                        <div class="row">
                                            <div class="col-5 text-left text-center-vertical">{{ trans('attributes.balance.preview.table_3.title_1') }}</div>
                                            <div class="col-4 p0">
                                                <input class="like-input op-ground-area p10l p10r w-100" type="text" disabled=""
                                                       value="{{ numberFormatWithUnit(basisCalculationBusinessPlan($annualPerformance['sum_difference'], $property['total_area_floors']), ' ' . trans('attributes.common.unit-4')) }}">
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            @endif

                            <table class="table table-bordered table-preview table-preview-analysis tb-pre-1 m-0 m10b">
                                <tbody>
                                <tr>
                                    <td class="p6 w150 fw-bold text-center">{{ trans('attributes.property.during_initial_borrowing_period') }}</td>
                                    <td class="p6 text-center" id="initial-borrowing-period-print"></td>
                                </tr>
                                <tr>
                                    <td class="p6 w150 fw-bold text-center">{{ trans('attributes.business_plan.expected_interest') }}</td>
                                    <td class="p6 text-right" id="expected-interest-print"></td>
                                </tr>
                                </tbody>
                            </table>

                            <table class="table table-bordered table-preview table-preview-analysis tb-pre-1 m-0 m10b">
                                <tbody>
                                <tr>
                                    <td class="p6 w150 fw-bold text-center">{{ trans('attributes.business_plan.repayment_cover_rate_1') }}<br />{{ trans('attributes.business_plan.repayment_cover_rate_2') }}</td>
                                    <td class="p6 text-right" id="repayment-cover-rate-print"></td>
                                </tr>
                                </tbody>
                            </table>

                            <table class="table table-bordered table-preview table-preview-analysis tb-pre-1 m-0">
                                <tbody>
                                <tr>
                                    <td class="p6 w150 fw-bold text-center" colspan="2">{{ trans('attributes.business_plan.interest_noi') }} </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
