@extends('modal.preview.common_preview')
@section('title', trans('attributes.property.history_edit'))
@section('content_preview')
    <div id="pre-print-business-plan" class="background-print">
        <div id="block-page" class="container p0">
            <div class="content-preview">
                <div class="page-preview-print m0t">
                    <div class="modal-header centered-vertical border-0 p0"></div>

                    <div class="row m-0">
                        <div class="col-12 p0">
                            <div class="row m-0">
                                <table class="table table-bordered table-preview table-preview-analysis tb-pre-1 m-0 m10b">
                                    <tbody>
                                    <tr>
                                        <td class="w150 text-center fw-bold">{{ trans('attributes.property.house_name') }}</td>
                                        <td>{{ $property->house_name ?? '' }}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div class="row m-0">
                                <table class="table table-bordered table-preview table-preview-analysis tb-pre-1 m-0">
                                    <thead>
                                    <tr>
                                        <td class="fw-bold text-center align-middle w-4dot6">{{ trans('attributes.borrowing.table.no') }}</td>
                                        <td class="fw-bold text-center align-middle w-6">{{ trans('attributes.repair_history.classify') }}</td>
                                        <td class="fw-bold text-center align-middle  w-31">{{ trans('attributes.repair_history.describe') }}</td>
                                        <td class="fw-bold text-center align-middle">{{ trans('attributes.repair_history.order_repair_date') }}</td>
                                        <td class="fw-bold text-center align-middle">{{ trans('attributes.repair_history.construction_completion_date') }}</td>
                                        <td class="fw-bold text-center align-middle">{{ trans('attributes.repair_history.payment_excluding_tax_1') }}<br />
                                            {{ trans('attributes.repair_history.payment_excluding_tax_2') }}({{ trans('attributes.common.yen') }})</td>
                                        <td class="fw-bold text-center align-middle">{{ trans('attributes.repair_history.payment_date') }}</td>
                                        <td class="fw-bold text-center align-middle w-16">{{ trans('attributes.repair_history.payment_side') }}</td>
                                    </tr>
                                    </thead>
                                    @forelse($records as $record)
                                    <tr>
                                        <td class="text-center">{{ $loop->index + 1 }}</td>
                                        <td class="">{{ $record->classify ?? '' }}</td>
                                        <td class="break-all" data-text="{{ $record->describe ?? 'ー' }}">{{ $record->describe ?? '' }}</td>
                                        <td class="">{{ $record->order_repair_date ? date('Y/m/d', strtotime($record->order_repair_date)) : '' }}</td>
                                        <td class="">{{ $record->construction_completion_date ? date('Y/m/d', strtotime($record->construction_completion_date)) : '' }}</td>
                                        <td class="text-right" data-value="{{ $record->payment_excluding_tax }}">{{ $record->payment_excluding_tax ? number_format($record->payment_excluding_tax) : 0 }}</td>
                                        <td class="">{{ $record->payment_date ? date('Y/m/d', strtotime($record->payment_date)) : '' }}</td>
                                        <td class="">{{ $record->payment_side ?? '' }}</td>
                                    </tr>
                                    @empty
                                        <tr>
                                            <td class="text-center" colspan="8" >{{ trans('attributes.rent_roll_list.no_data') }}</td>
                                        </tr>
                                    @endforelse
                                    @if(count($records) != FLAG_ZERO)
                                        <tr>
                                            <td class="text-center">{{ trans('attributes.simulation.content.operating_revenue.sum') }}</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td class="convert-data text-right">{{number_format($sumPaymentExcludingTax)}}</td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                    @endif
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
