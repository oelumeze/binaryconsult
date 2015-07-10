<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title><?php echo $title ; ?></title>
<link href="<?php echo base_url() ; ?>assets/css/style.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url() ; ?>assets/css/timePicker.css" rel="stylesheet" type="text/css" />
    <?php
    
        echo "<script type=\"text/javascript\">
                function get_base_url()
                {
                    return \"".base_url()."\";
                }
                function get_site_url()
                {
                    return \"".site_url()."\";
                }
                
                function get_current_url()
                {
                    return \"".current_url()."\";
                }
                
            </script>";
            
        //generate the script for
    ?>
<script src="<?php echo base_url() ; ?>assets/js/jquery.js" type="text/javascript"></script>

<?php echo $additional_js ; ?>

</head>

<body>

<div id="signInHolder">
<div class="wrap"><h1><img src="<?php echo base_url()."assets/images/agt_logo.png" ; ?>" alt="Africa Ground Transport"  class="logo"/></h1>
<div id="signPanel">
<ul>
      <h2>Sign In</h2>
	<font color="red"><?php echo $error ; ?></font>

	  <form id="form1" name="form1" method="post" action="">
		<li><label>Email Address</label>
		  <?php echo form_input('username', set_value('username')) ; ?></li>
		<li>
		<label>Password</label>
		  <?php echo form_password('password','') ; ?></li>
		
		 <li class="clearfix"><a href="<?php echo site_url('register') ; ?>" class="signup">Sign Up</a><input name="submit" type="submit"  class="blueBtn floatRight"  id="submit" value="Sign In" /></li>
		  <li><a href="#" style="margin-left:100px; color:#2b6ba8">Forgot Password</a></li>
	  </form>

    </div>
</div><div class="clear"></div>
			
<?php $this->load->view('partial/footer') ; ?>