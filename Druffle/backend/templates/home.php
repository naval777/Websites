<?php include("/templates/include/header.php"); 

$results['users']=User::getUserList($_SESSION['userId']);
?>
<?php
/*
$api_key = '1509766599252478';
$secret  = '2c22458bc5c89fade0c5e810cb457414';

include_once '../facebook-php-sdk-master/src/facebook.php';

$facebook = new Facebook($api_key, $secret);
$user = $facebook->getUser(); 

    if ($user) {
        $user_profile = $facebook->api('/me');
        $friends = $facebook->api('/me/friends');

        echo '<ul>';
        foreach ($friends["data"] as $value) {
            echo '<li>';
            echo '<div class="pic">';
            echo '<img src="https://graph.facebook.com/' . $value["id"] . '/picture"/>';
            echo '</div>';
            echo '<div class="picName">'.$value["name"].'</div>'; 
            echo '</li>';
        }
        echo '</ul>';
    }
	else
	{
	
	}
	
*/	




?>


   <div>
   <div>
   
 
   </div>
   
		<form name="form" action="/backend/main.php?action=createGroup" method="POST">
		<table>
					<tr>
						<td>
						  Name
						</td>
						<td>
							<input type="text" name="name" placeholder="Name of the group" />
						</td>
					</tr>
					<tr>
						<td>
						  Caption
						</td>
						<td>
							<input type="text" name="caption" placeholder="Caption" />
						</td>
					</tr>
					<tr>
						<td>
						  Select friends
						</td>
                        <td>
		                  <input type="text" id="demo" name="blah" />
						  <input type="text" name="adminId" value="<?php echo $_SESSION['userId']; ?>" /><br>
				
		               </td>
		            </tr>
					
					<tr>
						<td colspan="2">
							<input type="submit" name="groupForm" value="Create Group" />
							</td>
					</tr>	
      
		</table>
        <script type="text/javascript">
        $(document).ready(function() {
            $("#demo").tokenInput(<?php print_r(json_encode($results['users']));?>
          , {
              propertyToSearch: "name",
			  
			   tokenLimit: 2,
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
	if(isset($_SESSION['groupId']))
	{
	echo "conversation groups: <br>";
	echo $_SESSION['groupId'];
	$chatGroups = ChatGroup::getList($_SESSION['groupId']);
	print_r($chatGroups);
	
	for($i=0;$i<sizeOf($chatGroups);$i++)
	{
	if($chatGroups[$i]['group2Id']!=$_SESSION['groupId'])
	{
	echo Group::getById($chatGroups[$i]['group2Id'])->name;
	?>
	<form name="chat_group" action="main.php?action=chat" method="POST" enctype="multipart/form-data">
                         <input type="text" name ="groupId1" value="<?php print_r($chatGroups[$i]['group2Id']) ?>" >
                        <input type="submit"  name="group" value="chat"  >
                        
                 </form>   
				 <?php
	}
	else
	{
	echo Group::getById($chatGroups[$i]['group1Id'])->name;
	?>
	<form name="chat_group" action="main.php?action=chat" method="POST" enctype="multipart/form-data">
                         <input type="text" name ="groupId1" value="<?php print_r($chatGroups[$i]['group1Id']) ?>" >
                        <input type="submit"  name="group" value="Chat"  >
                        
                 </form>   
				 <?php
	}
	}
	}
	echo "Questions:";
	$questions = Question::getList();

	
	for($i=0;$i<sizeOf($questions);$i++)
	{
	echo $questions[$i]['question'];
	?>
	<form name="questions" action="main.php?action=addAnswer" method="POST" enctype="multipart/form-data">
	<input type="text" name ="userId" value="<?php print_r ($_SESSION['userId']) ?>" >
	
	<input type="text" name ="answer" value="<?php 
	
	if($question1=Question::getAnswerByUserId($_SESSION['userId'],$questions[$i]['question']))
	{
	print_r($question1->answer); 
	}
	else
	print_r($questions[$i]['answer']); 
	
	?>" placeholder="write answer" >
	<input type="text" name ="question" value="<?php print_r($questions[$i]['question']) ?>" >
	<input type="submit"  name="" value="submit"  >
	</form>
	<?php
	}
	/////////////////////////////////////
////////////////////////////////
////////////////////////////////////
////////////////////////////////////////
	?>
	   
	

