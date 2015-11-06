<?php
session_start();
	require_once("config.php");
	 $action = isset( $_POST['action'] ) ? $_POST['action'] : "";
	switch( $action ){
	
	case 'chat_req' : chat_req();
	break;
	case 'date_req' : date_req();
	break;
	case 'date_acc' : date_acc();
	break;
	case 'grp_req' : grp_req();
	break;
	case 'nm_search': nm_search();
	break;
	case 'get_person': get_person();
	break;
	case 'get_groups': get_groups();
	break;
	case 'get_my_groups': get_my_groups();
	break;
	case 'set_mygrp': set_mygrp();
	break;
	
	}
    //User::getById($_SESSION['userId'])->name;
     //get by user id gives requests only with status pending
	  function set_mygrp(){
	 $_SESSION['mygroupId'] = $_POST['query'];
	 }
	 
	  function get_person(){
	$person = User::getById($_POST['id']);
	$_SESSION['personId']= $_POST['id'];
	 $img= $person->icon_link;
	 $html ='';
	 $html.= '<a href="backend/main.php?action=viewProfile" class="detail">';
	 $html.= '<img class="pics" src="'.$img.'" /></a>';
	 echo($html);
	  }
	  
	  function get_groups(){                                             // for groups of other person
	$grps = Group::getListByUserId($_SESSION['personId']);
	$a = sizeof($grps);
	  settype($a, "integer");
	  $html1 ='';
	  $html2 ='';
	 for($i=0;$i<$a/2;$i++){
	 $img= $grps[$i]['icon_link'];
	 $id= $grps[$i]['id'];
	 
	 $html1.= '<a href="backend/main.php?id='.urlencode($id).'&action=viewGroup" class="detail">';
	 $html1.= '<img  class="pics" src="'.$img.'" /></a>';
	
	 }
	 $b=($a/2)+1;
	 for($i=$b;$i<$a;$i++){
	 $img= $grps[$i]['icon_link'];
	 $id= $grps[$i]['id'];
	 
	 $html2.= '<a href="backend/main.php?id='.urlencode($id).'&action=viewGroup" class="detail">';
	 $html2.= '<img class="pics" src="'.$img.'" /></a>';
	 }
	 $a= array();
	 $a[0]= $html1; $a[1]= $html2;
	  return $a;
	  }
	  
	  function get_my_groups(){															// get user group list
	 
	 $grps = Group::getListByUserId($_SESSION['userId']);
	$a = sizeof($grps);
	  $html ='';
	 for($i=0;$i<$a;$i++){
	 $id= $grps[$i]['id'];
	 $name= $grps[$i]['name'];
	 $html.= '<input name="grp_name" id="'.$id.'" type="radio"  ><label for="'.$id.'" >'.$name.'</label><br />';
	 }
	 return $html;
	 }
	  
	  function nm_search(){
	User::nameSearch($_POST['query']);

	 }
	
	  function grp_req(){
     $requests = Request::getByUserId( $_SESSION['userId'] );
      $a = sizeof($requests);
	  
	  for($i=0;$i<$a;$i++)											// requests user has got for adding groups
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
	  echo "<a href='/backend/main.php?action=acceptGroupRequest&id=".$requests[$i]["id"]."'>accept</a>&nbsp&nbsp&nbsp&nbsp";
	  echo "<a href='/backend/main.php?action=declineGroupRequest&id=".$requests[$i]["id"]."'>decline</a><br>";

	 
	  }
	  }
	  
	  function chat_req(){
if(isset($_SESSION['groupId']))
{
echo "you are under this group :". Group::getById($_SESSION['groupId'])->name."<br>";  // chat requests for group which has been selected
echo "chat requests for this group:<br>";
  $chatRequests = ChatRequest::getByUserId( $_SESSION['userId'],$_SESSION['groupId'] );
      $a = sizeof($chatRequests);
	  for($i=0;$i<$a;$i++)
	  {
	  $group = Group::getById($chatRequests[$i]["sentById"]);
	  $html= "<li>chat request from ".$group->name."<br>";
	   $html.= "users: <br>".User::getById($group->adminId)->name." , ".User::getById($group->per2Id)->name."and".User::getById($group->per3Id)->name."<br>";
	    $html.= "<a href='/backend/main.php?action=acceptChatRequest&id=".$chatRequests[$i]["id"]."'>accept</a>&nbsp&nbsp&nbsp&nbsp";
	  $html.= "<a href='/backend/main.php?action=declineChatRequest&id=".$chatRequests[$i]["id"]."'>decline</a></li><br>";
	  
	  }
	  }
	  echo $html;
	  }
	  
	  function date_req(){
	  if(isset($_SESSION['groupId']))
{
	  
echo "date requests for this group:<br>";												// date requests for group which has been selected
  $dateRequests = DateRequest::getByUserId( $_SESSION['userId'],$_SESSION['groupId'] );   
      $a = sizeof($dateRequests);
	  for($i=0;$i<$a;$i++)
	  {
	  $group = Group::getById($dateRequests[$i]["sentById"]);
	  echo "date request from ".$group->name."<br>";
	  echo "users: <br>".User::getById($group->adminId)->name." , ".User::getById($group->per2Id)->name."and".User::getById($group->per3Id)->name."<br>";
	   echo "<a href='/backend/main.php?action=acceptDateRequest&id=".$dateRequests[$i]["id"]."'>accept</a>&nbsp&nbsp&nbsp&nbsp";
	  echo "<a href='/backend/main.php?action=declineDateRequest&id=".$dateRequests[$i]["id"]."'>decline</a><br>";
	  }
	  
	  
echo "accepted date requests:<br>";													// date requests accepted for group which has been selected
  $dateRequests = DateRequest::getByGroupId($_SESSION['groupId']);
	 if($dateRequests['0']['status']=="successful" OR $dateRequests['1']['status']=="successful" OR $dateRequests['2']['status']=="successful" ) 
	 {
	   $group = Group::getById($dateRequests['0']["sentToGroupId"]);
	 echo "your date request was accepted by".$group->name."<br>";
	  echo "users: <br>".User::getById($group->adminId)->name." , ".User::getById($group->per2Id)->name."and".User::getById($group->per3Id)->name."<br>";
	 }

}
}

/*
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
<!--
 <img src="<?php// print_r($groupsCreatedOnline[$i]['icon_link'])?>" alt="Group" style= "height:200px; width:300px;" >

 <form name="select_group" action="main.php?action=assignGroup" method="POST" enctype="multipart/form-data">
              
                       <input type="text" name ="groupId" value="<?php // print_r($groupsCreatedOnline[$i]["id"]) ?>" >
                       <input type="submit"  name="group" value="select"  >
                 </form>   
<form name="change_group_image" action="main.php?action=updateGroupImage" method="POST" enctype="multipart/form-data">
                       
					   <input type="file" name="image" /><br>
                       <input type="text" name ="groupId" value="<?php //print_r($groupsCreatedOnline[$i]["id"]) ?>" >
                       <input type="submit"  name="group" value="update"  >
                 </form>	-->			 
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
}

<img src="<?php print_r($groupsOnline[$i]['icon_link'])?>" alt="Group" style= "height:200px; width:300px;" >
 <form name="select_group" action="main.php?action=assignGroup" method="POST" enctype="multipart/form-data">
                         <input type="text" name ="groupId" value="<?php print_r($groupsOnline[$i]["id"]) ?>" >
                        <input type="submit"  name="group" value="select"  >
                        
                 </form>  
<form name="change_group_image" action="main.php?action=updateGroupImage" method="POST" enctype="multipart/form-data">
                       
					   <input type="file" name="image" /><br>
                       <input type="text" name ="groupId" value="<?php print_r($groupsOnline[$i]["id"]) ?>" >
                       <input type="submit"  name="group" value="update"  >
                 </form>				 


 groups pending
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


<?php
if(isset($_SESSION['groupId']))
{
?>

  
  <?php
  }
  <!--
<a href="/backend/main.php?action=logout">
Logout<a href="/backend/main.php?action=dateForm">Send Date Request</a> -->
</a>
<a href="/backend/main.php?action=login">home</a> --><!--  <a href="/backend/main.php?action=profileSearch">Search people</a>
  <!-- <a href="/backend/main.php?action=updateForm">Settings</a>  --> */
  ?>

 