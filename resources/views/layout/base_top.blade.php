<!DOCTYPE html>
<html lang="{{config('app.locale')}}">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name') }}</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/custom.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{ asset('css/fontawesome-free-5.6.1.min.css')}}">
    <link rel="stylesheet" href="{{ asset('css/datepicker.standalone.min.css') }}">
    ////
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    @yield('styles')
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/datepicker.min.js') }}"></script>
    <script src="{{ asset('js/datepicker.ja.min.js') }}"></script>
    <script src="{{ asset('js/highcharts/exporting.js') }}"></script>
    <script src="{{ asset('js/highcharts/highcharts.js') }}"></script>
    @yield('script-files')
</head>
<body>
<div id="wrapper" style="position: absolute; top: 0 !important;">
    <div id="wrap">
        @yield('content')

        @include('layout.new_footer')
    </div>
</div>
</body>
@yield('js')
<script src="{{ asset('dist/js/custom.min.js') }}"></script>
<script src="{{ asset('dist/js/new_top.min.js') }}"></script>
</html>
