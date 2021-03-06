
<?php
	
		
	class Message {
		
		public $id = null;
		public $sentById = null;
		public $sentToId = null;
		public $sentByUserId = null;
		public $createdOn = null;
		public $message = null;
		public $status = null;
		
	
		public static $errorMessage;
		public static $errorCode;
		public static $successMessage;

		public function __construct( $data = array() ) {
			
if( isset( $data['id'] ) ) $this->id = (int) $data['id'];
if( isset( $data['sentById'] ) ) $this->sentById = (int) $data['sentById'];
if( isset( $data['sentToId'] ) ) $this->sentToId = (int) $data['sentToId'];
if( isset( $data['sentByUserId'] ) )    $this->sentByUserId = $data['sentByUserId'];
if( isset( $data['createdOn'] ) )    $this->createdOn = $data['createdOn'];
if( isset( $data['message'] ) )    $this->message = $data['message'];
if( isset( $data['status'] ) ) $this->status = $data['status'];



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
		
				
     		$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
			$sql = "INSERT INTO ".TABLENAME_MESSAGES." ( sentById, sentToId, sentByUserId, message, status ) VALUES ( :sentById, :sentToId, :sentByUserId, :message, :status)";
			$st = $conn->prepare( $sql );
			$st->bindValue( ":sentById", $this->sentById, PDO::PARAM_INT );
			$st->bindValue( ":sentToId", $this->sentToId, PDO::PARAM_INT );
			$st->bindValue( ":sentByUserId", $this->sentByUserId, PDO::PARAM_INT );
			$st->bindValue( ":message", $this->message, PDO::PARAM_STR );
			$st->bindValue( ":status", $this->status, PDO::PARAM_STR );
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
	

		
    
	
		
			public static function getById( $id ){
			$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
			$sql = "SELECT * FROM ".TABLENAME_MESSAGES." WHERE id = :id ";
			$st = $conn->prepare( $sql );
			$st->bindValue( ":id", $id, PDO::PARAM_INT );
			$st->execute();
			$row = $st->fetch();
			$conn = null;
			if( $row ) return new Request( $row );
		}
		public static function getOther( $sentById,$type,$sentToId ){
			$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
			$sql = "SELECT * FROM ".TABLENAME_MESSAGES." WHERE sentById = :sentById AND type = :type AND sentToId != :sentToId ";
			$st = $conn->prepare( $sql );
			$st->bindValue( ":sentById", $sentById, PDO::PARAM_INT );
			$st->bindValue( ":type", $type, PDO::PARAM_STR );
			$st->bindValue( ":sentToId", $sentToId, PDO::PARAM_INT );
			$st->execute();
			$row = $st->fetch();
			$conn = null;
			if( $row ) return new Request( $row );
		}
		public static function getByGroup( $sentById,$type ){
			$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
			$sql = "SELECT * FROM ".TABLENAME_MESSAGES." WHERE sentById = :sentById AND type = :type  ";
			$st = $conn->prepare( $sql );
			$st->bindValue( ":sentById", $sentById, PDO::PARAM_INT );
			$st->bindValue( ":type", $type, PDO::PARAM_STR );
		
			$st->execute();
			while ($row = $st->fetch())
			{
			$row1[]=$row;
			}
			$conn = null;
     
			if( $row1 ) return $row1 ;
		}
		
		
			public static function getByUserId( $sentToId ){
			$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
			$row1=array();
			$status = "pending";
			$sql = "SELECT * FROM ".TABLENAME_MESSAGES." WHERE sentToId = :sentToId AND status = :status ";
			$st = $conn->prepare( $sql );
			$st->bindValue( ":sentToId", $sentToId, PDO::PARAM_INT );
			$st->bindValue( ":status", $status, PDO::PARAM_STR );
			$st->execute();
			while ($row = $st->fetch())
			{
			$row1[]=$row;
			}
			$conn = null;
     
			if( $row1 ) return $row1 ;
		}
		
		
	
		
	
		public function delete(){
						
			//Does the object have an ID?
			if( is_null( $this->id ) ) trigger_error( "User::delete(): Attempt to delete a user object that does not have its ID property set.", E_USER_ERROR );
			
			//Delete the object
			$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
			$st = $conn->prepare ( "DELETE FROM ".TABLENAME_MESSAGES." WHERE id = :id LIMIT 1" );
			$st->bindValue( ":id", $this->id, PDO::PARAM_INT );
			$st->execute();
			$conn = null;		
		}

				
	}
?>