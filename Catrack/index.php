<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="style.css">
        <title>C(at)Trak</title>
    </head>
    <body>

        <div class = logo></div>

        <div class = content>
            <table id = tNav>
                <tr>
                    <td>
                        <a href = "#" id = nav>Buten</a>
                    </td>
                    <td>
                        <a onclick="reviiri()" href = "#" id = nav>Reviiri</a>
                    </td>
                    <td>
                        <a onclick="reviiri2()" href = "#" id = nav>Buten</a>
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
                    <td>
                        <a href = "#" id = nav>Buten</a>
                    </td>
                </tr>
            </table>

            <div class = left id="map"></div>

            <div class = right>
                <h1>Content</h1>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras blandit enim et feugiat ullamcorper. Integer vel nisl at erat vestibulum tincidunt nec nec massa. Sed hendrerit malesuada sodales. Donec interdum dolor quis iaculis consequat. Curabitur vestibulum metus a arcu lobortis rutrum in sit amet justo. Mauris ac ultricies elit. Nunc porttitor velit sed dui molestie, ut tincidunt augue venenatis.</p>
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
        </script>
        <script src="reviiri.php"></script>
        <script async defer
                src="https://maps.googleapis.com/maps/api/js?key=AIzaSyClrOhZG24nKhAzRKpfWH1BJ0PKgozI6H4&callback=initMap">
        </script>

    </body>
</html>