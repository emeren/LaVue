<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<meta name="csrf-token" content="{{ csrf_token() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'LaVue - cms starter ver 0.2 beta') }}</title>
    <link rel="shortcut icon" href="/backend/favicon.ico">

    <!-- Scripts -->
    <script src="{{ asset('/backend/js/backend.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('/backend/css/backend.css') }}" rel="stylesheet">

    </script>
</head>


@yield('content')


</html>