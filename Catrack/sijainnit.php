<?php
?>
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function sijainnit() {
    <?php
    require_once('config.php');
    require_once('dbopen.php');
    
    $query = "SELECT cordlang, cordlong FROM tiedot WHERE elainid = 2";
    $results = mysql_query($query)
            or die("Kyselyssä tapahtui virhe: " . mysql_errno());
    $i = 0;
    
    while ($row = mysql_fetch_array($results)) {
        echo "var myLatLng" . $i . " = {lat: " . $row[0] . ", lng: " . $row[1] . "};\n";
        $i++;
    }
    $i--;
    require_once('dbclose.php');
    ?>

    var map = new google.maps.Map(document.getElementById('map'), {
    zoom: 4,
    center: myLatLng0
    });
        
    <?php
    while ($i >= 0) {
        echo "var marker" . $i . " = new google.maps.Marker({ \nposition: myLatLng" . $i . ", \nmap: map, \ntitle: '" . $i . "'}); \n";
        $i--;
    }
    ?>
}