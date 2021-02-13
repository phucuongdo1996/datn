@extends('layout.home.master')
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/preview/repair_history.css') }}">
@endsection
@section('content')
<div class="container-fluid container-wrapper container-wrapper-history">
    <div id="main-info-assessment" class="@if(request('show_print') == true) has-print @endif">
        <div class="row row-header m50b">
            <div class="row m0">
                <div class="col-12 text-center text-md-left p0">
                    <h3 class="m0">{{ trans('attributes.property.history_edit') }} - <span class="fs24 fw-normal">{{ $property->house_name }}</span></h3>
                </div>
            </div>
        </div>
    </div>
    @include('partials.flash_messages')
    <input type="text" class="d-none property-id" value="{{ $property->id }}">
    <form id="form-list-repair-history" class="row m0 m30b">
            <div class="col-6 text-center text-md-right m0 p0 row">
                @if(in_array($currentUser->role, [BROKER, EXPERT]))
                <div id="block-status" class="row spBlock m0 w-auto">
                    <div class="centered first-block p15r p15l">
                        <label class="m0">{{ trans('attributes.repair_history.owner') }}</label>
                    </div>
                    <div class="centered-vertical p0 p15r p15l w250">
                        <div class="fw-normal home-owner"> {{ $property->proprietor ?? 'ー' }}</div>
                    </div>
                </div>
                @endif
            </div>
        <div class="col-6 col-12-sp text-center text-lg-right p0 text-right">
            <div class="btn-group w-auto m0">
                <div class="btn label-option fs14 centered fw-bold p15r p15l">{{ trans('attributes.repair_history.total_records') }}</div>
                <div class="btn wrap-input-option fs14 w100 p0">
                    <select name="option_paginate" class="option-paginate-1 page-repair-history btn form-control hp100 m0 p0 p15r p15l">
                        @foreach(LIST_OPTION_PAGINATE as $key => $value)
                            <option class="m20r m20l" value="{{ $key }}" @if($optionPaginate == $key) {{'selected'}} @endif>{{ $value }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <a href="{{ route(USER_REPAIR_HISTORY_CREATE, [ 'propertyId' => $property->id, 'screen' => 'list_repair_history', 'option_paginate' => $optionPaginate , 'page'=> $records->currentPage()]) }}" class="btn custom-btn-primary fs15 sort-property m20l w-auto">{{ trans('attributes.repair_history.add_item') }}</a>
            <button type="button" class="btn custom-btn-success fs15 btn-borrowing-preview d-none d-sm-inline-block fs13-sp m20l media-767-m7l h36 pre-print-repair show-print">{{ trans('attributes.property.display_preview') }}</button>
        </div>
    </form>

    <div class="row m0 m30b br10 bg-white">
        <div class="table-responsive fs14 br10">
            <table id="table-property" class="table-repair-history table table-bordered table-striped border-0 m0">
                <tr class="table-head">
                    <td class="border-0">
                        <div class="w35">
                            <div class="centered-vertical">
                                <span>{{ trans('attributes.borrowing.table.no') }}</span>
                                <span class="sort-icon sort-icon-first" data-id="0"><i class="fa-sort-icon fa fa-caret-down" aria-hidden="true"></i></span>
                            </div>
                        </div>
                    </td>
                    <td class="border-top-0">
                        <div class="w50">
                            <div class="centered-vertical">
                                <span>{{ trans('attributes.repair_history.classify') }}</span>
                                <span class="sort-icon" data-id="1"><i class="fa-sort-icon fa fa-caret-down" aria-hidden="true"></i></span>
                            </div>
                        </div>
                    </td>
                    <td class="border-top-0">
                        <div class="w700">
                            <div class="centered-vertical">
                                <span>{{ trans('attributes.repair_history.describe') }}</span>
                                <span class="sort-icon" data-id="2"><i class="fa-sort-icon fa fa-caret-down" aria-hidden="true"></i></span>
                            </div>
                        </div>
                    </td>
                    <td class="border-top-0">
                        <div class="w80">
                            <div class="centered-vertical">
                                <span>{{ trans('attributes.repair_history.order_repair_date') }}</span>
                                <span class="sort-icon" data-id="3"><i class="fa-sort-icon fa fa-caret-down" aria-hidden="true"></i></span>
                            </div>
                        </div>
                    </td>
                    <td class="border-top-0">
                        <div class="w90">
                            <div class="centered-vertical">
                                <span>{{ trans('attributes.repair_history.construction_completion_date') }}</span>
                                <span class="sort-icon" data-id="4"><i class="fa-sort-icon fa fa-caret-down" aria-hidden="true"></i></span>
                            </div>
                        </div>
                    </td>
                    <td class="border-top-0">
                        <div class="w90">
                            <div class="centered-vertical">
                                <span class="centered">
                                    <p class="m0">{{ trans('attributes.repair_history.payment_excluding_tax_1') }}<br />{{ trans('attributes.repair_history.payment_excluding_tax_2') }}</p>
                                    <span class="sort-icon" data-id="5"><i class="fa-sort-icon fa fa-caret-down" aria-hidden="true"></i></span>
                                </span>
                            </div>
                            <span class="fs11">({{ trans('attributes.common.yen') }})</span>
                        </div>
                    </td>
                    <td class="border-top-0">
                        <div class="w80">
                            <div class="centered-vertical">
                                <span>{{ trans('attributes.repair_history.payment_date') }}</span>
                                <span class="sort-icon" data-id="6"><i class="fa-sort-icon fa fa-caret-down" aria-hidden="true"></i></span>
                            </div>
                        </div>
                    </td>
                    <td class="border-top-0">
                        <div class="w80">
                            <div class="centered-vertical">
                                <span>{{ trans('attributes.repair_history.payment_side') }}</span><span class="sort-icon"></span>
                            </div>
                        </div>
                    </td>
                    <td class="border-top-0 border-right-0">
                        <div class="centered-vertical w20"></div>
                    </td>
                </tr>

                @if(empty($optionPaginate))
                    <div class="d-none">{{ $stepNumber = ($records->currentPage() - 1) * 10 }}</div>
                @else
                    <div class="d-none">{{ $stepNumber = ($records->currentPage() - 1) * $optionPaginate }}</div>
                @endif

                @php($sumPaymentExcludingTax = 0)
                @forelse($records as $record)
                    @php($sumPaymentExcludingTax += $record->payment_excluding_tax)
                    <tr class="table" data-id="{{ $record->id }}">
                        <td class="border-left-0">
                            @if($stepNumber + $loop->index + 1 < 10)
                                {{ '00' . ($stepNumber + $loop->index + 1) }}
                            @elseif($stepNumber + $loop->index + 1 < 100)
                                {{ '0' . ($stepNumber + $loop->index + 1) }}
                            @endif
                        </td>
                        <td class="border-top-0 border-left-0">{{ $record->classify ?? 'ー' }}</td>
                        <td class="border-top-0 border-left-0" data-text="{{ $record->describe ?? 'ー' }}">
                            <a href="{{ route(USER_REPAIR_HISTORY_EDIT, [ 'propertyId' => $record->property_id, 'repairId' => $record->id, 'screen' => 'list_repair_history', 'option_paginate' => $optionPaginate , 'page'=> $records->currentPage()]) }}" class="fw-bold">{{ $record->describe ?? 'ー' }}</a>
                        </td>
                        <td class="border-top-0 border-left-0">{{ $record->order_repair_date ? date('Y/m/d', strtotime($record->order_repair_date)) : 'ー' }}</td>
                        <td class="border-top-0 border-left-0">{{ $record->construction_completion_date ? date('Y/m/d', strtotime($record->construction_completion_date)) : 'ー' }}</td>
                        <td class="border-top-0 border-left-0 text-right" data-value="{{ $record->payment_excluding_tax }}">{{ $record->payment_excluding_tax ? number_format($record->payment_excluding_tax) : 0 }}</td>
                        <td class="border-top-0 border-left-0">{{ $record->payment_date ? date('Y/m/d', strtotime($record->payment_date)) : 'ー' }}</td>
                        <td class="border-top-0 border-left-0">{{ $record->payment_side ?? 'ー' }}</td>
                        <td class="border-top-0 border-left-0 border-right-0 text-center"><a class="delete-repair-history pointer" data-id="{{ $record->id }}"><i class="far fa-trash-alt"></i></a></td>
                    </tr>
                @empty
                    <td colspan="9" class="text-center">{{ __('attributes.repair_history.no_data') }}</td>
                @endforelse
                <tr class="table-foot">
                    <td class="border-0"></td>
                    <td class="border-bottom-0 text-left">{{ trans('attributes.borrowing.table.total') }}</td>
                    <td class="border-bottom-0"></td>
                    <td class="border-bottom-0"></td>
                    <td class="border-bottom-0"></td>
                    <td class="border-bottom-0 convert-data text-right">{{number_format($sumPaymentExcludingTax)}}</td>
                    <td class="border-bottom-0"></td>
                    <td class="border-bottom-0"></td>
                    <td class="border-bottom-0"></td>
                </tr>
            </table>
        </div>
    </div>

    <div class="row col-12 text-center text-lg-right m0 p0">
        <div class="col-6 text-center text-md-right m0 p0 row">
            <a href="{{ route(USER_REPAIR_HISTORY_CREATE, [ 'propertyId' => $property->id, 'screen' => 'list_repair_history', 'option_paginate' => $optionPaginate , 'page'=> $records->currentPage()]) }}" class="btn custom-btn-primary fs15 sort-property m0 w-auto">{{ trans('attributes.repair_history.add_item') }}</a>
        </div>

        <div class="col-6 text-center text-lg-right p0 text-right">
            <div class="btn-group w-auto m0">
                <div class="btn label-option fs14 centered fw-bold p15r p15l">{{ trans('attributes.repair_history.total_records') }}</div>
                <div class="btn wrap-input-option fs14 w100 p0">
                    <select name="option_paginate" class="option-paginate-1 page-repair-history btn form-control hp100 p0 p15r p15l">
                        @foreach(LIST_OPTION_PAGINATE as $key => $value)
                            <option class="m20r m20l" value="{{ $key }}" @if($optionPaginate == $key) {{ 'selected' }} @endif>{{ $value }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            {{ $records->appends(['option_paginate' => $optionPaginate])->links('partials.simple_paginate', ['totalPage' => $totalPage]) }}
        </div>
    </div>
</div>
@include('backend.preview_print.repair_history_print')
@include('modal.confirm_delete_repair_history')
@endsection
@section('js')
    <script src="{{ asset('dist/js/repair_history.min.js') }}"></script>
@endsection
