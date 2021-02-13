@extends('layout.home.master')
@section('content')
    <div class="content-wrapper">
        <div class="container-fluid container-wrapper container-wrapper-bank container-csv-download">
            <div id="main-info-assessment">
                <div class="row row-header mb-5">
                    <div class="row m0">
                        <div class="col-12 text-center text-md-left p0">
                            <h3 class="m0">{{ trans('attributes.admin_manager.user.title') }}{{ trans('attributes.admin_manager.user.csv_download') }}</h3>
                        </div>
                    </div>
                </div>

                <!--profile edit-->
                @include('partials.flash_messages')
                <form class="row" action="{{ route(ADMIN_MANAGE_USER_DOWNLOAD_CSV) }}">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">{{ trans('attributes.admin_manager.user.select_member_type') }}</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                        <i class="fas fa-minus"></i></button>
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="form-group">
                                    <label>{{ trans('attributes.invite_user.role') }}</label>
                                    <select class="form-control csv-role @error('role') input-error @enderror" name="role">
                                        <option value="" {{ old('role')=='' ? 'selected' : ''  }}>---</option>
                                        @foreach(ROLE as $key => $role)
                                            @php($item =isset($roles[$key]) ? $roles[$key]['total'] : 0)
                                            @php($subUser =isset($totalSubUser[$key]) ? $totalSubUser[$key]['total'] : 0)
                                            <option value="{{ $role }}" {{ old('role')==$role ? 'selected' : ''  }}>{{ $role . '(' . $item . ')' .' サブユーザー'. '(' . $subUser . ')'}}</option>
                                        @endforeach
                                    </select>
                                    @error('role')
                                        <div class="error-message error-message-role p5t m0">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>{{ trans('attributes.admin_manager.user.state') }}</label>
                                    <select class="form-control csv-status @error('status') input-error @enderror" name="status">
                                        <option value="" {{ old('status')=='' ? 'selected' : ''  }}>---</option>
                                        @foreach(STATUS_USER as $status)
                                            <option value="{{ $status }}" {{ old('status')==$status ? 'selected' : ''  }}>{{ $status }}</option>
                                        @endforeach
                                    </select>
                                    @error('status')
                                        <div class="error-message error-message-status p5t m0">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>{{ trans('attributes.admin_manager.user.number_of_sub_users') }}</label>
                                    <div class="row">
                                        <div class="col-6">
                                            <input type="text" class="form-control convert-data block-out-character" name="min_sub_users" placeholder="{{ trans('attributes.admin_manager.user.min') }}">
                                        </div>
                                        <div class="col-6">
                                            <input type="text" class="form-control convert-data block-out-character" name="max_sub_users" placeholder="{{ trans('attributes.admin_manager.user.max') }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>{{ trans('attributes.admin_manager.user.registration_date') }}</label>
                                    <div class="row">
                                        <div class="col-6">
                                            <input data-provide="datepicker" name="date_from_registration" type="text" class="form-control date-time date-from-registration @error('date_from_registration') input-error @enderror" placeholder="2020/01/01" value="{{ old('date_from_registration') }}">
                                            @error('date_from_registration')
                                            <div class="error-message error-date-from-registration p5t m0">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-6">
                                            <input data-provide="datepicker" name="date_to_registration" type="text" class="form-control date-time date-to-registration @error('date_to_registration') input-error @enderror" placeholder="2020/12/31" value="{{ old('date_to_registration') }}">
                                            @error('date_to_registration')
                                            <div class="error-message error-date-to-registration p5t m0">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>{{ trans('attributes.admin_manager.user.update_date') }}</label>
                                    <div class="row">
                                        <div class="col-6">
                                            <input data-provide="datepicker" name="date_from_last_payment" type="text" class="form-control date-time date-from-last-payment @error('date_from_last_payment') input-error @enderror" placeholder="2020/01/01" value="{{ old('date_from_last_payment') }}">
                                            @error('date_from_last_payment')
                                            <div class="error-message error-date-from-last-payment p5t m0">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-6">
                                            <input data-provide="datepicker" name="date_to_last_payment" type="text" class="form-control date-time date-to-last-payment @error('date_to_last_payment') input-error @enderror" placeholder="2020/12/31" value="{{ old('date_to_last_payment') }}">
                                            @error('date_to_last_payment')
                                            <div class="error-message error-date-to-last-payment p5t m0">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>{{ trans('attributes.admin_manager.topics.last_login_date') }}</label>
                                    <div class="row">
                                        <div class="col-6">
                                            <input data-provide="datepicker" name="date_from_last_login" type="text" class="form-control date-from-last-login date-time @error('date_from_last_login') input-error @enderror" placeholder="2020/01/01" value="{{ old('date_from_last_login') }}">
                                            @error('date_from_last_login')
                                            <div class="error-message error-date-from-last-login p5t m0">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-6">
                                            <input data-provide="datepicker" name="date_to_last_login" type="text" class="form-control date-time date-to-last-login @error('date_to_last_login') input-error @enderror" placeholder="2020/12/31" value="{{ old('date_to_last_login') }}">
                                            @error('date_to_last_login')
                                            <div class="error-message error-date-to-last-login p5t m0">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary btn-download-csv float-right">{{ trans('attributes.admin_manager.user.csv_download') }}</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="{{ asset('dist/js/download.min.js') }}"></script>
@endsection
