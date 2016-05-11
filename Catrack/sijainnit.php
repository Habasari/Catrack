function sijainnit() {
  <?php
  require_once('config.php');
  require_once('dbopen.php');

  $query = "SELECT cordlang, cordlong, elainid, id FROM tiedot";
  $results = mysql_query($query)
          or die("Kyselyssä tapahtui virhe: " . mysql_errno());

  echo "var map;\n";
  while ($row = mysql_fetch_array($results)) {
      echo "var myLatLng" . $row[3] . " = {lat: " . $row[0] . ", lng: " . $row[1] . "};\n";
      echo "if (map == null) {
          map = new google.maps.Map(document.getElementById('map'), {
          zoom: 14,
          center: myLatLng".$row[3]."
      });}\n";
      echo "var marker" . $row[3] . " = new google.maps.Marker({ \nposition: myLatLng" . $row[3] . ", \nmap: map, \ntitle: '" . $row[3] . "', icon: 'buten" . $row[2] .".png'}); \n";
      echo "google.maps.event.addListener(marker" . $row[3] . ", 'click', function(event){
        setMetaData(". $row[3] .");
      });\n";
  }
  //require_once('dbclose.php');
  ?>
}

function setMetaData(id) {

  var rowID = id;
  var php = "";
  $.get("fetchData.php?id=" + rowID, function(data){
    setData(data, rowID)
  });
}

function setData(html, rowID){
  document.getElementById('metaotsikko').innerHTML = "Sijaintitieto nr." + rowID;
  document.getElementById('metadata').innerHTML = html;
}
