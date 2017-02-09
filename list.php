<div class='result-box'>
<?php
$sql=("SELECT * FROM train");
$result=$conn->query($sql);
if($result!=null)
{
  echo "<table>";
  echo "<tr>";
  echo "<th>s/no</th>";
  echo "<th>Train no.</th>";
  echo "<th>Name</th>";
  echo "<th>From</th>";
  echo "<th>To</th>";
  echo "</tr>";

  while($row=$result->fetch_assoc())

   { $name= strtolower($row['tname']);
     $name = trim($name, '-');
     $name=preg_replace('/[^a-zA-Z0-9]+/', '-', $name);
     echo "<tr>";
     echo "<td>".$row['id']."</td>";
     echo "<td>".$row['tno']."</td>";
     echo "<td><a href='train/".$row['tno']."/".$name."'>".$row['tname']."</a></td>";
     echo "<td>".$row['frm']."</td>";
     echo "<td>".$row['des']."</td>";
     echo "</tr>";
   }

   echo "</table>";

}



 ?>
</div>
