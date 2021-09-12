<?php
require_once "php_scripts/session.php";

  if(isset($_SESSION['username'])){

    require_once "repeated_sections/configuration.php";



  }else {
    header("Location:signin.php");
  }
?>

<?php
require_once("repeated_sections/connection.php");

$username = $_SESSION['username'];

/*
if (isset($_GET['check_date'])){
$check_date = $_GET['check_date'];
$timestamp = strtotime($check_date);

$day_id = date('w', $timestamp);
} else {
	echo "No Checking Date was submitted";
	die();
}

	if ($day_id==0) 
	{
	$day = 'Sunday';
	} 
	
	else if ($day_id==1) 
	{
	$day = 'Monday';
	} 
	
	else if ($day_id==2) 
	{
	$day = 'Tuesday';
	} 
	
	else if ($day_id==3) 
	{
	$day = 'Wednesday';
	} 
	
	else if ($day_id==4) 
	{
	$day = 'Thursday';
	} 
	
	else if ($day_id==5) 
	{
	$day = 'Friday';
	} 
	
	else if ($day_id==6) 
	{
	$day = 'Saturday';
	} 
	*/
	

  $sql= "select u.user_id, u.gender, ua.username from users u, user_auth ua where ua.username = '$username' and u.user_id=ua.user_id;";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {

while($row = mysqli_fetch_assoc($result)) {
$user_id = $row['user_id'];
$user_gender = $row['gender'];
} // end of while 
} else {
echo 'No Record Found';
}
                                            
												

?>
<!DOCTYPE html>
<html lang="en">
<head>
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

        .patient_detail_table td {
            padding: 5px;
			text-align:center;
        }

        input[type="text"] {
            width: 80px;
        }
 body {
            font-family: arial;
            font-size: 11px;
        }

        #feebill {
            float: left;
            width: 32%;
            padding-right: 5px;
            margin-right: 5px;
            margin-top: 5px;
            display: inline-block;
        }

        .feebill_border {
            border-right: #333333 dashed 1px;
        }
        <!-- ----for table bordr--------- -->
        table.btable {
            border: 1px solid black;
        }

        table.btable tr {
            border: 1px solid black;
        }

        table.btable td {
            border: 1px solid black;
        }

        .style6 {
            font-size: 14px;
            font-weight: bold;
            font-family: Arial;
        }

        {
            size &#58;
            landscape;
        }
		
@media print {
  body * {
    visibility: hidden;
  }
  #print_div, #print_div * {
    visibility: visible;
  }
  #print_div {
    position: absolute;
    left: 0;
    top: 0;
padding-left:25px;
  }
 
 
  @page {
                size: landscape;
            }

            tr, td, th, table {
                page-break-inside: avoid;
            }

            footer {
                page-break-after: always;
            }

            thead {
                display: table-header-group;
            }
}
    </style>


    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Bilal Hijama Clinic</title>

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
                     <div id="print_div"></div>

                    <div class="page-title col-xs-12">
                        <div class="title_left">
                            <h3>Check Availability</h3>
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
                                    <li>
                                        <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
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
                                    <li>
                                        <a class="close-link"><i class="fa fa-close"></i></a>
                                    </li>
                                </ul>
                                <div class="clearfix"></div>
                            </div>

                            <div class="x_content">

                                <div class="box-body">
                                    <div class="col-md-6"> 


 <div id="patient_details" class="form-group">
 <input type="date" id="check_date" class="form-control">
 </div>
                                   
 <div class="form-group" style="margin-bottom:50px">
 <input type="button" class="form-control" id="check_availability"  value="Check Availability">
 </div>


<div class="form-group" id="details">
</div>

                                    </div><!-- /.col-md-6 -->





                                </div><!-- /.box-body -->
                                <!-- end form for validations -->

                            </div>


                           


                        </div>


                    </div>
                </div>
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

        // Document Ready Start
$(document).ready(function () {


/*$('.patient_detail_table').DataTable( {
pageLength: 50,	
dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
			]
}); // end of datatable*/




$( document ).on( "click", "#check_availability", function() {
var check_date = $('#check_date').val();

    
	$.post("ajax.php",{opt: "check_availability",check_date:check_date},
	function (data)
	{
	  //alert(data);
	  $("#details").html(data); 
	}); 




}); // end of delete


        }); // end of document.ready
    </script>

</body>
</html>