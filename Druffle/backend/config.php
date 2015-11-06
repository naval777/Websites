<?php
ini_set( "display_errors", true );
date_default_timezone_set( "Asia/Calcutta" );
define( "DB_DSN", "mysql:host=localhost;dbname=druffle" );
define( "DB_USERNAME", "root" );
define( "DB_PASSWORD", "" );
define( "CLASS_PATH", "/classes" );
define( "TEMPLATE_PATH", ".." );
define( "ADMIN_USERNAME", "naval" );
define( "ADMIN_PASSWORD", "naval" );
define( "TABLENAME_USERS", "users" );
define( "TABLENAME_IMAGES", "images" );
define( "TABLENAME_GROUPS", "groups" );
define( "TABLENAME_REQUESTS", "requests" );
define( "TABLENAME_CHATREQUESTS", "chatRequests" );
define( "TABLENAME_DATEREQUESTS", "dateRequests" );
define( "TABLENAME_CHATGROUPS", "chatgroups" );
define( "TABLENAME_MESSAGES", "messages" );
define( "TABLENAME_SHOPS", "shops" );
define( "TABLENAME_QUESTIONS", "questions" );
define( "IMAGE_UPLOAD_LOCATION", "upload" );
define( "ID_UPLOAD_LOCATION", "IdPics" );
define( "DEFAULT_IMAGE_LOCATION", "backend/upload/default.jpg" );
define( "DEFAULT_USER_IMAGE", "backend/upload/default.jpg" );
require( CLASS_PATH . "/Password.php" );
require( CLASS_PATH . "/User.php" );
require( CLASS_PATH . "/Image.php" );
require( CLASS_PATH . "/Group.php" );
require( CLASS_PATH . "/Request.php" );
require( CLASS_PATH . "/chatRequest.php" );
require( CLASS_PATH . "/DateRequest.php" );
require( CLASS_PATH . "/chatGroup.php" );
require( CLASS_PATH . "/Message.php" );
require( CLASS_PATH . "/Shop.php" );
require( CLASS_PATH . "/Question.php" );

//require( CLASS_PATH . "/File.php" );
//require( CLASS_PATH . "/Message.php" );
//require( CLASS_PATH . "/Utility.php" );
//require( CLASS_PATH . "/Document.php" );
/////////////////////////////////////
////////////////////////////////
////////////////////////////////////
////////////////////////////////////////

?>
