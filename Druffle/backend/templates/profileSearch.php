<?php 


include("include/header.php"); 

$results['users']=User::getUserList($_SESSION['userId']);
?>


   <div>
		<form name="form" action="/backend/main.php?action=viewProfile" method="POST">
		<table>
					
				
					<tr>
						<td>
						  Select user
						</td>
                        <td>
		                  <input type="text" id="demo1" name="personId" />
						  
		               </td>
		            </tr>
					
					<tr>
						<td colspan="2">
							<input type="submit" name="groupForm" value="see profile" />
							</td>
					</tr>	
      
		</table>
        <script type="text/javascript">
        $(document).ready(function() {
            $("#demo1").tokenInput(<?php print_r(json_encode($results['users']));?>
          , {
              propertyToSearch: "name",
			  
			   tokenLimit: 1,
			   tokenValue: "id",
			   theme: "facebook",
			    hintText: "search for first names",
                noResultsText: "no results found",
                searchingText: "searching :)",
              resultsFormatter: function(item){ return "<li>" + "<img src='" + item.gender + "' title='" + item.name + "' height='25px' width='25px' />" + "<div style='display: inline-block; padding-left: 10px;'><div class='full_name'>" + item.name + "</div><div class='email'>" + item.email + "</div></div></li>" },
              tokenFormatter: function(item) { return "<li><p>" + item.name +  "</p></li>" },
          });
        });
        </script>
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
	
	
	</div>
	
	<?php
	echo "suggestions"."<br>";
	for($i=0;$i<sizeof($suggestions);$i++)
	{
	echo $suggestions[$i]['name']."<br>";
	echo $suggestions[$i]['age']."<br>";
	echo $suggestions[$i]['college']."<br>";
	?>
	 <form name="" action="main.php?action=viewProfile" method="POST" enctype="multipart/form-data">
              
                       <input type="text" name ="personId" value="<?php print_r($suggestions[$i]["id"]) ?>" />
                       <input type="submit"  name="group" value="see profile"  />
                 </form>   
	
	<?php
	}
	?>