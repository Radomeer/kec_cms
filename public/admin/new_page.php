<?php require_once('../../includes/initialize.php');?>
	
<?php 

	

	$subject = Subject::find_by_id($_GET['subject']);

	if(isset($_POST['submit'])) {

		$new_page = new Page(); 

		$new_page->menu_name = trim($_POST['menu_name']);
		$new_page->visible = (int) trim($_POST['visible']);
		$new_page->position = (int) trim($_POST['position']);
		$new_page->content = trim($_POST['content']);
		if($new_page->save()) {
			$message = "New Page Added";
		 	redirect_to("..manage_content.php");
		}else{
			$message = "Failed to Add New Subject";
		}
	}

?>
<?php include_layout_template("admin_header");?>

	<nav>
		&nbsp;
	</nav>
		
		<div class="page">
		<?php 
			if(!empty($message)) {
				echo "<div class =\"message\">{$message}</div>";
			}
		?>
			<h2><b>Create New Page for <?php echo $subject->menu_name;?></b></h2>

			<form action = "new_page.php" method="POST">
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
						<?php $pages = Page::find_pages_on($subject->id);?>
						<?php $subject_count = count($pages);?>
						
						<?php for($i=1; $i<=$subject_count + 1; $i++) {
								echo "<option value=\"{$i}\">{$i}</option>";
							}
						?>
					</select>
				</p>
				<p>
					Write Content: <br><textarea name="content" id="" cols="70" rows="20"></textarea>
				</p>	
			<p>
				<input type="submit" name="submit" value="Add Page">
			</p>
			</form>
		<a href="../manage_content.php">Cancel</a>
		</div> <!-- end div page -->

<?php include_layout_template("admin_footer");?>
