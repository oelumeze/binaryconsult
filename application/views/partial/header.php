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
<div id="wrapper">
            <div id="header" class="clearfix">
                            
                <h1 class="logo"><img src="<?php echo base_url()."assets/images/agt_logo.png" ; ?>"  alt="Africa Ground Transport"/></h1>
    </div>