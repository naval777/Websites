<?php //include("include/header.php"); ?>


<?php

if(isset($_POST['Submit']))
{
    echo $_FILES['image']['error'];
}
   $hotelId = isset( $_GET['hotelId'] ) ? $_GET['hotelId'] : "";
   	  $type = isset( $_GET['type'] ) ? $_GET['type'] : "";
?>

<div id="content">
		<div id="registerDiv">
			Add Image for <?php echo $type;?> <br>
           <form name="add_activity" action="../index.php?action=addImage" method="POST" enctype="multipart/form-data">
			<input type="text" name="hotelId" value="<?php echo $hotelId; ?>"  style="visibility:hidden;" /><br>	 
			<input type="text" name="type" value="<?php echo $type; ?>"  style="visibility:hidden;" /><br>				
			<input type="file" name="image" /><br>
			<input type="submit" name="register_form" value="Create" /> 
			
			</form>
			
		</div>	
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