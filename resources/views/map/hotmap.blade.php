@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">hotmap</div>
                <div class="panel-body">
                    {{-- baiduap --}}
                 
                    <div id="map"></div>
                                                         
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
      var map;
      function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
          zoom: 2,
          center: {lat: -33.865427, lng: 151.196123},
          mapTypeId: 'terrain'
        });

        // Create a <script> tag and set the USGS URL as the source.
        var script = document.createElement('script');

        // This example uses a local copy of the GeoJSON stored at
        // http://earthquake.usgs.gov/earthquakes/feed/v1.0/summary/2.5_week.geojsonp
        script.src = 'https://developers.google.com/maps/documentation/javascript/examples/json/earthquake_GeoJSONP.js';
        document.getElementsByTagName('head')[0].appendChild(script);

      }

      function eqfeed_callback(results) {
        var heatmapData = [];
        for (var i = 0; i < results.features.length; i++) {
          var coords = results.features[i].geometry.coordinates;
          var latLng = new google.maps.LatLng(coords[1], coords[0]);
          heatmapData.push(latLng);
        }
        var heatmap = new google.maps.visualization.HeatmapLayer({
          data: heatmapData,
          dissipating: false,
          map: map
        });
      }
    </script>
      <script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAuhqLjag8kBHNfDsHkaL4TtEgGn6YkYGo&libraries=visualization&callback=initMap">
    </script>
@endsection
