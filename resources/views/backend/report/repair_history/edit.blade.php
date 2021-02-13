@extends('layout.home.master')
@section('content')
    <div class="container-fluid container-wrapper container-padding container-wrapper-add">
        <form id="form-data-update-repair-history" action="{{ route(USER_REPAIR_HISTORY_UPDATE , ['propertyId' => $record->property_id]) }}" method="POST">
            @method('PUT')
            @csrf
            @include('partials.flash_messages')
            <input type="text" name="id" class="d-none" value="{{ $record->id }}">
            <input type="text" name="property_id" class="d-none" value="{{ $record->property_id }}">
            <input type="text" name="time_open_page" class="d-none" value="{{ date('Y/m/d H:i:s', time()) }}">
            <input type="text" name="option_paginate" class="d-none" value="{{ $optionPaginate }}">
            <div id="main-info-assessment">
                <div class="row row-header m50b">
                    <div class="row m0">
                        <div class="col-12 text-center text-md-left p0">
                            <h3 class="m0">{{ trans('attributes.property.history_edit') }} - <span class="fs24 fw-normal">{{ $property->house_name }}</span></h3>
                        </div>
                    </div>
                </div>

                <div class="w-45 m30b">
                    <div class="m0 diagram-analysis">
                        <div class="p30 diagram-block">
                            <div class="d-flex m30b m0l">
                                <p class="fs16 fw-bold m0">{{ trans('attributes.repair_history.edit.title') }}</p>
                            </div>

                            <div class="row m-0 p0">
                                <div class="w-30 col-12-sp p0 d-flex align-items-center">
                                    <span class="d-inline-block">{{ trans('attributes.repair_history.classify') }}</span>
                                </div>
                                <div class="w-70 col-12-sp p0">
                                    <div class="w-auto m20r">
                                        @php($isOldInput = session()->has('_old_input'))
                                        <div class="btn wrap-input-option-copy w230 p0 br4 @error('classify') input-error @enderror">
                                            <select name="classify" class="option-paginate-1 btn form-control hp100 p3 p15r p15l fs14">
                                                @if($isOldInput && old('classify') === null)
                                                    <option value="" {{ $isOldInput && old('classify') === null ? 'selected' : '' }}>---</option>
                                                    @foreach(CLASSIFY as $classify)
                                                        <option value="{{ $classify }}" {{ ($isOldInput && old('classify') == $classify)  ? 'selected' : '' }}>{{ $classify }}</option>
                                                    @endforeach
                                                @elseif($isOldInput && old('classify') != null)
                                                    <option value="">---</option>
                                                    @foreach(CLASSIFY as $classify)
                                                        <option value="{{ $classify }}" {{ old('classify') == $classify  ? 'selected' : '' }}>{{ $classify }}</option>
                                                    @endforeach
                                                @elseif(!$isOldInput)
                                                    <option value="">---</option>
                                                    @foreach(CLASSIFY as $classify)
                                                        <option value="{{ $classify }}" {{ $record['classify'] == $classify  ? 'selected' : '' }}>{{ $classify }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    @error('classify')<div class="m5t"></div><span class="text-red error-repair-history fs12" data-error="classify">{{ $message }}</span>@enderror
                                </div>
                            </div>

                            <div class="row m-0 m15t p0">
                                <div class="w-30 col-12-sp p0 d-flex">
                                    <span class="d-inline-block">{{ trans('attributes.repair_history.describe') }}</span>
                                </div>
                                <div class="w-70 col-12-sp p0">
                                    <div class="w-100 m20r">
                                        <textarea name="describe" id="items" cols="15" rows="5" class="form-control m0 p13 p15l p15r h-auto fs14 text-left">{{ old('describe', $record->describe) }}</textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="row m-0 m15t p0">
                                <div class="w-30 col-12-sp p0 d-flex align-items-center">
                                    <span class="d-inline-block">{{ trans('attributes.repair_history.order_repair_date') }}</span>
                                </div>
                                <div class="w-70 col-12-sp p0">
                                    <div class="w230 m20r">
                                        <input type="text" name='order_repair_date' value="{{ old('order_repair_date', $record->order_repair_date ? date('Y/m/d', strtotime($record->order_repair_date)) : '') }}"
                                               class="form-control m0 p13 p8l p8r h-auto fs14 text-left date-time @error('order_repair_date') input-error @enderror"
                                               @error('order_repair_date') autofocus @enderror />
                                        @error('order_repair_date')<div class="m5t"></div><span class="text-red error-repair-history fs12" data-error="order_repair_date">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row m-0 m15t p0">
                                <div class="w-30 col-12-sp p0 d-flex align-items-center">
                                    <span class="d-inline-block">{{ trans('attributes.repair_history.construction_completion_date') }}</span>
                                </div>
                                <div class="w-70 col-12-sp p0">
                                    <div class="w230 m20r">
                                        <input type="text" name="construction_completion_date" value="{{ old('construction_completion_date', $record->construction_completion_date ? date('Y/m/d', strtotime($record->construction_completion_date)) : '') }}"
                                               class="form-control m0 p13 p8l p8r h-auto fs14 text-left date-time @error('construction_completion_date') input-error @enderror"
                                               @error('construction_completion_date') autofocus @enderror />
                                        @error('construction_completion_date')<div class="m5t"></div><span class="text-red error-repair-history fs12" data-error="construction_completion_date">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row m-0 m15t p0">
                                <div class="w-30 col-12-sp p0 d-flex align-items-center">
                                    <span class="d-inline-block">{{ trans('attributes.repair_history.payment_excluding_tax_1') }} {{ trans('attributes.repair_history.payment_excluding_tax_2') }} </span>
                                </div>
                                <div class="w-70 col-12-sp p0">
                                    <div class="row m0">
                                        <div class="col-10 p0 mw230">
                                            <input type="text" name="payment_excluding_tax" value="{{ old('payment_excluding_tax', $record->payment_excluding_tax) }}"
                                                   class="form-control m0 p13 p8l p8r h-auto fs14 text-right convert-data @error('payment_excluding_tax') input-error @enderror"
                                                   @error('payment_excluding_tax') autofocus @enderror />
                                        </div>
                                        <div class="col-2 centered-vertical fs14">{{ trans('attributes.common.yen') }}</div>
                                    </div>
                                    @error('payment_excluding_tax')<div class="m5t"></div><span class="text-red error-repair-history fs12" data-error="payment_excluding_tax">{{ $message }}</span>@enderror
                                </div>
                            </div>

                            <div class="row m-0 m15t p0">
                                <div class="w-30 col-12-sp p0 d-flex align-items-center">
                                    <span class="d-inline-block">{{ trans('attributes.repair_history.payment_date') }}</span>
                                </div>
                                <div class="w-70 col-12-sp p0">
                                    <div class="w230 m20r">
                                        <input type="text" name="payment_date" value="{{ old('payment_date', $record->payment_date ? date('Y/m/d', strtotime($record->payment_date)) : '') }}"
                                               class="form-control m0 p13 p8l p8r h-auto fs14 text-left date-time @error('payment_date') input-error @enderror"
                                               @error('payment_date') autofocus @enderror />
                                        @error('payment_date')<div class="m5t"></div><span class="text-red error-repair-history fs12" data-error="payment_date">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row m-0 m15t p0">
                                <div class="w-30 col-12-sp p0 d-flex align-items-center">
                                    <span class="d-inline-block">{{ trans('attributes.repair_history.payment_side') }}</span>
                                </div>
                                <div class="w-70 col-12-sp p0">
                                    <div class="w230 m20r">
                                        <input type="text" name="payment_side" class="form-control m0 p13 p8l p8r h-auto fs14 text-left" value="{{ old('payment_side', $record->payment_side ?? '') }}"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-flex col-12 text-center text-lg-right m0 p0">
                    <div class="w-auto text-center text-md-right m20r m p0">
                        <a href="{{ buttonBackPages(request()->all(), $property->id) }}"
                           class="btn custom-btn-default fs15 sort-property m0 p18l p18r w-auto btn-cancel">{{ trans('attributes.button.btn_cancel') }}</a>
                    </div>

                    <div class="w-auto text-center text-md-right m0 p0">
                        <button type="submit" class="p0 border-0 m0 w-auto btn-update-repair">
                            <a class="btn custom-btn-primary fs15 sort-property m0 p18l p18r w-auto btn-update-repair">{{ trans('attributes.repair_history.edit.btn_update') }}</a>
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
