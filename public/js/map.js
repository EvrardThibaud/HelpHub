let mapOptions = {
    center:[45.90347575,6.1276757575],
    zoom:10
}


let map = new L.map('map' , mapOptions);

let layer = new L.TileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png');
map.addLayer(layer);

let marker = new L.Marker([45.903457575,6.12767575757]);
marker.addTo(map);