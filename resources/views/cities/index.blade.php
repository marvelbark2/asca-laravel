
<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <title>Google Map Marker Issue</title>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <meta name="robots" content="noindex, nofollow">
  <meta name="googlebot" content="noindex, nofollow">
  <meta name="viewport" content="width=device-width, initial-scale=1">


  <script
    type="text/javascript"
    src="//code.jquery.com/jquery-compat-git.js"

  ></script>
    <script type="text/javascript" src="//example.com/error.js"></script>
    <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.10.3/css/base/jquery-ui.css">

    <link rel="stylesheet" type="text/css" href="/css/result-light.css">

      <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?v=3&amp;amp;sensor=false"></script>

  <style id="compiled-css" type="text/css">
      #map-canvas {
    position: absolute;
    top: 0;
    left: 0;
    bottom: 50px;
    right: 0;
}
#reportframe {
    position: absolute;
    top: -50px;
    background-color: #666;
}
#logo {
    text-align: center;
    position: absolute;
    bottom: 0;
    right: 0;
    padding: 5px;
}
#controls {
    background-color: #000;
    height: 60px;
    width: 100%;
    position: absolute;
    left: 0;
    bottom: 0px;
    text-align: center;
}
#wrapper {
    height: 100%;
    width: 100%;
    margin: 0px;
    background-image: url(../images/stormersite_CP_header.jpg);
    background-size: cover;
}
.marker {
    margin: 5px;
    text-align: center;
    display: block;
}
#hailmarkers {
    text-align: center;
    display: none;
    position: absolute;
    bottom: 65px;
    border: 1px solid #000;
    z-index: 9999;
    width: 180px;
    background-image: url(../images/35percblack.png);
    background-repeat: repeat;
}
.markeroff {
    margin: 5px;
    text-align: center;
    display: block;
    opacity: 0.5;
}
.holdmarker {
    text-align: center;
    margin-right: auto;
    margin-left: auto;
    width: 280px;
}
  </style>


  <!-- TODO: Missing CoffeeScript 2 -->

  <script type="text/javascript">//<![CDATA[

    $(window).on('load', function() {

var locations = [
    ["1.50 inches", 37.5, -77.33, 0, "hail150"],
    ["1.75 inches", 37.45, -77.49, 1, "hail175"],
    ["1.00 inches", 37.38, -77.51, 2, "hail100"],
    ["1.00 inches", 37.35, -77.71, 3, "hail100"],
    ["1.00 inches", 38.63, -75.61, 4, "hail100"],
    ["1.00 inches", 38.28, -76.42, 5, "hail100"],
    ["1.00 inches", 34.99, -77.66, 6, "hail100"],
    ["1.00 inches", 34.95, -77.61, 7, "hail100"],
    ["1.00 inches", 34.92, -77.77, 8, "hail100"],
    ["1.25 inches", 34.89, -77.77, 9, "hail125"],
    ["1.50 inches", 36.24, -80.36, 10, "hail150"],
    ["1.25 inches", 34.22, -80.98, 11, "hail125"],
    ["1.00 inches", 35.78, -81.28, 12, "hail100"],
    ["1.00 inches", 35.81, -81.18, 13, "hail100"],
    ["1.00 inches", 34.52, -78.81, 14, "hail100"],
    ["1.25 inches", 33.94, -80.39, 15, "hail125"],
    ["1.75 inches", 34.11, -80.86, 16, "hail175"],
    ["1.75 inches", 34.67, -80.72, 17, "hail175"],
    ["1.75 inches", 33.54, -81.82, 18, "hail175"],
    ["1.00 inches", 33.52, -81.96, 19, "hail100"],
    ["1.00 inches", 33.46, -82, 20, "hail100"],
    ["1.25 inches", 33.47, -82, 21, "hail125"],
    ["1.00 inches", 33.45, -82.2, 22, "hail100"],
    ["1.00 inches", 33.41, -82.32, 23, "hail100"],
    ["1.75 inches", 33.33, -82.77, 24, "hail175"],
    ["1.00 inches", 32.49, -86.73, 25, "hail100"],
    ["1.00 inches", 32.19, -87.31, 26, "hail100"],
    ["1.00 inches", 32.18, -86.58, 27, "hail100"],
    ["1.00 inches", 36.64, -82.58, 28, "hail100"],
    ["1.00 inches", 36.41, -83.01, 29, "hail100"],
    ["1.75 inches", 32.98, -84.96, 30, "hail175"],
    ["1.75 inches", 31.2, -89.04, 31, "hail175"],
    ["1.00 inches", 31.13, -89.24, 32, "hail100"],
    ["Wind Report", 37.33, -76.29, 33, "wind"],
    ["Wind Report", 35.79, -78.73, 34, "wind"],
    ["Wind Report", 33.46, -79.56, 35, "wind"],
    ["Wind Report", 37.82, -75.59, 36, "wind"],
    ["Wind Report", 36.52, -78.04, 37, "wind"],
    ["Wind Report", 35.76, -79.23, 38, "wind"],
    ["Wind Report", 31.98, -81.12, 39, "wind"],
    ["Wind Report", 36.31, -78.41, 40, "wind"],
    ["Wind Report", 31.57, -81.32, 41, "wind"],
    ["Wind Report", 31.59, -81.36, 42, "wind"],
    ["Wind Report", 32.61, -81.25, 43, "wind"],
    ["Wind Report", 35.98, -78.9, 44, "wind"],
    ["Wind Report", 32.69, -81.32, 45, "wind"],
    ["Wind Report", 35.8, -79.55, 46, "wind"],
    ["Wind Report", 36.27, -79.05, 47, "wind"],
    ["Wind Report", 35.56, -79.66, 48, "wind"],
    ["Wind Report", 36.6, -78.74, 49, "wind"],
    ["Wind Report", 35.63, -80.11, 50, "wind"],
    ["Wind Report", 35.72, -79.78, 51, "wind"],
    ["Wind Report", 35.73, -79.76, 52, "wind"],
    ["Wind Report", 31.48, -82.02, 53, "wind"],
    ["Wind Report", 35.76, -80.06, 54, "wind"],
    ["Wind Report", 38.63, -75.61, 55, "wind"],
    ["Wind Report", 31.98, -81.12, 56, "wind"],
    ["Wind Report", 31.98, -81.14, 57, "wind"],
    ["Wind Report", 31.99, -81.14, 58, "wind"],
    ["Wind Report", 32.03, -81.1, 59, "wind"],
    ["Wind Report", 31.99, -81.16, 60, "wind"],
    ["Wind Report", 36.1, -79.87, 61, "wind"],
    ["Wind Report", 36.11, -79.83, 62, "wind"],
    ["Wind Report", 31.99, -81.16, 63, "wind"],
    ["Wind Report", 32, -81.15, 64, "wind"],
    ["Wind Report", 31.94, -81.18, 65, "wind"],
    ["Wind Report", 38.56, -76.08, 66, "wind"],
    ["Wind Report", 38.62, -75.85, 67, "wind"],
    ["Wind Report", 36.07, -80.41, 68, "wind"],
    ["Wind Report", 36.5, -79.37, 69, "wind"],
    ["Wind Report", 36.51, -79.38, 70, "wind"],
    ["Wind Report", 31.32, -82.5, 71, "wind"],
    ["Wind Report", 38.56, -76.08, 72, "wind"],
    ["Wind Report", 38.59, -76.04, 73, "wind"],
    ["Wind Report", 36.23, -80.44, 74, "wind"],
    ["Wind Report", 31.98, -81.13, 75, "wind"],
    ["Wind Report", 36.09, -80.25, 76, "wind"],
    ["Wind Report", 36.02, -80.06, 77, "wind"],
    ["Wind Report", 31.52, -82.5, 78, "wind"],
    ["Wind Report", 36.07, -80.41, 79, "wind"],
    ["Wind Report", 31.6, -82.23, 80, "wind"],
    ["Wind Report", 35.01, -77.48, 81, "wind"],
    ["Wind Report", 31.55, -82.47, 82, "wind"],
    ["Wind Report", 32.03, -81.89, 83, "wind"],
    ["Wind Report", 35.02, -77.79, 84, "wind"],
    ["Wind Report", 38.65, -76.89, 85, "wind"],
    ["Wind Report", 36.23, -80.44, 86, "wind"],
    ["Wind Report", 35.02, -77.97, 87, "wind"],
    ["Wind Report", 34.9, -78.06, 88, "wind"],
    ["Wind Report", 36.24, -80.36, 89, "wind"],
    ["Wind Report", 36.74, -79.38, 90, "wind"],
    ["Wind Report", 34.1, -79.88, 91, "wind"],
    ["Wind Report", 30.58, -84.13, 92, "wind"],
    ["Wind Report", 30.65, -84.04, 93, "wind"],
    ["Wind Report", 30.44, -84.28, 94, "wind"],
    ["Wind Report", 31.05, -84.23, 95, "wind"],
    ["Wind Report", 31.02, -84.46, 96, "wind"],
    ["Wind Report", 36.91, -80.26, 97, "wind"],
    ["Wind Report", 31.32, -83.5, 98, "wind"],
    ["Wind Report", 31.35, -83.49, 99, "wind"],
    ["Wind Report", 34.19, -79.88, 100, "wind"],
    ["Wind Report", 34.19, -79.89, 101, "wind"],
    ["Wind Report", 37.58, -79.05, 102, "wind"],
    ["Wind Report", 31.16, -84.07, 103, "wind"],
    ["Wind Report", 37.1, -79.83, 104, "wind"],
    ["Wind Report", 36.63, -79.64, 105, "wind"],
    ["Wind Report", 37.5, -79.88, 106, "wind"],
    ["Wind Report", 37.36, -79.81, 107, "wind"],
    ["Wind Report", 34.09, -80.57, 108, "wind"],
    ["Wind Report", 36.59, -80.58, 109, "wind"],
    ["Wind Report", 33.67, -81.11, 110, "wind"],
    ["Wind Report", 31.89, -85.15, 111, "wind"],
    ["Wind Report", 31.23, -84.21, 112, "wind"],
    ["Wind Report", 33.54, -81.82, 113, "wind"],
    ["Wind Report", 33.52, -81.96, 114, "wind"],
    ["Wind Report", 33.45, -81.84, 115, "wind"],
    ["Wind Report", 33.46, -82, 116, "wind"],
    ["Wind Report", 33.5, -81.78, 117, "wind"],
    ["Wind Report", 33.5, -81.95, 118, "wind"],
    ["Wind Report", 33.66, -80.78, 119, "wind"],
    ["Wind Report", 33.68, -81.11, 120, "wind"],
    ["Wind Report", 30.91, -85.16, 121, "wind"],
    ["Wind Report", 36.14, -81, 122, "wind"],
    ["Wind Report", 32.03, -85.38, 123, "wind"],
    ["Wind Report", 33.39, -82.5, 124, "wind"],
    ["Wind Report", 39.42, -81.53, 125, "wind"],
    ["Wind Report", 33.42, -82.38, 126, "wind"],
    ["Wind Report", 33.47, -82.57, 127, "wind"],
    ["Wind Report", 30.94, -84.85, 128, "wind"],
    ["Wind Report", 31.75, -86.19, 129, "wind"],
    ["Wind Report", 30.91, -85.16, 130, "wind"],
    ["Wind Report", 32.04, -86.06, 131, "wind"],
    ["Wind Report", 33.45, -82.65, 132, "wind"],
    ["Wind Report", 33.46, -82.71, 133, "wind"],
    ["Wind Report", 32.58, -86.3, 134, "wind"],
    ["Wind Report", 32.12, -86.45, 135, "wind"],
    ["Wind Report", 33.22, -83.44, 136, "wind"],
    ["Wind Report", 33.2, -83.66, 137, "wind"],
    ["Wind Report", 33.24, -83.49, 138, "wind"],
    ["Wind Report", 33.2, -83.77, 139, "wind"],
    ["Wind Report", 31.83, -86.63, 140, "wind"],
    ["Wind Report", 33.33, -83.39, 141, "wind"],
    ["Wind Report", 32.12, -86.45, 142, "wind"],
    ["Wind Report", 32.59, -86.15, 143, "wind"],
    ["Wind Report", 33.1, -84.34, 144, "wind"],
    ["Wind Report", 32.18, -86.58, 145, "wind"],
    ["Wind Report", 32.6, -86.2, 146, "wind"],
    ["Wind Report", 32.59, -86.25, 147, "wind"],
    ["Wind Report", 33.2, -83.66, 148, "wind"],
    ["Wind Report", 33.58, -82.99, 149, "wind"],
    ["Wind Report", 31.52, -87.88, 150, "wind"],
    ["Wind Report", 31.51, -87.9, 151, "wind"],
    ["Wind Report", 33.2, -83.77, 152, "wind"],
    ["Wind Report", 32.61, -86.4, 153, "wind"],
    ["Wind Report", 33.58, -83.18, 154, "wind"],
    ["Wind Report", 36.71, -81.97, 155, "wind"],
    ["Wind Report", 33.53, -83.39, 156, "wind"],
    ["Wind Report", 36.41, -83.01, 157, "wind"],
    ["Wind Report", 31.33, -88.53, 158, "wind"],
    ["Wind Report", 32.88, -85.11, 159, "wind"],
    ["Wind Report", 32.87, -85.21, 160, "wind"],
    ["Wind Report", 32.63, -86.13, 161, "wind"],
    ["Wind Report", 36.98, -83, 162, "wind"],
    ["Wind Report", 37.24, -83.3, 163, "wind"],
    ["Tornado Report", 37.33, -76.29, 164, "tornado"],
    ["Tornado Report", 32.89, -80.89, 165, "tornado"],
    ["Tornado Report", 32.87, -80.88, 166, "tornado"],
    ["Tornado Report", 32.88, -80.89, 167, "tornado"],
    ["Tornado Report", 32.9, -80.94, 168, "tornado"],
    ["Tornado Report", 33.71, -80.56, 169, "tornado"],
    ["Tornado Report", 31.31, -83.54, 170, "tornado"],
    ["Tornado Report", 33.62, -81.1, 171, "tornado"],
    ["Tornado Report", 33.72, -81.35, 172, "tornado"]
];

var markerGroups = {
    "hail100": [],
    "hail125": [],
    "hail150": [],
    "hail175": [],
    "wind": [],
    "tornado": []
};
var iconBase = 'http://www.stormersite.com/markers/';
var icons = {
    hail25: {
        icon: iconBase + '25.png'
    },
    hail50: {
        icon: iconBase + '50.png'
    },
    hail75: {
        icon: iconBase + '75.png'
    },
    hail88: {
        icon: iconBase + '88.png'
    },
    hail100: {
        icon: iconBase + '100.png'
    },
    hail125: {
        icon: iconBase + '125.png'
    },
    hail150: {
        icon: iconBase + '150.png'
    },
    hail175: {
        icon: iconBase + '175.png'
    },
    hail200: {
        icon: iconBase + '200.png'
    },
    hail225: {
        icon: iconBase + '225.png'
    },
    hail250: {
        icon: iconBase + '250.png'
    },
    hail275: {
        icon: iconBase + '275.png'
    },
    hail300: {
        icon: iconBase + '300.png'
    },
    hail325: {
        icon: iconBase + '325.png'
    },
    hail350: {
        icon: iconBase + '350.png'
    },
    hail375: {
        icon: iconBase + '375.png'
    },
    hail400: {
        icon: iconBase + '400.png'
    },
    hail425: {
        icon: iconBase + '425.png'
    },
    hail450: {
        icon: iconBase + '450.png'
    },
    hail475: {
        icon: iconBase + '475.png'
    },
    hail500: {
        icon: iconBase + '500.png'
    },
    wind: {
        icon: iconBase + 'wind.png'
    },
    tornado: {
        icon: iconBase + 'tornado.png'
    }
};
var myLatlng = new google.maps.LatLng(39.50, -98.35);
// map options,
var myOptions = {
    zoom: 4,
    maxZoom: 14,
    center: myLatlng,
    styles: [{
        'featureType': 'water',
        'stylers': [{
            'color': '#021019'
        }]
    }, {
        'featureType': 'landscape',
        'stylers': [{
            'color': '#08304b'
        }]
    }, {
        'featureType': 'poi',
        'elementType': 'geometry',
        'stylers': [{
            'color': '#0c4152'
        }, {
            'lightness': 5
        }]
    }, {
        'featureType': 'road.highway',
        'elementType': 'geometry.fill',
        'stylers': [{
            'color': '#000000'
        }]
    }, {
        'featureType': 'road.highway',
        'elementType': 'geometry.stroke',
        'stylers': [{
            'color': '#0b434f'
        }, {
            'lightness': 25
        }]
    }, {
        'featureType': 'road.arterial',
        'elementType': 'geometry.fill',
        'stylers': [{
            'color': '#000000'
        }]
    }, {
        'featureType': 'road.arterial',
        'elementType': 'geometry.stroke',
        'stylers': [{
            'color': '#0b3d51'
        }, {
            'lightness': 16
        }]
    }, {
        'featureType': 'road.local',
        'elementType': 'geometry',
        'stylers': [{
            'color': '#000000'
        }]
    }, {
        'elementType': 'labels.text.fill',
        'stylers': [{
            'color': '#ffffff'
        }]
    }, {
        'elementType': 'labels.text.stroke',
        'stylers': [{
            'color': '#000000'
        }, {
            'lightness': 13
        }]
    }, {
        'featureType': 'transit',
        'stylers': [{
            'color': '#146474'
        }]
    }, {
        'featureType': 'administrative',
        'elementType': 'geometry.fill',
        'stylers': [{
            'color': '#000000'
        }]
    }, {
        'featureType': 'administrative',
        'elementType': 'geometry.stroke',
        'stylers': [{
            'color': '#144b53'
        }, {
            'lightness': 14
        }, {
            'weight': 1.4
        }]
    }]
};
map = new google.maps.Map(document.getElementById("map-canvas"), myOptions);
google.maps.event.addDomListener(window, 'load');



tileNEX = new google.maps.ImageMapType({
    getTileUrl: function (tile, zoom) {
        return "http://mesonet.agron.iastate.edu/cache/tile.py/1.0.0/nexrad-n0q-900913/" + zoom + "/" + tile.x + "/" + tile.y + ".png?" + (new Date()).getTime();
    },
    tileSize: new google.maps.Size(256, 256),
    opacity: 0.60,
    name: 'NEXRAD',
    isPng: true
});


goes = new google.maps.ImageMapType({
    getTileUrl: function (tile, zoom) {
        return "http://mesonet.agron.iastate.edu/cache/tile.py/1.0.0/goes-east-vis-1km-900913/" + zoom + "/" + tile.x + "/" + tile.y + ".png?" + (new Date()).getTime();
    },
    tileSize: new google.maps.Size(256, 256),
    opacity: 0.40,
    name: 'GOES East Vis',
    isPng: true
});


map.overlayMapTypes.push(null); // create empty overlay entry


// add markers
var infowindow = new google.maps.InfoWindow();
var bounds = new google.maps.LatLngBounds();
var marker, i;

for (i = 0; i < locations.length; i++) {
    var myLatLng = new google.maps.LatLng(locations[i][1], locations[i][2]);
    marker = new google.maps.Marker({
        position: new google.maps.LatLng(locations[i][1], locations[i][2]),
        icon: icons[locations[i][4]].icon,
        map: map,
        id: locations[i][3],
        type: locations[i][4]
    });
    markerGroups[locations[i][4]].push(marker);
    google.maps.event.addListener(marker, 'click', (function (marker, i) {
        return function(){
        var godiv = '#sr' + marker.id;
        if ($(godiv).css('display') == 'block') {
            $(godiv).css('display', 'none');
        } else {
            $("#reportframe").children().hide();
            $(godiv).css('display', 'block');
        };
        }})(marker, i));
    bounds.extend(myLatLng);
}

if (locations.length > 0) {
    map.fitBounds(bounds);
}

function toggleGroup(type) {
    for (var i = 0; i < markerGroups[type].length; i++) {
        var marker = markerGroups[type][i];
        marker.setVisible(!marker.getVisible());
    }
}

$('#nexrad').fadeTo(1600, 0.5);

map.overlayMapTypes.clear();

$("#nexrad").click(function () {
    if (map.overlayMapTypes.length < 1) {
        $('#nexrad').fadeTo(1600, 1);
        map.overlayMapTypes.setAt("1", tileNEX);
    } else {
        $('#nexrad').fadeTo(1600, 0.5);
        map.overlayMapTypes.clear();
    }
});

$("#tornado").click(function () {
    if ($('#tornado').css('opacity') == 1) {
        $('#tornado').fadeTo(1600, 0.5);
        toggleGroup('tornado');
    } else {
        $('#tornado').fadeTo(1600, 1);
        toggleGroup('tornado');
    };
});

$("#hail").click(function () {
    $('#hailmarkers').fadeToggle('fast');
});

$("#wind").click(function () {
    if ($('#wind').css('opacity') == 1) {
        $('#wind').fadeTo(1600, 0.5);
        toggleGroup('wind');
    } else {
        $('#wind').fadeTo(1600, 1);
        toggleGroup('wind');
    };
});

$("#hail100").click(function () {
    if ($('#hail100').css('opacity') == 1) {
        $('#hail100').fadeTo(1600, 0.5);
        toggleGroup('hail100');
    } else {
        $('#hail100').fadeTo(1600, 1);
        toggleGroup('hail100');
    };
});
$("#hail125").click(function () {
    if ($('#hail125').css('opacity') == 1) {
        $('#hail125').fadeTo(1600, 0.5);
        toggleGroup('hail125');
    } else {
        $('#hail125').fadeTo(1600, 1);
        toggleGroup('hail125');
    };
});
$("#hail150").click(function () {
    if ($('#hail150').css('opacity') == 1) {
        $('#hail150').fadeTo(1600, 0.5);
        toggleGroup('hail150');
    } else {
        $('#hail150').fadeTo(1600, 1);
        toggleGroup('hail150');
    };
});
$("#hail175").click(function () {
    if ($('#hail175').css('opacity') == 1) {
        $('#hail175').fadeTo(1600, 0.5);
        toggleGroup('hail175');
    } else {
        $('#hail175').fadeTo(1600, 1);
        toggleGroup('hail175');
    };
});

    });

  //]]></script>

</head>
<body>
    <div id="wrapper">
    <div id="map-canvas"></div>
    <div id="controls">
        <div class="holdmarker">
            <div id="hailmarkers">
                <div id="hail100" class="marker" style="float: left;">
                    <img src="http://www.stormersite.com/mmarkers/hail100.png" width="50" height="50" />
                </div>
                <div id="hail125" class="marker" style="float: left;">
                    <img src="http://www.stormersite.com/markers/hail125.png" width="50" height="50" />
                </div>
                <div id="hail150" class="marker" style="float: left;">
                    <img src="http://www.stormersite.com/markers/hail150.png" width="50" height="50" />
                </div>
                <div id="hail175" class="marker" style="float: left;">
                    <img src="http://www.stormersite.com/markers/hail175.png" width="50" height="50" />
                </div>
            </div>
            <div id="hail" class="marker" style="float: left;">
                <img src="http://www.stormersite.com/markers/hailsq.png" width="50" height="50" />
            </div>
            <div id="wind" style="float: left;" class="marker">
                <img src="http://www.stormersite.com/markers/windsq.png" width="50" height="50" />
            </div>
            <div id="tornado" style="float: left;" class="marker">
                <img src="http://www.stormersite.com/markers/tornadosq.png" width="50" height="50" />
            </div>
            <div id="nexrad" style="float: left;" class="marker">
                <img src="http://www.stormersite.com/markers/nexrad.png" width="50" height="50" />
            </div>
        </div>
        <div id="reportframe">
            <div id="sr0" style="display:: none;">1.50 inches @ 37.5, -77.33</div>
            <div id="sr1" style="display:: none;">1.75 inches @ 37.45, -77.49</div>
            <div id="sr2" style="display:: none;">1.00 inches @ 37.38, -77.51</div>
            <div id="sr3" style="display:: none;">1.00 inches @ 37.35, -77.71</div>
            <div id="sr4" style="display:: none;">1.00 inches @ 38.63, -75.61</div>
            <div id="sr5" style="display:: none;">1.00 inches @ 38.28, -76.42</div>
            <div id="sr6" style="display:: none;">1.00 inches @ 34.99, -77.66</div>
            <div id="sr7" style="display:: none;">1.00 inches @ 34.95, -77.61</div>
            <div id="sr8" style="display:: none;">1.00 inches @ 34.92, -77.77</div>
            <div id="sr9" style="display:: none;">1.25 inches @ 34.89, -77.77</div>
            <div id="sr10" style="display:: none;">1.50 inches @ 36.24, -80.36</div>
            <div id="sr11" style="display:: none;">1.25 inches @ 34.22, -80.98</div>
            <div id="sr12" style="display:: none;">1.00 inches @ 35.78, -81.28</div>
            <div id="sr13" style="display:: none;">1.00 inches @ 35.81, -81.18</div>
            <div id="sr14" style="display:: none;">1.00 inches @ 34.52, -78.81</div>
            <div id="sr15" style="display:: none;">1.25 inches @ 33.94, -80.39</div>
            <div id="sr16" style="display:: none;">1.75 inches @ 34.11, -80.86</div>
            <div id="sr17" style="display:: none;">1.75 inches @ 34.67, -80.72</div>
            <div id="sr18" style="display:: none;">1.75 inches @ 33.54, -81.82</div>
            <div id="sr19" style="display:: none;">1.00 inches @ 33.52, -81.96</div>
            <div id="sr20" style="display:: none;">1.00 inches @ 33.46, -82</div>
            <div id="sr21" style="display:: none;">1.25 inches @ 33.47, -82</div>
            <div id="sr22" style="display:: none;">1.00 inches @ 33.45, -82.2</div>
            <div id="sr23" style="display:: none;">1.00 inches @ 33.41, -82.32</div>
            <div id="sr24" style="display:: none;">1.75 inches @ 33.33, -82.77</div>
            <div id="sr25" style="display:: none;">1.00 inches @ 32.49, -86.73</div>
            <div id="sr26" style="display:: none;">1.00 inches @ 32.19, -87.31</div>
            <div id="sr27" style="display:: none;">1.00 inches @ 32.18, -86.58</div>
            <div id="sr28" style="display:: none;">1.00 inches @ 36.64, -82.58</div>
            <div id="sr29" style="display:: none;">1.00 inches @ 36.41, -83.01</div>
            <div id="sr30" style="display:: none;">1.75 inches @ 32.98, -84.96</div>
            <div id="sr31" style="display:: none;">1.75 inches @ 31.2, -89.04</div>
            <div id="sr32" style="display:: none;">1.00 inches @ 31.13, -89.24</div>
            <div id="sr33" style="display:: none;">Wind Report @ 37.33, -76.29</div>
            <div id="sr34" style="display:: none;">Wind Report @ 35.79, -78.73</div>
            <div id="sr35" style="display:: none;">Wind Report @ 33.46, -79.56</div>
            <div id="sr36" style="display:: none;">Wind Report @ 37.82, -75.59</div>
            <div id="sr37" style="display:: none;">Wind Report @ 36.52, -78.04</div>
            <div id="sr38" style="display:: none;">Wind Report @ 35.76, -79.23</div>
            <div id="sr39" style="display:: none;">Wind Report @ 31.98, -81.12</div>
            <div id="sr40" style="display:: none;">Wind Report @ 36.31, -78.41</div>
            <div id="sr41" style="display:: none;">Wind Report @ 31.57, -81.32</div>
            <div id="sr42" style="display:: none;">Wind Report @ 31.59, -81.36</div>
            <div id="sr43" style="display:: none;">Wind Report @ 32.61, -81.25</div>
            <div id="sr44" style="display:: none;">Wind Report @ 35.98, -78.9</div>
            <div id="sr45" style="display:: none;">Wind Report @ 32.69, -81.32</div>
            <div id="sr46" style="display:: none;">Wind Report @ 35.8, -79.55</div>
            <div id="sr47" style="display:: none;">Wind Report @ 36.27, -79.05</div>
            <div id="sr48" style="display:: none;">Wind Report @ 35.56, -79.66</div>
            <div id="sr49" style="display:: none;">Wind Report @ 36.6, -78.74</div>
            <div id="sr50" style="display:: none;">Wind Report @ 35.63, -80.11</div>
            <div id="sr51" style="display:: none;">Wind Report @ 35.72, -79.78</div>
            <div id="sr52" style="display:: none;">Wind Report @ 35.73, -79.76</div>
            <div id="sr53" style="display:: none;">Wind Report @ 31.48, -82.02</div>
            <div id="sr54" style="display:: none;">Wind Report @ 35.76, -80.06</div>
            <div id="sr55" style="display:: none;">Wind Report @ 38.63, -75.61</div>
            <div id="sr56" style="display:: none;">Wind Report @ 31.98, -81.12</div>
            <div id="sr57" style="display:: none;">Wind Report @ 31.98, -81.14</div>
            <div id="sr58" style="display:: none;">Wind Report @ 31.99, -81.14</div>
            <div id="sr59" style="display:: none;">Wind Report @ 32.03, -81.1</div>
            <div id="sr60" style="display:: none;">Wind Report @ 31.99, -81.16</div>
            <div id="sr61" style="display:: none;">Wind Report @ 36.1, -79.87</div>
            <div id="sr62" style="display:: none;">Wind Report @ 36.11, -79.83</div>
            <div id="sr63" style="display:: none;">Wind Report @ 31.99, -81.16</div>
            <div id="sr64" style="display:: none;">Wind Report @ 32, -81.15</div>
            <div id="sr65" style="display:: none;">Wind Report @ 31.94, -81.18</div>
            <div id="sr66" style="display:: none;">Wind Report @ 38.56, -76.08</div>
            <div id="sr67" style="display:: none;">Wind Report @ 38.62, -75.85</div>
            <div id="sr68" style="display:: none;">Wind Report @ 36.07, -80.41</div>
            <div id="sr69" style="display:: none;">Wind Report @ 36.5, -79.37</div>
            <div id="sr70" style="display:: none;">Wind Report @ 36.51, -79.38</div>
            <div id="sr71" style="display:: none;">Wind Report @ 31.32, -82.5</div>
            <div id="sr72" style="display:: none;">Wind Report @ 38.56, -76.08</div>
            <div id="sr73" style="display:: none;">Wind Report @ 38.59, -76.04</div>
            <div id="sr74" style="display:: none;">Wind Report @ 36.23, -80.44</div>
            <div id="sr75" style="display:: none;">Wind Report @ 31.98, -81.13</div>
            <div id="sr76" style="display:: none;">Wind Report @ 36.09, -80.25</div>
            <div id="sr77" style="display:: none;">Wind Report @ 36.02, -80.06</div>
            <div id="sr78" style="display:: none;">Wind Report @ 31.52, -82.5</div>
            <div id="sr79" style="display:: none;">Wind Report @ 36.07, -80.41</div>
            <div id="sr80" style="display:: none;">Wind Report @ 31.6, -82.23</div>
            <div id="sr81" style="display:: none;">Wind Report @ 35.01, -77.48</div>
            <div id="sr82" style="display:: none;">Wind Report @ 31.55, -82.47</div>
            <div id="sr83" style="display:: none;">Wind Report @ 32.03, -81.89</div>
            <div id="sr84" style="display:: none;">Wind Report @ 35.02, -77.79</div>
            <div id="sr85" style="display:: none;">Wind Report @ 38.65, -76.89</div>
            <div id="sr86" style="display:: none;">Wind Report @ 36.23, -80.44</div>
            <div id="sr87" style="display:: none;">Wind Report @ 35.02, -77.97</div>
            <div id="sr88" style="display:: none;">Wind Report @ 34.9, -78.06</div>
            <div id="sr89" style="display:: none;">Wind Report @ 36.24, -80.36</div>
            <div id="sr90" style="display:: none;">Wind Report @ 36.74, -79.38</div>
            <div id="sr91" style="display:: none;">Wind Report @ 34.1, -79.88</div>
            <div id="sr92" style="display:: none;">Wind Report @ 30.58, -84.13</div>
            <div id="sr93" style="display:: none;">Wind Report @ 30.65, -84.04</div>
            <div id="sr94" style="display:: none;">Wind Report @ 30.44, -84.28</div>
            <div id="sr95" style="display:: none;">Wind Report @ 31.05, -84.23</div>
            <div id="sr96" style="display:: none;">Wind Report @ 31.02, -84.46</div>
            <div id="sr97" style="display:: none;">Wind Report @ 36.91, -80.26</div>
            <div id="sr98" style="display:: none;">Wind Report @ 31.32, -83.5</div>
            <div id="sr99" style="display:: none;">Wind Report @ 31.35, -83.49</div>
            <div id="sr100" style="display:: none;">Wind Report @ 34.19, -79.88</div>
            <div id="sr101" style="display:: none;">Wind Report @ 34.19, -79.89</div>
            <div id="sr102" style="display:: none;">Wind Report @ 37.58, -79.05</div>
            <div id="sr103" style="display:: none;">Wind Report @ 31.16, -84.07</div>
            <div id="sr104" style="display:: none;">Wind Report @ 37.1, -79.83</div>
            <div id="sr105" style="display:: none;">Wind Report @ 36.63, -79.64</div>
            <div id="sr106" style="display:: none;">Wind Report @ 37.5, -79.88</div>
            <div id="sr107" style="display:: none;">Wind Report @ 37.36, -79.81</div>
            <div id="sr108" style="display:: none;">Wind Report @ 34.09, -80.57</div>
            <div id="sr109" style="display:: none;">Wind Report @ 36.59, -80.58</div>
            <div id="sr110" style="display:: none;">Wind Report @ 33.67, -81.11</div>
            <div id="sr111" style="display:: none;">Wind Report @ 31.89, -85.15</div>
            <div id="sr112" style="display:: none;">Wind Report @ 31.23, -84.21</div>
            <div id="sr113" style="display:: none;">Wind Report @ 33.54, -81.82</div>
            <div id="sr114" style="display:: none;">Wind Report @ 33.52, -81.96</div>
            <div id="sr115" style="display:: none;">Wind Report @ 33.45, -81.84</div>
            <div id="sr116" style="display:: none;">Wind Report @ 33.46, -82</div>
            <div id="sr117" style="display:: none;">Wind Report @ 33.5, -81.78</div>
            <div id="sr118" style="display:: none;">Wind Report @ 33.5, -81.95</div>
            <div id="sr119" style="display:: none;">Wind Report @ 33.66, -80.78</div>
            <div id="sr120" style="display:: none;">Wind Report @ 33.68, -81.11</div>
            <div id="sr121" style="display:: none;">Wind Report @ 30.91, -85.16</div>
            <div id="sr122" style="display:: none;">Wind Report @ 36.14, -81</div>
            <div id="sr123" style="display:: none;">Wind Report @ 32.03, -85.38</div>
            <div id="sr124" style="display:: none;">Wind Report @ 33.39, -82.5</div>
            <div id="sr125" style="display:: none;">Wind Report @ 39.42, -81.53</div>
            <div id="sr126" style="display:: none;">Wind Report @ 33.42, -82.38</div>
            <div id="sr127" style="display:: none;">Wind Report @ 33.47, -82.57</div>
            <div id="sr128" style="display:: none;">Wind Report @ 30.94, -84.85</div>
            <div id="sr129" style="display:: none;">Wind Report @ 31.75, -86.19</div>
            <div id="sr130" style="display:: none;">Wind Report @ 30.91, -85.16</div>
            <div id="sr131" style="display:: none;">Wind Report @ 32.04, -86.06</div>
            <div id="sr132" style="display:: none;">Wind Report @ 33.45, -82.65</div>
            <div id="sr133" style="display:: none;">Wind Report @ 33.46, -82.71</div>
            <div id="sr134" style="display:: none;">Wind Report @ 32.58, -86.3</div>
            <div id="sr135" style="display:: none;">Wind Report @ 32.12, -86.45</div>
            <div id="sr136" style="display:: none;">Wind Report @ 33.22, -83.44</div>
            <div id="sr137" style="display:: none;">Wind Report @ 33.2, -83.66</div>
            <div id="sr138" style="display:: none;">Wind Report @ 33.24, -83.49</div>
            <div id="sr139" style="display:: none;">Wind Report @ 33.2, -83.77</div>
            <div id="sr140" style="display:: none;">Wind Report @ 31.83, -86.63</div>
            <div id="sr141" style="display:: none;">Wind Report @ 33.33, -83.39</div>
            <div id="sr142" style="display:: none;">Wind Report @ 32.12, -86.45</div>
            <div id="sr143" style="display:: none;">Wind Report @ 32.59, -86.15</div>
            <div id="sr144" style="display:: none;">Wind Report @ 33.1, -84.34</div>
            <div id="sr145" style="display:: none;">Wind Report @ 32.18, -86.58</div>
            <div id="sr146" style="display:: none;">Wind Report @ 32.6, -86.2</div>
            <div id="sr147" style="display:: none;">Wind Report @ 32.59, -86.25</div>
            <div id="sr148" style="display:: none;">Wind Report @ 33.2, -83.66</div>
            <div id="sr149" style="display:: none;">Wind Report @ 33.58, -82.99</div>
            <div id="sr150" style="display:: none;">Wind Report @ 31.52, -87.88</div>
            <div id="sr151" style="display:: none;">Wind Report @ 31.51, -87.9</div>
            <div id="sr152" style="display:: none;">Wind Report @ 33.2, -83.77</div>
            <div id="sr153" style="display:: none;">Wind Report @ 32.61, -86.4</div>
            <div id="sr154" style="display:: none;">Wind Report @ 33.58, -83.18</div>
            <div id="sr155" style="display:: none;">Wind Report @ 36.71, -81.97</div>
            <div id="sr156" style="display:: none;">Wind Report @ 33.53, -83.39</div>
            <div id="sr157" style="display:: none;">Wind Report @ 36.41, -83.01</div>
            <div id="sr158" style="display:: none;">Wind Report @ 31.33, -88.53</div>
            <div id="sr159" style="display:: none;">Wind Report @ 32.88, -85.11</div>
            <div id="sr160" style="display:: none;">Wind Report @ 32.87, -85.21</div>
            <div id="sr161" style="display:: none;">Wind Report @ 32.63, -86.13</div>
            <div id="sr162" style="display:: none;">Wind Report @ 36.98, -83</div>
            <div id="sr163" style="display:: none;">Wind Report @ 37.24, -83.3</div>
            <div id="sr164" style="display:: none;">Tornado Report @ 37.33, -76.29</div>
            <div id="sr165" style="display:: none;">Tornado Report @ 32.89, -80.89</div>
            <div id="sr166" style="display:: none;">Tornado Report @ 32.87, -80.88</div>
            <div id="sr167" style="display:: none;">Tornado Report @ 32.88, -80.89</div>
            <div id="sr168" style="display:: none;">Tornado Report @ 32.9, -80.94</div>
            <div id="sr169" style="display:: none;">Tornado Report @ 33.71, -80.56</div>
            <div id="sr170" style="display:: none;">Tornado Report @ 31.31, -83.54</div>
            <div id="sr171" style="display:: none;">Tornado Report @ 33.62, -81.1</div>
            <div id="sr172" style="display:: none;">Tornado Report @ 33.72, -81.35</div>
        </div>
    </div>
    <div id="maplegend"></div>
</div>


  <script>
    // tell the embed parent frame the height of the content
    if (window.parent && window.parent.parent){
      window.parent.parent.postMessage(["resultsFrame", {
        height: document.body.getBoundingClientRect().height,
        slug: "7my0qsyc"
      }], "*")
    }

    // always overwrite window.name, in case users try to set it manually
    window.name = "result"
  </script>
</body>
</html>
