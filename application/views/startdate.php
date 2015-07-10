<?php
$this->load->view('partial/header_page.php');
?>



<font color=red><?php echo $error ; ?></font>
    <?php echo form_open('signup/startdate') ; ?>
    <div>
        <ul>
            <li><b>Start Date*</b><br/><script>DateInput('pickupdate', true, 'DD-MON-YYYY')</script></li>
            <?php echo $set_start_date; ?> 
            <li><b>End Date*</b><br/><script>DateInput('pickdate', true, 'DD-MON-YYYY')</script></li>
            <?php echo $set_end_date;?>
            </ul>
            <?php echo form_submit('submit', 'Submit');?>
            
        
    </div>
    <?php echo form_close();?>
            