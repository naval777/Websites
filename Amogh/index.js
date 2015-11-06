$(document).ready(function(){


	$('#learn_more').click(function(){
	$('#page0').animate({'top':'-100%'},1000);
	$('#page1').animate({'top':'0'},1000);
			});
	$('.mech_detail').hide();
	$('.elec_detail').hide();
	$('.soft_detail').hide();
	$('.intro').show();

	$('#m1').click(function(){$('.mech_detail').hide();
	$('#mb1').show()});
		$('#m2').click(function(){$('.mech_detail').hide();
	$('#mb2').show()});
		$('#m3').click(function(){$('.mech_detail').hide();
	$('#mb3').show()});
		$('#m4').click(function(){$('.mech_detail').hide();
	$('#mb4').show()});
		$('#m5').click(function(){$('.mech_detail').hide();
	$('#mb5').show()});
		$('#m6').click(function(){$('.mech_detail').hide();
	$('#mb6').show()});
		$('#m7').click(function(){$('.mech_detail').hide();
	$('#mb7').show()});

	$('#e1').click(function(){$('.elec_detail').hide();
	$('#eb1').show()});
		$('#e2').click(function(){$('.elec_detail').hide();
	$('#eb2').show()});
		$('#e3').click(function(){$('.elec_detail').hide();
	$('#eb3').show()});
		$('#e4').click(function(){$('.elec_detail').hide();
	$('#eb4').show()});
		$('#e5').click(function(){$('.elec_detail').hide();
	$('#eb5').show()});
		$('#e6').click(function(){$('.elec_detail').hide();
	$('#eb6').show()});
		$('#e7').click(function(){$('.elec_detail').hide();
	$('#eb7').show()});

		$('#s1').click(function(){$('.soft_detail').hide();
	$('#sb1').show()});
		$('#s2').click(function(){$('.soft_detail').hide();
	$('#sb2').show()});
		$('#s3').click(function(){$('.soft_detail').hide();
	$('#sb3').show()});
		$('#s4').click(function(){$('.soft_detail').hide();
	$('#sb4').show()});

$(".button-collapse").sideNav();

});