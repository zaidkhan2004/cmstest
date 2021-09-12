
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

$sql="SELECT ua.user_id,u.name FROM users u, user_auth ua,user_roles ur where ua.username='$username' and u.user_id=ua.user_id and u.user_id=ur.user_id and ur.role_id not in (6)";
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
$sql = "update visit set t_start_time = '$current_time' where visit_id = $visit_id";
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
td {
    padding: 15px;
}
th {
    padding: 15px;
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
              <h3>New Treatment Form </h3>
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
                                        <div class="form-group">Incision By<span style="color:red">*</span>
											<select id="incision_by" class="form-control">
                                            <option value="<?php echo $user_id; ?>" selected><?php echo $name; ?></option>
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
                                            <option value="<?php echo $user_id; ?>" selected><?php echo $name; ?></option>
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
                                            <option value="<?php echo $user_id; ?>" selected><?php echo $name; ?></option>
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
                   
                                        
                                <div class="form-group">Treatment Time<span style="color:red">*</span>
								<input type="time" id="treatment_start_time" class="form-control" value="<?php echo date('h:i:s'); ?>" disabled>
										</div>

                                      <div class="form-group">Diseases<span style="color:red">*</span>
											<?php 
						  					$sql= "select d.disease_id, d.disease_name from diseases d, visit_diseases vd where vd.visit_id=$visit_id and d.disease_id=vd.disease_id;";
                                            $result = mysqli_query($conn, $sql);
                                            if (mysqli_num_rows($result) > 0) {
						                    while($row = mysqli_fetch_assoc($result)) { 
						                    echo '<br><label for="disease'.$row['disease_id'].'"> '.$row['disease_name']. '</label>';
                                                } // end of while
                                               
                                            } else {
                                            // do nothing
                                            }
						                    ?>

										</div>
                                        
																				
										<div class="form-group" style="display:none"> 
                                        	<label>Additional Treatment Points</label>
				                   			<input type="text" id="points" class="form-control">
                                            <input type="button" id="save_points" value="Verify and Save Points">
										</div> 
                                        
                                        <div id="points_list_div" class="form-group"> 
										</div>   
										
										
                                       <div class="form-group">Set Cupping Timer
                                       <select class="form-control" id="set_cupping_timer"> 
                                       <option value="1">1 Minute</option> 
                                       <option value="2">2 Minutes</option> 
                                       <option value="3">3 Minutes</option> 
                                       <option value="4">4 Minutes</option> 
                                       <option value="5" selected>5 Minutes</option> 
                                       <option value="6">6 Minutes</option> 
                                       <option value="7">7 Minutes</option> 
                                       <option value="8">8 Minutes</option> 
                                       <option value="9">9 Minutes</option> 
                                       <option value="10">10 Minutes</option>
                                       <option value="11">11 Minutes</option>
                                       <option value="12">12 Minutes</option>
                                       <option value="13">13 Minutes</option>
                                       <option value="14">14 Minutes</option> 
                                       <option value="15">15 Minutes</option>
                                       </select>
                                       </div>
                                        
                                        <div class="form-group">
                                        <input type="button" id="cupping_btn" class="form-control" value="Start Cupping Timer">
                                        <h1 id="cupping_timer" style="color:#060"></h1>
                                       <label id="cupping_start_time"></label><br>  <label id="cupping_end_time"></label>
                                        </div>
                                        
                                       <div class="form-group" id="incision_timer_div" style="display:none">Set Incision Timer
                                       <select class="form-control" id="set_incision_timer"> 
                                       <option value="1">1 Minute</option> 
                                       <option value="2">2 Minutes</option> 
                                       <option value="3">3 Minutes</option> 
                                       <option value="4">4 Minutes</option> 
                                       <option value="5" selected>5 Minutes</option> 
                                       <option value="6">6 Minutes</option> 
                                       <option value="7">7 Minutes</option> 
                                       <option value="8">8 Minutes</option> 
                                       <option value="9">9 Minutes</option> 
                                       <option value="10">10 Minutes</option>
                                       <option value="11">11 Minutes</option>
                                       <option value="12">12 Minutes</option>
                                       <option value="13">13 Minutes</option>
                                       <option value="14">14 Minutes</option> 
                                       <option value="15">15 Minutes</option>
                                       </select>
                                       </div>
                                        
                                        <div class="form-group">
                                        <input type="button" id="incision_btn" class="form-control" value="Start Incision Timer" style="display:none">
                                        <h1 id="incision_timer" style="display:none; color:#060"></h1>
                                        <label id="incision_start_time"></label><br> <label id="incision_end_time"></label>
                                        </div>
                                        
                                        <div class="form-group">Points<span style="color:red">*</span>
				                   			<?php 
						  					$sql= "select p.point_id, p.point_no from points p, visit_points vp where vp.visit_id=$visit_id and p.point_id=vp.point_id;";
                                            $result = mysqli_query($conn, $sql);
                                            if (mysqli_num_rows($result) > 0) {
											
											echo '<table border="1" cellpadding="5"><tr><th>Points</th><th>Quantity</th></tr>';
											$count = 0;
						                    while($row = mysqli_fetch_assoc($result)) {
						                    echo '<tr id="points_tr"><td><span style="font-size:20px"> '.$row['point_no']. '</span></td>
											<td><label for="high'.$row['point_id'].'">High</label> <input type="radio" name="quantity'.$row['point_id'].'" id="high'.$row['point_id'].'" value="'.$row['point_id'].',H" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
											<label for="medium'.$row['point_id'].'">Medium</label> <input type="radio" name="quantity'.$row['point_id'].'" id="medium'.$row['point_id'].'" value="'.$row['point_id'].',M" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
											<label for="low'.$row['point_id'].'">Low</label> <input type="radio" name="quantity'.$row['point_id'].'" id="low'.$row['point_id'].'" value="'.$row['point_id'].',L" /></td></tr>
											';
											$count++;
                                                } // end of while
                                               echo '</table>';
                                            } else {
                                            // do nothing
                                            }
						                    ?>

										</div>
                                        
                                        <div class="form-group">
											<label>No of Cups Used</label><span style="color:red">*</span>
											<select id="cups_used" class="form-control">
                                            <option value="<?php echo $count; ?>" selected> <?php echo $count; ?> </option>
                                            <?php 
											for ($i=1; $i<=70; $i++) { 
											?>
                                            <option value="<?php echo $i; ?>"> <?php echo $i; ?> </option>
                                             <?php 
											} // end of for loop
											 ?>
                                            </select>
											<input type="hidden" id="no_of_points" value="<?php echo $count; ?>">
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
						           <input type="button" name="submit" id="submit" value="Submit Treatment Details" >
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

var audio = new Audio('audio/alarm.mp3');


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

var quantity = [];
 $.each($("input[type='radio']:checked"), function(){            
 quantity.push($(this).val());
});

var points_arr = [];


/*for (i = 0; i < quantity.length; i++) {	
alert(quantity[i]);
} // end of for loop*/


    var patient_id = $("#patient_id").val();
	var visit_id = $("#visit_id").val();
	var incision_by = $("#incision_by").val();
	var cupping_by = $("#cupping_by").val();
	var bandage_by = $("#bandage_by").val();
	var treatment_start_time = $("#treatment_start_time").val();
	var cups_used = $("#cups_used").val();
	var cups_wasted = $("#cups_wasted").val();
	var blades_used = $("#blades_used").val();
    var no_of_points = $("#no_of_points").val();
	
		if(cupping_by =='') { 
			alert("Please Select Cupping by");
			return false;
		}
			else if(bandage_by =='') { 
			alert("Please Select Bandage by");
			return false;
		}
			else if(cups_used =='') { 
			alert("Please Enter No of Cups Used");
			return false;
		}
			else if(cups_wasted =='') { 
			alert("Please Enter No of Cups Wasted");
			return false;
		}
			else if(blades_used =='') { 
			alert("Please Enter No of Blades Used");
			return false;
		}		
		
	for (i = 0; i < no_of_points; i++) {	
	//var point_id = $("#point"+i).val();
	points_arr.push($("#point"+i).val());
	} // end of for loop
		
	
$.post("ajax.php",{opt: "add_new_treatment",patient_id:patient_id,visit_id:visit_id,incision_by:incision_by,cupping_by:cupping_by,bandage_by:bandage_by,treatment_start_time:treatment_start_time,cups_used:cups_used,cups_wasted:cups_wasted,blades_used:blades_used,quantity:quantity,points:points_arr},

function(data){

alert(data);
$("#output").html(data);

//alert (window.location.href);
window.location.replace("experience_rating.php?visit_id="+visit_id);
//window.location.replace("treatment_queue.php");

}); //end of post




}); //end of submit


$( document ).on( "click", "#cupping_btn", function() {

$('#cupping_btn').hide("slow");
var set_cupping_timer = $("#set_cupping_timer").val();


var now = new Date(Date.now());
var formatted_time = now.getHours() + ":" + now.getMinutes() + ":" + now.getSeconds();

$('#cupping_start_time').html("Cupping Time Started at: " + formatted_time);

var start = new Date;

var refreshIntervalId  = setInterval(function() {
	var timer =	parseFloat((new Date - start) / 1000 + " Seconds");	
	timer = Math.round(timer/60);
	
	if (timer <= parseFloat(set_cupping_timer-1)) {
    $('#cupping_timer').html((set_cupping_timer - timer) + " Minute(s) Remaining");
	 } 
					 else{
						 var now2 = new Date(Date.now());
						 var formatted_time2 = now2.getHours() + ":" + now2.getMinutes() + ":" + now2.getSeconds();

						 $('#cupping_timer').html("Cupping Time Completed");
						 $('#cupping_timer').fadeIn(2000).fadeOut(2000).fadeIn(2000).fadeOut(2000).fadeIn(2000).fadeOut(2000).fadeIn(2000);
						 $('#cupping_end_time').html("Cupping Time Completed at: " + formatted_time2);
						 clearInterval(refreshIntervalId);
						 $('#incision_timer_div').show("slow");
						 $('#incision_btn').show("slow");
						 $('#incision_timer').show("slow");
						 audio.play();
						 
						 }
}, 1000);
					

}); // end of cupping_btn click




$( document ).on( "click", "#incision_btn", function() {

$('#incision_btn').hide("slow");
var set_incision_timer = $("#set_incision_timer").val();

var now = new Date(Date.now());
var formatted_time = now.getHours() + ":" + now.getMinutes() + ":" + now.getSeconds();

$('#incision_start_time').html("Incision Time Started at: " + formatted_time);

var start = new Date;

var refreshIntervalId2  = setInterval(function() {
	var timer2 =	parseFloat((new Date - start) / 1000 + " Seconds");	
	timer2 = Math.round(timer2/60);
	
	if (timer2 <= parseFloat(set_incision_timer-1)) {
    $('#incision_timer').html((set_incision_timer - timer2) + " Minute(s) Remaining");
	 } 
					 else{
						 var now2 = new Date(Date.now());
						 var formatted_time2 = now2.getHours() + ":" + now2.getMinutes() + ":" + now2.getSeconds();
						 
						 $('#incision_timer').html("Incision Time Completed");
						 $('#incision_timer').fadeIn(2000).fadeOut(2000).fadeIn(2000).fadeOut(2000).fadeIn(2000).fadeOut(2000).fadeIn(2000);
						 $('#incision_end_time').html("Incision Time Completed at: " + formatted_time2);
						 clearInterval(refreshIntervalId2);
						 audio.play();
						 }
}, 1000);
					

}); // end of incision_btn click



// This code will show warning if browser window is accidently closed or back button is pressed.
window.onbeforeunload = function() {
   return "Do you really want to close this window?";
   //if we return nothing here (just calling return;) then there will be no pop-up question at all
   //return;
};

}); // end of document.ready

 </script>

  </body>
  </html>
