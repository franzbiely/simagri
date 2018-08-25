var Phase = {
	out : function() {
		var animation = ['fadeOutUp','fadeOutDown','fadeOut'];
		$('body *').addClass(animation[Math.floor(Math.random()*animation.length)]);
		setTimeout(function() {
			$('.out').remove()
		},1500)
	}
}