<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<title><?php echo $title ; ?></title>
<link href="<?php echo base_url()."assets/css/agtcss.css" ; ?>" rel="stylesheet" type="text/css" />
<!-- Copy to the head section of your webpage -->
<script type="text/javascript" src="<?php echo base_url()."assets/index_js/jquery.js" ; ?>" ></script>
<script type="text/javascript" src="<?php echo base_url()."assets/index_js/mhgallery.js" ; ?>" ></script>
<script type="text/javascript" src="<?php echo base_url()."assets/index_js/initgallery.js" ; ?>" ></script>
<link rel="stylesheet" href="<?php echo base_url()."assets/index_js/mhgallery.css" ; ?>" type="text/css" />
<!-- End of head section codes -->

<!-- End of head section codes -->
</head>

<body>
<div id="header">
  <div id="agt_logo">
	  <a href="index.html">
	  	<img src="<?php echo base_url()."assets/images/agt_logo.png" ; ?>" alt="AGT Logo" width="148" height="62" border="0"  title="Africa Ground Transport"/>
	  </a>
  </div>
  <div id="login_logout"><a href="<?php echo site_url('login') ; ?>">Login</a> / <a href="<?php echo site_url('register') ; ?>">Sign Up</a> </div>
	<div id="nav">
    	<ul>
        	<li><a href="#">HOME</a></li>
            <li class="current"><a href="#">about</a></li>
            <li><a href="#">products</a></li>
            <li><a href="#">Services</a></li>
            <li><a href="#">clients</a></li>
            <li><a href="#">blog</a></li>
            <li><a href="#">Contact</a></li>
        </ul>
    </div></div>

<div id="slider">
  <div id="slider_parent">
    <!-- Copy to where you want to display the Slideshow -->
    <div id="mhgallery">
      <style type="text/css"> 
		#mhgallery img { display:none; } 
	  </style>
      <img src="<?php echo base_url()."assets/images/slide1.jpg" ; ?>" title="slide1" /> 
	  <img src="<?php echo base_url()."assets/images/slide2.jpg" ; ?>" title="slide2" /> 
	  <img src="<?php echo base_url()."assets/images/slide3.jpg" ; ?>" title="slide3" />
	  <img src="<?php echo base_url()."assets/images/slide4.jpg" ; ?>"title="slide4" /> 
	  <img src="<?php echo base_url()."assets/images/slide5.jpg" ; ?>" title="slide5" /> 
    </div>
    <!-- End of Slideshow codes -->
  </div>
</div>
<div id="content">
  
  <div id="head_hing1">
    <h2 align="center">Professional</h2>
    <p align="center"> Lorem ipsum dolor sit amet,&nbsp;lectus</p>
    <p align="center">sit amet sollicitudin nisl neque nec justo. </p>
    <p align="center">Donec vel lconsectetur adipiscing elit. </p>
    <p align="center">Etiam blandit, ipsum quis viverra feugiat,</p>
    <p align="center"> dolor&nbsp;orem diam, id condimentum nunc. </p>
    <p align="center"><a href="#"><img src="<?php echo base_url()."assets/images/learn_more.jpg" ; ?>" width="156" height="40" border="0" /></a></p>
  </div>
  
  <div id="head_hing2">
    <h2 align="center">Trusted</h2>
    <p align="center"> Lorem ipsum dolor sit amet,&nbsp;lectus</p>
    <p align="center">sit amet sollicitudin nisl neque nec justo. </p>
    <p align="center">Donec vel lconsectetur adipiscing elit. </p>
    <p align="center">Etiam blandit, ipsum quis viverra feugiat,</p>
    <p align="center"> dolor&nbsp;orem diam, id condimentum nunc. </p>
    <p align="center"><a href="#"><img src="<?php echo base_url()."assets/images/learn_more.jpg" ; ?>" width="156" height="40" border="0" /></a></p>
  </div>
  
  <div id="head_hing3">
    <h2 align="center">Reliable</h2>
    <p align="center"> Lorem ipsum dolor sit amet,&nbsp;lectus</p>
    <p align="center">sit amet sollicitudin nisl neque nec justo. </p>
    <p align="center">Donec vel lconsectetur adipiscing elit. </p>
    <p align="center">Etiam blandit, ipsum quis viverra feugiat,</p>
    <p align="center"> dolor&nbsp;orem diam, id condimentum nunc. </p>
    <p align="center"><a href="#"><img src="<?php echo base_url()."assets/images/learn_more.jpg" ; ?>" width="156" height="40" border="0" /></a></p>
    
  </div>
</div>
<div id="footer">Copyright &copy; AGT 2012 </div>
</body>
</html>