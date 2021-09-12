<?php 
require_once("repeated_sections/connection.php");

date_default_timezone_set("Asia/Karachi");



$sql='SELECT P.NAME, P.MOBILE_NO, A.DATE, TS.START_FROM FROM patient P,appointment A,TIME_SLOT TS WHERE DATE(DATE_ADD(DATE, INTERVAL -1 DAY)) = (SELECT DATE_FORMAT(sysdate(), "%Y-%m-%d")) AND P.PATIENT_ID = A.PATIENT_ID AND TS.TIME_SLOT_ID = A.TIME_SLOT';
$result = mysqli_query($conn, $sql);

while($row = mysqli_fetch_assoc($result)) {
$name =  $row['NAME'];
$receiver =  $row['MOBILE_NO'];
$DATE =  $row['DATE'];
$START_FROM = $row['START_FROM'];

$START_FROM = date('h:i a',strtotime($START_FROM));

$username="alhijama";
$password = "******";

//$receiver = "923333079014";
$msgdata = "Assalam-o-Alaikum: \r\n Dear ".$name." \r\n You have an appointment for Hijama at ". $START_FROM ." on " . $DATE  . " You are requested to kindly arrive on time.";

echo $msgdata;

$url = "http://sms.iisol.pk/api/?username=alhijama&password=Saqiqasi1&receiver=$receiver&msgdata=$msgdata";
$xml = simplexml_load_file($url); 
//print_r($xml);
echo '<br>';
echo $xml->status;
echo '<br>';
echo $receiver;
//echo $receiver;
//echo $msgdata;
sleep(15);
  } // end of while


/*
<response>
<errorno>0</errorno>
<status>Message(s) accepted for delivery</status>
<sender>AL-Hijama</sender>
<msgdata>test sms for api implimentation</msgdata>

<receivers>
<receiver>923333079014</receiver>
</receivers>

</response>
*/


?>