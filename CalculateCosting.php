<?php
  class CalculateCosting{
      public function calculate($data){
          echo "<pre>";
          print_r($data);
          echo "</pre>";
          //process fertilizer
          $fertilizer_cost = $this->fertilizerCost($data['estimated_plant_count'], $data['days_to_harvest'], $data['fertilizers']);    
          
          return array(
            "fertilizers" => $fertilizer_cost
          );
      }
      
      public function fertilizerCost($crops_count, $days_to_harvest, $fertilizers){
          $returns = array();
          $returns['total_cost'] = 0;
          foreach($fertilizers as $application){
                $fert_data = $this->fetchFertilizer($application['name']);
                $cost_per_gram = $fert_data['price']/$fert_data['quantity'];
                $application_times = $days_to_harvest/$application['frequency_span'];
                $total_applied = $crops_count * $application['quantity'] * $application_times;
                
                $returns[$application['name']] = array(
                    "cost_per_gram" => $cost_per_gram,
                    "total_usage" => $total_applied,
                    "total_amount" => $total_applied * $cost_per_gram,
                );
                
                $returns['total_cost'] += round(($cost_per_gram * $total_applied), 2);
          }
          return $returns;
      }
      
      /*
      public function fetchData(){
        $file = "db/summary.json";
        return json_decode(file_get_contents($file), TRUE);    
      }
      */
      
      public function fetchFertilizer($name){
        $file = "db/fertilizers.json";
        $data = json_decode(file_get_contents($file), TRUE);    
        return $data[$name];
      }
  }
?>
