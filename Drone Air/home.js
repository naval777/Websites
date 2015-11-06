$(document).ready(function(){
	$('#header2').hide();
	///////////////////////////////////////////////////////////////////////////////
	var count=0;
	nextSlide();
	function nextSlide(){
    // Go forward or back to the beginning?
    count=count==7?1:++count;
    $("#slid_img"+count).fadeIn(500).delay(5500).fadeOut(500);
    setTimeout(function(){nextSlide()},6100);
	}
	///////////////////////////////////////////////////////////////////////////////
	$('#menu1').hover(function(){
	$('#header2').show();
	});

	$(document).mouseup(function (e)
	{
		var container = $("#header2");

		if (!container.is(e.target) // if the target of the click isn't the container...
			&& container.has(e.target).length === 0) // ... nor a descendant of the container
		{
			container.hide();
		}
	});


});
/*	setInterval(function(){
			
		},8000);
if($img1.offset().left== 0){
			$img2.animate({left:"0%"},2000);
			$img1.delay(2600).animate({left:"100%"},1000);
		}
		if($img2.offset().left== 0){
			$img3.animate({left:"0%"},2000);
			$img2.delay(2600).animate({left:"100%"},1000);
		}
		if($img3.offset().left== 0){
			$img4.animate({left:"0%"},2000);
			$img3.delay(2600).animate({left:"100%"},1000);
		}
		if($img4.offset().left== 0){
			$img1.animate({left:"0%"},2000);
			$img4.delay(2600).animate({left:"100%"},2000);}		*/
