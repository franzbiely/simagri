var Phase = {
	out : function() {
		$('body *').addClass('out');
		setTimeout(function() {
			$('.out').remove()
		},1500)
	}
}