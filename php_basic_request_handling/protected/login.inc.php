<?php 
	if (isset($_POST['login-submit'])) {
		require 'functions.php';

		 $username = trim(filter_input(INPUT_POST, 'uname', FILTER_SANITIZE_STRING));
		 $pwd = trim(filter_input(INPUT_POST, 'pwd', FILTER_SANITIZE_STRING));

		 if (empty($username || empty($pwd))) {
		 	header('Location: ../index.php?error=emptyfields');
		 	exit();
		 }
		 else {
	 		if ($user = get_user_by_username($username)) {
	 			if (password_verify($pwd, $user['password'])) {
	 				session_start();
	 				$_SESSION['username'] = $user['username'];
	 				$_SESSION['email'] = $user['email'];
	 				header('Location: ../index.php?success=login&state=list');
		 			exit();
	 			}
	 			else {
	 				header('Location: ../index.php?error=wrongpwd');
		 			exit();
	 			}
	 		}
	 		else {
 				header('Location: ../index.php?error=wronguname');
		 		exit();
	 		}
		 }
	}
	else {
		header('Location: ../index.php');
	}
?>