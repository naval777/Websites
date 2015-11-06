<?php
	require_once('Password.php');
	
	define("MINIMUM_NAME_LENGTH", 4);
	define("MINIMUM_PASSWORD_LENGTH", 6);
		
	class User {
		
		public $id = null;
		public $name = null;
		public $birthday = null;
		public $age = null;
		public $gender = null;
		public $college = null;
		public $password = null;
		public $phone = null;
		public $email = null;
		public $icon_link = null;
		public $aboutMe = null;
		public $id_link = null;
		public $verification = null;
     	public static $errorMessage;
		public static $errorCode;
		public static $successMessage;

		public function __construct( $data = array() ) {
			
			if( isset( $data['id'] ) ) 					$this->id = (int) $data['id'];
			if( isset( $data['password'] ) ) 			$this->password = $data['password'];
		    if( isset( $data['name'] ) ) 				$this->name = preg_replace( "/[^a-zA-Z0-9]/", "", $data['name'] );
            if( isset( $data['birthday'] ) )                 $this->birthday = $data['birthday'];
			if( isset( $data['age'] ) ) 					$this->age = (int) $data['age'];
			if( isset( $data['gender'] ) )                 $this->gender = $data['gender'];
			if( isset( $data['college'] ) )             $this->college = $data['college'];
			if( isset( $data['email'] ) ){ 				
				$this->email = trim( preg_replace( "/[^\.\@\_ a-zA-Z0-9]/", "", $data['email'] ) );
				
			}
			if( isset( $data['phone'] ) ) 				$this->phone = preg_replace ( "/[^\+ 0-9]/", "", $data['phone'] );
			if( isset( $data['icon_link'] ) )           $this->icon_link = $data['icon_link'];
			if( isset( $data['aboutMe'] ) )             $this->aboutMe = $data['aboutMe'];
		    if( isset( $data['id_link'] ) )             $this->id_link = $data['id_link'];
			if( isset( $data['verification'] ) )        $this->verification = $data['verification'];
		
		}
		
		public static function errorInfo(){
			return self::$errorMessage;
		}
		
		public static function errorCode(){
			return self::$errorCode;
		}
		
		public function storeFormValues( $params ){
			$this->__construct( $params );
		}	
			
		public function insert(){
		
			if( !is_null( $this->id ) ) trigger_error( "User::insert(): Attempt to insert a user object that already has its ID property set to $this->id.", E_USER_ERROR );
		
			// Set Values
			$this->password = Password::hash($this->password);
			   
			

			// Validation
			if( !filter_var( $this->email, FILTER_VALIDATE_EMAIL ) ){
				self::$errorCode ="ERR_INV_EMAIL";
				return false;
			}
			else if( strlen( $this->name ) < MINIMUM_NAME_LENGTH || preg_match("/[^a-zA-Z'-]/", $this->name) ){
				self::$errorCode ="ERR_INV_NAME";
				return false;
			}
			else if( strlen( $this->phone ) != 10 || preg_match("/[^[0-9]{10}]/", $this->phone) ){
				self::$errorCode ="ERR_INV_PHONE";
				return false;
			}
			
				
     		$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
			$sql = "INSERT INTO ".TABLENAME_USERS." ( name, birthday, age, gender,college, password, phone, email, icon_link, aboutMe, id_link, verification ) VALUES ( :name, :birthday, :age, :gender, :college, :password, :phone, :email, :icon_link, :aboutMe, :id_link, :verification )";
			$st = $conn->prepare( $sql );
			$st->bindValue( ":name", $this->name, PDO::PARAM_STR );
			$st->bindValue( ":birthday", $this->birthday, PDO::PARAM_STR );
			$st->bindValue( ":age", $this->age, PDO::PARAM_INT );
			$st->bindValue( ":gender", $this->gender, PDO::PARAM_STR );
			$st->bindValue( ":college", $this->college, PDO::PARAM_STR );
			$st->bindValue( ":password", $this->password, PDO::PARAM_STR );
			$st->bindValue( ":email", $this->email, PDO::PARAM_STR );
			$st->bindValue( ":phone", $this->phone, PDO::PARAM_STR );
			$st->bindValue( ":icon_link", $this->icon_link, PDO::PARAM_STR );
			$st->bindValue( ":aboutMe", $this->aboutMe, PDO::PARAM_STR );
			$st->bindValue( ":id_link", $this->id_link, PDO::PARAM_STR );
			$st->bindValue( ":verification", $this->verification, PDO::PARAM_STR );
		//	print_r( $st );
			$result = $st->execute();
			$this->id = $conn->lastInsertId();
			$conn = null;
			
			if( !$result ){
				self::$errorMessage = "User::insert: Insertion Failed, PDO::errorInfo(): ".$st->errorCode().": ".$st->errorInfo()[2];
				self::$errorCode = $st->errorCode();
			//echo $errorMessage;
				return false;
			}
			else{		
				self::$successMessage = "User::insert: User successfully inserted with id ".$this->id;			
				return true;
			}
		}
		public function update(){
				
			//Does the object have an ID?
			if( is_null( $this->id ) ) trigger_error( "User::update(): Attempt to update a user object that does not have its ID property set.", E_USER_ERROR );
			
			else if( strlen( $this->name ) < MINIMUM_NAME_LENGTH || preg_match("/[^a-zA-Z'-]/", $this->name) ){
				self::$errorCode ="ERR_INV_NAME";
				return false;
			}
			else if( strlen( $this->phone ) != 10 || preg_match("^[0-9]{10}", $this->phone) ){
				self::$errorCode ="ERR_INV_PHONE";
				return false;
			}
			

			//Update the object
			$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );		
			$sql = "UPDATE ".TABLENAME_USERS." SET name=:name, phone=:phone  WHERE id = :id";
			$st = $conn->prepare( $sql );
			$st->bindValue( ":name", $this->name, PDO::PARAM_STR );
			
			$st->bindValue( ":phone", $this->phone, PDO::PARAM_STR );
			
			$st->bindValue( ":id", $this->id, PDO::PARAM_INT );
			echo $this->id;
			echo "<br>";
			$st->execute();
		//	print_r($st->errorInfo());
			$conn = null;	
			
			return true;
		}
	    public function updateImage(){

			//Update the object
			$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );		
			$sql = "UPDATE ".TABLENAME_USERS." SET icon_link=:icon_link  WHERE id = :id";
			$st = $conn->prepare( $sql );
			$st->bindValue( ":icon_link", $this->icon_link, PDO::PARAM_STR );
			$st->bindValue( ":id", $this->id, PDO::PARAM_INT );
			echo "<br>";
			$st->execute();
		//	print_r($st->errorInfo());
			$conn = null;	
			
			return true;
		}

		public function updateIdImage(){

			//Update the object
			$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );		
			$sql = "UPDATE ".TABLENAME_USERS." SET id_link=:id_link  WHERE id = :id";
			$st = $conn->prepare( $sql );
			$st->bindValue( ":id_link", $this->id_link, PDO::PARAM_STR );
			$st->bindValue( ":id", $this->id, PDO::PARAM_INT );
			echo "<br>";
			$st->execute();
		//	print_r($st->errorInfo());
			$conn = null;	
			
			return true;
		}
        
		public function updatePassword(){

			if( is_null( $this->id ) ) trigger_error( "User::update(): Attempt to update a user object that does not have its ID property set.", E_USER_ERROR );
			
			if( strlen( $this->password ) < MINIMUM_PASSWORD_LENGTH ){
				self::$errorCode ="ERR_INV_PASS";
				return false;
			}
			//Update the object
			$this->password = Password::hash($this->password);
			$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );		
			$sql = "UPDATE ".TABLENAME_USERS." SET password=:password WHERE id = :id";
			$st = $conn->prepare( $sql );
			$st->bindValue( ":password", $this->password, PDO::PARAM_STR );
			$st->bindValue( ":id", $this->id, PDO::PARAM_INT );
			$st->execute();
			$conn = null;

			return true;
			}
		
		
		public static function getById( $id ){
			$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
			$sql = "SELECT * FROM ".TABLENAME_USERS." WHERE id = :id ";
			$st = $conn->prepare( $sql );
			$st->bindValue( ":id", $id, PDO::PARAM_INT );
			$st->execute();
			$row = $st->fetch();
			$conn = null;
			if( $row ) return new User( $row );
		}
		
		
			
		/*
		public static function getByUsername( $username ){
			$username = trim( $username );
			$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
			$sql = "SELECT *, UNIX_TIMESTAMP(joinDateTime) AS joinDateTime, UNIX_TIMESTAMP(lastLoginDateTime) AS lastLoginDateTime FROM ".TABLENAME_USERS." WHERE username = :username ";
			$st = $conn->prepare( $sql );
			$st->bindValue( ":username", $username, PDO::PARAM_STR );
			$st->execute();
			$row = $st->fetch();
			$conn = null;
			if( $row ) return new User( $row );
		}
        */
		public static function getByEmail( $email ){
			$email = trim( $email );
			$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
			$sql = "SELECT * FROM ".TABLENAME_USERS." WHERE email = :email ";
			$st = $conn->prepare( $sql );
			$st->bindValue( ":email", $email, PDO::PARAM_STR );
			$st->execute();
			$row = $st->fetch();
			$conn = null;
			if( $row ) return new User( $row );
		}
		public function delete(){
						
			//Does the object have an ID?
			if( is_null( $this->id ) ) trigger_error( "User::delete(): Attempt to delete a user object that does not have its ID property set.", E_USER_ERROR );
			
			//Delete the object
			$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
			$st = $conn->prepare ( "DELETE FROM ".TABLENAME_USERS." WHERE id = :id LIMIT 1" );
			$st->bindValue( ":id", $this->id, PDO::PARAM_INT );
			$st->execute();
			$conn = null;		
		}
        public static function getList(){
			$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
			$row=array();
			$row1=array();
			$sql = "SELECT * FROM ".TABLENAME_USERS."";
			$st = $conn->prepare( $sql );
			$st->execute();
			while ($row = $st->fetch())
			{
			$row1[]=$row;
			}
			$conn = null;
     
			if( $row1 ) return $row1 ;
		}
		  public static function getUserList($id){
			$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
			$row=array();
			$row1=array();
			$sql = "SELECT * FROM ".TABLENAME_USERS." WHERE id != :id";
			$st = $conn->prepare( $sql );
			$st->bindValue( ":id", $id, PDO::PARAM_INT );
			$st->execute();
			while ($row = $st->fetch())
			{
			$row1[]=$row;
			}
			$conn = null;
     
			if( $row1 ) return $row1 ;
		}		
		   public static function getSuggestions($gender,$age,$id){
			$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
			$row=array();
			$row1=array();
			$age1=$age+2;
			$age2=$age-2;
			$sql = "SELECT * FROM ".TABLENAME_USERS." WHERE id != :id AND gender != :gender AND (age >= :age2 AND age<= :age1) ";
			$st = $conn->prepare( $sql );
			$st->bindValue( ":id", $id, PDO::PARAM_INT );
			$st->bindValue( ":gender", $gender, PDO::PARAM_INT );
			$st->bindValue( ":age1", $age1, PDO::PARAM_INT );
			$st->bindValue( ":age2", $age2, PDO::PARAM_INT );
			$st->execute();
			while ($row = $st->fetch())
			{
			$row1[]=$row;
			}
			$conn = null;
     
			if( $row1 ) return $row1 ;
		}		
	}
?>