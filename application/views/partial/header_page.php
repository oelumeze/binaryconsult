<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title><?php echo $title ; ?></title>
<!--<link href="<?php echo base_url() ; ?>assets/css/styles.css" rel="stylesheet" type="text/css" />-->
<!--<link href="<?php echo base_url() ; ?>assets/css/timePicker.css" rel="stylesheet" type="text/css" />-->
<link href="<?php echo base_url() ; ?>assets/css/style.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url() ; ?>assets/css/reset.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url() ; ?>assets/css/960_12_col.css" rel="stylesheet" type="text/css" />
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
<script language="javascript">  
//Alter this variable depending on how many words you want to limit the textarea to.  
var maxwords = 100;  
  
function check_length(obj, cnt, rem)  
{  
    var ary = obj.value.split(" ");  
    var len = ary.length;  
    cnt.innerHTML = len;  
    rem.innerHTML = maxwords - len;  
    if (len > maxwords) {  
        alert("Message in '" + obj.name + "' limited to " + maxwords + " words.");  
        ary = ary.slice(0,maxwords-1);  
        obj.value = ary.join(" ");  
        cnt.innerHTML = maxwords;  
        rem.innerHTML = 0;  
        return false;  
    }  
    return true;  
}  
</script> 

<?php echo $additional_js ; ?>

</head>

<body>
    <div id="wrapper">
 <!--CONTAINER-->
 <div class="container_12">
  <!--HEADER-->
  <div id="header">
   <!--LOGO-->
   <div class="grid_4" id="logo">
    <img src="<?php echo base_url(); ?>assets/images/logo.png">
   </div>
   <!--LOGO-->
   
   <!--NAV-->
   <div class="grid_8" id="nav">
    <?php echo $access_uri;?>
   </div>
   <!--NAV-->
   <div class="clear"></div>
  </div>
  <!--HEADER--> 
 </div>
 <!--CONTAINER-->
 
 <!--SLIDES-->
 <!--<div id="slides">
  <img src="<?php echo base_url(); ?>assets/images/slide1.jpg" />
 </div>-->
    
    
   

<?php echo $content;?>