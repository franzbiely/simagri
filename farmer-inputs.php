<link rel="stylesheet" href="./css/global.css" />
<link rel="stylesheet" href="./css/layout.css" />
<link rel="stylesheet" href="./css/inputs.css" />
<link rel="stylesheet" href="./css/progress.css" />
<body>
	<div class="farmer-inputs flex-container">
		<div class="row">
			<h3>Hey Farmer!</h3>
			<p> Please choose your farm location.</p>
			<select >
				<option>[Please select]</option>
				<option value='davao'>Davao</option>
				<option value='cebu'>Cebu</option>
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
$('button').on('click',function() {
	var tasks = {
		1 : {
			title : 'Fetching Data',
			func : function(){
				console.log('fetching');
			}
		},
		2 : {
			title : 'Rendering Maps',
			func : function(){
				console.log('Rendering');
			}
		},
		3 : {
			title : 'Ready',
			func : function() {
				setTimeout(function() {
					Phase.out()
					window.location.href='./maps.php';
				},1000)			
			}
		}
	}
	ProgressBar.render(tasks)
})
</script>