<?php $this->load->view('partial/header') ; ?>

        </div>
        <div id="tab"  class="clearfix">
        			<div id="wrapper" >
                            <ul>
				  <li><a href="<?php echo site_url() ; ?>">Home</a></li>
				  <li><a href="<?php echo site_url('login') ; ?>">Login</a></li>
				  <li class="active"><a href="<?php echo site_url('register') ; ?>">Register</a></li>
                            </ul>
                    </div>
        </div>
        <div id="pgMenu">
        			<div id="wrapper">
                    			<div class="pgTitle">
                                			<h2>Register</h2>
                                </div>
                        </div>
                        
        </div>
        <div id="main" >
        		
       			 <div id="wrapper">
                 			<h3>Personal Information</h3>
                   <div class="sform">
		    <form id="form1" name="form1" method="post" action="">
		  <ul>        
    
		    <li><label>My Name</label> <?php echo form_input('yname', set_value('yname')) ; ?></li>
		    <li><label>Mobile</label> <?php echo form_input('mobile', set_value('mobile')) ; ?></li>
		    
		    <h3>Login Information</h3>
		    <li><label>Email Address</label> <?php echo form_input('email_ad', set_value('email_ad')) ; ?></li>
		    <li><label>Password</label> <?php echo form_password('password', '') ; ?></li>
		    <li><label>Confirm Password</label> <?php echo form_password('cpassword', '') ; ?></li>
		    
		    <li><label>Verification Code </label><?php echo $cap_img ; ?></li>
		    <li><label>Type in verification Code </label><?php echo form_input(array('name' => 'captcha', 'value' => '', 'id' => 'vcode')).form_hidden('cap_word',$cap_word) ; ?></li>

		</ul>
		</div>
		   <input name="submit" type="submit"  class="blueBtn"  id="submit" value="Register" />
	  </form>
	 </ul>
    </div>
</div><div class="clear"></div>
			
<?php $this->load->view('partial/footer') ; ?>