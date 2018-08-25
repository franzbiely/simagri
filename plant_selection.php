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
	}
	p {
    text-shadow: 1px 1px 0px #fff;
	}

	.result{
		display:none;
	}
	.sub{
		font-style: italic;
	}
</style>
<body>
	<div class="selection container">
		<div class="row">
			<h1>Plant Selection</h1>
		</div>
		<div class="info row">
			<p>Land Area: <span><?php echo $_REQUEST["area_size"] ?> Hectare(s)</span></p>
			<p>Soil type: <span><?php echo $_REQUEST["soil_type"] ?></span></p>
		</div>
		<div class="input-group row">
			<p>
				<label for="crop-list">Suggested Crop List</label>
				<select class="crop-list" id="crop-list">
					<option>---SELECT---</option>
				</select>
			</p>
		</div>
		<div class="result row">
			<form action="./summary.php">
				<table class="table crop_data">
				</table>
				<input type="submit" value="Create Summary">
			</form>
		</div>
	</div>
</body>
<script src="./js/jquery.js"></script>
<script src="./js/progress.js"></script>
<script src="./js/phase.js"></script>
<script>
$(document).ready(function(){
	var plants;
	var x = <?php echo $_REQUEST["area_size"]?> * 10000;
	$.getJSON( "db/plants.json", function( data ) {
		var options = "";
		plants = data;
		$.each( data, function( key, val ) {
			if(val.soil == "<?php echo $_REQUEST["soil_type"];?>")
				options +="<option value='"+key+"' >"+key+"</option>";
		});
		$("#crop-list").append(options);

	});
	$(".crop-list").on("change", function(e){
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
						key = $(".crop-list").val();
						tds = ""
						$.each( plants[key]["details"], function (index, value){
							tds += "<tr>"+
								"<td class='field'>"+index+":</td>";

							if($.type(value) === "object" ){
								tds +=	"<td></td>"+
									"</tr>";
								$.each(value, function (i, o){

									tds += "<tr>"+
										"<td class='field sub'>"+i+":</td>"+
										"<td>"+o+"</td>"+
										"<input type='hidden' name='"+ i.replace(" ","_").toLowerCase()+"' value='"+o+"'>"+
										"</tr>"	;
								});
							}else{
								if(index == "estimated plant count"){
									tds +=	"<td><span class='value'>"+eval(value)+"</span>";
								}
								else{
									tds +=	"<td><span class='value'>"+value+"</span>";
								}

							tds +="<input type='hidden' name='"+ index.replace(" ","_").toLowerCase()+"' value='"+value+"'></td>"+
								"</tr>";


							}

							$(".crop_data").html(tds);


						});

						$(".result").stop().fadeOut("slow").fadeIn("slow");
					},1000)
					Phase.out();
				}
			}
		}
		ProgressBar.render(tasks)

	});
});

</script>