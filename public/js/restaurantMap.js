"use strict";

(function($) {
    var instances = [];
    $.fn.restaurantMap = function (options) {
        instances[$(this).prop('id')] = $.extend({
            zoom: 7,
            useLocation: true,
            apiKey: null,
            searchInputField: 'map-search',
            longitude: -1.8243013,
            latitude: 52.5678167,

        }, options);

        var instance = instances[$(this).prop('id')];
        instance.map = new google.maps.Map($(this).find('.map-container')[0], {
            zoom: 11,
            center: {
                lat: instance.latitude,
                lng: instance.longitude
            }
        });
        var element = $(this);
        $(this).find('.search .use-geolocation').on('click', function () {
            element.getUserLocation(element);
        });
        $(this).find('.search .search-button').on('click', function () {
            element.performSearch(element);
        });
        $(this).find('.search .map-search').on('keypress', function (event) {
            if (event.which == 13) {
                element.performSearch(element);
            }
        });
        instance.directionsRenderer = new google.maps.DirectionsRenderer()
        instance.directionsRenderer.setMap(instance.map);
    };

    $.fn.getUserLocation = function (element) {
        var instance = instances[element.prop('id')];
        navigator.geolocation.getCurrentPosition(function (position){
            element.setUserLocation(
                element,
                {
                    latitude:  position.coords.latitude,
                    longitude:  position.coords.longitude,
                }
            );
            element.updateSearchBar(element);
        }, function () {
            alert('Opps...  You need to allow access to your location');
        });
    };

    $.fn.setUserLocation = function (element, position) {
        var instance = instances[element.prop('id')];
        instance.latitude = position.latitude;
        instance.longitude = position.longitude;
    };

    $.fn.updateMapPosition = function (element) {
        var instance = instances[element.prop('id')];
        let newCenterPoint = new google.maps.LatLng(
            instance.latitude,
            instance.longitude
        );
        instance.map.setCenter(newCenterPoint);
    };

    $.fn.updateSearchBar = function (element) {
        var instance = instances[element.prop('id')];
        var geocoder = new google.maps.Geocoder;
        var latlng = {
            lat: parseFloat(instance.latitude),
            lng: parseFloat(instance.longitude)
        };
        geocoder.geocode(
            { 'location' : latlng },
            function(results, status) {
                if (status === 'OK') {
                    if (results[0]) {
                        element.find('.search .map-search')[0].value = results[0].formatted_address;
                        element.performSearch(element);
                    } else {
                        alert('No results found');
                    }
                } else {
                    alert('error');
                }
            }
        );
    };

    $.fn.performSearch = function(element) {
        var instance = instances[element.prop('id')];
        $.post('/api/get-closest', {
            search: element.find('.search .map-search')[0].value
        }).done(function (response) {
            instance.toLocation = response;
            element.setUserLocation(element,
                {
                    latitude:  parseFloat(response.fromLatitude),
                    longitude:  parseFloat(response.fromLongitude),
                });
            element.drawRoute(element);
        });
    };

    $.fn.setToMarker = function(element) {
        var instance = instances[element.prop('id')];
        if (!!instance.toMarker) {
            instance.toMarker.setMap(null);
            instance.toMarker = null;
        }
        instance.marker = new google.maps.Marker({
            position: {
                lat: parseFloat(instance.toLocation.latitude),
                lng: parseFloat(instance.toLocation.longitude)
            },
            map: instance.map,
            title: instance.toLocation.restaurant
        });
    };

    $.fn.drawRoute = function(element) {
        var instance = instances[element.prop('id')];

        var request = {
            origin: {
                lat: parseFloat(instance.latitude),
                lng: parseFloat(instance.longitude)
            },
            destination: {
                lat: parseFloat(instance.toLocation.latitude),
                lng: parseFloat(instance.toLocation.longitude)
            },
            travelMode: google.maps.TravelMode.DRIVING
        };

        var bounds = new google.maps.LatLngBounds();
        bounds.extend(request.origin);
        bounds.extend(request.destination);

        instance.map.fitBounds(bounds);

        new google.maps.DirectionsService().route(request, function (response, status) {
            if (status == google.maps.DirectionsStatus.OK) {
                instance.directionsRenderer.setDirections(response);
                instance.directionsRenderer.setMap(instance.map);
            }
        });
    };

}(jQuery));
