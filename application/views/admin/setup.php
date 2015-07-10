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
    <form id="form1" name="form1" method="post" action="">
        <div>
            <ul>
                    <h3>Add Vehicle Categories</h3>
                    <li><label>Vehicle Category* : </label><?php echo form_input('vehicle_cat', set_value('vehicle_cat')) ; ?></li>
            </ul>
            <ul>
                    <li><?php echo form_submit('add_vehicle_cat', 'Add Vehicle Category', 'class="blueBtn"') ; ?></li>
            </ul>
            </div>
            <div>
            <ul>
                    <h3>Add City</h3>
                    <li><label>City name* : </label><?php echo form_input('city_name', set_value('city_name')) ; ?></li>
            </ul>
            <ul>
                    <li><?php echo form_submit('add_city_name', 'Add City', 'class="blueBtn"') ; ?></li>
            </ul>
            </div>        
            <div>
            <ul>
                    <h3>Add Location</h3>
                    <li><label>Choose City* : </label><?php echo $this->general->build_dropdown_list('city', 'id', 'city_name', 'city_id') ; ?></li>
                    <li><label>Location* : </label><?php echo form_input('location', set_value('location')) ; ?></li>
            </ul>
            <ul>
                    <li><?php echo form_submit('add_location', 'Add Location', 'class="blueBtn"') ; ?></li>
            </ul>
            </div>
            
            <div>
            <ul>
                    <h3>Update Tarrif</h3>
                    
                    <?php
		    
			echo "<li><label>From: </label>".$this->general->build_dropdown_list('location', 'id', 'location_name', 'city_from')."</li>
				<li><label>To: </label>".$this->general->build_dropdown_list('location', 'id', 'location_name', 'city_to')."</li>
				<li><label>Vehicle Category: </label>".$this->general->build_dropdown_list('vehicle_category', 'id', 'vehicle_category_name', 'vehicle_cat_id')."</li>
				<li><label>Cost $</label>".form_input('travel_cost', set_value('travel_cost'))."</li>";
                    ?>
		    
		    <hr />
		    
		    <?php
		    
			$cities = $this->general->get_all('city', 'id, city_name', array());
			
			foreach($cities->result() as $row)
			{
			    $city_id = $row->id;
			    $city_name = $row->city_name;
			    
			    echo "<font size=\"4\">".$city_name."</font>";
			    
			    $all_tariff = $this->general->get_all('tarrif_table', '*', array('city_id' => $city_id));
			    
			    echo "<div class=\"invoiceTb\">
                                <table border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
				<thead>
				    <tr>
					<th>Location</th>
					<th>Vehicle Type</th>
					<th>Cost($)</th>
					<th>Action</th>
				    </tr>
                                </thead>
                                <tbody>";
			    
			    foreach($all_tariff->result() as $row)
			    {
				$location1 = $this->general->get('location', 'location_name', array('id' => $row->location_id1));
				$location2 = $this->general->get('location', 'location_name', array('id' => $row->location_id2));
				$vechicle_type = $this->general->get('vehicle_category', 'vehicle_category_name', array('id' => $row->vechicle_cat_id));
				$cost = $row->cost;
				
				echo "<tr>
					<td>$location1 - $location2</td>
					<td>$vechicle_type</td>
					<td>$cost</td>
					<td>Edit | Delete</td>
				    </tr>";
			    }
			    
			    echo "</tbody>
				    </table></div>";
			    
			    //echo "<hr />";
			}
			
		    ?>
            </ul>
            <ul>
                    <li><?php echo form_submit('update_tariff', 'Update Tariff', 'class="blueBtn"') ; ?></li>
            </ul>
            </div>            
            
        </div>
    </form>
</div>

</div><div class="clear"></div>
			
<?php $this->load->view('partial/footer') ; ?>