@extends('layout.home.master')
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/preview/borrowing.css') }}">
@endsection
@section('content')
    <div id="borrowing-content" class="container-fluid container-wrapper container-wrapper-analysis">
        <div id="main-analysis-borrowing">

            {{--Title page--}}
            <div class="row m0 m20b p0">
                <div class="col-12 text-left text-md-left p0 media-575-p20l media-575-p20r p15lr">
                    <h3 class="m0">{{ trans('attributes.borrowing.title') }}</h3>
                </div>
            </div>

            {{--Filter and button--}}
            <form id="form-borrowing" action="{{ route(USER_BORROWING) }}" method="GET">
                <div class="row m0 m30b media-575-p20l media-575-p20r p0 p15lr">
                    <div class="row col-12 text-center text-md-right col-xl-8 p0 group-status-top">
                        <div id="borrowing-block-status" class="d-flex min-h38 m8t m10r">
                            <div class="w-20 centered first-block">
                                <label class="m0 fw-normal">{{ __('attributes.portfolio_analysis.first_block.title') }}</label>
                            </div>
                            @if(empty($params))
                                <div class="w-80 p8t p5b p10l p10r">
                                    <div class="row">
                                        <div class="offset-1 offset-lg-0 col-5 col-lg-3 p0l p0r m5b">
                                            <label class="container-input fw-normal borrowing-left">{{ __('attributes.portfolio_analysis.first_block.checkbox_1') }}
                                                <input class="checkbox-borrowing" name="owning" type="checkbox" checked>
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                        <div class="offset-1 offset-lg-0 col-5 col-lg-3 p0l p0r m5b">
                                            <label class="container-input fw-normal borrowing-left">{{ __('attributes.portfolio_analysis.first_block.checkbox_2') }}
                                                <input class="checkbox-borrowing" name="sold" type="checkbox" checked>
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                        <div class="offset-1 offset-lg-0 col-5 col-lg-3 p0l p0r m5b">
                                            <label class="container-input fw-normal borrowing-left">{{ __('attributes.portfolio_analysis.first_block.checkbox_3') }}
                                                <input class="checkbox-borrowing" name="negotiating" type="checkbox" checked>
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                        <div class="offset-1 offset-lg-0 col-5 col-lg-3 p0l p0r m5b">
                                            <label class="container-input fw-normal borrowing-left">{{ __('attributes.portfolio_analysis.first_block.checkbox_4') }}
                                                <input class="checkbox-borrowing" name="negotiated" type="checkbox" checked>
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="w-80 p8t p5b p10l p10r">
                                    <div class="row">
                                        <div class="offset-1 offset-lg-0 col-5 col-lg-3 p0l p0r m5b">
                                            <label class="container-input fw-normal borrowing-left">{{ __('attributes.portfolio_analysis.first_block.checkbox_1') }}
                                                <input class="checkbox-borrowing" name="owning" type="checkbox"  {{ isset($params['owning']) ? 'checked=checked' : '' }}>
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                        <div class="offset-1 offset-lg-0 col-5 col-lg-3 p0l p0r m5b">
                                            <label class="container-input fw-normal borrowing-left">{{ __('attributes.portfolio_analysis.first_block.checkbox_2') }}
                                                <input class="checkbox-borrowing" name="sold" type="checkbox"  {{ isset($params['sold']) ? 'checked=checked' : '' }}>
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                        <div class="offset-1 offset-lg-0 col-5 col-lg-3 p0l p0r m5b">
                                            <label class="container-input fw-normal borrowing-left">{{ __('attributes.portfolio_analysis.first_block.checkbox_3') }}
                                                <input class="checkbox-borrowing" name="negotiating" type="checkbox"  {{ isset($params['negotiating']) ? 'checked=checked' : '' }}>
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                        <div class="offset-1 offset-lg-0 col-5 col-lg-3 p0l p0r m5b">
                                            <label class="container-input fw-normal borrowing-left">{{ __('attributes.portfolio_analysis.first_block.checkbox_4') }}
                                                <input class="checkbox-borrowing" name="negotiated" type="checkbox"  {{ isset($params['negotiated']) ? 'checked=checked' : '' }}>
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                        @if(in_array($currentUser->role, [BROKER, EXPERT]))
                            <div class="m0 name-group d-flex min-h38 m8t" style="width: 300px;max-width: 100%;">
                                <div class="btn fs14 centered fw-bold p10" style="border-radius: inherit; background-color: #6E7A94 !important;color: white !important;">{{ trans('attributes.register_info.item_block.label.proprietor_2') }}</div>
                                <div class="btn wrap-input-option fs14 p0 w-50">
                                    <select id="select-proprietor" name="proprietor" class="option-paginate-1 btn form-control hp100 p0 p15r p5l">
                                        <option class="m20r m20l" value="">{{ trans('attributes.register_info.item_block.label.all') }}</option>
                                        <option class="m20r m20l" value="ー" @if(isset($params['proprietor']) && $params['proprietor'] == 'ー') selected @endif>ー</option>
                                        @foreach($proprietors as $item)
                                            @if(isset($item->proprietor))
                                                <option @if(isset($params['proprietor']) && ($params['proprietor'] == $item->proprietor)) selected @endif class="m20r m20l break-all" value="{{ $item->proprietor }}">{{ $item->proprietor }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="col-12 col-xl-4 text-left text-lg-right p0 group-button-top">
                        @if(!$currentUser->isSubUser())
                            <a href="{{ route(USER_BORROWING_SORT) }}" class="btn custom-btn-default fs15 m7r sort-property d-none d-md-inline-block fs13-sp p7t-sp m5t h36">{{ trans('attributes.portfolio_analysis.text_btn_sort') }}</a>
                        @endif
                        <div class="btn-group m7r m8t">
                            <div class="btn label-option fs15 fs14-sp centered">{{ trans('attributes.portfolio_analysis.number_displayed') }}</div>
                            <div class="btn wrap-input-option fs14 w-40 p0">
                                <div class="style-select-option text-center">
                                    <select class="select-paginate pointer fs14 border-0" name="paginate">
                                        <option {{ isset($params['paginate']) && $params['paginate'] == 10 ? 'selected' : '' }} value="10">10{{ trans('attributes.portfolio_analysis.item') }}</option>
                                        <option {{ isset($params['paginate']) && $params['paginate'] == 20 ? 'selected' : '' }} value="20">20{{ trans('attributes.portfolio_analysis.item') }}</option>
                                        <option {{ isset($params['paginate']) && $params['paginate'] == 30 ? 'selected' : '' }} value="30">30{{ trans('attributes.portfolio_analysis.item') }}</option>
                                        <option {{ isset($params['paginate']) && $params['paginate'] == 50 ? 'selected' : '' }} value="50"> 50{{ trans('attributes.portfolio_analysis.item') }}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <a href="{{ route(USER_BORROWING_SORT) }}" class="btn custom-btn-default fs15 sort-property d-sm-inline-block d-md-none fs14-sp p7t-sp m5t h36">{{ trans('attributes.portfolio_analysis.text_btn_sort') }}</a>
                        <a class="btn custom-btn-success fs15 btn-borrowing-preview d-none d-sm-inline-block fs13-sp media-767-m7l m5t">{{ trans('attributes.portfolio_analysis.pre_print') }}</a>
                    </div>
                </div>
            </form>

            <div class="row m0">
                <div class="col-12 borrowing-diagram-block">
                    <p class="title-diagram text-left p20l color-title-chart">{{ __('attributes.borrowing.title_high_charts') }}</p>
                    <div id="chart-all"></div>
                    <p class="highcharts-des fs15 highcharts-note m15l fs13-sp" style="display: none">
                        {{ __('attributes.simulation_charts.note_1') }}<br/>
                        {{ __('attributes.simulation_charts.note_2') }}
                    </p>
                </div>
            </div>


                {{--Table--}}
                <div class="mt-3">
                    <div class="row m0 m20b br10 bg-white">
                        <div class="table-responsive fs14 br10 portfolio-table">
                            <table id="table-property" class="table-borrowing table table-bordered table-striped border-0 m0">
                                <tr class="table-head">
                                    <td class="border-0">
                                        <div class="centered-vertical m17b">
                                        </div>
                                        <div class="centered-vertical">
                                            <label class="container-input p25l">
                                                <input id="all-data" type="checkbox" checked>
                                                <span class="checkmark"></span>
                                                <span>{{ trans('attributes.borrowing.table.no') }}</span>
                                            </label>
                                            <span class="sort-icon sort-icon-first"  data-id='0'><i class="fa-sort-icon fa fa-caret-down" aria-hidden="true"></i></span>
                                        </div>
                                    </td>
                                    <td class="border-top-0">
                                        <div class="centered-vertical m17b">
                                        </div>
                                        <div class="centered-vertical">
                                            <span class="centered">
                                                <p class="m0">{{ trans('attributes.borrowing.table.name') }}</p>
                                                <span  data-id='1' class="sort-icon"><i class="fa-sort-icon fa fa-caret-down" aria-hidden="true"></i></span>
                                            </span>
                                        </div>
                                    </td>
                                    <td class="border-top-0">
                                        <div class="centered-vertical m17b">
                                        </div>
                                        <div class="centered-vertical">
                                            <span class="centered">
                                                <p class="m0">{{ trans('attributes.borrowing.table.status') }}</p>
                                                <span data-id='2' class="sort-icon"><i class="fa-sort-icon fa fa-caret-down" aria-hidden="true"></i></span>
                                            </span>
                                        </div>
                                    </td>
                                    <td class="border-top-0 @if(!in_array($currentUser->role, [BROKER, EXPERT])) pcH @endif">
                                        <div class="centered-vertical m17b">
                                        </div>
                                        <div class="centered-vertical">
                                            <span class="centered">
                                                <p class="m0">{{ trans('attributes.repair_history.owner') }}</p>
                                                <span data-id='3' class="sort-icon"><i class="fa-sort-icon fa fa-caret-down" aria-hidden="true"></i></span>
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
                                                <span data-id='4' class="sort-icon"><i class="fa-sort-icon fa fa-caret-down" aria-hidden="true"></i></span>
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
                                                <span data-id='5' class="sort-icon"><i class="fa-sort-icon fa fa-caret-down" aria-hidden="true"></i></span>
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
                                                <span  data-id='6' class="sort-icon"><i class="fa-sort-icon fa fa-caret-down" aria-hidden="true"></i></span>
                                            </span>
                                        </div>
                                    </td>
                                    <td class="border-top-0">
                                        <div class="centered-vertical m17b">
                                        </div>
                                        <div class="centered-vertical">
                                            <span class="centered">
                                                <p class="m0">{{ trans('attributes.borrowing.table.borrowing_day') }}</p>
                                                <span data-id='7' class="sort-icon"><i class="fa-sort-icon fa fa-caret-down" aria-hidden="true"></i></span>
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
                                                <span data-id='8' class="sort-icon"><i class="fa-sort-icon fa fa-caret-down" aria-hidden="true"></i></span>
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
                                                <span data-id='9' class="sort-icon"><i class="fa-sort-icon fa fa-caret-down" aria-hidden="true"></i></span>
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
                                                <span data-id='10' class="sort-icon"><i class="fa-sort-icon fa fa-caret-down" aria-hidden="true"></i></span>
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
                                                <span data-id='11' class="sort-icon"><i class="fa-sort-icon fa fa-caret-down" aria-hidden="true"></i></span>
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
                                                <span data-id='12' class="sort-icon"><i class="fa-sort-icon fa fa-caret-down" aria-hidden="true"></i></span>
                                            </span>
                                        </div>
                                    </td>
                                    <td class="border-top-0">
                                        <div class="centered-vertical m17b">
                                        </div>
                                        <div class="centered-vertical">
                                            <span class="centered">
                                                <p class="m0">{{ trans('attributes.borrowing.table.noi') }}<br>
                                                    ({{ trans('attributes.common.yen') }})
                                                </p>
                                                <span data-id='13' class="sort-icon"><i class="fa-sort-icon fa fa-caret-down" aria-hidden="true"></i></span>
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
                                                <span data-id='14' class="sort-icon"><i class="fa-sort-icon fa fa-caret-down" aria-hidden="true"></i></span>
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
                                                <span data-id='15' class="sort-icon"><i class="fa-sort-icon fa fa-caret-down" aria-hidden="true"></i></span>
                                            </span>
                                        </div>
                                    </td>
                                    <td class="border-top-0">
                                        <div class="centered-vertical m17b">
                                        </div>
                                        <div class="centered-vertical">
                                            <span class="centered">
                                                <p class="m0">{!! trans('attributes.property.assess_revenue_expenditure2') !!}</p>
                                                <span  data-id='16' class="sort-icon"><i class="fa-sort-icon fa fa-caret-down" aria-hidden="true"></i></span>
                                            </span>
                                        </div>
                                    </td>
                                    <td class="border-top-0">
                                        <div class="centered-vertical m17b">
                                        </div>
                                        <div class="centered-vertical">
                                            <span class="centered">
                                                <p class="m0">{{ trans('attributes.borrowing.table.the_main_purpose') }}</p>
                                                <span data-id='17' class="sort-icon"><i class="fa-sort-icon fa fa-caret-down" aria-hidden="true"></i></span>
                                            </span>
                                        </div>
                                    </td>
                                    <td class="border-top-0">
                                        <div class="centered-vertical m17b">
                                        </div>
                                        <div class="centered-vertical">
                                            <span class="centered">
                                                <p class="m0">{{ trans('attributes.borrowing.table.use_in_detail') }}</p>
                                                <span data-id='18' class="sort-icon"><i class="fa-sort-icon fa fa-caret-down" aria-hidden="true"></i></span>
                                            </span>
                                        </div>
                                    </td>
                                    <td class="border-top-0">
                                        <div class="centered-vertical m17b">
                                        </div>
                                        <div class="centered-vertical">
                                            <span class="centered">
                                                <p class="m0">{{ trans('attributes.borrowing.table.where_abouts') }}</p>
                                                <span data-id='19' class="sort-icon"><i class="fa-sort-icon fa fa-caret-down" aria-hidden="true"></i></span>
                                            </span>
                                        </div>
                                    </td>
                                    <td class="border-top-0 border-right-0">
                                        <div class="centered-vertical m17b">
                                        </div>
                                        <div class="centered-vertical">
                                            <span class="centered">
                                                <p class="m0">{{ trans('attributes.borrowing.table.borrowing_financial_institutions') }}</p>
                                                <span data-id='20' class="sort-icon"><i class="fa-sort-icon fa fa-caret-down" aria-hidden="true"></i></span>
                                            </span>
                                        </div>
                                    </td>
                                </tr>

                                @if(empty($params['paginate']))
                                    <div class="d-none">{{ $stepNumber = ($listData->currentPage() - 1) * 10  }}</div>
                                @else
                                    <div class="d-none">{{ $stepNumber = ($listData->currentPage() - 1) * $params['paginate']  }}</div>
                                @endif
                                <tbody>
                                @php($totalAmountPaidAnnually = 0)
                                @php($totalDebtBalance = 0)
                                @php($totalNoi = 0)
                                @php($totalDscr = 0)
                                @php($totalPoint = 0)
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
                                        <span class="d-none">
                                            {{ $totalAmountPaidAnnually += round($data->amount_paid_annually) }}
                                            {{ $totalDebtBalance += round($data->debt_balance) }}
                                            {{ $totalNoi += round($data->noi) }}
                                            {{ $totalDscr += round($data->dscr, 2) }}
                                            {{ $totalPoint += round($data->synthetic_point) }}
                                        </span>
                                        <tr class="keep-all">
                                            <td  class="border-left-0" data-value="
                                                @if($stepNumber + $loop->index + 1 < 10)
                                                {{ '00' . ($stepNumber + $loop->index + 1) }}
                                                @elseif($stepNumber + $loop->index + 1 < 100)
                                                {{ '0' . ($stepNumber + $loop->index + 1) }}
                                                @endif">
                                                <div class="centered-vertical">
                                                    <label class="container-input p25l fw-normal">
                                                        <input class="house-borrowing" checked type="checkbox" name="id-chart" data-id="{{ $data->id }}">
                                                        <span class="checkmark"></span>
                                                        <span>
                                                            @if($stepNumber + $loop->index + 1 < 10)
                                                                {{ '00' . ($stepNumber + $loop->index + 1) }}
                                                            @elseif($stepNumber + $loop->index + 1 < 100)
                                                                {{ '0' . ($stepNumber + $loop->index + 1) }}
                                                            @endif
                                                        </span>
                                                    </label>
                                                </div>
                                            </td>
                                            <td class="border-top-0 name-color fw-bold">{{ $data->house_name ? $data->house_name : ''}}</td>
                                            <td class="border-top-0">{{ $data->status ? STATUS_HOUSE[$data->status] ? : '' : '' }}</td>
                                            <td class="border-top-0 @if(!in_array($currentUser->role, [BROKER, EXPERT])) pcH @endif">{{ $data->status ? $data->proprietor ? : 'ー' : '' }}</td>
                                            <td class="border-top-0 text-right">
                                                {{ dateTimeFormatBorrowing($data->date_year_registration_revenue, $data->date_month_registration_revenue) }}
                                            </td>
                                            <td class="border-top-0 text-right" data-value="{{ $data->money_receive_house }}" >{{ number_format($data->money_receive_house) }}</td>
                                            <td class="border-top-0 text-right" data-value="{{ $data->loan }}">{{ number_format($data->loan) }}</td>
                                            <td class="border-top-0">{{ $data->loan_date ? date("Y/m/d", strtotime($data->loan_date)) : "ー" }}</td >
                                            <td class="border-top-0" data-value="{{ $data->contract_loan_period }}">{{ number_format($data->contract_loan_period) . trans('attributes.common.year') }}</td>
                                            <td class="border-top-0" data-value="{{ $data->years_passed ?? 0 }}">{{ $data->years_passed ? $data->years_passed . trans('attributes.common.year') : '' }}</td>
                                            <td class="border-top-0" data-value="{{ $data->interest_rate }}">{{ number_format((float)$data->interest_rate, 2, '.', ',') . '%' }}</td>
                                            <td class="border-top-0 text-right" data-value="{{ $data->debt_balance }}">{{ number_format($data->debt_balance) }}</td>
                                            <td class="border-top-0 text-right" data-value="{{ $data->amount_paid_annually }}">{{ number_format($data->amount_paid_annually) }}</td>
                                            <td class="border-top-0 text-right" data-value="{{ $data->noi }}">{{ number_format($data->noi) }}</td>
                                            <td class="border-top-0 text-center" data-value="{{ $data->dscr }}">{{ number_format((float)$data->dscr, 2, '.', ',') . '%' }}</td>
                                            <td class="border-top-0 text-center" data-value="{{ $data->acquisition_price_yield }}">{{ number_format((float)$data->acquisition_price_yield, 2, '.', ',') . '%' }}</td>
                                            <td class="border-top-0 text-center" data-value="{{ $data->synthetic_point ? round($data->synthetic_point): 0 }}">{{ $data->synthetic_point ? round($data->synthetic_point) . ' points' : '0 points' }}</td>
                                            <td class="border-top-0">{{ isset($data->realEstateType->name) ? $data->realEstateType->name : 'ー' }}</td>
                                            <td class="border-top-0">{{ isset($data->detailRealEstateType->name) ? $data->detailRealEstateType->name : 'ー' }}</td>
                                            <td class="border-top-0">{{ $data->address_district ? $data->address_district : 'ー' }}</td>
                                            <td class="border-right-0">
                                                <div class="loan-bank-branch d-none">
                                                    {{ $data->loan_bank_name . '/' . $data->bank_branch_name }}
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr class="table-foot">
                                        <td class="border-0"></td>
                                        <td class="border-bottom-0 fw-bold text-left">{{ trans('attributes.borrowing.table.total') }}</td>
                                        <td class="border-bottom-0"></td>
                                        <td class="border-bottom-0"></td>
                                        <td class="border-bottom-0 @if(!in_array($currentUser->role, [BROKER, EXPERT])) pcH @endif"></td>
                                        <td class="border-bottom-0 text-right">{{ number_format($listData->sum('money_receive_house')) }}</td>
                                        <td class="border-bottom-0 text-right">{{ number_format($listData->sum('loan')) }}</td>
                                        <td class="border-bottom-0"></td>
                                        <td class="border-bottom-0 text-left">{{ number_format(divisionNumber($listData->sum('contract_loan_period'), $listData->count()), 1, ".", ",") . trans('attributes.common.year') }}</td>
                                        <td class="border-bottom-0 text-left">{{ $listData->sum('years_passed') ? number_format(divisionNumber($listData->sum('years_passed'), $listData->count()), 1, ".", ",") . trans('attributes.common.year') : '0' . trans('attributes.common.year') }}</td>
                                        <td class="border-bottom-0"></td>
                                        <td class="border-bottom-0 text-right">{{ number_format($totalDebtBalance) }}</td>
                                        <td class="border-bottom-0 text-right">{{ number_format($totalAmountPaidAnnually) }}</td>
                                        <td class="border-bottom-0 text-right">{{ number_format($totalNoi) }}</td>
                                        <td class="border-bottom-0 text-center">{{ number_format((float)division($totalNoi, $totalAmountPaidAnnually), 2, '.', ',') . '%' }}</td>
                                        <td class="border-bottom-0 text-center">{{ number_format((float)division($totalNoi, $listData->sum('money_receive_house')), 2, '.', ',') . '%' }}</td>
                                        <td class="border-bottom-0 text-center">{{ $totalPoint ? number_format(divisionNumber($totalPoint, $listData->count()), 2, '.', ',') . ' points' : '0 points' }}</td>
                                        <td class="border-bottom-0"></td>
                                        <td class="border-bottom-0"></td>
                                        <td class="border-bottom-0"></td>
                                        <td class="border-0"></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>

                {{--Paginate--}}
                <div class="row m-0 mb-5">
                    <div class="col-12 text-center text-sm-right text-lg-right p0 p15lr media-575-p20r media-575-p20l">
                        @if(!$currentUser->isSubUser())
                            <a href="{{ route(USER_BORROWING_SORT) }}" class="btn custom-btn-default fs15 sort-property borrowing-float-left fs14-sp p7t-sp h36 m0lr-sp">{{ trans('attributes.portfolio_analysis.text_btn_sort') }}</a>
                        @endif
                        <div class="btn-group m15l m30r d-none d-sm-inline-flex m3t">
                            <div class="btn label-option fs15 centered fs14-sp">{{ trans('attributes.portfolio_analysis.number_displayed') }}</div>
                            <div class="btn wrap-input-option fs14 w-40 p0">
                                <div class="style-select-option">
                                    <select class="select-paginate pointer" name="paginate">
                                        <option {{ isset($params['paginate']) && $params['paginate'] == 10 ? 'selected' : '' }} value="10">10{{ trans('attributes.portfolio_analysis.item') }}</option>
                                        <option {{ isset($params['paginate']) && $params['paginate'] == 20 ? 'selected' : '' }} value="20">20{{ trans('attributes.portfolio_analysis.item') }}</option>
                                        <option {{ isset($params['paginate']) && $params['paginate'] == 30 ? 'selected' : '' }} value="30">30{{ trans('attributes.portfolio_analysis.item') }}</option>
                                        <option {{ isset($params['paginate']) && $params['paginate'] == 50 ? 'selected' : '' }} value="50"> 50{{ trans('attributes.portfolio_analysis.item') }}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="d-inline-block cus-paginate borrowing-float-right borrowing-m10r fs13-sp fs14 m10t m0lr-sp">
                            {{ $listData->links('backend.custom_pagination_borrowing', ['paginator' => $listData, 'param' => $params]) }}
                        </div>
                    </div>
                </div>

            {{--Chart--}}
            <div class="chart-block row"></div>

            {{--Footer button--}}
            <div class="row justify-content-end m15t p15lr m0">
                <a class="btn custom-btn-success btn-borrowing-preview d-none d-sm-block">{{ trans('attributes.portfolio_analysis.pre_print') }}</a>
            </div>

        </div>
    </div>

    {{--Preview--}}
    <div class="borrowing-preview preview-print background-print">
        @include('backend.property.borrowing_preview')
    </div>
@endsection
@section('js')
    <script src="{{ asset('dist/js/borrowing.min.js') }}"></script>
    <script type="text/javascript">
        let data = {!! json_encode($listData->toArray()) !!} ;
    </script>
@endsection

