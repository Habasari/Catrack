<?php

require_once("config.php");
require_once("dbopen.php");

$rowID = $_GET[id];

$query = "SELECT cordlang, cordlong, heartbeat, steps FROM tiedot WHERE id = " . $rowID;
$results = mysql_query($query)
        or die("Kyselyssä tapahtui virhe: " . mysql_errno());

$row = mysql_fetch_array($results);

echo $row[0] . " lant<br>";
echo $row[1] . " long<br>";
echo $row[2] . " bpm<br>";
echo $row[3] . " akeleet<br>";

?>
