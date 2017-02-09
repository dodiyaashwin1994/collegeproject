<?php
include ('includes/configure.php');

include ('header.php');

$page=$_GET['page'];
   switch ($page)
		    {
          case 'national-train-enquiry-system' : include ('pages/live-status.php');
	        break;

          case 'pnr-status' : include ('pages/pnr-status.php');
		      break;

          case 'train' : include ('pages/train.php');
          break;


          case 'list' : include ('pages/list.php');
	        break;

          case 'seat-availability' : include ('pages/seat.php');
	        break;

          case 'trains-between-stations' : include ('pages/trainbtwstn.php');
	        break;

          case 'station-name-to-code' : include ('pages/stncode.php');
	        break;

          case 'time-table' : include ('pages/table.php');
          break;


          default: include('pages/home.php');
          break;

        }

include ('footer.php');
?>
