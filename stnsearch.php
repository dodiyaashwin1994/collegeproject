<?php
include ('includes/configure.php');

if (isset($_GET['term'])) {
  $query=$_GET['term'];
  $s = ("SELECT stncode, stnname FROM station WHERE stncode LIKE '%{$query}%' OR stnname LIKE '%{$query}%'");
  $sql=$conn->query($s);
$array = array();
  while ($row = $sql->fetch_assoc()) {
      $array[] = array (
          'label' => $row['stncode'].'-'.$row['stnname'],
          'value' => $row['stncode'],
      );
  }
  //RETURN JSON ARRAY
  echo json_encode($array);
}
 ?>
