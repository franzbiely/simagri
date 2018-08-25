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
                $data = $calculateCost->data;
                $cost = $calculateCost->calculate();
            ?>
            
        </div>
        
        <div class="row">
            <div class=""><p>Crop: </p></div>
            <div class=""><h4><?php echo $data['crop']; ?></h4></div>
        </div>
        <div class="row">
            <div class=""><p>Yield: </p></div>
            <div class=""><h4><?php echo $data['yield']; ?></h4></div>
        </div>
        <div class="row">
            <div class=""><p>Total Arable Area: </p></div>
            <div class=""><h4><?php echo $data['arable_area']; ?></h4></div>
        </div>
        <div class="row">
            <div class=""><p>Number of Crops: </p></div>
            <div class=""><h4><?php echo $data['crops_count']; ?></h4></div>
        </div>
        <div class="row">
            <div class=""><p>Total Arable Area: </p></div>
            <div class=""><h4><?php echo $data['arable_area']; ?></h4></div>
        </div>
        <div class="row">
            <div class=""><p>Soil Classification: </p></div>
            <div class=""><h4><?php echo $data['soil_type']; ?></h4></div>
        </div>

        <div class="row">
            
            <h4>Fertilizers Cost:</h4>
            <?php echo "Php ".$cost['fertilizers']['total_cost']; ?>
            
            <h4>Fertilizers Cost Breakdown:</h4>
                    
            <table>
                <?php foreach($data['fertilizers'] as $fertilizer): ?>
                    <tr><th>Name:</th><td><?php echo $fertilizer['name']; ?></td></tr>
                    <tr><th>Application:</th><td>Every <?php echo $fertilizer['frequency_span']; ?>&nbsp;Days</td></tr>
                    <tr><th></th><td><?php echo $fertilizer['quantity']; ?>&nbsp;Grams</td></tr>
                    <tr><th>Cost:</th><td>Php&nbsp;<?php echo $cost['fertilizers'][$fertilizer['name']]['total_amount']; ?></td></tr>
                    <tr><th></th><td><?php echo $cost['fertilizers'][$fertilizer['name']]['total_usage']; ?> Grams @ Php&nbsp;<?php echo $cost['fertilizers'][$fertilizer['name']]['cost_per_gram']; ?> per Gram</td></tr>
                <?php endforeach; ?>
            </table>
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
</script>