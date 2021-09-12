<?php
require_once "php_scripts/session.php";

  if(isset($_SESSION['username'])){

    require_once "repeated_sections/configuration.php";
	require_once("repeated_sections/connection.php");
    
    //require_once "php_scripts/apis.php";
	
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

	if ($role_id==2) {
	header("Location:consultation_queue.php"); 
	}
	else if ($role_id==3) {
	header("Location:treatment_queue.php"); 
	}
	


} else {
    header("Location:signin.php");  
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

    <title>Home Page</title>

    <!-- Header Libraries -->
    <?php
      require_once "repeated_sections/headlibs.php";
    ?>
    <!-- /Header Libraries -->


  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        
        <!-- Mail Left Navigation Panel -->
        <?php
          require_once "repeated_sections/mainleftnav.php";
        ?>        
        <!-- /Mail Left Navigation Panel -->
        

        <!-- Top Bar -->
        <?php
          require_once "repeated_sections/topnavbar.php";
        ?>        
        <!-- /Top Bar -->
        
        

        <!-- page content -->
        <div class="right_col" role="main">



        <!-- Your Content Here -->
        <!-- <h1 class="text-center">Mimar Group</h1> -->

        <!--<img src="assets/images/logoBig2.png" class='center-block'>-->
          <h1 class='center-block' align="center">User Dashboard Home</h1>
        </div>
        <!-- /page content -->

        <!-- footer Content -->
        <?php
          require_once "repeated_sections/footerbar.php";
        ?>
        <!-- /footer Content -->
      </div>
    </div>

    <!-- footer Libraries -->
    <?php
      require_once "repeated_sections/footlibs.php";
    ?>
    <!-- footer Libraries -->

    <script>
      $(document).ready(function() {
       

      });
    </script>


    
  </body>
</html>
