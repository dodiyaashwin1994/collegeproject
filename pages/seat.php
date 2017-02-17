<div class="content">
        <h1>Indian Railways Seat Availability in Trains</h1>
<!-- form to input various variables using POST METHOD -->
        <form method="POST">
        <div class="input-box">
               <div class="input-area">
                   <div class="input-label"><label>Enter Train Number</label></div>
                   <!-- $trainname input variables  --> 
                   <div class="input-filed"><input type="text" name="trainnum" placeholder="enter train number" class="num" required> </div>
                   
                   <!--script fot  train ane and number auto complete using trainsearch.php  --> 
                   <script>
                   $( function() {
                                 $( ".num" ).autocomplete({
                                    source: 'trainsearch.php', minLength: 3
                                  });
                            });
                  </script>
               </div>

               <div class="input-area">
                    <div class="input-label"> <label>Source Station</label></div>
                       <!-- $srcstn input variables  --> 
                    <div class="input-filed"><input type="text" name="srcstn" class="stn" placeholder="enter station name or code" required></div>
                    
                    <!-- Script for station name and code auto complete using stnsearch.php-->   
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
                     <!-- $desstn input variables  --> 
                    <div class="input-filed"><input type="text" name="desstn" class="stn" placeholder="enter station name or code" required></div>
               </div>

               <div class="input-area">
                    <div class="input-label"> <label>DOJ</label></div>
                      <!-- $jrnydate input variables  -->   
                    <div class="input-filed"><input type="date" name="jrnydate" required></div>
               </div>

               <div class="input-area">
                    <div class="input-label"> <label>Select Journey Class</label></div>
                       <!-- $class input variables  --> 
                    <div class="input-filed">
                       <select name="class">
                                 <option value="1A" >AC First Class (1A)</option>
                                 <option value="2A" >AC 2 Tier (2A)</option>
                                 <option value="3A" >AC 3 Tier (3A)</option>
                                 <option value="3E" >AC 3 Economy (3E)</option>
                                 <option value="CC" >AC Chair Car (CC)</option>
                                 <option value="FC" >First Class (FC)</option>
                                 <option value="SL" selected>Sleeper (SL)</option>
                                 <option value="2S" >Second Sitting (2S)</option>

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
/* variable for train number and intialized with POST method from above form*/          
$trainnum=mysqli_real_escape_string($conn, $_POST['trainnum']);

/* variable for journey date and intialized with POST method from above form*/   
$jrnydate=mysqli_real_escape_string($conn, $_POST['jrnydate']);

/* variable for source station code and intialized with POST method from above form*/   
$srcstn=mysqli_real_escape_string($conn, $_POST['srcstn']);

/* variable for destination station code and intialized with POST method from above form*/   
$desstn=mysqli_real_escape_string($conn, $_POST['desstn']);

/* variable for coach class and intialized with POST method from above form*/   
$class=mysqli_real_escape_string($conn, $_POST['class']);

/* variable for newdate and convert jrnydate in d-m-Y format*/   
$newDate = date("d-m-Y", strtotime($jrnydate));

/*$file fetch data from api in json format*/
$file=file_get_contents("INSERT_YOUR_API_URL_TO_FETCH_DATA_FROM_SERVER");
         
/* stores decoded value of $file variable in array*/ 
$decode=json_decode($file,true);

if ($decode['response_code'] == 200)
{
    echo "<div class='result-box'>";
    echo "<div class='result-display'>";
        /*prints train number, train name */
        echo "<h3>".$decode['train_number']." - ".$decode['train_name']." Seat availibiltiy check </h3>";
        /*prints train class searched and class code */
        echo "Class ".$decode['class']['class_name']." (".$decode['class']['class_code'].")";
    echo "</div>";

    echo "<div class='result-table'>";
          echo "<table class='seat'>";
            echo "<tr>";
               echo "<th >Date</th>";
               echo "<th>Availability</th>";
            echo "</tr>";
        
     /* foreach loop echo's stored data in $decode variable*/
    foreach ($decode['availability'] as $data)
     {
        echo "<tr>";
               /*prints date */
             echo "<td>".$data['date']."</td>";
              /*prints status*/
             echo "<td>".$data['status']."</td>";
       echo "</tr>";
     }

   echo "</table>";
   echo "</div>";

echo "</div>";

}
/*if API doesn't works*/
elseif($decode['response_code'] == 204) {
   echo "<div class='result-box'>";
    echo "<div class='result-display'>";
   echo "<h3 style='color:red;'>Please Try Agian you will get result this time</h3>";
   echo "</div>";
    echo "</div>";
}

/*if user doesn't provide correct values*/
else {
   echo $decode['error'];echo "<div class='result-box'>";
    echo "<div class='result-display'>";
   echo "<h3 style='color:red;'>Please check your Entries and Try again.</h3>";
   echo "</div>";
    echo "</div>";
}

}
?>
<!-- menu html code-->
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
