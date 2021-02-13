@extends('modal.preview.common_preview')
@section('title', __('attributes.tax.title') )
@section('content_preview')
    <div id="pre-print-confirm-final" class="background-print" style="display: block;">
        <div id="block-page">
            <div class="content-preview">
                <div class="page-preview-print m0t">
                    <div class="row m-0 m20b">
                        <div class="w-20 p0">
                            @if(in_array($currentUser->role, [BROKER, EXPERT]))
                                <table class="table table-bordered table-preview table-preview-analysis tb-pre-1 m-0 m30b w300">
                                    <tbody>
                                    <tr>
                                        <td class="w-55 fw-bold border-right-0">{{ trans('attributes.tax.property_owner') }}</td>
                                        <td class="break-all" id="content-property-owner">
                                            @if(isset($propertyOwner))
                                                {{ $propertyOwner->proprietor }}
                                            @endif
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            @endif
                        </div>
                        <div class="w-60 p0">
                            <div class="row modal-header border-0 centered m-0 p0">
                                <h5 class="modal-title m10r fs25 fw500 year-label"></h5>
                                <input class="w50 like-input op-building-floor-area-1 m20r p10l p10r date-of-year-label" type="text" disabled="">
                                <h5 class="modal-title fs25 fw500">{{ trans('attributes.tax.annual_income') }}</h5>
                            </div>
                        </div>

                        <div class="w-20 p0">
                            <div class="centered-vertical">
                                <div class="row m-0 ml-auto">
                                    <div class="centered-vertical m15r fs16">{{ trans('attributes.tax.for_real_estate_income') }}</div>
                                    <table class="table table-bordered table-preview table-preview-analysis tb-pre-1 w140 m-0">
                                        <tbody>
                                        <tr>
                                            <td class="text-center fs16 fw-normal">FA0223</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row m-0 m40b">
                        <div class="col-6 m0 p0">
                            <table class="table table-bordered table-preview table-preview-analysis tb-pre-1 m-0 m30b w300">
                                <tbody>
                                <tr>
                                    <td class="w-55 fw-bold">{{ trans('attributes.tax.fiscal_year') }}</td>
                                    <td class="date-time-format-tax"></td>
                                </tr>
                                </tbody>
                            </table>
                            <div class="fs12 fw-bold">{{ getDateAndTheLabel(date('Y'), 1) . ' ' . trans('attributes.common.year') }} {{ date('m') . ' ' . trans('attributes.common.month') }} {{ date('d') . ' ' . trans('attributes.common.day') }}</div>
                        </div>

                        <div class="col-6 m0 p0">
                            <div class="row m-0">
                                <table class="table table-bordered table-preview table-preview-analysis tb-pre-1 m-0 w-100">
                                    <tbody>
                                    <tr>
                                        <td class="w50 fs12 text-center fw-bold lh1" rowspan="3">{{ trans('attributes.tax.street_address') }}</td>
                                        <td class="fs12 lh1" rowspan="3">＊＊＊</td>
                                        <td class="w50 fs12 text-center fw-bold lh1" rowspan="3"><span class="fs10">{{ trans('attributes.tax.free') }}</span><br />{{ trans('attributes.tax.full_name1') }}</td>
                                        <td class="fs12 lh1" rowspan="3">＊＊＊</td>
                                        <td class="w20 fs10 text-center fw-bold vertical lh1" rowspan="6">{{ trans('attributes.tax.requested_tax_accountant') }}</td>
                                        <td class="w80 fs10 text-center fw-bold lh1" rowspan="2">{{ trans('attributes.tax.office_location') }}</td>
                                        <td class="fs12 lh1" rowspan="2">＊＊＊</td>
                                    </tr>
                                    <tr>
                                    </tr>
                                    <tr>
                                        <td class="w80 fs10 text-center fw-bold lh1" rowspan="2">{{ trans('attributes.tax.full_name') }}</td>
                                        <td class="fs12 lh1" rowspan="2">＊＊＊</td>
                                    </tr>
                                    <tr>
                                        <td class="fs12 text-center fw-bold lh1" rowspan="3">{{ trans('attributes.tax.profession') }}</td>
                                        <td class="fs12 lh1" rowspan="3">＊＊＊</td>
                                        <td class="fs12 text-center fw-bold lh1" rowspan="3">{{ trans('attributes.tax.phone') }}<br />{{ trans('attributes.tax.number') }}</td>
                                        <td class="fs12 lh1" rowspan="3">＊＊＊</td>
                                    </tr>
                                    <tr>
                                        <td class="w80 fs10 text-center fw-bold lh1" rowspan="2">{{ trans('attributes.tax.phone_number') }}</td>
                                        <td class="fs12 lh1" rowspan="2">＊＊＊</td>
                                    </tr>
                                    <tr>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="row m-0 m40b">
                        <div class="w-20 p0">
                        </div>

                        <div class="w-60 p0">
                            <div class="row modal-header border-0 centered m-0 p0">
                                <h5 class="modal-title m10r fs16 fw500">{{ trans('attributes.tax.profit_loss_statement') }}</h5>
                                <p class="m0 fs16">({{ trans('attributes.tax.self') }}</p>
                                <input class="w50 like-input op-building-floor-area-1 m5l m5r p10l p10r time-default" type="text" disabled="" value="">
                                <p class="m0 fs16">{{ trans('attributes.common.month') }}</p>
                                <input class="w50 like-input op-building-floor-area-1 m5l m5r p10l p10r" type="text" disabled="" value="1">
                                <p class="m0 fs16">{{ trans('attributes.common.day') }} 　{{ trans('attributes.tax.solstice') }}</p>
                                <input class="w50 like-input op-building-floor-area-1 m5l m5r p10l p10r month-preview" type="text" disabled="" value="">
                                <p class="m0 fs16">{{ trans('attributes.common.month') }}</p>
                                <input class="w50 like-input op-building-floor-area-1 m5l m5r p10l p10r day-of-month" type="text" disabled="" value="">
                                <p class="m0 fs16">{{ trans('attributes.common.day') }})</p>
                            </div>
                        </div>

                        <div class="w-20 p0">
                            <div class="row m-0 centered-vertical">
                                <table class="table table-bordered table-preview table-preview-analysis tb-pre-1 w140 m-0 ml-auto">
                                    <tbody>
                                    <tr>
                                        <td class="text-center fs12 fw-normal">＊＊＊＊＊＊＊＊</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="row m-0 m30b">
                        <div class="col-10 p0">
                            <div class="row m-0">
                                <table class="table table-bordered table-preview table-preview-analysis tb-pre-1 m-0">
                                    <tbody>
                                    <tr>
                                        <td class="text-center td-vertical" rowspan="5">{{ trans('attributes.tax.income') }}</td>
                                        <td colspan="2">{{ trans('attributes.simulation.preview.subjects') }}</td>
                                        <td class="text-right">{{ trans('attributes.tax.unit') }}</td>
                                        <td class="text-center td-vertical" rowspan="7">{{ trans('attributes.tax.necessary_expenses') }}</td>
                                        <td colspan="2">{{ trans('attributes.simulation.preview.subjects') }}</td>
                                        <td class="text-right">{{ trans('attributes.tax.unit') }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-left td-first-child">{{ trans('attributes.tax.rent') }}</td>
                                        <td class="text-center number-radius">
                                            <div class="number-border-radius">1</div>
                                        </td>
                                        <td class="w-20 text-right td-revenue-room-rentals td-total_rent"></td>
                                        <td class="text-left td-first-child">{{ trans('attributes.simulation.content.operating_fee.utilities') }}</td>
                                        <td class="text-center number-radius">
                                            <div class="number-border-radius">13</div>
                                        </td>
                                        <td class="w-20 text-right td-revenue-room-rentals td-total_utilities_fee"></td>
                                    </tr>
                                    <tr>
                                        <td class="text-left td-first-child">{{ trans('attributes.tax.key_money') }}</td>
                                        <td class="text-center number-radius">
                                            <div class="number-border-radius">2</div>
                                        </td>
                                        <td class="w-20 text-right td-revenue-room-rentals td-total_key_money"></td>
                                        <td class="text-left td-first-child">{{ trans('attributes.tax.management_fee') }}</td>
                                        <td class="text-center number-radius">
                                            <div class="number-border-radius">14</div>
                                        </td>
                                        <td class="w-20 text-right td-revenue-room-rentals td-total_asset_management_fee"></td>
                                    </tr>
                                    <tr>
                                        <td class="text-left td-first-child">{{ trans('attributes.balance.body.other_income') }}</td>
                                        <td class="text-center number-radius">
                                            <div class="number-border-radius">3</div>
                                        </td>
                                        <td class="w-20 text-right td-revenue-room-rentals td-total_other_income"></td>
                                        <td class="text-left td-first-child">{{ trans('attributes.tax.commission_paid') }}</td>
                                        <td class="text-center number-radius">
                                            <div class="number-border-radius">15</div>
                                        </td>
                                        <td class="w-20 text-right td-revenue-room-rentals td-total_tenant_recruitment_fee"></td>
                                    </tr>
                                    <tr>
                                        <td class="text-left td-first-child">{{ trans('attributes.balance.body.meter') }}</td>
                                        <td class="text-center number-radius">
                                            <div class="number-border-radius">4</div>
                                        </td>
                                        <td id="td-item4" class="w-20 text-right td-revenue-room-rentals td-total_income"></td>
                                        <td class="text-left td-first-child">{{ trans('attributes.tax.bad_debt_losses') }}</td>
                                        <td class="text-center number-radius">
                                            <div class="number-border-radius">16</div>
                                        </td>
                                        <td class="w-20 text-right td-revenue-room-rentals td-total_bad_debt_losses"></td>
                                    </tr>
                                    <tr>
                                        <td class="text-center td-vertical" rowspan="8">{{ trans('attributes.tax.necessary_expenses') }}</td>
                                        <td class="text-left td-first-child">{{ trans('attributes.tax.taxes_dues') }}</td>
                                        <td class="text-center number-radius">
                                            <div class="number-border-radius">5</div>
                                        </td>
                                        <td class="w-20 text-right td-revenue-room-rentals td-total_taxes_dues"></td>
                                        <td class="text-left td-first-child">{{ trans('attributes.tax.other_expenses') }}</td>
                                        <td class="text-center number-radius">
                                            <div class="number-border-radius">17</div>
                                        </td>
                                        <td class="w-20 text-right td-revenue-room-rentals td-other_expenses"></td>
                                    </tr>
                                    <tr>
                                        <td class="text-left td-first-child">{{ trans('attributes.simulation.content.operating_fee.damage_insurance') }}</td>
                                        <td class="text-center number-radius">
                                            <div class="number-border-radius">6</div>
                                        </td>
                                        <td class="w-20 text-right td-revenue-room-rentals td-total_insurance_premium"></td>
                                        <td class="text-left td-first-child">{{ trans('attributes.balance.body.meter') }}</td>
                                        <td class="text-center number-radius">
                                            <div class="number-border-radius">18</div>
                                        </td>
                                        <td id="td-item18" class="w-20 text-right td-revenue-room-rentals td-total_required_expenses"></td>
                                    </tr>
                                    <tr>
                                        <td class="text-left td-first-child">{{ trans('attributes.balance.body.repair_fee') }}</td>
                                        <td class="text-center number-radius">
                                            <div class="number-border-radius">7</div>
                                        </td>
                                        <td class="w-20 text-right td-revenue-room-rentals td-total_repair_costs"></td>
                                        <td class="text-left td-first-child" colspan="2">
                                            <div class="row m-0">
                                                <div class="col-6 p0">{{ trans('attributes.tax.balance') }}</div>
                                                <div class="col-6 p0 fw-normal text-red">(4) - (18)</div>
                                            </div>
                                        </td>
                                        <td class="text-center number-radius">
                                            <div class="number-border-radius">19</div>
                                        </td>
                                        <td id="td-item19" class="w-20 text-right td-revenue-room-rentals td-balance"></td>
                                    </tr>
                                    <tr>
                                        <td class="text-left td-first-child">{{ trans('attributes.tax.depreciation') }}</td>
                                        <td class="text-center number-radius">
                                            <div class="number-border-radius">8</div>
                                        </td>
                                        <td class="w-20 text-right td-revenue-room-rentals td-depreciation"></td>
                                        <td class="text-left td-first-child" colspan="2">{{ trans('attributes.tax.full_time_salary') }}</td>
                                        <td class="text-center number-radius">
                                            <div class="number-border-radius">20</div>
                                        </td>
                                        <td class="w-20 text-right td-revenue-room-rentals">＊＊＊</td>
                                    </tr>
                                    <tr>
                                        <td class="text-left td-first-child">{{ trans('attributes.tax.borrowing_interest') }}</td>
                                        <td class="text-center number-radius">
                                            <div class="number-border-radius">9</div>
                                        </td>
                                        <td class="w-20 text-right td-revenue-room-rentals td-borrowing_interest"></td>
                                        <td class="text-left td-first-child" colspan="2">
                                            <div class="row m-0">
                                                <div class="col-6 p0 lh1">{{ trans('attributes.tax.income_amount') }}<br />{{ trans('attributes.tax.before_blue_tax') }}</div>
                                                <div class="col-6 centered-vertical p0 fw-normal text-red">(19) - (20)</div>
                                            </div>
                                        </td>
                                        <td class="text-center number-radius">
                                            <div class="number-border-radius">21</div>
                                        </td>
                                        <td class="w-20 text-right td-revenue-room-rentals">＊＊＊</td>
                                    </tr>
                                    <tr>
                                        <td class="text-left td-first-child">{{ trans('attributes.simulation.content.operating_fee.land_tax') }}</td>
                                        <td class="text-center number-radius">
                                            <div class="number-border-radius">10</div>
                                        </td>
                                        <td class="w-20 text-right td-revenue-room-rentals td-total_land_tax"></td>
                                        <td class="text-left td-first-child" colspan="2">
                                            <div class="row m-0">
                                                <div class="col-6 p0 lh1">{{ trans('attributes.tax.tax_return') }}<br />{{ trans('attributes.tax.special_deduction') }}</div>
                                                <div class="col-6 centered-vertical p0 fs10 lh1 text-red">{{ trans('attributes.tax.yen_between1') }}<br />{{ trans('attributes.tax.yen_between2') }}</div>
                                            </div>
                                        </td>
                                        <td class="text-center number-radius">
                                            <div class="number-border-radius">22</div>
                                        </td>
                                        <td class="w-20 text-right td-revenue-room-rentals">＊＊＊</td>
                                    </tr>
                                    <tr>
                                        <td class="text-left td-first-child">{{ trans('attributes.tax.salary_wage') }}</td>
                                        <td class="text-center number-radius">
                                            <div class="number-border-radius">11</div>
                                        </td>
                                        <td class="w-20 text-right td-revenue-room-rentals td-salary_wage"></td>
                                        <td class="text-left td-first-child" colspan="2">
                                            <div class="row m-0">
                                                <div class="col-6 p0 centered-vertical lh1">{{ trans('attributes.tax.income_amount3') }}</div>
                                                <div class="col-6 centered-vertical p0 fw-normal text-red">(21) - (22)</div>
                                            </div>
                                        </td>
                                        <td class="text-center number-radius">
                                            <div class="number-border-radius">23</div>
                                        </td>
                                        <td class="w-20 text-right td-revenue-room-rentals">＊＊＊</td>
                                    </tr>
                                    <tr>
                                        <td class="text-left td-first-child">{{ trans('attributes.tax.building_management_fee') }}</td>
                                        <td class="text-center number-radius">
                                            <div class="number-border-radius">12</div>
                                        </td>
                                        <td class="w-20 text-right td-revenue-room-rentals td-total_management_fee"></td>
                                        <td class="text-left td-first-child lh1" colspan="3">{{ trans('attributes.tax.interest_debt') }}<br />{{ trans('attributes.tax.required_acquire') }}</td>
                                        <td class="w-20 text-right td-revenue-room-rentals">＊＊＊</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="col-2 p0 p30l relative">
                            <table class="table table-preview table-preview-analysis tb-pre-1 m-0">
                                <tbody>
                                <tr>
                                    <td class="text-center fs12 fw-normal"></td>
                                    <td class="text-center fs12 fw-normal" colspan="2">＊＊＊＊＊＊＊＊</td>
                                </tr>
                                <tr>
                                    <td class="text-center fs12 fw-normal"></td>
                                    <td class="text-center fs12 fw-normal">＊</td>
                                    <td class="border-0 w-70"></td>
                                </tr>
                                </tbody>
                            </table>

                            <div class="absolute-bottom">
                                <div class="description-border m20b">
                                    <p class="m0 fs10">{{ trans('attributes.tax.description1') }}</p>
                                </div>
                                <div>
                                    <p class="description-border m0 fs10">{{ trans('attributes.tax.description2') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
{{--                    <div class="row col-12 m-0 p0">--}}
{{--                        <div class="text-left border-0 p0 centered-vertical copy-right-preview">--}}
{{--                            <span class="fs10">&copy;</span>--}}
{{--                            <span class="fs10">&nbsp;{{ trans('attributes.common.copy-right') }}</span>--}}
{{--                        </div>--}}

{{--                        <div class="ml-auto">--}}
{{--                            <span class="fs10 fw-bold">1</span>--}}
{{--                        </div>--}}
{{--                    </div>--}}
                    <div>
                        <h5 class="fw-bold">{{ trans('attributes.tax.property_checked') }}</h5>
                        <div class="content-property">
                            @if(isset($propertyChecked))
                                @include('backend.preview_print.property-tax-preview', ['data' => $propertyChecked])
                            @endif
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection
