<?php require_once('../../includes/initialize.php');?>
<?php 
		if(!$session->is_logged_in()){
			redirect_to("login.php");
		}
?>


<?php
	
	if(isset($_POST['submit'])) {

		$username = trim($_POST['username']);
		$password = trim($_POST['password']);

		$new_admin = new User();
		$new_admin->hashed_password = password_hash($password, PASSWORD_BCRYPT,['cost'=>10]);
		$new_admin->username = $username;

		if($new_admin->save()) {
			$session->message("New admin saved");
			redirect_to("manage_admins.php");
		}else{
			$message =  "Failed to save the admin";
		}

	}
?>

<?php include_layout_template("admin_header");?>

	<nav>
		&nbsp;
	</nav>

	<div class="page">
	

		<form action="new_admin.php" method = "POST">
			<h2>Create Admin</h2>
			<table>
				<tr>
					<td>Username:</td>
					<td><input type="text" name = "username" value =""></td>
				</tr>
				<tr>
					<td>Password:</td>
					<td><input type="password" name = "password"></td>
				</tr>
				<tr>
					<td>First Name:</td>
					<td><input type="text" name = "first_name" value =""></td>
				</tr>
				<tr>
					<td>Last Name:</td>
					<td><input type="text" name = "last_name" value =""></td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td><input type="submit" name = "submit" value = "Create Admin"></td>
				</tr>
			</table>

		</form>
	
	</div>

<?php include_layout_template("admin_footer");?>