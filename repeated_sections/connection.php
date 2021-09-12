<?php
$conn = mysqli_connect("localhost", "root","","cms_db"); 
// Establishing Connection with Server..

//$db = mysqli_select_db("cl28-a-moodl-smn", $conn); 
// Selecting Database

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
//echo "Connected successfully";

?>

