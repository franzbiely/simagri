<link rel="stylesheet" href="./css/global.css" />
<link rel="stylesheet" href="./css/layout.css" />
<link rel="stylesheet" href="./css/inputs.css" />
<link rel="stylesheet" href="./css/progress.css" />
<body>
	<div class="farmer-inputs flex-container">
		<div class="row">
			<h3>Hey Farmer!</h3>
			<p> Please choose your farm location.</p>
			<select>
				<option>[Please select]</option>
			</select>
			<br />
			<button>Enter</button>
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
						window.location.href='./maps.php?'+selected_area;
					},1000)				
				}
				
			}
		}
	}
	ProgressBar.render(tasks)
})
</script>