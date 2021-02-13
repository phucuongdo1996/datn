@extends('layout.home.master')
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/preview/borrowing.css') }}">
@endsection
@section('content')
    <div class="container-fluid container-wrapper container-wrapper-analysis">
        <div id="main-analysis-borrowing">

            {{--Title page--}}
            <div class="row m0 m20b media-575-p20l media-575-p20r p15lr">
                <div class="col-9 text-left text-md-left p0">
                    <h3 class="m0">{{ trans('attributes.borrowing.sort_title') }}</h3>
                </div>
                <div class="col-3 text-right p0">
                    <button type="button" class="btn custom-btn-primary d-none d-sm-inline-block btn-save-borrowing-sort w68 fs15 fs14-sp">{{ trans('attributes.simulation.content.text_btn_save') }}</button>
                </div>
            </div>

            @include('partials.flash_messages')
            {{--Table--}}
            <div class="p15lr">
                <div class="row m0 m30b br10 bg-white">
                    <div class="table-responsive fs14 portfolio-table">
                        <table class="table-borrowing-sort table table-bordered table-striped border-0 m0">
                            <thead class="table-head">
                            <td class="border-top-0 border-left-0">
                                <div class="centered-vertical m17b">
                                </div>
                                <div class="centered-vertical">
                                <span class="centered">
                                    <p class="m0">{{ trans('attributes.borrowing.table.no') }}</p>
                                </span>
                                </div>
                            </td>
                            <td class="border-top-0 p120r">
                                <div class="centered-vertical m17b">
                                </div>
                                <div class="centered-vertical">
                                <span class="centered">
                                    <p class="m0">{{ trans('attributes.borrowing.table.name') }}</p>
                                </span>
                                </div>
                            </td>
                            <td class="border-top-0">
                                <div class="centered-vertical m17b">
                                </div>
                                <div class="centered-vertical">
                                <span class="centered">
                                    <p class="m0">{{ trans('attributes.table_list_house.table_head.td_2_sort') }}</p>
                                </span>
                                </div>
                            </td>
                            <td class="border-top-0">
                                <div class="centered-vertical m17b">
                                </div>
                                <div class="centered-vertical">
                                <span class="centered">
                                    <p class="m0">{{ trans('attributes.borrowing.table.status') }}</p>
                                </span>
                                </div>
                            </td>
                            <td class="border-top-0">
                                <div class="centered-vertical m17b">
                                </div>
                                <div class="centered-vertical">
                                <span class="centered">
                                    <p class="m0">{{ trans('attributes.borrowing.table.annual_balance') }}<br>
                                        {{ trans('attributes.borrowing.table.year_of_registration') }}
                                    </p>
                                </span>
                                </div>
                            </td>
                            <td class="border-top-0">
                                <div class="centered-vertical m17b">
                                </div>
                                <div class="centered-vertical">
                                <span class="centered">
                                    <p class="m0">{{ trans('attributes.borrowing.table.acquisition_price') }}<br>
                                        ({{ trans('attributes.common.yen') }})
                                    </p>
                                </span>
                                </div>
                            </td>
                            <td class="border-top-0">
                                <div class="centered-vertical m17b">
                                </div>
                                <div class="centered-vertical">
                                <span class="centered">
                                    <p class="m0">{{ trans('attributes.borrowing.table.borrowed_amount') }}<br>
                                        ({{ trans('attributes.common.yen') }})
                                    </p>
                                </span>
                                </div>
                            </td>
                            <td class="border-top-0">
                                <div class="centered-vertical m17b">
                                </div>
                                <div class="centered-vertical">
                                <span class="centered">
                                    <p class="m0">{{ trans('attributes.borrowing.table.borrowing_day') }}</p>
                                </span>
                                </div>
                            </td>
                            <td class="border-top-0">
                                <div class="centered-vertical m17b">
                                </div>
                                <div class="centered-vertical">
                                <span class="centered">
                                    <p class="m0">{{ trans('attributes.borrowing.table.loan') }}<br>
                                        {{ trans('attributes.borrowing.table.agreement_period') }}</p>
                                </span>
                                </div>
                            </td>
                            <td class="border-top-0">
                                <div class="centered-vertical m17b">
                                </div>
                                <div class="centered-vertical">
                                <span class="centered">
                                    <p class="m0">{{ trans('attributes.borrowing.table.elapsed') }}<br>
                                        {{ trans('attributes.borrowing.table.number_of_years') }}</p>
                                </span>
                                </div>
                            </td>
                            <td class="border-top-0">
                                <div class="centered-vertical m17b">
                                </div>
                                <div class="centered-vertical">
                                <span class="centered">
                                    <p class="m0">{{ trans('attributes.borrowing.table.borrowing') }}<br>
                                        {{ trans('attributes.borrowing.table.interest') }}</p>
                                </span>
                                </div>
                            </td>
                            <td class="border-top-0">
                                <div class="centered-vertical m17b">
                                </div>
                                <div class="centered-vertical">
                                <span class="centered">
                                    <p class="m0">{{ trans('attributes.borrowing.table.borrowing_balance') }}<br>
                                        {{ trans('attributes.borrowing.table.at_elapsed_years') }}<br>
                                        ({{ trans('attributes.common.yen') }})
                                    </p>
                                </span>
                                </div>
                            </td>
                            <td class="border-top-0">
                                <div class="centered-vertical m17b">
                                </div>
                                <div class="centered-vertical">
                                <span class="centered">
                                    <p class="m0">{{ trans('attributes.borrowing.table.loan_repayment_amount') }}<br>
                                        {{ trans('attributes.borrowing.table.equity_and_interest_repayment') }}<br>
                                        ({{ trans('attributes.common.yen') }})
                                    </p>
                                </span>
                                </div>
                            </td>
                            <td class="border-top-0 p0t vertical-base">
                                <div class="centered-vertical m10b">
                                    <span class="number-li m0b m3r">1</span>
                                </div>
                                <div class="centered-vertical">
                                <span class="centered">
                                    <p class="m0">{{ trans('attributes.borrowing.table.noi') }}<br>
                                        ({{ trans('attributes.common.yen') }})
                                    </p>
                                </span>
                                </div>
                            </td>
                            <td class="border-top-0">
                                <div class="centered-vertical m17b">
                                </div>
                                <div class="centered-vertical">
                                <span class="centered">
                                    <p class="m0">{{ trans('attributes.borrowing.table.dscr') }}<br>
                                        {{ trans('attributes.borrowing.table.repayment_rate') }}</p>
                                </span>
                                </div>
                            </td>
                            <td class="border-top-0">
                                <div class="centered-vertical m17b">
                                </div>
                                <div class="centered-vertical">
                                <span class="centered">
                                    <p class="m0">{{ trans('attributes.borrowing.table.acquisition_cost') }}<br>
                                        {{ trans('attributes.borrowing.table.yield') }}</p>
                                </span>
                                </div>
                            </td>
                            <td class="border-top-0 p0t vertical-base">
                                <div class="centered-vertical m10b">
                                    <span class="number-li m0b m3r">11</span>
                                </div>
                                <div class="centered-vertical">
                                <span class="centered">
                                    <p class="m0">{{ trans('attributes.borrowing.table.balance_score') }}</p>
                                </span>
                                </div>
                            </td>
                            <td class="border-top-0">
                                <div class="centered-vertical m17b">
                                </div>
                                <div class="centered-vertical">
                                <span class="centered">
                                    <p class="m0">{{ trans('attributes.borrowing.table.the_main_purpose') }}</p>
                                </span>
                                </div>
                            </td>
                            <td class="border-top-0">
                                <div class="centered-vertical m17b">
                                </div>
                                <div class="centered-vertical">
                                <span class="centered">
                                    <p class="m0">{{ trans('attributes.borrowing.table.use_in_detail') }}</p>
                                </span>
                                </div>
                            </td>
                            <td class="border-top-0">
                                <div class="centered-vertical m17b">
                                </div>
                                <div class="centered-vertical">
                                <span class="centered">
                                    <p class="m0">{{ trans('attributes.borrowing.table.where_abouts') }}</p>
                                </span>
                                </div>
                            </td>
                            <td class="border-top-0 border-right-0">
                                <div class="centered-vertical m17b">
                                </div>
                                <div class="centered-vertical">
                                <span class="centered">
                                    <p class="m0">{{ trans('attributes.borrowing.table.borrowing_financial_institutions') }}</p>
                                </span>
                                </div>
                            </td>
                            </thead>

                            <tbody>
                            <form id="sort-borrowing" action="">
                                @php($totalAmountPaidAnnually = 0)
                                @php($totalDebtBalance = 0)
                                @php($totalNoi = 0)
                                @php($totalDscr = 0)
                                @foreach($listData as $key => $value)
                                    <?php
                                        empty($value->loan_date) ? $value->years_passed = 0 : $value->years_passed = getNumberYearPassed($value->loan_date);
                                    if (empty($value->loan) || empty($value->contract_loan_period) || empty($value->loan_date)) {
                                        $value->debt_balance = 0;
                                    } else {
                                        $value->debt_balance = $value->loan - (divisionNumber($value->loan, ($value->contract_loan_period * 12)) * getMonthDifferenceNow($value->loan_date));
                                    }
                                        $value->noi_yield = divisionNumber($value->total_revenue - $value->total_cost, $value->money_receive_house) * 100;
                                        $value->amount_paid_annually = countAmountPaidAnnually($value->loan, $value->contract_loan_period, $value->interest_rate);
                                        $value->dscr = divisionNumber(round($value->total_revenue - $value->total_cost), round($value->amount_paid_annually)) * 100;
                                        $value->noi = $value->total_revenue - $value->total_cost;
                                        $value->acquisition_price_yield = divisionNumber($value->noi, $value->money_receive_house) * 100;
                                    ?>
                                    <span class="d-none">
                                        {{ $totalAmountPaidAnnually += round($value->amount_paid_annually) }}
                                        {{ $totalDebtBalance += round($value->debt_balance) }}
                                        {{ $totalNoi += round($value->noi) }}
                                        {{ $totalDscr += round($value->dscr, 2) }}
                                    </span>
                                    <tr class="keep-all" data-order="{{ $value->order }}" data-id="{{ $value->id }}">
                                        <td  class="border-left-0">
                                            <div class="centered-vertical">
                                                {{ $key + FLAG_ONE }}
                                            </div>
                                        </td>
                                        <td class="border-top-0 name-color fw-bold">{{ $value->house_name ? $value->house_name : ''}}</td>
                                        <td class="border-top-0">
                                            <div class="row">
                                                <div class="col-6 up"><img class="pointer" src="{{ asset('images/sort_up.png') }}"></div>
                                                <div class="col-6 down"><img class="pointer" src="{{ asset('images/sort_down.png') }}"></div>
                                            </div>
                                        </td>
                                        <td class="border-top-0">{{ $value->status ? STATUS_HOUSE[$value->status] ? : '' : '' }}</td>
                                        <td class="border-top-0 text-right">
                                            {{ dateTimeFormatBorrowing($value->date_year_registration_revenue, $value->date_month_registration_revenue) }}
                                        </td>
                                        <td class="border-top-0 text-right" data-value="{{ $value->money_receive_house }}" >{{ number_format($value->money_receive_house) }}</td>
                                        <td class="border-top-0 text-right" data-value="{{ $value->loan }}">{{ number_format($value->loan) }}</td>
                                        <td class="border-top-0">{{ $value->loan_date ? date("Y/m/d", strtotime($value->loan_date)) : "ー" }}</td>
                                        <td class="border-top-0" data-value="{{ $value->contract_loan_period }}">{{ number_format($value->contract_loan_period) . trans('attributes.common.year') }}</td>
                                        <td class="border-top-0" data-value="{{ $value->years_passed ?? 0 }}">{{ $value->years_passed ? $value->years_passed . trans('attributes.common.year') : '' }}</td>
                                        <td class="border-top-0" data-value="{{ $value->interest_rate }}">{{ number_format((float)$value->interest_rate, 2, '.', ',') . '%' }}</td>
                                        <td class="border-top-0 text-right" data-value="{{ $value->debt_balance }}">{{ number_format($value->debt_balance) }}</td>
                                        <td class="border-top-0 text-right" data-value="{{ $value->amount_paid_annually }}">{{ number_format($value->amount_paid_annually) }}</td>
                                        <td class="border-top-0 text-right" data-value="{{ $value->noi }}">{{ number_format($value->noi) }}</td>
                                        <td class="border-top-0 text-center" data-value="{{ $value->dscr }}">{{ number_format((float)$value->dscr, 2, '.', ',') . '%' }}</td>
                                        <td class="border-top-0 text-center" data-value="{{ $value->acquisition_price_yield }}">{{ number_format((float)$value->acquisition_price_yield, 2, '.', ',') . '%' }}</td>
                                        <td class="border-top-0">{{ $value->synthetic_point ? round($value->synthetic_point) . ' points' : '0 points' }}</td>
                                        <td class="border-top-0">{{ !empty($value->detailRealEstateType) ? !empty($value->detailRealEstateType->realEstateTypes) ? $value->detailRealEstateType->realEstateTypes->name : "" : ""}}</td>
                                        <td class="border-top-0">{{ !empty($value->detailRealEstateType) ? $value->detailRealEstateType->name : "" }}</td>
                                        <td class="border-top-0">{{ $value->address_district ? $value->address_district : 'ー' }}</td>
                                        <td class="border-right-0">
                                            <div class="loan-bank-branch-sort d-none">
                                                {{ $value->loan_bank_name . '/' . $value->bank_branch_name }}
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </form>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="row m0 p0 media-575-p20l media-575-p20r p15lr">
                <div class="col-9 text-left text-md-left p0">
                </div>
                <div class="col-3 text-right p0">
                    <button type="button" class="btn custom-btn-primary btn-save-borrowing-sort w68 fs15 fs14-sp">{{ trans('attributes.simulation.content.text_btn_save') }}</button>
                </div>
            </div>
        </div>
    </div>
@endsection
