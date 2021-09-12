
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

?>

<!DOCTYPE html>
<html lang="en">
<head>

  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <!-- Meta, title, CSS, favicons, etc. -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Cupping Therapy Clinic</title>

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


                                    <div class="form-group">
                                    <label>Consultant Remarks</label><span style="color:red"></span>
									<textarea id="consultant_remarks" class="form-control"> </textarea>
										</div>
                                        
                                        
                                      <div class="form-group">
                                      <label>Diseases</label><span style="color:red">*</span>
				                   	  <select name="diseases[]" multiple id="diseases" class="form-control">
											<?php 
						  					$sql= "select * from diseases;";
                                            $result = mysqli_query($conn, $sql);
                                            if (mysqli_num_rows($result) > 0) {
						                    while($row = mysqli_fetch_assoc($result)) { 
						                    echo '<option value="'.$row['disease_id'].'">'.$row['disease_name'].'</option>';
                                                } // end of while
                                               echo '</select>';
                                            } else {
                                            // do nothing
                                            }
						                    ?>

									  </div> 
                                         
                                     <div class="form-group"> 
                                      <label>Drugs In Use</label><span style="color:red">*</span> 
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
				                   			<select name="points[]" multiple id="points" class="form-control"> 
											<?php 
						  					$sql= "select * from points;";
                                            $result = mysqli_query($conn, $sql);
                                            if (mysqli_num_rows($result) > 0) {
						                    while($row = mysqli_fetch_assoc($result)) { 
						                    echo '<option value="'.$row['point_id'].'">'.$row['point_no'].'</option>';
                                                } // end of while
                                               echo '</select>';
                                            } else {
                                            // do nothing
                                            }
						                    ?>

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
						  					$sql= "select count(patient_id) cnt from visit where patient_id= $patient_id;";
                                            $result = mysqli_query($conn, $sql);
                                            if (mysqli_num_rows($result) > 0) {
						                    while($row = mysqli_fetch_assoc($result)) {
											$cnt = $row['cnt'];
											} // end of while
											} // end of if
											if($cnt <=  1) {	
											?> 
                                            <label for="yes">Yes</label> <input type="radio" name="consultation_charges" id="yes" value="1" checked="checked"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <label for="no">No</label> <input type="radio" name="consultation_charges" id="no" value="0" /> 
                                            <?php } else{ ?>
												<label for="yes">Yes</label> <input type="radio" name="consultation_charges" id="yes" value="1" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <label for="no">No</label> <input type="radio" name="consultation_charges" id="no" value="0" checked="checked"/> 
												<?php } ?>
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

$('#points').multiselect({
    columns: 1,
    placeholder: 'Select Points',
    search: true
});



$( document ).on( "click", "#submit", function() {
				
var diseases = $("#diseases").val();

var drugs = $("#drugs").val();

var points = $("#points").val();

//alert(diseases);

var diseases_arr = [];
var diseases_arr = JSON.parse("[" + diseases + "]");

var drugs_arr = [];
var drugs_arr = JSON.parse("[" + drugs + "]");

var points_arr = [];
var points_arr = JSON.parse("[" + points + "]");


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
			
	
$.post("ajax.php",{opt: "add_new_consultation",visit_id:visit_id,patient_id:patient_id,consultant:consultant,consultation_start_time:consultation_start_time,consultant_remarks:consultant_remarks,discount:discount,consultation_charges:consultation_charges,diseases:diseases_arr,drugs:drugs_arr,points:points_arr},

function(data){

alert(data);
$("#output").html(data);
window.location.replace("consultation_queue.php");

}); //end of post



}); //end of submit


//$(".data_saved").show("slow");



}); // end of document.ready

 </script>

  </body>
  </html>
