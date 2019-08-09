var map, myLatlng, Coordenadas = { lat: 21.002562, lng: -89.395063 },
    marker;

function muestraMapa() {
    myLatlng = new google.maps.LatLng(Coordenadas);
    var a = { zoom: 16, center: Coordenadas };
    map = new google.maps.Map(document.getElementById("map-canvas"), a);
    placeMarker(new google.maps.LatLng(Coordenadas));
    var b = new google.maps.InfoWindow({ content: '<div id="siteNotice"></div><h5 id="firstHeading" class="firstHeading">H. Ayuntamiento de Tixkokob</h5><p>Calle 21, Tixkokob, 97470 Tixkokob, Yucatán</p></div></div>' });

    marker.addListener("click", function() {
        b.open(map, marker)
    })
}

function placeMarker(a) {
    marker = new google.maps.Marker({ position: a, map: map, title: "H. Ayuntamiento de Tixkokob" })
};