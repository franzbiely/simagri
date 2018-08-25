<?php
/**
 * Created by PhpStorm.
 * User: ikoymaster
 * Date: 25/08/2018
 * Time: 12:23 PM
 */
?>

<link rel="stylesheet" href="./css/global.css" />
<link rel="stylesheet" href="./css/layout.css" />
<link rel="stylesheet" href="./css/progress.css" />
<style>
	h1 {
		margin-bottom: 0;
		text-shadow: 2px 2px 1px #fff;
	}
	p {
    text-shadow: 1px 1px 0px #fff;
	}

	.result{
		display:none;
	}
</style>
<body>
	<div class="selection container">
		<div class="row">
			<h1>Plant Selection</h1>
		</div>
		<div class="info row">
			<p>Location:</p>
			<p>Soil type:</p>
		</div>
		<div class="input-group row">
			<p>
				<label for="crop-list">Suggested Crop List</label>
				<select class="crop-list" id="crop-list">
					<option>---SELECT---</option>
					<option>Mango</option>
					<option>Banana</option>
				</select>
			</p>
		</div>
		<div class="result row">
			<table class="table crop_data">
				<tr>
					<td class="field">Suggested Planting Months:</td>
					<td><span class="value">March to April</span></td>
				</tr>
				<tr>
					<td class="field">Estimated number of crops:</td>
					<td><span class="value">65 trees</span></td>
				</tr>
				<tr>
					<td class="field">Gap between plantation:</td>
					<td><span class="value">2m-3m</span></td>
				</tr>
				<tr>
					<td class="field">Flower Induction Months:</td>
					<td><span class="value">March to April</span></td>
				</tr>
				<tr>
					<td class="field">Growing Fertilizer:</td>
					<td><span class="value">Urea Apply once a month every month until supplies last</span></td>
				</tr>
				<tr>
					<td class="field">Estimated Yield:</td>
					<td><span class="value">100kg-200kg/tree</span></td>
				</tr>
			</table>
			<button>Create Summary</button>
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
				},1000)
			}
		}
	}
	ProgressBar.render(tasks)

	// window.history.pushState("", "", '/farmer-details');


});

$(".crop-list").on("change", function(e){
	$(".result").stop().fadeOut("slow").fadeIn("slow");
});

</script>