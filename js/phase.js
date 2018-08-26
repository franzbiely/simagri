var Phase = {
	out : function(to) {
		var animation = ['fadeOutUp','fadeOutDown','fadeOut'];

		$('body *').addClass(animation[Math.floor(Math.random()*animation.length)]);
		setTimeout(function() {
			$(document).find('.animated').remove();
		},1000)
	}
}
