<?php
	session_start();
	if(isset($_SESSION["loggedIn"]) && $_SESSION["loggedIn"]) {
		if(!isset($_GET['path']) || empty($_GET['path'])) {
			// echo "No path";
			exit();
		}
		require "config/config.php";
		$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
		if ($mysqli->connect_errno) {
			// echo $mysqli->connect_error;
			exit();
		}

		$mysqli->set_charset("utf8");

		//find clothes id
		$sql = "SELECT id FROM clothes WHERE filepath LIKE '" . $_GET['path'] . "';";

		$results = $mysqli->query($sql);
		if ( $results == false ) {
			// echo $mysqli->error;
			exit();
		}
		if ($results->num_rows == 0) {
      // echo "Couldn't find filepath";
      exit();
    }

    $id = $results->fetch_assoc()['id'];
    //use clothes id to delete entries in clothes_has_colors
    $sql2 = "DELETE FROM clothes_has_colors WHERE clothes_id = " . $id . ";";
		$results2 = $mysqli->query($sql2);
		if ($results2 == false) {
			// echo $mysqli->error;
			exit();
		}

    //delete clothes entry
    $sql3 = "DELETE FROM clothes WHERE id = " . $id . ";";
		$results3 = $mysqli->query($sql3);
		if ( $results3 == false ) {
			// echo $mysqli->error;
			exit();
		}
		$mysqli->close();

		//remove file from server
		unlink($_GET['path']);
	}
	else {
		header("Location: homepage.php");
	}
?>