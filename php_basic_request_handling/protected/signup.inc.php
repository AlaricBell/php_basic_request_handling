<?php 
	// Checks if the user had access to this file through form input.
	if (isset($_POST['signup-submit'])) {
		require_once 'functions.php';

		// Gets the data from the POST request and avoids harmful data in input fields.
		$username = trim(filter_input(INPUT_POST, 'uname', FILTER_SANITIZE_STRING));
		$email = trim(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING));
		$pwd = trim(filter_input(INPUT_POST, 'pwd', FILTER_SANITIZE_STRING));
		$pwdConf = trim(filter_input(INPUT_POST, 'pwd-conf', FILTER_SANITIZE_STRING));

		// Validating input fields and sending the user back with error data if something is not correct.
		if (empty($username) || empty($email) || empty($pwd) || empty($pwdConf)) {
			header('Location: ../index.php?error=emptyfields&uname='.$username.'&email='.$email);
			exit();
		}
		else if(!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/", $username)) {
			header('Location: ../index.php?error=invalidfield');
			exit();
		}
		else if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			header('Location: ../index.php?error=invalidfield&uname='.$username);
			exit();
		}
		else if(!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
			header('Location: ../index.php?error=invalidfield&email='.$email);
			exit();
		}
		else if($pwd !== $pwdConf) {
			header('Location: ../index.php?error=pwdconf&uname='.$username.'&email='.$email);
			exit();
		}
		else {
			try {
				// Checks if the user already exists.
				if (get_user_by_username($username)) {
					header('Location: ../index.php?error=usernametaken&email='.$email);
					exit();
				}
				// Adds user to the database
				else {
					if (add_user($username, $email, $pwd)) {
						header('Location: ../index.php?success=signup');
						exit();
					}
					else {
						header('Location: ../index.php?error=badquery');
						exit();
					}
				}
			} catch (Exception $e) {
				header('Location: ../index.php?error=badquery');
				exit();
			}
		}
	}
	else {
		header('Location: ../index.php');
	}
?>