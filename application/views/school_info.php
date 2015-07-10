<?php
$this->load->view('partial/header_page.php');
?>

<?php
$school_type = array(
    'private' => 'Private',
    'government owned' => 'Government Owned'
);
?>


<font color=red><?php echo $error ; ?></font>
    <?php echo form_open() ; ?>
    <div>
        <ul>
            <li>UserName*<?php echo form_input('username', set_value('username'));?></li>
            <li>Password*<?php echo form_input('password', set_value('password'));?></li>
        </ul>
            <?php echo form_submit('submit', 'Submit');?>
        
    </div>
    