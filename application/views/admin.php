<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $title;?></title>
<script type="text/javascript" src="<?php echo base_url(); ?>/assets/js/jquery.js"></script>
<script type="text/javascript" src="<?php  echo base_url();?>/assets/js/jquery.easing.1.3.js"></script>
<script type="text/javascript" src="<?php echo  base_url();?>/assets/js/action.js"></script>
<link href='http://fonts.googleapis.com/css?family=Oxygen:400,700' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Nova+Square' rel='stylesheet' type='text/css'>
<link href="<?php echo base_url(); ?>/assets/css/style.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>/assets/css/bootstrap.css" rel="stylesheet" type="text/css" />

<link href="<?php echo base_url();?>/assets/css/adminStyle.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div class="container">
<div class="row loginLogo">
<div class="span4"></div>
<div class="span4"><img src="<?php echo base_url(); ?>/assets/img/adminLogo.png"></div>
<div class="span4"></div>
</div>
	<div class="row">
    <div class="span4"><br />
</div>
    	<div class="span4" id="login">
	  <font color="red"><?php echo $error; ?></font>
        <div>
       </div>
        	<form method = "post" action = "<?php site_url('login'); ?>">
          <fieldset>
            <legend>Sign In</legend>
            <label>Username</label>
            <input type="text" name="username" placeholder="Username" class="span4">
            <label>Password</label>
            <input type="Password" name="password" placeholder="Password" class="span4">
              <label> </label>
           <button type="submit" class="btn btn-primary">Submit</button>
        
          </fieldset>
</form>

 
        </div>
            <div class="span4"><br />
</div>
    </div>
   </div>
</body>
</html>
