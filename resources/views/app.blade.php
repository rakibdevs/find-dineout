<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') - </title>
    <!-- Favicon -->
    <link rel="shortcut icon" href="" />
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('plugins/1.3.0/css/line-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>
<body>
    <!-- loader END -->
    <div id="app" class="@yield('class')">
        <router-view></router-view>
        <header-component></header-component>
        <div class="main-content">
            @yield('container')
        </div>
        @include('include.footer')
    </div>
    <script src="{{ asset('js/app.js') }}"></script>
</body>