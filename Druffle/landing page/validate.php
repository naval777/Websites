<?php
$name= $email= $insti="";
$nameErr= $emailErr= $instiErr="";

function test_input($data)
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

if (array_key_exists('save',$_GET)){
	
	  if (empty($_GET["email"]))
    {$login_mailErr = "Email is required";}
  else
    {
	$email = test_input($_GET["email"]);
	// check if e-mail address syntax is valid
    if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/",$email))
      {
      $emailErr = "Invalid email format"; 
      }
	  }
	  
	if (empty($_GET["insti"]))
    {$instiErr = "Institute is required";}
  else
    {
	$insti = test_input($_GET["insti"]);
	// check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z ]*$/",$insti))
      {
      $instiErr = "Only letters and white space allowed"; 
      }
	  } 
	    /* db conn*/
		
if(!$email==""){
$con=mysqli_connect('localhost','naval','naval777','druffle');

// Check connection
if (mysqli_connect_errno()) {
$_SERVER['PHP_SELF'];
}
if (isset($_GET['beta'])){
$sql="INSERT INTO user (email, insti, beta) VALUES ('$email', '$insti','1')";
}
else{
$sql="INSERT INTO user (email, insti) VALUES ('$email', '$insti')";
}
if (!mysqli_query($con,$sql)) {
$_SERVER['PHP_SELF'];
}
 $email= $insti="";
mysqli_close($con);	
}
}
?>
