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
	<link rel="stylesheet" href="styles/homepage.css">
	<!-- jquery -->
	<script
  src="https://code.jquery.com/jquery-3.4.1.min.js"
  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
  crossorigin="anonymous"></script>

	<title>Homepage</title>
</head>
<body>
	<?php include 'navbar.php'; ?>
	<?php include 'modal.php'; ?>

	<div class="container">
		<h1 id="title" class="row justify-content-center">coordinate</h1>
		<p class="row justify-content-center">What should I wear today?</p>
		<div class="row justify-content-center">
			<img id="duck-image" src="images/duck.png"/>
		</div>
		<div class="row justify-content-center">
			<?php if (isset($_SESSION["loggedIn"]) && $_SESSION["loggedIn"]): ?>
				<a id="get-started" class="btn btn-warning" href="codi.php">get started</a>
			<?php else: ?>
				<button id="get-started" type="button" class="btn btn-warning" data-toggle="modal" data-target="#loginModal">Get started</button>
			<?php endif; ?>
		</div>
	</div>

  <!-- login validation -->
	<script src="js/modal_validation.js"></script>
	<!-- bootstrap js -->
	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>