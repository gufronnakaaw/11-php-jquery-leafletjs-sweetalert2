<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/leaflet/leaflet.css">
    <link rel="stylesheet" href="css/leaflet/leaflet.draw.css">
    <style>
        #map {
            height: 600px;
            width: 600px;
        }
    </style>
</head>
<body>
    <div id="map"></div>
    
    <script src="js/leaflet/leaflet.js"></script>

    <script src="js/leaflet-draw/Leaflet.draw.js"></script>
    <script src="js/leaflet-draw/Control.Draw.js"></script>
    <script src="js/leaflet-draw/Leaflet.Draw.Event.js"></script>

    <script src="js/leaflet-draw/Toolbar.js"></script>
    <script src="js/leaflet-draw/Tooltip.js"></script>
    <script src="js/leaflet-draw/draw/DrawToolbar.js"></script>
    
    <script src="js/leaflet-draw/edit/handler/Edit.Marker.js"></script>

    <script src="js/leaflet-draw/draw/handler/Draw.Feature.js"></script>
    <script src="js/leaflet-draw/draw/handler/Draw.Polyline.js"></script>
    <script src="js/leaflet-draw/draw/handler/Draw.Polygon.js"></script>
    <script src="js/leaflet-draw/draw/handler/Draw.SimpleShape.js"></script>
    <script src="js/leaflet-draw/draw/handler/Draw.Rectangle.js"></script>
    <script src="js/leaflet-draw/draw/handler/Draw.Marker.js"></script>
    <script src="js/leaflet-draw/draw/handler/Draw.CircleMarker.js"></script>
    <script src="js/leaflet-draw/draw/handler/Draw.Circle.js"></script>

    <script src="js/leaflet-draw/ext/TouchEvents.js"></script>
    <script src="js/leaflet-draw/edit/EditToolbar.js"></script>
    <script src="js/leaflet-draw/edit/handler/EditToolbar.Edit.js"></script>
    <script src="js/leaflet-draw/edit/handler/EditToolbar.Delete.js"></script>
    
    <script src="js/leaflet-draw/ext/TouchEvents.js"></script>
    <script src="js/leaflet-draw/ext/LatLngUtil.js"></script>
    
    <script>
        let curLocation = [-6.200000, 106.816666];

        let map = L.map('map').setView(curLocation, 5);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        var drawnItems = new L.FeatureGroup();
        map.addLayer(drawnItems);

        var drawControl = new L.Control.Draw({
            position: 'topright',
            draw: {
                circlemarker: false,
                rectangle: false,
                polyline: false,
                polygon: false,
                circle: false,
                marker: true
            },
            edit: {
                featureGroup: drawnItems,
                remove: true
            }
        });
        map.addControl(drawControl);
        map.on(L.Draw.Event.CREATED, function (e) {
            var type = e.layerType,
                layer = e.layer;

            if (type === 'marker') {
                let position = layer.getLatLng();
                let lat = position.lat;
                let long = position.lng;

                
            }

            drawnItems.addLayer(layer);
        });

        map.on('draw:editmove', function (e) {
            // var layers = e.layers;

            // let position = e._lastCenter();

            console.log(e.target);
        });
    </script>
</body>
</html>