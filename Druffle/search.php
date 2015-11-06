
<?php 
include("backend/header.php"); 
//$results['groups']=Group::getGroupsList($_SESSION['groupId']);
//$results['shops']=Shop::getList();
$grp=get_my_groups();
?>
<!DOCTYPE html>
<?xml version="1.0" encoding="UTF-8" ?>
<html xmlns="http://www.w3.org/1999/xhtml"xml:lang="en">
<head>
<meta charset=utf-8>
<title>DRUFFLE</title>
<link rel="shortcut icon" href="images/icon.ico" >
<link rel="stylesheet" href="css/main.css" />
<link rel="stylesheet" href="css/search.css" />
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
<?php echo $grp;?>
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

<div class="left"><div id="left-title">SEARCH</div>

	<form>
<input id="by_name"  type="text" name="by_name" placeholder="Search by Name.." spellcheck="false" value="" />
<input  type="text" name="by_college" placeholder="Search by College.." spellcheck="false" value="" />
<input id='search_but' type="button"   value="SEARCH" />
</form>
<div id='name_box'><ul id='nm_list'></ul></div>
<div id='coll_box'><ul></ul></div>	 

</div>

<div class="right">
<div class='wrap'>
<div id='search_top_img'>
 
  </div>
	 <div class="clear"></div>
	 <div id='search_bot_img'>
  
</div>
</div>
</div>

<div class='move_left'></div>
<div class='move_right'></div>


</body>
</html>
