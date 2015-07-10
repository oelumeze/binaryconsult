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
	<div class="span12"><h2>Manage Jobs</h2></div></div>
    <div class="row">
	<div class="span12">
  <ul class="nav nav-pills">
  <li >
   <?php
   echo "<a href= ".site_url('login/addjob').  ">Add Jobs</a>";?>
  </li>
  <?php echo "<li><a href=".site_url('login/clearjobs').">Clear Jobs</a></li>";?>
  
</ul>
    </div>
    </div>
  <div class="row">
	<div class="span12">
	 <?php
	 if(!$query){
	  
	  echo "No Job(s) Available";
	 }
	 else{
	 
	 
	 
		echo '<table class="table table-bordered" width="100%" border="0" cellspacing="0" cellpadding="0">
        <thead>
    <td>Industry</td>
    <td>Job Title</td>
    <td>Company</td>
    <td>Location</td>
    <td>Summary</td>
    <td>Salary</td>
    <td>Action</td>
        
        </thead>';
	foreach($query as $row){
         
 echo '<tr>
    <td>'.$row['industry'].'</td>
    <td>'.$row['job_title'].'</td>
    <td>'.$row['company_name'].'</td>
    <td>'.$row['location'].'</td>
    <td>'.$row['summary'].'</td>
    <td>'.$row['salary'].'</td>
    <td><a href="'.site_url('login/deletejob/'.$row['job_id']).'"><i class=" icon-remove-sign"></i><a href = "'.site_url('login/deletejob/'.$row['job_id']).'">Delete</a></td>
  </tr>';
	}
	 }
	 ?>
<?php echo '</table>';?>

    </div>
    </div>
<?php echo '<div class="pagination">
  <ul>
    <li><a href ="'.site_url('login/home').'" >'.$pagination.'</a></li>
    
  </ul>
</div> ';
	?> 
  
   </div>
</body>
</html>
