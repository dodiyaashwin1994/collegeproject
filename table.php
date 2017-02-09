<div class="content">
        <h1>Indian railway train Time table</h1>

        <form method="POST">
        <div class="input-box">

               <div class="input-area">
                    <div class="input-label"> <label>Enter train name or number</label></div>
                    <div class="input-filed"><input type="text" name="trainnum" class="stn" placeholder="enter train name or number" required></div>
                    <script>
                    $(function() {
                                  $( ".stn" ).autocomplete({
                                    source: 'trainsearch.php', minLength:3
                                  });
                                 });
                   </script>
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
$tno=mysqli_real_escape_string($conn, $_POST['trainnum']);
$file=file_get_contents("INSERT_YOUR_API_URL_TO_FETCH_DATA_FROM_SERVER");
$decode=json_decode($file,true);

if ($decode['response_code'] == 200)
{
  echo "<div class='result-box'>";
  echo "<div class='result-display'>";
      echo "<h3>".$decode['train']['number']." - ".$decode['train']['name']." train time table </h3>";
  echo "</div>";

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
echo "</div>";
}

}

?>
<div class="sub-menu">
  <ul class="topnav">
    <li><a class="spot" href="national-train-enquiry-system">spot your train</a></li>
    <li><a class="pnr" href="pnr-status">Pnr Status</a></li>
    <li><a class="fare" href="station-name-to-code">stn name to code</a></li>
    <li><a class="time" href="time-table">Train Time Table</a></li>
    <li><a class="seat" href="seat-availability">Seat Availability</a></li>
    <li><a class="tbstn" href="trains-between-stations">Trains Btw Stations</a></li>
  </ul>
</div>
