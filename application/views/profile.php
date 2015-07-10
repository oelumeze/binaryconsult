<?php $this->load->view('partial/header') ; ?>

        </div>
        <div id="tab"  class="clearfix">
        		    <div id="wrapper" >
                            <ul>
				<?php echo $menu ; ?>
                            </ul>
                            <div class="userId">
                            				Hi <?php echo ucwords(strtolower($mem_name)) ; ?> | <a href="<?php echo site_url('home/logout') ; ?>">Sign Out</a>
                            </div>			    
                    </div>
        </div>
        <div id="pgMenu">
        			<div id="wrapper">
                    			<div class="pgTitle">
                                			<h2><?php echo $menu_title ; ?></h2>
                                </div>
                        </div>
                        
        </div>
        <div id="main" >
	     <div id="wrapper">
     <div class="sform">
    <font color=red><?php echo $error ; ?></font>
    <ul>
    <?php echo form_open() ; ?>
        <li><label>Your Name*</label> <?php echo form_input('yname', $yname) ; ?></li>
        <li><label>Email Address*</label><?php echo form_input('email_ad', $email_ad) ; ?></li>
        <li><label>Mobile*</label> <?php echo form_input('mobile', $mobile) ; ?></li>
        <li><label>Contact Address*</label> <?php echo form_textarea(array('name' => 'contact_ad', 'rows' => '5', 'cols' => '30', 'value' => $contact_ad)) ; ?></li>
        <li><input name="submit" type="submit"  class="blueBtn"  id="submit" value="Update Profile" /></li>
        <div class="clear"></div>
   <?php echo form_close();?>
    </ul>
     </div>
    </div>
</div>
        
<div class="clear"></div>

<?php $this->load->view('partial/footer') ; ?>