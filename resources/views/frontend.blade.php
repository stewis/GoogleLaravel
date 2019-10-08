<!DOCTYPE html>
<html lang="en">
    <head>
        <title>
            @section('title') Search @show
        </title>
        <link rel="stylesheet" href="{{ secure_asset('css/map.css') }}">
        <script src="https://kit.fontawesome.com/0ca262b039.js" crossorigin="anonymous"></script>
    </head>
    <body>
        <div id="map">
            @include('partials.nav')
            @include('partials.map')
        </div>
        <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
        @stack('scripts')
    </body>
</html>
