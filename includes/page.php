<?php
	

	class Page extends DatabaseObjects {

		// static protected $table_fields = array('id', 'subject_id', 'menu_name', 'position', 'visible', 'content');
		protected static $table_name = "pages";

		public $id;
		public $subject_id;
		public $menu_name;
		public $position;
		public $visible;
		public $content;


		static public function find_pages_on($subject_id) {
			global $database; 

			$sql = "SELECT * FROM " . self::$table_name . " WHERE subject_id = {$subject_id}";
			return self::find_by_sql($sql);
		}

	}




?>