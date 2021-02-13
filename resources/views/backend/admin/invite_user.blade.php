@extends('layout.home.master')
@section('content')
<div class="container-fluid container-wrapper container-wrapper-bank invite-user">
    <form id="invite-user" action="{{ route(ADMIN_USER_STORE) }}" method="POST">
        @csrf
        <input name="verified_token" type="hidden" value="{{ old('verified_token') ?? $verifiedToken }}">
        <div class="row row-header mb-5">
            <div class="row m0">
                <div class="col-12 text-center text-md-left p0">
                    <h3 class="m0">{{ __('attributes.invite_user.title') }}</h3>
                </div>
            </div>
        </div>
        @include('partials.flash_messages')
        <!--profile edit-->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{ __('attributes.invite_user.title_2') }}</h3>
                        <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                            <i class="fas fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label>{{ __('attributes.invite_user.name') }}</label>
                            <div class="row">
                                <div class="col-6">
                                    <input name="person_charge_last_name" data-name="last-name" type="text" class="form-control  @error('person_charge_last_name') input-error @enderror" placeholder="{{ __('attributes.invite_user.last_name') }}" value="{{ old('person_charge_last_name') }}" >
                                    @error('person_charge_last_name')<p class="error-message m5t">{{ $message }}</p>@enderror
                                </div>
                                <div class="col-6">
                                    <input name="person_charge_first_name" data-name="first-name" type="text" class="form-control @error('person_charge_first_name') input-error @enderror" placeholder="{{ __('attributes.invite_user.first_name') }}" value="{{ old('person_charge_first_name') }}" >
                                    @error('person_charge_first_name')<p class="error-message m5t">{{ $message }}</p>@enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>{{ __('attributes.invite_user.mail_address') }}</label>
                            <input name="email" data-name="mail" type="text" class="form-control @error('email') input-error @enderror" placeholder="" value="{{ old('email') }}">
                            @error('email')<p class="error-message m5t">{{ $message }}</p>@enderror
                            <input name="password" type="hidden" value="{{ old('password') ?? $password }}">
                        </div>
                        <div class="form-group">
                            <label>{{ __('attributes.invite_user.role') }}</label>
                            <select name="role" class="form-control">
                                @foreach(ROLES_JA as $key => $value)
                                    <option value="{{ $key }}" @if(old('role') && old('role') == $key) selected  @endif>{{ $value }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>{{ __('attributes.invite_user.label_send_mail') }}</label>
                            <input type="text" class="form-control" placeholder="" value="{{ __('attributes.invite_user.title_mail') }}"  disabled="">
                            <div class="form-control mt-2 mail-preview" disabled>
                                <div><span class="last-name">{{ old('person_charge_last_name') ? old('person_charge_last_name') : '｛'.__('attributes.invite_user.last_name').'｝' }}</span><span class="first-name">{{ old('person_charge_first_name') ? old('person_charge_first_name') : '｛'.__('attributes.invite_user.first_name').'｝' }}</span><span>{{ __('attributes.invite_user.gender') }}</span></div>
                                <br>
                                <div><span>{{ __('attributes.invite_user.content_1') }}</span><span class="role">{{ ROLES_JA[old('role')] ?? ROLES_JA[FLAG_ZERO] }}</span><span>{{ __('attributes.invite_user.content_1_2') }}</span></div>
                                <div>{{ __('attributes.invite_user.content_2') }}</div>
                                <br>
                                <div>{{ url('register/authentication').'/'.(old('verified_token') ?? $verifiedToken) }}</div>
                                <br>
                                <div>{{ __('attributes.invite_user.content_3') }}</div>
                                <div><span>{{ __('attributes.invite_user.content_4') }} : </span><span class="email">{{ old('email') ?? __('attributes.invite_user.content_5') }}</span></div>
                                <div>{{ __('attributes.invite_user.content_6') }} : {{ old('password') ?? $password }}</div>
                                <br>
                                <div>{{ __('attributes.invite_user.content_8') }}</div>
                                <div>{{ __('attributes.invite_user.content_9') }}</div>
                                <div>{{ __('attributes.invite_user.content_10') }}</div>
                                <div>{{ __('attributes.invite_user.content_11') }}</div>
                                <div>{{ __('attributes.invite_user.content_12') }}</div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button id="btn-send" type="submit" class="btn btn-primary float-right">{{ __('attributes.invite_user.btn_send') }}</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
@section('js')
    <script src="{{ asset('dist/js/invite-user.min.js') }}"></script>
@endsection
