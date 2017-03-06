<!--
$trainnum is used to take train number as input
onclick submit below php code executes
Php function will fetch data of that train in array from database
while loop is used to echo data fetched from sql query
-->
<div class="content">
        <h1>Offline train Data Fetch</h1>

        <form method="POST">
        <div class="input-box">
               <div class="input-area">
                   <div class="input-label"><label>Enter Train Number</label></div>
                   <div class="input-filed"><input type="text" name="trainnum" placeholder="enter train number" class="tnum" required> </div>
               </div>

               <div class="input-area">
                   <div><input type="submit" name="submit" class="submit-btn" value="submit"> </div>
               </div>

          </form>
       </div>


</div>
<?php
if(isset($_POST['submit']))
{

$trainnum=mysqli_real_escape_string($conn, $_POST['trainnum']);

$sql="SELECT * FROM `$trainnum`"; // sql query to fetch data from sql

$result=$conn->query($sql); //execites sql query and stores result in array result

echo "<div class='result-box'>";
echo "<div class='result-display'>";
    echo "Train no :<h3 style='color:red;'>".$trainnum."</h3>";
echo "</div>";

echo "<div class='result-table'>";
      echo "<table>";
        echo "<tr>";
           echo "<th>Stn Name</th>";
           echo"<th class='mob-hdn'>Stn code</th>";
           echo "<th class='mob-hdn'>Day</th>";
           echo "<th>Distance</th>";
           echo "<th>Sch.Arr</th>";
           echo "<th class='mob-hdn'>Sch.Dep</th>";
        echo "</tr>";

while ($row=$result->fetch_assoc())  // while is used to fetch & print data stored in $result varibale
 {
 $stnname=$row['stnname'];
 $stncode=$row['stncode'];
 $day=$row['day'];
 $distance=$row['distance'];
 $scharr=$row['scharr'];
 $schdep=$row['schdep'];

 echo "<tr>";
      echo "<td>".$stnname."</td>";
      echo "<td class='mob-hdn'>". $stncode."</td>";
      echo "<td class='mob-hdn'>".$day."</td>";
      echo "<td>".$distance."</td>";
      echo "<td>".$scharr."</td>";
      echo "<td class='mob-hdn'>".$schdep."</td>";

 echo "</tr>";
}

echo "</table>";
echo "</div>";
echo "</div>";

}

?>
