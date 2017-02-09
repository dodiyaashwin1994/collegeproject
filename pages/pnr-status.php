<div id="fb-root"></div>
<script>(function(d, s, id) {
var js, fjs = d.getElementsByTagName(s)[0];
if (d.getElementById(id)) return;
js = d.createElement(s); js.id = id;
js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.8&appId=1536526606678024";
fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<div class="content">
        <h1>Check Pnr Status</h1>

        <form method="POST">
        <div class="input-box">
               <div class="input-area">
                   <div class="input-label"><label>Enter PNR Number</label></div>
                   <div class="input-filed"><input type="number" name="pnr" placeholder="enter 10 Digit PNR number" max="10" min="10" required> </div>
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
$pnr=mysqli_real_escape_string($conn, $_POST['pnr']);


$file=file_get_contents("INSERT_YOUR_API_URL_TO_FETCH_DATA_FROM_SERVER");
$decode=json_decode($file,true);

if ($decode['response_code'] == 200)
{
    echo "<div class='result-box'>";
    echo "<div class='result-display'>";
        echo "PNR Enquiry for : <h3 style='color:red;'>".$decode['pnr']."</h3>";
    echo "</div>";

    echo "<div class='result-table'>";
          echo "<table>";
            echo "<tr>";
               echo "<th>Train no.</th>";
               echo "<th>Train Name</th>";
               echo"<th>FROM</th>";
               echo "<th>TO</th>";
            echo "</tr>";

            echo "<tr>";
               echo "<td>".$decode['train_num']."</th>";
               echo "<td>".$decode['train_name']."</th>";
               echo"<td>".$decode['from_station']['name']."</th>";
               echo "<td>".$decode['to_station']['name']."</th>";
            echo "</tr>";


            echo "<tr>";
               echo "<th>Chart status</th>";
               echo "<th>Class</th>";
               echo"<th>Passenger</th>";
               echo "<th>DOJ</th>";
            echo "</tr>";

            echo "<tr>";
               echo "<td>".$decode['chart_prepared']."</th>";
               echo "<td>".$decode['class']."</th>";
               echo"<td>".$decode['total_passengers']."</th>";
               echo "<td>".$decode['doj']."</th>";
            echo "</tr>";

           echo "</table>";

           echo "<table>";
            echo "<tr>";
               echo "<th>S.no</th>";
               echo "<th>Booking Status</th>";
               echo"<th>Current Status</th>";
               echo "<th>Coach postion</th>";
            echo "</tr>";

          foreach($decode['passengers'] as $pass)
           {
            echo "<tr>";
               echo "<td>".$pass['no']."</th>";
               echo "<td>".$pass['booking_status']."</th>";
               echo"<td>".$pass['current_status']."</th>";
               echo "<td>".$pass['coach_position']."</th>";
            echo "</tr>";
          }
           echo "</table>";
     echo "</div>";


   echo "</div>";
}

elseif ($decode['response_code'] == 410) {
   echo "<div class='result-box'>";
    echo "<div class='result-display'>";
        echo "<h3 style='color:red;'>Flushed PNR / PNR not yet generated</h3>";
    echo "</div>";
    echo "</div>";

}

elseif ($decode['response_code'] == 202) {
    echo "<div class='result-box'>";
    echo "<div class='result-display'>";
        echo "<h3 style='color:red;'>Service Down / Source not responding</h3>";
    echo "</div>";
    echo "</div>";
}

else {
    echo "<div class='result-box'>";
    echo "<div class='result-display'>";
        echo "<h3 style='color:red;'>Service Down / Source not responding</h3>";
    echo "</div>";
    echo "</div>";
}

}

?>
<div class="sub-menu">
<ul class="topnav">
  <li><a class="spot" href="national-train-enquiry-system">spot your train</a></li>
  <li><a class="pnr" href="pnr-status">Pnr Status</a></li>
  <li><a class="fare" href="pnr-status">Fare Enquiry</a></li>
  <li><a class="time" href="pnr-status">Train Time Table</a></li>
  <li><a class="seat" href="seat-availability">Seat Availability</a></li>
  <li><a class="tbstn" href="trains-between-stations">Trains Between Stations</a></li>
</ul>
</div>
