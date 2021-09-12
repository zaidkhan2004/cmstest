<?php
########################################################
# Login information for the SMS Gateway
########################################################
if (isset($_POST['message'])){
$username   = "alhijama"; // your username
$password   = "bilal9999"; // your Password
$smsurl     = "http://sms.iisol.pk/api/?"; // change smsdomain.com to your provided

########################################################
# Functions used to send the SMS message
########################################################
    function httpRequest($url)
    {
        $args;
        $pattern = "/http...([0-9a-zA-Z-.]*).([0-9]*).(.*)/";
        preg_match($pattern,$url,$args);
        $in = "";
        $fp = fsockopen("$args[1]", $args[2], $errno, $errstr, 30);
        if (!$fp)
        {
           return("$errstr ($errno)");
        }
        else
        {
            $out = "GET /$args[3] HTTP/1.1\r\n";
            $out .= "Host: $args[1]:$args[2]\r\n";
            $out .= "User-agent: PHP Web SMS client\r\n";
            $out .= "Accept: */*\r\n";
            $out .= "Connection: Close\r\n\r\n";

            fwrite($fp, $out);
            while (!feof($fp))
            {
               $in.=fgets($fp, 128);
            }
        }
        fclose($fp);
        return($in);
    }
    
    function send_sms($phone, $msg, $debug=false)
    {
        global $username,$password,$smsurl;
        $url  = 'username='.$username;
        $url  .= '&password='.$password;
        $url  .= '&receiver='.urlencode($phone);
        $url  .= '&msgdata='.urlencode($msg);
        $urltouse =  $smsurl.$url;
        if($debug)
        {
            echo "Request: <br>$urltouse<br><br>";
        }
        //Open the URL to send the message
        $response = httpRequest($urltouse);
        if ($debug)
        {
            echo "Response: <br><pre>".
            str_replace(array("<",">"),array("&lt;","&gt;"),$response).
            "</pre><br>";
        }
        return($response);
    }
########################################################
# GET data from the form below
########################################################
$phonenum = $_POST['recipient'];
$message = $_POST['message'];
$debug = true;

send_sms($phonenum,$message,$debug);
}
?>
<html>
<body>
    <h1>My SMS form</h1>
    <form method=post action=''>
    <table border=0>
    <tr>
        <td>Recipient</td>
        <td><input type='text' name='recipient'></td>
    </tr>
    <tr>
        <td>Message</td>
        <td><textarea rows=4 cols=40 name='message'></textarea></td>
    </tr>
    <tr>
        <td> </td>
        <td><input type=submit name=submit value=Send></td>
    </tr>
    </table>
    </form>
</body>
</html>