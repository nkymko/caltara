<?php

include 'config/connect.inc.php';

$username = "";

if (isset($_POST['login'])) {
	
	$username = mysqli_real_escape_string($conn, $_POST['username']);
	$password = mysqli_real_escape_string($conn, $_POST['password']);
	
	$username_check = "SELECT * FROM users WHERE username = '$username'";
	$result = mysqli_query($conn, $username_check);

	//username verify
	if( mysqli_num_rows($result) === 1){
		//password verify

		$fetch = mysqli_fetch_assoc($result);
		if(password_verify($password, $fetch["password"])) {
			//if password true
			$_SESSION['username'] = $username; //set session
			header("Location: homePage.php");
			exit;
		}
	}

	$error = true;
}

?>