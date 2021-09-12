
<?php
require_once "php_scripts/session.php";

if(isset($_SESSION['username'])){

    require_once "repeated_sections/configuration.php";

  }
else {
    header("Location:signin.php");
}
  
require_once("repeated_sections/connection.php");

$username = $_SESSION['username'];

$sql="SELECT ua.user_id,u.name FROM users u, user_auth ua,user_roles ur where ua.username='$username' and u.user_id=ua.user_id and u.user_id=ur.user_id and ur.role_id in (1,2)";
$result = mysqli_query($conn, $sql);

while($row = mysqli_fetch_assoc($result)) {
$user_id =  $row['user_id'];
$name =  $row['name'];
  } // end of while
  
 
date_default_timezone_set("Asia/Karachi");

if(isset($_POST['visit_id'])){
$visit_id = $_POST['visit_id'];
}
else { 
die("Error! No visit data submitted");
}

$sql="SELECT patient_id from visit where visit_id=$visit_id";
$result = mysqli_query($conn, $sql);

while($row = mysqli_fetch_assoc($result)) {
$patient_id =  $row['patient_id'];
  } // end of while


$current_time = date('h:i:s');
$sql = "update visit set c_start_time = '$current_time' where visit_id = $visit_id";
if (mysqli_query($conn, $sql)) {
    // do nothing
}
else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
} // end of else


$sql= "select count(patient_id) cnt from visit where patient_id= $patient_id;";
$result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($result) > 0) {
	while($row = mysqli_fetch_assoc($result)) {
	 $cnt = $row['cnt'];
	} // end of while
 } // end of if

?>

<!DOCTYPE html>
<html lang="en">
<head>

  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <!-- Meta, title, CSS, favicons, etc. -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Bilal Hijama Clinic</title>

  <!-- Header Libraries -->
  <?php require_once "repeated_sections/headlibs.php"; ?>
  <!-- /Header Libraries -->
<style>
#print_link a:link, 
#print_link a:visited {
  background-color:#CCC;
  color: #000;
  padding: 4px 11px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  white-space: nowrap;
}


#print_link a:hover, 
#print_link a:active {
  background-color:#999;
  color: white;
}

#points{
 text-transform:uppercase;
}

</style>
</head>

<body class="nav-md">
  <div class="container body">
    <div class="main_container">

      <!-- Mail Left Navigation Panel -->
      <?php require_once "repeated_sections/mainleftnav.php"; ?>
      <!-- /Mail Left Navigation Panel -->

      <!-- Top Bar -->
      <?php require_once "repeated_sections/topnavbar.php"; ?>
      <!-- /Top Bar -->

      <!-- page content -->
      <div class="right_col" role="main">
        <div class="">
          <div class="page-title col-xs-12">
            <div class="title_left">
              <h3>New Consultation Form</h3>
            </div>

            <div class="title_right">
              <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">

              </div>
            </div>
          </div>

          <div class="col-xs-12">

            <!-- Add Branch Form -->
            <div class="x_panel">
              <div class="x_title">
                <h2>Details</h2>
                <ul class="nav navbar-right panel_toolbox">
                  <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                  </li>
                      <!-- <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="#">Settings 1</a>
                          </li>
                          <li><a href="#">Settings 2</a>
                          </li>
                        </ul>
                      </li> -->
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>

              <div class="x_content">
                <div class="box-body">
                  <div class="col-md-6">
                  
                                        <div class="form-group">
											<label>Visit ID</label><span style="color:red">*</span>
											<input type="text" id="visit_id" class="form-control" value="<?php echo $visit_id; ?>" disabled>
										</div>                    					
                                        <div class="form-group">
											<label>Patient ID</label><span style="color:red">*</span>
											<input type="text" id="patient_id" class="form-control" value="<?php echo $patient_id; ?>" disabled>
										</div>
                                        <div class="form-group">
                                        	<label>Consultant</label><span style="color:red">*</span>
											<select id="consultant" class="form-control" disabled>
                                            <option value="<?php echo $user_id; ?>" selected><?php echo $name; ?></option>
				                   			<?php 
						  					$sql= "select u.user_id, u.name from users u,user_roles r where r.role_id=2 and u.user_id=r.user_id;";
                                            $result = mysqli_query($conn, $sql);
                                            if (mysqli_num_rows($result) > 0) {
						                    while($row = mysqli_fetch_assoc($result)) { 
						                    echo'<option value="'.$row['user_id'].'"> '.$row['name'].' </option>';
                                                } // end of while
                                               
                                            } else {
                                            // do nothing
                                            }
						                    ?>
						                      </select>
										</div>
		
                                       
                                        
                                    <div class="form-group">
                                    <label>Consultation Time</label><span style="color:red">*</span>
									<input type="time" id="consultation_start_time" class="form-control" value="<?php echo date('h:i:s'); ?>" disabled>
										</div>

                                         <?php 						  				
											if($cnt >= 1) {	
											?> 
                                            
                                    	<div class="form-group">
                                        <label>Disease Improvement Feedback of Last Treatment</label> <br>
                                   <?php 
						  					$sql= "select d.disease_id, d.disease_name, v.visit_id from diseases d, visit_diseases v where v.visit_id = (select max(visit_id) vid from visit where patient_id=$patient_id and visit_id < $visit_id) and v.disease_id=d.disease_id";
                                            $result = mysqli_query($conn, $sql);
											$i=0;
                                            if (mysqli_num_rows($result) > 0) {
						                    while($row = mysqli_fetch_assoc($result)) { 
											$last_visit_id = $row['visit_id'];
											echo '<input type="hidden" id="last_visit" value="'.$last_visit_id.'" >';
						                    echo'<span>'.$row['disease_name'].' </span> 
											<select id="disease_feedback'.$row['disease_id'].'" class="disease_feedback'.$i.'">
											<option value="0">Select 1 to 10</option>
											<option value="1">1</option>
											<option value="2">2</option>
											<option value="3">3</option>
											<option value="4">4</option>
											<option value="5">5</option>
											<option value="6">6</option>
											<option value="7">7</option>
											<option value="8">8</option>
											<option value="9">9</option>
											<option value="10">10</option>
											</select><br><br>';
											$i++;
                                                } // end of while
										   //echo '<input type="hidden" id="diseases_count" value="'.$i.'" >';
                                            } else {
                                            // do nothing
                                            }
						                    ?>
											<input type="hidden" id="diseases_count" value="<?php echo $i; ?>" >
										</div>
                                        
                                          <?php 						  				
											} // end of if	
											?> 
                                            
                                    <div class="form-group">
									<a href="last_visit.php?patient_id=<?php echo $patient_id;  ?>&current_visit_id=<?php echo $visit_id;  ?>" target="_blank"><strong>View Previous Visits Detail</strong></a><br><br>
										</div>
                                        
                                    <div class="form-group">
                                    <label>Consultant Remarks</label>
									<textarea id="consultant_remarks" class="form-control"> </textarea>
										</div>
                                        
                                        
                                      <div class="form-group">
                                      <label>Disease(s) / Reason</label><span style="color:red">*</span>
				                   	  <select name="diseases[]" multiple id="diseases" class="form-control">
											<?php 
						  					$sql= "select * from diseases;";
                                            $result = mysqli_query($conn, $sql);
                                            if (mysqli_num_rows($result) > 0) {
						                    while($row = mysqli_fetch_assoc($result)) { 
						                    echo '<option value="'.$row['disease_id'].'">'.$row['disease_name'].'</option>';
                                                } // end of while
                                               echo '</select> <input type="button" id="add_new_disease" value="Add New Disease" style="display:none">
											   <input type="text" id="new_disease_name" class="form-control" placeholder="Write Disease Name Here" style="display:none;" > <input type="button" id="save_new_disease" value="Save Disease" style="display:none;">';
                                            } else {
                                            // do nothing
                                            }
						                    ?>

									  </div> 
                                         
                                     <div class="form-group"> 
                                      <label>Drugs In Use</label>
				                   			<select name="drugs[]" multiple id="drugs" class="form-control">
											<?php 
						  					$sql= "select * from drugs;";
                                            $result = mysqli_query($conn, $sql);
                                            if (mysqli_num_rows($result) > 0) {
						                    while($row = mysqli_fetch_assoc($result)) { 
						                    echo '<option value="'.$row['drug_id'].'">'.$row['drug_name'].'</option>';
                                                } // end of while
                                               echo '</select>';
                                            } else {
                                            // do nothing
                                            }
						                    ?>

										</div> 
                                        
                                        <div class="form-group"> 
                                        	<label>Recommended Treatment Points</label><span style="color:red">*</span>
				                   			<input type="text" id="points" class="form-control">
                                            <input type="button" id="save_points" value="Verify and Save Points">
										</div> 
                                        
                                        <div id="points_list_div" class="form-group"> 
										</div> 
                                     
                                      <div class="form-group">
                                    <label>Discount</label> 
									<select id="discount" class="form-control">
                                         <option value="0" selected>Select Discount (If Applicable)</option>
                                         <option value="10">10</option>
                                         <option value="20">20</option>
                                         <option value="30">30</option>
                                         <option value="40">40</option>
                                         <option value="50">50</option>
                                         <option value="60">60</option>
                                         <option value="70">70</option>
                                         <option value="80">80</option>
									 </select>
										</div>
                                        <div class="form-group">
                                            <label>Consultation Charges</label><br>
                                         <?php 			
										 echo' <label for="yes">Yes</label> <input type="radio" name="consultation_charges" id="yes" value="1" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										   
                                            <label for="no">No</label> <input type="radio" name="consultation_charges" id="no" value="0" checked="checked"/>';
										 
								/*			
											if($cnt <=  1) {	
				 
                                           echo' <label for="yes">Yes</label> <input type="radio" name="consultation_charges" id="yes" value="1" checked="checked"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										   
                                            <label for="no">No</label> <input type="radio" name="consultation_charges" id="no" value="0" />'; 
                                           } else{ 
												echo' <label for="yes">Yes</label> <input type="radio" name="consultation_charges" id="yes" value="1" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <label for="no">No</label> <input type="radio" name="consultation_charges" id="no" value="0" checked="checked"/> ';
												 } // end of else 
												 */
												 ?>
                                        </div>   
                      <br> 
                      <br> 

                     			<div class="form-group"> 	 
						           <input type="button" name="submit" id="submit" value="Submit Consultation Details" > 
						         </div> 
                                 
                                  <div id="print_link" class="form-group" style="display:none"></div> 

				<div id="output"></div> 

                  </div><!-- /.col-md-6 --> 
                </div><!-- /.box-body --> 

              <!-- end form for validations -->
                  </div> 
                </div> 
              </div>  




                </div>
              </div>
            </div>
            <!-- /page content -->

            <!-- footer Content -->
            <?php require_once "repeated_sections/footerbar.php";?>
            <!-- /footer Content -->

        </div>
        </div>
        <!-- footer Libraries -->
        <?php require_once "repeated_sections/footlibs.php"; ?>
        <!-- footer Libraries -->



<script>
$(document).ready(function() {
					
// This code will show warning if browser window is accidently closed or back button is pressed.
window.onbeforeunload = function() {
   return "Do you really want to close this window?";
   //if we return nothing here (just calling return;) then there will be no pop-up question at all
   //return;
};					
					
					
$('#diseases').multiselect({
    columns: 1,
    placeholder: 'Select Diseases',
    search: true
});

$('#drugs').multiselect({
    columns: 1,
    placeholder: 'Select Drugs',
    search: true
});

/*$('#points').multiselect({
    columns: 1,
    placeholder: 'Select Points',
    search: true
});*/

/*

$( document ).on( "click", "#add_new_disease", function() {	
$("#new_disease_name").show("slow");
$("#save_new_disease").show("slow");
});

$( document ).on( "click", "#save_new_disease", function() {
var new_disease_name = $("#new_disease_name").val();
//$("#diseases").append(new Option("option text", "101"));
//$("#diseases").append('<option value="101">sardard</option>');
alert(new_disease_name+' saved successfully');
});*/



$( document ).on( "click", "#save_points", function() {													
var points_arr = $("#points").val();

$.post("ajax.php",{opt: "save_verify_points",points_arr:points_arr},

function(data){
//alert(data);
$("#points_list_div").html(data);
return false;
}); //end of post 

}); // end of save_points click

$( document ).on( "click", "#submit", function() {
				
var diseases = $("#diseases").val();

var drugs = $("#drugs").val();



//alert(diseases);

var diseases_arr = [];
var diseases_arr = JSON.parse("[" + diseases + "]");

var drugs_arr = [];
var drugs_arr = JSON.parse("[" + drugs + "]");

var points_arr = [];
//var points_arr = JSON.parse("[" + points + "]");


/*
for (i = 0; i < diseases_arr.length; i++) {	
alert(diseases_arr[i]);
} // end of for loop
*/

				
    var visit_id = $("#visit_id").val();
    var patient_id = $("#patient_id").val();
	var consultant = $("#consultant").val();
	var consultation_start_time = $("#consultation_start_time").val();
	var consultant_remarks = $("#consultant_remarks").val();
	var discount = $("#discount").val();
	var consultation_charges = $("input[name=consultation_charges]:checked").val();
	var last_visit = $("#last_visit").val();
	var diseases_count = $("#diseases_count").val();
	var no_of_points = $("#no_of_points").val();
	
	var diseases_feedback_arr = [];
	for (i = 0; i < diseases_count; i++) {	
	var disease_id = $(".disease_feedback"+i).attr("id").replace("disease_feedback","");
	diseases_feedback_arr.push(disease_id+','+$("#disease_feedback"+disease_id).val());
	} // end of for loop			
	
/*	for (i = 0; i < diseases_feedback_arr.length; i++) {
		alert(diseases_feedback_arr[i]);
	}*/
	
	for (i = 0; i < no_of_points; i++) {	
	//var point_id = $("#point"+i).val();
	points_arr.push($("#point"+i).val());
	} // end of for loop
	
	
/*	for (i = 0; i < points_arr.length; i++) {
		alert(points_arr[i]);
	}*/
	
	
$.post("ajax.php",{opt: "add_new_consultation",visit_id:visit_id,patient_id:patient_id,consultant:consultant,consultation_start_time:consultation_start_time,consultant_remarks:consultant_remarks,discount:discount,consultation_charges:consultation_charges,last_visit:last_visit,diseases:diseases_arr,drugs:drugs_arr,points:points_arr,diseases_feedback:diseases_feedback_arr},

function(data){

alert(data);
$("#output").html(data);
window.location.replace("consultation_queue.php");
return false;
}); //end of post


}); //end of submit


//$(".data_saved").show("slow");





}); // end of document.ready

 </script>

  </body>
  </html>
