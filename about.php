<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<!-- mobile first -->
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<!-- bootstrap css-->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<!-- custom css -->
	<link rel="stylesheet" href="styles/shared.css">
	<link rel="stylesheet" href="styles/modal.css">
	<link rel="stylesheet" href="styles/about.css">
	<!-- jquery -->
	<script
  src="https://code.jquery.com/jquery-3.4.1.min.js"
  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
  crossorigin="anonymous"></script>

	<title>About</title>
</head>
<body>
	<?php include 'navbar.php'; ?>
	<?php include 'modal.php'; ?>
	
	<div class="container">
		<h1 id="title" class="row justify-content-center">coordinate</h1>
		<div class="row justify-content-center">
			<p id="about-text">
				<img id="duck-image" src="images/duckcloth.png"/>
				What should I wear today?<br />
				Forgotten what’s in the depths of your drawers?<br />
				Coordinate lets you upload your closet and<br />
				<span id="important-text">easily see what you have</span><br />
				by searching by category or color<br />
				to mix and match to create an outfit each day.
			</p>
		</div>
	</div>

	<!-- login validation -->
	<script src="js/modal_validation.js"></script>
	<!-- bootstrap js -->
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>