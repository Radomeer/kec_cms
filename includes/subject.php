<?php 

	class Subject extends DatabaseObjects {

		// static protected $table_fields = array('id', 'menu_name', 'position', 'visible');
		static protected $table_name = "subjects";

		public $id;
		public $menu_name;
		public $position;
		public $visible;


		public function pages() {
			return Page::find_pages_on($this->id);
		}	
		
 }



?>