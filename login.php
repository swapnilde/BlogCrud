<?php
	require 'classes/Database.php';
	require 'classes/Login.php';

	$db = Database::getInstance();
	$conn = $db->getConnection();

	$login = new Login($conn);

	if ($_SERVER['REQUEST_METHOD']=='POST'){
		$name = $_POST['lname'];
		$pass = $_POST['lpass'];
		$result = $login->getLogin($name,$pass);
	}

include 'includes/header.php'; ?>
<div class="login">
	<h1>Login</h1>
	<div class="message">
		<?php echo $result; ?>
	</div>
	<form method="post" action="login.php" id="login-form">
		<label><input type="text" name="lname" id="lname" placeholder="Username" required="required" /></label>
		<label><input type="password" name="lpass" id="lpass" placeholder="Password" required="required" /></label>
		<button type="submit" id="login-btn" class="btn btn-primary btn-block btn-large">Let me in</button>
		<input type="reset" value="Reset" />
	</form>
	<div class="ref-link">
		<p>Not a Member Yet?</p>
		<a href="register.php">Sign Up</a>
	</div>
</div>
<?php
	include 'includes/footer.php';