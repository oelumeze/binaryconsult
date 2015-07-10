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
    <?php echo form_open() ; ?>
        <div>
            <ul>
                    <h3>Journey Details</h3>
                    <li><label>Arrival City* : </label><?php echo $this->general->build_dropdown_list('city', 'id', 'city_name', 'city_id') ; ?><span id="loader" style="display:none;color:#D63A1B">Loading...</span></li>
                    <li><label>Pickup Location* : </label><div id="city_loader_from"><?php echo form_dropdown('city_location_from', array('' => '--Select--'), '') ; ?></div></li>
                    <li><label>Destination* : </label><div id="city_loader_to"><?php echo form_dropdown('city_location_to', array('' => '--Select--'), '') ; ?></div></li>
                    <li><label>Vehicle Type* : </label><?php echo $this->general->build_dropdown_list('vehicle_category', 'id', 'vehicle_category_name', 'vehicle_cat_id') ; ?></li>
                    
                    <h3>When</h3>
                    <li><label>Pickup date* : </label><script>DateInput('pickupdate', true, 'DD-MON-YYYY')</script></li>
                    <li><label>Pickup Time* : </label><?php echo form_input('pickuptime', set_value('pickuptime'), 'id="pickuptime" readonly="readonly" style="width:95px;"') ; ?></li>
                    <li></li>
                    <li><label>Return Booking?* : </label><span class="radio " ><?php echo form_checkbox('return', 'yes', set_checkbox('return', 'yes'), ' class="recurr"') ; ?>
                        <div class="pMore" style="padding-left:10px;"><br>
                            Pickup Location: <div id="city_loader_from_return" style="padding:1px; margin-left:-20px;"><?php echo form_dropdown('city_location_from_return', array('' => '--Select--'), '', 'style="width:310px"') ; ?></div>
                            Destination: <div id="city_loader_to_return" style="padding:1px; margin-left:-20px;"><?php echo form_dropdown('city_location_to_return', array('' => '--Select--'), '', 'style="width:310px;"') ; ?></div>
                            Pickup Date: <script>DateInput('pickupdate_return', true, 'DD-MON-YYYY')</script>
                            
                            Pickup Time:<?php echo form_input('pickuptime_return', set_value('pickuptime_return'), 'id="pickuptime_return" readonly="readonly" style="width:100px; margin-bottom:10px; margin-top:5px; margin-left:10px;"') ; ?>
                        </div>
                    </span></li>                    
                    <li><label>Cost* : </label><span class="radio " ><span id="cost">$0.00</span></span></li>
                    <li></li>
                    
                    <h3>Other Information</h3>
                    <li><label>Passenger Mobile Number</label><span class="radio " ><?php echo $mmobile ; ?></span></li>

                    <li><label>Other Mobile Contact(optional) : </label><?php echo form_input('omobile', set_value('omobile'), 'id="omobile"') ; ?></li>

            </ul>
            <ul>
                    <li><?php echo form_submit('book', 'Continue >>', 'class="blueBtn"') ; ?></li>
            </ul>            
        </div>
    </form>
</div>
                         </div>
</div><div class="clear"></div>

<?php $this->load->view('partial/footer') ; ?>