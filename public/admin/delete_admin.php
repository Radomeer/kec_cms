<?php require_once("../../includes/initialize.php");?>

<?php 
	// if(!$session->is_logged_in()) {
	// 	redirect_to('login.php');
	// }

	if(!isset($_GET['id'])) {
		redirect_to('manage_admins.php');
	}

	if($admin = User::find_by_id($_GET['id'])) {
		
		if($admin->delete()) {
			$session->message("Admin was deleted");
			redirect_to("manage_admins.php");
		}else{
			$session->message("Unable to delete the admin");
			redirect_to("manage_admins.php");
		}
	}

?>


