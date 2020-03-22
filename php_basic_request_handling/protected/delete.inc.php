<?php 
if (isset($_POST['delete-submit'])) {
	require 'functions.php';

	$taj = trim(filter_input(INPUT_POST, 'taj', FILTER_SANITIZE_NUMBER_INT));
	
	if (delete_worker($taj)) {
		header('Location: ../index.php?success=delete&state=list');
		exit();
	}
	else {
		header('Location: ../index.php?error=delete&state=list');
		exit();
	}
}
else {
	header('Location: ../index.php?state=list');
	exit();
}
?>