<!DOCTYPE html>
<html lang="{{config('app.locale')}}">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name') }}</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{ asset('css/fontawesome-free-5.6.1.min.css')}}">
    <link rel="stylesheet" href="{{ asset('css/datepicker.standalone.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/custom.min.css') }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    @yield('styles')
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/datepicker.min.js') }}"></script>
    <script src="{{ asset('js/datepicker.ja.min.js') }}"></script>
    <script src="{{ asset('js/dropzone.js') }}"></script>
    <script src="{{ asset('js/cleave.js') }}"></script>
    <script src="{{ asset('js/common/common.js') }}"></script>
    <script src="{{ asset('js/highcharts/highstock.js')}}"></script>
    <script src="{{ asset('js/highcharts/highcharts-more.js')}}"></script>
    <script src="{{ asset('js/common/excelFormulas.js') }}"></script>
    <script src="{{ asset('js/common/highcharts.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/slick.min.js') }}"></script>
    @yield('script-files')
</head>

@include('layout.home.header')

<body>
<div id="wrapper-master">
    @include('layout.home.sidebar')
    <div class="content-wrapper" @if($currentUser && $currentUser->isAdmin()) {{ 'id=admin-site' }} @endif">
        @yield('content')
    </div>
</div>
</body>

@yield('js')
<script src="{{ asset('js/adminlte.min.js') }}"></script>
<script src="{{ asset('dist/js/custom.min.js') }}"></script>
<script src="{{ asset('js/custom_input.js') }}"></script>
</html>
