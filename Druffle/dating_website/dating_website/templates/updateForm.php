<?php include("/templates/include/header.php"); 
?>
update profile picture
<form name="" action="/dating_website/index.php?action=updateUserImage" method="POST" enctype="multipart/form-data">
                       
					   <input type="file" name="image" /><br>
                       <input type="text" name ="userId" value="<?php if(isset($_SESSION['userId']))print_r($_SESSION['userId']);else echo 1; ?>" >
                       <input type="submit"  name="" value="updateImage"  >
                 </form>	
				 
update Password
<form name="" action="/dating_website/index.php?action=updatePassword" method="POST" enctype="multipart/form-data">
                       
					<input type="password" name="password" placeholder="type new password">
					<input type="password" name="password_confirmation" placeholder="type password again">
                       <input type="text" name ="userId" value="<?php if(isset($_SESSION['userId']))print_r($_SESSION['userId']);else echo 1; ?>" >
                       <input type="submit"  name="" value="updatePawwsord"  >
                 </form>				 
	Update Basic Info			 
<form name="update_form" action="/dating_website/index.php?action=update" method="POST" enctype="multipart/form-data">
                       
					   <input type="text" name="name" placeholder="update Username" /><br>
					    <input type="text" name="phone" placeholder="update Phonenumber" /><br>
                       <input type="text" name ="userId" value="<?php if(isset($_SESSION['userId']))print_r($_SESSION['userId']);else echo 1; ?>" >
                       <input type="submit"  name="" value="update"  >
                 </form>					 
				 
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