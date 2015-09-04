<?php require_once('../../includes/initialize.php');?>

<?php 
	// if(!$session->is_logged_in()) {
	// 	redirect_to('login.php');
	// }

	if(!isset($_GET['id'])) {
		redirect_to('manage_admins.php');
	}

	$admin = User::find_by_id($_GET['id']);

	if(isset($_POST['submit'])) {
		$admin->username = ($_POST['username']);
		$admin->password = ($_POST['password']);
		$admin->first_name = ($_POST['first_name']);
		$admin->last_name = ($_POST['last_name']);
		if($admin->save()) {
			$message= "Admin updated";
		}else{
			$message = "Failed to update the admin";
		}
	}

?>


<?php include_layout_template("admin_header");?>
	
<br>
	<?php echo $message; ?> 

	<h2>Create Admin</h2>
			<form action="edit_admin.php?id=<?php echo $admin->id;?>" method="POST">
				<table>
					<tr>
						<td>Username:</td>
						<td><input type="text" name = "username" value ="<?php echo $admin->username; ?>"></td>
					</tr>
					<tr>
						<td>Password:</td>
						<td><input type="password" name = "password" value = ""></td>
					</tr>
					<tr>
						<td>First Name:</td>
						<td><input type="text" name = "first_name" value ="<?php echo $admin->first_name; ?>"></td>
					</tr>
					<tr>
						<td>Last Name:</td>
						<td><input type="text" name = "last_name" value ="<?php echo $admin->last_name; ?>"></td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td><input type="submit" name = "submit" value = "Update Admin"></td>
					</tr>
				</table>
			</form>

			<br>

	<a href="manage_admins.php">&laquo; Back to Manage Admins</a>

<?php include_layout_template("admin_footer");?>
