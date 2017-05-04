<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<script type="text/javascript" src="<?php echo URL; ?>public/js/map/parse-1.2.18.min.js"></script>
    <style type="text/css">
         #map-canvas { height: 500px;
         width: 500px;
         }
    </style>
    <script type="text/javascript"
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAz0Zo9jDoAopzVB9cqzFzT8onr8XdQ_pk&sensor=false">
    </script>
    <script type="text/javascript">
        var latlog = new google.maps.LatLng(7.0000,81.0000);
        var mapOptions = {
          center: latlog,
          zoom: 8
        };
      function initialize() {       
        var map = new google.maps.Map(document.getElementById("map-canvas"),mapOptions);
      }
      google.maps.event.addDomListener(window, 'load', initialize);
       setInterval(mapMarker,10000);

 var pinColor = "00FF00";
        function mapMarker(){
        //        Parse.initialize(app Key ,js Key )
        Parse.initialize('w6sOkx6IXZPloTIkWcdbfX3RxKrrPJZmWPIGHeYk','A2yVM8pivVRG45md3dmHP0g0rDGloutMDK2ETgdv');
            var Test = Parse.Object.extend("tracking");
		var query = new Parse.Query(Test);		
		query.find({
		  success: function(object) {
                      var maps = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
                      for (var i = 0; i < object.length; i++) { 
                      var marker;
		 		var pinImage = new google.maps.MarkerImage("http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=%E2%80%A2|" + pinColor,
			        new google.maps.Size(21, 34),
			        new google.maps.Point(0,0),
			        new google.maps.Point(10, 34));
				marker=new google.maps.Marker({
				position: new google.maps.LatLng(object[i].get("lat"),object[i].get("log")),
				map: maps,
				icon: pinImage,
				title: object[i].get("busNo")
				});
                  }
                  }
                });
        }
    </script> 
    <div id="map-canvas"></div>
 