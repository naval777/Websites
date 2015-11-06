<?php
	
		
	class Group {
		
		public $id = null;
		public $name = null;
		public $caption = null;
		public $adminId = null;
		public $per2Id = null;
		public $per3Id = null;
		public $icon_link = null;
		public $status = null;
	
		public static $errorMessage;
		public static $errorCode;
		public static $successMessage;

		public function __construct( $data = array() ) {
			
if( isset( $data['id'] ) ) $this->id = (int) $data['id'];
if( isset( $data['name'] ) )    $this->name = $data['name'];
if( isset( $data['caption'] ) ) $this->caption = $data['caption'];
if( isset( $data['adminId'] ) ) $this->adminId = (int) $data['adminId'];
if( isset( $data['per2Id'] ) ) $this->per2Id = (int) $data['per2Id'];
if( isset( $data['per3Id'] ) ) $this->per3Id = (int) $data['per3Id'];
if( isset( $data['icon_link'] ) ) $this->icon_link = $data['icon_link'];
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
			$sql = "INSERT INTO ".TABLENAME_GROUPS." ( name, caption, adminId, per2Id, per3Id, icon_link,status ) VALUES ( :name, :caption, :adminId, :per2Id, :per3Id, :icon_link, :status)";
			$st = $conn->prepare( $sql );
			$st->bindValue( ":name", $this->name, PDO::PARAM_STR );
			$st->bindValue( ":caption", $this->caption, PDO::PARAM_STR );
			$st->bindValue( ":adminId", $this->adminId, PDO::PARAM_INT );
			$st->bindValue( ":per2Id", $this->per2Id, PDO::PARAM_INT );
			$st->bindValue( ":per3Id", $this->per3Id, PDO::PARAM_INT );
			$st->bindValue( ":icon_link", $this->icon_link, PDO::PARAM_STR );
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
	

		public function update(){
				
			//Does the object have an ID?
			if( is_null( $this->id ) ) trigger_error( "User::update(): Attempt to update a user object that does not have its ID property set.", E_USER_ERROR );
			
		

			//Update the object
			$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );		
			$sql = "UPDATE ".TABLENAME_GROUPS." SET name=:name, caption=:caption, adminId=:adminId, per2Id=:per2Id, per3Id=:per3Id, icon_link=:icon_link, status=:status  WHERE id = :id";
			$st = $conn->prepare( $sql );
			$st->bindValue( ":name", $this->name, PDO::PARAM_STR );
			$st->bindValue( ":caption", $this->caption, PDO::PARAM_STR );
			$st->bindValue( ":adminId", $this->adminId, PDO::PARAM_INT );
			$st->bindValue( ":per2Id", $this->per2Id, PDO::PARAM_INT );
			$st->bindValue( ":per3Id", $this->per3Id, PDO::PARAM_INT );
			$st->bindValue( ":icon_link", $this->icon_link, PDO::PARAM_STR );
			$st->bindValue( ":status", $this->status, PDO::PARAM_STR );
			$st->bindValue( ":id", $this->id, PDO::PARAM_INT );
			echo "<br>";
			$st->execute();
		//	print_r($st->errorInfo());
			$conn = null;	
			
			return true;
		}
		public function updateStatus(){
				
			//Does the object have an ID?
			if( is_null( $this->id ) ) trigger_error( "User::update(): Attempt to update a user object that does not have its ID property set.", E_USER_ERROR );
			
		

			//Update the object
			$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );		
			$sql = "UPDATE ".TABLENAME_GROUPS." SET status=:status  WHERE id = :id";
			$st = $conn->prepare( $sql );
			$st->bindValue( ":status", $this->status, PDO::PARAM_STR );
			$st->bindValue( ":id", $this->id, PDO::PARAM_INT );
			echo "<br>";
			$st->execute();
		//	print_r($st->errorInfo());
			$conn = null;	
			
			return true;
		}
          public function updateImage(){
				
			//Does the object have an ID?
			if( is_null( $this->id ) ) trigger_error( "User::update(): Attempt to update a user object that does not have its ID property set.", E_USER_ERROR );
			$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );		
			$sql = "UPDATE ".TABLENAME_GROUPS." SET icon_link=:icon_link WHERE id = :id";
			$st = $conn->prepare( $sql );
			$st->bindValue( ":icon_link", $this->icon_link, PDO::PARAM_STR );
			
			$st->bindValue( ":id", $this->id, PDO::PARAM_INT );
			$st->execute();
			$conn = null;

			return true;
			
			} 
	
		
			public static function getById( $id ){
			$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
			$sql = "SELECT * FROM ".TABLENAME_GROUPS." WHERE id = :id ";
			$st = $conn->prepare( $sql );
			$st->bindValue( ":id", $id, PDO::PARAM_INT );
			$st->execute();
			$row = $st->fetch();
			$conn = null;
			if( $row ) return new Group( $row );
		}
		public static function getByMembers( $adminId,$per2Id,$per3Id ){
			$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
			$sql = "SELECT * FROM ".TABLENAME_GROUPS." WHERE adminId = :adminId AND ((per2Id = :per2Id AND per3Id = :per3Id) OR (per2Id = :per3Id AND per3Id = :per2Id)) ";
			$st = $conn->prepare( $sql );
			$st->bindValue( ":adminId", $adminId, PDO::PARAM_INT );
			$st->bindValue( ":per2Id", $per2Id, PDO::PARAM_INT );
			$st->bindValue( ":per3Id", $per3Id, PDO::PARAM_INT );
			$st->execute();
			$row = $st->fetch();
			$conn = null;
			if( $row ) return new Group( $row );
		}
		public static function getList(){
			$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
			$row1=array();
			$sql = "SELECT * FROM ".TABLENAME_GROUPS."";
			$st = $conn->prepare( $sql );
			$st->execute();
			while ($row = $st->fetch())
			{
			$row1[]=$row;
			}
			$conn = null;
     
			if( $row1 ) return $row1 ;
		}
		 public static function getGroupsList($id){
			$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
			$row=array();
			$row1=array();
			$sql = "SELECT * FROM ".TABLENAME_GROUPS." WHERE id != :id";
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
		public static function getListPendingByAdminId($adminId){
			$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
			$row1=array();
			$status="pending";
			$sql = "SELECT * FROM ".TABLENAME_GROUPS." WHERE adminId= :adminId AND status= :status";
			$st = $conn->prepare( $sql );
			$st->bindValue( ":adminId", $adminId, PDO::PARAM_INT );
			$st->bindValue( ":status", $status, PDO::PARAM_STR );
			$st->execute();
			while ($row = $st->fetch())
			{
			$row1[]=$row;
			}
			$conn = null;
     
			if( $row1 ) return $row1 ;
		}
		public static function getListOnlineByAdminId($adminId){
			$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
			$row1=array();
			$status="online";
			$sql = "SELECT * FROM ".TABLENAME_GROUPS." WHERE adminId= :adminId AND status= :status";
			$st = $conn->prepare( $sql );
			$st->bindValue( ":adminId", $adminId, PDO::PARAM_INT );
			$st->bindValue( ":status", $status, PDO::PARAM_STR );
			$st->execute();
			while ($row = $st->fetch())
			{
			$row1[]=$row;
			}
			$conn = null;
     
			if( $row1 ) return $row1 ;
		}
		public static function getListOnline($adminId){
			$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
			$row1=array();
			$status="online";
			$sql = "SELECT * FROM ".TABLENAME_GROUPS." WHERE (per2Id= :adminId OR per3Id= :adminId) AND status= :status";
			$st = $conn->prepare( $sql );
			$st->bindValue( ":adminId", $adminId, PDO::PARAM_INT );
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
			$st = $conn->prepare ( "DELETE FROM ".TABLENAME_GROUPS." WHERE id = :id LIMIT 1" );
			$st->bindValue( ":id", $this->id, PDO::PARAM_INT );
			$st->execute();
			$conn = null;		
		}

				
	}
?>