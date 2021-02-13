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
                            <p class="fs12 m0 p0 p10r">({{ trans('attributes.common.yen') }})</p>
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
                    <div class="col-3 col-12-sp p0 d-flex align-items-center">
                        <span class="d-inline-block fs14">{{ trans('attributes.balance.body.maintenance_management_fee') }}</span>
                    </div>
                    <div class="col-9 col-12-sp p0">
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
                    <div class="col-3 col-12-sp p0 d-flex align-items-center">
                        <span class="d-inline-block fs14">{{ trans('attributes.balance.body.utilities_expenses') }}</span>
                    </div>
                    <div class="col-9 col-12-sp p0">
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
                    <div class="col-3 col-12-sp p0 d-flex align-items-center">
                        <span class="d-inline-block fs14">{{ trans('attributes.simulation.content.operating_fee.repair') }}</span>
                    </div>
                    <div class="col-9 col-12-sp p0">
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
                    <div class="col-3 col-12-sp p0 d-flex align-items-center">
                        <span class="d-inline-block fs14">{{ trans('attributes.balance.body.intact_reply_fee') }}</span>
                    </div>
                    <div class="col-9 col-12-sp p0">
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
                    <div class="col-3 col-12-sp p0 d-flex align-items-center">
                        <span class="d-inline-block fs14">{{ trans('attributes.balance.body.property') }}<br class="spH" />{{ trans('attributes.balance.body.management_fee') }}</span>
                    </div>
                    <div class="col-9 col-12-sp p0">
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
                    <div class="col-3 col-12-sp p0 d-flex align-items-center">
                        <span class="d-inline-block fs14">{{ trans('attributes.balance.body.tenant_recruitment_costs') }}</span>
                    </div>
                    <div class="col-9 col-12-sp p0">
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
                    <div class="col-3 col-12-sp p0 d-flex align-items-center">
                        <span class="d-inline-block fs14">{{ trans('attributes.balance.body.taxes_and_dues') }}</span>
                    </div>
                    <div class="col-9 col-12-sp p0">
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
                    <div class="col-3 col-12-sp p0 d-flex align-items-center">
                        <span class="d-inline-block fs14">{{ trans('attributes.balance.body.non-life_insurance_premiums') }}</span>
                    </div>
                    <div class="col-9 col-12-sp p0">
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
                    <div class="col-3 col-12-sp p0 d-flex align-items-center">
                        <span class="d-inline-block fs14">{{ trans('attributes.single_analysis.rent') }}</span>
                    </div>
                    <div class="col-9 col-12-sp p0">
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
                    <div class="col-3 col-12-sp p0 d-flex align-items-center">
                        <span class="d-inline-block fs14">{{ trans('attributes.balance.body.other_expenses') }}</span>
                    </div>
                    <div class="col-9 col-12-sp p0">
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
                                           value="{{ calculationPercentBusinessPlan($annualPerformance['other_fee'], $property['total_revenue']) . ' ' . trans('attributes.common.percent') }}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row m0 m10b">
                <div class="col-6 row align-items-center m0 p0 p20r">
                    <div class="col-3 col-12-sp p0 d-flex align-items-center">
                        <span class="d-inline-block fs14">{{ trans('attributes.balance.body.meter') }}</span>
                    </div>
                    <div class="col-9 col-12-sp p0">
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
                            <div class=" p0 d-flex align-items-center m15l m55r">
                                <span class="d-inline-block fs14">{{ trans('attributes.property.cost_ratio') }}</span>
                            </div>
                            <div class="col-4 p0">
                                <div class="col-12 m15l p0">
                                    <input name="basis_for_calculation_20" class="disable-field form-control text-left fs14" id="basis_for_calculation_20" disabled
                                           value="{{ number_format(divisionNumber($annualPerformance['sum_fee'], $property['total_revenue']) * 100, FLAG_TWO) . ' ' . trans('attributes.common.percent') }}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
