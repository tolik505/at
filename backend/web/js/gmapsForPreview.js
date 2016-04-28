var CoordsFromBaseLat = 23.559698564166673;
var CoordsFromBaseLon = 6.630943730000016;
var ZoomFromBaseLon = 2;

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

//console.log(document.getElementById('map').getAttribute('data-markers-array'));
console.log($('#map').data('markers-array'));
console.log(('#map').attr('data-markers-array'));
var markerArray = $('#map').data('markers-array');
if(markerArray.length) {

    for (var i = 0; i < markerArray.length; ++i) {
        //console.log(parseFloat(markerArray[i].lat), parseFloat(markerArray[i].long))
        var marker = new google.maps.Marker({
            position: {
                lat: parseFloat(markerArray[i].lat),
                lng: parseFloat(markerArray[i].long)
            },
            map: map
        });
        //attachSecretMessage(marker, secretMessages[i]);
    }
}




