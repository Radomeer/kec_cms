<?php require_once("../../includes/initialize.php");?>

<?php 
	// if(!$session->is_logged_in()) {
	// 	redirect_to('login.php');
	// }

	if(!isset($_GET['subject'])) {
		redirect_to('manage_admins.php');
	}

	$subject = Subject::find_by_id($_GET['subject']);
		
		if($subject && $subject->delete()) {
			$session->message("Admin was deleted");
			redirect_to("manage_content.php");
		}else{
			$session->message("Unable to delete the admin");
			redirect_to("manage_content.php");
		}


	// TASK 

	// Find out how to perform cascade deleting

?>
