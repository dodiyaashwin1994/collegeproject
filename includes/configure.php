<?php
   /* Establishing connection with mysql database*/
   define('DB_SERVER', 'localhost'); /* defines server path*/
   define('DB_USERNAME', 'root'); /* defines server username*/
   define('DB_PASSWORD', '');  /* defines server password*/
   define('DB_DATABASE', 'mytutr'); /* defines server database name*/
   $conn = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE); 
   if (mysqli_connect_errno()) /* establishes connection*/
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
  mysqli_select_db($conn,"mytutr"); /* selects databse for query processing*/
?>
