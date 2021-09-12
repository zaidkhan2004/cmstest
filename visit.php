
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
              <h3>New  Visit Form</h3>
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
											<input type="date" id="visit_date" class="form-control" value="<?php echo date('Y-m-d'); ?>">
										</div>
                                        
                                      <div class="form-group">Visit Time<span style="color:red">*</span>
											<input type="time" id="visit_start_time" class="form-control" value="<?php echo date('h:i:s'); ?>">
										</div>
                                        
                                           <div class="form-group">
											<input type="checkbox" id="skip_consultation"  value="1">
                                            <label for="skip_consultation"> Skip Consultation </label>
                                            
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
					
$( document ).on( "click", "#submit", function() {
											   
    var patient_id = $("#patient_id").val();
	var visit_date = $("#visit_date").val();
	var visit_start_time = $("#visit_start_time").val();
	

if ($('#skip_consultation').is(":checked"))
{
    var skip_consultation = 1;
} else {
	var skip_consultation = 0;
}		
	
$.post("ajax.php",{opt: "add_new_visit",patient_id:patient_id,visit_date:visit_date,visit_start_time:visit_start_time,skip_consultation:skip_consultation},

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
