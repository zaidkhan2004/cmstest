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
                            <h3>Edit/View All Patients Data</h3>
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
 											<?php 


                                            echo '<table id="patient_detail_table" border="1" cellpadding="5" class="display" >
                                               <thead>
											   <tr>
                                                    <th>Patient ID</th>
													<th>Patient Name</th>
													<th>Gender</th>
													<th>Age</th>
													<th>Mobile No</th>
													<th>Address</th>
													<th>Reg. Date</th>
													<th>Old Patient No</th>
													<th></th>
													<th></th>
													<th></th>
                                                </tr>
												</thead>';
 
                                                echo '</table>';

?>
                                        </div>


                                        <br>



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
							
/*$('#patient_detail_table').DataTable( {
	"bProcessing": true,
 	"serverSide": true,
 	"ajax":{
        url :"data_table_ajax.php",
        type: "POST",
        error: function(){
          $("#patient_detail_table_processing").css("display","none");
        }
  	}

}); // end of datatable	*/						


$('#patient_detail_table').DataTable( {
        "processing": true,
        "serverSide": true,
        "ajax": "data_table_ajax.php",
		'columnDefs': [ {
            'targets': -1,
            'data': null,
            'defaultContent': '<input type="button" id="print" value="Print Form">'
        },
		{
            'targets': -2,
            'data': null,
            'defaultContent': '<input type="button" id="visit" value="Add Visit Data">'
        },
		{
            'targets': -3,
            'data': null,
            'defaultContent': '<input type="button" id="edit" value="Edit">'
        }
		
		]
}); // end of datatable



 $('#patient_detail_table tbody').on( 'click', '#edit', function () {
		var table = $('#patient_detail_table').DataTable();
        var data = table.row( $(this).parents('tr') ).data();
        window.open('edit_patient.php?patient_id='+data[0]);
		//alert( data[0] +"'s salary is: "+ data[ 5 ] );
});
 
  $('#patient_detail_table tbody').on( 'click', '#visit', function () {
		var table = $('#patient_detail_table').DataTable();
        var data = table.row( $(this).parents('tr') ).data();
        window.open('add_visit.php?patient_id='+data[0]);
		//alert( data[0] +"'s salary is: "+ data[ 5 ] );
});
  
   $('#patient_detail_table tbody').on( 'click', '#print', function () {
		var table = $('#patient_detail_table').DataTable();
        var data = table.row( $(this).parents('tr') ).data();
        window.open('print_form.php?id='+data[0]);
		//alert( data[0] +"'s salary is: "+ data[ 5 ] );
});

/*$('.patient_detail_table').DataTable( {
"processing": true,
"serverSide": true,
"ajax": {
	url: "data_table_ajax.php",	
	dataSrc: ""
},
"columns" : [
			 {"data":"receipt_id"},
			 {"data":"patient_id"},
			 {"data":"name"},
			 {"data":"visit_id"},
			 {"data":"amount"},
			 {"data":"date"},
			 {"data":"status"}
									 ],
pageLength: 10,	
dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
			]
}); // end of datatable
*/


        }); // end of document.ready
    </script>

</body>
</html>