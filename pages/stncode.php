<div class="content">
        <h1>Station Name to Station code</h1>

        <form method="POST">
        <div class="input-box">

               <div class="input-area">
                    <div class="input-label"> <label>Enter station name</label></div>
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
                   <div><input type="submit" name="submit" class="submit-btn" value="submit"> </div>
               </div>

          </form>
       </div>
</div>
<?php
if(isset($_POST['submit']))
{
$srcstn=mysqli_real_escape_string($conn, $_POST['srcstn']);
$s = ("SELECT stncode, stnname FROM station WHERE stncode LIKE '%{$srcstn}%' or stnname LIKE '%{$srcstn}%'");
$sql=$conn->query($s);
  echo "<div class='result-box'>";
echo "<div class='result-table'>";
      echo "<table class='seat'>";
        echo "<tr>";
           echo "<th>Stn Code</th>";
           echo "<th>Stn Name</th>";
        echo "</tr>";

while ($row = $sql->fetch_assoc()) {

          echo "<tr>";
             echo "<td>".$row['stncode']."</th>";
             echo "<td>".$row['stnname']."</th>";
          echo "</tr>";

}

}

echo "</table>";
echo "</div>";
echo "</div>";
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
