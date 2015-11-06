<?php 
	class Password {
	 
		//Blowfish
		private static $algo = '$2a';
	 
		//Cost
		private static $cost = '$10';
	 	 
		//Salt
		private static $salt = 'aPL1ci6zeH54c0deV2jsdA$';
	 
		//Generate password hash
		public static function hash( $password ){	 
			return crypt( $password, self::$algo . self::$cost . '$' . self::$salt );	 
		}	 
		
		//Comapre hash and password
		public static function validate_password($hash, $password) {	 
			$full_salt = substr($hash, 0, 29);	 
			$new_hash = crypt($password, $full_salt);	 
			return ($hash == $new_hash);	 
		}	 
	}
?>