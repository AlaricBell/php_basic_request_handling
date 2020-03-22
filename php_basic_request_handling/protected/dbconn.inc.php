<?php 
	require_once 'config.php';
	
	try {
		$conn = new PDO(DB_TYPE.':host='.DB_HOST.';dbname='.DB_NAME.';charset='.DB_CHARSET.';',DB_USER, DB_PASS);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	} catch (Exception $e) {
		header('Location: ../index.php?error=connection');
		exit();
	}
?>