<?php
require_once "php_scripts/session.php";

  if(isset($_SESSION['username'])){

    require_once "repeated_sections/configuration.php";



  }else
    header("Location:signin.php");

?>

<?php
require_once("repeated_sections/connection.php");

$username = $_SESSION['username'];



$current_date = date("Y/m/d");

$sql= "select u.user_id, u.gender, ua.username, ur.role_id from users u, user_auth ua, user_roles ur where ua.username = '$username' and u.user_id=ua.user_id and u.user_id = ur.user_id;";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {

while($row = mysqli_fetch_assoc($result)) {
$user_gender = $row['gender'];
$user_role = $row['role_id'];
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
    <meta http-equiv="refresh" content="30" >

    <title>Cupping Therapy Clinic</title>

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
                            <h3>Treatment Queue</h3>
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
                                <h2>In Waiting</h2>
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
 											<?php 
											if ($user_gender == 'F' and $user_role != 1) { 
                                           $sql= "(select p.patient_id,p.name,p.gender,p.age,p.mobile_no,p.reg_date,v.visit_id,c.end_time from patient p,visit v,consultation c where p.gender='F' and v.visit_date = '$current_date' and v.t_start_time is null and p.patient_id=v.patient_id and v.visit_id = c.visit_id and v.visit_id not in (select visit_id from treatment) order by v.visit_id desc)
UNION ALL 
(select p.patient_id,p.name,p.gender,p.age,p.mobile_no,p.reg_date,v.visit_id, '' AS end_time from patient p,visit v where p.gender='F' and v.visit_date =  '$current_date' and v.t_start_time is null and p.patient_id=v.patient_id and v.visit_id not in (select visit_id from treatment) and v.skip_consultation = 1 order by v.visit_id desc);";
										} else if ($user_gender == 'M' and $user_role != 1) {
										$sql= "(select p.patient_id,p.name,p.gender,p.age,p.mobile_no,p.reg_date,v.visit_id,c.end_time from patient p,visit v,consultation c where p.gender='M' and v.visit_date = '$current_date' and v.t_start_time is null and p.patient_id=v.patient_id and v.visit_id = c.visit_id and v.visit_id not in (select visit_id from treatment) order by v.visit_id desc)
UNION ALL 
(select p.patient_id,p.name,p.gender,p.age,p.mobile_no,p.reg_date,v.visit_id, '' AS end_time from patient p,visit v where p.gender='M' and v.visit_date =  '$current_date' and v.t_start_time is null and p.patient_id=v.patient_id and v.visit_id not in (select visit_id from treatment) and v.skip_consultation = 1 order by v.visit_id desc);";
											} // end of else if
											else {
											$sql= "(select p.patient_id,p.name,p.gender,p.age,p.mobile_no,p.reg_date,v.visit_id,c.end_time from patient p,visit v,consultation c where v.visit_date = '$current_date' and v.t_start_time is null and p.patient_id=v.patient_id and v.visit_id = c.visit_id and v.visit_id not in (select visit_id from treatment) order by v.visit_id desc)
UNION ALL 
(select p.patient_id,p.name,p.gender,p.age,p.mobile_no,p.reg_date,v.visit_id, '' AS end_time from patient p,visit v where v.visit_date =  '$current_date' and v.t_start_time is null and p.patient_id=v.patient_id and v.visit_id not in (select visit_id from treatment) and v.skip_consultation = 1 order by v.visit_id desc);";
											
											}
                                            $result = mysqli_query($conn, $sql);

                                            if (mysqli_num_rows($result) > 0) {
                                            // output data of each row
                                            $counter = 1;

                                            echo '<table border="1" cellpadding="5" class="patient_detail_table">
                                                 <thead>
												<tr>
                                                    <th>Patient No</th>
                                                    <th>Name</th>
													<th>Gender</th>
													<th>Age</th>
                                                    <th>Mobile No</th>
													<th>Consultation Time</th>
													<th>&nbsp;</th>
													
                                                </tr>
												</thead><tbody>';
                                                while($row = mysqli_fetch_assoc($result)) {

                         echo '<tr>
                         <td>'.$row['patient_id'].'</td>
						 <td>'.$row['name'].'</td>
						 <td>'.$row['gender'].'</td>
						 <td>'.$row['age'].'</td>
						 <td>'.$row['mobile_no'].'</td>	
						 <td>'.$row['end_time'].'</td>	
						 <td>
						 <form action="treatment.php" method="post">
						 <input type="hidden" name="visit_id" value="'.$row['visit_id'].'">
						 <input type="submit" id="submit_btn" value="Start Treatment">
						 </form>
						 </td> ';
                                               echo'</tr>';
                                                $counter++;
                                                } // end of while 
                                                echo '</tbody></table>	<br>';
                                            } else {
                                             echo 'No Record Found';
                                            }
                                            

//mysqli_close($conn); // Connection Closed
?>
                                        </div>


                                        <br>



                                    </div><!-- /.col-md-6 -->





                                </div><!-- /.box-body -->
                                <!-- end form for validations -->

                            </div>


                        </div> <!-- end of div x_panel -->



							<!-- Add Branch Form 2 -->
							
							<div class="x_panel">

                            <div class="x_title">
                                <h2>In Progress</h2>
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
 											<?php 
										if ($user_gender == 'F' and $user_role != 1) {
                                           $sql1= "(select p.patient_id,p.name,p.gender,p.age,p.mobile_no,p.reg_date,v.visit_id,c.end_time from patient p,visit v,consultation c where p.gender = 'F' and v.visit_date = '$current_date' and v.t_start_time is not null and v.visit_end_time is null and p.patient_id=v.patient_id and v.visit_id = c.visit_id  order by v.visit_id desc)
UNION ALL 
(select p.patient_id,p.name,p.gender,p.age,p.mobile_no,p.reg_date,v.visit_id, '' AS end_time from patient p,visit v where p.gender = 'F' and v.visit_date =  '$current_date' and v.t_start_time is not null and v.visit_end_time is null and p.patient_id=v.patient_id and v.skip_consultation = 1 order by v.visit_id desc);";
										} else if ($user_gender == 'M' and $user_role != 1) {
										$sql1= "(select p.patient_id,p.name,p.gender,p.age,p.mobile_no,p.reg_date,v.visit_id,c.end_time from patient p,visit v,consultation c where p.gender = 'M' and v.visit_date = '$current_date' and v.t_start_time is not null and v.visit_end_time is null and p.patient_id=v.patient_id and v.visit_id = c.visit_id  order by v.visit_id desc)
UNION ALL 
(select p.patient_id,p.name,p.gender,p.age,p.mobile_no,p.reg_date,v.visit_id, '' AS end_time from patient p,visit v where p.gender = 'M' and  v.visit_date =  '$current_date' and v.t_start_time is not null and v.visit_end_time is null and p.patient_id=v.patient_id and v.skip_consultation = 1 order by v.visit_id desc);";
										} else {
										$sql1= "(select p.patient_id,p.name,p.gender,p.age,p.mobile_no,p.reg_date,v.visit_id,c.end_time from patient p,visit v,consultation c where v.visit_date = '$current_date' and v.t_start_time is not null and v.visit_end_time is null and p.patient_id=v.patient_id and v.visit_id = c.visit_id  order by v.visit_id desc)
UNION ALL 
(select p.patient_id,p.name,p.gender,p.age,p.mobile_no,p.reg_date,v.visit_id, '' AS end_time from patient p,visit v where v.visit_date =  '$current_date' and v.t_start_time is not null and v.visit_end_time is null and p.patient_id=v.patient_id and v.skip_consultation = 1 order by v.visit_id desc);";					
										} // end of else
										
                                            $result1 = mysqli_query($conn, $sql1);

                                            if (mysqli_num_rows($result1) > 0) {
                                            // output data of each row
                                            $counter1 = 1;

                                            echo '<table border="1" cellpadding="5" class="patient_detail_table">
                                                 <thead>
												<tr>
                                                    <th>Patient No</th>
                                                    <th>Name</th>
													<th>Gender</th>
													<th>Age</th>
                                                    <th>Mobile No</th>
													<th>Consultation Time</th>
													<th>&nbsp;</th>
													
                                                </tr>
												</thead><tbody>';
                                                while($row = mysqli_fetch_assoc($result1)) {

                         echo '<tr>
                         <td>'.$row['patient_id'].'</td>
						 <td>'.$row['name'].'</td>
						 <td>'.$row['gender'].'</td>
						 <td>'.$row['age'].'</td>
						 <td>'.$row['mobile_no'].'</td>
						 <td>'.$row['end_time'].'</td>	
						 <td>
						 <form action="treatment.php" method="post">
						 <input type="hidden" name="visit_id" value="'.$row['visit_id'].'">
						 <input type="submit" id="submit_btn" value="Resume Treatment">
						 </form>
						 </td> ';
                                               echo'</tr>';
                                                $counter1++;
                                                } // end of while 
                                                echo '</tbody></table>	<br>';
                                            } else {
                                             echo 'No Record Found';
                                            }
                                            

mysqli_close($conn); // Connection Closed
?>
                                        </div>


                                        <br>



                                    </div><!-- /.col-md-6 -->





                                </div><!-- /.box-body -->
                                <!-- end form for validations -->

                            </div>


                          
                        </div> <!-- end of div x_panel 2 -->





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

$('.patient_detail_table').DataTable( {
pageLength: 50,									 
dom: 'Bfrtip',
buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
			]
}); // end of datatable


$( document ).on( "click", ".edit_btn", function() {
var id =$(this).attr("id").replace("edit","");
$("#save"+id).show("slow");
$(this).hide("slow");


document.getElementById("name"+id).removeAttribute("disabled");
document.getElementById("gender"+id).removeAttribute("disabled");
document.getElementById("age"+id).removeAttribute("disabled");
document.getElementById("blood_group"+id).removeAttribute("disabled");
document.getElementById("mobile_no"+id).removeAttribute("disabled");
document.getElementById("address"+id).removeAttribute("disabled");
document.getElementById("email"+id).removeAttribute("disabled");
document.getElementById("occupation"+id).removeAttribute("disabled");
document.getElementById("old_patient_no"+id).removeAttribute("disabled");
document.getElementById("reg_date"+id).removeAttribute("disabled");



return false;
}); // end of EDIT


$( document ).on( "click", ".save_btn", function() {
var id =$(this).attr("id").replace("save","");
$("#edit"+id).show("slow");
$(this).hide("slow");

var patient_id = $('#patient_id'+id).val();
var name = $('#name'+id).val();
var gender = $('#gender'+id).val();
var age = $('#age'+id).val();
var blood_group = $('#blood_group'+id).val();
var mobile_no = $('#mobile_no'+id).val();
var address = $('#address'+id).val();
var email = $('#email'+id).val();
var occupation = $('#occupation'+id).val();
var reg_date = $('#reg_date'+id).val();
var old_patient_no = $('#old_patient_no'+id).val();


document.getElementById("name"+id).setAttribute("disabled","disabled");
document.getElementById("gender"+id).setAttribute("disabled","disabled");
document.getElementById("age"+id).setAttribute("disabled","disabled");
document.getElementById("blood_group"+id).setAttribute("disabled","disabled");
document.getElementById("mobile_no"+id).setAttribute("disabled","disabled");
document.getElementById("address"+id).setAttribute("disabled","disabled");
document.getElementById("email"+id).setAttribute("disabled","disabled");
document.getElementById("occupation"+id).setAttribute("disabled","disabled");
document.getElementById("reg_date"+id).setAttribute("disabled","disabled");
document.getElementById("old_patient_no"+id).setAttribute("disabled","disabled");





//alert(builty_no);
//alert(vehicle_no);
//alert(container);
//alert(cash_person);

$.post("ajax.php",{opt: "update_patients",patient_id:patient_id,name:name,gender:gender,age:age,blood_group:blood_group,mobile_no:mobile_no,address:address,email:email,occupation:occupation,reg_date:reg_date,old_patient_no:old_patient_no},
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

var patient_id = $('#patient_id'+id).val();

    if (confirm("Are you sure you want to delete Patient No: "+patient_id)) {
    
	$.post("ajax.php",{opt: "delete_patients",patient_id:patient_id},
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