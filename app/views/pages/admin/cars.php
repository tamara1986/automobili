<?php require APPROOT . "/views/inc/header.php" ?>
<?php require APPROOT . "/views/inc/aside.php" ?> 
	<div class="col-lg-10 col-md-9 col-sm-12" id="carsDiv">
			<form id="carsForm" style="margin: 20px auto;width: 80%;" method="POST" action="<?php echo URLROOT; ?>/Cars/store" enctype="multipart/form-data">
					<?php
						if (isset($data['msg'])) {
							?>
							<p style="color: green"><?php echo $data['msg']; ?></p>
							<?php
						}
					 ?>
					 <?php
						if (isset($data['msgErr'])) {
							?>
							<p style="color: red"><?php echo $data['msgErr']; ?></p>
							<?php
						}
					 ?>
			  <div class="form-group">
			    <label for="manufacturerSelect">Choose manufacturer</label>
			    <select class="form-control" id="manufacturerSelect" onchange="getModels()" name="manufSelect">
			    	<?php foreach ($data['manufacturer'] as $key => $value): ?>
			    		<option value="<?php echo $value['id']; ?>"><?php echo $value['manufacturer']; ?></option>
			    	<?php endforeach ?>
			    </select>
			  </div>
			  <div class="form-group" id="modell" >
			    <label for="modelSelect">Choose model</label>
			    <select class="form-control" id="modelSelect" name="modelSelect"></select>
			  </div>
			   <div class="form-group">
			    <label for="colorSelect">Choose color</label>
			    <select class="form-control" id="colorSelect" name="colorSelect">
			    	<?php foreach ($data['color'] as $key => $value): ?>
			    		<option value="<?php echo $value['id']; ?>"><?php echo $value['color']; ?></option>
			    	<?php endforeach ?>
			    </select>
			  </div>
			  <div class="form-group">
			    <label for="yearSelect">Choose year</label>
			    <select class="form-control" id="yearSelect" name="yearSelect">
			    	<?php
			    	for ($i=1986; $i <2020 ; $i++) { 
			    		?>
			    		<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
			    		<?php
			    	}
			    	 ?>
			    </select>
			  </div>
			  	<div class="form-group">
			    <label for="kmSelect">Choose year</label>
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
			    <label for="state">Choose state</label>
			    <select class="form-control" id="state" name="state">
			    	<option value="0">New</option>
			    	<option value="1">Used</option>
			    </select>
			  </div>
			  	<div class="form-group">
				  <label for="price">Price</label>
				  <input type="number" id="price" name="price" class="form-control">
			  </div>
			  	<div class="form-group">
				  <label for="picture">Choose photo</label>
				  <input type="file" class="form-control-file" accept="image/*" id="picture" name="picture">
			  </div>
			  <input type="submit"  class="btn btn-primary btn-block" value="Submit">
			</form>
	</div>
	<footer></footer>
<script type="text/javascript">
	window.onload=function(){
		getModels();
	}
	function getModels(){
		let sel = document.getElementById ("manufacturerSelect");
		let selOption = sel.options[sel.selectedIndex].value;
		let modell=document.getElementById ("modell");
		let x=document.getElementById ("modelSelect");
		x.innerHTML='';
		$.ajax({
				type : 'POST',
				url : 'http://localhost/automobili/ManufacturerModels/getModelsManufacturer',					
				data : {
					insurance_form: 1,
        			form_data : selOption, 
				},
				success: function(response){
					let resp = JSON.parse(response);
					let y='';
					for (var i = 0; i < resp.length; i++) {
						console.log(resp[i]);
						 y+='<option value="'+resp[i].id+'">'+resp[i].model+'</option>';
					}
					x.innerHTML+=y;
					
				},
				dataType : 'text'
			});
	}
</script>
<?php require APPROOT . "/views/inc/footer.php" ?> 