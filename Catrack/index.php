<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
        <link rel="stylesheet" type="text/css" href="style.css">
        <title>C(at)Trak</title>
    </head>
    <body>

        <div class = logo></div>

        <div class = content>
            <table id = tNav>
                <tr>
                    <td>
                        <a href = "index.php" id = nav>Sijainti</a>
                    </td>
                    <td>
                        <a onclick="reviiri()" href = "#" id = nav>Reviiri</a>
                    </td>
                    <td>
                        <a onclick="sijainnit()" href = "#" id = nav>Sijainnit</a>
                    </td>
                    <td>
                        <a onclick="reitti()" href = "#" id = nav>Reitti</a>
                    </td>
                    <td>
                        <a href = "#" id = nav>Buten</a>
                    </td>
                    <td>
                        <a href = "#" id = nav>Buten</a>
                    </td>
                    <td>
                        <a href = "#" id = nav>Buten</a>
                    </td>
                    <td>
                        <a href = "#" id = nav>Buten</a>
                    </td>
                </tr>
            </table>

            <div class = left id="map"></div>

            <div class = right>
                <h1 id="metaotsikko"></h1>
                <p id="metadata"></p>
            </div>

        </div>

        <script>
            function initMap() {
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
                //require_once('dbclose.php');
                ?>
                var map = new google.maps.Map(document.getElementById('map'), {
                    zoom: 14,
                    center: myLatLng0
                });

                <?php
                //while ($i >= 0) {
                    echo "var marker" . $i . " = new google.maps.Marker({ \nposition: myLatLng" . $i . ", \nmap: map, \ntitle: '" . $i . "'}); \n";
                //    $i--;
                //}
                ?>

                //metaa
                document.getElementById('metaotsikko').innerHTML = "Sijainti";

                document.getElementById('metadata').innerHTML = '<?php

                require_once('config.php');
                require_once('dbopen.php');

                $query = "SELECT cordlang, cordlong, heartbeat, steps FROM tiedot  WHERE elainid = 2 ORDER BY id DESC LIMIT 1;";
                $results = mysql_query($query)
                        or die("Kyselyssä tapahtui virhe: " . mysql_errno());

                $i = 0;

                $row = mysql_fetch_array($results);

                echo $row[0] . " lant<br>";
                echo $row[1] . " long<br>";
                echo $row[2] . " bpm<br>";
                echo $row[3] . " akeleet<br>";

                ?>';
            }
        </script>
        <script src="reviiri.php"></script>
        <script src="sijainnit.php"></script>
        <script src="reitti.php"></script>
        <script async defer
                src="https://maps.googleapis.com/maps/api/js?key=AIzaSyClrOhZG24nKhAzRKpfWH1BJ0PKgozI6H4&callback=initMap">
        </script>

    </body>
</html>
