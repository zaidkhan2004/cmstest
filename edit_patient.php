
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
die("Error! No Patient data submitted");
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
						  					$sql= "select * from patient where patient_id=$patient_id";
                                            $result = mysqli_query($conn, $sql);
                                            if (mysqli_num_rows($result) > 0) {
						                    while($row = mysqli_fetch_assoc($result)) { 
                                     ?>
                                       <div class="form-group">
                                       <label>Patient No</label><span style="color:red">*</span>
                                       <input type="text" id="patient_id" class="form-control" value="<?php echo $row['patient_id']; ?>" disabled>
                                       </div>
                                                                                    
                                        <div class="form-group">
											<label>Name</label><span style="color:red">*</span>
											<input type="text" id="name" class="form-control" value="<?php echo $row['name']; ?>">
										</div>                                    
                                    
                                    <div class="form-group">
                                            <label>Gender</label><span style="color:red">*</span> <br>
                                            <?php 
											$gender = $row['gender'];
											if ($gender == 'M') {
												?>
                                          <label for="male">Male</label> <input type="radio" name="gender" id="male" value="M" checked/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                          <label for="female">Female</label> <input type="radio" name="gender" id="female" value="F" /> 
												<?php
												} // end of if
												else {
													?>
                                       <label for="male">Male</label> <input type="radio" name="gender" id="male" value="M" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                       <label for="female">Female</label> <input type="radio" name="gender" id="female" value="F" checked /> 
										<?php
										} //end of else 
										?>

                                        </div>     
                                        
                                        <div class="form-group">
                                        <label>Age</label><span style="color:red">*</span>
										<input type="text" id="age" class="form-control" value="<?php echo $row['age']; ?>">
										</div>
                                        
                                        <div class="form-group">
                                        <label>Blood Group</label>
										<input type="text" id="blood_group" class="form-control" value="<?php echo $row['blood_group']; ?>">
										</div>
                                        
                                        <div class="form-group">
                                        <label>Merital Status</label>
										<input type="text" id="merital_status" class="form-control" value="<?php echo $row['merital_status']; ?>">
										</div>
                                        
                                        <div class="form-group">
										<label>Mobile No</label><span style="color:red">*</span>
										<input type="text" id="mobile_no" class="form-control" value="<?php echo $row['mobile_no']; ?>">
										</div>
                                        
                                        <div class="form-group">
										<label>Address</label><span style="color:red">*</span>
										<input type="text" id="address" class="form-control" value="<?php echo $row['address']; ?>">
										</div>
                                                                                
                                        <div class="form-group">
										<label>Email</label>
										<input type="text" id="email" class="form-control" value="<?php echo $row['email']; ?>">
										</div>
                                        
                                        <div class="form-group">
										<label>Occupation</label>
										<input type="text" id="occupation" class="form-control" value="<?php echo $row['occupation']; ?>">
										</div>                                        
                                        
                                        <div class="form-group">
                                        <label>Registration Date</label> <span style="color:red">*</span>
										<input type="date" id="reg_date" class="form-control" value="<?php echo $row['reg_date']; ?>">
										</div>
                                        
                                        <div class="form-group">
										<label>Old Patient No</label>
										<input type="text" id="old_patient_no" class="form-control" value="<?php echo $row['old_patient_no']; ?>">
										</div>   
                                        <?php  } // end of while 
											
											} else {
                                            // do nothing
                                            }
										?>                                     
                                        
                                        

                      <br>
                      <br>

                     <div class="form-group">
						           <input type="button" name="submit" id="submit" value="Submit" >
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

var patient_id = $("#patient_id").val();
var name = $('#name').val();
var gender = $("input[name=gender]:checked").val();
var age = $('#age').val();
var blood_group = $('#blood_group').val();
var merital_status = $('#merital_status').val();
var mobile_no = $('#mobile_no').val();
var address = $('#address').val();
var email = $('#email').val();
var occupation = $('#occupation').val();
var reg_date = $('#reg_date').val();
var old_patient_no = $('#old_patient_no').val();
		
		if(patient_id=='') { 
			alert("Please Enter Patient No");
			return false;
		}
		else if (name=='') {
			alert("Please Enter Patient Name");
			return false;
			}
			
			else if (address=='') {
			alert("Please Enter Patient Address");
			return false;
			}
			
			else if (mobile_no=='') {
			alert("Please Enter Patient Mobile No");
			return false;
			}
			
	
$.post("ajax.php",{opt: "update_patients",patient_id:patient_id,name:name,gender:gender,age:age,blood_group:blood_group,merital_status:merital_status,mobile_no:mobile_no,address:address,email:email,occupation:occupation,reg_date:reg_date,old_patient_no:old_patient_no},

    function(data){

alert(data);


window.location.replace("edit_view_all_patient.php");
//location.reload();
      }); //end of post
    }); //end of submit


//$(".data_saved").show("slow");



}); // end of document.ready

 </script>

  </body>
  </html>
