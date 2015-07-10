<?php
$this->load->view('partial/header_page.php');

?>
<?php echo $error;?>
<?php

    if(!count($query < 1)){
        
        echo '<p>There are no registered students for this session</p>';
    }
    
    else{
        echo '<div id = "invoiceTb">
        <table border = "1">
                    <tr>
                        <th>Passport</th>
                        <th>Birth Certificate</th>
                        <th>Transcript/Result</th>
                        <th></th>
                    </tr>';
        
       
        
        foreach($query as $row){
            echo '<tr>
                      <td>'.$row['passport'].'</td>
                      <td>'.$row['birth'].'</td>
                      <td>'.$row['result'].'</td>
                      <td>Download All</td>
                    </tr>';
            
        }
        echo '</table>';
        
        echo '<div class="paginator" id="paginator">'.$pagination.'</div>';
        echo '</div>';
    }


?>