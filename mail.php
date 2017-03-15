<!--

this function will fetch all user data where journey date is equal to today's date.
it will fetch all data in array.
for each value in array it will get live train running data and sends mail to user.

-->

<?php
include('includes/configure.php'); // includes configure file for database connection
$sql="SELECT * From sms";          // fetches all data from sms table like user email , train number and date of journey
$result=mysqli_query($conn,$sql);  // executes sql query and stores result in $result variable
while($data=mysqli_fetch_array($result,MYSQLI_ASSOC))   // loop executes till value in result ends
         {
         $trainnum=$data['trainnum'];   //stores train number from data
         $newdate=$data['jrnydate'];    // stores journey date
         $jrnydate = date("Ymd", strtotime($newdate));  //converts journey date formate in Ymd format from Y-m-d format
         $to = $data['email'];         // stores user email
         $subject = $trainnum." live postion - Spot Your Train";  // subject of email to be sent

         $file=file_get_contents("API URL"); // gets information of train fro api
         $decode=json_decode($file,true); //decodes train information from json file and stores in $decode variable
         if ($decode['response_code'] == 200) // if data is successfully recieved then response code is 200
         {
         $message .="<div class='container train' style='padding-right: 0 !important; padding-left: 0 !important;'>";
         $message .= "<div class='row' style='text-align: center; padding: 20px; margin:0;'>";
         $message .= "Train no :<h3 style='color:red;'>".$decode['train_number']."</h3>"; // prints train number
         $message .= $decode['position'];  // prints train current position
         $message .= "</div>";
         
         $message .="<table class='table table-striped table-bordered'>";
            $message .="<tr>";
            $message .= "<th class='hidden-xs'>Stn no.</th>";
            $message .="<th>Stn Name</th>";
            $message .="<th class='hidden-xs'>Stn code</th>";
            $message .= "<th class='hidden-xs'>Day</th>";
            $message .= "<th>Distance</th>";
            $message .="<th>Sch.Arr</th>";
            $message .="<th class='hidden-xs'>Sch.Dep</th>";
            $message .= "<th>Act.arr / Act.dep</th>";
            $message .= "<th>Late(min)</th>";
            $message .= "</tr>";

    foreach ($decode['route'] as $data)
     {
        $message .= "<tr>";
             $message .="<td class='hidden-xs'>".$data['no']."</td>"; // prints serial number
             $message .= "<td>".$data['station_']['name']."</td>";  // prints station name
             $message .= "<td class='hidden-xs'>".$data['station_']['code']."</td>";   // prints station code
             $message .= "<td class='hidden-xs'>".$data['day']."</td>";  // prints day of journey
             $message .= "<td>".$data['distance']."</td>";  // prints distance of covered by train
             $message .= "<td>".$data['scharr']."</td>";    // prints schedule arrival
             $message .= "<td class='hidden-xs'>".$data['schdep']."</td>"; // prints schedule departure
             $message .= "<td>".$data['actarr']."/".$data['actdep']."</td>"; // prints actual arrival
             $message .="<td style='color:red;'>".$data['latemin']."</td>";  // prints actual departure
       $message .= "</tr>";
     }

   $message .= "</table>";
   $message .= "</div>";
   

         $header = "From:SpotYourTrain \r\n";  // from sender name
         $header .= "MIME-Version: 1.0\r\n";
         $header .= "Content-type: text/html\r\n";  
         $retval = mail ($to,$subject,$message,$header);  // sends mail to user

         }
         else     // excutes if resopnse code is not equal to 200
         {
          $message ="Service currently down";
          $header = "From:care@spotyourtrain.info \r\n";
          $header .= "MIME-Version: 1.0\r\n";
          $header .= "Content-type: text/html\r\n";  
          $retval = mail ($to,$subject,$message,$header);  // delivers failure message to user
         }
         
         }
      ?>
