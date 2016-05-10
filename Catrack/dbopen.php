<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if($dbtype == "mysql") {
    $conn = mysql_connect($dbhost, $dbuser, $dbpass)
            or die('Ei voida yhdistää: ' . mysql_error());
    mysql_select_db($dbname, $conn);
}

?>