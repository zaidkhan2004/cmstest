
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


 
$current_date = date("Y/m/d"); 
   



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
#link a:link, 
#link a:visited {
  background-color:#CCC;
  color: #000;
  padding: 4px 11px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  white-space: nowrap;
}


#link a:hover, 
#link a:active {
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
              <h3>Edit/View Appointment Form</h3>
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

  <div id="patient_details" class="form-group">
 											<?php 
/*                                           $sql= "select a.appointment_id,a.patient_id,a.consultant_id,a.date,a.time_slot, u.name  consultant_name,p.name patient_name,t.start_from, t.end_at from appointment a, users u, patient p, time_slot t where a.patient_id=p.patient_id and a.consultant_id=u.user_id and a.time_slot = t.id;";*/

$sql= "select a.appointment_id,a.patient_id,a.date,a.time_slot,p.name patient_name,p.mobile_no,t.start_from, t.end_at from appointment a, patient p, time_slot t where a.patient_id=p.patient_id and a.time_slot = t.time_slot_id and a.date >= '$current_date' order by a.date;";
                                            $result = mysqli_query($conn, $sql);

                                            if (mysqli_num_rows($result) > 0) {
                                            // output data of each row
                                            $counter = 1;

                                            echo '<table border="1" cellpadding="5" class="patient_detail_table">
                                                <tr>
												    <td><strong>Appointment ID</strong></td>
													<td><strong>Patient ID</strong></td>
                                                    <td><strong>Patient Name</strong></td>
                                                    <td><strong>Mobile No</strong></td>
						                            <td><strong>Date</strong></td>
                                                    <td><strong>Time Slot</strong></td>
													<td>&nbsp;</td>
													<!--<td>&nbsp;</td>-->
													<td>&nbsp;</td>';
													
                                                echo '</tr>';
                                                while($row = mysqli_fetch_assoc($result)) {

                         echo '<tr id="tr'.$counter.'">
						 <td><input type="text" id="appointment_id'.$counter.'" value="'.$row['appointment_id'].'" style="width:80px" disabled></td>
                         <td><input type="text" id="patient_id'.$counter.'" value="'.$row['patient_id'].'" style="width:60px" disabled></td>
						 <td><input type="text" value="'.$row['patient_name'].'" disabled></td>
						 <td><input type="text" value="'.$row['mobile_no'].'" disabled></td>
						 <td><input type="date" id="date'.$counter.'" value="'.$row['date'].'" style="width:150px" disabled></td>
						 <td><input type="text" id="time_slot'.$counter.'" value="'.$row['start_from'].'-'.$row['end_at'].'" disabled></td>
						 <td> <div id="link"><a href="visit.php?patient_id='.$row['patient_id'].'" target="_blank">Create Visit</a></div></td>
						<!-- <td><input type="button" id="edit'.$counter.'" value="Edit" class="edit_btn"><input type="button" id="save'.$counter.'" value="Save" class="save_btn" style="display:none"></td>-->
						<td><input type="button" id="reschedule'.$counter.'" value="Re-Schedule" class="reschedule_btn"></td>';
                                               echo'</tr>';
                                                $counter++;
                                                } // end of while 
                                                echo '</table>	<br>	';
                                            } else {
                                             echo 'No Record Found';
                                            }
                                            

mysqli_close($conn); // Connection Closed
?>
                                        </div>


                                       
  
  
                                        

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
$( document ).on( "click", ".edit_btn", function() {
var id =$(this).attr("id").replace("edit","");
$("#save"+id).show("slow");
$(this).hide("slow");


//document.getElementById("consultant"+id).removeAttribute("disabled");
document.getElementById("date"+id).removeAttribute("disabled");
document.getElementById("time_slot"+id).removeAttribute("disabled");


return false;
}); // end of EDIT


$( document ).on( "click", ".save_btn", function() {
var id =$(this).attr("id").replace("save","");
$("#edit"+id).show("slow");
$(this).hide("slow");

var appointment_id = $('#appointment_id'+id).val();
var patient_id = $('#patient_id'+id).val();
//var consultant = $('#consultant'+id).val();
var date = $('#date'+id).val();
var time_slot = $('#time_slot'+id).val();

//document.getElementById("consultant"+id).setAttribute("disabled","disabled");
document.getElementById("date"+id).setAttribute("disabled","disabled");
document.getElementById("time_slot"+id).setAttribute("disabled","disabled");



//alert(builty_no);
//alert(vehicle_no);
//alert(container);
//alert(cash_person);

//$.post("ajax.php",{opt: "update_appointment",appointment_id:appointment_id,patient_id:patient_id,consultant:consultant,date:date,time_slot:time_slot},
$.post("ajax.php",{opt: "update_appointment",appointment_id:appointment_id,patient_id:patient_id,date:date,time_slot:time_slot},	
	function (data)
	{
	  alert(data);
	  //$("#details").html(data); 
	}); 
	
	
	//END OF $.post()



//return false;
}); // end of save

*/

$( document ).on( "click", ".delete_btn", function() {
var id =$(this).attr("id").replace("delete","");

var appointment_id = $('#appointment_id'+id).val();

    if (confirm("Are you sure you want to Delete Appointment No: "+appointment_id)) {
    
	$.post("ajax.php",{opt: "delete_appointment",appointment_id:appointment_id},
	function (data)
	{
	  alert(data);
	  $('#tr'+id).hide("slow");
	  //$("#details").html(data); 
	}); 
	
  } else {
    return false;
  }



}); // end of delete



$( document ).on( "click", ".reschedule_btn", function() {
var id =$(this).attr("id").replace("reschedule","");

var appointment_id = $('#appointment_id'+id).val();
var patient_id = $('#patient_id'+id).val();


    if (confirm("Are you sure you want to Re-Schedule Appointment No: "+appointment_id)) {
    
	$.post("ajax.php",{opt: "delete_appointment",appointment_id:appointment_id},
	function (data)
	{
	  //alert(data);
window.location.replace("appointment.php?patient_id="+patient_id);
	  //$("#details").html(data); 
	}); 
	
  } else {
    return false;
  }



}); // end of delete

        }); // end of document.ready

 </script>

  </body>
  </html>
