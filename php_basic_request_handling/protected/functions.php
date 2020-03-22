<?php 
	// -------------------------- PAGINATION -------------------------------------
	function get_workers_count() {
		require 'dbconn.inc.php';
		try {
			$sql = "SELECT COUNT(id) FROM Workers;";
			$result = $conn->query($sql);
			$count = $result->fetchColumn(0);
		} catch (Exception $e) {
			header('Location: ../index.php?error=badquery');
			exit();
		}
		return $count;
	}

	// -------------------------- ADD WORKER-------------------------------------
	function add_worker($name, $taj, $nation) {
		require 'dbconn.inc.php';

		try {
			$sql = "INSERT INTO Worker (name, taj, nation) VALUE (?, ?, ?);";
			$stmt = $conn->prepare($sql);
			$stmt->bindParam(1, $name, PDO::PARAM_STR);
			$stmt->bindParam(2, $taj, PDO::PARAM_INT);
			$stmt->bindParam(3, $nation, PDO::PARAM_STR);
			$stmt->execute();
		} catch (Exception $e) {
			return false;
		}
		return true;
	}

	// -------------------------- ADD USER -------------------------------------
	function add_user($username, $email, $pwd) {
		require 'dbconn.inc.php';
		try {
			$hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
			$sql = "INSERT INTO User (username, email, password) VALUE (?, ?, ?);";
			$stmt = $conn->prepare($sql);
			$stmt->bindParam(1, $username, PDO::PARAM_STR);
			$stmt->bindParam(2, $email, PDO::PARAM_STR);
			$stmt->bindParam(3, $hashedPwd, PDO::PARAM_STR);
			$stmt->execute();
		} catch (Exception $e) {
			return false;
		}
		return true;
	}
	// -------------------------- GET USER -------------------------------------
	function get_user_by_username($username) {
		require 'dbconn.inc.php';
		$stmt = $conn->prepare("SELECT * FROM User WHERE username = ?");
		$stmt->bindParam(1, $username, PDO::PARAM_STR);
		$stmt->execute();
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}
	// -------------------------- GET WORKER -------------------------------------
	function get_worker_by_taj($taj) {
		require 'dbconn.inc.php';
		$stmt = $conn->prepare("SELECT * FROM Worker WHERE taj = ?");
		$stmt->bindParam(1, $taj, PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}
	// -------------------------- GET WORKERS -------------------------------------
	function get_workers() {
		require 'dbconn.inc.php';
		$stmt = $conn->query("SELECT * FROM Worker");
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	// -------------------------- DELETE WORKER -------------------------------------
	function delete_worker($taj) {
		require 'dbconn.inc.php';
			
		try {
			$stmt = $conn->prepare("DELETE FROM Worker WHERE taj = ?");
			$stmt->bindParam(1, $taj, PDO::PARAM_INT);
			$stmt->execute();
		} catch (Exception $e) {
			return false;
		}
		return true;
	}

	// -------------------------- UPDATE WORKER -------------------------------------
	function update_worker($name, $taj, $nation, $id) {
		require 'dbconn.inc.php';

		try {
			$stmt = $conn->prepare("UPDATE Worker SET name = ?, taj = ?, nation = ? WHERE id = ?");
			$stmt->bindParam(1, $name, PDO::PARAM_STR);
			$stmt->bindParam(2, $taj, PDO::PARAM_INT);
			$stmt->bindParam(3, $nation, PDO::PARAM_STR);
			$stmt->bindParam(4, $id, PDO::PARAM_INT);
			$stmt->execute();
		} catch (Exception $e) {
			return false;
		}
		return true;
	}
?>