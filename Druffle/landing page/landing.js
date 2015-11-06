	
var tag = document.createElement('script');
tag.src = "//www.youtube.com/iframe_api";
var firstScriptTag = document.getElementsByTagName('script')[0];
firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

// Create YouTube player(s) after the API code downloads.
var player;
function onYouTubeIframeAPIReady() {
    player = new YT.Player('vid1');
}

$(document).ready(function(){
	


	var video = document.getElementById("vid1");
	
		$('#play').click(function(){
		$('#blur').css("visibility","visible");
		
		player.playVideo();
		});
		
		
		$(document).mouseup(function (e)
	{
		var container = $('#vid1');

		if (!container.is(e.target) // if the target of the click isnt the container...
			&& container.has(e.target).length === 0)  // ... nor a descendant of the container
		{
			$("#blur").css("visibility","hidden");
			
			player.pauseVideo();
		}
	});
	
	
	  
     
 $('.butt').click(function (e) {
    e.preventDefault();
    $("#popup").css("visibility","visible");
    setTimeout(function () {
    $('.butt').unbind('click');
      $('.butt').trigger('click');
    }, 1000); // in milliseconds
});

  
});