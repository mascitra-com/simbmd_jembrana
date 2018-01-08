<!DOCTYPE html>
<html>
<head>
    <title> Map SIMBMD  </title>
    <!-- Load Komponen Open Layer -->
    <link rel="stylesheet" href="{{ base_url('assets/bootstrap/css/bootstrap.css') }}" type="text/css" />
    <link rel="stylesheet" href="{{ base_url('assets/openlayer/ol.css') }}" type="text/css" />

    <script src="{{ base_url('assets/jquery/jquery-1.9.1.js') }}"> </script>
    <script src="{{ base_url('assets/bootstrap/js/bootstrap.min.js') }}"> </script>

    <script src="{{ base_url('assets/openlayer/ol.js') }}"> </script>

</head>
<body>
<div id="map" class="map">
    <div id="popup"> </div>
</div>
<script>
    $(document).ready(function () {
        //menambahkan sebuah titik
        //mendeklarasikan titik

        var red = new ol.Feature({
            geometry: new ol.geom.Point(ol.proj.transform([114.767572, -3.753858], 'EPSG:4326',
                'EPSG:3857')), //koordinat posisi titik poltek
            name: 'Politala', //nama titik
            population: 4000, //informasi tambahan
            rainfall: 500 //informasi tambahan lainnya
        });

        var green = new ol.Feature({
            geometry: new ol.geom.Point(ol.proj.transform([114.788337, -3.80093], 'EPSG:4326',
                'EPSG:3857')), //koordinat posisi  taman
            name: 'Taman RTH', //nama titik
            population: 4000, //informasi tambahan
            rainfall: 500 //informasi tambahan lainnya
        });
        //deklarasikan jenis ikonnya
        var redPoint = new ol.style.Style({
            image: new ol.style.Icon(({
                src: '{{ base_url('assets/red-point.png') }}'
            }))
        });

        var greenPoint = new ol.style.Style({
            image: new ol.style.Icon(({
                src: '{{ base_url('assets/green-point.png') }}'
            }))
        });


        red.setStyle(redPoint);
        green.setStyle(greenPoint);

        var vectorSource = new ol.source.Vector({
            features: [red,green]
        });
        var vectorLayer = new ol.layer.Vector({
            source: vectorSource
        });
        var titikdb =[];
        $.ajax({
            type: "POST",
            url : "{{base_url('aset/kiba/'.$location)}}",
            success: function(data){
                var res = jQuery.parseJSON(data);
                for (var i = 0;i<res.length;i++) {
                    var icf = new ol.Feature({
                        geometry: new ol.geom.Point(ol.proj.transform([parseFloat(res[i][4]),parseFloat(res[i][3])],
                            'EPSG:4326', 'EPSG:3857')), //koordinat posisi titik
                        name: res[i][1], //nama titik
                        alamat: res [i][5], //informasi tambahan
                        info: res[i][6], //informasi tambahan lainnya
                        luas: res[i][7] //informasi tambahan lainnya
                    });
                    if(res[i][8]){
                        icf.setStyle(greenPoint); //set icon
                    } else {
                        icf.setStyle(redPoint); //set icon
                    }
                    titikdb.push(icf); //masukan kedalam array
                }
                var titikdatabase = new ol.source.Vector({
                    features:titikdb
                });
                console.log(titikdb);
                var map = new ol.Map({
                    layers: [ //lapisan layer untuk basemap
                        new ol.layer.Tile({
                            source: new ol.source.OSM() //mengambil basemap
                        }),//layer untuk ikon dimasukkan ke map
                        new ol.layer.Vector({
                            source: titikdatabase //mengambil basemap
                        })
                    ],

                    target: 'map', //komponen html yang dijadikan map
                    controls: ol.control.defaults({ //control => untuk zoom in dan out
                        attributionOptions: ({
                            collapsible: false
                        })
                    }),
                    view: new ol.View({ // view => kalo pertama kali di buka , maunya langsung kemana
                        center: ol.proj.transform([parseFloat(res[0][4]),parseFloat(res[0][3])],
                            'EPSG:4326', 'EPSG:3857'), //posisi pusat peta
                        @if($location == "get_all_json")
                        zoom: 6, //zoom level
                        @else
                        zoom: 16, //zoom level
                        @endif
                    })
                });

                //popup

                var element = document.getElementById('popup');

                var popup = new ol.Overlay({
                    element: element,
                    positioning: 'top-left',
                    stopEvent: false
                });
                map.addOverlay(popup);

                map.on('click', function(evt) {
                    var feature = map.forEachFeatureAtPixel(evt.pixel,
                        function(feature, layer) {
                            return feature;
                        });

                    if (feature) {
                        var geometry = feature.getGeometry();
                        var coord = geometry.getCoordinates();
                        popup.setPosition(coord);
                        $(element).attr( 'data-placement', 'top' );
                        $(element).attr( 'data-original-title',
                            '<b>'+feature.get('name')+'</b>' );
                        $(element).attr( 'data-content', '<pre>'
                            + 'Luas : '+feature.get('luas')
                            + '<br>Alamat : '+ feature.get('alamat')
                            +' </pre> ');
                        $(element).attr( 'data-html', true );
                        $(element).popover('show');
                    } else {
                        $(element).popover('destroy');
                    }
                });

            }
        });

    });
</script>

</body>
</html>