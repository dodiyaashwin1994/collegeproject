<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="initial-scale=1, maximum-scale=1">
<link rel="stylesheet" type="text/css" href="/includes/style.css">
<meta name="robots" content="noodp"/>
<link rel="shortcut icon" type="image/png" href="/includes/icons/favicon.png"/>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

<?php
$page=$_GET['page'];
if ($_GET['page']=="train")
{
  $tno=$_GET['tno'];
  $str=$_GET['tname'];

  $tname=str_replace('-', ' ', $str);
}

switch($page)
{
  case 'national-train-enquiry-system':
  $title='National train enquiry system on mobile';
  $desc='National train enquiry system. Check live train running status on mobile for Indian Railways. Spot your train online.';
  break;

  case 'pnr-status':
  $title='Check train PNR status of Indian railway on mobile';
  $desc='Check PNR status of your train ticket. Check live train running status on mobile for Indian Railways.Get Live Running Status for 6500 trains.';
  break;


  case 'train' :
  $title= $tno." ".$tname;
  $desc=$tno." ".$tname." time table.";
  break;

  case 'list' :
  $title="Indian railway train list";
  $desc="List all indian railway trains. List of all Express, superfast, local, premium and special trains running in India. Rajdhani, Durunto and Shatabdi.";
  break;

  default:
  $title='Spot your Train, Live Train Running Status on mobile';
  $desc='Spot your train on mobile. Get live Train running status of Indian Railways anywhere anytime on Spot ur train. Get Live Running Status for 6500 trains.';
  break;

}
 ?>

<title> <?php echo $title;?> </title>
<meta name="description" content="<?php echo $desc; ?>"/>
<link rel="author" href="https://plus.google.com/"/>

<meta property="og:title" content="<?php echo $title; ?>"/>
<meta property="og:type" content="website"/>
<meta property="og:image" content="http://spotyourtrain.info/includes/icons/train.png"/>
<meta property="og:url" content='<?php echo 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>'/>
<meta property="og:description" content="<?php echo $desc; ?>"/>
<meta property="og:site_name" content="Spotyourtrain" />
<meta property="fb:admins" content="1473326486227570"/>

<meta name="twitter:card" content="summary">
<meta name="twitter:url" content='<?php echo 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>'>
<meta name="twitter:title" content="<?php echo $title; ?>">
<meta name="twitter:description" content="<?php echo $desc; ?>">
<meta name="twitter:image" content="http://spotyourtrain.info/includes/icons/train.png">

</head>
<body>
<div class="container">

<div>
<div class="header">
         <div class="logo">
         <a href="http://localhost">
           <div class="logo-title">spotyourtrain</div>
          </a>
         </div><!--logo-->
</div><!--header--->
