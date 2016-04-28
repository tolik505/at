var CoordsFromBaseLat = parseFloat($('#coordinates_x').val()) ? parseFloat($('#coordinates_x').val()) : -53.123213;
var CoordsFromBaseLon = parseFloat($('#coordinates_y').val()) ? parseFloat($('#coordinates_y').val()) : 151.12313123;
var ZoomFromBaseLon = parseFloat($('#scale').val()) ? parseFloat($('#scale').val()) : 2;

var CoordsFromBase = {lat: CoordsFromBaseLat, lng: CoordsFromBaseLon};

var map = new google.maps.Map(document.getElementById('map'), {
    zoom: ZoomFromBaseLon,
    center: CoordsFromBase,
    scrollwheel: false,
    styles: [{
        stylers: [{
            saturation: -100
        }]
    }]
});

google.maps.event.addListener(map, "bounds_changed", function(event) {
    //console.log(map.getCenter().lat(), map.getCenter().lng(), map.getZoom())

    var lat = map.getCenter().lat();
    var lng = map.getCenter().lng();
    var zoom = map.getZoom();
    // populate yor box/field with lat, lng
    console.log("Lat=" + lat + "; Lng=" + lng + "; Zoom=" + zoom);

    $('#coordinates_x').val(lat);
    $('#coordinates_y').val(lng);
    $('#scale').val(zoom);
});






