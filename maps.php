<link rel="stylesheet" href="./css/global.css" />
<link rel="stylesheet" href="./css/layout.css" />
<link rel="stylesheet" href="./css/animate.css" />
<style>
	#maps {
		
	}
	#maps .map {
		cursor: pointer;
		width:400px;
		margin: 20px 30px;
		height: 300px;
		transition-duration: 0.2s;
		border-radius: 20px;
		border:1px solid transparent;
	}
	#maps div {
		display:inline-block;
		float:left;
	}
	#maps .map:hover {
		box-shadow: 0px 0px 100px #000;
		border-color: #fff;
	}

</style>
<body>
	<div class="maps flex-container">
		<div class="row">
			<h3>Choose Maps</h3>
			<div id="maps" class="clearfix">
				<div class="clear:both"></div>
			</div><br /><br /><br />
			<small>Location not listed? <a href="mailto:request@simagri.ph">Request a location to map</a></small>
		</div>
	</div>
</body>
<script src="./js/jquery.js"></script>
<script src="./js/phase.js"></script>
<script>
$('body *').addClass('animated');
let loc;
$.get('./db/location.json', function(data) {
	loc = new URL(window.location.href).searchParams.get('loc');
	console.log(data[loc]);
	Object.keys(data[loc]).map(function(name) {
		$('#maps').prepend('<div><img class="map" data="'+name+'" src="'+data[loc][name].image+'" /><br /><small>'+name.toUpperCase()+', Davao</small></div>')
	})
})

$(document).on('click','.map',function() {
	var that = this;
	setTimeout(function() {
		Phase.out();
	},1000)			
	setTimeout(function() {
		window.location.href='./map-details.php?loc='+loc+'&subloc='+$(that).attr('data');
	}, 1500);
});
</script>