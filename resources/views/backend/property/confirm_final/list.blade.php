@extends('layout.home.master')
@section('content')
    <div class="container-fluid container-wrapper container-wrapper-bank wrapper-bank-list">
        <div id="main-info-assessment" class="padding-container">
            <div class="row row-header m50b">
                <div class="row m0">
                    <div class="col-12 text-center text-md-left p0">
                        <h3 class="m0">{{trans('attributes.common.title')}}</h3>
                    </div>
                </div>
            </div>

            <form id="form-condition-1" class="col-12 text-lg-right m0 m30b p0 text-right group-button-top" action="{{route(USER_TAX_INDEX)}}" method="get">
                <a href="{{ route(USER_DOCUMENT_CONFIRM_FINAL_CREATE, ['option_paginate' => $params]) }}" class="btn custom-btn-default fs15 sort-property m15r w70">
                    {{ trans('attributes.tax.add') }}
                </a>
                <div class="btn-group m0">
                    <div class="paginate-opt btn label-option fs14 centered fw-bold p10">{{trans('attributes.common.option_paginate')}}</div>
                    <div class="btn wrap-input-option fs14 w-45 p0">
                        <select name="option_paginate" class="select-paginate option-paginate-1 btn form-control hp100 p0 p15r p5l">
                            @foreach(LIST_OPTION_PAGINATE as $key => $value)
                                <option class="m20r m20l" value="{{ $key }}" @if($params == $key) {{'selected'}} @endif>{{ $value }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="d-inline-block cus-paginate">
                    {{ $taxes->appends(['option_paginate' => $optionPaginate])->links('partials.simple_paginate', ['totalPage' => $totalPage]) }}
                </div>
            </form>

            <div class="row m0 m30b br10 bg-white">
                <div class="table-responsive br10">
                    <table id="table-property" class="table table-bordered table-striped table-tax border-0 m0">
                        <tr class="table-head">
                            <td class="{{$style}} border-0 text-center"><div>{{trans('attributes.common.year_2')}}</div></td>
                            @if($currentUser->role == BROKER || $currentUser->role == EXPERT)
                                <td class="{{$style}} border-top-0 text-center">
                                    <div class="centered-vertical text-center">
                                        <span class="centered">
                                            <p class="m0 text-center">{!! trans('attributes.property.report_owner') !!}</p>
                                            <span data-id='1' class="sort-icon"><i class="fa-sort-icon fa fa-caret-down" aria-hidden="true"></i></span>
                                        </span>
                                    </div>
                                </td>
                            @endif
                            <td class="{{$style}} border-top-0 text-center"><div>{{trans('attributes.common.income')}}</div></td>
                            <td class="{{$style}} border-top-0"><div class="w90"></div></td>
                            <td class="border-top-0"><div></div></td>
                        </tr>
                        @forelse($taxes as $tax)
                        <tr class="table">
                            <td class="border-left-0 text-center">{{$tax['year'].trans('attributes.rent_roll_list.year').' '.$tax['month'].trans('attributes.common.lunar_month')}}</td>
                            @if($currentUser->role == BROKER || $currentUser->role == EXPERT)
                                <td class="border-top-0 text-left" data-text="{{ $tax['proprietor'] ?? 'ー' }}">{{ $tax['proprietor'] ?? 'ー' }}</td>
                            @endif
                            <td class="border-bottom-0 text-left td-name">
                                @foreach($tax['property'] as $house_name)
                                    {{ $house_name['house_name'] }} <br>
                                @endforeach
                            </td>
                            <td class="border-bottom-0 text-center">
                                <div class="centered m5b">
                                    <div class="image">
                                        <img src="{{asset('images/icon_report_check.png')}}" alt="" />
                                    </div>
                                </div>
                                <div class="row centered">
                                    <a href="{{ route(USER_DOCUMENT_CONFIRM_FINAL_EDIT, ['id' => $tax->id,'option_paginate' => $params]) }}">{{trans('attributes.common.edit')}}</a><span class="m0 m5r m5l">/</span>
                                    <a href="{{ route(USER_DOCUMENT_CONFIRM_FINAL_EDIT, [$tax->id, 'option_paginate' => $params, 'show_print' => true]) }}">{{trans('attributes.common.export')}}</a>
                                </div>
                            </td>
                            <td class="border-top-0 border-bottom-0 border-left-0 border-right-0 text-center">
                                <input type="hidden" value="{{$optionPaginate}}" class="option-paginate-list">
                                <input type="hidden" value="{{$totalPage}}" class="page-list">
                                <a href="#" class="remove_cfl">
                                    <i class="far fa-trash-alt btn-delete-tax" data-id="{{ $tax->id }}" data-value="{{$tax['year'].trans('attributes.rent_roll_list.year').''.$tax['month'].trans('attributes.common.lunar_month')}}"></i>
                                </a>
                            </td>
                        </tr>
                        @empty
                            <tr>
                                <td class="td-no-data text-center" colspan="@if($currentUser->role == BROKER || $currentUser->role == EXPERT) 5 @else 4 @endif" >{{ trans('attributes.tax.no_data') }}</td>
                            </tr>
                        @endforelse
                    </table>
                </div>
            </div>

            <form id="form-condition-1" class="col-12 text-lg-right m0 m30b p0 text-right group-button-top" action="{{route(USER_TAX_INDEX)}}" method="get">
                <a href="{{ route(USER_DOCUMENT_CONFIRM_FINAL_CREATE, ['option_paginate' => $params]) }}" class="btn custom-btn-default fs15 sort-property m15r w70">
                    {{ trans('attributes.tax.add') }}
                </a>
                <div class="btn-group m0">
                    <div class="paginate-opt btn label-option fs14 centered fw-bold p10">{{trans('attributes.common.option_paginate')}}</div>
                    <div class="btn wrap-input-option fs14 w-45 p0">
                        <select name="option_paginate" class="select-paginate option-paginate-1 btn form-control hp100 p0 p15r p5l">
                            @foreach(LIST_OPTION_PAGINATE as $key => $value)
                                <option class="m20r m20l" value="{{ $key }}" @if($params == $key) {{'selected'}} @endif>{{ $value }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="d-inline-block cus-paginate">
                    {{ $taxes->appends(['option_paginate' => $optionPaginate])->links('partials.simple_paginate', ['totalPage' => $totalPage]) }}
                </div>
            </form>
        </div>
    </div>
    @include('modal.confirm_delete_tax')
@endsection
@section('js')
    <script src="{{ asset('dist/js/tax.min.js') }}"></script>
@endsection

