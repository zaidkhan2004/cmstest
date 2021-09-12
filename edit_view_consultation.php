
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
              <h3>Edit/View Consultation Form</h3>
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
                                           $sql= "select v.visit_id,v.patient_id,v.consultant_id,v.visit_date,v.visit_start_time, u.name  consultant_name,p.name patient_name from visit v, users u, patient p where v.patient_id=p.patient_id and v.consultant_id=u.user_id;";
                                            $result = mysqli_query($conn, $sql);

                                            if (mysqli_num_rows($result) > 0) {
                                            // output data of each row
                                            $counter = 1;

                                            echo '<table border="1" cellpadding="5" class="patient_detail_table">
                                                <tr>
												    <td><strong>Visit ID</strong></td>
                                                    <td><strong>Patient ID</strong></td>
                                                    <td><strong>Consultant ID</strong></td>
						                            <td><strong>Visit Date</strong></td>
                                                    <td><strong>Visit Time</strong></td>
													<td>&nbsp;</td>
													<td>&nbsp;</td>';
													
                                                echo '</tr>';
                                                while($row = mysqli_fetch_assoc($result)) {

                         echo '<tr id="tr'.$counter.'">
						 <td><input type="text" id="visit_id'.$counter.'" value="'.$row['visit_id'].'" disabled></td>
                         <td><input type="hidden" id="patient_id'.$counter.'" value="'.$row['patient_id'].'"><input type="text" value="'.$row['patient_name'].'" disabled></td>
						 <td>
						 <select id="consultant'.$counter.'" class="consultant" disabled>
						 <option value="'.$row['consultant_id'].'" selected>'.$row['consultant_name'].' </option>';
						 
						  					$sql2= "select u.user_id, u.name from users u,user_roles r where r.role_id=2 and u.user_id=r.user_id;";
                                            $result2 = mysqli_query($conn, $sql2);
                                            if (mysqli_num_rows($result2) > 0) {
						                    while($row2 = mysqli_fetch_assoc($result2)) { 
						             echo'<option value="'.$row2['user_id'].'">'.$row2['name'].' </option>';
                                                } // end of while
                                               
                                            } else {
                                            // do nothing
                                            }
						 
						 echo'</select>
						 </td>
						 <td><input type="date" id="visit_date'.$counter.'" value="'.$row['visit_date'].'" style="width:150px" disabled></td>
						 <td><input type="text" id="visit_start_time'.$counter.'" value="'.$row['visit_start_time'].'" disabled></td>
						 <td><input type="button" id="edit'.$counter.'" value="Edit" class="edit_btn"><input type="button" id="save'.$counter.'" value="Save" class="save_btn" style="display:none"></td>
						 <td><input type="button" id="delete'.$counter.'" value="Delete" class="delete_btn"></td> ';
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
						



$( document ).on( "click", ".edit_btn", function() {
var id =$(this).attr("id").replace("edit","");
$("#save"+id).show("slow");
$(this).hide("slow");


document.getElementById("consultant"+id).removeAttribute("disabled");
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
var consultant = $('#consultant'+id).val();
var date = $('#date'+id).val();
var time_slot = $('#time_slot'+id).val();

document.getElementById("consultant"+id).setAttribute("disabled","disabled");
document.getElementById("date"+id).setAttribute("disabled","disabled");
document.getElementById("time_slot"+id).setAttribute("disabled","disabled");



//alert(builty_no);
//alert(vehicle_no);
//alert(container);
//alert(cash_person);

$.post("ajax.php",{opt: "update_appointment",appointment_id:appointment_id,patient_id:patient_id,consultant:consultant,date:date,time_slot:time_slot},
	function (data)
	{
	  alert(data);
	  //$("#details").html(data); 
	}); 
	
	
	//END OF $.post()



//return false;
}); // end of save



$( document ).on( "click", ".delete_btn", function() {
var id =$(this).attr("id").replace("delete","");

var appointment_id = $('#appointment_id'+id).val();

    if (confirm("Are you sure you want to delete Appointment No: "+appointment_id)) {
    
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


        }); // end of document.ready

 </script>

  </body>
  </html>
