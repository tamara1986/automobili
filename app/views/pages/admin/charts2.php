<?php require APPROOT . "/views/inc/header.php" ?>
<?php require APPROOT . "/views/inc/aside.php" ?> 
	<div class="col-lg-10 col-md-9 col-sm-12" id="chartDiv">
		<form action="" method="POST">
			<div class="form-group">
				<label for="date1">Year from:</label>
			    <input class="form-control" type="number" min="1980" max="2020" step="1" value="2019"  id="date1" />
		  	</div>
		  	<div class="form-group">
		  		<label for="date2">Year to:</label>
			    <input class="form-control" type="number" min="1980" max="2020" step="1" value="2019" id="date2"  />
		  </div>
		  <div class="form-group">
			  <label for="manufSelect">Choose manufacturer:</label>
			    <select class="form-control" id="manufSelect">
			    	<?php foreach ($data['manuf'] as $key => $value): ?>
			    		<option value="<?php echo $value['id']; ?>"><?php echo $value['manufacturer']; ?></option>
			    	<?php endforeach ?>
			     
			    </select>
		  </div>
		  <input type="button" class="btn btn-primary" onclick="submitForm()" value="Submit">
		</form>
		
		<div class="second-chart">
		 	<div id="columnchart_values" style="width: 900px; height: 300px;"></div>
		</div>
		
	</div>
	
	
	<footer></footer>
	<script type="text/javascript">
    google.charts.load("current", {packages:['corechart']});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart(resp,options,chart) {
      var data = google.visualization.arrayToDataTable(resp);

      var view = new google.visualization.DataView(data);
      view.setColumns([0, 1,
                       { calc: "stringify",
                         sourceColumn: 1,
                         type: "string",
                         role: "annotation" },
                       2]);
      
      chart.draw(view, options);
 	}	
    function submitForm(){
			let date1=document.getElementById('date1').value;
			let date2=document.getElementById('date2').value;
			let sel = document.getElementById ("manufSelect");
			let selOption = sel.options[sel.selectedIndex].value;
			let data={
				"date1":date1,
				"date2":date2,
				"manufacturer":selOption
			};
			if (date2>date1) {
				$.ajax({
				type : 'POST',
				url : 'http://localhost/automobili/Charts/getDataSecondCharts',					
				data : {
					insurance_form: 1,
        			form_data : data, 
				},
				success: function(response){
					var resp = JSON.parse(response);
					console.log(resp);
					let niz=[];
					let x=['Element','Density',{ role: "style" }];
					niz.push(x);
					for(data in resp){
						
						niz1=[resp[data].year, parseInt(resp[data].price), "rgb(0,0,45)"];
						niz.push(niz1);
					}
					console.log(niz);
					var options = {
				        title: "AVG price cars per year",
				        width: 600,
				        height: 400,
				        bar: {groupWidth: "95%"},
				        legend: { position: "none" },
				      };
				      var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_values"));
					drawChart(niz,options,chart);
				},
				dataType : 'text'
			});
			}else{
				alert('Incorect data');
				location.reload();
			}
			
		}
	
	</script>
 <?php require APPROOT . "/views/inc/footer.php" ?> 

 



