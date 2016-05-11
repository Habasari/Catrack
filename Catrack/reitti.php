<?php
?>
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function reitti() {
    <?php
    require_once("config.php");
    require_once("dbopen.php");

    $query = "SELECT cordlang, cordlong FROM tiedot WHERE elainid = 2";
    $results = mysql_query($query)
            or die("Kyselyssä tapahtui virhe: " . mysql_errno());

    $i = 0;

    while ($row = mysql_fetch_array($results)) {
        echo "var lat" . $i . " = " . $row[0] . ";\n";
        echo "var lng" . $i . " = " . $row[1] . ";\n";
        $i++;
    }

    $i--;
    echo "var i = " . $i . ";\n";

    echo 'console.log("' . $i . '");';
    echo 'console.log(lat9);';

    require_once('dbclose.php');
    ?>

    var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 14,
        center: {lat: lat0, lng: lng0},
        mapTypeId: google.maps.MapTypeId.TERRAIN
    });

    /*var flightPlanCoordinates = [
        {lat: 37.772, lng: -122.214},
        {lat: 21.291, lng: -157.821},
        {lat: -18.142, lng: 178.431},
        {lat: -27.467, lng: 153.027}
    ];*/

    <?php
    echo "var flightPlanCoordinates = [\n";

    while($i >= 0) {
        if($i == 0) {
            echo "{lat: lat" . $i . ", lng: lng" . $i . "}\n";
            echo "];\n";
        } else {
            echo "{lat: lat" . $i . ", lng: lng" . $i . "},\n";
        }
        $i--;
    }
    ?>

    var flightPath = new google.maps.Polyline({
        path: flightPlanCoordinates,
        geodesic: true,
        strokeColor: '#FF0000',
        strokeOpacity: 1.0,
        strokeWeight: 2
    });
    flightPath.setMap(map);

    //metaa
    document.getElementById('metaotsikko').innerHTML = "Reitti";
    document.getElementById('metadata').innerHTML = " ";
}
