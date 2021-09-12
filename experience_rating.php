
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


  
if(isset($_GET['visit_id'])){
$visit_id = $_GET['visit_id'];
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
              <h3>Patient Feedback Form</h3>
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
       <input type="hidden" id="visit_id" value="<?php echo $visit_id; ?>"> 
       <h3>How was your overall expeirence? </h3>
<h4>Please rate on a scale of 1-10, <br>
1 being the lowest(poor), 10 being the highest(great). </h4><br>                    
      <table width="100%" border="0" cellspacing="5" cellpadding="5" align="center">
  <tr>
    <td><strong>1</strong></td>
    <td><strong>2</strong></td>
    <td><strong>3</strong></td>
    <td><strong>4</strong></td>
    <td><strong>5</strong></td>
    <td><strong>6</strong></td>
    <td><strong>7</strong></td>
    <td><strong>8</strong></td>
    <td><strong>9</strong></td>
    <td><strong>10</strong></td>
  </tr>
  <tr>
<td><input type="radio" name="rating" value="1"></td>
<td><input type="radio" name="rating" value="2"></td>
<td><input type="radio" name="rating" value="3"></td>
<td><input type="radio" name="rating" value="4"></td>
<td><input type="radio" name="rating" value="5"></td>
<td><input type="radio" name="rating" value="6"></td>
<td><input type="radio" name="rating" value="7"></td>
<td><input type="radio" name="rating" value="8"></td>
<td><input type="radio" name="rating" value="9"></td>
<td><input type="radio" name="rating" value="10"></td>
  </tr>
  </table><br>
  
                       <div class="form-group">
						           <input type="button" name="submit" id="submit" value="Submit" >
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
						


$("#submit").click(function (){

var visit_id = $("#visit_id").val();
var rating = $("input[name=rating]:checked").val();
		
			
	
$.post("ajax.php",{opt: "experience_rating",visit_id:visit_id,rating:rating},

    function(data){

alert(data);
window.location.replace("treatment_queue.php");

//location.reload();
      }); //end of post
}); //end of submit


//$(".data_saved").show("slow");



}); // end of document.ready

 </script>

  </body>
  </html>
