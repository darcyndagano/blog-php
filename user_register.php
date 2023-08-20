<?php include_once('config.php') ?>

<?php include_once(ROOT_PATH . '/includes/header.php') ?>
  <title>DUKORE Tech | Register </title>
<?php include_once(ROOT_PATH . '/includes/navbar.php') ?>
  <body>
  <form action="register.php" method="post">
  <div class="container">
    <h1>Register</h1>
    <p>Please fill in this form to create an account.</p>
    <hr>

    <label for="email"><b>Email</b></label>
    <input type="text" placeholder="Enter Email" name="email" id="email" required>

    <label for="fullname"><b>Full Name</b></label>
    <input type="text" placeholder="Enter fullname" name="fullname" id="fullname" required>

    <label for="password"><b> Password</b></label>
    <input type="password" placeholder="Your password" name="password" id="password" required>
    <hr>

    <p>By creating an account you agree to our <a href="#">Terms & Privacy</a>.</p>
    <button type="submit" class="registerbtn">Register</button>
  </div>

  <div class="container signin">
    <p>Already have an account? <a href="login.php">Sign in</a>.</p>
  </div>
</form>
		</form>

	<?php include(ROOT_PATH . '/includes/footer.php'); ?>