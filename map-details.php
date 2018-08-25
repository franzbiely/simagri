<link rel="stylesheet" href="./css/global.css" />
<link rel="stylesheet" href="./css/layout.css" />
<style>
.map-details {
	height: 100%;
	background-repeat: no-repeat;
	position: relative;
}
.map-section {
	position: absolute;
	opacity: 0.1;
	cursor: pointer;
	transition-duration: 0.2s;
}
.map-section:hover {
	opacity: 1;
}
</style>
<body>
	<div class="map-details"></div>
</body>
<script src="./js/jquery.js"></script>
<script>
let loc = new URL(window.location.href).searchParams.get('loc'),
	subloc = new URL(window.location.href).searchParams.get('subloc');
// Fetch db
$.get('./db/location.json', function(data) {
	let area = data[loc][subloc];
	$('.map-details').css({
		backgroundImage : 'url('+area.image+')'
	})
	Object.values(area.sections).map(function(val) {
		var ob1 = document.createElement('img');
			ob1.setAttribute('class','map-section');
			ob1.setAttribute('name', val.name);
			ob1.setAttribute('src', val.image);
			ob1.style.width = val.image_prop.w + 'px';
			ob1.style.height = val.image_prop.h + 'px';
			ob1.style.left = val.image_prop.x + 'px';
			ob1.style.top = val.image_prop.y + 'px';
		$('.map-details').append(ob1);
	})


})
</script>