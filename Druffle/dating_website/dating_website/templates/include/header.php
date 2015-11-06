 <html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Dating Website</title>
 
 <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>
    <script type="text/javascript" src="src/jquery.tokeninput.js"></script>

    <link rel="stylesheet" href="styles/token-input.css" type="text/css" />
    <link rel="stylesheet" href="styles/token-input-facebook.css" type="text/css" />

   
</head>
<?php

    echo "Welcome". User::getById($_SESSION['userId'])->name."<br>";
     //get by user id gives requests only with status pending
     $requests = Request::getByUserId( $_SESSION['userId'] );
      $a = sizeof($requests);
	  for($i=0;$i<$a;$i++)
	  {
	  
	  $group = Group::getById($requests[$i]["sentById"]);
	  
	  $user=User::getById($group->adminId);
	  
	  if($_SESSION['userId']!= $group->per2Id)
	  {
	  $user1=User::getById($group->per2Id);
	  }
	  else
	  {
	   $user1=User::getById($group->per3Id); 
	  }
	  
	
	  echo "you got request from ".$user->name." to join to group ".$group->name. " with ".$user1->name." <br>";
	  echo "<a href='/dating_website/index.php?action=acceptGroupRequest&id=".$requests[$i]["id"]."'>accept</a>&nbsp&nbsp&nbsp&nbsp";
	  echo "<a href='/dating_website/index.php?action=declineGroupRequest&id=".$requests[$i]["id"]."'>decline</a><br>";
	  
	 
	  }
	  
   
if(isset($_SESSION['groupId']))
{
echo "you are under this group :". Group::getById($_SESSION['groupId'])->name."<br>";
echo "chat requests for this group:<br>";
  $chatRequests = ChatRequest::getByUserId( $_SESSION['userId'],$_SESSION['groupId'] );
      $a = sizeof($chatRequests);
	  for($i=0;$i<$a;$i++)
	  {
	  $group = Group::getById($chatRequests[$i]["sentById"]);
	  echo "chat request from ".$group->name."<br>";
	  echo "users: <br>".User::getById($group->adminId)->name." , ".User::getById($group->per2Id)->name."and".User::getById($group->per3Id)->name."<br>";
	   echo "<a href='/dating_website/index.php?action=acceptChatRequest&id=".$chatRequests[$i]["id"]."'>accept</a>&nbsp&nbsp&nbsp&nbsp";
	  echo "<a href='/dating_website/index.php?action=declineChatRequest&id=".$chatRequests[$i]["id"]."'>decline</a><br>";
	  
	  }
echo "date requests for this group:<br>";
  $dateRequests = DateRequest::getByUserId( $_SESSION['userId'],$_SESSION['groupId'] );
      $a = sizeof($dateRequests);
	  for($i=0;$i<$a;$i++)
	  {
	  $group = Group::getById($dateRequests[$i]["sentById"]);
	  echo "date request from ".$group->name."<br>";
	  echo "users: <br>".User::getById($group->adminId)->name." , ".User::getById($group->per2Id)->name."and".User::getById($group->per3Id)->name."<br>";
	   echo "<a href='/dating_website/index.php?action=acceptDateRequest&id=".$dateRequests[$i]["id"]."'>accept</a>&nbsp&nbsp&nbsp&nbsp";
	  echo "<a href='/dating_website/index.php?action=declineDateRequest&id=".$dateRequests[$i]["id"]."'>decline</a><br>";
	  
	  }
echo "accepted date requests:<br>";
  $dateRequests = DateRequest::getByGroupId($_SESSION['groupId']);
	 if($dateRequests['0']['status']=="successful" OR $dateRequests['1']['status']=="successful" OR $dateRequests['2']['status']=="successful" ) 
	 {
	   $group = Group::getById($dateRequests['0']["sentToGroupId"]);
	 echo "your date request was accepted by".$group->name."<br>";
	  echo "users: <br>".User::getById($group->adminId)->name." , ".User::getById($group->per2Id)->name."and".User::getById($group->per3Id)->name."<br>";
	 }

}
else
{
echo "select a group to proceed"."<br>";
}

$groupsPending=Group::getListPendingByAdminId($_SESSION['userId']);
$groupsCreatedOnline=Group::getListOnlineByAdminId($_SESSION['userId']);;
$groupsOnline=Group::getListOnline($_SESSION['userId']);


echo "Groups you are admin for <br> ";
for($i=0;$i<sizeof($groupsCreatedOnline);$i++)
{
echo "Group Name: ".$groupsCreatedOnline[$i]["name"]."<br>";
echo "group members: <br>";
$per2=User::getById($groupsCreatedOnline[$i]["per2Id"]);
$per3=User::getById($groupsCreatedOnline[$i]["per3Id"]);
echo $per2->name."<br>";
echo $per3->name."<br>";
?>

 <img src="<?php print_r($groupsCreatedOnline[$i]['icon_link'])?>" alt="Group" style= "height:200px; width:300px;" >

 <form name="select_group" action="index.php?action=assignGroup" method="POST" enctype="multipart/form-data">
              
                       <input type="text" name ="groupId" value="<?php print_r($groupsCreatedOnline[$i]["id"]) ?>" >
                       <input type="submit"  name="group" value="select"  >
                 </form>   
<form name="change_group_image" action="index.php?action=updateGroupImage" method="POST" enctype="multipart/form-data">
                       
					   <input type="file" name="image" /><br>
                       <input type="text" name ="groupId" value="<?php print_r($groupsCreatedOnline[$i]["id"]) ?>" >
                       <input type="submit"  name="group" value="update"  >
                 </form>				 
<?php
}
echo "Groups you are member of <br> ";
for($i=0;$i<sizeof($groupsOnline);$i++)
{
echo "Group Name: ".$groupsOnline[$i]["name"]."<br>";
echo "group members: <br>";
$admin=User::getById($groupsOnline[$i]["adminId"]);
	  if($_SESSION['userId']!= $groupsOnline[$i]["per3Id"])
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
<img src="<?php print_r($groupsOnline[$i]['icon_link'])?>" alt="Group" style= "height:200px; width:300px;" >
 <form name="select_group" action="index.php?action=assignGroup" method="POST" enctype="multipart/form-data">
                         <input type="text" name ="groupId" value="<?php print_r($groupsOnline[$i]["id"]) ?>" >
                        <input type="submit"  name="group" value="select"  >
                        
                 </form>  
<form name="change_group_image" action="index.php?action=updateGroupImage" method="POST" enctype="multipart/form-data">
                       
					   <input type="file" name="image" /><br>
                       <input type="text" name ="groupId" value="<?php print_r($groupsOnline[$i]["id"]) ?>" >
                       <input type="submit"  name="group" value="update"  >
                 </form>				 
<?php
}
echo "Groups that are pending <br> ";
for($i=0;$i<sizeof($groupsPending);$i++)
{
echo "Group Name: ".$groupsPending[$i]["name"]."<br>";
echo "group members: <br>";
$type="accept";
$requests=Request::getByGroup($groupsPending[$i]["id"],$type);
$per2=User::getById($requests[0]["sentToId"]);
echo $per2->name;
echo $requests[1]["sentToId"];
$per3=User::getById($requests[1]["sentToId"]);
echo $per2->name." status: ".$requests[0]["status"]."<br>";
echo $per3->name." status: ".$requests[1]["status"]."<br>";

}
?>


<a href="/dating_website/index.php?action=logout">
Logout
</a>
<a href="/dating_website/index.php?action=login">home</a>
<?php
if(isset($_SESSION['groupId']))
{
?>
  <a href="/dating_website/index.php?action=profileSearch">Search people</a>
  <a href="/dating_website/index.php?action=dateForm">Send Date Request</a>
  <?php
  }
  ?>
  <a href="/dating_website/index.php?action=updateForm">Settings</a>