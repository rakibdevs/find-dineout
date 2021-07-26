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
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>
<body>
    <!-- loader END -->
    <div id="app">
        <div class="leading-normal tracking-normal" id="main-body">
            <div class="flex flex-wrap">
                <admin-header></admin-header>
                <div class="w-full bg-gray-100 pl-0 lg:pl-64 min-h-screen" :class="sideBarOpen ? 'overlay' : ''" id="main-content">
                    <admin-sidebar></admin-sidebar>
                    <div class="p-6 bg-gray-100 mb-20">
                        @yield('container')
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/app.js') }}"></script>
</body>