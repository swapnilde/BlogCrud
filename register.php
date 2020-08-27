<?php
	require 'classes/Database.php';
	require 'classes/Register.php';
	$db = Database::getInstance();
	$conn = $db->getConnection();
	$register = new Register($conn);

	if ($_SERVER['REQUEST_METHOD']=='POST'){
		$name = $_POST['sname'];
		$pass = $_POST['spass'];
		$result = $register->getRegister($name,$pass);
	}


include 'includes/header.php'; ?>
<div class="login">
	<h1>Sign Up</h1>
	<div class="message">
		<?php echo $result; ?>
	</div>
	<form method="post" action="register.php" id="signup-form">
		<label><input type="text" name="sname" id="sname" placeholder="Username" required="required" /></label>
		<label><input type="password" name="spass" id="spass" placeholder="Password" required="required" /></label>
		<button type="submit" id="signup-btn" class="btn btn-primary btn-block btn-large">Let me sign up</button>
		<input type="reset" value="Reset" />
	</form>
	<div class="ref-link">
		<p>Already a Member?</p>
		<a href="login.php">Login</a>
	</div>
</div>

<?php
	include 'includes/footer.php';