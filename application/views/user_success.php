<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $title;?></title>
<script type="text/javascript" src="<?php echo base_url();?>/assets/js/jquery.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>/assets/js/jquery.easing.1.3.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>/assets/js/action.js"></script>

<link href='http://fonts.googleapis.com/css?family=Nova+Square' rel='stylesheet' type='text/css'>
<link href="<?php echo base_url();?>/assets/css/style.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url();?>/assets/css/bootstrap.css" rel="stylesheet" type="text/css" />

<link href="<?php echo base_url();?>/assets/css/adminStyle.css" rel="stylesheet" type="text/css" />
</head>

<body>
 <?php //$this->load->view('main_nav.php'); ?>
<div class="container adminContent">
<div class="row">
	<div class="span12"><h2></h2></div></div>
    <div class="row">
	<div class="span12">
  <ul class="nav nav-pills">
  
  <?php  echo '<p align = "center">Your CV has successfully been uploaded on our record';?><br/>
  <?php  echo '<p align = "center">An email has been forwarded to you on '.'<em>'.$user_email.'</em>'.'</p>';?>
 
  
</ul>
    </div>
    </div>
    
    </div>
</body>
</html>
