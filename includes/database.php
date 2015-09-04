<?php
	require_once("config.php");

	class MySQLDatabase {

		private $connection;
		private $last_query;


		function __construct() {
			$this->open_connection();
		}


		private function open_connection() {

			$this->connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
			if(!$this->connection) {
				die("Failed to open database connection" . mysqli_connect_error());
			}
		}

		protected function close_connection() {

			if(isset($this->connection)) {
				mysqli_close($this->connection);
				unset($this->connection);

			}
		}

		public function query($sql) {
			$this->last_query = $sql;

			$result_set = mysqli_query($this->connection, $sql);
			$this->confirm_query($result_set);
			return $result_set;
		}

		private function confirm_query($result_set) {
			if(!$result_set) {
				$output = "Last MySQL Query: " . $this->last_query . "<br>"; 
				$output .= "Query Execution Failed"; 
				die($output);
			}
		}

		public function fetch_array($result_set) {
			return mysqli_fetch_assoc($result_set);  /* PRBOBAJ DA POBOLJSAS PERFORMANSE SA MYSQLI_FETCH ASSOC*/
		}

		public function escape_value($string) {
			$escaped_string = mysqli_real_escape_string($this->connection,$string); 
			return $escaped_string; 
		}

		public function insert_id() {
			return mysqli_insert_id($this->connection);
		}

		public function affected_rows() {
			return mysqli_affected_rows($this->connection);
		}


	}

	$database = new MySQLDatabase();

?>