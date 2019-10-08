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
        instances[$(this).prop('id')].map = new google.maps.Map($(this).find('.map-container')[0], {
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
    };

    $.fn.getUserLocation = function (element) {
        var instance = instances[element.prop('id')];
        navigator.geolocation.getCurrentPosition(function (position){
            element.setUserLocation(
                element,
                position
            );
            element.updateMapPosition(element);
            element.updateSearchBar(element);
            element.performSearch(element);
        }, function () {
            alert('Opps...  You need to allow access to your location');
        });
    };

    $.fn.setUserLocation = function (element, position) {
        var instance = instances[element.prop('id')];
        instance.latitude = position.coords.latitude;
        instance.longitude = position.coords.longitude;
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

    }


}(jQuery));
