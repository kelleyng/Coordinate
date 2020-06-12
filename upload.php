<?php
	session_start();
	if(isset($_SESSION["loggedIn"]) && $_SESSION["loggedIn"]) {
		require "config/config.php";
		$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
		if ($mysqli->connect_errno) {
			//echo $mysqli->connect_error;
			exit();
		}

		$mysqli->set_charset("utf8");

		$sql_categories = "SELECT * FROM categories;";
		$results_categories = $mysqli->query($sql_categories);
		if ($results_categories == false) {
			//echo $mysqli->error;
			exit();
		}
		$sql_colors = "SELECT * FROM colors;";
		$results_colors = $mysqli->query($sql_colors);
		if ($results_colors == false) {
			//echo $mysqli->error;
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
	<link rel="stylesheet" href="styles/upload.css">
	<!-- jquery -->
	<script
  src="https://code.jquery.com/jquery-3.4.1.min.js"
  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
  crossorigin="anonymous"></script>

	<title>Upload</title>
</head>
<body>
	<?php include 'navbar.php'; ?>

	<div class="container">
		<h1 class=" title">add an article of clothing</h1>

		<form id="upload-form" enctype="multipart/form-data" action="upload_confirmation.php" method="POST">

			<div class="row form-group">
				<div class="col-12 col-sm-6 col-md-3">
			    <label for="categoryInput">category</label>
					<select id="categoryInput" name="category" class="custom-select">
					  <option selected disabled>--select one--</option>
					  <?php while ($row = $results_categories->fetch_assoc()): ?>
					  	<option value="<?php echo $row['id']; ?>"><?php echo $row['category']; ?></option>
					  <?php endwhile; ?>
					</select>
				</div>
			</div>

	    <div class="row form-group">
	    	<div class="col-12 col-sm-6 col-md-3">
		    	<label>photo</label>
				  <div class="custom-file">
				    <label class="btn btn-warning">
						  browse
						  <input type="file" name="fileToUpload" hidden />
						</label>
				  </div>
				</div>
			</div>

			<div class="row">
				<div class="col">
					<label>colors</label>
				</div>
			</div>
			<div class="row col form-group color-col">
				<?php while ($row = $results_colors->fetch_assoc()): ?>
					<div class="col m-1 color-box" data-id="<?php echo $row['id']; ?>" data-hex="<?php echo $row['hex']; ?>">
						<p><?php echo $row['name']; ?></p>
					</div>
				<?php endwhile; ?>
			</div>

			<input type="button" id="add-button" class="btn btn-warning" value="done" />
		</form>
	</div>

	<!-- style options, handle color selection -->
	<script src="js/upload.js"></script>
	<!-- bootstrap js -->
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>
<?php ?>