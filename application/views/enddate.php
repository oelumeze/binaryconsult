<?php
$this->load->view('partial/header_page.php');
?>



<font color=red><?php echo $error ; ?></font>
    <?php echo form_open('signup/enddate') ; ?>
    <div>
        <ul>
            <li><b>End Date*</b><br/><script>DateInput('pickdate', true, 'DD-MON-YYYY')</script></li>
            </ul>
            <?php echo form_submit('submit', 'Submit');?>
            
        
    </div>
    <?php echo form_close();?>