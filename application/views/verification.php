<?php $this->load->view('partial/header') ; ?>

        <div id="pgMenu">
        			<div id="wrapper">
                    			<div class="pgTitle">
                                			<h2>Verification</h2>
                                </div>
                        </div>
                        
        </div>
        <div id="main" >
	    
      			 <div id="wrapper">
                 			<h3>Email Verification</h3>
		    <font color="red"><?php echo $error ; ?></font>
                   <div class="sform">
		    <form id="form1" name="form1" method="post" action="">
			<div class="alert">
			    Please Check the email address you provided at registration for your verification code.
			</div>
			<ul>  
			  <li><label>Verification code</label> <?php echo form_input('verification_code', set_value('verification_code')) ; ?></li>
			<input name="submit" type="submit"  class="blueBtn"  id="submit" value="Register" />
			</ul>
		    </form>
		   </div>
		   
		   <font color="red"><?php echo $rerror ; ?></font>
		    <div class="sform">
			<form id="form1" name="form1" method="post" action="">
			<div class="alert">
			    If you can not find the verification code in your email you can submit your email address again for resend
			</div>			    
			    <h3>Resend Verification</h3>
			    <ul>
				<li><label>Email Address</label> <?php echo form_input('email_verification_code', set_value('email_verification_code')) ; ?></li>
				<input type="submit" name="resend" value="Resend" class="blueBtn"/>				
			    </ul>
			</form>
		    </div>
		    
    </div>
</div><div class="clear"></div>

<?php $this->load->view('partial/footer') ; ?>