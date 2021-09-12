
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

date_default_timezone_set("Asia/Karachi");

if(isset($_GET['patient_id'])){
$patient_id = $_GET['patient_id'];
}
else { 
die("Error! No patient data submitted");
}


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
              <h3>Add Visit Data Form</h3>
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
											<label>Patient ID</label><span style="color:red">*</span>
											<input type="text" id="patient_id" class="form-control" value="<?php echo $patient_id; ?>" disabled>
										</div>
                                       		
                                        
                                         <div class="form-group">Visit Date<span style="color:red">*</span>
											<input type="date" id="visit_date" class="form-control">
										</div>
                                        
                                      <div class="form-group">Visit Time<span style="color:red">*</span>
											<input type="time" id="visit_start_time" class="form-control">
										</div>
                                        
                                        <div class="form-group">
                                        	<label>Consultant</label><span style="color:red">*</span>
											<select id="consultant" class="form-control">
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
                                        
                                        <div class="form-group">No of Points<span style="color:red">*</span>
											<select id="no_of_points" class="form-control">
                                            <option value="0" selected>Select No of Points</option>
											<?php 
											for ($i=1; $i<=100; $i++) { 
											?>
                                            <option value="<?php echo $i; ?>"> <?php echo $i; ?> </option>
                                             <?php 
											} // end of for loop
											 ?>
                                            </select>
										</div>
                                        
                                         <div class="form-group">
											<label>Points</label><span style="color:red">*</span>
                                            <table id="points_table" cellpadding="15">
                                            </table>
										</div>
                                        
                                        
                                        <div class="form-group">Incision By<span style="color:red">*</span>
											<select id="incision_by" class="form-control">
                                            <option value="0" selected>Select</option>
				                   			<?php 
						  					$sql= "select u.user_id, u.name from users u,user_roles r where r.role_id not in (1,6) and u.user_id=r.user_id;";
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

                                        <div class="form-group">Cupping By<span style="color:red">*</span>
											<select id="cupping_by" class="form-control">
                                            <option value="0" selected>Select</option>
				                   			<?php 
						  					$sql= "select u.user_id, u.name from users u,user_roles r where r.role_id not in (1,6) and u.user_id=r.user_id;";
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
 
                                         <div class="form-group">Bandage By<span style="color:red">*</span>
											<select id="bandage_by" class="form-control">
                                            <option value="0" selected>Select</option>
				                   			<?php 
						  					$sql= "select u.user_id, u.name from users u,user_roles r where r.role_id not in (1,6) and u.user_id=r.user_id;";
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
											<label>No of Cups Used</label><span style="color:red">*</span>
											<select id="cups_used" class="form-control">
                                            <option value="0"> Select No of Cups </option>
                                            <?php 
											for ($i=1; $i<=50; $i++) { 
											?>
                                            <option value="<?php echo $i; ?>"> <?php echo $i; ?> </option>
                                             <?php 
											} // end of for loop
											 ?>
                                            </select>
										</div>
                                        
                                        <div class="form-group">
											<label>No of Cups Wasted</label><span style="color:red">*</span>
											<select id="cups_wasted" class="form-control">
                                            <option value="0" selected> 0 </option>
                                            <option value="1"> 1 </option>
                                            <option value="2"> 2 </option>
                                            <option value="3"> 3 </option>
                                            <option value="4"> 4 </option>
                                            <option value="5"> 5 </option>
                                            <option value="6"> 6 </option>
                                            <option value="7"> 7 </option>
                                            <option value="8"> 8 </option>
                                            <option value="9"> 9 </option>
                                            <option value="10"> 10 </option>
                                            </select>
										</div>
                                        
                                        <div class="form-group">
											<label>No of Blades Used</label><span style="color:red">*</span>
											<select id="blades_used" class="form-control">
                                            <option value="1" selected> 1 </option>
                                            <option value="2"> 2 </option>
                                            <option value="3"> 3 </option>
                                            <option value="4"> 4 </option>
                                            <option value="5"> 5 </option>
                                            </select>
										</div>
                                        

                      <br>
                      <br>

                     <div class="form-group">
						           <input type="button" name="submit" id="submit" value="Submit Visit Details" >
						         </div>
                                 
                                  <div id="print_link" class="form-group" style="display:none"></div>

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

$( document ).on( "change", "#no_of_points", function() {	

$("#points_table").html('');
var no_of_points = $("#no_of_points").val();

$("#cups_used").val(no_of_points);


for (var i=1; i <= no_of_points; i++ ) {
	
$("#points_table").append('<tr><td valign="top">'+ i +'&nbsp; &nbsp;</td><td><select id="point_id'+ i + '" class="point_class"><option value="0" selected> Select Point </option></select><br><br></td> <td>&nbsp; &nbsp;<label for="high'+ i + '">High</label> <input type="radio" name="quantity'+ i + '" id="high'+ i + '" value="H" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label for="medium'+ i + '">Medium</label> <input type="radio" name="quantity'+ i + '" id="medium'+ i + '" value="M" /> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label for="low'+ i + '">Low</label> <input type="radio" name="quantity'+ i + '" id="low'+ i + '" value="L" /> <br><br></td></tr>');
	
} // end of for loop


$.post("ajax.php",{opt: "load_points"},

function(data){
	$(".point_class").html(data);
      }); //end of post

				
}); //end of no_of_points change				


/*$( document ).on( "click", ".point_class", function() {	
var id =$(this).attr("id").replace("point_id","");
//alert(id);

$.post("ajax.php",{opt: "load_points"},

function(data){
	if ($("#point_id"+id).val()==='0') {
	$(".point_class").html(data);
	} else { 
	// do nothing
	}
      }); //end of post
}); //end of point_class change
*/


$( document ).on( "click", "#submit", function() {

var patient_id = $("#patient_id").val();
var visit_date = $("#visit_date").val();
var visit_start_time = $("#visit_start_time").val();
var consultant = $("#consultant").val();
var consultant_remarks = $("#consultant_remarks").val();
var incision_by = $("#incision_by").val();
var cupping_by = $("#cupping_by").val();
var bandage_by = $("#bandage_by").val();
var cups_used = $("#cups_used").val();
var cups_wasted = $("#cups_wasted").val();
var blades_used = $("#blades_used").val();

var diseases = $("#diseases").val();
var drugs = $("#drugs").val();

var diseases_arr = [];
var diseases_arr = JSON.parse("[" + diseases + "]");

var drugs_arr = [];
var drugs_arr = JSON.parse("[" + drugs + "]");

var no_of_points = $("#no_of_points").val();

var points_arr = [];
	
for (var i=1; i <= no_of_points; i++ ) {
var point_id =	$("#point_id"+i).val();
var quantity = $("input[name=quantity"+i+"]:checked").val();
//var quantity = $("#quantity"+i).val();
points_arr.push(point_id + '-' + quantity);
} // end of for loop

	
$.post("ajax.php",{opt: "add_visit_data",patient_id:patient_id,visit_date:visit_date,visit_start_time:visit_start_time,consultant:consultant,consultant_remarks:consultant_remarks,diseases:diseases_arr,drugs:drugs_arr,incision_by:incision_by,cupping_by:cupping_by,bandage_by:bandage_by,cups_used:cups_used,cups_wasted:cups_wasted,blades_used:blades_used,points_arr:points_arr},

function(data){

alert(data);
window.location.replace("index.php");
//location.reload();
      }); //end of post

}); //end of submit


//$(".data_saved").show("slow");



}); // end of document.ready

 </script>

  </body>
  </html>
