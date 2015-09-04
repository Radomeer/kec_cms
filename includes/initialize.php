<?php 

	defined("DS") ? null : define("DS", DIRECTORY_SEPARATOR);
	defined("SITE_ROOT") ? null : define("SITE_ROOT", "C:".DS."wamp".DS."www".DS."kec_cms");
	defined("LIB_PATH") ? null : define("LIB_PATH", SITE_ROOT.DS."includes");

	// load config file first 
	require_once(LIB_PATH.DS."config.php");

	// load the basic functions, so everything after that can use them
	require_once(LIB_PATH.DS."functions.php");

	// load core objects
	require_once(LIB_PATH.DS."session.php");
	require_once(LIB_PATH.DS."database.php");

	// load database-related classes
	require_once(LIB_PATH.DS."database_objects.php");
	require_once(LIB_PATH.DS."user.php");
	require_once(LIB_PATH.DS.'subject.php');
	require_once(LIB_PATH.DS.'page.php');











?>