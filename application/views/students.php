<?php
$this->load->view('partial/header_page.php');

?>



<?php echo $error;?>

<?php
#echo form_open('sign');
?>

<?php

    if(!count($query < 1)){
        
        echo '<p>There are no registered students for this session</p>';
    }
    
    else{
        echo '<div id = "invoiceTb">
        <table border = "1">
                    <tr>
                        <th>Name</th>
                        <th>School</th>
                        <th>Email Address</th>
                        <th>Admission Status</th>
                    </tr>';
        
       
        
        foreach($query as $row){
            echo '<tr>
                      <td><a href = "'.site_url('signup/details/'.$row['student_id']).'">'.ucfirst($row['first_name']). " ".ucfirst($row['last_name']).'</a></td>
                      <td>'.ucfirst($row['school_name']).'</td>
                      <td>'.$row['email'].'</td>
                      <td><a href = "'.site_url('signup/admit/'.$row['student_id']).'">'.ucfirst($row['admission_status']).'</a></td>
                      <td><a href = "'.site_url('signup/download/'.$row['student_id']).'">Get Uploads</a></td>
                    </tr>';
            
        }
        echo '</table>';
        
        echo '<div class="paginator" id="paginator">'.$pagination.'</div>';
        echo '</div>';
    }


?>