<?php
	session_start();

	require("config.php");
    $action = isset( $_GET['action'] ) ? $_GET['action'] : "";
	$userId = isset( $_SESSION['userId'] ) ? $_SESSION['userId']: "";
	
	// Send to login by default
	//if( $action != "login" && $action != "logout" && !$username){
		//login();
		//exit;
	//}
	
	switch( $action ){
		case 'login';
			login();
			break;
		case 'logout';
			logout();
			break;
		case 'register';
			register();
			break;
		case 'update';
			update();
			break;
		case 'updatePassword';
			updatePassword();
			break;
		case 'addImage';
            addImage();
            break;
        case 'updateGroupImage';
            updateGroupImage();
            break;
        case 'createGroup';
			createGroup();
			break;			
		case 'acceptGroupRequest';
			acceptGroupRequest();
			break;	
		case 'declineGroupRequest';
			declineGroupRequest();
			break;	
        case 'acceptChatRequest';
			acceptChatRequest();
			break;	
		case 'declineChatRequest';
			declineChatRequest();
			break;
        case 'acceptDateRequest';
			acceptDateRequest();
			break;	
		case 'declineDateRequest';
			declineDateRequest();
			break;			
		case 'assignGroup';
			assignGroup();
			break;		
		case 'profileSearch';
			profileSearch();
			break;
		case 'dateForm';
			dateForm();
			break;
		case 'viewProfile';
			viewProfile();
			break;
		case 'createChatGroup';
			createChatGroup();
			break;
		 case 'updateChatGroupImage';
            updateChatGroupImage();
            break;	
	    case 'chat';
			chat();
			break;
		case 'dateRequest';
			dateRequest();
			break;	
		case 'loadMessage';
			loadMessage();
			break;
		case 'loadMessageByUser';
			loadMessageByUser();
			break;
		case 'shout';
			shout();
			break;
		case 'addQuestion';
			addQuestion();
			break;
		case 'addAnswer';
			addAnswer();
			break;
		case 'addShop';
			addShop();
			break;	
		case 'idUpload';
			idUpload();
			break;	
		case 'updateForm';
		     updateForm();
			break;
		case 'updateUserImage';
		     updateUserImage();
			break;
		default:
			login();
	}


	function login(){													// login.. checks if session already set.. 
		$results = array();
		$results['pageTitle'] = "Home | Dating website";
	
		 if( !isset( $_SESSION['email'] ) ){
			 if(isset($_POST['email']))
			 {
				$email = $_POST['email'];
				$password = $_POST['password'];
				$passwordHash = Password::hash( $password );
				//echo $passwordHash;
				if( $user = User::getByEmail( $email ) ){
					if( $passwordHash == $user->password ){
					   if($user->verification=="verified")
					   {
						$_SESSION['email'] = $email;
						$_SESSION['userId'] = $user->id;
						
					require( TEMPLATE_PATH . "/home.php" );     // if its a verified account goes to home
					}
					elseif ($user->verification=="notVerified"){
						$results['errorMessage'] = "Account not activated please wait";
						require( TEMPLATE_PATH . "/loginForm.php" );			// if account not verif goes to login form
					}
				    else
					{
					$results['errorMessage'] = "Information provided is not valid";
						require( TEMPLATE_PATH . "/loginForm.php" );
					}
					}
					else {
						$results['errorMessage'] = "Username and password do not match.";
						require( TEMPLATE_PATH . "/loginForm.php" );
					}
				}
				else {
					$results['errorMessage'] = "Username not found, please register first.";
					require( TEMPLATE_PATH . "/loginForm.php" );
				}
			
		}
		else
		require( TEMPLATE_PATH . "/loginForm.php" );
		
		}
		else{
			$user = User::getByEmail( $_SESSION['email'] );
			
			require( TEMPLATE_PATH . "/home.php" ); 
		  //temporary until logout is created .. login form musn't be accessible.. looks unproffes... login form is hidden when session is on.
	
		}
	}
	function assignGroup(){
      if(isset($_POST['groupId']))
	  {
       		
				 
				 $_SESSION['groupId'] = $_POST['groupId'];
	           require( TEMPLATE_PATH . "/home.php" );         
	
	
	
	}
	}
		function profileSearch(){
		$user=User::getById($_SESSION['userId']);
		$suggestions = User::getSuggestions($user->gender,$user->age,$_SESSION['userId']);  // sugg based on gender, age
        require( TEMPLATE_PATH . "/profileSearch.php" );  
	}
		function dateForm(){
		
        require( TEMPLATE_PATH . "/datingPage.php" );   // WHAT IS THIS??
	}
	function viewProfile(){
		if(isset($_POST['personId']))
		$_SESSION['personId']=$_POST['personId'];    // got id .. load info acc to it
        require( TEMPLATE_PATH . "/profile.php" );  
	}
	
	function chat(){
		
		
		$group1Members= Group::getById($_SESSION['groupId']);
		if(isset($_POST['groupId1']))
		$_SESSION['groupId1']=$_POST['groupId1'];
		$group2Members= Group::getById($_SESSION['groupId1']);
        require( TEMPLATE_PATH . "/conversationPage.php" );  
		
	}
	function loadMessage(){
	$db_username = 'root';
$db_password = '';
$db_name = 'dating';
$db_host = '127.0.0.1';
$sql_con = mysqli_connect($db_host, $db_username, $db_password,$db_name)or die('could not connect to database');
	
		if($_POST["fetch"]==1)
	{
	   $sentById=$_SESSION['groupId']; 
	   $sentToId=$_SESSION['groupId1'];
	   if(isset($_SESSION['chatId']))
	   {
	   $chatId=$_SESSION['chatId'];
	   $chatId1=$_SESSION['userId'];
	   $results = mysqli_query($sql_con,"SELECT sentByUserId, message, date_time FROM (select * from messages ORDER BY id DESC LIMIT 10) messages WHERE sentById = $sentById AND sentToId = $sentToId AND (sentByUserId = $chatId1 OR sentByUserId = $chatId) ORDER BY messages.id ASC");
	   }
	   else
		$results = mysqli_query($sql_con,"SELECT sentByUserId, message, date_time FROM (select * from messages ORDER BY id DESC LIMIT 10) messages WHERE sentById = $sentById AND sentToId = $sentToId ORDER BY messages.id ASC");
		while($row = mysqli_fetch_array($results))
		{
			$msg_time = date('h:i A M d',strtotime($row["date_time"])); //message posted time
			echo '<div class="shout_msg"><time>'.$msg_time.'</time><span class="username">'.User::getById($row["sentByUserId"])->name.'</span> <span class="message">'.$row["message"].'</span></div>';
		}
	}
	
	}
	function loadMessageByUser(){				// message load by user ????????
	
	   $_SESSION['chatId']=$_POST['userId'];
		header('Location:index.php?action=chat');
	
	}
	function logout(){
		unset( $_SESSION['email'] );
		unset( $_SESSION['userId'] );
		unset( $_SESSION['groupId'] );
		unset( $_SESSION['groupId1'] );
		unset( $_SESSION['chatId'] );
		unset( $_SESSION['profileId'] );
		header("Location: /dating_website/templates/loginForm.php");     // main land page specifically.
	}

	function register(){										// fb register
	          
            define('FACEBOOK_APP_ID', '1509766599252478');
            define('FACEBOOK_SECRET', '2c22458bc5c89fade0c5e810cb457414');

			// No need to change function body
            function parse_signed_request($signed_request, $secret) {
                list($encoded_sig, $payload) = explode('.', $signed_request, 2);

                // decode the data
                $sig = base64_url_decode($encoded_sig);
                $data = json_decode(base64_url_decode($payload), true);

                if (strtoupper($data['algorithm']) !== 'HMAC-SHA256') {
                    error_log('Unknown algorithm. Expected HMAC-SHA256');
                    return null;
                }

                // check sig
                $expected_sig = hash_hmac('sha256', $payload, $secret, $raw = true);
                if ($sig !== $expected_sig) {
                    error_log('Bad Signed JSON signature!');
                    return null;
                }

                return $data;
            }

            function base64_url_decode($input) {
                return base64_decode(strtr($input, '-_', '+/'));
            }

            if ($_REQUEST) {
                $response = parse_signed_request($_REQUEST['signed_request'],
                                FACEBOOK_SECRET);
				/*
				echo "<pre>";
				print_r($response);
				echo "</pre>"; // Uncomment this for printing the response Array
				*/
                
             }				
              

      
	
		$results = array();	
		$results['pageTitle'] = "Register | Name of the website";	
		$user = new User( $response["registration"] );
		
		   $birthDate = $user->birthday;
  $birthDate = explode("/", $birthDate);
   $user->age = (date("md", date("U", mktime(0, 0, 0, $birthDate[0], $birthDate[1], $birthDate[2]))) > date("md")
    ? ((date("Y") - $birthDate[2]) - 1)
    : (date("Y") - $birthDate[2]));
 
    $user->icon_link = DEFAULT_USER_IMAGE;
	$user->id_link = default_image;
    $user->verification="notVerified";	
		if( $user->insert() ){
			$results['successMessage'] = "Registration successful. Please login.";
			
			require( TEMPLATE_PATH . "/verification.php" );
		}		
		else{
			//echo User::errorInfo();
			if( User::errorCode() == 23000 )
				$results['errorMessage'] = "Registration unsuccessful, user already exists. <a href=\"#\">Forgot Password?</a>";
			else if( User::errorCode() == "ERR_INV_EMAIL" )
				$results['errorMessage'] = "Registration unsuccessful, invalid email address provided.";
			else if( User::errorCode() == "ERR_INV_NAME" )
				$results['errorMessage'] = "Registration unsuccessful, invalid name provided.";
			else if( User::errorCode() == "ERR_INV_PHONE" )
				$results['errorMessage'] = "Registration unsuccessful, invalid phone number provided.";	
			else
				$results['errorMessage'] = "Registration unsuccessful. Please try again.";
				
			require( TEMPLATE_PATH . "/loginForm.php" );	
		}	
	}																			// end of fb registr
	
	
    function idUpload(){
	$user = User::getById($_POST['userId']);
	
	if ( isset($_FILES["image"]) ) {
		$imageName = "image";
		$type = "verification";
		$typeId = $_POST['userId'];
		$imageLocation = ID_UPLOAD_LOCATION;	
		$user->id_link = uploadImage( $imageName,$imageLocation,$type,$typeId );
		
		}
		print_r($user);
		$user->updateIdImage();
	    require( TEMPLATE_PATH . "/loginForm.php" );	
	}
	
	function updatePassword(){
		$results = array();	
		$results['pageTitle'] = "Profile Update | Dating website";	
		$results['user'] = User::getById($_SESSION['userId']);
		if( $_POST['password'] == $_POST['password_confirmation']  ){
			$user = new User( $_POST );
			$user->id = $results['user']->id;
			//echo $user->id;

			if( $user->updatePassword() )
			{
				$results['successMessage'] = "Update successful.";
				$results['user'] = $user;
			}
			else{
				//echo User::errorInfo();
				if( User::errorCode() == "ERR_INV_PASS" )
					$results['errorMessage'] = "Update unsuccessful, password should atleast be 6 characters long.";
				else
					$results['errorMessage'] = "Update unsuccessful. Please try again.";
			}
		}
		else{
			$results['errorMessage'] = "Update unsuccessful. Passwords do not match.";
		}
		require( TEMPLATE_PATH . "/updateForm.php" );
	}
	function update(){
		$results = array();	
		$results['pageTitle'] = "Profile Update | Dating website";	
		$results['user'] = User::getById( $_SESSION['userId'] );
   
		if( isset( $_POST['userId'] ) ){
			$user = new User( $_POST );
			$user->id = $results['user']->id;
			
	
			if( $user->update() )
			{
				$results['successMessage'] = "Update successful.";
				$results['user'] = $user;
			}
			else{
				//echo User::errorInfo();
				if( User::errorCode() == "ERR_INV_NAME" )
					$results['errorMessage'] = "Update unsuccessful, invalid name provided.";
				else if( User::errorCode() == "ERR_INV_PHONE" )
					$results['errorMessage'] = "Update unsuccessful, invalid phone number provided.";
				else
					$results['errorMessage'] = "Update unsuccessful. Please try again.";
			}
		}
		require( TEMPLATE_PATH . "/updateForm.php" );
		
	}
	 
    function updateForm() {
    require( TEMPLATE_PATH . "/updateForm.php" );
	}
	function updateUserImage() {
	    
		$results = array();	
		
		//echo $type;
		$user = new User( $_POST );
		$user->id = $_POST['userId'];
			if ( isset($_FILES["image"]) ) {
		$imageName = "image";
		$type = "user";
		$typeId = $_POST['userId'];
		$imageLocation = IMAGE_UPLOAD_LOCATION;	
		$user->icon_link = uploadImage( $imageName,$imageLocation,$type,$typeId );
		
		}
		else {
			$user->icon_link = DEFAULT_IMAGE_LOCATION;
			
		}
		//print_r($_POST);
		if( $user->updateImage() ){
			$results['successMessage'] = "Updated image successfully.";
			
		require( TEMPLATE_PATH . "/updateForm.php" );
		
		}
		
	}
	function updateGroupImage() {
	    
		$results = array();	
		
		//echo $type;
		$group = new Group( $_POST );
		$group->id = $_POST['groupId'];
			if ( isset($_FILES["image"]) ) {
		$imageName = "image";
		$type = "group";
		$typeId = $_POST['groupId'];
		$imageLocation = IMAGE_UPLOAD_LOCATION;	
		$group->icon_link = uploadImage( $imageName,$imageLocation,$type,$typeId );
		
		}
		else {
			$group->icon_link = DEFAULT_IMAGE_LOCATION;
			
		}
		//print_r($_POST);
		if( $group->updateImage() ){
			$results['successMessage'] = "Updated image successfully.";
			
		require( TEMPLATE_PATH . "/home.php" );
		
		}
		
	}
	function updateChatGroupImage() {
	    
		$results = array();	
		
		//echo $type;
		$chatGroup = new ChatGroup( $_POST );
		$chatGroup->id = $_POST['chatGroupId'];
			if ( isset($_FILES["image"]) ) {
		$imageName = "image";
		$type = "chatGroup";
		$typeId = $_POST['chatGroupId'];
		$imageLocation = IMAGE_UPLOAD_LOCATION;	
		$chatGroup->icon_link = uploadImage( $imageName,$imageLocation,$type,$typeId );
		
		}
		
		//print_r($_POST);
		if( $chatGroup->updateImage() ){
			$results['successMessage'] = "Updated image successfully.";
			
		header('Location:index.php?action=chat');
		
		}
		
	}
	
	function shout(){
	
	####### db config ##########
$db_username = 'root';
$db_password = '';
$db_name = 'dating';
$db_host = '127.0.0.1';
####### db config end ##########

if($_POST)
{
	//connect to mysql db
	$sql_con = mysqli_connect($db_host, $db_username, $db_password,$db_name)or die('could not connect to database');
	//check if its an ajax request, exit if not
    if(!isset($_SERVER['HTTP_X_REQUESTED_WITH']) AND strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') {
        die();
    } 
	
	if(isset($_POST["message"]) &&  strlen($_POST["message"])>0)			// this doesnt allow blank mess.
	{
	
	   
		//sanitize user name and message received from chat box
		//You can replace username with registerd username, if only registered users are allowed.
		$sentById = filter_var(trim($_POST["sentById"]),FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH);
		$sentByUserId = filter_var(trim($_POST["sentByUserId"]),FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH);
		$sentToId = filter_var(trim($_POST["sentToId"]),FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH);
		$message = filter_var(trim($_POST["message"]),FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH);
		$icon_link= "default";
		$user_ip = $_SERVER['REMOTE_ADDR'];
		
		 if ( isset($_FILES["image"]) ) {
		$imageName = "image";
		$type = "message";
		$typeId = 0;
		$imageLocation = IMAGE_UPLOAD_LOCATION;	
		$icon_link1 = uploadImage( $imageName,$imageLocation,$type,$typeId );
		
		}

		//insert new message in db
		if(mysqli_query($sql_con,"INSERT INTO messages (sentById, sentToId, sentByUserId, icon_link, message, ip_address) value('$sentById','$sentToId','$sentByUserId','$icon_link','$message','$user_ip')"))
		{
			$msg_time = date('h:i A M d',time()); // current time
			echo '<div class="shout_msg"><time>'.$msg_time.'</time><span class="username">'.$sentByUserId.'</span><span class="message">'.$message;
			echo '</span></div>';
		}
		
		// delete all records except last 10, if you don't want to grow your db size!
		mysqli_query($sql_con,"DELETE FROM messages WHERE id NOT IN (SELECT * FROM (SELECT id FROM messages ORDER BY id DESC LIMIT 0, 10) as sb)");
	}
	
	else
	{
		header('HTTP/1.1 500 Are you kiddin me?');
    	exit();
	}
}
	
	
	
	
	
	}
	
    function createGroup(){
		$results = array();	
		$results['pageTitle'] = " Add an activity | Dating website";
		if($_POST)
		{
		$group = new Group( $_POST );
		
			$group->icon_link = DEFAULT_IMAGE_LOCATION;
	
			
			$group->status = "pending";
		$arr=explode(",",$_POST['blah']);
		$group->per2Id=$arr[0];
		$group->per3Id=$arr[1];
		if($arr[0]!=$arr[1])
		{
		if($group1 = Group::getByMembers( $group->adminId,$arr[0],$arr[1] ) ){
		$results['successMessage'] = "failed adding group already exists";
		require( TEMPLATE_PATH . "/home.php" );
		
		}
		//print_r($_POST);
		
		else
		{
		
		if( $group->insert() ){
			$results['successMessage'] = "Added group successfully.";
			$request= new Request();
			$request->type="accept";
			$request->sentById=$group->id;
			$request->status="pending";
			$request->sentToId=$group->per2Id;
			 if($request->insert())
			 $results['requestMessage']="a request has been sent successfully";
			 $request1= new Request();
			$request1->type="accept";
			$request1->sentById=$group->id;
			$request1->status="pending";
			$request1->sentToId=$group->per3Id;
			 if($request1->insert())
			 $results['requestMessage1']="a request has been sent successfully";
			//header('Location: ' . $_SERVER['HTTP_REFERER']);
		    require( TEMPLATE_PATH . "/home.php" );	
		}
		else
		{
		$results['successMessage'] = "failed adding group .";
		require( TEMPLATE_PATH . "/home.php" );
		//echo "fail";
		}
		}
		}
		else
		{
		$results['successMessage'] = "failed adding group same persons selected.";
		require( TEMPLATE_PATH . "/home.php" );
		}
		}
		else 
		require( TEMPLATE_PATH . "/home.php" );
	}
	 function createChatGroup(){
		$results = array();	
		$results['pageTitle'] = " Add an activity | Dating website";
		if(isset($_SESSION['groupId']))
		{
		$chatGroup = new ChatGroup( $_POST );
		$chatGroup->group1Id = $_SESSION['groupId'];
		$chatGroup->icon_link = DEFAULT_IMAGE_LOCATION;
        $chatGroup->status = "pending";
		$group2 = Group::getById($_POST['group2Id']);
	
		if( ChatGroup::getByGroupIds( $chatGroup->group1Id,$chatGroup->group2Id ) ){
		$results['errorMessage'] = "failed sending request, already exists";
		//require( TEMPLATE_PATH . "/home.php" );
		header('Location:index.php?action=viewProfile');
		
		}
		//print_r($_POST);
		
		else
		{
		
		if( $chatGroup->insert() ){
			$results['successMessage'] = "Added group successfully.";
			$request= new ChatRequest();
			$request->type="chat";
			$request->sentById=$chatGroup->group1Id;
			$request->status="pending";
			$request->sentToUserId=$group2->adminId;
			$request->sentToGroupId=$group2->id;
			 if($request->insert())
			 {
			$results['requestMessage']="a request has been sent successfully";
			}
			$request= new ChatRequest();
			$request->type="chat";
			$request->sentById=$chatGroup->group1Id;
			$request->status="pending";
			$request->sentToUserId=$group2->per2Id;
			$request->sentToGroupId=$group2->id;
			$request->insert();
			$request= new ChatRequest();
			$request->type="chat";
			$request->sentById=$chatGroup->group1Id;
			$request->status="pending";
			$request->sentToUserId=$group2->per3Id;
			$request->sentToGroupId=$group2->id;
			$request->insert();
			
			//header('Location: ' . $_SERVER['HTTP_REFERER']);
		    header('Location:index.php?action=viewProfile');
          		  
		}
		else
		{
		$results['errorMessage'] = "failed adding group ";
		header('Location:index.php?action=viewProfile');
		echo "fail";
		}
		}
		}
		else
		{
		$results['errorMessage'] = "select a group to proceed ";
		header('Location:index.php?action=viewProfile');
		
		}
		
	}
	function dateRequest(){     // hangout request
		$results = array();	
		$results['pageTitle'] = " Add an activity | Dating website";
		
			$group2 = Group::getById($_POST['dateGroupId']);
			$request= new DateRequest();
			$request->type="date";
			$request->shopId=$_POST['shopId'];	
			$request->sentById=$_POST['groupId'];
			$request->status="pending";
			$request->sentToUserId=$group2->adminId;				// user who receives
			$request->sentToGroupId=$_POST['dateGroupId'];			// group targeted
			$request->date = $_POST['date'];
			 if($request->insert())
			 {
			$results['requestMessage']="a request has been sent successfully";
			}
			$request= new DateRequest();
			$request->type="date";
		   	$request->shopId=$_POST['shopId'];	
			$request->sentById=$_POST['groupId'];
			$request->status="pending";
			$request->sentToUserId=$group2->per2Id;
			$request->sentToGroupId=$_POST['dateGroupId'];
			$request->date = $_POST['date'];
			$request->insert();
			$request= new DateRequest();
			$request->type="date";
			$request->shopId=$_POST['shopId'];	
			$request->sentById=$_POST['groupId'];
			$request->status="pending";
			$request->sentToUserId=$group2->per3Id;
			$request->sentToGroupId=$_POST['dateGroupId'];
			$request->date = $_POST['date'];
			$request->insert();
			
			//header('Location: ' . $_SERVER['HTTP_REFERER']);
		    header('Location:index.php?action=dateForm');
        
	}
	
	
	
	function acceptGroupRequest()
	{
	$request=Request::getById( $_GET['id'] );
	$request->status="accepted";
	$request->update();
	
	$request1=Request::getOther($request->sentById,$request->type,$request->sentToId);
	if(($request->status=="accepted")&&($request1->status=="accepted"))
	{
	$group=Group::getById( $request->sentById );
	$group->status="online";
	$group->updateStatus();
	}
	require( TEMPLATE_PATH . "/home.php" );
	}
	function declineGroupRequest()
	{
	$request=Request::getById( $_GET['id'] );
	$request->status="declined";
	$request->update();
	
	require( TEMPLATE_PATH . "/home.php" );
	}
	function acceptChatRequest()
	{
	$chatRequest=ChatRequest::getById( $_GET['id'] );
	$chatRequest->status="accepted";
	$chatRequest->update();
	
	$chatRequests=ChatRequest::getOthers($chatRequest->sentById,$chatRequest->type,$chatRequest->sentToGroupId,$chatRequest->sentToUserId);
	
	if((($chatRequests[0]['status']=="accepted")&&($chatRequests[1]['status']=="accepted")) || (($chatRequest->status=="accepted")&&($chatRequests[1]['status']=="accepted")) ||(($chatRequests[0]['status']=="accepted")&&($chatRequest->status=="accepted")))
	{
	$chatGroup=ChatGroup::getByGroupId( $chatRequest->sentById, $chatRequest->sentToGroupId );
	$chatGroup->status="online";
	$chatGroup->updateStatus();
	
	
	}
	require( TEMPLATE_PATH . "/home.php" );
	}
	function declineChatRequest()
	{
	$request=Request::getById( $_GET['id'] );
	$request->status="declined";
	$request->update();
	
	require( TEMPLATE_PATH . "/home.php" );
	}
	function acceptDateRequest()
	{
	$dateRequest=DateRequest::getById( $_GET['id'] );
	$dateRequest->status="accepted";
	$dateRequest->update();
	
	$dateRequests=DateRequest::getOthers($dateRequest->sentById,$dateRequest->type,$dateRequest->sentToGroupId,$dateRequest->sentToUserId);
	
	if(($dateRequests[0]['status']=="accepted")&&($dateRequests[1]['status']=="accepted") && ($dateRequest->status=="accepted") )
	{
	$dateRequest->status="successful";
	$dateRequest->update();
	
	
	}
	require( TEMPLATE_PATH . "/home.php" );
	}
	function declineDateRequest()
	{
	$request=ChatRequest::getById( $_GET['id'] );
	$request->status="declined";
	$request->update();
	
	require( TEMPLATE_PATH . "/home.php" );
	}
	
	function uploadImage( $imageName, $imageLocation, $type ,$typeId ){

		if ( !isset($results) ) {
			$results = array();
		}
		
		if ($_FILES[$imageName]['error'] === UPLOAD_ERR_OK) 
		{ 
  			$imageData = array();
			$imageData['imageName'] = $_FILES[$imageName]["name"];
			$imageData['type'] = $type;
			$imageData['typeId'] = $typeId;

	        if( is_dir( $imageLocation ) == false )
	        {
            	mkdir( $imageLocation, 0777 );		// Create directory if it does not exist
            }
            if( is_file( $imageLocation.'/'.$imageData['imageName'] ) == false )
            {
                move_uploaded_file( $_FILES[$imageName]["tmp_name"], $imageLocation.'/'.$imageData['imageName'] );
            }
            else
            {    //rename the image if another one exist
            	$temp = explode(".", $_FILES[$imageName]["name"]);
                $imageData['imageName'] = $temp[0].time().".".$temp[1];
                move_uploaded_file( $_FILES[$imageName]["tmp_name"], $imageLocation.'/'.$imageData['imageName'] ); 
            }

            $imageData['imageType'] = $_FILES[$imageName]["type"];
			$imageData['imageLocation'] = $imageLocation.'/'.$imageData['imageName'];    //to add later (the location of the image)
	        
			$image = new Image( $imageData );
             if($imageName === "image")
			 {
	        if( $image->insert() )
			{
				$results['successMessage'] = "image upload successful. Thank you";
				//header('Location: ' . $_SERVER['HTTP_REFERER']);
			
			
			return $imageData['imageLocation'];
			}
			}
		}
		else
		{ 
			switch ( $_FILES[$imageName]['error'] ) {
	            case UPLOAD_ERR_INI_SIZE:
	                $results['errorMessage'] = "The uploaded image exceeds the upload_max_imagesize directive in php.ini";
	                break;
	            case UPLOAD_ERR_FORM_SIZE:
	                $results['errorMessage'] = "The uploaded image exceeds the MAX_image_SIZE directive that was specified in the HTML form";
	                break;
	            case UPLOAD_ERR_PARTIAL:
	                $results['errorMessage'] = "The uploaded image was only partially uploaded";
	                break;
	            case UPLOAD_ERR_NO_IMAGE:
	                $results['errorMessage'] = "No image was uploaded";
	                break;
	            case UPLOAD_ERR_NO_TMP_DIR:
	                $results['errorMessage'] = "Missing a temporary folder";
	                break;
	            case UPLOAD_ERR_CANT_WRITE:
	                $results['errorMessage'] = "Failed to write image to disk";
	                break;
	            case UPLOAD_ERR_EXTENSION:
	                $results['errorMessage'] = "image upload stopped by extension";
	                break;

	            default:
	                $results['errorMessage'] = "Unknown upload error";
	                break;
	        }
	        echo $results['errorMessage'];
		}
	}
   	function addShop(){
		$results = array();	
		$results['pageTitle'] = " Add shop | Dating website";
		$shop = new Shop( $_POST );
		$shop->icon_link = DEFAULT_IMAGE_LOCATION;
		$shop->insert();
		
			if ( isset($_FILES["image"]) ) {
		$imageName = "image";
		$type = "shop";
		$typeId = $shop->id;
		$imageLocation = IMAGE_UPLOAD_LOCATION;	
		$shop->icon_link = uploadImage( $imageName,$imageLocation,$type,$typeId );
		$shop->updateImage();
		
		}
	
		header('templates/addQuestion.php');
		
		}
		function addQuestion(){
		$question = new Question( $_POST );
		print_r($question);
		$question->insert();
		header('templates/addQuestion.php');
		
		}	
		function addAnswer(){
		$question = new Question( $_POST );
		if($question1=Question::getAnswerByUserId($_SESSION['userId'],$question->question))
		{
		$question->id=$question1->id;
		$question->update();
		}
		else
		$question->insert();
		header('index.php?action = login');
		
		}
		
		
	
	
	
	?>