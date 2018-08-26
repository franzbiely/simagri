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
<link rel="stylesheet" href="./css/inputs.css" />
<style>
	.selection {
		background: url('./img/bg2.jpg') center;
		background-size: cover;
	}
	h1 {
		margin-bottom: 0;
	}
	table {
		margin-bottom: 30px !important;
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
	<div class="selection container flex-container">
		<div class="row">
			<div class="box clearfix">
				<div class="float-left">
					<h1>Plant Selection</h1>
					<div class="info row">
						<p>Land Area: <span><?php echo $_REQUEST["area_size"] ?> Hectare(s)</span></p>
						<p>Soil type: <span><?php echo $_REQUEST["soil_type"] ?></span></p>
					</div>
					<div class="input-group row">
						<p>
							<label for="crop-list">Suggested Crop List :</label><br />
							<select class="crop-list" id="crop-list">
								<option>---SELECT---</option>
							</select>
						</p>
					</div>
				</div>
				<div class="float-right">
					<div class="result row">
						<form action="./summary.php" id="crop_data" method="POST">
							<table class="table crop_data">
							</table>
							<input type="submit" value="Create Summary">
						</form>
					</div>
				</div>
			</div>
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
						tds = "<input type='hidden' name='plant' value='"+key+"'>"
						$.each( plants[key]["details"], function (index, value){
							tds += "<tr>"+
								"<td class='field'>"+index+":</td>";

							if($.type(value) === "object" ){
								tds +=	"<td></td>"+
									"</tr>";
								$.each(value, function (i, o){

									if($.type(o) === "object"){
										$.each(o, function (a, b){
											tds += "<tr>"+
												"<td class='field sub'>"+ a +":</td>"+
												"<td>"+b+"</td>"+
												"<input type='hidden' name='"+ index.replace(" ","_").toLowerCase()+"["+a.replace(" ","_").toLowerCase()+"]' value='"+b+"'>"+
												"</tr>"	;
										});
									}else{
										tds += "<tr>"+
											"<td class='field sub'>"+i+":</td>"+
											"<td>"+o+"</td>"+
											"<input type='hidden' name='"+ index.replace(" ","_").toLowerCase()+"["+i.replace(" ","_").toLowerCase()+"]' value='"+o+"'>"+
											"</tr>"	;
									}


								});
							}else{
								if(index == "estimated plant count"){
									tds +=	"<td><span class='value'>"+eval(value)+"</span>";
									tds +="<input type='hidden' name='"+ index.replace(" ","_").toLowerCase()+"' value='"+eval(value)+"'></td>"+
										"</tr>";
								}
								else{
									tds +=	"<td><span class='value'>"+value+"</span>";
									tds +="<input type='hidden' name='"+ index.replace(" ","_").toLowerCase()+"' value='"+value+"'></td>"+
										"</tr>";
								}


							}

							$(".crop_data").html(tds);


						});

						$(".result").stop().fadeOut("slow").fadeIn("slow");
					},1000)
					// Phase.out();
				}
			}
		}
		ProgressBar.render(tasks)

	});

	$("#crop_data").on("submit", function(e){
		localStorage.setItem('plantInfo', JSON.stringify($(this).serializeArray()) );


	});
});

</script>