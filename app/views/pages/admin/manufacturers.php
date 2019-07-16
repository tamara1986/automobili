<?php require APPROOT . "/views/inc/header.php" ?>
<?php require APPROOT . "/views/inc/aside.php" ?> 
<div class="col-lg-10 col-md-9 col-sm-12" id="manuf">
			<form style="display: none;margin: 20px auto;width: 80%;" id="editForm">
				<div class="form-group">
				    <label for="manufacturer">Edit manufacturer</label>
				    <a href="#"><span style="float: right;color: red;font-weight: bold" onclick="hiddenForm('editForm')" id="editSpan">x</span></a>
				    <input type="text" class="form-control" id="editTitle" value="">  
				  </div>
  				<button type="submit" id="editBtn" class="btn btn-primary btn-success">Submit</button>
			</form>

			 <form id="Mform" style="margin: 20px auto;width: 80%;display: none" method="POST">
			  <div class="form-group">
			    <label for="manufacturer">Add manufacturer</label>
			    <a href="#"><span style="float: right;color: red;font-weight: bold" onclick="hiddenForm('Mform')" id="addSpan">x</span></a>
			    <input type="text" class="form-control" id="manufacturer" placeholder="Enter manufacturer">  
			  </div>
			  <input type="button" onclick="manufacturerAdd()" class="btn btn-primary" value="Submit">
			  
			 </form>
			 
				<table id="lista" class="table table-dark" style="width: 80%;margin: 0 auto">
				<thead class="thead-dark"  id="rowList">
				    <tr>
				      <th scope="col"></th>
				      <th scope="col">Manufacturer</th>
				      <th scope="col" class="deleteTh">Delete</th>
				      <th scope="col" class="deleteTh">Edit</th>
				    </tr>

				    <?php 
				    $brojac=0;
				    foreach ($data['manufacturers'] as $key => $value): ?>
				    <tr><td><?php echo ++$brojac; ?></td><td><?php echo $value['manufacturer']; ?></td><td><button class="btn btn-danger btn-sm" onclick="deleteItem(<?php echo $value['id'] ?>)" id="<?php $value['id']; ?>">Delete</button></td><td><button class="btn btn-warning  btn-sm" onclick="editManufacturer(<?php echo $value['id']; ?>,'<?php echo $value['manufacturer']; ?>')">Edit</button></td></tr>
				    <?php endforeach ?>
				 </thead>
			</table>
			<button type="button" class="btn btn-lg btn-block" style="color:rgb(0,0,45);background-color:white;width: 80%;margin: 0 auto" onclick="showForm()">ADD NEW MODEL</button>
			</div>

<script type="text/javascript">
	function showForm(){
		document.getElementById('Mform').style.display="block";
		
	}
	function manufacturerAdd(){
		let manuf=document.getElementById('manufacturer').value;
		console.log(manuf);
				$.ajax({
					type : 'POST',
					url : 'http://localhost/automobili/Manufacturers/store',					
					data : {
						insurance_form: 1,
            			form_data : manuf, 
					},
					success: function(response){
						var resp = JSON.parse(response);
						alert('You have successfully added the manufacturer');
						location.reload();
					},
					dataType : 'text'
				});
	}
	function editManufacturer(id,x){
		console.log(x);
		let manufacturer_id=id;
		let input=document.getElementById('editTitle');
		input.value=x;
		input.style.border="1px solid red"
		let btnn=document.getElementById('editBtn');
		btnn.addEventListener("click", function() {
  		updateManufacturer(manufacturer_id);
  		});
		let form=document.getElementById('editForm').style.display="block";
	}
	function updateManufacturer(id){
		console.log(id);
		let editTitle=document.getElementById('editTitle').value;
		let manuf_id=id;
		data={
			"id":manuf_id,
			"title":editTitle
		}
			$.ajax({
				type : 'POST',
				url : 'http://localhost/automobili/Manufacturers/edit',					
				data : {
					insurance_form: 1,
        			form_data : data, 
				},
				success: function(response){
					var resp = JSON.parse(response);
					alert('You have successfully updated the manufacturer!');
					location.reload();
				},
				dataType : 'text'
			});
		
	}
	function deleteItem(id){
		let id_manufacturer=id;
		$.ajax({
				type : 'POST',
				url : 'http://localhost/automobili/Manufacturers/delete',					
				data : {
					insurance_form: 1,
        			form_data : id_manufacturer, 
				},
				success: function(response){
					var resp = JSON.parse(response);
					alert('Manufacturer deleted');
					location.reload();
				},
				dataType : 'text'
			});
		
	}
	function hiddenForm(spanName){
		let form=document.getElementById(spanName);
		form.style.display="none";
	}
</script>


<?php require APPROOT . "/views/inc/footer.php" ?> 