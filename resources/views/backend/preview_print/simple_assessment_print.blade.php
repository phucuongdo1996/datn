@extends('modal.preview.common_preview')
@section('title', trans('attributes.home.menu.simple_form') )
@section('content_preview')
<div id="pre-print-simple-assessment" class="background-print">
    <div id="block-page" class="container p0 m0">
        <div class="content-preview">
            <div class="page-preview-print m0t">
                <div class="modal-header row m-0 centered-vertical border-0 p0 d-none"></div>

                <div class="row m-0 m10b">
                    <div class="col-3 p0 p10r">
                        <table class="table table-bordered table-preview table-preview-analysis tb-pre-1 m-0">
                            <tbody>
                                <tr>
                                    <td class="w135 text-center fw-bold">{{ trans('attributes.balance.header.title_button_1') }}</td>
                                    <td class="text-center">{{ $property['date_year_registration_revenue'] ? $property['date_year_registration_revenue'] . trans('attributes.common.year') : "" }}{{ MONTH[$property['date_month_registration_revenue']]  ?? "" }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="col-3 p0 p10r">
                        <table class="table table-bordered table-preview table-preview-analysis tb-pre-2 m-0">
                            <tbody>
                                <tr>
                                    <td class="w135 text-center fw-bold">{{ trans('attributes.property.status') }}</td>
                                    <td class="text-center">{{ STATUS_HOUSE_SIMPLE[$property['status']] }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="col-6 p0 p10l">
                        <table class="table table-bordered table-preview table-preview-analysis tb-pre-1 m-0">
                            <tbody>
                                <tr>
                                    <td class="w158 text-center fw-bold" rowspan="2">{{ trans('attributes.simple_assessment.assessment_result') }}</td>
                                    <td class="border-bottom-0 border-right-0">
                                        <div class="row m-0">
                                            <div class="fs11 fw-bold">{{ trans('attributes.borrowing.table.noi') }}</div>
                                            <div class="fs11 ml-auto fw-normal">({{ trans('attributes.common.yen') }})</div>
                                        </div>
                                    </td>
                                    <td class="border-bottom-0 border-right-0 border-left-0"></td>
                                    <td class="border-bottom-0 border-right-0 border-left-0 fs11 fw-bold">{{ trans('attributes.simple_assessment.cap_rate') }}</td>
                                    <td class="border-bottom-0 border-right-0 border-left-0"></td>
                                    <td class="border-bottom-0 border-left-0 fs11 fw-bold">
                                        <div class="row m-0">
                                            <div class="fs11 fw-bold">{{ trans('attributes.property.assessed_amount') }}</div>
                                            <div class="fs11 ml-auto fw-normal">({{ trans('attributes.common.yen') }})</div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="border-top-0 border-right-0"><input class="like-input text-right p5r pre-operating-expenses" type="text" disabled=""></td>
                                    <td class="border-top-0 border-right-0 border-left-0">{{ trans('attributes.common.division') }}</td>
                                    <td class="border-top-0 border-right-0 border-left-0">
                                        <div class="row centered-vertical m-0">
                                            <input class="like-input text-right m5r p5r pre-net-profit" type="text" disabled="">
                                            <div class="">{{ trans('attributes.common.percent') }}</div>
                                        </div>
                                    </td>
                                    <td class="border-top-0 border-right-0 border-left-0">{{ trans('attributes.common.equals') }}</td>
                                    <td class="border-top-0 border-left-0"><input class="like-input text-right p5r pre-amount-assessed-taxing" type="text" disabled=""></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="row m-0">
                    <div class="col-3 p0 p10r">
                        <div class="row m-0">
                            <table class="table table-bordered table-preview table-preview-analysis tb-pre-1 m-0">
                                <tbody>
                                    <tr>
                                        <td class="text-center td-vertical fw-bold" rowspan="{{ $property['real_estate_type_id'] == FLAG_TEN ? FLAG_TWELVE : FLAG_ELEVEN }}">{{ trans('attributes.property.list_basic_house') }}</td>
                                        <td class="text-left td-first-child">{{ trans('attributes.simulation.content.physical_info.name') }}</td>
                                        <td class="text-left">{{ $property['house_name'] }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-left td-first-child lh1">{{ trans('attributes.simple_assessment.preview.address') }}</td>
                                        <td class="text-left">
                                            {{ (addressFormat($property['address_city'], $property['address_district'], $property['address_town']) != 'ー') ? addressFormat($property['address_city'], $property['address_district'], $property['address_town']) : '' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-left td-first-child">{{ trans('attributes.balance.body.the_main_purpose') }}</td>
                                        <td class="text-center">{{ $property['real_estate_type']['name'] }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-left td-first-child">{{ trans('attributes.balance.body.use_in_detail') }}</td>
                                        <td class="text-center">{{ $property['detail_real_estate_type']['name'] }}</td>
                                    </tr>
                                    @if($property['real_estate_type_id'] == FLAG_TEN)
                                    <tr>
                                        <td class="text-left td-first-child">{{ trans('attributes.property.main_application') }}</td>
                                        <td class="text-center">{{ $property['real_estate_type_id'] == FLAG_TEN &&  $property['main_application'] ? MAIN_APPLICATION[$property['main_application']] : ""  }}</td>
                                    </tr>
                                    @endif
                                    <tr>
                                        <td class="text-left td-first-child">{{ trans('attributes.balance.body.construction') }}</td>
                                        <td class="text-center">
                                            {{ materialFormat($property['house_material']['name'], $property['house_roof_type']['name'], true) }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-left td-first-child">{{ trans('attributes.balance.body.floor') }}</td>
                                        <td class="text-center">{{ materialFormat($property['basement'], $property['storeys'], true) }}</td>
                                    </tr>
                                    <tr>
                                        <td class="td-first-child">
                                            <div class="row m-0">
                                                <div class="col-9 p0">
                                                    <span>{{ trans('attributes.balance.body.total_land_area') }}</span></div>
                                                <div class="col-3 p0 col-unit"><span>{{ trans('attributes.common.m2') }}</span>
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
                                                    <span>{{ trans('attributes.balance.body.building_floor_area') }}</span></div>
                                                <div class="col-3 p0 col-unit"><span>{{ trans('attributes.common.m2') }}</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-right">{{ $property['total_area_floors'] ? number_format($property['total_area_floors'], 2) : "0.00" }} {{ trans('attributes.common.square_meters') }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-right td-first-child">{{ trans('attributes.common.unit2') }}</td>
                                        <td class="text-right">{{ $property['total_area_floors'] ? number_format($property['total_area_floors'] * 0.3025, 2) : "0" }} {{ trans('attributes.common.unit2') }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-left td-first-child">{{ trans('attributes.balance.body.date_of_completion') }}</td>
                                        <td class="text-center">{{ $property['construction_time'] ? dateTimeFormat($property['construction_time']) : "" }}</td>
                                    </tr>

                                    <tr>
                                        <td class="text-center td-vertical fw-bold" rowspan="3">{{ trans('attributes.balance.body.rights_mode') }}</td>
                                        <td class="text-left td-first-child">{{ trans('attributes.balance.body.land_rights') }}</td>
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
                        </div>
                    </div>

                    <div class="col-3 p0 p10r">
                        <div class="row m-0">
                            <table class="table table-bordered table-preview table-preview-analysis tb-pre-2 m-0">
                                <tbody>
                                    <tr>
                                        <td class="text-center td-vertical fw-bold lh1" rowspan="5">{{ trans('attributes.property.items_related_to_benefits') }}</td>
                                        <td class="text-left td-first-child">{{ trans('attributes.property.area_can_for_rent') }}</td>
                                        <td class="text-right">{{ $property['area_may_rent'] ? number_format($property['area_may_rent'], 2) : "0.00" }} {{ trans('attributes.common.square_meters') }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-left td-first-child lh1">{{ trans('attributes.simple_assessment.rentable_ratio') }}<br />{{ trans('attributes.essential.body.bed_effective_rate') }}</td>
                                        <td class="text-center">{{ division((float)$property['area_may_rent'] ?? 0 , (float)$property['total_area_floors'] ?? 0)  }} {{ trans('attributes.common.percent') }}</td>
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
                                        <td class="text-left td-first-child lh1">{{ trans('attributes.balance.body.current_rent_agreement_date') }}<br />{{ trans('attributes.balance.body.latest_rent_update_date') }}</td>
                                        <td class="text-center">{{ $property['date_lease'] ? dateTimeFormat($property['date_lease']) : "" }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-left td-first-child">{{ trans('attributes.essential.body.security_deposit') }}</td>
                                        <td class="text-center">{{ $property['deposit_host'] == "" ? trans('attributes.common.no_stipulation') : $property['deposit_host'] }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-left td-first-child">{{ trans('attributes.balance.body.royalties') }}</td>
                                        <td class="text-center">{{ $property['prize_money'] == "" ? trans('attributes.common.no_stipulation') : $property['prize_money'] }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-left td-first-child">{{ trans('attributes.essential.body.nominal_book_change') }}</td>
                                        <td class="text-center">{{ $property['room_cede_fee'] == "" ? trans('attributes.common.no_stipulation') : $property['room_cede_fee'] }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-left td-first-child">{{ trans('attributes.essential.body.rebuilding_consent_fee') }}</td>
                                        <td class="text-center">{{ $property['fee_rebuild_rented_house'] == "" ? trans('attributes.common.no_stipulation') : $property['fee_rebuild_rented_house'] }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-left td-first-child">{{ trans('attributes.balance.body.update') }}</td>
                                        <td class="text-center">{{ $property['contract_update_fee'] == "" ? trans('attributes.common.no_stipulation') : $property['contract_update_fee'] }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    @if(!$hideAnnualPerformance)
                    <div class="col-3 p0 p10l">
                        <div class="row m-0">
                            <table class="table table-bordered table-preview-2 tb-pre-3 m-0">
                                <tbody>
                                    <tr>
                                        <td class="text-center fw-bold p6" colspan="3">{{ trans('attributes.simulation.preview.subjects') }}</td>
                                        <td class="text-center fw-bold p6">
                                            <div class="row m-0">
                                                <div class="col-9 p0">
                                                    <span>{{ trans('attributes.simulation.preview.moneys') }}</span></div>
                                                <div class="col-3 p0"><span>({{ trans('attributes.common.yen') }})</span></div>
                                            </div>
                                        </td>
                                    </tr>
                                    @if($property['real_estate_type_id'] === FLAG_NINE || $property['real_estate_type_id'] === FLAG_TEN)
                                    <tr>
                                        <td class="text-center td-vertical fw-bold" rowspan="10">{{ trans('attributes.balance.body.operating_revenue') }}</td>
                                        <td class="text-left td-first-child lh1 label-long-text">{{ __('attributes.register_info.item_block.label.rent_income') }}<br>{{ __('attributes.register_info.item_block.label.rent_income_1') }}</td>
                                        <td class="text-center number-radius">
                                            <div class="number-border-radius">0</div>
                                        </td>
                                        <td class="text-right td-revenue-room-rentals">{{ $annualPerformance['revenue_land_taxes'] ? number_format($annualPerformance['revenue_land_taxes']) : "0" }}</td>
                                    </tr>
                                    @endif
                                    <tr>
                                        @if($property['real_estate_type_id'] !== FLAG_NINE && $property['real_estate_type_id'] !== FLAG_TEN)
                                        <td class="text-center td-vertical fw-bold" rowspan="9">{{ trans('attributes.balance.body.operating_revenue') }}</td>
                                        @endif
                                        <td class="text-left td-first-child">{{ trans('attributes.balance.body.rent_income') }}</td>
                                        <td class="text-center number-radius">
                                            <div class="number-border-radius">1</div>
                                        </td>
                                        <td class="text-right td-revenue-room-rentals">{{ $annualPerformance['rent_income'] ? number_format($annualPerformance['rent_income']) : "0" }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-left td-first-child">{{ trans('attributes.balance.body.common_service_revenue') }}</td>
                                        <td class="text-center number-radius">
                                            <div class="number-border-radius">2</div>
                                        </td>
                                        <td class="text-right td-revenue-service-charges">{{ $annualPerformance['general_services'] ? number_format($annualPerformance['general_services']) : "0" }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-left td-first-child">{{ trans('attributes.balance.body.utilities_expenses_revenue') }}</td>
                                        <td class="text-center number-radius">
                                            <div class="number-border-radius fs11">3</div>
                                        </td>
                                        <td class="text-right td-revenue-utilities">{{ $annualPerformance['utilities_revenue'] ? number_format($annualPerformance['utilities_revenue']) : "0" }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-left td-first-child">{{ trans('attributes.balance.body.parking_revenue') }}</td>
                                        <td class="text-center number-radius">
                                            <div class="number-border-radius">4</div>
                                        </td>
                                        <td class="text-right"><span class="td-revenue-car-deposits">{{ $annualPerformance['parking_revenue'] ? number_format($annualPerformance['parking_revenue']) : "0" }}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-left td-first-child label-long-text">{{ trans('attributes.balance.body.key_money_and_royalties') }}</td>
                                        <td class="text-center number-radius">
                                            <div class="number-border-radius fs11">5</div>
                                        </td>
                                        <td class="text-right td-turnover-revenue">{{ $annualPerformance['income_input_money'] ? number_format($annualPerformance['income_input_money']) : "0" }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-left td-first-child">{{ trans('attributes.balance.body.renewal_fee_income') }}</td>
                                        <td class="text-center number-radius">
                                            <div class="number-border-radius">6</div>
                                        </td>
                                        <td class="text-right td-revenue-contract-update-fee">{{ $annualPerformance['income_update_house_contract'] ? number_format($annualPerformance['income_update_house_contract']) : "0" }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-left td-first-child">{{ trans('attributes.balance.body.other_income') }}</td>
                                        <td class="text-center number-radius">
                                            <div class="number-border-radius">7</div>
                                        </td>
                                        <td class="text-right td-revenue-other">{{ $annualPerformance['other_income'] ? number_format($annualPerformance['other_income']) : "0" }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-left td-first-child">{{ trans('attributes.balance.body.bad_debt_losses') }}</td>
                                        <td class="text-center number-radius">
                                            <div class="number-border-radius">8</div>
                                        </td>
                                        <td class="text-right td-bad-debt">{{ $annualPerformance['bad_debt_losses'] ? number_format($annualPerformance['bad_debt_losses']) : "0" }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-left td-first-child">{{ trans('attributes.balance.body.meter') }}</td>
                                        <td class="text-center number-radius">
                                            <div class="number-border-radius">9</div>
                                        </td>
                                        <td class="text-right td-total-revenue">{{ $annualPerformance['sum_income'] ? number_format($annualPerformance['sum_income']) : "0" }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center td-vertical fw-bold" rowspan="11">{{ trans('attributes.simulation.content.operating_fee.title') }}</td>
                                        <td class="text-left td-first-child">{{ trans('attributes.balance.body.maintenance_management_fee') }}</td>
                                        <td class="text-center number-radius">
                                            <div class="number-border-radius">10</div>
                                        </td>
                                        <td class="text-right td-maintenance-management-fee">{{ $annualPerformance['management_fee'] ? number_format($annualPerformance['management_fee']) : "0" }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-left td-first-child">{{ trans('attributes.balance.body.utilities_expenses') }}</td>
                                        <td class="text-center number-radius">
                                            <div class="number-border-radius">11</div>
                                        </td>
                                        <td class="text-right td-electricity-gas-charges">{{ $annualPerformance['utilities_fee'] ? number_format($annualPerformance['utilities_fee']) : "0" }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-left td-first-child">{{ trans('attributes.balance.body.management_repair_fee') }}</td>
                                        <td class="text-center number-radius">
                                            <div class="number-border-radius">12</div>
                                        </td>
                                        <td class="text-right td-repair-fee">{{ $annualPerformance['repair_fee'] ? number_format($annualPerformance['repair_fee']) : "0" }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-left td-first-child">{{ trans('attributes.balance.body.intact_reply_fee') }}</td>
                                        <td class="text-center number-radius">
                                            <div class="number-border-radius">13</div>
                                        </td>
                                        <td class="text-right td-recovery-costs">{{ $annualPerformance['intact_reply_fee'] ? number_format($annualPerformance['intact_reply_fee']) : "0" }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-left td-first-child lh1 label-long-text">{{ trans('attributes.balance.body.property') }}<br />{{ trans('attributes.balance.body.management_fee') }}
                                        </td>
                                        <td class="text-center number-radius">
                                            <div class="number-border-radius">14</div>
                                        </td>
                                        <td class="text-right td-property-management_fee">{{ $annualPerformance['asset_management_fee'] ? number_format($annualPerformance['asset_management_fee']) : "0" }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-left td-first-child label-long-text">{{ trans('attributes.balance.body.tenant_recruitment_costs') }}</td>
                                        <td class="text-center number-radius">
                                            <div class="number-border-radius">15</div>
                                        </td>
                                        <td class="text-right td-find-tenant-fee">{{ $annualPerformance['tenant_recruitment_fee'] ? number_format($annualPerformance['tenant_recruitment_fee']) : "0" }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-left td-first-child">{{ trans('attributes.balance.body.taxes_and_dues') }}</td>
                                        <td class="text-center number-radius">
                                            <div class="number-border-radius">16</div>
                                        </td>
                                        <td class="text-right td-tax">{{ $annualPerformance['taxes_dues'] ? number_format($annualPerformance['taxes_dues']) : "0" }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-left td-first-child">{{ trans('attributes.balance.body.non-life_insurance_premiums') }}</td>
                                        <td class="text-center number-radius">
                                            <div class="number-border-radius">17</div>
                                        </td>
                                        <td class="text-right td-loss-insurance">{{ $annualPerformance['insurance_premium'] ? number_format($annualPerformance['insurance_premium']) : "0" }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-left td-first-child">{{ trans('attributes.single_analysis.rent') }}</td>
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
                                        <td></td>
                                        <td class="text-left fw-bold p6">{{ trans('attributes.simulation.preview.operating_total') }}</td>
                                        <td class="text-center number-radius">
                                            <div class="number-border-radius">21</div>
                                        </td>
                                        <td class="text-right p6 td-operating-expenses">{{ $annualPerformance['sum_difference'] ? number_format($annualPerformance['sum_difference']) . ' ' : "0 " }}</td>
                                    </tr>
                                </tbody></table>
                        </div>
                    </div>

                    <div class="col-3 p0 p10l">
                        <div class="row m-0">
                            <table class="table table-bordered table-preview table-preview-analysis table-preview-analysis tb-pre-4 m-0">
                                <tbody>
                                    <tr>
                                        <td class="text-center fw-bold" colspan="2">{{ trans('attributes.balance.preview.table_3.table_head') }}</td>
                                    </tr>
                                    @if($property['real_estate_type_id'] === FLAG_NINE || $property['real_estate_type_id'] === FLAG_TEN)
                                    <tr>
                                        <td class="text-center p7t p7b h37" colspan="2">
                                            <div class="row">
                                                <div class="col-5 text-left text-center-vertical">{{ trans('attributes.balance.preview.table_3.title_8') }}</div>
                                                <div class="col-4 p0">
                                                    <input class="like-input op-building-floor-area-1" type="text" disabled=""
                                                           value="{{ numberFormatWithUnit(basisCalculationBusinessPlan($annualPerformance['revenue_land_taxes'], number_format($property['area_rent'] * 0.3025, FLAG_TWO), FLAG_MAX_MONTH), ' ' . trans('attributes.common.unit-3')) }}">
                                                </div>
                                                <div class="col-3 text-center-vertical">{{ trans('attributes.balance.preview.table_3.unit') }}</div>
                                            </div>
                                        </td>
                                    </tr>
                                    @endif
                                    <tr>
                                        <td class="text-center p7t p7b" colspan="2">
                                            <div class="row">
                                                <div class="col-5 text-left text-center-vertical">{{ trans('attributes.balance.preview.table_3.title_1') }}</div>
                                                <div class="col-4 p0">
                                                    <input class="like-input op-building-floor-area-1" type="text" disabled=""
                                                           value="{{ numberFormatWithUnit(basisCalculationBusinessPlan($annualPerformance['rent_income'], number_format($property['total_area_floors'] * 0.3025, FLAG_TWO), FLAG_MAX_MONTH), ' ' . trans('attributes.common.unit-3')) }}">
                                                </div>
                                                <div class="col-3 text-center-vertical">{{ trans('attributes.balance.preview.table_3.unit') }}</div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-center" colspan="2">
                                            <div class="row">
                                                <div class="col-5 text-left text-center-vertical">{{ trans('attributes.balance.preview.table_3.title_1') }}</div>
                                                <div class="col-4 p0">
                                                    <input class="like-input op-building-floor-area-2" type="text" disabled=""
                                                           value="{{ numberFormatWithUnit(basisCalculationBusinessPlan($annualPerformance['general_services'], number_format($property['total_area_floors'] * 0.3025, FLAG_TWO), FLAG_MAX_MONTH), ' ' . trans('attributes.common.unit-3')) }}">
                                                </div>
                                                <div class="col-3 text-center-vertical">{{ trans('attributes.balance.preview.table_3.unit') }}</div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-center" colspan="2">
                                            <div class="row">
                                                <div class="col-5 text-left text-center-vertical">{{ trans('attributes.balance.preview.table_3.title_1') }}</div>
                                                <div class="col-4 p0">
                                                    <input class="like-input op-building-floor-area-3" type="text" disabled=""
                                                           value="{{ numberFormatWithUnit(basisCalculationBusinessPlan($annualPerformance['utilities_revenue'], number_format($property['total_area_floors'] * 0.3025, FLAG_TWO), FLAG_MAX_MONTH), ' ' . trans('attributes.common.unit-3')) }}">
                                                </div>
                                                <div class="col-3 text-center-vertical">{{ trans('attributes.balance.preview.table_3.unit') }}</div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr class="no-fix">
                                        <td class="text-center" colspan="2">
                                            <div class="row">
                                                <div class="col-1 p30r text-left text-center-vertical">{{ trans('attributes.common.equals') }}</div>
                                                <div class="col-4 p0">
                                                    <input class="like-input op-revenue-car" type="text" disabled=""
                                                           value="{{ numberFormatWithUnit($annualPerformance['parking_revenue'] / FLAG_MAX_MONTH, ' ' . trans('attributes.common.yen')) }}">
                                                </div>
                                                <div class="col-6 text-left text-center-vertical">{{ trans('attributes.balance.preview.table_3.unit') }}</div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-center" colspan="2">
                                            <div class="row">
                                                <div class="col-5 text-left text-center-vertical">{{ trans('attributes.balance.preview.table_3.title_2') }}</div>
                                                <div class="col-4 p0">
                                                    <input class="like-input op-turnover-revenue" type="text" disabled=""
                                                           value="{{ calculationPercentBusinessPlan($annualPerformance['income_input_money'], $annualPerformance['rent_income']) . ' ' . trans('attributes.common.percent') }}">
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-center" colspan="2">
                                            <div class="row">
                                                <div class="col-5 text-left text-center-vertical">{{ trans('attributes.balance.preview.table_3.title_2') }}</div>
                                                <div class="col-4 p0">
                                                    <input class="like-input op-revenue-contract-update-fee" type="text" disabled=""
                                                           value="{{ calculationPercentBusinessPlan($annualPerformance['income_update_house_contract'], $annualPerformance['rent_income']) . ' ' . trans('attributes.common.percent') }}">
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-center" colspan="2">
                                            <div class="row">
                                                <div class="col-5 text-left text-center-vertical">{{ trans('attributes.balance.preview.table_3.title_3') }}</div>
                                                <div class="col-4 p0">
                                                    <input class="like-input op-revenue-other" type="text" disabled=""
                                                           value="{{ calculationPercentBusinessPlan($annualPerformance['other_income'], sumRentalIncome($property)) . ' ' . trans('attributes.common.percent') }}">
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-center" colspan="2">
                                            <div class="row">
                                                <div class="col-5 text-left text-center-vertical">{{ trans('attributes.balance.preview.table_3.title_3') }}</div>
                                                <div class="col-4 p0">
                                                    <input class="like-input op-bad-debt" type="text" disabled=""
                                                           value="{{ calculationPercentBusinessPlan($annualPerformance['bad_debt_losses'], sumRentalIncome($property)) . ' ' . trans('attributes.common.percent') }}">
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-center" colspan="2">
                                            <div class="row">
                                                <div class="col-5 text-left text-center-vertical">{{ trans('attributes.balance.preview.table_3.title_1') }}</div>
                                                <div class="col-4 p0">
                                                    <input class="like-input op-total-revenue" type="text" disabled=""
                                                           value="{{ numberFormatWithUnit(basisCalculationBusinessPlan($annualPerformance['sum_income'], $property['total_area_floors']), ' ' . trans('attributes.common.unit-4')) }}">
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-center" colspan="2">
                                            <div class="row">
                                                <div class="col-5 text-left text-center-vertical">{{ trans('attributes.balance.preview.table_3.title_1') }}</div>
                                                <div class="col-4 p0">
                                                    <input class="like-input op-maintenance-fee" type="text" disabled=""
                                                           value="{{ numberFormatWithUnit(basisCalculationBusinessPlan($annualPerformance['management_fee'], number_format($property['total_area_floors'], FLAG_TWO), FLAG_MAX_MONTH), ' ' . trans('attributes.common.unit-4')) }}">
                                                </div>
                                                <div class="col-3 text-center-vertical">{{ trans('attributes.balance.preview.table_3.unit') }}</div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-center" colspan="2">
                                            <div class="row">
                                                <div class="col-5 text-left text-center-vertical">{{ trans('attributes.balance.preview.table_3.title_1') }}</div>
                                                <div class="col-4 p0">
                                                    <input class="like-input op-electricity-gas-charges" type="text" disabled=""
                                                           value="{{ numberFormatWithUnit(basisCalculationBusinessPlan($annualPerformance['utilities_fee'], number_format($property['total_area_floors'] * 0.3025, FLAG_TWO), FLAG_MAX_MONTH), ' ' . trans('attributes.common.unit-3')) }}">
                                                </div>
                                                <div class="col-3 text-center-vertical">{{ trans('attributes.balance.preview.table_3.unit') }}</div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-center" colspan="2">
                                            <div class="row">
                                                <div class="col-5 text-left text-center-vertical">{{ trans('attributes.balance.preview.table_3.title_1') }}</div>
                                                <div class="col-4 p0">
                                                    <input class="like-input op-repair-fee" type="text" disabled=""
                                                           value="{{ numberFormatWithUnit(basisCalculationBusinessPlan($annualPerformance['repair_fee'], number_format($property['total_area_floors'], FLAG_TWO)), ' ' . trans('attributes.common.unit-4')) }}">
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr class="no-fix">
                                        <td class="text-center" colspan="2">
                                            <div class="row">
                                                <div class="col-5 text-left text-center-vertical">{{ trans('attributes.balance.preview.table_3.title_1') }}</div>
                                                <div class="col-4 p0">
                                                    <input class="like-input op-recovery-costs" type="text" disabled=""
                                                           value="{{ numberFormatWithUnit(basisCalculationBusinessPlan($annualPerformance['intact_reply_fee'], number_format($property['total_area_floors'], FLAG_TWO)), ' ' . trans('attributes.common.unit-4')) }}">
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-center h37" colspan="2">
                                            <div class="row">
                                                <div class="col-5 text-left text-center-vertical">{{ trans('attributes.balance.preview.table_3.title_3') }}</div>
                                                <div class="col-4 p0">
                                                    <input class="like-input op-property-management-fee" type="text" disabled=""
                                                           value="{{ calculationPercentBusinessPlan($annualPerformance['asset_management_fee'], sumRentalIncome($property)) . ' ' . trans('attributes.common.percent') }}">
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-center" colspan="2">
                                            <div class="row">
                                                <div class="col-5 text-left text-center-vertical">{{ trans('attributes.balance.preview.table_3.title_3') }}</div>
                                                <div class="col-4 p0">
                                                    <input class="like-input op-find-tenant-fee" type="text" disabled=""
                                                           value="{{ calculationPercentBusinessPlan($annualPerformance['tenant_recruitment_fee'], sumRentalIncome($property)) . ' ' . trans('attributes.common.percent') }}">
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-center" colspan="2">
                                            <div class="row">
                                                <div class="col-4 p10l text-left">
                                                    <input class="like-input-sm" type="text" disabled=""
                                                           value="{{ $property['date_year_registration_revenue'] ?? "" }}">
                                                </div>
                                                <div class="col-8 text-left p0 text-center-vertical">{{ trans('attributes.balance.preview.table_3.title_4') }}</div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-center" colspan="2">
                                            <div class="row">
                                                <div class="col-4 p10l text-left">
                                                    <input class="like-input-sm" type="text" disabled=""
                                                           value="{{ $property['date_year_registration_revenue'] ?? "" }}">
                                                </div>
                                                <div class="col-8 text-left p0 text-center-vertical">{{ trans('attributes.balance.preview.table_3.title_4') }}</div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-center" colspan="2">
                                            <div class="row">
                                                <div class="col-4 p10l text-left">
                                                    <input class="like-input-sm" type="text" disabled=""
                                                           value="{{ $property['date_year_registration_revenue'] ?? "" }}">
                                                </div>
                                                <div class="col-8 text-left p0 text-center-vertical">{{ trans('attributes.balance.preview.table_3.title_4') }}</div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-center" colspan="2">
                                            <div class="row">
                                                <div class="col-5 text-left text-center-vertical">{{ trans('attributes.balance.preview.table_3.title_5') }}</div>
                                                <div class="col-4 p0">
                                                    <input class="like-input op-tax" type="text" disabled=""
                                                           value="{{ calculationPercentBusinessPlan($annualPerformance['other_fee'], $annualPerformance['sum_income']) . ' ' . trans('attributes.common.percent') }}">
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr class="no-fix">
                                        <td class="text-center" colspan="2">
                                            <div class="row">
                                                <div class="col-5 text-left text-center-vertical">{{ trans('attributes.property.cost_ratio') }}</div>
                                                <div class="col-4 p0">
                                                    <input class="like-input op-total-cost" type="text" disabled=""
                                                           value="{{ number_format(divisionNumber($annualPerformance['sum_fee'], $annualPerformance['sum_income']) * 100, FLAG_TWO) . ' ' . trans('attributes.common.percent') }}">
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr class="no-fix">
                                        <td class="text-center h49" colspan="2">
                                            <div class="row">
                                                <div class="col-5 text-left text-center-vertical">{{ trans('attributes.balance.preview.table_3.title_1') }}</div>
                                                <div class="col-4 p0">
                                                    <input class="like-input op-ground-area" type="text" disabled=""
                                                           value="{{ numberFormatWithUnit(basisCalculationBusinessPlan($annualPerformance['sum_difference'], $property['total_area_floors']), ' ' . trans('attributes.common.unit-4')) }}">
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
