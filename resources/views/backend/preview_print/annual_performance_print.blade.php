@extends('modal.preview.common_preview')
@section('title', '年度実績表 - '.$property['house_name'] )
@section('content_preview')
<div id="pre-print-annual-performance" class="background-print">
    <div id="block-page" class="container p0">
        <div class="content-preview">
            <div class="page-preview-print m0t">
                <div class="modal-header centered-vertical border-0 p0"></div>
                <div class="row m-0 m10b">
                    <div class="col-2 m10r p0">
                        <table class="table table-bordered table-preview table-preview-analysis tb-pre-2 m-0">
                            <tbody>
                                <tr>
                                    <td class="w135 text-center fw-bold">{{ trans('attributes.property.status') }}</td>
                                    <td class="text-center">{{ $property['status'] ? STATUS_HOUSE[$property['status']] : '' }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    @if ($currentUser->role != INVESTOR)
                    <div class="col-4 m10r p0">
                        <table class="table table-bordered table-preview table-preview-analysis tb-pre-2 m-0">
                            <tbody>
                                <tr>
                                    <td class="w135 text-center fw-bold">{{ trans('attributes.repair_history.owner') }}</td>
                                    <td class="text-center">{{$property['proprietor'] ?? ''}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    @endif

                    <div class="col-2 m10r p0">
                        <table class="table table-bordered table-preview table-preview-analysis tb-pre-2 m-0">
                                <tbody>
                                <tr>
                                    <td class="text-center">{{ trans('attributes.monthly_balance.first_month').$timeLine['month_start'].trans('attributes.common.month').'〜'.trans('attributes.common.period') . $timeLine['month_end'].trans('attributes.common.month')}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="row m-0 page-1-pre">
                    <div class="w-auto p0">
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
                                        <div class="ml-auto fw-bold">{{$dataLatestYear->year}}{{ __('attributes.rent_roll_list.year') }}</div>
                                        <div class="ml-auto fs12">({{ trans('attributes.common.yen') }})</div>
                                    </div>
                                 </td>
                                @foreach($dataPreview['year'] as $value)
                                <td class="text-center">
                                    <div class="row m-0">
                                        <div class="ml-auto fw-bold">{{$value}}{{ __('attributes.rent_roll_list.year') }}</div>
                                        <div class="ml-auto fs12">({{ trans('attributes.common.yen') }})</div>
                                    </div>
                                </td>
                                @endforeach
                            </tr>
                            <input type="text" class="d-none total-records" value="{{ count($dataPreview['year']) +1 }}">
                            @if($showInput0)
                                <tr>
                                    <td class="fw-bold td-vertical" rowspan="10">{{ trans('attributes.register_info.item_block.title.operating_revenue') }}</td>
                                    <td>{{ __('attributes.register_info.item_block.label.rent_income') }} {{ __('attributes.register_info.item_block.label.rent_income_1') }}</td>
                                    <td class="text-center number-radius"><div class="number-border-radius">0</div></td>
                                    <td class="text-right">{{number_format($dataLatestYear->revenue_land_taxes)}}</td>
                                    @foreach($dataPreview['revenue_land_taxes'] as $value)
                                        <td class="text-right">{{number_format($value)}}</td>
                                    @endforeach
                                </tr>

                                <tr>
                                    <td>{{ trans('attributes.register_info.item_block.label.rent_income_2') }}</td>
                                    <td class="text-center number-radius"><div class="number-border-radius">1</div></td>
                                    <td class="text-right">{{number_format($dataLatestYear->rent_income)}}</td>
                                    @foreach($dataPreview['rent_income'] as $value)
                                        <td class="text-right">{{number_format($value)}}</td>
                                    @endforeach
                                </tr>
                            @else
                                <tr>
                                    <td class="fw-bold td-vertical" rowspan="9">{{ trans('attributes.register_info.item_block.title.operating_revenue') }}</td>
                                    <td>{{ trans('attributes.register_info.item_block.label.rent_income_2') }}</td>
                                    <td class="text-center number-radius"><div class="number-border-radius">1</div></td>
                                    <td class="text-right">{{number_format($dataLatestYear->rent_income)}}</td>
                                    @foreach($dataPreview['rent_income'] as $value)
                                    <td class="text-right">{{number_format($value)}}</td>
                                    @endforeach
                                </tr>
                            @endif

                            <tr>
                                <td>{{ trans('attributes.register_info.item_block.label.service_revenue') }}</td>
                                <td class="text-center number-radius"><div class="number-border-radius">2</div></td>
                                <td class="text-right">{{number_format($dataLatestYear->general_services)}}</td>
                                @foreach($dataPreview['general_services'] as $value)
                                <td class="text-right">{{number_format($value)}}</td>
                                @endforeach
                            </tr>
                            <tr>
                                <td>{{ trans('attributes.register_info.item_block.label.utilities_revenue') }}</td>
                                <td class="text-center number-radius"><div class="number-border-radius">3</div></td>
                                <td class="text-right">{{number_format($dataLatestYear->utilities_revenue)}}</td>
                                @foreach($dataPreview['utilities_revenue'] as $value)
                                <td class="text-right">{{number_format($value)}}</td>
                                @endforeach
                            </tr>
                            <tr>
                                <td>{{ trans('attributes.register_info.item_block.label.parking_lot_revenue') }}</td>
                                <td class="text-center number-radius"><div class="number-border-radius">4</div></td>
                                <td class="text-right">{{number_format($dataLatestYear->parking_revenue)}}</td>
                                @foreach($dataPreview['parking_revenue'] as $value)
                                <td class="text-right">{{number_format($value)}}</td>
                                @endforeach
                            </tr>
                            <tr>
                                <td>{{ trans('attributes.register_info.item_block.label.key_money_royalties') }}</td>
                                <td class="text-center number-radius"><div class="number-border-radius">5</div></td>
                                <td class="text-right">{{number_format($dataLatestYear->income_input_money)}}</td>
                                @foreach($dataPreview['income_input_money'] as $value)
                                <td class="text-right">{{number_format($value)}}</td>
                                @endforeach
                            </tr>
                            <tr>
                                <td>{{ trans('attributes.register_info.item_block.label.renewal_fee') }}</td>
                                <td class="text-center number-radius"><div class="number-border-radius">6</div></td>
                                <td class="text-right">{{number_format($dataLatestYear->income_update_house_contract)}}</td>
                                @foreach($dataPreview['income_update_house_contract'] as $value)
                                <td class="text-right">{{number_format($value)}}</td>
                                @endforeach
                            </tr>
                            <tr>
                                <td>{{ trans('attributes.register_info.item_block.label.other_income') }}</td>
                                <td class="text-center number-radius"><div class="number-border-radius">7</div></td>
                                <td class="text-right">{{number_format($dataLatestYear->other_income)}}</td>
                                @foreach($dataPreview['other_income'] as $value)
                                <td class="text-right">{{number_format($value)}}</td>
                                @endforeach
                            </tr>
                            <tr>
                                <td>{{ trans('attributes.register_info.item_block.label.etc') }}</td>
                                <td class="text-center number-radius"><div class="number-border-radius">8</div></td>
                                <td class="text-right">{{number_format($dataLatestYear->bad_debt_losses)}}</td>
                                @foreach($dataPreview['bad_debt_losses'] as $value)
                                <td class="text-right">{{number_format($value)}}</td>
                                @endforeach
                            </tr>
                            <tr>
                                <td>{{ trans('attributes.register_info.item_block.label.meter') }}</td>
                                <td class="text-center number-radius"><div class="number-border-radius">9</div></td>
                                <td class="text-right">{{number_format($dataLatestYear->sum_income)}}</td>
                                @foreach($dataPreview['sum_income'] as $value)
                                <td class="text-right">{{number_format($value)}}</td>
                                @endforeach
                            </tr>
                            <tr>
                                <td class="fw-bold td-vertical" rowspan="11">{{ trans('attributes.register_info.item_block.title.operating_cost') }}</td>
                                <td>{{ trans('attributes.register_info.item_block.label.management_fee') }}</td>
                                <td class="text-center number-radius"><div class="number-border-radius">10</div></td>
                                <td class="text-right">{{number_format($dataLatestYear->management_fee)}}</td>
                                @foreach($dataPreview['management_fee'] as $value)
                                <td class="text-right">{{number_format($value)}}</td>
                                @endforeach
                            </tr>
                            <tr>
                                <td>{{ trans('attributes.register_info.item_block.label.utilities_expenses') }}</td>
                                <td class="text-center number-radius"><div class="number-border-radius">11</div></td>
                                <td class="text-right">{{number_format($dataLatestYear->utilities_fee)}}</td>
                                @foreach($dataPreview['utilities_fee'] as $value)
                                <td class="text-right">{{number_format($value)}}</td>
                                @endforeach
                            </tr>
                            <tr>
                                <td>{{ trans('attributes.register_info.item_block.label.repair_fee') }}</td>
                                <td class="text-center number-radius"><div class="number-border-radius">12</div></td>
                                <td class="text-right">{{number_format($dataLatestYear->repair_fee)}}</td>
                                @foreach($dataPreview['repair_fee'] as $value)
                                <td class="text-right">{{number_format($value)}}</td>
                                @endforeach
                            </tr>
                            <tr>
                                <td>{{ trans('attributes.register_info.item_block.label.intact_reply_fee') }}</td>
                                <td class="text-center number-radius"><div class="number-border-radius">13</div></td>
                                <td class="text-right">{{number_format($dataLatestYear->intact_reply_fee)}}</td>
                                @foreach($dataPreview['intact_reply_fee'] as $value)
                                <td class="text-right">{{number_format($value)}}</td>
                                @endforeach
                            </tr>
                            <tr>
                                <td>{{ trans('attributes.register_info.item_block.label.asset_management_fee') }}</td>
                                <td class="text-center number-radius"><div class="number-border-radius">14</div></td>
                                <td class="text-right">{{number_format($dataLatestYear->asset_management_fee)}}</td>
                                @foreach($dataPreview['asset_management_fee'] as $value)
                                <td class="text-right">{{number_format($value)}}</td>
                                @endforeach
                            </tr>
                            <tr>
                                <td>{{ trans('attributes.register_info.item_block.label.tenant_recruitment_fee') }}</td>
                                <td class="text-center number-radius"><div class="number-border-radius">15</div></td>
                                <td class="text-right">{{number_format($dataLatestYear->tenant_recruitment_fee)}}</td>
                                @foreach($dataPreview['tenant_recruitment_fee'] as $value)
                                <td class="text-right">{{number_format($value)}}</td>
                                @endforeach
                            </tr>
                            <tr>
                                <td>{{ trans('attributes.register_info.item_block.label.taxes_dues') }}</td>
                                <td class="text-center number-radius"><div class="number-border-radius">16</div></td>
                                <td class="text-right">{{number_format($dataLatestYear->taxes_dues)}}</td>
                                @foreach($dataPreview['taxes_dues'] as $value)
                                <td class="text-right">{{number_format($value)}}</td>
                                @endforeach
                            </tr>
                            <tr>
                                <td>{{ trans('attributes.register_info.item_block.label.insurance_premium') }}</td>
                                <td class="text-center number-radius"><div class="number-border-radius">17</div></td>
                                <td class="text-right">{{number_format($dataLatestYear->insurance_premium)}}</td>
                                @foreach($dataPreview['insurance_premium'] as $value)
                                <td class="text-right">{{number_format($value)}}</td>
                                @endforeach
                            </tr>
                            <tr>
                                <td>{{ trans('attributes.register_info.item_block.label.land_payment') }}</td>
                                <td class="text-center number-radius"><div class="number-border-radius">18</div></td>
                                <td class="text-right">{{number_format($dataLatestYear->land_tax)}}</td>
                                @foreach($dataPreview['land_tax'] as $value)
                                <td class="text-right">{{number_format($value)}}</td>
                                @endforeach
                            </tr>
                            <tr>
                                <td>{{ trans('attributes.register_info.item_block.label.other_expenses') }}</td>
                                <td class="text-center number-radius"><div class="number-border-radius">19</div></td>
                                <td class="text-right">{{number_format($dataLatestYear->other_fee)}}</td>
                                @foreach($dataPreview['other_fee'] as $value)
                                <td class="text-right">{{number_format($value)}}</td>
                                @endforeach
                            </tr>
                            <tr>
                                <td>{{ trans('attributes.register_info.item_block.label.meter') }}</td>
                                <td class="text-center number-radius"><div class="number-border-radius">20</div></td>
                                <td class="text-right">{{number_format($dataLatestYear->sum_fee)}}</td>
                                @foreach($dataPreview['sum_fee'] as $value)
                                <td class="text-right">{{number_format($value)}}</td>
                                @endforeach
                            </tr>
                            <tr>
                                <td colspan="2">{{ trans('attributes.monthly_balance.preview.total') }}</td>
                                <td class="text-center number-radius"><div class="number-border-radius">21</div></td>
                                <td class="text-right">{{number_format($dataLatestYear->sum_difference)}}</td>
                                @foreach($dataPreview['sum_difference'] as $value)
                                <td class="text-right">{{number_format($value)}}</td>
                                @endforeach
                            </tr>
                            <tr>
                                <td colspan="3">{{ trans('attributes.property.total_tenants') }}</td>
                                <td class="text-center">{{number_format($dataLatestYear->total_tenants)}}</td>
                                @foreach($dataPreview['total_tenants'] as $value)
                                    <td class="text-center">{{number_format($value)}}</td>
                                @endforeach
                            </tr>
                            <tr>
                                <td colspan="3">{{ trans('attributes.property.area_can_for_rent') }}</td>
                                <td class="text-center">{{number_format($dataLatestYear->area_may_rent, 2)}}</td>
                                @foreach($dataPreview['area_may_rent'] as $value)
                                    <td class="text-center">{{number_format($value, 2)}}</td>
                                @endforeach
                            </tr>
                            <tr>
                                <td colspan="3">{{ trans('attributes.property.deposit') }}</td>
                                <td class="text-center">{{number_format($dataLatestYear->deposits)}}</td>
                                @foreach($dataPreview['deposits'] as $value)
                                    <td class="text-center">{{number_format($value)}}</td>
                                @endforeach
                            </tr>
                            <tr>
                                <td colspan="3">{{ trans('attributes.property.area_for_rent') }}</td>
                                <td class="text-center">{{number_format($dataLatestYear->area_rental_operating, 2)}}</td>
                                @foreach($dataPreview['area_rental_operating'] as $value)
                                    <td class="text-center">{{number_format($value, 2)}}</td>
                                @endforeach
                            </tr>
                            <tr>
                                <td colspan="3">{{ trans('attributes.register_info.item_block.label.crop_yield_1') }}</td>
                                <td class="text-center">{{number_format($dataLatestYear->crop_yield, 2)}} {{ trans('attributes.common.percent') }}</td>
                                @foreach($dataPreview['crop_yield'] as $value)
                                <td class="text-center">{{number_format($value, 2)}} {{ trans('attributes.common.percent') }}</td>
                                @endforeach
                            </tr>
                            <tr>
                                <td colspan="3">{{ trans('attributes.property.annual_payment_principal_interes') }}</td>
                                <td class="text-right">{{number_format($property['amount_paid_annually'])}}</td>
                                @foreach($dataPreview['crop_yield'] as $value)
                                <td class="text-right"></td>
                                @endforeach
                            </tr>
                            <tr>
                                <td colspan="3">{{ trans('attributes.register_info.item_block.label.dscr_first') }} {{ trans('attributes.register_info.item_block.label.dscr_last') }}</td>
                                <td class="text-center">{{number_format($dataLatestYear->dscr, 2)}} {{ trans('attributes.common.percent') }}</td>
                                @foreach($dataPreview['dscr'] as $value)
                                <td class="text-center">{{number_format($value, 2)}} {{ trans('attributes.common.percent') }}</td>
                                @endforeach
                            </tr>
                            <tr>
                                <td colspan="3">{{ trans('attributes.simulation.preview.title_chart_1_first') }} ({{ trans('attributes.simulation.preview.title_chart_1_last') }})</td>
                                <td class="text-center pre-score-point-0"></td>
                                @foreach($dataPreview['income_input_money'] as $key => $value)
                                <td class="text-center {{ 'pre-score-point-' . ($key+1) }}"></td>
                                @endforeach
                            </tr>
                        </tbody>
                    </table>
                    </div>
                </div>

                <div class="row m-0 page-2-pre">
                    <div class="col-12 p0">
                        <div class="container-preview m0 m30b diagram-analysis wp50">
                            <div class="diagram-block">
                                <div class="w-auto">
                                    <p class="p30l m0 fs16 fw-bold">{{ trans('attributes.balance.body.SCOREMAP') }}</p>
                                    <p class="p30l m0 fs14 fw-bold">{{ trans('attributes.balance.body.note_chart') }}</p>
                                    <div id="pre-annual-per-spiderweb-chart"></div>
                                </div>
                            </div>
                        </div>

                        <div class="container-preview m0 diagram-analysis">
                            <div class="p30 diagram-block diagram-block-2">
                                <div class="w-auto">
                                    <div id="pre-container-chart-annual"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
