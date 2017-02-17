<div class="menu">
<ul class="topnav">
  <li><a class="spot" href="http://spotyourtrain.info/national-train-enquiry-system">Live train status</a></li>
  <li><a class="seat" href="http://spotyourtrain.info/seat-availability">Seat Availability</a></li>
</ul>
</div>
<div class='result-box'>
   <div class='result-display'>
    <h1><?php echo $tno." ".$tname; ?></h1>
</div>
 <?php
/* variable for train number and intialized with POST method from above form*/ 
 $trainnum=mysqli_real_escape_string($conn, $tno);
  
 /*$file fetch data from api in json format*/
 $file=file_get_contents("INSERT_YOUR_API_URL_TO_FETCH_DATA_FROM_SERVER");
  
 /* stores decoded value of $file variable in array*/ 
 $decode=json_decode($file,true);

 if ($decode['response_code'] == 200)
 {

     echo "<div class='result-table'>";
           echo "<table>";
             echo "<tr>";
                echo "<th class='mob-hdn'>Stn no.</th>";
                echo "<th>Stn Name</th>";
                echo"<th class='mob-hdn'>Stn code</th>";
                echo "<th>Day</th>";
                echo "<th>Distance</th>";
                echo "<th>Sch.Arr</th>";
                echo "<th>Sch.Dep</th>";

             echo "</tr>";
   
   
     /* foreach loop echo's stored data in $decode variable*/
     foreach ($decode['route'] as $data)
      {
         echo "<tr>";
              echo "<td class='mob-hdn'>".$data['no']."</td>";
              echo "<td>".$data['fullname']."</td>";
              echo "<td class='mob-hdn'>".$data['code']."</td>";
              echo "<td>".$data['day']."</td>";
              echo "<td>".$data['distance']."</td>";
              echo "<td>".$data['scharr']."</td>";
              echo "<td>".$data['schdep']."</td>";
        echo "</tr>";
      }

    echo "</table>";
    echo "</div>";



 }

 ?>

 </div>
