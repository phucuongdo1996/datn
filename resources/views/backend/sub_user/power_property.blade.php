@extends('layout.home.master')
@section('content')
    <div class="container-fluid container-wrapper container-wrapper-bank container-power-property">
        <div class="row row-header mb-5">
            <div class="col-12 col-md-7 text-center text-md-left p0">
                <h3 class="m0">{{ trans('attributes.sub_user.power_property.title') }}</h3>
            </div>
            <div class="col-12 col-md-5 text-right text-md-right">
                <a href="{{ route(SUB_USER_PROFILE_CREATE) }}" class="btn custom-btn-default fs13-sp m5t d-none d-sm-inline-block fs15">{{ trans('attributes.sub_user.power_property.btn_add_sub_user') }}</a>
            </div>
        </div>

        @include('partials.flash_messages')

        <div class="row">
            <div class="col-12">
                <input type="hidden" name="total_property" value="{{ $totalProperty }}">
                <input type="hidden" name="total_user" value="{{ $totalUser }}">
                @forelse($listProperty as $key => $property)
                    @php
                        $key = $listProperty->currentPage() - FLAG_ONE > FLAG_ZERO ? (($listProperty->currentPage() - FLAG_ONE) * FLAG_TEN) + $key : $key;
                        $data = array_key_exists($property['id'], $listData) ? array_combine(array_column($listData[$property['id']], 'user_id'), $listData[$property['id']]) : [];
                    @endphp
                    <form id="from-sub-user-property" method="post" action="{{ route(SUB_USER_PROPERTY_STORE) }}">
                        @csrf
                    <div class="card">
                            <div class="card-header">
                                <input type="hidden" class="property-{{ $key }}" name="property_id" value="{{ $property['id'] }}">
                                <h3 class="card-title">{{ $property['house_name'] }}</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                        <i class="fas fa-minus"></i></button>
                                </div>
                            </div>

                                <div class="card-body p-0">
                                    <div class="row m0 br10 bg-white">
                                        <div class="table-responsive">

                                            <table class="table table-bordered table-striped border-0 m0">
                                                <thead>
                                                <tr>
                                                    <th class="w-40">{{ trans('attributes.article_photo.user_name') }}</th>
                                                    <th class="text-center w-15">{{ trans('attributes.sub_user.power_property.power_view') }}</th>
                                                    <th class="text-center w-15">{{ trans('attributes.sub_user.power_property.power_edit') }}</th>
                                                    <th class="text-center w-15">{{ trans('attributes.property.delete_house') }}</th>
                                                    <th class="text-center w-15">{{ trans('attributes.sub_user.power_property.power_report') }}</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($listUser as $index => $user)
                                                    <tr>
                                                        <input type="hidden" class="permission-{{ $key.$index }}" name="permission[]" value="{{ array_key_exists($user['id'], $data) ? $data[$user['id']]['permission'] : FLAG_ZERO }}">
                                                        <input type="hidden" class="user-{{ $key.$index }}" name="user_id[]" value="{{ $user['id'] }}">
                                                        <input type="hidden" name="id[]" value="{{ array_key_exists($user['id'], $data) ? $data[$user['id']]['id'] : FLAG_ZERO }}">
                                                        <td>{{ $user['profile']['person_charge_last_name'] . $user['profile']['person_charge_first_name']  }}</td>
                                                        <td class="">
                                                            <div class="form-check text-center p0">
                                                                <input class="form-check-input m0 permission-view-{{ $key.$index }}" type="checkbox" >
                                                            </div>
                                                        </td>
                                                        <td class="">
                                                            <div class="form-check text-center p0">
                                                                <input class="form-check-input m0 permission-edit-{{ $key.$index }}" type="checkbox" >
                                                            </div>
                                                        </td>
                                                        <td class="">
                                                            <div class="form-check text-center p0">
                                                                <input class="form-check-input m0 permission-delete-{{ $key.$index }}" type="checkbox" >
                                                            </div>
                                                        </td>
                                                        <td class="">
                                                            <div class="form-check text-center p0">
                                                                <input class="form-check-input m0 permission-report-{{ $key.$index }}" type="checkbox" >
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer clearfix">
                                    <button type="submit" class="btn btn-primary pull-right btn-create-sub-property btn-create-sub-property-{{ $key }}" disabled>{{ trans('attributes.sub_user.btn_save_power') }}</button>
                                </div>
                        </div>
                    </form>
                @empty
                    <p class="text-center fs18">{{ __('messages.no_data') }}</p>
                @endforelse
            </div>
            @if(count($listProperty) != FLAG_ZERO)
                <div class="d-inline-block cus-paginate m0 w-100 text-right">
                    {{ $listProperty->appends(['option_paginate' => LIMIT_RECORD_DEFAULT])->links('partials.simple_paginate', ['totalPage' => $listProperty->lastPage()]) }}
                </div>
            @endif
        </div>
    </div>
@endsection
@section('js')
    <script src="{{ asset('/dist/js/sub-user-property.min.js') }}"></script>
@endsection
