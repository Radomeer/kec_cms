<?php 
	require_once ("../../includes/initialize.php");

selected_page();


?>


<?php include_layout_template('admin_header'); ?>

	<nav>
		<br>
			<a href="admin.php">&laquo; Main Menu</a>
		<br>
		<?php echo navigation($current_subject, $current_page); ?>
	</nav> <!-- end nav -->
		
	<div class = "page">

		<?php if(!empty($message)) { echo "<div class = \"message\">{$message}</div>";}?>

		<?php if($current_subject) { ?>
		<h2>Manage Subjects <?php echo $current_subject->menu_name;?></h2>
		
		
				<p>
					Menu Name: <?php echo $current_subject->menu_name; ?> <br>
				</p>
				<p>
					Visible: <?php echo $current_subject->visible == 1 ? "Yes" : "No" ?> <br>
				</p>
				<p>
					Position: <?php echo $current_subject->position;?> <br>
				</p>
				<br>
				<a href="edit_subject.php?subject=<?php echo $current_subject->id; ?>">Edit Subject</a> &nbsp; <a href="delete_subject.php?subject=<?php echo $current_subject->id; ?>"> Delete Subject</a>
			
		<br>
		<hr />
			<?php  $pages = $current_subject->pages(); ?>
			<?php if($pages) { ?>
					<h2>Page in this subjects</h2>
					<ul class="pages">
						<?php
							foreach ($pages as $page): 
						?>
							<li>
							<a href="manage_content.php?page=<?php echo urlencode($page->id);?>"><?php echo $page->menu_name?></a> 
							</li>	
						<?php 
						  	endforeach;
						?>
					</ul>
				<a href="/new_page.php?subject=<?php echo urldecode($current_subject->id);?>">Create new page for <?php echo $current_subject->menu_name;?></a>
			<?php } ?>

		<?php }elseif($current_page) { ?>
		<h2>Manage Pages</h2>
	
			<p>Menu Name: <?php echo $current_page->menu_name; ?></p>
			<p>Visible: <?php echo $current_page->visible == 1 ? "Yes" : "No";?></p>
			<p>Position: <?php echo $current_page->position;?></p>
			<p>Content: <div class ="message"><?php echo $current_page->content;?></div></p>
			<br>
			<a href="edit_page.php?page=<?php echo $current_page->id;?>">Edit Page</a> &nbsp; <a href="delete_page.php?page=<?php echo $current_page->id;?>">Delete Page</a>
		<?php 
			}else{
				echo "<br>Please select menu:";
			}

		// $subjects = Subject::find_by_sql("SELECT * from subjects");
	
		// foreach ($subjects as $subject) {
		
		// 	echo $subject->menu_name . "<br>";
		// }	

		// $subjects = Subject::find_all();
	
		// foreach($subjects as $subject) {
		// 	echo "<br> Menu Name: " . $subject->menu_name;
		// }

		// if($current_subject) {
		// 	echo "<h2>Subject</h2><br>";
		// 	echo $current_subject->id;
		// }


		// $subject = Subject::find_by_id(15);
		// $subject->menu_name = "Drugi";
		// $subject->save();

	?>


	</div> <!-- end messagedi></div>"v} page -->





<?php include_layout_template('admin_footer'); ?>