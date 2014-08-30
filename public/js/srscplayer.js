var widget = null;
var isPlaying = false;
var volume = 100;
var totalDuration = 0;
$(function(){
	var widgetIframe = document.getElementById('sc-widget');
	widget = SC.Widget(widgetIframe);
	widget.bind(SC.Widget.Events.READY, function() {
		widget.getDuration(function(durationSC) {
			totalDuration = durationSC;
			$("#time_info").html( msToHMS(durationSC));
		});
		
		widget.bind(SC.Widget.Events.FINISH, function() {
			widget.seekTo(0);
			isPlaying = false;
			$("#pause_button").css("display","none");
			$("#play_button").css("display","block");
		});
		
		widget.bind(SC.Widget.Events.PAUSE, function(){
			$("#pause_button").css("display","none");
			$("#play_button").css("display","block");
		});
		
		widget.bind(SC.Widget.Events.PLAY, function(){
			$("#play_button").css("display","none");
			$("#pause_button").css("display","block");
		});
		
		$("#play_pause_buttons .fs1").on('click',function(e){
			e.preventDefault();
			widget.toggle(); 
		});
		
		// get current level of volume
		widget.getVolume(function(volume) {});

		// set new volume level
		widget.setVolume(100);
		
		widget.bind(SC.Widget.Events.PLAY_PROGRESS, function(e) {
			var sliderPos = parseInt((e.relativePosition * 100) - 100);
			$('.position').css('width', ( e.relativePosition*100)+"%");
			$("#player_controls .space2").css("background-position",sliderPos + "px 2px");
		});
		
		$("#time_info").click(function(event){
			pos_x = event.offsetX ? (event.offsetX):event.pageX - document.getElementById("time_info").offsetLeft;
			var t = Math.floor((totalDuration * (pos_x - 10))/100);
			//alert((totalDuration * (pos_x - 10))/100);
			widget.seekTo(t);
		});
	});

}());

function mute(){
	if(widget != null && volume == 100){
		widget.setVolume(0);
		volume = 0;
		$("#mute_button").css("display","none");
		$("#unmute_button").css("display","block");
	}
	else if (widget != null && volume == 0) {
		widget.setVolume(100);
		volume = 100;
		$("#mute_button").css("display","block");
		$("#unmute_button").css("display","none");
	}
}

function msToHMS(ms){
	var sec = Math.floor(ms/1000);
	var hour = Math.floor(sec/(60*60));
	hour = (hour == 0) ? '' : hour + ":";
	var min = Math.floor((sec - hour*60*60)/60);
	var sec = sec - hour*60*60 - min*60;
	
	return hour + pad(min+'',2,'0',STR_PAD_LEFT) + ":" + pad(sec+'',2,'0',STR_PAD_LEFT);
}

var STR_PAD_LEFT = 1;
var STR_PAD_RIGHT = 2;
var STR_PAD_BOTH = 3;

function pad(str, len, pad, dir) {
	if (typeof(len) == "undefined") { len = 0; }
	if (typeof(pad) == "undefined") { pad = ' '; }
	if (typeof(dir) == "undefined") { dir = STR_PAD_RIGHT; }

	if (len + 1 >= str.length) {
		switch (dir){
			case STR_PAD_LEFT:
				str = Array(len + 1 - str.length).join(pad) + str;
				break;
			case STR_PAD_BOTH:
				var right = Math.ceil((padlen = len - str.length) / 2);
				var left = padlen - right;
				str = Array(left+1).join(pad) + str + Array(right+1).join(pad);
				break;
			default:
				str = str + Array(len + 1 - str.length).join(pad);
				break;
		} // switch
	}
	return str;
}