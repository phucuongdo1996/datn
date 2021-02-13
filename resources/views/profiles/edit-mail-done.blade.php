@extends('layout.base')
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/register/step3.css') }}">
@endsection
@section('content')
    <div class="container container-reset-password">
        <div class="title-forgot-pw title-forgot-pw_2 text-center fw-bold p90t fs40">{{__('attributes.email_change_done.title')}}</div>
        <div class="forgot-pw-step4 p15b">
            <div class="label-forgot-pw text-center fs16 m65t text-danger fw-bold">{{__('attributes.email_change_done.sub_title')}}</div>
            <div class="label-forgot-pw text-center fs16 m15t">{{__('attributes.email_change_done.content')}}</div>
            <div class="margin-auto text-center m60t m60b">
                <a href="{{ route(TOP) }}">
                    <button type="button"
                            class="btn btn-submit btn-forgot-pass text-white label-forgot-pw custom-top-btn-primary">{{__('attributes.email_change_done.button')}}
                    </button>
                </a>
            </div>
        </div>
    </div>
@endsection
