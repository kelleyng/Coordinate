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
		$sql_categories = "SELECT * FROM categories;";
		$results_categories = $mysqli->query($sql_categories);
		if ($results_categories == false) {
			// echo $mysqli->error;
			exit();
		}
		$sql_colors = "SELECT * FROM colors;";
		$results_colors = $mysqli->query($sql_colors);
		if ($results_colors == false) {
			// echo $mysqli->error;
			exit();
		}
		$mysqli->close();
	} else {
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
	<link rel="stylesheet" href="styles/codi.css">
	<!-- jquery -->
	<script
  src="https://code.jquery.com/jquery-3.4.1.min.js"
  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
  crossorigin="anonymous"></script>

	<title>Codi</title>
</head>
<body>
	<?php include 'navbar.php'; ?>
	
	<div class="container">
		<h2 class="title">good morning, <?php echo $_SESSION["username"]; ?></h2>

		<div id="picked-photos" class="row"></div>

		<form id="codi-form" action="" method="">

			<div class="row form-group">
				<div class="col-12 col-sm-6 col-md-3">
			    <label for="categoryInput">category</label>
					<select id="categoryInput" class="custom-select">
					  <option selected disabled>--select one--</option>
					  <?php while ($row = $results_categories->fetch_assoc()): ?>
					  	<option value="<?php echo $row['id']; ?>"><?php echo $row['category']; ?></option>
					  <?php endwhile; ?>
					</select>
				</div>
			</div>

			<div class="row">
				<div class="col">
					<label>colors</label>
				</div>
			</div>

			<div class="row col color-col form-group">
				<?php while ($row = $results_colors->fetch_assoc()): ?>
					<div class="col m-1 color-box" data-id="<?php echo $row['id']; ?>" data-hex="<?php echo $row['hex']; ?>">
						<p><?php echo $row['name']; ?></p>
					</div>
				<?php endwhile; ?>
			</div>
			<button type="button" id="search-button" class="btn btn-warning">search</button>
			<p class="instructions">1. search your closet by category and color</p>
			<p class="instructions">2. click the image of what you want to wear today!</p>
		</form>

		<div id="result-error"></div>
		<div id="result-photos" class="row">
			<div class="col-6 col-sm-4 col-md-3 col-xl-2"></div>
		</div>

	</div>

	<!-- style options, handle color selection, serve results w ajax/no refresh -->
	<script src="js/codi.js"></script>
	<!-- bootstrap js -->
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>