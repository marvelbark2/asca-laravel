@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'cities-index'
])

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title"> Les villes visitees</h4>
                    </div>
                    <div class="card-body">
                        <div id="map"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@push('style')
<link rel="stylesheet" href="https://d19vzq90twjlae.cloudfront.net/leaflet-0.7.3/leaflet.css" />
<style>
        #map {
            width: 960px;
            height:500px;
        }

        /* css to customize Leaflet default styles  */
        .custom .leaflet-popup-tip,
        .custom .leaflet-popup-content-wrapper {
            background: #e93434;
            color: #ffffff;
        }
        .pin1 {
  position: absolute;
  top: 40%;
  left: 50%;
  margin-left: -115px;

  border-radius: 50% 50% 50% 0;
  border: 4px solid #fff;
  width: 20px;
  height: 20px;
/*   transform: rotate(-45deg); */
}

.pin1::after {
  position: absolute;
  content: '';
  width: 10px;
  height: 10px;
  border-radius: 50%;
  top: 50%;
  left: 50%;
  margin-left: -5px;
  margin-top: -5px;
  background-color: #fff;
}
</style>
@endpush
@push('scripts')
<script src="https://d19vzq90twjlae.cloudfront.net/leaflet-0.7.3/leaflet.js"></script>
<script>

        //  create map object, tell it to live in 'map' div and give initial latitude, longitude, zoom values
        // var map = L.map('map', {scrollWheelZoom:false}).setView([43.64701, -79.39425], 15);
        var map = new L.Map('map').setView([31.7917, -7.0926], 5);


        //  add base map tiles from OpenStreetMap and attribution info to 'map' div
        L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="#">ASCA</a> | made with <i class="fa fa-heart heart"></i> by <a class="text-info" href="#">Younes Masaoudi</a> '
        }).addTo(map);

        // create custom icon
        var ascaIcon = L.icon({
            iconUrl: 'https://svgshare.com/i/FMe.svg',
            iconSize: [45, 45], // size of the icon
            popupAnchor: [0,50],
            className : 'pin1'
            });

        // create popup contents
        var customPopup = "Mozilla Toronto Offices<br/><img src='http://joshuafrazier.info/images/maptime.gif' alt='maptime logo gif' width='350px'/>";

        // specify popup options
        var customOptions =
            {
            'maxWidth': '500',
            'className' : 'card-body'
            }

        // create marker object, pass custom icon as option, pass content and options to popup, add to map
        @forelse ($cities as $key=>$i)
        L.marker([{{$i->lat}}, {{$i->lon}}], {icon: ascaIcon}).addTo(map).bindPopup("<b>{{$i->city}}</b><br/><hr><span>Taches</span>@if(!empty($i->tasks)) <ul>@foreach ($i['tasks'] as $key=>$t) <li>{{$t}}</li> @endforeach </ul> @endif",customOptions);
        @empty
        @endforelse

        // L.marker([51.49, -0.09]).addTo(map).bindPopup("<b>Hello world!</b><br />I am popup 1.",customOptions);

        // L.marker([51.51, -0.091], {icon: ascaIcon}).addTo(map).bindPopup("<b>Olá mundo!</b><br />Sou o popup 2.");

        // L.marker([51.51, -0.12], {icon: ascaIcon}).addTo(map).bindPopup("<b>Bonjour monde!</b><br />Je suis popup 3.",customOptions)

    </script>
@endpush
@endsection
