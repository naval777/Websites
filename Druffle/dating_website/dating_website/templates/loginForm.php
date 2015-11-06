<?php //include("include/header.php"); ?>
<script>
  // This is called with the results from from FB.getLoginStatus().
  function statusChangeCallback(response) {
    console.log('statusChangeCallback');
    console.log(response);
    // The response object is returned with a status field that lets the
    // app know the current login status of the person.
    // Full docs on the response object can be found in the documentation
    // for FB.getLoginStatus().
    if (response.status === 'connected') {
      // Logged into your app and Facebook.
      testAPI();
    } else if (response.status === 'not_authorized') {
      // The person is logged into Facebook, but not your app.
      document.getElementById('status').innerHTML = 'Please log ' +
        'into this app.';
		FB.login();
    } else {
      // The person is not logged into Facebook, so we're not sure if
      // they are logged into this app or not.
      document.getElementById('status').innerHTML = 'Please log ' +
        'into Facebook.';
       FB.login();
	}
  }

  // This function is called when someone finishes with the Login
  // Button.  See the onlogin handler attached to it in the sample
  // code below.
  function checkLoginState() {
    FB.getLoginStatus(function(response) {
      statusChangeCallback(response);
    });
  }

  window.fbAsyncInit = function() {
  FB.init({
    appId      : '1509766599252478',
    cookie     : true,  // enable cookies to allow the server to access 
                        // the session
    xfbml      : true,  // parse social plugins on this page
    version    : 'v2.0' // use version 2.0
  });

  // Now that we've initialized the JavaScript SDK, we call 
  // FB.getLoginStatus().  This function gets the state of the
  // person visiting this page and can return one of three states to
  // the callback you provide.  They can be:
  //
  // 1. Logged into your app ('connected')
  // 2. Logged into Facebook, but not your app ('not_authorized')
  // 3. Not logged into Facebook and can't tell if they are logged into
  //    your app or not.
  //
  // These three cases are handled in the callback function.

  FB.getLoginStatus(function(response) {
    statusChangeCallback(response);
  });
 FB.login(function(response) {
   if (response.authResponse) {
     console.log('Welcome!  Fetching your information.... ');
     FB.api('/me', function(response) {
      
	   window.location.assign('../index.php?email=' + response.email+'&action='+login)
        
     });

   } else {
     
   }
 } , {scope: 'email'} );
  
  };

 
   
  // Load the SDK asynchronously
  (function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));

  // Here we run a very simple test of the Graph API after login is
  // successful.  See statusChangeCallback() for when this call is made.
  function testAPI() {
    console.log('Welcome!  Fetching your information.... ');
    FB.api('/me', function(response) {
      console.log('Successful login for: ' + response.name);
      document.getElementById('status').innerHTML =
        'Thanks for logging in, ' + response.name + '!';
    });
  }
</script>

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
			<div id="whiteBgDiv"></div>
			<form name="loginForm" action="/dating_website/index.php?action=login" method="POST">
				<table>
					<tr>
						<td>
							E-mail
						</td>
						<td>
							<input type="text" name="email" placeholder="email" />
						</td>
					</tr>
					<tr>
						<td>
							Password
						</td>
						<td>
							<input type="password" name="password" placeholder="Password" />
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<input type="submit" name="login_form" value="Login" />
							</td>
					</tr>				 
				</table>
			</form>
		</div>
		
       <div id="reg_form">
	   <div><h4>
	   Note: password should be greater than 7 charecters 
	   </h4></div>
                <iframe src='http://www.facebook.com/plugins/registration.php?
                        client_id=1509766599252478&
                        redirect_uri=http://localhost/dating_website/index.php?action=register&
                        fields=[
                        {"name":"name"},
                        {"name":"email"},
                        {"name":"password"},
                        {"name":"gender"},
                        {"name":"birthday"},
						{"name":"college", "description":"College *", "type":"text"},
						{"name":"phone", "description":"Phone Number *", "type":"text"},
						{"name":"aboutMe", "description":"About *", "type":"text"},
                       
                        
                        ]'
						onvalidate="validate"
                        scrolling="auto"
                        frameborder="no"
                        style="border:none"
                        allowTransparency="true"
                        width="500"
                        height="600">
                </iframe>
		<div><h6>* All fields are mandatory </h6></div>		
        </div>
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
<?php //include("include/footer.php"); ?>

