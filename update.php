<!--
$trainnum is ued to store train number
using sql we will crete a table with above trainnum variable if table donot already exsists.
Once table is created it will fetch train data from api and stores in variable $file
then json data stored in $file is decoded and stored in $decode variable
then $decode data is inserted into table $trainnum using foreach loop and sql query
-->

<div class="content">
        <h1>Adding Train Data Into Database</h1>

        <form method="POST">
        <div class="input-box">
               <div class="input-area">
                   <div class="input-label"><label>Enter Train Number</label></div>
                   <div class="input-filed"><input type="text" name="trainnum" placeholder="enter train number" class="tnum" required> </div>
                   <!-- used for train name and number auto complete-->
                   <script>
                   $(function() {
                                 $( ".tnum" ).autocomplete({
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
// stores train number entered by user
$trainnum=mysqli_real_escape_string($conn, $_POST['trainnum']);
//sql query to create table with $trainnum as table name
$sql1="CREATE TABLE IF NOT EXISTS `$trainnum` (
  `stnname` text NOT NULL,
  `stncode` text NOT NULL,
  `day` int(2) NOT NULL,
  `distance` int(4) NOT NULL,
  `scharr` text NOT NULL,
  `schdep` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1";

$query1=mysqli_query($conn,$sql1);
// query to fetch data of $trainnum from api
$file=file_get_contents("http://api.railwayapi.com/route/train/$trainnum/apikey/qhk507gq/");
$decode=json_decode($file,true);
if ($decode['response_code'] == 200)
{
foreach ($decode['route'] as $data)
 {
 $stnname=$data['fullname'];
 $stncode=$data['code'];
 $day=$data['day'];
 $distance=$data['distance'];
 $scharr=$data['scharr'];
 $schdep=$data['schdep'];
// sql query to insert data into $trainnum table
 $sql="INSERT INTO `$trainnum`(`stnname`, `stncode`, `day`, `distance`, `scharr`, `schdep`) VALUES ('$stnname','$stncode','$day','$distance','$scharr','$schdep')";
 $query=mysqli_query($conn,$sql);
 echo "successfully added";

 }
}
}
?>
