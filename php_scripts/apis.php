<?php

	// include "error_reporting.php";

	$path = "../../uploads/";				// Path used to upload files
	$dwnPath = "uploads/";					// Path used to download files

	function signin($req){

		global $conn2;

		$username = $req['username'];
		$pass = $req['password'];

		$statement = $conn2->prepare('SELECT * FROM user_auth WHERE username=? AND pass=?');

		$statement->bindValue(1, $username);
		$statement->bindValue(2, $pass);

		$statement->execute();
		$count = $statement->rowCount();

		if($statement->rowCount()>0){
			$row = $statement->fetch(PDO::FETCH_ASSOC);
			$_SESSION['user_id'] = $row['user_id'];
			$_SESSION['username'] = $row['username'];
			header("Location:index.php");
		}else{
			return "Invalid username or password";
		}

	}



?>