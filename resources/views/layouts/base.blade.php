<!DOCTYPE html>
<html lang="{{config('app.locale')}}">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name') }}</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{ asset('css/fontawesome-free-5.6.1.min.css')}}">
    <link rel="stylesheet" href="{{ asset('css/datepicker.standalone.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dota/common.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/toastr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/loading.min.css') }}">
    @yield('styles')
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/datepicker.min.js') }}"></script>
    <script src="{{ asset('js/slick.min.js') }}"></script>
    <script src="{{ asset('js/highcharts/highcharts.js') }}"></script>
    <script src="{{ asset('js/cleave.js') }}"></script>
    <script src="{{ asset('js/common/common.js') }}"></script>
    <script src="{{ asset('js/toastr.min.js') }}"></script>
    @yield('script-files')
</head>
<body>
<div id="wrapper" style="background-color: #c0c0c08c">
    <div class="position-fixed w-100 h-100" style="background: url('/images/background.jpeg'); filter: blur(1.5px)"></div>
    <div id="wrap">
        @yield('content')
    </div>
</div>
@yield('modal')
@include('layouts.loading')
</body>
<script>
    @if(\Illuminate\Support\Facades\Session::has(STR_FLASH_SUCCESS))
        toastr.success('{{ \Illuminate\Support\Facades\Session::get(STR_FLASH_SUCCESS) }}')
    @elseif(\Illuminate\Support\Facades\Session::has(STR_FLASH_ERROR))
        toastr.error('{{ \Illuminate\Support\Facades\Session::get(STR_FLASH_ERROR) }}', 'Error!')
    @endif
</script>
@yield('js')
</html>
