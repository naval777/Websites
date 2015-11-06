$(document).ready(function(){

(function($) {
    $.fn.writeText = function(content) {
        var contentArray = content.split(""),
            current = 0,
            elem = this;
        setInterval(function() {
            if(current < contentArray.length) {
                elem.text(elem.text() + contentArray[current++]);
            }
        }, 100);
    };
    
})(jQuery);
$("#holder").writeText("Wake up, Neo...");
setTimeout(function(){$("#holder").html("");$("#holder").writeText("The Matrix has you...");},2000);
setTimeout(function(){$("#holder2").writeText("Make your choice...");},4000);
setTimeout(function(){$("#holder3").writeText("1. Blue pill...");},6000);
setTimeout(function(){$("#holder4").writeText("2. Red pill...");},6000);
setTimeout(function(){$("#holder5").writeText("ENTER THE NUMBER YOU CHOOSE...");},8000);
setTimeout(function(){$("#holder6").writeText("_");},11000);
$( document ).keydown(
			function ( event ) {
				if(event.keyCode == 49) window.location.href = "http://matrix.wikia.com/wiki/Bluepill";
				if(event.keyCode == 50) window.location.href = "http://matrix.wikia.com/wiki/Redpill";
				
			});
});
