<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'MNFFL') }}</title>

    <!-- Styles -->
    <link href="{{ mix('/css/app.css') }}" rel="stylesheet">

    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/7fe5eb3b95.js"></script>
</head>
<body>
    <div id="app">

        @include('inc.navbar')

        <div id="background-image">
        </div>

        <main class="container" id="main-content">
            
            @include('inc.messages')

            @yield('content')

        </main>

        <footer style="height: 100px">
        </footer>

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}"></script>
        
    </div>
</body>
</html>