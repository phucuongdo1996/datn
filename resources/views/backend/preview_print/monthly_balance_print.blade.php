@extends('modal.preview.common_preview')
@section('title', trans('attributes.monthly_balance.house_name').$property->house_name )
@section('content_preview')
<div id="pre-print-monthly-balance" class="background-print">
    <div id="block-page" class="container p0 m0">
        <div class="content-preview">
            <div class="page-preview-print m0t">
                <div class="modal-header centered-vertical border-0 p0"></div>

                <div class="row m-0 m10b">
                    <div class="col-2 p0 p10r">
                        <table class="table table-bordered table-preview table-preview-analysis tb-pre-1 m-0">
                            <tbody>
                                <tr>
                                    <td class="w135 text-center fw-bold">{{ trans('attributes.rent_roll_list.year') }}</td>
                                    <td class="text-center pre-year"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="col-1 p0 p10r">
                        <table class="table table-bordered table-preview table-preview-analysis tb-pre-1 m-0">
                            <tbody>
                            <tr>
                                <td class="text-center">12 {{ trans('attributes.common.lunar_month') }}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="col-2 p0 p10r">
                        <table class="table table-bordered table-preview table-preview-analysis tb-pre-1 m-0">
                            <tbody>
                                <tr>
                                    <td class="text-center">{{ trans('attributes.monthly_balance.first_month') }}
                                        {{(int)$property['date_month_registration_revenue'] == DEC ?
                                        JAN . trans('attributes.common.month') . trans('attributes.common.end_of_period') . DEC . trans('attributes.common.month') :
                                        (int)$property['date_month_registration_revenue'] + FLAG_ONE . trans('attributes.common.month') . trans('attributes.common.end_of_period') .
                                        (int)$property['date_month_registration_revenue'] . trans('attributes.common.month') }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="col-2 p10r">
                        <table class="table table-bordered table-preview table-preview-analysis tb-pre-2 m-0">
                            <tbody>
                                <tr>
                                    <td class="w135 text-center fw-bold">{{ trans('attributes.property.status') }}</td>
                                    <td class="text-center">{{ STATUS_HOUSE_SIMPLE[$property->status] }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    @if ($currentUser->role != INVESTOR)
                    <div class="col-3 p0">
                        <table class="table table-bordered table-preview table-preview-analysis tb-pre-2 m-0">
                            <tbody>
                            <tr>
                                <td class="w135 text-center fw-bold">{{ trans('attributes.repair_history.owner') }}</td>
                                <td class="text-center">{{ $property->proprietor ?? '' }}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    @endif
                </div>

                <div class="row m-0 m30b">
                    <div class="col-12 p0">
                        <table class="table table-bordered table-preview table-preview-analysis tb-pre-1 table-data m-0">
                            <tbody>
                                <tr>
                                    <td colspan="3">
                                        <div class="row m-0">
                                            <div class="ml-auto fs12"></div>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="row m-0">
                                            <div class="ml-auto fw-bold">{{ trans('attributes.monthly_balance.annual_total') }}</div>
                                            <div class="ml-auto fs12">({{ trans('attributes.common.yen') }})</div>
                                        </div>
                                    </td>
                                    @foreach(setArrayDateMonth((int)$property['date_month_registration_revenue']) as $key => $month)
                                    <td class="text-center">
                                        <div class="row m-0">
                                            <div class="ml-auto fw-bold">{{ $month }}{{ trans('attributes.common.month') }}</div>
                                            <div class="ml-auto fs12">({{ trans('attributes.common.yen') }})</div>
                                        </div>
                                    </td>
                                    @endforeach
                                </tr>
                                @if($showInput0)
                                <tr>
                                    <td class="fw-bold td-vertical" rowspan="10">{{ trans('attributes.register_info.item_block.title.operating_revenue') }}</td>
                                    <td>{{ trans('attributes.register_info.item_block.label.rent_income')}}<br>{{trans('attributes.register_info.item_block.label.rent_income_1') }}</td>
                                    <td class="text-center number-radius"><div class="number-border-radius">0</div></td>
                                    <td class="text-right">{{ number_format($total['revenue_land_taxes']) }}</td>
                                    @foreach(setArrayDateMonth((int)$property['date_month_registration_revenue']) as $key => $month)
                                        <td class="text-right">{{ number_format($dataPreview['revenue_land_taxes'][$month - FLAG_ONE]) }}</td>
                                    @endforeach
                                </tr>
                                @endif
                                <tr>
                                    @if(!$showInput0)
                                    <td class="fw-bold td-vertical" rowspan="9">{{ trans('attributes.register_info.item_block.title.operating_revenue') }}</td>
                                    @endif
                                    <td>{{ trans('attributes.register_info.item_block.label.rent_income_2') }}</td>
                                    <td class="text-center number-radius w35"><div class="number-border-radius">1</div></td>
                                    <td class="text-right">{{ number_format($total['revenue_room_rentals']) }}</td>
                                    @foreach(setArrayDateMonth((int)$property['date_month_registration_revenue']) as $key => $month)
                                    <td class="text-right">{{ number_format($dataPreview['revenue_room_rentals'][$month - FLAG_ONE]) }}</td>
                                    @endforeach
                                </tr>

                                <tr>
                                    <td>{{ trans('attributes.register_info.item_block.label.service_revenue') }}</td>
                                    <td class="text-center number-radius w35"><div class="number-border-radius">2</div></td>
                                    <td class="text-right">{{ number_format($total['revenue_service_charges']) }}</td>
                                    @foreach(setArrayDateMonth((int)$property['date_month_registration_revenue']) as $key => $month)
                                        <td class="text-right">{{ number_format($dataPreview['revenue_service_charges'][$month - FLAG_ONE]) }}</td>
                                    @endforeach
                                </tr>
                                <tr>
                                    <td>{{ trans('attributes.register_info.item_block.label.utilities_revenue') }}</td>
                                    <td class="text-center number-radius w35"><div class="number-border-radius">3</div></td>
                                    <td class="text-right">{{ number_format($total['revenue_utilities']) }}</td>
                                    @foreach(setArrayDateMonth((int)$property['date_month_registration_revenue']) as $key => $month)
                                        <td class="text-right">{{ number_format($dataPreview['revenue_utilities'][$month - FLAG_ONE]) }}</td>
                                    @endforeach
                                </tr>
                                <tr>
                                    <td>{{ trans('attributes.register_info.item_block.label.parking_lot_revenue') }}</td>
                                    <td class="text-center number-radius w35"><div class="number-border-radius">4</div></td>
                                    <td class="text-right">{{ number_format($total['revenue_car_deposits']) }}</td>
                                    @foreach(setArrayDateMonth((int)$property['date_month_registration_revenue']) as $key => $month)
                                        <td class="text-right">{{ number_format($dataPreview['revenue_car_deposits'][$month - FLAG_ONE]) }}</td>
                                    @endforeach
                                </tr>
                                <tr>
                                    <td>{{ trans('attributes.register_info.item_block.label.key_money_royalties') }}</td>
                                    <td class="text-center number-radius w35"><div class="number-border-radius">5</div></td>
                                    <td class="text-right">{{ number_format($total['turnover_revenue']) }}</td>
                                    @foreach(setArrayDateMonth((int)$property['date_month_registration_revenue']) as $key => $month)
                                        <td class="text-right">{{ number_format($dataPreview['turnover_revenue'][$month - FLAG_ONE]) }}</td>
                                    @endforeach
                                </tr>
                                <tr>
                                    <td>{{ trans('attributes.register_info.item_block.label.renewal_fee') }}</td>
                                    <td class="text-center number-radius w35"><div class="number-border-radius">6</div></td>
                                    <td class="text-right">{{ number_format($total['revenue_contract_update_fee']) }}</td>
                                    @foreach(setArrayDateMonth((int)$property['date_month_registration_revenue']) as $key => $month)
                                        <td class="text-right">{{ number_format($dataPreview['revenue_contract_update_fee'][$month - FLAG_ONE]) }}</td>
                                    @endforeach
                                </tr>
                                <tr>
                                    <td>{{ trans('attributes.register_info.item_block.label.other_income') }}</td>
                                    <td class="text-center number-radius w35"><div class="number-border-radius">7</div></td>
                                    <td class="text-right">{{ number_format($total['revenue_other']) }}</td>
                                    @foreach(setArrayDateMonth((int)$property['date_month_registration_revenue']) as $key => $month)
                                        <td class="text-right">{{ number_format($dataPreview['revenue_other'][$month - FLAG_ONE]) }}</td>
                                    @endforeach
                                </tr>
                                <tr>
                                    <td>{{ trans('attributes.register_info.item_block.label.etc') }}</td>
                                    <td class="text-center number-radius w35"><div class="number-border-radius">8</div></td>
                                    <td class="text-right">{{ number_format($total['bad_debt']) }}</td>
                                    @foreach(setArrayDateMonth((int)$property['date_month_registration_revenue']) as $key => $month)
                                        <td class="text-right">{{ number_format($dataPreview['bad_debt'][$month - FLAG_ONE]) }}</td>
                                    @endforeach
                                </tr>
                                <tr>
                                    <td>{{ trans('attributes.register_info.item_block.label.meter') }}</td>
                                    <td class="text-center number-radius w35"><div class="number-border-radius">9</div></td>
                                    <td class="text-right">{{ number_format($total['total_operating_revenue']) }}</td>
                                    @foreach(setArrayDateMonth((int)$property['date_month_registration_revenue']) as $key => $month)
                                        <td class="text-right">{{ number_format($dataPreview['total_operating_revenue'][$month - FLAG_ONE]) }}</td>
                                    @endforeach
                                </tr>
                                <tr>
                                    <td class="fw-bold td-vertical" rowspan="11">{{ trans('attributes.register_info.item_block.title.operating_cost') }}</td>
                                    <td>{{ trans('attributes.register_info.item_block.label.management_fee') }}</td>
                                    <td class="text-center number-radius w35"><div class="number-border-radius">10</div></td>
                                    <td class="text-right">{{ number_format($total['maintenance_management_fee']) }}</td>
                                    @foreach(setArrayDateMonth((int)$property['date_month_registration_revenue']) as $key => $month)
                                        <td class="text-right">{{ number_format($dataPreview['maintenance_management_fee'][$month - FLAG_ONE]) }}</td>
                                    @endforeach
                                </tr>
                                <tr>
                                    <td>{{ trans('attributes.register_info.item_block.label.utilities_expenses') }}</td>
                                    <td class="text-center number-radius w35"><div class="number-border-radius">11</div></td>
                                    <td class="text-right">{{ number_format($total['electricity_gas_charges']) }}</td>
                                    @foreach(setArrayDateMonth((int)$property['date_month_registration_revenue']) as $key => $month)
                                        <td class="text-right">{{ number_format($dataPreview['electricity_gas_charges'][$month - FLAG_ONE]) }}</td>
                                    @endforeach
                                </tr>
                                <tr>
                                    <td>{{ trans('attributes.register_info.item_block.label.repair_fee') }}</td>
                                    <td class="text-center number-radius w35"><div class="number-border-radius">12</div></td>
                                    <td class="text-right">{{ number_format($total['repair_fee']) }}</td>
                                    @foreach(setArrayDateMonth((int)$property['date_month_registration_revenue']) as $key => $month)
                                        <td class="text-right">{{ number_format($dataPreview['repair_fee'][$month - FLAG_ONE]) }}</td>
                                    @endforeach
                                </tr>
                                <tr>
                                    <td>{{ trans('attributes.register_info.item_block.label.intact_reply_fee') }}</td>
                                    <td class="text-center number-radius w35"><div class="number-border-radius">13</div></td>
                                    <td class="text-right">{{ number_format($total['recovery_costs']) }}</td>
                                    @foreach(setArrayDateMonth((int)$property['date_month_registration_revenue']) as $key => $month)
                                        <td class="text-right">{{ number_format($dataPreview['recovery_costs'][$month - FLAG_ONE]) }}</td>
                                    @endforeach
                                </tr>
                                <tr>
                                    <td>{{ trans('attributes.balance.body.property') }}<br>{{ trans('attributes.balance.body.management_fee') }}</td>
                                    <td class="text-center number-radius w35"><div class="number-border-radius">14</div></td>
                                    <td class="text-right">{{ number_format($total['property_management_fee']) }}</td>
                                    @foreach(setArrayDateMonth((int)$property['date_month_registration_revenue']) as $key => $month)
                                        <td class="text-right">{{ $dataPreview['property_management_fee'][$month - FLAG_ONE] }}</td>
                                    @endforeach
                                </tr>
                                <tr>
                                    <td>{{ trans('attributes.register_info.item_block.label.tenant_recruitment_fee') }}</td>
                                    <td class="text-center number-radius w35"><div class="number-border-radius">15</div></td>
                                    <td class="text-right">{{ number_format($total['find_tenant_fee']) }}</td>
                                    @foreach(setArrayDateMonth((int)$property['date_month_registration_revenue']) as $key => $month)
                                        <td class="text-right">{{ number_format($dataPreview['find_tenant_fee'][$month - FLAG_ONE]) }}</td>
                                    @endforeach
                                </tr>
                                <tr>
                                    <td>{{ trans('attributes.register_info.item_block.label.taxes_dues') }}</td>
                                    <td class="text-center number-radius w35"><div class="number-border-radius">16</div></td>
                                    <td class="text-right">{{ number_format($total['tax']) }}</td>
                                    @foreach(setArrayDateMonth((int)$property['date_month_registration_revenue']) as $key => $month)
                                        <td class="text-right">{{ number_format($dataPreview['tax'][$month - FLAG_ONE]) }}</td>
                                    @endforeach
                                </tr>
                                <tr>
                                    <td>{{ trans('attributes.register_info.item_block.label.insurance_premium') }}</td>
                                    <td class="text-center number-radius w35"><div class="number-border-radius">17</div></td>
                                    <td class="text-right">{{ number_format($total['loss_insurance']) }}</td>
                                    @foreach(setArrayDateMonth((int)$property['date_month_registration_revenue']) as $key => $month)
                                        <td class="text-right">{{ number_format($dataPreview['loss_insurance'][$month - FLAG_ONE]) }}</td>
                                    @endforeach
                                </tr>
                                <tr>
                                    <td>{{ trans('attributes.register_info.item_block.label.land_payment') }}</td>
                                    <td class="text-center number-radius w35"><div class="number-border-radius">18</div></td>
                                    <td class="text-right">{{ number_format($total['land_rental_fee']) }}</td>
                                    @foreach(setArrayDateMonth((int)$property['date_month_registration_revenue']) as $key => $month)
                                        <td class="text-right">{{ number_format($dataPreview['land_rental_fee'][$month - FLAG_ONE]) }}</td>
                                    @endforeach
                                </tr>
                                <tr>
                                    <td>{{ trans('attributes.register_info.item_block.label.other_expenses') }}</td>
                                    <td class="text-center number-radius w35"><div class="number-border-radius">19</div></td>
                                    <td class="text-right">{{ number_format($total['other_costs']) }}</td>
                                    @foreach(setArrayDateMonth((int)$property['date_month_registration_revenue']) as $key => $month)
                                        <td class="text-right">{{ number_format($dataPreview['other_costs'][$month - FLAG_ONE]) }}</td>
                                    @endforeach
                                </tr>
                                <tr>
                                    <td>{{ trans('attributes.register_info.item_block.label.meter') }}</td>
                                    <td class="text-center number-radius w35"><div class="number-border-radius">20</div></td>
                                    <td class="text-right">{{ number_format($total['total_operating_costs']) }}</td>
                                    @foreach(setArrayDateMonth((int)$property['date_month_registration_revenue']) as $key => $month)
                                        <td class="text-right">{{ number_format($dataPreview['total_operating_costs'][$month - FLAG_ONE]) }}</td>
                                    @endforeach
                                </tr>
                                <tr>
                                    <td colspan="2">{{ trans('attributes.monthly_balance.preview.total') }}</td>
                                    <td class="text-center number-radius w35"><div class="number-border-radius">21</div></td>
                                    <td class="text-right">{{ number_format($total['operating_expenses']) }}</td>
                                    @foreach(setArrayDateMonth((int)$property['date_month_registration_revenue']) as $key => $month)
                                        <td class="text-right">{{ number_format($dataPreview['operating_expenses'][$month - FLAG_ONE]) }}</td>
                                    @endforeach
                                </tr>
                                <tr>
                                    <td colspan="3">{{ trans('attributes.register_info.item_block.label.crop_yield') }}</td>
                                    <td class="text-right" id="pre-rental-percentage"></td>
                                    @foreach(setArrayDateMonth((int)$property['date_month_registration_revenue']) as $key => $month)
                                        <td class="text-right">{{ number_format($dataPreview['rental_percentage'][$month - FLAG_ONE], FLAG_ONE) }} {{trans('attributes.common.percent')}}</td>
                                    @endforeach
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div id="container-preview" class="container-preview m0 diagram-analysis">
                        <div id="pre-container-chart-monthly" class="p30"></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
