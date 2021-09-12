<?php
require_once "php_scripts/session.php";

  if(isset($_SESSION['user_email'])){

    require_once "repeated_sections/configuration.php";



  }else
    header("Location:signin.php");

?>

<?php
require_once("repeated_sections/connection.php");

$user_email = $_SESSION['user_email'];

$sql="SELECT usertype FROM users where email='$user_email'";
$result = mysqli_query($conn, $sql);

while($row = mysqli_fetch_assoc($result)) {
$user_type =  $row['usertype'];
  } // end of while

$challan_no = $_POST['challan_no'];
$challan_no = 12345;

?>
<!DOCTYPE html>
<html lang="en">
<head>
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
                            <h3>Edit Female Patients Data</h3>
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
			
                                        <div id="patient_details1" class="form-group">
 											<?php 
		$rec_limit = 100;
		// total recorsd to show on a page
		
		$sql1 = "SELECT count(patient_no) FROM patients where patient_no like 'F%'; ";
        $retval = mysqli_query( $conn,$sql1 );
         
         if(! $retval ) {
            die('Could not get data: ' . mysqli_error());
         }
         $row1 = mysqli_fetch_array($retval, MYSQLI_NUM );
		 
         $rec_count = $row1[0];
		 // total number of records
		 
		 $lastPage = ceil($rec_count / $rec_limit);
		 
		   if( isset($_GET{'page'} ) ) {
            $page = $_GET{'page'} + 1;
            $offset = $rec_limit * $page ;
         }else {
            $page = 0;
            $offset = 0;
         }
		  $left_rec = $rec_count - ($page * $rec_limit);
		   //echo 'count: ' .$rec_count;
		  //echo 'left: ' .$left_rec;
		  //echo 'limit: ' .$rec_limit;
											
                                           $sql= "select * from patients where patient_no like 'F%' LIMIT $offset, $rec_limit;";
                                            $result = mysqli_query($conn, $sql);

                                            if (mysqli_num_rows($result) > 0) {
                                            // output data of each row
                                            $counter = 1;

                                            echo '<table border="1" cellpadding="5" class="patient_detail_table">
                                                <tr>
                                                    <td><strong>Patient No</strong></td>
                                                    <td><strong>Name</strong></td>
													<td><strong>Address</strong></td>
                                                    <td><strong>Mobile No</strong></td>
                                                    <td><strong>Age</strong></td>
						                            <td>&nbsp;</td>
													<td>&nbsp;</td>
													<td>&nbsp;</td>';
													
                                                echo '</tr>';
												//while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                                                while($row = mysqli_fetch_assoc($result)) {
                                               
                         echo '<tr id="tr'.$counter.'">
                         <td><input type="text" id="patient_no'.$counter.'" value="'.$row['patient_no'].'" style="width:70px" disabled></td>
						 <td><input type="text" id="name'.$counter.'" value="'.$row['name'].'" style="width:200px" disabled ></td>
                         <td><input type="text" id="address'.$counter.'" value="'.$row['address'].'" style="width:200px" disabled></td>
						 <td><input type="text" id="mobile_no'.$counter.'" value="'.$row['mobile_no'].'" style="width:100px" disabled></td>
						 <td><input type="text" id="age'.$counter.'" value="'.$row['age'].'" style="width:50px" disabled></td>
						 <td><input type="button" id="edit'.$counter.'" value="Edit" class="edit_btn"><input type="button" id="save'.$counter.'" value="Save" class="save_btn" style="display:none"></td>
						 <td><input type="button" id="delete'.$counter.'" value="Delete" class="delete_btn"></td>
						 <td> <div id="print_link"><a href="print_form.php?id='.$row['patient_no'].'" target="_blank"> Print Form </a> </td> ';
                                               echo'</tr>';
                                                $counter++;
                                                } // end of while 
                                                echo '</table>	<br>	';
                                            } else {
                                            echo 'No Record Found <br><br>';
                                            }
          
		 echo '<select id="page_no">
		 <option value="0" selected>Select Page</option>';
		 
		 for($i=1; $i<$lastPage; $i++) {
			$j = $i-1;
			echo '<option value="'.$j.'">Page No '.$i.'</option>'; 
			 
			 } // end of for loop 
		 echo '</select>';
		 
		 echo '<a href="edit_view_all_patient_female.php"> First Page </a>  &nbsp; | &nbsp;';
		 
if( $page > 0 ) {
            $last = $page - 2;
            echo "<a href =\"$_PHP_SELF?page=$last\"> Previous ".$rec_limit." Records</a> &nbsp; | &nbsp;";
            echo "<a href =\"$_PHP_SELF?page=$page\"> Next ".$rec_limit." Records</a> &nbsp; | &nbsp;";
         }else if( $page == 0 ) {
            echo "<a href =\"$_PHP_SELF?page=$page\"> Next ".$rec_limit." Records</a> &nbsp; | &nbsp;";
         }else if( $left_rec < $rec_limit ) {
            $last = $page - 2;
            echo "<a href =\"$_PHP_SELF?page=$last\"> Previous ".$rec_limit." Records</a> &nbsp; | &nbsp;";
         }
         
		 
		 $lastPage = $lastPage-2; 
		 echo "<a href =\"$_PHP_SELF?page=$lastPage\"> Last Page </a>";
		 
mysqli_close($conn); // Connection Closed
?>
                                        </div>


                                        <br>



                                    </div><!-- /.col-md-6 -->

                                </div><!-- /.box-body -->

                			 </div><!-- /.x_content -->                      

                        </div> <!-- /.x_panel -->




                        <div class="x_panel">

                            <div class="x_title">
                                <h2>Patient Search</h2>  
                                 <ul class="nav navbar-right panel_toolbox">
                                    <li>
                                        <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                    </li>
                                 </ul>    
                                <div class="clearfix"></div>
                            </div>

                            <div class="x_content">

                                <div class="box-body">
                                    <div class="col-md-6">
                                      <div id="patient_details" class="form-group">
 	
                                        </div><br>
<strong>Patient No:</strong> <input type="text" id="patient_no" placeholder="Enter Patient No Here" style="width:200px; margin-bottom:25px;">
                    <input type="button" id="search" value="Search">&nbsp; &nbsp;<input type="button" id="clear_patient_no" value="Clear">  
                    <h3>OR</h3>
                    <strong>Name:</strong> &nbsp; &nbsp;&nbsp; &nbsp;&nbsp;<input type="text" id="patient_name" placeholder="Enter Patient Name Here" style="width:200px; margin-bottom:25px;">
                    <input type="button" id="search_name" value="Search">&nbsp; &nbsp;<input type="button" id="clear_patient_name" value="Clear"> 
                    <h3>OR</h3>
                    <strong>Mobile No:</strong> <input type="text" id="patient_mobile" placeholder="Enter Patient Mobile No Here" style="width:200px; margin-bottom:25px;">
                    <input type="button" id="search_mobile" value="Search">&nbsp; &nbsp;<input type="button" id="clear_patient_mobile" value="Clear">                   
                    <br><br>
       

                                    </div><!-- /.col-md-6 -->

                                </div><!-- /.box-body -->

                            </div><!-- /.x_content -->                      

                        </div> <!-- /.x_panel -->



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



$( document ).on( "click", ".edit_btn", function() {
var id =$(this).attr("id").replace("edit","");
$("#save"+id).show("slow");
$(this).hide("slow");


document.getElementById("name"+id).removeAttribute("disabled");
document.getElementById("address"+id).removeAttribute("disabled");
document.getElementById("mobile_no"+id).removeAttribute("disabled");
document.getElementById("age"+id).removeAttribute("disabled");


return false;
}); // end of EDIT


$( document ).on( "click", ".save_btn", function() {
var id =$(this).attr("id").replace("save","");
$("#edit"+id).show("slow");
$(this).hide("slow");

var patient_no = $('#patient_no'+id).val();
var name = $('#name'+id).val();
var address = $('#address'+id).val();
var mobile_no = $('#mobile_no'+id).val();
var age = $('#age'+id).val();

document.getElementById("name"+id).setAttribute("disabled","disabled");
document.getElementById("address"+id).setAttribute("disabled","disabled");
document.getElementById("mobile_no"+id).setAttribute("disabled","disabled");
document.getElementById("age"+id).setAttribute("disabled","disabled");



//alert(builty_no);
//alert(vehicle_no);
//alert(container);
//alert(cash_person);

$.post("ajax.php",{opt: "update_patients",patient_no:patient_no,name:name,address:address,mobile_no:mobile_no,age:age},
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

var patient_no = $('#patient_no'+id).val();

    if (confirm("Are you sure you want to delete Patient No: "+patient_no)) {
    
	$.post("ajax.php",{opt: "delete_patients",patient_no:patient_no},
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



$( document ).on( "change", "#page_no", function() {
var page_no = $('#page_no').val();

window.location = "?page=" + page_no;

}); // end of change page no





$( document ).on( "click", "#search", function() {
var patient_no = $('#patient_no').val();

$.post("ajax.php",{opt: "get_patient_details",patient_no:patient_no},
	function (data)
	{	  
	  $("#patient_details").html(data); 
	}); 
	//END OF $.post()										   
										   
}); // end of search



$( document ).on( "click", "#search_name", function() {
var patient_name = $('#patient_name').val();

$.post("ajax.php",{opt: "get_patient_details_name",patient_name:patient_name},
	function (data)
	{	  
	  $("#patient_details").html(data); 
	}); 
	//END OF $.post()										   
										   
}); // end of search_name



$( document ).on( "click", "#search_mobile", function() {
var patient_mobile = $('#patient_mobile').val();

$.post("ajax.php",{opt: "get_patient_details_mobile",patient_mobile:patient_mobile},
	function (data)
	{	  
	  $("#patient_details").html(data); 
	}); 
	//END OF $.post()										   
										   
}); // end of search_mobile


$( document ).on( "click", "#clear_patient_no", function() {
$('#patient_no').val("");									   										   
}); // end of clear_no

$( document ).on( "click", "#clear_patient_name", function() {
$('#patient_name').val("");									   										   
}); // end of clear_name

$( document ).on( "click", "#clear_patient_mobile", function() {
$('#patient_mobile').val("");									   										   
}); // end of clear_mobile


$(document).on('keypress',function(e) {
   
   if(e.which == 13) {
      var foc = ($("*:focus").attr("id"));
	  //alert(foc);
	  if (foc == 'patient_no') {
		  $('#search').click();
    		return false;
		  }
		  
	  else if (foc == 'patient_name') {
		  $('#search_name').click();
    		return false;
		  }
		  
	  else if (foc == 'patient_mobile') {
		  $('#search_mobile').click();
    		return false;
		  }
    }
});
// end of keypress event

}); // end of document.ready
    </script>

</body>
</html>