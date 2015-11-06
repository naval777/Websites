<?php 

print_r($group1Members);
print_r($group2Members);
$user= array();
$user[1][1]=User::getById($group1Members->adminId);
$user[1][2]=User::getById($group1Members->per2Id);
$user[1][3]=User::getById($group1Members->per3Id);
$user[2][1]=User::getById($group2Members->adminId);
$user[2][2]=User::getById($group2Members->per2Id);
$user[2][3]=User::getById($group2Members->per3Id);

$chatGroup=ChatGroup::getByGroupId( $group1Members->id,$group2Members->id );
?>

<img src="<?php echo $chatGroup->icon_link ?>" alt="Group" style= "height:200px; width:300px;" >
 
 <form name="change_chat_group_image" action="main.php?action=updateChatGroupImage" method="POST" enctype="multipart/form-data">
                       
					   <input type="file" name="image" /><br>
                       <input type="text" name ="chatGroupId" value="<?php print_r($chatGroup->id) ?>" >
                       <input type="submit"  name="group" value="update"  >
                 </form>				 

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Conversation</title>
<style type="text/css">

.shout_box {
	background: #627BAE;
	width: 260px;
	overflow: hidden;
	position: fixed;
	bottom: 0;
	right: 20%;
	z-index:9;
}

.shout_box .header .close_btn {
	background: url(images/close_btn.png) no-repeat 0px 0px;
	float: right;
	width: 15px;
	height: 15px;
}
.shout_box .header .close_btn:hover {
	background: url(images/close_btn.png) no-repeat 0px -16px;
}

.shout_box .header .open_btn {
	background: url(images/close_btn.png) no-repeat 0px -32px;
	float: right;
	width: 15px;
	height: 15px;
}
.shout_box .header .open_btn:hover {
	background: url(images/close_btn.png) no-repeat 0px -48px;
}
.shout_box .header{
	padding: 5px 3px 5px 5px;
	font: 11px 'lucida grande', tahoma, verdana, arial, sans-serif;
	font-weight: bold;
	color:#fff;
	border: 1px solid rgba(0, 39, 121, .76);
	border-bottom:none;
	cursor: pointer;
}
.shout_box .header:hover{
	background-color: #627BAE;
}
.shout_box .message_box {
	background: #FFFFFF;
	height: 200px;
	overflow:auto;
	border: 1px solid #CCC;
}
.shout_msg{
	margin-bottom: 10px;
	display: block;
	border-bottom: 1px solid #F3F3F3;
	padding: 0px 5px 5px 5px;
	font: 11px 'lucida grande', tahoma, verdana, arial, sans-serif;
	color:#7C7C7C;
}
.message_box:last-child {
	border-bottom:none;
}
time{
	font: 11px 'lucida grande', tahoma, verdana, arial, sans-serif;
	font-weight: normal;
	float:right;
	color: #D5D5D5;
}
.shout_msg .username{
	margin-bottom: 10px;
	margin-top: 10px;
}
.user_info input {
	width: 98%;
	height: 25px;
	border: 1px solid #CCC;
	border-top: none;
	padding: 3px 0px 0px 3px;
	font: 11px 'lucida grande', tahoma, verdana, arial, sans-serif;
}
.shout_msg .username{
	font-weight: bold;
	display: block;
}

</style>
<script src="http://malsup.github.io/jquery.form.js"></script>
<script type="text/javascript" src="js/jquery-1.9.0.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {

	// load messages every 1000 milliseconds from server.
	load_data = {'fetch':1};
	window.setInterval(function(){
	 $.post('main.php?action=loadMessage', load_data,  function(data) {
		$('.message_box').html(data);
		var scrolltoh = $('.message_box')[0].scrollHeight;
		$('.message_box').scrollTop(scrolltoh);
	 });
	}, 1000);
	
	
	//method to trigger when user hits enter key
	$("#message").keypress(function(evt) {
		if(evt.which == 13) {
				var isentById = $('#sentById').val();
				var isentToId = $('#sentToId').val();
				var isentByUserId = $('#sentByUserId').val();
				var iimage = $('#image').prop("files")[0];
				var imessage = $('#message').val();
				post_data = {'sentById':isentById,'sentByUserId':isentByUserId,'sentToId':isentToId,'file':iimage,'message':imessage};
				//send data to "shout.php" using jQuery $.post()
				$.post('main.php?action=shout', post_data, function(data) {
					
					//append data into messagebox with jQuery fade effect!
					$(data).hide().appendTo('.message_box').fadeIn();
	
					//keep scrolled to bottom of chat!
					var scrolltoh = $('.message_box')[0].scrollHeight;
					$('.message_box').scrollTop(scrolltoh);
					
					//reset value of message box
					$('#message').val('');
					
				}).fail(function(err) { 
				
				//alert HTTP server error
				alert(err.statusText); 
				});
			}
	});
	
	//toggle hide/show shout box
	$(".close_btn").click(function (e) {
		//get CSS display state of .toggle_chat element
		var toggleState = $('.toggle_chat').css('display');
		
		//toggle show/hide chat box
		$('.toggle_chat').slideToggle();
		
		//use toggleState var to change close/open icon image
		if(toggleState == 'block')
		{
			$(".header div").attr('class', 'open_btn');
		}else{
			$(".header div").attr('class', 'close_btn');
		}
		 
		 
	});
});

</script>
</head>

<body>
<a href="/backend/main.php?action=logout">
Logout
</a>
<a href="/backend/main.php?action=login">home</a>
  <a href="/backend/main.php?action=profileSearch">Search people</a>
  
<?php 
 for($i=1;$i<=2;$i++)
{
for($j=1;$j<=3;$j++)
{
echo $user[$i][$j]->name;

?>
<img src="<?php echo $user[$i][$j]->icon_link ?>" alt="Group" style= "height:200px; width:300px;" >
<?php
if($user[$i][$j]->id!=$_SESSION['userId'])
{
?>
 <form name="search_messages_of_a_user" id="form2" action="main.php?action=loadMessageByUser" method="POST" >
                       
                       <input type="text" name ="userId" value="<?php print_r($user[$i][$j]->id) ;?>" >
                       <input type="submit"  name="group" value="select"  >
                 </form>		
<?php
}
else
echo "<br>";
}
}
?>

<div class="shout_box">
<div class="header">Message <div class="close_btn">&nbsp;</div></div>
  <div class="toggle_chat">
  <div class="message_box">
    </div>
    <div class="user_info">
	<form name="change_chat_group_image"  enctype="multipart/form-data">
    <input name="sentById" id="sentById" type="text" value="<?php echo $_SESSION['groupId'];?>" maxlength="15" />
	<input name="sentByUserId" id="sentByUserId" type="text" value="<?php echo $_SESSION['userId'];?>" maxlength="15" />
	<input name="sentToId" id="sentToId" type="text" value="<?php echo $_SESSION['groupId1'];?>" maxlength="15" />
	<input type="file" id="image"  name="image" /><br>
   <input name="message" id="message" type="text" placeholder="Type Message Hit Enter" maxlength="100" /> 
   </form>
    </div>
    </div>
</div>
</body>
</html>











