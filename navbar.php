<nav id="nav" class="navbar navbar-expand-md navbar-dark navbar-black">
	<a class="navbar-brand" href="homepage.php">coordinate</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarContent">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse justify-content-end" id="navbarContent">
    <a class="nav-link d-flex justify-content-end" href="about.php">about</a>
    <?php if(!isset($_SESSION["loggedIn"]) || !$_SESSION["loggedIn"]): ?>
      <a class="nav-link d-flex justify-content-end" data-toggle="modal" data-target="#loginModal" href="#">login</a>
    <?php else: ?>
      <a class="nav-link d-flex justify-content-end" href="upload.php">upload</a>
      <a class="nav-link d-flex justify-content-end" href="codi.php">codi</a>
      <a class="nav-link d-flex justify-content-end" href="closet.php">closet</a>
      <a id="logout-link" class="nav-link d-flex justify-content-end" href="login/logout.php">logout</a>
    <?php endif; ?>
  </div>
</nav>