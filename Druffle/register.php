<?php// include("backend/header.php"); ?>
<!DOCTYPE html>
<?xml version=”1.0” encoding=”UTF-8”?>
<html xmlns=”http://www.w3.org/1999/xhtml” xml:lang=”en”>
<head>
<meta charset=utf-8>
<link rel="stylesheet" type="text/css" href="register.css" />
<script type="text/javascript" src="javasc/fb_reg.js"></script>
<title> Druffle</title>
</head>
<body>
<!--
  Below we include the Login Button social plugin. This button uses
  the JavaScript SDK to present a graphical Login button that triggers
  the FB.login() function when clicked.
-->

<fb:login-button scope="public_profile,email,user_friends" onlogin="checkLoginState();">
</fb:login-button>

<div id="status">
</div>
    <div id="bgDiv"></div>
	<div id="content" style="margin-left:0px;background:none;"><br><br><br>
		<div id="loginDiv" >
			<form name="loginForm" action="backend/main.php?action=login" method="POST">
				
							E-mail
						
							<input type="text" name="email" placeholder="email" />
						
							Password
						
							<input type="password" name="password" placeholder="Password" />
						
							<input type="submit" name="login_form" value="Login" />
							
			</form>
		</div>
		
	   <div><h4>
	   Note: password should be greater than 7 characters 
	   </h4></div>
                <iframe src='http://www.facebook.com/plugins/registration.php?
                        client_id=930557470312181&redirect_uri=http://localhost/druffle/backend/main.php?action=register &									                        
                        fields=[
                        {"name":"name"},
                        {"name":"email"},
                        {"name":"password"},
                        {"name":"gender"},
                        {"name":"birthday"},
						{"name":"college", "description":"College *", "type":"text"},
						{"name":"phone", "description":"Phone Number *", "type":"text"},
						{"name":"aboutMe", "description":"About *", "type":"text"}, ]'
						onvalidate="validate"
                        scrolling="auto"
                        frameborder="no"
                        style="border:none"
                        allowTransparency="true"
                        width="500"
                        height="600">
					
                </iframe>
		<div><h6>* All fields are mandatory </h6></div>		
        
		<script type="text/javascript">
    window.validate = function (form) {
        var errors = {};
        if (form.college == -1) {
            errors.college = "Please fill title";
        }
		 if (form.phone == -1) {
            errors.phone = "Please fill title";
        }
        if (!form.password) {
            errors.password = "Please fill password.";
        } else if (form.password.length <= 7) {
            errors.password = "password should be greater than or equal to 8 character.";
        }

        if (!form.password_confirmation) {
            errors.password_confirmation = "Please fill confirm password.";
        } else if (form.password_confirmation.length <= 7) {
            errors.password_confirmation = "confirm password should be greater than or equal 8 character.";
        }
        if (form.password != form.password_confirmation) {
            errors.password_confirmation = "Password does not match with confirm password."
        }
        return errors;
    }
</script>
	     
		
		
		<div id="messageDiv">
			<?php if( isset( $results['successMessage'] ) ) { ?>
			<div class="message success">
				<?php echo $results['successMessage']; ?> 
			</div>
			<?php } 
				if( isset( $results['errorMessage'] ) ) { ?>
				<div class="message error">
					<?php echo $results['errorMessage']; ?> 
				</div>
			<?php } ?>			
		</div>
	</div>

	</body>
	</html>
