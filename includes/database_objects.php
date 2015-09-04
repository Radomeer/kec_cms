<?php 
	require_once(LIB_PATH.DS.'database.php');



	class DatabaseObjects {

		// protected static $table_fields;
		protected static $table_name;



		// Database Common Methods

		public static function count_all() {
			global $database;

			$sql = "SELECT COUNT(*) FROM " . static::$table_name;
			$result = $database->query($sql);
			$count = $database->fetch_array($result);
			return !empty($count) ? array_shift($count) : null;
		}

		static public function find_all() {

			$sql = "SELECT * FROM " . static::$table_name;
			$result_array = static::find_by_sql($sql);
			return !empty($result_array) ? $result_array : false;
		}

		static public function find_by_id($id){
			global $database;

			$sql = "SELECT * from " . static::$table_name . " where id = {$database->escape_value($id)}";
			$result_set = static::find_by_sql($sql);
			return !empty($result_set) ? array_shift($result_set) : false;
		}

		static public function find_by_sql($sql) {
			global $database;

			$result_set = $database->query($sql);
			$objects_array = array();
			
			while ($row = mysqli_fetch_array($result_set)) {
				$objects_array[] = static::instantiate($row);
			}

			return $objects_array;
				
		}

		static protected function instantiate($record) {
			$class = get_called_class(); 	// Instead of get_class()  with late static bindings we also have get_called_class(), so we can find out what class  actualy call this static method
			$new_object = new $class;

			foreach($record as $attribute => $value) {
				if($new_object->has_attribute($attribute)) {
					$new_object->$attribute = $value;
				}
			}
			return $new_object;
		}

		private function has_attribute($attribute) {
			$object_vars = $this->attributes();
			return array_key_exists($attribute, $object_vars);
		}

		// dynamic way of getting column names from database table

		protected function attributes() {
			global $database;

			$fields_array = array();

			$sql = "SHOW FIELDS from " . static::$table_name;
			$result_set = $database->query($sql);
			
			foreach($result_set as $assoc_array) {
				$fields_array[$assoc_array['Field']] = $this->$assoc_array['Field'];
			}
			return $fields_array;
		}

		//this is the way when we manualy(hard code) define name of columns in array $table_fields for class
		// public function attributes() {

		// 	$attribute_array = array();

		// 	foreach(static::$table_fields as $field) {
		// 		if(property_exists($this, $field)) {
		// 			$attribute_array[$field] = $this->$field; 
		// 		}
		// 	}
		// 	return $attribute_array;
		// }

		protected function sanitize_attributes() {
			global $database;

			$safe_attribute = array();

			foreach($this->attributes() as $key => $value) {
				$safe_attribute[$key] = $database->escape_value($value);
			}
			return $safe_attribute;
		}

		public function save() {
			return !empty($this->id) ? $this->update() : $this->create();
		}

		public function create() {
			global $database; 

			$attributes = $this->sanitize_attributes();

			$sql = "INSERT INTO " . static::$table_name . "(" . join(",", array_keys($attributes)) .") VALUES ('" . join("','", array_values($attributes)) . "')";  
			$result = $database->query($sql);
			if($result) {
				$this->id = $database->insert_id();
				
				return true;		
			}else{
				return false;
			}
		}

		public function update() {
			global $database;

			$attribute_pairs = array();

			foreach($this->sanitize_attributes() as $attribute => $value) {
				$attribute_pairs[] = "{$attribute} = '{$value}'"; 
			}
				
			$sql = "UPDATE " . static::$table_name . " SET " . join(",", $attribute_pairs) . " WHERE id = {$database->escape_value($this->id)}";
			$result = $database->query($sql); 

			if($result && $database->affected_rows() == 1 ) {
				return true;
			}else {
				return false;
			}

		}

		public function delete() {
			global $database;

			$sql = "DELETE FROM " . static::$table_name . " where id = {$database->escape_value($this->id)} LIMIT 1";

			$result = $database->query($sql);

			if($result && $database->affected_rows() == 1) {
				return true;
			}else {
				return false;
			}
		}
	}	




?>