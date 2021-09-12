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

 // end of while

$patient_no = $_GET['id'];


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        .export_detail_table td {
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
            portrait;
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

<body style="background:#FFF">


   
                      <div id="print_div">

                    
                                        <div id="patient_form" class="form-group">
 											<?php 
                                           $sql1= "select * from patient where patient_id = '$patient_no';";
                                            $result1 = mysqli_query($conn, $sql1);

                                            if (mysqli_num_rows($result1) > 0) {
                                            // output data of each row
                                            $counter = 1;

  echo'<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="4%">&nbsp;</td>
    <td width="30%">&nbsp;</td>
    <td width="2%">&nbsp;</td>
    <td width="60%"></td>
    <td width="4%">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><h3> Registration Form </h3></td>
    <td>&nbsp;</td>
	
	';
	 while($row1 = mysqli_fetch_assoc($result1)) {
		$temp_date = $row1['reg_date'] ;
		$reg_date = date("d-m-Y", strtotime($temp_date));
		
		if (empty($row1['old_patient_no'])) {
			$temp_patient_no =/* $row1['gender'] . '-' .*/ $row1['patient_id'];
			}
			else {
				$temp_patient_no = $row1['old_patient_no'];
				}
				
    echo '<td align="right" valign="bottom">Registration No: '.$temp_patient_no.' <br> Gender: '.$row1['gender'].' <br> Registration Date: '.$reg_date.'</td>';
	 } // end of while
    echo '<td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td valign="top">&nbsp;</td>
    <td valign="top"><table width="100%" border="2" cellspacing="0" cellpadding="0">
      <tr>
        <td width="70%" align="left" bgcolor="#CCCCCC"><strong>Disease</strong></td>
        <td width="15%" align="center" bgcolor="#CCCCCC"><strong>Yes</strong></td>
        <td width="15%" align="center" bgcolor="#CCCCCC"><strong>No</strong></td>
      </tr>
	  <tr>
        <td>Diabetes</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>Hypertension</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>Epilepsy</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>Hypercholesterolemia</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>HIV</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>Hepatitis</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>T.B</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>Arthritis</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>Osteoporosis</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>Anemia</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>Blood Thinning drug</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>Allergies</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>Dysmenorrhea</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>PCO</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>Menopause</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>Amenorrhea</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>Pregnancy</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
    </table>
      <br />
      <table width="100%" border="2" cellspacing="0" cellpadding="0">
        <tr>
          <td width="70%" align="left" bgcolor="#CCCCCC"><strong>Addiction</strong></td>
          <td width="15%" align="center" bgcolor="#CCCCCC"><strong>Yes</strong></td>
          <td width="15%" align="center" bgcolor="#CCCCCC"><strong>No</strong></td>
        </tr>
        <tr>
          <td>Smoking</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>Others</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
    </table>
    <br>
    <table width="100%" border="2" cellspacing="0" cellpadding="0">
      <tr>
        <td colspan="2" align="center" bgcolor="#CCCCCC"><strong>Drugs In Use</strong></td>
        </tr>
      <tr>
        <td width="50%">&nbsp;</td>
        <td width="50%">&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>


      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
    </table>
    <br />
    <table width="100%" border="2" cellspacing="0" cellpadding="0">
      <tr>
        <td align="center" bgcolor="#CCCCCC"><strong>History</strong></td>
        </tr>
      <tr>
        <td width="80%"><p><br />
          <strong>Points Repetition</strong> ______ <strong>Times</strong></p>
          <p><strong>Frequency</strong> ______ <strong>Days</strong></p>
          <p><br />
          </p></td>
        </tr>
    </table>
    <p>&nbsp;</p></td>
    <td>&nbsp;</td>
    <td valign="top">';
	
                                           $sql= "select * from patient where patient_id = '$patient_no' ;";
                                            $result = mysqli_query($conn, $sql);

                                            if (mysqli_num_rows($result) > 0) {
                                            // output data of each row
                                            $counter = 1;
	
	echo '<table width="100%" border="2" cellspacing="0" cellpadding="0">
      <tr>
        <td colspan="2" align="center" bgcolor="#CCCCCC"><strong>Basic Information</strong></td>
      </tr>';
	   while($row = mysqli_fetch_assoc($result)) {

     echo '<tr>
        <td width="30%">Name:</td>
        <td>'.$row['name'].'</td>
        </tr>
      <tr>
        <td>Age:</td>
        <td>'.$row['age'].'</td>
        </tr>
      <tr>
        <td>Contact:</td>
        <td>'.$row['mobile_no'].'</td>
        </tr>
      <tr>
        <td>Address:</td>
        <td>'.$row['address'].'</td>
      </tr>';
	   } // end of while
	   } else {
          // do nothing
               }
	   
    echo '</table>
      <br />
      <table width="100%" border="2" cellspacing="0" cellpadding="0">
        <tr>
        <td align="center" bgcolor="#CCCCCC"><strong>Diseases and Diagnosis</strong></td>
      </tr>
      <tr>
        <td width="80%" height="28" align="center">&nbsp;</td>
      </tr>
      <tr>
        <td height="28">&nbsp;</td>
      </tr>
      <tr>
        <td height="28">&nbsp;</td>
      </tr>
      <tr>
        <td height="28">&nbsp;</td>
      </tr>
      <tr>
        <td height="28">&nbsp;</td>
      </tr>
      <tr>
        <td height="28">&nbsp;</td>
      </tr>
      <tr>
        <td height="28">&nbsp;</td>
      </tr>
      <tr>
        <td height="28">&nbsp;</td>
      </tr>
      <tr>
        <td height="28">&nbsp;</td>
      </tr>
      <tr>
        <td height="28">&nbsp;</td>
      </tr>
      <tr>
        <td height="28">&nbsp;</td>
      </tr>
	  <tr>
        <td height="28">&nbsp;</td>
      </tr>
      </table>
    <br />
    <table width="100%" border="2" cellspacing="0" cellpadding="0">
      <tr>
        <td colspan="8" align="center" bgcolor="#CCCCCC"><strong>Recommended Treatment Points</strong></td>
        </tr>
      <tr>
        <td colspan="2" align="center"><strong>Front</strong></td>
        <td colspan="2" align="center"><strong>Back</strong></td>
        <td colspan="2" align="center"><strong>Head/Neck</strong></td>
        <td colspan="2" align="center"><strong>Arms/Legs</strong></td>
        </tr>
      <tr>
        <td width="12%">&nbsp;</td>
        <td width="12%">&nbsp;</td>
        <td width="12%">&nbsp;</td>
        <td width="12%">&nbsp;</td>
        <td width="12%">&nbsp;</td>
        <td width="12%">&nbsp;</td>
        <td width="12%">&nbsp;</td>
        <td width="12%">&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      </table>
    <br />
    <p>&nbsp;</p></td>
    <td valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>	<br>	';
                                            } else {
                                            // do nothing
                                            }
                                            

mysqli_close($conn); // Connection Closed
?>
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

window.print();


}); // end of document.ready
    </script>

</body>
</html>