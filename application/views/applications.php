<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $title;?></title>
<script type="text/javascript" src="<?php echo base_url();?>/assets/js/jquery.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>/assets/js/jquery.easing.1.3.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>/assets/js/action.js"></script>

<link href='http://fonts.googleapis.com/css?family=Nova+Square' rel='stylesheet' type='text/css'>
<link href="<?php echo base_url();?>/assets/css/style.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url();?>/assets/css/bootstrap.css" rel="stylesheet" type="text/css" />

<link href="<?php echo base_url();?>/assets/css/adminStyle.css" rel="stylesheet" type="text/css" />
</head>

<body style="max-width:90%;">
<div class="container adminContent">
<div class="row">
    <div class="row">
	<div class="span12">
  <ul class="nav nav-pills">
  
  
</ul>
    </div>
    </div>
    <p align= "center"><?php echo $query;?></p>
    <font color="red" size="-1"><?php echo $error; ?></font>
    <font color="red" size="-1"><?php echo $rerror;?></font>
    <font color="red" size="-1"><?php echo $rerror2;?></font>
    
    <?php echo form_open_multipart('submitCV/apply/'.$id); ?>
     <table>
        <tr>
            <th><label>SurName</label></th>
            <td><input type="text" name="name"/></td>
        </tr>
        <tr>
            <th><label>FirstName</label></th>
            <td><input type="text" name="fname"/></td>
        </tr>
	<tr>
            <th><label>OtherNames</label></th>
            <td><input type="text" name="oname"/></td>
        </tr>
      <tr>
	<th><label><p>Sex</p></label></th>
	<td>
            <select name="sex">
            <option value = "male">Male</option>
            <option value = "female">Female</option>
            </select>
        </td>
      </tr>
      <?php $year = range(1900,2011);
      $year_array = array($year);
      $day = range(1,31);
      $day_array = array($day);?>
      <tr>
       <th><label><p>Date Of Birth</p></label></th>
       <td>
            <select name = "month">
            <option value = "january">January</option>
            <option value = "february">February</option>
            <option value = "march">March</option>
            <option value = "april">April</option>
            <option value = "may">May</option>
            <option value = "june">June</option>
            <option value = "july">July</option>
            <option value = "august">August</option>
            <option value = "september">September</option>
            <option value = "october">October</option>
            <option value = "november">November</option>
            <option value = "december">December</option>
            </select>
            <?php echo '<select name = "day">';?>
            <?php foreach($day as $key){
		  echo '<option value = "'.$key.'">'.$key.'</option>';
	     }
	     echo '</select>';
	     ?>
	     <?php echo '<select name = "year">';?>
            <?php foreach($year as $key){
		  echo '<option value = "'.$key.'">'.$key.'</option>';
	     }
	     echo '</select>';
	     ?>
            
       </td>
      </tr>
      
      <tr>
        <th><label><p>Marital Status</p></th>
        <td><select name = "marital_status">
            <option value = "single">Single</option>
            <option value= "married">married</option>
            </select>
        </td>
      </tr>
      
      <tr>
       <th><label><p>Nationality</p></label></th>
       <td><input type="text" name = "nationality"/></td>
      </tr>
      
      <tr>
       <th><label><p>State</p></label></th>
       <td><input type="text" name = "state"/></td>
      </tr>
      
      <tr>
       <th><label><p>Local Government Area</p></label></th>
       <td><input type="text" name = "lga"/></td>
      </tr>
      
      <tr>
       <th><label><p>Email</p></label></th>
       <td><input type="text" name = "email"/></td>
      </tr>
      
      
      <tr>
       <th><label><p>Phone</p></label></th>
       <td><input type="text" name = "phone"/></td>
      </tr>
      
      
      <tr>
       <th><label><p>Contact Address</p></label></th>
       <td><textarea name = "contact_address"></textarea></td>
      </tr>
      
      <tr>
       <th><label><p>Qualification</p></label></th>
       <td>
        <table width="100%" cellpadding="5">
            <tr>
                <td>
                    <label>Institution</label>
                </td>
                <td>
                    <label>Course</label>
                </td>
                <td>
                    <label>Grade</label>
                </td>
                <td>
                    <label>Year</label>
                </td>
            </tr>
            <tr>
                <td>
                    <input type="text" name = "institution"/>
                </td>
                <td>
                    <input type="text" name="course"/>
                </td>
                <td>
                    <select name="classification">
                        <option value="first class">Firstclass</option>
                        <option value="second-class(upper)">Second Class(upper)</option>
                        <option value="second-class(lower)">Second Class(lower)</option>
                        <option value="third-class">Third Class</option>
                        <option value="distinction">Distinction</option>
                        <option value="merit">Merit</option>
                        <option value="pass">Pass</option>
                        <option value="HND upper-credit">HND Upper Credit</option>
                        <option value="HND lower-credit">HND lower Credit</option>
                        <option value="ND upper-credit">ND Upper Credit</option>
                        <option value="ND lower-credit">ND lower Credit</option>
                        <option value="awaiting-result">Awaiting Result</option>
                  </select>
                </td>
                <td>
                    <input type="text" name="qyear"/>
                </td>
            </tr>
        </table>
       </td>
      </tr>
      
      <tr>
        <th><label><p>Work Experience</p></label></th>
        <td>
            <table width="100%" cellpadding="5">
            <tr>
                <td>
                    <label>Company Name</label>
                </td>
                <td>
                    <label>Position Held</label>
                </td>
                <td>
                    <label>Job Description</label>
                </td>
                <td>
                    <label>Year</label>
                </td>
            </tr>
            <tr>
                <td><input type="text" name="company_name"/></td>
                <td><input type= "text" name="position"/></td>
                <td><textarea name="job"></textarea></td>
                <td><input type="text" name="eyear"/></td>
                
            </tr>
            </table>
        </td>
      </tr>
      
      <tr>
        <th><label><p>Professional Certification</p></label></th>
        <td>
            <table width="" cellpadding="5">
                <tr>
                    <td><label>Certification</label></td>
                    <td><label>Year</label>
                </tr>
                <tr>
                    <td><input type="text" name="certification"/></td>
                    <td><input type="text" name="cyear"/></td>
                </tr>
            </table>
                    </td>
      </tr>
                
               
      <tr>
        <th><label><p>Upload CV(Word OR pdf)</p></label></th>
        <td><input type="file" name="userfile"></td>
      </tr>
      
      <tr>
        <th><label><p>Upload Passport Photograph</p></label></th>
        <td><input type="file" name="userfile1"></td>
      </tr>  
      
      
      <tr>
       <th></th>
       <td><input type="submit" name="submit" value="Submit"/></td>
      </tr>
     </table>
     </form>
    </div>
</body>
</html>
