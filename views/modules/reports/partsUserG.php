<?php

$item = null;
$value = null;

$sales = ControllerWithdrawal::ctrShowWithdrawal($item, $value);
$Customers = ControllerpartsUser::ctrShowpartsUser($item, $value);

$arrayCustomers = array();
$arrayCustomersList = array();

foreach ($sales as $key => $valueSales) {

  foreach ($Customers as $key => $valueCustomers) {

    if($valueCustomers["id"] == $valueSales["idPartsUser"]){

        #We capture Customers in an array
        array_push($arrayCustomers, $valueCustomers["name"]);

        #We capture the names and net values in the same array
        $arrayCustomersList = array($valueCustomers["name"] => $valueSales["netPrice"]);

        #We add the netprice of each Customer

        foreach ($arrayCustomersList as $key => $value) {

            $addingTotalSales[$key] += $value;

         }

    }
  
  }

}

#Avoiding repeated names
$dontrepeatnames = array_unique($arrayCustomers);

?>


<!--=====================================
Issuers
======================================-->

<div class="box box-primary">
	
	<div class="box-header with-border">
    
    	<h3 class="box-title">Part Users</h3>
  
  	</div>

  	<div class="box-body">
  		
		<div class="chart-responsive">
			
			<div class="chart" id="bar-chart" style="height: 300px;"></div>

		</div>

  	</div>

</div>

<script>

//BAR CHART
    var bar = new Morris.Bar({
      element: 'bar-chart',
      resize: true,
      data: [

        <?php
    
        foreach($dontrepeatnames as $value){

         echo "{y: '".$value."', a: '".$addingTotalSales[$value]."'},";

        }

        ?>

        // {y: 'Jamal', a: 10012},
        // {y: 'David', a: 5023, b: 40
      
      ],
      barColors: ['#f6a',],
      xkey: 'y',
      ykeys: ['a'],
      labels: ['sales'],
      hideHover: 'auto'
    });

</script>