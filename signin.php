<?php

require_once "php_scripts/session.php";

if(!empty($_SESSION['user_id'])){
	header("Location:index.php");
}

	$error = "";
	if(!empty($_POST) ){

		$requests_req = 1;

		// Checking all required fields
		$req_fields = array('username', 'password');
		foreach ($req_fields as $fields) {
		    if (!empty($_POST[$fields])) {
		    }else{
		    	$requests_req = 0;
				$error = "Please fill all fields";
		        break;
		    }
		}

		// Do this when all fields are filled
		if($requests_req){
			// echo "All fields are filled<br>";print_r($_POST);
			require_once "repeated_sections/configuration.php";
			 
			require_once "php_scripts/apis.php";
			// Will redirect to homepage is successfully logged in else return error.
			$error =  signin($_POST);
			
		}

	}else
		// echo "no request found";
?>


<!DOCTYPE html>
<html lang="en">
<head>

	<meta charset="UTF-8">
	<title>Login Page</title>

	<!-- Bootstrap -->
	<link href="assets/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- jQuery -->
    <script src="assets/vendors/jquery.min.js"></script>

	<!-- my css file -->
	<link rel="stylesheet" href="assets/css/style.css">

</head>
<body class='body_theme1'>

	<h1 class='fpages text-center'> Login Form</h1>

	<div class="container">
		<div class="row">
			<div class="login_box col-centered">
				
				<form method="post">
					<p class='fheading'>Log into your account</p>
					<div class="form-group">
						<input type="text" name='username' class="input_theme1 form-control"  placeholder="Username" required>
					</div>
					<div class="form-group">
						<input type="password" name='password' class="input_theme1 form-control"  placeholder="Password" required>
					</div>
					<div class="form-group">
						<input type="submit" class="input_theme1 form-control btn-theme1" value='Login'>
					</div>
					<p class='text-danger error_area'><?=$error?></p>
				</form>
		
				<div class="clearfix"></div>

			</div> <!-- login_box end -->
		
		</div> <!-- row end -->
	</div> <!-- container end --> 
	
</body>
</html>