<?php require_once('../../includes/initialize.php');?>

<?php 
	if(!$session->is_logged_in()) {
	 	redirect_to("login.php");
	 }
?>


<?php selected_page()?>

<?php include_layout_template('admin_header'); ?>

	<nav>
		<?php echo navigation($current_subject, $current_page); ?>
		<br>
		<br>
		<a href="new_subject.php"> &nbsp; + Add New Subject</a>
	</nav>
		

	<div class="page">
		<h2>Admin Menu</h2>
		<p>welcome to the admin area, ?></p>
		
		<?php echo $message; ?>
		<ul class = "subjects">
			<a href="../manage_content.php"><li>Manage Website Content</li></a>
			<a href="manage_admins.php"><li>Manage Admin Users</li></a>
			<a href=""><li>Manage Gallery</li></a>
			<a href="logout.php"><li>Logout</li></a>
		</ul>


	</div>





<?php include_layout_template('admin_footer'); ?>
