@extends('modal.preview.common_preview')
@section('title', __('attributes.borrowing.title') )
@section('content_preview')
<div class="content-borrowing-preview">
    {{--Table--}}
    <div class="row m0 m30b br10 page-break-after">
        <div class="table-responsive">
            <table id="table-property-preview-print"
                   class="table-preview table table-bordered m0 fs11 text-center">
                <thead>
                    <tr class="table-head no-background-color fw-bold">
                        <td class="break-all w-3dot5">{{ trans('attributes.borrowing.table.no') }}</td>
                        <td class="break-all w-7dot2">{{ trans('attributes.borrowing.table.name') }}</td>
                        <td class="break-all w-5">{{ trans('attributes.borrowing.table.status') }}</td>
                        <td class="break-all w-6 @if(!in_array($currentUser->role, [BROKER, EXPERT])) pcH @endif">{{ trans('attributes.repair_history.owner') }}</td>
                        <td class="break-all w-5dot2">{{ trans('attributes.borrowing.table.annual_balance') }}
                            <br>{{ trans('attributes.borrowing.table.year_of_registration') }}
                        </td>
                        <td class="break-all w-4dot2">{{ trans('attributes.borrowing.table.acquisition_price') }}<br>
                                ({{ trans('attributes.common.yen') }})
                        </td>
                        <td class="break-all w-4dot2">{{ trans('attributes.borrowing.table.borrowed_amount') }}<br>
                                ({{ trans('attributes.common.yen') }})
                        </td>
                        <td class="break-all w-4dot2">{{ trans('attributes.borrowing.table.borrowing_day') }}</td>
                        <td class="break-all w-4dot2">{{ trans('attributes.borrowing.table.loan') }}<br>
                                {{ trans('attributes.borrowing.table.agreement_period') }}
                        </td>
                        <td class="break-all w-4dot2">{{ trans('attributes.borrowing.table.elapsed') }}<br>
                                {{ trans('attributes.borrowing.table.number_of_years') }}
                        </td>
                        <td class="break-all w-4dot2">{{ trans('attributes.borrowing.table.borrowing') }}<br>
                                {{ trans('attributes.borrowing.table.interest') }}
                        </td>
                        <td class="break-all w-4dot6">{{ trans('attributes.borrowing.table.borrowing_balance') }}<br>
                                {{ trans('attributes.borrowing.table.at_elapsed_years') }}<br>
                                ({{ trans('attributes.common.yen') }})
                        </td>
                        <td class="break-all w-4dot6">{{ trans('attributes.borrowing.table.loan_repayment_amount') }}<br>
                                {{ trans('attributes.borrowing.table.equity_and_interest_repayment') }}<br>
                                ({{ trans('attributes.common.yen') }})
                        </td>
                        <td class="break-all w-5dot2">{{ trans('attributes.borrowing.table.noi') }}<br>
                                ({{ trans('attributes.common.yen') }})
                        </td>
                        <td class="break-all w-4dot6">{{ trans('attributes.borrowing.table.dscr') }}<br>
                                {{ trans('attributes.borrowing.table.repayment_rate') }}
                        </td>
                        <td class="break-all w-4dot2">{{ trans('attributes.borrowing.table.acquisition_cost') }}<br>
                                {{ trans('attributes.borrowing.table.yield') }}
                        </td>
                        <td class="break-all w-5">{!! trans('attributes.property.assess_revenue_expenditure2') !!}</td>
                        <td class="break-all w-5dot2">{{ trans('attributes.borrowing.table.the_main_purpose') }}</td>
                        <td class="break-all w-4dot2">{{ trans('attributes.borrowing.table.use_in_detail') }}</td>
                        <td class="break-all w-4dot2">{{ trans('attributes.borrowing.table.where_abouts') }}</td>
                        <td class="break-all w-4dot2">{{ trans('attributes.borrowing.table.borrowing_financial_institutions') }}</td>
                    </tr>
                </thead>
                @foreach($listData as $data)
                    <?php
                        empty($data->loan_date) ? $data->years_passed = 0 : $data->years_passed = getNumberYearPassed($data->loan_date);
                        $data->debt_balance = round($data->loan + excelCUMPRINC($data->interest_rate / 100, $data->contract_loan_period, $data->loan, 1, dateDif($data->loan_date), 0));
                        $data->noi_yield = divisionNumber($data->total_revenue - $data->total_cost, $data->money_receive_house) * 100;
                        $data->amount_paid_annually = countAmountPaidAnnually($data->loan, $data->contract_loan_period, $data->interest_rate);
                        $data->dscr = divisionNumber(round($data->total_revenue - $data->total_cost), round($data->amount_paid_annually)) * 100;
                        $data->noi = $data->total_revenue - $data->total_cost;
                        $data->acquisition_price_yield = divisionNumber($data->noi, $data->money_receive_house) * 100;
                    ?>
                    <tr class="keep-all">
                        <td>
                            <div>
                                <label class="fw-normal m-0">
                                <span>
                                    @if($stepNumber + $loop->index + 1 < 10)
                                        {{ '00' . ($stepNumber + $loop->index + 1)}}
                                    @elseif($stepNumber + $loop->index + 1 < 100)
                                        {{ '0' . ($stepNumber + $loop->index + 1)}}
                                    @endif
                                    </span>
                                </label>
                            </div>
                        </td>
                        <td class="text-left">{{ $data->house_name ? $data->house_name : ''}}</td>
                        <td class="text-center">{{ $data->status ? STATUS_HOUSE[$data->status] ? : '' : '' }}</td>
                        <td class="text-center break-all @if(!in_array($currentUser->role, [BROKER, EXPERT])) pcH @endif">{{ $data->status ? $data->proprietor ? : '' : '' }}</td>
                        <td class="text-center">
                            {{ $data->date_year_registration_revenue ? $data->date_year_registration_revenue . trans('attributes.common.year') : ''  }}
                            {{ $data->date_month_registration_revenue ? MONTH[$data->date_month_registration_revenue] ?? '' : ''}}
                        </td>
                        <td class="text-right"
                            data-value="{{ $data->money_receive_house ?? 0 }}">{{ $data->money_receive_house ? number_format($data->money_receive_house) : '0' }}</td>
                        <td class="text-right"
                            data-value="{{ $data->loan ?? 0 }}">{{ $data->loan ? number_format($data->loan) : '0' }}</td>
                        <td class="text-left">{{ $data->loan_date ? date("Y/m/d", strtotime($data->loan_date)) : '' }}</td>
                        <td class="text-left"
                            data-value="{{ $data->contract_loan_period ?? 0 }}">{{ $data->contract_loan_period ? number_format($data->contract_loan_period) . trans('attributes.common.year') : '0' }}</td>
                        <td class="text-left"
                            data-value="{{ $data->years_passed ?? 0 }}">{{ $data->years_passed ? $data->years_passed . trans('attributes.common.year') : '' }}</td>
                        <td class="text-left"
                            data-value="{{ $data->interest_rate ?? 0 }}">{{ $data->interest_rate ? number_format((float)$data->interest_rate, 2, '.', ',') . '%' : '0.00 %' }}</td>
                        <td class="text-right"
                            data-value="{{ $data->debt_balance ?? 0 }}">{{ $data->debt_balance ? number_format($data->debt_balance) : '0' }}</td>
                        <td class="text-right"
                            data-value="{{ $data->amount_paid_annually ?? 0 }}">{{ $data->amount_paid_annually ? number_format($data->amount_paid_annually) : '0' }}</td>
                        <td class="text-right"
                            data-value="{{ $data->noi ?? 0 }}">{{ $data->noi ? number_format($data->noi) : '0' }}</td>
                        <td class="text-left"
                            data-value="{{ $data->dscr ?? 0 }}">{{ $data->dscr ? number_format((float)$data->dscr, 2, '.', ',') . '%' : '0.00 %' }}</td>
                        <td class="text-left"
                            data-value="{{ $data->acquisition_price_yield ?? 0 }}">{{ $data->acquisition_price_yield ? number_format((float)$data->acquisition_price_yield, 2, '.', ',') . '%' : '0.00 %' }}</td>
                        <td class="text-center">{{ $data->synthetic_point ? round($data->synthetic_point) : 0 }}<br/>points</td>
                        <td class="text-left">{{ isset($data->realEstateType->name) ? $data->realEstateType->name : ""}}</td>
                        <td class="text-left">{{ isset($data->detailRealEstateType->name) ? $data->detailRealEstateType->name : "" }}</td>
                        <td class="text-left w35">{{ $data->address_district ? $data->address_district : '' }}</td>
                        <td class="text-left">
                            <div class="loan-bank-branch loan-bank-branch-pre d-none">
                                {{ $data->loan_bank_name . '/' . $data->bank_branch_name }}
                            </div>
                        </td>
                    </tr>
                @endforeach
                <tr class="fw-bold">
                    <td></td>
                    <td class="text-left">{{ trans('attributes.borrowing.table.total') }}</td>
                    <td class="text-left"></td>
                    <td class="text-left"></td>
                    <td class="text-left @if(!in_array($currentUser->role, [BROKER, EXPERT])) pcH @endif"></td>
                    <td class="text-right">{{ $listData->sum('money_receive_house') ? number_format($listData->sum('money_receive_house')) : '0' }}</td>
                    <td class="text-right">{{ $listData->sum('loan') ? number_format($listData->sum('loan')) : '0' }}</td>
                    <td class="text-left"></td>
                    <td class="text-left w30">{{ number_format(divisionNumber($listData->sum('contract_loan_period'), $listData->count()), 1, ".", ",") . trans('attributes.common.year') }}</td>
                    <td class="text-left">{{ $listData->sum('years_passed') ? number_format(divisionNumber($listData->sum('years_passed'), $listData->count()), 1, ".", ",") . trans('attributes.common.year') : '' }}</td>
                    <td class="text-left w53"></td>
                    <td class="text-right">{{ $totalDebtBalance ? number_format($totalDebtBalance) : '0' }}</td>
                    <td class="text-right">{{ $totalAmountPaidAnnually ? number_format($totalAmountPaidAnnually) : '0' }}</td>
                    <td class="text-right">{{ $totalNoi ? number_format($totalNoi): '0' }}</td>
                    <td class="text-left">{{ number_format((float)division($totalNoi, $totalAmountPaidAnnually), 2, '.', ',') . ' %' }}</td>
                    <td class="text-left">{{ number_format((float)division($totalNoi, $listData->sum('money_receive_house')), 2, '.', ',') . ' %' }}</td>
                    <td class="text-center">{{ $totalPoint ? number_format(divisionNumber($totalPoint, $listData->count()), 2, '.', ',') : 0 }}<br/>points</td>
                    <td class="text-left"></td>
                    <td class="text-left"></td>
                    <td class="text-left"></td>
                    <td class="text-left"></td>
                </tr>
            </table>
        </div>
    </div>
    <div id="chart-all-data" class="row m0 m10b diagram-analysis chart-block-preview">
        <div class="col-12 col-xl-12 p0">
            <div class="borrowing-diagram-block borrowing-h564 chart-all-data-preview">
                <p class="title-diagram text-left p20l">{{ __('attributes.borrowing.title_high_charts') }}</p>
                <div id="chart-all-preview"></div>
                <p class="highcharts-des fs15 highcharts-note" style="display: none">
                    {{ __('attributes.simulation_charts.note_1') }}<br/>
                    {{ __('attributes.simulation_charts.note_2') }}
                </p>
            </div>
        </div>
    </div>
    <div id="chart-preview-parent-1" class="chart-block-preview"></div>
    <div id="chart-preview-parent-2" class="chart-block-preview"></div>
    <div id="chart-preview-parent-3" class="chart-block-preview"></div>
    <div id="chart-preview-parent-4" class="chart-block-preview"></div>
    <div id="chart-preview-parent-5" class="chart-block-preview"></div>
    <div id="chart-preview-parent-6" class="chart-block-preview"></div>
    <div id="chart-preview-parent-7" class="chart-block-preview"></div>
    <div id="chart-preview-parent-8" class="chart-block-preview"></div>
    <div id="chart-preview-parent-9" class="chart-block-preview"></div>
</div>
@endsection
