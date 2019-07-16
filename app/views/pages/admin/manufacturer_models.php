<?php require APPROOT . "/views/inc/header.php" ?>
<?php require APPROOT . "/views/inc/aside.php" ?> 
<div class="col-lg-10 col-md-9 col-sm-12" id="manModel">
			<form style="display: none;margin: 20px auto ;width: 80%;" id="editForm">
				<div class="form-group">
				    <label for="editTitle">Edit model</label>
				    <a href="#"><span style="float: right;color: red;font-weight: bold" onclick="hiddenForm('editForm')" id="editSpan">x</span></a>
				    <input type="text" class="form-control" id="editTitle" value=""> 
				    <input type="hidden" id="idManufacturer" value="">
				  </div>
				  <input type="button" id="editBtn" class="btn btn-primary btn-success" value="Submit">
  				
			</form>
			 <form id="Modelform" style="margin: 20px auto;width: 80%;display: none">
			  <div class="form-group">
			    <label for="manufacturerSelect">Choose manufacturer</label>
			    <a href="#"><span style="float: right;color: red;font-weight: bold" onclick="hiddenForm('Modelform')" id="addSpan">x</span></a>
			    <select class="form-control" id="manufacturerSelect">
			    	<?php foreach ($data['manufacturer'] as $key => $value): ?>
			    		<option value="<?php echo $value['id']; ?>"><?php echo $value['manufacturer']; ?></option>
			    	<?php endforeach ?>
			     
			    </select>
			  </div>
			  <div class="form-group">
			    <label for="type">Add model</label>
			    <input type="text" class="form-control" id="model_name" placeholder="Enter model">  
			  </div>
			  <input type="button" onclick="modelAdd()" class="btn btn-primary" value="Submit">
			 </form>
			<table class="table" id="lista" style="width: 80%;margin: 0 auto">
				  <thead class="thead-dark" style="background-color: rgb(0,166,90);color: white">
				    <tr>
				      <th scope="col"></th>
				      <th scope="col">Manufacturer</th>
				      <th scope="col">Model</th>
				      <th scope="col">Delete</th>
				      <th scope="col">Edit</th>
				    </tr>
				  </thead>
				  <tbody>
				  	<?php 
				  	$brojac=0;
				  	foreach ($data['models'] as $key => $value): ?>
				  		<tr><td><?php echo ++$brojac; ?></td><td><?php echo $value['manufacturer']; ?></td><td><?php echo $value['model_name']; ?></td><td><button class="btn btn-danger btn-sm" onclick="deleteItem('<?php echo $value['id_model']; ?>')" id="'<?php echo $value['id_model']; ?>'">Delete</button></td><td><button class="btn btn-warning btn-sm" onclick="editModels(<?php echo $value['id_model']; ?>,'<?php echo $value['model_name']; ?>',<?php echo $value['id_manufacturer']; ?>)">Edit</button></td></tr>
				  	<?php endforeach ?>
				
				</tbody>
			</table>
	
	
			<button type="button" class="btn btn-lg btn-block" style="background-color:white;color:rgb(0,0,45);width: 80%;margin: 0 auto" onclick="showForm()">ADD NEW MODEL</button>

</div>
<footer></footer>
<script type="text/javascript">
	function editModels(id,x,man_id){
		let model_id=id;
		let input=document.getElementById('editTitle');
		input.value=x;
		input.style.border="1px solid red";
		let manufId=document.getElementById('idManufacturer');
		manufId.value=man_id;
		let btnn=document.getElementById('editBtn');
		btnn.addEventListener("click", function() {
  		updateModel(model_id);
  		});
		let form=document.getElementById('editForm').style.display="block";
		
	}
	function updateModel(id){
		console.log('tu');
		let editTitle=document.getElementById('editTitle').value;
		let ManufacId=document.getElementById('idManufacturer').value;
		let model_id=id;
		let data={
			"id_manufacturer":ManufacId,
			"id_model":model_id,
			"model":editTitle
		};
			$.ajax({
				type : 'POST',
				url : 'http://localhost/automobili/ManufacturerModels/update',					
				data : {
					insurance_form: 1,
        			form_data : data, 
				},
				success: function(response){
					var resp = JSON.parse(response);
					console.log(resp);
					alert('Model updated');
					location.reload();
				},
				dataType : 'text'
			});
		
	}
	function showForm(){
		document.getElementById('Modelform').style.display="block";
		
	}
	function hiddenForm(spanName){
		let form=document.getElementById(spanName);
		form.style.display="none";
	}
	function deleteItem(id){
		let id_model=id;
			$.ajax({
				type : 'POST',
				url : 'http://localhost/automobili/ManufacturerModels/delete',					
				data : {
					insurance_form: 1,
        			form_data : id_model, 
				},
				success: function(response){
					var resp = JSON.parse(response);
					alert('Models deleted');
					location.reload();
				},
				dataType : 'text'
			});
	}
	function modelAdd(){
		let model_name=document.getElementById('model_name').value;
		let sel = document.getElementById ("manufacturerSelect");
		let selOption = sel.options[sel.selectedIndex].value;
		let data={
			"model":model_name,
			"id_manufacturer":selOption
		}
			$.ajax({
				type : 'POST',
				url : 'http://localhost/automobili/ManufacturerModels/store',					
				data : {
					insurance_form: 1,
        			form_data : data, 
				},
				success: function(response){
					var resp = JSON.parse(response);
					alert('Models added');
					location.reload();
				},
				dataType : 'text'
			});
	}
	
</script>
<?php require APPROOT . "/views/inc/footer.php" ?> 