@extends('layout.home.master')
@section('content')
    <div class="container-fluid container-wrapper container-wrapper-bank">
        <form class="form-search-bank" action="{{ route(USER_PROPERTY_LIST_SEARCH) }}">
            <div id="main-info-assessment">
                <div class="row row-header m50b">
                    <div class="row m0">
                        <div class="col-12 text-center text-md-left p0">
                            <h3 class="m0">{{ __('attributes.search_bank.title') }}</h3>
                        </div>
                    </div>
                </div>

                <div class="col-8 m30b p0">
                    <input type="hidden" value="{{ empty($params) ? FLAG_ZERO : FLAG_ONE}}" class="check-param-url">
                    <div class="m0 diagram-analysis">
                        <div class="diagram-block p0">
                            <div class="p30">
                                <div class="d-flex m25b m0l">
                                    <p class="fs16 fw-bold m0">{{ __('attributes.search_bank.condition') }}</p>
                                </div>

                                <div class="row m-0 p0">
                                    <div class="m30r p0 d-flex align-items-center">
                                        <span class="d-inline-block fs14">{{ __('attributes.search_bank.select_title') }}</span>
                                    </div>
                                    <div class="w-70 col-12-sp p0">
                                        <div class="w-auto m20r">
                                            <div class="btn wrap-input-option w230 p0 br4">
                                                <select name="real_estate_type_search" class="extraction option-paginate-1 btn form-control hp100 p3 p15r p15l fs14">
                                                    @foreach(REAL_ESTATE_TYPE_SEARCH as $key => $item)
                                                        <option class="m20r m20l" value="{{ $key }}"
                                                            @if(isset($params['real_estate_type_search']) && $key == $params['real_estate_type_search'])
                                                            {{ 'selected' }}
                                                            @endif
                                                        >{{ $item }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @include('backend.property.search.conditions')

                        </div>
                    </div>
                </div>

                <div class="d-flex col-8 text-center text-lg-right m0 p0">
                    <div class="w-auto text-center text-md-right m0 ml-auto p0">
                        <button type="submit" class="bank-search btn custom-btn-primary fs15 sort-property m0 p18l p18r w-auto">{{ __('attributes.search_bank.search') }}</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
@section('js')
    <script src="{{ asset('dist/js/search.min.js') }}"></script>
@endsection
