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
<div class="alert">
                                  <h4>Successful action</h4>
                                    
                                </div>
</div>

</div><div class="clear"></div>

<?php $this->load->view('partial/footer') ; ?>