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
        <div>
            <ul>
                    <h3>Journey Details Confirmation</h3>
                    <li><label>Arrival City: </label><span class="radio " ><?php echo ucwords(strtolower($this->general->get('city', 'city_name', array('id' => $city)))) ; ?></span></li>
                    <li><label>Pickup Location: </label><span class="radio " ><?php echo ucwords(strtolower($this->general->get('location', 'location_name', array('id' => $pickupaddress)))) ; ?></span></li>
                    <li><label>Destination: </label><span class="radio " ><?php echo ucwords(strtolower($this->general->get('location', 'location_name', array('id' => $destination)))) ; ?></span></li>
                    
                    <li><label>Vehicle Type: </label><span class="radio " ><?php echo ucwords(strtolower($this->general->get('vehicle_category', 'vehicle_category_name', array('id' => $vehicle_cat)))) ; ?></span></li>

                    <li><label>Pickup date: </label><span class="radio " ><?php echo $pickupdate ; ?></span></li>
                    <li><label>Pickup Time: </label><span class="radio " ><?php echo $pickuptime ; ?></span></li>
                    
                    <li><label>Return Booking: </label><span class="radio " ><?php echo ucwords(strtolower($return)) ; ?></span></li>
                    <?php
                        if($return){
                    ?>
                    <li><label>Return Pickup Location: </label><span class="radio " ><?php echo ucwords(strtolower($this->general->get('location', 'location_name', array('id' => $city_location_from_return)))) ; ?></span></li>
                    <li><label>Return Destination: </label><span class="radio " ><?php echo ucwords(strtolower($this->general->get('location', 'location_name', array('id' => $city_location_to_return)))) ; ?></span></li>
                    <li><label>Return Pickup Date: </label><span class="radio " ><?php echo $pickupdate_return ; ?></span></li>
                            
                    <li><label>Return Pickup Time: </label><span class="radio " ><?php echo $pickuptime_return ; ?></span></li>
                    <?php } ; ?>
                    
                    <li><label>Other Mobile Contact(optional) : </label><span class="radio " ><?php echo $omobile ; ?></span></li>
                    
                    <?php
                    
                        $cost = $this->general->get('tarrif_table', 'cost', array('location_id1' => $pickupaddress, 'location_id2' => $destination, 'vechicle_cat_id' => $vehicle_cat));
                        $mutiplyrate  = ($return != "" ? 2 : 1);
                        
                        if($cost != "")
                            $cost_total = $cost * $mutiplyrate;
                        else
                            $cost_total = $this->general->get('tarrif_table', 'cost', array('location_id1' => $pickupaddress, 'location_id2' => $destination, 'vechicle_cat_id' => $vehicle_cat)) * $mutiplyrate;
                    ?>
                    
                    <li><label>Cost : </label><span class="radio " ><span id="cost">$<?php echo $cost_total ; ?></span></span></li>

            </ul>
            <ul>
                    <?php echo form_open('home/process') ; ?>
                        <li><?php echo form_submit('pay', 'Pay', 'class="blueBtn"') ; ?><?php echo form_hidden('bdetails', $encrypted_string) ; ?></li>
                    <?php echo form_close() ; ?>
            </ul>            
        </div>
    </form>
</div>

</div><div class="clear"></div>

<?php $this->load->view('partial/footer') ; ?>