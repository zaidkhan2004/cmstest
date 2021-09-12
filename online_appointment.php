
<?php
require_once "repeated_sections/configuration.php";
require_once("repeated_sections/connection.php");

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


      <!-- page content -->
      <div class="right_col" role="main">
        <div class="">
          <div class="page-title col-xs-12">
            <div class="title_left">
              <h3>New  Appointment Form</h3>
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
                                            <?php 
											if(isset($patient_id)){ 
											?>
                                            <input type="text" id="patient_id" class="form-control" value="<?php echo $patient_id; ?>" disabled>
                                            <?php 
											} else {
												?>
                                            <input type="text" id="patient_id" class="form-control" >
                                            <?php
												}
											?>
											
										</div>
                                        
<!--                                        <div class="form-group">Consultant<span style="color:red">*</span>
											<select id="consultant" class="form-control">
                                            <option value="0" selected>Select Consultant</option>
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
										</div>-->
		
                                        
                                         <div class="form-group">Date<span style="color:red">*</span>
											<input type="date" id="appointment_date" class="form-control">
										</div>
                                        
										<div class="form-group"><label>Time Slot</label><span style="color:red">*</span>
											<select id="time_slot" class="form-control">
				                   			<option value="0" disabled selected>Select Time Slot</option>
						                      </select>
										</div>


                      <br>
                      <br>

                     <div class="form-group">
						           <input type="button" name="submit" id="submit" value="Book Appointment" >
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
					

/*
$( document ).on( "change", "#appointment_date", function() {
alert("abc");														  
var d = $("#appointment_date").val();												   
d = new Date(d);										   
var n = d.getDay()

alert(n);

$("#time_slot").append('<option value="' + n + '">Day</option>');

}); //end of date change											   
*/

$( document ).on( "change", "#appointment_date", function() {													  
var appointment_date = $("#appointment_date").val();												   

$.post("ajax.php",{opt: "load_time_slots",appointment_date:appointment_date},

function(data){
$("#time_slot").html(data);

      }); //end of post


}); //end of date change											   


$( document ).on( "click", "#submit", function() {

    var patient_id = $("#patient_id").val();
	//var consultant = $("#consultant").val();
	var date = $("#appointment_date").val();
	var time_slot = $("#time_slot").val();
		
		if(patient_id=='') { 
			alert("Please Enter Patient No");
			return false;
		}
			
	
//$.post("ajax.php",{opt: "add_new_appointment",patient_id:patient_id,consultant:consultant,date:date,time_slot:time_slot},
 $.post("ajax.php",{opt: "add_new_appointment",patient_id:patient_id,date:date,time_slot:time_slot},

function(data){

//alert(data);
alert("Appointment Successfully Created");
window.location.replace("http://www.bilalhijamaclinic.com");
      }); //end of post

}); //end of submit


//$(".data_saved").show("slow");



}); // end of document.ready

 </script>

  </body>
  </html>
