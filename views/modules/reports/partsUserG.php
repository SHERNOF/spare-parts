<!--=====================================
Sellers
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
        {y: 'Sherwin Nofuente', a: 10012, b: 90},
        {y: 'Angelyn Nofuente', a: 7534, b: 65},
        {y: '2008', a: 5023, b: 40},
      
      ],
      barColors: ['#00a65a', '#f56954'],
      xkey: 'y',
      ykeys: ['a', 'b'],
      labels: ['CPU', 'DISK'],
      hideHover: 'auto'
    });

</script>