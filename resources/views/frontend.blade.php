<!DOCTYPE html>
<html lang="en">
    <head>
        <title>
            @section('title') Search @show
        </title>
        <link rel="stylesheet" href="{{ secure_asset('css/map.css') }}">
        <script src="https://kit.fontawesome.com/0ca262b039.js" crossorigin="anonymous"></script>
        <meta name="csrf-token" content="{{ csrf_token() }}">
    </head>
    <body>
        <div id="map">
        </div>
        <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
        <script async defer src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_API') }}"></script>
        <script src="{{secure_asset('js/restaurantMap.js')}}">
        </script>
        <script>
            $(document).ready( function() {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $('#map').restaurantMap(
                    {
                        'apiKey': '{{ env('GOOGLE_API') }}'
                    }
                );
            });
        </script>
    </body>
</html>
