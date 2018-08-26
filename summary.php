<link rel="stylesheet" href="./css/global.css" />
<link rel="stylesheet" href="./css/layout.css" />
<link rel="stylesheet" href="./css/inputs.css" />
<link rel="stylesheet" href="./css/progress.css" />
<style>
.summary {
    background: url('./img/page2.jpg') center;
    background-size: cover;
}
.summary .box {
    background: rgba(255,255,255,0.8);
    border: 1px solid #000;
    border-radius:10px;
    box-shadow: 5px 5px 10px #000;
    padding: 20px;
}
.float-left {
    padding: 20px;
}
.float-right {
    border-left: 1px solid #999;
    padding: 20px;
    text-align: left;
}
.block {
}
</style>
<body>
    <div class="summary flex-container">
        <div class="row">
            <div class="box clearfix">
                <div class="float-left">
                    <div class="block">
                        <h1>Hey Farmer!</h1>
                        <p> Below is the summary of your lands possible costing.</p>
                        <hr />
                        <?php 
                            require_once("CalculateCosting.php");
                            $calculateCost = new CalculateCosting();
                            $data = $_REQUEST;
                            round($cost = $calculateCost->calculate($data), 2);
                            
                            //print_r($data);
                        ?>
                        
                    </div>
                    
                    <div class="block">
                        <div class=""><p>Crop: <strong><?php echo $data['plant']; ?></strong></p></div>
                    </div>
                    <div class="block">
                        <div class=""><p>Estimated Number of Crops: <strong><?php echo $data['estimated_plant_count']; ?></strong></p></div>
                    </div>
                    <div class="block">
                        <div class=""><p>Production Age (in days): <strong><?php echo $data['production_age']; ?></strong></p></div>
                    </div>
                    <div class="block">
                        <div class=""><p>Estimated Yield Per Production (in Grams): </p></div>
                        <div class=""><h4><?php echo $data['estimated_yield_per_tree']['min']*$data['estimated_plant_count']; ?> - <?php echo $data['estimated_yield_per_tree']['max']*$data['estimated_plant_count']; ?></h4></div>
                    </div>
                </div>
                <div class="float-right">
                    <div class="block">
                        
                        <h4>Fertilizers Cost:</h4>
                        <?php echo "Php ".round($cost['fertilizers']['total_cost'],2); ?>
                        
                        <h4>Fertilizers Cost Breakdown:</h4>
                                
                        <table>
                            <?php foreach($data['fertilizer'] as $name=>$fertilizer): 
                            $fertilizer = explode(",",$fertilizer);
                            ?>
                                <tr><th>Name:</th><td><?php echo $name; ?></td></tr>
                                <tr><th>Application:</th><td>Every <?php echo $fertilizer[0]; ?>&nbsp;Days</td></tr>
                                <tr><th></th><td><?php echo $fertilizer[1]; ?>&nbsp;Grams</td></tr>
                                <tr><th>Cost:</th><td>Php&nbsp;<?php echo round($cost['fertilizers'][$name]['total_amount'],2 ); ?></td></tr>
                                <tr><th></th><td><?php echo round($cost['fertilizers'][$name]['total_usage'],2); ?> Grams @ Php&nbsp;<?php echo round($cost['fertilizers'][$name]['cost_per_gram'],2); ?> per Gram</td></tr>
                            <?php endforeach; ?>
                        </table>
                    </div><br />
                    <hr /><br />
                    <div class="block clearfix" style="text-align: center;">
                        <button style="float:left; line-height: 35px;">Apply for Loan &nbsp;&nbsp;<img style="float:right;" src="./img/unionbank.png" width="150" /></button>
                        
                    </div>
                </div>
            </div>
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
                alert('Service under construction.')
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