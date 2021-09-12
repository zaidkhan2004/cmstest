    <div class="col-md-3 left_col">
      <div class="left_col scroll-view">
        <div class="navbar nav_title" style="border: 0;">
<!-- <h2 align="center">Cupping Therapy Clinic</h2>-->
        </div>

        <div class="clearfix"></div>

        <!-- menu profile quick info -->
        <div class="profile">
          <!-- <div class="profile_pic">
            <img src="assets/images/img.jpg" alt="..." class="img-circle profile_img">
          </div> -->
          <div class="profile_info">
            <span>Welcome,</span>
            <h2><?=$_SESSION['username']?></h2>
          </div>
        </div>
        <!-- /menu profile quick info -->
<?php 
require_once("connection.php");

$username = $_SESSION['username'];

$sql="SELECT user_id from user_auth where username='$username'";
$result = mysqli_query($conn, $sql);

while($row = mysqli_fetch_assoc($result)) {
$user_id =  $row['user_id'];
  } // end of while
	
$sql="SELECT role_id from user_roles where user_id=$user_id";
$result = mysqli_query($conn, $sql);

while($row = mysqli_fetch_assoc($result)) {
$role_id =  $row['role_id'];
  } // end of while


//mysqli_close($conn);
?>
        <br />

         <!-- sidebar menu -->
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
          <div class="menu_section">
            <h3>General</h3>
            <ul class="nav side-menu">
              <li>
              	<a href="index.php"><i class="fa fa-home"></i> Home <span class=""></span></a>
              </li>

<?php 
if($role_id == 2) {
	
?>	

              <li><a><i class="fa fa-id-card"></i> Consultation Module <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="consultation_queue.php">Consultation Queue</a></li>
                    <!--<li><a href="edit_view_consultation.php">View/Edit Consultations</a></li>-->
                </ul>
              </li>

<?php 

} 

else if($role_id == 3)  { 
?>	
              <li><a><i class="fa fa-id-card"></i> Consultation Module <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="consultation_queue.php">Consultation Queue</a></li>
                    <!--<li><a href="edit_view_consultation.php">View/Edit Consultations</a></li>-->
                </ul>
              </li>

               <li><a><i class="fa fa-id-card"></i> Treatment Module <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="treatment_queue.php">Treatment Queue</a></li>
                </ul>
              </li>
<?php 
}

else if($role_id == 6)  { 
?>	
			 <li><a><i class="fa fa-user"></i> Patients Module <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="add_patient.php">Register New Patient</a></li>
                    <li><a href="edit_view_all_patient.php">View/Edit Patients</a></li>
                </ul>
              </li>
              
               <li><a><i class="fa fa-calendar"></i> Appointment Module <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="book_appointment.php">Book Appointment</a></li>
                    <li><a href="edit_view_appointment.php">View/Edit Appointments</a></li>
                    <li><a href="check_availability.php">Check Slots Availability</a></li>
                </ul>
              </li>
               
               <li><a><i class="fa fa-id-card"></i> Visit Module <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="create_visit.php">Create Visit</a></li>
                    <!--<li><a href="edit_view_visit.php">View/Edit Visit Info</a></li>-->
                </ul>
              </li>
                            
             <li><a><i class="fa fa-id-card"></i> Receipt Module  <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="receipts.php">Receipts</a></li>
                   <!-- <li><a href="fee_management.php">Update Fee</a></li>-->
                    <li><a href="visit_discount.php">Apply Discount</a></li>
                </ul>
              </li>
              
<!--              <li><a><i class="fa fa-id-card"></i> Reports / Analysis  <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="reports.php">Reports</a></li>
                </ul>
              </li>-->
<?php 
}

else {
?>	

			 <li><a><i class="fa fa-user"></i> Patients Module <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="add_patient.php">Register New Patient</a></li>
                    <li><a href="edit_view_all_patient.php">View/Edit Patients</a></li>
                </ul>
              </li>
              
               <li><a><i class="fa fa-calendar"></i> Appointment Module <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="book_appointment.php">Book Appointment</a></li>
                    <li><a href="edit_view_appointment.php">View/Edit Appointments</a></li>
                    <li><a href="check_availability.php">Check Slots Availability</a></li>
                </ul>
              </li>
              
              <li><a><i class="fa fa-id-card"></i> Visit Module <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="create_visit.php">Create Visit</a></li>
                    <!--<li><a href="edit_view_visit.php">View/Edit Visit Info</a></li>-->
                </ul>
              </li>
              
              <li><a><i class="fa fa-id-card"></i> Consultation Module <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="consultation_queue.php">Consultation Queue</a></li>
                    <!--<li><a href="edit_view_consultation.php">View/Edit Consultations</a></li>-->
                </ul>
              </li>
              
               <li><a><i class="fa fa-id-card"></i> Treatment Module <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="treatment_queue.php">Treatment Queue</a></li>
                </ul>
              </li>
              
             <li><a><i class="fa fa-id-card"></i> Receipt Module  <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="receipts.php">Receipts</a></li>
                    <!--<li><a href="fee_management.php">Update Fee</a></li>-->
                    <li><a href="visit_discount.php">Apply Discount</a></li>
                </ul>
              </li>
              
              <li><a><i class="fa fa-id-card"></i> Reports / Analysis  <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="reports.php">Reports</a></li>
                </ul>
              </li>

	
<?php
} // end of else

?>


              
            
              
            </ul>
          </div>
          <div class="menu_section"></div>

        </div>
        <!-- /sidebar menu -->

        <!-- /menu footer buttons -->
        <div class="sidebar-footer hidden-small">
         <!--  <a data-toggle="tooltip" data-placement="top" title="Settings">
            <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
          </a>
          <a data-toggle="tooltip" data-placement="top" title="FullScreen">
            <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
          </a>
          <a data-toggle="tooltip" data-placement="top" title="Lock">
            <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
          </a> -->
          <a href="signout.php" data-toggle="tooltip" data-placement="top" title="Logout">
            <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
          </a>
        </div>
        <!-- /menu footer buttons -->
      </div>
    </div>

    <!-- top navigation -->
