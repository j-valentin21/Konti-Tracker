<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{-- Part: all meta-related contents --}}
    @yield('head-meta')
    {{-- Part: site title with default value in parent --}}
    <title> @yield('title')</title>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Title -->
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Titillium+Web:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@900&display=swap" rel="stylesheet">
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('img/logo-icon.png') }}"  type='image/x-icon'>
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    {{-- Part: anything else in head --}}
    @yield('head-extra')
</head>
<body class= @yield("class")>
    <div id= @yield("id")>
        {{-- Part: something at start of body --}}
        @yield('body-start')

        {{-- Part: header of body --}}
        @section('body-header')

        @show

        {{-- Part: create main content of the page --}}
        @yield('body-content')

        {{-- Part: footer --}}
        @section('body-footer')
            {{-- Part: footer is probably shared across many pages --}}
        @show
    </div>
        {{-- Part: load scripts --}}
        @yield('body-scripts')
        {{-- Part: something else to do --}}
        @yield('body-others')
        {{-- Part: finalize stuffs if there is --}}
        @yield('body-end')
</body>
</html>
