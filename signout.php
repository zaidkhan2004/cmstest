<?php
require_once "php_scripts/session.php";
	session_destroy();
	header("Location:signin.php");
?>