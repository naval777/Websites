<?php
	
		
	class Question {
		
		public $id = null;
		public $userId = null;
		public $question = null;
	    public $answer = null;
		public static $errorMessage;
		public static $errorCode;
		public static $successMessage;

		public function __construct( $data = array() ) {
			
if( isset( $data['id'] ) ) $this->id = (int) $data['id'];
if( isset( $data['userId'] ) )    $this->userId =  $data['userId'];
if( isset( $data['question'] ) ) $this->question = $data['question'];
if( isset( $data['answer'] ) ) $this->answer = $data['answer'];


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
			$sql = "INSERT INTO ".TABLENAME_QUESTIONS." ( userId, question, answer ) VALUES ( :userId, :question ,:answer)";
			$st = $conn->prepare( $sql );
			$st->bindValue( ":userId", $this->userId, PDO::PARAM_INT );
			$st->bindValue( ":question", $this->question, PDO::PARAM_STR );
			$st->bindValue( ":answer", $this->answer, PDO::PARAM_STR );
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
			$sql = "SELECT * FROM ".TABLENAME_QUESTIONS." WHERE id = :id ";
			$st = $conn->prepare( $sql );
			$st->bindValue( ":id", $id, PDO::PARAM_INT );
			$st->execute();
			$row = $st->fetch();
			$conn = null;
			if( $row ) return new DateRequest( $row );
		}
	
		public function update(){
				
			//Does the object have an ID?
			if( is_null( $this->id ) ) trigger_error( "User::update(): Attempt to update a user object that does not have its ID property set.", E_USER_ERROR );
			
		

			//Update the object
			$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );		
			$sql = "UPDATE ".TABLENAME_QUESTIONS." SET question=:question, answer=:answer, userId = :userId  WHERE id = :id";
			$st = $conn->prepare( $sql );
			$st->bindValue( ":question", $this->question, PDO::PARAM_STR );
			$st->bindValue( ":answer", $this->answer, PDO::PARAM_STR );
			$st->bindValue( ":userId", $this->userId, PDO::PARAM_INT );
			$st->bindValue( ":id", $this->id, PDO::PARAM_INT );
			echo "<br>";
			$st->execute();
		//	print_r($st->errorInfo());
			$conn = null;	
			
			return true;
		}
		 
		public static function getList(){
			$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
			$row1=array();
			$userId = 0;
			$sql = "SELECT * FROM ".TABLENAME_QUESTIONS." WHERE userId = :userId";
			$st = $conn->prepare( $sql );
			$st->bindValue( ":userId", $userId, PDO::PARAM_INT );
			$st->execute();
			while ($row = $st->fetch())
			{
			$row1[]=$row;
			}
			$conn = null;
     
			if( $row1 ) return $row1 ;
		}
		public static function getAnswerByUserId($userId,$question){
		$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
			
		$sql = "SELECT * FROM ".TABLENAME_QUESTIONS." WHERE userId = :userId AND question = :question ";
			$st = $conn->prepare( $sql );
			$st->bindValue( ":question", $question, PDO::PARAM_STR );
			$st->bindValue( ":userId", $userId, PDO::PARAM_INT );
			$st->execute();
			$row = $st->fetch();
			$conn = null;
			if( $row ) return new Question( $row );
		
		}
		public static function getByUserId( $userId ){
			$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
			$row1=array();
			$sql = "SELECT * FROM ".TABLENAME_QUESTIONS." WHERE userId = :userId ";
			$st = $conn->prepare( $sql );
			$st->bindValue( ":userId", $userId, PDO::PARAM_INT );
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
			$st = $conn->prepare ( "DELETE FROM ".TABLENAME_QUESTIONS." WHERE id = :id LIMIT 1" );
			$st->bindValue( ":id", $this->id, PDO::PARAM_INT );
			$st->execute();
			$conn = null;		
		}

				
	}
?>