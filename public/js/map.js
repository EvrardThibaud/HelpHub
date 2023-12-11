$.ajax({
    url: 'action.blade.php',
    method: 'GET',
    dataType: 'json',
    success: function(data) {
        var coordonneeX = data.coordonneeX;
        var coordonneeY = data.coordonneeY;
    },
    error: function() {
        console.error('Erreur lors de la récupération des données.');
    }
});

let mapOptions = {
    center:[coordonneeX,coordonneeY],
    zoom:10
}


let map = new L.map('map' , mapOptions);

let layer = new L.TileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png');
map.addLayer(layer);

let marker = new L.Marker([coordonneeX,coordonneeY]);
marker.addTo(map);