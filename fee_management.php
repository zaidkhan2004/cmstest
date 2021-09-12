
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
.link a:link, 
.link a:visited {
  background-color:#CCC;
  color: #000;
  padding: 4px 11px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  white-space: nowrap;
}


.link a:hover, 
.link a:active {
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
              <h3>Update Patient Data</h3>
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
                               		<?php 
						  					$sql= "select * from fee where fee_id = 1";
                                            $result = mysqli_query($conn, $sql);
                                            if (mysqli_num_rows($result) > 0) {
										?>
                                        
                                        <?php
						                    while($row = mysqli_fetch_assoc($result)) { 
                                     ?>
                                       <div class="form-group">
                                       <label>Fee ID</label>
                                       <input type="text" id="fee_id" class="form-control" value="<?php echo $row['fee_id']; ?>" disabled>
                                       </div>
                                                                                    
                                    <div class="form-group">
									<label>Description</label>
									<input type="description" id="name" class="form-control" value="<?php echo $row['description']; ?>" disabled>
									</div>                                                                       
                                        
                                        <div class="form-group">
										<label>Charges</label>
										<input type="text" id="charges" class="form-control" value="<?php echo $row['charges']; ?>">
										</div>   
                                        <?php  } // end of while 
											
											} else {
                                            // do nothing
                                            }
										?>                                     
                                        
                                        

                      <br>
                      <br>

                     <div class="form-group">
						           <input type="button" name="submit" id="submit" value="Update Fee" >
						         </div>
                                 
                                 <div id="book_appointment" class="link" style="display:none"></div>
                                 
                                 <div id="create_visit" class="link" style="display:none"></div>
                                 
                                  <div id="print_link" class="link" style="display:none"></div>

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
						



$("#submit").click(function (){

var fee_id = $("#fee_id").val();
var description = $('#description').val();
var charges = $('#charges').val();
				
	
$.post("ajax.php",{opt: "patient",patient_id:patient_id,name:name,gender:gender,age:age,blood_group:blood_group,merital_status:merital_status,mobile_no:mobile_no,address:address,email:email,occupation:occupation,reg_date:reg_date,old_patient_no:old_patient_no},

    function(data){

alert(data);


//location.reload();
      }); //end of post
    }); //end of submit


//$(".data_saved").show("slow");



}); // end of document.ready

 </script>

  </body>
  </html>
