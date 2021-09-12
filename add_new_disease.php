
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


$sql="SELECT max(disease_id) cnt from diseases";
$result = mysqli_query($conn, $sql);

while($row = mysqli_fetch_assoc($result)) {
$max_disease_id =  $row['cnt'];
  } // end of while
$disease_id = $max_disease_id+1;

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
              <h3>Add New Disease </h3>
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
                                    <label>Disease Name</label><span style="color:red"></span>
									<input type="text" id="disease_name" class="form-control">
									</div>
                               
                                    <div class="form-group"> 
                                        	<label>Disease Points</label>
				                   			<input type="text" id="points" class="form-control">
                                            <input type="button" id="save_points" value="Verify Points">
									</div> 
										
									<div id="points_list_div" class="form-group"> 
									</div> 
 
   

                      <br>
                      <br>

                     <div class="form-group">
						           <input type="button" name="submit" id="submit" value="Add New Disease" >
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

var disease_name = $("#disease_name").val();

var no_of_points = $("#no_of_points").val();

var points_arr = [];
	
for (i = 0; i < no_of_points; i++) {	
	//var point_id = $("#point"+i).val();
	points_arr.push($("#point"+i).val());
	} // end of for loop

$.post("ajax.php",{opt: "add_new_disease",disease_name:disease_name,points:points_arr},
function(data){
alert(data);
//window.location.replace("index.php");
location.reload();
      }); //end of post

}); //end of submit


//$(".data_saved").show("slow");



}); // end of document.ready

 </script>

  </body>
  </html>
