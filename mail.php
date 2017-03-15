<?php
include('includes/configure.php');
$sql="SELECT * From sms";
$result=mysqli_query($conn,$sql);
while($data=mysqli_fetch_array($result,MYSQLI_ASSOC))
         {
         $trainnum=$data['trainnum'];
         $newdate=$data['jrnydate'];
         $jrnydate = date("Ymd", strtotime($newdate));
         $to = $data['email'];
         $subject = $trainnum." live postion - Spot Your Train";

         $file=file_get_contents("http://api.railwayapi.com/live/train/$trainnum/doj/$jrnydate/apikey/qhk507gq/");
         $decode=json_decode($file,true);
         if ($decode['response_code'] == 200)
         {
         $message .="<div class='container train' style='padding-right: 0 !important; padding-left: 0 !important;'>";
         $message .= "<div class='row' style='text-align: center; padding: 20px; margin:0;'>";
         $message .= "Train no :<h3 style='color:red;'>".$decode['train_number']."</h3>";
         $message .= $decode['position'];
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
             $message .="<td class='hidden-xs'>".$data['no']."</td>";
             $message .= "<td>".$data['station_']['name']."</td>";
             $message .= "<td class='hidden-xs'>".$data['station_']['code']."</td>";
             $message .= "<td class='hidden-xs'>".$data['day']."</td>";
             $message .= "<td>".$data['distance']."</td>";
             $message .= "<td>".$data['scharr']."</td>";
             $message .= "<td class='hidden-xs'>".$data['schdep']."</td>";
             $message .= "<td>".$data['actarr']."/".$data['actdep']."</td>";
             $message .="<td style='color:red;'>".$data['latemin']."</td>";
       $message .= "</tr>";
     }

   $message .= "</table>";
   $message .= "</div>";
   

         $header = "From:SpotYourTrain \r\n";
         $header .= "MIME-Version: 1.0\r\n";
         $header .= "Content-type: text/html\r\n";  
         $retval = mail ($to,$subject,$message,$header);

         }
         else
         {
          $message ="Service currently down";
          $header = "From:care@spotyourtrain.info \r\n";
          $header .= "MIME-Version: 1.0\r\n";
          $header .= "Content-type: text/html\r\n";  
          $retval = mail ($to,$subject,$message,$header);
         }
         
         }
      ?>