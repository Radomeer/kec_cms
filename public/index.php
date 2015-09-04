<?php 
	require_once ("../includes/initialize.php");

selected_page();


?>


<?php include_layout_template('header'); ?>

	<nav>
		<?php echo public_navigation($current_subject, $current_page); ?>
	</nav> <!-- end nav -->
		
	<div class = "page">

 
		<?php if($current_subject) { ?>
		<h2>Manage Subjects <?php echo $current_subject->menu_name;?></h2>

		<?php }elseif($current_page) { ?>
		<h2>Manage Pages</h2>

			<p>Content: <div class ="message"><?php echo htmlentities($current_page->content);?></div></p>

		<?php 
			}else{
				echo "<br>Please select menu:";
			}

		?>

	</div> <!-- end div page-->





<?php include_layout_template('footer'); ?>