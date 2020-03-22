<?php 
if (isset($_POST['update-submit'])) {
	require 'functions.php';

	$wname = trim(filter_input(INPUT_POST, 'wname', FILTER_SANITIZE_STRING));
	$taj = trim(filter_input(INPUT_POST, 'taj', FILTER_SANITIZE_NUMBER_INT));
	$nation = trim(filter_input(INPUT_POST, 'nation', FILTER_SANITIZE_STRING));
	$id = trim(filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT));
	$origin = trim(filter_input(INPUT_POST, 'origin', FILTER_SANITIZE_NUMBER_INT));
	
	if (empty($wname) || empty($taj) || empty($nation)) {
		header('Location: ../index.php?error=emptyfields&state=edit&taj='.$origin);
		exit();
	}
	if (strlen((string)$taj) != 9) {
		header('Location: ../index.php?error=tajlngth&state=edit&taj='.$origin);
		exit();
	}
	else if (update_worker($wname, $taj, $nation, $id)) {
		header('Location: ../index.php?success=update&state=list');
		exit();
	}
	else {
		header('Location: ../index.php?error=update&state=list');
		exit();
	}
}
else {
	header('Location: ../index.php?state=list');
	exit();
}
?>
