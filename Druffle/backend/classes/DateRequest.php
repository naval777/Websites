<?php
	
		
	class DateRequest {
		
		public $id = null;
		public $type = null;
		public $shopId = null;
		public $sentById = null;
		public $sentToGroupId = null;
		public $sentToUserId = null;
		public $status = null;
		public $date = null;
	
		public static $errorMessage;
		public static $errorCode;
		public static $successMessage;

		public function __construct( $data = array() ) {
			
if( isset( $data['id'] ) ) $this->id = (int) $data['id'];
if( isset( $data['type'] ) )    $this->type = $data['type'];
if( isset( $data['shopId'] ) ) $this->shopId = (int) $data['shopId'];
if( isset( $data['sentById'] ) ) $this->sentById = (int) $data['sentById'];
if( isset( $data['sentToGroupId'] ) ) $this->sentToGroupId = (int) $data['sentToGroupId'];
if( isset( $data['sentToUserId'] ) ) $this->sentToUserId = (int) $data['sentToUserId'];
if( isset( $data['status'] ) ) $this->status = $data['status'];
if( isset( $data['date'] ) ) $this->date = $data['date'];



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
			$sql = "INSERT INTO ".TABLENAME_DATEREQUESTS." ( type, shopId, sentById, sentToGroupId, sentToUserId, status, date ) VALUES ( :type, :shopId, :sentById, :sentToGroupId, :sentToUserId, :status, :date)";
			$st = $conn->prepare( $sql );
			$st->bindValue( ":type", $this->type, PDO::PARAM_STR );
			$st->bindValue( ":shopId", $this->shopId, PDO::PARAM_INT );
			$st->bindValue( ":sentById", $this->sentById, PDO::PARAM_INT );
			$st->bindValue( ":sentToGroupId", $this->sentToGroupId, PDO::PARAM_INT );
			$st->bindValue( ":sentToUserId", $this->sentToUserId, PDO::PARAM_INT );
			$st->bindValue( ":status", $this->status, PDO::PARAM_STR );
			$st->bindValue( ":date", $this->date, PDO::PARAM_STR );
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
			$sql = "SELECT * FROM ".TABLENAME_DATEREQUESTS." WHERE id = :id ";
			$st = $conn->prepare( $sql );
			$st->bindValue( ":id", $id, PDO::PARAM_INT );
			$st->execute();
			$row = $st->fetch();
			$conn = null;
			if( $row ) return new DateRequest( $row );
		}
		
		
		public static function getOthers( $sentById, $type, $sentToGroupId, $sentToUserId ){
		    $type="date";
			$row1=array();
			$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
			$sql = "SELECT * FROM ".TABLENAME_DATEREQUESTS." WHERE sentById = :sentById AND type = :type AND sentToUserId != :sentToUserId AND sentToGroupId= :sentToGroupId ";
			$st = $conn->prepare( $sql );
			$st->bindValue( ":sentById", $sentById, PDO::PARAM_INT );
			$st->bindValue( ":type", $type, PDO::PARAM_STR );
			$st->bindValue( ":sentToUserId", $sentToUserId, PDO::PARAM_INT );
			$st->bindValue( ":sentToGroupId", $sentToGroupId, PDO::PARAM_INT );
			$st->execute();
			while ($row = $st->fetch())
			{
			$row1[]=$row;
			}
			$conn = null;
     
			if( $row1 ) return $row1 ;
		}
		
		
		public static function getByUserGroupId( $sentById, $sentToGroupId, $sentToUserId ){
		    $type="date";
			$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
			$sql = "SELECT * FROM ".TABLENAME_DATEREQUESTS." WHERE sentById = :sentById AND type = :type AND sentToUserId = :sentToUserId AND sentToGroupId= :sentToGroupId ";
			$st = $conn->prepare( $sql );
			$st->bindValue( ":sentById", $sentById, PDO::PARAM_INT );
			$st->bindValue( ":type", $type, PDO::PARAM_STR );
			$st->bindValue( ":sentToUserId", $sentToUserId, PDO::PARAM_INT );
			$st->bindValue( ":sentToGroupId", $sentToGroupId, PDO::PARAM_INT );
			$st->execute();
			$row = $st->fetch();
			$conn = null;
			if( $row ) return new DateRequest( $row );
		}
		
		
		public static function getByGroup( $sentById,$type ){
			$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
			$sql = "SELECT * FROM ".TABLENAME_DATEREQUESTS." WHERE sentById = :sentById AND type = :type  ";
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
			public function update(){
				
			//Does the object have an ID?
			if( is_null( $this->id ) ) trigger_error( "User::update(): Attempt to update a user object that does not have its ID property set.", E_USER_ERROR );
			
		

			//Update the object
			$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );		
			$sql = "UPDATE ".TABLENAME_DATEREQUESTS." SET status=:status  WHERE id = :id";
			$st = $conn->prepare( $sql );
			$st->bindValue( ":status", $this->status, PDO::PARAM_STR );
			$st->bindValue( ":id", $this->id, PDO::PARAM_INT );
			echo "<br>";
			$st->execute();
		//	print_r($st->errorInfo());
			$conn = null;	
			
			return true;
		}
	
			public static function getByUserId( $sentToUserId,$sentToGroupId ){
			$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
			$row1=array();
			$status = "pending";
			$sql = "SELECT * FROM ".TABLENAME_DATEREQUESTS." WHERE sentToUserId = :sentToUserId AND status = :status AND sentToGroupId = :sentToGroupId ";
			$st = $conn->prepare( $sql );
			$st->bindValue( ":sentToGroupId", $sentToGroupId, PDO::PARAM_INT );
			$st->bindValue( ":sentToUserId", $sentToUserId, PDO::PARAM_INT );
			$st->bindValue( ":status", $status, PDO::PARAM_STR );
			$st->execute();
			while ($row = $st->fetch())
			{
			$row1[]=$row;
			}
			$conn = null;
     
			if( $row1 ) return $row1 ;
		}
		public static function getByGroupId( $sentById ){
			$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
			$row1=array();
			$sql = "SELECT * FROM ".TABLENAME_DATEREQUESTS." WHERE sentById = :sentById ";
			$st = $conn->prepare( $sql );
			$st->bindValue( ":sentById", $sentById, PDO::PARAM_INT );
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
			$st = $conn->prepare ( "DELETE FROM ".TABLENAME_DATEREQUESTS." WHERE id = :id LIMIT 1" );
			$st->bindValue( ":id", $this->id, PDO::PARAM_INT );
			$st->execute();
			$conn = null;		
		}

				
	}
?>