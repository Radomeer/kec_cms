<?php 

	class User extends DatabaseObjects {

		// static protected $table_fields = array('id', 'username', 'hashed_password', 'first_name', 'last_name');
		protected static $table_name = "users";

		public $id;
		public $username;
		public $hashed_password;
		public $first_name;
		public $last_name;

		public static function authenticate($username, $password) {
			
			$sql ="SELECT * FROM " . self::$table_name . " WHERE username = '{$username}'";
			$result = self::find_by_sql($sql);
			$admin = !empty($result) ? array_shift($result) : false;

			if($admin) {
				
				// found admin, now check password
				if(password_verify($password, $admin->hashed_password)) {
					// password mathches 
					return $admin;
				}else {
					// password do not match
					return false;
				}
			// admin not found
			}else{
				return false;
			}
		}

		// Scheduled for PHP v.5.5
		// password_verify($password, existing_hash);

		// private static function password_check($password, $existing_hash) {
		// 	$hash = crypt($password, $existing_hash);
		// 	if($hash == $existing_hash) {
		// 		return true;
		// 	}else {
		// 		return false;
		// 	}
		// }

		// Scheduled for PHP v.5.5
		// password_hash($password, PASSWORD_BCRYPT, [cost=>10]);

		// public function password_encrypt($password) {
		// 	$hash_format = "$2y$10$";
		// 	$salt_length = 22;
		// 	$salt = $this->generate_salt($salt_length);
		// 	$format_and_salt = $hash_format . $salt;
		// 	$hash = crypt($password, $format_and_salt);
		// 	return $hash;
		// }

		// private function generate_salt($length) {
		// 	$uniq_random_string = md5(uniqid(rand(), true));
		// 	// valid characters for a salt are [a-zA-Z0-9./]
		// 	$base64_string = base64_encode($uniq_random_string);
		// 	$modified_base64_encode = str_replace("+",".", $base64_string);
		// 	$salt = substr($modified_base64_encode, 0, $length);
		// 	return $salt;

		// }
	}



?>