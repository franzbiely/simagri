<link rel="stylesheet" href="./css/global.css" />
<link rel="stylesheet" href="./css/layout.css" />
<link rel="stylesheet" href="./css/inputs.css" />
<link rel="stylesheet" href="./css/progress.css" />
<body>
    <div class="">
        <div class="row">
            <h3>Hey Farmer!</h3>
            <p> Below is the summary of your lands possible costing.</p>
            <?php 
                require_once("CalculateCosting.php");
                $calculateCost = new CalculateCosting();
                $data = $_REQUEST;
                $cost = $calculateCost->calculate($data);
                
                //print_r($data);
            ?>
            
        </div>
        
        <div class="row">
            <div class=""><p>Crop: </p></div>
            <div class=""><h4><?php echo $data['plant']; ?></h4></div>
        </div>
        <div class="row">
            <div class=""><p>Estimated Number of Crops: </p></div>
            <div class=""><h4><?php echo $data['estimated_plant_count']; ?></h4></div>
        </div>
        <div class="row">
            <div class=""><p>Production Age (in days): </p></div>
            <div class=""><h4><?php echo $data['production_age']; ?></h4></div>
        </div>
        <div class="row">
            <div class=""><p>Estimated Yield Per Production (in Grams): </p></div>
            <div class=""><h4><?php echo $data['estimated_yield_per_tree']['min']*$data['estimated_plant_count']; ?> - <?php echo $data['estimated_yield_per_tree']['max']*$data['estimated_plant_count']; ?></h4></div>
        </div>
        
        <div class="row">
            
            <h4>Fertilizers Cost:</h4>
            <?php echo "Php ".$cost['fertilizers']['total_cost']; ?>
            
            <h4>Fertilizers Cost Breakdown:</h4>
                    
            <table>
                <?php foreach($data['fertilizer'] as $name=>$fertilizer): 
                $fertilizer = explode(",",$fertilizer);
                ?>
                    <tr><th>Name:</th><td><?php echo $name; ?></td></tr>
                    <tr><th>Application:</th><td>Every <?php echo $fertilizer[0]; ?>&nbsp;Days</td></tr>
                    <tr><th></th><td><?php echo $fertilizer[1]; ?>&nbsp;Grams</td></tr>
                    <tr><th>Cost:</th><td>Php&nbsp;<?php echo $cost['fertilizers'][$name]['total_amount']; ?></td></tr>
                    <tr><th></th><td><?php echo $cost['fertilizers'][$name]['total_usage']; ?> Grams @ Php&nbsp;<?php echo $cost['fertilizers'][$name]['cost_per_gram']; ?> per Gram</td></tr>
                <?php endforeach; ?>
            </table>
        </div>

        <div class="row">
            <button>Apply for Loan</button>
        </div>
    </div>
</body>
<script src="./js/jquery.js"></script>
<script src="./js/progress.js"></script>
<script src="./js/process_summary.js"></script>

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
                },500)            
            }
        }
    }
    ProgressBar.render(tasks)
})

    console.log(JSON.parse(localStorage.getItem('plantInfo')));
</script>