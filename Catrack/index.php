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
        <div style = logo>
        </div>
        <?php
        require_once('config.php');
        require_once('dbopen.php');

        $query = "SELECT * FROM koord";
        $results = mysql_query($query)
                or die("Kyselyssä tapahtui virhe: " . mysql_errno());

        while($row = mysql_fetch_array($results)) {
            echo "<br>";
            echo "$row[0]";
        }
        ?>
    </body>
</html>
