<?php
?>

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function reviiri() {
    <?php
    require_once("config.php");
    require_once("dbopen.php");

    $query = "SELECT cordlang, cordlong FROM tiedot WHERE elainid = 2";
    $results = mysql_query($query)
            or die("Kyselyssä tapahtui virhe: " . mysql_errno());
    
    $row = mysql_fetch_array($results);
    $row = mysql_fetch_array($results);
    
    echo 'console.log("' . $row[0] . '");';
    echo 'console.log("' . $row[1] . '");';
    
    echo "var reviirimap = new google.maps.Map(document.getElementById('map'), { ";
    echo "zoom: 5,";
    echo 'center: {lat: ' . $row[0] . ', lng: ' . $row[1]. '} ,';
    echo "mapTypeId: google.maps.MapTypeId.TERRAIN";
    echo "});";
    
    ?>
    
    <?php
    //require_once("config.php");
    //require_once("dbopen.php");
    
    $query = "SELECT cordlang, cordlong FROM tiedot WHERE elainid = 2";
    $results = mysql_query($query)
            or die("Kyselyssä tapahtui virhe: " . mysql_errno());
    
    $northest = -200;
    $northest_i = 0;
    $southest = 200;
    $southest_i = 0;
    $estern = -200;
    $estern_i = 0;
    $western = 200;
    $western_i = 0;
    
    while($row = mysql_fetch_array($results)) {
        if($row[0] >= $northest) {
            $northest = $row[0];
            $northest_i = $row[1];
        }
        if($row[0] <= $southest) {
            $southest = $row[0];
            $southest_i = $row[1];
        }
        if($row[1] >= $estern) {
           $estern = $row[1];
           $estern_i = $row[0];
        }
        if($row[1] <= $western) {
           $western = $row[1];
           $western_i = $row[0];
        }
    }
    
    echo 'console.log("' . $western . '");';
    
    /*  tavallaan meidän datat vähän kusee
     *  polygonit saattaa myös olla kolmioita
     *  paska testata ku en jaksa alkaa keksimään uttaa
     *  mut oli miten oli niin tää toimii joka tilanteessa
     */
    
    echo "var reviiriCoords_w = [";
    echo "{lat: " . $northest . ", lng: " . $northest_i . "},";
    echo "{lat: " . $western_i . ", lng: " . $western . "},";
    echo "{lat: " . $southest . ", lng: " . $southest_i . "},";
    //echo "{lat: " . $estern_i . ", lng: " . $estern . "},";
    echo "{lat: " . $northest . ", lng: " . $northest_i . "}";
    echo "];";
    
    echo "var reviiriCoords_e = [";
    echo "{lat: " . $northest . ", lng: " . $northest_i . "},";
    //echo "{lat: " . $western_i . ", lng: " . $western . "},";
    echo "{lat: " . $southest . ", lng: " . $southest_i . "},";
    echo "{lat: " . $estern_i . ", lng: " . $estern . "},";
    echo "{lat: " . $northest . ", lng: " . $northest_i . "}";
    echo "];";
        
    //require_once("dbclose.php");
    ?>
        
    var reviiriPoly_w = new google.maps.Polygon({
        paths: reviiriCoords_w,
        strokeColor: '#FF0000',
        strokeOpacity: 0.8,
        strokeWeight: 2,
        fillColor: '#FF0000',
        fillOpacity: 0.35
    });
    
    var reviiriPoly_e = new google.maps.Polygon({
        paths: reviiriCoords_e,
        strokeColor: '#FF0000',
        strokeOpacity: 0.8,
        strokeWeight: 2,
        fillColor: '#FF0000',
        fillOpacity: 0.35
    });
    
    reviiriPoly_w.setMap(reviirimap);
    reviiriPoly_e.setMap(reviirimap);
}