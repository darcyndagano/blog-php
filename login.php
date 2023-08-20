<?php
include_once('config.php');

?>

<?php include_once(ROOT_PATH . '/includes/header.php') ?>
<?php include_once(ROOT_PATH . '/includes/navbar.php') ?>
<div class="login_div">
		<form action="login.php" method="post" >
			<h2>Login</h2>
			<input type="text" name="username" placeholder="Username" required>
			<input type="password" name="password"  placeholder="Password" required> 
			<button class="btn" type="submit" name="login_btn">Sign in</button>
		</form>
	</div>
    <?php include_once(ROOT_PATH . '/includes/footer.php') ?>