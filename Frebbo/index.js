$(document).ready(function(){	

	var vheight = $(window).height();
	
		
	$('#page').fullpage({
	normalScrollElements: '#page2_part8',
	easingcss3: 'ease',
	navigation:true,
	 scrollingSpeed: 1500,

	  onLeave: function(index, nextIndex, direction){
            var leavingSection = $(this);

            //after leaving section 2
            if(index == 10 && direction =='down'){
				 $('.hideme').hide();$('.fademe').fadeOut(1000);
                $('#page2_part8_clone').show(); $('#page2_part8_clone').css({'visibility':'visible'});
            }
			else{ $('#page2_part8_clone').hide(); $('.hideme').show();$('.fademe').show();}
			

        }
	});
	
	$('#page1').click(function(){$.fn.fullpage.moveSectionDown();});
	$('#page2_part8_clone').hide();
	$('#cover1').click(function(){
	var time=2500;
	$('#sp1').animate({'top':'18%','left':'58%'},time);
	$('#sp2').animate({'top':'12%','left':'62%'},time);
	$('#sp3').animate({'top':'30%','left':'55%'},time);
	$('#sp4').animate({'top':'25%','left':'51%'},time);
	$('#sp5').animate({'top':'2%','left':'57%'},time);
	$('#sp6').animate({'top':'22%','left':'52%'},time);
	$('#sp7').animate({'top':'10%','left':'49%'},time);
	$('#sp8').animate({'top':'12%','left':'50%'},time);
	$('#sp9').animate({'top':'10%','left':'53%'},time);
	$('#sp10').animate({'top':'8%','left':'55%'},time);
	});

	
	setInterval(function(){ 
	
	var scroll1=$('#page2_part3_p2').hasClass('active');
		if(scroll1){$('#cover1').trigger("click");}
	
	
	 }, 250);

   
});	



	
	
	
	
	
	
	
	
	
	

