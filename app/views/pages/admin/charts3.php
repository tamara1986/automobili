<?php require APPROOT . "/views/inc/header.php" ?>
<?php require APPROOT . "/views/inc/aside.php" ?> 
<div class="col-lg-10 col-md-9 col-sm-12" id="chartDiv">
	<form action="" method="POST">
			<div class="form-group">
				<label for="date3">Year from:</label>
			    <input class="form-control" type="number" min="1980" max="2020" step="1" value="2019"  id="date3" />
		  	</div>
		  	<div class="form-group">
		  		<label for="date4">Year to:</label>
			    <input class="form-control" type="number" min="1980" max="2020" step="1" value="2019" id="date4"  />
		  </div>
		  <div class="form-group">
			  <label for="manufSelect">Miles from:</label>
			     <select class="form-control" id="kmSelect" name="kmSelect">
			    	<?php
			    	for ($i=10; $i <=500 ; $i+=30) { 
			    		?>
			    		<option value="<?php echo $i; ?>"><?php echo $i; ?>Miles from</option>
			    		<?php
			    	}
			    	 ?> 
			    </select>
		  </div>
		   <div class="form-group">
			  <label for="manufSelect2">Miles to:</label>
			     <select class="form-control" id="kmSelect2" name="kmSelect2">
			    	<?php
			    	for ($i=10; $i <=500 ; $i+=30) { 
			    		?>
			    		<option value="<?php echo $i; ?>"><?php echo $i; ?>Miles from</option>
			    		<?php
			    	}
			    	 ?> 
			    </select>
		  </div>
		  <input type="button" class="btn btn-primary" onclick="submitForm2()" value="Submit">
		</form>
		<div class="third-chart">
		 	<div id="columnchart_values2" style="width: 900px; height: 300px;"></div>
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
 		function submitForm2(){
			let date1=document.getElementById('date3').value;
			let date2=document.getElementById('date4').value;
			let sel = document.getElementById ("kmSelect");
			let selOption = sel.options[sel.selectedIndex].value;
			let sel2 = document.getElementById ("kmSelect2");
			let selOption2 = sel2.options[sel2.selectedIndex].value;
			let datas={
				"date1":date1,
				"date2":date2,
				"km":selOption,
				"km2":selOption2
			};
			console.log(selOption,selOption2);
			if (date2>date1 && selOption2>selOption) {
				$.ajax({
				type : 'POST',
				url : 'http://localhost/automobili/Charts/getDataThirdCharts',					
				data : {
					insurance_form: 1,
        			form_data : datas, 
				},
				success: function(response){
					var resp = JSON.parse(response);
					console.log(resp);
					let niz=[];
					let x=['Element','Density',{ role: "style" }];
					niz.push(x);
					for(data in resp){
						
						niz1=[resp[data].year, parseFloat(resp[data].km), "rgb(0,0,45)"];
						niz.push(niz1);
					}
					console.log(niz);
					var options = {
				        title: "AVG km cars per year",
				        width: 600,
				        height: 400,
				        bar: {groupWidth: "95%"},
				        legend: { position: "none" },
				      };
				      var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_values2"));
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