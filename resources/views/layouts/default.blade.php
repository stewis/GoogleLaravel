<!DOCTYPE html>
<html lang="en">
    <head>
        <title>
            @section('title') Search Tool @show
        </title>
        @stack('css')
        <link rel="stylesheet" href="{{ secure_asset('css/map.css') }}">
        <script src="https://kit.fontawesome.com/0ca262b039.js" crossorigin="anonymous"></script>
        <meta name="csrf-token" content="{{ csrf_token() }}">
    </head>
    <body>
        @yield('content')
        @stack('scripts')
    </body>
</html>
