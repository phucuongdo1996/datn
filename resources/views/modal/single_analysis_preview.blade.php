@extends('modal.preview.common_preview')
@section('title', trans('attributes.balance.header.title'))
@section('content_preview')
    <div class="background-print fs11">
        <div class="page-preview-print m0t">
            <div class="row m-0 m10b">
                @if ($currentUser->role != INVESTOR)
                    <div class="col-3 p0 p10r">
                        <table class="table table-bordered table-preview table-preview-analysis m-0">
                            <tr>
                                <td class="w122 text-center fw-bold">{{ trans('attributes.repair_history.owner') }}</td>
                                <td class="text-center">{{ $property['proprietor'] ?? '' }}</td>
                            </tr>
                        </table>
                    </div>
                @endif
            </div>

            <div class="row m-0">
                <div class="col-3 p0 p10r">
                    <div class="row m-0">
                        <table class="table table-bordered table-preview table-preview-analysis tb-pre-1 m-0">
                            <tr>
                                <td class="text-center fw-bold"
                                    colspan="2">{{ trans('attributes.property.date_of_receipt')}}</td>
                                <td class="text-center">{{ convertDateTime($property['receive_house_date']) }}</td>
                            </tr>
                            <tr>
                                <td></td>
                            </tr>
                            <tr>
                                <td class="text-center td-vertical fw-bold"
                                    rowspan="@if($property['main_application'] != null) 12 @else 11 @endif">{{ trans('attributes.balance.body.thing')}}</td>
                                <td class="text-left td-first-child">{{ trans('attributes.simulation.content.physical_info.name') }}</td>
                                <td class="text-center">{{ $property['house_name'] }}</td>
                            </tr>
                            <tr>
                                <td class="text-left td-first-child lh1">{{ trans('attributes.property.address')}}</td>
                                <td class="text-center">{{ $property['address_city'] . ' ' . $property['address_district'] . ' ' . $property['address_town'] }}</td>
                            </tr>
                            <tr>
                                <td class="text-left td-first-child">{{ trans('attributes.balance.body.the_main_purpose') }}</td>
                                <td class="text-center">{{ $property['real_estate_type']['name'] ?? "" }}</td>
                            </tr>
                            <tr>
                                <td class="text-left td-first-child">{{ trans('attributes.balance.body.use_in_detail') }}</td>
                                <td class="text-center">{{ $property['detail_real_estate_type']['name'] ?? "" }}</td>
                            </tr>
                            @if($property['main_application'] != null)
                                <tr>
                                    <td class="text-left td-first-child">{{ trans('attributes.property.main_application') }}</td>
                                    <td class="text-center">{{ $property['main_application'] ? MAIN_APPLICATION[$property['main_application']] : "" }}</td>
                                </tr>
                            @endif
                            <tr>
                                <td class="text-left td-first-child">{{ trans('attributes.balance.body.construction') }}</td>
                                <td class="text-center">{{ materialFormat($property['house_material']['name'], $property['house_roof_type']['name'], true) }}</td>
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
                                        <div class="col-3 p0 col-unit"><span>{{ trans('attributes.common.square_meters') }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-right">{{ numberFormatWithUnit($property['ground_area'], trans('attributes.common.square_meters'), FLAG_TWO) }}</td>
                            </tr>
                            <tr>
                                <td class="text-right td-first-child">{{ trans('attributes.common.unit2') }}</td>
                                <td class="text-right">{{ numberFormatWithUnit($property['ground_area'] * 0.3025, trans('attributes.common.unit2'), FLAG_TWO) }}</td>
                                <td class="ground-area-unit2 d-none">{{ number_format($property['ground_area'] * 0.3025, FLAG_TWO) }}</td>
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
                                <td class="text-right"><span
                                        class="td-ground-area">{{ number_format($property['total_area_floors'], FLAG_TWO) }}</span> {{ trans('attributes.common.square_meters') }}
                                </td>
                            </tr>
                            <tr>
                                <td class="text-right td-first-child">{{ trans('attributes.common.unit2') }}</td>
                                <td class="text-right"><span
                                        class="td-ground-area-unit2">{{ number_format($property['total_area_floors'] * 0.3025, FLAG_TWO) }}</span> {{ trans('attributes.common.unit2') }}
                                </td>
                            </tr>
                            <tr>
                                <td class="text-left td-first-child">{{ trans('attributes.balance.body.date_of_completion') }}</td>
                                <td class="text-center">{{ $property['construction_time'] ? dateTimeFormat($property['construction_time']) : "" }}</td>
                            </tr>

                            <tr>
                                <td class="text-center td-vertical lh1-3  fw-bold"
                                    rowspan="3">{{ trans('attributes.balance.body.rights_mode') }}</td>
                                <td class="text-left td-first-child"> {{ trans('attributes.balance.body.land_rights') }}</td>
                                <td class="text-center">{{ $property['land_right']['name'] ?? "" }}</td>
                            </tr>
                            <tr>
                                <td class="text-left td-first-child">{{ trans('attributes.balance.body.building_rights') }}</td>
                                <td class="text-center">{{ $property['building_right']['name'] ?? "" }}</td>
                            </tr>
                            <tr>
                                <td class="text-left td-first-child">{{ trans('attributes.balance.body.total_number_of_tenants') }}</td>
                                <td class="text-center">{{ $property['total_tenants'] ? number_format($property['total_tenants']) : 0 }}</td>
                            </tr>
                        </table>
                    </div>
                </div>

                <div class="col-3 p0 p10r">
                    <div class="row m-0">
                        <table class="table table-bordered table-preview table-preview-analysis tb-pre-2 m-0">
                            <tr>
                                <td class="text-center fw-bold" colspan="2">{{ trans('attributes.property.house_price') }}</td>
                                <td class="text-right">{{ numberFormatWithUnit($property['money_receive_house'], " " . trans('attributes.common.yen')) }}</td>
                            </tr>
                            <tr>
                                <td></td>
                            </tr>

                            <tr>
                                <td class="text-center td-vertical fw-bold lh1-3 "
                                    rowspan="6">{{ trans('attributes.balance.body.funding_conditions') }}</td>
                                <td class="text-left td-first-child">{{ trans('attributes.balance.body.borrowed_amount') }}</td>
                                <td class="text-right">{{ numberFormatWithUnit($property['loan'], " " . trans('attributes.common.yen')) }}</td>
                            </tr>
                            <tr>
                                <td class="text-left td-first-child">{{ trans('attributes.balance.body.contract_borrowing_period') }}</td>
                                <td class="text-right">{{ $property['contract_loan_period'] . " " .trans('attributes.common.year') }}</td>
                            </tr>
                            <tr>
                                <td class="text-left td-first-child">{{ trans('attributes.balance.body.interest_rate') }}</td>
                                <td class="text-center">{{ numberFormatWithUnit($property['interest_rate'], " " . trans('attributes.common.percent'), FLAG_TWO) }}</td>
                            </tr>
                            <tr>
                                <td class="text-left td-first-child">{{ trans('attributes.balance.body.borrowing_day') }}</td>
                                <td class="text-center">{{ $property['loan_date'] ? dateTimeFormat($property['loan_date']) : "" }}</td>
                            </tr>
                            <tr>
                                <td class="text-left td-first-child">{{ trans('attributes.balance.body.age') }}</td>
                                <td class="text-center">{{ getNumberYearPassed($property['loan_date']) . " " . trans('attributes.common.year') }}</td>
                            </tr>
                            <tr>
                                <td class="text-left td-first-child">{{ trans('attributes.balance.body.loan_repayment_amount') }}<br>
                                    {{ trans('attributes.balance.body.repayment_of_principal_and_interest_2') }}</td>
                                <td class="text-right">{{ number_format(round($pmt)) . " " . trans('attributes.common.yen') }}</td>
                            </tr>
                            <tr>
                                <td></td>
                            </tr>
                            <tr>
                                <td class="text-center td-vertical fw-bold lh1-3 "
                                    rowspan="5">{{ trans('attributes.balance.body.matters_concerning_rights') }}</td>
                                <td class="text-left td-first-child">{{ trans('attributes.balance.body.leasable_area') }}</td>
                                <td class="text-right">{{ numberFormatWithUnit($property['area_may_rent'], " " . trans('attributes.common.square_meters'), 2) }}</td>
                            </tr>
                            <tr>
                                <td class="text-left td-first-child lh1">{{ trans('attributes.balance.body.for_rent') }}<br>{{ trans('attributes.balance.body.floor_rate') }}</td>
                                <td class="text-center">{{ division($property['area_may_rent'], $property['total_area_floors']) . " " . trans('attributes.common.percent') }}</td>
                            </tr>
                            <tr>
                                <td class="text-left td-first-child">{{ trans('attributes.balance.body.rental_operating_area') }}</td>
                                <td class="text-right">{{ numberFormatWithUnit($property['area_rental_operating'], " " . trans('attributes.common.square_meters'), 2) }}</td>
                            </tr>
                            <tr>
                                <td class="text-left td-first-child">{{ trans('attributes.balance.body.crop_yield') }}</td>
                                <td class="text-center">{{ numberFormatWithUnit($property['rental_percentage'], " " . trans('attributes.common.percent'), FLAG_TWO) }}</td>
                            </tr>
                            <tr>
                                <td class="text-left td-first-child">{{ trans('attributes.balance.body.deposit_guarantor') }}</td>
                                <td class="text-right">{{ numberFormatWithUnit($property['deposits'], " " . trans('attributes.common.yen')) }}</td>
                            </tr>
                            <tr>
                                <td class="text-center td-vertical fw-bold lh1-3 "
                                    rowspan="11">{{ trans('attributes.balance.body.leasehold') }}</td>
                                <td class="text-left td-first-child">{{ trans('attributes.balance.body.leasehold_type') }}</td>
                                <td class="text-center">{{ $property['type_rental']['name'] ?? "" }}</td>
                            </tr>
                            <tr>
                                <td class="text-left td-first-child">{{ trans('attributes.balance.body.leased_land_area') }}</td>
                                <td class="text-right">{{ numberFormatWithUnit($property['area_rent'], " " . trans('attributes.common.square_meters'), 2) }}</td>
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
                                    {{ trans('attributes.balance.body.latest_rent_update_date') }}</td>
                                <td class="text-center">{{ $property['date_lease'] ? dateTimeFormat($property['date_lease']) : "" }}</td>
                            </tr>
                            <tr>
                                <td class="text-left td-first-child">{{ trans('attributes.balance.body.security_deposit') }}</td>
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
                                <td class="text-left td-first-child">{{ trans('attributes.single_analysis.reconstruction_permission_fee') }}</td>
                                <td class="text-center">{{ $property['fee_rebuild_rented_house'] == "" ? trans('attributes.common.no_stipulation') : $property['fee_rebuild_rented_house'] }}</td>
                            </tr>
                            <tr>
                                <td class="text-left td-first-child">{{ trans('attributes.balance.body.update') }}</td>
                                <td class="text-center">{{ $property['contract_update_fee'] == "" ? trans('attributes.common.no_stipulation') : $property['contract_update_fee'] }}</td>
                            </tr>
                            <tr>
                                <td class="text-left td-first-child">{{ trans('attributes.property.notes') }}</td>
                                <td class="text-center">{{ $property['notes'] ?? "" }}</td>
                            </tr>
                        </table>
                    </div>
                </div>

                <div class="col-3 p0 p10l">
                    <div class="row m-0">
                        <table class="table table-bordered table-preview-2 tb-pre-3 m-0">
                            <tr>
                                <td class="text-center fw-bold"
                                    colspan="2">{{ trans('attributes.balance.header.title_button_1') }}</td>
                                <td class="text-center" colspan="2">
                                    {{ dateTimeFormatBorrowing($property['date_year_registration_revenue'], $property['date_month_registration_revenue'], 'preview') }}
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                            </tr>
                            <tr>
                                <td class="text-center fw-bold p6"
                                    colspan="3">{{ trans('attributes.simulation.preview.subjects') }}</td>
                                <td class="text-center fw-bold p6">
                                    <div class="row m-0">
                                        <div class="col-9 p0">
                                            <span>{{ trans('attributes.simulation.preview.moneys') }}</span></div>
                                        <div class="col-3 p0"><span>({{ trans('attributes.common.yen') }})</span></div>
                                    </div>
                                </td>
                            </tr>
                            @if($showInput0)
                                <tr>
                                    <td class="text-center td-vertical fw-bold"
                                        rowspan="10">{{ trans('attributes.simulation.content.operating_revenue.title') }}</td>
                                    <td class="text-left td-first-child">{{ __('attributes.register_info.item_block.label.rent_income') }}<br>
                                        {{ __('attributes.register_info.item_block.label.rent_income_1') }}</td>
                                    <td class="text-center number-radius">
                                        <div class="number-border-radius">0</div>
                                    </td>
                                    <td class="text-right td-revenue-land-taxes">{{ $property['revenue_land_taxes'] ? number_format($property['revenue_land_taxes']) : "0" }}</td>
                                </tr>

                                <tr>
                                    <td class="text-left td-first-child">{{ trans('attributes.simulation.content.operating_revenue.number') }}</td>
                                    <td class="text-center number-radius">
                                        <div class="number-border-radius">1</div>
                                    </td>
                                    <td class="text-right td-revenue-room-rentals">{{ $property['revenue_room_rentals'] ? number_format($property['revenue_room_rentals']) : "0" }}</td>
                                </tr>
                            @else
                                <tr>
                                    <td class="text-center td-vertical fw-bold"
                                        rowspan="9">{{ trans('attributes.simulation.content.operating_revenue.title') }}</td>
                                    <td class="text-left td-first-child">{{ trans('attributes.simulation.content.operating_revenue.number') }}</td>
                                    <td class="text-center number-radius">
                                        <div class="number-border-radius">1</div>
                                    </td>
                                    <td class="text-right td-revenue-room-rentals">{{ $property['revenue_room_rentals'] ? number_format($property['revenue_room_rentals']) : "0" }}</td>
                                </tr>
                            @endif
                            <tr>
                                <td class="text-left td-first-child">{{ trans('attributes.simulation.content.operating_revenue.general_services') }}</td>
                                <td class="text-center number-radius">
                                    <div class="number-border-radius">2</div>
                                </td>
                                <td class="text-right td-revenue-service-charges">{{ $property['revenue_service_charges'] ? number_format($property['revenue_service_charges']) : "0" }}</td>
                            </tr>
                            <tr>
                                <td class="text-left td-first-child">{{ trans('attributes.simulation.content.operating_revenue.utilities') }}</td>
                                <td class="text-center number-radius">
                                    <div class="number-border-radius fs11">3</div>
                                </td>
                                <td class="text-right td-revenue-utilities">{{ $property['revenue_utilities'] ? number_format($property['revenue_utilities']) : "0" }}</td>
                            </tr>
                            <tr>
                                <td class="text-left td-first-child">{{ trans('attributes.simulation.content.operating_revenue.parking') }}</td>
                                <td class="text-center number-radius">
                                    <div class="number-border-radius">4</div>
                                </td>
                                <td class="text-right"><span
                                        class="td-revenue-car-deposits">{{ $property['revenue_car_deposits'] ? number_format($property['revenue_car_deposits']) : "0" }}</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-left td-first-child">{{ trans('attributes.simulation.content.operating_revenue.income_input_money') }}</td>
                                <td class="text-center number-radius">
                                    <div class="number-border-radius fs11">5</div>
                                </td>
                                <td class="text-right td-turnover-revenue">{{ $property['turnover_revenue'] ? number_format($property['turnover_revenue']) : "0" }}</td>
                            </tr>
                            <tr>
                                <td class="text-left td-first-child">{{ trans('attributes.simulation.content.operating_revenue.income_update_house_contract') }}</td>
                                <td class="text-center number-radius">
                                    <div class="number-border-radius">6</div>
                                </td>
                                <td class="text-right td-revenue-contract-update-fee">{{ $property['revenue_contract_update_fee'] ? number_format($property['revenue_contract_update_fee']) : "0" }}</td>
                            </tr>
                            <tr>
                                <td class="text-left td-first-child">{{ trans('attributes.simulation.content.operating_revenue.other') }}</td>
                                <td class="text-center number-radius">
                                    <div class="number-border-radius">7</div>
                                </td>
                                <td class="text-right td-revenue-other">{{ $property['revenue_other'] ? number_format($property['revenue_other']) : "0" }}</td>
                            </tr>
                            <tr>
                                <td class="text-left td-first-child">{{ trans('attributes.simulation.content.operating_revenue.bad_debt') }}</td>
                                <td class="text-center number-radius">
                                    <div class="number-border-radius">8</div>
                                </td>
                                <td class="text-right td-bad-debt">{{ $property['bad_debt'] ? number_format($property['bad_debt']) : "0" }}</td>
                            </tr>
                            <tr>
                                <td class="text-left td-first-child">{{ trans('attributes.simulation.content.operating_revenue.sum') }}</td>
                                <td class="text-center number-radius">
                                    <div class="number-border-radius">9</div>
                                </td>
                                <td class="text-right td-total-revenue">{{ $property['total_revenue'] ? number_format($property['total_revenue']) : "0" }}</td>
                            </tr>
                            <tr>
                                <td class="text-center td-vertical fw-bold"
                                    rowspan="11">{{ trans('attributes.simulation.content.operating_fee.title') }}</td>
                                <td class="text-left td-first-child">{{ trans('attributes.simulation.content.operating_fee.maintenance_management') }}</td>
                                <td class="text-center number-radius">
                                    <div class="number-border-radius">10</div>
                                </td>
                                <td class="text-right td-maintenance-management-fee">{{ $property['maintenance_management_fee'] ? number_format($property['maintenance_management_fee']) : "0" }}</td>
                            </tr>
                            <tr>
                                <td class="text-left td-first-child">{{ trans('attributes.simulation.content.operating_fee.utilities') }}</td>
                                <td class="text-center number-radius">
                                    <div class="number-border-radius">11</div>
                                </td>
                                <td class="text-right td-electricity-gas-charges">{{ $property['electricity_gas_charges'] ? number_format($property['electricity_gas_charges']) : "0" }}</td>
                            </tr>
                            <tr>
                                <td class="text-left td-first-child">{{ trans('attributes.simulation.content.operating_fee.repair') }}</td>
                                <td class="text-center number-radius">
                                    <div class="number-border-radius">12</div>
                                </td>
                                <td class="text-right td-repair-fee">{{ $property['repair_fee'] ? number_format($property['repair_fee']) : "0" }}</td>
                            </tr>
                            <tr>
                                <td class="text-left td-first-child">{{ trans('attributes.simulation.content.operating_fee.intact_reply') }}</td>
                                <td class="text-center number-radius">
                                    <div class="number-border-radius">13</div>
                                </td>
                                <td class="text-right td-recovery-costs">{{ $property['recovery_costs'] ? number_format($property['recovery_costs']) : "0" }}</td>
                            </tr>
                            <tr>
                                <td class="text-left td-first-child lh1">{{ trans('attributes.simulation.content.operating_fee.property_management') }}
                                    <br>
                                    {{ trans('attributes.simulation.content.operating_fee.property_management_1') }}
                                </td>
                                <td class="text-center number-radius">
                                    <div class="number-border-radius">14</div>
                                </td>
                                <td class="text-right td-property-management_fee">{{ $property['property_management_fee'] ? number_format($property['property_management_fee']) : "0" }}</td>
                            </tr>
                            <tr>
                                <td class="text-left td-first-child">{{ trans('attributes.simulation.content.operating_fee.recruitment_rental') }}</td>
                                <td class="text-center number-radius">
                                    <div class="number-border-radius">15</div>
                                </td>
                                <td class="text-right td-find-tenant-fee">{{ $property['find_tenant_fee'] ? number_format($property['find_tenant_fee']) : "0" }}</td>
                            </tr>
                            <tr>
                                <td class="text-left td-first-child">{{ trans('attributes.simulation.content.operating_fee.tax') }}</td>
                                <td class="text-center number-radius">
                                    <div class="number-border-radius">16</div>
                                </td>
                                <td class="text-right td-tax">{{ $property['tax'] ? number_format($property['tax']) : "0" }}</td>
                            </tr>
                            <tr>
                                <td class="text-left td-first-child">{{ trans('attributes.simulation.content.operating_fee.damage_insurance') }}</td>
                                <td class="text-center number-radius">
                                    <div class="number-border-radius">17</div>
                                </td>
                                <td class="text-right td-loss-insurance">{{ $property['loss_insurance'] ? number_format($property['loss_insurance']) : "0" }}</td>
                            </tr>
                            <tr>
                                <td class="text-left td-first-child">{{ trans('attributes.single_analysis.rent') }}</td>
                                <td class="text-center number-radius">
                                    <div class="number-border-radius">18</div>
                                </td>
                                <td class="text-right td-land-rental-fee">{{ $property['land_rental_fee'] ? number_format($property['land_rental_fee']) : "0" }}</td>
                            </tr>
                            <tr class="last-row">
                                <td class="text-left td-first-child">{{ trans('attributes.simulation.content.operating_fee.other') }}</td>
                                <td class="text-center number-radius">
                                    <div class="number-border-radius">19</div>
                                </td>
                                <td class="text-right td-other-costs">{{ $property['other_costs'] ? number_format($property['other_costs']) : "0" }}</td>
                            </tr>
                            <tr>
                                <td class="text-left td-first-child">{{ trans('attributes.simulation.content.operating_fee.sum') }}</td>
                                <td class="text-center number-radius">
                                    <div class="number-border-radius">20</div>
                                </td>
                                <td class="text-right td-total-cost">{{ $property['total_cost'] ? number_format($property['total_cost']) : "0" }}</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td class="text-left fw-bold p6">{{ trans('attributes.simulation.preview.operating_total') }}</td>
                                <td class="text-center number-radius">
                                    <div class="number-border-radius">21</div>
                                </td>
                                <td class="text-right p6 td-operating-expenses">{{ number_format($property['total_revenue'] - ($property['total_cost'])) }}</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td class="text-left fw-bold p6">{{ trans('attributes.simulation.content.net_income') }}</td>
                                <td class="text-center number-radius">
                                    <div class="number-border-radius">22</div>
                                </td>
                                <td class="text-center td-operating-expenses">{{ division((float)($property['total_revenue'] - ($property['total_cost'])) ?? 0 , (float)$property['money_receive_house'] ?? 0)  }} {{ trans('attributes.common.percent') }}</td>
                            </tr>
                        </table>
                    </div>
                </div>

                <div class="col-3 p0 p10l">
                    <div class="row m-0">
                        <table
                            class="table table-bordered table-preview table-preview-analysis table-preview-analysis tb-pre-4 m-0">
                            <tr>
                                <td class="text-center fw-bold td-first-child">{{ trans('attributes.portfolio_analysis.first_block.title')}}</td>
                                <td class="text-center">{{ STATUS_HOUSE[$property['status']] }}</td>
                            </tr>
                            <tr>
                                <td></td>
                            </tr>
                            <tr>
                                <td class="text-center fw-bold"
                                    colspan="2">{{ trans('attributes.balance.preview.table_3.table_head')}}</td>
                            </tr>
                            @if($showInput0)
                                <tr>
                                    <td class="text-center" colspan="2">
                                        <div class="row">
                                            <div class="col-5 text-left text-center-vertical">{{ trans('attributes.balance.preview.table_3.title_0')}}</div>
                                            <div class="col-4 centered like-input op-building-floor-area-0"></div>
                                            <div class="col-3 text-center-vertical">{{ trans('attributes.balance.preview.table_3.unit')}}</div>
                                        </div>
                                    </td>
                                </tr>
                            @endif
                            <tr>
                                <td class="text-center" colspan="2">
                                    <div class="row">
                                        <div class="col-5 text-left text-center-vertical">{{ trans('attributes.balance.preview.table_3.title_1')}}</div>
                                        <div class="col-4 centered like-input op-building-floor-area-1"></div>
                                        <div class="col-3 text-center-vertical">{{ trans('attributes.balance.preview.table_3.unit')}}</div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center" colspan="2">
                                    <div class="row">
                                        <div class="col-5 text-left text-center-vertical">{{ trans('attributes.balance.preview.table_3.title_1')}}</div>
                                        <div class="col-4 centered like-input op-building-floor-area-2"></div>
                                        <div class="col-3 text-center-vertical">{{ trans('attributes.balance.preview.table_3.unit')}}</div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center" colspan="2">
                                    <div class="row">
                                        <div class="col-5 text-left text-center-vertical">{{ trans('attributes.balance.preview.table_3.title_1')}}</div>
                                        <div class="col-4 centered like-input op-building-floor-area-3"></div>
                                        <div class="col-3 text-center-vertical">{{ trans('attributes.balance.preview.table_3.unit')}}</div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center" colspan="2">
                                    <div class="row">
                                        <div class="col-1 p30r text-left text-center-vertical">{{ trans('attributes.balance.preview.table_3.sub_unit')}}</div>
                                        <div class="col-4 centered like-input op-revenue-car"></div>
                                        <div class="col-6 text-left text-center-vertical">{{ trans('attributes.balance.preview.table_3.unit')}}</div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center" colspan="2">
                                    <div class="row">
                                        <div class="col-5 text-left text-center-vertical">{{ trans('attributes.balance.preview.table_3.title_2')}}</div>
                                        <div class="col-4 centered like-input op-turnover-revenue"></div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center" colspan="2">
                                    <div class="row">
                                        <div class="col-5 text-left text-center-vertical">{{ trans('attributes.balance.preview.table_3.title_2')}}</div>
                                        <div class="col-4 centered like-input op-revenue-contract-update-fee"></div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center" colspan="2">
                                    <div class="row">
                                        <div class="col-5 text-left text-center-vertical">{{ trans('attributes.balance.preview.table_3.title_3')}}</div>
                                        <div class="col-4 centered like-input op-revenue-other"></div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center" colspan="2">
                                    <div class="row">
                                        <div class="col-5 text-left text-center-vertical">{{ trans('attributes.balance.preview.table_3.title_3')}}</div>
                                        <div class="col-4 centered like-input op-bad-debt"></div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center" colspan="2">
                                    <div class="row">
                                        <div class="col-5 text-left text-center-vertical">{{ trans('attributes.balance.preview.table_3.title_1')}}</div>
                                        <div class="col-4 centered like-input op-total-revenue"></div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center" colspan="2">
                                    <div class="row">
                                        <div class="col-5 text-left text-center-vertical">{{ trans('attributes.balance.preview.table_3.title_1')}}</div>
                                        <div class="col-4 centered like-input op-maintenance-fee"></div>
                                        <div class="col-3 text-center-vertical">{{ trans('attributes.balance.preview.table_3.unit')}}</div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center" colspan="2">
                                    <div class="row">
                                        <div class="col-5 text-left text-center-vertical">{{ trans('attributes.balance.preview.table_3.title_1')}}</div>
                                        <div class="col-4 centered like-input op-electricity-gas-charges"></div>
                                        <div class="col-3 text-center-vertical">{{ trans('attributes.balance.preview.table_3.unit')}}</div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center" colspan="2">
                                    <div class="row">
                                        <div class="col-5 text-left text-center-vertical">{{ trans('attributes.balance.preview.table_3.title_1')}}</div>
                                        <div class="col-4 centered like-input op-repair-fee"></div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center" colspan="2">
                                    <div class="row">
                                        <div class="col-5 text-left text-center-vertical">{{ trans('attributes.balance.preview.table_3.title_1')}}</div>
                                        <div class="col-4 centered like-input op-recovery-costs"></div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center" colspan="2">
                                    <div class="row">
                                        <div class="col-5 text-left text-center-vertical">{{ trans('attributes.balance.preview.table_3.title_3')}}</div>
                                        <div class="col-4 centered like-input op-property-management-fee"></div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center" colspan="2">
                                    <div class="row">
                                        <div class="col-5 text-left text-center-vertical">{{ trans('attributes.balance.preview.table_3.title_3')}}</div>
                                        <div class="col-4 centered like-input op-find-tenant-fee"></div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center" colspan="2">
                                    <div class="row m0 m5l">
                                        <div class="col-3 p10l centered text-left like-input-sm">{{ $property['date_year_registration_revenue'] }}</div>
                                        <div class="col-8 text-left p20l text-center-vertical">{{ trans('attributes.balance.preview.table_3.title_4')}}</div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center" colspan="2">
                                    <div class="row m0 m5l">
                                        <div class="col-3 p10l centered text-left like-input-sm">{{ $property['date_year_registration_revenue'] }}</div>
                                        <div class="col-8 text-left p20l text-center-vertical">{{ trans('attributes.balance.preview.table_3.title_4')}}</div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center" colspan="2">
                                    <div class="row m0 m5l">
                                        <div class="col-3 p10l centered text-left like-input-sm">{{ $property['date_year_registration_revenue'] }}</div>
                                        <div class="col-8 text-left p20l text-center-vertical">{{ trans('attributes.balance.preview.table_3.title_4')}}</div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center" colspan="2">
                                    <div class="row">
                                        <div class="col-5 text-left text-center-vertical">{{ trans('attributes.balance.preview.table_3.title_5')}}</div>
                                        <div class="col-4 centered like-input op-tax"></div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center" colspan="2">
                                    <div class="row">
                                        <div class="col-5 text-left text-center-vertical">{{ trans('attributes.balance.preview.table_3.title_6')}}</div>
                                        <div class="col-4 centered like-input op-total-cost"></div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center" colspan="2">
                                    <div class="row">
                                        <div class="col-5 text-left text-center-vertical">{{ trans('attributes.balance.preview.table_3.title_1')}}</div>
                                        <div class="col-4 centered like-input op-ground-area"></div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-left" colspan="2">{{ trans('attributes.balance.preview.table_3.title_7')}}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="page-preview-print">
            <div class="sub-title-review-simulation m15b">
                <span class="fs14 fw-bold m15l">{{ trans('attributes.balance.body.table.target_real_estate')}}</span>
                <span class="m20l fs13 break-all">{{ $property['house_name'] }}</span>
            </div>
            <div class="content-page">
                <div class="table-responsive">
                    <table class="table table-bordered table-preview border-0 m-0">
                        <tr>
                            <td class="fw-bold w-3">{{ trans('attributes.borrowing.table.no') }}</td>
                            <td class="fw-bold w-4">{{ trans('attributes.balance.body.table.prefectures') }}</td>
                            <td class="fw-bold w-4">{{ trans('attributes.balance.body.location') }}<br>
                                ({{ trans('attributes.balance.body.table.urban_area') }})
                            </td>
                            <td class="fw-bold w-5">{{ trans('attributes.balance.body.the_main_purpose') }}</td>
                            <td class="fw-bold w-4">{{ trans('attributes.balance.body.construction') }}</td>
                            <td class="fw-bold w-4">{{ trans('attributes.balance.body.floor') }}<br>
                                ({{ trans('attributes.balance.body.table.ground_floor') }})
                            </td>
                            <td class="fw-bold w-4">{{ trans('attributes.balance.body.total_land_area') }}</td>
                            <td class="fw-bold w-4">{{ trans('attributes.balance.body.building_floor_area') }}</td>
                            <td class="fw-bold w-4">{{ trans('attributes.balance.body.table.year_of_completion') }}</td>
                            <td class="fw-bold w-4">{{ trans('attributes.balance.body.land_rights') }}</td>
                            <td class="fw-bold w-4">{{ trans('attributes.balance.body.building_rights') }}</td>
                            <td class="fw-bold w-4">{{ trans('attributes.balance.body.table.leasable_area') }}</td>
                            <td class="fw-bold w-4">{{ trans('attributes.balance.body.table.rent-a-file_ratio') }}
                                <br>
                                ({{ trans('attributes.balance.body.table.bed_effective_rate') }})
                            </td>
                            <td class="fw-bold w-4">{{ trans('attributes.balance.body.crop_yield') }}</td>
                            <td class="fw-bold w-4">{{ trans('attributes.balance.body.rent_income') }}<br>
                                ({{ trans('attributes.balance.body.table.monthly_basis') }})
                            </td>
                            <td class="fw-bold w-4">{{ trans('attributes.balance.body.operating_revenue') }}<br>
                                ({{ trans('attributes.balance.body.table.per_m²') }})
                            </td>
                            <td class="fw-bold w-4">{{ trans('attributes.balance.body.maintenance_management_fee') }}
                                <br>
                                ({{ trans('attributes.balance.body.table.monthly_m²') }})
                            </td>
                            <td class="fw-bold w-4">{{ trans('attributes.balance.body.repair_fee') }}<br>
                                ({{ trans('attributes.balance.body.table.per_m²') }})
                            </td>
                            <td class="fw-bold w-4">{{ trans('attributes.balance.body.non-life_insurance_premiums') }}
                                <br>
                                ({{ trans('attributes.balance.body.table.per_m²') }})
                            </td>
                            <td class="fw-bold w-4">{{ trans('attributes.balance.body.operating_costs') }}
                                <br>
                                ({{ trans('attributes.balance.body.table.per_m²') }})
                            </td>
                            <td class="fw-bold w-4">{{ trans('attributes.balance.body.table.expense_ratio') }}
                                <br>
                                ({{ trans('attributes.balance.body.operating_costs') }}
                                ÷ {{ trans('attributes.balance.body.operating_revenue') }})
                            </td>
                            <td class="fw-bold w-4">{{ trans('attributes.balance.body.operating_balance') }}
                                <br>
                                ({{ trans('attributes.balance.body.table.per_m²') }})
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center"></td>
                            <td class="text-left">
                                {{ $property['address_city'] ?? "" }}
                            </td>
                            <td class="text-left">
                                {{ $property['address_district'] ?? "" }}
                            </td>
                            <td class="text-left">
                                {{ $property['real_estate_type']['name'] ?? "" }}
                            </td>
                            <td class="text-left">
                                {{ materialFormat($property['house_material']['name'], $property['house_roof_type']['name'], true)}}
                            </td>
                            <td class="btext-left">
                                {{ $property['storeys'] ?? "" }}
                            </td>
                            <td class="text-left">
                                {{ number_format(excelRoundDown($property['ground_area'])) . trans('attributes.common.round_square_meters') }}
                            </td>
                            <td class="text-left">
                                {{ getValueByListLimited($property['real_estate_type_id'], $property['total_area_floors']) }}
                            </td>
                            <td class="text-left">
                                {{ !empty($property['construction_time']) ? getDecade($property['construction_time']) . ' ' . trans('attributes.common.decade') : "" }}
                            </td>
                            <td class="text-left">
                                {{ $property['land_right']['name'] ?? "" }}
                            </td>
                            <td class="text-left">
                                {{ $property['building_right']['name'] ?? "" }}
                            </td>
                            <td class="text-center">
                                {{ getValueByListLimited($property['real_estate_type_id'], $property['area_may_rent']) }}
                            </td>
                            <td class="text-center">
                                {{ division($property['area_may_rent'], $property['total_area_floors']) }} {{ trans('attributes.common.percent') }}
                            </td>
                            <td class="text-center">
                                {{ numberFormatWithUnit($property['rental_percentage'], " " . trans('attributes.common.percent'), FLAG_TWO) }}
                            </td>
                            <td class="text-right">
                                {{ numberFormatWithUnit(divisionNumber($property['revenue_room_rentals'] / FLAG_TWELVE, $property['total_area_floors'] * 0.3025), ' ' . trans('attributes.common.unit-3')) }}
                            </td>
                            <td class="text-right">
                            <span class="td-total_revenue-16">
                                {{ number_format(divisionNumber($property['total_revenue'], $property['total_area_floors'])) }}
                            </span> {{trans('attributes.common.unit-4')}}
                            </td>
                            <td class="text-right">
                                {{ numberFormatWithUnit(divisionNumber($property['maintenance_management_fee'], $property['total_area_floors']) / FLAG_TWELVE, ' ' . trans('attributes.common.unit-4')) }}
                            </td>
                            <td class="text-right">
                                {{ numberFormatWithUnit(divisionNumber($property['repair_fee'], $property['total_area_floors']), ' ' . trans('attributes.common.unit-4')) }}
                            </td>
                            <td class="text-right">
                                {{ numberFormatWithUnit(divisionNumber($property['loss_insurance'], $property['total_area_floors']), ' ' . trans('attributes.common.unit-4')) }}
                            </td>
                            <td class="text-right">
                                {{numberFormatWithUnit(divisionNumber($property['total_cost'], $property['total_area_floors']), ' ' . trans('attributes.common.unit-4')) }}
                            </td>
                            <td class="text-center">
                            <span
                                class="td-total_revenue-21">{{  $property['total_revenue'] }}</span> {{trans('attributes.common.percent')}}
                            </td>
                            <td class="text-right">
                            <span
                                class="td-total_revenue-22">{{ number_format(divisionNumber($property['total_revenue'] - $property['total_cost'], $property['total_area_floors'])) }}</span> {{trans('attributes.common.unit-4')}}
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="sub-title-review-simulation m15b m25t">
                <span class="fs14 fw-bold m15l">{{ trans('attributes.balance.preview.table_3.sub_title_2')}}</span>
            </div>
            <div class="content-page">
                <div class="table-responsive">
                    <table class="table table-preview border-0 m0">
                        <thead>
                        <tr>
                            <td class="fw-bold w-3">{{ trans('attributes.borrowing.table.no') }}</td>
                            <td class="fw-bold w-4">{{ trans('attributes.balance.body.table.prefectures') }}</td>
                            <td class="fw-bold w-4">{{ trans('attributes.balance.body.location') }}<br>
                                ({{ trans('attributes.balance.body.table.urban_area') }})
                            </td>
                            <td class="fw-bold w-5">{{ trans('attributes.balance.body.the_main_purpose') }}</td>
                            <td class="fw-bold w-4">{{ trans('attributes.balance.body.construction') }}</td>
                            <td class="fw-bold w-4">{{ trans('attributes.balance.body.floor') }}<br>({{ trans('attributes.balance.body.table.ground_floor') }})
                            </td>
                            <td class="fw-bold w-4">{{ trans('attributes.balance.body.total_land_area') }}</td>
                            <td class="fw-bold w-4">{{ trans('attributes.balance.body.building_floor_area') }}</td>
                            <td class="fw-bold w-4">{{ trans('attributes.balance.body.table.year_of_completion') }}</td>
                            <td class="fw-bold w-4">{{ trans('attributes.balance.body.land_rights') }}</td>
                            <td class="fw-bold w-4">{{ trans('attributes.balance.body.building_rights') }}</td>
                            <td class="fw-bold w-4">{{ trans('attributes.balance.body.table.leasable_area') }}</td>
                            <td class="fw-bold w-4">{{ trans('attributes.balance.body.table.rent-a-file_ratio') }}
                                <br>
                                ({{ trans('attributes.balance.body.table.bed_effective_rate') }})
                            </td>
                            <td class="fw-bold w-4">{{ trans('attributes.balance.body.crop_yield') }}</td>
                            <td class="fw-bold w-4">{{ trans('attributes.balance.body.rent_income') }}<br>
                                ({{ trans('attributes.balance.body.table.monthly_basis') }})
                            </td>
                            <td class="fw-bold w-4">{{ trans('attributes.balance.body.operating_revenue') }}<br>
                                ({{ trans('attributes.balance.body.table.per_m²') }})
                            </td>
                            <td class="fw-bold w-4">{{ trans('attributes.balance.body.maintenance_management_fee') }}
                                <br>
                                ({{ trans('attributes.balance.body.table.monthly_m²') }})
                            </td>
                            <td class="fw-bold w-4">{{ trans('attributes.balance.body.repair_fee') }}<br>
                                ({{ trans('attributes.balance.body.table.per_m²') }})
                            </td>
                            <td class="fw-bold w-4">{{ trans('attributes.balance.body.non-life_insurance_premiums') }}
                                <br>
                                ({{ trans('attributes.balance.body.table.per_m²') }})
                            </td>
                            <td class="fw-bold w-4">{{ trans('attributes.balance.body.operating_costs') }}
                                <br>
                                ({{ trans('attributes.balance.body.table.per_m²') }})
                            </td>
                            <td class="fw-bold w-4">{{ trans('attributes.balance.body.table.expense_ratio') }}
                                <br>
                                ({{ trans('attributes.balance.body.operating_costs') }}
                                ÷ {{ trans('attributes.balance.body.operating_revenue') }})
                            </td>
                            <td class="fw-bold w-4">{{ trans('attributes.balance.body.operating_balance') }}
                                <br>
                                ({{ trans('attributes.balance.body.table.per_m²') }})
                            </td>
                        </tr>
                        </thead>
                        @foreach($listPropertyTable as $key => $value)
                            <tr class="table-body">
                                <td class="text-center">{{ $key + FLAG_ONE }}</td>
                                <td class="text-left">{{ $value['address_city'] ?? "" }}</td>
                                <td class="text-left">{{ $value['address_district'] ?? "" }}</td>
                                <td class="text-left"> {{ $value['realEstateType']['name'] ?? "" }}</td>
                                <td class="text-left">{{ materialFormat($value['house_material']['name'], $value['house_roof_type']['name'], true) }}</td>
                                <td class="text-left">{{ $value['storeys'] ?? "" }}</td>
                                <td class="text-left">{{ number_format(excelRoundDown($value['ground_area'])) . trans('attributes.common.round_square_meters')  }}</td>
                                <td class="text-left">{{ getValueByListLimited($value['real_estate_type_id'], $value['total_area_floors']) }}
                                </td>
                                <td class="text-left">
                                    {{ !empty($value['construction_time']) ? getDecade($value['construction_time']) . ' ' . trans('attributes.common.decade') : "" }}
                                </td>
                                <td class="text-left">{{ $value['land_right']['name'] ?? "" }}
                                </td>
                                <td class="text-left">{{ $value['building_right']['name'] ?? "" }}
                                </td>
                                <td class="text-center">{{ getValueByListLimited($value['real_estate_type_id'], $value['area_may_rent']) }}
                                </td>
                                <td class="ext-center">{{ division($value['area_may_rent'], $value['total_area_floors']) }} {{ trans('attributes.common.percent') }}
                                </td>
                                <td class="text-center">{{ numberFormatWithUnit($value['rental_percentage'], " " . trans('attributes.common.percent'), FLAG_TWO) }}
                                </td>
                                <td class="text-center">{{ numberFormatWithUnit(divisionNumber($value['revenue_room_rentals'] / FLAG_TWELVE, $value['total_area_floors'] * 0.3025), ' ' . trans('attributes.common.unit-3')) }}
                                </td>
                                <td class="text-right">{{ numberFormatWithUnit(divisionNumber($value['total_revenue'], $value['total_area_floors']), ' ' . trans('attributes.common.unit-4')) }}
                                </td>
                                <td class="text-right">{{ numberFormatWithUnit(divisionNumber($value['maintenance_management_fee'], $value['total_area_floors']) / FLAG_TWELVE, ' ' . trans('attributes.common.unit-4')) }}
                                </td>
                                <td class="text-right">{{ numberFormatWithUnit(divisionNumber($value['repair_fee'], $value['total_area_floors']), ' ' . trans('attributes.common.unit-4')) }}
                                </td>
                                <td class="text-right">{{ numberFormatWithUnit(divisionNumber($value['loss_insurance'], $value['total_area_floors']), ' ' . trans('attributes.common.unit-4')) }}
                                </td>
                                <td class="text-right">{{ numberFormatWithUnit(divisionNumber($value['total_cost'], $value['total_area_floors']), ' ' . trans('attributes.common.unit-4')) }}
                                </td>
                                <td class="text-center">{{ numberFormatWithUnit(divisionNumber($value['total_cost'] * 100, $value['total_revenue']), ' ' . trans('attributes.common.percent'), 2) }}
                                </td>
                                <td class="text-right">{{ numberFormatWithUnit(divisionNumber($value['total_revenue'] - $value['total_cost'], $value['total_area_floors']), ' ' . trans('attributes.common.unit-4')) }}
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
        <div class="page-preview-print" >
            <div class="row m-0 chart-single-analysis-preview">
                <div  class="col-12 p0 p2b">
                    <div class="col-preview-single-analysis p15">
                        <p class="title-diagram text-left fs16 color-title-chart">{{ __('attributes.single_analysis.title_high_charts') }}</p>
                        <div id="chart-all-preview" class="d-flex"></div>
                        <p class="highcharts-description fs11 highcharts-notedes m10l" style="display: none">
                            {{ __('attributes.simulation_charts.note_1') }}<br/>
                            {{ __('attributes.simulation_charts.note_2') }}
                        </p>
                    </div>
                </div>
            </div>
            <div class="row m-0 chart-single-analysis-preview">
                <div class="col-6 p0 p2r p2t">
                    <div class="col-preview-single-analysis p10">
                        <div id="scatter-chart-preview" class=""></div>
                    </div>
                </div>
                <div class="col-6 p0 p2l p2t score-map-wrapper">
                    <div class="col-preview-single-analysis p10">
                        <div class="header-card6">
                            <div class="header-card6-left p5t p20l p10r">
                                <p class="fs16 fw-bold m0">SCOREMAP
                                    <i class="question-icon far fa-question-circle" aria-hidden="true"></i>
                                </p>
                                <p class="fs12 fw-bold m0">{{ trans('attributes.balance.body.note_chart') }}</p>
                            </div>
                            <div class="header-card6-right p15r">
                                <div class="pre-sum-points text-white text-center">
                                    <span id="synthetic-point-preview" class="fs24">{{ round($property['synthetic_point']) }}</span> <span class="fs12">points</span>
                                </div>
                            </div>
                        </div>
                        <div id="spiderweb-chart-preview"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="page-preview-print" >
            <div class="row m-0 chart-single-analysis-preview">
                <div class="col-4 border-left-0 p0 p2r p2b">
                    <div class="col-preview-single-analysis p10t p10b">
                        <div id="box-plot-chart-1-preview"></div>
                    </div>
                </div>
                <div class="col-4 p0 p2r p2l p2b">
                    <div class="col-preview-single-analysis p10t p10b">
                        <div id="box-plot-chart-2-preview"></div>
                    </div>
                </div>
                <div class="col-4 p0 p2l p2b">
                    <div class="col-preview-single-analysis p10t p10b">
                        <div id="box-plot-chart-3-preview"></div>
                    </div>
                </div>
            </div>
            <div class="row m-0 chart-single-analysis-preview">
                <div class="col-4 p0 p2t p2r">
                    <div class="col-preview-single-analysis p10t p10b">
                        <div id="box-plot-chart-4-preview"></div>
                    </div>
                </div>
                <div class="col-4 p0 p2t p2r p2l">
                    <div class="col-preview-single-analysis p10t p10b">
                        <div id="box-plot-chart-5-preview"></div>
                    </div>
                </div>
                <div class="col-4 p0 p2t p2l">
                    <div class="col-preview-single-analysis p10t p10b">
                        <div id="box-plot-chart-6-preview"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
