<link rel="stylesheet" href="./css/global.css" />
<link rel="stylesheet" href="./css/layout.css" />
<link rel="stylesheet" href="./css/inputs.css" />
<link rel="stylesheet" href="./css/progress.css" />
<style>
.farmer-inputs {
	background: url('./img/page2.jpg') center;
	background-size: cover;
}
.farmer-inputs .box {
	background: rgba(255,255,255,0.8);
	border: 1px solid #000;
	border-radius:10px;
	box-shadow: 5px 5px 10px #000;
	padding: 20px;
}
</style>
<body>
	<div class="farmer-inputs flex-container">
		<div class="row">
			<div class="box">
				<h3>Hey Farmer!</h3>
				<p> Please choose your farm location.</p>
				<select>
					<option>[Please select]</option>
				</select>
				<br />
				<button>Enter</button>
			</div>
		</div>
	</div>
</body>
<script src="./js/jquery.js"></script>
<script src="./js/progress.js"></script>
<script src="./js/phase.js"></script>
<script>
let _data;
let selected_area;;
$.get('./db/location.json', function(data) {
	_data = data;
	Object.keys(data).map(function(name) {
		$('select').append('<option value="'+name+'">'+name.toUpperCase()+'</option>')
	})
})

$('button').on('click',function() {
	var tasks = {
		1 : {
			title : 'Fetching Data',
			func : function(){
				selected_area = _data[$('select').find(":selected").val()];
			}
		},
		2 : {
			title : 'Rendering Maps',
			func : function(){
				//
			}
		},
		3 : {
			title : 'Ready',
			func : function() {
				if($.isEmptyObject(selected_area)) {
					alert('Sorry. This location still needs more data.')
				}
				else {
					setTimeout(function() {
						// Phase.out()
						window.location.href='./maps.php?loc='+$('select').find(":selected").val();
					},1000)				
				}
				
			}
		}
	}
	ProgressBar.render(tasks)
})
</script>