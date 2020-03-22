<?php 
	if (isset($_POST['add-submit'])) {
		require_once 'functions.php';

		// Gets the data from the POST request and avoids harmful data in input fields.
		$wname = trim(filter_input(INPUT_POST, 'wname', FILTER_SANITIZE_STRING));
		$taj = trim(filter_input(INPUT_POST, 'taj', FILTER_SANITIZE_NUMBER_INT));
		$nation = trim(filter_input(INPUT_POST, 'nation', FILTER_SANITIZE_STRING));

		if (empty($wname) || empty($taj) || empty($nation)) {
			header('Location: ../index.php?error=emptyfields&state=add&wname='.$wname.'&taj='.$taj.'&nation='.$nation);
			exit();
		}
		else if(strlen((string)$taj) != 9) {
			header('Location: ../index.php?error=tajlngth&state=add&wname='.$wname.'&taj='.$taj.'&nation='.$nation);
			exit();
		}
		else {
			if (get_worker_by_taj($taj)) {
				header('Location: ../index.php?error=workerexists&state=add');
				exit();
			}
			else {
				if (add_worker($wname, $taj, $nation)) {
					header('Location: ../index.php?success=add&state=list');
					exit();
				}
				else {
					header('Location: ../index.php?error=badquery&state=add');
					exit();
				}
			}
		}
	}
	else {
		header('Location: ../index.php');
	}
?>