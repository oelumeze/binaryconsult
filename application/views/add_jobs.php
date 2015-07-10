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
 <?php echo $access_uri; ?>
<div class="container adminContent">
<div class="row">
	<div class="span12"><h2>Add Jobs</h2></div></div>
    <div class="row">
	<div class="span12">
  <ul class="nav nav-pills">
  <li >
   <?php //echo "<a href=".site_url('login/addjob').">Add Jobs</a>";?>
  </li>
 <!-- <li><a href="#">Clear Jobs</a></li>-->
  
</ul>
    </div>
    </div>
    <?php echo '<font color = "red"><p>'.$error.'</p></font>'; ?>
    <form method="post" action="<?php site_url('login/addjob'); ?>">
     <table>
      <tr>
	<th><label><p>Industry</p></label></th>
	<td><input type="text" name="industry"></td>
      </tr>
      <tr>
	<th><label><p>Job Title</p></label></th>
	<td><input type="text" name = "job_title"/></td>
      </tr>
      
      <tr>
       <th><label><p>Company Name</p></label></th>
       <td><input type="text" name="company_name"/></td>
      </tr>
      
      <tr>
       <th><label><p>Location</p></label></th>
       <td><input type="text" name = "location"/></td>
      </tr>
      
      <tr>
       <th><label><p>Summary</p></label></th>
	<td><textarea name="summary"></textarea></td>
      </tr>
      
       <tr>
       <th><label><p>Expected Salary Range</p></label></th>
	<td>
	    <label><p>From</p></label><input type="text" name="salary1"/>
	</td>
	
	<td>
	    <label><p>To</p></label><input type="text" name="salary2"/>
	</td>
      </tr>
      
      <tr>
       <th></th>
       <td><input type="submit" name="submit" value="Submit"/></td>
      </tr>
     </table>
     </form>
    </div>
</body>
</html>
