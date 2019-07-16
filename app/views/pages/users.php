<?php require APPROOT . "/views/inc/header.php" ?>
<div id="profile"></div>
<div class="container" id="userContainer">
	<div class="row">
		<div class="col">
			<h4 id="titleName">Trending Near You</h4>
		</div>
	</div>
	<div class="row">
		
		<?php foreach ($data['cars'] as $key => $value): ?>
		<div class="col-md-4">
			<div class="card" style="width: 18rem;">
			  
			  <div class="card-body">
			    <h5 class="card-title"><?php echo $value['manufacturer'].' '.$value['model']; ?></h5>
			  </div>
			  <img id="cardImg" class="card-img-top" src="<?php echo URLROOT; ?>/public/img/cars/<?php echo $value['picture']; ?>" alt="Card image cap">
			  <ul class="list-group list-group-flush">
			    <li class="list-group-item" id="cardPrice"><?php echo $value['price']; ?>&euro;</li>
		 	</ul>
			</div>
		</div>
		<?php endforeach ?>

	</div>
</div>

<footer></footer>
<?php require APPROOT . "/views/inc/footer.php" ?> 