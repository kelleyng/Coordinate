<?php
	session_start();
	require "../config/config.php";

	if (!isset($_POST['current'])
		|| !isset($_POST['new'])
		|| empty($_POST['current'])
		|| empty($_POST['new']) ) {
		$response = "Current & new password cannot be empty";
	}
	else {
		$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
		if ($mysqli->connect_errno) {
			$response = $mysqli->connect_error;
		}
		else {
			$mysqli->set_charset("utf8");
			$currPw = hash("sha256", $_POST['current']);

			$checkStmt = $mysqli->prepare(
				'SELECT * FROM users WHERE id = ? AND pwd = ?;');
			$checkStmt->bind_param('is', $_SESSION['user_id'], $currPw);
			$executed = $checkStmt->execute();
			if(!$executed) {
				$response = $mysqli->error;
				$checkStmt->close();
			}
			else {
				$result = $checkStmt->get_result();
				$checkStmt->close();
				if ($result->num_rows == 0) {
					$response = "Incorrect current password.";
				}
				else {
          //change password
          $newPw = hash("sha256", $_POST['new']);
          $updateStmt = $mysqli->prepare(
						'UPDATE users SET pwd = ? WHERE id = ?;');
					$updateStmt->bind_param('si', $newPw, $_SESSION['user_id']);
					$executed = $updateStmt->execute();
					if(!$executed) {
						$response = $mysqli->error;
						$updateStmt->close();
					}
					$response = "";
				}
			}
		}
		$mysqli->close();
	}
	echo $response;
?>