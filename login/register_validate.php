<?php
	session_start();
	require "../config/config.php";

	if ( !isset($_POST['email'])
		|| !isset($_POST['username'])
		|| !isset($_POST['password'])
		|| empty($_POST['email'])
		|| empty($_POST['username'])
		|| empty($_POST['password']) ) {
		$response = "Please enter email, username, and password.";
	}
	else {
		$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
		if ($mysqli->connect_errno) {
			$response = $mysqli->connect_error;
		}
		else {
			$mysqli->set_charset("utf8");
			$checkStmt = $mysqli->prepare(
				'SELECT * FROM users WHERE email = ? || username = ?;');
			$checkStmt->bind_param('ss', $_POST['email'], $_POST['username']);
			$executed = $checkStmt->execute();
			if(!$executed) {
				$response = $mysqli->error;
				$checkStmt->close();
			}
			else {
				$result = $checkStmt->get_result();
				$checkStmt->close();
				if ($result->num_rows > 0) {
					$response = "Username or email already taken.";
				}
				else {
					$passwordInput = hash("sha256", $_POST['password']);
					$stmt = $mysqli->prepare(
						'INSERT INTO users(email, username, pwd) VALUES(?,?,?);');
					$stmt->bind_param('sss',
						$_POST['email'], $_POST['username'], $passwordInput);
					$executed = $stmt->execute();
					if(!$executed) {
						$response = $mysqli->error;
					}
					$result2 = $stmt->get_result();
					$stmt->close();
					//get user_id
          $sql_user = 'SELECT id FROM users WHERE username LIKE \'' . $_POST['username'] . '\';';
          $result_user = $mysqli->query($sql_user);
          if ($result_user == false) {
              // echo $mysqli->error;
              $mysqli->close();
              exit();
          }
					//store user_id, username, isLoggedIn flag
					$_SESSION["user_id"] = $result_user->fetch_assoc()['id'];
					$_SESSION["username"] = $_POST["username"];
					$_SESSION["loggedIn"] = true;
					$response = "";
				}
			}
		}
		$mysqli->close();
	}
	echo $response;
?>