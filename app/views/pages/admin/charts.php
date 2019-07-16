<?php require APPROOT . "/views/inc/header.php" ?>
<?php require APPROOT . "/views/inc/aside.php" ?> 
	<div class="col-lg-10 col-md-9 col-sm-12" id="chartDiv">

		<div class="first-chart">
			<div id="piechart_3d" style="width: 900px; height: 500px;"></div>
		</div>
		<div class="second-chart">
		 	<div id="piechart_3d2" style="width: 900px; height: 500px;"></div> 
		</div>
	</div>

	<footer></footer>

 
 <script type="text/javascript">

 	window.onload=function(){
 		getDataFrstChart();

 	}
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart(datas,options,chart) {
	      var data = google.visualization.arrayToDataTable(datas);
	      chart.draw(data, options);
      }
      function getDataFrstChart(){
      		$.ajax({
				type : 'GET',
				url : 'http://localhost/automobili/Charts/getDataForFirstCharts',				
				data : {
					insurance_form: 1, 
				},
				success: function(response){
					var resp = JSON.parse(response);
					console.log(resp);
					var options1 = {
			          title: 'Manufacturers cars',
			          is3D: true,
			        };
			        var chart1 = new google.visualization.PieChart(document.getElementById('piechart_3d'));
					drawChart(resp[0],options1,chart1);
					var options2 = {
			          title: 'Colors of cars',
			          is3D: true,
			          colors: resp[2]
			        };
			        var chart2 = new google.visualization.PieChart(document.getElementById('piechart_3d2'));
			        drawChart(resp[1],options2,chart2);
					
				},
				dataType : 'text'
			});
      }
    </script>

 



<?php require APPROOT . "/views/inc/footer.php" ?> 