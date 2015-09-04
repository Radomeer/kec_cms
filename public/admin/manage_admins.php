<?php require_once('../../includes/initialize.php');?>

<?php 
	// if(!$session->is_logged_in()){
	// 		redirect_to('login.php');
	// 	}
?>


<?php
	$admins = User::find_all();
?>

<?php include_layout_template("admin_header");?>

	<nav>
		<br>
		<a href="index.php"> &laquo; Back</a>
	</nav>

	<div class="page">
	<?php echo $message;?>
		<table>
			<h2>Manage Admins</h2>
			<tr style= "width:100">
				<th>Username</th>
				<th>Action</th>
			</tr>
			<?php foreach($admins as $admin):?>
				<tr>
					<td><?php echo $admin->username;?></td>
					<td><a href="edit_admin.php?id=<?php echo $admin->id;?>">Edit</a> <a href="delete_admin.php?id=<?php echo $admin->id; ?>">Delete</a></td>
				</tr>
			<?php endforeach; ?>
		</table> <br>
		<a href="new_admin.php">Add new admin</a>

	
	</div>

<?php include_layout_template("admin_footer");?>