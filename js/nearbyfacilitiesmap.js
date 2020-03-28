const marker     = [];
const infoWindow = [];
let map;

function initMap() {
    const initPos = new google.maps.LatLng(nearby_lat, nearby_lng);
    const map_options = {
        zoom: zoom,
        center: initPos,
    }
    map[container_id] = new google.maps.Map(document.getElementById(container_id), map_options);

    const markersData = Array.from(points);
    for (let i = 0; i < markersData.length; i++) {
        const LatLng = new google.maps.LatLng({
            lat: markersData[i]['lat'],
            lng: markersData[i]['lng']
        });
        marker[i] = new google.maps.Marker({
            position: LatLng,
            map: map[container_id],
            // icon: {
            //     url: "images/icon-flag.png",
            //     size: new google.maps.Size(33, 49),
            //     origin: new google.maps.Point(0, 0),
            //     anchor: new google.maps.Point(0, 49),
            //     scaledSize: new google.maps.Size(33, 49),
            // },
            // title: 'TITLE',
            // visible: true,
            // clickable: true,
            // draggable: false,
            // opacity: 1,
            // zIndex: i,
            animation: google.maps.Animation.DROP // or BOUNCE
        });
        infoWindow[i] = new google.maps.InfoWindow({
            content: `<p class="txt12"><strong>${markersData[i]['name']}</strong></p>` //,
            // maxWidth: 200,
            // pixelOffset: new google.maps.Size(-9, -15),
            // zIndex: i,
        });
        markerEvent(i);
    }
}

function markerEvent(i) {
    // Configurable event handlers are click, dblclick, mousemove, mouseout, mouseover, rightclick
    google.maps.event.addListener(marker[i], 'click', function () {
        infoWindow[i].open(map, marker[i]);
        // Add bounce motion.
        var bounceMotion = marker[i].getAnimation() !== null ? null : google.maps.Animation.BOUNCE;
        marker[i].setAnimation(bounceMotion);
    });
}
google.maps.event.addDomListener(window, 'resize', function () {
    var center = map.getCenter();
    google.maps.event.trigger(map, 'resize');
    map.setCenter(center);
});
