<?php 
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


$username="alhijama";
$password = "Saqiqasi1";
$receiver = "923333079014";
$msgdata = "This is another test to check API through PHP";


$url = "http://sms.iisol.pk/api/?username=$username&password=$password&receiver=$receiver&msgdata=$msgdata";
$xml = simplexml_load_file($url);
//print_r($xml);
echo $xml->status;
?>