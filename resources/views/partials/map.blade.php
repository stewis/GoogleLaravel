<div class="map-container">

</div>
@push('scripts')
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
                    'apiKey': 'AIzaSyANw4md06yWy7JRPr1oVZG0pM2grwQK318'
                }
            );
        });
    </script>
@endpush