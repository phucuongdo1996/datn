<div class="m0 diagram-analysis col-12 p0">
    <div class="p30 m30t m30b diagram-block">
        <div class="m35b">
            <div class="col-11 p0l m0">
                <p class="fs16 fw-bold m0">{{ trans('attributes.simple_assessment.assessment_result') }}</p>
            </div>
        </div>

        <div class="row m-0 fs14">
            <div class="row col-12 col-xl-7 d-flex  p0l p0r">
                <div class="col-11 col-xl-8 p0l p0r">
                    <div class="col-11 d-flex m10b m0l">
                        <div class="col-12 p0l m5b">
                            <p class="fs16 fw-bold m0">{{ trans('attributes.borrowing.table.noi') }}</p>
                        </div>
                        <div class="p0l d-flex align-items-end justify-content-end">
                            <p class="fs12 m0">({{ trans('attributes.common.yen') }})</p>
                        </div>
                    </div>

                    <div class="d-flex">
                        <div class="col-11 div-grey text-right m0r p6 p15r p15l">
                            <p class="fs28 fw-bold m0" id="operating-expenses">{{ $property['operating_expenses'] ? number_format($property['operating_expenses']) . ' ' : "0 " }}</p>
                        </div>
                        <div class="unit-info p15l p7l-sp">
                            <span class="m0t">&divide;</span>
                        </div>
                    </div>
                </div>

                <div class="col-11 col-xl-4 p0r p10t-sp">
                    <div class="row m10b m0l">
                        <div class="m5b p0">
                            <p class="fs16 fw-bold m0">{{ trans('attributes.simple_assessment.cap_rate') }}</p>
                        </div>
                    </div>

                    <div class="d-flex">
                        <div class="w-100">
                            <input type="text" id="net-profit" name="net_profit"
                                   value="{{ old('net_profit') ?? (isset($simpleAssessment['net_profit']) ? number_format($simpleAssessment['net_profit'], FLAG_TWO) : '0.00') }}"
                                   class="form-control m0 p15 p15t p15b text-right h-auto fs15 inline convert-number-double-decimal @error('net_profit')input-error @enderror"/>
                            @error('net_profit')
                                <div class="error-message p5t m0 break-all">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="unit-info p15l p7l-sp">
                            <span class="m0t">{{ trans('attributes.common.percent') }}</span>
                        </div>
                        <div class="unit-info p15l p15r">
                            <span class="m0t">&efDot;</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-xl-4 p0l p0r">
                <div class="d-flex m10b m0l p10t-sp">
                    <div class="col-11 p0l m5b">
                        <p class="fs16 fw-bold m0">{{ trans('attributes.property.assessed_amount') }}</p>
                    </div>
                    <div class="col-1 p0l d-flex align-items-end justify-content-end">
                        <p class="fs12 m0">({{ trans('attributes.common.yen') }})</p>
                    </div>
                </div>
                <input type="text" id="amount-assessed-taxing" name="amount_assessed_taxing"
                       value="{{ old('amount_assessed_taxing') ?? (isset($simpleAssessment['amount_assessed_taxing']) ? number_format($simpleAssessment['amount_assessed_taxing']) : 0) }}"
                       class="form-control m0 p5 p15r p15l text-right h-auto fs28 fw-bold convert-data @error('amount_assessed_taxing')input-error @enderror"/>
                @error('amount_assessed_taxing')
                    <div class="error-message p5t m0 break-all">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>
</div>
