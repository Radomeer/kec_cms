		</div> <!-- end main -->

		<footer id="footer" style="clear:both;">Copyright <?php echo date("Y", time());?>, KEvin Skoglund</footer>
</body>
</html>


<?php 
	if(isset($database)) {
		$database->close_connection();
	}
?>