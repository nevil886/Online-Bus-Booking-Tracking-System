<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<script type="text/javascript" src="<?php echo URL; ?>public/js/map/parse-1.2.18.min.js"></script>
<style type="text/css">
    #map-canvas { 
        height: 950px;
        width: 750px;
        margin-top:50px;
    }
    #map-key { 
        background-color: #F5F5F5;
        border: 1px solid #A4A4A4;
        float: right;
        height: 160px;
        margin-left: 10px;
        margin-top: -950px;
        padding: 0px;
        width: 135px;
    }
</style>
<script type="text/javascript"
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAz0Zo9jDoAopzVB9cqzFzT8onr8XdQ_pk&sensor=false">
</script>
<script type="text/javascript">
    
    var latlog = new google.maps.LatLng(6.9000,79.8700);//7.9000,80.7000 6.9000,79.8700
    var mapOptions = {
        center: latlog,
        zoom: 12 //9
    };
    function initialize() {       
        var map = new google.maps.Map(document.getElementById("map-canvas"),mapOptions);
    }
    google.maps.event.addDomListener(window, 'load', initialize);
    setInterval(mapMarker,5000);

    var pinColor = "00FF00";
    function mapMarker(){
        //Parse.initialize(app Key ,js Key )
        Parse.initialize('w6sOkx6IXZPloTIkWcdbfX3RxKrrPJZmWPIGHeYk','A2yVM8pivVRG45md3dmHP0g0rDGloutMDK2ETgdv');
        var Test = Parse.Object.extend("Tracking_Data");
        var query = new Parse.Query(Test);		
        query.find({
            success: function(object) {
                var maps = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
                for (var i = 0; i < object.length; i++) {
                    
                    //-----------------------------------------------------------
                    if(object[i].get("status")=="R"){
                        var imageURL = "<?php echo URL; ?>public/images/map/bus-green-icon.png";
                    }else if(object[i].get("status")=="W"){
                        var imageURL = "<?php echo URL; ?>public/images/map/bus-yellow-icon.png";
                    }else if(object[i].get("status")=="B"){
                        var imageURL = "<?php echo URL; ?>public/images/map/bus-red-icon.png";
                    }else{
                        var imageURL = "<?php echo URL; ?>public/images/map/bus-yellow-icon.png";
                    }
                    
                    //---------------------------------------------------------- http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=%E2%80%A2|  
                    if(object[i].get("status")!="S"){
                    var pinImage = new google.maps.MarkerImage(imageURL,
                    new google.maps.Size(30, 30),
                    new google.maps.Point(0,0),
                    new google.maps.Point(10, 34));
                    var marker=new google.maps.Marker({
                        position: new google.maps.LatLng(object[i].get("latitude"),object[i].get("longitude")),
                        map: maps,
                        icon: pinImage,
                        title: object[i].get("bus_number")
                    });
                    //-------------------------------------------------------
                    var infowindow = new google.maps.InfoWindow();
                    infowindow.setContent(
                    "<div id=''>"+
                        "<span class='infolable'>Bus No :</span>"+
                        "<span class='infovalue'>"+object[i].get("bus_number")+"</span>"+
                        "</div>"
                    );
                    infowindow.open(maps,marker);
                    /*google.maps.event.addListener(marker, 'click', (function(marker, i) {
                        return function() {
                            infowindow.setContent(
                            "<div id=''>"+
                                "<span class='infolable'>Bus Number :</span>"+
                                "<span class='infovalue'>"+object[i].get("busnumber")+"</span>"+
                                "<span class='infolable'>Status :</span>"+
                                "<span class='infovalue'>"+object[i].get("status")+"</span>"+
                                "</div>"
                        );
                            infowindow.open(maps, marker);
                        }
                    })(marker, i));*/
                    //----------------------------------------------------------
                    }
                }
            }
        });
    }
</script> 
<div id="map-canvas"></div>
<div id="map-key">

    <img src="<?php echo URL; ?>public/images/map/bus-green-icon.png"> Running Bus <br/><br/>
    <img src="<?php echo URL; ?>public/images/map/bus-yellow-icon.png"> Waiting Bus <br/><br/>
    <img src="<?php echo URL; ?>public/images/map/bus-red-icon.png"> Breakdown Bus <br/>
</div>
