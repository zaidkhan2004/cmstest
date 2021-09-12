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

$opt = $_POST['opt'];

$entryby = $username;

date_default_timezone_set("Asia/Karachi");

$current_date = date('Y-m-d');


if($opt=='patient'){

$patient_id=$_POST['patient_id'];
$name=$_POST['name'];
$gender=$_POST['gender'];
$age=$_POST['age'];
$blood_group=$_POST['blood_group'];
$merital_status=$_POST['merital_status'];
$mobile_no=$_POST['mobile_no'];
$address=$_POST['address'];
$email=$_POST['email'];
$occupation=$_POST['occupation'];
$reg_date=$_POST['reg_date'];
$old_patient_no=$_POST['old_patient_no'];




$sql="SELECT COUNT(patient_id) AS CNT FROM patient WHERE patient_id='$patient_id'";
$result = mysqli_query($conn, $sql);

while($row = mysqli_fetch_assoc($result)) {
$count_patient_no =  $row['CNT'];
  }

if($count_patient_no > 0){
echo "Patient No Already Exists. Please Enter Different Patient No.";	
} else {

$sql = "INSERT INTO patient (patient_id,name,gender,age,blood_group,merital_status,address,mobile_no,email,occupation,reg_date,old_patient_no) VALUES ('$patient_id','$name','$gender',$age,'$blood_group','$merital_status','$address','$mobile_no','$email','$occupation','$reg_date','$old_patient_no')";

if (mysqli_query($conn, $sql)) {
    echo "Patient Data Inserted Successfully";
}
else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    // $("#output_div").html(data);
}


} // end of else check patient_id

mysqli_close($conn); // Connection Closed

}
// end of if($opt=='patient')


else if($opt=='update_patients'){

$patient_id=$_POST['patient_id'];
$name=$_POST['name'];
$gender=$_POST['gender'];
$age=$_POST['age'];
$blood_group=$_POST['blood_group'];
$mobile_no=$_POST['mobile_no'];
$address=$_POST['address'];
$email=$_POST['email'];
$occupation=$_POST['occupation'];
$reg_date=$_POST['reg_date'];
$old_patient_no=$_POST['old_patient_no'];


$sql2 = "update patient set patient_id=$patient_id,name='$name', address='$address', mobile_no='$mobile_no',age=$age where patient_id='$patient_id'";

if (mysqli_query($conn, $sql2)) {
    echo "Data has been Updated Successuflly";
	//echo $sql2;
}
else {
    echo "Error: " . $sql2 . "<br>" . mysqli_error($conn);
    // $("#output_div").html(data);
}




mysqli_close($conn); // Connection Closed
}
// end of if($opt=='update_patient')



else if($opt=='delete_patients'){

$patient_id=$_POST['patient_id'];


$sql2 = "delete from patient where patient_id='$patient_id'";

if (mysqli_query($conn, $sql2)) {
    echo "Patient No " . $patient_id . " Has Been Deleted Successuflly";
	//echo $sql2;
}
else {
    echo "Error: " . $sql2 . "<br>" . mysqli_error($conn);
    // $("#output_div").html(data);
}


mysqli_close($conn); // Connection Closed
}
// end of if($opt=='delete_patients')




else if($opt=='get_patient_details') {
	
$patient_id=$_POST['patient_id'];


echo' <input type="hidden" id="challan_no" value="'.$patient_id.'">';
                                           $sql= "select * from patient where patient_id like '%$patient_id%';";
                                            $result = mysqli_query($conn, $sql);

                                            if (mysqli_num_rows($result) > 0) {
                                            // output data of each row
                                            $counter = 1;

                                            echo '<table border="1" cellpadding="5" class="patient_detail_table">
                                                <tr>
						    						<td><strong>S.No</strong></td>
                                                    <td><strong>Patient No</strong></td>
                                                    <td><strong>Name</strong></td>
													<td><strong>Address</strong></td>
                                                    <td><strong>Mobile No</strong></td>
                                                    <td><strong>Age</strong></td>
						                            <td>&nbsp;</td>
													<td>&nbsp;</td>
													<td>&nbsp;</td>';
													
                                                echo '</tr>';
                                                while($row = mysqli_fetch_assoc($result)) {

                                            
                         echo '<tr id="tr'.$counter.'">
						 <td>'.$counter.'</td>
                         <td><input type="text" id="patient_id'.$counter.'" value="'.$row['patient_id'].'" style="width:70px" disabled></td>
						 <td><input type="text" id="name'.$counter.'" value="'.$row['name'].'" style="width:200px" disabled ></td>
                         <td><input type="text" id="address'.$counter.'" value="'.$row['address'].'" style="width:200px" disabled></td>
						 <td><input type="text" id="mobile_no'.$counter.'" value="'.$row['mobile_no'].'" style="width:100px" disabled></td>
						 <td><input type="text" id="age'.$counter.'" value="'.$row['age'].'" style="width:50px" disabled></td>
						 <td><input type="button" id="edit'.$counter.'" value="Edit" class="edit_btn"><input type="button" id="save'.$counter.'" value="Save" class="save_btn" style="display:none"></td>
						 <td><input type="button" id="delete'.$counter.'" value="Delete" class="delete_btn"></td>
						  <td> <div id="print_link"><a href="print_form.php?id='.$row['patient_id'].'" target="_blank"> Print Form </a></div> </td>';
                                               echo'</tr>';
                                                $counter++;
                                                } // end of while
                                                echo '</table>	<br>	';
                                            } else {
                                            // do nothing
                                            }
                                            

mysqli_close($conn); // Connection Closed

	
} // end of if get_patient_details



else if($opt=='get_patient_details_name') {
	
$patient_name=$_POST['patient_name'];


                                           $sql= "select * from patient where name like '%$patient_name%';";
                                            $result = mysqli_query($conn, $sql);

                                            if (mysqli_num_rows($result) > 0) {
                                            // output data of each row
                                            $counter = 1;

                                            echo '<table border="1" cellpadding="5" class="patient_detail_table">
                                                <tr>
						    						<td><strong>S.No</strong></td>
                                                    <td><strong>Patient No</strong></td>
                                                    <td><strong>Name</strong></td>
													<td><strong>Address</strong></td>
                                                    <td><strong>Mobile No</strong></td>
                                                    <td><strong>Age</strong></td>
						                            <td>&nbsp;</td>
													<td>&nbsp;</td>
													<td>&nbsp;</td>';
													
                                                echo '</tr>';
                                                while($row = mysqli_fetch_assoc($result)) {

                         echo '<tr id="tr'.$counter.'">
						 <td>'.$counter.'</td>
                         <td><input type="text" id="patient_id'.$counter.'" value="'.$row['patient_id'].'" style="width:70px" disabled></td>
						 <td><input type="text" id="name'.$counter.'" value="'.$row['name'].'" style="width:200px" disabled ></td>
                         <td><input type="text" id="address'.$counter.'" value="'.$row['address'].'" style="width:200px" disabled></td>
						 <td><input type="text" id="mobile_no'.$counter.'" value="'.$row['mobile_no'].'" style="width:100px" disabled></td>
						 <td><input type="text" id="age'.$counter.'" value="'.$row['age'].'" style="width:50px" disabled></td>
						 <td><input type="button" id="edit'.$counter.'" value="Edit" class="edit_btn"><input type="button" id="save'.$counter.'" value="Save" class="save_btn" style="display:none"></td>
						 <td><input type="button" id="delete'.$counter.'" value="Delete" class="delete_btn"></td>
						  <td> <div id="print_link"><a href="print_form.php?id='.$row['patient_id'].'" target="_blank"> Print Form </a> </td>';
                                               echo'</tr>';
                                                $counter++;
                                                } // end of while
                                                echo '</table>	<br>	';
                                            } else {
                                            // do nothing
                                            }
                                            

mysqli_close($conn); // Connection Closed

	
} // end of if get_patient_details_name




else if($opt=='get_patient_details_mobile') {
	
$patient_mobile=$_POST['patient_mobile'];


                                           $sql= "select * from patient where mobile_no = '$patient_mobile';";
                                            $result = mysqli_query($conn, $sql);

                                            if (mysqli_num_rows($result) > 0) {
                                            // output data of each row
                                            $counter = 1;

                                            echo '<table border="1" cellpadding="5" class="patient_detail_table">
                                                <tr>
						    						<td><strong>S.No</strong></td>
                                                    <td><strong>Patient No</strong></td>
                                                    <td><strong>Name</strong></td>
													<td><strong>Address</strong></td>
                                                    <td><strong>Mobile No</strong></td>
                                                    <td><strong>Age</strong></td>
						                            <td>&nbsp;</td>
													<td>&nbsp;</td>
													<td>&nbsp;</td>';
													
                                                echo '</tr>';
                                                while($row = mysqli_fetch_assoc($result)) {

                         echo '<tr id="tr'.$counter.'">
						 <td>'.$counter.'</td>
                         <td><input type="text" id="patient_id'.$counter.'" value="'.$row['patient_id'].'" style="width:70px" disabled></td>
						 <td><input type="text" id="name'.$counter.'" value="'.$row['name'].'" style="width:200px" disabled ></td>
                         <td><input type="text" id="address'.$counter.'" value="'.$row['address'].'" style="width:200px" disabled></td>
						 <td><input type="text" id="mobile_no'.$counter.'" value="'.$row['mobile_no'].'" style="width:100px" disabled></td>
						 <td><input type="text" id="age'.$counter.'" value="'.$row['age'].'" style="width:50px" disabled></td>
						 <td><input type="button" id="edit'.$counter.'" value="Edit" class="edit_btn"><input type="button" id="save'.$counter.'" value="Save" class="save_btn" style="display:none"></td>
						  <td><input type="button" id="delete'.$counter.'" value="Delete" class="delete_btn"></td>
						  <td> <div id="print_link"><a href="print_form.php?id='.$row['patient_id'].'" target="_blank"> Print Form </a> </td>';
                                               echo'</tr>';
                                                $counter++;
                                                } // end of while
                                                echo '</table>	<br>	';
                                            } else {
                                            // do nothing
                                            }
                                            

mysqli_close($conn); // Connection Closed

	
} // end of if get_patient_details_mobile





else if($opt=='add_new_appointment'){


$patient_id=$_POST['patient_id'];
//$consultant=$_POST['consultant'];
$date=$_POST['date'];
$time_slot=$_POST['time_slot'];



//$sql = "INSERT INTO appointment  (patient_id,consultant_id,date,time_slot) VALUES ($patient_id,$consultant,'$date','$time_slot')";
$sql = "INSERT INTO appointment  (patient_id,date,time_slot) VALUES ($patient_id,'$date','$time_slot')";

if (mysqli_query($conn, $sql)) {
    echo "Appointment Added Successfully";
}
else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    // $("#output_div").html(data);
}




mysqli_close($conn); // Connection Closed

}
// end of if($opt=='add_appointment')


else if($opt=='update_appointment'){
$appointment_id=$_POST['appointment_id'];
$patient_id=$_POST['patient_id'];
//$consultant=$_POST['consultant'];
$date=$_POST['date'];
$time_slot=$_POST['time_slot'];


/*$sql2 = "update appointment set patient_id=$patient_id,consultant_id=$consultant, date='$date', time_slot='$time_slot' where appointment_id=$appointment_id";*/
$sql2 = "update appointment set patient_id=$patient_id, date='$date', time_slot='$time_slot' where appointment_id=$appointment_id";

if (mysqli_query($conn, $sql2)) {
    echo "Data has been Updated Successuflly";
	//echo $sql2;
}
else {
    echo "Error: " . $sql2 . "<br>" . mysqli_error($conn);
    // $("#output_div").html(data);
}




mysqli_close($conn); // Connection Closed
}
// end of if($opt=='update_appointment')



else if($opt=='delete_appointment'){

$appointment_id=$_POST['appointment_id'];


$sql2 = "delete from appointment where appointment_id='$appointment_id'";

if (mysqli_query($conn, $sql2)) {
    echo "Appointment No " . $appointment_id . " Has Been Deleted Successuflly";
	//echo $sql2;
}
else {
    echo "Error: " . $sql2 . "<br>" . mysqli_error($conn);
    // $("#output_div").html(data);
}


mysqli_close($conn); // Connection Closed
}
// end of if($opt=='delete_appointment')




else if($opt=='load_time_slots'){

$appointment_date=$_POST['appointment_date'];

$timestamp = strtotime($appointment_date);

$day = date('w', $timestamp);
 
 

echo '<option value="0" disabled selected>Select Time Slot</option>';

$sql= "select a.time_slot_id, t.start_from, t.end_at from time_slot t, appointment_slot a where a.day_id = $day and t.time_slot_id = a.time_slot_id ;";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
while($row = mysqli_fetch_assoc($result)) { 

$time_slot_id = $row['time_slot_id'];

$sql2= "select count(date) cnt from appointment where date='$appointment_date' and time_slot = $time_slot_id ;";
$result2 = mysqli_query($conn, $sql2);

if (mysqli_num_rows($result2) > 0) {
while($row2 = mysqli_fetch_assoc($result2)) { 
$count = $row2['cnt'];
 } // end of while
} else {
// do nothing
}

if ($count > 3) {
	echo'<option value="'.$row['time_slot_id'].'" disabled> '.$row['start_from'].' - '.$row['end_at'].' (Slot Full) </option>';
	}
	else {
echo'<option value="'.$row['time_slot_id'].'"> '.$row['start_from'].' - '.$row['end_at'].' </option>';
	} // end of else
 } // end of while
                                               
} else {
// do nothing
}
						                   
}// end of if($opt=='load_time_slots')





else if($opt=='add_new_visit'){


$patient_id=$_POST['patient_id'];
$visit_date=$_POST['visit_date'];
$visit_start_time=$_POST['visit_start_time'];



$sql = "INSERT INTO visit  (patient_id,visit_date,visit_start_time) VALUES ($patient_id,'$visit_date','$visit_start_time')";

if (mysqli_query($conn, $sql)) {
    echo "Visit Created Successfully";
}
else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    // $("#output_div").html(data);
}




mysqli_close($conn); // Connection Closed

}
// end of if($opt=='add_visit')



else if($opt=='add_new_consultation'){

$visit_id = $_POST['visit_id'];
$patient_id = $_POST['patient_id'];
$consultant_id = $_POST['consultant'];
$consultation_start_time = $_POST['consultation_start_time'];
$consultant_remarks = $_POST['consultant_remarks'];
$discount = $_POST['discount'];
$consultation_charges_applied = $_POST['consultation_charges'];
$diseases = $_POST['diseases'];
$drugs = $_POST['drugs'];
$points = $_POST['points'];
$no_of_points = sizeof($points);

$current_time =  date('h:i:s');


$sql = "INSERT INTO consultation (visit_id,consultant_id,start_time,end_time,consultant_remarks) VALUES ($visit_id,$consultant_id,'$consultation_start_time','$current_time','$consultant_remarks')";

if (mysqli_query($conn, $sql)) {
    //echo "Patient Data Inserted Successfully";
}
else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    // $("#output_div").html(data);
} 



if(isset($diseases)){

for ($i=0; $i<sizeof($diseases);$i++) {
$sql = "INSERT INTO visit_diseases (visit_id,disease_id) VALUES ($visit_id,$diseases[$i])";

if (mysqli_query($conn, $sql)) {
    //echo "Patient Data Inserted Successfully";
}
else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
} // end of else
} // end of for loop

} // end of if(isset($_POST['diseases']))

if(isset($drugs)){
for ($i=0; $i<sizeof($drugs);$i++) {
$sql = "INSERT INTO visit_drugs (visit_id,drug_id) VALUES ($visit_id,$drugs[$i])";

if (mysqli_query($conn, $sql)) {
    //echo "Patient Data Inserted Successfully";
}
else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
} // end of else
} // end of for loop

}  // end of if(isset($_POST['drugs']))



if(isset($points)){
for ($i=0; $i<sizeof($points);$i++) { 
$sql = "INSERT INTO visit_points (visit_id,point_id) VALUES ($visit_id,$points[$i])";

if (mysqli_query($conn, $sql)) {
    //echo "Patient Data Inserted Successfully";
}
else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
} // end of else
} // end of for loop

}  // end of if(isset($_POST['points']))


$sql = "update visit set discount_percentage = $discount, c_end_time = '$current_time' where visit_id = $visit_id;";
if (mysqli_query($conn, $sql)) {
    //echo "Discount has been applied successfully";
}
else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
} // end of else


$sql1="select charges from fee where fee_id=1";
$result1 = mysqli_query($conn, $sql1);

while($row1 = mysqli_fetch_assoc($result1)) {
$consultation_charges =  $row1['charges'];
 }

$sql2="select charges from fee where fee_id=2";
$result2 = mysqli_query($conn, $sql2);

while($row2 = mysqli_fetch_assoc($result2)) {
$per_cup =  $row2['charges'];
 }

$sql3="select discount_percentage from visit where visit_id=$visit_id";
$result3 = mysqli_query($conn, $sql3);

while($row3 = mysqli_fetch_assoc($result3)) {
$discount_percentage =  $row3['discount_percentage'];
 }
 
if($consultation_charges_applied == 0) {
	 $consultation_charges = 0;
}

$amount = ($no_of_points*($per_cup))+$consultation_charges;

$cups_charges =  $amount - $consultation_charges;

$discount_amount = ($cups_charges*($discount_percentage/100));

$amount_after_discount = $amount - $discount_amount;


/*echo "Amount: " . $amount;

echo "cups_charges: " . $cups_charges;

echo "discount_amount: " . $discount_amount;

echo "after discount: " . $amount_after_discount;*/


$sql = "INSERT INTO receipts (visit_id,patient_id,date,no_of_cups,consultation_charges,cups_charges,amount,discount_amount) VALUES ($visit_id,$patient_id,'$current_date',$no_of_points,$consultation_charges,$cups_charges,$amount_after_discount,$discount_amount)";

if (mysqli_query($conn, $sql)) {
    //echo "Patient Data Inserted Successfully";
}
else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
} // end of else



mysqli_close($conn); // Connection Closed


echo "Consultation Data Submitted Successfully!";




}  // end of if($opt=='add_new_consultation')





else if($opt=='add_new_treatment'){

$visit_id = $_POST['visit_id'];
$patient_id = $_POST['patient_id'];
$incision_by = $_POST['incision_by'];
$cupping_by = $_POST['cupping_by'];
$bandage_by = $_POST['bandage_by'];
$treatment_start_time = $_POST['treatment_start_time'];
$cups_used = $_POST['cups_used'];
$cups_wasted = $_POST['cups_wasted'];
$blades_used = $_POST['blades_used'];
$quantity = $_POST['quantity'];

$current_time =  date('h:i:s');

$sql = "INSERT INTO treatment (visit_id,incision_by,cupping_by,bandage_by,start_time,end_time,cups_used,cups_wasted,blades_used) VALUES ($visit_id,$incision_by,$cupping_by,$bandage_by,'$treatment_start_time','$current_time',$cups_used,$cups_wasted,$blades_used)";

if (mysqli_query($conn, $sql)) {
    //echo "Patient Data Inserted Successfully";
}
else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    // $("#output_div").html(data);
} 



if(isset($quantity)){
for ($i=0; $i<sizeof($quantity);$i++) { 
//echo $quantity[$i];
 
$temp = explode (",", $quantity[$i]);

$point_id = $temp[0];
$blood_quantity = $temp[1];

$sql = "update visit_points set blood_quantity = '$blood_quantity' where visit_id = $visit_id and point_id = $point_id";

if (mysqli_query($conn, $sql)) {
    //echo "Patient Datap Inserted Successfully";
}
else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
} // end of else
} // end of for loop

}  // end of if(isset($_POST['quantity']))



$sql = "update visit set visit_end_time = '$current_time' where visit_id = $visit_id";
if (mysqli_query($conn, $sql)) {
    //echo "Patient Datap Inserted Successfully";
}
else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
} // end of else



mysqli_close($conn); // Connection Closed


echo "Treatment Data Submitted Successfully!";



}  // end of if($opt=='add_new_treatment')



else if($opt=='update_receipt_status'){

$receipt_id = $_POST['receipt_id'];
$status = $_POST['status'];

$sql = "update receipts set status = '$status' where receipt_id = $receipt_id";
if (mysqli_query($conn, $sql)) {
    echo "Receipt Status Updated Successfully";
}
else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
} // end of else


} // end of if($opt=='update_receipt_status')




else if($opt=='experience_rating'){

$visit_id = $_POST['visit_id'];
$rating = $_POST['rating'];

$sql = "update visit set visit_feedback = $rating where visit_id = $visit_id";
if (mysqli_query($conn, $sql)) {
    echo "Thank You! Your Feedback Submitted Successfully";
}
else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
} // end of else


} // end of if($opt=='experience_rating')




else if($opt=='visit_discount'){

$visit_id = $_POST['visit_id'];
$discount = $_POST['discount'];
$amount = $_POST['amount'];
$cups_charges = $_POST['cups_charges'];


$sql = "update visit set discount_percentage = $discount where visit_id = $visit_id;";
if (mysqli_query($conn, $sql)) {
   // echo "Discount has been applied successfully";
}
else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
} // end of else


$sql3="select discount_percentage from visit where visit_id=$visit_id";
$result3 = mysqli_query($conn, $sql3);

while($row3 = mysqli_fetch_assoc($result3)) {
$discount_percentage =  $row3['discount_percentage'];
 }


$discount_amount = ($cups_charges*($discount_percentage/100));

$amount_after_discount = $amount - $discount_amount;



$sql = "update receipts set amount = $amount_after_discount, discount_amount = $discount_amount  where visit_id = $visit_id;";
if (mysqli_query($conn, $sql)) {
    echo "Discount has been applied successfully";
}
else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
} // end of else


} // end of if($opt=='visit_discount')

?>