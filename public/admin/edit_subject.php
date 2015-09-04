<?php require_once('../../includes/initialize.php');?>
	
<?php
	selected_page();

	// if(!$session->is_logged_in()) {
	// 	redirect_to('login.php')
	// }


	if(!isset($_GET['subject'])) {
		redirect_to('manage_content.php');
	}

	$subject = Subject::find_by_id($_GET['subject']); 

	if(isset($_POST['submit'])) {

		$subject->menu_name = trim($_POST['menu_name']);
		$subject->visible = (int) trim($_POST['visible']);
		$subject->position = (int) trim($_POST['position']);
		if($subject->save()) {
			$message = "New Subject Updated";
		}else{
			$message = "Failed to Update New Subject";
		}
	}
?>
<?php include_layout_template("admin_header");?>

	<nav>
		<br>
		<a href="index.php">&laquo; Back</a>
		<br>
		<?php echo navigation($current_subject, $current_page);?>
	</nav>
		
		<div class="page">
		<?php if(!empty($message)) { echo "<div class =\"message\">{$message}</div>";} ?>
			<h2>Edit Subject</h2>

			<form action = "new_subject.php?subject=<?php echo $current_subject->id;?>" method="POST">
				<p>
					Menu Name: <input type="text" name= 'menu_name' value = "<?php echo $current_subject->menu_name;?>">
				</p>
				<p>
					Visible: <input type="radio" name = "visible" value = "1" <?php if($subject->visible == "1") { echo "checked";} ?>> Yes
							&nbsp;
							 <input type="radio" name = "visible" value = "0" <?php if($subject->visible == "0") { echo "checked";} ?>> No
				</p>
				<p>
					Position:	
					<select name = "position">
						<?php $subject_count = Subject::count_all();?>
						
						<?php for($i=1; $i<=$subject_count + 1; $i++) {
								echo "<option value=\"{$i}\" ";
								if($i == $subject->position) {
									echo "selected";
								}
								echo ">{$i}</option>";
							}
						?>
					</select>
				</p>		
			<p><input type="submit" name="submit" value="Edit Subject"></p>
			</form>
			<a href="manage_content.php?subject=<?php echo $subject->id?>">Cancel</a>
		</div>







<?php include_layout_template("admin_footer");?>