<?php require_once('../../includes/initialize.php');?>
	
<?php 
	selected_page();

	if(isset($_POST['submit'])) {

		$new_subject = new Subject(); 

		$new_subject->menu_name = trim($_POST['menu_name']);
		$new_subject->visible = (int) trim($_POST['visible']);
		$new_subject->position = (int) trim($_POST['position']);
		if($new_subject->save()) {
			$message = "New Subject Added";
		}else{
			$message = "Failed to Add New Subject";
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
		<?php 
			if(!empty($message)) {
				echo "<div class =\"message\">";
				echo $message; 
				echo "</div>";
			}
		?>
			<h2>Create New Subject</h2>

			<form action = "new_subject.php" method="POST">
				<p>
					Menu Name: <input type="text" name= 'menu_name'>
				</p>
				<p>
					Visible: <input type="radio" name = "visible" value = "1"> Yes
							&nbsp;
							 <input type="radio" name = "visible" value = "0"> No
				</p>
				<p>
					Position:	
					<select name = "position">
						<?php $subject_count = Subject::count_all();?>
						
						<?php for($i=1; $i<=$subject_count + 1; $i++) {
								echo "<option value=\"{$i}\">{$i}</option>";
							}
						?>
					</select>
				</p>		
			<p>
				<input type="submit" name="submit" value="Add Subject">
			</p>
			
			</form>
		</div>







<?php include_layout_template("admin_footer");?>
