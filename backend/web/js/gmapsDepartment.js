var CoordsFromBaseLat = parseFloat($('#coordinates_x').val()) ? parseFloat($('#coordinates_x').val()) : -53.123213;
var CoordsFromBaseLon = parseFloat($('#coordinates_y').val()) ? parseFloat($('#coordinates_y').val()) : 151.12313123;

var CoordsFromBase = {lat: CoordsFromBaseLat, lng: CoordsFromBaseLon};



var map = new google.maps.Map(document.getElementById('map'), {
    zoom: 2,
    center: CoordsFromBase,
    scrollwheel: false,
    styles: [{
        stylers: [{
            saturation: -100
        }]
    }]
});

$(document).on('click', ".test_click", function() {
    console.log(123123);
    console.log(map.getCenter().lat(), map.getCenter().lng(), map.getZoom())
});

var markers =  [
    new google.maps.Marker({
        position: CoordsFromBase,
        map: map,
        icon:"/img/content/pin_icon.svg"
    })
];

var tooltips = [

];

//fix display on tab
$(document).on('click', "ul.nav-tabs li", function() {
    if($('#map').length) {
        google.maps.event.trigger(map, 'resize');
        map.setCenter(CoordsFromBase);
    }
});

//try to get coordinates with stackoverflow

google.maps.event.addListener(map, "rightclick", function(event) {
    var lat = event.latLng.lat();
    var lng = event.latLng.lng();
    // populate yor box/field with lat, lng
    console.log("Lat=" + lat + "; Lng=" + lng);

    $('#coordinates_x').val(lat);
    $('#coordinates_y').val(lng);

    clearMarkers();
    console.log(markers);
    mark = new google.maps.Marker({
        position: {lat: lat, lng: lng},
        map: map,
        icon:"/img/content/pin_icon.svg"
    });
    markers.push(mark);

});

//google.maps.event.addDomListener(window, "resize", function() {
//    var center = map.getCenter();
//    google.maps.event.trigger(map, "resize");
//    map.setCenter(center);
//});


//function initMap() {
//    $.each( tooltips, function( index, value ){
//        //window['infoWindow'+index] = new google.maps.InfoWindow({
//        //    content: tooltips[index]
//        //});
//
//        markers[index].addListener('click', function() {
//            window['infoWindow'+index].open(map,  markers[index]);
//            map.setZoom( Math.max(16));
//
//            map.setCenter(new google.maps.LatLng(markers[index].getPosition().H, markers[index].getPosition().L));
//        });
//
//    });
//
//
//}
////
//google.maps.event.addDomListener(window, 'load', initMap);


// Sets the map on all markers in the array.
function setMapOnAll(map) {
    for (var i = 0; i < markers.length; i++) {
        markers[i].setMap(map);
    }

}

// Removes the markers from the map, but keeps them in the array.
function clearMarkers() {
    setMapOnAll(null);
}






