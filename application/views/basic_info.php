<?php
$this->load->view('partial/header_page.php');
?>

<?php
$school_type = array(
    'private' => 'Private',
    'government owned' => 'Government Owned'
);

$sex = array(
             'male' => 'Male',
             'female' => 'Female'
             );

$option = array(
                'yes' => 'Yes',
                'no' => 'No'
                );

$rating = array(
                'excellent' => 'Excellent',
                'very good' => 'Very Good',
                'good' => 'Good',
                'poor' => 'Poor',
                'indifferent' => 'Indifferent'
                
            );
$program = array(
    
                'knowledge' => 'Knowledge',
                'leisure' => 'Leisure'        
);
?>

<?php


?>
<font color=red><?php echo $error ; ?></font>
<font color=red><?php echo $rerror ; ?></font>
<font color=red><?php echo $rerror2 ; ?></font>
<font color=red><?php echo $rerror3 ; ?></font>



    <?php echo form_open_multipart('signup') ; ?>
    <div>
        <?php echo form_fieldset('Basic Information');?>
        <ul>
            <?php #echo $end_date;?>
            <?php echo form_hidden('status');?>
            <li><b>FirstName*</b><br/><?php echo form_input('first_name', set_value('first_name'));?></li>
            <li><b>LastName*</b><br/><?php echo form_input('last_name', set_value('last_name'));?></li>
            <li><b>Date Of Birth*</b><br/><script>DateInput('pickupdate', true, 'DD-MON-YYYY')</script></li>
            <li><b>Nationality*</b><br/><?php echo form_input('nationality', set_value('nationality'));?></li>
            <li><b>Sex*</b><br/><?php echo form_dropdown('sex', $sex);?></li>
            <li><b>Email*</b><br/><?php echo form_input('email', set_value('email'));?></li>
            <li><b>Phone Number</b><br/><?php echo form_input('phone_number', set_value('phone_number'));?></li>
        </ul>
            <?php echo form_fieldset_close(); ?>
          <ul>  
            <?php echo form_fieldset('School Information');?>
            <li><b>School Name*</b><br/><?php echo form_input('school_name', set_value('school_name'));?></li>
            <li><b>School Type*</b><br/><?php echo form_dropdown('school_type', $school_type);?></li>
            <li><b>Present Class*</b><br/><?php echo form_input('present_class', set_value('present_class'));?></li>
            <?php echo form_fieldset_close();?>
            <li><b>Do You Have a Personal Computer/Someone else Laptop*</b><br/>
                Yes<?php echo form_radio('personal_computer', 'yes' );?>
                No<?php echo form_radio('personal_computer', 'no');?>
            </li>
             <li><b>Do You Have Computer Knowledge*</b><br/>
                Yes<?php echo form_radio('computer_knowledge', 'yes' );?>
                No<?php echo form_radio('computer_knowledge', 'no');?>
            </li>
             <li><b>Rate Yourself On Computer Knowledge*</b><br/>
                Yes<?php echo form_dropdown('computer_rating', $rating );?>
            </li>
              <li><b>Do You like Solving Problems?*</b><br/>
                Yes<?php echo form_radio('solving_problem', 'yes' );?>
                No<?php echo form_radio ('solving_problem', 'no');?>
            </li>
              <li>
                <b>State Solved Problem*</b><br/>
                <textarea name="solved_problem" onkeypress=" return check_length(this, document.getElementById('count_number_words'), document.getElementById('show_remaining_words'));"></textarea>
                <br>
                <font color="black">Word count:</font><font color="red">
                <span id="count_number_words">0</span>
                </font>
                <br>
                <font color="black">Words remaining: </font><font color="red">
                <span id="show_remaining_words">100</span>
                </font>
            </li>
            <li><b>Why Do You Want To Learn Programming*</b><br/><?php echo form_dropdown('learn_program', $program);?></li>
            <li><b>What is Your Best Subject At School?*</b><br/><?php echo form_input('best_subject', set_value('best_subject'));?></li>
            <li><b>Reason*</b><br/>
                <textarea name="reason" onkeypress=" return check_length(this, document.getElementById('count_words'), document.getElementById('show_words'));"></textarea>
                <br>
                <font color="black">Word count:</font><font color="red">
                <span id="count_words">0</span>
                </font>
                <br>
                <font color="black">Words remaining: </font><font color="red">
                <span id="show_words">100</span>
                </font> 
            </li>
            <li><b>Upload Passport Photograph</b><br/><?php echo form_upload('passport');?></li>
            <li><b>Upload Birth Certificate</b><br/><?php echo form_upload('birth');?></li>
            <li><b>Upload Most Recent School Result</b><br/><?php echo form_upload('result');?></li>
              
        </ul>
            <?php echo form_submit('submit', 'Submit');?>
            
            
        
    </div>
    
    <?php echo form_close();?>
    