<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no">

        <title>myMap</title>
        <script type="text/javascript" src="https://openapi.map.naver.com/openapi/v3/maps.js?ncpClientId=f9athoezy6&submodules=geocoder"></script>
    </head>
    <body>
        <h1>myMap</h1>
        <a href="/">홈</a>
        <div id="map" style="width:100%;height:400px;">
            <form style="position: absolute;z-index: 1000;top: 20px;left: 20px;">
                <input type="text">
                <button>버튼</button>
            </form>
        </div>

        <script>
        var map = new naver.maps.Map("map", {
            center: new naver.maps.LatLng(37.3595316, 127.1052133),
            zoom: 15,
            mapTypeControl: true
        });

        var infoWindow = new naver.maps.InfoWindow({
            anchorSkew: true
        });

        map.setCursor('pointer');

        function searchCoordinateToAddress(latlng) {

        infoWindow.close();

        naver.maps.Service.reverseGeocode({
            coords: latlng,
            orders: [
            naver.maps.Service.OrderType.ADDR,
            naver.maps.Service.OrderType.ROAD_ADDR
            ].join(',')
        }, function(status, response) {
            if (status === naver.maps.Service.Status.ERROR) {
            if (!latlng) {
                return alert('ReverseGeocode Error, Please check latlng');
            }
            if (latlng.toString) {
                return alert('ReverseGeocode Error, latlng:' + latlng.toString());
            }
            if (latlng.x && latlng.y) {
                return alert('ReverseGeocode Error, x:' + latlng.x + ', y:' + latlng.y);
            }
            return alert('ReverseGeocode Error, Please check latlng');
            }

            var address = response.v2.address,
                htmlAddresses = [];

            if (address.jibunAddress !== '') {
                htmlAddresses.push('[지번 주소] ' + address.jibunAddress);
            }

            if (address.roadAddress !== '') {
                htmlAddresses.push('[도로명 주소] ' + address.roadAddress);
            }

            infoWindow.setContent([
            '<div style="padding:10px;min-width:200px;line-height:150%;">',
            '<h4 style="margin-top:5px;">검색 좌표</h4><br />',
            htmlAddresses.join('<br />'),
            '</div>'
            ].join('\n'));

            infoWindow.open(map, latlng);
        });
        }

        function searchAddressToCoordinate(address) {
        naver.maps.Service.geocode({
            query: address
        }, function(status, response) {
            if (status === naver.maps.Service.Status.ERROR) {
            if (!address) {
                return alert('Geocode Error, Please check address');
            }
            return alert('Geocode Error, address:' + address);
            }

            if (response.v2.meta.totalCount === 0) {
            return alert('No result.');
            }

            var htmlAddresses = [],
            item = response.v2.addresses[0],
            point = new naver.maps.Point(item.x, item.y);

            if (item.roadAddress) {
            htmlAddresses.push('[도로명 주소] ' + item.roadAddress);
            }

            if (item.jibunAddress) {
            htmlAddresses.push('[지번 주소] ' + item.jibunAddress);
            }

            if (item.englishAddress) {
            htmlAddresses.push('[영문명 주소] ' + item.englishAddress);
            }

            infoWindow.setContent([
            '<div style="padding:10px;min-width:200px;line-height:150%;">',
            '<h4 style="margin-top:5px;">검색 주소 : '+ address +'</h4><br />',
            htmlAddresses.join('<br />'),
            '</div>'
            ].join('\n'));

            map.setCenter(point);
            infoWindow.open(map, point);
        });
        }

        function initGeocoder() {
        if (!map.isStyleMapReady) {
            return;
        }

        map.addListener('click', function(e) {
            searchCoordinateToAddress(e.coord);
        });

        $('#address').on('keydown', function(e) {
            var keyCode = e.which;

            if (keyCode === 13) { // Enter Key
            searchAddressToCoordinate($('#address').val());
            }
        });

        $('#submit').on('click', function(e) {
            e.preventDefault();

            searchAddressToCoordinate($('#address').val());
        });

        searchAddressToCoordinate('정자동 178-1');
        }

        naver.maps.onJSContentLoaded = initGeocoder;
        naver.maps.Event.once(map, 'init_stylemap', initGeocoder);
        </script>
    </body>
</html>