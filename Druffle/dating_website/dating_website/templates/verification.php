<form name="" action="/dating_website/index.php?action=idUpload" method="POST" enctype="multipart/form-data">
                       
					   <input type="file" name="image" /><br>
                       <input type="text" name ="userId" value="<?php if(isset($_SESSION['userId']))print_r($_SESSION['userId']);else echo 1; ?>" >
                       <input type="submit"  name="group" value="update"  >
                 </form>	