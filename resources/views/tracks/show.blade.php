<!DOCTYPE html>
<html lang="en">
<head>
    <title>Bootstrap Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
          integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
          crossorigin=""/>

</head>
<body onload="init()">

<br>

<div class="container">

    <div class="panel panel-primary">
        <div class="panel-heading">Welcome to Tracks</div>
        <div class="panel-body">

            {{$track->name}}

            <div id="map" style = "height:800px;width:800px" >

            </div>



{{--            <table class="table">
                <thead>
                <tr>
                    <th scope="col">Lat</th>
                    <th scope="col">Long</th>
                    <th scope="col">Elev</th>
                </tr>
                </thead>
                <tbody>



                @foreach ($track->points as $point)
                    <tr>
                        <td>{{$point->latitude}}</td>
                        <td>{{$point->longitude}}</td>
                        <td>{{$point->elevation}}</td>


                    </tr>

                @endforeach

                </tbody>
            </table>--}}




        </div>
    </div>

</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

<!-- Make sure you put this AFTER Leaflet's CSS -->
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
        integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
        crossorigin=""></script>

</body>

<script>
function init()
{
    var map = L.map('map').setView([{{$track->points[0]->longitude}}, {{$track->points[0]->latitude}}], 13);

    L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
        maxZoom: 18,
        id: 'mapbox/streets-v11',
        tileSize: 512,
        zoomOffset: -1,
        accessToken: '{{$token}}'

    }).addTo(map);
}

</script>

</html>
