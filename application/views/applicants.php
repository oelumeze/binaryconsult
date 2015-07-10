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
<?php echo $access_uri;?>
 <div class="container adminContent">
<div class="row">
	<div class="span12"><h2>Manage CVs</h2></div></div>
    <div class="row">
	<div class="span12">
  <ul class="nav nav-pills">
  <li >
   <?php
   //echo "<a href= ".site_url('login/submitCV').  ">Add CVs</a>";?>
  </li>
  <?php //echo "<li><a href=".site_url('login/clearjobs').">Clear Jobs</a></li>";?>
  
</ul>
    </div>
    </div>
  <div class="row">
	<div class="span12">
	 <?php
	 if(!$query){
	  
	  echo "No applicant(s) Available";
	 }
	 else{
	 
	 
	 
		echo '<table class="table table-bordered" width="100%" border="0" cellspacing="0" cellpadding="0">
        <thead>
    <td>SurName</td>
    <td>FirstName</td>
    <td>OtherName</td>
    <td>Email Address</td>
    <td><a href = "'.site_url('login/jobtitle').'">Job Applied For</a></td>
    <td><a href = "'.site_url('login/companyname').'">Company Name</a></td>
    <td><a href = "'.site_url('login/status').'">Marital Status</a></td>
    <td>Phone</td>
    <td><a href = "'.site_url('login/state').'">State</a></td>
    <td><a href = "'.site_url('login/gender').'">Sex</a></td>
    <td>Passport</td>
    <td>CVs</td>
        
        </thead>';
	foreach($query as $row){
         
 echo '<tr>
    <td>'.ucfirst($row['sname']).'</td>
    <td>'.ucfirst($row['fname']).'</td>
    <td>'.ucfirst($row['oname']).'</td>
    <td><em>'.$row['email'].'</em></td>
    <td>'.ucfirst($row['job_title']).'</td>
    <td>'.ucfirst($row['company_name']).'</td>
    <td>'.ucfirst($row['marital_status']).'</td>
    <td>'.ucfirst($row['phone']).'</td>
    <td>'.ucfirst($row['state']).'</td>
    <td>'.ucfirst($row['sex']).'</td>
    <td><a href = "'.site_url('login/viewimage/'.$row['applicant_id']).'"><img src ="'.base_url().'folders/images/member_data/'.$row['passport'].'" width = "70" height = "70" ></a></td>
    <td><a href = "'.site_url('login/downloadCV/'.$row['applicant_id']).'">Download CV</a></td>
    
  </tr>';
	}
	 }
	 ?>
<?php echo '</table>';?>

    </div>
    </div>
<?php echo '<div class="pagination">
  <ul>
    <li><a href ="'.site_url('login/applications').'" >'.$pagination.'</a></li>
    
  </ul>
</div> ';
	?> 
  
   </div>
</body>
</html>
