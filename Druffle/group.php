<?php
include_once("backend/header.php");
$grp= Group::getById($_SESSION['groupId']);
$groupList=get_my_groups();
?>
<!DOCTYPE html>
<?xml version="1.0" encoding="UTF-8" ?>

<html xmlns="http://www.w3.org/1999/xhtml"xml:lang="en">
<head>
<meta charset=utf-8>
<title>DRUFFLE</title>
<link rel="shortcut icon" href="images/icon.ico" >
<link rel="stylesheet" href="css/main.css" />
<link rel="stylesheet" href="css/group.css" />
<script src="javasc/jquery.js" type="text/javascript"></script>
<!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>-->
<script src="javasc/main.js"></script>
</head>
<body>
<div id="header">

<img src="images/logo.png" style="margin-left:1%;float:left;"/>

<div id="topmenu">
<ul>
<li>PROFILE</li>
	<li id='grp_link'>GROUPS</li>
	<li>SETTING</li>
	<li>Notifications</li> 
	</ul>
</div>
</div>

<div id='grp_list'>
<!--<input id="my_grp"  type="text" name="my_grp" placeholder="Search my Groups.." spellcheck="false" value="" /> -->
<?php echo $groupList;?>
<input type='button' id='set_mygrp' value='Save' />
</div>

<div id='notif_list'>
<ul>
<li>Chat Requests</li>
<li>Hangout Requests</li>
<li>Upcoming Hangouts </li>
<li>Group Requests</li>
</ul>
</div>
<div id='notif_item'>
<ul id='notif_ul'>
</ul>
</div>

<img src="images/arrow.png" class="but">
<div id="tst">
<ul>
<li>Search</li>
<li>Conversation</li>
<li>Hangouts</li>
<li>Druffle</li>
<li>Settings</li>
</ul>
</div>

<div class="left">

	<div id='group_pic'><img id="group_img" src="<?php echo $grp->icon_link; ?>" /></div>
	<div class='group_detail'><?php print_r($grp);?></div>
	
		<input type="button" class="chat_req_but"  value="SEND REQUEST" />
		 
        </div>

<div class="right">
<div class='wrap'>
<div id='grp_top_img'>
 <?php echo $grp[0]; ?>
  </div>
	 <div class="clear"></div>
 <div id='grp_bot_img'>
  <?php echo $grp[1]; ?>
</div>

</div>
</div>

<div class='move_left'></div>
<div class='move_right'></div>


</body>
</html>
