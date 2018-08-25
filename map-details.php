<link rel="stylesheet" href="./css/global.css" />
<link rel="stylesheet" href="./css/layout.css" />
<link rel="stylesheet" href="./css/progress.css" />
<link rel="stylesheet" href="./css/modal.css" />
<link rel="stylesheet" href="./css/inputs.css" />
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
#modal .float-right {
	border-left: 1px solid #eee;
	width:300px;
	text-align: left;
    font-size: 15px;
    font-style: italic;
}
input[type="number"] {
	width:150px;
	margin-top:0;
	margin-right: 10px;
}
button {
	float: right;
	width: 100px;
}
</style>
<body>
	<div class="map-details"></div>
</body>
<script src="./js/jquery.js"></script>
<script src="./js/modal.js"></script>
<script src="./js/progress.js"></script>
<script>
let loc = new URL(window.location.href).searchParams.get('loc'),
	subloc = new URL(window.location.href).searchParams.get('subloc'),
	area_details;
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

	$(document).on('click','.map-section', function() {
		var _this = this;
		var tasks = {
			1 : {
				title : 'Fetching Data',
				func : function(){
					area_details = Object.values(area.sections).filter(function(val) {
						if(val.name == $(_this).attr('name')) {
							return val;
						}
					})[0]
					console.log(area_details)
				}
			},
			2 : {
				title : 'Analysing',
				func : function(){
					console.log('Rendering');
				}
			},
			3 : {
				title : 'Prepare',
				func : function() {
					setTimeout(function() {
						let arg = {
							title : 'Area Details',
							body : '<div class="row">'+
								'<img style="float:left;" with="150" src="' + area_details.image + '" />'+
								'<div class="float-right">'+
									'<p>Soil Type  : <span>'+ area_details.soil_type +'</span></p>'+
									'<p>Acidity Type  : <span>'+ area_details.acidity_type +'</span></p>'+
									'<p>Acidity Level  : <span>'+ area_details.acidity_level +'</span></p>'+
									'<p>Elevation  : <span>'+ area_details.elevation +'</span></p>'+
									'<p>Slope  : <span>'+ area_details.slope +'</span></p>'+
									'<p>Moisture  : <span>'+ area_details.moisture +'</span></p>'+
									'<p>Humidity  : <span>'+ area_details.humidity +'</span></p>'+
									'<hr />'+
									'<p>Please enter your area size in hectar : </p>'+
									'<form method="POST" action="./plant_selection.php">'+
									'<input type="hidden" name="soil_type" value="'+area_details.soil_type+'" />'+
									'<input required type="number" name="area_size" />'+
									'<input type="submit" value="Analyze" />'+
									'</form>'+
								'</div>'+
							'</div>'
						}
						var modal = new Modal(arg);
					},1000)			
				}
			}
		}
		ProgressBar.render(tasks)
	})

})
</script>