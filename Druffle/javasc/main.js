
$(document).ready(function(){
	var body =$('body');
	var right =$('.right');
	// moving right n left
	$('.move_right').click(function(){
	 right.animate( { scrollLeft: '+=386' },3000);
});
	 
	
	
	$('.move_left').click(function(){
right.animate( { scrollLeft: '-=386' }, 3000);
});
																			//body.scrollLeft(body.scrollLeft()- 320); body.animate( { scrollLeft: '+=50' }
																		//timerID2 = setInterval(slideLeft,1000);},function() {
																		//clearInterval(timerID2)
	// aniamtion for hamburger	
		
		$('.but').click(function(){		//quick search animation
		var tst=$('#tst');
		var position = tst.position();
		if(position.top == -200)
		{tst.animate({top:'46px'},800);}
		else{tst.animate({top:'-200px'},500);}
		});
		
		$(document).mouseup(function (e)
	{
		var container = $('#tst');

		if (!container.is(e.target) // if the target of the click isn't the container...
			&& container.has(e.target).length === 0) // ... nor a descendant of the container
		{
			container.animate({top:'-200px'},500);
		}
	});
	// end of hamb
	
	
	
	// this for scrolling of mouse moves right n left
	var mouseWheelEvt = function (e)
{
    var event = e || window.event;
    if (document.body.doScroll)
        document.body.doScroll(event.wheelDelta>0?"left":"right");
    else if ((event.wheelDelta || event.detail) > 0)
        document.body.scrollLeft -= 10;
    else
        document.body.scrollLeft += 10;

    return false;
}
if ("onmousewheel" in document.body)
    document.body.onmousewheel = mouseWheelEvt;
else
    document.body.addEventListener("DOMMouseScroll", mouseWheelEvt);
	
	// end of scrollwheel
	
	
	
	
	
	// my grp setting on header
	$('#grp_list').hide();
      $('#grp_link').click(function(){
	  $('#grp_list').toggle();
	  });
	  $('#set_mygrp').click(function(){
	var id = $("#grp_list input[type='radio']:checked").attr('id');
	$.ajax({
				type: "POST",
				url: "./backend/header.php",
				data: { query: id, action: "set_mygrp" },
				cache: false,
				
			});
   });
   
	// notifications
	$.ajax({ url: './backend/header.php',
         data: {action: 'chat_req'},
         type: 'post',
         success: function(output) {
                     $('#notif_ul').html(output);
                  }
});     	
//			notification ends,

 
//name search begins


		function searchName() {
		var query_value = $('input#by_name').val();
		if(query_value !== ''){
			$.ajax({
				type: "POST",
				url: "./backend/header.php",
				data: { query: query_value, action: "nm_search" },
				cache: false,
				success: function(html){
					$("ul#nm_list").html(html);
				}
			});
		}return false;    
	}
$("#name_box").hide();

	$("input#by_name").on("keyup", function(e) {
		clearTimeout($.data(this, 'timer'));
		var search_string = $(this).val();
		if (search_string == '') {
			$("#name_box").hide();
			$("ul#nm_list").fadeOut();
			$('.nm_txt').fadeOut();
		}
		else{
		$("#name_box").show();
			$("ul#nm_list").fadeIn();
			$('.nm_txt').fadeIn();
			$(this).data('timer', setTimeout(searchName, 100));
		};
	});
	
// name search ends


//image reordering
		$('ul#nm_list').on('click','li',function(){
		var txt = $(this).text();

		var arr= txt.split('*');
				
		var id_value= arr[1];
		
		if(id_value !== ''){
			$.ajax({
				type: "POST",
				url: "./backend/header.php",
				data: { id: id_value, action: "get_person" },
				cache: false,
				success: function(html){
					$("#search_top_img").html(html);
				}
			});
		}return false;    
		
		
		});


// send chat request to some group
		$('chat_req_but').click(function(){
		
		$.ajax({
				type: "POST",
				url: "./backend/header.php",
				data: { action: "get_person" },
				cache: false,
				success: function(html){
					$("#search_top_img").html(html);
				}
			});
		
		
		
		
		});



});
