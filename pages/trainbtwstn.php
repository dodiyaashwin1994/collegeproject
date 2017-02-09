<div class="content">
        <h1>Trains between stations</h1>

        <form method="POST">
        <div class="input-box">

               <div class="input-area">
                    <div class="input-label"> <label>Source Station</label></div>
                    <div class="input-filed"><input type="text" name="srcstn" class="stn" placeholder="enter station name or code" required></div>
                    <script>
                    $(function() {
                                  $( ".stn" ).autocomplete({
                                    source: 'stnsearch.php', minLength:3
                                  });
                                 });
                   </script>
               </div>

               <div class="input-area">
                    <div class="input-label"> <label>Destination Station</label></div>
                    <div class="input-filed"><input type="text" name="desstn" class="stn" placeholder="enter station name or code" required></div>
               </div>

               <div class="input-area">
                    <div class="input-label"> <label>Date of Journey</label></div>
                    <div class="input-filed"><input type="date" name="jrnydate" required></div>
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
$srcstn=mysqli_real_escape_string($conn, $_POST['srcstn']);
$desstn=mysqli_real_escape_string($conn, $_POST['desstn']);
$jrnydate=mysqli_real_escape_string($conn, $_POST['jrnydate']);
$newDate = date("d-m", strtotime($jrnydate));
$file=file_get_contents("INSERT_YOUR_API_URL_TO_FETCH_DATA_FROM_SERVER");
$decode=json_decode($file,true);

if ($decode['response_code'] == 200)
{
    echo "<div class='result-box'>";
    echo "<div class='result-display'>";
        echo "<h3>".$decode['total']." Trains Found</h3>";
    echo "</div>";

    echo "<div class='result-table'>";
          echo "<table>";
            echo "<tr>";
               echo "<th>Train No.</th>";
               echo "<th>Train Name</th>";
               echo"<th class='mob-hdn'><table><tr><th>mon</th><th>tue</th><th>wed</th><th>thrus</th><th>fri</th><th>sat</th><th>sun</th></tr></table></th>";
               echo "<th>From</th>";
               echo "<th>Dep.</th>";
               echo "<th>To</th>";
               echo "<th>Arr.</th>";
               echo "<th>Travel Time</th>";
            echo "</tr>";

    foreach ($decode['train'] as $data)
     {
        echo "<tr>";
             echo "<td>".$data['number']."</td>";
             echo "<td>".$data['name']."</td>";
             echo"<td class='mob-hdn'><table><tr>";
             foreach($data['days'] as $day)
             { echo "<td>".$day['runs']."</td>";}
             echo "</tr></table></td>";
             echo "<td>".$data['from']['code']."</td>";
             echo "<td>".$data['src_departure_time']."</td>";
             echo "<td>".$data['to']['code']."</td>";
             echo "<td >".$data['dest_arrival_time']."</td>";
             echo "<td>".$data['travel_time']."</td>";

       echo "</tr>";
     }

   echo "</table>";
   echo "</div>";

echo "</div>";

}

else {
   echo $decode['error'];echo "<div class='result-box'>";
    echo "<div class='result-display'>";
   echo "<h3 style='color:red;'>Service Down. Try again after few minutes.</h3>";
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
