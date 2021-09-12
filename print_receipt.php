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

$receipt_id = $_GET['receipt_id'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        #detail_table td {
            padding-left: 25px;
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
	  
echo '<table width="800px" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>&nbsp;</td>
    <td></td>
    <td>&nbsp;</td>
  </tr>
  
<tr>
<td>&nbsp;</td>
<td align="center" valign="bottom"><br> 
<img src="images/logo.png" /><br></td>
<td>&nbsp;</td>
</tr>


<tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
</tr>

<tr>
    <td valign="top"></td>
    <td valign="top">';
	
$sql = "select p.patient_id, p.name, p.gender,p.age,p.mobile_no,p.address,p.reg_date,p.old_patient_no, r.visit_id, r.receipt_id,r.no_of_cups,r.cups_charges,r.consultation_charges, r.amount,r.discount_amount, r.date from patient p, receipts r where r.receipt_id = $receipt_id and r.patient_id  =  p.patient_id;";
                                            $result = mysqli_query($conn, $sql);

                                            if (mysqli_num_rows($result) > 0) {
                                            // output data of each row
                                            $counter = 1;
	
	echo '<table width="100%" border="2" cellspacing="0" cellpadding="0">
      <tr>
        <td align="center" bgcolor="#CCCCCC"><strong>Payment Receipt (Patient Copy)</strong></td>
      </tr>';
	 
	 while($row = mysqli_fetch_assoc($result)) {
		$temp_date = $row['date'] ;
		$visit_date = date("d-m-Y", strtotime($temp_date));

     echo '
      <tr>
        <td>
        
		<table width="100%" border="0" cellspacing="0" cellpadding="0" id="detail_table">
          <tr>
            <td width="20%">&nbsp;</td>
            <td>&nbsp;</td>
            </tr>
          <tr>
            <td>Patient No:</td>
            <td>'.$row["patient_id"].'</td>
          </tr>
          <tr>
            <td width="20%"> Name:</td>
            <td>'.$row["name"].'</td>
            </tr>
          <tr>
            <td>Age:</td>
            <td>'.$row["age"].'</td>
            </tr>
          <tr>
            <td>Gender:</td>
			';
			if ($row["gender"] == 'M') {
				$gender = 'Male';
				} else {
					$gender = 'Female';
				} // end of else
            echo'<td>'.$gender.'</td>
            </tr>
          <tr>
            <td>Contact:</td>
            <td>'.$row["mobile_no"].'</td>
          </tr>
          <tr>
            <td>Visit Date:</td>
            <td>'.$visit_date.'</td>
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
            <td><strong>Payment Details</strong></td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td><strong>Description</strong></td>
            <td><strong>Fee</strong></td>
          </tr>
          <tr>
            <td>Cups: ('.$row["no_of_cups"].')</td>
            <td>'.$row["cups_charges"].'</td>
          </tr>
          <tr>
            <td>Consultation Fee:</td>
            <td>'.$row["consultation_charges"].'</td>
          </tr>
		  <tr>
            <td>Discount:</td>
            <td>-'.$row["discount_amount"].'</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td><strong>Total Charges:</strong></td>
            <td>'.$row["amount"].'</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
    
	<tr>
            <td colspan="2"><strong>Note:</strong> This is a computer generated receipt. No signature required.<br><br></td>
   </tr>
          </table>
		  
		  </td>
      </tr>
      
      ';
	   } // end of while

} else {
          // do nothing
               }
	   
    echo '</table>
</td>
    <td valign="top">&nbsp;</td>
  </tr>
  
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>';
                                            

?>
                                        </div>
                  
<div id="patient_form" class="form-group">

<?php 
	  
echo '<table width="800px" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>&nbsp;</td>
    <td></td>
    <td>&nbsp;</td>
  </tr>
  
<tr>
<td>&nbsp;</td>
<td align="center" valign="bottom"><br> 
<img src="images/logo.png" /><br></td>
<td>&nbsp;</td>
</tr>


<tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
</tr>

<tr>
    <td valign="top"></td>
    <td valign="top">';
	
$sql = "select p.patient_id, p.name, p.gender,p.age,p.mobile_no,p.address,p.reg_date,p.old_patient_no, r.visit_id, r.receipt_id,r.no_of_cups,r.cups_charges,r.consultation_charges, r.amount,r.discount_amount, r.date from patient p, receipts r where r.receipt_id = $receipt_id and r.patient_id  =  p.patient_id;";
                                            $result = mysqli_query($conn, $sql);

                                            if (mysqli_num_rows($result) > 0) {
                                            // output data of each row
                                            $counter = 1;
	
	echo '<table width="100%" border="2" cellspacing="0" cellpadding="0">
      <tr>
        <td align="center" bgcolor="#CCCCCC"><strong>Payment Receipt (Clinic Copy)</strong></td>
      </tr>';
	 
	 while($row = mysqli_fetch_assoc($result)) {
		$temp_date = $row['date'] ;
		$visit_date = date("d-m-Y", strtotime($temp_date));
     echo '
      <tr>
        <td>
        
		<table width="100%" border="0" cellspacing="0" cellpadding="0" id="detail_table">
          <tr>
            <td width="20%">&nbsp;</td>
            <td>&nbsp;</td>
            </tr>
          <tr>
            <td>Patient No:</td>
            <td>'.$row["patient_id"].'</td>
          </tr>
          <tr>
            <td width="20%"> Name:</td>
            <td>'.$row["name"].'</td>
            </tr>
          <tr>
            <td>Age:</td>
            <td>'.$row["age"].'</td>
            </tr>
          <tr>
            <td>Gender:</td>
			';
			if ($row["gender"] == 'M') {
				$gender = 'Male';
				} else {
					$gender = 'Female';
				} // end of else
            echo'<td>'.$gender.'</td>
            </tr>
          <tr>
            <td>Contact:</td>
            <td>'.$row["mobile_no"].'</td>
          </tr>
          <tr>
            <td>Visit Date:</td>
            <td>'.$visit_date.'</td>
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
            <td><strong>Payment Details</strong></td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td><strong>Description</strong></td>
            <td><strong>Fee</strong></td>
          </tr>
          <tr>
            <td>Cups: ('.$row["no_of_cups"].')</td>
            <td>'.$row["cups_charges"].'</td>
          </tr>
          <tr>
            <td>Consultation Fee:</td>
            <td>'.$row["consultation_charges"].'</td>
          </tr>
		  <tr>
            <td>Discount:</td>
            <td>-'.$row["discount_amount"].'</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td><strong>Total Charges:</strong></td>
            <td>'.$row["amount"].'</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
    
	<tr>
            <td colspan="2"><strong>Note:</strong> This is a computer generated receipt. No signature required.<br><br></td>
   </tr>
          </table>
		  
		  </td>
      </tr>
      
      ';
	   } // end of while

} else {
          // do nothing
               }
	   
    echo '</table>
</td>
    <td valign="top">&nbsp;</td>
  </tr>
  
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>';
                                            

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