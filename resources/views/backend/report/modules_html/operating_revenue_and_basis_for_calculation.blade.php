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
                            <p class="fs12 m0 p0 p10r">(円)</p>
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
                    <div class="col-3 col-12-sp p0 d-flex align-items-center">
                        <span class="d-inline-block fs14">{{ __('attributes.register_info.item_block.label.rent_income') }}<br>{{ __('attributes.register_info.item_block.label.rent_income_1') }}</span>
                    </div>
                    <div class="col-9 col-12-sp p0">
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
                                <span class="d-inline-block fs14">{{ trans('attributes.balance.preview.table_3.title_0') }}</span>
                            </div>
                            <div class="col-4 p0">
                                <div class="col-12 m15l p0">
                                    <input name="basis_for_calculation_0" class="disable-field form-control text-left fs14" id="basis_for_calculation_1" disabled
                                           value="{{ numberFormatWithUnit(basisCalculationBusinessPlan($annualPerformance['revenue_land_taxes'], number_format($property['ground_area'] * 0.3025, FLAG_TWO), FLAG_MAX_MONTH), ' ' . trans('attributes.common.unit-3')) }}">
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
                    <div class="col-3 col-12-sp p0 d-flex align-items-center">
                        <span class="d-inline-block fs14">{{ trans('attributes.balance.body.rent_income') }}</span>
                    </div>
                    <div class="col-9 col-12-sp p0">
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
                    <div class="col-3 col-12-sp p0 d-flex align-items-center">
                        <span class="d-inline-block fs14">{{ trans('attributes.balance.body.common_service_revenue') }}</span>
                    </div>
                    <div class="col-9 col-12-sp p0">
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
                    <div class="col-3 col-12-sp p0 d-flex align-items-center">
                        <span class="d-inline-block fs14">{{ trans('attributes.balance.body.utilities_expenses_revenue') }}</span>
                    </div>
                    <div class="col-9 col-12-sp p0">
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
                    <div class="col-3 col-12-sp p0 d-flex align-items-center">
                        <span class="d-inline-block fs14">{{ trans('attributes.balance.body.parking_revenue') }}</span>
                    </div>
                    <div class="col-9 col-12-sp p0">
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
                    <div class="col-3 col-12-sp p0 d-flex align-items-center">
                        <span class="d-inline-block fs14">{{ trans('attributes.balance.body.key_money_and_royalties') }}</span>
                    </div>
                    <div class="col-9 col-12-sp p0">
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
                    <div class="col-3 col-12-sp p0 d-flex align-items-center">
                        <span class="d-inline-block fs14">{{ trans('attributes.balance.body.renewal_fee_income') }}</span>
                    </div>
                    <div class="col-9 col-12-sp p0">
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
                    <div class="col-3 col-12-sp p0 d-flex align-items-center">
                        <span class="d-inline-block fs14">{{ trans('attributes.balance.body.other_income') }}</span>
                    </div>
                    <div class="col-9 col-12-sp p0">
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
                    <div class="col-3 col-12-sp p0 d-flex align-items-center">
                        <span class="d-inline-block fs14">{{ trans('attributes.balance.body.bad_debt_losses') }}</span>
                    </div>
                    <div class="col-9 col-12-sp p0">
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
                    <div class="col-3 col-12-sp p0 d-flex align-items-center">
                        <span class="d-inline-block fs14">{{ trans('attributes.balance.body.meter') }}</span>
                    </div>
                    <div class="col-9 col-12-sp p0">
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

