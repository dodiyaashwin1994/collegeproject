<div class="content">
        <h1>Spot Your Train</h1>

        <form method="POST">
        <div class="input-box">
               <div class="input-area">
                   <div class="input-label"><label>Enter Train Number</label></div>
                   <div class="input-filed"><input type="text" name="trainnum" placeholder="enter train number" class="tnum" required> </div>
                   <script>
                   $(function() {
                                 $( ".tnum" ).autocomplete({
                                   source: 'trainsearch.php', minLength:3
                                 });
                                });
                  </script>
               </div>

               <div class="input-area">
                    <div class="input-label"> <label>Select Journey Date</label></div>
                    <div class="input-filed">
                       <select name="jrnydate">
                                 <option value="<?php echo date("Ymd", strtotime('-2 days'));?>" >Day before Yesterday</option>
                                 <option value="<?php echo date("Ymd", strtotime('-1 days'));?>" >Yesterday</option>
                                 <option value="<?php echo date("Ymd");?>"  selected>today</option>
                       </select>
                    </div>
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

$jrnydate=mysqli_real_escape_string($conn, $_POST['jrnydate']);

$file=file_get_contents("INSERT_YOUR_API_URL_TO_FETCH_DATA_FROM_SERVER");
$decode=json_decode($file,true);

if ($decode['response_code'] == 200)
{
    echo "<div class='result-box'>";
    echo "<div class='result-display'>";
        echo "Train no :<h3 style='color:red;'>".$decode['train_number']."</h3>";
        echo $decode['position'];
    echo "</div>";

    echo "<div class='result-table'>";
          echo "<table>";
            echo "<tr>";
               echo "<th class='mob-hdn'>Stn no.</th>";
               echo "<th>Stn Name</th>";
               echo"<th class='mob-hdn'>Stn code</th>";
               echo "<th class='mob-hdn'>Day</th>";
               echo "<th>Distance</th>";
               echo "<th>Sch.Arr</th>";
               echo "<th class='mob-hdn'>Sch.Dep</th>";
               echo "<th>Act.arr / Act.dep</th>";
               echo "<th>Late(min)</th>";
            echo "</tr>";

    foreach ($decode['route'] as $data)
     {
        echo "<tr>";
             echo "<td class='mob-hdn'>".$data['no']."</td>";
             echo "<td>".$data['station_']['name']."</td>";
             echo "<td class='mob-hdn'>".$data['station_']['code']."</td>";
             echo "<td class='mob-hdn'>".$data['day']."</td>";
             echo "<td>".$data['distance']."</td>";
             echo "<td>".$data['scharr']."</td>";
             echo "<td class='mob-hdn'>".$data['schdep']."</td>";
             echo "<td>".$data['actarr']."/".$data['actdep']."</td>";
             echo "<td style='color:red;'>".$data['latemin']."</td>";
       echo "</tr>";
     }

   echo "</table>";
   echo "</div>";

echo "</div>";

}

elseif($decode['response_code'] == 510) {
   echo "<div class='result-box'>";
    echo "<div class='result-display'>";
   echo "<h3 style='color:red;'>Train not scheduled to run on the given date.</h3>";
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
  <li><a class="fare" href="pnr-status">Fare Enquiry</a></li>
  <li><a class="time" href="pnr-status">Train Time Table</a></li>
  <li><a class="seat" href="seat-availability">Seat Availability</a></li>
  <li><a class="tbstn" href="trains-between-stations">Trains Between Stations</a></li>
</ul>
</div>
<div class='result-display'>
  <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- spot your train -->
<ins class="adsbygoogle"
     style="display:block"
     data-ad-client="ca-pub-8648217255727755"
     data-ad-slot="6815713627"
     data-ad-format="auto"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>
</div>
