<?php
	session_start();
	if(isset($_SESSION["loggedIn"]) && $_SESSION["loggedIn"]) {
		require "config/config.php";
		$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
		if ($mysqli->connect_errno) {
			// echo $mysqli->connect_error;
			exit();
		}

		$mysqli->set_charset("utf8");

		$sql = "SELECT filepath FROM clothes WHERE user_id LIKE '" . $_SESSION['user_id'] . "';";
		$results = $mysqli->query($sql);
		if ( $results == false ) {
			// echo $mysqli->error;
			exit();
		}

		$mysqli->close();
	}
	else {
		header("Location: homepage.php");
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<!-- mobile first -->
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<!-- bootstrap css-->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<!-- custom css -->
	<link rel="stylesheet" href="styles/shared.css">
	<link rel="stylesheet" href="styles/closet.css">
	<!-- jquery -->
	<script
  src="https://code.jquery.com/jquery-3.4.1.min.js"
  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
  crossorigin="anonymous"></script>

	<title>Closet</title>
</head>
<body>
	<?php include 'navbar.php'; ?>

	<div class="container">
		<h1 id="title" class="row justify-content-center">coordinate</h1>
		<p id="subtitle">welcome to your closet!</p>
		<p>click any image to <span id="delete">remove</span> it from your closet</p>
		<form id="update-form">

			<div class="form-group row justify-content-center">
				<input
					id="current-pwd"
					type="password"
					placeholder="current password"
					class="form-control col-10 col-sm-5 col-md-3" />
				<input
					id="new-pwd"
					type="password"
					placeholder="new password"
					class="form-control col-10 col-sm-5 col-md-3" />
				<small class="invalid-feedback">cannot be empty</small>
			</div>
			<small id="pwd-error"></small>
			<small id="pwd-success"></small>

			<div class="row justify-content-center">
				<button type="submit" class="btn btn-warning">update my password</button>
			</div>

		</form>

		<div id="photos" class="row">
			<?php while ($row = $results->fetch_assoc()['filepath']): ?>
		  	<div class="col-6 col-sm-4 col-md-3 col-xl-2 photo-col">
		  		<div class="row photo-row">
		  			<img src="<?php echo $row; ?>" />
		  		</div>
		  	</div>
		  <?php endwhile; ?>
		</div>
	</div>

	<!-- handle delete, update password -->
	<script src="js/closet.js"></script>
	<!-- bootstrap js -->
	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>