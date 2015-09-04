<?php require_once("../../includes/initialize.php"); ?>


<?php

	if(isset($_POST['submit'])) {
		
		$username = trim($_POST['username']);
		$password = trim($_POST['password']);

		
		$found_admin = User::authenticate($username, $password);
	

		if($found_admin) {
			$session->login($found_admin->id);
			redirect_to('index.php');
		} else {
			$message = "Username or password not found!";
		}
	}
?>

<?php include_layout_template('admin_header'); ?>

	<nav>
	
	</nav>
		
	<div class = "page">
		<h2>Login</h2>
		<?php echo $message;?>
		
		<form action="login.php" method = "POST">
			<p>
				Username: <input type="text" name = "username" value ="">
			</p>
			<p>
				Password : <input type="text" name = "password">
			</p>
			<p>
				<input type="submit" name = "submit" value = "Login">
			</p>
		</form>

	</div>


<?php include_layout_template('admin_footer');?>