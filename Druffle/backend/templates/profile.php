<?php 


include("include/header.php"); 
$person= User::getById($_SESSION['personId']);
print_r($person);


$groupsCreatedOnline=Group::getListOnlineByAdminId($person->id);;
$groupsOnline=Group::getListOnline($person->id);


echo "Groups ".$person->name ." is admin for <br> ";
for($i=0;$i<sizeof($groupsCreatedOnline);$i++)
{
if($g=ChatGroup::getByGroupId($_SESSION['groupId'],$groupsCreatedOnline[$i]["id"]))
{

echo "already a chatting group<br>";
}

if($groupsCreatedOnline[$i]["per2Id"]!=$_SESSION['userId'] && $groupsCreatedOnline[$i]["per3Id"]!=$_SESSION['userId'])
{
echo "Group Name: ".$groupsCreatedOnline[$i]["name"]."<br>";
echo "group members: <br>";
$per2=User::getById($groupsCreatedOnline[$i]["per2Id"]);
$per3=User::getById($groupsCreatedOnline[$i]["per3Id"]);
echo $per2->name."<br>";
echo $per3->name."<br>";
?>
 <form name="select_group" action="main.php?action=createChatGroup" method="POST" enctype="multipart/form-data">
              
                       <input type="text" name ="group2Id" value="<?php print_r($groupsCreatedOnline[$i]["id"]) ?>" >
                       <input type="submit"  name="group" value="send chat request" >
                 </form>   
<?php
}
}
echo "Groups".$person->name." are member of <br> ";
for($i=0;$i<sizeof($groupsOnline);$i++)
{
if(ChatGroup::getByGroupId($_SESSION['groupId'],$groupsOnline[$i]["id"]))
{
echo "already a chatting group<br>";
}
if($groupsOnline[$i]["adminId"]!=$_SESSION['userId'] && $groupsOnline[$i]["per2Id"]!=$_SESSION['userId'] && $groupsOnline[$i]["per3Id"]!=$_SESSION['userId'])
{
echo "Group Name: ".$groupsOnline[$i]["name"]."<br>";
echo "group members: <br>";
$admin=User::getById($groupsOnline[$i]["adminId"]);
	  if($person->id!= $groupsOnline[$i]["per3Id"])
	  {
	  $per2=User::getById($groupsOnline[$i]["per3Id"]);
	  }
	  else
	  {
	     $per2=User::getById($groupsOnline[$i]["per2Id"]);
	  }
echo "admin <br>";
echo $admin->name."<br>";
echo $per2->name."<br>";
?>
 <form name="select_group" action="main.php?action=createChatGroup" method="POST" enctype="multipart/form-data">
                         <input type="text" name ="group2Id" value="<?php print_r($groupsOnline[$i]["id"]) ?>" >
                        <input type="submit"  name="group" value="send chat request"  >
                        
                 </form>   
<?php
}

}
?>
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
	