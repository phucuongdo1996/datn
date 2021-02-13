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
    <link rel="stylesheet" href="{{ asset('css/datepicker.standalone.min.css') }}">
    @yield('styles')
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/datepicker.min.js') }}"></script>
    <script src="{{ asset('js/datepicker.ja.min.js') }}"></script>
    <script src="{{ asset('js/dropzone.js') }}"></script>
    @yield('script-files')
</head>
<body>
@if(request()->route()->getPrefix() !== '/register' || (request()->route()->getPrefix() == '/register' && $currentUser))
    @include('layout.home.header')
    <div id="wrapper-master" class="wrapper-master-profile p0l">
        <div class="content-wrapper">
            @yield('content')
        </div>
@else
    <div id="wrapper">
        @include('layout/header')

        @yield('content')
@endif
        <div id="wrap">
            @include('layout.new_footer')
        </div>
    </div>
</body>
@yield('js')
<script src="{{ asset('dist/js/custom.min.js') }}"></script>
</html>
