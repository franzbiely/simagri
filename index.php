<link rel="stylesheet" href="./css/global.css" />
<link rel="stylesheet" href="./css/animate.css" />
<link rel="stylesheet" href="./css/layout.css" />
<link rel="stylesheet" href="./css/progress.css" />
<style>
	.index {
		background: url(./img/splash.jpg) center;
		background-size: cover;
		width:100%;
		height: 100%;
		position: fixed;
	}
	button {
		margin-top: 100px;
	}
	h1 {
		font-size: 150px;
		margin-bottom: 0;
		text-shadow: 2px 2px 1px #fff;
	}
	p {
		text-shadow: 1px 1px 0px #fff;
	}
</style>
<body>
	<div class="index flex-container">
		<div class="row">
			<h1>Sims Agri</h1>
			<p>Developed by Artificers</p>
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
			title : 'Rendering',
			func : function(){
				console.log('Rendering');
			}
		},
		3 : {
			title : 'Ready',
			func : function() {
				setTimeout(function() {
					Phase.out()
					window.location.href='./farmer-inputs.php';
				},1000)			
			}
		}
	}
	ProgressBar.render(tasks)
	
	// window.history.pushState("", "", '/farmer-details');


})
</script>