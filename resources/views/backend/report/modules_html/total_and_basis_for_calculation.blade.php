<div class="m0 m30b diagram-analysis">
    <div class="row m0 p30 m25b diagram-block">
        <div class="col-12 m0 p0">
            <div class="row m0 m10b">
                <div class="col-6 row align-items-center m0 p0 p20r">
                    <div class="col-3 col-12-sp p0 d-flex align-items-center">
                        <span class="d-flex flex-wrap fs14">{{ trans('attributes.balance.body.operating_balance') }}(<span class="number-li m5l m5r">9</span>-<span class="number-li m5l m5r">20</span>)</span>
                    </div>
                    <div class="col-9 col-12-sp p0">
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
                                           value="{{ numberFormatWithUnit(basisCalculationBusinessPlan($annualPerformance['sum_difference'], $property['total_area_floors']), ' ' . trans('attributes.common.unit-4')) }}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
