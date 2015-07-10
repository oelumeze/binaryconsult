<?php
$this->load->view('partial/header_page.php');

?>
<?php echo $error;?>
<?php

    if(!count($query < 1)){
        
        echo '<p>There are no admitted students for this session</p>';
    }
    
    else{
        echo '<table border = "1">
                    <tr>
                        <th>Name</th>
                        <th>School</th>
                        <th>Email Address</th>
                    </tr>';
        
       
        
        foreach($query as $row){
            echo '<tr>
                      <td>'.ucfirst($row['first_name']). " ".ucfirst($row['last_name']).'</td>
                      <td>'.ucfirst($row['school_name']).'</td>
                      <td>'.$row['email'].'</td>
                  </tr> ';
            
        }
        echo '</table>';
        
        echo '<div class="paginator" id="paginator">'.$pagination.'</div>';
    }


?>