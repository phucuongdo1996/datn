@extends('modal.preview.common_preview')
@section('title', __('attributes.simulation.content.title_left') )
@section('content_preview')
<div class="preview-print background-print" id="preview-print">
    <div class="container-preview-simulation p0">
        <div id="cant-preview-print" class="col-12 page-1 p0">
            <div class="w-100 text-center fs25 font-weight-bold text-content">{{ trans('messages.cant_print') }}</div>
        </div>

        <div id="page-1" class="col-12 page-1 p0" >
            <div class="sub-title-review-simulation m15b">
                <span class="fs15 fw-bold m15l">{{__('attributes.simulation.preview.title_1') }}</span>
            </div>
            <div class="row m-0 m20b">
                <div class="col-6 p0 p10r">
                    <div class="row m-0">
                        <table class="table table-bordered table-preview">
                            <tr>
                                <td class="text-center td-vertical fw-bold" rowspan="9">{{__('attributes.simulation.content.physical_info.title') }}</td>
                                <td class="text-left td-first-child">{{__('attributes.simulation.content.physical_info.name') }}</td>
                                <td class="text-center pre-name" data-name ="name"></td>
                            </tr>
                            <tr>
                                <td class="text-left td-first-child">{{__('attributes.simulation.preview.zip_code') }}</td>
                                <td class="text-center pre-zip-code" data-name ="zipcode"></td>
                            </tr>
                            <tr>
                                <td class="text-left td-first-child">{{__('attributes.simulation.content.physical_info.address') }}</td>
                                <td class="text-center pre-address" data-name="address"></td>
                            </tr>
                            <tr>
                                <td class="text-left td-first-child">{{__('attributes.simulation.content.physical_info.uses') }}</td>
                                <td class="text-center pre-uses" data-name="uses"></td>
                            </tr>
                            <tr>
                                <td class="text-left td-first-child">{{__('attributes.simulation.content.physical_info.date_of_construction') }}</td>
                                <td class="text-center pre-date-construction" data-name="construction_time"></td>
                            </tr>
                            <tr>
                                <td class="td-first-child">
                                    <div class="row m-0">
                                        <div class="col-9 p0"><span>{{__('attributes.simulation.content.physical_info.ground_area') }}</span></div>
                                        <div class="col-3 p0 col-unit"><span>{{__('attributes.common.m2') }}</span></div>
                                    </div>
                                </td>
                                <td class="text-right pre-ground-area" data-name="ground_area"></td>
                            </tr>
                            <tr>
                                <td class="text-right td-first-child">{{__('attributes.common.unit2') }}</td>
                                <td class="text-right pre-unit-1" data-name="unit_1"></td>
                            </tr>
                            <tr>
                                <td class="text-left td-first-child">
                                    <div class="row m-0">
                                        <div class="col-9 p0"><span>{{__('attributes.simulation.content.physical_info.total_floor_area') }}</span></div>
                                        <div class="col-3 p0 col-unit"><span>{{__('attributes.common.m2') }}</span></div>
                                    </div>
                                </td>
                                <td class="text-right pre-total-floor-area" data-name="total_area_floors"></td>
                            </tr>
                            <tr>
                                <td class="text-right td-first-child">{{__('attributes.common.unit2') }}</td>
                                <td class="text-right pre-unit-2" data-name="unit_2"></td>
                            </tr>
                        </table>
                    </div>

                    <div class="row m-0 p5t">
                        <table class="table table-bordered table-preview">
                            <tr>
                                <td class="text-center td-vertical fw-bold" rowspan="6">{{__('attributes.simulation.content.investment_conditions.title') }}</td>
                                <td class="text-left td-first-child">{{__('attributes.simulation.content.investment_conditions.house_price') }}</td>
                                <td class="text-right pre-house-price" data-name="house_price"></td>
                            </tr>
                            <tr>
                                <td class="text-left td-first-child">{{__('attributes.simulation.content.investment_conditions.personal_money_spent') }}</td>
                                <td class="text-right pre-personal-money-spent" data-name="personal_money_spent"></td>
                            </tr>
                            <tr>
                                <td class="text-left td-first-child">{{__('attributes.simulation.content.investment_conditions.loan') }}</td>
                                <td class="text-right pre-loan" data-name="loan"></td>
                            </tr>
                            <tr>
                                <td class="text-left td-first-child">{{__('attributes.simulation.content.investment_conditions.interest') }}</td>
                                <td class="text-center pre-interest" data-name="interest"></td>
                            </tr>
                            <tr>
                                <td class="text-left td-first-child">{{__('attributes.simulation.content.investment_conditions.year') }}</td>
                                <td class="text-center pre-year" data-name="year"></td>
                            </tr>
                            <tr>
                                <td class="lh1 td-first-child">
                                    <span class="text-left">{{__('attributes.simulation.content.investment_conditions.loan_per_year_1') }}<br>
                                        {{__('attributes.simulation.content.investment_conditions.loan_per_year_2') }}
                                    </span>
                                </td>
                                <td class="text-right pre-loan-per-year" data-name="loan_per_year"></td>
                            </tr>
                        </table>
                    </div>
                </div>

                <div class="col-6 p0 p10l">
                    <div class="row m-0">
                        <table class="table table-bordered table-preview-2">
                            <tr>
                                <td class="text-center fw-bold p6" colspan="3">{{__('attributes.simulation.preview.subjects') }}</td>
                                <td class="text-center fw-bold p6">
                                    <div class="row m-0">
                                        <div class="col-10 p0"><span>{{__('attributes.simulation.preview.moneys') }}</span></div>
                                        <div class="col-2 p0 p15l"><span>({{__('attributes.common.yen') }})</span></div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center td-vertical fw-bold" rowspan="10">{{__('attributes.simulation.content.operating_revenue.title') }}</td>
                                <td class="text-left td-first-child">{{ __('attributes.register_info.item_block.label.rent_income') }}<br>
                                    {{ __('attributes.register_info.item_block.label.rent_income_1') }}</td>
                                <td class="text-center number-radius">
                                    <div class="number-border-radius fs12">0</div>
                                </td>
                                <td class="text-right pre-operating-revenue-number" data-name="revenue_land_taxes"></td>
                            </tr>
                            <tr>
                                <td class="text-left td-first-child">{{__('attributes.simulation.content.operating_revenue.number') }}</td>
                                <td class="text-center number-radius">
                                    <div class="number-border-radius fs12">1</div>
                                </td>
                                <td class="text-right pre-operating-revenue-number" data-name="revenue_room_rentals"></td>
                            </tr>
                            <tr>
                                <td class="text-left td-first-child">{{__('attributes.simulation.content.operating_revenue.general_services') }}</td>
                                <td class="text-center number-radius">
                                    <div class="number-border-radius fs12">2</div>
                                </td>
                                <td class="text-right pre-general-services" data-name="revenue_general_services"></td>
                            </tr>
                            <tr>
                                <td class="text-left td-first-child">{{__('attributes.simulation.content.operating_revenue.utilities') }}</td>
                                <td class="text-center number-radius">
                                    <div class="number-border-radius fs12">3</div>
                                </td>
                                <td class="text-right pre-revenue-utilities" data-name="revenue_utilities"></td>
                            </tr>
                            <tr>
                                <td class="text-left td-first-child">{{__('attributes.simulation.content.operating_revenue.parking') }}</td>
                                <td class="text-center number-radius">
                                    <div class="number-border-radius fs12">4</div>
                                </td>
                                <td class="text-right pre-parking" data-name="revenue_parking"></td>
                            </tr>
                            <tr>
                                <td class="text-left td-first-child">{{__('attributes.simulation.content.operating_revenue.income_input_money') }}</td>
                                <td class="text-center number-radius">
                                    <div class="number-border-radius fs12">5</div>
                                </td>
                                <td class="text-right pre-income-input-money" data-name="income_input_money"></td>
                            </tr>
                            <tr>
                                <td class="text-left td-first-child">{{__('attributes.simulation.content.operating_revenue.income_update_house_contract') }}</td>
                                <td class="text-center number-radius">
                                    <div class="number-border-radius fs12">6</div>
                                </td>
                                <td class="text-right pre-income-update-house-contract" data-name="income_update_house_contract"></td>
                            </tr>
                            <tr>
                                <td class="text-left td-first-child">{{__('attributes.simulation.content.operating_revenue.other') }}</td>
                                <td class="text-center number-radius">
                                    <div class="number-border-radius fs12">7</div>
                                </td>
                                <td class="text-right pre-revenue-other" data-name="other_revenue"></td>
                            </tr>
                            <tr>
                                <td class="text-left td-first-child">{{__('attributes.simulation.content.operating_revenue.bad_debt') }}</td>
                                <td class="text-center number-radius">
                                    <div class="number-border-radius fs12">8</div>
                                </td>
                                <td class="text-right pre-bad-debt" data-name="bad_debt"></td>
                            </tr>
                            <tr>
                                <td class="text-left td-first-child">{{__('attributes.simulation.content.operating_revenue.sum') }}</td>
                                <td class="text-center number-radius">
                                    <div class="number-border-radius fs12">9</div>
                                </td>
                                <td class="text-right pre-total-operating-revenue" data-name="total_revenue"></td>
                            </tr>
                            <tr>
                                <td class="text-center td-vertical fw-bold" rowspan="11">{{__('attributes.simulation.content.operating_fee.title') }}</td>
                                <td class="text-left td-first-child">{{__('attributes.simulation.content.operating_fee.maintenance_management') }}</td>
                                <td class="text-center number-radius">
                                    <div class="number-border-radius fs12">10</div>
                                </td>
                                <td class="text-right pre-maintenance-management" data-name="maintenance_management_fee"></td>
                            </tr>
                            <tr>
                                <td class="text-left td-first-child">{{__('attributes.simulation.content.operating_fee.utilities') }}</td>
                                <td class="text-center number-radius">
                                    <div class="number-border-radius fs12">11</div>
                                </td>
                                <td class="text-right pre-fee-utilities" data-name="fee_utilities"></td>
                            </tr>
                            <tr>
                                <td class="text-left td-first-child">{{__('attributes.simulation.content.operating_fee.repair') }}</td>
                                <td class="text-center number-radius">
                                    <div class="number-border-radius fs12">12</div>
                                </td>
                                <td class="text-right pre-repair" data-name="repair_fee"></td>
                            </tr>
                            <tr>
                                <td class="text-left td-first-child">{{__('attributes.simulation.content.operating_fee.intact_reply') }}</td>
                                <td class="text-center number-radius">
                                    <div class="number-border-radius fs12">13</div>
                                </td>
                                <td class="text-right pre-intact-reply" data-name="fee_intact_reply"></td>
                            </tr>
                            <tr>
                                <td class="text-left lh1 td-first-child">{{__('attributes.simulation.content.operating_fee.property_management') }}<br>
                                    {{__('attributes.simulation.content.operating_fee.property_management_1') }}
                                </td>
                                <td class="text-center number-radius">
                                    <div class="number-border-radius fs12">14</div>
                                </td>
                                <td class="text-right pre-property-management" data-name="fee_property_management"></td>
                            </tr>
                            <tr>
                                <td class="text-left td-first-child">{{__('attributes.simulation.content.operating_fee.recruitment_rental') }}</td>
                                <td class="text-center number-radius">
                                    <div class="number-border-radius fs12">15</div>
                                </td>
                                <td class="text-right pre-recruitment-rental" data-name="fee_recruitment_rental"></td>
                            </tr>
                            <tr>
                                <td class="text-left td-first-child">{{__('attributes.simulation.content.operating_fee.tax') }}</td>
                                <td class="text-center number-radius">
                                    <div class="number-border-radius fs12">16</div>
                                </td>
                                <td class="text-right pre-tax" data-name="tax"></td>
                            </tr>
                            <tr>
                                <td class="text-left td-first-child">{{__('attributes.simulation.content.operating_fee.damage_insurance') }}</td>
                                <td class="text-center number-radius">
                                    <div class="number-border-radius fs12">17</div>
                                </td>
                                <td class="text-right pre-damage-insurance" data-name="loss_insurance"></td>
                            </tr>
                            <tr>
                                <td class="text-left td-first-child">{{__('attributes.simulation.content.operating_fee.land_tax') }}</td>
                                <td class="text-center number-radius">
                                    <div class="number-border-radius fs12">18</div>
                                </td>
                                <td class="text-right pre-land-tax" data-name="land_tax"></td>
                            </tr>
                            <tr>
                                <td class="text-left td-first-child">{{__('attributes.simulation.content.operating_fee.other') }}</td>
                                <td class="text-center number-radius">
                                    <div class="number-border-radius fs12">19</div>
                                </td>
                                <td class="text-right pre-fee-other" data-name="other_fees"></td>
                            </tr>
                            <tr>
                                <td class="text-left td-first-child">{{__('attributes.simulation.content.operating_fee.sum') }}</td>
                                <td class="text-center number-radius">
                                    <div class="number-border-radius fs12">20</div>
                                </td>
                                <td class="text-right total-operating-fee" data-name="total_cost"></td>
                            </tr>
                            <tr>
                                <td class="border-right-0"></td>
                                <td class="text-left fw-bold p6 border-left-0">{{__('attributes.simulation.preview.operating_total') }}</td>
                                <td class="text-center number-radius">
                                    <div class="number-border-radius fs12">21</div>
                                </td>
                                <td class="text-right p6 pre-operating-total" data-name="operating_expenses"></td>
                            </tr>
                            <tr>
                                <td></td>
                            </tr>
                            <tr>
                                <td class="text-center fw-bold" colspan="2">{{__('attributes.simulation.content.net_income') }}</td>
                                <td class="text-center pre-net-income" colspan="2" data-name="net_income"></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div id="page-2" class="col-12 page-2 p0" >
            <div class="content-page">
                <div class="sub-title-review-simulation m15b">
                    <span class="fs15 fw-bold m15l">{{__('attributes.simulation.preview.title_2') }}</span>
                </div>
                <div class="row m-0 row-test">
                    <div class="col-6 p0">
                        <div class="chart-1">
                            <div class="title display-center">
                                <span class="fs15 fw-bold m15r">{{__('attributes.simulation.preview.title_chart_1') }}</span>
                                <span class="fs20 fw-bold synthetic-point">0</span>&nbsp;
                                <span class="fs15 fw-bold">points</span>
                            </div>
                            <div class="position-absolute fw-bold fs15 m15t m15l">SCOREMAP</div>
                            <div id="simulation-spiderweb-preview" class="content m20t"></div>
                        </div>
                    </div>
                </div>
                <div class="row m-0">
                    <div class="sub-title-review-simulation m15b m30t">
                        <span class="fs15 fw-bold m15l">{{__('attributes.simulation.preview.title_chart_2') }}</span>
                    </div>
                    <div class="col-12 p0 m100b">
                        <div class="chart-2">
                            <div class="parent-chart p20l p20r">
                                <div id="chart-simulation-preview" class="content"></div>
                            </div>
                            <div class="note fs10 m20t">
                                <span>{{__('attributes.simulation.preview.unit_1') }}<br>{{__('attributes.simulation.preview.unit_2') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
