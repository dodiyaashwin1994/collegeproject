<?php
include ('includes/configure.php');

if (isset($_GET['term'])) {
  $query=$_GET['term'];
  $s = ("SELECT tno, tname FROM train WHERE tno LIKE '%{$query}%' OR tname LIKE '%{$query}%'");
  $sql=$conn->query($s);
$array = array();
  while ($row = $sql->fetch_assoc()) {
      $array[] = array (
          'label' => $row['tno'].'-'.$row['tname'],
          'value' => $row['tno'],
      );
  }
  //RETURN JSON ARRAY
  echo json_encode($array);
}
 ?>
